<?php

namespace App\Models;

use App\Models\Item;
use App\Models\History;
use App\Models\Request;
use App\Models\StockLogs;
use App\Models\MaintenanceLog;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Equipment extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;



    protected $casts = [

        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public const AVAILABLE = 'Available';
    public const RESERVED = 'Reserved';
    public const NOTAVAILABLE = 'Not Available';
    public const OUTOFSTOCK = 'Out of Stock';
    public const ARCHIVED = 'Archived';


    public const STATUS_OPTIONS = [
        self::AVAILABLE => self::AVAILABLE,
        self::RESERVED => self::RESERVED,
        self::NOTAVAILABLE => self::NOTAVAILABLE,
        self::OUTOFSTOCK => self::OUTOFSTOCK,
        self::ARCHIVED => self::ARCHIVED,

    ];


    public function stocksLogs(){
        return $this->hasMany(StockLogs::class);
    }
    public function maintenanceLogs(){
        return $this->hasMany(MaintenanceLog::class);
    }
    public function history(){
        return $this->hasMany(History::class);
    }
    public function items(){
        return $this->hasMany(Item::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('image')->singleFile();
    }

    protected function createdAttributes(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->created_at
                ? Carbon::parse($this->created_at)
                    ->setTimezone(config('app.timezone'))
                    ->format('F j, Y') // Example: 4:30 PM, January 31, 2023
                : null
        );

    }

    public function scopeWithRelation($query){
        return $query->latest()->with([
            'stocksLogs' => function ($query) {
                $query->latest()->limit(10);
            },
            'maintenanceLogs'=>function($query){
                $query->latest()->limit(20);

            },
            'history'=> function($query){
                $query->latest()->limit(20);
            },
            'media',
        ]);
    }

    public function scopeWithAllRelations($query)
{
    return $query->latest()->with([
        'stocksLogs' => function ($query) {
            $query->latest();
        },
        'maintenanceLogs' => function ($query) {
            $query->latest();
        },
        'history' => function ($query) {
            $query->latest();
        },
        'media',
    ]);
}



}
