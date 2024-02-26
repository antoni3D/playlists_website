<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleMain.css">
    <title>Spotify_generator</title>
</head>
<body>
<?php include 'database_conn.php';?>
    <!-- Header - najwyzszy blok (zawiera nagłówek oraz oraz elementy graficzne) -->
    <header id="header" class="colorChange">
        <img src="sunt.png" alt="slonce">
        <h1>Playlist generator - Untitled</h1>
        <img src="SpotifyLogo.png" alt="" class="RightIcons" id="BlockerSpotify">
        <img src="starssprite.png" alt="" class="RightIcons">
        <img src="max.png" alt="" class="RightIcons">
        <img src="min.png" alt="" class="RightIcons">
        <img src="cross.png" alt="" class="RightIcons">
    </header>

    <!-- Toolbar - blok nad głównym polem (zawiera odnośniki to innych pod-stron )  wymienic na linki !! -->
    <section id="toolbar">
        <button onclick = "window.location.href='Main.php';">main</button>
        <button onclick = "window.location.href='Account.php';">account</button> 
        <button onclick = "window.location.href='Create.php';">create</button> 
        <button onclick = "window.location.href='Saved.php';">saved</button>
        <button onclick = "window.location.href='Help.php';">help</button>  
        <?php
            if(isset($_SESSION['role']))
            {
                if($_SESSION['role'] == 2)
                {
                    echo '<a href="deleteUsers.php">Admin Panel #1</a>';
                    echo '<a href="modifyDataBase.php">Admin Panel #2</a>';
                }

                
            }
            if(isset($_SESSION['logged']))
            {
                if($_SESSION['logged'] == TRUE)
                {
                    echo '<a href="logout.php">logout</a>';
                }
            }
        ?>
    </section>

    <!-- Main - główne pole (zawiera lewy oraz prawy pasek) -->
    <main>

        <!-- left_panel - lewe pole głównego obaszru (zawiera grafiki oraz paragrafy) -->
        <section id="left_panel">
            <img src="colors.png" alt="" class="colorChange">
            <img src="tools.png" alt="" id="tools">
            <h2>Hi! This site lets u save and create music playlists,</h2>
            <p>hope it will serve u well. Take your time to tinker with all the settings</p>
            <p>@Ktosiek_tosiek</p>
        </section>

        <!-- right_panel - prawe pole głównego obaszru (zawiera wszystkie elementy pozwalajace na poruszanie bloków oraz te bloki) -->
        <section id="right_panel">

            <!-- choose color - wybór koloru ( zawiera cztery przyciski pozwalające na zmianę kolorów na stronie ) -->
            <div class="draggable" id="chooseColor">
                <p>Choose color</p>
                <button class="imageOption" id="color1"></button>
                <button class="imageOption" id="color2"></button>
                <button class="imageOption" id="color3"></button>
                <button class="imageOption" id="color4"></button>

                <!-- skrypt zmiany kolorów ----------------------------------------------------------------------------->
                <script>
                    const subheaders = document.getElementsByClassName('colorChange');
                    document.getElementById("color1").addEventListener('click',function onClick(){
                        for (const box of subheaders) { box.style.backgroundColor = '#8F8DD4';}
                        document.getElementById("LoginButton").style.color = '#8F8DD4';
                        document.getElementById("right_panel").style.background = 'url("background.png")';
                        document.getElementById("right_panel").style.backgroundSize = 'cover';
                    });
                    document.getElementById("color2").addEventListener('click',function onClick(){
                        for (const box of subheaders) { box.style.backgroundColor = '#ebb2d6';}
                        document.getElementById("LoginButton").style.color = '#ebb2d6';
                        document.getElementById("right_panel").style.background = 'url("background2.png")';
                        document.getElementById("right_panel").style.backgroundSize = 'cover';
                    });
                    document.getElementById("color3").addEventListener('click',function onClick(){
                        for (const box of subheaders) { box.style.backgroundColor = '#ec9c99';}
                        document.getElementById("LoginButton").style.color = '#ec9c99';
                        document.getElementById("right_panel").style.background = 'url("background3.png")';
                        document.getElementById("right_panel").style.backgroundSize = 'cover';
                    });
                    document.getElementById("color4").addEventListener('click',function onClick(){
                        for (const box of subheaders) { box.style.backgroundColor = '#518af2';}
                        document.getElementById("LoginButton").style.color = '#518af2';
                        document.getElementById("right_panel").style.background = 'url("background4.png")';
                        document.getElementById("right_panel").style.backgroundSize = 'cover';
                    });
                </script>
            </div>
            <!--album_covers - blok chartujących albumów ( zawiera poruszający się blok z grafikami ) -->
            <div class="draggable" id="album_covers">
                <section class="subheader colorChange" id="album_coversheader"> <!--Id sprawdzane przy detekcji czy obiekt posiada header) -->
                    <h3>Charts - app</h3>
                </section>
                <h2>Charting songs</h2>
                <div class="photobanner">
                    <?php
                    $sql_charts = "SELECT * FROM charts";  
                    foreach ($conn->query($sql_charts) as $album) { 
                        $sql_charts_out = "SELECT album FROM song WHERE id LIKE '" .$album['song']."'"; 
                        foreach ($conn->query($sql_charts_out) as $cover) { 
                            $cover_art_path = "cover_arts/tmp" .$cover['album'].".jpg"; 
                            echo '<img src="'.$cover_art_path.'" alt="">';
                        }  
                    } 
                    foreach ($conn->query($sql_charts) as $album) { 
                        $sql_charts_out = "SELECT album FROM song WHERE id LIKE '" .$album['song']."'"; 
                        foreach ($conn->query($sql_charts_out) as $cover) { 
                            $cover_art_path = "cover_arts/tmp" .$cover['album'].".jpg"; 
                            echo '<img src="'.$cover_art_path.'" alt="">';
                        }  
                    } 
                    ?>
                </div>
            </div>
            <script>
            // Java script to move objects --------------------------------------------------------------
            var draggableElements = document.getElementsByClassName("draggable");
            for(var i = 0; i < draggableElements.length; i++){
                dragElement(draggableElements[i]);
            }       
            function dragElement(elmnt) {
                var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
                if (document.getElementById(elmnt.id + "header")) {
                    document.getElementById(elmnt.id + "header").onmousedown = dragMouseDown;
                } else {
                    elmnt.onmousedown = dragMouseDown;
                }
                function dragMouseDown(e) {
                    e = e || window.event;
                    e.preventDefault();
                    pos3 = e.clientX;
                    pos4 = e.clientY;
                    document.onmouseup = closeDragElement;
                    document.onmousemove = elementDrag;
                }
                function elementDrag(e) {
                    e = e || window.event;
                    e.preventDefault();
                    pos1 = pos3 - e.clientX;
                    pos2 = pos4 - e.clientY;
                    var xMax = window.innerWidth - elmnt.offsetWidth;
                    var yMax = window.innerHeight - elmnt.offsetHeight;
                    if ((elmnt.offsetLeft - pos1) >= 0 && (elmnt.offsetLeft - pos1) <= xMax) {
                    elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";
                    pos3 = e.clientX;
                    }
                    if ((elmnt.offsetTop - pos2) >= 0 && (elmnt.offsetTop - pos2) <= yMax) {
                    elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
                    pos4 = e.clientY;
                    }
                }
                function closeDragElement() {
                    document.onmouseup = null;
                    document.onmousemove = null;
                }
            }
            //----------------------------------------------------------------------------------------------------
            </script>
        </section>
    </main>
</body>
</html>