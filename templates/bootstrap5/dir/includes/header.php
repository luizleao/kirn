<?php
$config = parse_ini_file(dirname(dirname(__FILE__)) . "/classes/core/config.ini", true);
?>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>Sistema <?=ucfirst($config['producao']['sistema'])?></title>
<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-xBuQ/xzmlsLoJpyjoggmTEz8OWUFM0/RC5BsqQBDX2v5cMvDHcMakNTNrHIW2I5f" crossorigin="anonymous"></script>
<!-- ICON -->
<link rel="shortcut icon" href="img/logo.png" />
<?php require_once("css.php");?>