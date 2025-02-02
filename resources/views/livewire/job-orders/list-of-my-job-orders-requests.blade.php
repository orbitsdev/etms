<div>

    <x-admin-layout>
        @section('title')
        My Job Order Requests
    @endsection

        {{ $this->table }}
        <x-filament-actions::modals />

    </x-admin-layout>
</div>
