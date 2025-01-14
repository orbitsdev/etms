<div class="min-h-screen flex flex-col items-center justify-center relative"
     style="background: url('{{ asset('images/bg.jpg') }}') center/cover no-repeat;">
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-b from-[#2c3e1f] via-[#3e5730] to-[#3e6129] opacity-85"></div>

    <!-- Content with Z-Index for Visibility -->
    <div class="z-10 relative">
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg bg-dots-darker z-10 relative">
        {{ $slot }}
    </div>
</div>
