<div>
  <main class="flex-1">
      <div class="">
          <div class="mx-auto xl:grid xl:max-w-5xl xl:grid-cols-3">
              <!-- Main Content -->
              <div class="xl:col-span-2 xl:border-r xl:border-gray-200 xl:pr-8">
                  <div>
                      <!-- Header Section -->
                      <div class="md:flex md:items-center md:justify-between md:space-x-4 xl:border-b xl:pb-6">
                          <div>
                              <h1 class="text-2xl font-bold text-gray-900">{{ $record->name }}</h1>
                              <p class="mt-2 text-sm text-gray-500">
                                  Status: 
                                  <span class="font-medium {{ match($record->status) {
                                      'Available' => 'text-green-600',
                                      'Reserved' => 'text-yellow-600',
                                      'Not Available' => 'text-red-600',
                                      'Out of Stock' => 'text-gray-600',
                                      'Under Maintenance' => 'text-orange-600',
                                      'Archived' => 'text-blue-600',
                                      default => 'text-gray-500',
                                  } }}">
                                      {{ $record->status }}
                                  </span>
                              </p>
                              <p class="mt-1 text-sm text-gray-500">
                                  Added On: <span class="font-medium text-gray-900">{{ $record->created_at->format('F j, Y') }}</span>
                              </p>
                          </div>
                      </div>
                      @if ($record->getFirstMediaUrl())
                      <div class="py-5 flex flex-col items-center">
                          <a href="{{ $record->getFirstMediaUrl() }}" target="_blank" class="block">
                              <img 
                                  src="{{ $record->getFirstMediaUrl() }}" 
                                  alt="{{ $record->name }}" 
                                  class="rounded-lg border-2 border-gray-200 shadow-lg w-64 h-64 object-cover">
                          </a>
                      </div>
                  @else
                      <div class="py-5 flex flex-col items-center text-gray-500">
                          <p>No image available</p>
                      </div>
                  @endif
                  

                      <!-- Logs Section -->
                      <section aria-labelledby="logs-title" class="mt-8 xl:mt-10">
                        
                          <div class="divide-y divide-gray-200">
                              <!-- Stock Logs -->
                              <div class="py-4">
                                <h3 class="text-md font-semibold text-gray-900">Stocks Activity</h3>
                                <ul role="list" class="mt-4 space-y-2">
                                    @forelse ($record->stocksLogs as $log)
                                        <li class="text-sm text-gray-600">
                                            <p>
                                                @if ($log->change_type === 'Addition')
                                                    <span class="text-green-600 font-semibold">Stock Added</span>: 
                                                @elseif ($log->change_type === 'Removal')
                                                    <span class="text-red-600 font-semibold">Stock Removed</span>: 
                                                @endif
                                                <span class="font-semibold">Old Stock:</span> {{ $log->old_stock ?? 'N/A' }}
                                                →
                                                <span class="font-semibold">New Stock:</span> {{ $log->new_stock ?? 'N/A' }}
                                            </p>
                                            {{-- <p class="text-xs text-gray-500">
                                                Reason: {{ $log->reason ?? 'No reason provided' }}
                                            </p> --}}
                                            <p class="text-xs text-gray-400">
                                                Updated: {{ $log->updated_at->diffForHumans() }} by 
                                                <span class="font-medium">{{ $log->updater->name ?? 'System' }}</span>
                                            </p>
                                        </li>
                                    @empty
                                        <p class="text-sm text-gray-500">No stock logs available.</p>
                                    @endforelse
                                </ul>
                            </div>
                            

                              <!-- Maintenance Logs -->
                              <div class="py-4">
                                <h3 class="text-md font-semibold text-gray-900">Maintenance Logs</h3>
                                <ul role="list" class="mt-4 space-y-2">
                                    @forelse ($record->maintenanceLogs as $log)
                                        <li class="text-sm text-gray-600 flex items-start space-x-4">
                                            <!-- Reporter Image -->
                                            @if ($log->reporter)
                                                <div>
                                                    <img 
                                                        src="{{ $log->reporter->getImage() }}" 
                                                        alt="{{ $log->reporter->name ?? 'User' }}" 
                                                        class="w-5 h-5 rounded-full border border-gray-200">
                                                </div>
                                            @endif
                                            <!-- Log Details -->
                                            <div>
                                                <p><strong>Issue:</strong> {{ $log->issue_description ?? 'No description provided' }}</p>
                                                <p class="text-xs text-gray-500">
                                                   Last Updated: {{ $log->updated_at->format('F j, Y, g:i A') }}
                                                </p>
                                                @if ($log->formattedReportedDate)
                                                    <p class="text-xs text-gray-500">
                                                     Reported On: {{ $log->formattedReportedDate }}
                                                    </p>
                                                @endif
                                                <p class="text-xs text-gray-500 ">
                                                    Reported By: {{ $log->reporter->name ?? 'Unknown User' }}
                                                </p>
                                            </div>
                                        </li>
                                    @empty
                                        <p class="text-sm text-gray-500">No maintenance logs available.</p>
                                    @endforelse
                                </ul>
                            </div>
                            
                            
                            
                            

                              <!-- History -->
                              <div class="py-4">
                                  <h3 class="text-md font-semibold text-gray-900">History</h3>
                                  <ul role="list" class="mt-4 space-y-2">
                                      @forelse ($record->history as $history)
                                          <li class="text-sm text-gray-600">
                                              <p>
                                                  {{ $history->type }} - 
                                                  @if ($history->type === 'Status Change')
                                                      {{ $history->old_status }} → {{ $history->new_status }}
                                                  @elseif ($history->type === 'Stock Change')
                                                      Stock: {{ $history->old_stock }} → {{ $history->new_stock }}
                                                  @endif
                                              </p>
                                              <span class="block text-xs text-gray-500">{{ $history->created_at->diffForHumans() }}</span>
                                          </li>
                                      @empty
                                          <p class="text-sm text-gray-500">No history available.</p>
                                      @endforelse
                                  </ul>
                              </div>
                          </div>
                      </section>

                      <!-- Issue Reporting Section (if status is Under Maintenance) -->
                      @if ($record->status === 'Under Maintenance')
                      <div class="py-4">
                          <h3 class="text-md font-semibold text-gray-900">Issue Details</h3>
                          <ul role="list" class="mt-4 space-y-2">
                              <!-- Issue Description -->
                              <li class="text-sm text-gray-600">
                                  <strong>Issue:</strong> 
                                  <span class="text-gray-900">{{ $record->issue_description ?? 'No issue description provided.' }}</span>
                              </li>
                  
                             
                              {{-- <li class="text-sm text-gray-600">
                                  <strong>Reported By:</strong> 
                                  <span class="text-gray-900">{{ $record->reportedBy->name ?? 'N/A' }}</span>
                              </li>

                              <li class="text-sm text-gray-600">
                                  <strong>Reported On:</strong> 
                                  <span class="text-gray-900">
                                      {{ $record->reported_date ? $record->reported_date->format('F j, Y, g:i A') : 'N/A' }}
                                  </span>
                              </li> --}}
                          </ul>
                      </div>
                  @endif
                  

                  </div>
              </div>

              <!-- Sidebar -->
              <aside class="hidden xl:block xl:pl-8">
                  <h2 class="sr-only">Details</h2>
                  <div class="space-y-5">
                      <!-- Equipment Status -->
                      <div class="flex items-center space-x-2">
                          <svg class="size-5 text-gray-500" viewBox="0 0 20 20" fill="currentColor">
                              <path d="M10 2a8 8 0 1 0 0 16 8 8 0 0 0 0-16Zm1 4H9v5h2V6Zm0 6H9v2h2v-2Z" />
                          </svg>
                          <span class="text-sm text-gray-700">Status: <span class="font-semibold">{{ $record->status }}</span></span>
                      </div>

                      <!-- Total Items Associated -->
                      <div class="flex items-center space-x-2">
                          <svg class="size-5 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                              <path d="M10 2C5.58 2 2 5.58 2 10s3.58 8 8 8 8-3.58 8-8-3.58-8-8-8ZM8 9h4v2H8V9Zm0 4h4v2H8v-2ZM8 5h4v2H8V5Z" />
                          </svg>
                          <span class="text-sm text-blue-700">{{ $record->items->count() }} Items Associated</span>
                      </div>
                  </div>
              </aside>
          </div>
      </div>
  </main>
</div>
