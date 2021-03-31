<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="stylesheet" type="text/css" href="css/cred.css">
        <link rel="stylesheet" type="text/css" href="css/bugpool.css">
        <link rel="stylesheet" type="text/css" href="css/index.css">
        <link rel="shortcut icon" type="image" href="img/a0.png">
    </head>
<?php
    include('include/header.php');
    include('include/getReqResolved.php');
?>

        <div class="content">
            <div class="subcontent">
                <div class="card cardcontent depthFX">
                    <span>Name</span>
                    <?php echo $name;?>
                    <span>Reported Bug(s)</span>
                    <?php echo $repbug;?>
                    <span>Resolved Bug(s)</span>
                    <?php echo $resbug;?>
                    <span>Resolving Bug(s)</span>
                    <?php echo $inprogbug;?>
                </div>
            </div>
        </div>

        <div class="modal">
            <div class="card">
                <span onclick="document.getElementsByClassName('modal')[0].style.display = 'none';" class="modalclose">&times;</span>
                <br>
                <span class="reportbug">Bug Details</span>
                <div class="cardcontent modalViewDetails">
                    <span>Timestamp</span>
                    <div class="neuL">
                        <span></span>
                    </div>
                    <span>Author</span>
                    <div class="neuL">
                        <span></span>
                    </div>
                    <span>Title</span>
                    <div class="neuL">
                        <span></span>
                    </div>
                    <span>Description</span>
                    <div class="neuL">
                        <pre></pre>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="subcontent">

                <div class="card depthFX">
                    <div class="bpCategoryHead">
                        <div class="neuH">Request for resolved</div>
                        <div class="searchWParam">
                            <div class="neuL">
                                <select name='param'>
                                    <option value='' disabled selected>Search Location</option>
                                    <option value='title'>Title</option>
                                    <option value='username'>Username</option>
                                </select>
                            </div>
                            <div class="field">
                                <input onkeyup="searchReqResolved(this)" name="search" type="text" placeholder="Search"/>
                            </div>
                        </div>
                        <div class="break"></div>
                        <hr style="width: 100%;" class="styled">

                        <div class="requests">
                            <!-- <div class='neuH cardcontent userRequest'>
                                <div class='cardcontent'>
                                    <span>Title</span>
                                    <div class='neuL resHScroll'>
                                        <span>Sample Title</span>
                                    </div>
                                    <span>Username</span>
                                    <div class='neuL resHScroll'>
                                        <span>Sample Username</span>
                                    </div>
                                </div>
                                <button value="" class="itemsHovFX">Acknowledge</button>
                                <button value="" class="itemsHovFX">Deny</button>
                            </div> -->
                            <?php echo $request?>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <script>
            window.onclick = function hideModal(event){
                for(let i = 0; document.getElementsByClassName("modal")[i] != undefined ;i++){
                    if(event.target == document.getElementsByClassName("modal")[i]){
                        document.getElementsByClassName("modal")[i].style.display = "none";
                        break;
                    }
                }
            }
        </script>
        <script type="text/javascript" src="script/bugpool.js"></script>
        <script type="text/javascript" src="script/index.js"></script>

<?php include('include/footer.php'); ?>