		<div class="hero-unit" id="Resultats" align="center">
			<h1>Resultats Statistiques</h1>
		</div>
		<br />
<div class="hero-unit">
		<table>
				<caption><h2>Cout des communications<h2></caption>

				<thead> <!-- En-tête du tableau -->
					<tr>
						<th align="center">Mois</th>
						<th align="center">Trimestre Pr&eacute;c&eacute;dent</th>
					</tr>
				</thead>

				<tbody>
		                <tr>
		                    <td align="center"><?php echo $this->statistiquesCout['mois'];?></td>
		                    <td align="center"><?php echo $this->statistiquesCout['moyenne'];?></td>
		                </tr>

				</tbody>
		</table>
	</div>

	<div class="hero-unit">
		<table>
				<caption><h2>Nombre de communications<h2></caption>

				<thead> <!-- En-tête du tableau -->
					<tr>
						<th align="center">Mois</th>
						<th align="center">Trimestre Pr&eacute;c&eacute;dent</th>
					</tr>
				</thead>

				<tbody>
		                <tr>
		                    <td align="center"><?php echo $this->statistiquesNb['mois'];?></td>
		                    <td align="center"><?php echo $this->statistiquesNb['moyenne'];?></td>
		                </tr>

				</tbody>
		</table>
	</div>
