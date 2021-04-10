<?php
//print_r($_POST);

include_once "session.php";
include_once "database.php";

$id = (int) $_POST['id_apartmaji'];
$rate = (int) $_POST['star'];
$user_id = $_SESSION['user_id'];
echo $id;
echo $rate;
echo $user_id;
if (!empty($id) && !empty($rate)) {
    $query = "INSERT INTO ocena_apartmaja(ocene,id_osebe,id_apartmaji) VALUES (?,?,?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$rate,$user_id,$id]);

    //posodobim povprečno vrednost za rating kriptovalute
    $query = "UPDATE apartmaji SET ocena = (SELECT AVG(ocene) FROM ocena_apartmaja WHERE id_apartmaji = ?) WHERE id_apartmaji = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$id,$id]);
}

odziv("Uspešno dodana ocena");

header("Location: apartma.php?id=$id");
die();
?>