<?php

class personalCall
{
    public function WelcomeFunc()
    {
        if (isset($_SESSION['username']))
        {
            $userCheck = $_SESSION['username'];

            if ($userCheck!= null)
            {
                echo "<a style='position: absolute; left: 75%; top: 1%; color: deepskyblue;' href=''>Hi! " . $_SESSION['username']."</a>";
            }
        }
        else
        {
            echo "<p style='position: absolute; left: 75%; top: 1%; color: blueviolet; '>Welcome!</p>";
        }
    }


    public function rendFunc() //this function renders comments, this way this can be used at any page by just calling the class
    {
        if (isset($_SESSION['username']))
        {
            $userCheck = $_SESSION['username'];

            if ($userCheck!= null)
            {

                echo" <div id='callPcomments' class='callPcomments' name='callPcomments'>"; //no need to worry about style because the div already exists in the MainStyle.css
                $this-> callComments();

                echo"     </br>
                </div>


                <form id='commentSubmit' class='commentSubmit' name='commentSubmit' method='POST'>
                    <textarea class='Pcmt' id='Pcmt' name='Pcmt' placeholder='Feel free to shout'></textarea> </br>
                    </br>
                    <input type='submit' class='Ppost' id='Ppost' value='Write-o!' name='Psubmit'> </br>";

                if(isset($_POST['Psubmit']))   $this->insertComments();
                echo "</form>";

            }
        }
        else
            echo "<p style='position: absolute; left: 43%; top: 20% '>Please Sign In to see user comments!</p>";

    }


    public function callComments() //calls the comments to page
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



    public function insertComments() //stores comments to db
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
}