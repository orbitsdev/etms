<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserDetails extends Model
{
    use HasFactory;

    public const ADMIN = 'Faculty';
    public const FACULTY = 'Faculty';
    public const STUDENT = 'Student';
    public const JOBORDER = 'Job Order';


    public const TYPE_OPTIONS = [
        self::ADMIN => 'Faculty',
        self::FACULTY => 'Faculty',
        self::STUDENT => 'Student',
        self::JOBORDER => 'Job Order'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function suggestion(){
        $currentYear = date('Y');
        $nextYear = $currentYear + 1;

        return "{$currentYear}-{$nextYear}";
    }
    public function isFaculty()
    {
        return $this->type === UserDetails::FACULTY;
    }
    public function isStudent()
    {
        return $this->type === UserDetails::STUDENT;
    }
    public function isJobOrder()
    {
        return $this->type === UserDetails::JOBORDER;
    }



    public function getFullNameAttribute()
    {
        $firstName = $this->first_name ?? '';
        $lastName = $this->last_name ?? '';

        return $firstName . ' ' . $lastName;
    }

}
