<?php

class Account
{
    private $pageIndex = 1;
    private $con;
    private $OrderBy;
    private $Order;
    private $searchInput;
    private $numOfItems = 25;
    
    public function __construct(){
    }

    public function GetSearchInput(){
    }

    public function GetOrder(){
    }

    public function GetOrderBy(){
    }

    public function GetNumOfItems(){
    }

    public function GetPageIndex(){
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