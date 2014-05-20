<?php
require 'menu.php';
?>

<div class="hero-unit">
	<?php foreach($contenu as $key => $value){ ?>
	<form class="form-horizontal" method="post" action="SaveEdit">
    	<div class="control-group">
	    	<label class="control-label" for="input">Nom</label>
			    <div class="controls">
			    	<input type="text" value="<?php echo $value['nomAbonne']; ?>" name="Nom" />
			    </div>
		    </div>

			<div class="control-group">
			    <label class="control-label" for="input">Num</label>
			    <div class="controls">
		    		<input type="text" value="<?php echo $value['numAbonne']; ?>" name="Num"/>
		    	</div>
		    </div>

		    <div class="control-group">
			    <label class="control-label" for="input">Service</label>
			    <div class="controls">
		    		<input type="test" value="<?php echo $value['service_id']; ?>" name="IDService"/>
		    	</div>
		    </div>
		    <input type="hidden" name="ID" value="<?php echo $value['idAbonne']; ?>" />
		    <input type="hidden" name="Type" value="Abonne" />
		    <br/>
		    <div class="control-group">
		    	<div class="controls">
		    	<button class="btn primary" type="submit"><i class="icon-white icon-ok"></i> Fini!</button> 
		    	</div>
		    </div>  
    </form>
    <?php } ?>
</div>