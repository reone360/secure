<?php

    include($_SERVER['DOCUMENT_ROOT'].'/secure/calls/index_call.php');

    session_start();

    $class1 = new indexCall();
    $class1 ->WelcomeFunc();

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
            <a href="#about" onclick="w3_close()">About</a>
            <a href="signup_scene.php" onclick="w3_close()">Sign Up</a>
            <a href="signin_scene.php" onclick="w3_close()">Sign In</a>
            <a href="signout_scene.php" onclick="w3_close()">Sign Out</a>
            <a href="javascript:void(0)" onclick="w3_close()"
               class="w3-closenav">Close</a>

        </nav>

        <!-- Top menu -->
        <div class="w3-top">

            <div class="w3-opennav w3-left w3-hover-text-grey" onclick="w3_open()">☰</div>

        </div>


        <strong> Main-Comment Section</strong>

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

        <?php $class1->rendFunc();?> <!--comments-->


    </body>

</html>
