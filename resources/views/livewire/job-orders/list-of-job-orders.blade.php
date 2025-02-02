<div>

    <x-admin-layout>
        @section('title')
        Job Orders
    @endsection

        {{ $this->table }}
        <x-filament-actions::modals />

    </x-admin-layout>
</div>
