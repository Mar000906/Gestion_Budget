<?php
session_start();

// Connexion à la base de données
$host = 'localhost';
$dbname = 'gestion_budget';
$user = 'root';
$pass = 'Mysql'; // Mot de passe MySQL

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Traitement du formulaire
$erreur = '';
$succes = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"]);
    $telephone = trim($_POST["telephone"]);
    $email = trim($_POST["email"]);
    $mot_de_passe = $_POST["mot_de_passe"];

    // Vérification si l'email OU téléphone existe déjà
    $stmt = $pdo->prepare("SELECT * FROM personne WHERE email = :email OR telephone = :tel");
    $stmt->execute(['email' => $email, 'tel' => $telephone]);
    $existe = $stmt->fetch();

    if ($existe) {
        $erreur = "Un compte avec cet email ou téléphone existe déjà.";
    } else {
        // Hash du mot de passe
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_DEFAULT);

        // Insertion
        $stmt = $pdo->prepare("INSERT INTO personne (nom, telephone, email, mot_de_passe) VALUES (:nom, :tel, :email, :mdp)");
        $stmt->execute([
            'nom' => $nom,
            'tel' => $telephone,
            'email' => $email,
            'mdp' => $mot_de_passe_hash
        ]);

        // Redirection vers login
        header("Location: login.php?success=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Créer un compte - J'ai son budget</title>
    <style>
        body { font-family: Arial; background-color: #eef2f3; display: flex; justify-content: center; align-items: center; height: 100vh; }
        .register-box { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 0 10px #bbb; width: 400px; }
        .register-box h2 { text-align: center; margin-bottom: 20px; }
        .register-box input { width: 100%; padding: 10px; margin: 10px 0; }
        .register-box button { width: 100%; padding: 10px; background: #2196F3; color: white; border: none; cursor: pointer; }
        .register-box button:hover { background: #1976D2; }
        .register-box .error { color: red; text-align: center; }
        .register-box .success { color: green; text-align: center; }
        .register-box .login-link { text-align: center; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="register-box">
        <h2>Créer un compte</h2>
        <?php if (!empty($erreur)) echo "<div class='error'>$erreur</div>"; ?>
        <form method="post" action="">
            <input type="text" name="nom" placeholder="Nom complet" required>
            <input type="text" name="telephone" placeholder="Téléphone" required>
            <input type="email" name="email" placeholder="Adresse e-mail" required>
            <input type="password" name="mot_de_passe" placeholder="Mot de passe" required>
            <button type="submit">Créer le compte</button>
        </form>
        <div class="login-link">
            <a href="login.php">← Retour à la connexion</a>
        </div>
    </div>
</body>
</html>
