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

$stmt = $pdo->query("
    SELECT sc.id, sc.nom AS sous_categorie, c.nom AS categorie
    FROM sous_categorie sc
    JOIN categorie c ON sc.id_categorie = c.id
    ORDER BY c.nom, sc.nom
");
$sous_categories = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des sous-catégories</title>
    <style>
        body { font-family: Arial; background: #fff; padding: 40px; }
        table { width: 80%; margin: auto; border-collapse: collapse; background: white; }
        th, td { padding: 12px; border: 1px solid #ccc; text-align: center; }
        th { background-color: #4caf50; color: white; }
        h2 { text-align: center; margin-bottom: 20px; }
        a { display: block; text-align: center; margin-top: 20px; color: #4caf50; text-decoration: none; }
    </style>
</head>
<body>
    <h2>Liste des sous-catégories</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Catégorie</th>
            <th>Sous-catégorie</th>
        </tr>
        <?php foreach ($sous_categories as $sc): ?>
            <tr>
                <td><?= $sc['id'] ?></td>
                <td><?= htmlspecialchars($sc['categorie']) ?></td>
                <td><?= htmlspecialchars($sc['sous_categorie']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="dashboard.php">← Retour au tableau de bord</a>
</body>
</html>
