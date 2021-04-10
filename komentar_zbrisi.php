<?php 
include_once "session.php";
include_once "database.php";

$id = (int) $_GET['id'];
$id_osebe = $_SESSION['user_id'];

//pogledam za kateri apartma gre
$query = "SELECT * FROM komentarji WHERE id_komentarji = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);
$apartmaji = $stmt->fetch();
$id_apartmaji=$apartmaji['id_apartmaji'];

//izbriše le, če je trenutno prijavljeni lastnik avtor komentarja
$query = "DELETE FROM komentarji WHERE id_komentarji = ? AND id_osebe = ? ";
$stmt = $pdo->prepare($query);
$stmt->execute([$id,$id_osebe]);

odziv("Komentar izbrisan");

header("Location: apartma.php?id=$id_apartmaji#komentarji");
die();

?>