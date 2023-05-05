<?php
$config = parse_ini_file(dirname(dirname(__FILE__)) . "/classes/core/config.ini", true);
?>
<meta charset="utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>Sistema <?=ucfirst($config['producao']['sistema'])?></title>

<!-- ICON -->
<link rel="shortcut icon" href="img/logo.png" />

<?php include_once('css.php');?>
<?php include_once('js.php');?>