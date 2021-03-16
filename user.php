<?php
include_once "header.php";
include_once "database.php";

$id = (int) $_GET['id'];

$query = "SELECT* FROM osebe WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);

if($stmt->rowCount() != 1){
    header("Location: index.php");
    die();
}
$osebe= $stmt->fetch();

?>


<?php
//prikaže povezavo samo administratorjem
if(admin()){
?>
<a href="user_delete.php?id=<?php echo $osebe['id'];?>" class="btn btn-primary"
    onclick="return confirm('Prepričani?')">Izbriši</a>
<?php
}
?>
<section class="masthead bg-primary text-white text-center">
    <div class="container d-flex align-items-center flex-column">
        <!-- Masthead Avatar Image-->
        <?php
        if(!empty($osebe['avatar'])){
                $avatar = $osebe['avatar'];
              }
              else {
                  $avatar = './assets/img/no-photo.jpg';
              }
        ?>
        <img class="masthead-avatar mb-5" src="<?php echo $avatar;?>" alt="" />
        <!-- Masthead Heading-->
        <h1 class="masthead-heading text-uppercase mb-0"><?php echo $osebe'ime'].' '.$osebe'priimek'];?></h1>
        <!-- Icon Divider-->
        <div class="divider-custom divider-light">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Masthead Subheading-->
        <p class="masthead-subheading font-weight-light mb-0"><?php echo $osebe['opis'];?></p>
        </div>
         </div>
   
</section>


<?php
include_once "footer.php";
?>