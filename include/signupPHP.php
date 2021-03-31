<?php
    if(session_id() === "")
        session_start();
    if(isset($_SESSION['logged_in']) === true && $_SESSION['logged_in'] === true)
        header("Location: index.php");
    $status = "";
    $con = mysqli_connect("localhost","root","","bugtracker");
    if(isset($_POST['username']) && mysqli_fetch_assoc(mysqli_query($con, "SELECT username FROM users WHERE username='".$_POST['username']."'")) != NULL){
        $status = "<span>Username already exist!</span>";
    }else if(isset($_POST['password']) && isset($_POST['rpassword']) && ($_POST['password'] != $_POST['rpassword'])){
        $status = "<span>Password does not match!</span>";
    }else if(isset($_POST['password']) && isset($_POST['rpassword']) && (strlen($_POST['password']) < 8)){
        $status = "<span>Password must be at least 8 characters long!</span>";
    }else if(isset($_POST['username']) && isset($_POST['fname']) && isset($_POST['mname']) && isset($_POST['lname']) && isset($_POST['password']) && isset($_POST['rpassword'])){
        $result = mysqli_query($con, "INSERT INTO users VALUES(NULL,'".$_POST['username']."','".md5($_POST['password'])."',1,'".$_POST['fname']."','".$_POST['mname']."','".$_POST['lname']."',0,0,0)");
        $status = "<span style='color:green;'>Account successfully created.</span>";
    }
?>