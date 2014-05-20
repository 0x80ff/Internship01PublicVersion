<html>
<head>
	<title>Hi</title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.3/jquery.min.js" /></script>
<script type="text/javascript">
$(document).ready(function() {
 
    $('#champ1').hide(); // on cache les champs
    $('#champ2').hide();
    $('#champ3').hide();
     
    $('select[name="FormatDate"]').change(function() { // lorsqu'on change de valeur dans la liste
    var valeur = $(this).val(); // valeur sélectionnée
     
        if(valeur != '') { // si non vide
            if(valeur == 'Mois') { // si "Mois"
                $('#champ2').hide();
                $('#champ3').hide();
                $('#champ1').slideToggle("slow");
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
</script>
</head>
<body>
 
<form method="post" action="" align="center">
<p>
    <select name="FormatDate">
        <option value="">-- Choisir --</option>
        <option value="Mois">Mois</option>
        <option value="Trimestre">Trimestre</option>
        <option value="DateDate">Date a Date</option>
    </select><br /><br />

    <!-- Les Elements: -->
    <div id="champ3">
        <input type="date" id="3" /><br /><br />
        <input type="date" id="4" />
    </div>

    <did id="champ2">
        <select name="NumeroTrimestre">
            <option value="">-- Choisir --</option>
            <option value="1">1: Janvier-Mars</option>
            <option value="2">2: Avril-Juin</option>
            <option value="3">3: Juillet-Septembre</option>
            <option value="4">4: Octobre-Decembre</option>
        </select>
    </div>

    <div id="champ1" align="center"><input type="text" id="1" /></div>


    
</p>
</form>
<body>
	</html>