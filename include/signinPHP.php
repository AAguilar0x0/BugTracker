<?php
    if(session_id() === "")
        session_start();
    if(isset($_SESSION['logged_in']) === true && $_SESSION['logged_in'] === true)
        header("Location: index.php");
	$status = "";
	if(isset($_POST['username']) && isset($_POST['password'])){
		$con = mysqli_connect("localhost","root","","bugtracker");
		$result = mysqli_query($con, "SELECT username FROM users WHERE username='".$_POST['username']."' AND password='".md5($_POST['password'])."'");
        $row = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_close($con);
		if($row == NULL){
			$status = "<span>Username or password is incorrect!</span>";
		}else{
            $status = "";
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $row['username'];
            header("Location: index.php");
        }
	}
?>