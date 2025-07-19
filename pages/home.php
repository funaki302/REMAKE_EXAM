<?php
include("header.php");
$list_object = get_list_object();
?>
<main>
    <div class="container">

        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Categorie</th>
                    <th scope="col">Disponibilite</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_object as $object) : ?>
                <tr class="table-active">
                    <td><?= $object['nom_objet'] ?></td>
                    <td><?= $object['nom_categorie'] ?></td>
                    <td><?= $object['date_retour'] ?></td>
                </tr>
               <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
    include("footer.php");
    ?>