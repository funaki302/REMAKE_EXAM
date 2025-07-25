<?php
include("../inc/functions.php");
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emprunt</title>
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">
    <script src="../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="home.php">Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="upload.php">Nouvel Object</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="fiche_membre.php">Mon profil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../inc/deconnexion.php">Deconnexion</a>
                    </li>
                </ul>
                <ul>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Bonjour <?= $_SESSION['user']['nom'] ?></a>
                    </li>
                </ul>
                <form class="d-flex" role="search" action="traitement.php" method="post">
                    <input class="form-control " type="search" name="categorie" placeholder="selon categorie"
                        aria-label="Search">
                    <input type="checkbox" name="dispo">
                    <input class="form-control " type="search" name="nom_objet" placeholder="selon nom objet"
                        aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                <input type="checkbox" name="" id="">

            </div>
        </div>
    </nav>