<?php
session_start();
include_once("./config/config.php");
include_once("./config/User.php");
include_once("functions.php");
$db = new Database();
$connection = $db->DB_Connect();
$account = new Account($connection);
if (isset($_POST['sortorder']) || isset($_POST['sortby']) || isset($_POST['search']) || isset($_POST['pagenumber'])){
 $account->Search($_POST['sortorder'], $_POST['sortby'], $_POST['search'], $_POST['pagenumber']);
}
include_once('./Controllers/View.php');
$adat = $account->SelectRecordsOfTablesByStatus();
$table = new Table($adat, $account->GetNumOfItems(), $account->GetPageIndex());
if ($adat === false) exitAlert("Üres a tábla!");
?>
<!DOCTYPE html>
<html lang="hu">
<?php require('./html/head.html'); ?>
<body>
<?php require("nav.php"); ?>
<main>
    <div class="_container_">
        <label for="" class="talalatok">
                <?php $talalatok = $account->ShowPageNumbers();
                        $table->ShowPageNumber($talalatok);
                ?>
            </label>

            <div id="tablepress-1_filter" class="dataTables_filter">
                <form action="" method="post" class="controller">
                    <?php
                    echo "<label> Oldalszám <select class='custom-select custom-select-lg mb-3-select' name='pagenumber'>";
                    $i = 0;
                    do {
                        $i++;
                        $str = "";
                        if ($i == $table->GetPageIndex()) $str = "selected = 'selected'";
                        echo "<option $str value='$i'>$i</option>";
                    }
                    while ($i*$table->GetNumOfItems() < $talalatok);
                    echo "</select></label>";
                echo "<label><input class='form-control mr-sm-2' placeholder='Keresés...' value='{$account->GetSearchInput()}' type='search' name='search' class='search' aria-controls='tablepress-1'></label>
                    <label>
                        <select class='custom-select custom-select-lg mb-3' name='sortorder' >   
                            <option value='' >Rendezés</option>
                            <option value='ASC' >Növekvő</option>
                            <option value='DESC' >Csökkenő</option>
                        </select>"; ?>
                        <select class="custom-select custom-select-lg mb-3-select" name="sortby" >
                            <option value="">Mi szerint?</option>
                            <option value="Marka">Márka</option>
                            <option value="Evjarat">Évjárat</option>
                            <option value="Ar">Ár</option>
                        </select>
                    </label>
                    <input type="submit" value="Küldés" class="btn btn-primary">
                </form>
            </div>
            </div>
                <table class="table table-active table-striped">
                    <thead class="thead-dark">
                    <tr>
                        <th><i class="fas fa-map-marked-alt"></i></th>
                        <th>Márka
                        </th>
                        <th>Típus</th>
                        <th>Évjárat
                        </th>
                        <th>Kilométeróra állása</th>
                        <th>Üzemanyag</th>
                        <th>Ár</th>
                        <th>Adatlap</th>
                        <?php
                        if (isset($_SESSION['admin']) && $_SESSION['admin']) {
                            echo "<th>Törlés</th>";
                            echo "<th>Szerkesztés</th>";
                        }
                        ?>
                    </tr>
                    </thead>
                    <tbody id="demo">
                    <?php $table->FillTable(); ?>
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form name='insert' action='update.php' method='post'>
                                        Márka
                                        <input type='text' name='marka' id='marka' value='' class='form-control' required/>
                                        Típus
                                        <input type='text' name='tipus' id='tipus' value='' class='form-control' required/>
                                        Évjárat
                                        <input type='text' name='evjarat' id='evjarat' value='' class='form-control' required/>
                                        Kilométeróra állása
                                        <input type='text' name='kmallas' id='kmallas' value='' class='form-control'
                                               required/>
                                        Üzemanyag
                                        <input type='text' name='uzemanyag' id='uzemanyag' value='' class='form-control' required/>
                                        Adatlap
                                        <input type='text' name='link' id='link' value='' class='form-control'/>
                                        <br>
                                        <input type="text" class="fade" name='id' id="id" value='' readonly>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <input type="submit" class="btn btn-primary"/>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    </tbody>
                </table>
        </div>
    </div>
</main>
<?php require('./html/footer.html'); ?>
</body>
</html>
