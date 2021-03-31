<?php
    $result = mysqli_query($con,"SELECT * FROM bugs WHERE status=0");
    $unresolved = "<span class=\"NO_DATA\">NO DATA</span>";
    if($result == true){
        $data = mysqli_fetch_all($result);
        mysqli_free_result($result);
        if(count($data) > 0){
            $unresolved = "";
        }
        for($i = 0; $i < count($data); $i++){
            $unresolved .= "
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
                </div>"
                .($data[$i][6] === $_SESSION['username'] ? "
                <button onclick='update(this)' value='".$data[$i][0]."' class='itemsHovFX'><span class='icon-write'></span></button>
                <button onclick='deleteBug(this)' value='".$data[$i][0]."' class='itemsHovFX' style='color:red'>&times;</button>
                " : "").
                "<button onclick='resolve(this)' value='".$data[$i][0]."' class='itemsHovFX'>Resolve</button>
                <button onclick='viewdetails(this)' value='".$data[$i][0]."' class='itemsHovFX'>View Details</button>
                <br>
                <span>".$data[$i][6]."</span>
                <span>".$data[$i][1]."</span>
            </div>";
        }
    }
?>