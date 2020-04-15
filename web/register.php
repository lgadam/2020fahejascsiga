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
					       
            </form>
            </div>
        </div>
    </div>
</main>
<?php require('./html/footer.html'); ?>
</body>
</html>