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

// Récupérer les comptes de l’utilisateur
$stmt1 = $pdo->prepare("SELECT id, nom FROM compte WHERE id_personne = :id");
$stmt1->execute(['id' => $_SESSION["id_personne"]]);
$comptes = $stmt1->fetchAll();

// Récupérer les sous-catégories
$stmt2 = $pdo->query("SELECT sc.id, sc.nom, c.nom AS categorie FROM sous_categorie sc JOIN categorie c ON sc.id_categorie = c.id");
$sous_categories = $stmt2->fetchAll();

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $montant = floatval($_POST["montant"]);
    $date = $_POST["date"];
    $id_compte = $_POST["id_compte"];
    $id_sous_categorie = $_POST["id_sous_categorie"];

    $stmt = $pdo->prepare("INSERT INTO depense (montant, date, id_compte, id_sous_categorie, id_personne) VALUES (:montant, :date, :compte, :sous_categorie, :personne)");
    $stmt->execute([
        'montant' => $montant,
        'date' => $date,
        'compte' => $id_compte,
        'sous_categorie' => $id_sous_categorie,
        'personne' => $_SESSION["id_personne"]
    ]);

    $message = "Dépense ajoutée avec succès.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une dépense</title>
    <style>
        body { font-family: Arial; background-color: #f0f0f0; padding: 50px; }
        .form-box { background: white; padding: 30px; border-radius: 10px; max-width: 500px; margin: auto; box-shadow: 0 0 10px #ccc; }
        h2 { text-align: center; }
        input, select { width: 100%; padding: 10px; margin: 10px 0; }
        button { width: 100%; padding: 10px; background-color: #f44336; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #d32f2f; }
        .message { color: green; text-align: center; }
        a { display: block; text-align: center; margin-top: 20px; color: #f44336; text-decoration: none; }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Ajouter une dépense</h2>
        <?php if ($message) echo "<div class='message'>$message</div>"; ?>
        <form method="post">
            <input type="number" name="montant" placeholder="Montant (MAD)" step="0.01" required>
            <input type="date" name="date" required>
            <select name="id_compte" required>
                <option value="">-- Sélectionner un compte --</option>
                <?php foreach ($comptes as $compte): ?>
                    <option value="<?= $compte['id'] ?>"><?= htmlspecialchars($compte['nom']) ?></option>
                <?php endforeach; ?>
            </select>
            <select name="id_sous_categorie" required>
                <option value="">-- Sélectionner une sous-catégorie --</option>
                <?php foreach ($sous_categories as $sc): ?>
                    <option value="<?= $sc['id'] ?>">
                        <?= htmlspecialchars($sc['categorie'] . " - " . $sc['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Ajouter</button>
        </form>
        <a href="dashboard.php">← Retour au tableau de bord</a>
    </div>
</body>
</html>
