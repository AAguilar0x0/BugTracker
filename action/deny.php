<?php
    if(session_id() === "")
        session_start();
    if($_SESSION['logged_in'] != true)
        header("Location: signin.php");
    $con = mysqli_connect("localhost","root","","bugtracker");
    $result = mysqli_query($con,"UPDATE bugs SET request = JSON_REMOVE(request, JSON_UNQUOTE(JSON_SEARCH(request, 'one', '".$_POST['username']."'))) WHERE id='".$_POST['bugId']."' AND JSON_SEARCH(request, 'one', '".$_POST['username']."') IS NOT NULL");
    mysqli_close($con);
?>