<?php
$config = parse_ini_file(dirname(dirname(__FILE__)) . "/classes/core/config.ini", true);
?>
<meta charset="utf-8" />
<title>Sistema <?=ucfirst($config['producao']['sistema'])?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta name="description" content="" />
<meta name="author" content="" />

<meta name="google-signin-client_id"
	content="414682654952-fkgv41mnqcuds3a57e9lb150c5qo07uf.apps.googleusercontent.com">

<!-- ICON -->
<link rel="shortcut icon" href="img/logo.png" />

<!-- CSS -->
<?php require_once("css.php");?>

<!-- JS -->
<?php require_once("js.php");?>