@extends('app')
@section('content')


<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style >
		p{
			margin-left: 100px;
			color: red;
		}
	</style>
</head>
<body>
	@if($status=="add")
		<form method="post" action="/create/{{$id}}">
			Question Name: <input type="text" name="name">
			<input type="submit" value="Add"> <button ><a href="/create/{{$id}}">Back</a></button>
	@else
		<form method="post" action="/edit/{{$question['quiz_id']}}/{{$question['id']}}">
			Question Name: <input type="text" name="name" value="{{$question['name']}}">
			<input type="submit" value="Edit"> <button ><a href="/create/{{$question['quiz_id']}}">Back</a></button>
	@endif
			
		</form>
		@if(!empty($error))
			<p>*{{$error[0]}}</p>
		@endif
</body>
</html>

@stop