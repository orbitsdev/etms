<div class="grid grid-cols-4 gap-6 mb-6">
    <div class="bg-white p-6 rounded-lg shadow">
      <p class="text-lg font-semibold">Total Approved</p>
      <h2 class="text-3xl font-bold">{{$totalApproved}}</h2>
      <p class="text-sm text-green-500 mt-2">+4.07% This year</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
      <p class="text-lg font-semibold">Total Completed</p>
      <h2 class="text-3xl font-bold">{{$totalCompleted}}</h2>
      <p class="text-sm text-green-500 mt-2">+0.24% This year</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
      <p class="text-lg font-semibold">Total Cancelled</p>
      <h2 class="text-3xl font-bold">{{$totalCancelled}}</h2>
      <p class="text-sm text-red-500 mt-2">-1.64% This year</p>
    </div>
    <div class="bg-white p-6 rounded-lg shadow">
      <p class="text-lg font-semibold">Total Pending</p>
      <h2 class="text-3xl font-bold">{{$totalPending}}</h2>
      <p class="text-sm text-gray-500 mt-2">0.00% This year</p>
    </div>
  </div>
