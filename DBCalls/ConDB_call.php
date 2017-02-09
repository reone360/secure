<?php

class ConDBFrameuser
{
    public function ReadFromCommentsTable() //Reads Comments from the table
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "frameusers";
        $table = "comments";

        $conn = new mysqli($servername, $username, $password, $db);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        else
        {
            $sql = "SELECT cid, username, comment, timing FROM $table ORDER BY cid DESC";
            $result = $conn->query($sql);

            if ($result->num_rows  > 0)
            {
                // output data of each row
                while($row = $result->fetch_assoc())
                {
                    if (strpos($row["comment"], 'https://')!==false)
                    {
                        /*this part checks if a url exists in the chat, the !==false is there on purpose because
                          strpos returns either the offset at which the needle string begins in the haystack string
                          or the boolean false if the needle isn't found.
                        */
                        echo "<p style='color:greenyellow;'>" . $row["username"] . " - Commented @ " . $row["timing"] . " : </p>" ."<a href='". $row["comment"] . "'>".$row["comment"]."</a><br><br>";
                        echo "</br>";
                    }
                    else if(strpos($row["comment"], '.com')!==false) //if you want to add more options for link detections you can do it here and keep advancing the else if statements
                    {
                        echo "<p style='color:greenyellow;'>" . $row["username"] . " - Commented @ " . $row["timing"] . " : </p>" ."<a href='http://". $row["comment"] . "'>".$row["comment"]."</a><br><br>";
                        echo "</br>";
                    }
                    else
                    {
                        echo "<p style='color:greenyellow;'>" . $row["username"] . " - Commented @ " . $row["timing"] . " : </p>" . $row["comment"] . "<br><br>";
                        echo "</br>";
                    }
                }

            } else {
                echo "0 results";
            }
            $conn->close();
        }
    }

    public function ReadFromPCommentsTable() //calls the comments to page
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "frameusers";
        $table = "pcomments";

        $user= $_SESSION['username'];

        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $sql = "SELECT * FROM $table WHERE username= '$user' ORDER BY pcid DESC";
            $result = $conn->query($sql);

            if ($result->num_rows  > 0)
            {
                // output data of each row
                while($row = $result->fetch_assoc())
                {
                    if (strpos($row["comment_body"], 'https://')!==false)
                    {
                        /*this part checks if a url exists in the chat, the !==false is there on purpose because
                          strpos returns either the offset at which the needle string begins in the haystack string
                          or the boolean false if the needle isn't found.
                        */
                        echo "<p style='color:greenyellow;'>" . $row["comment_author"] . " - Commented @ " . $row["timin"] . " : </p>" ."<a href='". $row["comment_body"] . "'>".$row["comment_body"]."</a><br><br>";
                        echo "</br>";
                    }
                    else if(strpos($row["comment_body"], '.com')!==false) //if you want to add more options for link detections you can do it here and keep advancing the else if statements
                    {
                        echo "<p style='color:greenyellow;'>" . $row["comment_author"] . " - Commented @ " . $row["timin"] . " : </p>" ."<a href='http://". $row["comment_body"] . "'>".$row["comment_body"]."</a><br><br>";
                        echo "</br>";
                    }
                    else
                    {
                        echo "<p style='color:greenyellow;'>" . $row["comment_author"] . " - Commented @ " . $row["timin"] . " : </p>" . $row["comment_body"] . "<br><br>";
                        echo "</br>";
                    }
                }

            }
            else
            {
                //echo "0 results";
                echo "This user doesn't have comments yet";
            }
            $conn->close();
        }
    }

    public function WriteToCommentsTable() //Inserts comments to Comments Table
    {
        //error_reporting(0); //Uncomment this to hide notice reports on Live server, else leave it commented for develop

        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "frameusers";
        $table = "comments";

        $commentTxt = $_POST['cmt'];
        $user = $_SESSION['username'];
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
        else if ($commentTxt != null)
        {
            $sql = "INSERT INTO $table (comment, username, timing )VALUES ('$commentTxt','$user', '$date')";

            if ($conn->query($sql) === TRUE) {
                echo "<p style='color: orange; position: absolute; left: 45%; top: 90% '>Comment Posted Successfully</p>";
                echo "<meta http-equiv=\"refresh\" content=\"1;url=http://localhost/secure/\" />";
            } else {
                //echo "Error: " . $sql . "<br>" . $conn->error;
                echo "<p style='color: orangered; position: absolute; left: 34%; top: 90% '>Comment was not posted successfully, if the problem persists please contact us</p>";
            }

            $conn->close();
            //echo "Connected successfully";
        }
        else
        {
            echo "<p style='color: orangered; position: absolute; left: 40%; top: 90% '>Please enter a comment first before posting</p>";
        }
    }

    public function WriteToPCommentsTable() //stores comments to db
    {
        //error_reporting(0); //Uncomment this to hide notice reports on Live server, else leave it commented for develop

        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "frameusers";
        $table = "pcomments";

        $commentTxt = $_POST['Pcmt'];
        $user = $_SESSION['username'];
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
        else if ($commentTxt != null)
        {
            $sql = "INSERT INTO $table (comment_body, comment_author, username, timin )VALUES ('$commentTxt', '$user','$user', '$date')";

            if ($conn->query($sql) === TRUE) {
                echo "<p style='color: orange; position: absolute; left: 45%; top: 90% '>Comment Posted Successfully</p>";
                echo "<meta http-equiv=\"refresh\" content=\"1;url=http://localhost/secure/scenes/personal_scene.php\" />";
            } else {
                //echo "Error: " . $sql . "<br>" . $conn->error;
                echo "<p style='color: orangered; position: absolute; left: 34%; top: 90% '>Comment was not posted successfully, if the problem persists please contact us</p>";
            }

            $conn->close();
            //echo "Connected successfully";
        }
        else
        {
            echo "<p style='color: orangered; position: absolute; left: 40%; top: 90% '>Please enter a comment first before posting</p>";
        }
    }


    public function StoreDetailsUserTable($user, $pass, $email) //Stores the user account details in the db
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "frameusers";
        $table = "users";


        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        else
        {
            $sql = "INSERT INTO $table (pid, username, password, email)VALUES ('4', '$user', '$pass', '$email')";

            if ($conn->query($sql) === TRUE) {
                echo "<p style='color:greenyellow; position: absolute; left: 31%; top: 280px; '>Account created successfully</p>";
                echo "<meta http-equiv=\"refresh\" content=\"3;url=http://localhost/secure/\" />";

            } else {
                //echo "Error: " . $sql . "<br>" . $conn->error; //enable this for develop
                echo "<p style='color:mediumvioletred; position: absolute; left: 31%; top: 280px; '>Username already exists</p>";
            }

            $conn->close();

            //echo "Connected successfully";
        }
    }


    public function checkUserLogin($user, $pass) //Validates the user
    {
        $pass_encrypted = crypt($pass, '$2a$09$tryingtoblowtheblowfish$');

        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "frameusers";
        $table = "users";


        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $sql = "SELECT * FROM $table WHERE username='$user' AND password='$pass_encrypted'";
            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if (mysqli_num_rows($result) == 1) {

                $_SESSION['username']= $user;
                echo "<p style='color:greenyellow; position: absolute; left: 32%; top: 250px; '>Sign In successful</p>";
                echo "<meta http-equiv=\"refresh\" content=\"3;url=http://localhost/secure/\" />";
            } else {
                //echo "Error: " . $sql . "<br>" . $conn->error;
                echo "<p style='color:red; position: absolute; left: 29.5%; top: 250px; '> Login unsuccessful, please try again</p>";

            }

            $conn->close();

        }
    }

    public function SearchProfile() //Searches different user's profile
    {
        $SearchResult = $_POST['searchName'];
        $count = 1;
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "frameusers";
        $table = "users";


        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $sql = "SELECT * FROM $table WHERE username='$SearchResult'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {
                // get data of each row
                while ($row = $result->fetch_assoc())
                {
                    $Pruser[$count] = $row['username'];
                    $count++;
                }
                $CallClassBack = new ProfileSearchCall();
                $CallClassBack->ListProfiles($Pruser);
            }
            else
            {
                //echo "Error: " . $sql . "<br>" . $conn->error;
                echo "<p style='color:red; position: absolute; left: 29.5%; top: 250px; '> User not found, please try again</p>";

            }

            $conn->close();

        }
    }

    public function WriteToProfile($profile)
    {
        if (isset($_SESSION['username']))
        {
            $userCheck = $_SESSION['username'];

            if ($userCheck!= null)
            {

                echo"

                <form id='postSubmit' class='postSubmit' name='postSubmit' method='POST'>
                    <textarea class='Pcmt' id='Pcmt' name='Pcmt' placeholder='Please write your post here'></textarea> </br>
                    </br>
                    <input type='submit' class='Ppost' id='Ppost' value='Post' name='submit'> </br>";

                if(isset($_POST['submit']))   $this->createPost($profile);
                echo "</form>";

            }

        }
        else
        {
            echo "<p style='position: absolute; color: mediumvioletred'>Please Sign In to create Forum Posts!</p>";
        }
    }


    public function createPost($profile) //This allows users to write to different user's walls
    {
        //error_reporting(0); //Uncomment this to hide notice reports on Live server, else leave it commented for develop

        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "frameusers";
        $table = "pcomments";

        $cmtBody = $_POST['Pcmt'];
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
        else if ($profile != null)
        {
            $sql = "INSERT INTO $table (comment_body, comment_author, username, timin)VALUES ('$cmtBody', '$user', '$profile', '$date')";

            if ($conn->query($sql) === TRUE) {
                echo "<p style='color: orange; position: absolute; left: 43%; top: 90% '>Post created Successfully</p>";
                echo "<meta http-equiv=\"refresh\" content=\"1;url=http://localhost/secure/scenes/Profile_Search_scene.php?PrName=".$profile."\" />";
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

    public function ReadFromProfile($profile) //This reads from different user's walls
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "frameusers";

        $table = "pcomments";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        else
        {
            $sql = "SELECT * FROM $table WHERE username = '$profile' ORDER BY pcid DESC";
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {
                // get data of each row
                while ($row = $result->fetch_assoc())
                {
                    if (strpos($row["comment_body"], 'https://')!==false)
                    {
                        /*this part checks if a url exists in the chat, the !==false is there on purpose because
                          strpos returns either the offset at which the needle string begins in the haystack string
                          or the boolean false if the needle isn't found.
                        */
                        echo "<p style='color:greenyellow;'>" . $row["comment_author"] . " - Posted @ " . $row["timin"] . " : </p>" ."<a href='". $row["comment_body"] . "'>".$row["comment_body"]."</a><br><br>";
                        echo "</br>";
                    }
                    else if(strpos($row["comment_body"], '.com')!==false) //if you want to add more options for link detections you can do it here and keep advancing the else if statements
                    {
                        echo "<p style='color:greenyellow;'>" . $row["comment_author"] . " - Posted @ " . $row["timin"] . " : </p>" ."<a href='". $row["comment_body"] . "'>".$row["comment_body"]."</a><br><br>";
                        echo "</br>";
                    }
                    else
                    {
                        echo "<p style='color:greenyellow;'>" . $row["comment_author"] . " - Posted @ " . $row["timin"] . " : </p>" . $row["comment_body"] . "<br><br>";
                        echo "</br>";
                    }
                }

            }
            else
            {
                //echo "0 results";
                echo "Be the first the post!";
            }
            $conn->close();
        }
    }

    public function changePass($pass) //Changes the user's password
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "frameusers";
        $table = "users";

        $user = $_SESSION['username'];
        $pass_encrypted = crypt($pass, '$2a$09$tryingtoblowtheblowfish$');

        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        else
        {
            $sql = "UPDATE $table SET password = '$pass_encrypted' WHERE username='$user'";

            if ($conn->query($sql) === TRUE) {
                echo "<p style='color:greenyellow; position: absolute; left: 15%; top: 240px; '>Password Updated Successfully</p>";
                //echo "<meta http-equiv=\"refresh\" content=\"3;url=http://localhost/secure/\" />";

            } else {
                echo "Error: " . $sql . "<br>" . $conn->error; //enable this for develop
                echo "<p style='color:mediumvioletred; position: absolute; left: 15%; top: 240px; '>Password failed to update </p>";
            }

            $conn->close();

            //echo "Connected successfully";
        }
    }

    public function changeMail($mail) //Changes the user's email
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "frameusers";
        $table = "users";

        $user = $_SESSION['username'];

        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        else
        {
            $sql = "UPDATE $table SET email = '$mail' WHERE username='$user'";

            if ($conn->query($sql) === TRUE) {
                echo "<p style='color:greenyellow; position: absolute; left: 15%; top: 510px; '>email updated successfully</p>";
                echo "<meta http-equiv=\"refresh\" content=\"3;url=http://localhost/secure/\" />";

            } else {
                //echo "Error: " . $sql . "<br>" . $conn->error; //enable this for develop
                echo "<p style='color:mediumvioletred; position: absolute; left: 15%; top: 510px; '>email failed to update</p>";
            }

            $conn->close();

            //echo "Connected successfully";
        }
    }

    public function chkUsername($check)
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "frameusers";
        $table = "users";

        $CallClassBack = new recoverPassCall();

        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $sql = "SELECT * FROM $table WHERE username='$check'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0)
            {
                /*
                  Before showing the Password reset form, send some form of token to verify the user,
                  eg. email, security question etc and add before the next step.
                  This was done this way as a mock check for the function to work.
                */
                //$CallClassBack->ShowPassForm();
                echo "Email reset was sent to you";
            }
            else
            {
                //echo "Error: " . $sql . "<br>" . $conn->error;
                echo "<p style='color:red; position: absolute; left: 29.5%; top: 250px; '> User not found, please try again</p>";

            }

            $conn->close();
        }

    }

    public function DelUser($user)
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "frameusers";
        $table = "users";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $sql = "DELETE FROM $table WHERE username='$user'";
            $result = $conn->query($sql);

            if ($result === TRUE) {
                echo "User deleted successfully";
            } else {
                echo "Error deleting record: " . $conn->error;
                echo "<p style='color:red; position: absolute; left: 29.5%; top: 250px; '> User not deleted, please try again</p>";

            }

            $conn->close();
        }

    }

}

class ConDBForumDB
{
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

                $CallClassBack = new forumCall();
                $CallClassBack->previewForum($frname, $frdesc);

            }
            else
            {
                //echo "0 results";
                echo "Be the first the post!";
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

                $CallClassBack = new forumCall();
                $CallClassBack->previewForum($frname, $frdesc);

            }
            else
            {
                //echo "0 results";
                echo "Be the first the post!";
            }
            $conn->close();
        }
    }

    //=========================================================================================

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

    //================================================Posts within the forums are done below this line(no, not the method, just a normal post section)=====================================================

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
                //echo "0 results";
                echo "Be the first the post!";
            }
            $conn->close();
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