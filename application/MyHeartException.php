<?php
require_once 'iMyHeartException.php';
/**
 * C'est le gestionnaire d'exceptions par défaut du framework.
 * Il herite de la classe Exception de la platte forme PHP
 * @author      mbele
 * @category:       MyHeartException
 * @version:        1.0
 * @access          public
 * @license         Libre
 */
class MyHeartException extends Exception implements iMyHeartException {
    private $format;
    private $msg;
    private $msginfo = 'ui-icon-info';
    private $msgalert = 'ui-icon-alert';
    private $msgOk = 'ui-icon-check';
    
    public function getFormat() {
        return $this->format;
    }

    public function getMsg() {
        return $this->msg;
    }
    
    public function setMsg($msg) {
        $this->msg = $msg;
    }

    public function infoMsg() {
        $this->format = '<div class="ui-state-highlight ui-corner-all ui-msg-box"><p>' 
                . '<span class="ui-icon ' . $this->msginfo . '"></span>' . "\n"
                . '<strong>MyHeartFramework Information : </strong>' . $this->msg . " !"
                . '</p></div>';
    }
        
    public function alertMsg() {
        $this->format = '<div class="ui-state-error ui-corner-all ui-msg-box"><p>' 
                . '<span class="ui-icon ' . $this->msgalert . ' "></span>' . "\n"
                . '<strong>MyHeartFramework Alert : </strong>' . $this->msg . " !"
                . '</p></div>';
    }

    public function confirmMsg() {
        $this->format = '<div class="ui-state-highlight ui-corner-all ui-msg-box"><p>' 
                . '<span class="ui-icon ' . $this->msgOk . ' "></span>' . "\n"
                . '<strong>MyHeartFramework Confirmation : </strong>' . $this->msg . " !"
                . '</p></div>';
    }
    
    public function getMessageCode() {
        return '<div class="ui-widget">' . $this->getFormat() . '</div>' . "\n";
    }
}
?>
