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
    die("Erreur de connexion : " . $e->getMessage());
}

// Récupérer les ressources de l'utilisateur connecté
$sql = "
    SELECT r.id, r.montant, r.date, 
           c.nom AS nom_compte, 
           s.nom_source AS nom_source
    FROM ressource r
    JOIN compte c ON r.id_compte = c.id
    JOIN source s ON r.id_source = s.id
    WHERE r.id_personne = :id_personne
    ORDER BY r.date DESC
";

$stmt = $pdo->prepare($sql);
$stmt->execute(['id_personne' => $_SESSION["id_personne"]]);
$ressources = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des ressources</title>
    <style>
        body { font-family: Arial; background-color: #f9f9f9; padding: 40px; }
        table { width: 100%; border-collapse: collapse; background: white; }
        th, td { padding: 12px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #2196F3; color: white; }
        h2 { text-align: center; margin-bottom: 20px; }
        .container { max-width: 900px; margin: auto; }
        a { display: block; text-align: center; margin-top: 20px; color: #2196F3; text-decoration: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Liste des ressources</h2>
        <table>
            <thead>
                <tr>
                    <th>Montant (MAD)</th>
                    <th>Date</th>
                    <th>Compte</th>
                    <th>Source</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($ressources) > 0): ?>
                    <?php foreach ($ressources as $ress): ?>
                        <tr>
                            <td><?= htmlspecialchars($ress['montant']) ?></td>
                            <td><?= htmlspecialchars($ress['date']) ?></td>
                            <td><?= htmlspecialchars($ress['nom_compte']) ?></td>
                            <td><?= htmlspecialchars($ress['nom_source']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="4">Aucune ressource trouvée.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="dashboard.php">← Retour au tableau de bord</a>
    </div>
</body>
</html>
