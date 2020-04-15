<?php 
function exitAlertRedirect($alert, $url){
    exit("
        <script type='text/javascript'>
            alert('$alert');
            document.location='$url';
        </script>");
}

function exitAlert($alert){
    exit("
    <script type='text/javascript'>
        alert('$alert');
    </script>");
}

function passwordVerify($password, $password2){
    if (!($password === $password2)) {
        exitAlert('Nem egyeznek a jelszavak!');
    }
}

function loginErrorMessage(){

}

function isProperAddress(){

}

?>