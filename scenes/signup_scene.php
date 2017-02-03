<?php

include($_SERVER['DOCUMENT_ROOT'].'/secure/calls/signup_call.php');



$class1 = new signUp();
//$class1 ->SignUpFunc();

//$jan ="hi";
//$das ="pass";

//$class1->StoreDetails($jan, $das);

?>


<html>

    <head>
        <link href="CSS/MainStyle.css" rel="stylesheet">
        <link href="CSS/carbon.css" rel="stylesheet">
        <link rel="shortcut icon" href="Images/title-img.ico" /> <!--Replace this part with your own logo or symbol-->
    </head>

    <title> Sign Up</title>

    <body>

        <!-- Sidenav (hidden by default) -->
        <nav class="w3-sidenav w3-card-2 w3-top w3-medium w3-animate-top" id="mySidenav">

            <a href="index_scene.php" onclick="w3_close()">Home</a>
            <a href="about_scene.php" onclick="w3_close()">About</a>
            <a href="forum_scene.php" onclick="w3_close()">Forum</a>
            <a href="signin_scene.php" onclick="w3_close()">Sign In</a>
            <?php if (isset($_SESSION['username'])!= null){ echo "<a href=\"signout_scene.php\" onclick=\"w3_close()\">Sign Out</a>";}?>
            <a href="javascript:void(0)" onclick="w3_close()"
               class="w3-closenav">Close</a>

        </nav>

        <div class="w3-opennav w3-top w3-hover-text-grey" onclick="w3_open()">☰</div>

        <div>
            <h1 class="signupH1"> Use the following form to Sign Up</h1>
        </div>

        <form id="signupForm" class="signupForm" name="signupForm" method="POST">

            <input type="text" class="inpUser" id="username" name="user" placeholder="Your username"> </br>
            </br>
            <input type="password" class="inpPass" id="pass" name="pass" placeholder="Your password"> </br>
            </br>
            <input type="password" class="inpConfirmPass" id="passcon" name="passcon" placeholder="Confirm your password"> </br>
            <input type="submit" class="submit" id="submit" value="Sign Up" name="submit"> </br>

            <?php if(isset($_POST['submit']))   $class1->ValConfirmPass()  ?>
            <p id="CheckPassWordMatch"></p>
        </form>


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