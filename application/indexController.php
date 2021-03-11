<?php
    require_once 'MyHeartController.php';
    
    /**
     * Controller d'index par defaut. Il hérite de la classe MyHeartController 
     * C'est le coeur de notre site parce qu'il écoute toutes actions de click 
     * utilisateur & les charge les pages & traitements associés
     * @author mbele
     * @version 1.0
     * @license libre
     * @copyright 2012 
     */
    class indexController extends MyHeartController {
        /**
         * Attribut d'interface avec la base de données
         * @access private
         * @var type 
         */
        private $_db;
        
        /**
         * Contructeur du controlleur 
         */
        public function __construct() {
            parent::__construct();
        }
        
        /**
         * Méthode qui initialise le projet 
         * @access public
         */
        public function initProject(){
            //on construit le tableau de repertoire de notre projet
            $this->setFolders(array('application/', 'application/annuaire/', 'application/lib.in-put/','application/lib.out-put/','application/intervention/', 'application/vues/', 'application/parc_info/ordinateur/','application/parc_info/imprimante/'));
            
            //On definit l'action par défaut
            $this->setDefautAction('annuair.php');
            
        }
    }
?>
