<?php
require 'menu.php';

if(isset($message)){
	echo $message;
}
?>
<div class="span5 offset4">
<table class="table"><thead><tr class="error"><th></th></tr></thead><tbody><tr style="text-align: center"  class="info"><td style="text-align: center" ><h2>Edition<h2></td></tr></tbody></table>
</div>
<br /><br /><br /><br />
<div class="hero-unit">
	<table class="table  table-bordered">
	   		<thead>
		   		<tr class="info">
		   			<th>#</th>
		   			<th>Nom</th>
		   			<th>Numéro</th>
		   			<th>ID Service</th>
		   			<th>Action</th>
		   		</tr>
	   		</thead>

	   		<tbody>
	   			<?php 
	   			$i = 1;
	   			foreach($contenu as $key => $value){ ?>
	   			<tr class="">
	   			   <ul class="nav nav-list">
	      				<td><li><?php echo $i; ?></li></td>
	      				<td><li><?php echo $value['nomAbonne']; ?></li></td>
	      				<td><li><?php echo $value['numAbonne']; ?></li></td>
	      				<td><li><?php echo $value['service_id']; ?></li></td>
	      				<td><form method="post" action="../Session/Editing">
	      					<input type="hidden" name="ID" value="<?php echo $value['idAbonne']; ?>"/>
	      					<input type="hidden" name="Nom"  value="Abonne" />
	      					<button class="btn primary" type="submit"><i class="icon-white icon-pencil"></i> Editer</button></form>
	      				</td>
	      		    </ul>
				   </tr>
				   <?php $i++; } ?>
	   		</tbody>		
	</table>
</div>





