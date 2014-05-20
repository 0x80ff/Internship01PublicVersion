<div class="hero-unit" id="Resultats" align="center">

	<?php foreach($infos as $key => $value){?>
	<p class="text-center"><h2>Informations sur <?php echo $value['nomAbonne']; ?><h2></p><br />
	<p class="text-left">Numero: <?php echo $value['numAbonne']; ?></p>
	<p class="text-left">Service: <?php echo $value['nomService']; ?></p>
	<p class="text-left">Nombre d'Appels: <?php echo $value['nombre']; ?></p>
	<?php } ?>
