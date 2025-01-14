<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobOrder extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;
    use HasFactory;

  
    // Array of All Statuses
    public const STATUS_PENDING = 'Pending';
    public const STATUS_IN_PROGRESS = 'In Progress';
    public const STATUS_COMPLETED = 'Completed';
    public const STATUS_CANCELLED = 'Cancelled';
    public const STATUS_FAILED = 'Failed';

    // Array of All Statuses
    public const STATUSES = [
        self::STATUS_PENDING,
        self::STATUS_IN_PROGRESS,
        self::STATUS_COMPLETED,
        self::STATUS_CANCELLED,
        self::STATUS_FAILED,
    ];

    // Status Transitions
    public const IF_PENDING = [
        self::STATUS_IN_PROGRESS => self::STATUS_IN_PROGRESS,
        self::STATUS_CANCELLED => self::STATUS_CANCELLED,
    ];

    public const IF_IN_PROGRESS = [
        self::STATUS_COMPLETED => self::STATUS_COMPLETED,
        self::STATUS_FAILED => self::STATUS_FAILED,
        self::STATUS_CANCELLED => self::STATUS_CANCELLED,
    ];

    public const IF_COMPLETED = [
        // No further transitions; job is finalized.
    ];

    public const IF_CANCELLED = [
        // No further transitions; job is terminated.
    ];

    public const IF_FAILED = [
        // No further transitions; job has failed.
    ];

    /**
     * Get available status transitions for the current status.
     *
     * @return array
     */
    public function getAvailableStatusTransitions(): array
    {
        // Map the current status to its allowed transitions
        $statusTransitions = [
            self::STATUS_PENDING => self::IF_PENDING,
            self::STATUS_IN_PROGRESS => self::IF_IN_PROGRESS,
            self::STATUS_COMPLETED => self::IF_COMPLETED,
            self::STATUS_CANCELLED => self::IF_CANCELLED,
            self::STATUS_FAILED => self::IF_FAILED,
        ];

        return $statusTransitions[$this->status] ?? [];
    }



    // belong to user
    public function user(){
        return $this->belongsTo(User::class,'requester_id');
    }


    public function assignee()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    // Updated By: The user who last updated the job
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by_id');
    }


    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('file')->singleFile();
        $this->addMediaCollection('files');
    }


    public function scopeMyOrders($query,){
        return $query->where('requester_id', Auth::user()->id);
    }

    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }


}
