<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model {
	protected $fillable =['name','status'];
	//

	public function choices(){
		return $this->hasMany('App\Choice');
	}

	public function quiz(){
		return $this->belongTo('App\Quiz');
	}
}
