<?php

require($_SERVER['DOCUMENT_ROOT'].'/secure/DBCalls/ConDB_call.php');

class indexCall
{
    public function WelcomeFunc()
    {
        if (isset($_SESSION['username']))
        {
            $userCheck = $_SESSION['username'];

            if ($userCheck!= null)
            {
                echo "<a style='position: absolute; left: 75%; top: 1%; color: deepskyblue;' href='personal_scene.php'>Hi! " . $_SESSION['username']."</a>";
            }
        }
        else
        {
            echo "<p style='position: absolute; left: 75%; top: 1%; color: blueviolet; '>Welcome!</p>";
        }
    }

    public function rendFunc() //this function renders comments, this way this can be used at any page by just calling the class
    {
        $callClass = new ConDBFrameuser();

        if (isset($_SESSION['username']))
        {
            $userCheck = $_SESSION['username'];

            if ($userCheck!= null)
            {

               echo" <div id='callcomments' class='callcomments' name='callcomments'>"; //no need to worry about style because the div already exists in the MainStyle.css
                    $callClass-> ReadFromCommentsTable();

               echo"     </br>
                </div>


                <form id='commentSubmit' class='commentSubmit' name='commentSubmit' method='POST'>
                    <textarea class='cmt' id='cmt' name='cmt' placeholder='Feel free to shout'></textarea> </br>
                    </br>
                    <input type='submit' class='post' id='post' value='Fus-Roh-Dah!' name='submit'> </br>";

                if(isset($_POST['submit']))   $callClass->WriteToCommentsTable();
                echo "</form>";

             }
        }
        else
            echo "<p style='position: absolute; left: 43%; top: 20% '>Please Sign In to see comments!</p>";

    }


}
