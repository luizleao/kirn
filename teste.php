<?php
require_once("classes/autoload.php");
try{
    //$oControle = new Controller();
    //$oGeracao = new Geracao(dirname(__FILE__)."/xml/blog.xml");
    
    //Util::trace($oGeracao->getTituloObjeto("Comentario"));
    //Util::trace($oGeracao->getAllAtributo("Post"));
    //Util::trace($oGeracao->getObjetosMontados("Comentario"));
    //$var = $oController->gerarArtefatos('blog', 'bootstrap2', false);
    //Util::trace($var);  //exit;
    
    /*
    $a = Util::getAllFileDir(dirname(__FILE__)."/geradas/seguradora");
    $count = 0;
    
    foreach($a as $b){
        // return mime type ala mimetype extension
        $finfo = finfo_open(FILEINFO_MIME);
        echo $b."................................".finfo_file($finfo, $b)."\n";
        //check to see if the mime-type starts with 'text'
        if(substr(finfo_file($finfo, $b), 0, 4) == 'text')
            $count += Util::getLines($b);    
    }
    
    
    echo "Total de linhas geradas: $count\n";
    */
    //Util::trace(Util::getTotalLineProject(dirname(__FILE__)."/geradas/blog"), true);
    
    echo Project::getTotalPFProject(dirname(__FILE__)."/xml/CentralServicos.xml")." PFs\n";
    //echo Project::getTotalPFProject(dirname(__FILE__)."/xml/seguradora.xml")." PFs\n";
    //echo Project::getTotalPFProject(dirname(__FILE__)."/xml/blog.xml")." PFs\n";
    //echo Project::getTotalPFProject(dirname(__FILE__)."/xml/academico.xml")." PFs\n";
        
} catch (Exception $e){
    return "Erro na operação";
}