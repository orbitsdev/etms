<?php

namespace App\Models;

use App\Models\Request;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;

    public function request(){
        return $this->belongsTo(Request::class);
    }
    public function equipment(){
        return $this->belongsTo(Equipment::class);
    }
}
