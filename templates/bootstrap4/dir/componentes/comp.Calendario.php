<?php
$textoHora = ($hora) ? "hh:mm:dd" : "";
?>

<div class="form-group">
	<div class="input-group" id="dp<?=$nomeCampo?>">
		<input type="text" class="form-control" name="<?=$nomeCampo?>" value="<?=$valorInicial?>" required/>
		<div class="input-group-addon input-group-append">
            <div class="input-group-text">
                <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
            </div>
        </div>
	</div>
</div>
<script>
(function($){
    $(function() {
    	$('#dp<?=$nomeCampo?>').datetimepicker({
    	    locale: 'pt-br',
            "allowInputToggle": true,
            "showClose": true,
            "showClear": true,
            "showTodayButton": true,
            "format": "DD/MM/YYYY<?=($hora) ? " hh:mm:ss A" : ""?>",
        });
    });
})(jQuery);
</script>
