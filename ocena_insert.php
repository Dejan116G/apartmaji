<?php
//print_r($_POST);

include_once "session.php";
include_once "database.php";

$id = (int) $_POST['id'];
$ocena = (int) $_POST['star'];
$id_osebe = $_SESSION['id_osebe'];

if(!empty($id) && !empty($ocena)){
   $query = "INSERT INTO ocena_apartmaja(ocena,id_osebe,id_apartmaji) VALUES (?,?,?)";
   $stmt = $pdo->prepare($query);
   $stmt->execute([$ocena,$id_osebe,$id]);

   // posodobim povprečno oceno apartmaja
   $query = "UPDATE ocena_apartmaja SET ocena = (SELECT AVG(ocena) FROM ocena_apartmaja WHERE id_apartmaji = ?) WHERE id = ?";
   $stmt = $pdo->prepare($query);
   $stmt->execute([$id,$id]);
}

odziv("uspešno dodana ocena");

header("Location: apartma.php?id=$id");
die();
?>