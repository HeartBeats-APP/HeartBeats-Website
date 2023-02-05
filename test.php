<?php

// Paramètres de connexion à la base de données
include 'tests/db_config.php';

try {
    // Créer une connexion à la base de données
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Définir le mode d'erreur de PDO sur exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Récupérer l'adresse e-mail du formulaire
    $email = $_POST['email'];

    // Vérifier si l'adresse e-mail existe déjà dans la base de données
    $stmt = $conn->prepare("SELECT email FROM preco WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

     if ($result) {
        // Adresse e-mail existe déjà dans la base de données
        header("Location: alreadythere.html");
        exit;
    } else {
        // Adresse e-mail n'existe pas dans la base de données
        // Préparer la requête pour insérer l'adresse e-mail dans la base de données
        $stmt = $conn->prepare("INSERT INTO preco (email) VALUES (:email)");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Rediriger vers la page de réussite
        header("Location: success.html");
        exit;
    }
} catch(PDOException $e) {
    // Afficher le code d'erreur
    header("Location: tesperdu.html");
    echo "Error: " . $e->getMessage();
    exit;
}

$conn = null;

?>