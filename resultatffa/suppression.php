<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vds";
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifie si la connexion a échoué
if ($conn->connect_error) {
    die("La connexion a échoué : " . $conn->connect_error);
}

// Vérifie si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupère l'ID de l'entrée à supprimer depuis le formulaire
    $id = $_POST["id"];

    // Supprime l'entrée de la base de données
    $sql = "DELETE FROM vds.resultatffa WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "L'entrée a été supprimée avec succès";
    } else {
        echo "Une erreur s'est produite : " . $conn->error;
    }
}

// Ferme la connexion à la base de données
$conn->close();
?>

<p><a href="index.php">Revenir à la liste des courses</a></p>


