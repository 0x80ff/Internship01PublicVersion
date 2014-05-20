<?php
class Uploads extends Model{

	function insertContent($nom, $path, $online){
		$path = addcslashes ( $path , '\\' );

		$req = 'INSERT INTO content (nomContent, pathContent, online) VALUES ("'.$nom.'", "'.$path.'", "'.$online.'")';
		$req = $this->getExecution($req, 'insert');
	return $req;
	}

	function getUploads(){
		$req = 'SELECT idContent, nomContent, online FROM content';
		$req = $this->getExecution($req);
	return $req;
	}
	
	function getOnline($id){
		$req = 'SELECT online FROM content WHERE idContent='.$id;
		$req = $this->getExecution($req);
	return $req;
	}

	function ifExist($nom){
		$req = 'SELECT COUNT(idContent) as total FROM content WHERE nomContent="'.$nom.'"';
		$req = $this->getExecution($req);
		
		foreach($req as $key => $value)
		{
			$total = $value['total'];
		}
		if($total != 0){
			$req =  false;
		}elseif($total == 0){
			$req =  true;
		}
	return $req;
	}

}