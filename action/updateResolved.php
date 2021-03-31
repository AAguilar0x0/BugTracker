<?php
    if(session_id() === "")
        session_start();
    if($_SESSION['logged_in'] != true)
        header("Location: signin.php");
    $con = mysqli_connect("localhost","root","","bugtracker");
    $result = mysqli_query($con,"SELECT * FROM bugs WHERE status=2");
    $resolved = "<span class=\"NO_DATA\">NO DATA</span>";
    if($result == true){
        $data = mysqli_fetch_all($result);
        mysqli_free_result($result);
        $resolved = count($data) > 0 ? "" : $resolved;
        for($i = 0; $i < count($data); $i++){
            $resolved .= "
            <div id='bugItem".$data[$i][0]."' class='neuH cardcontent bugShort'>
                <div class='cardcontent'>
                    <span>ID</span>
                    <div class='neuL resHScroll'>
                        <span>".$data[$i][0]."</span>
                    </div>
                    <span>Title</span>
                    <div class='neuL resHScroll'>
                        <span>".$data[$i][2]."</span>
                    </div>
                </div>
                <button onclick='viewdetailsResolved(this)' value='".$data[$i][0]."' class='itemsHovFX'>View Details</button>
                <br>
                <span>".$data[$i][6]."</span>
                <span>".$data[$i][1]."</span>
            </div>";
        }
    }
    echo $resolved;
    mysqli_close($con);
?>