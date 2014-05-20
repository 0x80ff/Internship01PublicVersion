<div id="ResultatsTT">
	<table>
		<caption><h3>Informations suppl&eacute;mentaires</h3></caption>

		<thead> <!-- En-tête du tableau -->
			<tr>
				<th>Type</th>
				<th>Nombre d'appels</th>
				<th>Dur&eacute;e totale</th>
				<th>Co&ucirc;t total</th>
			</tr>
		</thead>

		<tbody>
                <tr class="info">            		
                	<td><?php echo $this->typeTT;?></td>
                	<?php foreach($this->nombreTT as $cle => $valeur){ ?>
                    <td align="center"><?php echo $valeur['nombreTotal'];?></td>
                    <?php } ?>
                    <td align="center"><?php echo $this->dureeTT;?></td>
                    <?php foreach($this->coutTT as $cle => $valeur){ ?>
                    <td align="center"><?php echo round($valeur['coutTotal'],2)."€"?></td>
                    <?php } ?>
                </tr>
		</tbody>
</table>
</div>