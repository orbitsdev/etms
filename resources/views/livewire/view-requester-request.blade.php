<div>
   
    
    <main class="flex-1">
        <div class="py-8 xl:py-10">
          <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8 xl:grid xl:max-w-5xl xl:grid-cols-3">
            <div class="xl:col-span-2 xl:border-r xl:border-gray-200 xl:pr-8">
              <div>
                <div>
                  <div class="md:flex md:items-center md:justify-between md:space-x-4 xl:border-b xl:pb-6">
                    <div>
                      <h1 class="text-2xl font-bold text-gray-900">Equipment Request</h1>
                      <p class="mt-2 text-sm text-gray-500">
                      
                        <a href="#" class="font-medium text-gray-900">Requested Date</a>
                        -
                        <a href="#" class="font-medium text-gray-900"> {{$record->getFormattedRequestDateAttribute()}}</a>
                      </p>
                    </div>
                    <div class="mt-4 flex space-x-3 md:mt-0">
                
                    </div>
                  </div>
                  <aside class="mt-8 xl:hidden">
                    <h2 class="sr-only">Details</h2>
                    <div class="space-y-5">
                      <div class="flex items-center space-x-2">
                        <svg class="size-5 text-green-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                          <path fill-rule="evenodd" d="M14.5 1A4.5 4.5 0 0 0 10 5.5V9H3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-1.5V5.5a3 3 0 1 1 6 0v2.75a.75.75 0 0 0 1.5 0V5.5A4.5 4.5 0 0 0 14.5 1Z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-medium text-green-700">{{ $record->countAvailableItems() }} Available Iems</span>
                      </div>
                      <div class="flex items-center space-x-2">
                        <svg class="size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                          <path fill-rule="evenodd" d="M10 2c-2.236 0-4.43.18-6.57.524C1.993 2.755 1 4.014 1 5.426v5.148c0 1.413.993 2.67 2.43 2.902.848.137 1.705.248 2.57.331v3.443a.75.75 0 0 0 1.28.53l3.58-3.579a.78.78 0 0 1 .527-.224 41.202 41.202 0 0 0 5.183-.5c1.437-.232 2.43-1.49 2.43-2.903V5.426c0-1.413-.993-2.67-2.43-2.902A41.289 41.289 0 0 0 10 2Zm0 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM8 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm5 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-medium text-gray-900">{{$record->countUnavailableItems() }} Not Available Items</span>
                      </div>
                      <div class="flex items-center space-x-2">
                        <svg class="size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                          <path fill-rule="evenodd" d="M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4H5V2.75A.75.75 0 0 1 5.75 2Zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75Z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm font-medium text-gray-900">Created on <time datetime="{{$record->getFormattedActualReturnDateAttribute()}}">{{$record->getFormattedActualReturnDateAttribute()}}</time></span>
                      </div>
                    </div>
                    <div class="mt-6 space-y-8 border-b border-t border-gray-200 py-6">
                      <div>
                        <h2 class="text-sm font-medium text-gray-500">Assignees</h2>
                        <ul role="list" class="mt-3 space-y-3">
                          <li class="flex justify-start">
                            <a href="#" class="flex items-center space-x-3">
                              <div class="shrink-0">
                                <img class="size-5 rounded-full" src="https://images.unsplash.com/photo-1520785643438-5bf77931f493?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80" alt="">
                              </div>
                              <div class="text-sm font-medium text-gray-900">Eduardo Benz</div>
                            </a>
                          </li>
                        </ul>
                      </div>
                      <div>
                        <h2 class="text-sm font-medium text-gray-500">Tags</h2>
                        <ul role="list" class="mt-2 flex flex-wrap gap-1">
                          <li>
                            <a href="#" class="relative inline-flex items-center rounded-full px-2.5 py-1 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                              <div class="absolute flex shrink-0 items-center justify-center">
                                <span class="size-1.5 rounded-full bg-rose-500" aria-hidden="true"></span>
                              </div>
                              <div class="ml-3 text-xs font-semibold text-gray-900">Bug</div>
                            </a>
                          </li>
                          <li>
                            <a href="#" class="relative inline-flex items-center rounded-full px-2.5 py-1 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                              <div class="absolute flex shrink-0 items-center justify-center">
                                <span class="size-1.5 rounded-full bg-indigo-500" aria-hidden="true"></span>
                              </div>
                              <div class="ml-3 text-xs font-semibold text-gray-900">Accessibility</div>
                            </a>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </aside>
                  <div class="py-3 xl:pb-0 xl:pt-6">
                    <h2 class="sr-only">Description</h2>
                    <div class="text-base/7 text-gray-700">
                        <p>{{$record->purpose}}</p>
                      <ul role="list" class="mt-5 list-disc space-y-2 pl-6 marker:text-gray-300">
                        Items
                        @forelse ($record->items as  $item)
                        <li class="pl-3">{{$item->equipment->name}} - {{$item->equipment->status}} </li>
                        
                            
                        @empty
                            No Item    
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
                          <li>
                            <div class="relative pb-8">
                              <span class="absolute left-5 top-5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                              <div class="relative flex items-start space-x-3">
                                <div class="relative">
                                  <img class="flex size-10 items-center justify-center rounded-full bg-gray-400 ring-8 ring-white" src="https://images.unsplash.com/photo-1520785643438-5bf77931f493?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80" alt="">
  
                                  <span class="absolute -bottom-0.5 -right-1 rounded-tl bg-white px-0.5 py-px">
                                    <svg class="size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                      <path fill-rule="evenodd" d="M10 2c-2.236 0-4.43.18-6.57.524C1.993 2.755 1 4.014 1 5.426v5.148c0 1.413.993 2.67 2.43 2.902.848.137 1.705.248 2.57.331v3.443a.75.75 0 0 0 1.28.53l3.58-3.579a.78.78 0 0 1 .527-.224 41.202 41.202 0 0 0 5.183-.5c1.437-.232 2.43-1.49 2.43-2.903V5.426c0-1.413-.993-2.67-2.43-2.902A41.289 41.289 0 0 0 10 2Zm0 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM8 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm5 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                                    </svg>
                                  </span>
                                </div>
                                <div class="min-w-0 flex-1">
                                  <div>
                                    <div class="text-sm">
                                      <a href="#" class="font-medium text-gray-900">Eduardo Benz</a>
                                    </div>
                                    <p class="mt-0.5 text-sm text-gray-500">Commented 6d ago</p>
                                  </div>
                                  <div class="mt-2 text-sm text-gray-700">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Tincidunt nunc ipsum tempor purus vitae id. Morbi in vestibulum nec varius. Et diam cursus quis sed purus nam.</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="relative pb-8">
                              <span class="absolute left-5 top-5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                              <div class="relative flex items-start space-x-3">
                                <div>
                                  <div class="relative px-1">
                                    <div class="flex size-8 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white">
                                      <svg class="size-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0Zm-5.5-2.5a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0ZM10 12a5.99 5.99 0 0 0-4.793 2.39A6.483 6.483 0 0 0 10 16.5a6.483 6.483 0 0 0 4.793-2.11A5.99 5.99 0 0 0 10 12Z" clip-rule="evenodd" />
                                      </svg>
                                    </div>
                                  </div>
                                </div>
                                <div class="min-w-0 flex-1 py-1.5">
                                  <div class="text-sm text-gray-500">
                                    <a href="#" class="font-medium text-gray-900">Hilary Mahy</a>
                                    assigned
                                    <a href="#" class="font-medium text-gray-900">Kristin Watson</a>
                                    <span class="whitespace-nowrap">2d ago</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="relative pb-8">
                              <span class="absolute left-5 top-5 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                              <div class="relative flex items-start space-x-3">
                                <div>
                                  <div class="relative px-1">
                                    <div class="flex size-8 items-center justify-center rounded-full bg-gray-100 ring-8 ring-white">
                                      <svg class="size-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                        <path fill-rule="evenodd" d="M4.5 2A2.5 2.5 0 0 0 2 4.5v3.879a2.5 2.5 0 0 0 .732 1.767l7.5 7.5a2.5 2.5 0 0 0 3.536 0l3.878-3.878a2.5 2.5 0 0 0 0-3.536l-7.5-7.5A2.5 2.5 0 0 0 8.38 2H4.5ZM5 6a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                                      </svg>
                                    </div>
                                  </div>
                                </div>
                                <div class="min-w-0 flex-1 py-0">
                                  <div class="text-sm/8 text-gray-500">
                                    <span class="mr-0.5">
                                      <a href="#" class="font-medium text-gray-900">Hilary Mahy</a>
                                      added tags
                                    </span>
                                    <span class="mr-0.5">
                                      <a href="#" class="relative inline-flex items-center rounded-full px-2.5 py-1 text-xs ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                        <span class="absolute flex shrink-0 items-center justify-center">
                                          <span class="size-1.5 rounded-full bg-rose-500" aria-hidden="true"></span>
                                        </span>
                                        <span class="ml-3 font-semibold text-gray-900">Bug</span>
                                      </a>
                                      <a href="#" class="relative inline-flex items-center rounded-full px-2.5 py-1 text-xs ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                        <span class="absolute flex shrink-0 items-center justify-center">
                                          <span class="size-1.5 rounded-full bg-indigo-500" aria-hidden="true"></span>
                                        </span>
                                        <span class="ml-3 font-semibold text-gray-900">Accessibility</span>
                                      </a>
                                    </span>
                                    <span class="whitespace-nowrap">6h ago</span>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                          <li>
                            <div class="relative pb-8">
                              <div class="relative flex items-start space-x-3">
                                <div class="relative">
                                  <img class="flex size-10 items-center justify-center rounded-full bg-gray-400 ring-8 ring-white" src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80" alt="">
  
                                  <span class="absolute -bottom-0.5 -right-1 rounded-tl bg-white px-0.5 py-px">
                                    <svg class="size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                      <path fill-rule="evenodd" d="M10 2c-2.236 0-4.43.18-6.57.524C1.993 2.755 1 4.014 1 5.426v5.148c0 1.413.993 2.67 2.43 2.902.848.137 1.705.248 2.57.331v3.443a.75.75 0 0 0 1.28.53l3.58-3.579a.78.78 0 0 1 .527-.224 41.202 41.202 0 0 0 5.183-.5c1.437-.232 2.43-1.49 2.43-2.903V5.426c0-1.413-.993-2.67-2.43-2.902A41.289 41.289 0 0 0 10 2Zm0 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM8 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm5 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                                    </svg>
                                  </span>
                                </div>
                                <div class="min-w-0 flex-1">
                                  <div>
                                    <div class="text-sm">
                                      <a href="#" class="font-medium text-gray-900">Jason Meyers</a>
                                    </div>
                                    <p class="mt-0.5 text-sm text-gray-500">Commented 2h ago</p>
                                  </div>
                                  <div class="mt-2 text-sm text-gray-700">
                                    <p>{{$record->purpose}}</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                      <div class="mt-6">
                        <div class="flex space-x-3">
                          <div class="shrink-0">
                            <div class="relative">
                              <img class="flex size-10 items-center justify-center rounded-full bg-gray-400 ring-8 ring-white" src="https://images.unsplash.com/photo-1517365830460-955ce3ccd263?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80" alt="">
  
                              <span class="absolute -bottom-0.5 -right-1 rounded-tl bg-white px-0.5 py-px">
                                <svg class="size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                  <path fill-rule="evenodd" d="M10 2c-2.236 0-4.43.18-6.57.524C1.993 2.755 1 4.014 1 5.426v5.148c0 1.413.993 2.67 2.43 2.902.848.137 1.705.248 2.57.331v3.443a.75.75 0 0 0 1.28.53l3.58-3.579a.78.78 0 0 1 .527-.224 41.202 41.202 0 0 0 5.183-.5c1.437-.232 2.43-1.49 2.43-2.903V5.426c0-1.413-.993-2.67-2.43-2.902A41.289 41.289 0 0 0 10 2Zm0 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM8 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm5 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                                </svg>
                              </span>
                            </div>
                          </div>
                          <div class="min-w-0 flex-1">
                            <form action="#">
                              <textarea rows="3" name="comment" id="comment" aria-label="sr-only" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" placeholder="Leave a comment"></textarea>
                              <div class="mt-6 flex items-center justify-end space-x-4">
                                <button type="button" class="inline-flex justify-center gap-x-1.5 rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                                  <svg class="-ml-0.5 size-5 text-green-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                                  </svg>
                                  Close issue
                                </button>
                                <button type="submit" class="inline-flex items-center justify-center rounded-md bg-gray-900 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-gray-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-900">Comment</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            </div>
            <aside class="hidden xl:block xl:pl-8">
              <h2 class="sr-only">Details</h2>
              <div class="space-y-5">
                <div class="flex items-center space-x-2">
                   
                  {{-- <svg class="size-5 text-green-500" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                    <path fill-rule="evenodd" d="M14.5 1A4.5 4.5 0 0 0 10 5.5V9H3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-6a2 2 0 0 0-2-2h-1.5V5.5a3 3 0 1 1 6 0v2.75a.75.75 0 0 0 1.5 0V5.5A4.5 4.5 0 0 0 14.5 1Z" clip-rule="evenodd" />
                  </svg> --}}
                  <span class="text-sm font-medium text-green-700">{{$record->countAvailableItems()}} Available Items</span>
                </div>
                <div class="flex items-center space-x-2">
                  {{-- <svg class="size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                    <path fill-rule="evenodd" d="M10 2c-2.236 0-4.43.18-6.57.524C1.993 2.755 1 4.014 1 5.426v5.148c0 1.413.993 2.67 2.43 2.902.848.137 1.705.248 2.57.331v3.443a.75.75 0 0 0 1.28.53l3.58-3.579a.78.78 0 0 1 .527-.224 41.202 41.202 0 0 0 5.183-.5c1.437-.232 2.43-1.49 2.43-2.903V5.426c0-1.413-.993-2.67-2.43-2.902A41.289 41.289 0 0 0 10 2Zm0 7a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM8 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0Zm5 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z" clip-rule="evenodd" />
                  </svg> --}}
             
                  <span class="text-sm font-medium text-gray-900">{{$record->countUnavailableItems()}} Not Available Items </span>
                
                </div>
                <div class="flex items-center space-x-2">
                  <svg class="size-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                    <path fill-rule="evenodd" d="M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4H5V2.75A.75.75 0 0 1 5.75 2Zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75Z" clip-rule="evenodd" />
                  </svg>
                  <span class="text-sm font-medium text-gray-900">Created on <time datetime="{{$record->getFormattedActualReturnDateAttribute()}}">{{$record->getFormattedActualReturnDateAttribute()}}</time></span>
                </div>
              </div>
              <div class="mt-6 space-y-8 border-t border-gray-200 py-6">
                <div>
                  <h2 class="text-sm font-medium text-gray-500">Assignees</h2>
                  <ul role="list" class="mt-3 space-y-3">
                    <li class="flex justify-start">
                      <a href="#" class="flex items-center space-x-3">
                        <div class="shrink-0">
                          <img class="size-5 rounded-full" src="https://images.unsplash.com/photo-1520785643438-5bf77931f493?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=256&h=256&q=80" alt="">
                        </div>
                        <div class="text-sm font-medium text-gray-900">Eduardo Benz</div>
                      </a>
                    </li>
                  </ul>
                </div>
                <div>
                  <h2 class="text-sm font-medium text-gray-500">Tags</h2>
                  <ul role="list" class="mt-2 flex flex-wrap gap-1">
                    <li>
                      <a href="#" class="relative inline-flex items-center rounded-full px-2.5 py-1 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        <div class="absolute flex shrink-0 items-center justify-center">
                          <span class="size-1.5 rounded-full bg-rose-500" aria-hidden="true"></span>
                        </div>
                        <div class="ml-3 text-xs font-semibold text-gray-900">Bug</div>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="relative inline-flex items-center rounded-full px-2.5 py-1 ring-1 ring-inset ring-gray-300 hover:bg-gray-50">
                        <div class="absolute flex shrink-0 items-center justify-center">
                          <span class="size-1.5 rounded-full bg-indigo-500" aria-hidden="true"></span>
                        </div>
                        <div class="ml-3 text-xs font-semibold text-gray-900">Accessibility</div>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </aside>
          </div>
        </div>
      </main>
</div>
