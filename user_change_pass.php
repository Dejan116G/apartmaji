<?php
include_once "session.php";
include_once "database.php";

$id = $_SESSION['id_osebe'];

$geslo = $_POST['geslo'];
$geslo2 = $_POST['geslo2'];

//preverim, ali so podatki polni in se gesli ujemata
if(!empty($geslo) && ($geslo == $geslo2)){

$geslo = password_hash($geslo,PASSWORD_DEFAULT);

$query  = "UPDATE osebe SET geslo=? WHERE id=?";

$stmt = $pdo->prepare($query);
$stmt->execute([$geslo,$id]);

header("Location: profile.php");
}
else{
header("Location: profile.php");
}
?>