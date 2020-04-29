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
             <div>
                <label>Évjárat </label>
                <input type='text' name='evjarat' id='evjarat'
                       value="<?php echo htmlspecialchars($adat['Evjarat']); ?>" class='form-control' required/>
            </div>
            <div>
                <label>Üzemanyag</label>
                <select class="custom-select custom-select-lg" name="uzemanyag" >
                    <option value="<?php echo htmlspecialchars($adat['Uzemanyag']); ?>"><?php echo htmlspecialchars($adat['Uzemanyag']); ?></option>
                    <option value="Benzin">Benzin</option>
                    <option value="Dizel">Dízel</option>
                    <option value="Hibrid">Hibrid</option>
                    <option value="Elektromos">Elektromos</option>
                </select>
            </div>
            <div>
                <label>Kilométeróra Állás </label>
                <input type='text' name='kmallas' id='kmallas'
                       value="<?php echo htmlspecialchars($adat['Kilometer_Allas']); ?>" class='form-control' required/>
            </div>
            <div>
                <label>Ár </label>
                <input type='text' name='ar' id='ar'
                       value="<?php echo htmlspecialchars($adat['Ar']); ?>" class='form-control' required/>
            </div>

            <div class="btncontainer">
                <input type='submit' name='submit' value='Szerkesztés' class='btn btn-primary'/>
            </div>
        </form>
<?php }
if ($isPwModify) {
?>
<div class='container border'>
        <h1>Jelszó változtatása</h1>
        <form class="modifyform" name='insert' action='' method='post'>
            <div>
                <label> Jelenlegi Jelszó</label>
                <input type="password" name="currentpw" placeholder="Kérem adja meg aktuális jelszavát"
                       id="currentpw" value="" class="form-control" required/>
            </div>
            <div>
                <label> Jelszó</label>
                <input type="password" name="password" placeholder="Új jelszó" id="password" value=""
                       class="form-control" required/>
            </div>
            <div>
                <label>Jelszó megerősítés</label>
                <input type="password" name="password2" placeholder="Jelszó megerősítése" id="password2" value=""
                       class="form-control" required/>
            </div>
            <div class="btncontainer">
                <input type='submit' name='submit' value='Változtatás' class='btn btn-primary'/>
            </div>
        </form>



    </div>
        <form class="modifyform" action="deleteuser.php" method="post">
            <div>
            <label for="">Fiók törlése</label>
                <input type="password" name="deletepw" placeholder="Add meg a jelszavad..." id="password2" value=""
                       class="form-control" required/>
            </div>
            <div class="btncontainer">
            <input type="submit" class="btn btn-primary" class='deleteuserbtn' value="Fiók törlése"/>
            </div>
        </form>

    </div>
    <?php } ?
</main>
<?php require('./html/footer.html'); ?>
</body>
</html>
