<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    public function user(){
		return  $this->hasMany(User::class);
	}
}
