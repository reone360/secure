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
    </head>

    <body>

        <!-- Sidenav (hidden by default) -->
        <nav class="w3-sidenav w3-card-2 w3-top w3-medium w3-animate-top" id="mySidenav">
            <a href="javascript:void(0)" onclick="w3_close()"
               class="w3-closenav">Close</a>
            <a href="index_scene.php" onclick="w3_close()">Home</a>
            <a href="#about" onclick="w3_close()">About</a>
            <a href="signin_scene.php" onclick="w3_close()">Sign In</a>
            <a href="signout_scene.php" onclick="w3_close()">Sign Out</a>
        </nav>

        <div class="w3-opennav w3-top w3-hover-text-grey" onclick="w3_open()">☰</div>

        <div>
            <h1 class="signupH1"> Use the following form to sing in</h1>
        </div>

        <form id="signupForm" class="signupForm" name="signupForm" method="POST">

            <input type="text" class="inp" id="username" name="user" placeholder="Your username"> </br>
            </br>
            <input type="password" class="inp" id="pass" name="pass" placeholder="Your password"> </br>
            </br>
            <input type="password" class="inp" id="passcon" name="passcon" placeholder="Confirm your password"> </br>
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