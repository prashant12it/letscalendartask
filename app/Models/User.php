<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'mobile',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /* User Roles */
    public const MEMBER  = 0;
    public const ADMIN  = 1;
    public const ATTENDEE  = 2;

    /* User Role Values */
    public const MEMBER_VALUE  = 'Member';
    public const ADMIN_VALUE = 'Admin';
    public const ATTENDEE_VALUE  = 'Attendee';

    /**
     * List of roles.
     *
     * @var array
     */
    public static $roleList = [
        self::MEMBER  => self::MEMBER_VALUE,
        self::ADMIN => self::ADMIN_VALUE,
        self::ATTENDEE => self::ATTENDEE_VALUE
    ];
}
