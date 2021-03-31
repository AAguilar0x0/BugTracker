<?php
    if(session_id() === "")
        session_start();
    if($_SESSION['logged_in'] != true)
        header("Location: signin.php");
    $con = mysqli_connect("localhost","root","","bugtracker");
    date_default_timezone_set('Asia/Manila');
    $datetime = date("Y-m-d H:i:s",time());
    $title = str_replace("'","\'",$_POST['titleup']);
    $description = str_replace("'","\'",$_POST['descriptionup']);
    $result = mysqli_query($con,"UPDATE bugs SET datetime='".$datetime."', title='".$title."', description='".$description."' WHERE id='".$_POST['bugid']."'");
    mysqli_close($con);
    header("Location: ../bugpool.php");
?>