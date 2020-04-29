<?php
class Table
{
    private $pageIndex = 1;
    private $numOfItems;
    private $count;
    private $data;
    private $pages;
    public function __construct($data, $numOfItems, $pageIndex)
    {
        $this->data = $data;
        $this->numOfItems = $numOfItems;
        $this->pageIndex = $pageIndex;
        $this->count = sizeof($data);
        $this->pages = intval(ceil($this->count/$this->numOfItems));
    }
    public function GetPageIndex(){
        return $this->pageIndex;
    }
    public function FillTable()
    {
        $isAdmin =  isset($_SESSION['admin']) && $_SESSION['admin'];
        for ($i = 0; $i < $this->count; $i++) {
            $cim = htmlspecialchars($this->data[$i]['Cim']);
            $marka = htmlspecialchars($this->data[$i]['Marka']);
            $tipus = htmlspecialchars($this->data[$i]['Tipus']);
            $evjarat = htmlspecialchars($this->data[$i]['Evjarat']);
            $kmallas = number_format(htmlspecialchars($this->data[$i]['Kilometer_Allas']), "0", "", ".");
            $uzemanyag = htmlspecialchars($this->data[$i]['Uzemanyag']);
            $ar = number_format(htmlspecialchars($this->data[$i]['Ar']), "0", "", ".");
            $id = htmlspecialchars($this->data[$i]['id']);
                echo "<tr class='table_row'>
                        <td><a class='location' target='_blank' href='https://www.google.hu/maps/search/{$cim}/'><i class=\"fas fa-map-marker-alt\"></i></a></td>
                        <td>$marka</td>
                        <td>$tipus</td>
                        <td>$evjarat</td>
                        <td>$kmallas km</td>
                        <td>$uzemanyag</td>
                        <td>$ar Ft</td>
                        <td><a href='datasheet.php?id=$id'>Megtekintés</a></td>";
                    if ($isAdmin){
                        echo "  <td><a class='btn btn-danger' href='delete.php?id={$id}'>Törlés</a></td>
                            <td>
                               <a target='_blank' href='modify.php?id=$id' class='btn btn-warning'>Szerkesztés</a>
                            </td>";
                    }
                    echo "</tr>";

        }
    }

    public function ShowPageNumber($numOfFound){
        echo $this->pageIndex.". oldal, ".$numOfFound." találat";
    }

    public function GetCount(){
        return $this->count;
    }

    public function GetNumOfItems(){
        return $this->numOfItems;
    }
}
?>