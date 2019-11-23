<?php

namespace App\Model;
use App\User;
use App\Model\Project;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'name',
        'description',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function projects(){
        return $this->hasMany(Project::class);
       // return $this->hasMany('App\Model\Project');
    }
}
