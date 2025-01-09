<?php
session_start();
if (isset($_SESSION['email'])){
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
          $title_replace = $_POST["replace_title"]  ;
          $text_replace = $_POST["replace_text"]  ;
    }
    else{
        $title_replace = "";
        $text_replace = "";
    }
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
            <h1 class="title"><?php echo "Hi ". $_SESSION['name'];?></h1>
            <h2 style="color:white; text-align:center;">Submit a post below to add to the blog</h2>

            <form id="post_form" method="POST" action="log_entry.php">
                <input class="post_form_input" type="text" id="post_title" name="Title" placeholder="Enter Title" maxlength="20" value=<?php echo $title_replace ?>>
                <input class="post_form_input" type="text" style="padding:30px;"id="text" name="text" placeholder="Enter text" value=<?php echo $text_replace ?>>
                <div class="buttons">
                    <input class="button" id="submit_button" type="submit" value="Add Post" onclick="check_empty()">
                    <button id="clear" class="button" type="button" onclick="clear_button()">Clear</button>
                </div>
            </form>
            <form action='blog_preview.php' id="previewForm" method="POST">
                <input type="hidden" name="preview_title" id="preview_post_title" value="">
                <input type="hidden" name="preview_text" id="preview_post_text" value="">
            </form>
            <input type="button" class="button" id="add_post_button" onclick="get_preview()" value="Preview"/>

        </main>
        <footer class="layout_footer">Ben Gaunt 2023 &copy</footer>

 
 
    </body>
</html>

<?php
}
else{
    header("Location: login.html");
    exit();
}