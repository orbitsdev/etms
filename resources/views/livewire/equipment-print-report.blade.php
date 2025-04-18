<div>

    <x-admin-layout>

    <!-- Filter and Button Section (Hidden in print) -->
    <div class="flex justify-between items-center mb-4 print:hidden p-4 bg-white rounded-lg shadow">
        <div class="flex space-x-4">
            <div>
                <label class="font-semibold">Filter Status:</label>
                <select wire:model.live="status" class="border px-2 py-1 rounded">
                    <option value="all">All</option>
                    @foreach($statuses as $statusOption)
                        <option value="{{ $statusOption }}">{{ $statusOption }}</option>
                    @endforeach
                </select>
                <span class="text-xs text-gray-500 ml-2">Current filter: {{ $status }}</span>
            </div>
            <div>
                <label class="font-semibold">Sort By:</label>
                <select wire:model="sortBy" class="border px-2 py-1 rounded">
                    <option value="name">Name</option>
                    <option value="serial_number">Serial Number</option>
                    <option value="stock">Stock</option>
                    <option value="status">Status</option>
                    <option value="created_at">Date Added</option>
                </select>
            </div>
            <div>
                <label class="font-semibold">Order:</label>
                <select wire:model="sortDirection" class="border px-2 py-1 rounded">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
            </div>
        </div>
        <button onclick="printDiv('printArea')" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
            <i class="fa-solid fa-print mr-2"></i> Print Report
        </button>
    </div>

    <!-- Printable Section -->
    <div id="printArea" class="bg-white p-8">
        <!-- Header with Logo and Title -->
        <div class="flex justify-between items-center mb-6 border-b pb-4">
            <div class="flex items-center">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-16 mr-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">Equipment Inventory Report</h1>
                    <p class="text-sm text-gray-600">Sultan Kudarat State University</p>
                </div>
            </div>
            <div class="text-right">
                <p class="text-sm">Date Generated: <strong>{{ $currentDate }}</strong></p>
                <p class="text-sm">Status Filter: <strong>{{ $status === 'all' ? 'All Equipment' : $status }}</strong></p>
                <p class="text-sm">Total Equipment: <strong>{{ $totalEquipment }}</strong></p>
            </div>
        </div>

        <!-- Equipment Table -->
        <div class="mb-6">
            <h2 class="text-lg font-semibold mb-2">Equipment Inventory List</h2>
            <table class="w-full border-collapse" border="1" cellpadding="8">
                <thead>
                    <tr style="background-color: #333; color: white;">
                        <th class="text-left">ID</th>
                        <th class="text-left">Name</th>
                        <th class="text-left">Serial Number</th>
                        <th class="text-center">Stock</th>
                        <th class="text-left">Status</th>
                        <th class="text-left">Location</th>
                        <th class="text-left">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($equipments as $equipment)
                        <tr class="{{ $loop->even ? 'bg-gray-50' : '' }}">
                            <td>{{ $equipment->id }}</td>
                            <td class="font-medium">{{ $equipment->name }}</td>
                            <td>{{ $equipment->serial_number ?? 'N/A' }}</td>
                            <td class="text-center">{{ $equipment->stock }}</td>
                            <td>{{ $equipment->status }}</td>
                            <td>{{ $equipment->location ?? 'N/A' }}</td>
                            <td>{{ $equipment->description ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No equipment found for this status.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Footer -->
        <div class="mt-8 pt-4 border-t text-sm text-gray-600">
            <div class="flex justify-between">
                <div>
                    <p>Prepared by: ___________________________</p>
                    <p class="mt-1">Position: ___________________________</p>
                </div>
                <div>
                    <p>Verified by: ___________________________</p>
                    <p class="mt-1">Position: ___________________________</p>
                </div>
            </div>
            <p class="mt-6 text-center text-xs">This is a system-generated report from ETMS (Equipment Tracking Management System)</p>
        </div>
    </div>

    <!-- Print Script -->
    <script>
        function printDiv(divName) {
            const printContents = document.getElementById(divName).innerHTML;
            const originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
            location.reload(); // Reload to restore the Livewire functionality
        }
    </script>


    </x-admin-layout>
</div>