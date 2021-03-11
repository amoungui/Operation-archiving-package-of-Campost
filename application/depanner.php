<?php
/**
 * Description of depanner
 *
 * @author mbele.serge
 */
class depanner extends MyHeartMySQL {
    private $cols = array('id_si', 'code_mat');   
    
    public function __construct() {
        parent::__construct('root', '127.0.0.1', '', 'campost');
        $this->connect();
    }
    
    public function fetchOne($id,$code){
        $id = (int)$id;
        
        $this->setTablename('depanner');
        $sql = 'select * from '. $this->getTablename() . ' where id_si='. $id .'AND code_mat='.$code.';';
        $result = $this->query($sql);
        
        return $result;
    }
    
    public function fetchAll(){
        $this->setTable('depanner');
        
        $sql = 'select * from '. $this->getTablename() .';';
        $result = $this->query($sql);
        
        return $result;
    }
    
    public function fetchColumn($column){
        $this->setTablename('depanner');
        
        $sql = 'select distinct('.$column.') from '. $this->getTablename() .';';
        $result = $this->query($sql);
        
        return $result;
    }
    
    public function add ($id_si, $code_mat) {
        $data = array($id_si, $code_mat);
        $this->setTablename('depanner');
        
        return $this->insertValues($this->cols, $data);
    }
    
    public function delete ($id, $code) {
        $this->setTablename('depanner');
        
        $sql = 'DELETE FROM `' . $this->getDatabase() . '`.`' .$this->getTablename() . '` WHERE `' . $this->getTablename().'`.id_si=' .$id. 'AND `'.$this->getTablename().'`.code_mat=' . $code.';';
        return $this->query($sql);
    }

}

?>
