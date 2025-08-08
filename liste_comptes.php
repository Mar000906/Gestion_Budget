<?php
session_start();
if (!isset($_SESSION["id_personne"])) {
    header("Location: login.php");
    exit;
}

// Connexion BDD
$host = 'localhost';
$dbname = 'gestion_budget';
$user = 'root';
$pass = 'Mysql';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}

// Récupération des comptes de l'utilisateur
$stmt = $pdo->prepare("SELECT * FROM compte WHERE id_personne = :id");
$stmt->execute(['id' => $_SESSION["id_personne"]]);
$comptes = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des comptes</title>
    <style>
        body { font-family: Arial; background: #f9f9f9; padding: 40px; }
        table { border-collapse: collapse; width: 80%; margin: auto; background: white; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: center; }
        th { background-color: #4CAF50; color: white; }
        h2 { text-align: center; margin-bottom: 20px; }
        a { display: block; text-align: center; margin-top: 20px; text-decoration: none; color: #4CAF50; }
    </style>
</head>
<body>
    <h2>Liste de vos comptes</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom du compte</th>
            <th>Solde</th>
        </tr>
        <?php foreach ($comptes as $compte): ?>
            <tr>
                <td><?= htmlspecialchars($compte['id']) ?></td>
                <td><?= htmlspecialchars($compte['nom']) ?></td>
                <td><?= number_format($compte['solde'], 2, ',', ' ') ?> MAD</td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="dashboard.php">← Retour au tableau de bord</a>
</body>
</html>
