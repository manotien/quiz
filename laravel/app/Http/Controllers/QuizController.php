<?php namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\NameRequest;
use App\Http\Controllers\Controller;
use App\Quiz;
use App\Question;
use App\Choice;

class QuizController extends Controller {
	public function showfirst($id){
		$quiz=Quiz::find($id);
		$question=$quiz->questions;

		foreach ($question as $q) {
			$qa=$q->choices;	

			foreach ($qa as $c) {
				if($c->goto!=null && $c->goto!=0){
					$c->goname=Question::find($c->goto)->name;
					$c->gostatus=Question::find($c->goto)->status;
					$c->goid=Question::find($c->goto)->id;
				}
			}
		}	

		return $quiz;
	}





	public function index(){
		
		return view('create.addquiz')->with('status','add');	
	}

	public function store(Request $request){

		$v = Validator::make($request->all(), [
	        'name' => 'required'
	   	]);
		if ($v->fails())
  	    {
  	    	$error = $v->messages()->all();
  	    	//dd($error);
    		return view('create.addquiz')->with('status','add')->with('error',$error);
    	}

		$quiz=new Quiz;
		$quiz->name=$request->name;
		$quiz->save();

		return redirect('create');

	}
	public function show($id){
		$quiz=Quiz::find($id);
		$question=$quiz->questions;
		$qc=[];
		$q_id=[];
		foreach ($question as $q) {
			if($q->status=="result")
				$q_id[$q->id]="Result: ".$q->name;
			else
				$q_id[$q->id]="Question: ".$q->name;
			$qc[$q->id]=$q->choices;
		}
		return view('create.question')->with("quiz",$quiz)->with('choice',$qc)->with('q_id',$q_id);
	}
	public function goedit($id){
		$quiz=Quiz::find($id);
		
		return view('create.addquiz')->with('status','edit')->with('quiz',$quiz);
	}
	public function edit($id,Request $request){
		$quiz=Quiz::find($id);
		$v = Validator::make($request->all(), [
	        'name' => 'required'
	   	]);
		if ($v->fails())
  	    {
  	    	$error = $v->messages()->all();
  	    	//dd($error);
    		return view('create.addquiz')->with('status','edit')->with('error',$error)->with('quiz',$quiz);
    	}

		
		$quiz->name=$request->name;
		
		$quiz->save();
		return redirect('create');
	}

	public function delete($id){
		$all=Quiz::find($id);

		$question=$all->questions;
		foreach ($question as $q) {
			foreach ($q->choices as $c) {
				$c->delete();
			}
			$q->delete();
		}
		
		$all->delete();
		
		return redirect('create');
	}
}
