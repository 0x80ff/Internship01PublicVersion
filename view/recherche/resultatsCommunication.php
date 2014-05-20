<?php
if($this->typeTT != ""){
	foreach($this->dureeTT as $cle => $valeur){ 
        $this->dureeTT =  $this->HMS($valeur['dureeTotale']);
	} 

	require 'informationSupplementaires.php';
}
?>
		<div class="hero-unit" id="Resultats" align="center">
		<table>
				<caption><h2>Resultats de la recherche<h2></caption>

				<thead> <!-- En-tête du tableau -->
					<tr>
						<th></th>
						<th align="center">Nom</th>
						<th align="center">Numero D'&eacute;mission</th>
						<th align="center">Date</th>
						<th align="center">Numero Distant</th>
						<th align="center">Dur&eacute;e</th>
						<th align="center">Type</th>
						<th align="center">Etendue</th>
						<th align="center">Montant</th>
					</tr>
				</thead>

				<tbody>
					<?php
					//echo $this->communication;
					//
					foreach($this->communication as $cle => $valeur)
		            {
		            ?>
		                <tr>
		                	<td><form method="post" action="<?php echo BASE_URI.'/Info/Abonnes'; ?>"><input type="hidden" name="idAbo" value="<?php echo $valeur['idAbonne']; ?>"/><input type="submit" class="btn info btn-mini" value="Infos"/></form><p></td>
		                	<td><?php echo $valeur['nomAbonne'];?></p></td>
		                    <td align="center"><?php echo $valeur['numAbonne'];?></td>
		                    <td align="center"><?php echo $valeur['dateCommunication'];?></td>
		                    <td align="center"><?php echo $valeur['numeroDistant'];?></td>
		                    <td align="center"><?php echo $valeur['dureeCommunication'];?></td>
		                    <td align="center"><?php echo $valeur['typeCommunication'];?></td>
		                    <td align="center"><?php echo $valeur['etendueCommunication'];?></td>
		                    <td align="center"><?php echo $valeur['montantCommunication'];?></td>
		                </tr>
		            <?php
		            } ////fin de la boucle
		            ?>

				</tbody>
		</table>
		</div>

