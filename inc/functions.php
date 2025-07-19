<?php 
 include("connexion.php");

 function login($email, $mdp) {
     global $pdo;
     $stmt = $pdo->prepare("SELECT * FROM membres WHERE email = :email AND mdp = :mdp");
     $stmt->execute(['email' => $email, 'mdp' => $mdp]);
     return $stmt->fetch();
 }

 function inscription($email, $mdp,$nom,$dtn,$ville,$genre ) {
    $sql = "INSERT INTO membres (email, mdp, nom, date_naissance, ville, genre) VALUES ('$email', '$mdp', '$nom', '$dtn', '$ville', '$genre')";
    $result = mysqli_query(dbconnect(), $sql);
    if ($result) {
        return true;
    } else {
        return false;
    }
 }

?>