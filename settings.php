<?php 
require_once("classes/autoload.php");
$oController  = new Controller();

if($_POST){
    echo ($oController->saveSettings()) ? "" : $oController->msg;
}
?>
<!doctype html>
<html lang="pt">
<head>
	<?php include_once("includes/header.php");?>
</head>
<body>
	<?php include_once("includes/menu.php");?>
	<?php include_once("includes/loading.php");?>
	<main class=" container light">
        <blockquote class="border">
    		Settings 
        </blockquote>
        <form role="form" onsubmit="return false;">
             <div class="row">
                <div class="col s4">
                    <div class="input-field">
                        <input type="text" name="prodEquipe" id="prodEquipe" value=""  />    
                        <label for="prodEquipe">Produtividade Média da Equipe (PF/Dia)</label>
                    </div>
                </div>
                <div class="col s4">
                    <div class="input-field">
                        <input type="text" name="valorPf" id="valorPf" value=""  />    
                        <label for="valorPf">Valor do Ponto de Função (R$)</label>
                    </div>
                </div>
             </div>
<!--              
             <blockquote class="border">
    		Características Gerais de Sistema (CGS)
        	</blockquote>
             <div class="row">
                <div class="col s4">
                    <div class="input-field">
                        <select name="sgbd" id="sgbd">
    						<option value="" selected disabled>Select</option>
        					<option value="0">0 - Não presente ou sem influência</option>
        					<option value="1">1 - Influência Mínima</option>
    						<option value="2">2 - Influência Moderada</option>
    						<option value="3">3 - Influência Média</option>
    						<option value="4">4 - Influência Significativa</option>
    						<option value="5">5 - Forte Influência</option>
    					</select>    
                        <label for="dataHoraCadastro">CGS1 - Comunicação de dados</label>
                    </div>
                </div>
                <div class="col s4">
                    <div class="input-field">
                        <select name="sgbd" id="sgbd">
    						<option value="" selected disabled>Select</option>
        					<option value="0">0 - Não presente ou sem influência</option>
        					<option value="1">1 - Influência Mínima</option>
    						<option value="2">2 - Influência Moderada</option>
    						<option value="3">3 - Influência Média</option>
    						<option value="4">4 - Influência Significativa</option>
    						<option value="5">5 - Forte Influência</option>
    					</select>    
                        <label for="dataHoraCadastro">CGS2 - Processamento distribuído</label>
                    </div>
                </div>
                <div class="col s4">
                    <div class="input-field">
                        <select name="sgbd" id="sgbd">
        					<option value="" selected disabled>Select</option>
        					<option value="0">0 - Não presente ou sem influência</option>
        					<option value="1">1 - Influência Mínima</option>
    						<option value="2">2 - Influência Moderada</option>
    						<option value="3">3 - Influência Média</option>
    						<option value="4">4 - Influência Significativa</option>
    						<option value="5">5 - Forte Influência</option>
        				</select>    
                        <label for="dataHoraCadastro">CGS3 - Performance</label>
                    </div>
                </div>
                <div class="col s4">
                    <div class="input-field">
                        <select name="sgbd" id="sgbd">
    						<option value="" selected disabled>Select</option>
        					<option value="0">0 - Não presente ou sem influência</option>
        					<option value="1">1 - Influência Mínima</option>
    						<option value="2">2 - Influência Moderada</option>
    						<option value="3">3 - Influência Média</option>
    						<option value="4">4 - Influência Significativa</option>
    						<option value="5">5 - Forte Influência</option>
    					</select>    
                        <label for="dataHoraCadastro">CGS4 - Utilização de Equipamento</label>
                    </div>
                </div>
                <div class="col s4">
                    <div class="input-field">
                        <select name="sgbd" id="sgbd">
    						<option value="" selected disabled>Select</option>
        					<option value="0">0 - Não presente ou sem influência</option>
        					<option value="1">1 - Influência Mínima</option>
    						<option value="2">2 - Influência Moderada</option>
    						<option value="3">3 - Influência Média</option>
    						<option value="4">4 - Influência Significativa</option>
    						<option value="5">5 - Forte Influência</option>
    					</select>    
                        <label for="dataHoraCadastro">CGS5 - Volume de transações</label>
                    </div>
                </div>
                <div class="col s4">
                    <div class="input-field">
                        <select name="sgbd" id="sgbd">
    						<option value="" selected disabled>Select</option>
        					<option value="0">0 - Não presente ou sem influência</option>
        					<option value="1">1 - Influência Mínima</option>
    						<option value="2">2 - Influência Moderada</option>
    						<option value="3">3 - Influência Média</option>
    						<option value="4">4 - Influência Significativa</option>
    						<option value="5">5 - Forte Influência</option>
    					</select>    
                        <label for="dataHoraCadastro">CGS6 - Entrada de dados on-line</label>
                    </div>
                </div>
                <div class="col s4">
                    <div class="input-field">
                        <select name="sgbd" id="sgbd">
    						<option value="" selected disabled>Select</option>
        					<option value="0">0 - Não presente ou sem influência</option>
        					<option value="1">1 - Influência Mínima</option>
    						<option value="2">2 - Influência Moderada</option>
    						<option value="3">3 - Influência Média</option>
    						<option value="4">4 - Influência Significativa</option>
    						<option value="5">5 - Forte Influência</option>
    					</select>    
                        <label for="dataHoraCadastro">CGS7 - Eficiência do Usuário Final</label>
                    </div>
                </div>
                <div class="col s4">
                    <div class="input-field">
                        <select name="sgbd" id="sgbd">
    						<option value="" selected disabled>Select</option>
        					<option value="0">0 - Não presente ou sem influência</option>
        					<option value="1">1 - Influência Mínima</option>
    						<option value="2">2 - Influência Moderada</option>
    						<option value="3">3 - Influência Média</option>
    						<option value="4">4 - Influência Significativa</option>
    						<option value="5">5 - Forte Influência</option>
    					</select>    
                        <label for="dataHoraCadastro">CGS8 - Atualização On-Line</label>
                    </div>
                </div>
                <div class="col s4">
                    <div class="input-field">
                        <select name="sgbd" id="sgbd">
    						<option value="" selected disabled>Select</option>
        					<option value="0">0 - Não presente ou sem influência</option>
        					<option value="1">1 - Influência Mínima</option>
    						<option value="2">2 - Influência Moderada</option>
    						<option value="3">3 - Influência Média</option>
    						<option value="4">4 - Influência Significativa</option>
    						<option value="5">5 - Forte Influência</option>
    					</select>    
                        <label for="dataHoraCadastro">CGS9 - Processamento complexo</label>
                    </div>
                </div>
                <div class="col s4">
                    <div class="input-field">
                        <select name="sgbd" id="sgbd">
    						<option value="" selected disabled>Select</option>
        					<option value="0">0 - Não presente ou sem influência</option>
        					<option value="1">1 - Influência Mínima</option>
    						<option value="2">2 - Influência Moderada</option>
    						<option value="3">3 - Influência Média</option>
    						<option value="4">4 - Influência Significativa</option>
    						<option value="5">5 - Forte Influência</option>
    					</select>    
                        <label for="dataHoraCadastro">CGS10 - Reutilização de código</label>
                    </div>
                </div>
                <div class="col s4">
                    <div class="input-field">
                        <select name="sgbd" id="sgbd">
    						<option value="" selected disabled>Select</option>
        					<option value="0">0 - Não presente ou sem influência</option>
        					<option value="1">1 - Influência Mínima</option>
    						<option value="2">2 - Influência Moderada</option>
    						<option value="3">3 - Influência Média</option>
    						<option value="4">4 - Influência Significativa</option>
    						<option value="5">5 - Forte Influência</option>
    					</select>    
                        <label for="dataHoraCadastro">CGS11 - Facilidade de Implantação</label>
                    </div>
                </div>
                <div class="col s4">
                    <div class="input-field">
                        <select name="sgbd" id="sgbd">
        					<option value="" selected disabled>Select</option>
        					<option value="0">0 - Não presente ou sem influência</option>
        					<option value="1">1 - Influência Mínima</option>
    						<option value="2">2 - Influência Moderada</option>
    						<option value="3">3 - Influência Média</option>
    						<option value="4">4 - Influência Significativa</option>
    						<option value="5">5 - Forte Influência</option>
        				</select>    
                        <label for="dataHoraCadastro">CGS12 - Facilidade Operacional</label>
                    </div>
                </div>
                <div class="col s4">
                    <div class="input-field">
                        <select name="sgbd" id="sgbd">
    						<option value="" selected disabled>Select</option>
    						<option value="0">0 - Não presente ou sem influência</option>
        					<option value="1">1 - Influência Mínima</option>
    						<option value="2">2 - Influência Moderada</option>
    						<option value="3">3 - Influência Média</option>
    						<option value="4">4 - Influência Significativa</option>
    						<option value="5">5 - Forte Influência</option>
    					</select>
                        <label for="dataHoraCadastro">CGS13 - Múltiplos Locais</label>
                    </div>
                </div>
                <div class="col s4">
                    <div class="input-field">
                        <select name="sgbd" id="sgbd">
        					<option value="" selected disabled>Select</option>
        					<option value="0">0 - Não presente ou sem influência</option>
        					<option value="1">1 - Influência Mínima</option>
    						<option value="2">2 - Influência Moderada</option>
    						<option value="3">3 - Influência Média</option>
    						<option value="4">4 - Influência Significativa</option>
    						<option value="5">5 - Forte Influência</option>
        				</select>    
                        <label for="dataHoraCadastro">CGS14 - Facilidade de mudanças</label>
                    </div>
                </div>
            </div>
-->
            <div class="row">
                <div class="form-actions">
                    <button id="btnCadastrar" type="submit" class="btn btn-small tooltipped" data-position="top" data-tooltip="Save"><i class="material-icons">save</i> </button>
                    <a class="btn btn-small tooltipped" href="admPessoa.php" data-position="top" data-tooltip="Back"><i class="material-icons">arrow_back</i> </a>
                </div>
            </div>
        </form>
    </main>
	<?php include_once("includes/footer.php");?>
	<?php include_once("includes/modals.php");?>
	<?php include_once("includes/js.php");?>
</body>
</html>