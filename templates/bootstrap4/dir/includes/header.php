<?php
$config = parse_ini_file(dirname(dirname(__FILE__))."/classes/core/config.ini", true);
?>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
<title>Sistema <?=ucfirst($config['producao']['sistema'])?></title>

<script type="text/javascript" src="js/jscalendar/js/jscal2.js"></script>
<script type="text/javascript" src="js/jscalendar/js/lang/pt.js"></script>
<link rel="stylesheet" href="js/jscalendar/css/jscal2.css" />
<link rel="stylesheet" href="js/jscalendar/css/border-radius.css" />

<!-- ICON -->
<link rel="shortcut icon" href="img/logo.png" />
<?php require_once("css.php");?>