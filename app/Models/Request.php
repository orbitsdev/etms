<?php

namespace App\Models;

use App\Models\Item;
use App\Models\User;
use App\Models\Equipment;
use App\Models\RequestHistory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Request extends Model
{
    use HasFactory;

    public const PENDING = 'Pending';
    public const APPROVED = 'Approved';
    public const READY_FOR_PICKUP = 'Ready for Pickup';
    public const PICKUP = 'Picked Up';
    public const RETURNED = 'Returned';
    public const CANCELED = 'Cancelled';
    public const COMPLETED = 'Completed';
    public const DUE = 'DUE';


    public const STATUS_OPTIONS = [
        self::PENDING => self::PENDING,
        self::APPROVED => self::APPROVED,
        self::READY_FOR_PICKUP => self::READY_FOR_PICKUP,
        self::PICKUP => self::PICKUP,
        self::RETURNED => self::RETURNED,
        self::CANCELED => self::CANCELED,
        self::COMPLETED => self::COMPLETED,
        self::COMPLETED => self::DUE,
    ];
    public const IF_CANCELED = [
        self::APPROVED => self::APPROVED,
    ];
    public const IF_PENDING = [
        self::APPROVED => self::APPROVED,
        self::READY_FOR_PICKUP => self::READY_FOR_PICKUP,
        self::CANCELED => self::CANCELED,
    ];
    public const IF_APPROVED = [
        self::CANCELED => self::CANCELED,
        self::READY_FOR_PICKUP => self::READY_FOR_PICKUP,
        self::PICKUP => self::PICKUP,

    ];
    public const IF_READY_FOR_PICKUP = [
        self::PICKUP => self::PICKUP,
        self::CANCELED => self::CANCELED,

    ];

    public const IF_PICKUP = [
        self::RETURNED => self::RETURNED,
        // self::COMPLETED => self::COMPLETED,
    ];
    public const IF_RETURNED = [
        self::DUE => self::DUE,
        self::COMPLETED => self::COMPLETED,
    ];
    public const IF_COMPLETED = [
        // self::CANCELED => self::CANCELED,
        // self::COMPLETED => self::COMPLETED,
    ];



    public function getAvailableStatusTransitions(): array
    {
        // Map the current status to its allowed transitions
        $statusTransitions = [
            self::PENDING => self::IF_PENDING,
            self::APPROVED => self::IF_APPROVED,
            self::READY_FOR_PICKUP => self::IF_READY_FOR_PICKUP,
            self::PICKUP => self::IF_PICKUP,
            self::RETURNED => self::IF_RETURNED,
            self::CANCELED => self::IF_CANCELED,
            self::COMPLETED => self::IF_COMPLETED,
        ];


        return $statusTransitions[$this->status] ?? [];
    }



    protected $casts = [
        'user_snapshot' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function admin()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    public function histories()
    {
        return $this->hasMany(RequestHistory::class)->latest('created_at');
    }


    public function scopeWithAllRelations($query)
    {
        return $query->latest()->with([
            'user',
            'admin',
            'items' => function ($query) {
                $query->with(['equipment'])->latest();
            },
            'histories' => function ($query) {
                $query->latest();
            },
            'histories.user'

        ]);
    }
    public function scopeMyRequest($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function getFormattedRequestDateAttribute(): ?string
    {
        return $this->request_date
            ? Carbon::parse($this->request_date)->format('F j, Y, g:i A')
            : null;
    }
    public function getFormattedActualReturnDateAttribute(): ?string
    {
        return $this->actual_return_date
            ? Carbon::parse($this->actual_return_date)->format('F j, Y, g:i A')
            : null;
    }

    public function availableItems()
    {
        return $this->items()->whereHas('equipment', function ($query) {
            $query->where('status', Equipment::AVAILABLE);
        });
    }

    public function unavailableItems()
    {
        return $this->items()->whereHas('equipment', function ($query) {
            $query->where('status', '!=', Equipment::AVAILABLE);
        });
    }

    public function getItemsSummaryAttribute()
    {
        $availableCount = $this->availableItems()->count();
        $unavailableCount = $this->unavailableItems()->count();

        return [
            'available' => $availableCount,
            'unavailable' => $unavailableCount,
        ];
    }
    public function scopeWithItemCounts($query)
    {
        return $query->withCount([
            'items as available_items_count' => function ($query) {
                $query->whereHas('equipment', function ($query) {
                    $query->where('status', Equipment::AVAILABLE);
                });
            },
            'items as unavailable_items_count' => function ($query) {
                $query->whereHas('equipment', function ($query) {
                    $query->where('status', '!=', Equipment::AVAILABLE);
                });
            },
        ]);
    }

    public function countAvailableItems(): int
    {
        // Ensure items and equipment are already loaded
        if (!$this->relationLoaded('items')) {
            $this->load('items.equipment');
        }

        return $this->items->filter(function ($item) {
            return $item->equipment && $item->equipment->status === Equipment::AVAILABLE;
        })->count();
    }

    public function countUnavailableItems(): int
    {
        // Ensure items and equipment are already loaded
        if (!$this->relationLoaded('items')) {
            $this->load('items.equipment');
        }

        return $this->items->filter(function ($item) {
            return $item->equipment && $item->equipment->status !== Equipment::AVAILABLE;
        })->count();
    }

    public function scopePending($query){
        return $query->where('status', Request::PENDING);
    }
    public function scopeApproved($query){
        return $query->where('status', Request::APPROVED);
    }
    public function scopeReadyToPickUp($query){
        return $query->where('status', Request::READY_FOR_PICKUP);
    }
    public function scopePickedUp($query){
        return $query->where('status', Request::PICKUP);
    }
    public function scopeReturned($query){
        return $query->where('status', Request::RETURNED);
    }
    public function scopeCancelled($query){
        return $query->where('status', Request::CANCELED);
    }
    public function scopeCompleted($query){
        return $query->where('status', Request::COMPLETED);
    }
    public function scopeDue($query){
        return $query->where('status', Request::DUE);
    }


}
