<?php
class InfoController extends Controller{

	public $infos;

	public function Abonnes(){
		if (isset($_POST['idAbo'])){
                $id = $_POST['idAbo'];
            }

		$this->loadModel('Abonnes');
		$this->infos = $this->Abonnes->getAbonnesByID($id);
		$this->set('infos', $this->infos);
		$this->render('infoAbo');
	}
}