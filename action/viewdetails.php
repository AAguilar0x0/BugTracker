<?php
    if(session_id() === "")
        session_start();
    if($_SESSION['logged_in'] != true)
        header("Location: signin.php");
    $con = mysqli_connect("localhost","root","","bugtracker");
    $result = mysqli_query($con,"SELECT * FROM bugs WHERE id='".$_POST['bugId']."'");
    $td = mysqli_fetch_assoc($result);
    $author = str_replace('"','\"',$td['author']);
    $title = str_replace('"','\"',$td['title']);
    $description = str_replace('"','\"',$td['description']);
    echo "[\"".$td['datetime']."\",\"".$author."\",\"".$title."\",\"".$description."\"]";
    // if(isset($_POST['title']) && isset($_POST['description'])){
    //     $result = mysqli_query($con,"INSERT INTO bugs VALUES(NULL,'".$datetime."','".$_POST['title']."','".$_POST['description']."',0,0,'".$_SESSION['username']."','')");
    //     // UPDATE `users` SET `repbug` = '6', `reported` = NULL WHERE `users`.`id` = 1;
    // }
    mysqli_close($con);
    // header("Location: ../bugpool.php");
?>