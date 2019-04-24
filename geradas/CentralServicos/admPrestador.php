<?php
require_once("classes/autoload.php");
$oController = new ControllerPrestador();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if($_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir($_REQUEST['idPrestador'])) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$aPrestador = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["Prestador.idPrestador"], $_REQUEST['pag']);
//Util::trace($aPrestador);
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
                <li class="active">Administrar Prestador</li>
            </ul>
            <form action="" method="post">
	            <div class="row">
	            	<div class="span12">
			            <div class="input-append">
							<input type="text" class="span8" id="txtConsulta" name="txtConsulta" placeholder="Pesquisar Prestador" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
							<button class="btn btn-primary" type="submit"><i class="icon-white icon-search"></i></button>
							<a href="frmPrestador.php" class="btn btn-success" title="Cadastrar"><i class="icon-white icon-plus"></i></a>
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
if($aPrestador){
?>
	
                <thead>
                    <tr>
                        <th>Id</th>
					<th>NaturezaContratual</th>
					<th>Nome</th>
					<th>NumeroContrato</th>
					<th>NomePreposto</th>
					<th>ContatoPreposto</th>
					<th>Usuario</th>
					<th>Senha</th>
					<th>Email</th>
					<th>Status</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
<?php
	foreach($aPrestador as $oPrestador){
?>
                    <tr>
                        <td><?=$oPrestador->idPrestador?></td>
					<td><?=$oPrestador->oNaturezaContratual->descricao?></td>
					<td><?=$oPrestador->nome?></td>
					<td><?=$oPrestador->numeroContrato?></td>
					<td><?=$oPrestador->nomePreposto?></td>
					<td><?=$oPrestador->contatoPreposto?></td>
					<td><?=$oPrestador->usuario?></td>
					<td><?=$oPrestador->senha?></td>
					<td><?=$oPrestador->email?></td>
					<td><?=$oPrestador->status?></td>
                        <td><a id="btnDetalhes" class="btn btn-info btn-small" href="#" title="Detalhes Prestador" data-id="<?=$oPrestador->idPrestador;?>"><i class="icon-white icon-info-sign"></i></a></td>
                        <td><a class="btn btn-success btn-small" href="frmPrestador.php?idPrestador=<?=$oPrestador->idPrestador;?>" title="Editar"><i class="icon-white icon-edit"></i></a></td>
                        <td><a id="btnExcluir" data-id="idPrestador" data-id-valor="<?=$oPrestador->idPrestador;?>" class="btn btn-danger btn-small" href="javascript: void(0);" title="Excluir"><i class="icon-white icon-trash"></i></a></td>
                    </tr>
<?php
	}
?>
				<tr>
					<td colspan="13">
						<?php $oController->componentePaginacao($numPags);?>
					</td>
				</tr>
<?php
}
?>
                </tbody>
			</table>
<?php
if(!$aPrestador){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
        </div>
        <div id="push"></div>
        <input type="hidden" name="classe" id="classe" value="Prestador" />
    </div>
    <?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php")?>
</body>
</html>