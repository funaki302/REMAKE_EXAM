<?php
include("connexion.php");

function login($email, $mdp)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM membres WHERE email = :email AND mdp = :mdp");
    $stmt->execute(['email' => $email, 'mdp' => $mdp]);
    return $stmt->fetch();
}

function inscription($email, $mdp, $nom, $dtn, $ville, $genre)
{
    $sql = "INSERT INTO membres (email, mdp, nom, date_naissance, ville, genre) VALUES ('$email', '$mdp', '$nom', '$dtn', '$ville', '$genre')";
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
    $sql = "SELECT * FROM v_all_info_objet group by id_objet";
    $result = mysqli_query(dbconnect(), $sql);
    $list = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $list[] = $row;
    }
    return $list;
}
?>