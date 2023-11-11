<?php 
    session_start();
    session_destroy();

    //redierect to index page
    header("Location: index.php")
?>