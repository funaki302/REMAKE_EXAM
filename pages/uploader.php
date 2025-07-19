<?php
include('../inc/functions.php');
session_start();
$id_membre = $_SESSION['user']['id_membre'];
$id_categorie = $_POST['categorie'];
$nom_objet = $_POST['nom_objet'];
$tipe = 0;
$uploadDir = __DIR__ . '/uploads/';
$maxSize = 200 * 1024 * 1024; // 2 Mo 
$allowedMimeTypes = [ 'image/jpeg', 'image/png', 'image/svg+xml', 'image/webp'];
$cas = 0;

// Création du dossier s'il n'existe pas
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
} 

// Vérifie si un fichier est soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['media'])) {
    $file = $_FILES['media'];
    if ($file['error'] !== UPLOAD_ERR_OK) {
        die('Erreur lors de l’upload : ' . $file['error']);
    }
    // Vérifie la taille 
    if ($file['size'] > $maxSize) {
        die('Le fichier est trop volumineux.');
    }
    // Vérifie le type MIME avec `finfo` 
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $file['tmp_name']);
    finfo_close($finfo);
    if (!in_array($mime, $allowedMimeTypes)) {
        die('Type de fichier non autorisé : ' . $mime);
    }

    // Définir $tipe selon le type de fichier
    if ($mime === 'video/mp4' || $mime === 'video/webm' ) {
        $tipe = 2; // Vidéo
    } else {
        $tipe = 1; // Photo
    }

    // Renommer le fichier 
    $originalName = pathinfo($file['name'], PATHINFO_FILENAME);
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $newName = $originalName . '_' . uniqid() . '.' . $extension;

    // Déplace le fichier 
    if (move_uploaded_file($file['tmp_name'], $uploadDir . $newName)) {
        set_new_objects($nom_objet,$id_categorie, $newName, $id_membre);
        header('location:../pages/home.php');
    } else {
        echo "Échec du déplacement du fichier.";
    }
} else {
    echo "Aucun fichier reçu.";
}