<div>
    <x-admin-layout>
        <div id="printableDiv" class="p-8 bg-white shadow-md border border-gray-300 mx-auto max-w-3xl text-gray-900 text-sm leading-relaxed">
            <x-sksu-header/>

            <div class="text-center mb-6">
                <h2 class="text-xl font-semibold uppercase">Property Acknowledgement Certificate</h2>
            </div>

            <div class="space-y-2 mb-6">
                <p>
                    This is to certify that the following item(s) were issued to:
                </p>
                <div class="flex">
                    <span class="w-40 font-semibold">Name:</span>
                    <span>{{ $record->user->name }}</span>
                </div>
                <div class="flex">
                    <span class="w-40 font-semibold">Date Issued:</span>
                    <span>{{ \Carbon\Carbon::parse($record->request_date)->format('F d, Y') }}</span>
                </div>
            </div>

            <div class="mt-4">
                <table class="w-full border border-gray-800 mt-4">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="border border-gray-800 px-2 py-1 text-left">Item Description</th>
                            <th class="border border-gray-800 px-2 py-1 text-center">Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($record->items as $item)
                            <tr>
                                <td class="border border-gray-800 px-2 py-1">{{ $item->equipment->name }}</td>
                                <td class="border border-gray-800 px-2 py-1 text-center">{{ $item->quantity }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="border border-gray-800 px-2 py-1 text-center text-gray-500">No items listed.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                <p>
                    I hereby acknowledge receipt of the above-listed property/ies and accept responsibility for their proper use and safekeeping.
                </p>
            </div>

            <div class="grid grid-cols-2 gap-4 mt-10 text-center">
                <div>
                    <p class="font-semibold underline mt-6">{{ $record->user->name }}</p>
                    <p>Recipient</p>
                </div>
                <div>
                    <p class="font-semibold underline mt-6">&nbsp;</p>
                    <p>Authorized Personnel</p>
                </div>
            </div>
        </div>

        <script>
            function printDiv(divName) {
                var printContents = document.getElementById(divName).innerHTML;
                var originalContents = document.body.innerHTML;
                document.body.innerHTML = printContents;
                window.print();
                document.body.innerHTML = originalContents;
            }
        </script>
    </x-admin-layout>
</div>
