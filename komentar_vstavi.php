<?php
//print_r($_POST);

include_once "session.php";
include_once "database.php";

$id = (int) $_POST['id_apartmaji'];
$komentar = $_POST['komentar'];
$user_id = $_SESSION['user_id'];

if(!empty($id) && !empty($komentar)){
   $query = "INSERT INTO komentarji(komentar,id_osebe,id_apartmaji) VALUES (?,?,?)";
   $stmt = $pdo->prepare($query);
   $stmt->execute([$komentar,$user_id,$id]);
}

odziv("Komentar dodan");

header("Location: apartma.php?id=$id#komentarji");
die();
?>