<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    //
    protected $fillable = [
        'project_id',
        'user_id', 
    ];
}
