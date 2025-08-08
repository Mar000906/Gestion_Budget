<?php
session_start();

// Si l'utilisateur n'est pas connecté, on le redirige
if (!isset($_SESSION["id_personne"])) {
    header("Location: login.php");
    exit;
}

$nom = $_SESSION["nom"];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tableau de bord - J'ai son budget</title>
    <style>
        body { margin: 0; font-family: Arial, sans-serif; background-color: #f6f9fc; }
        header { background-color: #4CAF50; color: white; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; }
        nav a { color: white; margin-right: 20px; text-decoration: none; font-weight: bold; }
        nav a:hover { text-decoration: underline; }
        .content { padding: 30px; }
        .welcome { font-size: 20px; margin-bottom: 30px; }
        .menu-boxes { display: flex; flex-wrap: wrap; gap: 20px; }
        .box {
            background-color: white;
            padding: 20px;
            flex: 1 1 200px;
            text-align: center;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 2px 2px 8px rgba(0,0,0,0.1);
        }
        .box a {
            display: block;
            margin-top: 10px;
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }
        .logout {
            background-color: #f44336;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .logout:hover {
            background-color: #d32f2f;
        }
    </style>
</head>
<body>
    <header>
        <div><strong>J'ai son budget</strong></div>
        <nav>
            <a href="dashboard.php">Accueil</a>
            <a href="ajouter_compte.php">Compte</a>
            <a href="ajouter_ressource.php">Ressources</a>
            <a href="ajouter_depense.php">Dépenses</a>
            <a href="ajouter_categorie.php">Catégories</a>
            <a href="ajouter_sous_categorie.php">Sous-catégories</a>
            <a href="ajouter_source.php">Source</a>
        </nav>
        <form method="post" action="logout.php">
            <button class="logout" type="submit">Déconnexion</button>
        </form>
    </header>

    <div class="content">
        <div class="welcome">Bienvenue, <strong><?= htmlspecialchars($nom) ?></strong> !</div>

        <div class="menu-boxes">
            <div class="box">
                <h3>Comptes</h3>
                <a href="ajouter_compte.php">Ajouter</a>
                <a href="liste_comptes.php">Voir la liste</a>
            </div>
            <div class="box">
                <h3>Sources</h3>
                <a href="ajouter_source.php">Ajouter</a>
                <a href="liste_sources.php">Voir la liste</a>
            </div>
            <div class="box">
                <h3>Ressources</h3>
                <a href="ajouter_ressource.php">Ajouter</a>
                <a href="liste_ressources.php">Voir la liste</a>
            </div>
            <div class="box">
                <h3>Catégories</h3>
                <a href="ajouter_categorie.php">Ajouter</a>
                <a href="liste_categories.php">Voir la liste</a>
            </div>
            <div class="box">
                <h3>Sous-catégories</h3>
                <a href="ajouter_sous_categorie.php">Ajouter</a>
                <a href="liste_sous_categories.php">Voir la liste</a>
            </div>
              <div class="box">
                <h3>Dépenses</h3>
                <a href="ajouter_depense.php">Ajouter</a>
                <a href="liste_depenses.php">Voir la liste</a>
            </div>
        </div>
    </div>
</body>
</html>