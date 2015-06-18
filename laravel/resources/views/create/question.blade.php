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

	</style>
</head>
<body>
	<h2 align="center">Topic: {{$quiz['name']}}</h2>
	<div class="question">
	<?php  $i=0?>
	<table >
		@foreach($quiz['questions'] as $q)
			<tr>
				@if($q->status!="result")
					<td>Question: <a href="/create/{{$quiz['id']}}/{{$q->id}}" method="get" >{{$q->name}}</a></td>
				@else
					<td>Result: {{$q->name}}</td>
				@endif
				<td><button class="t"><a href="/goedit/{{$quiz['id']}}/{{$q['id']}}" method="get" >Edit</a></button></td>
				<td><button class="t"><a href="/delete/{{$quiz['id']}}/{{$q['id']}}" method="get" onclick="return confirm('Are you sure?');">Delete</a></button></td>
			</tr>
		@endforeach
	</table>
	<br>
	</div>
	<button class="sub"><a href="/create/{{$quiz['id']}}/question" method="get" ><?php if(count($quiz['questions'])==0) {echo "Create First Question"; $num=0;} else{ echo "Create Question"; $num=1;} ?></a></button>
	<button ><a href="/create/">Back</a></button>
</body>
</html>

@stop