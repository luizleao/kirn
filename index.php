<?php
require_once ("classes/Autoload.php");
$oController = new Controller();
$aXML = $oController->getAllXML();

if (isset($_REQUEST['acao'])) {
    switch ($_REQUEST['acao']) {
        case "xml":
            echo ($oController->gerarXML($_REQUEST['sgbd'], $_REQUEST['host'], $_REQUEST['login'], $_REQUEST['senha'], $_REQUEST['database'])) ? "" : $oController->msg;
            exit();
            break;

        case "gerar":
            // echo Util::trace($_REQUEST); exit;
            echo $oController->gerarArtefatos($_REQUEST['xml'], $_REQUEST['gui'], false);
            exit();
            break;

        case "excluirXML":
            echo $oController->excluirXML($_REQUEST['xml']);
            exit();
            break;

        case "download":
            echo $oController->downloadProjeto($_REQUEST['app']);
            exit();
            break;
    }
}
?>
<!doctype html>
<html lang="pt">

<head>
	<?php include_once("includes/header.php"); ?>
</head>

<body>
	<?php include_once("includes/menu.php"); ?>
	<?php include_once("includes/loading.php"); ?>
	<main>	
		<form onsubmit="return false;">
			<div class="row">
				<div class="col m6 s12">
					<div class="row">
						<div class="col s12">
							<div class="card">
								<div class="card-content">
									<label class="teal-text lighten-2-text">Database Connect</label>
									<div class="input-field">
										<select name="sgbd" id="sgbd">
											<option value="" selected disabled>Source DBMS</option>
											<option value="mysql">MySQL</option>
											<option value="sqlserver">SQL Server</option>
											<option value="postgre">PostgreSQL</option>
										</select>
									</div>
									<div class="row">
										<div class="input-field col s3">
											<input type="text" id="host" name="host" value="" />
											<label for="host">Host</label> 
										</div>
										<div class="input-field col s3">
											<input type="text" id="login" name="login" value="" /> <label for="login">User</label>
										</div>
										<div class="input-field col s4">
											<input type="password" id="senha" name="senha" value="" /> <label for="senha">Password</label>
										</div>
										<div class="input-field col s2">
											<button id="btnConectar" type="submit"
												class="btn btn-small btn-flat">
												<i class="material-icons">arrow_forward</i>
											</button>

										</div>
									</div>
									<div class="row">
										<div class="input-field col s9">
											<select name="database" id="database" class=""></select> 
											<label for="database">Database</label>
										</div>
										<div class="input-field col s1">
											<button id="btnGerarXml" type="submit" class="btn btn-small">XML</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--    				
                    <div class="row">
        				<div class="col s12">
        					<div class="card">
            					<div class="card-content">
            						<label class="teal-text lighten-2-text">Upload Model</label>
            						<div class="row">
                                        <div class="input-field col s9">
                                            <div class="file-field input-field">
                                            	<div class="btn">
                                                      <i class="material-icons">attach_file</i>
                                                    <input type="file">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text">
                                                </div>
                                        	</div>
                                        </div>
                                    </div>
            					</div>
            				</div>
        				</div>
    				</div>  -->
				</div>
				<div class="col m6 s12">
					<div class="card">
						<div class="card-content">
							<label class="teal-text lighten-2-text">Mapped Schemas</label>
							<div class="row">
								<table class="striped table-responsive">
<?php
        if($aXML){
?>
									<tbody>
<?php
            foreach($aXML as $xml){
?>
										<tr>
											<td><?= ucfirst($xml) ?></td>
											<td>
											<a class="dropdown-trigger btn btn-flat btn-small" href="#" data-target="btnMenuOptions<?= $xml ?>">
												<i class="material-icons">more_horiz</i></a>
												<ul id="btnMenuOptions<?= $xml ?>" class="dropdown-content">
													<li><a href="xml/<?= $xml ?>.xml?" target="_blank"><i class="material-icons">insert_link</i> Ver KML</a></li>
													<li><a href="#" target="_blank"><i class="material-icons tiny">edit</i> Editar KML</a></li>
													<li><a id="btnExcluirXML" data-xml="<?= $xml ?>" href="#"><i class="material-icons">delete</i> Excluir KML</a></li>
<?php
                if(file_exists("geradas/$xml")){
?>
													<li class="divider"></li>
													<li><a href="report.php?xml=<?= $xml ?>"><i class="material-icons">info</i> Relatório do Projeto</a></li>
													<li><a href="geradas/<?= $xml ?>/" target="_blank"><i class="material-icons tiny">open_in_browser</i> Abrir</a></li>
													<li><a href="?acao=download&app=<?= $xml ?>" target="_blank"><i class="material-icons tiny">cloud_download</i> Download</a></li>
<?php
                }
?>
												</ul>
											</td>
											<td>
												<a class="dropdown-trigger btn btn-flat btn-small" href="#" data-target="btnMenu<?= $xml ?>">
													<i class="material-icons">settings</i>
												</a>
												<ul id="btnMenu<?= $xml ?>" class="dropdown-content">
													<li>
														<a href="#" id="btnGerarArtefatos" data-xml="<?= $xml ?>" data-gui="bootstrap2">
														<img src="img/icon-bootstrap2.png" alt="Bootstrap 2" /> Bootstrap 2</a>
													</li>
													<li>
														<a href="#" id="btnGerarArtefatos" data-xml="<?= $xml ?>" data-gui="bootstrap3">
														<img src="img/icon-bootstrap3.png" alt="Bootstrap 3" /> Bootstrap 3</a>
													</li>
													<li>
														<a href="#" id="btnGerarArtefatos" data-xml="<?= $xml ?>" data-gui="bootstrap4">
														<img src="img/icon-bootstrap4.png" alt="Bootstrap 4" /> Bootstrap 4</a>
													</li>
													<li>
														<a href="#" id="btnGerarArtefatos" data-xml="<?= $xml ?>" data-gui="bootstrap5">
														<img src="img/icon-bootstrap5.png" alt="Bootstrap 5" /> Bootstrap 5</a>
													</li>
													<li>
														<a href="#" id="btnGerarArtefatos" data-xml="<?= $xml ?>" data-gui="materialize">
														<img src="img/icon-materialize.png" alt="Materialize 1.0" /> Materialize 1.0</a>
													</li>
													<li>
														<a href="#" id="btnGerarArtefatos" data-xml="<?= $xml ?>" data-gui="milligram">
														<img src="img/icon-milligram-32x32.png" alt="Milligram 1.3.0" /> Milligram 1.3.0</a>
													</li>
													<li>
														<a href="#" id="btnGerarArtefatos" data-xml="<?= $xml ?>" data-gui="ionic">
														<img src="img/icon-ionic-16x16.png" alt="Ionic 3" /> Ionic 3</a>
													</li>
												</ul>
											</td>
										</tr>
<?php
            }
?>
										</tbody>
<?php
        } else {
?>
										<tr>
										<td>No project finded.</td>
									</tr>
<?php
									}
?>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</form>
	</main>
	<?php include_once("includes/footer.php"); ?>
	<?php include_once("includes/modals.php"); ?>
	<?php include_once("includes/js.php"); ?>
</body>
</html>