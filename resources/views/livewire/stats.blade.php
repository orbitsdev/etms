<div class="grid grid-cols-4 gap-6 mb-6" wire:poll.visible.5s>
  <!-- Total Approved -->
  <div class="bg-white p-6 rounded-lg shadow stat-card hover:scale-105 transition-transform duration-300">
      <p class="text-lg font-normal text-gray-700">Total Approved</p>
      <h2 class="text-3xl font-bold text-gray-600">{{ $totalApproved }}</h2>
      @if ($totalApproved > 0)
          <a href="{{ route('requests.export', ['status' => 'Approved']) }}" target="_blank" class="text-sm text-sksu-500 mt-2 underline hover:text-sksu-700">
              Download
          </a>
      @endif
  </div>

  <!-- Total Completed -->
  <div class="bg-white p-6 rounded-lg shadow stat-card hover:scale-105 transition-transform duration-300">
      <p class="text-lg font-normal text-gray-700">Total Completed</p>
      <h2 class="text-3xl font-bold text-gray-600">{{ $totalCompleted }}</h2>
      @if ($totalCompleted > 0)
          <a href="{{ route('requests.export', ['status' => 'Completed']) }}" target="_blank" class="text-sm text-blue-500 mt-2 underline hover:text-blue-700">
              Download
          </a>
      @endif
  </div>

  <!-- Total Cancelled -->
  <div class="bg-white p-6 rounded-lg shadow stat-card hover:scale-105 transition-transform duration-300">
      <p class="text-lg font-normal text-gray-700">Total Cancelled</p>
      <h2 class="text-3xl font-bold text-gray-600">{{ $totalCancelled }}</h2>
      @if ($totalCancelled > 0)
          <a href="{{ route('requests.export', ['status' => 'Cancelled']) }}" target="_blank" class="text-sm text-red-500 mt-2 underline hover:text-red-700">
              Download
          </a>
      @endif
  </div>

  <!-- Total Pending -->
  <div class="bg-white p-6 rounded-lg shadow stat-card hover:scale-105 transition-transform duration-300">
      <p class="text-lg font-normal text-gray-700">Total Pending</p>
      <h2 class="text-3xl font-bold text-gray-600">{{ $totalPending }}</h2>
      @if ($totalPending > 0)
          <a href="{{ route('requests.export', ['status' => 'Pending']) }}" target="_blank" class="text-sm text-yellow-500 mt-2 underline hover:text-yellow-700">
              Download
          </a>
      @endif
  </div>
</div>
