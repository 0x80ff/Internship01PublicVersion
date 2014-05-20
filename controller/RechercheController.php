<?php
class RechercheController extends Controller{

		public $communication = null;
        public $servicesC = null;
        public $typesC = null;
        public $etendueC = null;

        public $coutTT = null;
        public $dureeTT = null;
        public $nombreTT = null;
        public $typeTT = null;

		function Chargement(){

		if (isset($_POST['dMin'])){
                $dMin = htmlentities($_POST['dMin'], ENT_QUOTES, 'UTF-8');
            }
        if (isset($_POST['dMax'])){
                $dMax = htmlentities($_POST['dMax'], ENT_QUOTES, 'UTF-8');
            }
        if (isset($_POST['nom'])){
                $nom = htmlentities($_POST['nom']);
            }
        if (isset($_POST['service'])){
                $service = htmlentities($_POST['service']);
            }
        if (isset($_POST['type'])){
                $type = htmlentities($_POST['type']);
            }
        if (isset($_POST['etendue'])){
                $etendue = htmlentities($_POST['etendue']);
            }
        if(isset($_POST['service'])){
            $modeService = $_POST['service'];

            $service = "";

            if($modeService == 'parService')
            {
                $service = $_POST['ByService'];
            }
            if($modeService == 'parDirection')
            {
                $service = $_POST['ByDirection'];
            }
        }
        if(isset($_POST['FormatDate'])) {
            $Format = $_POST['FormatDate'];
            $date="";

            if($Format == "Mois"){
                $date = $_POST['Mois'];
            }
            if($Format == "Trimestre"){
                $date = $_POST['NumeroTrimestre'];
            }
            if($Format == "DateDate"){
                $date = array($_POST['date1'],$_POST['date2']);
            }

        }
    
        if (isset($_POST['numero'])){
                $numero = htmlentities($_POST['numero']);
            }
        if (isset($_POST['mMin'])){
                $mMin = htmlentities($_POST['mMin']);
            }
        if (isset($_POST['mMax'])){
                $mMax = htmlentities($_POST['mMax']);
            }
       
            $this->Recherche($dMin,$dMax,$nom,$service,$type,$etendue,$date,$numero,$mMin,$mMax,$Format,$modeService);
           
       }


    function Preparation(){
        $this->loadModel('Communication');
        $this->servicesC = $this->Communication->getServices();
        $this->servicesCbyDir = $this->Communication->getServicesByDir();
        $this->typesC = $this->Communication->getTypesCalls();
        $this->etendueC = $this->Communication->getAreaCalls();
        $this->set($this->servicesC);
        $this->set($this->servicesCbyDir);
        $this->set($this->typesC);
        $this->set($this->etendueC);

        $this->render('communicationsFormulaire');
    }

	function Recherche($dMin,$dMax,$nom,$service,$type,$etendue,$date,$numero,$mMin,$mMax,$Format,$modeService){
		 $this->loadModel('Communication');
		 $this->communication = $this->Communication->getResults($dMin,$dMax,$nom,$service,$type,$etendue,$date,$numero,$mMin,$mMax,$Format,$modeService);
         if(!empty($type)){
         $this->typeTT = $type;
         $this->coutTT = $this->Communication->getCostCalls($type);
         $this->dureeTT = $this->Communication->getDurationCalls($type);
         $this->nombreTT = $this->Communication->getNbCalls($type);
         }
		 if(empty($this->communication)){
		 	$this->e404('Aucun élément trouvé pour cette recherche', 'warning');
		 }
		 $this->set($this->communication);
         $this->set($this->coutTT);
         $this->set($this->dureeTT);
         $this->set($this->nombreTT);

		 $this->render('resultatsCommunication');

	}

    /*
    * Fonction de conversion de secondes en Mois, Jours, Heures, Minutes, Secondes
    */
    function HMS($ss){
        $s = $ss%60;
        $m = floor(($ss%3600)/60);
        $h = floor(($ss%86400)/3600);
        $d = floor(($ss%2592000)/86400);
        $M = floor($ss/2592000);

    return $M."M:".$d."J:".$h."h:".$m."m:".$s."s";
    }

}