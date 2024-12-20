<div class="">

    <x-admin-layout>

<!-- Dashboard Wrapper -->
<div class="p-6">
    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

    <!-- Top Stats Section -->
    @livewire('stats')



    <!-- Two Columns: New Customers and Top Categories -->
    <div class="grid grid-cols-3 gap-6 mb-6">
      <!-- New Customers -->


      <!-- Top Categories -->
      <div class="col-span-1 bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-4">Top Equipments</h3>
        <ul class="divide-y divide-gray-200">
            @foreach ($topPopularEquipment as $equipment)
                <li class="py-2 flex justify-between">
                    <span>{{ $equipment->name }}</span>
                    <span>{{ $equipment->usage_count }}</span>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="bg-white p-6 rounded-lg shadow col-span-2">
        <h3 class="text-lg font-semibold mb-4">Out of Stocks</h3>
        <table class="min-w-full table-auto border-collapse border border-gray-200">

            <tr class="bg-gray-100">
              <th class="border border-gray-200 px-4 py-2">Image</th>
              <th class="border border-gray-200 px-4 py-2">Name</th>
              <th class="border border-gray-200 px-4 py-2">Stocks</th>
              <th class="border border-gray-200 px-4 py-2">Stocks</th>
              <th class="border border-gray-200 px-4 py-2">Last Updated</th>
            </tr>

          <tbody>
            @forelse ($outOfStockEquipment as $equipment)
            {{-- <tr>
                <td class="border border-gray-200 px-4 py-2 ">
                  @if ($equipment->getFirstMediaUrl())
                                  <a href="{{ $equipment->getFirstMediaUrl() }}" target="_blank">
                                      <img
                                          src="{{ $equipment->getFirstMediaUrl() }}"
                                          alt="{{ $equipment->name }}"
                                          class="w-16 h-16 rounded-lg object-cover">
                                  </a>
                              @else
                              <img src="https://via.placeholder.com/50" alt="Thumbnail" class="w-12 h-12 rounded">
                              @endif
                </td>
                <td class="border border-gray-200 px-4 py-2">{{$equipment->name}}</td>
                <td class="border border-gray-200 px-4 py-2">{{$equipment->serial_number}}</td>
                <td class="border border-gray-200 px-4 py-2">{{ $equipment->updated_at->format('F j, Y') }}</td>
              </tr> --}}

              <tr>
                <td class="border border-gray-200 px-4 py-2">
                    @if ($equipment->getFirstMediaUrl())
                                  <a href="{{ $equipment->getFirstMediaUrl() }}" target="_blank">
                                      <img
                                          src="{{ $equipment->getFirstMediaUrl() }}"
                                          alt="{{ $equipment->name }}"
                                          class="w-16 h-16 rounded-lg object-cover">
                                  </a>
                              @else
                              <img src="https://via.placeholder.com/50" alt="Thumbnail" class="w-12 h-12 rounded">
                              @endif
                </td>
                <td class="border border-gray-200 px-4 py-2">{{$equipment->name}}</td>
                <td class="border border-gray-200 px-4 py-2">{{$equipment->stock}}</td>
                <td class="border border-gray-200 px-4 py-2 text-yellow-500">{{$equipment->status}}</td>
                <td class="border border-gray-200 px-4 py-2">{{$equipment->updated_at->format('F j, Y') }}</td>
              </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center text-gray-500 py-4">No out-of-stock equipment found.</td>
            </tr>
        @endforelse

          </tbody>
        </table>
      </div>
    </div>

    <!-- Content Table -->


    {{-- <div class="bg-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold mb-4">Out of Stock Equipment</h3>
        <table class="min-w-full table-auto border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-200 px-4 py-2">Thumbnail</th>
                    <th class="border border-gray-200 px-4 py-2">Name</th>
                    <th class="border border-gray-200 px-4 py-2">Stock</th>
                    <th class="border border-gray-200 px-4 py-2">Status</th>
                    <th class="border border-gray-200 px-4 py-2">Last Updated</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($outOfStockEquipment as $equipment)
                    <tr>
                        <td class="border border-gray-200 px-4 py-2 flex justify-center items-center">
                            @if ($equipment->getFirstMediaUrl())
                                <a href="{{ $equipment->getFirstMediaUrl() }}" target="_blank">
                                    <img
                                        src="{{ $equipment->getFirstMediaUrl() }}"
                                        alt="{{ $equipment->name }}"
                                        class="w-16 h-16 rounded-lg object-cover">
                                </a>
                            @else
                                <span class="text-gray-500">No Image</span>
                            @endif
                        </td>
                        <td class="border border-gray-200 px-4 py-2">{{ $equipment->name }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $equipment->stock }}</td>
                        <td class="border border-gray-200 px-4 py-2 text-red-500">Out of Stock</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $equipment->updated_at->format('F j, Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-gray-500 py-4">No out-of-stock equipment found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div> --}}
  </div>

  <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans antialiased">

  <!-- Dashboard Wrapper -->
  <div class="p-6">
    <h1 class="text-3xl font-bold mb-6">Dashboard</h1>

    <!-- Top Stats Section -->
    <div class="grid grid-cols-4 gap-6 mb-6">
      <div class="bg-white p-6 rounded-lg shadow">
        <p class="text-lg font-semibold">Total Visits</p>
        <h2 class="text-3xl font-bold">1,478,286</h2>
        <p class="text-sm text-green-500 mt-2">+4.07% Last month</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow">
        <p class="text-lg font-semibold">Total Visits</p>
        <h2 class="text-3xl font-bold">1,478,286</h2>
        <p class="text-sm text-green-500 mt-2">+0.24% Last month</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow">
        <p class="text-lg font-semibold">Total Visits</p>
        <h2 class="text-3xl font-bold">1,478,286</h2>
        <p class="text-sm text-red-500 mt-2">-1.64% Last month</p>
      </div>
      <div class="bg-white p-6 rounded-lg shadow">
        <p class="text-lg font-semibold">Total Visits</p>
        <h2 class="text-3xl font-bold">1,478,286</h2>
        <p class="text-sm text-gray-500 mt-2">0.00% Last month</p>
      </div>
    </div>

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
      <div class="col-span-1 bg-purple-500 text-white p-6 rounded-lg shadow">
        <h3 class="text-lg font-semibold">New Customers</h3>
        <p class="text-2xl font-bold mt-4">28 Daily Avg.</p>
        <p class="text-sm mt-2">+958 Last month</p>
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

</body>
</html>


    </x-admin-layout>

</div>
