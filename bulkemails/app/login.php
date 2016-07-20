<?php
//start session

session_start();

//
if (isset($_SESSION['usr_id'])) {
	
	header("Location: index.php");

}

//open database

include_once 'connect.php'; 

//check if form is submitted

if (isset($_POST['login'])) {
	
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = mysqli_real_escape_string($con, $_POST['password']);
	//query details from the database  
	$result = mysqli_query($con, "SELECT * FROM users WHERE email ='" . $email ."' AND password='" . md5($password) . "'" );
    
    //authenticate the email and password

	if ($row = mysqli_fetch_array($result)) {
		
		$_SESSION['usr_id'] = $row['id'];
		$_SESSION['usr_name'] = $row['name'];
		header(" Location: index.php");

	}else{
		$errormsg = "Incorrect Email and password!!!";
	}
}

 ?>


 <!DOCTYPE> 
<html>
<head>
	<title>Bulk Email System</title>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" conutent="IE=edge">
    <!--for repsonsiveness-->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <style type="text/css">

.section
{
	font-family: 'freight-text-pro';
	font-size: 1em;
}
	.navbar-brand{
      max-width: 10%;
      min-width: 10px;
      padding: 5px;

	}
	ul{
		font-family: 'freight-text-pro';
		font-size: 1.5em;
		color: white;
	}
	form{
		display: inline-block;
		border:1px solid black;
		width: 60%;
		height: 50%
		margin-right:25%;
		margin-left: 25%;
		padding: 10%;
		float: center;

	}
	.well{
		align: center;
		font-size: 1.5em;
		padding-left: 15%;
		margin-left:25%;
		margin-right: 25%;
	}

</style>
</head>
<body>
<!--navbar section-->
<nav class="navbar navbar-inverse ">

      <!-- Brand and toggle get grouped for better mobile display -->
    <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle">
	    <span class="sr-only">Toggle navigation</span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
	    <span class="icon-bar"></span>
     </button>
	<a class="navbar-brand" >
		<img alt="brand" src="img/logos.jpg" >
	</a>
	 <div class="collapse navbar-collapse" id="navbarCollapse">
	<ul class="nav navbar-nav navbar-right">
		<li><a href="#">Home</a></li>
		<li><a href="#">Bulk Email</a></li>
		<li><a href="#">Services</a></li>
	</ul>
	</div>

</nav>
<!--form section-->
<div class="section">
	<div class="row">
		<div class="col-xs-10">
           <h1 align="center">SIGN IN</h1>
            <div class="form">
		<form class="form-horizontal" method="POST" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="loginform">
			<div class="form-group">
				 <!--<label for="name" class="control-label">Name</label>
				<input type="email" class="form-control"  placeholder="name">-->
				<label for="email" class="control-label">Email</label>
				<input type="text" required class="form-control" name="email" placeholder="email"><!--emai-->
				<label for="inputPassword" class="control-label" >Password</label>
				<input type="password" required class="form-control" name="password"  placeholder="Password" ><!--password-->
			    
		</div>
			<label><input type="checkbox">Remember me</label>
			<br/>
			<button type="submit" class="btn btn-primary" value="login" name="login">Login</button>
			<br/>
			<br/>
			<br/>
			 <span class="text-danger"><?php if(isset($errormsg)){echo $errormsg;} ?></span>
		</div>
			</form>
            
		<div class="well">
			<p style="font-size:0.85em;"> New user? Don't have an account? <h4 style="color:#0033FF; font-weight: bold;"><a href="register.php">SIGN IN</a><h4> </p>
			
			</div>
	</div>
	</div>
</div>
 <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
 </body>
</html>