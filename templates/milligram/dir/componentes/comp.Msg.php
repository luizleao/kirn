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
<div class="alert <?=$tipo?> alert-dismissible fade show" role="alert">
	<h6><img src="img/ico_<?=$tipo_ico?>.png" /> <?=$msg?></h6>
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>