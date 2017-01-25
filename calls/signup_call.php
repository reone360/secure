<?php

class signUp
{
    public function SignUpFunc()
    {
        echo "<meta http-equiv=\"refresh\" content=\"3;url=http://localhost/secure/\" />";
    }

    public function FormGen()//an example of renderer(for all those java servlets nabs coming over)
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
                echo "Account created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
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

        if ($pass != $passConfirm)
        {
            echo "Passwords don't match";
        }
        else
        {
            $pass_encrypted = crypt($pass, '$2a$09$tryingtoblowtheblowfish$');
            $temp->SignUpFunc();
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