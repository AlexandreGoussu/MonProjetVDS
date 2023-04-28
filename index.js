'use strict';

/**
 *    chargement de l'ensemble des données nécessaires afin d'alimenter la page d'accueil :
 *        dernier résultat présent sur le site FFA : table resultatFFA
 *        prochaine épreuve : table epreuve
 *        la dernière actualité : champ contenu de la table bandeau
 *        informations clubs et 4 saisons : table element
 *        partenaires et liens utiles : table partenaire et lien
 */

window.onload = init;

/**
 *     chargement de l'ensemble des données nécessaires :
 *
 */
function init() {
    $.ajax({
        url: 'ajax/getdonneesaccueil.php',
        dataType: 'json',
        error: reponse => console.error(reponse.responseText),
        success: afficher
    });

    // activation de toutes les infobulles et popover de la page
    let option = {
        trigger: "hover",
        placement: "top",
        html: true,
    }
    document.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(element => new bootstrap.Tooltip(element));
    document.querySelectorAll('[data-bs-toggle="popover"]').forEach(element => new bootstrap.Popover(element, option));
}

/**
 * Alimente en données les différents éléments de la page d'accueil
 * @param { Object } data données au format json
 *    date.lesClassements contient le nom des fichier pdf trouvé dans le répertoire
 */
function afficher(data) {

    // alimentation du bandeau
    detailBandeau.innerHTML = data.bandeau;


    // afficher le dernier résultat de moins de 15 jours publié sur le site de la F.F.A
    if(data.ffa.length > 0) {
        let a = document.createElement('a');
        a.href= "https://bases.athle.fr/asp.net/liste.aspx?frmbase=resultats&frmmode=1&frmespace=0&frmcompetition=" + data.ffa[0].id;
        a.classList.add("btn", "btn-sm", "btn-outline-dark", "m-2", "shadow-sm");
        a.innerText = data.ffa[0].date;
        a.innerText= data.ffa[0].titre;
        detailFFA.appendChild(a);
        cadreFFA.style.display = 'block';
    }


    // affichage de la prochaine épreuve si renseignée
    // les inscriptions ne sont pas forcément ouvertes


    // affichage des partenaires


    // affichage des liens


    pied.style.visibility = 'visible';
}
