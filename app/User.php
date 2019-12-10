<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    protected $table="user";

    public function tasks(){
        return $this->hasMany(Task::class,'user_id','id');
    }
}
