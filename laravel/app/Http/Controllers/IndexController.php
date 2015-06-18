<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Quiz;
use App\Question;
use App\Choice;
class IndexController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$quiz=Quiz::all();
	
		return view('index')->with('quiz',$quiz);
	}

	public function store()
	{
		//
	}

	public function showfirst($id)
	{
		$quiz=Quiz::find($id);
		$question=$quiz->questions->where('status','first');
		$choice=Question::find($question[0]->id)->choices;
		//$choice=$question->choices;
		return view('question')->with('question',$question)->with('choice',$choice)->with('quiz',$quiz);
	}

	public function shownext(Request $request){
		$c=Choice::find($request->id);
		$question=Question::find($c->goto);

		$choice=$question->choices;
		//dd([$question,$choice]);
		return $question;

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
