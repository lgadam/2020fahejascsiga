<?php
session_start();
if (isset($_SESSION['login'])) {
    include_once("./config/config.php");
    include_once("./config/User.php");
    include_once("./functions.php");
    $db = new Database();
    $connection = $db->DB_Connect();
    $update = new Account($connection);
    $cim = $_POST['cim'];
    $marka = $_POST['marka'];
    $tipus = $_POST['tipus'];
    $evjarat = $_POST['evjarat'];
    $kmallas = $_POST['kmallas'];
    $uzemanyag = $_POST['uzemanyag'];
    $ar = $_POST['ar'];

}
