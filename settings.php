<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Settings</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="stylesheet" type="text/css" href="css/cred.css">
        <link rel="stylesheet" type="text/css" href="css/settings.css">
        <link rel="shortcut icon" type="image" href="img/a0.png">
    </head>
<?php include('include/header.php'); ?>
<?php include('include/settingsPHP.php') ?>
        
        <div class="content">
            <div class="subcontent">
                <!-- <div class="myform"> -->
                    <form class="myform depthFX" action="" method="POST">
                        <div class="cardcontent">
                            <span>Username </span>
                            <div class="field">
                                <input type="text" placeholder="Username" value="<?php echo $inp0?>" readonly/>
                            </div>
                            <span>First Name </span>
                            <div class="field">
                                <input name="fname" type="text" placeholder="First Name" value="<?php echo $inp1?>" required/>
                            </div>
                            <span>Middle Name</span>
                            <div class="field">
                                <input name="mname" type="text" placeholder="Middle Name" value="<?php echo $inp2?>" required/>
                            </div>
                            <span>Last Name</span>
                            <div class="field">
                                <input name="lname" type="text" placeholder="Last Name" value="<?php echo $inp3?>" required/>
                            </div>
                            <span>Password</span>
                            <div class="field">
                                <input name="password" type="password" placeholder="(Optional)"/>
                            </div>
                            <span>Re-Type Password</span>
                            <div class="field">
                                <input name="rpassword" type="password" placeholder="(Optional)"/>
                            </div>
                        </div>
                        <div class="invalid-credentials"><?php echo $status;?></div>
                        <button class="itemsHovFX">Save Changes</button>
                    </form>
                <!-- </div> -->
            </div>
        </div>

<?php include('include/footer.php'); ?>