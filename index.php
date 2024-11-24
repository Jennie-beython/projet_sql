<?php
// Connexion à la base de données
$host = 'localhost';
$dbname = 'ecommerce_db'; // Remplacez par le nom de votre base
$username = 'root';    // Par défaut dans XAMPP/MAMP/WAMP
$password = '';        // Généralement vide

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Fonction pour afficher une table
function displayTable($pdo, $tableName) {
    echo "<h2>Contenu de la table: $tableName</h2>";
    $query = $pdo->query("SELECT * FROM $tableName");
    
    // Afficher les colonnes
    $columns = array_keys($query->fetch(PDO::FETCH_ASSOC));
    if (empty($columns)) {
        echo "<p>Aucune donnée dans cette table.</p>";
        return;
    }
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr>";
    foreach ($columns as $column) {
        echo "<th style='padding: 8px;'>" . htmlspecialchars($column) . "</th>";
    }
    echo "</tr>";
    
    // Afficher les lignes
    $query->execute(); // Ré-exécution pour afficher les lignes
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td style='padding: 8px;'>" . htmlspecialchars($value) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}

// Récupérer et afficher toutes les tables
$query = $pdo->query("SHOW TABLES");
echo "<h1>Tables dans la base de données</h1>";
while ($table = $query->fetch(PDO::FETCH_NUM)) {
    displayTable($pdo, $table[0]);
}
?>
