<?php

include($_SERVER['DOCUMENT_ROOT'].'/secure/calls/forumium_call.php');

session_start();

$class1 = new forumCall();
$class1 ->WelcomeFunc();

?>

<html>

    <head>
        <link href="CSS/MainStyle.css" rel="stylesheet">
        <link href="CSS/carbon.css" rel="stylesheet">
        <link rel="shortcut icon" href="Images/title-img.ico" /> <!--Replace this part with your own logo or symbol-->
    </head>

    <title> Forum Post </title>

    <body>

    <!-- Sidenav (hidden by default) -->
    <nav class="w3-sidenav w3-card-2 w3-top w3-medium w3-animate-top" id="mySidenav">

        <a href="index_scene.php" onclick="w3_close()">Home</a>
        <a href="about_scene.php" onclick="w3_close()">About</a>
        <a href="forum_scene.php" onclick="w3_close()">Forum</a>
        <?php if (isset($_SESSION['username'])!= null){ echo "<a href=\"Profile_Search_scene.php\" onclick=\"w3_close()\">Profiles</a>";}?>
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


    <strong> Forum</strong>

    <div class="postView" id="postView">
        <?php echo "<h5>".$_GET['name']."</h5>"; ?>
        <?php $class1->displayPost();  ?>
        <?php $class1->rendFuncPost(); ?>
    </div>
    <a class="gear" id="gear" name="gear" href="user_settings_scene.php">⚙</a>



    <!-- End page content -->

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
