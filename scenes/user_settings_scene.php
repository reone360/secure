<?php

include($_SERVER['DOCUMENT_ROOT'].'/secure/calls/user_settings_call.php');

session_start();

$class1 = new UserSettingsCall();
$class1 ->WelcomeFunc();

?>

<html>

    <head>
        <link href="CSS/MainStyle.css" rel="stylesheet">
        <link href="CSS/carbon.css" rel="stylesheet">
        <link rel="shortcut icon" href="Images/title-img.ico" /> <!--Replace this part with your own logo or symbol-->
    </head>

    <title> Welcome</title>

    <body>

        <!-- Sidenav (hidden by default) -->
        <nav class="w3-sidenav w3-card-2 w3-top w3-medium w3-animate-top" id="mySidenav">

            <a href="index_scene.php" onclick="w3_close()">Home</a>
            <a href="about_scene.php" onclick="w3_close()">About</a>
            <a href="forum_scene.php" onclick="w3_close()">Forum</a>
            <?php if (isset($_SESSION['username'])!= null){ echo "<a href=\"Profile_Search_scene.php\" onclick=\"w3_close()\">Profiles</a>";}?>
            <?php if (isset($_SESSION['username'])== null){ echo "<a href=\"signup_scene.php\" onclick=\"w3_close()\">Sign Up</a>";}?>
            <?php if (isset($_SESSION['username'])== null){ echo "<a href=\"signin_scene.php\" onclick=\"w3_close()\">Log In</a>";}?>
            <?php if (isset($_SESSION['username'])!= null){ echo "<a href=\"signout_scene.php\" onclick=\"w3_close()\">Log Out</a>";}?>

            <a href="javascript:void(0)" onclick="w3_close()"
               class="w3-closenav">Close</a>

        </nav>

        <!-- Top menu -->
        <div class="w3-top">

            <div class="w3-opennav w3-left w3-hover-text-grey" onclick="w3_open()">☰</div>

        </div>


        <strong> Settings Page</strong>
        <a class="gear" id="gear" name="gear" href="user_settings_scene.php">⚙</a>

        <div class="SettingsForm" id="SettingsForm" name="SettingsForm">
            <form method="POST">

                <div id="PassChange" class="PassChange" name="PassChage">
                    <p> We recomend you change your password every 3 months or so</p>
                    <input type="password" id="OldPass" class="OldPass" name="OldPass" placeholder="Current Password"></br>
                    <input type="password" id="NewPass" class="NewPass" name="NewPass" placeholder="New Password"></br>
                    <input type="password" id="changePass" class="changePass" name="changePass" placeholder="Confirm New Password">
                </div>

                <div id="EmailChange" class="EmailChange" name="EmailChange">
                    <p>Changed your email, Let us in on the details</p>
                    <input type="text" id="OldMail" class="OldMail" name="OldMail" placeholder="Your old email"></br>
                    <input type="text" id="NewMail" class="NewMail" name="NewMail" placeholder="New email"></br>
                    <input type="text" id="changeMail" class="changeMail" name="changeMail" placeholder="Confirm new email">
                </div>

                <input type="submit" id="submitChange" class="submitChange" name="submitChange" value="Save All Changes">
                <?php if(isset($_POST['submitChange']))   $class1->CheckChanges(); ?>
            </form>

            <div id="delAccount" class="delAccount" name="delAccount" >
                <p>Delete your account here</p>
                <a style="color: sandybrown;" href="delete_account_scene.php" onclick="return confirm('Are you sure you want to delete your account?')" id="DelAC" class="DelAC" name="DelAC">Delete!</a>
            </div>

        </div>

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