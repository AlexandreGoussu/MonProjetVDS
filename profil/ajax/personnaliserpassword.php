<?php

/**
 *  personnalisation du mot de passe du membre connecté avec un password à 0000
 * Appel : personnaliserpassword.js - fonction modifie()
 * Résultat : 1 ou message d'erreur
 * Remarque : Ce script ne doit pas utiliser initialisation.php
 */

// attention : la classe Mail utilise la constante racine
// pas de chargement dynamique ici : il faut charger la classe Profil

session_start();
define('RACINE', $_SERVER['DOCUMENT_ROOT']);

include '../../class/class.database.php';
include '../class/class.profil.php';


// contrôle des données attendues
if(!isset($_POST['password'])) {
    echo "Donnée manquante";
    exit;
}
// récupération des données
$id = $_SESSION['membre']['id'];
$password = $_POST["password"];

// vérification : le membre est bien connecté et il doit bien personnaliser son mot de passe
if(!isset($_SESSION['membre'])) {
    echo "Donnée manquante";
    exit;
}

if(!isset($_SESSION['personnaliser'])) {
    echo "Donnée manquante";
    exit;
}

// contrôle du respect des règles de sécurité sur le mot de passe
if (!preg_match('#^(?=.*[a-z]+)(?=.*[A-Z]+)(?=.*[0-9]+)(?=.*[()=+?!\'$.%;:@&*\#/\\-]+).{8,}$#', $password)) {
    echo "Le mot de passe doit comporter 8 caractères minimum, dont une minuscule, une majuscule un chiffre et un caractère spécial. ";
    exit;
}

// Mise à jour du mot de passe
$erreur = "";
if (Profil::modifierColonne('password', hash('sha256', $password), $id, $erreur)) {
    unset($_SESSION['personnaliser']);
    if (isset($_SESSION['url'])) {
        echo json_encode($_SESSION['url']);
        unset($_SESSION['url']); }
    else {
        echo json_encode('/index.php');
    }
} else {
    echo $erreur;
}
