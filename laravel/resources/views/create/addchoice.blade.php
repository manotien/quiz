@extends('app')
@section('content')
<!DOCTYPE html>
<html>
<head>

	<title></title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script >
	$(document).ready(function(){
		$('input:radio[name="way"]').change(function(){
		    if($(this).val() == 'Yes'){
		       alert("test");
		    }
		});

});
	</script>
	<style >
	#all{
		margin-left: 20px;
	}
	fieldset  {
		    display: block;
    margin-left: 2px;
    margin-right: 2px;
    padding-top: 0.35em;
    padding-bottom: 0.625em;
    padding-left: 0.75em;
    padding-right: 0.75em;
    border: 2px groove (internal value);		
	}
	p#err{
		margin-left: 110px;
		color: red;
	}
	p#e{
		margin-left: 10px;
		color: red;
	}
	
	</style>
	
</head>
@if($status=="edit") 
	<body onload="choose({{$go}})">
@else
	<body >
@endif
	<div id="all">
		@if($status=="add")
			<form method="post" action="/create/{{$id}}/{{$id2}}">
				<div>
				<font size="4">Choice Name: </font><input type="text" name="name" >
				@if(!empty($error) and $error[0]=='The name field is required.')
					<p id="err">*{{$error[0]}}</p>
				@else
					<br>
				@endif
				<br>
				<div>
					<input type="radio" name="way" value="1" onclick="dis_end()">
					<div class="next">
						
							<fieldset id="next">
							<legend>Next Question Or End</legend>					
							<select name="goto">
								<option  value="None">None</option>
								@foreach($question as $q)
									@if($q['status']=='result')
										<option  value="{{$q['id']}}">E: {{$q['name']}}</option>
									@else
										<option  value="{{$q['id']}}">Q: {{$q['name']}}</option>
									@endif
								@endforeach
							</select>
							<br><br>
							</fieldset>
					
					</div>
				</div>
				<br>
				<input type="radio" name="way" value="2" onclick="dis_next()">
			
				<div class="end">
				
					<fieldset id="end">
					<legend>End</legend>
						<textarea rows="10" cols="50" name="result"></textarea>
							@if(!empty($error) and ($error[0]=='The result field is required.' or (count($error)==2 and $error[1]=='The result field is required.')))
								<p id="e">*{{$error[count($error)-1]}}</p>
							@else
								<br>
							@endif
						<br>
					</fieldset>
			
				</div>
				<input type="submit" value="Add" > <button ><a href="/create/{{$id}}/{{$id2}}">Back</a></button>
				</div>
			</form>
		@else
			<form method="post" action="/edit/{{$id}}/{{$id2}}/{{$choice['id']}}">
				<div>
				<font size="4">Choice Name: </font><input type="text" name="name" value="{{$choice['name']}}">
				<br><br>
				<div>
					@if($go==1)
						<input type="radio" name="way" value="1" onclick="dis_end()" checked="checked">
					@else
						<input type="radio" name="way" value="1" onclick="dis_end()" >
					@endif
					<div class="next">
						
							<fieldset id="next">
							<legend>Next Question Or End</legend>					
							<select name="goto">
								<option  value="None">None</option>
								@foreach($question as $q)
									@if($q['id']==$choice['goto'])
										<?php $ending=$q['name'];  ?>
								
									@endif
									@if($q['status']=='result')
										<option  value="{{$q['id']}}" <?php if($go==1 and $choice['goto']==$q['id']) echo "selected='selected'";?>>E: {{$q['name']}}</option>
									@else
										<option  value="{{$q['id']}}" <?php if($go==1 and $choice['goto']==$q['id']) echo "selected='selected'";?>>Q: {{$q['name']}}</option>
									@endif	

								@endforeach
							</select>

							<br><br>
							</fieldset>
					
					</div>
				</div>
				<br>
				@if($go==0)

					<input type="radio" name="way" value="2" onclick="dis_next()" checked="checked">
				@else
					<input type="radio" name="way" value="2" onclick="dis_next()">
				@endif
				
			
				<div class="end">
				
					<fieldset id="end">
					<legend>End</legend>

						<textarea rows="10" cols="50" name="result" >@if($go==0){{$ending}}@endif</textarea>
					<br><br>
					</fieldset>
			
				</div>
				<input type="submit" value="Edit" > <button ><a href="/create/{{$id}}/{{$id2}}">Back</a></button>
				</div>
			</form>
		@endif

		<br>
	</div>

	<script>
		function choose(go){
			if(go==0)
				dis_next();
			else if(go==1)
				dis_end();

		}
		function dis_next(){
		
			$("#next").prop('disabled',true);
			$("#end").prop('disabled',false);
		}
		function dis_end(){
	
			$("#end").prop('disabled',true);
			$("#next").prop('disabled',false);
		}
	</script>
	</div>

</body>
</html>
@stop