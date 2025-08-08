<?php
session_start();
if (!isset($_SESSION["id_personne"])) {
    header("Location: login.php");
    exit;
}

$host = 'localhost';
$dbname = 'gestion_budget';
$user = 'root';
$pass = 'Mysql';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

$stmt = $pdo->prepare("
    SELECT d.date, d.montant, c.nom AS compte, sc.nom AS sous_categorie, cat.nom AS categorie
    FROM depense d
    JOIN compte c ON d.id_compte = c.id
    JOIN sous_categorie sc ON d.id_sous_categorie = sc.id
    JOIN categorie cat ON sc.id_categorie = cat.id
    WHERE d.id_personne = :id
    ORDER BY d.date DESC
");
$stmt->execute(['id' => $_SESSION["id_personne"]]);
$depenses = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des dépenses</title>
    <style>
        body { font-family: Arial; background: #fafafa; padding: 40px; }
        table { width: 90%; margin: auto; border-collapse: collapse; background: white; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: center; }
        th { background-color: #f44336; color: white; }
        h2 { text-align: center; margin-bottom: 20px; }
        a { display: block; text-align: center; margin-top: 20px; color: #f44336; text-decoration: none; }
    </style>
</head>
<body>
    <h2>Liste de vos dépenses</h2>
    <table>
        <tr>
            <th>Date</th>
            <th>Montant</th>
            <th>Compte</th>
            <th>Catégorie</th>
            <th>Sous-catégorie</th>
        </tr>
        <?php foreach ($depenses as $d): ?>
            <tr>
                <td><?= htmlspecialchars($d['date']) ?></td>
                <td><?= number_format($d['montant'], 2, ',', ' ') ?> MAD</td>
                <td><?= htmlspecialchars($d['compte']) ?></td>
                <td><?= htmlspecialchars($d['categorie']) ?></td>
                <td><?= htmlspecialchars($d['sous_categorie']) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="dashboard.php">← Retour au tableau de bord</a>
</body>
</html>
