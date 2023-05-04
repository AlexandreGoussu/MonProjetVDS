<?php

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vds";
$conn = new mysqli($servername, $username, $password, $dbname);

    if (isset($_POST["id_objet"])) {
// Récupère les nouvelles valeurs de l'objet à partir du formulaire
        $id_objet = $_POST["id_objet"];
        $nouveau_titre = $_POST["nouveau_titre"];
        $nouvelle_date = $_POST["nouvelle_date"];


// Vérifie si la connexion a échoué
if ($conn->connect_error) {
die("La connexion a échoué : " . $conn->connect_error);
}

// Met à jour l'objet dans la base de données
$sql = "UPDATE vds.resultatffa SET titre='" . $nouveau_titre . "', date='" . $nouvelle_date . "' WHERE id=" . $id_objet;
if ($conn->query($sql) === TRUE) {
echo "L'objet a été modifié avec succès !" ;
} else {
echo "Erreur lors de la modification de l'objet : " . $conn->error;
}

// Ferme la connexion à la base de données
$conn->close();
}
?>

<p><a href="index.php">Revenir à la liste des courses</a></p>