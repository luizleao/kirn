<?php
require_once ("../classes/autoload.php");

// print $_SERVER['REQUEST_URI'];

if (preg_match("#^.*/rest/(.*?)/!/(.*?)/?$#is", $_SERVER['REQUEST_URI'], $retornoux)) {
    $retornoParam['classe'] = $retornoux[1];
    $retornoParam['texto'] = $retornoux[2];
    $retornoParam['consulta'] = true;
} 
elseif (preg_match("#^.*/rest/(.*?)/(\d+)/?$#is", $_SERVER['REQUEST_URI'], $retornoux)) {
    $retornoParam['classe'] = $retornoux[1];
    $retornoParam['id'] = $retornoux[2];
} 
elseif (preg_match("#^.*/rest/(.*?)/?$#is", $_SERVER['REQUEST_URI'], $retornoux)) {
    $retornoParam['classe'] = $retornoux[1];
} else {
    die('Nenhum padrao encontrado');
}

// Util::trace($retornoParam);

$exec = "\$oController = new Controller{$retornoParam['classe']}();\n";

try {
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'GET':

            if ($retornoParam['consulta'] == true) {
                $exec .= "\$retorno = \$oController->consultar('" . urldecode($retornoParam['texto']) . "');\n";
                // print $exec;
            } else {
                $exec .= (isset($retornoParam['id'])) ? "\$retorno = \$oController->get({$retornoParam['id']});\n" : "\$retorno = \$oController->getAll();\n";
            }
            break;

        case 'POST':
            $post = json_decode(file_get_contents("php://input"), true);
            $exec .= "\$retorno = \$oController->cadastrar(\$post);\n";
            break;

        case 'PUT':
            $post = unserialize(file_get_contents("php://input"));
            $exec .= "\$retorno = \$oController->alterar(\$post);\n";
            break;

        case 'DELETE':
            $exec .= "\$retorno = \$oController->excluir({$retornoParam['id']});\n";
            break;
    }
    // print "$exec";
    eval($exec);
} catch (Exception $e) {
    $retorno = $e->getMessage();
}
header("content-type: application/json; charset=UTF-8");
echo json_encode($retorno);