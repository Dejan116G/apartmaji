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
    $uploadOk = 0;
  }

// Check file size
if ($_FILES["avatar"]["size"] > 5000000) {
    $uploadOk = 0;
  }

  // Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  $uploadOk = 0;
}


//preverim, ali so podatki polni
if ($uploadOk = 1){
    
if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $target_file)) {
    $query  = "UPDATE osebe SET avatar = ? WHERE id_osebe = ?";
    /*echo $query;
    echo $id;
    echo $_FILES["avatar"]["tmp_name"];
    echo $target_file;
    die();*/
    $stmt = $pdo->prepare($query);
    $stmt->execute([$target_file,$id]);
//die();
    header("Location: profil.php");
    die();
    
} else {
    header("Location: profil.php");
    die();
    
    }

    odziv("Slika je zamenjana."); 


}
else{
odziv("Slika ni zamenjana."); 
header("Location: profil.php");
die();
}

?>