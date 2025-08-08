<?php
session_start();
if (!isset($_SESSION['id_personne'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une source - J'ai son budget</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f6f9fc;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            background: white;
            padding: 30px 40px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 350px;
            text-align: center;
        }
        h2 {
            margin-bottom: 25px;
            color: #4CAF50;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            text-align: left;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 14px;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s ease;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .message {
            margin-top: 20px;
            font-weight: bold;
            color: #333;
        }
        .message.success {
            color: green;
        }
        .message.error {
            color: red;
        }
        a {
            display: inline-block;
            margin-top: 25px;
            text-decoration: none;
            color: #4CAF50;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Ajouter une source</h2>
        <form method="post" action="">
            <label for="nom_source">Nom de la source :</label>
            <input type="text" id="nom_source" name="nom_source" required>
            <input type="submit" value="Ajouter la source">
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nom_source = htmlspecialchars($_POST["nom_source"]);
            $id_personne = $_SESSION["id_personne"];

            $conn = new mysqli("localhost", "root", "Mysql", "gestion_budget");
            if ($conn->connect_error) {
                echo '<p class="message error">Erreur de connexion à la base de données.</p>';
            } else {
                $stmt = $conn->prepare("INSERT INTO source (nom_source, id_personne) VALUES (?, ?)");
                $stmt->bind_param("si", $nom_source, $id_personne);

                if ($stmt->execute()) {
                    echo '<p class="message success">Source ajoutée avec succès.</p>';
                } else {
                    echo '<p class="message error">Erreur lors de l\'ajout de la source.</p>';
                }

                $stmt->close();
                $conn->close();
            }
        }
        ?>

        <a href="dashboard.php">Retour au tableau de bord</a>
    </div>
</body>
</html>
