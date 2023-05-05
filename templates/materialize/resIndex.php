<?php
require_once ("classes/Autoload.php");

foreach ($_POST as $campo => $valor) {
    $$campo = trim($valor);
}
$oController = new Controller();

print ($oController->autenticaUsuarioLDAP($login, $senha)) ? "" : $oController->msg;
