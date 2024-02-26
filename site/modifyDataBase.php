<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="modifyDataBaseStyle.css">
    <title>Spotify_generator_admin#1</title>
</head>
<body>
<?php include 'database_conn.php';?>

    <!-- Header - najwyzszy blok (zawiera nagłówek oraz oraz elementy graficzne) -->
    <header id="header" class="colorChange">
        <img src="sunt.png" alt="slonce">
        <h1>Admin panel</h1>
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
      <section id="Forms"> 
      <form action="modifyDataBase.php" class="editForm" name="album_form" method="post">
          <p>Album</p>
          <input type="text" placeholder="Album Title" name="title">
          <input type="date" placeholder="Realese Date" name="date">
          <select id="artist" name="artist_album">
            <?php
                $sql_artist = "SELECT * FROM artist";  
                foreach ($conn->query($sql_artist) as $artist) { 
                  echo "<option value=".$artist['id'].">".$artist['stage_name']."</option>";
                }
            ?>
          </select>
          <input type="text" placeholder="Album Cover Path" name="path">
          <input type="submit" name="album">
        </form>
        <?php
        if(isset($_POST['album']))  
        {   
          $title = $_POST['title'];
          $date = $_POST['date'];
          $artist = $_POST['artist_album'];
          $path = $_POST['path'];
          $sql= $conn->prepare("INSERT into album(album_title, realse_date, artist, cover_art_path) VALUES (:title,:date,:artist,:path)");
          $sql->bindValue(':title', $title, PDO::PARAM_STR);
          $sql->bindValue(':date', $date, PDO::PARAM_STR);
          $sql->bindValue(':artist', $artist, PDO::PARAM_STR);
          $sql->bindValue(':path', $path, PDO::PARAM_STR);
          $sql->execute();     
          echo "<script>alert('Album added'); </script>";
        }
        ?>
        

        <form action="modifyDataBase.php" class="editForm" name="artist_form" method="post">
          <p>Artist</p>
          <input type="text" placeholder="Name" name="name" >
          <input type="text" placeholder="Stage Name" name="stage_name">
          <input type="text" placeholder="Nationality" name="nationality">
          <input type="submit" name="artist">
        </form>
        <?php
        if(isset($_POST['artist']))  
        {   
          $name = $_POST['name'];
          $stage_name = $_POST['stage_name'];
          $nationality = $_POST['nationality'];
          $sql= $conn->prepare("INSERT into artist(stage_name, name, nationality) VALUES (:stage_name,:name,:nationality)");
          $sql->bindValue(':name', $name, PDO::PARAM_STR);
          $sql->bindValue(':stage_name', $stage_name, PDO::PARAM_STR);
          $sql->bindValue(':nationality', $nationality, PDO::PARAM_STR);
          $sql->execute();     
          echo "<script>alert('Artist Added'); </script>";
        }
        ?>

        <form action="modifyDataBase.php" class="editForm" name="song_form" method="post">
          <p>Song</p>
          <input type="text" placeholder="Title" name="title">
          <select id="albums" name="album_form">
            <?php
                $sql_album = "SELECT * FROM album";  
                foreach ($conn->query($sql_album) as $album) { 
                  echo "<option value=".$album['id'].">".$album['album_title']."</option>";
                }
            ?>
          </select>
          <input type="submit" name="song">
        </form>
        <?php
        if(isset($_POST['song']))  
        {   
          $title = $_POST['title'];
          $album_form = $_POST['album_form'];
          $sql= $conn->prepare("INSERT into song(title, album) VALUES (:title,:album_form)");
          $sql->bindValue(':title', $title, PDO::PARAM_STR);
          $sql->bindValue(':album_form', $album_form, PDO::PARAM_STR);
          $sql->execute();     
          echo "<script>alert('Song Added'); </script>";
        }
        ?>
      </section>
    </main>
</body>
</html>