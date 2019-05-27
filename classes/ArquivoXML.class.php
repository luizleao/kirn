<?php
#namespace classes;
/**
 * Class ArquivoXML | classes/ArquivoXML.class.php
 *
 * @package     classes
 * @author      Luiz Leão <luizleao@gmail.com>
 * @version     v.2.0 (06/12/2018)
 * @copyright   Copyright (c) 2018, Luiz
 */
/**
 * Arquivo XML
 * 
 * Gerencia a lista de arquivos XML gerados pela aplicação
 * 
 * @author Luiz Leão <luizleao@gmail.com>
 */
class ArquivoXML {
    /**
     * Lista de arquivos XML
     * 
     * @var string[] 
     */
    public $arquivos;

    /**
     * Método Construtor
     * 
     * @return void
     */
    function __construct(){
        $arquivos = [];
        $dir      = dirname(__FILE__)."/../xml/";
        $dh       = opendir($dir);
        while(($file = readdir($dh)) !== false){
            if(filetype($dir.$file) == "file" && substr($file,-4) == ".xml"){
                $arquivos[] = substr($file,0,strrpos($file,".xml"));
            }
        }
        $this->arquivos = $arquivos;
    }
    
    /**
     * Método GET
     * 
     * @return string[] 
     */
    function getArquivos(){
        return $this->arquivos;
    }
}