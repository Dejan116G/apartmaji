<?php
//print_r($_POST);

include_once "session.php";
include_once "database.php";

$id = (int) $_POST['id_apartmaji'];
$komentar = $_POST['komentar'];
$id_osebe = $_SESSION['user_id'];

if(!empty($id) && !empty($komentar)){
   $query = "INSERT INTO komentarji(komentar,user_id,id_apartmaji) VALUES (?,?,?)";
   $stmt = $pdo->prepare($query);
   $stmt->execute([$komentar,$id_osebe,$id]);
}

odziv("Komentar dodan");

header("Location: apartma.php?id=$id#komentarji");
die();
?>