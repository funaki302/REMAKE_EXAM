<?php
 include("header.php");
 $id_objet = $_GET['id_objet'];
 $objet = avoir_objet($id_objet); 
 $historiques = historique_emprunt($id_objet);
 $images = get_images_objet($id_objet);
?>
<main>
    <header>
        <h1 class="text-center"><strong>
            Fiche de l'objet: <?= $objet['nom_objet'] ?>
        </strong></h1>
    </header>
    <div class="contenaire">
        <div class="row text-center">
            <p> <strong>Nom</strong>: <?= $objet['nom_objet'] ?></p>
            <p> <strong>Categorie</strong>: <?= $objet['nom_categorie'] ?></p>
        </div>
<br>

    <div id="carouselExampleIndicators" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <?php foreach($images as $image) : ?>
            <div class="carousel-item active">
                <img src="./uploads/<?= $image['nom_image'] ?>" class="d-block w-100" width="400" height="400" alt="">
            </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
</div>
<br>
<?php if(empty($historiques)) { ?>
    <p><h2 class="text-center">Aucun historique d'emprunt</h2></p>
<?php } else{ ?>
    <p><h2 class="text-center">Historique des Emprunts</h2></p>
    <table class="table table-dark">
        <thead>
            <tr>
                <th scope="col">Nom de l'emprunteur</th>
                <th scope="col">Date de l'emprunt</th>
                <th scope="col">Date de retour</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($historiques as $histo) : ?>
                <tr>
                    <td><?= $histo['nom'] ?></td>
                    <td><?= $histo['date_emprunt'] ?></td>
                    <td><?= $histo['date_retour'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php } ?>
    </div>
</main>