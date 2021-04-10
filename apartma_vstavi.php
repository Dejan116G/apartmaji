<?php
include_once "session.php";
adminOnly();
include_once "database.php";

$ime = $_POST['ime'];
$opis = $_POST['opis'];
$max_oseb = floatval($_POST['max_oseb']);
$stevilo_sob = floatval($_POST['stevilo_sob']);
$ocena = $_POST['ocena'];
$cena = floatval($_POST['cena']); //kzezerzezrz0,64646agaggag => 0


$target_dir = "uploads/";

$random = date('YmdHisu'); 

$target_file = $target_dir . $random . basename($_FILES["zgradba"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//preveri ali datoteka ima dejansko velikost
$check = getimagesize($_FILES["zgradba"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 2;
  }

// Check file size
if ($_FILES["zgradba"]["size"] > 5000000) {
    $uploadOk = 3;
  }

  // Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $uploadOk = 4;
}


//preverim, ali so podatki polni
if(!empty($ime) && ($uploadOk = 1)){

if (move_uploaded_file($_FILES["zgradba"]["tmp_name"], $target_file)) {
    $query  = "INSERT INTO apartmaji(ime,opis,cena,max_oseb,stevilo_sob,zgradba,ocena) VALUES(?,?,?,?,?,?,?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$ime,$opis,$cena,$max_oseb,$stevilo_sob,$target_file,$ocena]);

    header("Location: apartmaji.php");
    die();

} else {
    header("Location: apartma_dodaj.php");
    die();
    }




}
else{
header("Location: apartma_dodaj.php");
die();
}

   
?>