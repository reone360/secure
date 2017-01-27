<?php

class testCall
{
    public function chat()
    {
        //Creates a new chat room==========================================================================
        echo "<form method='POST'>
               <input type='text' id='rname' class='rname' name='rname' placeholder='Enter room name'>
               <input type='submit' id='crroom' class='crroom' name='crroom' value='Create Room'>";

        if(isset($_POST['crroom']))   $this->crRoom();
        echo "</form>";

        //Loads a previously created chatroom==============================================================
        echo "<form method='POST'>
               <input type='text' id='rname' class='rname' name='rname' placeholder='Enter room name'>
               <input type='submit' id='crroom' class='crroom' name='loadroom' value='Load Room'>";

        if(isset($_POST['loadroom']))   $this->rendFunc();
        echo "</form>";

        //Deletes a chatroom================================================================================
        echo "<form method='POST'>
               <input type='text' id='rname' class='rname' name='rname' placeholder='Enter room name'>
               <input type='submit' id='crroom' class='crroom' name='rmroom' value='Delete Room'>";

        if(isset($_POST['rmroom']))   $this->rmRoom();
        echo "</form>";
    }

    public function crRoom()//creates a chatroom
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "chatdb";

        $Rname= $_POST['rname'];

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // sql to create table
        $sql = "CREATE TABLE ".$Rname."(
        cid INT(100) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(20),
        comment TINYTEXT,
        timing TEXT(100)
        )";

        if ($conn->query($sql) === TRUE) {
            echo "Room created successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }

        $conn->close();
    }

    public function rmRoom() //Deletes a chatroom
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "chatdb";

        $Rname= $_POST['rname'];

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // sql to create table
        $sql = "DROP TABLE IF EXISTS ".$Rname."";

        if ($conn->query($sql) === TRUE) {
            echo "Room removed successfully";
        } else {
            echo "Error creating table: " . $conn->error;
        }

        $conn->close();
    }

    public function rendFunc() //this function renders comments, this way this can be used at any page by just calling the class
    {
        if (isset($_SESSION['username']))
        {
            $userCheck = $_SESSION['username'];

            if ($userCheck!= null)
            {

                echo" <div id='callcomments' class='callcomments' name='callcomments'>"; //no need to worry about style because the div already exists in the MainStyle.css
                $this-> callComments();

                echo"     </br>
                </div>


                <form id='commentSubmit' class='commentSubmit' name='commentSubmit' method='POST'>
                    <textarea class='cmt' id='cmt' name='cmt' placeholder='Please type a comment'></textarea> </br>
                    </br>
                    <input type='submit' class='post' id='post' value='Post' name='submit'> </br>";

                if(isset($_POST['submit']))   $this->insertComments();
                echo "</form>";

            }
        }
        else
            echo "<p style='position: absolute; left: 43%; top: 20% '>Please Sign In to see comments!</p>";

    }


    public function insertComments() //stores comments to db
    {
        //error_reporting(0); //Uncomment this to hide notice reports on Live server, else leave it commented for develop

        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "chatdb";
        $table = $_POST['rname'];

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
            $sql = "INSERT INTO $table (username,comment, timing )VALUES ('$user','$commentTxt', '$date')";

            if ($conn->query($sql) === TRUE) {
                echo "<p style='color: orange; position: absolute; left: 43%; top: 90% '>Comment Posted Successfully</p>";
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


    public function callComments() //calls the comments to page
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "chatdb";
        $table = $_POST['rname'];


        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
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


}