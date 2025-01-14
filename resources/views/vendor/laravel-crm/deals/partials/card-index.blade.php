@component('my-crm::components.card')

    @component('my-crm::components.card-header')

        @slot('title')
            {{ ucfirst(__('my-crm::lang.deals')) }}
        @endslot

        @slot('actions')
            @if($pipeline)
                @include('my-crm::partials.view-types', [
                    'model' => 'deals', 
                    'viewSetting' => $viewSetting ?? 'list'
                ])
            @endif
            
            @include('my-crm::partials.filters', [
                'action' => route('laravel-crm.deals.filter'),
                'model' => '\Kv\MyCrm\Models\Deal'
            ])
            @can('create crm deals')
                <a type="button" class="btn btn-primary btn-sm" href="{{ url(route('laravel-crm.deals.create')) }}"><span class="fa fa-plus"></span>  {{ ucfirst(__('my-crm::lang.add_deal')) }}</a>
            @endcan
        @endslot

    @endcomponent

    @component('my-crm::components.card-table')

        <table class="table mb-0 card-table table-hover">
            <thead>
            <tr>
                <th scope="col">{{ ucwords(__('my-crm::lang.created')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.title')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.labels')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.value')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.client')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.organization')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.contact_person')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.expected_close')) }}</th>
                <th scope="col">{{ ucwords(__('my-crm::lang.owner')) }}</th>
                <th scope="col" width="240"></th>
            </tr>
            </thead>
            <tbody>
            @foreach($deals as $deal)
                <tr class="has-link @if($deal->closed_status == 'won') table-success @elseif($deal->closed_status == 'lost') table-danger @endif" data-url="{{ url(route('laravel-crm.deals.show',$deal)) }}">
                    <td>{{ $deal->created_at->diffForHumans() }}</td>
                    <td>{{ $deal->title }}</td>
                    <td>@include('my-crm::partials.labels',[
                            'labels' => $deal->labels,
                            'limit' => 3
                        ])</td>
                    <td>{{ money($deal->amount, $deal->currency) }}</td>
                    <td>{{ $deal->client->name ?? null }}</td>
                    <td>{{ $deal->organisation->name ?? null }}</td>
                    <td>{{ $deal->person->name ?? null }}</td>
                    <td>{{ ($deal->expected_close) ? $deal->expected_close->format($dateFormat) : null }}</td>
                    <td>{{ $deal->ownerUser->name ?? ucfirst(__('my-crm::lang.unallocated')) }}</td>
                    <td class="disable-link text-right">
                        @can('edit crm deals')
                        @if(!$deal->closed_at)
                            <a href="{{  route('laravel-crm.deals.won',$deal) }}" class="btn btn-success btn-sm">{{ ucfirst(__('my-crm::lang.won')) }}</a>
                            <a href="{{  route('laravel-crm.deals.lost',$deal) }}" class="btn btn-danger btn-sm">{{ ucfirst(__('my-crm::lang.lost')) }}</a>
                        @else
                            <a href="{{  route('laravel-crm.deals.reopen',$deal) }}" class="btn btn-outline-secondary btn-sm">{{ ucfirst(__('my-crm::lang.reopen')) }}</a>
                        @endif
                        @endcan
                        @can('view crm deals')
                        <a href="{{  route('laravel-crm.deals.show',$deal) }}" class="btn btn-outline-secondary btn-sm"><span class="fa fa-eye" aria-hidden="true"></span></a>
                        @endcan
                        @can('edit crm deals')
                        <a href="{{  route('laravel-crm.deals.edit',$deal) }}" class="btn btn-outline-secondary btn-sm"><span class="fa fa-edit" aria-hidden="true"></span></a>
                        @endcan
                        @can('delete crm deals')
                        <form action="{{ route('laravel-crm.deals.destroy',$deal) }}" method="POST" class="form-check-inline mr-0 form-delete-button">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button class="btn btn-danger btn-sm" type="submit" data-model="{{ __('my-crm::lang.deal') }}"><span class="fa fa-trash-o" aria-hidden="true"></span></button>
                        </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    @endcomponent

    @if($deals instanceof \Illuminate\Pagination\LengthAwarePaginator )
        @component('my-crm::components.card-footer')
            {{ $deals->links() }}
        @endcomponent
    @endif

@endcomponent
