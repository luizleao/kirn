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
        spl_autoload_extensions('.php');
        spl_autoload_register([$this, 'load']);    
    }
    
    /**
     * Carrega a classe na memória, quando requerida
     * 
     * @param string $className
     */
    private function load($className) {
        $extension = spl_autoload_extensions();
        $aDir = ["", "/bd/", "/core/", "/core/model/", "/core/bdbase/", "/core/map/", "/enum/"];
        foreach($aDir as $oDir){
            $classeImport = __DIR__.'/'.$oDir.$className.$extension;
            
            if(file_exists($classeImport)){
                //echo $classeImport;
                require_once ($classeImport);
                break;
            }
        }
    }
}

new Autoload();