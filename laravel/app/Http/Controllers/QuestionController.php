<?php namespace App\Http\Controllers;


use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Quiz;
use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id)
	{
		return view('create.addquestion')->with('id',$id)->with('status','add');	
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('question.create')->with('status','add');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id,Request $request)
	{
		$quiz=Quiz::find($id)->questions;
		$question=new Question;
		
		if(sizeof($quiz)){
			$question->status="next";
		}
		else{
			$question->status="first";
		}
		//dd($question);
		$question->name=$request->question;
		$question->quiz_id=$id;
		$question->save();

		

		return redirect('create/'.$id);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id,$id2)
	{
		$quiz=Quiz::find($id);

		$question=$quiz->questions->find($id2);
		$choice=$question->choices;
		// dd($question);

		return view('create.choice')->with('question',$question)->with('quiz',$quiz);
	}

	public function delete($id,$id2){
		$q=Question::find($id2);
		$ch=$q->choices;

		foreach ($ch as $c) {

			$c->delete();
		}
		
		$q->delete();
		return redirect('create/'.$id);
	}

	public function goedit($id,$id2){

		$question=Question::find($id2);
		return view('create.addquestion')->with('status','edit')->with('question',$question);

	}

	public function edit($id,$id2,Request $request){
		$question=Question::find($id2);
		$question->name=$request->question;
		$question->save();
		return redirect('create/'.$id); 
	}
}
