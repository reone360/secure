<?php
echo"bs";

$url = isset($_SERVER['PATH_INFO']) ? explode('/', ltrim($_SERVER['PATH_INFO'],'/')) : '/';

if ($url == '/')
{
    header('Location: scenes/index_scene.php');
}
