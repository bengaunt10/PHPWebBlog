<?php
session_start();
$servername = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "ecs417";
// Creates connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Checks connection
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
}
 if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title=$_POST["Title"];
    $text=$_POST["text"];
    $user=$_SESSION['name'];
    $date = date("Y/m/d");
    $time = date("h:i:sa");

     $sql = "INSERT INTO BLOG (user,title,info,date,time)
    VALUES ('$user', '$title', '$text', '$date','$time')";
    if ($conn->query($sql) === TRUE) {
        header("Location:blog_view.php");
        exit();

    } else {
        header("Location:add_post.php");
        exit();
    }
 $conn->close();
 }
 else{
    header("Location:add_post.php");
    exit();
   }
 ?>