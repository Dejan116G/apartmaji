<?php
include_once "session.php";
include_once "database.php";



$id = $_SESSION['user_id'];

$target_dir = "avatars/";

$random = date('YmdHisu'); 

$target_file = $target_dir . $random . basename($_FILES["avatar"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

//preveri ali datoteka ima dejansko velikost
$check = getimagesize($_FILES["avatar"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
    $uploadOk = 2;
  }

// Check file size
if ($_FILES["avatar"]["size"] > 5000000) {
    $uploadOk = 3;
  }

  // Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $uploadOk = 4;
}


//preverim, ali so podatki polni
if ($uploadOk = 1){
    
if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
    $query  = "UPDATE osebe SET avatar = ? WHERE id_osebe = ?";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$title,$id]);

    header("Location: profil.php");
    die();

} else {
    header("Location: profil.php");
    die();
    }




}
else{
header("Location: profil.php");
die();
}

?>