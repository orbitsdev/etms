<?php

namespace App\Models;

use App\Models\Item;
use App\Models\User;
use App\Models\Equipment;
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


    public const STATUS_OPTIONS= [
        self::PENDING => self::PENDING,
        self::APPROVED => self::APPROVED,
        self::READY_FOR_PICKUP => self::READY_FOR_PICKUP,
        self::PICKUP => self::PICKUP,
        self::RETURNED => self::RETURNED,
        self::CANCELED => self::CANCELED,
        self::COMPLETED => self::COMPLETED,
    ];
    public const IF_CANCELED = [
        self::APPROVED => self::APPROVED,
    ];
    public const IF_PENDING = [
        self::APPROVED => self::APPROVED,
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
        self::COMPLETED => self::COMPLETED,
    ];
    public const IF_RETURNED = [
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
        self::COMPLETED =>self::IF_COMPLETED,
    ];

    // Return the transitions for the current status or an empty array if the status is invalid
    return $statusTransitions[$this->status] ?? [];
}



    protected $casts = [
        'user_snapshot' => 'array', // Automatically cast JSON to an array
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function admin()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
    public function items(){
        return $this->hasMany(Item::class);
    }
    public function scopeWithAllRelations($query)
    {
        return $query->latest()->with([
            'user',
            'admin',
            'items' => function ($query) {
                $query->latest();
            },

        ]);
    }
    public function scopeMyRequest($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }
}
