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


    public function displayForumImp()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";

        $db = "forumdb";

        $table = "forum";

        $count=1;
        $frname=array();
        $frdesc=array();

        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        else
        {
            $sql = "SELECT * FROM $table WHERE sticky='1'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {
                // get data of each row
                while ($row = $result->fetch_assoc())
                {
                    $frname[$count] = $row['forum_name'];
                    $frdesc[$count] = $row['forum_desc'];

                    $count++;
                }

                $this->previewForum($frname, $frdesc);

            }
            else
            {
                echo "0 results";
            }
            $conn->close();
        }
    }

    public function displayForumGen()
    {
        $servername = "localhost";
        $username = "root";
        $password = "";

        $db = "forumdb";

        $table = "forum";

        $count=1;
        $frname=array();
        $frdesc=array();

        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        else
        {
            $sql = "SELECT * FROM $table WHERE sticky='0s'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {
                // get data of each row
                while ($row = $result->fetch_assoc())
                {
                    $frname[$count] = $row['forum_name'];
                    $frdesc[$count] = $row['forum_desc'];

                    $count++;
                }

                $this->previewForum($frname, $frdesc);

            }
            else
            {
                echo "0 results";
            }
            $conn->close();
        }
    }



    public function previewForum($frname, $frdesc)
    {
        foreach (array_combine($frname,$frdesc) as $name=>$desc) //some brilliant piece of code to properly handle 2 arrays at once, but objects won't work and num strings will be converted to integers
        {
            echo "</br><a href='forum_preview_scene.php?name=".$name."'>Title: ".$name." - ".$desc." </a> </br>";
        }

    }

    public function displayPost()
    {
        $forumName = $_GET['name'];

        $servername = "localhost";
        $username = "root";
        $password = "";

        $db = "forumdb";

        $table = "post";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        else
        {
            $sql = "SELECT * FROM $table WHERE forum_name = '$forumName'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {
                // get data of each row
                while ($row = $result->fetch_assoc())
                {
                    if (strpos($row["post_body"], 'https://')!==false)
                    {
                        /*this part checks if a url exists in the chat, the !==false is there on purpose because
                          strpos returns either the offset at which the needle string begins in the haystack string
                          or the boolean false if the needle isn't found.
                        */
                        echo "<p style='color:greenyellow;'>" . $row["post_author"] . " - Posted @ " . $row["timin"] . " : </p>" ."<a href='". $row["post_body"] . "'>".$row["post_body"]."</a><br><br>";
                        echo "</br>";
                    }
                    else if(strpos($row["post_body"], '.com')!==false) //if you want to add more options for link detections you can do it here and keep advancing the else if statements
                    {
                        echo "<p style='color:greenyellow;'>" . $row["post_author"] . " - Posted @ " . $row["timin"] . " : </p>" ."<a href='". $row["post_body"] . "'>".$row["post_body"]."</a><br><br>";
                        echo "</br>";
                    }
                    else
                    {
                        echo "<p style='color:greenyellow;'>" . $row["post_author"] . " - Posted @ " . $row["timin"] . " : </p>" . $row["post_body"] . "<br><br>";
                        echo "</br>";
                    }
                }

            }
            else
            {
                echo "0 results";
            }
            $conn->close();
        }


    }

    //===================================================Create functions for forum, posts and replies ====================================================================

    public function rendFuncPost() //=========================Renders the Post create box========================================
    {
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

                if(isset($_POST['submit']))   $this->createPost();
                echo "</form>";

            }
        }
    }

    public function rendFuncForum() //=========================Renders the forum create box========================================
    {
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

                if(isset($_POST['postFr']))   $this->createForum();
                echo "</form>";

            }
        }
        else
            echo "<p style='position: absolute; left: 43%; top: 20% '>Please Sign In to create Forum Posts!</p>";

    }


    public function createForum()
    {
        //error_reporting(0); //Uncomment this to hide notice reports on Live server, else leave it commented for develop

        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "forumdb";
        $table = "forum";

        $forumName = $_POST['frname'];
        $forumDesc = $_POST['fdesc'];
        $sticky = $_POST['chkSticky'];
        $datetime = new DateTime();

        $date = $datetime->format('d-m-Y H:i');

        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);


        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        else if (!(isset($_SESSION['username'])))
        {
            echo "Please login first";
        }
        else if ($forumName != null)
        {
            $sql = "INSERT INTO $table (forum_name, forum_desc, sticky, timin )VALUES ('$forumName','$forumDesc', '$sticky', '$date')";

            if ($conn->query($sql) === TRUE) {
                echo "<p style='color: orange; position: absolute; left: 43%; top: 90% '>Forum created Successfully</p>";
                echo "<meta http-equiv=\"refresh\" content=\"1;url=http://localhost/secure/scenes/forum_preview_scene.php?name=".$forumName."\" />";
            } else {
                //echo "Error: " . $sql . "<br>" . $conn->error;
                echo "<p style='color: orangered; position: absolute; left: 34%; top: 90% '>Forum was not created successfully, if the problem persists please contact us</p>";
            }

            $conn->close();
            //echo "Connected successfully";
        }
        else
        {
            echo "<p style='color: orangered; position: absolute; left: 40%; top: 90% '>Please enter a title first before posting</p>";
        }
    }

    public function createPost()
    {
        //error_reporting(0); //Uncomment this to hide notice reports on Live server, else leave it commented for develop

        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "forumdb";
        $table = "post";

        $forumName = $_GET['name'];
        $Body = $_POST['postbody'];
        $datetime = new DateTime();

        $user = $_SESSION['username'];
        $date = $datetime->format('d-m-Y H:i');

        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);


        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        else if (!(isset($_SESSION['username'])))
        {
            echo "Please login first";
        }
        else if ($forumName != null)
        {
            $sql = "INSERT INTO $table (post_author, post_body, forum_name, timin)VALUES ('$user', '$Body', '$forumName', '$date')";

            if ($conn->query($sql) === TRUE) {
                echo "<p style='color: orange; position: absolute; left: 43%; top: 90% '>Post created Successfully</p>";
                echo "<meta http-equiv=\"refresh\" content=\"1;url=http://localhost/secure/scenes/forum_preview_scene.php?name=".$forumName."\" />";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
                echo "<p style='color: orangered; position: absolute; left: 34%; top: 90% '>Post was not created successfully, if the problem persists please contact us</p>";
            }

            $conn->close();
            //echo "Connected successfully";
        }
        else
        {
            echo "<p style='color: orangered; position: absolute; left: 40%; top: 90% '>Please enter something before posting</p>";
        }
    }

}