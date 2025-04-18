<div>
    <x-admin-layout>
        @section('title')
            Create Administrator
        @endsection

        <div class="max-w-2xl mx-auto bg-white p-8 rounded-lg shadow">
            <form wire:submit="create">
                {{ $this->form }}

                <div class="mt-6 flex justify-end">
                    <a href="{{ route('admins.index') }}" class="px-4 py-2 bg-gray-300 rounded-md mr-2">Cancel</a>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md">Create Admin</button>
                </div>
            </form>
        </div>

        <x-filament-actions::modals />
    </x-admin-layout>
</div>
