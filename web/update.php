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
    if ($_SESSION['admin']) {
        $id = $_POST['id'];
        $prop = "id";
    } else {
        $id = $_SESSION['id'];
        $prop = 'madeby';
    }
    $data =
        [
            'cim' => $cim,
            'marka' => $marka,
            'tipus' => $tipus,
            'evjarat' => $evjarat,
            'kmallas' => $kmallas,
            'uzemanyag' => $uzemanyag,
            'ar' => $ar,
            'id' => $id
        ];
    $sql = $update->UpdateRecords($data, $prop);
    $db->Disconnect();
    if ($sql)
        exitAlertRedirect('Sikeres módosítás', 'index.php');
    else
        exitAlertRedirect('Sikertelen módosítás', 'modify.php');
}
