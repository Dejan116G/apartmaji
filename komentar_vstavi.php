<?php



include_once "session.php";
include_once "database.php";
//print_r($_POST);
//print_r($_SESSION);
//die();
$id = (int) $_POST['id_apartmaji'];
$komentar = $_POST['komentar'];
$user_id = $_SESSION['user_id']; // ce dam id_osebe mi dela ampak ne vpise id_osebe v tabelo komentarji
//echo $id;
//echo $komentar;
//echo $user_id;
//die();

if(!empty($id) && !empty($komentar)){
   $query = "INSERT INTO komentarji(komentar,id_osebe,id_apartmaji) VALUES (?,?,?)";
   $stmt = $pdo->prepare($query);
   $stmt->execute([$komentar,$user_id,$id]);
   //die();
}

odziv("Komentar dodan");

header("Location: apartma.php?id=$id#komentarji");
die();
?>