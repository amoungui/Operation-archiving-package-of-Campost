<?php

//require_once 'MyHeartMySQL.php';


class materiel extends MyHeartMySQL {
    private $cols = array('code_mat', 'code_bp', 'designation', 'marque', 'numero_serie', 'taille_ecran', 'type_clavier','type_souris','taille_disk','taille_ram','type_cable');   
    
    public function __construct() {
        parent::__construct('root', '127.0.0.1', '', 'campost');
        $this->connect();
    }
    
     public function fetchOne($id){
        $id = (int)$id;
        
        $this->setTablename('materiel');
        $sql = 'select * from '. $this->getTablename() . ' where code_mat='. $id .';';
        $result = $this->query($sql);
        
        return $result;
    }
    
    public function fetchAll(){
        $this->setTablename('materiel');
        
        $sql = 'select * from '. $this->getTablename() .';';
        $result = $this->query($sql);
        
        return $result;
    }
    
    public function fetchColumn($column){
        $this->setTablename('materiel');
        
        $sql = 'select distinct('.$column.') from '. $this->getTablename() .';';
        $result = $this->query($sql);
        
        return $result;
    }
    
    public function add ($code_mat, $code_bp, $designation, $marque, $numero_serie, $taille_ecran, $type_clavier,$type_souris,$taille_disk,$taille_ram,$type_cable) {
        $data = array($code_mat, $code_bp, $designation, $marque, $numero_serie, $taille_ecran, $type_clavier,$type_souris,$taille_disk,$taille_ram,$type_cable);
        $this->setTablename('materiel');
        
        return $this->insertValues($this->cols, $data);
    }
    
    public function update ($id, $idValue, $designation, $marque, $numero_serie, $taille_ecran, $type_clavier,$type_souris,$taille_disk,$taille_ram,$type_cable) {
        $this->setTablename('materiel');
        $data = array($designation, $marque, $numero_serie, $taille_ecran, $type_clavier,$type_souris,$taille_disk,$taille_ram,$type_cable);
        $this->cols = array('designation', 'marque', 'numero_serie', 'taille_ecran', 'type_clavier','type_souris','taille_disk','taille_ram','type_cable');
        
        return $this->updateValues($this->cols, $data, $id, $idValue);
    }
    
    public function delete ($code_mat, $idValue) {
        $this->setTablename('materiel');
        
        return $this->deleteValues($code_mat, $idValue);
    }
    
    public function getIdByname($numero_serie) {
        $this->setTablename('materiel');
        
        $sql = 'select code_mat from ' . $this->getTablename() . ' where numero_serie ="' . $numero_serie . '";';
        $result = $this->query($sql);
        
        if($result != NULL) {
            $row = mysql_fetch_row($result);
            return $row[0];
        } else {
            return NULL;
        }
    }
    
    public function getLastId(){
        $this->setTablename('materiel');
        $sql = 'select max(code_mat) from '. $this->getTablename() . ';';
        $result = $this->query($sql);
        $row = mysql_fetch_row($result);
        
        return $row[0];
    }
    
    public function putCode($type_equipment){
        $type = ""; $out = '';
        
        $this->setTablename('materiel');
        $sql = 'SELECT max(code_mat) from '. $this->getTablename() . ';';
        $result = $this->query($sql);
        $row = mysql_fetch_row($result);
        
        $value = substr($row[0], 2, 4);
        
        if($type_equipment == "clavier"){
            $type = "CV";
        } elseif($type_equipment == "ecran") {
            $type = "EC";
        } elseif($type_equipment == "unite centrale") {
            $type = "UC";
        }elseif($type_equipment == "imprimante") {
            $type = "IM";
        }elseif($type_equipment == "souris") {
            $type = "SR";
        }
        
        if(!$row[0]){
            $out = 'CE' . '0001' . $type;
        } else {
            $num = substr_count($value, 0);
            (int) $i = $value;
            (int) $q= $i+1;

            if ($num == "3") {
                if($i <= 10){
                    $last = substr($value, -1, 1);
                    if($last == 9){
                        $code = array('CE','00', $last+1, $type);
                        $out = $code[0] . $code[1] . $code[2] . $code[3];
                    } elseif ($last > 9) {
                        $last = substr($value, -2, 2);
                        $code = array('CE','00', $last+1, $type);
                        $out = $code[0] . $code[1] . $code[2] . $code[3];
                    }else {
                        $code = array('CE','000', $last+1, $type);
                        $out = $code[0] . $code[1] . $code[2] . $code[3];
                    }
                } else {
                    $last = substr($value, -2, 2);
                    $code = array('CE','00', $last+1, $type);
                    $out = $code[0] . $code[1] . $code[2] . $code[3];
                }
            } elseif ($num == "2") {
                if( (10 < $i) && ($i<100) ){
                    $last = substr($value, -2, 2);
                    $code = array('CE', '00', $last+1, $type);
                    $out = $code[0] . $code[1] . $code[2] . $code[3];
                }
            } elseif ($num == "1") {
                if( (100<$i) && ($i<1000) ){
                    $last = substr($value, -1, 3);
                    $code = array('CE', '0', $last+1, $type);
                    $out = $code[0] . $code[1] . $code[2] . $code[3];
                }
            }
        }
        
        return $out;
    }
}

?>
