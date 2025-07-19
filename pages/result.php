<?php
 include("header.php");
?>
<main>
    <div class="contenaire">
        <?php if(empty($_SESSION['recherche'])) {?>
            <p><h2 class="text-center">Aucun resultat</h2></p>
        <?php } else {?>
            <p><h2 class="text-center">Resultats de recherche</h2></p>
            <br>
            <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Categorie</th>
                    <th scope="col">Disponibilite</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($_SESSION['recherche'] as $object) : 
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