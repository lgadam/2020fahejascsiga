<?php

class Account
{
    private $pageIndex = 1;
    private $con;
    private $OrderBy;
    private $Order;
    private $searchInput;
    private $numOfItems = 25;

    public function __construct($con){
        $this->con = $con;
    }

    public function GetSearchInput(){
        return $this->searchInput;
    }

    public function GetOrder(){
        return $this->Order;
    }

    public function GetOrderBy(){
        return $this->OrderBy;
    }

    public function GetNumOfItems(){
        return $this->numOfItems;
    }

    public function GetPageIndex(){
        return $this->pageIndex;
    }

    public function ShowPageNumbers(){
	$query = "SELECT COUNT(*) FROM hasznaltautok INNER JOIN userregistration ON hasznaltautok.madeby = userregistration.id WHERE userregistration.status = 1";
        $isSearch = $this->searchInput != null;
        if ($isSearch)
        {
            $query .= " AND (Marka LIKE :search1
            OR Tipus LIKE :search2
            OR Evjarat LIKE :search3
            OR Kilometer_Allas LIKE :search4
            OR Uzemanyag LIKE :search5
            OR Ar LIKE :search6) ";
        }
        $sql = $this->con->prepare($query);
        if ($isSearch) {
            $searchInput = "%$this->searchInput%";
            for ($i = 1; $i <= 6; $i++) {
                $sql->bindParam(":search$i", $searchInput, PDO::PARAM_STR);
            }
        }
        $sql->execute();
        $result = $sql->fetchColumn();
        return $result;
    }
	
    public function SelectRecordsOfTablesByStatus(){
    }

    public function Search(){
    }

	public function Activate(){
    }
	
	 public function DeleteUser(){
    }

	public function DeleteRecords(){
    }

    public function GetUserId(){
    }

    public function UpdateRecords(){
    }

    public function UpdatePassword(){
    }

    public function GetUserPost(){
    }

    public function IsVerifiedEmail(){
    }

    public function AddNewPwd(){
    }

    public function RemoveAllExpired(){
    }

    public function UpdatePsw(){    
    }

    public function SelectUserByEmail(){
    }

    public function SelectPostById(){
    }
    
    public function SelectUserIdByEmail(){
    }

    public function CheckPassword(){
    }

    public function IsEmailInUse(){
    }

    public function AddUser(){
    }

     public function InsertRecord(){
    }     

    public function SendVerifyingEmail(){
    }
}
