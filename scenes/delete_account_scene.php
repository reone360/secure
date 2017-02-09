<?php

include($_SERVER['DOCUMENT_ROOT'].'/secure/calls/delete_account_call.php');

$class1= new DeleteAccountCall();

session_start();

$user = $_SESSION['username'];

$class1->deleteAccount($user);

if(session_destroy())
{
    $class1->redir();
}
?>