<?php
    if(session_id() === "")
        session_start();
    if($_SESSION['logged_in'] != true)
        header("Location: signin.php");
    $con = mysqli_connect("localhost","root","","bugtracker");
    $result = mysqli_query($con,"SELECT resbug FROM users WHERE username='".$_SESSION['username']."'");
    $resbug = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    echo $resbug['resbug'];
    mysqli_close($con);
?>