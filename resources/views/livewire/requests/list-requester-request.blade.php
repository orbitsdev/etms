<div>

    <x-admin-layout>
        @section('title')
        Requests
    @endsection

        {{ $this->table }}
        <x-filament-actions::modals />

    </x-admin-layout>
</div>
