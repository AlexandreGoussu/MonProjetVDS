<?php

class Membre
{

    /**
     * Ajout d'un membre avec vérification unicité sur nom, prénom et génération du login
     * @param string $nom
     * @param string $titre
     * @param string $email
     * @param string $reponse
     * @return bool
     */
    public static function ajouter(string $nom, string $titre, string $email, string &$reponse): bool
    {
        $db = Database::getInstance();
        $ok = false;
        $sql = <<<EOD
            Select id
            From membre
            Where nom = :nom
            and titre = :titre
EOD;
        $db = Database::getInstance();
        $curseur = $db->prepare($sql);
        $curseur->bindParam('nom', $nom);
        $curseur->bindParam('titre', $titre);
        $curseur->execute();
        $ligne = $curseur->fetch();
        $curseur->closeCursor();
        if ($ligne)
            $reponse = "Ce membre existe déjà";
        else {
            // génération du login
            $login = $nom;
            $i = 2;
            do {
                $sql = <<<EOD
                      SELECT 1 
                      FROM membre
                       Where login = :login
EOD;
                $curseur = $db->prepare($sql);
                $curseur->bindParam('login', $login);
                $curseur->execute();
                $ligne = $curseur->fetch();
                $curseur->closeCursor();
                if (!$ligne) break;
                $login = $nom . $i;
                $i++;
            } while (true);

            // ajout dans la table membre, le mot de passe par défaut est 0000

            $sql = <<<EOD
        insert into membre(nom, titre, email, login, password)
        values (:nom, :titre, :email, :login, sha2('0000', 256));
EOD;

            $curseur = $db->prepare($sql);
            $curseur->bindParam('nom', $nom);
            $curseur->bindParam('titre', $titre);
            $curseur->bindParam('email', $email);
            $curseur->bindParam('login', $login);
            try {
                $curseur->execute();
                $reponse = $login;
                $ok = true;
            } catch (Exception $e) {
                $reponse = substr($e->getMessage(), strrpos($e->getMessage(), '#') + 1);
            }
        }
        return $ok;
    }

    /**
     * Retourne la liste des membres
     * @return array
     */
    public static function getLesMembres(): array
    {
        $db = Database::getInstance();
        $sql = <<<EOD
            Select login, concat(nom, ' ' , titre) as nomtitre, email, autMail, photo, ifnull(telephone, 'Non communiqué') as telephone 
            From membre
            Order by nom, titre;
EOD;
        $curseur = $db->query($sql);
        $lesLignes = $curseur->fetchAll(PDO::FETCH_ASSOC);
        $curseur->closeCursor();
        return $lesLignes;
    }

}