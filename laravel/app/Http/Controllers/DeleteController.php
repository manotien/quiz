<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Quiz;
use App\Question;
use App\Choice;

class DeleteController extends Controller {
	public function topic($id){
		$all=Quiz::find($id);

		$question=$all->questions;
		foreach ($question as $q) {
			foreach ($q->choices as $c) {
				$c->delete();
			}
			$q->delete();
		}
		
		$all->delete();
		return "true";
	}

	public function question($id,$id2){
		$q=Question::find($id2);
			$ch=$q->choices;

			foreach ($ch as $c) {

				$c->delete();
			}
		$q->delete();
		return "true";
	}

	public function choice($id,$id2,$id3){
		$c=Choice::find($id3);
		$c->delete();
		return "true";
	}
}
