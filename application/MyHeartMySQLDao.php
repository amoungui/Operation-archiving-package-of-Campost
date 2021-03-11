<?php
require_once 'iMyHeartMySQLDao.php';
require_once 'MyHeartException.php';
/**
 * SuperClasse d'Accès aux Données(DAO) pour MySQL.
 * Elle implémente l'interface iMyHeartMySQLDao
  */

abstract class MyHeartMySQLDao implements iMyHeartMySQLDao {
    /**
     * Hôte de connexion à une Base de données MySQL
     * Il est 127.0.0.1 par defaut
     * @access      private
     * @var         type
     */
    private $hostname;
    
    /**
     * Utilisateur de la base de données. Il est root par defaut
     * @access      private
     * @var         type
     */
    private $user;
    
    /**
     * Mot de Passe utilisateur. Il est nul par defaut
     * @access      private
     * @var         type 
     */
    private $password;
    
    /**
     * Nom de la Base de données. Elle est mysql par defaut
     * @access      private
     * @var         type 
     */
    private $database;

    /**
     * Attribut definissant le d'une table
     * @access      private
     * @var         type 
     */
    private $tablename = '';
    
    /**
     * Attribut définissant un moteur de table MySQL
     * @access      private
     * @var         type 
     */
    private $tableEngine = '';
    
    private $exception;
    
    public function getException(){
        return $this->exception;
    }

    /**
     * Constructeur de la superclasse DAO_MySQL
     * @access public
     * @param type $user utilisateur
     * @param type $hostname hôte
     * @param type $password mot de passe 
     * @param type $database base de données
     */
    public function __construct($user='', $hostname='', $password='', $database='') {
        $this->exception = new MyHeartException();
        if (isset($user) || isset($hostname) || isset($password) || isset($database)){
            $this->user = $user;
            $this->hostname = $hostname;
            $this->password = $password;
            $this->database = $database;
        } 
        
        if (empty($user) && empty($hostname) && empty($password) && empty($database)) {
            $this->user  = 'root';
            $this->hostname = '127.0.0.1';
            $this->password  = '';
            $this->database  = 'mysql';
        }   
    }    
    
    
    public function getHostname() {
        return $this->hostname;
    }

    public function setHostname($hostname) {
        $this->hostname = $hostname;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getDatabase() {
        return $this->database;
    }

    public function setDatabase($database) {
        $this->database = $database;
    }

    public function getTablename() {
        return $this->tablename;
    }

    public function setTablename($tablename) {
        $this->tablename = $tablename;
    }

    public function getTableEngine() {
        return $this->tableEngine;
    }

    public function setTableEngine($tableEngine) {
        $this->tableEngine = $tableEngine;
    }

}

?>
