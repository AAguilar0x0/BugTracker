<?php include('include/signupPHP.php');?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Sign Up</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
        <link rel="stylesheet" type="text/css" href="css/cred.css" />
        <link rel="shortcut icon" type="image" href="img/a0.png" />
    </head>
    <body>
        <div class="content">
            <div class="subcontent">
                <div class="myform">
                    <div class="text formTitle">Sign Up</div>
                    <form action="" method="POST">
                        <div class="field">
                            <input name="username" type="text" placeholder="Username" required/>
                        </div>
                        <div class="field">
                            <input name="fname" type="text" placeholder="First Name" required/>
                        </div>
                        <div class="field">
                            <input name="mname" type="text" placeholder="Middle Name" required/>
                        </div>
                        <div class="field">
                            <input name="lname" type="text" placeholder="Last Name" required/>
                        </div>
                        <div class="field">
                            <input name="password" type="password" placeholder="Password" required/>
                        </div>
                        <div class="field">
                            <input name="rpassword" type="password" placeholder="Re-Type Password" required/>
                        </div>
                        <div class="invalid-credentials"><?php echo $status;?></div>
                        <button>Sign up</button>
                        <div class="signinup">
                            Already a member? 
                            <a href="signin.php">login now</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>


<?php include('include/footer.php'); ?>