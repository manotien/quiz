<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model {

	public function quiz(){
		return $this->hasMany('App\Quiz');
	}
}
