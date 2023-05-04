<?php
// Récupération de l'identifiant du résultat à afficher
$id = $_GET['id'];

// Connexion à la base de données
$host = 'localhost'; // remplacer par le nom de votre serveur si nécessaire
$dbname = 'vds'; // nom de votre base de données
$username = 'root'; // nom d'utilisateur de votre base de données
$password = ''; // mot de passe de votre base de données
$db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

// Récupération des données du résultat correspondant à l'identifiant
$sql = "SELECT * FROM vds.resultatffa WHERE id = :id";
$stmt = $db->prepare($sql);
$stmt->bindParam(':id', $id);
$stmt->execute();
$resultat = $stmt->fetch(PDO::FETCH_ASSOC);

?>


    <!DOCTYPE html>
    <html>
    <head>
        <title>Détail du résultat <?= $resultat['titre'] ?></title>
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
        </style>
    </head>
    <body>
    <h1>Détail du résultat <?= $resultat['titre'] ?></h1>

    <table>
        <tbody>
        <tr>
            <td><strong>ID :</strong></td>
            <td><?= $resultat['id'] ?></td>
        </tr>
        <tr>
            <td><strong>Date :</strong></td>
            <td><?= $resultat['date'] ?></td>
        </tr>
        <tr>
            <td><strong>Titre :</strong></td>
            <td><?= $resultat['titre'] ?></td>
        </tr>
        </tbody>
    </table>

    <div style="display: flex; margin-top: 30px">
        <div style="border-style: solid; border-width: 2px">
            <h3 style="margin: 15px">Modifier cette donnée</h3>
            <form method="post" action="modification.php" style="margin: 15px">
                <label>Id de la course à modifier</label>
                <input type="text" name="id_objet"><br><br>
                <label>Modification à apporter au titre</label>
                <input type="text" name="nouveau_titre"><br><br>
                <label>Modification de la date</label>
                <input type="date" name="nouvelle_date">
                <input type="submit" value="modifier">
            </form>
        </div>
        <div style="margin-left:10rem; max-height: 110px; border-style: solid; border-width: 2px;">
            <h3 style="margin: 15px">Supprimer cette donnée</h3>
            <form method="post" action="suppression.php" style="margin: 15px">
                <label>ID à supprimer:</label>
                <input type="text" name="id">
                <input type="submit" value="Supprimer">
            </form>
        </div>

        </div>


    </body>
    </html>
