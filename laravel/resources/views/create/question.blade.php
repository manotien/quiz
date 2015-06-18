@extends('app')
@section('content')


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		.question{
			margin-left: 20px;
			font-size: 150%;
		}
		button.t{
			font-size: 65%;
			margin-left: 10px;
		}
		button.sub{

			margin-left: 10px;
		}
		button.add{
			margin-left: 10px;
			font-size: 70%;
		}
		tr.ch{
			font-size: 75%;
			
			
		}
	</style>
</head>
<body>
	<h2 align="center">Topic: {{$quiz['name']}}</h2>
	<div class="question">
	<?php  $i=0?>
	<table>
		@foreach($quiz['questions'] as $q)
			
			@if($q->status!="result")
				<tr>
					<td>Question: <a href="/create/{{$quiz['id']}}/{{$q->id}}" method="get" >{{$q->name}}</a></td>
					<td><button class="t"><a href="/goedit/{{$quiz['id']}}/{{$q['id']}}" method="get" >Edit</a></button></td>
					<td><button class="t"><a href="/delete/{{$quiz['id']}}/{{$q['id']}}" method="get" onclick="return confirm('Are you sure?');">Delete</a></button></td>
				</tr>

				@foreach($choice[$q->id] as $c)
					<tr class="ch"> 	

						<td>->choice: {{$c->name}}</td>
						<td><button class="t"><a href="/goedit/{{$quiz['id']}}/{{$q['id']}}/{{$c->id}}" method="get" >Edit</a></button></td>
						<td><button class="t"><a href="/delete/{{$quiz['id']}}/{{$q['id']}}/{{$c->id}}" method="get" onclick="return confirm('Are you sure?');">Delete</a></button></td>
					</tr>
				@endforeach
				<tr class="ch">
					<td><button class="add"><a href="/create/{{$quiz['id']}}/{{$q['id']}}/choice" method="get" >Create Choice</a></button></td>
				</tr>
				<tr><td><br></td></tr>
			@endif
			
		@endforeach
	</table>

	<table >
		@foreach($quiz['questions'] as $q)
			<tr>
				@if($q->status=="result")
					<td>Result: {{$q->name}}</td>
					<td><button class="t"><a href="/goedit/{{$quiz['id']}}/{{$q['id']}}" method="get" >Edit</a></button></td>
				<td><button class="t"><a href="/delete/{{$quiz['id']}}/{{$q['id']}}" method="get" onclick="return confirm('Are you sure?');">Delete</a></button></td>
				@endif
				
			</tr>
		@endforeach
	</table>
	<br>
	</div>
	<button class="sub"><a href="/create/{{$quiz['id']}}/question" method="get" ><?php if(count($quiz['questions'])==0) {echo "Create First Question"; $num=0;} else{ echo "Create Question"; $num=1;} ?></a></button>
	<button ><a href="/create/">Back</a></button>
	<br><br>
</body>
</html>

@stop