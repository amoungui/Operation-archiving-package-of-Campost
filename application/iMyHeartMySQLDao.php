<?php

/**
 * Interface d'Accès aux Données(DAO) pour MySQL
 * 
 
 */
interface iMyHeartMySQLDao {
    public function getHostname();
    public function getUser();
    public function getPassword();
    public function getDatabase();
    public function getTableName();
    public function getTableEngine();
    public function setHostname($hostname);
    public function setUser($user);
    public function setPassword($password);
    public function setDatabase($database);
    public function setTableName($tablename);
    public function setTableEngine($tableEngine);
}

?>
