<div class="">

    <x-admin-layout>




        <div class="p-6">
            <h1 class="text-3xl font-bold mb-6">Dashboard</h1>



            @livewire('stats')




            <!-- Two Columns: New Customers and Top Categories -->
            <div class="grid grid-cols-3 gap-6 mb-6 stat-card">

            <div class="bg-gradient-to-r from-sksu-900 to-sksu-600 rounded-lg shadow-lg p-8 col-span-1 hover:scale-105 transition-all">
              <h1 class="text-4xl font-bold text-white mb-4">
                  Top Requester {{ now()->year }}
              </h1>
              @if ($mostActiveUser)
                  <div class="flex items-center space-x-4 mb-8 ">
                      <!-- User Image -->
                      <div class="w-16 h-16">
                          <img
                              src="{{ $mostActiveUser->getImage() }}"
                              alt="{{ $mostActiveUser->userDetails->fullName }}"
                              class="rounded-full border-2 border-white shadow-lg object-cover w-16 h-16">
                      </div>
                      <!-- User Details -->
                      <div>
                          <p class="text-base text-white font-semibold">
                              {{ $mostActiveUser->userDetails->fullName }}
                          </p>
                      </div>
                  </div>
                  <!-- Completed Request Count -->
                  <a href="#" class="bg-white hover:bg-gray-200 text-sksu-800  text-base py-2 px-4 rounded">
                      Total Request Completed ({{ $mostActiveUser->completed_request_count }})
                  </a>
              @else
                  <p class="text-base text-white mb-4">
                      No Data Available
                  </p>
              @endif
          </div>



              <div class="col-span-2 bg-white p-6 rounded-lg stat-card shadow   ">
                <div class="flex items-center justify-between">
                  <h3 class="text-base font-normal mb-4">Common Requested Equipments</h3>


                    <span class="text-base">
                        @if($topPopularEquipment->isNotEmpty())
                      <a href="{{ route('export.popular.equipment') }}" target="_blank" class="text-sm text-sksu-500 mt-2 underline hover:text-blue-700 flex items-center justify-center">

                        Download
                    </a>
                      @endif
                    </span>



                </div>
                <ul class="divide-y divide-gray-200">
                  @forelse ($topPopularEquipment as $equipment)

                  <li class="py-2 flex justify-between">
                    <span>{{$equipment->name}}</span>
                    <span>{{$equipment->usage_count }} Usage</span>
                  </li>
                  @empty

                  @endforelse

                </ul>
              </div>
            </div>
            <div class="grid grid-cols-4 gap-6">
            <div class="bg-white p-6 rounded-lg shadow stat-card col-span-2 mb-6 stat-card">
              <div class="sm:flex sm:items-center bg-gradient-to-r from-sksu-50 to-gray-50 rounded-lg p-6 space-y-4 sm:space-y-0">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-bold text-sksu-800">
                        <i class="fa-solid fa-toolbox mr-2"></i> Equipment Summary
                    </h1>
                    <p class="mt-2 text-sm text-sksu-800 max-w-md">
                        Access detailed equipment reports and export status-specific data for analysis.
                    </p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-auto flex items-center space-x-4">
                    <a class="bg-white text-sksu-900 font-medium py-3 px-6 rounded-lg shadow hover:bg-sksu-800 hover:text-white transition-all"
                        href="{{ route('equipment.export', ['status' => 'all']) }}">
                        <i class="fa-regular fa-file-excel mr-2"></i> Export
                    </a>
                    <a class="bg-white text-sksu-900 font-medium py-3 px-6 rounded-lg shadow hover:bg-sksu-800 hover:text-white transition-all"
                        href="{{ route('equipment-requesters.export', ['status' => 'all']) }}">
                        <i class="fa-regular fa-file-excel mr-2"></i> Export Requesters
                    </a>
                    <a class="bg-white text-sksu-900 font-medium py-3 px-6 rounded-lg shadow hover:bg-sksu-800 hover:text-white transition-all"
                        href="{{ route('equipment.print-report') }}" target="_blank">
                        <i class="fa-solid fa-print mr-2"></i> Print
                    </a>
                </div>
            </div>



              <div class="mt-8 flow-root">
                  <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                          <table class="min-w-full">
                              <thead class="bg-white">
                                  <tr>
                                      <th scope="col" class="px-3 py-3.5 text-left text-sm text-gray-900">Status</th>
                                      <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm text-gray-900 sm:pl-3">Total Equipment</th>
                                      <th scope="col" class="px-3 py-3.5 text-left text-sm text-gray-900"></th>
                                  </tr>
                              </thead>
                              <tbody class="bg-white">
                                  @php
                                      $equipmentStatuses = [
                                          'Available' => $availableEquipmentCount,
                                          'Out of Stock' => $outOfStockEquipmentCount,
                                          'Under Maintenance' => $underMaintenanceEquipmentCount,
                                          'Reserved' => $reservedEquipmentCount,
                                          'Not Available' => $notAvailableEquipmentCount,
                                          'Archived' => $archivedEquipmentCount,
                                      ];
                                  @endphp
                                  @foreach ($equipmentStatuses as $status => $count)
                                      <tr class="border-t border-gray-300">
                                          <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-sksu-900 sm:pl-3">{{ $status }}</td>
                                          <td class="whitespace-nowrap px-3 py-4 text-sm text-sksu-700">{{ $count }}</td>
                                          <td class="whitespace-nowrap px-3 py-4 text-sm text-sksu-700">
                                              @if ($count > 0)
                                                  <a href="{{ route('equipment.export', ['status' => $status]) }}"
                                                      class="underline text-sksu-700 hover:text-sksu-900">Download</a>
                                              @endif
                                          </td>
                                      </tr>
                                  @endforeach
                              </tbody>
                          </table>
                      </div>
                  </div>
              </div>
          </div>






            <div class="bg-white p-6 rounded-lg shadow stat-card col-span-2 mb-6 stat-card">

              <div class="sm:flex sm:items-center bg-gradient-to-r from-sksu-50 to-gray-50 rounded-lg p-6 space-y-4 sm:space-y-0">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-bold text-sksu-800">
                        <i class="fa-solid fa-clipboard-list mr-2"></i> Request Summary
                    </h1>
                    <p class="mt-2 text-sm text-sksu-800 max-w-md">
                        Access all your reports with ease. Click below to download or print the latest request status and usage statistics.
                    </p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-auto flex items-center space-x-4">
                    <a class="bg-white text-sksu-900 font-medium py-3 px-6 rounded-lg shadow hover:bg-sksu-800 hover:text-white transition-all"
                        href="{{route('requests.export',['status'=> 'all'])}}">
                        <i class="fa-regular fa-file-excel mr-2"></i> Export
                    </a>
                    <a class="bg-white text-sksu-900 font-medium py-3 px-6 rounded-lg shadow hover:bg-sksu-800 hover:text-white transition-all"
                        href="{{route('equipment-requesters.export',['status'=> 'all'])}}">
                        <i class="fa-regular fa-file-excel mr-2"></i> Export Requesters
                    </a>
                </div>
                  </div>

                <div class="mt-8 flow-root">
                  <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                      <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                          <table class="min-w-full">
                              <thead class="bg-white">
                                  <tr>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm  text-gray-900">
                                      Status
                                  </th>
                                      <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm  text-gray-900 sm:pl-3">
                                          Total Equipments
                                      </th>
                                      <th scope="col" class="px-3 py-3.5 text-left text-sm  text-gray-900">

                                      </th>
                                      {{--
                                      <th scope="col" class="px-3 py-3.5 text-left text-sm  text-gray-900">
                                          Status
                                      </th> --}}
                                  </tr>
                              </thead>
                              <tbody class="bg-white">
                                <tr class="border-t border-gray-300">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-sksu-900 sm:pl-3">Pending</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-sksu-700">{{ $pendingRequestsCount }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-sksu-700">
                                        @if ($pendingRequestsCount > 0)
                                            <a href="{{ route('requests.export', ['status' => 'Pending']) }}" class="underline text-sksu-700 hover:text-sksu-900">Download</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="border-t border-gray-300">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-sksu-900 sm:pl-3">Approved</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-sksu-700">{{ $approvedRequestsCount }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-sksu-700">
                                        @if ($approvedRequestsCount > 0)
                                            <a href="{{ route('requests.export', ['status' => 'Approved']) }}" class="underline text-sksu-700 hover:text-sksu-900">Download</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="border-t border-gray-300">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-sksu-900 sm:pl-3">Ready For Pickup</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-sksu-700">{{ $readyToPickUpRequestsCount }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-sksu-700">
                                        @if ($readyToPickUpRequestsCount > 0)
                                            <a href="{{ route('requests.export', ['status' => 'Ready for Pickup']) }}" class="underline text-sksu-700 hover:text-sksu-900">Download</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="border-t border-gray-300">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-sksu-900 sm:pl-3">Picked Up</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-sksu-700">{{ $pickedUpRequestsCount }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-sksu-700">
                                        @if ($pickedUpRequestsCount > 0)
                                            <a href="{{ route('requests.export', ['status' => 'Picked Up']) }}" class="underline text-sksu-700 hover:text-sksu-900">Download</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="border-t border-gray-300">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-sksu-900 sm:pl-3">Returned</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-sksu-700">{{ $returnedRequestsCount }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-sksu-700">
                                        @if ($returnedRequestsCount > 0)
                                            <a href="{{ route('requests.export', ['status' => 'Returned']) }}" class="underline text-sksu-700 hover:text-sksu-900">Download</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="border-t border-gray-300">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-sksu-900 sm:pl-3">Cancelled</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-sksu-700">{{ $cancelledRequestsCount }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-sksu-700">
                                        @if ($cancelledRequestsCount > 0)
                                            <a href="{{ route('requests.export', ['status' => 'Cancelled']) }}" class="underline text-sksu-700 hover:text-sksu-900">Download</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="border-t border-gray-300">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-sksu-900 sm:pl-3">Due</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-sksu-700">{{ $dueRequestsCount }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-sksu-700">
                                        @if ($dueRequestsCount > 0)
                                            <a href="{{ route('requests.export', ['status' => 'Due']) }}" class="underline text-sksu-700 hover:text-sksu-900">Download</a>
                                        @endif
                                    </td>
                                </tr>
                                <tr class="border-t border-gray-300">
                                    <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-sksu-900 sm:pl-3">Completed</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-sksu-700">{{ $completedRequestsCount }}</td>
                                    <td class="whitespace-nowrap px-3 py-4 text-sm text-sksu-700">
                                        @if ($completedRequestsCount > 0)
                                            <a href="{{ route('requests.export', ['status' => 'Completed']) }}" class="underline text-sksu-700 hover:text-sksu-900">Download</a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>


                          </table>
                      </div>
                  </div>
              </div>


          </div>

          <div class="bg-white p-6 rounded-lg shadow stat-card col-span-4 mb-6 col-span-2">
            <div class="sm:flex sm:items-center bg-gradient-to-r from-sksu-50 to-sksu-50 rounded-lg p-6">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-bold text-sksu-800">
                        <i class="fa-solid fa-wrench mr-2"></i> Job Orders Summary
                    </h1>
                    <p class="mt-2 text-sm text-sksu-800 max-w-md">
                        Access the status and reports of all job orders.
                    </p>
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-auto flex items-center space-x-4">
                    <a class="bg-white text-sksu-900 font-medium py-3 px-6 rounded-lg shadow hover:bg-sksu-800 hover:text-white transition-all" href="{{ route('job-orders.export', ['status' => 'all']) }}">
                        <i class="fa-regular fa-file-excel mr-2"></i> Export
                    </a>
                    <a class="bg-white text-sksu-900 font-medium py-3 px-6 rounded-lg shadow hover:bg-sksu-800 hover:text-white transition-all" href="{{ route('job-order-requesters.export', ['status' => 'all']) }}">
                        <i class="fa-regular fa-file-excel mr-2"></i> Export Requesters
                    </a>
                </div>
            </div>

            <div class="mt-8 flow-root">
                <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                        <table class="min-w-full">
                            <thead class="bg-white">
                                <tr>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm text-gray-900">Status</th>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm text-gray-900 sm:pl-3">Total</th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm text-gray-900"></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white">
                                @php
                                    $jobOrderStatuses = [
                                        'Pending' => $pendingJobOrdersCount,
                                        'Approved' => $approvedJobOrdersCount,
                                        'Completed' => $completedJobOrdersCount,
                                        'Cancelled' => $cancelledJobOrdersCount,
                                        'Failed' => $failedJobOrdersCount,
                                    ];
                                @endphp
                                @foreach ($jobOrderStatuses as $status => $count)
                                    <tr class="border-t border-gray-300">
                                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-sksu-900 sm:pl-3">{{ $status }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-sksu-700">{{ $count }}</td>
                                        <td class="whitespace-nowrap px-3 py-4 text-sm text-sksu-700">
                                            @if ($count > 0)
                                                <a href="{{ route('job-orders.export', ['status' => $status]) }}" class="underline text-sksu-700 hover:text-sksu-900">Download</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </x-admin-layout>

</div>
