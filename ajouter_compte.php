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

$message = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"]);
    $solde = floatval($_POST["solde"]);

    $stmt = $pdo->prepare("INSERT INTO compte (nom, solde, id_personne) VALUES (:nom, :solde, :id)");
    $stmt->execute([
        'nom' => $nom,
        'solde' => $solde,
        'id' => $_SESSION["id_personne"]
    ]);

    $message = "Compte ajouté avec succès.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un compte</title>
    <style>
        body { font-family: Arial; background: #f2f2f2; padding: 50px; }
        .form-box { background: white; padding: 30px; border-radius: 8px; max-width: 400px; margin: auto; box-shadow: 0 0 10px #ccc; }
        h2 { text-align: center; }
        input { width: 100%; padding: 10px; margin: 10px 0; }
        button { background: #4CAF50; color: white; border: none; padding: 10px 15px; cursor: pointer; width: 100%; }
        .message { color: green; text-align: center; margin-bottom: 10px; }
        a { display: block; text-align: center; margin-top: 20px; text-decoration: none; color: #4CAF50; }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Ajouter un compte</h2>
        <?php if ($message) echo "<div class='message'>$message</div>"; ?>
        <form method="post">
            <input type="text" name="nom" placeholder="Nom du compte" required>
            <input type="number" name="solde" placeholder="Solde initial" step="0.01" required>
            <button type="submit">Ajouter</button>
        </form>
        <a href="dashboard.php">← Retour au tableau de bord</a>
    </div>
</body>
</html>
