<?php
class StatistiquesController extends Controller{
	
	public $statistiquesCout = null;
	public $statistiquesNb = null;
	public $contenu = null;

	function view($id){
		 $this->loadModel('Statistiques');
		 $statistiques = $this->Statistiques->findFirst(array(
		 					'conditions' => array('idAbonne' => $id)
		 					));
		 if(empty($statistiques)){
		 	$this->e404('Page introuvable');
		 }
		 $this->set('statistiques', $statistiques);
	}

	function index(){
		$this->render('index');
	}

	function Chargement(){
		if (isset($_POST['mois'])){
            $mois = htmlentities($_POST['mois']);
        }
        $this->Affichage($mois);
	}

	function Affichage($mois){
		$this->LoadModel('Statistiques');
		$this->statistiquesCout = $this->Statistiques->getCout($mois);
		$this->statistiquesNb = $this->Statistiques->getNb($mois);
		$this->contenu = $this->Statistiques->AppelDepassement($mois);
		$this->set('contenu', $this->contenu);
		if(empty($this->statistiquesCout)){
		$this->e404('Page introuvable');
		 }

		 $this->render('resultatsStatistiques');
	}

	function Preparation(){
		$this->render('formulaireStatistiques');
	}
}

?>