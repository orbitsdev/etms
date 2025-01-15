<div>
    <x-admin-layout>

        <main>
            <!-- Feedback Section -->

            <div class="relative isolate ">
                <div class="relative">
                    <div class="mx-auto max-w-7xl px-6 lg:px-8">
                        <div class="mx-auto max-w-2xl sm:text-center">
                            <h2 class="text-base/7 font-semibold text-indigo-600">User Feedback</h2>
                            <p
                                class="mt-2 text-pretty text-4xl font-semibold tracking-tight text-gray-900 sm:text-balance sm:text-5xl">
                                What our users are saying about us
                            </p>

                            @if ($canSubmitFeedback)
                                <div class="mt-8">
                                    {{ $this->addFeedback }}
                                </div>
                            @else
                                <p class="mt-8 text-gray-500">You need to complete at least one request or job order to
                                    provide feedback.</p>
                            @endif

                        </div>

                        <!-- Feedback Grid -->
                        <div
                            class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-8 text-sm/6 text-gray-900 sm:mt-20 sm:grid-cols-2 xl:mx-0 xl:max-w-none xl:grid-cols-3">
                            @forelse($feedbacks as $feedback)
                                <figure class="rounded-2xl bg-white p-6 shadow-lg ring-1 ring-gray-900/5">
                                    <blockquote class="text-gray-900">
                                        <p>“{{ $feedback->message }}”</p>
                                    </blockquote>
                                    <figcaption class="mt-6 flex items-center gap-x-4">
                                        <img class="size-10 rounded-full bg-gray-50"
                                            src="{{ $feedback->user->getImage() }}" alt="{{ $feedback->user->name }}">
                                        <div>
                                            <div class="font-semibold">{{ $feedback->user->name }}</div>
                                            @if ($feedback->user->userDetails)
                                                <div class="text-gray-600">{{ $feedback->user->userDetails->type }}
                                                </div>
                                            @endif
                                            <div class="mt-2">
                                                <!-- Star Ratings -->
                                                <div class="flex items-center">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $feedback->rating)
                                                            <svg class="h-5 w-5 text-yellow-400"
                                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                fill="currentColor">
                                                                <path
                                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.036 3.194a1 1 0 00.95.69h3.362c.969 0 1.371 1.24.588 1.81l-2.72 1.978a1 1 0 00-.364 1.118l1.036 3.194c.3.921-.755 1.688-1.54 1.118l-2.72-1.978a1 1 0 00-1.175 0l-2.72 1.978c-.785.57-1.84-.197-1.54-1.118l1.036-3.194a1 1 0 00-.364-1.118L2.4 8.621c-.784-.57-.38-1.81.588-1.81h3.362a1 1 0 00.95-.69l1.036-3.194z" />
                                                            </svg>
                                                        @else
                                                            <svg class="h-5 w-5 text-gray-300"
                                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                                fill="currentColor">
                                                                <path
                                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.036 3.194a1 1 0 00.95.69h3.362c.969 0 1.371 1.24.588 1.81l-2.72 1.978a1 1 0 00-.364 1.118l1.036 3.194c.3.921-.755 1.688-1.54 1.118l-2.72-1.978a1 1 0 00-1.175 0l-2.72 1.978c-.785.57-1.84-.197-1.54-1.118l1.036-3.194a1 1 0 00-.364-1.118L2.4 8.621c-.784-.57-.38-1.81.588-1.81h3.362a1 1 0 00.95-.69l1.036-3.194z" />
                                                            </svg>
                                                        @endif
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </figcaption>
                                </figure>
                            @empty
                                <p class="text-gray-500">No feedback available at the moment.</p>
                            @endforelse
                        </div>


                        <!-- Pagination -->
                        <div class="mt-8">
                            {{ $feedbacks->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </main>



    </x-admin-layout>
    <x-filament-actions::modals />
</div>
