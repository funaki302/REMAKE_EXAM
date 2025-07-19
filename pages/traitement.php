<?php 
 include("../inc/functions.php");
    session_start();
    // login
    if(isset($_POST['email']) && isset($_POST['mdp']) && !isset($_POST['nom'])) {
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $user = login($email, $mdp);
        
        if($user) {
            $_SESSION['user'] = $user;
            header("Location: home.php");
            exit();
        } else {
            $_SESSION['mes'] = "Invalid email or password.";
            header("Location: login.php");
            exit();
        }
    }

    // inscription
    if(isset($_POST['nom']) && isset($_POST['dtn']) && isset($_POST['ville']) && isset($_POST['genre'])) {
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $nom = $_POST['nom'];
        $dtn = $_POST['dtn'];
        $ville = $_POST['ville'];
        $genre = $_POST['genre'];

        if(inscription($email, $mdp, $nom, $dtn, $ville, $genre)) {
            $_SESSION['mes'] = "Inscription successful!";
            $user = login($email, $mdp);
            $_SESSION["user"] = $user;
            header("Location: home.php");
            exit();
        } else {
            $_SESSION['mes'] = "Inscription failed.";
            header("Location: Inscription.php");
            exit();
        }
    }

    // recherche
    if(isset($_POST['categorie']) && isset($_POST['nom_objet']))
    {
        $categorie = $_POST['categorie'];
        $nom_objet = $_POST['nom_objet'];
        unset($_SESSION['recherche']);
        $dispo = 0;  // si non checker
        if(isset($_POST['dispo'])){
            // si checker
            $dispo = 1;
        }
        $_SESSION['recherche'] = recherche($categorie,$nom_objet,$dispo);
        $_SESSION['dispo'] = $dispo;
        header("Location:result.php");
        exit();
    }
?>