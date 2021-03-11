<?php
include_once "database.php";

$first_name = $_POST['ime'];
$last_name = $_POST['priimek'];
$email = $_POST['enaslov'];
$pass = $_POST['geslo'];
$pass2 = $_POST['geslo2'];

//preverim, ali so podatki polni in se gesli ujemata
if(!empty($user) && !empty($last_name) && !empty($email)
&& !empty($pass) && ($pass == $pass2)){

$pass = password_hash($pass,PASSWORD_DEFAULT);

$query  = "INSERT INTO osebe(ime,priimek,enaslov,geslo) VALUES(?,?,?,?)";

$stmt = $pdo->prepare($query);
$stmt->execute([$first_name,$last_name,$email,$pass]);

header("Location: login.php");
}
else{
header("Location: register.php");
}
?>