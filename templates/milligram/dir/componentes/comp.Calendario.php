<?php
$textoHora = ($hora) ? "hh:mm:dd" : "";
?>
<div>
	<div id="dp<?=$nomeCampo?>">
		<input type="text" name="<?=$nomeCampo?>" value="<?=$valorInicial?>" required/>
		<div>
            <div>
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
