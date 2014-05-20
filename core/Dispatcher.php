<?php
/**
* Dispatcher
* Permet de charger le controller en fonction de la requête utilisateur
**/
class Dispatcher{
	
	var $request;	// Object Request

	/**
	* Fonction principale du dispatcher
	* Charge le controller en fonction du routing
	**/
	function __construct(){
		$this->request = new Request(); 
		Router::parse($this->request->url,$this->request); 
		$controller = $this->loadController();

		if(!in_array($this->request->action , array_diff(get_class_methods($controller),get_class_methods('Controller'))))
		{
			$this->error('Le controller '.$this->request->controller.' n\'a pas de méthode '.$this->request->action); 
		}
		else
		{
		call_user_func_array(array($controller,$this->request->action),$this->request->params); 
		$controller->render($this->request->action);
		}
		}
	

	/**
	* Permet de générer une page d'erreur en cas de problème au niveau du routing (page inexistante)
	**/
	function error($message){
		$controller = new Controller($this->request); 
		$controller->e404($message);
		die(); 
	}

	/**
	* Permet de charger le controller en fonction de la requête utilisateur
	**/
	function loadController(){
        $name = ucfirst($this->request->controller).'Controller';// $name=PagesController
        if(!file_exists(ROOT.DS.'controller'.DS.$this->request->controller.'Controller.php'))
        {
        	$name = 'PagesController';
        	$this->request->controller = 'Pages';
        }
            $file = ROOT.DS.'controller'.DS.$name.'.php';// 
        require $file;
        return new $name($this->request);
    }

}