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