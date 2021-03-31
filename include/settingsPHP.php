<?php
    $status = "";
    if(isset($_POST['fname']) && isset($_POST['mname']) && isset($_POST['lname']) && 
        ( (!isset($_POST['password']) && !isset($_POST['rpassword'])) ||
        (empty($_POST['password']) && empty($_POST['rpassword'])) )){
        $result = mysqli_query($con, "UPDATE users SET firstname='".$_POST['fname']."', middlename='".$_POST['mname']."', lastname='".$_POST['lname']."' WHERE username='".$_SESSION['username']."';");
        $status = "<span style='color:green;'>Account successfully updated.</span>";
    }else if(( (isset($_POST['password']) && isset($_POST['rpassword'])) ||
        (!empty($_POST['password']) || !empty($_POST['rpassword'])) ) &&
        ($_POST['password'] != $_POST['rpassword'])){
        $status = "<span>Password does not match!</span>";
    }else if(( (isset($_POST['password']) && isset($_POST['rpassword'])) ||
        (!empty($_POST['password']) && !empty($_POST['rpassword'])) ) &&
        (strlen($_POST['password']) < 8 || strlen($_POST['rpassword']) < 8)){
        $status = "<span>Password must be at least 8 characters long!</span>";
    }else if(( (isset($_POST['password']) && isset($_POST['rpassword'])) ||
        (!empty($_POST['password']) && !empty($_POST['rpassword'])) ) &&
        ($_POST['password'] == $_POST['rpassword'])){
        $result = mysqli_query($con, "UPDATE users SET password='".md5($_POST['password'])."', firstname='".$_POST['fname']."', middlename='".$_POST['mname']."', lastname='".$_POST['lname']."' WHERE username='".$_SESSION['username']."';");
        $status = "<span style='color:green;'>Account successfully updated.</span>";
    }

    $result = mysqli_query($con, "SELECT username,firstname,middlename,lastname FROM users WHERE username='".$_SESSION['username']."'");
    $row = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    $inp0 = $row['username'];
    $inp1 = $row['firstname'];
    $inp2 = $row['middlename'];
    $inp3 = $row['lastname'];
?>