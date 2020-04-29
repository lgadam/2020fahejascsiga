<?php
session_start();
include_once("./config/config.php");
include_once("functions.php");
include_once("./config/User.php");

<!DOCTYPE html>
<html lang="hu">
<?php require('./html/head.html'); ?>
<body>
<?php require("nav.php"); ?>
<main>
    <table>
        <tr>
            <th>Ár:</th>
            <td></td>
        </tr>
        <tr>
            <th>Márka:</th>
            <td></td>
        </tr>
        <tr>
            <th>Típus:</th>
            <td></td>
        </tr>
        <tr>
            <th>Évjárat:</th>
            <td></td>
        </tr>
        <tr>
            <th>Kilométeróra állása:</th>
            <td></td>
        </tr>
        <tr>
            <th>Üzemanyag:</th>
            <td></td>
        </tr>
        <tr>
            <th>Cím:</th>
            <td></td>
        </tr>
        <tr>
            <th>Email cím:</th>
            <td></td>
        </tr>
        <tr>
            <th>Telefonszám:</th>
            <td></td>
        </tr>
    </table>
</main>
<?php require('./html/footer.html'); ?>
</body>
</html>