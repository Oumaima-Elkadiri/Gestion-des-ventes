<?php
    require_once('conn.php');
    $ref = $_GET['ref'];
    $image = $_GET['image'];
    $sql = "DELETE FROM produit WHERE refPdt = '$ref'";
    if(mysqli_query($conn,$sql)){
        $chemin_dossier = "Images/"; 
        $chemin_complet = $chemin_dossier . $image;
        if (file_exists($chemin_complet)) {
            unlink($chemin_complet);
        }
        header("location:produits.php");
    }
?>
    