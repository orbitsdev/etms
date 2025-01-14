<div>
    <section aria-labelledby="applicant-information-title">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h2 id="applicant-information-title" class="text-lg font-medium text-gray-900">Account Details</h2>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Detailed information about the account.</p>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <!-- Profile Photo -->
                    <div class="sm:col-span-2 flex items-center">
                        <dt class="text-sm font-medium text-gray-500">Profile Photo</dt>
                        <dd class="mt-1 ml-4">
                            <a href="{{$record->getImage()}}" target="_blank">

                                <img
                                class="h-16 w-16 rounded-full object-cover"
                                src="{{$record->getImage()}}"
                                alt="Profile Photo">
                            </a>
                        </dd>
                    </div>
                    <!-- Name -->
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Name</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $record->name }}</dd>
                    </div>
                    <!-- Email -->
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Email Address</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $record->email ?? '' }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </section>

    <section aria-labelledby="applicant-information-title" class="mt-2">
        <div class="bg-white shadow sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h2 id="applicant-information-title" class="text-lg font-medium text-gray-900">User Information</h2>
                <p class="mt-1 max-w-2xl text-sm text-gray-500">Details about the user's personal information.</p>
            </div>
            <div class="border-t border-gray-200 px-4 py-5 sm:px-6">
                <dl class="grid grid-cols-1 gap-x-4 gap-y-8 sm:grid-cols-2">
                    <!-- First Name -->
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">First Name</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $record->userDetails->first_name ?? 'N/A' }}</dd>
                    </div>
                    <!-- Last Name -->
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Last Name</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $record->userDetails->last_name ?? 'N/A' }}</dd>
                    </div>
                    <!-- Type with Badge -->
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Type</dt>
                        @php
                            $type = $record->userDetails->type ?? 'N/A';
                            $badgeClasses = match ($type) {
                                'Faculty' => 'bg-blue-100 text-blue-700',
                                'Student' => 'bg-green-100 text-green-700',
                                'Job Order' => 'bg-yellow-100 text-yellow-800',
                                default => 'bg-gray-100 text-gray-600',
                            };
                        @endphp
                        <dd class="mt-1 text-sm">
                            <span class="inline-flex items-center rounded-md px-2 py-1 text-xs font-medium {{ $badgeClasses }}">
                                {{ $type }}
                            </span>
                        </dd>
                    </div>
                    <!-- Department -->
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Department</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $record->userDetails->department ?? 'N/A' }}</dd>
                    </div>
                    <!-- Course -->
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Course</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $record->userDetails->course ?? 'N/A' }}</dd>
                    </div>
                    <!-- Position -->
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Position</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $record->userDetails->position ?? 'N/A' }}</dd>
                    </div>
                    <!-- Year -->
                    <div class="sm:col-span-1">
                        <dt class="text-sm font-medium text-gray-500">Year</dt>
                        <dd class="mt-1 text-sm text-gray-900">{{ $record->userDetails->year ?? 'N/A' }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </section>


</div>
