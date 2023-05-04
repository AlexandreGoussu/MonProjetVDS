<?php
var_dump($_POST);
const DBHOST = "localhost";
const DBUSER = "root";
const DBPASS = "";
const DBName = "vds";

//dsn de connection
$dsn = "mysql:dbname=".DBName.";host=".DBHOST;

//on va se connecter à la base
try {
    //instancier PDO
    $db = new PDO($dsn, DBUSER, DBPASS);
    echo "on est connecté";
}catch (PDOException $e) {
    die($e->getMessage());
}
//on traite le formulaire
if(!empty($_POST)){
    //post n'est pas vide on vérifie que les données sont bien présentes
    if(isset($_POST["titre"], $_POST["id"], $_POST["date"])
    && !empty($_POST["titre"])&& !empty($_POST["date"])&& !empty($_POST["id"])){
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
    $hostname="localhost";
    $username="root";
    $password="";
    $db = new PDO($dsn, DBUSER, DBPASS);
    //on écrit la requête
    $sql = "insert into vds.resultatffa (id, titre, date) values ( :id,:titre, :date)";
    //on prépare la requête
    $query = $db -> prepare($sql);
    
    //on injecte les valeurs
    $query->bindValue(":titre", $titre, PDO::PARAM_STR);
    $query->bindValue(":id", $id, PDO::PARAM_STR);
    $query->bindValue(":date", $date, PDO::PARAM_STR);
    
    //on execute la requète
    $query->execute();
    
    //on récupère l'id
    //$id = $db->lastInsertId();
    //die("Article ajouté sous le numéro $id");
}
?>

<h1>ajouter un article</h1>
<form method="post">
    <div>
        <label for="titre">titre</label>
        <input type="text" name="titre" id="titre">
    </div>
    <div>
        <label for="id">id</label>
        <input type="text" name="id" id="id">
    </div>
    <div>
        <label for="date">Date</label>
        <input type="date" name="date" id="date">
    </div>
    <button type="submit">Ajouter</button>
</form>