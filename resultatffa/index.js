$(document).ready(function() {
    $('#ajouter').click(function(e) {
        e.preventDefault(); // empêcher le formulaire d'être soumis

        // récupérer les valeurs des champs
        var id = $('#id').val();
        var date = $('#date').val();
        var titre = $('#titre').val();

        // envoyer les données au script PHP via AJAX
        $.ajax({
            url: 'ajoutercourse.php',
            method: 'POST',
            data: {id: id, date: date, titre: titre},
            success: function(response) {
                // afficher un message de confirmation
                alert('La course a été ajoutée avec succès !');

                // réinitialiser les champs du formulaire
                $('#id').val('');
                $('#date').val('');
                $('#titre').val('');
            }
        });
    });
});





