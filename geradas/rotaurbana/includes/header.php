<?php
$config = parse_ini_file(dirname(dirname(__FILE__))."/classes/core/config.ini", true);
?>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>Sistema <?=ucfirst($config['producao']['sistema'])?></title>

<!-- CSS -->
<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/bootstrap-grid.min.css" />
<link rel="stylesheet" href="css/bootstrap-reboot.min.css" />
<link href="ionicons/css/ionicons.min.css" rel="stylesheet">

<script type="text/javascript" src="js/jscalendar/js/jscal2.js"></script>
<script type="text/javascript" src="js/jscalendar/js/lang/pt.js"></script>
<link rel="stylesheet" href="js/jscalendar/css/jscal2.css" />
<link rel="stylesheet" href="js/jscalendar/css/border-radius.css" />

<!-- CSS Custom -->
<link href="css/sticky-footer-navbar.css" rel="stylesheet">

<!-- ICON -->
<link rel="shortcut icon" href="img/logo.png" />