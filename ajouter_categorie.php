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

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"]);
    if (!empty($nom)) {
        $stmt = $pdo->prepare("INSERT INTO categorie (nom) VALUES (:nom)");
        $stmt->execute(['nom' => $nom]);
        $message = "Catégorie ajoutée avec succès.";
    } else {
        $message = "Le nom ne doit pas être vide.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une catégorie</title>
    <style>
        body { font-family: Arial; background: #f7f7f7; padding: 50px; }
        .form-box { background: white; padding: 30px; border-radius: 10px; max-width: 500px; margin: auto; box-shadow: 0 0 10px #ccc; }
        h2 { text-align: center; }
        input { width: 100%; padding: 10px; margin: 10px 0; }
        button { width: 100%; padding: 10px; background-color: #3f51b5; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #2c387e; }
        .message { color: green; text-align: center; }
        a { display: block; text-align: center; margin-top: 20px; color: #3f51b5; text-decoration: none; }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Ajouter une catégorie</h2>
        <?php if ($message) echo "<div class='message'>$message</div>"; ?>
        <form method="post">
            <input type="text" name="nom" placeholder="Nom de la catégorie" required>
            <button type="submit">Ajouter</button>
        </form>
        <a href="dashboard.php">← Retour au tableau de bord</a>
    </div>
</body>
</html>
