<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'project';

$connection = mysqli_connect($servername, $username, $password, $dbname);

if(!$connection){
    echo "No Connection To Database";
}

?>