<?php
session_start();
include_once("functions.php");
if (!isset($_SESSION['login']))
    exitAlertRedirect('Nincs bejelentkezett felhasználó.', 'login.php');
$isAdmin = $_SESSION['admin'];
if ($isAdmin) {
    $isPostModify = isset($_GET['id']);
    $isPwModify = !$isPostModify;
} else {
    $isPwModify = true;
    $isPostModify = true;
}
$id = $isPwModify ? $_SESSION['id'] : $_GET['id'];

if ($isPwModify && isset($_POST['password']) && isset($_POST['password2']) && isset($_POST['currentpw'])) {
    include_once("./config/config.php");
    include_once("./config/User.php");

    $db = new Database();
    $connection = $db->DB_Connect();
    $account = new Account($connection);
    $password = $_POST['password'];
    $email = $_SESSION['login'];
    $currentpw = $_POST['currentpw'];
    if (!$account->CheckPassword($id, $currentpw))
        exitAlertRedirect("Nem a jelenlegi jelszót adta meg!", "modify.php");
    passwordVerify($password, $_POST['password2']);
    exitAlertRedirect($account->UpdatePassword($password, $email) ? 'Sikeres módosítás!' : 'Sikertelen módosítás', 'modify.php');

    include_once("./config/config.php");
    include_once("./config/User.php");
    include_once("functions.php");
    $db = new Database();
    $connection = $db->DB_Connect();
    $account = new Account($connection);

    if ($isPostModify) {
        $adat = $isAdmin ? $account->SelectPostById($_GET['id']) : $account->GetUserPost($id);
        if ($adat === false)
            exitAlertRedirect("Nincs ilyen adat!", "index.php");
    }
    
}
?>
<!DOCTYPE html>
<html lang='en'>
<?php require('./html/head.html'); ?>
<body>
<?php require('nav.php');
if ($isPostModify) { ?>
    <main class='container border'>
        <h1>Adatok változtatása</h1>
        <form class="modifyform" name='insert' action='update.php' method='post'>
            <?php if ($isAdmin) echo "<input type='hidden' name='id' value = '$id'>"; ?>
            <div>
                <label>Cím, ahol található </label>
                <input type='text' name='cim' id='cim'
                       value='<?php echo htmlspecialchars($adat['Cim']); ?>' class='form-control' required/>
            </div>
            <div>
                <label>Név </label>
                <input type='text' name='marka' id='marka'
                       value="<?php echo htmlspecialchars($adat['Marka']); ?>" class='form-control' required/>
            </div>
            <div>
                <label>Típus </label>
                <input type='text' name='tipus' id='tipus'
                       value="<?php echo htmlspecialchars($adat['Tipus']); ?>" class='form-control' required/>
            </div>
        </form>
<?php }
if ($isPwModify) {
?>
<div class='container border'>
    <div>
    </div>
<?php } ?>
</main>
<?php require('./html/footer.html'); ?>
</body>
</html>
