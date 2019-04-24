<?php
require_once("classes/autoload.php");

foreach($_POST as $campo=>$valor){
    $$campo = trim($valor);
}
$oController = new Controller();

print ($oController->autenticaUsuarioLDAP($login, $senha)) ? "" : $oController->msg;
