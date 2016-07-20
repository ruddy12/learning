<?php
//starts session
session_start();

if (isset($_SESSION['usr_id'])) {
	header("Location: index.php");
}
//connect to db
include_once 'connect.php';

//set validation error flag file as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {
	//remember to check ur names correctly
	$name = mysqli_real_escape_string($con, $_POST['name']);
	$email = mysqli_real_escape_string($con, $_POST['email']);
	$password = mysqli_real_escape_string($con, $_POST['cpassword']);
    
    //VALIDATE THE NAME
	//name can only contain alpha characters and space
	if (!preg_match("/^[a-zA-Z]+$/", $name)) {
		#generate your own error message after validation
		$error = true;
		$name_error = "Name must contain nly alphabets and space";
	}

	//VALIDATES THE EMAIL
	if (!filter_var("$email", FILTER_VALIDATE_EMAIL)) {
		#generate your own error message after validation
		$error = true;
		$email_error = "Please Enter a valid Email address";
	}

	//VALIDATE PASSWORD
	if (strlen($password)< 6) {
		#generate your own error message
		$error = true;
		$password_error = "Password Must be a minimum of 6 characters";
	}

	//VALIDATE CONFIRM PASSWORD
	 if($password != $cpassword) {
	 	//generate your own error msg
        $error = true;
        $cpassword_error = "Password and Confirm Password doesn't match";
	}
	//if all details are entered correctly and no error
	if (!$error) {
		//create a query to insert the datails submitted to the db
			
			 if(mysqli_query($con, "INSERT INTO users(name,email,password) VALUES('" . $name . "', '" . $email . "', '" . md5($password) . "')")) {
				
				//sucess message if all entries are correct
				$successmsg = "Successfully Registered! <a href ='login.php'> click here to Login </a>"; 
			}else{
				$errormsg ="Error in registering...please try again later!";
			} 
		}
	
}

 ?>



 <!DOCTYPE> 
<html>
<head>
	<title>SignUp.php</title>
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
		
	</ul>
	</div>

</nav>
<!--form section-->
<div class="section">
	<div class="row">
		<div class="col-xs-10">
           <h1 align="center">SIGN UP</h1>
            <div class="form">
		<form class="form-horizontal" method="POST" role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" name="signupform">
			<div class="form-group">
				 <label for="name" class="control-label">Name</label>
				<input type="name" class="form-control" name="name" placeholder="name" required value="<?php if ($error) echo $name;?>" class="form-control" />
				<span class="text-danger"><?php if (isset($name_error)) echo $name_error;?></span>
				<label for="email" class="control-label">Email</label>
				<input type="email" class="form-control" name="email" placeholder="email" required value="<?php if($error) echo $email ?>"><!--emai--> <span class="text-danger"><?php if(isset($email_error)) echo $email_error; ?></span>
				 <label for="name">Password</label>
                        <input type="password" name="password" placeholder="Password" required class="form-control" />
                        <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
			              <label for="name">Confirm Password</label>
                        <input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
                        <span class="text-danger"><?php if (isset($cpassword_error)) echo $cpassword_error; ?></span>

		</div>
			<label><input type="checkbox">Remember me</label>
			<br/>
			<button type="submit" class="btn btn-primary" value="register" name="signup">Sign Up</button>
			</form>
			<span class="text-success"><?php if(isset($successmsg)){echo $successmsg;} ?></span>
			<span class="text-danger"><?php if(isset($errormsg)){echo $errormsg;} ?></span>
		</div>
		
	</div>
	</div>
	
</div>
<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">Already Registered?<a href="login.php">Login Here</a>
		</div>

	</div>
 <!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
 </body>
</html>