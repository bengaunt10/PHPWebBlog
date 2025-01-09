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
            <h1 class="title">Blog Preview</h1>
            <form action='add_post.php' method="POST">
                <input type="hidden" name="replace_title" value=<?php echo $_POST["preview_title"]; ?>>
                <input type="hidden" name="replace_text" value=<?php echo $_POST["preview_text"];?>>
                <input type="submit"class="button" id="edit_button" value="Edit"/>
            </form>
            <form action="log_entry.php" method="POST">
                <input type="hidden" name="Title" value = <?php echo $_POST["preview_title"];?>>
                <input type="hidden" name="text" value = <?php echo $_POST["preview_text"];?>>
                <input type="submit"class="button" id="post_preview_button" value="Post"/>
            </form>
            <?php              
                $blog_list = array();
                $divName = "blog_post";
                $dateID = "date";
                $textp = "textp";
                $date = date("Y/m/d");
                $time = date("h:i:sa");
                $title=$_POST["preview_title"];
                $text=$_POST["preview_text"];
                echo "<div id='$divName'>";
                echo "<p id='$dateID'>" ."posted on: ". $date ." at: ".$time. "</p>";
                echo "<h2>" .$title . "</h2>";
                echo "<p id='$textp'>" . $text . "</p>";       
                echo "</div>"; 

                $sql = "SELECT * FROM BLOG ORDER BY ID ASC";
                $result = $conn->query($sql);
               /// if ($result->num_rows > 0) {

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
                    echo "<p id='$dateID'>" ."posted on: ". $item['date'] ." at: ". $item['time']. "</p>";
                    echo "<h2>" . $item['title'] . "</h2>";
                    echo "<p id='$textp'>" . $item['text'] . "</p>";       
                    echo "</div>"; 
                    }
            ?>
        </main>

 
 
    </body>
</html>