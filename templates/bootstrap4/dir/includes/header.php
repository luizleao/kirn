<?php
$config = parse_ini_file(dirname(dirname(__FILE__)) . "/classes/core/config.ini", true);
?>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>Sistema <?=ucfirst($config['producao']['sistema'])?></title>

<!-- ICON -->
<link rel="shortcut icon" href="img/logo.png" />
<?php require_once("js.php");?>
<?php require_once("css.php");?>