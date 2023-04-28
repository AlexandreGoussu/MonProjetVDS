<?php
$racine = $_SERVER['DOCUMENT_ROOT'];

require "$racine/vendor/autoload.php";

$dbHost = 'localhost';
$dbUser = 'root';
$dbPassword = '';
$dbBase = 'vds';

$date = date('Y-m-d');
$fichier = "$racine/data/sauvegarde/$date.sql";


//$cmd = "à compléter";

// lancer la commande mysqldump contenu dans $cmd


// le fichier est vide (taille 0) si la commande n'a pas fonctionné
if(filesize($fichier) === 0) {
    echo 'La sauvegarde a échoué : ';
    @unlink($fichier);
} else {
    echo json_encode($fichier);
}

