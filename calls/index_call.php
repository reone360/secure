<?php

class indexCall
{
    public function SomeFunc()
    {
        if (isset($_SESSION['username']))
        {
            $userCheck = $_SESSION['username'];

            if ($userCheck!= null)
            {
                echo "<p style='position: absolute; left: 75%; top: 12% '>Hi! " . $_SESSION['username']."</p>";
            }
        }
        else
        {
            echo "<p style='position: absolute; left: 75%; top: 12% '>Welcome!</p>";
        }
    }


    public function insertComments() //stores comments to db
    {
        //error_reporting(0); //Uncomment this to hide notice reports on Live server, else leave it commented for develop

        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "frameusers";
        $table = "comments";

        $commentTxt = $_POST['cmt'];
        $user = $_SESSION['username'];

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
        else
        {
            $sql = "INSERT INTO $table (comment, username)VALUES ('$commentTxt','$user')";

            if ($conn->query($sql) === TRUE) {
                echo "Comment Added";
            } else {
                //echo "Error: " . $sql . "<br>" . $conn->error;
                echo "Comment was not added, if the problem persists please contact us";
            }

            $conn->close();
            //echo "Connected successfully";
            echo "<meta http-equiv=\"refresh\" content=\"1;url=http://localhost/secure/\" />";
        }

    }


    public function callComments() //calls the comments to page
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $db = "frameusers";
        $table = "comments";


        // Create connection
        $conn = new mysqli($servername, $username, $password, $db);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } else {
            $sql = "SELECT username, comment FROM $table";
            $result = $conn->query($sql);

            if ($result->num_rows  > 0)
            {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo $row["username"]. " - Commented: " . $row["comment"]. "<br>";
                }

            } else {
                echo "0 results";
            }
            $conn->close();
        }
    }



}
