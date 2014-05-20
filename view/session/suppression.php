<?php
require 'menu.php';
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
		   			<th>Edition</th>
		   			<th>Action</th>
		   		</tr>
	   		</thead>

	   		<tbody>
	   			<tr class="">
	   			   <ul class="nav nav-list">
	      				<td><li>1</li></td>
	      				<td><li><i class="icon-user"></i> Abonnés</li></td>
	      				<td><form method="post" action="<?php echo BASE_URI.'/Session/Suppression'; ?>"><input type="hidden" name="Voir" value="Abonne"/><input type="submit" class="btn info" value="Voir"/></form></td>
	      		    </ul>
				   </tr>
				<tr class="">
	   			   	<ul class="nav nav-list">
	      				<td><li>2</li></td>
	      				<td><li><i class="icon-folder-close"></i> Contenu</li></td>
	      				<td><form method="post" action="<?php echo BASE_URI.'/Session/Suppression'; ?>"><input type="hidden" name="Voir" value="Contenu"/><input type="submit" class="btn info" value="Voir"/></form></td>
				      </ul>
				</tr>
				<tr class="">
	   			   	<ul class="nav nav-list">
	      				<td><li>3</li></td>
	      				<td><li><i class="icon-wrench"></i> Services</li></td>
	      				<td><form method="post" action="<?php echo BASE_URI.'/Session/Suppression'; ?>"><input type="hidden" name="Voir" value="Service"/><input type="submit" class="btn info" value="Voir"/></form></td>
				      </ul>
				</tr>
	   		</tbody>		
	</table>
</div>





