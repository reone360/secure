<?php

class signUp
{
    public function SignUpFunc()
    {
        echo "<meta http-equiv=\"refresh\" content=\"3;url=http://localhost/secure/\" />";
    }

    public function FormGen()//an example of renderer(for all those java servlets nabs coming over :P)
    {
        echo "<input type='text'>";
    }

    public function StoreDetails($user, $pass) //Stores the user account details in the db
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
            $sql = "INSERT INTO $table (pid, username, password)VALUES ('4', '$user', '$pass')";

            if ($conn->query($sql) === TRUE) {
                echo "<p style='color:greenyellow; position: absolute; left: 41%; top: 65% '>Account created successfully</p>";
                $this->SignUpFunc();

            } else {
                //echo "Error: " . $sql . "<br>" . $conn->error; //enable this for develop
                echo "<p style='color:mediumvioletred; position: absolute; left: 43%; top: 65% '>Username already exists</p>";
            }

            $conn->close();

            //echo "Connected successfully";
        }
    }

    public function ValConfirmPass() //this is used to confirm that the password matches both fields before procceeding
    {
        $pass = $_POST['pass'];
        $passConfirm = $_POST['passcon'];
        $user = $_POST['user'];

        $temp = new signUp();

        if (($user ==null) || ($pass ==null))
        {
            echo "<p style='color:orangered; position: absolute; left: 41%; top: 65% '>Username and password are mandatory</p>";
        }
        else if ($pass != $passConfirm)
        {
            echo "<p style='color:orangered; position: absolute; left: 41%; top: 65% '>Passwords don't match</p>";
        }
        else
        {
            $pass_encrypted = crypt($pass, '$2a$09$tryingtoblowtheblowfish$');
            $temp->StoreDetails($user,$pass_encrypted);

        }
    }

    public function connect() //you can use this function to test connectivity to the db
    {
        $servername = "localhost";
        $username = "root";
        $password = "";

        // Create connection
        $conn = new mysqli($servername, $username, $password);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        echo "Connected successfully";
    }
}

?>