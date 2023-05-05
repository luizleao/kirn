<?php
switch ($tipo) {
    case "erro":
        $tipo = "alert-error";
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
<div class="alert alert-block <?=$tipo?> fade in">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<h5 class="alert-heading">
		<img src="img/ico_<?=$tipo_ico?>.png" /> <?=$msg?></h5>
</div>