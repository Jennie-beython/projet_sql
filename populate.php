<?php
// Connexion à la base
$pdo = new PDO("mysql:host=localhost;dbname=ecommerce_db;charset=utf8", "root", "");

// Données à insérer
$username = 'user1';
$email = 'user1@example.com';
$name = 'Utilisateur 1';
$password = password_hash('password123', PASSWORD_BCRYPT);

// Vérifier si le nom d'utilisateur existe déjà
$stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
if ($stmt->fetchColumn() > 0) {
    echo "L'utilisateur $username existe déjà.";
} else {
    // Insérer seulement si l'utilisateur n'existe pas
    $insert = $pdo->prepare("INSERT INTO users (username, email, name, password) VALUES (:username, :email, :name, :password)");
    $insert->execute([
        'username' => $username,
        'email' => $email,
        'name' => $name,
        'password' => $password
    ]);
    echo "Utilisateur inséré avec succès.";
}
?>
