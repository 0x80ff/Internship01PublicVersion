<?php
class SessionController extends Controller{

	public $uploadfile = null;
	public $message = null;
	public $uploadContent = null;
	public $contenuAbonnes = null;
	public $contenuContent = null;
	public $contenuServices = null;

	public function Connection(){
		if(isset($_POST['login'])){
			// Création d'un tableau des erreurs
			$erreurs_connexion = array();

			// Validation des champs suivant les règles
		    $login = $_POST['login'];
		    $pass =  $_POST['pass'];

		    // On veut utiliser le modèle 
		    $this->loadModel('Session');
	     
		    // Si les identifiants sont valides
		    if ($this->Session->verifPass($login, $pass)){
		        // On enregistre les informations dans la session
		        $_SESSION['login'] = $login;
		   		$this->log = true;
		        // Affichage de la confirmation de la connexion
		        $this->render('index');
		    }else{
		        $erreurs_connexion[] = "Couple nom d'utilisateur / mot de passe inexistant.";
		         
		        // On réaffiche le formulaire de connexion
		        $this->render('loginForm');
    		}
     
 		}else{
		    // On réaffiche le formulaire de connexion
		    $this->render('loginForm');
		}
	}

    public function Connect(){
    	$this->render('loginForm');
    }

    public function Index(){
    	if(empty($_SESSION['login'])){
    		$this->e404('Vous n\'êtes pas connecté.','error');	
    	}else{
    		$this->render('index');
    	}
    }

    public function Disconnected(){
    	Controller::$this->logged = false;
    	Controller::$this->login = null;
    	unset($_SESSION['login']);
    	$this->render('loginForm');
    }

    public function Upload(){
    	$this->render('uploadForm');
    }

    public function Uploaded(){
    	$this->loadModel('Uploads');
    	$uploaddir = ROOT.DS.'webroot'.DS.'content'.DS;
		$this->uploadfile = $uploaddir.$_FILES['nomfichier']['name'];
		$this->set($this->uploadfile);


		if($this->Uploads->ifExist($_FILES['nomfichier']['name']))
		{
			if(move_uploaded_file($_FILES['nomfichier']['tmp_name'], $this->uploadfile))
			{
				$uploaded = $this->Uploads->insertContent($_FILES['nomfichier']['name'],$this->uploadfile, '0');
				$this->message = $this->setMessage('Le fichier est valide et a été téléchargé.', 'Succès!', 'success');
			}
			else
			{ 
				$this->message = $this->setMessage('Le fichier n\'a pas été téléchargé correctement.', 'Erreur!', 'error');
			}
		}
		elseif(($this->Uploads->ifExist($_FILES['nomfichier']['name'])) == false)
		{
			$this->message = $this->setMessage('Le fichier existe déjà.', 'Attention!','warning');
		}
		
		unset($_FILES['nomfichier']);
		
		$this->set('message', $this->message);	
		$this->render('controlUploads');
    }

    public function ResUpload(){
    	$this->loadModel('Uploads');
    	$this->uploadContent = $this->Uploads->getUploads();
    	$directory = BASE_URI.'/content'.'/';
    	$this->set('directory', $directory);
    	$this->set('content', $this->uploadContent);
    	$this->render('resultatsUploads');
    }


	public function Charger(){
		if(isset($_POST['idContent'])){
			$id = $_POST['idContent'];
		}
		$this->loadModel('Contenu');
		$this->Contenu->InsertBDD($id);
		$this->message = $this->setMessage('L\'insertion des données est réussie','Succès', 'success');
		$this->set('message', $this->message);
		$this->ResUpload();
	}

	public function Supprimer(){
		if(isset($_POST['idContent'])){
			$id = $_POST['idContent'];
		}
		$this->loadModel('Contenu');
		$this->Contenu->DeleteContent($id);
		$this->message = $this->setMessage('Le fichier à bien été supprimé', 'Succès', 'success');
		$this->set('message', $this->message);
		$this->ResUpload();
	}

	public function Edit(){
		$this->render('edition');
	}

	public function SaveEdit(){
		if(isset($_POST['Type'])){
			$Table = $_POST['Type'];

			if($Table == "Abonne"){
				if(isset($_POST['ID'])){
					$ID = $_POST['ID'];
					$Nom = $_POST['Nom'];
					$Num = $_POST['Num'];
					$IDService = $_POST['IDService'];
					$this->loadModel('Abonnes');
					$this->Abonnes->Update($ID, $Nom, $Num, $IDService);
					$this->message = $this->setMessage('La modification a été effectuée avec succès!', 'Succès!', 'success');
					$this->set('message', $this->message);
					$this->contenuAbonnes = $this->Abonnes->getAll();
					$this->set('contenu', $this->contenuAbonnes);
					$this->render('EditAbonnes');
				}else{
					$this->message = $this->setMessage('La modification n\'a pas été prise en compte.', 'Echec!', 'error');
					$this->set('message', $this->message);
					$this->contenuAbonnes = $this->Abonnes->getAll();
					$this->set('contenu', $this->contenuAbonnes);
					$this->render('EditAbonnes');
				}
			}
			elseif($Table == "Contenu"){
				if(isset($_POST['ID'])){
					$ID = $_POST['ID'];
					$Nom = $_POST['Nom'];
					$Path = $_POST['Path'];
					$Online = $_POST['Online'];
					$this->loadModel('Contenu');
					$this->Contenu->Update($ID, $Nom, $Path, $Online);
					$this->message = $this->setMessage('La modification a été effectuée avec succès!', 'Succès!', 'success');
					$this->set('message', $this->message);
					$this->contenuContent = $this->Contenu->getAll();
					$this->set('contenu', $this->contenuContent);
					$this->render('EditContent');
				}else{
					$this->message = $this->setMessage('La modification n\'a pas été prise en compte.', 'Echec!', 'error');
					$this->set('message', $this->message);
					$this->contenuContent = $this->Contenu->getAll();
					$this->set('contenu', $this->contenuContent);
					$this->render('EditContent');
				}
			}
			elseif($Table == "Service"){
				if(isset($_POST['ID'])){
					$ID = $_POST['ID'];
					$Nom = $_POST['Nom'];
					$Site = $_POST['Site'];
					$Attache = $_POST['Attache'];
					$this->loadModel('Services');
					$this->Services->Update($ID, $Nom, $Site, $Attache);
					$this->message = $this->setMessage('La modification a été effectuée avec succès!', 'Succès!', 'success');
					$this->set('message', $this->message);
					$this->contenuServices = $this->Services->getAll();
					$this->set('contenu', $this->contenuServices);
					$this->render('EditServices');
				}else{
					$this->message = $this->setMessage('La modification n\'a pas été prise en compte.', 'Echec!', 'error');
					$this->set('message', $this->message);
					$this->contenuServices = $this->Services->getAll();
					$this->set('contenu', $this->contenuServices);
					$this->render('EditServices');
				}
			}
		}else{
			$this->e404('Aucune donnée reçue pour le traitement');
		}
		$this->e404('Erreur lors de la réception du formulaire');
	}


	public function Editing(){
		if(isset($_POST['Nom'])){
			$Table = $_POST['Nom'];

		if($Table == "Abonne"){
			if(isset($_POST['ID'])){
				$id = $_POST['ID'];
				$this->loadModel('Abonnes');
				$this->contenuAbonnes = $this->Abonnes->getByID($id);
				$this->set('contenu', $this->contenuAbonnes);
				$this->render('pageEditFinalAbonnes');
				}
			}
			elseif($Table == "Contenu"){
				if(isset($_POST['ID'])){
					$id = $_POST['ID'];
					$this->loadModel('Contenu');
					$this->contenuContent = $this->Contenu->getByID($id);
					$this->set('contenu', $this->contenuContent);
					$this->render('pageEditFinalContenu');
				}
			}
			else{
				if(isset($_POST['ID'])){
					$id = $_POST['ID'];
					$this->loadModel('Services');
					$this->contenuServices = $this->Services->getByID($id);
					$this->set('contenu', $this->contenuServices);
					$this->render('pageEditFinalServices');
				}
			}
		}
		else{
			$this->e404('Echec de la réception des données');
		}
		$this->e404('Aucune donnée reçue pour le traitement');
	}


	public function Edition(){
		if(isset($_POST['Edit'])){
			$type = $_POST['Edit'];

			if($type == "Abonne"){
				$this->loadModel('Abonnes');
				$this->contenuAbonnes = $this->Abonnes->getAll();
				$this->set('contenu', $this->contenuAbonnes);
				$this->render('EditAbonnes');
			}
			elseif($type == "Contenu"){
				$this->loadModel('Contenu');
				$this->contenuContent = $this->Contenu->getAll();
				$this->set('contenu', $this->contenuContent);
				$this->render('EditContent');
			}
			else{
				$this->loadModel('Services');
				$this->contenuServices = $this->Services->getAll();
				$this->set('contenu', $this->contenuServices);
				$this->render('EditServices');
			}
		}else{
			$this->e404('Aucune donnée reçue pour le traitement');
		}
	}

	public function Delete(){
		$this->render('suppression');
	}

	public function Added(){
		if(isset($_POST['Type'])){
			$type = $_POST['Type'];

			if($type == "Service"){
				$Nom = $_POST['Nom'];
				$Site = $_POST['Site'];
				$Attache = $_POST['Attache'];

				$this->loadModel('Services');
				$this->Services->newService($Nom, $Site, $Attache);
				$this->message = $this->setMessage('Création du service réussie!', 'Succès!', 'success');
				$this->contenuServices = $this->Services->getName();
				$this->set('Service', $this->contenuServices);
				$this->set('message', $this->message);
				$this->render('addService');
			}
			elseif($type == "Abonne"){
				$NomA = $_POST['Nom'];
				$Numero = $_POST['Numero'];
				$ServiceA = $_POST['Service'];

				$this->loadModel('Abonnes');
				$this->loadModel('Services');
				$this->Abonnes->newAbonne($NomA, $Numero, $ServiceA);
				$this->message = $this->setMessage('Création de l\'abonné réussie!', 'Succès!', 'success');
				$this->contenuServices = $this->Services->getName();
				$this->set('Service', $this->contenuServices);
				$this->set('message', $this->message);
				$this->render('addService');
			}
		}else{
				$this->e404('Aucune donnée reçue');
			}
	}
	

	public function Add(){
		if(isset($_POST['Add'])){
			$Table = $_POST['Add'];

			if($Table == "Abonne"){
				$this->loadModel('Services');
				$this->contenuServices = $this->Services->getName();
				$this->set('Service', $this->contenuServices);
				$this->render('addAbonne');
			}
			else{
				$this->loadModel('Services');
				$this->contenuServices = $this->Services->getName();
				$this->set('Service', $this->contenuServices);
				$this->render('addService');
			}
		}
		else{
			$this->e404('Aucune donnée reçue pour le traitement');
		}
	}

	public function Suppression(){
		if(isset($_POST['Voir'])){
			$Table = $_POST['Voir'];

			if($Table == "Abonne"){
				$this->loadModel('Abonnes');
				$this->contenuAbonnes = $this->Abonnes->getAll();
				$this->set('contenu', $this->contenuAbonnes);
				$this->render('pageSuppressionAbonnes');

			}
			elseif($Table == "Contenu"){
				$this->loadModel('Contenu');
				$this->contenuContent = $this->Contenu->getAll();
				$this->set('contenu', $this->contenuContent);
				$this->render('pageSuppressionContenu');
			}
			else{
				$this->loadModel('Services');
				$this->contenuServices = $this->Services->getAll();
				$this->set('contenu', $this->contenuServices);
				$this->render('pageSuppressionServices');
			}
		}
		else{
			$this->e404('Aucune donnée reçue pour le traitement');
		}
	}

	public function Deleting(){
		if(isset($_POST['Nom'])){
			$Table = $_POST['Nom'];

			if($Table == "Abonne"){
				if(isset($_POST['ID'])){
					$id = $_POST['ID'];
					$this->loadModel('Abonnes');
					$this->Abonnes->SupprByID($id);
					$this->message = $this->setMessage('La suppression de l\'abonné a été effectuée avec succès!', 'Succès!', 'success');
					$this->contenuAbonnes = $this->Abonnes->getAll();
					$this->set('contenu', $this->contenuAbonnes);
					$this->set('message', $this->message);
					$this->render('pageSuppressionAbonnes');
				}
				else{
					$this->message = $this->setMessage('La suppression de l\'abonné a échouer', 'Echec!', 'error');
					$this->set('message', $this->message);
					$this->contenuAbonnes = $this->Abonnes->getAll();
					$this->set('contenu', $this->contenuAbonnes);
					$this->render('pageSuppressionServices');
				}
			}
			elseif($Table == "Contenu"){
				if(isset($_POST['ID'])){
					$id = $_POST['ID'];
					$this->loadModel('Contenu');
					$this->Contenu->SupprByID($id);
					$this->message = $this->setMessage('La suppression du contenu a été effectuée avec succès!', 'Succès!', 'success');
					$this->contenuContent = $this->Contenu->getAll();
					$this->set('contenu', $this->contenuContent);
					$this->set('message', $this->message);
					$this->render('pageSuppressionContenu');
				}
				else{
					$this->message = $this->setMessage('La suppression du contenu a échouer', 'Echec!', 'error');
					$this->set('message', $this->message);
					$this->contenuContent = $this->Contenu->getAll();
					$this->set('contenu', $this->contenuContent);
					$this->render('pageSuppressionContenu');
				}
			}
			else{
				if(isset($_POST['ID'])){
					$id = $_POST['ID'];
					$this->loadModel('Services');
					$this->Services->SupprByID($id);
					$this->message = $this->setMessage('La suppression du service a été effectuée avec succès!', 'Succès!', 'success');
					$this->contenuServices = $this->Services->getAll();
					$this->set('contenu', $this->contenuServices);
					$this->set('message', $this->message);
					$this->render('pageSuppressionServices');
				}
				else{
					$this->message = $this->setMessage('La suppression du service a échouer', 'Echec!', 'error');
					$this->set('message', $this->message);
					$this->contenuServices = $this->Services->getAll();
					$this->set('contenu', $this->contenuServices);
					$this->render('pageSuppressionServices');
				}
			}
		}
		else{
			$this->e404('Echec de la réception du formulaire');
		}
		$this->e404('Aucune donnée reçue pour le traitement');
	}











}