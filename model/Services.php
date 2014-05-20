<?php
class Services extends Model{

	public function getAll(){
		$req = 'SELECT * FROM services ORDER BY idService';
		$req = $this->getExecution($req);
	return $req;
	}

	public function getName(){
		$req = 'SELECT * FROM services ORDER By nomService';
		$req = $this->getExecution($req);
	return $req;
	}

	public function Update($ID, $Nom, $Site, $Attache){
		$req = 'UPDATE services SET nomService="'.$Nom.'", siteService="'.$Site.'", attacheService='.$Attache.' WHERE idService='.$ID;
		$req = $this->getExecution($req,'update');
	}

	public function getByID($id){
		$req = 'SELECT * FROM services WHERE idService='.$id;
		$req = $this->getExecution($req);
	return $req;
	}
	
	public function SupprByID($id){
		$req = 'DELETE FROM services WHERE idService='.$id;
		$req = $this->getExecution($req, 'delete');
	}

	public function newService($nom, $site, $attache){
		$req = 'INSERT INTO services (nomService, siteService, attacheService) VALUES ("'.$nom.'","'.$site.'",'.$attache.')';
		$req = $this->getExecution($req,'insert');
	}
}