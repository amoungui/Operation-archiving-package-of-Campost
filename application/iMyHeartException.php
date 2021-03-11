<?php

/**
 * Interface MyHeartException pour la gestion des exception
 * 
 * @author      mbele
 * @version     1.0
 */
interface iMyHeartException {
    /**
     * Methode qui retourne le un message deja formaté
     * @return type message 
     */
    public function getFormat();
    
    /**
     * Getter du message
     * @return type message
     */ 
    public function getMsg();
    
    /**
     * Setter du message
     * @param type $msg 
     */
    public function setMsg($msg);
    
    /**
     * Methode qui définit un message de type Information 
     */
    public function infoMsg();
    
    /**
     * Methode qui definit un message de type alerte
     */
    public function alertMsg();
    
    /**
     * Methode qui definit un message de type alerte
     */
    public function confirmMsg();
    
    /**
     * Methode qui definit un message de type alerte
     */
    public function getMessageCode();
}

?>
