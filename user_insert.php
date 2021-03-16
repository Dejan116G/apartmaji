<?php
include_once "database.php";

$ime = $_POST['ime'];
$priimek = $_POST['priimek'];
$enaslov = $_POST['enaslov'];
$geslo = $_POST['geslo'];
$geslo2 = $_POST['geslo2'];

//preverim, ali so podatki polni in se gesli ujemata
if(!empty($ime) && !empty($priimek) && !empty($enaslov)
&& !empty($geslo) && ($geslo == $geslo2)){

$geslo = password_hash($geslo,PASSWORD_DEFAULT);

$query  = "INSERT INTO osebe(ime,priimek,enaslov,geslo) VALUES(?,?,?,?)";

$stmt = $pdo->prepare($query);
$stmt->execute([$ime,$priimek,$enaslov,$geslo]);

header("Location: login.php");
}
else{
header("Location: register.php");
}
?>