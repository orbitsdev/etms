<main>


    <div class="mx-auto w-full px-4  sm:px-6 lg:px-8">
      <div class="mx-auto grid max-w-2xl grid-cols-1 grid-rows-1 items-start gap-x-8 gap-y-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">
        <!-- Invoice summary -->
        <div class="lg:col-start-3 lg:row-end-1">
          <h2 class="sr-only">Equipment</h2>
          <div class="rounded-lg  shadow-sm ring-1 ring-gray-900/5">
            <dl class="flex flex-wrap">
              <div class="flex-auto pl-6 pt-6">
                <dt class="text-sm/6 font-semibold text-gray-900">Equipment</dt>
                <dd class="mt-1 text-base font-semibold text-gray-900">{{$record->name??''}} </dd>
              </div>
              <div class="flex-none self-end px-6 pt-4">
                <dt class="sr-only">Status</dt>
                @php
                    // Map status to Tailwind color classes
                    $statusColors = [
                        'Available' => 'text-green-600 ring-green-600/20',
                        'Reserved' => 'text-yellow-600 ring-yellow-600/20',
                        'Not Available' => 'text-red-600 ring-red-600/20',
                        'Out of Stock' => 'text-gray-600 ring-gray-600/20',
                        'Archived' => 'text-indigo-600 ring-indigo-600/20',
                    ];

                    $status = $record->status ?? 'Available'; // Default to "Available"
                    $colorClass = $statusColors[$status] ?? 'text-gray-600 ring-gray-600/20';
                @endphp

                <dd class="rounded-md px-2 py-1 text-xs font-medium {{ $colorClass }} ring-1 ring-inset">
                    {{ $record->status ?? '' }}
                </dd>
            </div>

              <div class="mt-6 flex w-full flex-none gap-x-4 border-t border-gray-900/5 px-6 pt-6">
                <dt class="flex-none">
                  <span class="sr-only">Client</span>
                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-500">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                  </svg>


                </dt>
                <dd class="text-sm/6 font-medium text-gray-500">{{$record->serial_number??''}}</dd>
              </div>
              <div class="mt-4 flex w-full flex-none gap-x-4 px-6">
                <dt class="flex-none">
                  <span class="sr-only">Due date</span>
                  <svg class="h-6 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                    <path d="M5.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H6a.75.75 0 0 1-.75-.75V12ZM6 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H6ZM7.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H8a.75.75 0 0 1-.75-.75V12ZM8 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H8ZM9.25 10a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V10ZM10 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H10ZM9.25 14a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H10a.75.75 0 0 1-.75-.75V14ZM12 9.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V10a.75.75 0 0 0-.75-.75H12ZM11.25 12a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H12a.75.75 0 0 1-.75-.75V12ZM12 13.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V14a.75.75 0 0 0-.75-.75H12ZM13.25 10a.75.75 0 0 1 .75-.75h.01a.75.75 0 0 1 .75.75v.01a.75.75 0 0 1-.75.75H14a.75.75 0 0 1-.75-.75V10ZM14 11.25a.75.75 0 0 0-.75.75v.01c0 .414.336.75.75.75h.01a.75.75 0 0 0 .75-.75V12a.75.75 0 0 0-.75-.75H14Z" />
                    <path fill-rule="evenodd" d="M5.75 2a.75.75 0 0 1 .75.75V4h7V2.75a.75.75 0 0 1 1.5 0V4h.25A2.75 2.75 0 0 1 18 6.75v8.5A2.75 2.75 0 0 1 15.25 18H4.75A2.75 2.75 0 0 1 2 15.25v-8.5A2.75 2.75 0 0 1 4.75 4H5V2.75A.75.75 0 0 1 5.75 2Zm-1 5.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h10.5c.69 0 1.25-.56 1.25-1.25v-6.5c0-.69-.56-1.25-1.25-1.25H4.75Z" clip-rule="evenodd" />
                  </svg>
                </dt>
                <dd class="text-sm/6 text-gray-500">
                    <time datetime="{{ $record->created_at }}">{{ $record->createdAttributes }}</time>
                </dd>
              </div>
              <div class="mt-4 flex w-full flex-none gap-x-4 px-6">
                <dt class="flex-none">
                  <span class="sr-only">Status</span>
                  <svg class="h-6 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true" data-slot="icon">
                    <path fill-rule="evenodd" d="M2.5 4A1.5 1.5 0 0 0 1 5.5V6h18v-.5A1.5 1.5 0 0 0 17.5 4h-15ZM19 8.5H1v6A1.5 1.5 0 0 0 2.5 16h15a1.5 1.5 0 0 0 1.5-1.5v-6ZM3 13.25a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5h-1.5a.75.75 0 0 1-.75-.75Zm4.75-.75a.75.75 0 0 0 0 1.5h3.5a.75.75 0 0 0 0-1.5h-3.5Z" clip-rule="evenodd" />
                  </svg>
                </dt>
                <dd class="text-sm/6 text-gray-500">Stock </dd>
              </div>
            </dl>
            {{-- <div class="mt-6 border-t border-gray-900/5 px-6 py-6 flex items-center justify-between">
                <a href="{{ route('export.equipment', ['id' => $record->id]) }}" target="_blank"
                    class="text-sm/6 font-semibold text-sksu-700 hover:text-sksu-900 transition-all">
                     Download Details
                 </a>

            </div> --}}
          </div>
        </div>

        <!-- Invoice -->
        <div class="-mx-4 px-4 py-8 shadow-sm ring-1 ring-gray-900/5 sm:mx-0 sm:rounded-lg sm:px-8 sm:pb-14 lg:col-span-2 lg:row-span-2 lg:row-end-2 xl:px-16 xl:pb-20 xl:pt-16">
          <h2 class="text-base font-semibold text-gray-900">History</h2>

          <table class="mt-16 w-full whitespace-nowrap text-left text-sm/6">
            <colgroup>
              <col class="w-full">
              <col>
              <col>
              <col>
            </colgroup>
            <thead class="border-b border-gray-200 text-gray-900">
              <tr>
                <th scope="col" class="px-0 py-3 font-semibold">Descriptions</th>
                <th scope="col" class="hidden py-3 pl-8 pr-0 text-right font-semibold sm:table-cell">Status</th>

              </tr>
            </thead>
            <tbody>
                @forelse ($record->history as  $h)


                <tr class="border-b border-gray-100">
                    <td class="max-w-0 px-0 py-5 align-top">
                        <div class="truncate font-medium text-gray-900"></div>
                        <div class="truncate text-gray-500">{{$h->description}}</div>
                    </td>

                    <td class="hidden py-5 pl-8 pr-0 text-right align-top tabular-nums text-gray-700 sm:table-cell">{{$h->new_status}}</td>
                </tr>
                @empty
                @endforelse

            </tbody>

          </table>
        </div>

        <div class="lg:col-start-3">
            <!-- Activity feed -->
            <h2 class="text-sm/6 font-semibold text-gray-900">Stock Logs</h2>
            <ul role="list" class="mt-6 space-y-6">
                @forelse ($record->stocksLogs as $log)
                    <li class="relative flex gap-x-4">
                        <!-- Timeline Line -->
                        <div class="absolute -bottom-6 left-0 top-0 flex w-6 justify-center last:hidden">
                            <div class="w-px bg-gray-200"></div>
                        </div>

                        <!-- Circle Icon -->
                        <div class="relative flex size-6 flex-none items-center justify-center bg-white">
                            <div class="size-1.5 rounded-full bg-gray-100 ring-1 ring-gray-300"></div>
                        </div>

                        <!-- Log Details -->
                        <div class="flex-auto py-0.5">
                            <p class="text-xs/5 text-gray-500">
                                <span class="font-medium text-gray-900">
                                    {{ $log->updatedBy->name ?? 'System' }}
                                </span>
                                {{ $log->change_type === 'Addition' ? 'added' : 'removed' }}
                                <span class="font-medium">{{ $log->quantity }}</span> unit(s).
                                @if ($log->reason)
                                    <span class="text-gray-600">Reason: {{ $log->reason }}</span>
                                @endif
                            </p>
                        </div>

                        <!-- Timestamp -->
                        <time datetime="{{ $log->created_at }}" class="flex-none py-0.5 text-xs/5 text-gray-500">
                            {{ $log->created_at->diffForHumans() }}
                        </time>
                    </li>
                @empty
                    <li class="text-gray-500 text-sm">No stock logs available.</li>
                @endforelse
            </ul>
        </div>


      </div>
    </div>
  </main>
