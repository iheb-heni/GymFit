<?php

namespace App\Models;

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
        'secondname',
        'email',
        'password',
        'profile_photo',
        'couverture_pic',
        'role',
        'sexe',
        'civility',
        'phone',
        'country',
        'city',
        'attendance_mode',
        'occupation',
        'company_name',
        'sector',
        'activity_description',
        'email_subscription',
        'accepted_terms',
        'isactivated',
        'facebook',
        'twitter',
        'instagram',
        'linkedin',
        'cin'
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
        'email_subscription' => 'boolean',
        'accepted_terms' => 'boolean',
        'isactivated' => 'boolean',
    ];

    /**
     * Define relationships
     */

    // A user can have many posts
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    // A user can have many reclamations
    public function reclamations()
    {
        return $this->hasMany(Reclamation::class);
    }

    // A user can be followed by many users (including coaches)
    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }

    // A user can follow many users (including coaches)
    public function followings()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }

    // A user can enroll in many courses
    public function createdCourses()
    {
        return $this->hasMany(Course::class, 'coach_id');
    }

    /**
     * Role-based methods
     */
    public function hasRole($role)
    {
        return $this->role === $role;
    }

    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isCoach()
    {
        return $this->role === 'coach';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

}
