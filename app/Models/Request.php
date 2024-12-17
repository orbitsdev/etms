<?php

namespace App\Models;

use App\Models\Item;
use App\Models\User;
use App\Models\Equipment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Request extends Model
{
    use HasFactory;

    
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function items(){
        return $this->hasMany(Item::class);
    }
}

