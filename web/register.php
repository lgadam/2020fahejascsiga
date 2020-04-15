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
					       
            </form>
            </div>
        </div>
    </div>
</main>
<?php require('./html/footer.html'); ?>
</body>
</html>