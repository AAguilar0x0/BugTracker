<?php

    $result = mysqli_query($con,"SELECT * FROM bugs WHERE status=1");
    $resolving = "<span class=\"NO_DATA\">NO DATA</span>";
    if($result == true){
        $data = mysqli_fetch_all($result);
        mysqli_free_result($result);
        if(count($data) > 0){
            $resolving = "";
        }
        for($i = 0; $i < count($data); $i++){
            $result = mysqli_query($con,"SELECT id FROM bugs WHERE JSON_CONTAINS(solving, '["."\"".$_SESSION['username']."\""."]') AND id='".$data[$i][0]."'");
            $solving = mysqli_fetch_assoc($result);
            mysqli_free_result($result);
            $button = "<button onclick='resolve(this)' value='".$data[$i][0]."' class='itemsHovFX'>Resolve</button> ";
            if($solving != NULL){
                $result = mysqli_query($con,"SELECT id FROM bugs WHERE JSON_CONTAINS(request, '["."\"".$_SESSION['username']."\""."]') AND id='".$data[$i][0]."'");
                $requested = mysqli_fetch_assoc($result);
                mysqli_free_result($result);
                $button = "<button onclick='reqresolved(this)' value='".$data[$i][0]."' class='itemsHovFX'>Request Resolved</button> ";
                if($requested != NULL){
                    $button = "<button value='".$data[$i][0]."' 
                        requested='1' style='color:unset;cursor:default;'>Request Resolved</button> ";
                }
            }
            $resolving .= "
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
                <button onclick='deleteBug(this)' value='".$data[$i][0]."' class='itemsHovFX' style='color:red'>&times;</button> " : "").
                $button.
                "<button onclick='viewdetails(this)' value='".$data[$i][0]."' class='itemsHovFX'>View Details</button>
                <br>
                <span>".$data[$i][6]."</span>
                <span>".$data[$i][1]."</span>
            </div>";
        }
    }

?>