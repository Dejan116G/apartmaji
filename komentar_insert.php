<?php
//print_r($_POST);

include_once "session.php";
include_once "database.php";

$id = (int) $_POST['id'];
$komentar = $_POST['komentar'];
$id_osebe = $_SESSION['id_osebe'];

if(!empty($id) && !empty($komentar)){
   $query = "INSERT INTO komentarji(komentar,id_osebe,id_apartmaji) VALUES (?,?,?)";
   $stmt = $pdo->prepare($query);
   $stmt->execute([$komentar,$id_osebe,$id]);
}

odziv("Komentar dodan");

header("Location: apartma.php?id=$id#komentarji");
die();
?>