<?php
include_once "session.php";
include_once "database.php";

$ime = $_POST['ime'];
$priimek= $_POST['priimek'];
$opis = $_POST['opis'];


$id = $_SESSION['user_id'];

//preverim, ali so podatki polni in se gesli ujemata
if(!empty($ime) && !empty($priimek)
&& !empty($geslo) && ($geslo == $geslo2)){


$query  = "UPDATE osebe SET ime = ?, priimek= ?, opis= ? WHERE id = ?";

$stmt = $pdo->prepare($query);
$stmt->execute([$fime,$priimek,$opis,$id]);

header("Location: profile.php");
die();
}
else{
header("Location: profile.php");
die();
}
?>