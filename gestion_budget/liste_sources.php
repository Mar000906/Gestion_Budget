<?php
session_start();
if (!isset($_SESSION['id_personne'])) {
    header("Location: login.php");
    exit();
}

$conn = new mysqli("localhost", "root", "Mysql", "gestion_budget");
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

$id_personne = $_SESSION["id_personne"];
$stmt = $conn->prepare("SELECT * FROM source WHERE id_personne = ?");
if ($stmt === false) {
    die("Erreur de préparation : " . $conn->error);
}

$stmt->bind_param("i", $id_personne);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des sources</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f6f9fc; padding: 20px; }
        table { border-collapse: collapse; width: 100%; background-color: white; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        a { text-decoration: none; color: #4CAF50; font-weight: bold; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<h2>Liste des sources</h2>

<table>
    <thead>
        <tr>
            <th>Nom de la source</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= htmlspecialchars($row['nom_source']) ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<p><a href="dashboard.php">Retour au tableau de bord</a></p>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>