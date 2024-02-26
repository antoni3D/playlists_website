<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="savedStyle.css">
    <title>Spotify_generator_saved</title>
</head>
<body>
    <?php include 'database_conn.php';?>
    <!-- Header - najwyzszy blok (zawiera nagłówek oraz oraz elementy graficzne) -->
    <header id="header" class="colorChange">
        <img src="sunt.png" alt="slonce">
        <h2>Search : </h2>
        <h1>Saved Playlists</h1>
        <img src="starssprite.png" alt="" class="RightIcons" id="BlockerStars">
        <img src="max.png" alt=""class="RightIcons">
        <img src="min.png" alt=""class="RightIcons">
        <img src="cross.png" alt=""class="RightIcons">
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
        <?php
        if( isset($_SESSION['id'])){
            $sql_playlist = "SELECT * FROM playlists WHERE user_id LIKE ". $_SESSION['id'];  
            foreach ($conn->query($sql_playlist) as $playlist) { 
                $sql_song = "SELECT * from song WHERE id IN (SELECT song_id FROM playlist_song WHERE playlist_id LIKE '".$playlist['id']."')";
                echo '<section class="Playlist"> <section class="cover">'.$playlist['playlist_name'].'</section> <section class="tracks">';
                foreach ($conn->query($sql_song) as $song) { 
                    $cover_art_path = "cover_arts/tmp" .$song['album'].".jpg";  
                    echo '<section class="track"><img src="'.$cover_art_path.'" alt=""><p>'.$song['title'].' </p></section>'; 
                } 
                echo '</section><form class="controls" method="post" action="Saved.php"> <input type="text" value="'.$playlist['id'].'" name="id" readonly> <button>Export</button> <input type="submit" value="Delete" name="sub"> </form> </section>'; 
                } 


                if(isset($_POST['sub']))  
                {   
                  $id = $_POST['id'];
                  $sql= $conn->prepare("DELETE FROM playlist_song WHERE playlist_id LIKE :id ;");
                  $sql->bindValue(':id', $id, PDO::PARAM_STR);
                  $sql->execute();

                  $sql= $conn->prepare("DELETE FROM playlists WHERE id LIKE :id;");
                  $sql->bindValue(':id', $id, PDO::PARAM_STR);
                  $sql->execute();

                  header("Refresh:0");
                  echo "<script>alert('Playlist deleted'); </script>";

                }  
            }  
            ?>
    </main>
</body>
</html>