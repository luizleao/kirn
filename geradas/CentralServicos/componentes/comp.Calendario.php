<?php 
$textoHora = ($hora) ? "hh:mm:dd" : "";
?>
<div id="dp<?=$nomeCampo?>" class="input-append date">
	<input type="text" name="<?=$nomeCampo?>" value="<?=$valorInicial?>" data-format="dd/MM/yyyy <?=$textoHora?>" />
	<span class="add-on">
		<i data-time-icon="icon-time" data-date-icon="icon-calendar" /></i>
	</span>
</div>
<script>
$(function() {
	$('#dp<?=$nomeCampo?>').datetimepicker({
		language: 'pt-BR'
	});
});
</script>