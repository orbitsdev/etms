<?php

namespace App\Models;

use App\Models\User;
use App\Models\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RequestHistory extends Model
{
    use HasFactory;

    public function request()
    {
        return $this->belongsTo(Request::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
