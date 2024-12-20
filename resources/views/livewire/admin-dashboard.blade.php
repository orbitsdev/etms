<div class="">

    <x-admin-layout>




        <div class="p-6">
            <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

            <!-- Top Stats Section -->

            @livewire('stats')


            <!-- Visitor Statistics Section -->
            <div class="bg-white p-6 rounded-lg shadow mb-6">
              <h3 class="text-lg font-semibold mb-4">Visitor Statistics (Nov - July)</h3>
              <div class="relative h-64">
                <!-- Placeholder for the graph -->
                <div class="absolute inset-0 flex items-center justify-center text-gray-400">Graph Placeholder</div>
              </div>
            </div>

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
            <div class="col-span-1 bg-sksu-500 text-white p-6 rounded-lg shadow">
                @if ($mostActiveUser)
                <h3 class="text-lg font-semibold">Top Requester ({{ now()->year }})</h3>
                <p class="text-2xl font-bold mt-4"> {{ $mostActiveUser->userDetails->fullName }}</p>
                <p class="text-sm mt-2">Completed Request {{ $mostActiveUser->completed_request_count }} </p>
                @endif
              </div>

              <!-- Top Categories -->
              <div class="col-span-2 bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">Top Categories</h3>
                <ul class="divide-y divide-gray-200">
                  <li class="py-2 flex justify-between">
                    <span>Lifestyle</span>
                    <span>8.2k Posts</span>
                  </li>
                  <li class="py-2 flex justify-between">
                    <span>Tutorials</span>
                    <span>8.2k Posts</span>
                  </li>
                  <li class="py-2 flex justify-between">
                    <span>Technology</span>
                    <span>8.2k Posts</span>
                  </li>
                  <li class="py-2 flex justify-between">
                    <span>UX Design</span>
                    <span>8.2k Posts</span>
                  </li>
                </ul>
              </div>
            </div>

            <!-- Content Table -->
            <div class="bg-white p-6 rounded-lg shadow">
              <h3 class="text-lg font-semibold mb-4">Recent Articles</h3>
              <table class="min-w-full table-auto border-collapse border border-gray-200">
                <thead>
                  <tr class="bg-gray-100">
                    <th class="border border-gray-200 px-4 py-2">Thumbnail</th>
                    <th class="border border-gray-200 px-4 py-2">Title</th>
                    <th class="border border-gray-200 px-4 py-2">Author</th>
                    <th class="border border-gray-200 px-4 py-2">Status</th>
                    <th class="border border-gray-200 px-4 py-2">Date</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="border border-gray-200 px-4 py-2">
                      <img src="https://via.placeholder.com/50" alt="Thumbnail" class="w-12 h-12 rounded">
                    </td>
                    <td class="border border-gray-200 px-4 py-2">Starting your traveling blog</td>
                    <td class="border border-gray-200 px-4 py-2">Jenny Wilson</td>
                    <td class="border border-gray-200 px-4 py-2 text-yellow-500">Pending</td>
                    <td class="border border-gray-200 px-4 py-2">17.04.2021</td>
                  </tr>
                  <tr>
                    <td class="border border-gray-200 px-4 py-2">
                      <img src="https://via.placeholder.com/50" alt="Thumbnail" class="w-12 h-12 rounded">
                    </td>
                    <td class="border border-gray-200 px-4 py-2">Start a blog to reach your creative peak</td>
                    <td class="border border-gray-200 px-4 py-2">Annette Black</td>
                    <td class="border border-gray-200 px-4 py-2 text-yellow-500">Pending</td>
                    <td class="border border-gray-200 px-4 py-2">23.04.2021</td>
                  </tr>
                  <tr>
                    <td class="border border-gray-200 px-4 py-2">
                      <img src="https://via.placeholder.com/50" alt="Thumbnail" class="w-12 h-12 rounded">
                    </td>
                    <td class="border border-gray-200 px-4 py-2">Helping a local business reinvent itself</td>
                    <td class="border border-gray-200 px-4 py-2">Kathryn Murphy</td>
                    <td class="border border-gray-200 px-4 py-2 text-green-500">Active</td>
                    <td class="border border-gray-200 px-4 py-2">17.04.2021</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>


    </x-admin-layout>

</div>
