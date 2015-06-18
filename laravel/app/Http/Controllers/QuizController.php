<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Quiz;
use App\Question;
use App\Choice;
class QuizController extends Controller {
	
	public function index(){
		
		return view('create.addquiz')->with('status','add');	
	}

	public function store(Request $request){
		$quiz=new Quiz;
		$quiz->name=$request->quiz;
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
		$quiz->name=$request->quiz;
		
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
