<?php
session_start();

if(isset($_POST['produitSlug']) && isset($_POST['quantite'])){
    $produitSlug = $_POST['produitSlug'];
    $quantite = $_POST['quantite'];

    if(!isset($_SESSION['cart'][$produitSlug])){
        $_SESSION['cart'][$produitSlug] = ['quantite' => $quantite];
    } else {
        $_SESSION['cart'][$produitSlug]['quantite'] += $quantite;
    }
}
