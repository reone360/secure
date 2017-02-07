<?php
require($_SERVER['DOCUMENT_ROOT'].'/secure/DBCalls/ConDB_call.php');


class UserSettingsCall
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


    public function CheckChanges() //Checks for changes made, if any
    {
        $oldPass=$_POST['OldPass'];
        $newPass=$_POST['NewPass'];
        $confPass=$_POST['changePass'];

        $oldMail=$_POST['OldMail'];
        $newMail=$_POST['NewMail'];
        $confMail=$_POST['changeMail'];

        //Checks for password changes
        if (($oldPass != null) && ($newPass == null))
        {
            echo "<p class='chagnesMsg'>Please fill the new password field before proceeding!</p>";
        }
        else if (($newPass != null) && ($confPass == null))
        {
            echo "<p class='chagnesMsg'>Please fill the confirm password field before proceeding!</p>";
        }
        else if (($oldPass != null) && ($newPass != null))
        {
            if($newPass == $confPass)
            {
                //Do Actions here if passwords match
            }
            else if($oldPass == $newPass)
            {
                echo "<p class='chagnesMsg'>Please choose another password for your new one</p>";
            }
            else
            {
                echo "<p class='chagnesMsg'>The Passwords don't match!</p>";
            }
        }

        //Checks for email changes
        if (($oldMail != null) && ($newMail== null))
        {
            echo "<p class='chagnesMsg'>Please fill the new mail field before proceeding!</p>";
        }
        else if (($newMail != null) && ($confMail == null))
        {
            echo "<p class='chagnesMsg'>Please fill the confirm new email field before proceeding!</p>";
        }
        else if (($oldMail != null) && ($newMail != null))
        {
            if($newMail == $confMail)
            {
                //Do Actions here if passwords match
            }
            else if($oldMail == $newMail)
            {
                echo "<p class='chagnesMsg'>Please choose another email for your new one</p>";
            }
            else
            {
                echo "<p class='chagnesMsg'>The emails don't match!</p>";
            }
        }

    }

}