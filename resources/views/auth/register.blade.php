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

        {{-- ✅ Alpine.js at the FORM level for role-based logic --}}
        <form method="POST" action="{{ route('register') }}" x-data="{ role: 'Student', sections: [] }">
            @csrf

            <div>
                <x-label for="name">Name</x-label>
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email">Email</x-label>
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password">Password</x-label>
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-label for="password_confirmation">Confirm Password</x-label>
                <x-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            {{-- ✅ Role Selection (Controls visibility of Course & Section) --}}
            <div class="mt-4">
                <x-label for="role">Role</x-label>
                <select id="role" name="role" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                    x-model="role">
                    <option value="Student">Student</option>
                    <option value="Faculty">Faculty</option>
                </select>
            </div>

            {{-- ✅ Department Dropdown (Always Visible) --}}
            <div class="mt-4">
                <x-label for="department_id">Department</x-label>
                <select id="department_id" name="department_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    <option value="">Select Department</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- ✅ Course Dropdown (Only Visible for Students) --}}
            <div class="mt-4" x-show="role === 'Student'">
                <x-label for="course_id">Course</x-label>
                <select id="course_id" name="course_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm"
                    x-on:change="fetch('/get-sections/' + $event.target.value)
                        .then(res => res.json())
                        .then(data => sections = data)">
                    <option value="">Select Course</option>
                    @foreach ($courses as $course)
                        <option value="{{ $course->id }}">{{ $course->name }}</option>
                    @endforeach
                </select>
            </div>

            {{-- ✅ Section Dropdown (Only Visible for Students & When Sections Exist) --}}
            <div class="mt-4" x-show="role === 'Student' && sections.length > 0">
                <x-label for="section_id">Section</x-label>
                <select id="section_id" name="section_id" class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                    <template x-for="section in sections" :key="section.id">
                        <option :value="section.id" x-text="section.name"></option>
                    </template>
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button class="w-full flex items-center justify-center py-3" type="submit">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>

        <div class="py-4 flex items-center justify-center">
            <p class="text-gray-700 mr-2">Already registered?</p>
            <a href="{{ route('login') }}"
               class="text-sksu-600 underline hover:text-sksu-700 rounded"
               aria-label="Log in to your account">
                Log in
            </a>
        </div>
    </x-authentication-card>
</x-guest-layout>
