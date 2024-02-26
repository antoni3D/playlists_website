<?php
    include 'database_conn.php';
    session_destroy();
    header("Location: Main.php")
?>