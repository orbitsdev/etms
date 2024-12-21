<?php

namespace App\Models;

use App\Models\Item;
use App\Models\History;
use App\Models\Request;
use App\Models\StockLogs;
use App\Models\MaintenanceLog;
use Illuminate\Support\Carbon;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
    public const UNDER_MAINTENANCE = 'Under Maintenance';
    public const ARCHIVED = 'Archived';


    public const STATUS_OPTIONS = [
        self::AVAILABLE => self::AVAILABLE,
        self::UNDER_MAINTENANCE => self::UNDER_MAINTENANCE,
        self::RESERVED => self::RESERVED,
        self::NOTAVAILABLE => self::NOTAVAILABLE,
        self::OUTOFSTOCK => self::OUTOFSTOCK,
        self::ARCHIVED => self::ARCHIVED,

    ];public function stocksLogs()
    {
        return $this->hasMany(StockLogs::class)->latest('created_at');
    }

    public function maintenanceLogs()
    {
        return $this->hasMany(MaintenanceLog::class)->latest('created_at');
    }

    public function history()
    {
        return $this->hasMany(History::class)->latest('created_at');
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
            'stocksLogs',
            'maintenanceLogs',
            'history',
            'media',
        ]);
    }


public function getImage()
    {
        if ($this->hasMedia()) {
            return $this->getFirstMediaUrl();
        }

        return url('images/placeholder-image.jpg');


    }


public function scopeAvailable($query){
    return $query->where('status', Equipment::AVAILABLE);
}
public function scopeReserved($query){
    return $query->where('status', Equipment::RESERVED);
}
public function scopeNotAvailable($query){
    return $query->where('status', Equipment::NOTAVAILABLE);
}
public function scopeOutOfStocks($query){
    return $query->where('status', Equipment::OUTOFSTOCK);
}
public function scopeUnderMaintenance($query){
    return $query->where('status', Equipment::UNDER_MAINTENANCE);
}
public function scopeArchived($query){
    return $query->where('status', Equipment::ARCHIVED);
}
public function getFormattedReportedDateAttribute(): ?string
{
    return $this->reported_date
        ? Carbon::parse($this->reported_date)->format('F j, Y, g:i A')
        : null;
}



public function scopePopular($query, $limit = 10)
{
    return $query->select('equipment.id', 'equipment.name', DB::raw('COUNT(items.id) as usage_count'))
        ->join('items', 'equipment.id', '=', 'items.equipment_id')
        ->join('requests', 'items.request_id', '=', 'requests.id')
        ->where('requests.status', Request::COMPLETED)
        ->groupBy('equipment.id', 'equipment.name')
        ->orderByDesc('usage_count')
        ->limit($limit); // Limit results to the top N
}


public function scopeOutOfStock($query)
{
    return $query->where('stock', '<=', 0)->latest(); // Out of stock means stock is 0 or less
}

}
