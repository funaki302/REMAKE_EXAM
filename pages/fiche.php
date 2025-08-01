<?php
include("header.php");
$id_objet = $_GET['id_objet'];
$_SESSION['id_objet'] = $id_objet;
$objet = avoir_objet($id_objet);
$historiques = historique_emprunt($id_objet);
$images = get_images_objet($id_objet);
?>
<style>
    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        display: block;
        margin-bottom: 6px;
        color: #ccc;
    }

    .form-group input[type="text"],
    .form-group textarea,
    .form-group input[type="file"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #444;
        border-radius: 6px;
        background-color: #2a2a2a;
        color: white;
        font-size: 15px;
    }

    .form-group input[type="file"] {
        padding: 6px;
    }

    .form-group textarea {
        resize: vertical;
        height: 80px;
    }

    .btn-upload {
        width: 100%;
        padding: 12px;
        background-color: #00ffff;
        color: black;
        font-weight: bold;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-upload:hover {
        background-color: #00cccc;
    }

    .back-link {
        text-align: center;
        margin-top: 20px;
        font-size: 14px;
    }

    .back-link a {
        color: #00ffff;
        text-decoration: none;
    }

    .back-link a:hover {
        text-decoration: underline;
    }
</style>
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

        <form action="uploader.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="media">Fichier (image)</label>
                <input type="file" id="media" name="media" accept="image/*" required>
                <input type="hidden" name="id_objet_1" value="<?= $id_objet ?>">
            </div>
            <button type="submit" class="btn-upload">Inserer une image</button>
        </form>

        <div id="carouselExampleIndicators" class="carousel slide">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <?php foreach ($images as $image): ?>
                    <div class="carousel-item active">
                        <form action="traitement.php" method="post">
                            <p class="text-center"><input type="submit" value="Supprimer" id="suppr"></p>
                            <img src="./uploads/<?= $image['nom_image'] ?>" class="d-block w-100" width="400" height="400"
                                alt="">
                            <input type="hidden" name="id_image" value="<?= $image['id_image'] ?>">
                            <input type="hidden" name="nom_image" value="<?= $image['nom_image'] ?>">
                        </form>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <br>
        <?php if (empty($historiques)) { ?>
            <p>
            <h2 class="text-center">Aucun historique d'emprunt</h2>
            </p>
        <?php } else { ?>
            <p>
            <h2 class="text-center">Historique des Emprunts</h2>
            </p>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">Nom de l'emprunteur</th>
                        <th scope="col">Date de l'emprunt</th>
                        <th scope="col">Date de retour</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($historiques as $histo): ?>
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