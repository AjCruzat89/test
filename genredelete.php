<?php
include('connection.php');

$id = $_GET['id'];
mysqli_query($connection, "DELETE FROM genreTBL WHERE id = $id");
header("Location: genre.php");
exit();
?>