<?php
include_once "session.php";

adminOnly();

include_once "database.php";

$ime_slike = $_POST['ime_slike'];
$id = (int) $_POST['id_slike'];

$target_dir = "images/";

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
if ($uploadOk = 1){
    
if (move_uploaded_file($_FILES["url"]["tmp_name"], $target_file)) {
    $query  = "INSERT INTO slike(ime_slike,url,id_apartmaji) VALUES(?,?,?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$ime_slike,$target_file,$id]);

    odziv("slika dodana");

    header("Location: apartma.php?id=$id");
    die();

} else {
    header("Location: apartma.php?id=$id");
    die();
    }




}
else{
header("Location: apartma.php?id=$id");
die();
}

?>