<?php
require_once 'iMyHeartMySQL.php';
require_once 'MyHeartMySQLDao.php';

/**
 * Classe fille MyHeartMySQLDao. Elle implémente l'interface iMyHeartMySQL
 * Il permet une communication simple avec une base de données et encapsule
 * la plupart des primitives de communication.
 * @author      mbele
 * @access      public
 * @version     1.0
 * @license     libre
 **/
class MyHeartMySQL extends MyHeartMySQLDao implements iMyHeartMySQL {
    
    private $_connect;
    
    private $_query;
    
    private $_tableContent = '';

    private $_row = '';

    private $selectAll;
    
    private $sql;
    
    public function getConnect () {
        return $this->_connect;
    }
    
    public function getTableContent () {
        return $this->_tableContent;
    }

    public function getQuery () {
        return $this->_query;
    }
    
    public function getRow () {
        return $this->_row;
    }    

    public function connect() {
        $connect = @mysql_connect($this->getHostname(), $this->getUser(), $this->getPassword()) or die(mysql_error());
        try{
            if(!$connect) {                
                $this->getException()->setMsg('Impossible de se connecter à MySQL');
                $this->getException()->alertMsg();
                throw new Exception($this->getException()->getMessageCode());
            }
            
            if(!@mysql_select_db($this->getDatabase(), $connect)) {
                $this->getException()->setMsg('La base de données ' . '<strong>' . $this->getDatabase() . '</strong>' . ' est actuellement inaccessible ou n\'existe pas');
                $this->getException()->alertMsg();
                throw new Exception($this->getException()->getMessageCode());
            }
        } catch (MyHeartException $e) {
            print $e->getMessage();
        }
        return $this->_connect = $connect;
    }
    
    public function disconnect () {
        mysql_close($this->_connect);
    }
    
    public function query ($sql) {
        try{
            if(empty ($sql)){
                $this->getException()->setMsg('Bien vouloir renseigné la variable ' . '<strong>' . $sql . '</strong>');
                $this->getException()->alertMsg();
                throw new Exception($this->getException()->getMessageCode());
            } else {
                $result = mysql_query($sql, $this->_connect);
                if(!$result) {
                    $this->getException()->setMsg('Une erreur est survenue : Il impossible d\'exécuter votre requête');
                    $this->getException()->alertMsg();
                    throw new Exception($this->getException()->getMessageCode());
                } else {
                    return $this->_query = $result;
                }
            }
        }  catch (Exception $e){
            echo $e->getMessage();
        }
    }

    public function insertValues ($cols, $rows) { 
        try{
            if(empty ($cols) || empty ($rows)){
                $this->getException()->setMsg('Une ou plusieurs variable(s) ne sont pas renseignées...');
                $this->getException()->alertMsg();
                throw new Exception($this->getException()->getMessageCode());
            } else {
                //Parcours du tableau des colonnes
                $colone = '';
                for ((int)$i=0; $i<count($cols); $i++) {
                    $colone .= $cols[$i] . ', ';
                }
                
                //Parcours du tableau des champs
                $champ = '';
                for ((int)$j=0; $j<count($rows); $j++) {
                    $champ .= " '$rows[$j]' " . ', ';
                }
                
                //Construction de la requête d'insertion
                $insert = 'INSERT INTO ' . $this->getDatabase() . '.' .$this->getTablename() . ' (' . $colone . ')';
                $values = ' VALUES (' . $champ . ');';
                
                //On enlève les caractères suppléméntaires
                $sql = str_replace(', )', ')', $insert);
                $sql .= str_replace(', );', ');', $values);
                
                //echo $sql;
                return $this->query($sql);
            }
        } catch (MyHeartException $e) {
            echo $e->getMessage();
        }
    }
    
    public function comparvalue($cols, $rows){
        try{
            if(empty ($cols) || empty ($rows)){
                $this->getException()->setMsg('Une ou plusieurs variable(s) ne sont pas renseignées...');
                $this->getException()->alertMsg();
                throw new Exception($this->getException()->getMessageCode());
            } else {
                //Parcours du tableau des colonnes
                $colone = '';
                for ((int)$i=0; $i<count($cols); $i++) {
                    $colone .= $cols[$i] . ', ';
                }
                
                //Parcours du tableau des champs
//                $champ = '';
//                for ((int)$j=0; $j<count($rows); $j++) {
//                    $champ .= " '$rows[$j]' " . ', ';
//                }
                $select='select'.$colone.'from'.$this->getTablename().'where'.$colone.'LIKE'.$rows.'%';
                while ($données=$select->fetch())
                    {
                        if($données==$cols){
                            $this->getException()->setMsg('identifiant existant veillez reinseigner une autre valeur');
                            $this->getException()->alertMsg();
                            throw new Exception($this->getException()->getMessageCode());
                        }else{
                            echo 'identifiant correct merci'.$données.'de vous etre inscris ';
                        }
                    }
            }
        } catch (MyHeartException $e) {
            echo $e->getMessage();
        }
    }


    public function updateValues ($cols, $rows, $id, $idValue) {
        try{
            if (empty ($cols) || empty ($rows) || empty ($id) || empty ($idValue)) {
                $this->getException()->setMsg('Une ou plusieurs variable(s) ne sont pas renseignées...');
                $this->getException()->alertMsg();
                throw new Exception($this->getException()->getMessageCode());
            } else {
                //Formatage du tableau de colonnes
                $colone = explode('_', implode ('_', $cols));
                
                //Formatage du tableau de champs
                $champ = explode('_', implode ('_', $rows));
                
                (int)$i = 0;    (int)$j = 0;    $var = '';
                while ( ($i < count($colone)) && ($j < count($champ)) ) {
                    $var .= $colone[$i] . ' = ' . " '$champ[$j]' " . ', ';
                    $i++;
                    $j++;
                }
                $var .= ';';
                $set = str_replace(', ;', ' ', $var);
                
                //Construction de la requête de Mise à jour d'une table
                $sql = 'UPDATE ' . $this->getDatabase() . '.' .$this->getTablename() . ' SET ' . $set . ' WHERE ' .$id. ' = ' .$idValue. ';';
                
                return $this->query($sql);
            }
        } catch(MyHeartException $e) {
            echo $e->getMessage();
        }
    }
    
    public function deleteValues ($id, $idValue) {
        try{
            if(!isset ($id) || !isset ($idValue)) {
                $this->getException()->setMsg('Une ou plusieurs variable(s) ne sont pas renseignées...');
                $this->getException()->alertMsg();
                throw new Exception($this->getException()->getMessageCode());
            } else {
                $sql = 'DELETE FROM ' . $this->getDatabase() . '.' .$this->getTablename() . ' WHERE ' . $id . ' = ' . $idValue . ';';
                return $this->query($sql);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    
    public function addTableContent ($tablecontent) {
        $this->_tableContent .= $tablecontent;
    }

    public function resetTableContent () {
        $this->_tableContent = '';
    }

    public function createDb () {
        return $this->query('CREATE DATABASE IF NOT EXISTS ' . $this->getDatabase() . ';');
    }
    
    public function dropDb () {
        return $this->query('DROP DATABASE IF EXISTS ' . $this->getDatabase() . ';') ;
    }
    
    public function createTable () {
        $sql = 'CREATE TABLE IF NOT EXISTS ' . $this->getDatabase() . '.'
                                             . $this->getTablename() 
                                             . '(' . $this->_tableContent . ')ENGINE=' 
                                             . $this->getTableengine() . ';';
        return $this->query($sql);
    }
    
    public function dropTable () {
        return $this->query('DROP TABLE IF EXISTS' . $this->getDatabase() . '.' . $this->getTablename(). ';');
    }
    
    public function primaryKey ($id) {
        $this->_tableContent .= $this->addTableContent('primary key('.$id.')');
    }
    
    public function foreignKey($idRef, $tableRef) {
        $this->_tableContent .= $this->addTableContent('foreign key('. $idRef .') references '.$this->getDatabase(). '.' . '`' . $tableRef . '`' .' ('. $idRef .') ON DELETE CASCADE ON UPDATE CASCADE, ');
    }

    public function alterTable($type, $col, $attrib='', $newCol='') {
        try {
            if(($type == 'change') && isset ($newCol)){
                return $this->query('ALTER TABLE ' . $this->getDatabase() . '.' . $this->getTablename() . ' CHANGE ' . "`$col`" . '  ' . "`$newCol` " . $attrib . ';'); 
            } elseif (($type == 'add') && isset ($attrib)) {
                return $this->query('ALTER TABLE ' . $this->getDatabase() . '.' . $this->getTablename() . ' ADD ' . "`$col`" .' '.  $attrib . ';');
            } elseif($type == 'drop'){
                return $this->query('ALTER TABLE ' . $this->getDatabase() . '.' . $this->getTablename() . ' DROP ' . "`$col`" . ';');
            } else {
                $this->getException()->setMsg('Une ou plusieurs variable(s) ne sont pas renseignées...');
                $this->getException()->alertMsg();
                throw new Exception($this->getException()->getMessageCode());
            }
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
    
    public function truncate($nomsTable) {
        foreach ($nomsTable as $table) {
            $sql = 'truncate ' . '`'. $this->getDatabase() . '`.`' . $table . '`;  ';
            $this->query($sql);
        } 
    }
    
    public function selectAll() {
        $this->sql = $this->query('SELECT * FROM ' . $this->getDatabase() . '.' .$this->getTablename() . ';');
        return $this->sql;
    }

    public function fetchArray ($sql) {    
        mysql_fetch_array($sql);
    }
    
    public function fetchRow($sql) {
        mysql_fetch_row($sql);
    }
    
}

?>
