<?php
require($_SERVER['DOCUMENT_ROOT'].'/secure/DBCalls/ConDB_call.php');

class DeleteAccountCall
{
    public function redir()
    {
        header ('Location: index_scene.php');
    }

    public function deleteAccount($user)//This is just  simple user account remove
    {
        $CallClass = new ConDBFrameuser();

        $CallClass->DelUser($user);
    }

}