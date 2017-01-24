<?php

    include($_SERVER['DOCUMENT_ROOT'].'/secure/calls/index_call.php');

    session_start();

    $class1 = new indexCall();
    $class1 ->SomeFunc();

?>

<html>

    <head>
        <link href="CSS/MainStyle.css" rel="stylesheet">
        <link href="CSS/carbon.css" rel="stylesheet">
    </head>

    <body>

        <!-- Sidenav (hidden by default) -->
        <nav class="w3-sidenav w3-card-2 w3-top w3-xlarge w3-animate-left" style="display:none;z-index:2;width:40%;min-width:300px" id="mySidenav">
            <a href="javascript:void(0)" onclick="w3_close()"
               class="w3-closenav">Close</a>
            <a href="#food" onclick="w3_close()">Gallery</a>
            <a href="#about" onclick="w3_close()">About</a>
            <a href="signup_scene.php" onclick="w3_close()">Sign Up</a>
            <a href="signin_scene.php" onclick="w3_close()">Sign In</a>
            <a href="signout_scene.php" onclick="w3_close()">Sign Out</a>
        </nav>

        <!-- Top menu -->
        <div class="w3-top">
            <div class="w3-white w3-xlarge w3-padding-xlarge" style="max-width:1200px;margin:auto">
                <div class="w3-opennav w3-left w3-hover-text-grey" onclick="w3_open()">☰</div>
                <div class="w3-center">Gallery</div>
            </div>
        </div>

        <!-- !PAGE CONTENT! -->
        <div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">

        <strong > You can use this page as your like</strong>

            <!-- End page content -->
        </div>

        <script>
            // Script to open and close sidenav
            function w3_open() {
                document.getElementById("mySidenav").style.display = "block";
            }

            function w3_close() {
                document.getElementById("mySidenav").style.display = "none";
            }
        </script>

        <div id="callcomments" class="callcomments" name="callcomments">
            <?php $class1-> callComments();?>
        </div>


        <form id="commentSubmit" class="commentSubmit" name="commentSubmit" method="POST">
            <input type="text" class="cmt" id="cmt" name="cmt" placeholder="Please type a comment"> </br>
            </br>
            <input type="submit" class="post" id="post" value="Post" name="submit"> </br>

            <?php if(isset($_POST['submit']))   $class1->insertComments();  ?>
        </form>

    </body>

</html>
