
function afficher(data) {
    if (data.resultatffa.length > 0) {
        let a = document.createElement('a');
        data.resultatffa[0].id;
        a.classList.add("btn", "btn-sm", "btn-outline-dark", "m-2", "shadow-sm");
        a.innerText = data.resultatffa[0].date;
        a.innerText = data.resultatffa[0].titre;
        detailFFA.appendChild(a);
    }
}