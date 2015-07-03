<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Quiz;
use App\Question;
use App\Choice;

class EditController extends Controller {

	public function topic(Request $request,$id){
		
		$quiz=Quiz::find($id);
		$quiz->name=$request->name;
		$quiz->picture_id=$request->pic;
		$quiz->save();
		$quiz->picture;

		return $quiz;
	}

	public function question(Request $request,$id,$id2){
		$question=Question::find($id2);
		$question->name=$request->name;
		$question->save();
		return $question;
	}

	public function choice($id,$id2,$id3,Request $request){
	
		$choice=Choice::find($id3);
		$choice->name=$request->name;

		//dd($request);
		if($request->way==1){
			$choice->goto=$request->go;
		}
		else if($request->way==0){

			$question=Question::find($choice->goto);
			if($question==null){
				$question=new Question;
			}
			else{
				//
			}
			$question->quiz_id=$id;
			$question->name=$request->end;
			$question->status="result";

			$question->save();
			$choice->goto=$question->id;
		}
		$choice->save();
		if($choice->goto!=null && $choice->goto!=0){
			$choice->goname=Question::find($choice->goto)->name;
			$choice->gostatus=Question::find($choice->goto)->status;
			$choice->goid=Question::find($choice->goto)->id;
		}
		return $choice;	
	}

	public function getchoice($id){
		$choice=Choice::find($id);
		//dd($choice);
		$question=Question::find($choice->goto);
		if($question!=null){
			if($question->status=='result'){
				$choice->way=0;
				$choice->name=$question->name;
			}
			else if($question->status==""){
				$choice->way=2;
			}
			else{
				$choice->way=1;
				$choice->name=$question->name;
			}
		}
		return $choice;
	}
}