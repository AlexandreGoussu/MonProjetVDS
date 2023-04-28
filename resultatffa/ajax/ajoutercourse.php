<?php
require '../include/initialisation.php';
require '../include/controleacces.php';

echo json_encode(resultatffa::ajouterCourse());
//echo json_encode(resultatffa::ajouterCourse());



   /* $db = Database::getInstance();
    $erreur = false;
    if (!isset($_POST['id'])) {
        echo "\nLe paramètre 'id' indiquant le numéro de l'id n'est pas transmis";
        $erreur = true;
    }
    if (!isset($_POST['titre'])) {
        echo "\nLe paramètre 'titre' indiquant le titre de la course n'est pas transmis";
        $erreur = true;
    }
    if (!isset($_POST['date'])) {
        echo "\nLe paramètre 'date' indiquant la date de la n'est pas transmis";
        $erreur = true;
    }


    $titre = ($_POST['titre']);
    $id = ($_POST['id']);
    $date = ($_POST['date']);

    if (empty($id)) {
        echo "\nLe numéro de l'id doit être renseigné.";
        $erreur = true;
    } elseif (!preg_match("/^[0-9]{6,7}$/", $id)) {
        echo "\nLe numéro de l'id' doit être composé de 6 chiffres.";
        $erreur = true;
    } else {
        // Vérification de l'unicité du numéro de licence
        $sql = <<<EOD
			SELECT 1
			FROM resultatffa
			where id = :id;
	EOD;
        $curseur = $db->prepare($sql);
        $curseur->bindParam('id', $id);
        $curseur->execute();
        $ligne = $curseur->fetch(PDO::FETCH_ASSOC);
        $curseur->closeCursor();
        if ($ligne) {
            echo "Ce numéro d'id est déjà attribué à une autre course";
            $erreur = true;
        }
    }
// contrôle du prénom
    if (empty($titre)) {
        echo "\nLe titre doit être renseigné.";
        $erreur = true;
    } elseif (!preg_match("/^[A-Za-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]([ '-]?[A-Za-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ])*$/", $titre)) {
        echo "\nLe titre n'est pas conforme";
        $erreur = true;
    } elseif (mb_strlen($titre) > 100) {
        echo "\nLe titre ne doit pas dépasser 100 caractères";
        $erreur = true;
    }

    // contrôle de la date de naissance
    if (empty($dateN)) {
        echo "\nLa date de la course doit être renseignée.";
        $erreur = true;
    } elseif (!Controle::formatValide( $date, 'dateMysql')) {
        echo "\nLa date de la course n'est pas dans le format attendu aaaa-mm-jj.";
        $erreur = true;
    } else {
        $jour = date('D');
        $min = $jour - 80 . "-01-01";
        if ($date < $min) {
            echo "\nLa date de la course n'est pas dans l'intervale autorisée [$min]";
            $erreur = true;
        }

    }

    if ($erreur) exit;
    $sql = <<<EOD
    insert into resultatffa(id, date, titre)
           values (:id, :date, :titre);
EOD;
    $curseur = $db->prepare($sql);
    $curseur->bindParam('id', $id);
    $curseur->bindParam('titre', $titre);
    $curseur->bindParam('date', $date);
    try {
        $curseur->execute();
        echo 1;
    } catch(Exception $e) {
        echo substr($e->getMessage(),strrpos($e->getMessage(), '#') + 1);
    }
    var_dump($titre);
    var_dump($id);
    var_dump($date);

