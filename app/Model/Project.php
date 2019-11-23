<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'company_id', 
        'user_id', 
        'days',
    ];

    public function company(){
        //return $this->belongsTo(Company::class);
        return $this->belongsTo(Company::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
