<?php
    if(session_id() === "")
        session_start();
    if($_SESSION['logged_in'] != true)
        header("Location: signin.php");
    $con = mysqli_connect("localhost","root","","bugtracker");
    // $result = mysqli_query($con, "UPDATE `users` SET `reported` = '[1,2,3]' WHERE username='".$_SESSION['username']."'");
    // var_dump($result);
    
    // $result = mysqli_query($con, "SELECT reported FROM users WHERE username='".$_SESSION['username']."'");
    // $reported = mysqli_fetch_assoc($result);
    // var_dump($reported);
    // echo "<br>".$reported['reported']."<br>";
    // $newReported = JSON_DECODE($reported['reported']);
    // var_dump($newReported);
    // mysqli_free_result($result);
    // $result = mysqli_query($con, "SELECT JSON_EXTRACT('".$reported['reported']."', '$.newReported') FROM users WHERE username='".$_SESSION['username']."'");
    // $reported = mysqli_fetch_assoc($result);
    // var_dump($reported);
    // echo "<br>here".$reported['JSON_EXTRACT(\'["1","2","3"]\', \'$.newReported\')']."<br>";
    
    // SELECT id FROM bugs WHERE NOT JSON_LENGTH(request) = 0
    $result = mysqli_query($con, "SELECT id,title,request FROM bugs WHERE author='".$_SESSION['username']."' AND status=1 AND NOT JSON_LENGTH(request) = 0");
    $request = "<span class=\"NO_DATA\">NO DATA</span>";
    if($result == true){
        $data = mysqli_fetch_all($result);
        mysqli_free_result($result);
        $request = count($data) > 0 ? "" : $request;
        for($i = 0; $i < count($data); $i++){
            $users = JSON_DECODE($data[$i][2]);
            for($j = 0; $j < count($users); $j++){
                $request .= "<div value='".$data[$i][0]."' class='neuH cardcontent userRequest'>
                        <div class='cardcontent'>
                            <span>Title</span>
                            <div class='neuL resHScroll'>
                                <span>".$data[$i][1]."</span>
                            </div>
                            <span>Username</span>
                            <div class='neuL resHScroll'>
                                <span>".$users[$j]."</span>
                            </div>
                        </div>
                        <button usrnm='".$users[$j]."' currusrnm='".$_SESSION['username']."' value='".$data[$i][0]."' onclick='acknowledge(this)' class='itemsHovFX'>Acknowledge</button>
                        <button usrnm='".$users[$j]."' value='".$data[$i][0]."' onclick='deny(this)' class='itemsHovFX'>Deny</button>
                        <button value='".$data[$i][0]."' onclick='viewdetails(this)' class='itemsHovFX'>View Details</button>
                    </div>";
            }
        }
    }
    echo $request;
    mysqli_close($con);
?>