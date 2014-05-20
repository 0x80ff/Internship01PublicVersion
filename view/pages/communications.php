<?php


try
{
	$strConnection = 'mysql:host=localhost;dbname=stagev2'; //Ligne 1
	$arrExtraParam= array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"); //Ligne 2
	$pdo = new PDO($strConnection, 'root', 'root', $arrExtraParam); //Ligne 3; Instancie la connexion
	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);//Ligne 4
	echo "Connexion Etablie";
}
catch(PDOException $e)
{
	$msg = 'ERREUR PDO dans ' . $e->getFile() . ' L.' . $e->getLine() . ' : ' . $e->getMessage();
	die($msg);
}
 	$requete = 'SELECT DISTINCT nomService FROM services';
        $query = $pdo->prepare($requete);
        $tableaunom = $query->execute();
        $tableaunom = $query->fetchAll(PDO::FETCH_ASSOC);

        $requete = 'SELECT DISTINCT typeCommunication FROM communications';
        $query = $pdo->prepare($requete);
        $tableautype = $query->execute();
        $tableautype = $query->fetchAll(PDO::FETCH_ASSOC);

        $requete = 'SELECT DISTINCT etendueCommunication FROM communications';
        $query = $pdo->prepare($requete);
        $tableauetendue = $query->execute();
        $tableauetendue = $query->fetchAll(PDO::FETCH_ASSOC);


function communicationsOptions($dMin, $dMax, $nom, $service, $type, $etendue, $date, $numero, $mMin, $mMax)
{
	$attribut=" AND ";

	$req='SELECT * FROM communications, abonnes WHERE communications.abonne_id=abonnes.idAbonne';

	if (isset($dMin) && isset($dMax))
	{
		$req.=$attribut.'dureeCommunication >='.$dMin.' AND dureeCommunication <='.$dMax;
	}
	if(isset($nom))
	{
		$req.=$attribut.'abonne_id = (SELECT idAbonne FROM abonnes WHERE nomAbonne='.$nom.')';
	}
	if(isset($service))
	{
		$req.=$attribut.'service_id = (SELECT idService FROM services WHERE nomService ='.$service.')';
	}
	if(isset($type))
	{
		$req.=$attribut.'typeCommunication='.$type;
	}
	if(isset($etendue))
	{
		$req.=$attribut.'etendueCommunication='.$etendue;
	}
	if(isset($date))
	{
		$req.=$attribut.'dateCommunication='.$date;
	}
	if(isset($numero))
	{
		$req.=$attribut.'abonne_id=(SELECT idAbonne FROM abonnes WHERE numAbonne='.$numero.')';
	}
	if(isset($numero))
	{
		$req.=$attribut.'montantCommunication >='.$mMin.' AND montantCommunication <='.$mMax;
	}
	return $req;
}

//$resultat= communicationsOptions($dMin, $dMax, $nom, $service, $type, $etendue, $date, $numero, $mMin, $mMax);
//echo $resultat;

?>
<div id="Recherche Communication" align="center">
<form action="./resultats" method="post">
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
				<td><input type="text" name="dMin" value="00:00:00" /> % <input type="text" name="dMax" value="23:59:59"/></td>
				<td><input type="text" name="nom" /></td>
				<td><select name="service" onchange="updated(this)">
					<option value=""> </option>
        			<?php 
        			for($i=0;$i<sizeof($tableaunom);$i++)
        			{	
        			?> 
        			<option value="<?php echo($tableaunom[$i]['nomService']); ?>"><?php echo($tableaunom[$i]['nomService']); ?></option>
        			<?php
        			} 
        			?>
        			</select></td>
        		<td><select name="type" onchange="updated(this)">
        			<option value=""> </option>
        			<?php 
        			for($i=0;$i<sizeof($tableautype);$i++)
        			{	
        			?> 
        			<option value="<?php echo($tableautype[$i]['typeCommunication']); ?>"><?php echo($tableautype[$i]['typeCommunication']); ?></option>
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
					<option value=""> </option>
        			<?php 
        			for($i=0;$i<sizeof($tableauetendue);$i++)
        			{	
        			?> 
        			<option value="<?php echo($tableauetendue[$i]['etendueCommunication']); ?>"><?php echo($tableauetendue[$i]['etendueCommunication']); ?></option>
        			<?php
        			} 
        			?>
        			</select></td>
        		<td><input name="date" type="date" value=""/></td>
        		<td><input type="tel" name="numero" value="" pattern="^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$"/></td>
        		<td><input type="number" value="" name="mMin"> % <input type="number" value="" name="mMax"/></td>
        	</tr>
        </tbody>
    </table>
    <label>Total PP: </label><input type="radio" name="total" value="1">
    <br /><input type="submit" value="Search" align="left" />

</form>
</div>
<br /><br />

