<?php
session_start();

// Connexion à la base de données
$host = 'localhost';
$dbname = 'gestion_budget';
$user = 'root';
$pass = 'Mysql';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Traitement du formulaire
$erreur = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $identifiant = $_POST["identifiant"];
    $mot_de_passe = $_POST["mot_de_passe"];

    $stmt = $pdo->prepare("SELECT * FROM personne WHERE nom = :id OR telephone = :id OR email = :id");
    $stmt->execute(['id' => $identifiant]);
    $personne = $stmt->fetch();

    if ($personne && password_verify($mot_de_passe, $personne["mot_de_passe"])) {
        $_SESSION["id_personne"] = $personne["id"];
        $_SESSION["nom"] = $personne["nom"];
        header("Location: dashboard.php");
        exit;
    } else {
        $erreur = "Identifiant ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Connexion - J'ai son budget</title>
    <style>
        body { font-family: Arial; background-color: #f4f4f4; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .login-box { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px #aaa; width: 350px; }
        .login-box h2 { text-align: center; margin-bottom: 20px; }
        .login-box input { width: 100%; padding: 10px; margin: 10px 0; }
        .login-box button { width: 100%; padding: 10px; background: #4CAF50; color: white; border: none; cursor: pointer; }
        .login-box button:hover { background: #45a049; }
        .login-box .error { color: red; text-align: center; }
        .login-box .create-link { text-align: center; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="login-box">
        <h2>Connexion</h2>
        <?php if (!empty($erreur)) echo "<div class='error'>$erreur</div>"; ?>
        <form method="post" action="">
            <input type="text" name="identifiant" placeholder="Nom, téléphone ou email" required>
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
        <div class="create-link">
            <a href="register.php">Créer un compte</a>
        </div>
    </div>
</body>
</html>
