<?php

//QUOI ?

// Inclure le fichier de connexion à la base de données
require_once('connect.php');

if (isset($_POST["submit"])) {

    echo "on est dans la boucle"; //print de test
    // Récupérer les valeurs du formulaire
    $mail = $_POST['email'];
    $password = $_POST['password'];
    $cookie = $_POST['stayConnected'];

    // Échapper les caractères spéciaux pour éviter les attaques par injection SQL
    $mail = $conn->quote($mail);
    $password = $conn->quote($password);

    //$login = mysqli_real_escape_string($conn, $login);
    //$mot_de_passe = mysqli_real_escape_string($conn, $mot_de_passe);
    echo $mail;
    echo $password;
    echo "injections";

    // Vérifier si l'adresse e-mail existe déjà dans la base de données
    $stmt = $conn->prepare("SELECT * FROM tests WHERE mail = :mail AND password = :password");
    $stmt->bindParam(':mail', $mail);
    $stmt->bindParam(':password', $password);
    $stmt->execute();
    //$result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "verification";
    echo $stmt->rowCount();

    // Vérifier si l'utilisateur existe dans la base de données
    //if ($result) {
    if ($stmt->rowCount() > 0) {
        // L'utilisateur existe dans la base de données, rediriger vers la page d'accueil
        header("Location: ../account.html");
        exit;
    } else {
        // L'utilisateur n'existe pas dans la base de données, afficher un message d'erreur
        echo "feur";
        exit;
    }
}

// Fermer la connexion à la base de données
$conn->close();
echo "connclose";

//FEUR !

?>