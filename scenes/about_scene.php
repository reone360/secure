<?php
    include($_SERVER['DOCUMENT_ROOT'].'/secure/calls/about_call.php');

    session_start();
    $class = new aboutus();
    $class->WelcomeFunc();
?>

<html>

    <head>
        <link href="CSS/MainStyle.css" rel="stylesheet">
        <link href="CSS/carbon.css" rel="stylesheet">
    </head>

    <body>

        <!-- Sidenav (hidden by default) -->
        <nav class="w3-sidenav w3-card-2 w3-top w3-medium w3-animate-top" id="mySidenav">

            <a href="index_scene.php" onclick="w3_close()">Home</a>
            <a href="about_scene.php" onclick="w3_close()">About</a>
            <a href="forum_scene.php" onclick="w3_close()">Forum</a>
            <?php if (isset($_SESSION['username'])== null){ echo "<a href=\"signup_scene.php\" onclick=\"w3_close()\">Sign Up</a>";}?>
            <?php if (isset($_SESSION['username'])== null){ echo "<a href=\"signin_scene.php\" onclick=\"w3_close()\">Sign In</a>";}?>
            <?php if (isset($_SESSION['username'])!= null){ echo "<a href=\"signout_scene.php\" onclick=\"w3_close()\">Sign Out</a>";}?>
            <a href="javascript:void(0)" onclick="w3_close()"
               class="w3-closenav">Close</a>

        </nav>

        <!-- Top menu -->
        <div class="w3-top">

            <div class="w3-opennav w3-left w3-hover-text-grey" onclick="w3_open()">☰</div>

        </div>

        <div class="about" id="about">
            <p>This Framework was developed by ReoSoftWorks</p>
            <p>Any more info about it can be requested at spyros360reo@gmail.com</p>
            <p>Thank you for your support!</p>
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


    </body>

</html>