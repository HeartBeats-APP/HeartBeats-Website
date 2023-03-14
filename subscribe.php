<?php

// Inclure le fichier de connexion à la base de données
require_once('connect.php');

// Vérifier si le formulaire de connexion a été soumis
if (isset($_POST["submit"])) {
//$request_method = strtoupper(getenv('REQUEST_METHOD'));
//if (true) {

    echo "On est dans la boucle";

    // Récupérer les valeurs du formulaire
    $mail = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];

    // Échapper les caractères spéciaux pour éviter les attaques par injection SQL
    $name = $conn->quote($name);
    $mail = $conn->quote($mail);
    $password = $conn->quote($password);
    echo "Mes conn sur ton front."; //Print de test

    // Vérifier si l'adresse e-mail existe déjà dans la base de données
    $stmt = $conn->prepare("SELECT mail FROM tests WHERE mail = :mail");
    $stmt->bindParam(':mail', $mail);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Jusque là ça marche";


    if ($result) {

        // Adresse e-mail existe déjà dans la base de données
        header("Location: ../../../front/html/alreadythere.html");
        exit;

    } else {

        // Adresse e-mail n'existe pas dans la base de données

        // Préparation de la requête SQL pour insérer l'utilisateur dans la base de données
        $stmt_id = $conn->prepare("SELECT id FROM tests ORDER BY id DESC LIMIT 1");
        $stmt_id->execute();
        $last_id = $stmt_id->fetchColumn();
        $new_id = $last_id + 1;

        echo "On est arrivés jusque là";

        // Préparation de la requête SQL pour insérer l'utilisateur dans la base de données
        $stmt = $conn->prepare("INSERT INTO tests (id, name, mail, password) VALUES (:id, :name, :mail, :password)");

        // Lier les paramètres et exécuter la requête
        $stmt->bindParam(':id', $new_id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':mail', $mail);
        $stmt->execute();

        echo "Pas de problèmes";

        // Requête SQL pour vérifier si l'utilisateur a bien été inscrit
        $stmt_check = $conn->prepare("SELECT * FROM tests WHERE mail=:mail AND password=:password");
        $stmt_check->bindParam(':mail', $mail);
        $stmt_check->bindParam(':password', $password);
        $stmt_check->execute();

        echo "Lesss gooong";

        // Vérifier si l'utilisateur existe dans la base de données
        if ($stmt_check->rowCount() > 0) {
                // L'utilisateur existe dans la base de données, rediriger vers la page d'accueil
                header("Location: ../accout.html");
                exit;
        } else {
                // L'utilisateur n'existe pas dans la base de données, afficher un message d'erreur
                header("Location: /error.html");
                exit;
        }
    }
}

// Fermer la connexion à la base de données
$conn = null;

?>