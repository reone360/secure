<?php

class ProfileSearchCall
{
    public function WelcomeFunc()
    {
        if (isset($_SESSION['username']))
        {
            $userCheck = $_SESSION['username'];

            if ($userCheck!= null)
            {
                echo "<a style='position: absolute; left: 75%; top: 1%; color: deepskyblue;' href='personal_scene.php'>Hi! " . $_SESSION['username']."</a>";
            }
        }
        else
        {
            echo "<p style='position: absolute; left: 75%; top: 1%; color: blueviolet; '>Welcome!</p>";
        }
    }

    public function SearchProfile()
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
                $this->ListProfiles($Pruser);
            }
            else
            {
                //echo "Error: " . $sql . "<br>" . $conn->error;
                echo "<p style='color:red; position: absolute; left: 29.5%; top: 250px; '> User not found, please try again</p>";

            }

            $conn->close();

        }
    }

    private function ListProfiles($PrUser)
    {
        foreach ($PrUser as $value)
        {
            echo "</br><a id='PrUSer' class='PrUser' name='PrUser' href='Profile_Search_scene.php?PrName=".$value."'>Username: ".$value." </a> </br>";
        }

    }

    public function ProfileView()
    {
        $profile = $_GET['PrName'];
        $this->structureCmt($profile);
        $this->WriteToProfile($profile);

    }

    private function structureCmt($profile)
    {
        echo" <div id='callPcomments' class='callPcomments' name='callPcomments'>"; //no need to worry about style because the div already exists in the MainStyle.css
        $this->ReadFromProfile($profile);

        echo"   </br>
                </div>";
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

    public function createPost($profile)
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

    public function ReadFromProfile($profile)
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
}
