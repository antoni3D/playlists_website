<?php
    session_start();
    $dsn = 'mysql:dbname=spotify_generator;host=127.0.0.1';
    $username = "root";
    $password = "";

    // Create connection
    $conn = new PDO($dsn, $username, $password);
  ?> 