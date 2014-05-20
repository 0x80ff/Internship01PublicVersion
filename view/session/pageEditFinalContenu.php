<?php
require 'menu.php';
?>

<div class="hero-unit">
	<?php foreach($contenu as $key => $value){ ?>
	<form class="form-horizontal" method="post" action="SaveEdit">
    	<div class="control-group">
	    	<label class="control-label" for="input">Nom</label>
			    <div class="controls">
			    	<input type="text" value="<?php echo $value['nomContent']; ?>" class="input-xxlarge" name="Nom"/>
			    </div>
		    </div>

			<div class="control-group">
			    <label class="control-label" for="input">Chemin</label>
			    <div class="controls">
		    		<input type="text" value="<?php echo $value['pathContent']; ?>" class="input-xxlarge" name="Path"/>
		    	</div>
		    </div>

		    <div class="control-group">
			    <label class="control-label" for="input">Statut</label>
			    <div class="controls">
		    		<input type="test" value="<?php echo $value['online']; ?>" name="Online"/>
		    	</div>
		    </div>
		    <input type="hidden" name="ID" value="<?php echo $value['idContent']; ?>" />
		    <input type="hidden" name="Type" value="Contenu" />
		    <br/>
		    <div class="control-group">
		    	<div class="controls">
		    	<button class="btn primary" type="submit"><i class="icon-white icon-ok"></i> Fini!</button> 
		    	</div>
		    </div>  
    </form>
    <?php } ?>
</div>