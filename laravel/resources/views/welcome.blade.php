<html>
	<head>

		<title>Quizzes</title>
		<link rel="stylesheet" href="css/ngDialog.css">
		<link rel="stylesheet" href="css/ngDialog-theme-default.css">
		<link rel="stylesheet" href="css/ngDialog-theme-plain.css">
		<link rel="stylesheet" href="css/ngDialog.css">
		<link rel="stylesheet" href="css/ngDialog-theme-default.css">
		<link rel="stylesheet" href="css/ngDialog-theme-plain.css">
		<link rel="stylesheet" href="css/nsPopover.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">

		<script src="js/angular.min.js"></script>
		<script src="js/angular-route.js"></script>

		<script src="js/ui-bootstrap-tpls-0.13.0.min.js"></script>
		<script src="js/buttons.js"></script>
		<script src="js/accordion.js"></script>

		<script src="js/jquery-2.1.0.min.js"></script>
		<script src="js/bootstrap.min.js"></script>

			
		<script src="js/ngDialog.js"></script>
		<script src="js/ngDialog.min.js"></script>
		<script src="js/nsPopover.js"></script>
		<script src="js/popover.js"></script>
		
		<script src="js/app.js"></script>

		
		
			
		<style >
		
			body{

				background-color:;
			}
			.container{
				background-color:;
			}

			.btn-xlarge {
				width: 700px;
				height: 40px; 
			    padding: 8px 80px;
			    font-size: 17px;

			    line-height: normal;
			    background-color: ;
			    -webkit-border-radius: 8px;
			       -moz-border-radius: 8px;
			            border-radius: 8px;
 			   }
			input[type=checkbox] {
				-webkit-appearance: none;
			    width: 1em;
			    height: 1em;
			}
			input[type=checkbox]:after {
				content: '+';
			}
			input.open[type=checkbox]:after {
				content: '-';
			}
			input.open1[type=checkbox]:after {
				content: '-';
			}
			.topic{
				
				font-size: 22px;

			}
			.question{
				font-size: 20px;
				color: blue;
			}
			
			a.but:link {
			    text-decoration: none;
			    color:black;
			}

			a:link {
			    text-decoration: none;
			    color:black;
			}
			a:visited {
			    text-decoration: none;
			}
			a:hover {
			
			    color:blue;
			}

			.title {
				font-size: 96px;
				margin-left: auto;
   				margin-right: auto;
			}

		</style>
		
		
	</head>
	<body ng-app='myApp'>
		<nav class="navbar navbar-default">
		<div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle Navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/#/">Hi</a>
			</div>

			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="{{ url('/#index') }}">Home</a></li>
					<li><a href="{{ url('/#add') }}"></a></li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					@if (Auth::guest())
						<!--<li><a href="{{ url('/auth/login') }}">Login</a></li>
						<li><a href="{{ url('/auth/register') }}">Register</a></li>-->
					@else
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
							<ul class="dropdown-menu" role="menu">
								<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
							</ul>
						</li>
					@endif
				</ul>
			</div>
		</div>
	</nav>
			<div ng-view></div>

	</body>
</html>
