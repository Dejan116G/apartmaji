<?php
include_once "session.php";
adminOnly();
include_once "database.php";

$ime = $_POST['ime'];
$opis = $_POST['opis'];
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
    $query  = "INSERT INTO apartmaji(ime,opis,cena,zgradba) VALUES(?,?,?,?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$ime,$opis,$cena,$target_file]);

    header("Location: apartmaji.php");
    die();

} else {
    header("Location: apartmaji_add.php");
    die();
    }




}
else{
header("Location: apartmaji_add.php");
die();
}

   
?>