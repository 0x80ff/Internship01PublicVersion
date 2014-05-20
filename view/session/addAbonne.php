<?php
require 'menu.php';

if(isset($message)){
	echo $message;
}
?>
<div class="span5 offset4">
<table class="table"><thead><tr class="error"><th></th></tr></thead><tbody><tr style="text-align: center"  class="info"><td style="text-align: center" ><h2>Ajout<h2></td></tr></tbody></table>
</div>
<br /><br /><br /><br />

<div class="hero-unit">
	<table class="table">
	   		<thead>
		   		<tr>
		   			<th>Nom</th>
		   			<th>Numéro</th>
		   			<th>Service</th>
		   			<th>Action</th>
		   		</tr>
	   		</thead>

	   		<tbody>
	   			<form action="<?php echo BASE_URI.'/Session/Added'; ?>" method="post">
	   			<tr>
	   				<td><input type="text" value="" name="Nom" placeholder="Saisir"/></td>
	   				<td><input type="tel" name="Numero" value="" placeholder="N°" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$"/></td>
	   				<td>
	   					<select name="Service">
	   						<option value="">-- Choisir --</option>
	   						<?php foreach($Service as $key => $value){ ?>
	   						<option value="<?php echo $value['idService']; ?>"><?php echo $value['nomService']; ?></option>
	   						<?php } ?>
	   					</select>
	   				</td>
	   				<td>
	   					<input type="hidden" name="Type" value="Abonne"/>
	   					<button class="btn success" type="submit"><i class="icon-white  icon-plus-sign"></i> Ajouter</button></td>
	   			</tr>
	   		</form>
	   		</tbody>
	</table>
</div>
	   			