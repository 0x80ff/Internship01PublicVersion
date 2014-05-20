<?php
require 'menu.php';
?>

<table><thead><th><p><h2 align="center"><strong>Gestion des fichiers</strong></h2></p></th></thead><tbody><tr><td></td></tr></tbody></table>
	
<table class="table-bordered">
	<thead>
		<th>#</th>
		<th>Nom Fichier</th>
		<th>Statut</th>
		<th>Actions</th>
	<thead>

	<tbody>
		<?php
		$i=1;
		foreach($content as $key => $value){
		?>
		<tr>
			<td><?php echo $i ?></td>
			<td><?php echo '<a href="'.$directory.$value['nomContent'].'">'.$value['nomContent'].'</a>'; ?></td>
			<td><?php if($value['online'] == 0){
				echo '<span class="badge"><i class="icon-white icon-remove"></i> Hors ligne</span>';
			}else{
				 echo '<span class="badge badge-success"><i class="icon-white icon-ok"></i> En ligne</span>';
			}?></td>
			<td><form method="post" action="<?php echo BASE_URI.'/Session/Charger'; ?>"><input type="hidden" name="idContent" value="<?php echo $value['idContent']; ?>"/><input type="submit" class="btn primary" value="Charger"/></form></td>
				<td><form method="post" action="<?php echo BASE_URI.'/Session/Supprimer'; ?>"><input type="hidden" name="idContent" value="<?php echo $value['idContent']; ?>"/><input type="submit" class="btn danger" value="Supprimer"/></form></td>
		</tr>
		<?php
			$i++;}
		?>
	</tbody>
</table>





