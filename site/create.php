<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="createStyle.css">
    <title>Spotify_generator_saved</title>
</head>
<body>
<?php include 'database_conn.php';?>
    <!-- Header - najwyzszy blok (zawiera nagłówek oraz oraz elementy graficzne) -->
    <header id="header" class="colorChange">
        <img src="sunt.png" alt="slonce">
        <h2>Search : </h2>
        <h1>Create Playlist</h1>
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
      <form method="post" action="create.php"> 
        <section id="left_panel">
            <section id="albums">
              <!-- Od tego momentu php wyswietla z bazy -->
              <?php
                $sql_album = "SELECT * FROM album";  
                foreach ($conn->query($sql_album) as $album) { 
                  $sql_song = "SELECT * FROM song WHERE album = (SELECT id FROM album WHERE album_title LIKE '".$album['album_title']."')";
                  echo '<section class="album"> <img src="'.$album['cover_art_path'].'" alt=""> <section class="song">';
                  foreach ($conn->query($sql_song) as $song) {  echo '<p>'.$song['title'].'</p><input type="checkbox" name="techno[]" value="'.$song['id'].'">'; } 
                  echo '</section></section>';
                } 
                
                if(isset($_POST['sub']) && isset($_SESSION['id']))  
                {   
                  $q= $conn->prepare("SELECT MAX( id ) AS max FROM playlists;");
                  $q->execute();
                  $id = $q->fetchColumn();
                  $id = $id + 1;

                  $name = $_POST['content'];
                  $sql = $conn->prepare("INSERT INTO playlists (id,playlist_name,user_id) VALUES (:id,:name,".$_SESSION['id'].")");
                  $sql->bindValue(':name', $name, PDO::PARAM_STR);
                  $sql->bindValue(':id', $id, PDO::PARAM_STR);
                  $sql->execute();

                  $checkbox1=$_POST['techno'];   
                 
                  for ($i=0; $i<sizeof ($checkbox1);$i++) {  
                    $sql = $conn->prepare("INSERT INTO playlist_song (playlist_id,song_id) VALUES (".$id.",".$checkbox1[$i]. ")");     
                    $sql->execute();
                    }  
                    echo "<script>alert('Playlist added'); </script>";

                }    
              ?>
            </section>
        </section>

        <section id="right_panel">
          <section id="SaveClear">
            <input type="text" name="content">
            <script>
              function uncheckAll() {
                document.querySelectorAll('input[type="checkbox"]')
                .forEach(el => el.checked = false);
                }
            </script>
            <button onclick = "uncheckAll()">Clear</button>
            <input type="submit" value="Save" name="sub">
            </section>
        </section>
      </form>
</body>
</html>