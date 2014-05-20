<?php
require 'menu.php';
?>
<div class="span5 offset4">
<table class="table"><thead><tr class="info"><th></th></tr></thead><tbody><tr style="text-align: center"  class="info"><td style="text-align: center" ><h2>Edition<h2></td></tr></tbody></table>
</div>
<br /><br /><br />


<br />
<div class="hero-unit">
	<table class="table  table-bordered">
	   		<thead>
		   		<tr class="info">
		   			<th>#</th>
		   			<th>Edition</th>
		   			<th>Actions</th>
		   		</tr>
	   		</thead>

	   		<tbody>
	   			<tr class="">
	   			   <ul class="nav nav-list">
	      				<td><li>1</li></td>
	      				<td><li><i class="icon-user"></i> Abonnés</li></td>
	      				<td><form method="post" action="<?php echo BASE_URI.'/Session/Edition'; ?>"><input type="hidden" name="Edit" value="Abonne"/><input type="submit" class="btn primary" value="Edition"/></form></td>
	      				<td><form method="post" action="<?php echo BASE_URI.'/Session/Add'; ?>"><input type="hidden" name="Add" value="Abonne"/><input type="submit" class="btn success" value="+ Ajout"/></form></td>
				      </ul>
				   </tr>
				<tr class="">
	   			   	<ul class="nav nav-list">
	      				<td><li>2</li></td>
	      				<td><li><i class="icon-folder-close"></i> Contenu</li></td>
	      				<td><form method="post" action="<?php echo BASE_URI.'/Session/Edition'; ?>"><input type="hidden" name="Edit" value="Contenu"/><input type="submit" class="btn primary" value="Edition"/></form></td>
	      				<td></td>
	      		    </ul>
				</tr>
				<tr class="">
	   			   	<ul class="nav nav-list">
	      				<td><li>3</li></td>
	      				<td><li><i class="icon-wrench"></i> Services</li></td>
	      				<td><form method="post" action="<?php echo BASE_URI.'/Session/Edition'; ?>"><input type="hidden" name="Edit" value="Service"/><input type="submit" class="btn primary" value="Edition"/></form></td>
	      				<td><form method="post" action="<?php echo BASE_URI.'/Session/Add'; ?>"><input type="hidden" name="Add" value="Service"/><input type="submit" class="btn success" value="+ Ajout"/></form></td>
				      </ul>
				</tr>
	   		</tbody>		
	</table>
</div>





