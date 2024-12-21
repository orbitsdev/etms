<div>

    <x-admin-layout>
        <div class="p-6">
            <h1 class="text-3xl font-bold mb-6">Reports</h1>
        
            <!-- Section: Summary -->
            <div class="grid grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-lg font-semibold">Total Pending Requests</p>
                    <h2 class="text-3xl font-bold">125</h2>
                    <div class="mt-4">
                        <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded mr-2">
                            Download PDF
                        </button>
                        <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                            Download Excel
                        </button>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-lg font-semibold">Total Approved Requests</p>
                    <h2 class="text-3xl font-bold">89</h2>
                    <div class="mt-4">
                        <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded mr-2">
                            Download PDF
                        </button>
                        <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                            Download Excel
                        </button>
                    </div>
                </div>
                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-lg font-semibold">Total Out of Stock Equipment</p>
                    <h2 class="text-3xl font-bold">42</h2>
                    <div class="mt-4">
                        <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded mr-2">
                            Download PDF
                        </button>
                        <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded">
                            Download Excel
                        </button>
                    </div>
                </div>
            </div>
        
            <!-- Section: Detailed Reports -->
            <div class="bg-white p-6 rounded-lg shadow mb-8">
                <h3 class="text-lg font-semibold mb-4">Detailed Reports</h3>
                <ul class="divide-y divide-gray-200">
                    <li class="py-2 flex justify-between items-center">
                        <span>List of Equipment</span>
                        <div>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-3 rounded mr-2">
                                Download PDF
                            </button>
                            <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 rounded">
                                Download Excel
                            </button>
                        </div>
                    </li>
                    <li class="py-2 flex justify-between items-center">
                        <span>List of Requests</span>
                        <div>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-3 rounded mr-2">
                                Download PDF
                            </button>
                            <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 rounded">
                                Download Excel
                            </button>
                        </div>
                    </li>
                    <li class="py-2 flex justify-between items-center">
                        <span>List of Equipment Under Maintenance</span>
                        <div>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-3 rounded mr-2">
                                Download PDF
                            </button>
                            <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-3 rounded">
                                Download Excel
                            </button>
                        </div>
                    </li>
                </ul>
            </div>
        
            <!-- Section: Print Reports -->
            <div class="bg-white p-6 rounded-lg shadow">
                <h3 class="text-lg font-semibold mb-4">Print Reports</h3>
                <ul class="divide-y divide-gray-200">
                    <li class="py-2 flex justify-between items-center">
                        <span>Pending Requests Report</span>
                        <button class="bg-gray-700 hover:bg-gray-800 text-white font-semibold py-1 px-3 rounded">
                            Print
                        </button>
                    </li>
                    <li class="py-2 flex justify-between items-center">
                        <span>Approved Requests Report</span>
                        <button class="bg-gray-700 hover:bg-gray-800 text-white font-semibold py-1 px-3 rounded">
                            Print
                        </button>
                    </li>
                    <li class="py-2 flex justify-between items-center">
                        <span>Out of Stock Equipment Report</span>
                        <button class="bg-gray-700 hover:bg-gray-800 text-white font-semibold py-1 px-3 rounded">
                            Print
                        </button>
                    </li>
                </ul>
            </div>
        </div>
        
    </x-admin-layout>
</div>
