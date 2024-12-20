<div class="">

    <x-admin-layout>




        <div class="p-6">
            <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

            <!-- Top Stats Section -->

            @livewire('stats')


            <!-- Visitor Statistics Section -->
            {{-- <div class="bg-white p-6 rounded-lg shadow mb-6">
              <h3 class="text-lg font-semibold mb-4">Visitor Statistics (Nov - July)</h3>
              <div class="relative h-64">
                <!-- Placeholder for the graph -->
                <div class="absolute inset-0 flex items-center justify-center text-gray-400">Graph Placeholder</div>
              </div>
            </div> --}}

            <!-- Two Columns: New Customers and Top Categories -->
            <div class="grid grid-cols-3 gap-6 mb-6">
              <!-- New Customers -->

              {{-- <div class="col-span-1 bg-sksu-500 text-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold">Top Requester ({{ now()->year }})</h3>
                @if ($mostActiveUser)
                    <p class="text-2xl font-bold mt-4">{{ $mostActiveUser->name }}</p>
                    <p class="text-sm mt-2">Completed Requests: <strong>{{ $mostActiveUser->completed_request_count }}</strong></p>
                @else
                    <p class="text-2xl font-bold mt-4">No Data</p>
                    <p class="text-sm mt-2">No completed requests for this year.</p>
                @endif
            </div> --}}
            <div class="bg-gradient-to-r from-sksu-900 to-sksu-600 rounded-lg shadow-lg p-8 col-span-1">
              <h1 class="text-4xl font-bold text-white mb-4">
                  Top Requester {{ now()->year }}
              </h1>
              @if ($mostActiveUser)
                  <div class="flex items-center space-x-4 mb-8">
                      <!-- User Image -->
                      <div class="w-16 h-16">
                          <img 
                              src="{{ $mostActiveUser->getImage() }}" 
                              alt="{{ $mostActiveUser->userDetails->fullName }}" 
                              class="rounded-full border-2 border-white shadow-lg object-cover w-16 h-16">
                      </div>
                      <!-- User Details -->
                      <div>
                          <p class="text-lg text-white font-semibold">
                              {{ $mostActiveUser->userDetails->fullName }}
                          </p>
                      </div>
                  </div>
                  <!-- Completed Request Count -->
                  <a href="#" class="bg-white hover:bg-gray-200 text-sksu-600 font-bold py-2 px-4 rounded">
                      Total Request Completed ({{ $mostActiveUser->completed_request_count }})
                  </a>
              @else
                  <p class="text-lg text-white mb-4">
                      No Data Available
                  </p>
              @endif
          </div>
          
            {{-- <div class="col-span-1 bg-sksu-500 text-white p-6 rounded-lg shadow">
                @if ($mostActiveUser)
                <h3 class="text-lg font-semibold">Top Requester ({{ now()->year }})</h3>
                <p class="text-2xl font-bold mt-4"> {{ $mostActiveUser->userDetails->fullName }}</p>
                <p class="text-sm mt-2">Completed Request {{ $mostActiveUser->completed_request_count }} </p>
                @endif
              </div> --}}

              <!-- Top Categories -->

              
              <div class="col-span-2 bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">Top Requested Equipments</h3>
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

            <!-- Content Table -->
            <div class="bg-white p-6 rounded-lg shadow">
              <h3 class="text-lg font-semibold mb-4">Out of Stocks Equipments</h3>
              <table class="min-w-full table-auto border-collapse border border-gray-200">
                <thead>
                  <tr class="bg-gray-100">
                    <th class="border border-gray-200 px-4 py-2">Thumbnail</th>
                    <th class="border border-gray-200 px-4 py-2">Equipment</th>
                    <th class="border border-gray-200 px-4 py-2">Serial</th>
                    <th class="border border-gray-200 px-4 py-2">Status </th>
                    <th class="border border-gray-200 px-4 py-2">Last Update</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($outOfStockEquipment as $equipment)
                  <tr>
                    <td class="border border-gray-200 px-4 py-2">
                      @if ($equipment->getFirstMediaUrl())
                      <a href="{{ $equipment->getFirstMediaUrl() }}" target="_blank" class="block">
                        <img 
                            src="{{ $equipment->getFirstMediaUrl() }}" 
                            alt="{{ $equipment->name }}" 
                            class="w-12 h-12 rounded">
                    </a>
                    @else
                    <img src="{{asset('images/placeholder-image.jpg')}}" alt="Thumbnail" class="w-12 h-12 rounded">
                    @endif
                    
                    </td>
                    <td class="border border-gray-200 px-4 py-2">{{$equipment->name}}</td>
                    <td class="border border-gray-200 px-4 py-2">{{$equipment->serial_number ?? ''}}</td>
                    <td class="border border-gray-200 px-4 py-2 text-red-500">{{$equipment->status}}</td>
                    <td class="border border-gray-200 px-4 py-2">{{ $equipment->updated_at->format('F j, Y h:i:s A') }}</td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="5" class="text-center text-gray-500 py-4">No equipment found.</td>
                </tr>
                  @endforelse
                 
                </tbody>
              </table>
            </div>
          </div>


    </x-admin-layout>

</div>
