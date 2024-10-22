<?php
session_start();
require_once("pdo.php");

// Vérifier si le message est envoyé
if (isset($_POST['message']) && isset($_SESSION['pseudo'])) {
    // Préparer la requête
    $sql = "INSERT INTO message (message, date_envoi, pseudo) VALUES (:message, NOW(), :pseudo)";
    $stmt = $base_conn->prepare($sql);
    
    // Lier les paramètres
    $stmt->bindParam(':message', $_POST['message']);
    $stmt->bindParam(':pseudo', $_SESSION['pseudo']);
    
    // Exécuter la requête
    $stmt->execute();
}

// Rediriger vers la page d'accueil
header("location: index.php");
exit(); // Toujours exit après un header redirect
?>
