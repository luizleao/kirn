<?php
require_once ("classes/Autoload.php");
header('Content-type: text/json');
// echo json_encode($_REQUEST['sgbd']); exit;

switch ($_REQUEST['sgbd']) {
    case "mysql":
        $oConexao = new ConexaoMySqli('Vazia');
        $oConexao->set_conexao($_REQUEST['host'], $_REQUEST['login'], $_REQUEST['senha']);
        break;

    case "sqlserver":
        $oConexao = new ConexaoSqlServer('Vazia');
        $oConexao->set_conexao($_REQUEST['host'], $_REQUEST['login'], $_REQUEST['senha']);
        break;

    case "postgre":
        $oConexao = new ConexaoPostgre('Vazia');
        $oConexao->set_conexao($_REQUEST['host'], $_REQUEST['login'], $_REQUEST['senha']);
        break;
}
if (! $oConexao->conexao) {
    $retorno = false;
} else {
    $retorno = $oConexao->databases();
}

echo json_encode($retorno);