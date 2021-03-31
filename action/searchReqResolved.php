<?php
    if(session_id() === "")
        session_start();
    if($_SESSION['logged_in'] != true)
        header("Location: signin.php");
    $con = mysqli_connect("localhost","root","","bugtracker");
    $result;
    $reqresolved = "<span class=\"NO_DATA\">NO DATA</span>";
    if($_POST['param'] == "title"){
        $result = mysqli_query($con,"SELECT id,title,request FROM bugs WHERE author='".$_SESSION['username']."' AND status=1 AND NOT JSON_LENGTH(request) = 0 AND INSTR(".$_POST['param'].",'".$_POST['key']."')");
        if($result == true){
            $data = mysqli_fetch_all($result);
            mysqli_free_result($result);
            $reqresolved = count($data) > 0 ? "" : $reqresolved;
            for($i = 0; $i < count($data); $i++){
                $users = JSON_DECODE($data[$i][2]);
                for($j = 0; $j < count($users); $j++){
                    $reqresolved .= "<div value='".$data[$i][0]."' class='neuH cardcontent userRequest'>
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
                            <button usrnm='".$users[$j]."' value='".$data[$i][0]."' onclick='acknowledge(this)' class='itemsHovFX'>Acknowledge</button>
                            <button usrnm='".$users[$j]."' value='".$data[$i][0]."' onclick='deny(this)' class='itemsHovFX'>Deny</button>
                            <button value='".$data[$i][0]."' onclick='viewdetails(this)' class='itemsHovFX'>View Details</button>
                        </div>";
                }
            }
        }
    }else{
        $result = mysqli_query($con,"SELECT id,title FROM bugs WHERE author='".$_SESSION['username']."' AND status=1 AND JSON_SEARCH(request, 'all', '".$_POST['key']."') IS NOT NULL");
        if($result == true){
            $data = mysqli_fetch_all($result);
            mysqli_free_result($result);
            $reqresolved = count($data) > 0 ? "" : $reqresolved;
            for($i = 0; $i < count($data); $i++){
                $reqresolved .= "<div value='".$data[$i][0]."' class='neuH cardcontent userRequest'>
                        <div class='cardcontent'>
                            <span>Title</span>
                            <div class='neuL resHScroll'>
                                <span>".$data[$i][1]."</span>
                            </div>
                            <span>Username</span>
                            <div class='neuL resHScroll'>
                                <span>".$_POST['key']."</span>
                            </div>
                        </div>
                        <button usrnm='".$_POST['key']."' value='".$data[$i][0]."' onclick='acknowledge(this)' class='itemsHovFX'>Acknowledge</button>
                        <button usrnm='".$_POST['key']."' value='".$data[$i][0]."' onclick='deny(this)' class='itemsHovFX'>Deny</button>
                        <button value='".$data[$i][0]."' onclick='viewdetails(this)' class='itemsHovFX'>View Details</button>
                    </div>";
            }
        }
    }
    echo $reqresolved;
    mysqli_close($con);
?>