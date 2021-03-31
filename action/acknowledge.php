<?php
    if(session_id() === "")
        session_start();
    if($_SESSION['logged_in'] != true)
        header("Location: signin.php");
    $con = mysqli_connect("localhost","root","","bugtracker");
    $status = mysqli_query($con,"UPDATE bugs SET status='2', solver='".$_POST['username']."' WHERE id='".$_POST['bugId']."'");
    $result = mysqli_query($con,"SELECT resbug FROM users WHERE username='".$_POST['username']."'");
    $resbug = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    $resbugVal = 1+(int)$resbug['resbug'];
    $result = mysqli_query($con,"UPDATE users SET resbug='".$resbugVal."' WHERE username='".$_POST['username']."'");
    mysqli_close($con);
?>