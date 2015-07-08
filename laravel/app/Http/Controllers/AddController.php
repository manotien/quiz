<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Quiz;
use App\Question;
use App\Choice;

use Auth;

class AddController extends Controller {

	public function addquiz(Request $request)
	{

		$user=Auth::user();
		$quiz=new Quiz;
		$quiz->name=$request->name;
		$quiz->user_id=$user->id;
		$quiz->picture_id=$request->pic;
		$quiz->save();
		$quiz->picture;
		return $quiz;
	}

	public function addquestion(Request $request,$id){
		$question=new Question;
		$quiz=Quiz::find($id)->questions;
		$question->name=$request->name;
		$question->quiz_id=$id;
		if(sizeof($quiz)){
			$question->status="next";
		}
		else{
			$question->status="first";
		}
		$question->save();
		return $question;
	}

	public function addchoice(Request $request,$id,$id2){
		$choice=new Choice;
		$choice->name=$request->name;
		$choice->question_id=$id2;
		
		if($request->way==0){
			$question=new Question;
			$question->name=$request->end;
			$question->status="result";
			$question->quiz_id=$id;
			$question->save();
			$choice->goto=$question->id;
		}
		else if($request->way==1)
		{
			$choice->goto=$request->go;
		}
		else{
			//
		}
		$choice->save();
		if($choice->goto!=0){
			$choice->goname=Question::find($choice->goto)->name;
			$choice->gostatus=Question::find($choice->goto)->status;
			$choice->goid=Question::find($choice->goto)->id;
		}
		return $choice;
	}
}
