<?php
switch ($tipo) {
    case "erro":
        $tipo = "alert-danger";
        $tipo_ico = "error";
        break;
    case "sucesso":
        $tipo = "alert-success";
        $tipo_ico = "success";
        break;
    case "alerta":
        $tipo = "";
        $tipo_ico = "alert";
        break;
    case "info":
        $tipo = "alert-info";
        $tipo_ico = "info";
        break;
}
?>
<div class="alert alert-dismissible fade in <?=$tipo?>">
	<button type="button" class="close" data-dismiss="alert"
		aria-label="Close">×</button>
	<h5 class="alert-heading">
		<img src="img/ico_<?=$tipo_ico?>.png" /> <?=$msg?></h5>
</div>