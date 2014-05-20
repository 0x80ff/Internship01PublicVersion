<?php
class Communication extends Model{

	public $attribut=" AND ";

	/*
	* Retourne la requête principale. Dynamique, elle récupère les données du formulaire de recherche, et crée une
	* requête en fonction des paramêtres envoyés
	* @return un Array() contenant les résultats 
	*/
	public function getResults($dMin,$dMax,$nom,$service,$type,$etendue,$date,$numero,$mMin,$mMax,$Format,$modeService){

		$req='SELECT * FROM communications, abonnes WHERE communications.abonne_id=abonnes.idAbonne';

		if ($dMin!=NULL && $dMax!=NULL)
		{
			$req.=$this->attribut.'dureeCommunication >="'.$dMin.'" AND dureeCommunication <="'.$dMax.'"';
		}
		if($type!=NULL)
		{
			if($type!="Tout"){
			$req.=$this->attribut.'typeCommunication="'.$type.'"';
		}
		}
		if($etendue!=NULL)
		{
			$req.=$this->attribut.'etendueCommunication="'.$etendue.'"';
		}
		if($date!=NULL)
		{
			if($date!=null && $Format!=null){
			$req.=$this->getReqByFormat($date,$Format);
        }
        }
		if($numero!=NULL)
		{
			$req.=$this->attribut.'abonne_id=(SELECT idAbonne FROM abonnes WHERE numAbonne='.$numero.')';
		}
		if($mMin!=NULL && $mMax!=NULL)
		{
			$req.=$this->attribut.'montantCommunication >='.$mMin.' AND montantCommunication <='.$mMax;
		}
		if($nom!=NULL)
		{
			$i = 0;
			$mots = explode(" ", $nom);
			$req.=$this->attribut.'nomAbonne IN (SELECT nomAbonne FROM abonnes WHERE';
			
			foreach($mots as $mot)
			{
				if($i == 0){
					$req.=' nomAbonne LIKE "%'.$mot.'%"';
				}
				if($i > 0){
					$req.=$this->attribut.' nomAbonne LIKE "%'.$mot.'%"';
				}
				$i++;
			}
			$req.=' ORDER BY nomAbonne ASC)';
			
		}
		if($service!=NULL)
		{
			if($modeService == 'parDirection'){
				$req.=$this->attribut.'service_id IN';
				$req.=' (SELECT idService FROM services WHERE attacheService IN';
				$req.=' (SELECT attacheService FROM services WHERE attacheService =';
				$req.=' (SELECT idService FROM services WHERE nomService =  "'.$service.'")))';
				$req.=' OR nomAbonne IN (SELECT nomAbonne FROM abonnes WHERE service_id =';
				$req.=' (SELECT idService FROM services WHERE nomService = "'.$service.'" ))';
				$req.=' GROUP BY nomAbonne';
			}
			else if($modeService == 'parService'){
				$req.=$this->attribut.'service_id = (SELECT idService FROM services WHERE nomService ="'.$service.'")';
			}
			
		}
		$req = $this->getExecution($req);
	return $req;
	}

	/*
	* Renvois les noms de services
	*/
	public function getServices(){
		$req='SELECT DISTINCT nomService FROM services';
		$req = $this->getExecution($req);
	return $req;
	}

	/*
	* Renvois les noms des directions
	*/
	public function getServicesByDir(){
		$req='SELECT nomService FROM services WHERE attacheService ="0"';
		$req = $this->getExecution($req);
	return $req;
	}

	/*
	* Renvoie les types d'appels
	*/
	public function getTypesCalls(){
		$req = 'SELECT DISTINCT typeCommunication FROM communications';
		$req = $this->getExecution($req);
	return $req;
	}

	/*
	* Renvois les étendues de communications
	*/
	public function getAreaCalls(){
		$req =  'SELECT DISTINCT etendueCommunication FROM communications';
		$req = $this->getExecution($req);
	return $req;
	}

	/*
	* Renvois le nombre d'appel par type de communication.
	* @param $Format,$date: Non obligatoires, si précisés, recherche le nombre d'appels par type,
	* sur la durée notifiée.
	*/
	public function getNbCalls($type,$Format=null,$date=null){
		if($type!="Tout"){
			$req='SELECT COUNT(typeCommunication) AS nombreTotal FROM communications WHERE typeCommunication="'.$type.'"';
		}else{
			$req='SELECT COUNT(typeCommunication) As nombreTotal FROM communications';
		}		
		if($date!=null && $Format!=null){
			$req.=$this->getReqByFormat($date,$Format);
        }
		$req = $this->getExecution($req);
	return $req;
	}

	/*
	* Renvois la durée d'appels par type de communication.
	* @param $Format,$date: Non obligatoires, si précisés, recherche la durée par type,
	* sur la durée notifiée.
	*/
	public function getDurationCalls($type,$Format=null,$date=null){
		if($type!="Tout"){
			$req='SELECT SUM(dureeCommunication) AS dureeTotale FROM communications WHERE typeCommunication="'.$type.'"';
		}else{
			$req='SELECT SUM(dureeCommunication) As dureeTotale FROM communications';
		}
		if($date!=null && $Format!=null){
			$req.=$this->getReqByFormat($date,$Format);
        }
		$req = $this->getExecution($req);
	return $req;
	}

	/*
	* Renvois le coût des appels par type de communication.
	* @param $Format,$date: Non obligatoires, si précisés, recherche le coût des appels par type,
	* sur la durée notifiée.
	*/
	public function getCostCalls($type,$Format=null,$date=null){
		if($type!="Tout"){
			$req='SELECT SUM(montantCommunication) AS coutTotal FROM communications WHERE typeCommunication="'.$type.'"';
		}else{
		$req='SELECT SUM(montantCommunication) As coutTotal FROM communications';
		}
		if($date!=null && $Format!=null){
			$req.=$this->getReqByFormat($date,$Format);
        }
		$req = $this->getExecution($req);
	return $req;
	}

	/*
	* Renvois un morceau de requête en fonction du type de date
	*/
	public function getReqByFormat($date, $Format){
			if($Format == "Mois"){
                $req=$this->attribut.'MONTH(dateCommunication)="'.$date.'"';
            }
            if($Format == "Trimestre"){
                List($mois1,$mois2,$mois3) = explode("-", $date);
			 	$req=$this->attribut.'MONTH( dateCommunication )>="'.$mois1.'" AND MONTH( dateCommunication )<="'.$mois3.'"';
            }
            if($Format == "DateDate"){
                $req=$this->attribut.'dateCommunication>="'.$date[0].'" AND dateCommunication<="'.$date[1].'"';
            }
        return $req;
	}
}
