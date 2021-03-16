<?php
include_once "session.php";
adminOnly();
include_once "database.php";

$id = $_POST['id'];

$max_oseb= $_POST['max_oseb'];
$opis = $_POST['opis'];
$stevilo_sob = $_POST['stevilo_sob'];
$cena= floatval($_POST['cena']); //kzezerzezrz0,64646agaggag => 0


$target_dir = "uploads/";

$random = date('YmdHisu'); 

$target_file = $target_dir . $random . basename($_FILES["url"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//preveri ali datoteka ima dejansko velikost
$check = getimagesize($_FILES["url"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 2;
  }

// Check file size
if ($_FILES["url"]["size"] > 5000000) {
    $uploadOk = 3;
  }

  // Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $uploadOk = 4;
}


//preverim, ali so podatki polni
if(!empty($max_oseb) && ($uploadOk = 1)){

if (move_uploaded_file($_FILES["url"]["tmp_name"], $target_file)) {
    $query  = "UPDATE apartmaji SET max_oseb=?,opis=?,cena=?,stevilo_sob=? WHERE id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$max_oseb,$dopis,$cena,$stevilo_sob]);

    $query  = "UPDATE slike SET url=? WHERE id=?";
    $stmt = $pdo->prepare($query);
    $stmt->execute($target_file]);

    header("Location: apartmaji.php?id=".$id);
    die();

} else {
    header("Location: apartmaji_add.php?id=".$id);
    die();
    }




}
else{
header("Location: apartmaji_add.php?id=".$id);
die();
}

   
?>