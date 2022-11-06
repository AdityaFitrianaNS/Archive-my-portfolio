<?php

session_start();
require "../controllers/waifu_user.php";

if (!isset($_SESSION['login'])) {
    header("Location: login");
    exit;
}

$id_waifu = $_GET["id_waifu"];

if( deleteWaifu($id_waifu) > 0) {
    header("Location: waifu");
} else {
    header("Location: waifu");
}

?>