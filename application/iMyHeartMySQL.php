<?php

/**
 * Interface MySQL 
 * 
 * @author      mbele
 * @version     1.0
 */
interface iMyHeartMySQL {
    /**
     * Getter de l'objet de connexion
     * @access      public
     * @return      OID_de_la_connection
     */
    public function getConnect ();
    
    /**
     * Getter du contenu d'une table MySQL
     * @access      public
     * @return      string    Le contenu d'une table 
     */
    public function getTableContent ();
    
    /**
     * Getter du resultset d'une requête 
     * @access      public
     * @return      array       Le resultset d'une requête  
     */
    public function getQuery ();
    
    /**
     * Méthode qui retourne un tableau de valeur
     * rafraichi par query()
     * @access      public
     * @return      string         
     */
    public function getRow ();
    /**
     * Méthode qui ouvre une connexion avec une base de données MySQL
     * @access      public          connect
     * @category    MyHeartMySQL
     * @return      string          retourne un message d'erreur connexion 101 ou 102
     */
    public function connect ();
    
    /**
     * Méthode qui ferme une connexion avec une base de données MySQL
     * @access      public          disconnect
     * @category    MyHeartMySQL
     */
    public function disconnect ();
    
    /**
     * Méthode qui exécute une requête SQL
     * @access  public  query
     * @param   type    $sql    La requête à exécuter
     * @return  string  $query  taleau contenant le resultSet & la l'id max de la tableau
     */
    public function query ($sql);
    
    /**
     * Méthode qui génère un script d'insertion de données dans une table MySQL
     * @access  public  insert       
     * @param   type    $cols       Tableau simple de colonnes
     * @param   type    $table      Nom de la table 
     * @param   type    $rows       Tableau simple des champs à insérer
     * @return  string  $sql        Requête de modification'insertion d'une table
     */
    public function insertValues ($cols, $rows);
    
    /**
     * Méthode génère un script de mise à jour de données dans une table MySQL
     * @access      public      insert      
     * @param       type        $cols       Tableau de colonnes de la table
     * @param       type        $rows       Tableau de champs de la table
     * @param       type        $id         Identifiant de la table
     * @param       type        $idValue    Valeur de l'identifiant à mettre à jour
     * @return      string      $sql        Requête de modification d'une table
     */
    public function updateValues ($cols, $rows, $id, $idValue);
    
    /**
     * Méthode qui supprime une ligne dans une table 
     * @access      public      delete      Accès public à la methode delete
     * @param       type        $id         Identifiant de la table à supprimer
     * @param       type        $idValue    Valeur de l'identifiant à supprimer
     * @return      string      $sql        Requête de suppression d'une ligne dans une table      
     */
    public function deleteValues ($id, $idValue);
    
    /**
     * Méthode qui ajoute un élément dans une table
     * @access      publique
     * @param       string          $tablecontent       Element à ajouter dans la table
     */
    public function addTableContent ($tablecontent);
    
    /**
     * Méthode qui réinitialise le contenu d'une table
     * @access public
     */
    public function resetTableContent ();
    
    /**
     * Méthode de création d'une base de données MySQL
     * @access      public      Accès public à la métode createDb
     * @return      string      Script de création de la base de données
     */
    public function createDb ();
    
    /**
     * Méthode de suppression d'une base de données MySQL
     * @access      public      Accès public à la méthode dropDb
     * @return      string      Script de suppression d'une base de données
     */
    public function dropDb ();
    
    /**
     * Méthode qui crée une table MySQL
     * @return type resultat de requete de la table créée
     */
    public function createTable ();
    
    /**
     * Méthode qui supprime une table dans une base de données MySQL
     * @return type le resultat de la requete
     */
    public function dropTable ();
    
    /**
     * Méthode qui ajoute une clé primaire à une table MySQL
     * @access      public
     * @param       string      $id         valeur de la clé primaire     
     */
    public function primaryKey ($id);
    
    /**
     * Méthode qui ajoute une clé étrangère dans une table 
     * @access      publique    
     * @param       string          $idRef          valeur de la clé étrangère
     * @param       string          $tableRef       valeur de la table étrangère
     */
    public function foreignKey($idRef, $tableRef);
    
    /**
     * Méthode qui modifie une table en ajout(ADD), en modification(CHANGE),
     * et en suppression(DROP)
     * @access      public  
     * @param       type        $type               Type de la requete à faire(add, change, drop)
     * @param       string      $col                nom de la colonne à modifier
     * @param       string      $attrib             attribut de la colonne à modifier, exemple: varchar(10) not null
     * @param       string      $newCol             nouveau libellé de la colonne
     */
    public function alterTable($type, $col, $attrib='', $newCol='');
    
    /**
     * Méthode qui vide le contenu d'une table
     * @param type $nomsTable tableau numéroté de tables a vider
     */
    public function truncate($nomsTable);

    /**
     * Méthode qui retourne l'ensemble tuples d'une tables dans 1 tableau
     * @access public
     * @return array tableau de lignes de la table
     */
    public function selectAll();
    
    /**
     * Méthode qui prend en paramètre le résultat d'une requete
     * @access public
     * @param type $sql résultat d'une requete
     * @return type tableau associatif
     */
    public function fetchArray ($sql);
    
    /**
     * Méthode qui prend en paramètre le résultat d'une requete
     * @access public
     * @param type $sql résultat d'une requete
     * @return type tableau numeroté
     */
    public function fetchRow($sql);
}

?>
