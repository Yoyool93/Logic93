<?php
session_start();

// Vérifier que le produit existe dans le panier
if (isset($_SESSION['cart'][$produitSlug])) {
    unset($_SESSION['cart'][$produitSlug]);
}

// Rediriger l'utilisateur vers la page du panier
header('Location: ' . BASE_DIR . '/paniers');
exit;
