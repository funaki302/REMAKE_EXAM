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
    $sql = "SELECT * FROM v_all_info_objet";
    $result = mysqli_query(dbconnect(), $sql);
    $list = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $list[] = $row;
    }
    return $list;
}

function disponibilite($id_objet){
    $sql = "SELECT date_retour FROM v_all_info_objet WHERE id_objet = '$id_objet' AND date_retour > now()";
    $result = mysqli_query(dbconnect(), $sql);
    if (mysqli_num_rows($result) > 0) {
        $rest = mysqli_fetch_assoc($result);
        return "Disponible a partir du " . $rest['date_retour'];
    } else {
        return "Disponible";
    }
    
}

function get_list_object_categorie($id_categorie)
{
    $sql = "SELECT * FROM v_all_info_objet WHERE id_categorie = '$id_categorie'";
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
?>