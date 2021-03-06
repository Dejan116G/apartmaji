<?php
include_once "header.php";
adminOnly();
include_once "database.php";

$id = (int) $_GET['id'];

$query = "SELECT * FROM apartmaji WHERE id_apartmaji = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);



if($stmt->rowCount() != 1){
    header("Location: index.php");
    die();
}
$apartmaji = $stmt->fetch();

?>

<section class="page-section">
    <div class="container">
        <!-- Registration Section Heading-->
        <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Uredi apartma</h2>
        <!-- Icon Divider-->
        <div class="divider-custom">
            <div class="divider-custom-line"></div>
            <div class="divider-custom-icon"><i class="fas fa-star"></i></div>
            <div class="divider-custom-line"></div>
        </div>
        <!-- Registration Section Form-->
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19.-->
                <form action="apartma_posodobi.php" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $apartmaji['id_apartmaji'];?>" />
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label>Ime</label>
                            <input class="form-control" type="text" name="ime" placeholder="Vnesite ime"
                                required="required" value="<?php echo $apartmaji['ime'];?>" /> <br />
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label>Opis</label>
                            <textarea name="opis" class="form-control" rows="5"
                                placeholder="Vnesi opis apartmaja"><?php echo $apartmaji['opis'];?></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label>Cena (???)</label>
                            <input class="form-control" type="text" name="cena"
                                placeholder="Vnesite ceno no??itve" value="<?php echo $apartmaji['cena'];?>"/> <br />
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label>Slika</label>
                            <input class="form-control" type="file" name="zgradba" placeholder="Vnesite sliko" /> <br />
                        </div>
                    </div>
            </div>
            <div class="control-group">
                        <div class="form-group floating-label-form-group controls mb-0 pb-2">
                            <label>Ocena</label>
                            <input class="form-control" type="text" name="ocena" placeholder="Vnesite trenutno oceno"/> <br />
                        </div>
                    </div>
            <br />
            <div id="success"></div>
            <div class="form-group"><button class="btn btn-primary btn-xl" id="sendMessageButton"
                    type="submit">Shrani</button></div>
            </form>
        </div>
 
    </div>
    </div>
</section>




<?php
include_once "footer.php";
?>