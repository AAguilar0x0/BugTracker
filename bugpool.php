<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bug Pool</title>
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <link rel="stylesheet" type="text/css" href="css/cred.css">
        <link rel="stylesheet" type="text/css" href="css/bugpool.css">
        <link rel="shortcut icon" type="image" href="img/a0.png">
    </head>
<?php
    include('include/header.php');
    // mysqli_free_result($result);
    include('include/getUnresolved.php');
    include('include/getResolving.php');
    include('include/getResolved.php');
    // SELECT * FROM `users` WHERE JSON_CONTAINS(reported, '["admin"]');
    // UPDATE `users` SET reported=JSON_ARRAY_APPEND(reported,'$','user2') WHERE id=1
    // UPDATE users SET reported = JSON_REMOVE(reported, JSON_UNQUOTE(JSON_SEARCH(reported, 'one', 'user'))) WHERE JSON_SEARCH(reported, 'one', 'user') IS NOT NULL
?>
        <div class="subcontent">
            <div onclick="document.getElementsByClassName('modal')[0].style.display = 'block';" class="createNew neuH itemsHovFX">
                Create New
            </div>

            <div class="modal">
                <div class="card">
                    <span onclick="document.getElementsByClassName('modal')[0].style.display = 'none';" class="modalclose">&times;</span>
                    <br>
                    <span class="reportbug">Report Bug</span>
                    <form action="action/createnew.php" method="POST">
                        <div class="cardcontent">
                            <span>Title</span>
                            <div class="field">
                                <input name="title" type="text" placeholder="Title" required/>
                            </div>
                            <span>Description</span>
                            <div class="field">
                                <textarea name="description" placeholder="Description" row="10" required></textarea>
                            </div>
                        </div>
                        <button>Submit Report</button>
                    </form>
                </div>
            </div>

            <div class="modal">
                <div class="card">
                    <span onclick="document.getElementsByClassName('modal')[1].style.display = 'none';" class="modalclose">&times;</span>
                    <br>
                    <span class="reportbug">Edit Bug</span>
                    <form action="action/update.php" method="POST">
                        <div class="cardcontent">
                            <input name="bugid" type="text" style="display:none;"/>
                            <span>Title</span>
                            <div class="field">
                                <input name="titleup" type="text" placeholder="Title" required/>
                            </div>
                            <span>Description</span>
                            <div class="field">
                                <textarea name="descriptionup" placeholder="Description" row="10" required></textarea>
                            </div>
                        </div>
                        <button>Save Changes</button>
                    </form>
                </div>
            </div>

            <div class="modal">
                <div class="card">
                    <span onclick="document.getElementsByClassName('modal')[2].style.display = 'none';" class="modalclose">&times;</span>
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
            
            <div class="modal">
                <div class="card">
                    <span onclick="document.getElementsByClassName('modal')[3].style.display = 'none';" class="modalclose">&times;</span>
                    <br>
                    <span class="reportbug">Bug Details</span>
                    <div class="cardcontent modalViewDetails">
                        <span>Solved by</span>
                        <div class="neuL">
                            <span></span>
                        </div>
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

            <div class="break"></div>

            <div class="card depthFX">
                <div class="bpCategoryHead">
                    <div class="neuH">Devs Unresolved</div>
                    <div class="searchWParam">
                        <div class="neuL">
                            <select name='param'>
                                <option value='' disabled selected>Search Location</option>
                                <option value='id'>ID</option>
                                <option value='title'>Title</option>
                                <option value='description'>Description</option>
                                <option value='author'>Author</option>
                            </select>
                        </div>
                        <div class="field">
                            <input onkeyup="searchUnresolved(this)" name="search" type="text" placeholder="Search"/>
                        </div>
                    </div>
                    <div class="break"></div>
                    <hr style="width: 100%;" class="styled">

                    <div class="bugscontent">
                        <!-- <div class='neuH cardcontent bugShort'>
                            <div class='cardcontent'>
                                <span>ID</span>
                                <div class='neuL resHScroll'>
                                    <span>Sample ID</span>
                                </div>
                                <span>Title</span>
                                <div class='neuL resHScroll'>
                                    <span>Sample Title</span>
                                </div>
                            </div>
                            <button value="" class="itemsHovFX"><span class="icon-write"></span></button>
                            <button value="" class="itemsHovFX">&times;</button>
                            <button value="" class="itemsHovFX">Resolve</button>
                            <button value="" class="itemsHovFX">View Details</button>
                            <br>
                            <span>admin</span>
                            <span>2020-12-17 00:00:00</span>
                        </div> -->
                        <?php echo $unresolved; ?>
                    </div>
                </div>
            </div>
            
            <div class="break"></div>

            <div class="card depthFX">
                <div class="bpCategoryHead">
                    <div class="neuH">Devs Resolving</div>
                    <div class="searchWParam">
                        <div class="neuL">
                            <select name='param'>
                                <option value='' disabled selected>Search Location</option>
                                <option value='id'>ID</option>
                                <option value='title'>Title</option>
                                <option value='description'>Description</option>
                                <option value='author'>Author</option>
                            </select>
                        </div>
                        <div class="field">
                            <input onkeyup="searchResolving(this)" name="search" type="text" placeholder="Search"/>
                        </div>
                    </div>
                    <div class="break"></div>
                    <hr style="width: 100%;" class="styled">

                    <div class="bugscontent">
                        <?php echo $resolving; ?>
                    </div>
                </div>
            </div>
            
            <div class="break"></div>

            <div class="card depthFX">
                <div class="bpCategoryHead">
                    <div class="neuH">Devs Resolved</div>
                    <div class="searchWParam">
                        <div class="neuL">
                            <select name='param'>
                                <option value='' disabled selected>Search Location</option>
                                <option value='id'>ID</option>
                                <option value='title'>Title</option>
                                <option value='description'>Description</option>
                                <option value='author'>Author</option>
                            </select>
                        </div>
                        <div class="field">
                            <input onkeyup="searchResolved(this)" name="search" type="text" placeholder="Search"/>
                        </div>
                    </div>
                    <div class="break"></div>
                    <hr style="width: 100%;" class="styled">

                    <div class="bugscontent">
                        <?php echo $resolved; ?>
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

<?php include('include/footer.php'); ?>