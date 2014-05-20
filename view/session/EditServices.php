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
		   			<th>Site</th>
		   			<th>ID Service</th>
		   			<th>Action</th>
		   		</tr>
	   		</thead>

	   		<tbody>
	   			<?php 
	   			foreach($contenu as $key => $value){ ?>
	   			<tr class="<? if($value['attacheService'] == 0){ echo 'info'; } ?>">
	   			   <ul class="nav nav-list">
	      				<td><li><?php echo $value['idService'] ?></li></td>
	      				<td><li><?php echo $value['nomService']; ?></li></td>
	      				<td><li><?php echo $value['siteService']; ?></li></td>
	      				<td><li><?php echo $value['attacheService']; ?></li></td>
	      				<td><form method="post" action="<?php echo BASE_URI.'/Session/Editing'; ?>">
	      					<input type="hidden" name="ID" value="<?php echo $value['idService']; ?>"/>
	      					<input type="hidden" name="Nom"  value="Service" />
	      					<button class="btn primary" type="submit"><i class="icon-white icon-pencil"></i> Editer</button></form>
	      				</td>
	      		    </ul>
				   </tr>
				   <?php } ?>
	   		</tbody>		
	</table>
</div>





