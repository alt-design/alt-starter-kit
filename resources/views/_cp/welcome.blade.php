@use('Illuminate\Support\Str')
@use('Statamic\Facades\Site')
@use('Statamic\Facades\User')
@php($firstName = Str::before((string) User::current()->get('name'), ' '))
<ui-card class="flex flex-wrap items-center justify-between gap-6">
    <div>
        <ui-heading size="xl" text="Welcome{{ $firstName ? ", {$firstName}" : '' }}"></ui-heading>
        <ui-description class="mt-1" text="{{ config('app.name') }}"></ui-description>
    </div>

    <div class="flex flex-wrap gap-2">
        @can('create pages entries')
            <ui-button href="{{ cp_route('collections.entries.create', ['pages', Site::selected()->handle()]) }}" text="Add a page" icon="plus" variant="primary"></ui-button>
        @endcan
        @can('view main_nav nav')
            <ui-button href="{{ cp_route('navigation.show', 'main_nav') }}" text="Navigation" icon="navigation"></ui-button>
        @endcan
        @can('edit contact_details globals')
            <ui-button href="{{ cp_route('globals.variables.edit', 'contact_details') }}" text="Contact details" icon="globals"></ui-button>
        @endcan
        @can('view assets assets')
            <ui-button href="{{ cp_route('assets.browse.show', 'assets') }}" text="Assets" icon="assets"></ui-button>
        @endcan
        <ui-button href="https://alt-design.net/contact" target="_blank" text="Developer support" icon="support" variant="ghost"></ui-button>
    </div>
</ui-card>
