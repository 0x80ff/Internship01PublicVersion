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
		   			<th>Site</th>
		   			<th>Service Rattaché</th>
		   			<th>Action</th>
		   		</tr>
	   		</thead>

	   		<tbody>
	   			<form action="<?php echo BASE_URI.'/Session/Added'; ?>" method="post">
	   			<tr>
	   				<td><input type="text" value="" name="Nom" placeholder="Saisir" /></td>
	   				<td><input type="text" value="" name="Site" placeholder="Saisir"/></td>
	   				<td>
	   					<select name="Attache">
	   						<option value="">-- Choisir --</option>
	   						<?php foreach($Service as $key => $value){ 
	   						if($value['attacheService'] == 0){ ?>
	   						<option value="<?php echo $value['idService']; ?>"><?php echo $value['nomService']; ?></option>
	   						<?php } } ?>
	   					</select>
	   				</td>
	   				<td><input type="hidden" name="Type" value="Service"/>
	   					<button class="btn success" type="submit"><i class="icon-white  icon-plus-sign"></i> Ajouter</button></td>
	   			</tr>
	   		</form>
	   		</tbody>
	</table>
</div>