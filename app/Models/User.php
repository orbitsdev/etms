<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Request;
use App\Models\JobOrder;
use App\Models\UserDetails;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Laravel\Jetstream\HasProfilePhoto;
use Illuminate\Support\Facades\Storage;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;



    public const ADMIN = 'Admin';
    public const REQUESTER = 'Requester';
    public const STUDENT = 'Student';
    public const FACULTY = 'Faculty';

    //MAKE USERS OPTIONS FROM CONST


    public static function getRoleOptions(): array
    {
        return [
            self::ADMIN => self::ADMIN,
            // self::REQUESTER => self::REQUESTER,
            self::STUDENT => self::STUDENT,
            self::FACULTY => self::FACULTY,
        ];
    }




    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];


    public function userDetails()
    {
        return $this->hasOne(UserDetails::class,);
    }

    //job orders
    public function jobOrders()
    {
        return $this->hasMany(JobOrder::class, 'requester_id');
    }

    public function requests()
    {
        return $this->hasMany(Request::class);
    }

    public function isAdmin()
    {
        return $this->role === User::ADMIN;
    }
    public function isRequester()
    {
        return $this->role === User::REQUESTER;
    }

    public function scopeIsNotAdmin($query){
        return $query->where('role', '!=', User::ADMIN);
    }

    public function getRedirectRouteBasedOnRole()
    {
        switch ($this->role) {

            case User::ADMIN:
                return redirect()->route('admin.dashboard');

            case 'manager':
            case User::REQUESTER:
                return redirect()->route('requests.index');
            case User::STUDENT:
                return redirect()->route('requests.index');
            case User::FACULTY:
                return redirect()->route('requests.index');
            default:
                return '/';
        }
    }


    public function getImage()
    {
        if (!empty($this->profile_photo_path) && Storage::disk('public')->exists($this->profile_photo_path)) {
            return Storage::disk('public')->url($this->profile_photo_path);
        } else {
            return asset('images/placeholder-image.jpg'); // Return default image URL
        }
    }

    public function routeBaseOnRole()
    {
        switch ($this->role) {
            case User::ADMIN:
                return route('admin.dashboard');
            case User::REQUESTER:
                return route('user.dashboard');
            case User::STUDENT:
                return route('user.dashboard');
            case User::FACULTY:
                return route('user.dashboard');

            default:
                return route('unauthorizepage');
        }
    }

    public function scopeMostCompletedRequests($query)
    {
        return $query->select('users.*', DB::raw('COUNT(requests.id) as completed_request_count'))
            ->join('requests', 'users.id', '=', 'requests.user_id') // Join users with requests
            ->where('requests.status', 'Completed') // Filter for completed requests
            ->whereYear('requests.created_at', now()->year) // Filter by current year
            ->groupBy('users.id') // Group by user
            ->orderByDesc('completed_request_count') // Order by highest completed requests
            ->limit(1); // Only the top user
    }


}
