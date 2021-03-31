<?php
    // SELECT * FROM `users` WHERE JSON_CONTAINS(reported, '["admin"]');
    if(session_id() === "")
        session_start();
    if($_SESSION['logged_in'] != true)
        header("Location: signin.php");
    $con = mysqli_connect("localhost","root","","bugtracker");
    $result = mysqli_query($con,"UPDATE bugs SET request=JSON_ARRAY_APPEND(request,'$','".$_SESSION['username']."') WHERE id='".$_POST['bugId']."'");
    mysqli_close($con);
?>