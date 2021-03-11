<?php

//require_once 'MyHeartMySQL.php';

class intervention extends MyHeartMySQL {
    private $cols = array('id_si', 'nature_pb', 'diagnostics', 'travail_fait','resultat','observation','technicien','date_arr','date_sortie','code_bp','id');   
    
    public function __construct() {
        parent::__construct('root', '127.0.0.1', '', 'campost');
        $this->connect();
    }
    
    public function fetchOne($id){
        $id = (int)$id;
        
        $this->setTablename('servic_info');
        $sql = 'select * from '. $this->getTablename() . ' where id_si='. $id .';';
        $result = $this->query($sql);
        
        return $result;
    }
    
    public function fetchAll(){
        $this->setTable('servic_info');
        
        $sql = 'select * from '. $this->getTablename() .';';
        $result = $this->query($sql);
        
        return $result;
    }
    
    public function fetchColumn($column){
        $this->setTablename('servic_info');
        
        $sql = 'select distinct('.$column.') from '. $this->getTablename() .';';
        $result = $this->query($sql);
        
        return $result;
    }
    
    public function add ($nature_pb, $diagnostics, $travail_fait,$resultat,$observation,$technicien,$date_arr,$date_sortie, $code_bp, $idagent) {
        $data = array(NULL, $nature_pb, $diagnostics, $travail_fait,$resultat,$observation,$technicien,$date_arr,$date_sortie,$code_bp, $idagent);
        $this->setTablename('servic_info');
        
        return $this->insertValues($this->cols, $data);
    }
    
    public function update ($id_si, $idValue, $nature_pb, $diagnostics, $travail_fait,$resultat,$observation,$technicien,$date_arr,$date_sortie,$code_bp,$id) {
        $this->setTablename('servic_info');
        $data = array($nature_pb, $diagnostics, $travail_fait,$resultat,$observation,$technicien,$date_arr,$date_sortie,$code_bp,$id);
        $this->cols = array( 'nature_pb', 'diagnostics', 'travail_fait','resultat','observation','technicien','date_arr','date_sortie','code_bp','id');
        
        return $this->updateValues($this->cols, $data, $id_si, $idValue);
    }
    
    public function delete ($id, $idValue) {
        $this->setTablename('servic_info');
        
        return $this->deleteValues($id, $idValue);
    }
    
    public function getLastId(){
        $this->setTablename('servic_info');
        $sql = 'select max(id_si) from '. $this->getTablename() . ';';
        $result = $this->query($sql);
        $row = mysql_fetch_row($result);
        
        return $row[0];
    }
    
    public function getIdByname($technicien) {
        $this->setTablename('servic_info');
        
        $sql = 'select id_si from ' . $this->getTablename() . ' where technicien ="' . $technicien . '";';
        $result = $this->query($sql);
        
        if($result != NULL) {
            $row = mysql_fetch_row($result);
            return $row[0];
        } else {
            return NULL;
        }
    }
}

?>
