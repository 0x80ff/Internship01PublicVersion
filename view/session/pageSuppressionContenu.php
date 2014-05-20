<?php
require 'menu.php';

if(isset($message)){
	echo $message;
}
?>
<div class="span5 offset4">
<table class="table"><thead><tr class="error"><th></th></tr></thead><tbody><tr style="text-align: center"  class="info"><td style="text-align: center" ><h2>Supression<h2></td></tr></tbody></table>
</div>
<br /><br /><br /><br />
<div class="hero-unit">
	<table class="table  table-bordered">
	   		<thead>
		   		<tr class="info">
		   			<th>#</th>
		   			<th>Nom</th>
		   			<th>Chemin</th>
		   			<th>Statut</th>
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
	      				<td><li><?php echo '<a href="'.BASE_URI.'webroot/content/'.$value['nomContent'].'">'.$value['nomContent'].'</a>'; ?></li></td>
	      				<td><li class="text-info"><?php echo $value['pathContent']; ?></li></td>
	      				<td><li><?php echo $value['online']; ?></li></td>
	      				<td><form method="post" action="<?php echo BASE_URI.'/Session/Deleting'; ?>">
	      					<input type="hidden" name="ID" value="<?php echo $value['idContent']; ?>"/>
	      					<input type="hidden" name="Nom"  value="Contenu" />
	      					<button class="btn error" type="submit"><i class="icon-white icon-remove"></i> Supprimer</button></form>
	      				</td>
	      		    </ul>
				   </tr>
				   <?php $i++; } ?>
	   		</tbody>		
	</table>
</div>





