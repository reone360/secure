<?php

class forumCall
{
    public function WelcomeFunc()
    {
        if (isset($_SESSION['username']))
        {
            $userCheck = $_SESSION['username'];

            if ($userCheck!= null)
            {
                echo "<p style='position: absolute; left: 75%; top: 1% '>Hi! " . $_SESSION['username']."</p>";
            }
        }
        else
        {
            echo "<p style='position: absolute; left: 75%; top: 1% '>Welcome!</p>";
        }
    }

    //Display functions for forum, posts and replies ================================================================

    public function displayForum()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";

        $db = "forumdb";

        $table = "forum";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        else
        {
            $sql = "SELECT * FROM $table";
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {
                // output data of each row
                while ($row = $result->fetch_assoc())
                {
                    $frid = $row["forum_id"];

                    echo "<a style='color:greenyellow;' href='".$this->previewForum($frid)."'>" . $row["forum_id"] . " -Title:  " . $row["forum_name"] . " -Description: ".$row["forum_desc"]." </a> <br>";
                    //echo "</br>";
                }
            }
            else
            {
                echo "0 results";
            }
            $conn->close();
        }
    }



    public function previewForum($frid)
    {
        if ($frid==1) echo "bs";
        else echo "nope";
    }

    public function displayPost()
    {

    }

    public function displayReplies()
    {

    }


    //Create functions for forum, posts and replies ====================================================================

    public function createForum()
    {

    }

    public function createPost()
    {

    }

    public function createReply()
    {

    }


}