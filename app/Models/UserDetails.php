<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDetails extends Model
{
    use HasFactory;

    public const FACULTY = 'Faculty';
    public const STUDENT = 'Student';


    public const TYPE_OPTIONS = [
        self::FACULTY => 'Faculty',
        self::STUDENT => 'Student'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function suggestion(){
        $currentYear = date('Y');
        $nextYear = $currentYear + 1;

        return "{$currentYear}-{$nextYear}";
    }


}
