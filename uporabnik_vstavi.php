<?php
include_once "database.php";

$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$email = $_POST['email'];
$pass = $_POST['pass'];
$pass2 = $_POST['pass2'];
//preverim, ali so podatki polni in se gesli ujemata
if (!empty($first_name) && !empty($last_name) && !empty($email) 
    && !empty($pass) && ($pass == $pass2)) {

    $pass = password_hash($pass,PASSWORD_DEFAULT);

$query  = "INSERT INTO osebe(ime,priimek,enaslov,geslo) VALUES(?,?,?,?)";

    $stmt = $pdo->prepare($query);
    $stmt->execute([$first_name,$last_name,$email,$pass]);

    header("Location: login.php");

}
else {
    header("Location: register.php");
    
}
?>