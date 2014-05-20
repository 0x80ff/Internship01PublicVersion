<div id="Recherche Communication" align="center">
<form action="../Recherche/Chargement" method="post">
	<table>
		<caption><h3><strong>Recherche de Communications</strong></h3></caption>

		<thead> <!-- En-tête du tableau -->
			<tr>
				<th>Duree</th>
				<th>Nom Abonne</th>
				<th>Service</th>
				<th>Type</th>
			</tr>
		</thead>

		<tbody>
			<tr>
				<td><input type="text" class="input-mini" name="dMin" value="00:00:00" /><i class=" icon-resize-horizontal icon-black"></i><input type="text" class="input-mini" name="dMax" value="23:59:59"/></td>
				<td><input type="text" name="nom" placeholder="Saisir" /></td>

				<td><select name="service" onchange="updated(this)">
					<option value="Default">-- Choisir --</option>
					<option value="parService">Par Service</option>
					<option value="parDirection">Par Direction</option>
				</select>

				
				    <div id="champ4">
				    	<select name="ByService">
				    		<?php 
        					for($i=0;$i<sizeof($this->servicesC);$i++){	
        					?> 
        					<option value="<?php echo($this->servicesC[$i]['nomService']); ?>"><?php echo($this->servicesC[$i]['nomService']); ?></option>
        					<?php
		        			} 
		        			?>
        				</select>
        			</div>

        			<div id="champ5">
        				<select name="ByDirection">
        					<option value=""> </option>
        					<?php 
        					for($i=0;$i<sizeof($this->servicesCbyDir);$i++){	
        					?> 
        					<option value="<?php echo($this->servicesCbyDir[$i]['nomService']); ?>"><?php echo($this->servicesCbyDir[$i]['nomService']); ?></option>
        					<?php
		        			} 
		        			?>
		        		</select>
		        	</div>
				</td>
        			
        		<td><select name="type" onchange="updated(this)">
        			<option value="">-- Choisir --</option>
        			<option value="Tout">Tout types</option>
        			<?php 
        			for($i=0;$i<sizeof($this->typesC);$i++)
        			{	
        			?> 
        			<option value="<?php echo($this->typesC[$i]['typeCommunication']); ?>"><?php echo($this->typesC[$i]['typeCommunication']); ?></option>
        			<?php
        			} 
        			?>
        			</select></td>
        	</tr>
        </tbody>
    </table>
    <table>
    	<thead>
    		<tr>
				<th>Etendue</th>
				<th>Date</th>
				<th>Numero</th>
				<th>Montant</th>
			</tr>
		</thead>

		<tbody>
			<tr>
				<td><select name="etendue" onchange="updated(this)">
					<option value="">-- Choisir --</option>
        			<?php 
        			for($i=0;$i<sizeof($this->etendueC);$i++)
        			{	
        			?> 
        			<option value="<?php echo($this->etendueC[$i]['etendueCommunication']); ?>"><?php echo($this->etendueC[$i]['etendueCommunication']); ?></option>
        			<?php
        			} 
        			?>
        			</select></td>
        		<td>
        			<select name="FormatDate">
			        	<option value="Default">-- Choisir --</option>
				        <option value="Mois">Mois</option>
				        <option value="Trimestre">Trimestre</option>
				        <option value="DateDate">Date a Date</option>
			    	</select><br /><br />

			    	<!-- Les Elements: -->
			    	<div id="champ1">
			    		<input type="text" name="Mois" id="1" /><br />
			    	</div>

			    	<div id="champ3">
				        <input type="date" name="date1" id="3" /><br /><br />
				        <input type="date" name="date2" id="4" />
				    </div>


			    	<did id="champ2">
				        <select name="NumeroTrimestre">
				            <option value="">-- Choisir --</option>
				            <option value="01-02-03">1: Janvier-Mars</option>
				            <option value="04-05-06">2: Avril-Juin</option>
				            <option value="07-08-09">3: Juillet-Septembre</option>
				            <option value="10-11-12">4: Octobre-Decembre</option>
				        </select>
				    </div>

				    
				    <!--Fin des Elements -->  
			    </td>
        		<td><input type="tel" name="numero" value="" placeholder="N°" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$"/></td>
        		<td><input type="text" class="input-mini" value=""  placeholder="#Min" name="mMin"><i class="icon-resize-horizontal icon-black"></i><input type="text" class="input-mini" value="" placeholder="#Max" name="mMax"/></td>
        	</tr>
        </tbody>
    </table>
   
   <button type="submit" class="btn primary">
    <i class="icon-search icon-black"></i> Search!
    </button>

</form>
</div>
<br /><br />

