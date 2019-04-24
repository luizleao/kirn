<?php
$oController = new Controller();
$aUf = $oController->getAllUf();
?>
<div class="form-group">
    <select name="<?=$nomeCampo?>" id="<?=$nomeCampo?>" class="form-control">
        <option value="">Selecione</option>
    <?php
    foreach($aUf as $oUf){
    ?>
        <option value="<?=$oUf?>"<?=($oUf == $valor) ? ' selected="selected"' : ""?>><?=$oUf?></option>
    <?php
    }
    ?>
    </select>
</div>