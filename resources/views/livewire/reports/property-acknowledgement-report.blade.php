<div>
    <div id="printableDiv" class="p-6 bg-white shadow-md border border-gray-300 mx-auto max-w-3xl">
        <x-sksu-header/>

        <div class="mb-4 text-gray-800">
            <h2 class="text-center text-xl mt-2">Property Acknowledgement Report</h2>
            <p class="text-center">Request No: {{ $request->id }}</p>
        </div>

        <div class="border-b pb-2 border-black text-gray-800 text-xs">
            <div class="flex justify-start font-bold">
                <p class="min-w-28">Requested by:</p>
                <div>{{ $request->user->name }}</div>
            </div>
            <div class="flex justify-start font-bold">
                <p class="min-w-28">Department:</p>
                <div>{{ $request->user->department ?? 'N/A' }}</div>
            </div>
            <div class="flex justify-start font-bold">
                <p class="min-w-28">Date Requested:</p>
                <div>{{ \Carbon\Carbon::parse($request->request_date)->format('F d, Y') }}</div>
            </div>
        </div>

        <div class="mt-4 text-xs text-gray-900">
            <p class="mb-2">This document acknowledges the issuance of the following items to the requester for official use:</p>

            <table class="w-full border border-gray-800 text-xs text-left mt-2">
                <thead class="bg-gray-200 text-gray-900">
                    <tr>
                        <th class="border border-gray-800 px-2 py-1">Item</th>
                        <th class="border border-gray-800 px-2 py-1">Quantity</th>
                        <th class="border border-gray-800 px-2 py-1">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($request->items as $item)
                        <tr>
                            <td class="border border-gray-800 px-2 py-1">{{ $item->name }}</td>
                            <td class="border border-gray-800 px-2 py-1 text-center">{{ $item->quantity }}</td>
                            <td class="border border-gray-800 px-2 py-1">{{ $item->remarks ?? '---' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="border px-2 py-1 text-center text-gray-500">No items found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6 text-xs text-gray-800 leading-relaxed">
            <p>I hereby acknowledge the receipt of the above-mentioned items and accept responsibility for their safekeeping and return after use.</p>
        </div>

        <div class="grid grid-cols-2 gap-4 text-xs mt-6">
            <div class="text-center">
                <p class="font-bold mt-6 underline">{{ $request->user->name }}</p>
                <p>Recipient</p>
            </div>

            <div class="text-center">
                <p class="font-bold mt-6 underline">Jesher Palomaria</p>
                <p>Accountant III</p>
            </div>
        </div>
    </div>

    <button onclick="printDiv('printableDiv')" class="mt-4 px-4 py-2 bg-primary-500 text-white rounded">
        Print Document
    </button>

    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;
            window.print();
            document.body.innerHTML = originalContents;
        }
    </script>
</div>
