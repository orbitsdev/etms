<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            {{-- <x-authentication-card-logo /> --}}
        </x-slot>

        <x-validation-errors class="mb-4" />

        <div class="flex flex-col justify-center items-center mt-4 mb-8">
            <p class="text-3xl text-sksu-800 font-bold">ETMS</p>
            <p class="text-md text-sksu-900 drop-shadow-sm">Equipment Tracking Management System</p>
        </div>

        {{-- ✅ Alpine.js manages step navigation --}}
        <form method="POST" action="{{ route('register') }}"
            x-data="{ step: 1, role: 'Student', sections: [], courseSelected: false }">
            @csrf

            {{-- Step 1: Personal Information --}}
            <div x-show="step === 1">
                <h2 class="text-xl font-bold mb-4">Step 1: Personal Information</h2>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <x-label for="first_name">First Name</x-label>
                        <x-input id="first_name" class="block mt-1 w-full" type="text" name="first_name" required />
                    </div>
                    <div>
                        <x-label for="middle_name">Middle Name</x-label>
                        <x-input id="middle_name" class="block mt-1 w-full" type="text" name="middle_name" />
                    </div>
                    <div>
                        <x-label for="last_name">Last Name</x-label>
                        <x-input id="last_name" class="block mt-1 w-full" type="text" name="last_name" required />
                    </div>
                </div>

                <div class="mt-4">
                    <x-label for="email">Email</x-label>
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" required />
                </div>

                <div class="mt-4">
                    <x-label for="password">Password</x-label>
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                </div>

                <div class="mt-4">
                    <x-label for="password_confirmation">Confirm Password</x-label>
                    <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                </div>

                <div class="flex justify-end mt-4">
                    <x-button @click.prevent="step = 2">Next</x-button>
                </div>
            </div>

            {{-- Step 2: Role & Academic Details --}}
            <div x-show="step === 2">
                <h2 class="text-xl font-bold mb-4">Step 2: Role & Academic Details</h2>

                {{-- Role Selection --}}
                <div class="mt-4">
                    <x-label for="role">Role</x-label>
                    <select id="role" name="role" x-model="role" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                        <option value="Student">Student</option>
                        <option value="Faculty">Faculty</option>
                    </select>
                </div>

                {{-- Department Dropdown --}}
                <div class="mt-4">
                    <x-label for="department">Department</x-label>
                    <select id="department" name="department" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">Select Department</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->name }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Course & Section (Only for Students) --}}
                <div class="mt-4" x-show="role === 'Student'">
                    <x-label for="course_id">Course</x-label>
                    <select id="course_id" name="course_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                        x-on:change="fetch('/get-sections/' + $event.target.value)
                            .then(res => res.json())
                            .then(data => { sections = data; courseSelected = true; })">
                        <option value="">Select Course</option>
                        @foreach ($courses as $course)
                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4" x-show="role === 'Student' && courseSelected">
                    <x-label for="section_id">Section</x-label>
                    <select id="section_id" name="section_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                        <template x-for="section in sections">
                            <option :value="section.id" x-text="section.name"></option>
                        </template>
                    </select>
                </div>

                {{-- Position (Only for Faculty) --}}
                <div class="mt-4" x-show="role === 'Faculty'">
                    <x-label for="position">Position</x-label>
                    <x-input id="position" class="block mt-1 w-full" type="text" name="position" />
                </div>

                <div class="flex justify-between mt-4">
                    <x-button @click.prevent="step = 1">Previous</x-button>
                    <x-button @click.prevent="step = 3">Next</x-button>
                </div>
            </div>

            {{-- Step 3: Review & Submit --}}
            <div x-show="step === 3">
                <h2 class="text-xl font-bold mb-4">Step 3: Review & Submit</h2>

                <p class="text-gray-700">Please review your information before submitting.</p>

                <div class="flex justify-between mt-4">
                    <x-button @click.prevent="step = 2">Previous</x-button>
                    <x-button type="submit">Register</x-button>
                </div>
            </div>

        </form>
    </x-authentication-card>
</x-guest-layout>
