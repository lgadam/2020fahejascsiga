<?php
session_start();
include_once("./config/config.php");
include_once("functions.php");
include_once("./config/User.php");
$id = $_GET['id'];
$db = new Database();
$connection = $db->DB_Connect();
$account = new Account($connection);
$data = $account->SelectPostById($id)?>

<!DOCTYPE html>
<html lang="hu">
<?php require('./html/head.html'); ?>
<body>
<?php require("nav.php"); ?>
<main>
    <table class="table table-active table-striped" style="width: 70%; margin:auto">
        <tr>
            <th>Ár:</th>
            <td><?php echo $data['Ar'] ?> Ft</td>
        </tr>
        <tr>
            <th>Márka:</th>
            <td><?php echo $data['Marka'] ?></td>
        </tr>
        <tr>
            <th>Típus:</th>
            <td><?php echo $data['Tipus'] ?></td>
        </tr>
        <tr>
            <th>Évjárat:</th>
            <td><?php echo $data['Evjarat'] ?></td>
        </tr>
        <tr>
            <th>Kilométeróra állása:</th>
            <td><?php echo $data['Kilometer_Allas'] ?> km</td>
        </tr>
        <tr>
            <th>Üzemanyag:</th>
            <td><?php echo $data['Uzemanyag'] ?></td>
        </tr>
        <tr>
            <th>Cím:</th>
            <td><?php echo $data['Cim'] ?></td>
        </tr>
        <tr>
            <th>Email cím:</th>
            <td><?php echo $data['email'] ?></td>
        </tr>
        <tr>
            <th>Telefonszám:</th>
            <td><?php echo $data['tel'] ?></td>
        </tr>
    </table>


</main>
<?php require('./html/footer.html'); ?>
</body>
</html>