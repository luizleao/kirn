<?php
/**
 * Responsável pelo carregamento automatico das classes do sistema
 * 
 * @author luizleao
 */
/**
 * Class Autoload | classes/autoload.php
 *
 * @package     classes
 * @author      Luiz Leão <luizleao@gmail.com>
 * @version     v.2.1 (06/12/2018)
 * @copyright   Copyright (c) 2018, Luiz
 */
/**
 * Classe Autoload
 *
 * Responsável pelo carregamento automatico das classes do sistema
 *
 * @author Luiz Leão <luizleao@gmail.com>
 */
class Autoload {
    /**
     * Método construtor
     */
    public function __construct() {
        spl_autoload_extensions('.class.php');
        spl_autoload_register(array($this, 'load'));    
    }
    
    /**
     * Carrega a classe na memória, quando requerida
     * 
     * @param string $className
     */
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