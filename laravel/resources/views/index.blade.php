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
	</style>
</head>
<body>

	<h1 align="center">Topic</h1>
	<div class="quiz">
	<?php  $i=0?>
	@foreach($quiz as $q)
		Topic <?php  $i+=1; echo $i;?>:
	<a href="/index/{{$q->id}}" method="get" >{{$q->name}}</a>
		<br>
	@endforeach
	</div>
</body>
</html>

@stop