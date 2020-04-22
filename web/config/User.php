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
        $query = "SELECT hasznaltautok.id, Cim, Marka, Tipus, Evjarat, Uzemanyag, Kilometer_Allas, Ar FROM hasznaltautok INNER JOIN userregistration ON hasznaltautok.madeby = userregistration.id WHERE userregistration.status = 1";
        $isSearch = $this->searchInput != null;
        $isOrderBy = in_array($this->OrderBy, array("Marka", "Evjarat", "Ar"));
        $isOrder = $isOrderBy && in_array($this->Order, array("DESC", "ASC"));
        $isPageNumber = $this->pageIndex != null && is_int($this->pageIndex);
        if ($isSearch)
        {
            $query .= " AND (Marka LIKE :search1
            OR Tipus LIKE :search2
            OR Uzemanyag LIKE :search3
            OR Kilometer_Allas LIKE :search4
            OR Ar LIKE :search5
            OR Evjarat LIKE :search6) ";
        }
        if ($isOrderBy)
        {
            $query .= " ORDER BY $this->OrderBy ";
        }
        if ($isOrder) {
            $query .= $this->Order;
        }
        $query.=" LIMIT $this->numOfItems";
        if ($isPageNumber)
        {
            $number = ($this->pageIndex-1)*$this->numOfItems;
            $query.=" OFFSET ".$number;
        }
        $sql = $this->con->prepare($query);
        if ($isSearch) {
            $searchInput = "%$this->searchInput%";
            for ($i = 1; $i <= 6; $i++) {
                $sql->bindParam(":search$i", $searchInput, PDO::PARAM_STR);
            }
        }
        $sql->execute();
        $result = $sql->fetchAll(PDO::PARAM_STR);

        return $result;
    }

    public function Search($order, $orderby, $search, $pagenumber){
        $this->OrderBy = $orderby;
        $this->Order = $order;
        $this->searchInput = $search;
        $this->pageIndex = intval($pagenumber);    
    }
	
    public function Activate($activation)
	{
        $sql=$this->con->prepare("UPDATE userregistration SET status=1 WHERE activationcode=:activation");
        $sql->bindParam(':activation', $activation, PDO::PARAM_STR);
        $sql->execute();
        return $sql;
    }
	
    public function DeleteUser($id)
    {
        $user_delete = $this->con->prepare("DELETE FROM userregistration WHERE id = :id;");
        $user_delete->bindParam(':id', $id, PDO::PARAM_INT);
        $user_delete->execute();
        return $user_delete;
    }
	
    public function DeleteRecords($id)
    {
        $sql = $this->con->prepare("DELETE FROM hasznaltautok WHERE id = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
    }

    public function GetUserId($postid){		
        $query = $this->con->prepare("SELECT userregistration.id FROM userregistration INNER JOIN hasznaltautok ON hasznaltautok.madeby = userregistration.id WHERE userregistration.id = hasznaltautok.madeby AND hasznaltautok.id = :id");
        $query->bindParam(':id', $postid, PDO::PARAM_INT);
        $query->execute();
        $result = $query->fetchColumn();
        return $result;
    }

    public function UpdateRecords($data, $prop){
		 $sql = $this->con->prepare("UPDATE hasznaltautok SET Cim = :cim, Marka = :marka, Tipus = :tipus, Evjarat = :evjarat, Uzemanyag = :uzemanyag, Kilometer_Allas = :kmallas, Ar = :ar WHERE $prop = :id;");
        return $sql->execute($data);
    }

    public function UpdatePassword($password, $email){		
        $options = [
            'cost' => 15
        ];
        $passwordhash = password_hash($password, PASSWORD_BCRYPT, $options);
        $sql = $this->con->prepare("UPDATE userregistration SET password = :passwordhash  WHERE email = :email");
        $sql->bindParam(':passwordhash', $passwordhash, PDO::PARAM_STR);
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->execute();
        return $sql;
    }

    public function GetUserPost($id)
    {
        $sql = $this->con->prepare("SELECT Cim, Marka, Tipus, Evjarat, Uzemanyag, Kilometer_Allas, Ar FROM hasznaltautok WHERE madeby = :id");
        $sql->bindParam(':id', $id, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

   public function IsVerifiedEmail($email)
    {
        $sql = $this->con->prepare("SELECT status FROM userregistration WHERE email=:email AND status=1");
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->execute();
        return $sql && $sql->fetch();
    }

   
    public function AddNewPwd($email, $timeout)
    {
        $expires = date("U") + $timeout;
        $token = md5($email . time());
        $sql = $this->con->prepare("INSERT INTO pwdreset (pwdResetEmail,pwdResetToken,pwdResetExpires) VALUES (:email, :token, :expires)");
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->bindParam(':token', $token, PDO::PARAM_STR);
        $sql->bindParam(':expires', $expires, PDO::PARAM_STR);
        return $sql->execute() ? $token : false;
    }

    public function RemoveAllExpired()
    {
	$time = date("U");
        $sql = $this->con->prepare("DELETE FROM pwdreset WHERE pwdResetExpires < :time ");
        $sql->bindParam(':time', $time, PDO::PARAM_INT);
        $sql->execute();
    }

    public function UpdatePsw($password, $email, $token)
    {
	$sql = $this->con->prepare("DELETE FROM pwdreset WHERE pwdResetToken = :token AND pwdResetEmail = :email ");
        $sql->bindParam(':token', $token, PDO::PARAM_STR);
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->execute();

        if ($sql->rowCount() <= 0)
            return false;

        $query = $this->con->prepare("UPDATE userregistration SET password = :password WHERE email = :email");
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':password', $password, PDO::PARAM_STR);
        $query->execute();

        return $query->rowCount() > 0;    
    }

    public function SelectUserByEmail($email)
    {
	$sql = $this->con->prepare("SELECT id, name, email, tel, status, admin FROM userregistration WHERE email = :email");
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->execute();
        return $sql->fetch();
    }

    public function SelectPostById($postid)
    {
	$sql = $this->con->prepare("SELECT Cim, Marka, Tipus, Evjarat, Uzemanyag, Kilometer_Allas, Ar, userregistration.email, userregistration.tel FROM hasznaltautok INNER JOIN userregistration on hasznaltautok.madeby = userregistration.id WHERE hasznaltautok.id = :id");
        $sql->bindParam(':id', $postid, PDO::PARAM_INT);
        $sql->execute();
        $result = $sql->fetch();
        return $result;
    }
    
    public function SelectUserIdByEmail(){
    }

    public function CheckPassword($userid, $password){
        $sql = $this->con->prepare("SELECT password FROM userregistration WHERE id = :userid");
        $sql->bindParam(':userid', $userid, PDO::PARAM_INT);
        return $sql->execute() && password_verify($password, $sql->fetchColumn());
    }

    public function IsEmailInUse($email){
        $sql = $this->con->prepare("SELECT * FROM userregistration WHERE email=:email LIMIT 1");
        $sql->bindParam(':email', $email, PDO::PARAM_STR);
        $sql->execute();

        return $sql->rowCount() > 0;
    }

    public function AddUser($data, $password){
        $options = [
            'cost' => 15
        ];
        $data['password'] = password_hash($password, PASSWORD_BCRYPT, $options);
        $sql = $this->con->prepare("INSERT INTO userregistration (name, email, tel, password, activationcode) VALUES (:nev, :email, :tel, :password, :activationcode)");
        return $sql->execute($data);
    }

     public function InsertRecord($data){
        $sql = $this->con->prepare("INSERT INTO hasznaltautok (Cim, Marka, Tipus, Evjarat, Uzemanyag, Kilometer_Allas, Ar, madeby) VALUES (:cim, :marka, :tipus, :evjarat, :uzemanyag,:kmallas, :ar, :id)");
        return $sql->execute($data);
    }     

    public function SendVerifyingEmail($data){
        $to = $data['email'];
        $subject = "=?UTF-8?B?" . base64_encode("E-mail megerősítés") . "?=";
        $from = "=?UTF-8?B?" . base64_encode("Használt Autók") . "?=";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
        $headers .= 'From: ' . $from . ' <mailing.tester.none@gmail.com>' . "\r\n";
        $address = "172.16.24.192";
        $ms = "<html>
                </body>
                    <div>
                        <div>Kedves".$data['name']." !</div></br></br>";
        $ms .= "<div style='padding-top:8px;'>Kérem kattinston az alábbi linkre az email megerősítése és aktiválása érdekében.</div>
                            <div style='padding-top:10px;'><a href='http://$address/emailverify/email_verification.php?code=".$data['activationcode']."'>Katt ide</a>
                            </div>
                    </div>
                </body>
            </html>";
        return mail($to, $subject, $ms, $headers);
    }
}
