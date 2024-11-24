<?php
$host = 'localhost';       // Adresse du serveur MySQL
$dbname = 'ecommerce_db';     // Nom de ta base de données
$username = 'root';        // Nom d'utilisateur MySQL (par défaut, c'est 'root')
$password = '';            // Mot de passe MySQL (par défaut, c'est vide pour XAMPP)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie à la base de données!";
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}
?>