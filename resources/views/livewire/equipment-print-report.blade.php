<div>
    <x-admin-layout>
        <!-- Filter and Button Section (Hidden in print) -->
        <div class="flex justify-between items-center mb-4 print:hidden">
            <div>
                <label class="font-semibold">Filter Status:</label>
                <select wire:model="status" class="border px-2 py-1 rounded">
                    <option value="all">All</option>
                    <option value="Available">Available</option>
                    <option value="Under Maintenance">Under Maintenance</option>
                    <option value="Decommissioned">Decommissioned</option>
                    <!-- Add more statuses if needed -->
                </select>
            </div>
            <button onclick="printDiv('printArea')" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                Print Report
            </button>
        </div>

        <!-- Printable Section -->
        <div id="printArea">
            <div class="text-center mb-4">
                <h2 class="text-xl font-bold">Equipment Report</h2>
                <p class="text-sm">Date Generated: {{ now()->format('F d, Y h:i A') }}</p>
                <p class="text-sm">Status Filter: <strong>{{ $status === 'all' ? 'All' : $status }}</strong></p>
            </div>

            <table class="w-full border-collapse text-sm" border="1">
                <thead>
                    <tr style="background-color: #106c3b; color: white;">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Serial Number</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Location</th>
                        <th>Issue Description</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($equipments as $equipment)
                        <tr>
                            <td>{{ $equipment->id }}</td>
                            <td>{{ $equipment->name }}</td>
                            <td>{{ $equipment->serial_number }}</td>
                            <td>{{ $equipment->stock }}</td>
                            <td>{{ $equipment->status }}</td>
                            <td>{{ $equipment->location ?? 'N/A' }}</td>
                            <td>
                                @if ($equipment->status === 'Under Maintenance')
                                    {{ $equipment->issue_description ?? 'N/A' }}
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-2">No equipment found for this status.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Print Script -->
        <script>
            function printDiv(divName) {
                const printContents = document.getElementById(divName).innerHTML;
                const originalContents = document.body.innerHTML;

                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
                location.reload(); // Optional reload
            }
        </script>
    </x-admin-layout>
</div>
