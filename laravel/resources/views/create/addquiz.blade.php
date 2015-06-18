@extends('app')
@section('content')


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
		@if($status=="add")
			<form method="post" action="/create">
			Topic Name: <input type="text" name="quiz">
		@else
			<form method="get" action="/edit/{{$quiz['id']}}">
			Topic Name: <input type="text" name="quiz" value="{{$quiz['name']}}">
		@endif
		<input type="submit" value="Add">
		</form>
</body>
</html>

@stop