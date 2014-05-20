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

$dMin= mysql_real_escape_string(htmlspecialchars($_POST['dMin']));
$dMax= mysql_real_escape_string(htmlspecialchars($_POST['dMax']));
$nom=$_POST['nom'];
$service=$_POST['service'];
$type=$_POST['type'];
$etendue=$_POST['etendue'];
$date=$_POST['date'];
$numero=$_POST['numero'];
$mMin=$_POST['mMin'];
$mMax=$_POST['mMax'];

function communicationsOptions($dMin, $dMax, $nom, $service, $type, $etendue, $date, $numero, $mMin, $mMax)
{
	$attribut=" AND ";

	$req='SELECT * FROM communications, abonnes WHERE communications.abonne_id=abonnes.idAbonne';

	if ($dMin!=NULL && $dMax!=NULL)
	{
		$req.=$attribut.'dureeCommunication >="'.$dMin.'" AND dureeCommunication <="'.$dMax.'"';
	}
	if($nom!=NULL)
	{
		$i=0;
		$mots = explode(" ", $nom);
		foreach($mots as $mot)
		{
			$req.=$attribut.'nomAbonne = (SELECT nomAbonne FROM abonnes WHERE';
			$req.=' nomAbonne LIKE "%'.$mot.'%"';
			if($i>0)
			{
				$req.=' OR nomAbonne LIKE "%'.$mot.'%"';
			}
		}
		$req.=' ORDER BY nomAbonne ASC)';
		
	}
	if($service!=NULL)
	{
		$req.=$attribut.'service_id = (SELECT idService FROM services WHERE nomService ="'.$service.'")';
	}
	if($type!=NULL)
	{
		$req.=$attribut.'typeCommunication="'.$type.'"';
	}
	if($etendue!=NULL)
	{
		$req.=$attribut.'etendueCommunication="'.$etendue.'"';
	}
	if($date!=NULL)
	{
		$req.=$attribut.'dateCommunication="'.$date.'"';
	}
	if($numero!=NULL)
	{
		$req.=$attribut.'abonne_id=(SELECT idAbonne FROM abonnes WHERE numAbonne='.$numero.')';
	}
	if($mMin!=NULL && $mMax!=NULL)
	{
		$req.=$attribut.'montantCommunication >='.$mMin.' AND montantCommunication <='.$mMax;
	}
	return $req;
}

$resultat= communicationsOptions($dMin, $dMax, $nom, $service, $type, $etendue, $date, $numero, $mMin, $mMax);
echo $resultat;
?>

<div id="Resultats" align="center">
<table>
		<caption>Resultats de la recherche</caption>

		<thead> <!-- En-tête du tableau -->
			<tr>
				<th>Nom</th>
				<th>Numero D'emission</th>
				<th>Date</th>
				<th>Numero Distant</th>
				<th>Duree</th>
				<th>Type</th>
				<th>Etendue</th>
				<th>Montant</th>
			</tr>
		</thead>

		<tbody>
			<?php
			
        
        		$requete = communicationsOptions($dMin, $dMax, $nom, $service, $type, $etendue, $date, $numero, $mMin, $mMax);
        		$query = $pdo->prepare($requete);
                $query->execute();
			while($donnees = $query->fetch())
            {
            ?>
                <tr>
                	<td align="center"><?php echo $donnees['nomAbonne'];?></td>
                    <td align="center"><?php echo $donnees['numAbonne'];?></td>
                    <td align="center"><?php echo $donnees['dateCommunication'];?></td>
                    <td align="center"><?php echo $donnees['numeroDistant'];?></td>
                    <td align="center"><?php echo $donnees['dureeCommunication'];?></td>
                    <td align="center"><?php echo $donnees['typeCommunication'];?></td>
                    <td align="center"><?php echo $donnees['etendueCommunication'];?></td>
                    <td align="center"><?php echo $donnees['montantCommunication'];?></td>
                </tr>
            <?php
            } //fin de la boucle
            ?>

		</tbody>
</table>
</div>
