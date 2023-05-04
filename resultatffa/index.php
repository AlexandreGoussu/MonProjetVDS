<?php
// Connexion à la base de données
$host = 'localhost'; // remplacer par le nom de votre serveur si nécessaire
$dbname = 'vds'; // nom de votre base de données
$username = 'root'; // nom d'utilisateur de votre base de données
$password = ''; // mot de passe de votre base de données
$db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Récupération des données de la table resultatffa
$sql = "SELECT * FROM vds.resultatffa order by titre";
$stmt = $db->query($sql);
$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <head>
        <title>Résultats de la VDS</title>
        <style>
            table {
                border-collapse: collapse;
                margin: 20px 0;
                width: 100%;
            }
            th, td {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
                font-weight: bold;
            }
            tr:hover {
                background-color: #f5f5f5;
            }
        </style>
    </head>
</head>
<body>
<h1>Résultats de la VDS</h1>

<table>
    <thead>
    <tr>
        <th>Titre</th>
        <th>ID</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($resultats as $resultat): ?>
        <tr onclick="window.location.href='detail_resultat.php?id=<?= $resultat['id'] ?>'">
            <td><?= $resultat['titre'] ?></td>
            <td><?= $resultat['id'] ?></td>
            <td><?= $resultat['date'] ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<button><a href="ajout.php" style="text-decoration: none; ">Ajouter une course</a></button>
</body>
</html>
