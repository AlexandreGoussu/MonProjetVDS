<?php

/*
 * Récupération des données alimentant la page d'accueil
 */

require '../include/initialisation.php';


// Tableau stockant l'ensemble des tableaux de données à retourner
$lesDonnees = [];

// la classe Database sera chargée dynamiquement (pas besoin de require)
$lesDonnees['bandeau'] = base::getLeBandeau();


// récupération de la prochaine édition des 4 saisons

// récupération du dernier résultat datant de moins de 15 jours concernant les coureurs du club paru sur le site de la ffa : table resultatffa
$lesDonnees['ffa'] = resultatffa::getLesDernieresCourses();
// récupération des partenaires


// vérification de l'existence de l'image et solution au problème de non-rafraichissement du cache


// récupération des liens utiles


echo json_encode($lesDonnees);