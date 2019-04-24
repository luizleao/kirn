<?php
$textoHora = ($hora) ? "hh:mm:dd" : "";
?>
<div class="form-group">
    <div class="input-group date" id="dp<?=$nomeCampo?>">
        <input type="text" class="form-control" name="<?=$nomeCampo?>" value="<?=$valorInicial?>" data-format="dd/MM/yyyy <?=$textoHora?>" />
        <span class="input-group-addon">
            <span class="glyphicon glyphicon-calendar"></span>
        </span>
    </div>
</div>
<script>
$(function() {
	$('#dp<?=$nomeCampo?>').datetimepicker({
		locale: 'pt-BR',
		<?=($hora) ? "" : "format: 'L'"?>
	});
});
</script>
