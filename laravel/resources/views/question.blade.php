@extends('app')
@section('content')

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style>
		#all {
    		margin-left: 30px;
		} 
		#choice{
			margin-left: 10px;
		}
		p.result{
			margin-left: 20px;
		}
	</style>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script >
		$(document).ready(function(){
			
			$(document).on("click", "#submit" ,function () {

				var next_id=$("#choice:checked").val();
				
				if($("#choice:checked").length!=0){
					//alert("OK");
				}
				else{
					alert("Please Choose");
				}
				$.ajax({
					type:"get",
					url:"http://homestead.app/indexgo",
					data:{
						id:next_id
					},
					success:function(data){
						//alert("test");
						//console.log(data);
						if(data['status']=="next"){
							var radio="";
							for(var i=0;i<data['choices'].length;i++){
								radio+="<input type='radio' id='choice' name='choice' value='"+data['choices'][i]['id']+"'>"+data['choices'][i]['name']+"<br>";
							}
							radio+="<button id='submit'>Submit</button>"
							$("#all").html("<h4>Question: "+data['name']+"</h4>"+radio);
						}
						else{
							$("#all").html("<h4>Result...</h4><p class='result'>"+data['name']+"</p><br><button><a href='/index'>Back</a></button>");
						}
					}
				});
			});

		});
		

	</script>
</head>
<body >
	<h2 align="center">Topic: {{$quiz['name']}}</h2>
	<div id="all">
	<h4>Question: {{$question[0]->name}}</h4>
	
	@foreach($choice as $c)
		<input type="radio" id="choice" name="choice" value="{{$c->id}}">{{$c->name}}<br>
	@endforeach
	<button id="submit">Submit</button>
	</div>

</body>
</html>
@stop