<?php
include("header.php");
$categories = get_list_categorie();
if(isset($_GET['id_categorie']) && $_GET['id_categorie'] != '') {
    $id_categorie = $_GET['id_categorie'];
    $list_object = get_list_object_categorie($id_categorie);
} else {
    $list_object = get_list_object();
}
?>
<main>
    <div class="container">
        
        <p class="text-center"><strong>Filtrer par categorie</strong></p>
        <form action="home.php" method="get">
            <select name="id_categorie" id="">
                <option value="">Toutes les categories</option>
                <?php foreach($categories as $category): ?>
                    <option value="<?= $category['id_categorie'] ?>"><?= $category['nom_categorie'] ?></option>
                <?php endforeach; ?>
            </select>
            <br>
            <input type="submit" value="Filtrer">
        </form>
        
            <h1 class="text-center">Liste des objets</h1>
        <table class="table table-dark">
            <thead>
                <tr>
                    <th scope="col">Nom</th>
                    <th scope="col">Categorie</th>
                    <th scope="col">Disponibilite</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($list_object as $object) : 
                   $dispo = disponibilite($object['id_objet']); ?>
                <tr class="table-active">
                    <td><a href="fiche.php?id_objet=<?= $object['id_objet'] ?>"><?= $object['nom_objet'] ?></a></td>
                    <td><?= $object['nom_categorie'] ?></td>
                    <td><?= $dispo ?></td>
                </tr>
               <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php
    include("footer.php");
    ?>