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
    $Email=$_POST["Email"];
    $pass=$_POST["Password"];
    $sql = "SELECT * FROM USERS WHERE email='$Email' AND password='$pass'";
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($conn->query($sql))==1){
      $row =mysqli_fetch_assoc($result);
        $_SESSION['email'] = $row['email'];
        $_SESSION['name'] =$row['firstName'];
        header("Location:add_post.php");
        exit();
      }
      else{
        header("location:login.html");
        exit();
      }
    
    $conn->close();
 }
 else{
  header("Location:login.html");
  exit();
 }

 
 
 
?>