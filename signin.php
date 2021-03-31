<?php include('include/signinPHP.php');?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <title>Sign In</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css" />
        <link rel="stylesheet" type="text/css" href="css/cred.css" />
        <link rel="shortcut icon" type="image" href="img/a0.png" />
        <style>
            .content:nth-of-type(1) {
                min-height: 100vh;
            }
        </style>
    </head>
    <body>
        <div class="content">
            <div class="subcontent">
                <div class="myform">
                    <div class="text formTitle">Bug Tracker</div>
                    <form action="" method="POST">
                        <div class="field">
                            <span class="fas fa-user"></span>
                            <input name="username" type="text" placeholder="Username" required/>
                        </div>
                        <div class="field">
                            <span class="fas fa-lock"></span>
                            <input name="password" type="password" placeholder="Password" required/>
                        </div>
                            <!-- <a href="#">Forgot Password?</a> -->
                        <div class="invalid-credentials"><?php echo $status;?></div>
                        <button>Sign in</button>
                        <div class="signinup">
                            Not a member?
                            <a href="signup.php">signup now</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

<?php include('include/footer.php'); ?>
