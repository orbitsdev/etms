<div class="flex flex-col justify-center items-center min-h-screen bg-gray-100">
    <!-- Logout Button -->
    <div class="w-full max-w-4xl mb-4 mt-8">
        <div class="flex justify-end">
            <!-- Logout Form -->
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button
                    type="submit"
                    class="group flex items-center gap-x-2 rounded-md  px-4 py-2 text-gray-400  transition duration-200 ease-in-out"
                >
                    <!-- Logout Icon -->
                    <svg class="h-4 w-4 text-gray-400  group-hover:text-gray-700 " xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                    </svg>
                    <span class="text-base leading-6  group-hover:text-gray-700">
                        Logout
                    </span>
                </button>
            </form>
        </div>
    </div>


    <!-- Form Card -->
    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-4xl">

        <h2 class="text-2xl font-bold  text-gray-800 text-center">Complete Your Details</h2>
        <p class="text-sm text-gray-600 mb-6 text-center">
            You need to complete your profile details to proceed further. Please fill in the required information below.
        </p>

        <!-- Form -->
        <form wire:submit.prevent="save" class="space-y-4">
            {{ $this->form }}

            <!-- Submit Button -->
            <x-filament::button type="submit" class="mt-4 w-full">
                Update Details
            </x-filament::button>
        </form>
    </div>

    <!-- Filament Actions Modals -->
    <x-filament-actions::modals />
</div>
