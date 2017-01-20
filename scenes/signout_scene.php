<?php

    include($_SERVER['DOCUMENT_ROOT'].'/secure/calls/signout_call.php');

    $class1= new SignOut();

    session_start();
    if(session_destroy())
    {
        $class1->redir();
    }
?>