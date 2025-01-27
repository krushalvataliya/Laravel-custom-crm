<form method="POST" action="{{ url(route('laravel-crm.users.store')) }}">
    @csrf
    @component('my-crm::components.card')

        @component('my-crm::components.card-header')

            @slot('title')
                {{ ucfirst(__('my-crm::lang.create_user')) }}
            @endslot

            @slot('actions')
                <span class="float-right"><a type="button" class="btn btn-outline-secondary btn-sm" href="{{ url(route('laravel-crm.users.index')) }}"><span class="fa fa-angle-double-left"></span>  {{ ucfirst(__('my-crm::lang.back_to_users')) }}</a></span>
            @endslot

        @endcomponent

        @component('my-crm::components.card-body')

            @include('my-crm::users.partials.fields')

        @endcomponent

        @component('my-crm::components.card-footer')
            <a href="{{ url(route('laravel-crm.users.index')) }}" class="btn btn-outline-secondary">{{ ucfirst(__('my-crm::lang.cancel')) }}</a>
            <button type="submit" class="btn btn-primary">{{ ucfirst(__('my-crm::lang.save')) }}</button>
        @endcomponent

    @endcomponent
</form>