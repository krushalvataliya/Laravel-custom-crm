@extends('my-crm::layouts.app')

@section('content')

    <div class="container-fluid pl-0">
        <div class="row">
            <div class="col col-md-2">
                <div class="card">
                    <div class="card-body py-3 px-2">
                        @include('my-crm::layouts.partials.nav-settings')
                    </div>
                </div>
            </div>
            <div class="col col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title float-left m-0"> {{ ucfirst(__('my-crm::lang.tax_rates')) }}</h3>
                        @can('create crm tax rates')<span class="float-right"><a type="button" class="btn btn-primary btn-sm" href="{{ url(route('laravel-crm.tax-rates.create')) }}"><span class="fa fa-plus"></span>  {{ ucfirst(__('my-crm::lang.add_tax_rate')) }}</a></span>@endcan
                    </div>
                    <div class="card-body p-0">
                        <div class="tab-pane active" id="roles" role="tabpanel">
                            <div class="table-responsive">
                                <table class="table mb-0 card-table table-hover">
                                    <thead>
                                    <tr>
                                        <th scope="col">{{ ucfirst(__('my-crm::lang.name')) }}</th>
                                        <th scope="col">{{ ucfirst(__('my-crm::lang.rate')) }}</th>
                                        <th scope="col">{{ ucfirst(__('my-crm::lang.default')) }}</th>
                                        <th scope="col">{{ ucfirst(__('my-crm::lang.tax_type')) }}</th>
                                        <th scope="col">{{ ucfirst(__('my-crm::lang.products')) }}</th>
                                        <th scope="col">{{ ucfirst(__('my-crm::lang.created')) }}</th>
                                        <th scope="col">{{ ucfirst(__('my-crm::lang.updated')) }}</th>
                                        <th scope="col"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($taxRates as $taxRate)
                                        <tr class="has-link" data-url="{{ url(route('laravel-crm.tax-rates.show',$taxRate)) }}">
                                            <td>{{ $taxRate->name }}</td>
                                            <td>{{ $taxRate->rate }}%</td>
                                            <td>{{ $taxRate->default == 1 ? 'YES' : 'NO' }}</td>
                                            <td>{{ $taxRate->tax_type }}</td>
                                            <td>{{ $taxRate->products->count() }}</td>
                                            <td>{{ $taxRate->created_at->format($dateFormat) }}</td>
                                            <td>{{ $taxRate->updated_at->format($dateFormat) }}</td>
                                            <td class="disable-link text-right">
                                                @can('view crm tax rates')
                                                    <a href="{{  route('laravel-crm.tax-rates.show',$taxRate) }}" class="btn btn-outline-secondary btn-sm"><span class="fa fa-eye" aria-hidden="true"></span></a>
                                                @endcan
                                                @can('edit crm tax rates')
                                                    <a href="{{  route('laravel-crm.tax-rates.edit',$taxRate) }}" class="btn btn-outline-secondary btn-sm"><span class="fa fa-edit" aria-hidden="true"></span></a>
                                                @endcan
                                                @can('delete crm tax rates')
                                                    <form action="{{ route('laravel-crm.tax-rates.destroy',$taxRate) }}" method="POST" class="form-check-inline mr-0 form-delete-button">
                                                        {{ method_field('DELETE') }}
                                                        {{ csrf_field() }}
                                                        <button class="btn btn-danger btn-sm" type="submit" data-model="{{ __('my-crm::lang.tax_rate') }}"><span class="fa fa-trash-o" aria-hidden="true"></span></button>
                                                    </form>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @if($taxRates instanceof \Illuminate\Pagination\LengthAwarePaginator )
                        @component('my-crm::components.card-footer')
                            {{ $taxRates->links() }}
                        @endcomponent
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection