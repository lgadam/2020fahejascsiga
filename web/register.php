<?php
if (isset($_POST['submit'])) {
    include_once("./config/config.php");
    include_once("./config/User.php");
    include_once("functions.php");
    $db = new Database();
    $connection = $db->DB_Connect();
    $account = new Account($connection);
    passwordVerify($_POST['password'], $_POST['password2']);
    if (strlen($_POST['password']) < 6)
        exitAlert('A jelszó túl rövid! Kérem legalább 6 karakter hosszú jelszavat válasszon!');
    $email = $_POST['email'];
    $marka = $_POST['marka'];
    $cim = $_POST['cim'];
    $tipus = $_POST['tipus'];
    $telefon = $_POST['telefon'];
    $evjarat = $_POST['evjarat'];
    $kmallas = $_POST['kmallas'];
    $uzemanyag = $_POST['uzemanyag'];
    $ar = $_POST['ar'];
    $nev = $_POST['nev'];
    $password = $_POST['password'];
    if ($account->IsEmailInUse($email)) exitAlertRedirect('Ez az e-mail már használatban van.', 'register.php');
    $userdata =
        [
            'nev' => $nev,
            'email' => $email,
            'tel' => $telefon,
            'activationcode' =>  md5($email . time())
        ];
    //if (!$account->SendVerifyingEmail($userdata)) exitAlertRedirect('Sikertelen email küldés', 'register.php');
    if (!$account->AddUser($userdata, $password)) exitAlertRedirect('Sikertelen adatrögzítés', 'register.php');
    $notuserdata =
        [
            'cim' => $cim,
            'marka' => $marka,
            'tipus' => $tipus,
            'evjarat' => $evjarat,
            'uzemanyag' => $uzemanyag,
            'kmallas' => $kmallas,
            'ar' => $ar,
            'id' => (int)$account->SelectUserIdByEmail($email)
        ];
    if (!$account->InsertRecord($notuserdata)) exitAlertRedirect('Sikertelen művelet', 'register.php');
    exitAlertRedirect('Sikeres regisztráció! Kérem erősítse meg e-mail címét.', 'login.php');
}
?>
<!DOCTYPE html>
<html lang="hu">
<?php require('./html/head.html') ?>
<body>
<?php include_once("nav.php"); ?>
<main class="container-fluid">
    <div class="col-sm-12 ">
        <div class="row">
            <div class="col-xs-12 container border">
                <h3>Regisztráció</h3>
                <hr>
                <form class="modifyform" name="insert" action="" method="post">
                    <div>
                        <label>Név</label>
                                <input type="text" name="nev" id="nev" value="" placeholder="Felhasználó neve"
                                       class="form-control" required/>
                    </div>
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" id="email" value=""
                               placeholder="pelda@pelda.com" class="form-control" required/>
                    </div>
                    <div>
                        <label>Jelszó</label>
                        <input type="password" name="password" id="password"
                               placeholder="minimum 6 karakter" value="" class="form-control"
                               required/>
                    </div>
                    <div>
                        <label>Jelszó megerősítés</label>
                        <td width="71%"><input type="password" name="password2" id="password2"
                                               placeholder="minimum 6 karakter" value="" class="form-control"
                                               required/>
                    </div>
                    <div>
                        <label>Cím, ahol található</label>
                        <input type="text" name="cim" id="cim" value="" placeholder="Cím"
                               class="form-control" required/>
                    </div>
                    <div>
                        <label>Telefonszám</label>
                        <input type="text" name="telefon" id="telefon" placeholder="Telefonszám"
                               value="" class="form-control"/>
                    </div>
                    <div>
                        <label>Márka</label>
                        <input type="text" name="marka" id="marka" placeholder="Pl: Honda"
                               value="" class="form-control" required/>
                    </div>
                    <div>
                        <label>Típus</label>
                        <input type="text" name="tipus" id="tipus" value="" placeholder="Pl: Civic"
                               class="form-control"/>
                    </div>
                    <div>
                        <label>Évjárat</label>
                        <input type="text" name="evjarat" id="evjarat" value="" placeholder="Pl: 2006"
                               class="form-control"/>
                    </div>
                    <div>
                        <label>Kilométeróra állása</label>
                        <input type="text" name="kmallas" id="kmallas" value="" placeholder="Pl: 216000"
                               class="form-control"/>
                    </div>
                    <div>
                        <label>Üzemanyag</label>
                        <select class="custom-select custom-select-lg" name="uzemanyag" >
                            <option value="">Kérjük válassz..</option>
                            <option value="Benzin">Benzin</option>
                            <option value="Dizel">Dízel</option>
                            <option value="Hibrid">Hibrid</option>
                            <option value="Elektromos">Elektromos</option>
                        </select>
                    </div>
                    <div>
                        <label>Ár</label>
                        <input type="text" name="ar" id="ar" value="" placeholder="Pl: 410000"
                               class="form-control"/>
                    </div>
                    <div class="checkboxclass">
                        <input type="checkbox" name="gdpr" required>
                        <div> Elfogadom az <a href=""> Adatkezelési
                                tájékoztatót.</a></div>
                    </div>
                    <div class="btncontainer">
                        <input type="submit" name="submit" value="Regisztráció"
                               class="btn btn-primary"/>
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>
<?php require('./html/footer.html'); ?>
</body>
</html>