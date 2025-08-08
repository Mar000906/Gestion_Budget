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

// Récupérer les comptes de l’utilisateur connecté
$stmt1 = $pdo->prepare("SELECT id, nom FROM compte WHERE id_personne = :id_personne");
$stmt1->execute(['id_personne' => $_SESSION["id_personne"]]);
$comptes = $stmt1->fetchAll();

// Récupérer les sources de l’utilisateur connecté
$stmt2 = $pdo->prepare("SELECT id, nom_source FROM source WHERE id_personne = :id_personne");
$stmt2->execute(['id_personne' => $_SESSION["id_personne"]]);
$sources = $stmt2->fetchAll();

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $montant = floatval($_POST["montant"]);
    $date = $_POST["date"];
    $id_compte = $_POST["id_compte"];
    $id_source = $_POST["id_source"];

    $stmt = $pdo->prepare("INSERT INTO ressource (montant, date, id_compte, id_source, id_personne) VALUES (:montant, :date, :id_compte, :id_source, :id_personne)");
    $stmt->execute([
        'montant' => $montant,
        'date' => $date,
        'id_compte' => $id_compte,
        'id_source' => $id_source,
        'id_personne' => $_SESSION["id_personne"]
    ]);

    $message = "Ressource ajoutée avec succès.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une ressource</title>
    <style>
        body { font-family: Arial; background-color: #f0f0f0; padding: 50px; }
        .form-box { background: white; padding: 30px; border-radius: 10px; max-width: 500px; margin: auto; box-shadow: 0 0 10px #ccc; }
        h2 { text-align: center; }
        input, select { width: 100%; padding: 10px; margin: 10px 0; }
        button { width: 100%; padding: 10px; background-color: #2196F3; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #1976D2; }
        .message { color: green; text-align: center; }
        a { display: block; text-align: center; margin-top: 20px; color: #2196F3; text-decoration: none; }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Ajouter une ressource</h2>
        <?php if ($message) echo "<div class='message'>$message</div>"; ?>
        <form method="post">
            <input type="number" name="montant" placeholder="Montant de la ressource" step="0.01" required>
            <input type="date" name="date" required>
            <select name="id_compte" required>
                <option value="">-- Sélectionner un compte --</option>
                <?php foreach ($comptes as $compte): ?>
                    <option value="<?= $compte['id'] ?>"><?= htmlspecialchars($compte['nom']) ?></option>
                <?php endforeach; ?>
            </select>
            <select name="id_source" required>
                <option value="">-- Sélectionner une source --</option>
                <?php foreach ($sources as $source): ?>
                    <option value="<?= $source['id'] ?>"><?= htmlspecialchars($source['nom_source']) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Ajouter</button>
        </form>
        <a href="dashboard.php">← Retour au tableau de bord</a>
    </div>
</body>
</html>
