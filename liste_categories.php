<?php
$host = 'localhost';
$dbname = 'gestion_budget';
$user = 'root';
$pass = 'Mysql';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

$stmt = $pdo->query("SELECT * FROM categorie");
$categories = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des catégories</title>
    <style>
        body { font-family: Arial; background: #fff; padding: 40px; }
        table { width: 70%; margin: auto; border-collapse: collapse; background: white; }
        th, td { padding: 12px; border: 1px solid #ccc; text-align: center; }
        th { background-color: #3f51b5; color: white; }
        h2 { text-align: center; margin-bottom: 20px; }
        a { display: block; text-align: center; margin-top: 20px; color: #3f51b5; text-decoration: none; }
    </style>
</head>
<body>
    <h2>Liste des catégories</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
        </tr>
        <?php foreach ($categories as $cat): ?>
            <tr>
                <td><?= $cat['id'] ?></td>
                <td><?= htmlspecialchars($cat['nom']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="dashboard.php">← Retour au tableau de bord</a>
</body>
</html>
