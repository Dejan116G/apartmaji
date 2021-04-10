<?php
include_once "session.php";
include_once "database.php";

$id = $_SESSION['user_id'];

$geslo = $_POST['geslo'];
$geslo2 = $_POST['geslo2'];

//preverim, ali so podatki polni in se gesli ujemata
if(!empty($geslo) && ($geslo == $geslo2)){

$geslo = password_hash($geslo,PASSWORD_DEFAULT);

$query  = "UPDATE osebe SET geslo=? WHERE id_osebe=?";

$stmt = $pdo->prepare($query);
$stmt->execute([$geslo,$id]);

odziv("Geslo zamenjano");

header("Location: profil.php");
}
else{
odziv("Geslo ni bilo zamenjano.");    
header("Location: profil.php");
}
?>