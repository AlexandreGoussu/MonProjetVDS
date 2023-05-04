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
        var_dump($_POST);


//on va se connecter à la base
        try {
            //instancier PDO
            $db = Database::getInstance();
            echo "on est connecté";
        } catch (PDOException $e) {
            die($e->getMessage());
        }
        if (!empty($_POST)) {
            //post n'est pas vide on vérifie que les données sont bien présentes
            if (isset($_POST["titre"], $_POST["id"], $_POST["date"])
                && !empty($_POST["titre"]) && !empty($_POST["date"]) && !empty($_POST["id"])) {
                //le formulaire est complet
                //on récupère les données en les protégeant (failles XSS)
                //on retire toute balise du titre
                $titre = ($_POST["titre"]);
                //on netralise toute balise de contenu
                $id = ($_POST["id"]);
                $date = ($_POST["date"]);
            } else {
                die ("le formulaire est incomplet");
            }
            //on écrit la requête
            $sql = "insert into resultatffa (id, titre, date) values ( :id,:titre, :date)";
            //on prépare la requête
            $query = $db->prepare($sql);

            //on injecte les valeurs
            $query->bindValue(":titre", $titre, PDO::PARAM_STR);
            $query->bindValue(":id", $id, PDO::PARAM_STR);
            $query->bindValue(":date", $date, PDO::PARAM_STR);
            $curseur = $db->query($sql);
            $lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);

            //on execute la requète
            $query->execute();
        }
        return $lesLignes;
    }
}




