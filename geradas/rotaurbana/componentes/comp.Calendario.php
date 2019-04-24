<?php 
$textoHora = ($hora) ? "%d/%m/%Y %H:%M:%S" : "%d/%m/%Y";
$size = ($hora) ? 21 : 10;
?>
<div class="row">
    <div class="col-md-10">
    	<div class="input-group mb-2">
			<input name="<?=$nomeCampo;?>" value="<?=$valorInicial?>" type="text" id="<?=$nomeCampo;?>" size="<?=$size?>" class="form-control" <?=$complemento?> />
			<span class="input-group-append">
				<button id="btnData<?=$nomeCampo;?>" class="btn btn-outline-secondary" type="submit"><i class="icon ion-md-calendar"></i></button>
			</span>
		</div>
    </div>
</div>
<script type="text/javascript">
Calendar.setup({
    inputField : "<?=$nomeCampo;?>",
    trigger    : "btnData<?=$nomeCampo;?>",
    onSelect   : function() { this.hide();},
    showTime   : 24,
    dateFormat : "<?=$textoHora?>"
});
</script>