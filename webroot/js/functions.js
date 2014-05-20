$(document).ready(function() {
 
    $('#champ1').hide(); // on cache les champs
    $('#champ2').hide();
    $('#champ3').hide();
    $('#champ4').hide();
    $('#champ5').hide();
     
    $('select[name="service"]').change(function() {
        var valeur = $(this).val();

        if(valeur != '') {
            if(valeur == 'parService') {
                $('#champ5').hide();
                $('#champ4').slideToggle("slow");
            }
            else if(valeur == 'Default') {
                $('#champ4').hide();
                $('#champ5').hide();
            }
            else if(valeur == 'parDirection') {
                $('#champ4').hide();
                $('#champ5').slideToggle("slow");
            }
            else {
                $('#champ4').hide();
                $('#champ5').hide();
            }
        }
    })
    $('select[name="FormatDate"]').change(function() { // lorsqu'on change de valeur dans la liste
        var valeur = $(this).val(); // valeur sélectionnée
        

        if(valeur != '') { // si non vide
            if(valeur == 'Mois') { // si "Mois"
                $('#champ2').hide();
                $('#champ3').hide();
                $('#champ1').slideToggle("slow");
            }
            else if(valeur == 'Default') {
                $('#champ1').hide(); // on cache les champs
                $('#champ2').hide();
                $('#champ3').hide();
            }
            else if(valeur == 'Trimestre') {
                $('#champ1').hide();
                $('#champ3').hide();
                $('#champ2').slideToggle("slow");        
            }
            else if(valeur == 'DateDate') {
                $('#champ1').hide();
                $('#champ2').hide();
                $('#champ3').slideToggle("slow");

            }
            else {
                $('#champ1').hide(); // on cache les champs
                $('#champ2').hide();
                $('#champ3').hide();
            }
        }
    });
 
});