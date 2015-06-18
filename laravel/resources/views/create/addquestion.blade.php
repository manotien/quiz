@extends('app')
@section('content')


<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	@if($status=="add")
		<form method="post" action="/create/{{$id}}">
			Question Name: <input type="text" name="question">
			<input type="submit" value="Add">
	@else
		<form method="get" action="/edit/{{$question['quiz_id']}}/{{$question['id']}}">
			Question Name: <input type="text" name="question" value="{{$question['name']}}">
			<input type="submit" value="Edit">
	@endif
			
		</form>

</body>
</html>

@stop