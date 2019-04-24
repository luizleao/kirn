<?php
/**
 * Responsável pelo carregamento automatico das classes do sistema
 * 
 * @author luizleao
 */
class Autoload {
    public function __construct() {
        spl_autoload_extensions('.class.php');
        spl_autoload_register(array($this, 'load'));    
    }
    
    private function load($className) {
        $extension = spl_autoload_extensions();
        $aDir = ["", "/bd", "/core", "/core/model", "/core/bdbase", "/core/map"];
        //echo __DIR__ . '/' . $className . $extension;
        foreach($aDir as $oDir){
            if(file_exists(__DIR__.'/'.$oDir.'/'.$className.$extension)){
                require_once (__DIR__.'/'.$oDir.'/'.$className.$extension);
                break;
            }
        }
    }
}

new Autoload();