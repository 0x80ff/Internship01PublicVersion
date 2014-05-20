<?php 
/**
* Controller
**/
class Controller{
	
	public $request;  				// Objet Request 
	private $vars     = array();	// Variables à passer à la vue
	public $layout    = 'default';  // Layout à utiliser pour rendre la vue
	private $rendered = false;		// Si le rendu a été fait ou pas ?
	public $logged = null;
	public $login = null;

	/**
	* Constructeur
	* @param $request Objet request de l'application
	**/
	function __construct($request=null){
		if($request){
		$this->request = $request; 	// On stock la request dans l'instance
		}
	}

	public function isLogged(){
		if(isset($this->login)){
			$this->logged = true;
		}
		return $this->logged;
	}

	

	/**
	* Permet de rendre une vue
	* @param $view Fichier à rendre (chemin depuis view ou nom de la vue) 
	**/
	public function render($view){
		if($this->rendered){ return false; }
		extract($this->vars); 
		if(strpos($view,'/')===0){
			$view = ROOT.DS.'view'.$view.'.php';
		}else{
			$view = ROOT.DS.'view'.DS.$this->request->controller.DS.$view.'.php';
		}
		ob_start(); 
		require($view);
		$content_for_layout = ob_get_clean();  
		require ROOT.DS.'view'.DS.'layout'.DS.$this->layout.'.php'; 
		$this->rendered = true; 
	}


	/**
	* Permet de passer une ou plusieurs variable à la vue
	* @param $key nom de la variable OU tableau de variables
	* @param $value Valeur de la variable
	**/
	public function set($key,$value=null){
		if(is_array($key)){
			$this->vars += $key; 
		}else{
			$this->vars[$key] = $value; 
		}
	}

	/**
	* Permet e charger un model
	**/
	function loadModel($name){
		$file = ROOT.DS.'model'.DS.$name.'.php';
		require_once($file);
		if(!isset($this->$name)){
			$this->$name = new $name();
		}
		
	}

	/**
	* Premet d'appeller un controlleur depuis une vue
	*/
	function request($controller, $action){
		$controller = 'Controller';
		require_once ROOT.DS.'controller'.DS.$controller.'.php';
		$c = new $controller();
		return $c->$action;
	}

	/**
	* Permet de gérer les erreurs 404
	*/
	function e404($message, $type = null){
		header("HTTP/1.0 404 Not Found");
		if(isset($type)){
			$message = '<div class="alert alert-'.$type.'">
    				<a class="close" data-dismiss="alert">×</a>
    				<strong>Erreur!</strong> '.$message.'</div>';
    			}
		$this->set('message',$message); 
		$this->render('/errors/404');
		die();
	}

	/**
	* Permet de gérer les messages de génération
	*/
	function setMessage($message, $titre, $type){
		$message = '<div class="alert alert-'.$type.'">
	    			<button type="button" class="close" data-dismiss="alert">&times;</button>
	    			<h4>'.$titre.'</h4>
	    			'.$message.'</div>';
	return $message;
	}


}
?>