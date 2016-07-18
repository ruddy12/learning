<?php 
    //set validation error flag as false
    $error = false;
    //check if form is submitted
    if (isset($_POST['submit']))
    {
        $name = trim($_POST['txt_name']);
        $fromemail = trim($_POST['txt_email']);
        $pass = trim($_POST['txt_pass']);
          $PhoneNumber = trim($_POST['phonenumber']);
        $team = trim($_POST['txt_team']);
        $message = trim($_POST['txt_msg']);

        //name can contain only alpha characters and space
        if (!preg_match("/^[a-zA-Z ]+$/",$name))
        {
            $error = true;
            $name_error = "Please Enter Valid Name";
        }
        if(!filter_var($fromemail,FILTER_VALIDATE_EMAIL))
        {
            $error = true;
            $fromemail_error = "Please Enter Valid Email ID";
        }
        if(empty($pass))
        {
            $error = true;
            $pass_error = "Please Enter Your password";
        }
        if (empty($PhoneNumber)) {
            $error = true;
            $PhoneNumber_error = "Please Enter PhoneNumber";
        }

        if (empty($team)) {
            
            $error = true;
            $team_error = "Please Enter your Team";
        }
        /* if(empty($message))
        {
            $error = true;
            $message_error = "Please Enter Your Message";
        }
       if (!$error)
        {
            //send mail
            $toemail = "rufusngash@gmail.com";
            $subject = "Enquiry from Visitor " . $name;
            $body = "Here goes your Message Details: \n\n Name: $name \n From: $fromemail \n Message: \n $message";
            $headers = "From: $fromemail\n";
            $headers .= "Reply-To: $fromemail";

            if (mail ($toemail, $subject, $body, $headers))
                $alertmsg  = '<div class="alert alert-success text-center">Message sent successfully.  We will get back to you shortly!</div>';
            else
                $alertmsg = '<div class="alert alert-danger text-center">There is error in sending mail.  Please try again later.</div>';
        } */
    }
?>

<!DOCTYPE html>
<html>
<head>
    <title>Bootstrap 3 Contact Form Example</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" >
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3 well">
            <form role="form" class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="contactform">
            <fieldset>
                <legend>Bootstrap Contact Form</legend>

                <div class="form-group">
                    <div class="col-md-12">
                        <label for="txt_name" class="control-label">Full Name</label>
                    </div>
                    <div class="col-md-12">
                        <input class="form-control" name="txt_name" placeholder="Your Full Name" type="text" value="<?php if($error) echo $name; ?>" />
                        <span class="text-danger"><?php if (isset($name_error)) echo $name_error; ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <label for="txt_email" class="control-label">Email</label>
                    </div>
                    <div class="col-md-12">
                        <input class="form-control" name="txt_email" placeholder="Your Email" type="email" value="<?php if($error) echo $fromemail; ?>" />
                        <span class="text-danger"><?php if (isset($fromemail_error)) echo $fromemail_error; ?></span> 
                    </div>
                </div>
                      <div class="form-group">
                    <div class="col-md-12">
                        <label for="phonenumber" class="control-label">PhoneNumber</label>
                        </div>
                        <input type="tel" name="phonenumber" min="1" max="10" placeholder="Enter Phonenumber" value="<?php if($error) echo $PhoneNumber; ?>">
                        <span class="text-danger"><?php if(isset($PhoneNumber_error)) echo $PhoneNumber_error; ?></span>
                    
                </div>
              
                <div class="form-group">
                    <div class="col-md-12">
                        <label for="txt_subject" class="control-label">Password</label>
                    </div>
                    <div class="col-md-12">
                        <input class="form-control" name="txt_pass" placeholder="Your Password" type="password" value="<?php if($error) echo $pass; ?>" />
                        <span class="text-danger"><?php if (isset($pass_error)) echo $pass_error; ?></span>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                         <label for="txt_team" class="control-label">Team</label>
                    <select class="form-control" name="txt_team" value="<?php if($error) echo $team ?>">
                    
                              <option>Jerusalem</option>
                              <option>Nazareth</option>
                              <option>Jericho</option>
                              <option>Bethelehem</option>
                            </select>
                            <span class="text-danger"><?php if(isset($team_error)) echo $team_error; ?> </span>
                            </div><!-- c0l-md-12 -->
                </div><!--form group-->

                <div class="form-group">
                    <div class="col-md-12">
                        <label for="txt_msg" class="control-label"></label>
                    </div>
                    <div class="col-md-12">
                        <textarea class="form-control" name="txt_msg" rows="4" placeholder="Your Message"><?php if($error) echo $message; ?></textarea>
                        <span class="text-danger"><?php if (isset($message_error)) echo $message_error; ?></span>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-md-12">
                        <input name="submit" type="submit" class="btn btn-primary" value="Send" />
                    </div>
                </div>
            </fieldset>
            </form>
            <?php if (isset($alertmsg)) { echo $alertmsg; } ?>
        </div>
    </div>
</div>
</body>
</html>