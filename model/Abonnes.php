<?php
class Abonnes extends Model{
	
	public function getAbonnesByID($id){
		$req = 'SELECT COUNT( idCommunication ) AS nombre, nomAbonne, numAbonne, nomService FROM abonnes, services, communications
		WHERE services.idService = abonnes.service_id 
		AND communications.abonne_id = abonnes.idAbonne 
		AND idAbonne ='.$id;

		$req = $this->getExecution($req);
	return $req;
	}

	public function Update($ID, $Nom, $Num, $IDService){
		$req = 'UPDATE abonnes SET nomAbonne="'.$Nom.'", numAbonne='.$Num.', service_id='.$IDService.' WHERE idAbonne='.$ID;
		$req = $this->getExecution($req,'update');
	}
	public function getByID($id){
		$req = 'SELECT * FROM abonnes WHERE idAbonne='.$id;
		$req = $this->getExecution($req);
	return $req;
	}

	public function getAll(){
		$req = 'SELECT * FROM abonnes ORDER BY nomAbonne';
		$req = $this->getExecution($req);
	return $req;
	}

	public function SupprByID($id){
		$req = 'DELETE FROM abonnes WHERE idAbonne='.$id;
		$req = $this->getExecution($req, 'delete');
	}

	public function newAbonne($nom, $numero, $service){
		$req = 'INSERT INTO abonnes (nomAbonne, numAbonne, service_id) VALUES ("'.$nom.'",'.$numero.','.$service.')';
		$req = $this->getExecution($req, 'insert');
	}
}