<?php
require_once("classes/autoload.php");
$oController = new ControllerTicket();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['idTicket'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aTicket = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["Ticket.idTicket"], $_REQUEST['pag']);
//Util::trace($aTicket);
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
                <li class="active">Administrar Ticket</li>
            </ul>
            <form action="" method="post">
	            <div class="row">
	            	<div class="span12">
			            <div class="input-append">
							<input type="text" class="span8" id="txtConsulta" name="txtConsulta" placeholder="Pesquisar Ticket" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
							<button class="btn btn-primary" type="submit"><i class="icon-white icon-search"></i></button>
							<a href="frmTicket.php" class="btn btn-success" title="Cadastrar"><i class="icon-white icon-plus"></i></a>
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
if($aTicket){
?>
	
                <thead>
                    <tr>
                        <th>Id</th>
					<th>Servico</th>
					<th>Cd_servidor_solicitante</th>
					<th>Cd_servidor_recebimento</th>
					<th>Numero</th>
					<th>Descricao</th>
					<th>DataHoraAbertura</th>
					<th>FlagAprovado</th>
					<th>FlagAtendido</th>
					<th>FlagExecutado</th>
					<th>Status</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
<?php
	foreach($aTicket as $oTicket){
?>
                    <tr>
                        <td><?=$oTicket->idTicket?></td>
					<td><?=$oTicket->oServico->descricao?></td>
					<td><?=$oTicket->cd_servidor_solicitante?></td>
					<td><?=$oTicket->cd_servidor_recebimento?></td>
					<td><?=$oTicket->numero?></td>
					<td><?=$oTicket->descricao?></td>
					<td><?=Util::formataDataHoraBancoForm($oTicket->dataHoraAbertura)?></td>
					<td><?=$oTicket->flagAprovado?></td>
					<td><?=$oTicket->flagAtendido?></td>
					<td><?=$oTicket->flagExecutado?></td>
					<td><?=$oTicket->status?></td>
                        <td><a id="btnDetalhes" class="btn btn-info btn-small" href="#" title="Detalhes Ticket" data-id="<?=$oTicket->idTicket;?>"><i class="icon-white icon-info-sign"></i></a></td>
                        <td><a class="btn btn-success btn-small" href="frmTicket.php?idTicket=<?=$oTicket->idTicket;?>" title="Editar"><i class="icon-white icon-edit"></i></a></td>
                        <td><a id="btnExcluir" data-id="idTicket" data-id-valor="<?=$oTicket->idTicket;?>" class="btn btn-danger btn-small" href="javascript: void(0);" title="Excluir"><i class="icon-white icon-trash"></i></a></td>
                    </tr>
<?php
	}
?>
				<tr>
					<td colspan="14">
						<?php $oController->componentePaginacao($numPags);?>
					</td>
				</tr>
<?php
}
?>
                </tbody>
			</table>
<?php
if(!$aTicket){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
        </div>
        <div id="push"></div>
        <input type="hidden" name="classe" id="classe" value="Ticket" />
    </div>
    <?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php")?>
</body>
</html>