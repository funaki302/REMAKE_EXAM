<?php
 include("header.php");
 $id_objet = $_GET['id_objet'];
 $objet = avoir_objet($id_objet); 
 $historiques = historique_emprunt($id_objet);
?>
<main>
    <header>
        <h1 class="text-center"><strong>
            Fiche de l'objet: <?= $objet['nom_objet'] ?>
        </strong></h1>
    </header>
    <div class="contenaire">
        <div class="row">
            <p> <strong>Nom</strong>: <?= $objet['nom_objet'] ?></p>
            <p> <strong>Categorie</strong>: <?= $objet['nom_categorie'] ?></p>
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