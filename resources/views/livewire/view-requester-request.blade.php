<div>
   
    
    <main class="flex-1">
        <div class="">
          <div class="mx-auto  xl:grid xl:max-w-5xl xl:grid-cols-3">
            <div class="xl:col-span-2 xl:border-r xl:border-gray-200 xl:pr-8">
              <div>
                <div>
                  <div class="md:flex md:items-center md:justify-between md:space-x-4 xl:border-b xl:pb-6">
                    <div>
                      <h1 class="text-2xl font-bold text-gray-900">Equipment Request</h1>
                      <p class="mt-2 text-sm text-gray-500">
                      
                        <a href="#" class=" text-gray-500">Requested Date</a>
                        -
                        <a href="#" class="font-medium text-sksu-600"> {{$record->getFormattedRequestDateAttribute()}}</a>
                      </p>
                      <div>
                       
                      
                      </div>
                    </div>
                    <div class="mt-4 flex space-x-3 md:mt-0">
                      
                    </div>
                  </div>
                  
                  <div class="py-3 xl:pb-0 xl:pt-6">
                     <div class="pb-4">
                      <h2 id="activity-title" class="text-lg font-medium text-gray-900">Purpose</h2>
                    </div>
                    <h2 class="sr-only">Description</h2>
                    <div class="text-base/7 text-gray-700">
                        <p>{{$record->purpose}}</p>
                        <ul role="list" class="mt-5 list-disc space-y-2 pl-6 marker:text-gray-300">
                          <span class="font-medium text-gray-900">Items</span>
                          @forelse ($record->items as $item)
                              <li class="pl-3">
                                  {{ $item->equipment->name }}
                                  -
                                  <span class="{{ match($item->equipment->status) {
                                      // 'Available' => 'text-green-600',
                                      // 'Reserved' => 'text-yellow-600',
                                      // 'Not Available' => 'text-red-600',
                                      // 'Out of Stock' => 'text-gray-600',
                                      // 'Archived' => 'text-blue-600',
                                      default => 'text-gray-500',
                                  } }}">
                                      {{ $item->equipment->status }}
                                  </span>
                              </li>
                          @empty
                              <li class="pl-3 text-gray-500">No Items</li>
                          @endforelse
                      </ul>
                      
                    </div>
                  </div>
                </div>
              </div>
              <section aria-labelledby="activity-title" class="mt-8 xl:mt-10">
                <div>
                  <div class="divide-y divide-gray-200">
                    <div class="pb-4">
                      <h2 id="activity-title" class="text-lg font-medium text-gray-900">Activity</h2>
                    </div>
                    <div class="pt-6">
                      <!-- Activity feed-->
                      <div class="flow-root">
                        <ul role="list" class="-mb-8">
                            @foreach ($record->histories as $history)
                                <li>
                                    <div class="relative pb-8">
                                        <!-- Timeline Line -->
                                        @if (!$loop->last)
                                            <span class="absolute left-5 top-5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                        @endif
                    
                                        <div class="relative flex items-start space-x-3">
                                            <!-- Avatar/Indicator -->
                                            <div class="relative">
                                                @if ($history->user)
                                                    <img class="flex size-10 items-center justify-center rounded-full bg-gray-400 ring-8 ring-white"
                                                         src="{{ $history->user->getImage() ?? 'https://via.placeholder.com/50' }}"
                                                         alt="{{ $history->user->name }}">
                                                @else
                                                    <div class="flex size-10 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white">
                                                        <svg class="size-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                            <path fill-rule="evenodd"
                                                                  d="M10 2c-2.236 0-4.43.18-6.57.524C1.993 2.755 1 4.014 1 5.426v5.148c0 1.413.993 2.67 2.43 2.902.848.137 1.705.248 2.57.331v3.443a.75.75 0 0 0 1.28.53l3.58-3.579a.78.78 0 0 1 .527-.224 41.202 41.202 0 0 0 5.183-.5c1.437-.232 2.43-1.49 2.43-2.903V5.426c0-1.413-.993-2.67-2.43-2.902A41.289 41.289 0 0 0 10 2Zm0 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM8 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm5 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                                                                  clip-rule="evenodd"/>
                                                        </svg>
                                                    </div>
                                                @endif
                                            </div>
                    
                                            <!-- Content -->
                                            <div class="min-w-0 flex-1">
                                              <div>
                                                  <div class="text-sm">
                                                      <a href="#" class="font-medium text-gray-900">
                                                          {{ $history->user->name ?? 'System' }}
                                                      </a>
                                                  </div>
                                                  <p class="mt-0.5 text-sm text-gray-500">
                                                      @if ($history->type === 'Status Change')
                                                          Changed status 
                                                          <span class="{{ match($history->old_status) {
                                                              'Pending' => 'text-gray-600',
                                                              'Approved', 'Picked Up', 'Delivered', 'Returned', 'Completed' => 'text-green-600',
                                                              'Ready for Pickup' => 'text-yellow-600',
                                                              'Cancelled' => 'text-red-600',
                                                              default => 'text-gray-500',
                                                          } }}">{{ $history->old_status }}</span>
                                                          →
                                                          <span class="{{ match($history->new_status) {
                                                              'Pending' => 'text-gray-600',
                                                              'Approved', 'Picked Up', 'Delivered', 'Returned', 'Completed' => 'text-green-600',
                                                              'Ready for Pickup' => 'text-yellow-600',
                                                              'Cancelled' => 'text-red-600',
                                                              default => 'text-gray-500',
                                                          } }}">{{ $history->new_status }}</span>
                                                      @elseif ($history->type === 'Date Change')
                                                          Updated request date 
                                                          <span class="text-yellow-600 font-semibold">{{ $history->old_request_date }}</span>
                                                          →
                                                          <span class="text-yellow-600 font-semibold">{{ $history->new_request_date }}</span>
                                                      @elseif ($history->type === 'Purpose Change')
                                                          Modified purpose
                                                      @endif
                                                      <span class="whitespace-nowrap">{{ $history->created_at->diffForHumans() }}</span>
                                                  </p>
                                              </div>
                                          
                                              <div class="mt-2 text-sm text-gray-700">
                                                  <p>{{ $history->description }}</p>
                                                  @if ($history->type === 'Purpose Change')
                                                      <p class="text-gray-600">
                                                          <strong>Old Purpose:</strong> 
                                                          <span class="text-red-600 font-semibold">{{ $history->old_purpose }}</span>
                                                      </p>
                                                      <p class="text-gray-600">
                                                          <strong>New Purpose:</strong> 
                                                          <span class="text-green-600 font-semibold">{{ $history->new_purpose }}</span>
                                                      </p>
                                                  @endif
                                              </div>
                                          </div>
                                          
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    
                     
                    </div>
                  </div>
                </div>
              </section>
            </div>
            <aside class="hidden xl:block xl:pl-8">
              <h2 class="sr-only">Details</h2>
              <div class="space-y-5">
                  <!-- Total Items -->
                  <div class="flex items-center space-x-2">
                      <svg class="size-5 text-blue-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path d="M10 2C5.58 2 2 5.58 2 10s3.58 8 8 8 8-3.58 8-8-3.58-8-8-8ZM8 9h4v2H8V9Zm0 4h4v2H8v-2ZM8 5h4v2H8V5Z" />
                      </svg>
                      <span class="text-sm text-blue-700 ">{{ $record->items->count() }} Total Items</span>
                  </div>
          
                  <!-- Available Items -->
                  <div class="flex items-center space-x-2">
                      <svg class="size-5 text-green-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path d="M10 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16ZM8.293 12.293a1 1 0 0 1 1.414 0L10 12.586l3.293-3.293a1 1 0 1 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414Z" />
                      </svg>
                      <span class="text-sm text-green-700 ">{{ $record->countAvailableItems() }} Available Items</span>
                  </div>
          
                  <!-- Not Available Items -->
                  <div class="flex items-center space-x-2">
                      <svg class="size-5 text-red-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path d="M10 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16Zm3.707 10.707a1 1 0 0 1-1.414 0L10 10.414l-2.293 2.293a1 1 0 0 1-1.414-1.414L8.586 9 6.293 6.707a1 1 0 1 1 1.414-1.414L10 7.586l2.293-2.293a1 1 0 0 1 1.414 1.414L11.414 9l2.293 2.293a1 1 0 0 1 0 1.414Z" />
                      </svg>
                      <span class="text-sm text-red-500 ">{{ $record->countUnavailableItems() }} Not Available Items</span>
                  </div>
          
                  <!-- Expected Return -->
                  <div class="flex items-center space-x-2 bg-sksu-50 p-2   rounded-lg border-2 border-sksu-500">
                      <svg class="size-5 text-sksu-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                          <path d="M10 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16Zm1 4H9v5h2V6Zm0 6H9v2h2v-2Z" />
                      </svg>
                      <span class="text-sm text-sksu-700 ">
                          Expected To Return: 
                          <time datetime="{{ $record->getFormattedActualReturnDateAttribute() }}">
                              {{ $record->getFormattedActualReturnDateAttribute() }}
                          </time>
                      </span>
                  </div>
              </div>
              <div class="py-5 flex flex-col items-center">
                <!-- Profile Image -->
                        
                <!-- User Name and Department -->
                <div class="py-5 flex flex-col items-center">
                  <!-- Profile Image -->
                  <a href="{{$record->user->getImage()}}" target="_blank" class="block">
                      <img 
                          src="{{$record->user->getImage()}}" 
                          alt="{{$record->user->userDetails->fullName}}" 
                          class="rounded-full border-2 border-gray-200 shadow-lg w-32 h-32 object-cover"
                      >
                  </a>
              
                  <!-- User Name and Department -->
                  <div class="mt-3 text-center">
                      <p class="text-lg font-medium text-gray-900">
                          {{$record->user->userDetails->fullName}}
                      </p>
                      <p class="text-sm text-gray-500">
                          {{$record->user->userDetails->department}}
                      </p>
                  </div>
              </div>
              
            </div>
            
            
          </aside>
          
          
          </div>
        </div>
      </main>
</div>
