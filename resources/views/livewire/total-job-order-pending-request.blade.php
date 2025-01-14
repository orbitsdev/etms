<div class="ml-4 relative  flex items-center justify-center" wire:poll.visible.10s>
    <!-- Icon or Element -->


    <!-- Notification Badge -->
    @if($totalPending > 0)<span class="absolute -top-1 -right-1 bg-sksu-500 text-white text-xs font-bold px-2 py-1 rounded-full">
        {{ $totalPending }}
    </span>
    @endif
</div>
