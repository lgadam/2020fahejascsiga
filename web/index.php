<?php
/*$db = new Database();
$connection = $db->DB_Connect();*/
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
</main>
<?php require('./html/footer.html'); ?>
</body>
</html>
