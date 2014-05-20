<?php 
class PagesController extends Controller{
	function view($id){
		 $this->loadModel('Communication');
		 $communication = $this->Communication->findFirst(array(
		 					'conditions' => array('idCommunication' => $id)
		 					));
		 if(empty($communication)){
		 	$this->e404('Page introuvable');
		 }
		 $this->set('communication', $communication);
	}

	function index(){
		$this->render('index');
	}
}
