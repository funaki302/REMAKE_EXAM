<?php

include("connexion.php");

function login($email, $mdp)
{
    $sql = "SELECT * FROM membre WHERE email = '$email' AND mdp = '$mdp'";
    $result = mysqli_query(dbconnect(), $sql);

    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

function inscription($email, $mdp, $nom, $dtn, $ville, $genre)
{
    $sql = "INSERT INTO membre (email, mdp, nom, date_naissance, ville, genre) VALUES ('$email', '$mdp', '$nom', '$dtn', '$ville', '$genre')";
    $result = mysqli_query(dbconnect(), $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function get_user_info($id_membre)
{
    $sql = "SELECT * FROM v_all_info_membre WHERE id_membre = '$id_membre'";
    $result = mysqli_query(dbconnect(), $sql);
    $rest = mysqli_fetch_assoc($result);
    return $rest;
}

function get_list_object()
{
    $sql = "SELECT * FROM v_all_info_categorie";
    $result = mysqli_query(dbconnect(), $sql);
    $list = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $list[] = $row;
    }
    return $list;
}

function disponibilite($id_objet)
{
    $sql = "SELECT date_retour FROM v_all_info_objet_emprunter WHERE id_objet = '$id_objet' AND date_retour > now()";
    $result = mysqli_query(dbconnect(), $sql);
    if ($result && mysqli_num_rows($result) > 0) {
        $rest = mysqli_fetch_assoc($result);
        return "Disponible a partir du " . $rest['date_retour'];
    } else {
        return "Disponible";
    }

}

function get_list_object_categorie($id_categorie)
{
    $sql = "SELECT * FROM v_all_info_categorie WHERE id_categorie = '$id_categorie'";
    $result = mysqli_query(dbconnect(), $sql);
    $list = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $list[] = $row;
    }
    return $list;
}

function get_list_categorie()
{
    $sql = "SELECT * FROM categorie_objet";
    $result = mysqli_query(dbconnect(), $sql);
    $list = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $list[] = $row;
    }
    return $list;
}

function avoir_categorie($id_categorie)
{
    $sql = "SELECT * FROM categorie_objet WHERE id_categorie = '$id_categorie'";
    $result = mysqli_query(dbconnect(), $sql);
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

function set_new_images($id_object, $nom_image)
{
    $sql = "INSERT INTO images_objet (id_objet,nom_image) 
    VALUES ('$id_object', '$nom_image')";
    $result = mysqli_query(dbconnect(), $sql);
}

function get_id_object($nom_object, $id_categorie, $id_membre)
{
    $sql = "SELECT id_objet FROM objet 
    WHERE nom_objet = '$nom_object' AND id_categorie = '$id_categorie' AND id_membre = '$id_membre'";
    $result = mysqli_query(dbconnect(), $sql);
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result)['id_objet'];
    } else {
        return false;
    }
}

function set_new_objects($nom_object, $id_categorie, $nom_image, $id_membre)
{
    $sql = "INSERT INTO objet (nom_objet, id_categorie, id_membre) 
    VALUES ('$nom_object', '$id_categorie', '$id_membre')";
    $result = mysqli_query(dbconnect(), $sql);

    $id_object = get_id_object($nom_object, $id_categorie, $id_membre);
    set_new_images($id_object, $nom_image);
}

function avoir_objet($id_objet)
{
    $sql = "SELECT * FROM v_all_info_categorie WHERE id_objet = '$id_objet'";
    $result = mysqli_query(dbconnect(),$sql);
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result);
    } else {
        return false;
    }
}

function historique_emprunt($id_objet)
{
    $sql = "SELECT nom_objet,nom_categorie,date_emprunt,date_retour,nom,id_membre FROM v_all_info_objet_emprunter WHERE id_objet = '$id_objet'";
    $result = mysqli_query(dbconnect(),$sql);
    $list = [];

    while ($result && $row = mysqli_fetch_assoc($result)) {
        $list[] = $row;
    }
    return $list;

}

function get_images_objet($id_objet)
{
    $sql = "SELECT * FROM images_objet WHERE id_objet = '$id_objet'";
    $result = mysqli_query(dbconnect(),$sql);
    $list = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $list[] = $row;
    }
    return $list;

}

function recherche($categorie,$nom_objet,$dispo)
{
    $conditions = [];
    if (!empty($nom_objet)) {
        $conditions[] = "(nom_objet LIKE '%$nom_objet%')";
    }
    if (!empty($categorie)) {
        $conditions[] = "(nom_categorie LIKE  '%$categorie%')";
    }
    
    $sql = "SELECT * FROM v_all_info_categorie";
    
    if (!empty($conditions)) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    $result = mysqli_query(dbconnect(), $sql);
    $retour = [];
    while ($result && $donnes = mysqli_fetch_assoc($result)) {
        $retour[] = $donnes;
    }
    
    /*$fin = [];
    if($dispo === "1") {
        foreach($retour as $obj){
            $verifier = disponibilite($obj['id_objet']);
            if($verifier === "Disponible"){
                $fin[] = $obj;
            }
        }
    }
    if($dispo === "0") {
        foreach($retour as $obj){
            $verifier = disponibilite($obj['id_objet']);
            if($verifier === "Disponible"){
                $fin[] = $obj;
            }
        }
    }*/
    return $retour;
}

function get_id_membre($nom, $email, $mdp)
{
    $sql = "SELECT id_membre FROM membre 
    WHERE nom = '$nom' AND email = '$email' AND mdp = '$mdp'";
    $result = mysqli_query(dbconnect(), $sql);
    if (mysqli_num_rows($result) > 0) {
        return mysqli_fetch_assoc($result)['id_membre'];
    } else {
        return false;
    }
}

function get_list_object_membre($id_membre)
{
    $sql = "SELECT * FROM v_all_info_categorie WHERE id_membre = '$id_membre' order by nom_categorie";
    $result = mysqli_query(dbconnect(),$sql);
    $list = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $list[] = $row;
    }
    return $list;
}

function delete_image($id_image, $nom_image)
{
    $sql = "DELETE FROM images_objet WHERE id_image = '$id_image' AND nom_image = '$nom_image'";
    $result = mysqli_query(dbconnect(), $sql);
    if ($result) {
       unlink(__DIR__ . "/uploads/" . $nom_image); 
        return true;
    } else {
        return false;
    }
}
?>