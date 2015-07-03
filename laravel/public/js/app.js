var app=angular.module('myApp',['ngRoute','ngDialog','ui.bootstrap']);

app.controller('IndexController',function($scope,$http){
	$http.get('/gettopic')
	.success(function(data) {
		$scope.quiz = data;

		
	});
});
app.controller('QuizController',['$scope','$http','$routeParams',function($scope,$http,$routeParems){
	$scope.status = false;

	$scope.clickshow = function(index) {
		$scope.choices[index].status=!$scope.choices[index].status;
		for(var i=0;i<$scope.choices.length;i++){	
			if(i!=index){
				$scope.choices[i].status=false;
			}
		}
	}
	
	$http.get('/getquestion/'+ $routeParems.qzid)
	.success(function(data){

		$scope.quiz=data;
		for(var q in data.questions){
			if(data.questions[q].status=="first"){
				var firstq=data.questions[q];
				var find=true;
				break;
			}
		}
		if(find){
			$scope.question=firstq.name;
			$scope.choices=firstq.choices;
			for(var i=0; i<$scope.choices.length;i++)
			{
				$scope.choices[i].status=false;
			}
			$scope.qstatus="notend";
		}
		$scope.next=function(){
			var check=0;
			for(var i=0;i<$scope.choices.length;i++){	
				if($scope.choices[i].status){
					var gonext = $scope.choices[i].goto;
					check=1;
					break;
				}
			}
			if(check){
				console.log(gonext);
				for(var q in data.questions){
					if(data.questions[q].id==gonext){
						var newq=data.questions[q];
						console.log(newq.status);
						for(var i=0; i<$scope.choices.length;i++)
						{
							$scope.choices[i].status=false;
						}
						if(newq.status!="result"){
							$scope.question=newq.name;
							$scope.choices=newq.choices;
						}
						else{
							$scope.qstatus="end";
							$scope.question=newq.name;
						}
					}
				}
			}
			else{
				alert('Please Choose Answer!!!');
			}

		}
	});
	
}]);
	
app.controller('CreateController',['$scope','$http','ngDialog',function($scope,$http,ngDialog){
	$http.get('/getpic')
	.success(function(data) {
		$scope.pic=data;
	});

	$http.get('/gettopic')
	.success(function(data) {
		$scope.quiz=data;
	});

	$scope.addtopic=function(){

		ngDialog.openConfirm(
			{
				template: 'js/pages/addtopic.html',
				controller: 'AddQuizController',
				cache:false,
				closeByEscape:true,
				scope:$scope,
				closeByDocument:true,
				showClose:false
			}
		);
	}
	$scope.edittopic=function(name,qid,index,purl){
		$scope.topname=name;
		$scope.quiz_id=qid;
		$scope.quiz_index=index;
		$scope.pic_url=purl;
		ngDialog.openConfirm(
			{
				template: 'js/pages/edittopic.html',
				controller: 'AddQuizController',
				cache:false,
				closeByEscape:true,
				scope:$scope,
				closeByDocument:true,
				showClose:false
			}
		);
	}
	$scope.deltopic=function(id,index){
		var del = window.confirm('Are you sure?');
		if(del){
			$http.get('/deltopic/'+id)
			.success(function(data){
				$scope.quiz.splice(index,1);
			})
		}
	}
}]);

app.controller('AddQuizController',['$scope','$http','$routeParams','$location','ngDialog',function($scope,$http,$routeParems,$location,ngDialog){
	$scope.urlPic = "";
	$scope.tmp = [];

	if($scope.pic!=undefined){
		for(var i = 0 ; i < $scope.pic.length ; i++)
		{
			$scope.tmp[$scope.pic[i].id] = {};
			$scope.tmp[$scope.pic[i].id].id = $scope.pic[i].id;
			$scope.tmp[$scope.pic[i].id].url= $scope.pic[i].url;
		}

		$scope.$watch('model', function() {
			if($scope.model != undefined)
			{
				$scope.urlPic = $scope.tmp[parseInt($scope.model)].url;
			}
		})
	}
	$scope.add=function(){
		if($scope.model == null || $scope.topic == undefined)
		{
			alert("Please enter information");
		}
		else
		{
			$scope.click=true;
			$http({
	       		method: 'post',
	       		url: "/addquiz",
	       		data:{ name: $scope.topic,
	       				pic: $scope.model
	       		}
	 		})
	 		.success(function(data) {
	 			$scope.quiz.push(data);
				//window.location.reload();
				ngDialog.close();

			});
		}
		
	}
	$scope.close=function(){
		ngDialog.close();
	}
	$scope.toname=$scope.topname;

	$scope.edit=function(){
		if($scope.toname == undefined)
		{
			alert("Please enter information");
		}
		else{

			if($scope.model==undefined){
				$http({
		       		method: 'post',
		       		url: "/edittopic/"+$scope.quiz_id,
		       		data:{ name:$scope.toname }
		 		})
		 			.success(function(data) {
	 			$scope.quiz[$scope.quiz_index].name=data.name;
	 	
				//window.location.reload();
				ngDialog.close();

			});
			}
			else{
				$http({
		       		method: 'post',
		       		url: "/edittopic/"+$scope.quiz_id,
		       		data:{ name:$scope.toname,pic: $scope.model }
		 		})
		 		.success(function(data) {
	 			$scope.quiz[$scope.quiz_index].name=data.name;
	 			$scope.quiz[$scope.quiz_index].picture=data.picture;
				//window.location.reload();
				ngDialog.close();

			});
			}
	 	
 		}
	}
}]);

app.controller('AddQuestionController',['$scope','$http','$routeParams','$location','ngDialog','$anchorScroll',function($scope,$http,$routeParems,$location,ngDialog,$anchorScroll){
	$http.get('/getquestion/'+ $routeParems.qzid)
	.success(function(data){
		$scope.question=data;
		for(var i=0;i<$scope.question.questions.length;i++){
			$scope.question.questions[i].show=false;
		}
		
	});


  	$scope.dynamicPopover = {
    	content: 'Hello, World!',
    	templateUrl: 'myPopoverTemplate.html',

  	};
  	$scope.showpop=function(name,stat,index){

  		$scope.inpopover = {
	    	name:name,
	    	stat:stat,
	    	index:index
  		}
  	}
    $scope.showpop1=function(name,stat,qn,ch,index,index2,cname){

  		$scope.inpopover = {
	    	name:name,
	    	stat:stat,
	    	qn:qn,
	    	ch:ch,
	    	index:index,
	    	index2:index2,
	    	cname:cname
  		}
  	}

  	$scope.goquestion=function(id){
  		for(var i=0 ;i<$scope.question.questions.length;i++){
  	
  			if(id==$scope.question.questions[i].id){
  				id=i;
  				$scope.question.questions[id].show=true;
  				break;
  			}
  		}



		var old = $location.hash();
		$location.hash(id);
	    $anchorScroll();
	    
	    $location.hash(old);
		

  	}
	var qid=$routeParems.qzid;
	$scope.close=function(){
		ngDialog.close();
	}
	$scope.addques=function(){
		ngDialog.open(
			{
				template: 'js/pages/addquestion.html',
				scope:$scope,
				cache:false,
				controller: ['$scope','$http','ngDialog',function($scope,$http,ngDialog){

					$scope.addq=function(){
						$scope.click=true;
						$http({
				       		method: 'post',
				       		url: "/addquestion/"+qid,
				       		data: {name: $scope.questions}
				 		})
				 		.success(function(data) {
				 			data.choices=[];
							$scope.question.questions.push(data);

							//window.location.reload();
							ngDialog.close();
						});	
					}
				}],
				closeByEscape:true
			}
		);
		
	};
	$scope.delquestion=function(id,index){

		var del = window.confirm('Are you sure?');
		if(del){
			$http.get('/delquestion/'+$routeParems.qzid+"/"+id)
			.success(function(data){

				$scope.question.questions.splice(index,1);
			})
		}
	};

	$scope.editquestion=function(id,index,qname){
		$scope.eq=qname;
		ngDialog.open(
			{
				template: 'js/pages/editquestion.html',
				scope:$scope,
				cache:false,
				controller: ['$scope','$http','ngDialog',function($scope,$http,ngDialog){
					$scope.editq=function(){
						$scope.click=true;
						$http({
				       		method: 'post',
				       		url: "/editquestion/"+qid+"/"+id,
				       		data: {name: $scope.eq}
				 		})
				 		.success(function(data) {
				 			$scope.question.questions[index].name=data.name;

							//window.location.reload();
							ngDialog.close();
						});	
					}
				}],
				closeByEscape:true
			}
		);
	}


	$scope.addchoice=function(qnid,index){
		ngDialog.open(
			{
				template: 'js/pages/addchoice.html',
				cache:false,
				scope:$scope,
				controller: ['$scope','$http','ngDialog',function($scope,$http,ngDialog){
					$http.get('/getquestion/'+qid).success(function(data){ 
						for(var i=0;i<data.questions.length;i++){
							if(data.questions[i].status=='result')
								data.questions[i].status="Result";
							else
								data.questions[i].status="Question";
						}
						$scope.qn=data.questions;
						$scope.addc=function(){
							$scope.click=true;
							var data;
							if($scope.show=='true'){
								data={
									name: $scope.choice,
									go: $scope.ques.id,
									way:1,

								}
							}
							else if($scope.show=="false"){
								data={
									name: $scope.choice,
									way: 0,
									end:$scope.ending
								}
							
							}
							else{
								data={
									name: $scope.choice,
									way: 2,
									
								}
							}
							$http({
					       		method: 'post',
					       		url: "/addchoice/"+qid+"/"+qnid,
					       		data: data
						 	})
					 		.success(function(data) {
 								console.log($scope.question.questions[index]);
					 			$scope.question.questions[index].choices.push(data);

								ngDialog.close();
							});		

						}

					})
					$scope.close=function(){
						ngDialog.close();
					}

				}],
				closeByEscape:true,
				closeByDocument:true,
				showClose:false
			}
		)
		
	}
	$scope.delchoice=function(qz,qn,index,index2){
		
		var del = window.confirm('Are you sure?');
		if(del){
			$http.get('/delchoice/'+$routeParems.qzid+"/"+qz+"/"+qn)
			.success(function(data){
				$scope.question.questions[index].choices.splice(index2,1);
			})
		}
	}

	$scope.editchoice=function(qn,ch,index,index2,cname){
		$scope.cho=cname;
		ngDialog.open(
			{
				template: 'js/pages/editchoice.html',
				cache:false,
				scope:$scope,
				controller: ['$scope','$http','ngDialog',function($scope,$http,ngDialog){
					$http.get('/getquestion/'+qid).success(function(data){ 
						for(var i=0;i<data.questions.length;i++){
							if(data.questions[i].status=='result')
								data.questions[i].status="Result";
							else
								data.questions[i].status="Question";
						}
						$scope.qn=data.questions;
						var dataq=data.questions;
						$http.get('/getchoice/'+ch).success(function(data){
							if(data.way==0){
								$scope.ending=data.name;
								$scope.show='false';
								$scope.c2=true;
							}
							else if(data.way==1){
								$scope.show='true';
								$scope.c1=true;
								for(var i=0;i<dataq.length;i++){
									if(dataq[i].name==data.name){
										$scope.ques=dataq[i];		
								
										break;
									}
								}
								
								//
							}
						})
						
						$scope.editc=function(){
							$scope.click=true;
							var data;
							if($scope.show=='true'){
								data={
									name: $scope.cho,
									go: $scope.ques.id,
									way:1,

								}
							}
							else if($scope.show=="false"){
								data={
									name: $scope.cho,
									way: 0,
									end:$scope.ending
								}
							
							}
							else{
								data={
									name: $scope.cho,
									way: 2,
									
								}
							}
							$http({
					       		method: 'post',
					       		url: "/editchoice/"+qid+"/"+qn+"/"+ch,
					       		data: data
						 	})
					 		.success(function(data) {
					 			//$scope.question.questions[index].choices[index2].name=data.name;
					 			$scope.question.questions[index].choices[index2]=data;
					 			ngDialog.close();
							});		

						}

					})
					$scope.close=function(){
						ngDialog.close();
					}

				}],
				closeByEscape:true,
				closeByDocument:true,
				showClose:false
			}
		)
	}


}]);


app.directive('popoverClose', function($timeout){
  return{
    scope: {
      excludeClass: '@'
    },
    link: function(scope, element, attrs) {
      var trigger = document.getElementsByClassName('trigger');
      
      function closeTrigger(i) {
        $timeout(function(){ 
          angular.element(trigger[0]).triggerHandler('click').removeClass('trigger'); 
        });
      }
      
      element.on('click', function(event){
        var etarget = angular.element(event.target);
        var tlength = trigger.length;
        if(!etarget.hasClass('trigger') && !etarget.hasClass(scope.excludeClass)) {
          for(var i=0; i<tlength; i++) {
            closeTrigger(i)
          }
        }
      });
    }
  };
});
app.directive('popoverElem', function(){
  return{
    link: function(scope, element, attrs) {
      element.on('click', function(){
        element.addClass('trigger');
      });
    }
  };
});

app.config(['$routeProvider',
	function($routeProvider){
	$routeProvider
	.when('/', {
		templateUrl:'js/pages/home.html'
	})
	.when('/index', {
		templateUrl:'js/pages/index.html',
		controller: 'IndexController'
	})
	.when('/index/:qzid', {
		templateUrl:'js/pages/quiz.html',
		controller: 'QuizController'
	})	


	.when('/add',{
		templateUrl:'js/pages/add.html',
		controller: 'CreateController'
	})
	.when('/add/:qzid', {
		templateUrl:'js/pages/question.html',
		controller: 'AddQuestionController'
	})	
	
}]);