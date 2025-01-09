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
if(isset($_POST['delete_id'])){
    $delete_id = $_POST['delete_id'];
    $sql = "DELETE FROM BLOG WHERE ID=$delete_id";
    if($conn->query($sql) === TRUE){
        header("Location:blog_view.php");
    }
    else{
        echo"error";
    }


}

    $conn->close();
?>