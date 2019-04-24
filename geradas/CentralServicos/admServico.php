<?php
require_once("classes/autoload.php");
$oController = new ControllerServico();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['idServico'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aServico = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["Servico.idServico"], $_REQUEST['pag']);
//Util::trace($aServico);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <div id="wrap">
        <?php require_once("includes/menu.php");?>
        <div class="container">
            <?php require_once("includes/titulo.php"); ?>
            <ul class="breadcrumb">
                <li><a href="home.php">Home</a> <span class="divider">/</span></li>
                <li class="active">Administrar Servico</li>
            </ul>
            <form action="" method="post">
	            <div class="row">
	            	<div class="span12">
			            <div class="input-append">
							<input type="text" class="span8" id="txtConsulta" name="txtConsulta" placeholder="Pesquisar Servico" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
							<button class="btn btn-primary" type="submit"><i class="icon-white icon-search"></i></button>
							<a href="frmServico.php" class="btn btn-success" title="Cadastrar"><i class="icon-white icon-plus"></i></a>
						</div>
					</div>
				</div>
			</form>
<?php 
if($oController->msg != "")
	$oController->componenteMsg($oController->msg, "erro");
?>
            <table class="table table-striped">
<?php
if($aServico){
?>
	
                <thead>
                    <tr>
                        <th>Id</th>
					<th>Sla</th>
					<th>TipoServico</th>
					<th>Descricao</th>
					<th>Valor</th>
					<th>Status</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
<?php
	foreach($aServico as $oServico){
?>
                    <tr>
                        <td><?=$oServico->idServico?></td>
					<td><?=$oServico->oSla->descricao?></td>
					<td><?=$oServico->oTipoServico->descricao?></td>
					<td><?=$oServico->descricao?></td>
					<td><?=$oServico->valor?></td>
					<td><?=$oServico->status?></td>
                        <td><a id="btnDetalhes" class="btn btn-info btn-small" href="#" title="Detalhes Servico" data-id="<?=$oServico->idServico;?>"><i class="icon-white icon-info-sign"></i></a></td>
                        <td><a class="btn btn-success btn-small" href="frmServico.php?idServico=<?=$oServico->idServico;?>" title="Editar"><i class="icon-white icon-edit"></i></a></td>
                        <td><a id="btnExcluir" data-id="idServico" data-id-valor="<?=$oServico->idServico;?>" class="btn btn-danger btn-small" href="javascript: void(0);" title="Excluir"><i class="icon-white icon-trash"></i></a></td>
                    </tr>
<?php
	}
?>
				<tr>
					<td colspan="9">
						<?php $oController->componentePaginacao($numPags);?>
					</td>
				</tr>
<?php
}
?>
                </tbody>
			</table>
<?php
if(!$aServico){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
        </div>
        <div id="push"></div>
        <input type="hidden" name="classe" id="classe" value="Servico" />
    </div>
    <?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php")?>
</body>
</html>