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
		.sub{
			margin-left: 10px;
		}
	</style>
</head>
<body>
	<h2 align="center">Topic: {{$quiz['name']}} >>>>>> Question: {{$question['name']}}</h2>
	<div class="question">
	<?php  $i=0?>
	<table>
		
		@foreach($question['choices'] as $c)
		<tr>
			<td>Choice <?php  $i+=1; echo $i;?>:
			{{$c->name}}<td>
			<td><button class="t"><a href="/goedit/{{$quiz['id']}}/{{$question['id']}}/{{$c->id}}" method="get" >Edit</a></button></td>
			<td><button class="t"><a href="/delete/{{$quiz['id']}}/{{$question['id']}}/{{$c->id}}" method="get" onclick="return confirm('Are you sure?');">Delete</a></button></td>
		</tr>
		@endforeach
		
	</table>
	<br>
	</div>
	<button class="sub"><a href="/create/{{$quiz['id']}}/{{$question['id']}}/choice" method="get" >Create Choice</a></button>
	<button ><a href="/create/{{$quiz['id']}}/">Back</a></button>
</body>
</html>

@stop