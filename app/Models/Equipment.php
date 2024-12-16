<?php

namespace App\Models;

use App\Models\Item;
use App\Models\History;
use App\Models\Request;
use App\Models\StockLogs;
use App\Models\MaintenanceLog;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipment extends Model
{
    use HasFactory;

    public function items(){
        return $this->hasMany(Item::class);
    }
    public function stocksLogs(){
        return $this->hasMany(StockLogs::class);
    }
    public function maintenanceLogs(){
        return $this->hasMany(MaintenanceLog::class);
    }
    public function history(){
        return $this->hasMany(History::class);
    }
}
