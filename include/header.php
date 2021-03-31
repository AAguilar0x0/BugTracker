<?php
    if(session_id() === "")
        session_start();
    if($_SESSION['logged_in'] != true)
        header("Location: signin.php");
    $con = mysqli_connect("localhost","root","","bugtracker");
?>
    <body>
        <nav>
            <div class="items icon">
                <img src="img/a1.png" hegiht="40px" width="40px">
            </div>
            <div style="margin: 5px 5px 5px 0px">
                <input class="menuButton" type="checkbox" id="menuButtonID" style="display: none;"/>
                <label class="menuIcon" for="menuButtonID"><span class="navIcon"></span></label>
                <ul class="menuItems">
                    <li>
                        <a id="index" href="index.php">
                            <div class="items itemsHovFX">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <a id="bugpool" href="bugpool.php">
                            <div class="items itemsHovFX">Bug Pool</div>
                        </a>
                    </li>
                    <li>
                        <a id="settings" href="settings.php">
                            <div class="items itemsHovFX">Settings</div>
                        </a>
                    </li>
                    <li>
                        <a href="signout.php">
                            <div class="items itemsHovFX">Sign Out</div>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    <script>
        (function() {
                let title = document.getElementsByTagName('TITLE')[0].innerHTML;
                let myIdList = {"Dashboard":"index","Bug Pool":"bugpool","Settings":"settings"};
                document.getElementById(myIdList[title]).href = "";
                let x = document.getElementById(myIdList[title]).getElementsByTagName('DIV')[0];
                x.classList.remove("itemsHovFX");
                x.classList.add("active");
            }
        )();
        let prevScroll = window.pageYOffset;
        let prevButton = false;
        function scrollDirection(){
            let currScroll = window.pageYOffset;
            let result = currScroll > prevScroll ? 0 : 1;
            prevScroll = currScroll;
            // console.log(result == 0 ? "DOWN" : "UP");
            return result;
        }
        window.onscroll = function hideOnScroll(){
            let button = document.getElementById('menuButtonID');

            let navbar = document.getElementsByTagName('NAV')[0];
            if(button.checked == false && !scrollDirection()){
                navbar.style.position = "relative";
            }else{
                navbar.style.position = "sticky";
            }
        };
    </script>