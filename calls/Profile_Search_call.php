<?php
require($_SERVER['DOCUMENT_ROOT'].'/secure/DBCalls/ConDB_call.php');

class ProfileSearchCall
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

    public function SearchProfile()//Searches for Profiles by full name, haven't incorporated char string search yet
    {
        $CallClass = new ConDBFrameuser();

        $CallClass ->SearchProfile();
    }

    public function ListProfiles($PrUser)
    {
        foreach ($PrUser as $value)
        {
            echo "</br><a id='PrUSer' class='PrUser' name='PrUser' href='Profile_Search_scene.php?PrName=" .$value. "'>" .$value. " </a> </br>";
        }

    }

    public function ProfileView()
    {
        $profile = $_GET['PrName'];
        $this->structureCmt($profile);

        $CallClass = new ConDBFrameuser();
        $CallClass->WriteToProfile($profile);

    }

    private function structureCmt($profile)
    {
        $CallClass = new ConDBFrameuser();
        echo" <div id='callPcomments' class='callPcomments' name='callPcomments'>"; //no need to worry about style because the div already exists in the MainStyle.css
        $CallClass->ReadFromProfile($profile);

        echo"   </br>
                </div>";
    }

    public function WriteToProfile($profile)
    {
        $CallClass = new ConDBFrameuser();

        if (isset($_SESSION['username']))
        {
            $userCheck = $_SESSION['username'];

            if ($userCheck!= null)
            {

                echo"

                <form id='postSubmit' class='postSubmit' name='postSubmit' method='POST'>
                    <textarea class='Pcmt' id='Pcmt' name='Pcmt' placeholder='Please write your post here'></textarea> </br>
                    </br>
                    <input type='submit' class='Ppost' id='Ppost' value='Post' name='submit'> </br>";

                if(isset($_POST['submit']))   $CallClass->createPost($profile);
                echo "</form>";

            }

        }
        else
        {
            echo "<p style='position: absolute; color: mediumvioletred'>Please Sign In to create Forum Posts!</p>";
        }
    }


}
