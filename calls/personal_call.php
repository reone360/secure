<?php
require($_SERVER['DOCUMENT_ROOT'].'/secure/DBCalls/ConDB_call.php');

class personalCall
{
    public function WelcomeFunc()
    {
        if (isset($_SESSION['username']))
        {
            $userCheck = $_SESSION['username'];

            if ($userCheck!= null)
            {
                echo "<a style='position: absolute; left: 75%; top: 1%; color: deepskyblue;' href=''>Hi! " . $_SESSION['username']."</a>";
            }
        }
        else
        {
            echo "<p style='position: absolute; left: 75%; top: 1%; color: blueviolet; '>Welcome!</p>";
        }
    }


    public function rendFunc() //this function renders comments, this way this can be used at any page by just calling the class
    {
        $CallClass = new ConDBFrameuser();

        if (isset($_SESSION['username']))
        {
            $userCheck = $_SESSION['username'];

            if ($userCheck!= null)
            {

                echo" <div id='callPcomments' class='callPcomments' name='callPcomments'>"; //no need to worry about style because the div already exists in the MainStyle.css
                $CallClass-> ReadFromPCommentsTable();

                echo"     </br>
                </div>


                <form id='commentSubmit' class='commentSubmit' name='commentSubmit' method='POST'>
                    <textarea class='Pcmt' id='Pcmt' name='Pcmt' placeholder='Feel free to shout'></textarea> </br>
                    </br>
                    <input type='submit' class='Ppost' id='Ppost' value='Write-o!' name='Psubmit'> </br>";

                if(isset($_POST['Psubmit']))   $CallClass->WriteToPCommentsTable();
                echo "</form>";

            }
        }
        else
            echo "<p style='position: absolute; left: 43%; top: 20% '>Please Sign In to see user comments!</p>";

    }

    public function UploadImg()
    {
        $user     = $_SESSION['username'];
        $filename = $_POST['pic'];
        $datetime = new DateTime();

        $filedir = $_SERVER['DOCUMENT_ROOT']."/scenes/Images/UserGallery/jontest";

        if (file_exists('/secure/scenes/Images/UserGallery/jontest/'))
        {
            echo "well this is awkward";
        }
        else
        {
            echo "No such thing exists";
        }

    }
}