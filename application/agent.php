<?php
/**
 * Description of depanner
 *
 * @author mbele.serge
 */

//require_once 'MyHeartMySQL.php';


class agent extends MyHeartMySQL {
    private $cols = array('id', 'firstname', 'lastname', 'phone', 'email', 'fonction', 'code_bp');   
    
    public function __construct() {
        parent::__construct('root', '127.0.0.1', '', 'campost');
        $this->connect();
    }
    
     public function fetchOne($id){
        $id = (int)$id;
        
        $this->setTablename('agent');
        $sql = 'select * from '. $this->getTablename() . ' where id='. $id .';';
        $result = $this->query($sql);
        
        return $result;
    }
    
     public function fetchAll(){
        $this->setTablename('agent');
        
        $sql = 'select * from '. $this->getTablename() .';';
        $result = $this->query($sql);
        
        return $result;
    }
    
    public function add ($firstname, $lastname, $phone, $email, $fonction, $code_bp) {
        $data = array(NULL, $firstname, $lastname, $phone, $email, $fonction, $code_bp);
        $this->setTablename('agent');
        
        return $this->insertValues($this->cols, $data);
    }
    
    public function update($id, $idValue, $firstname, $lastname, $phone, $email, $fonction, $code_bp) {
        $this->setTablename('agent');
        $data = array($firstname, $lastname, $phone, $email, $fonction, $code_bp);
        $this->cols = array('firstname', 'lastname', 'phone', 'email', 'fonction', 'code_bp');
        
        return $this->updateValues($this->cols, $data, $id, $idValue);
    }
    
    public function delete ($id, $idValue) {
        $this->setTablename('agent');
        
        return $this->deleteValues($id, $idValue);
    }
    
    public function getIdByName($name) {
        $this->setTablename('agent');
        
        $sql = 'select id from ' . $this->getTablename() . ' where firstname="' . $name . '";';
        $result = $this->query($sql);
        
        if($result != NULL) {
            $row = mysql_fetch_row($result);
            return $row[0];
        } else {
            return NULL;
        }
    }
    
    public function getLastId(){
        $this->setTablename('agent');
        $sql = 'select max(id) from '. $this->getTablename() . ';';
        $result = $this->query($sql);
        $row = mysql_fetch_row($result);
        
        return $row[0];
    }
}
?>
