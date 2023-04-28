<?php

class resultatffa
{
    public static function getLesCourses(): array
    {
        $db = Database::getInstance();
        $sql = <<<EOD
            Select date, titre
            from resultatffa
order by date
EOD;
        $curseur = $db->query($sql);
        $lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);
        $curseur->closeCursor();
        return $lesLignes;
    }

    public static function getLesDernieresCourses(): array
    {
        $db = Database::getInstance();
        $sql = <<<EOD
            Select date, titre,id
            from resultatffa
            where date < now() - interval 15 DAY 
order by date desc limit 1 
EOD;
        $curseur = $db->query($sql);
        $lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);
        $curseur->closeCursor();
        return $lesLignes;
    }

    public static function ajouterCourse(): array
    {

        $db = Database::getInstance();
// se connecter à la base de données MySQL


// récupérer les données du formulaire
        $id = $_POST['id'];
        $date = $_POST['date'];
        $titre = $_POST['titre'];
var_dump($id);
var_dump($date);
var_dump($titre);
// préparer la requête SQL
        $sql = "INSERT INTO resultatffa (id, date, titre) VALUES (:id, :date, :titre)";

// exécuter la requête SQL
        if (mysqli_query($db, $sql)) {
            echo 'La course a été ajoutée avec succès !';
        } else {
            echo 'Erreur : ' . mysqli_error($db);
        }

// fermer la connexion à la base de données MySQL
        mysqli_close($db);
        $curseur = $db->query($sql);
        $lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);
        $curseur->closeCursor();
        return $lesLignes;
    }
}




