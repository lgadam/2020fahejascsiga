<?php
if (isset($_POST['email'])) {
    include_once("./config/config.php");
    include_once("functions.php");
    include_once("./config/User.php");
    $db = new Database();
    $connection = $db->DB_Connect();
    $user = new Account($connection);
    $email = $_POST['email'];
    if (!$user->IsVerifiedEmail($email))
        exitAlert("Kérem először regisztráljon be, vagy aktiválja regisztrált fiókját!");
    $token = $user->AddNewPwd($email, 600);
    if ($token === false)
        exitAlert("A művelet nem sikerült.");
    $headers = null;
    $to = $email;
    $subject = "E-mail visszaállítása (Használt autók)";
    $subject = "=?UTF-8?B?" . base64_encode($subject) . "?=";
    $from = "=?UTF-8?B?" . base64_encode("Használt autók") . "?=";
    $headers .= "MIME-Version: 1.0" . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
    $headers .= 'From: ' . $from . ' <mailing.tester.none@gmail.com>' . "\r\n";
    $ms = null;
    $ms .= "<html lang='hu'></body><div><div>Kedves Felhasználó,</div></br></br>";
    $ms .= "<div style='padding-top:8px;'>Kérem kattinston a linkre az email visszaállítása érdekében.</div>
<div style='padding-top:10px;'><a href='http://localhost/hasznaltautok/pswreset.php?email=$email&token=$token'>Katt ide</a></div>
</div>
</body></html>";
    mail($to, $subject, $ms, $headers);
    exitAlertRedirect('Kérem nézze meg email fiókját a jelszó helyreállításához!', 'login.php');
}
?>
