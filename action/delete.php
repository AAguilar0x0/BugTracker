<?php
    if(session_id() === "")
        session_start();
    if($_SESSION['logged_in'] != true)
        header("Location: signin.php");
    $con = mysqli_connect("localhost","root","","bugtracker");
    // DELETE FROM `bugs` WHERE `bugs`.`id` = 13
    $result = mysqli_query($con,"DELETE FROM bugs WHERE id=".$_POST['bugId']."");
    $result = mysqli_query($con,"SELECT repbug FROM users WHERE username='".$_SESSION['username']."'");
    $repbug = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    $repbugVal = ((int)$repbug['repbug']) - 1;
    $result = mysqli_query($con,"UPDATE users SET repbug='".$repbugVal."' WHERE username='".$_SESSION['username']."'");
    mysqli_close($con);
?>