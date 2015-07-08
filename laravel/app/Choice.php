<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model {
	protected $fillable=['name','goto'];
	//

	public function question(){
		return $this->belongsTo('App\Question','goto');
	}
}
