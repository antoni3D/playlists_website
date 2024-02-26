<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="deleteUsersStyle.css">
    <title>Spotify_generator_admin#2</title>
</head>
<body>
<?php include 'database_conn.php';?>

    <!-- Header - najwyzszy blok (zawiera nagłówek oraz oraz elementy graficzne) -->
    <header id="header">
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
        <?php
            $sql_user = "SELECT * FROM user";  
            foreach ($conn->query($sql_user) as $user) { 
                echo "<form class='user' method='post' action='deleteUsers.php'> <section class='photo'>".$user['name']."</section> <section class='info'> <input type='text' value=".$user['id']." name='id' readonly>
                <p>email - ".$user['email']."</p></section><section class='controlls'><input type='submit' value='Delete' name='sub'></section></form>";
            } 
        ?>
    </main>

    <?php
    if(isset($_POST['sub']))  
                {   
                  $id = $_POST['id'];
                  $sql= $conn->prepare("DELETE FROM playlist_song WHERE playlist_id LIKE (Select id from playlists where user_id LIKE :id );");
                  $sql->bindValue(':id', $id, PDO::PARAM_STR);
                  $sql->execute();
                  
                  $sql= $conn->prepare("DELETE FROM playlists WHERE user_id LIKE :id ;");
                  $sql->bindValue(':id', $id, PDO::PARAM_STR);
                  $sql->execute();

                  $sql= $conn->prepare("DELETE FROM comments WHERE user_id LIKE :id ;");
                  $sql->bindValue(':id', $id, PDO::PARAM_STR);
                  $sql->execute();

                  $sql= $conn->prepare("DELETE FROM user WHERE id LIKE :id ;");
                  $sql->bindValue(':id', $id, PDO::PARAM_STR);
                  $sql->execute();

                  header("Refresh:0");
                  echo "<script>alert('User deleted'); </script>";

                }  
        
        ?>
</body>
</html>