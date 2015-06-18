@extends('app')
@section('content')

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		.quiz{
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

	<h1 align="center">Create Topic</h1>
	<div class="quiz">
	<?php  $i=0?>
	<table>
	
	@foreach($quiz as $q)
		<tr>
			<td>Topic <?php  $i+=1; echo $i;?>:<a href="/create/{{$q->id}}" method="get" >{{$q->name}}</a><td>
			<td><button class="t"><a href="/goedit/{{$q->id}}" method="get" >Edit</a></button></td>
			<td><button class="t"><a href="/delete/{{$q->id}}" method="get" onclick="return confirm('Are you sure?');">Delete</a></button></td>
		<tr>

	@endforeach
	
	</table>
	<br>

	
	</div>
	<button class="sub" onclick="location.href='/create/quiz' ">Create New Topic</button>
</body>
</html>

@stop