<?php
    if(session_id() === "")
        session_start();
    if($_SESSION['logged_in'] != true)
        header("Location: signin.php");
    $con = mysqli_connect("localhost","root","","bugtracker");
    date_default_timezone_set('Asia/Manila');
    $datetime = date("Y-m-d H:i:s",time());
    if(isset($_POST['title']) && isset($_POST['description'])){
        $title = str_replace("'","\'",$_POST['title']);
        $description = str_replace("'","\'",$_POST['description']);
        $result = mysqli_query($con,"INSERT INTO bugs VALUES(NULL,'".$datetime."','".$title."','".$description."',0,0,'".$_SESSION['username']."','','[]','[]')");
        // UPDATE `users` SET `repbug` = '6', `reported` = NULL WHERE `users`.`id` = 1;
        $result = mysqli_query($con,"SELECT repbug FROM users WHERE username='".$_SESSION['username']."'");
        $repbug = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        $repbugVal = 1+(int)$repbug['repbug'];
        $result = mysqli_query($con,"UPDATE users SET repbug='".$repbugVal."' WHERE username='".$_SESSION['username']."'");
    }
    mysqli_close($con);
    header("Location: ../bugpool.php");
?>