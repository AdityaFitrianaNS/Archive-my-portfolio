<?php

session_start();
require "../controllers/anime_user.php";

if (!isset($_SESSION['login'])) {
    header("Location: login");
    exit;
}

$id_anime = $_GET["id_anime"];

if( deleteanime($id_anime) > 0) {
    header("Location: anime");
} else {
    header("Location: anime");
}

?>