<?php

require($_SERVER['DOCUMENT_ROOT'].'/secure/DBCalls/ConDB_call.php');

class signUp
{
    public function ValConfirmPass() //this is used to confirm that the password matches both fields before procceeding
    {

        $callClass = new ConDBFrameuser();

        $pass = $_POST['pass'];
        $passConfirm = $_POST['passcon'];
        $user = $_POST['user'];

        if (($user ==null) || ($pass ==null))
        {
            echo "<p style='color:orangered; position: absolute; left: 28%; top: 250px; '>Username and password are mandatory</p>";
        }
        else if ($pass != $passConfirm)
        {
            echo "<p style='color:orangered; position: absolute; left: 31%; top: 250px; '>Passwords don't match</p>";
        }
        else
        {
            $pass_encrypted = crypt($pass, '$2a$09$tryingtoblowtheblowfish$');
            $callClass->StoreDetailsUserTable($user,$pass_encrypted);

        }
    }

}

?>