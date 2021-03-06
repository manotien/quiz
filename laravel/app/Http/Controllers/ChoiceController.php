<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Quiz;
use App\Question;
use App\Choice;
use Illuminate\Http\Request;
use Validator;
class ChoiceController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id,$id2)
	{
		$question=Quiz::find($id)->questions;
		return view('create.addchoice')->with('id',$id)->with('id2',$id2)->with('question',$question)->with('status','add');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($id,$id2,Request $request)
	{
		$choice=new Choice;
		$choice->name=$request->name;
		$choice->question_id=$id2;
		if($request->way==1){
			$v = Validator::make($request->all(), [
	        	'name' => 'required',
		   
		   	]);
			if ($v->fails())
	  	    {
	  	    	$question=Quiz::find($id)->questions;
	  	    	$error = $v->messages()->all();
	  	    	//dd($error);
	    		return view('create.addchoice')->with('id',$id)->with('id2',$id2)->with('question',$question)->with('status','add')->with('error',$error);
	    	}
	    	
			
			$choice->goto=$request->goto;
		}
		else if($request->way==2){
			$v = Validator::make($request->all(), [
	        	'name' => 'required',
		   		'result' =>'required'
		   	]);
			if ($v->fails())
	  	    {
	  	    	$question=Quiz::find($id)->questions;
	  	    	$error = $v->messages()->all();
	  	    	//dd($error);
	    		return view('create.addchoice')->with('id',$id)->with('id2',$id2)->with('question',$question)->with('status','add')->with('error',$error);
	    	}
			$question=new Question;
			$question->name=$request->result;
			$question->status="result";
			$question->quiz_id=$id;
			$question->save();
			$choice->goto=$question->id;
		}
		else{
			$v = Validator::make($request->all(), [
	        	'name' => 'required',
		   
		   	]);
			if ($v->fails())
	  	    {
	  	    	$question=Quiz::find($id)->questions;
	  	    	$error = $v->messages()->all();
	  	    	//dd($error);
	    		return view('create.addchoice')->with('id',$id)->with('id2',$id2)->with('question',$question)->with('status','add')->with('error',$error);
	    	}
		}
		$choice->save();
	
		return redirect('create/'.$id."/");
	}

	public function goedit($id,$id2,$id3){
		$question=Quiz::find($id)->questions;
		$ch=Choice::find($id3);

		$next=Question::find($ch->goto);
		
		if($next==null)
			$way=2;
		else{
			if($next->status=="result" )
				$way=0;
			else
				$way=1;
		}

		return view('create.addchoice')->with('id3',$id3)->with('go',$way)->with('id',$id)->with('id2',$id2)->with('status','edit')->with('choice',$ch)->with('question',$question);
	}

	public function edit($id,$id2,$id3,Request $request){
		// dd($request);
		$choice=Choice::find($id3);
		$choice->name=$request->name;

	
		if($request->way==1){
			$choice->goto=$request->goto;
		}
		else{

			$question=Question::find($choice->goto);
			if($question->status=="result"){
				//
			}
			else{
				$question=new Question;
			}
			$question->quiz_id=$id;
			$question->name=$request->result;
			$question->status="result";

			$question->save();
			$choice->goto=$question->id;
		}
		$choice->save();
	
		return redirect('create/'.$id."/");
	}

	public function delete($id,$id2,$id3){
		$c=Choice::find($id3);
	
		$c->delete();
		
		return redirect('create/'.$id."/");
	}

}
