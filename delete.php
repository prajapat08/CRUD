<?php
 
include("config.php");
 
$id = $_GET['id'];
 
$result = mysqli_query($connection, "DELETE FROM users WHERE id=$id");
 
header("Location:index.php");
?>