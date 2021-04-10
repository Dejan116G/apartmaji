<?php
include_once "header.php";
?>
<?php
//prikaže povezavo samo administratorjem
if(admin()){
?>
<a href="apartma_dodaj.php" class="btn btn-primary">Dodaj apartma</a>
<?php
}
?>

<section class="page-section portfolio">
    <div class="container">
        <!-- Portfolio Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Apartmaji</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Portfolio Grid Items-->
        <div class="row justify-content-center">
            <?php
            include_once "database.php"; 
            $query = "SELECT * FROM apartmaji";
            

            $stmt = $pdo->prepare($query);
            $stmt->execute();
            while($row = $stmt->fetch()){
              echo '<div class="col-md-6 col-lg-4 mb-5">';
              echo '<div class="portfolio-item mx-auto">';
              echo '<a href="apartma.php?id='.$row['id_apartmaji'].'">';
              echo '<div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">';
              ?><h2 style="color:white"> Cena nočitve: <?php
              echo '<div class="portfolio-item-caption-content text-center text-white">'.$row['cena'].'</div>';
              ?> EUR (€) </h2><?php
              echo '</div>';
              echo '<img class="img-fluid" src="'.$row['zgradba'].'" alt="" />';
              echo '<h3 class="justify-content-center row align-items-center">'.$row['ime'].'</h3>';
              echo '</a>';
              echo '</div>';
              echo '</div>';
             }
?>
            <!-- Portfolio Item 1-->
           
        </div>
    </div>
</section>



<?php
include_once "footer.php";
?>