<?php
require($_SERVER['DOCUMENT_ROOT'].'/secure/DBCalls/ConDB_call.php');

class forumCall
{
    public function WelcomeFunc()
    {
        if (isset($_SESSION['username']))
        {
            $userCheck = $_SESSION['username'];

            if ($userCheck!= null)
            {
                echo "<p style='position: absolute; left: 75%; top: 1%;  color: deepskyblue;'>Hi! " . $_SESSION['username']."</p>";
            }
        }
        else
        {
            echo "<p style='position: absolute; left: 75%; top: 1%; color: blueviolet;'>Welcome!</p>";
        }
    }

    //Display functions for forum, posts and replies ================================================================
    public function displayForumImp()
    {
        $CallClass = new ConDBForumDB();
        $CallClass ->displayForumImp();
    }

    public function displayForumGen()
    {

        $CallClass = new ConDBForumDB();
        $CallClass ->displayForumGen();
    }



    public function previewForum($frname, $frdesc)
    {
        foreach (array_combine($frname,$frdesc) as $name=>$desc) //some brilliant piece of code to properly handle 2 arrays at once, but objects won't work and num strings will be converted to integers
        {
            echo "</br>Title:<a href='forum_preview_scene.php?name=".$name."'> ".$name." - ".$desc." </a> </br>";
        }

    }

    public function displayPost()
    {
        $CallClass = new ConDBForumDB();
        $CallClass ->displayPost();
    }

    //===================================================Create functions for forum, posts and replies ====================================================================

    public function rendFuncPost() //=========================Renders the Post create box========================================
    {
        $CallClass = new ConDBForumDB();

        if (isset($_SESSION['username']))
        {
            $userCheck = $_SESSION['username'];

            if ($userCheck!= null)
            {

                echo"

                <form id='postSubmit' class='postSubmit' name='postSubmit' method='POST'>
                    <textarea class='postbody' id='postbody' name='postbody' placeholder='Please write your post here'></textarea> </br>
                    </br>
                    <input type='submit' class='pst' id='pst' value='Post' name='submit'> </br>";

                if(isset($_POST['submit']))   $CallClass->createPost();
                echo "</form>";

            }

        }
        else
        {
            echo "<p style='position: absolute; color: mediumvioletred'>Please Sign In to create Forum Posts!</p>";
        }
    }

    public function rendFuncForum() //=========================Renders the forum create box========================================
    {
        $CallClass = new ConDBForumDB();

        if (isset($_SESSION['username']))
        {
            $userCheck = $_SESSION['username'];

            if ($userCheck!= null)
            {
                echo"

                <form id='forumSubmit' class='forumSubmit' name='forumSubmit' method='POST'>
                    <input type='text' class='frname' id='frname' name='frname' placeholder='Forum Title'>
                    <input type='checkbox' class='chkSticky' id='chkSticky' name='chkSticky' value= '1' >Make it Sticky</input></br>
                    <textarea class='fdesc' id='fdesc' name='fdesc' placeholder='Forum description'></textarea> </br>
                    </br>
                    <input type='submit' class='postFr' id='postFr' value='Create' name='postFr'> </br>";

                if(isset($_POST['postFr']))   $CallClass->createForum();
                echo "</form>";

            }
        }
        else
            echo "<p style='position: absolute; left: 3%; top: 20% '>Please Sign In to create Forum Posts!</p>";

    }
}