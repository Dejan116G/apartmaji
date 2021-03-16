<?php
include_once "session.php";
adminOnly();
include_once "database.php";

$id = (int) $_GET['id'];

//izbrišem vse njegove komentarje
$query = "DELETE FROM komentarji WHERE id_osebe = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);

//ohranim vse slike
$query = "UPDATE slike SET id_osebe=NULL WHERE id_osebe = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);

//ohranim vse ratinge
$query = "UPDATE ocena_apartmaja SET id_osebe=NULL WHERE id_osebe = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);

$query = "DELETE FROM osebe WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);

header("Location: users.php");
die();
?>