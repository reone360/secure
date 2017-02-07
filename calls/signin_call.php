<?php

require($_SERVER['DOCUMENT_ROOT'].'/secure/DBCalls/ConDB_call.php');

class signIn
{
    public function validateUser()
    {
        $pass = $_POST['pass'];
        $user = $_POST['user'];

        $CallClass = new ConDBFrameuser();

        $CallClass ->checkUserLogin($user, $pass);
    }

}