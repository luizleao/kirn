<?php
$oController = new Controller();
$aUf = $oController->getAllUf();
?>
<select name="<?=$nomeCampo?>" id="<?=$nomeCampo?>"<?=($evento != "") ? " $evento=\"$funcao\"" : ""?>>
    <option value="">Selecione</option>
<?php
foreach($aUf as $oUf){
?>
    <option value="<?=$oUf->get_idUf();?>"><?=$oUf->get_siglaUf();?> - <?=$oUf->get_descricaoUf();?></option>
<?php
}
?>
</select>