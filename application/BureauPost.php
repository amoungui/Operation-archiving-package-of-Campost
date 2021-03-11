<?php

//require_once 'MyHeartMySQL.php';

class BureauPost extends MyHeartMySQL {
    private $cols = array('code_bp', 'libele', 'lieu', 'phone');   
    
    public function __construct() {
        parent::__construct('root', '127.0.0.1', '', 'campost');
        $this->connect();
    }
    
    public function fetchOne($id){
        $id = (int)$id;
        
        $this->setTablename('buro_post');
        $sql = 'select * from '. $this->getTablename() . ' where code_bp='. $id .';';
        $result = $this->query($sql);
        
        return $result;
    }
    
    public function fetchAll(){
        $this->setTable('buro_post');
        
        $sql = 'select * from '. $this->getTablename() .';';
        $result = $this->query($sql);
        
        return $result;
    }
    
    public function add ($code_bp, $libele, $lieu, $phone) {
        $data = array($code_bp, $libele, $lieu, $phone);
        $this->setTablename('buro_post');
        
        return $this->insertValues($this->cols, $data);
    }
    
    public function update ($id, $idValue, $libele, $lieu, $phone) {
        $this->setTablename('buro_post');
        $data = array($libele, $lieu, $phone);
        $this->cols = array('libele', 'lieu', 'phone');
        
        return $this->updateValues($this->cols, $data, $id, $idValue);
    }
    
    public function delete ($id, $idValue) {
        $this->setTablename('buro_post');
        
        return $this->deleteValues($id, $idValue);
    }
    
    public function getIdByLibele($name) {
        $this->setTablename('buro_post');
        
        $sql = 'select code_bp from ' . $this->getTablename() . ' where libele="' . $name . '";';
        $result = $this->query($sql);
        
        if($result != NULL) {
            $row = mysql_fetch_row($result);
            return $row[0];
        } else {
            return NULL;
        }
    }
    
    public function getLastId(){
        $this->setTablename('buro_post');
        $sql = 'select max(code_bp) from '. $this->getTablename() . ';';
        $result = $this->query($sql);
        $row = mysql_fetch_row($result);
        
        return $row[0];
    }
}

?>
