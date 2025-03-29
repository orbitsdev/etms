<div>
    <div class="flex items-center">
        <figure>
            @if ($getRecord()->feedback)
                <div class="flex">
                    @for ($i = 1; $i <= 5; $i++)
                        <svg class="h-5 w-5 {{ $i <= $getRecord()->feedback->rating ? 'text-yellow-400' : 'text-gray-300' }}"
                             xmlns="http://www.w3.org/2000/svg"
                             viewBox="0 0 20 20"
                             fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.036 3.194a1 1 0 00.95.69h3.362c.969
                                     0 1.371 1.24.588 1.81l-2.72 1.978a1 1 0 00-.364
                                     1.118l1.036 3.194c.3.921-.755 1.688-1.54
                                     1.118l-2.72-1.978a1 1 0 00-1.175
                                     0l-2.72 1.978c-.785.57-1.84-.197-1.54-1.118l1.036-3.194a1
                                     1 0 00-.364-1.118L2.4 8.621c-.784-.57-.38-1.81.588-1.81h3.362a1
                                     1 0 00.95-.69l1.036-3.194z" />
                        </svg>
                    @endfor
                </div>
                <p class=" text-gray-700">“{{ $getRecord()->feedback->message }}”</p>
            @else
                <p class="text-gray-400 italic">No feedback available.</p>
            @endif
        </figure>
    </div>
</div>
