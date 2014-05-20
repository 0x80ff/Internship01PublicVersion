<?php
class Statistiques extends Model{

	public function AppelDepassement($timing){
	    $req = 'SELECT montantCommunication FROM communications WHERE montantCommunication >"0.0"';
	    $req = $this->getExecution($req);

	return array($req);
	}


	public function getCout($mois){

		$array 		= $this->setTrim($mois);
		$mois 		= $array[0];
		$trimestre 	= $array[1];

		$mois 		  = $this->getCountCost($mois);
		$trimestre[0] = $this->getCountCost($trimestre[0]);
		$trimestre[1] = $this->getCountCost($trimestre[1]);
		$trimestre[2] = $this->getCountCost($trimestre[2]);

		foreach($mois as $cle => $valeur){ 
	        $mois =  round($valeur['coutTotal'],2)."€";
	        }
	    foreach($trimestre[0] as $cle => $valeur){ 
	        $trimestre[0] =  round($valeur['coutTotal'],2)."€";
	        }
	    foreach($trimestre[1] as $cle => $valeur){ 
	        $trimestre[1] =  round($valeur['coutTotal'],2)."€";
	        }
	    foreach($trimestre[2] as $cle => $valeur){ 
	        $trimestre[2] =  round($valeur['coutTotal'],2)."€";
	        }

		$moyenne = round((($trimestre[0] + $trimestre[1] + $trimestre[2]) / 3),2)."€";

		return array('mois' => $mois, 'moyenne' => $moyenne);
	}

	public function getNb($mois){

		$array 		= $this->setTrim($mois);
		$mois 		= $array[0];
		$trimestre 	= $array[1];

		$mois 		  = $this->getCountNb($mois);
		$trimestre[0] = $this->getCountNb($trimestre[0]);
		$trimestre[1] = $this->getCountNb($trimestre[1]);
		$trimestre[2] = $this->getCountNb($trimestre[2]);

		foreach($mois as $cle => $valeur){ 
	        $mois =  round($valeur['nombreTotal'],2);
	        }
	    foreach($trimestre[0] as $cle => $valeur){ 
	        $trimestre[0] =  round($valeur['nombreTotal'],2);
	        }
	    foreach($trimestre[1] as $cle => $valeur){ 
	        $trimestre[1] =  round($valeur['nombreTotal'],2);
	        }
	    foreach($trimestre[2] as $cle => $valeur){ 
	        $trimestre[2] =  round($valeur['nombreTotal'],2);
	        }

		$moyenne = round((($trimestre[0] + $trimestre[1] + $trimestre[2]) / 3) );

		return array('mois' => $mois, 'moyenne' => $moyenne);
	}

	/*
	* Renvoie le cout total des communications pour le mois passé en paramêtre
	*/
	 public function getCountCost($timing){
	 		$req='SELECT SUM( montantCommunication ) AS coutTotal FROM communications WHERE MONTH( dateCommunication ) = "'.$timing.'"';
	 		$req = $this->getExecution($req);
		return $req;
		}

	/*
	* Renvoie le nombre de communication pour le mois passé en paramêtre
	*/
	 public function getCountNb($timing){
			$req='SELECT COUNT(idCommunication) AS nombreTotal FROM communications WHERE MONTH( dateCommunication )="'.$timing.'"';
			$req = $this->getExecution($req);
		return $req;
		}

	/*
	* Vérifie le mois saisit dans le formulaire, et adapte le trimestre précédent en conséquence
	*/		
	public function setTrim($mois){
		if($mois > 3){
			$trimestre[0] = $mois - 3;
			$trimestre[1] = $mois - 2;
			$trimestre[2] = $mois - 1;
		}else if($mois <= 3){
			if($mois == 1){
			$trimestre[0] = 10;
			$trimestre[1] = 11;
			$trimestre[2] = 12;
		   	}else if($mois == 2){
		   	$mois 		  = 02;
			$trimestre[0] = 11;
			$trimestre[1] = 12;
			$trimestre[2] = 1;
			}else if($mois == 3){
			$trimestre[0] = 12;
			$trimestre[1] = 1;
			$trimestre[2] = 2;
			}
		}

		return array($mois, $trimestre);
	}

}