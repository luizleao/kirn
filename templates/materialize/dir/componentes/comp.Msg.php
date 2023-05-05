<?php
switch ($tipo) {
    case "erro":
        $fundo = "red lighten-5";
        $texto = "red-text text-darken-4";
        $icone = "error";
        break;
    case "sucesso":
        $fundo = "green lighten-4";
        $texto = "green-text text-darken-4";
        $icone = "success";
        break;
    case "alerta":
        $fundo = "amber lighten-3";
        $texto = "amber-text text-darken-4";
        $icone = "alert";
        break;
    case "info":
        $fundo = "blue lighten-4";
        $texto = "blue-text text-darken-4";
        $icone = "info";
        break;
}
?>

<div class="card <?=$fundo?>">
	<div class="card-content <?=$texto?>">
		<img src="img/ico_<?=$icone?>.png" /> <?=$msg?>
    </div>
</div>