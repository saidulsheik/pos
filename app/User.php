<?php

namespace App;

use App\Model\Comment;
use App\Model\Company;
use App\Model\Project;
use App\Model\Role;
use App\Model\Task;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

  

    public function comment(){
        return $this->hasMany(Comment::class);
    }

    public function role(){
        return $this->belongsTo(Role::class);
    }
    public function company(){
        return $this->hasMany(Company::class);
    }

    public function tasks(){
        return $this->belongsToMany(Task::class);
    }

    public function projects(){
        return $this->belongsToMany(Project::class);
    }
}
