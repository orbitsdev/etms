<div>
    <x-admin-layout>
        @section('title')
        Course Form
    @endsection
        <form wire:submit="create">
            {{ $this->form }}

            <x-filament::button type="submit" class="mt-4">
            SAVE

            <div wire:loading wire:target="create" class="ml-2">
                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                </svg>
            </div>
        </x-filament::button>
        </form>

        <x-filament-actions::modals />
    </x-admin-layout>
</div>
