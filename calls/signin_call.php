<?php

class signIn
{
    public function validateUser()
    {
        $pass = $_POST['pass'];
        $user = $_POST['user'];

        $temp = new signIn();

        $temp ->checkUserLogin($user, $pass);
    }

    private function checkUserLogin($user, $pass)
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

}