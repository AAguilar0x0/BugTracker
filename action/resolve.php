<?php
    if(session_id() === "")
        session_start();
    if($_SESSION['logged_in'] != true)
        header("Location: signin.php");
    $con = mysqli_connect("localhost","root","","bugtracker");
    $result = mysqli_query($con,"SELECT rspdngbug FROM users WHERE username='".$_SESSION['username']."'");
    $rspdngbug = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    $rspdngbugVal = 1+(int)$rspdngbug['rspdngbug'];
    $result = mysqli_query($con,"UPDATE users SET rspdngbug='".$rspdngbugVal."' WHERE username='".$_SESSION['username']."'");
    $result = mysqli_query($con,"UPDATE bugs SET status='1' WHERE id='".$_POST['bugId']."'");
    $result = mysqli_query($con,"UPDATE bugs SET solving=JSON_ARRAY_APPEND(solving,'$','".$_SESSION['username']."') WHERE id='".$_POST['bugId']."'");
    $result = mysqli_query($con,"SELECT * FROM bugs WHERE id='".$_POST['bugId']."'");
    if($result == true){
        $data = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        $bugItem = "
        <div id='bugItem".$data['id']."' class='neuH cardcontent bugShort'>
            <div class='cardcontent'>
                <span>ID</span>
                <div class='neuL resHScroll'>
                    <span>".$data['id']."</span>
                </div>
                <span>Title</span>
                <div class='neuL resHScroll'>
                    <span>".$data['title']."</span>
                </div>
            </div>"
            .($data['author'] === $_SESSION['username'] ? "
            <button onclick='update(this)' value='".$data['id']."' class='itemsHovFX'><span class='icon-write'></span></button>
            <button onclick='deleteBug(this)' value='".$data['id']."' class='itemsHovFX' style='color:red'>&times;</button>
            " : "").
            "<button onclick='reqresolved(this)' value='".$data['id']."' class='itemsHovFX'>Request Resolved</button>
            <button onclick='viewdetails(this)' value='".$data['id']."' class='itemsHovFX'>View Details</button>
            <br>
            <span>".$data['author']."</span>
            <span>".$data['datetime']."</span>
        </div>";
        echo $bugItem;
    }
    mysqli_close($con);
?>