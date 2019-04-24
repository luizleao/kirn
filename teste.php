<?php
require_once("classes/autoload.php");
try{
    $oControle = new Controle();
    //$oGeracao = new Geracao(dirname(__FILE__)."/xml/blog.xml");
    
    //Util::trace($oGeracao);
    //Util::trace($oGeracao->getAllAtributo("Post"));
    //Util::trace($oGeracao->getObjetosMontados("Comentario"));
    $var = $oControle->gerarArtefatos('blog', 'bootstrap2', false);
    Util::trace($var);  //exit;
    
} catch (Exception $e){
    return "Erro na operação";
}