<?php
    if(!isset($_SESSION)) {
        session_start();
    }
    if (!isset($_SESSION['id']))
    {
        echo "Vous n'avez rien à faire ici";
        exit();
    } 
?>