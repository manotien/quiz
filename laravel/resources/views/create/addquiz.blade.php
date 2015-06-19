@extends('app')
@section('content')


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style >
	p{
		margin-left: 80px;
		color: red;
	}
	</style>
</head>
<body>
		
		
		@if($status=="add")
			<form method="post" action="/create">
			Topic Name: <input type="text" name="name">
			<input type="submit" value="Add"> <button ><a href="/create">Back</a></button>
		@else
			<form method="post" action="/edit/{{$quiz['id']}}">
			Topic Name: <input type="text" name="name" value="{{$quiz['name']}}">
			<input type="submit" value="Edit"> <button ><a href="/create">Back</a></button>
		@endif
		
		</form>
		@if(!empty($error))
			<p>*{{$error[0]}}</p>
		@endif
</body>
</html>

@stop