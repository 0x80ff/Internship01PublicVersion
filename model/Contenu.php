<?php
class Contenu extends Model{
	public $NOMBRELIGNEDEBUT = 0;
	public $NOMBRELIGNEFIN = 0;

	public $NOMBRELIGNEDEBUT2 = 2;
	public $NOMBRELIGNEFIN2 = 0;

	public function HMS($d)
    {
        $d = gmdate("H:i:s",$d);
        return $d;
    }
    public function getByID($id){
		$req = 'SELECT * FROM content WHERE idContent='.$id;
		$req = $this->getExecution($req);
	return $req;
	}
	
	public function Update($ID, $Nom, $Path, $Online){
		$req = 'UPDATE content SET nomContent="'.$Nom.'", pathContent="'.$Path.'", online='.$Online.' WHERE idContent='.$ID;
		$req = $this->getExecution($req,'update');
	}

    public function SupprByID($id){
    	$req = 'DELETE FROM content WHERE idContent='.$id;
		$req = $this->getExecution($req, 'delete');
    }

    public function getAll(){
		$req = 'SELECT * FROM content ORDER BY nomContent';
		$req = $this->getExecution($req);
	return $req;
	}

    public function putOnline($id){
    	$req = 'UPDATE content SET online="1" WHERE idContent='.$id;
    	$this->getExecution($req,'update');
    }

	public function InsertBDD($id){
		$filename = $this->getFileName($id);
		$pos1 = stripos($filename, 'detail');
		$pos2 = stripos($filename, '2250289_TBD');
		$pos3 = stripos($filename, '225028900');

		if ($pos1 !== false) {
			$this->doInsertDetail($id);
			$this->putOnline($id);
		}
		if($pos2 !== false) {
			$this->doInsert225($id);
			$this->putOnline($id);
		}
		if($pos3 !== false) {
			$this->doInsertSFR($id);
			$this->putOnline($id);
		}
	}

	public function DeleteContent($id){
		$req = $this->getPathContent($id);
			unlink ($req);

			$req = 'DELETE FROM content WHERE idContent='.$id;
			$this->getExecution($req, 'delete');

		//retourne vrai si suppr sinon false
		}

	public function getPathContent($id){
		$req = 'SELECT pathContent FROM content WHERE idContent='.$id;
		$req = $this->getExecution($req);
		foreach($req as $key => $value){
			$final = $value['pathContent'];
		}
	return $final;
	}

	public function getFileName($id){
		$req = 'SELECT nomContent FROM content WHERE idContent='.$id;
		$req = $this->getExecution($req);
		foreach($req as $key => $value){
			$final = $value['nomContent'];
		}
	return $final;
	}

	public function doInsertDetail($id){
		$filename = $this->getPathContent($id);
		
		$ligne = file($filename);
		$nbTotalLignes=count($ligne);
		$e=0;
		$nbSepar=0;

		for($i=0;$i<$nbTotalLignes;$i++)
		{
			if($i>$this->NOMBRELIGNEDEBUT2 && $i < ($nbTotalLignes-$this->NOMBRELIGNEFIN2))
		    {
		    	list($vide,$numeroAppel[$e],$nomAbo[$e],$vide,$vide,$vide,$date[$e],$vide,$numeroDist[$e],$durée[$e],$vide,$intitulé[$e],$montant[$e]) = explode(";", $ligne[$i]);
		    	
		        //ATTRIBUTION TYPE ET ETENDUE
		        $num=substr($numeroDist[$e], 0, 3);
		        if($num=="331" | $num=="332" | $num=="333" | $num=="334" | $num=="335" | $num=="339")
		        {
		            $type="Fixe";
		            $etendue="National";
		        }
		        elseif($num=="336" || $num=="337")
		        {
		        $type="Mobile";
		            if($durée[$e]=="")
		            {
		            $type="SMS";
		                if(!(strstr($intitulé[$e], "mobile")))
		                {
		                    $etendue="International";
		                }
		                else
		                {
		                    $etendue="National";
		                }
		            }
		            elseif(strstr($intitulé[$e],"appels internes"))
		            {
		                $etendue="Interne";
		            }
		            elseif(strstr($intitulé[$e],"renvoi appel depuis"))
		            {
		                $etendue="International";
		            }
		            elseif(strstr($intitulé[$e],"appel émis"))
		            {
		                $etendue="International";
		            }
		            else
		            {
		                $etendue="National";
		            }

		        }
		        elseif($num=="nav" || $num=="ora" ||$num=="web" ||$num=="mai")
		        {
		            $type="3G";
		            $etendue="Variable";
		        }
		        elseif($num=="338")
		        {
		            $type="Special";
		            if(strstr($intitulé[$e],"appel émis"))
		            {
		                $etendue="International";
		            }
		        }
		        else
		        {
		            $type="Fixe";
		            $etendue="International";
		        }
		        
		        if(!(strstr($durée[$e],":")))
		        {
		            $durée[$e]=intval($durée[$e]);
		            $durée[$e]=$this->HMS($durée[$e]);
		        }
		        
		        list($jour,$mois,$annee) = explode("/", $date[$e]);
		        $date[$e]=$annee."-".$mois."-".$jour;//Met $date au format DATE pour la BDD

		        $requete = 'SELECT idAbonne FROM abonnes
		                    WHERE numAbonne=:numAp';
		        $query = $this->db->prepare($requete);
		        $query->bindValue(':numAp', $numeroAppel[$e], PDO::PARAM_INT);
		        $query->execute();
		        $ID = $query->fetch(PDO::FETCH_ASSOC);
		        $ID=$ID['idAbonne'];

		        $numeroAppelé=$numeroDist[$e];
		        //Requête préparée, insertion données dans la table COMMUNICATIONS
		        $requete = 'INSERT INTO communications (abonne_id,dateCommunication,
		                                                numeroDistant,dureeCommunication,
		                                                typeCommunication,etendueCommunication,
		                                                montantCommunication)
		                    VALUES (:idabo,:datecom,:numdist,:duration,:typecom,:etend,:mont)';
		        $query = $this->db->prepare($requete);
		        $query->bindValue(':idabo', $ID, PDO::PARAM_INT);
		        $query->bindValue(':datecom', $date[$e], PDO::PARAM_INT);
		        $query->bindValue(':numdist', $numeroAppelé, PDO::PARAM_INT);
		        $query->bindValue(':duration', $durée[$e], PDO::PARAM_INT);
		        $query->bindValue(':typecom', $type, PDO::PARAM_INT);
		        $query->bindValue(':etend', $etendue, PDO::PARAM_INT);
		        $query->bindValue(':mont', $montant[$e], PDO::PARAM_INT);
		        $query->execute();
		        
		        $e++;
		    }
		}
	}

	public function doInsert225($id){
		$filename = $this->getPathContent($id);
		$ligne = file($filename);
		$nbTotalLignes=count($ligne);
		$e=0;
		$nbSepar=0;

		for($i=0;$i<$nbTotalLignes;$i++)
		{
			if($i>$this->NOMBRELIGNEDEBUT && $i < ($nbTotalLignes-$this->NOMBRELIGNEFIN))
		    {
		    	list($vide,$vide,$vide,$vide,$vide,$vide,$vide,$vide,$vide,$vide,$vide,
		    		$vide,$vide,$vide,$numAppel[$e],$vide,$vide,$vide,$vide,$vide,$vide,
		    		$vide,$numeroDist[$e],$date[$e],$vide,$vide,$durée[$e],$vide,$montant[$e]) = explode(";", $ligne[$i]);

		    	$numAppel[$e] ='0'.$numAppel[$e];//Ajout du 0;
		    	$numeroDist[$e] = '33'.$numeroDist[$e];//Ajout du 33;
		        //ATTRIBUTION TYPE ET ETENDUE
		        $num=substr($numeroDist[$e], 0, 3);
		        if($num=="331" | $num=="332" | $num=="333" | $num=="334" | $num=="335" | $num=="339")
		        {
		            $type="Fixe";
		            $etendue="National";
		        }
		        elseif($num=="336" || $num=="337")
		        {
		        $type="Mobile";
		        $etendue="National";
		        }
		        elseif($num=="338")
		        {
		            $type="Special";
		            $etendue="Variable";
		        }
		        else
		        {
		            $type="Fixe";
		            $etendue="International";
		        }
		        
		        if(!(strstr($durée[$e],":")))
		        {
		            $durée[$e]=intval($durée[$e]);
		            $durée[$e]=$this->HMS($durée[$e]);
		        }
		        
		        list($jour,$mois,$annee) = explode("/", $date[$e]);
		        $date[$e]=$annee."-".$mois."-".$jour;//Met $date au format DATE pour la BDD

		        $requete = 'SELECT idAbonne FROM abonnes
		                    WHERE numAbonne=:numAp';
		        $query =  $this->db->prepare($requete);
		        $query->bindValue(':numAp', $numAppel[$e], PDO::PARAM_INT);
		        $query->execute();
		        $ID = $query->fetch(PDO::FETCH_ASSOC);
		        $ID=$ID['idAbonne'];

		        $numeroAppelé=$numeroDist[$e];
		        //Requête préparée, insertion données dans la table COMMUNICATIONS
		        $requete = 'INSERT INTO communications (abonne_id,dateCommunication,
		                                                numeroDistant,dureeCommunication,
		                                                typeCommunication,etendueCommunication,
		                                                montantCommunication)
		                    VALUES (:idabo,:datecom,:numdist,:duration,:typecom,:etend,:mont)';
		        $query = $this->db->prepare($requete);
		        $query->bindValue(':idabo', $ID, PDO::PARAM_INT);
		        $query->bindValue(':datecom', $date[$e], PDO::PARAM_INT);
		        $query->bindValue(':numdist', $numeroAppelé, PDO::PARAM_INT);
		        $query->bindValue(':duration', $durée[$e], PDO::PARAM_INT);
		        $query->bindValue(':typecom', $type, PDO::PARAM_INT);
		        $query->bindValue(':etend', $etendue, PDO::PARAM_INT);
		        $query->bindValue(':mont', $montant[$e], PDO::PARAM_INT);
		        $query->execute();
		    	$e++;
			}	
		}
	}


	public function doInsertSFR($id){
		$filename = $this->getPathContent($id);
		$ligne = file($filename);
		$nbTotalLignes=count($ligne);
		$e=0;
		$nbSepar=0;

		for($i=0;$i<$nbTotalLignes;$i++)
		{
			if($i>$this->NOMBRELIGNEDEBUT && $i < ($nbTotalLignes-$this->NOMBRELIGNEFIN))
		    {
		    	list($vide,$vide,$vide,$vide,$vide,$vide,$vide,$vide,$vide,$vide,$numAppel[$e],$vide,$vide,$vide,$vide,$vide,$vide,
		    		$numeroDist[$e],$date[$e],$vide,$durée[$e],$vide,$vide,$montant[$e]) = explode(";", $ligne[$i]);

		    	$numAppel[$e] ='0'.$numAppel[$e];//Ajout du 0;
		    	$numeroDist[$e] = '33'.$numeroDist[$e];//Ajout du 33;
		        //ATTRIBUTION TYPE ET ETENDUE
		        $num=substr($numeroDist[$e], 0, 3);
		        if($num=="331" | $num=="332" | $num=="333" | $num=="334" | $num=="335" | $num=="339")
		        {
		            $type="Fixe";
		            $etendue="National";
		        }
		        elseif($num=="336" || $num=="337")
		        {
		        $type="Mobile";
		        $etendue="National";
		        }
		        elseif($num=="338")
		        {
		            $type="Special";
		            $etendue="Variable";
		        }
		        else
		        {
		            $type="Fixe";
		            $etendue="International";
		        }
		        
		        if(!(strstr($durée[$e],":")))
		        {
		            $durée[$e]=intval($durée[$e]);
		            $durée[$e]=$this->HMS($durée[$e]);
		        }
		        
		        list($jour,$mois,$annee) = explode("/", $date[$e]);
		        $date[$e]=$annee."-".$mois."-".$jour;//Met $date au format DATE pour la BDD

		        $requete = 'SELECT idAbonne FROM abonnes
		                    WHERE numAbonne=:numAp';
		        $query =  $this->db->prepare($requete);
		        $query->bindValue(':numAp', $numAppel[$e], PDO::PARAM_INT);
		        $query->execute();
		        $ID = $query->fetch(PDO::FETCH_ASSOC);
		        $ID=$ID['idAbonne'];

		        $numeroAppelé=$numeroDist[$e];
		        //Requête préparée, insertion données dans la table COMMUNICATIONS
		        $requete = 'INSERT INTO communications (abonne_id,dateCommunication,
		                                                numeroDistant,dureeCommunication,
		                                                typeCommunication,etendueCommunication,
		                                                montantCommunication)
		                    VALUES (:idabo,:datecom,:numdist,:duration,:typecom,:etend,:mont)';
		        $query = $this->db->prepare($requete);
		        $query->bindValue(':idabo', $ID, PDO::PARAM_INT);
		        $query->bindValue(':datecom', $date[$e], PDO::PARAM_INT);
		        $query->bindValue(':numdist', $numeroAppelé, PDO::PARAM_INT);
		        $query->bindValue(':duration', $durée[$e], PDO::PARAM_INT);
		        $query->bindValue(':typecom', $type, PDO::PARAM_INT);
		        $query->bindValue(':etend', $etendue, PDO::PARAM_INT);
		        $query->bindValue(':mont', $montant[$e], PDO::PARAM_INT);
		        $query->execute();
		    	$e++;
			}	
		}
	}


}