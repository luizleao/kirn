<?php
require_once("classes/autoload.php");
$oController = new ControllerPatrimonioTicket();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['idPatrimonioTicket'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aPatrimonioTicket = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["PatrimonioTicket.idPatrimonioTicket"], $_REQUEST['pag']);
//Util::trace($aPatrimonioTicket);
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
                <li class="active">Administrar PatrimonioTicket</li>
            </ul>
            <form action="" method="post">
	            <div class="row">
	            	<div class="span12">
			            <div class="input-append">
							<input type="text" class="span8" id="txtConsulta" name="txtConsulta" placeholder="Pesquisar PatrimonioTicket" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
							<button class="btn btn-primary" type="submit"><i class="icon-white icon-search"></i></button>
							<a href="frmPatrimonioTicket.php" class="btn btn-success" title="Cadastrar"><i class="icon-white icon-plus"></i></a>
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
if($aPatrimonioTicket){
?>
	
                <thead>
                    <tr>
                        <th>Id</th>
					<th>Ticket</th>
					<th>Tombamento</th>
					<th>Status</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
<?php
	foreach($aPatrimonioTicket as $oPatrimonioTicket){
?>
                    <tr>
                        <td><?=$oPatrimonioTicket->idPatrimonioTicket?></td>
					<td><?=$oPatrimonioTicket->oTicket->idTicket?></td>
					<td><?=$oPatrimonioTicket->tombamento?></td>
					<td><?=$oPatrimonioTicket->status?></td>
                        <td><a id="btnDetalhes" class="btn btn-info btn-small" href="#" title="Detalhes PatrimonioTicket" data-id="<?=$oPatrimonioTicket->idPatrimonioTicket;?>"><i class="icon-white icon-info-sign"></i></a></td>
                        <td><a class="btn btn-success btn-small" href="frmPatrimonioTicket.php?idPatrimonioTicket=<?=$oPatrimonioTicket->idPatrimonioTicket;?>" title="Editar"><i class="icon-white icon-edit"></i></a></td>
                        <td><a id="btnExcluir" data-id="idPatrimonioTicket" data-id-valor="<?=$oPatrimonioTicket->idPatrimonioTicket;?>" class="btn btn-danger btn-small" href="javascript: void(0);" title="Excluir"><i class="icon-white icon-trash"></i></a></td>
                    </tr>
<?php
	}
?>
				<tr>
					<td colspan="7">
						<?php $oController->componentePaginacao($numPags);?>
					</td>
				</tr>
<?php
}
?>
                </tbody>
			</table>
<?php
if(!$aPatrimonioTicket){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
        </div>
        <div id="push"></div>
        <input type="hidden" name="classe" id="classe" value="PatrimonioTicket" />
    </div>
    <?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php")?>
</body>
</html>