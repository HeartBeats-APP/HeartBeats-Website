<?php
session_start();

// Vérifie si l'utilisateur est déjà connecté

/*if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
    // Affiche la page d'administration
    header ('Location: index.html' );
    exit;
}*/

// Vérifie si le formulaire a été soumis
if (isset($_POST['password'])) {
    // Vérifie si le mot de passe est valide
    if ($_POST['password'] === 'mot_de_passe') {
        // Connecte l'utilisateur
        $_SESSION['logged_in'] = true;
        // Affiche la page d'administration
        header ('Location: index.html' );
        exit;
    } else {
        // Affiche un message d'erreur
       header ('Location: connect.html' );
    }
}
?>