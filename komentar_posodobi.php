<?php
include_once "session.php";
include_once "database.php";

$id = (int) $_POST['id_komentarji'];
$komentar = $_POST['komentar'];
$id_osebe = $_SESSION['user_id'];

// pogledam za katero kriptovaluto gre
$query = "SELECT * FROM komentarji WHERE id_komentarji = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);
$apartmaji = $stmt->fetch();
$apartmaji_id=$apartmaji['id_apartmaji'];

//uredi le, če je trenutno prijavljen lastnik avtor komentarja.
$query = "UPDATE komentarji SET komentar=? where id_komentarji = ? AND user_id = ? ";
$stmt = $pdo->prepare($query);
$stmt->execute([$komentar,$id,$id_osebe]);

odziv("Komentar posodobljen");

header("Location: apartma.php?id=$apartmaji_id#komentarji");
die();
?>