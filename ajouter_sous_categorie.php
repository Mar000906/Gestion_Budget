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

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"]);
    $id_categorie = $_POST["id_categorie"];

    if (!empty($nom) && !empty($id_categorie)) {
        $stmt = $pdo->prepare("INSERT INTO sous_categorie (nom, id_categorie) VALUES (:nom, :id_categorie)");
        $stmt->execute(['nom' => $nom, 'id_categorie' => $id_categorie]);
        $message = "Sous-catégorie ajoutée avec succès.";
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une sous-catégorie</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 50px; }
        .form-box { background: white; padding: 30px; border-radius: 10px; max-width: 500px; margin: auto; box-shadow: 0 0 10px #bbb; }
        h2 { text-align: center; }
        input, select { width: 100%; padding: 10px; margin: 10px 0; }
        button { width: 100%; padding: 10px; background-color: #4caf50; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #388e3c; }
        .message { color: green; text-align: center; }
        a { display: block; text-align: center; margin-top: 20px; color: #4caf50; text-decoration: none; }
    </style>
</head>
<body>
    <div class="form-box">
        <h2>Ajouter une sous-catégorie</h2>
        <?php if ($message) echo "<div class='message'>$message</div>"; ?>
        <form method="post">
            <input type="text" name="nom" placeholder="Nom de la sous-catégorie" required>
            <select name="id_categorie" required>
                <option value="">-- Sélectionner une catégorie --</option>
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nom']) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Ajouter</button>
        </form>
        <a href="dashboard.php">← Retour au tableau de bord</a>
    </div>
</body>
</html>
