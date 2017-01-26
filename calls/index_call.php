<?php

class indexCall
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
                echo "<p style='color: orangered; position: absolute; left: 43%; top: 90% '>Comment Posted Successfully</p>";
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
            echo "<p style='color: orangered; position: absolute; left: 40%; top: 90% '>Please enter a comment first before posting</p>";;
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
            $sql = "SELECT cid, username, comment, timing FROM $table ORDER BY cid DESC";
            $result = $conn->query($sql);

            if ($result->num_rows  > 0)
            {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<p style='color:greenyellow;'>" . $row["username"]. " - Commented @ ".$row["timing"]." : </p>" . $row["comment"]. "<br><br>";
                    echo "</br>";
                }

            } else {
                echo "0 results";
            }
            $conn->close();
        }
    }



}
