<?php

class aboutus
{
    public function WelcomeFunc()
    {
        if (isset($_SESSION['username']))
        {
            $userCheck = $_SESSION['username'];

            if ($userCheck!= null)
            {
                echo "<p style='position: absolute; left: 75%; top: 1%;  color: deepskyblue;'>Hi! " . $_SESSION['username']."</p>";
            }
        }
        else
        {
            echo "<p style='position: absolute; left: 75%; top: 1%; color: blueviolet;'>Welcome!</p>";
        }
    }
}