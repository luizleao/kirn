<?php
require_once("classes/autoload.php");
$oController = new Controller%%NOME_CLASSE%%();
$numPags = $oController->numeroPaginasConsulta($oController->totalColecao());

if(isset($_REQUEST['acao']) && $_REQUEST['acao'] == 'excluir'){
    print ($oController->excluir(%%PK_REQUEST%%)) ? "" : $oController->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$a%%NOME_CLASSE%% = ($_POST) ? $oController->consultar($_REQUEST['txtConsulta']) : $oController->getAll([], ["%%PK%%"], $_REQUEST['pag']);
//Util::trace($a%%NOME_CLASSE%%);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <div id="wrap">
        <?php require_once("includes/menu.php");?>
        <br />
        <br />
        <div class="container">
            <?php require_once("includes/titulo.php"); ?>
            <ul class="breadcrumb">
                <li><a href="home.php">Home</a> <span class="divider">/</span></li>
                <li class="active">Administrar %%NOME_CLASSE%%</li>
            </ul>
            <form action="" method="post">
	            <div class="row">
	            	<div class="span12">
			            <div class="input-append">
							<input type="text" class="span8" id="txtConsulta" name="txtConsulta" placeholder="Pesquisar %%NOME_CLASSE%%" value="<?=$_REQUEST['txtConsulta'] ?? NULL ?>" autofocus />
							<button class="btn btn-primary" type="submit"><i class="icon-white icon-search"></i></button>
							<a href="frm%%NOME_CLASSE%%.php" class="btn btn-success" title="Cadastrar"><i class="icon-white icon-plus"></i></a>
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
if($a%%NOME_CLASSE%%){
?>
	
                <thead>
                    <tr>
                        %%TITULOATRIBUTOS%%
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
<?php
	foreach($a%%NOME_CLASSE%% as $o%%NOME_CLASSE%%){
?>
                    <tr>
                        %%VALORATRIBUTOS%%
                        %%ADM_INFO%%
                        %%ADM_EDIT%%
                        %%ADM_DELETE%%
                    </tr>
<?php
	}
?>
				<tr>
					<td colspan="%%NUMERO_COLUNAS%%">
						<?php $oController->componentePaginacao($numPags);?>
					</td>
				</tr>
<?php
}
?>
                </tbody>
			</table>
<?php
if(!$a%%NOME_CLASSE%%){
	$oController->componenteMsg("Não há registros cadastrados", "info");
}
?>
        </div>
        <div id="push"></div>
        <input type="hidden" name="classe" id="classe" value="%%NOME_CLASSE%%" />
    </div>
    <?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php")?>
</body>
</html>