<?php
    require_once 'MyHeartException.php';
    
    /**
     * C'est une super classe controller par defaut du framework MyHeart.
     * Elle récupère les actions faites par un utilisateur et recherche
     * le fichier par defaut qui doit s'exécuter dans un tableau.
     * ensuite fait un include de ce fichier dans notre page web.
     *  
     * @author:         mbele
     * @category:       MyHeartException
     * @version:        1.0
     * @access          public
     * @license         Libre
     */
    class MyHeartController {
        /**
         * Tableau des différents repertoires des vues du projet
         * @access  private
         * @var     type        array
         */
        private $folders = array();
        
        /**
         * nom du ficher passé par la méthode GET
         * @access  private
         * @var     type        string
         */
        private $action;
        
        /**
         * Nom du fichier chargé par defaut dans le controller
         * @access  private
         * @var     type        string
         */
        private $defautAction;
        
        /**
         * variable temporaire de stockage
         * @var type 
         */
        private $temp = '';
        /**
         * Interface avec la classe MyHeartException
         * @access  private
         * @var     type        object
         */
        private $exception;
        
        /**
         * Constructeur de la classe MyHeartController 
         */
        public function __construct() {
            $this->exception = new MyHeartException();
        }
        
        /**
         * Getter du tableau des dossiers contenant les vues
         * @access  public
         * @return  type    array
         */
        public function getFolders () {
            return $this->folders;
        }
        
        /**
         * Getter de l'action sur la page
         * @access  public
         * @return  type    string
         */
        public function getAction () {
            return $this->action;
        }
        
        /**
         * Interface avec a classe MyHeartException
         * @access  public
         * @return  type    object
         */
        public function getException() {
            return $this->exception;
        }
        
        /**
         * Getter de l'actionpar defaut à effectuée si aucune action
         * @access  public
         * @return  type    string
         */
        public function getDefaultAction() {
            return $this->defautAction;
        }
        
        /**
         * Setter du tableau des divers dossiers du projet
         * @access public
         * @param type $folder tableau des différents dossiers de l'application
         */
        public function setFolders ($folder) {
            $this->folders = $folder;
        }
        
        /**
         * Setter de l'action faite par un utilisateur
         * @access public
         * @param type $action action faite par l'utilisateur
         */
        public function setAction ($action) {
            $this->action = $action;
        }
        
        /**
         * Setter de l'action par defaut lors du premier chargement
         * @access  public
         * @param type $action  action par defaut
         */
        public function setDefautAction($action){
            $this->defautAction = $action;
        }
        
        /**
         * Méthode qui construit une boîte de dialogue d'erreur
         * @access  public
         * @return type     boîte de dialogue
         */
        public function dialogBox(){
            $this->getException()->setIcon('alert');
            $this->getException()->setTitle('Boîte de dialogue erreur');
            $this->getException()->setMessage('<b>Erreur 404 :</b> Fichier inexistant, Vérifier que les chemins sont biens spécifiés dans la fonction :<b style="color:#f6931f;">initController() de la classe MyHeartController !</b> !');
            
            return $this->getException()->getMessageCode();
        }
        
        /**
         * Methode qui initialise un controller et retourne une action est capturée par la méthode GET
         * sinon retourne l'action par defaut
         * @access      public
         * @return      string          retourne une action sur la page
         * @throws      Exception 
         */
        public function renderAction(){
            try {
                if (isset($_GET['action'])) {
                    $this->action = $_GET['action'];
                    
                    foreach ($this->folders as $folder) {
                        //On vérifie si le fichier existe sur disque(peut etre coûteux si trop de fichier sur disque)
                        if(file_exists($folder . $this->action)) {
                            $this->temp =  $folder . $this->action;
                        } 
                    }
                    if(empty($this->temp)){
                        throw new Exception($this->dialogBox());
                    } else {
                        include $this->temp;
                    }
                } else {    //Sinon on charge l'action par défaut
                    foreach ($this->folders as $folder) {
                        if(file_exists($folder . $this->defautAction)){
                            $this->temp = $folder . $this->defautAction;
                        }
                    }
                    if(empty($this->temp)){
                        throw new Exception($this->dialogBox());
                    } else {
                        include $this->temp;
                    }
                }     
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
    }
?>
