<?php 
 include("header.php");
 $objets = get_list_object_membre($_SESSION['user']['id_membre']);
?>
<main>
    <div class="contenaire">
        <p><h1 class="text-center">Fiche du membre <?= $_SESSION['user']['nom'] ?></h1></p>
        <br>
        <div class="row fiche">
            <p><strong>Nom :</strong> <?= $_SESSION['user']['nom'] ?></p>
            <p><strong>Genre :</strong><?= $_SESSION['user']['genre'] ?></p>
            <p><strong>Email :</strong><?= $_SESSION['user']['email'] ?></p>
            <p><strong>Date de naissance :</strong> <?= $_SESSION['user']['date_naissance'] ?></p>
            <p><strong>Ville :</strong><?= $_SESSION['user']['ville'] ?></p>
        </div>
        <br>
        <?php if(empty($objets)) {?>
            <p><h2 class="text-center">Vous n'avez encore aucun objet</h2></p>
        <?php } else { ?>
            <p><h2 class="text-center">Liste de vos objets</h2></p>
            <table class="table table-dark">
                <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Categorie</th>
                        <th scope="col">Disponibilite</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($objets as $object) : 
                    $dispo = disponibilite($object['id_objet']); ?>
                        <tr class="table-active">
                            <td><a href="fiche.php?id_objet=<?= $object['id_objet'] ?>"><?= $object['nom_objet'] ?></a></td>
                            <td><?= $object['nom_categorie'] ?></td>
                            <td><?= $dispo ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
</main>