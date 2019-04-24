<?php
// Pasta Comum
require_once("../classes/autoload.php");

if(preg_match("#^.*/rest/(.*?)/(\d+)/?$#is", $_SERVER['REQUEST_URI'], $aux)){
    $aParam['classe'] = $aux[1];
    $aParam['id'] = $aux[2];
}

elseif(preg_match("#^.*/rest/(.*?)/?$#is", $_SERVER['REQUEST_URI'], $aux)){
    $aParam['classe'] = $aux[1];
} else {
    die('Nenhum padrao encontrado');
}

//Util::trace($aParam);

try{
    $exec = "\$oController = new Controller{$aParam['classe']}();\n";
    
    switch($_SERVER['REQUEST_METHOD']){
        case 'GET':
            if(isset($aParam['id']))
                $exec .= "\$a = \$oController->get({$aParam['id']});\n";
                else
                    $exec .= "\$a = \$oController->getAll();\n";
                    break;
                    
        case 'POST':
            $post = json_decode(file_get_contents("php://input"), true);
            $exec .= "\$a = \$oController->cadastrar(\$post);\n";
            break;
            
        case 'PUT':
            $post = json_decode(file_get_contents("php://input"), true);
            //Util::trace($post);exit;
            $exec .= "\$a = \$oController->alterar(\$post);\n";
            break;
            
        case 'DELETE':
            $exec .= "\$a = \$oController->excluir({$aParam['id']});\n";
            break;
    }
    
    //print $exec;
    
    if(!eval($exec)){
        throw new Exception("Falha na execução do WS");
    }
} catch(Exception $e){
    $a = $e->getMessage();
}
header("content-type: application/json");
echo json_encode($a);