<?php

namespace App\Models;

use App\Models\Equipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockLogs extends Model
{
    use HasFactory;

    public function equipment(){
        return $this->belongsTo(Equipment::class);
    }
    public function updater(){
        return $this->belongsTo(User::class, 'updated_by');
    }
}
