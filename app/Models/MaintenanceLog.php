<?php

namespace App\Models;

use App\Models\User;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaintenanceLog extends Model
{
    use HasFactory;

    public const REPORTED = 'Reported';
    public const UNDER_MAINTENANCE = 'Under Maintenance';
    public const READY_FOR_PICKUP = 'Ready for Pickup';
    public const FIXED = 'Fixed';
    public const UNFIXABLE = 'Unfixable';

    

    public const STATUS_OPTIONS= [
        self::REPORTED => self::REPORTED,
        self::UNDER_MAINTENANCE => self::UNDER_MAINTENANCE,
        self::READY_FOR_PICKUP => self::READY_FOR_PICKUP, 
        self::FIXED => self::FIXED,
        self::UNFIXABLE => self::UNFIXABLE,
   

    ];


    public function equipment(){
        return $this->belongsTo(Equipment::class);
    }

    public function reporter()
{
    return $this->belongsTo(User::class, 'reported_by');
}

}
