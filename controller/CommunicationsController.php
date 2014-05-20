<?php //CE CONTROLEUR NE SERT QUE POUR LES TESTS
class CommunicationsController extends Controller{

	function resultats(){
		$this->render('resultats');
	}
	function communications(){
		$this->render('communications');
	}
	function input(){
		$this->render('input');
	}
	function inputto(){
		$this->render('inputto');
	}

	

}