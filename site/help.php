<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="helpStyle.css">
    <title>Spotify_generator_help</title>
</head>
<body>
<?php include 'database_conn.php';?>
    <!-- Header - najwyzszy blok (zawiera nagłówek oraz oraz elementy graficzne) -->
    <header id="header" class="colorChange">
        <img src="moon.png" alt="slonce">
        <h2>Search : </h2>
        <h1>Help</h1>
        <img src="starssprite.png" alt="" class="RightIcons" id="BlockerStars">
        <img src="max.png" alt="" class="RightIcons">
        <img src="min.png" alt="" class="RightIcons">
        <img src="cross.png" alt="" class="RightIcons">
    </header>

    <!-- Toolbar - blok nad głównym polem (zawiera odnośniki to innych pod-stron ) -->
    <section id="toolbar">
        <button onclick = "window.location.href='Main.php';">main</button>
        <button onclick = "window.location.href='Account.php';">account</button> 
        <button onclick = "window.location.href='Create.php';">create</button> 
        <button onclick = "window.location.href='Saved.php';">saved</button>
        <button onclick = "window.location.href='Help.php';">help</button>  
    </section>

    <!-- Main - główne pole (zawiera lewy oraz prawy pasek) -->
    <main>
        <h2>This site is a passion project</h2>
        <p>It lets u create and browse saved playlists with songs that are put inside my personal database.</p>
        <p>email - Antoni.klimczuk.01@gmail.com</p>
        <p>number - 123456789</p>
        <p>Twitter</p>
        <a href="https://twitter.com/KlimoPimo">https://twitter.com/KlimoPimo</a>
        <p>Youtube</p>
        <a href="https://www.youtube.com/channel/UCGSszx5nHUVpN0e9hFCsPiQ">https://www.youtube.com/channel/UCGSszx5nHUVpN0e9hFCsPiQ</a>
        <form id="comment" method="post">
            <textarea name="content" id="commentArea" cols="50" rows="5">Write your comment here</textarea>
            <input type="submit" name="submit" value="Leave it">
        </form>
        <?php
        if(isset($_POST['submit']) && isset($_SESSION['id']))
        {
	        $textareaValue = trim($_POST['content']);

            $sql = $conn->prepare("INSERT into comments(text, user_id) VALUES (:textvalue,". $_SESSION['id'].")");
            $sql->bindValue(':textvalue', $textareaValue, PDO::PARAM_STR);
            if ($sql->execute()){
                echo "Comment sent";
            } 
            else {
                echo 'Comment not sent ';
            }
        }
        else{
            echo 'log in to leave a comment';
        }
        ?>
 
    </main>
</body>
</html>