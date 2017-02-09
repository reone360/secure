<?php
require($_SERVER['DOCUMENT_ROOT'].'/secure/DBCalls/ConDB_call.php');


class recoverPassCall
{
    public function CheckChanges() //Checks for changes made, if any
    {
        $CallClass = new ConDBFrameuser();

        $oldPass = $_POST['OldPass'];
        $newPass = $_POST['NewPass'];
        $confPass = $_POST['changePass'];

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
            if ($newPass == $confPass)
            {
                //Do Actions here if passwords match
                $CallClass->changePass($newPass);
            }
            else if ($oldPass == $newPass)
            {
                echo "<p class='chagnesMsg'>Please choose another password for your new one</p>";
            }
            else
            {
                echo "<p class='chagnesMsg'>The Passwords don't match!</p>";
            }
        }
    }

    public function SendVerificationWayToUserMYGODTHISISALONGNAME()
    {
        $CallClass = new ConDBFrameuser();
        $chkusername = $_POST['chkUser'];

        $CallClass->chkUsername($chkusername);
    }

    public function ShowUserForm()
    {
        echo "<form id='usercheck' class='usercheck' name='usercheck' method='POST'>
                <input type='text' class='chkUser' id='chkUser' name='chkUser' placeholder='Enter your username'> </br>
                <input type='submit' id='sendwhatever' class='sendwhatever' name='sendwhatever' value='Send THE USER VERFICATION of your choice'>  ";

        if(isset($_POST['sendwhatever']))   $this->SendVerificationWayToUserMYGODTHISISALONGNAME();

        echo "</form>";
    }

    public function ShowPassForm()
    {
        echo "<form method='POST'>

                <div id='PassChangeRec' class='PassChangeRec' name='PassChage'>
                    <p> We recomend you change your password every 3 months or so</p>
                    <input type='password' id='OldPass' class='OldPass' name='OldPass' placeholder='Current Password'></br>
                    <input type='password' id='NewPass' class='NewPass' name='NewPass' placeholder='New Password'></br>
                    <input type='password' id='changePass' class='changePass' name='changePass' placeholder='Confirm New Password'> </br></br>
                    <input type='submit' id='submitChangeRec' class='submitChangeRec' name='submitChangeRec' value='Save Changes'>";

        if(isset($_POST['submitChangeRec'])) echo "hi?";

        echo "   </div>
              </form>";
    }
}