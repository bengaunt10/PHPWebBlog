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
/* loop through the database in a for loop, each time a row is found, create a div with the information */

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Portfolio-Homepage</title>
        <link rel="stylesheet" href="css/Styles.css" media="screen and (min-width:769px)">
        <link rel="stylesheet" href="css/Styles_mobile.css" media="screen and (max-width:768px)" >
        <link rel="reset" type="text/css" href="css/reset.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
        <script src="js/validate.js"></script>
    </head>
    <body class="layout">
        <header>
            <h1>Portfolio</h1>
            <nav>
                <a href="index.html"><h2 class="spaced">Home</h2></a> 
                <a href="About.html"><h2 class="spaced">About</h2></a>
                <a href="Skills.html"><h2 class="spaced">Skills</h2></a>
                <a href="Education.html"><h2 class="spaced">Education</h2></a>
                <a href="Projects.html"><h2 class="spaced">Projects</h2></a>

                <a href="blog_view.php"><h2 class="spaced">Blog</h2></a>
            </nav>
        </header>
        
        <main>
        <h1 class="title">Blog posts</h1>
        <?php

            $logged = "logged";
            if (isset($_SESSION['email'])) {
               echo "<p class='$logged' style='color:green;'> Logged in as " . $_SESSION['name']. "</p>";
        ?>
               <form action="logout.php">
                    <input class="top-left" class="button" id="logout_button" type="submit" value="LOGOUT">
                </form>        
        <?php 
               echo "<form action='add_post.php'>";
            }else {
                echo "<p class='$logged' style='color:red;'> No User logged in </p>";
        ?>
                <p class=top-left style="color:red" > Click the add post button to log into your account</p>
        <?php
                echo "<form action='login.html'>";
            }
        ?>
                <input class="button" ID="add_post_button"type="submit" value="ADD POST"/>
            </form>
            <?php              

                $sql = "SELECT * FROM BLOG";
                $result = $conn->query($sql);
                $blog_list = array();
                $divName = "blog_post";
                $dateID = "date";
                $textp = "textp";
                while($row = $result->fetch_assoc()) {
                    $blog_list[] = array(
                        'ID' => $row['ID'],
                        'title' => $row['title'],
                        'text' => $row['info'],
                        'date' => $row['date'],
                        'time' => $row['time']
                    );
                }
                function list_sort($i,$x){
                    if($i['ID'] == $x['ID']){
                        return 0;
                    }
                    return ($i['ID'] < $x['ID']) ? 1 : -1;
                }
                usort($blog_list, 'list_sort');
                    
                foreach ($blog_list as $item){
                   echo "<div id='$divName'>";
                   if (isset($_SESSION['email'])) {
                    ?>
                   <form action='delete.php' method="POST">
                        <?php echo "<input type='hidden' name='delete_id' value='" .$item['ID']."'> "?>
                        <input class="button" ID="delete_post_button" type="submit" value="x"/>
                    </form>
                    <?php
                   }
                    echo "<p id='$dateID'>" ."posted on: ". $item['date'] ." at: ". $item['time']. "</p>";
                    echo "<h2>" . $item['title'] . "</h2>";
                    echo "<p id='$textp'>" . $item['text'] . "</p>";       
                    echo "</div>"; 
                    }
            ?>
        </main>

 
 
    </body>
</html>