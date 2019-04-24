<?php
require_once('autoload.php');
/**
 * Class Geracao | classes/Geracao.class.php
 *
 * @package     classes
 * @author      Luiz Leão <luizleao@gmail.com>
 * @version     v.2.1 (06/12/2018)
 * @copyright   Copyright (c) 2018, Luiz
 */
/**
 * Classe Geração
 *
 * Responsável pela construção dos artefatos de software
 *
 * @author Luiz Leão <luizleao@gmail.com>
 */
class Geracao {
	/**
     * Nome do Projeto
     * 
     * @var string 
     */
    public $projeto;
    
    /**
     * Arquivo XML que contém o schema de dados
     * 
     * @var string 
     */
    public $xml;
    
    /**
     * Tipo de GUI (Graphic User Interface)
     * 
     * @var string 
     */
    public $gui;
    
    /**
     * Método construtor
     * 
     * @param string $xml arquivo xml
     * @param string $gui modelo de GUI escolhido
     * @param string $projeto nome do projeto
     * @return void
     */
    function __construct($xml, $gui=NULL, $projeto=NULL){
        $this->projeto = $projeto;
        $this->xml     = join(file($xml),"");
        $this->gui     = $gui;
        
        if($projeto != NULL){
            $dir = dirname(dirname(__FILE__))."/geradas";
            if(!file_exists($dir)) mkdir($dir);

            $dir = dirname(dirname(__FILE__))."/geradas/".$this->projeto;
            if(!file_exists($dir)) mkdir($dir);

            $dir = dirname(dirname(__FILE__))."/geradas/".$this->projeto."/classes";
            if(!file_exists($dir)) mkdir($dir);

            $dir = dirname(dirname(__FILE__))."/geradas/".$this->projeto."/classes/core";
            if(!file_exists($dir)) mkdir($dir);
        }
        
        //Util::trace($this);
    }

    /**
     * Geracao das Classes Basicas
     * 
     * @return bool
     */
    function geraClassesBasicas(){
        # Abre o template da classe basica e armazena conteudo do modelo
        $modelo = Util::getConteudoTemplate('Modelo.class.tpl');

        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);
        //print_r($aBanco);
        # varre a estrutura das tabelas
        foreach($aBanco as $aTabela){
            $copiaModelo = $modelo;
            $nomeClasse  = ucfirst($this->getCamelMode($aTabela['NOME']));
            # Varre a estrutura dos campos da tabela em questao
            $aAtributo = $aListaAtributo = $aAtribuicao = array();
            foreach($aTabela as $oCampo){
                $nomeCampo 	  = (string)$oCampo['NOME'];
                if((string)$oCampo['FKTABELA'] != ''){
                    # Processa nome original da tabela estrangeira
                    $nomeFKClasse = ucfirst($this->getCamelMode((string)$oCampo['FKTABELA']));
                    
//					if($nomeFKClasse == $nomeClasse){
						$nomeCampo = "o".ucfirst(preg_replace("#^(?:id_?|cd_?)(.*?)#is", "$1", $nomeCampo));
//					}
//					else {
						$nomeCampo = "o$nomeFKClasse";
//                    }
                }

                # Atribui resultados
                $aAtributo[] 	  = "\tpublic \$$nomeCampo;";
                $aListaAtributo[] = ($oCampo['FKTABELA'] != '') ? "$nomeFKClasse \$$nomeCampo = NULL" : "\$$nomeCampo = NULL";
                $auxAtributos     = ($oCampo['FKTABELA'] != '') ? "\$this->$nomeCampo = (\$$nomeCampo == NULL) ? new $nomeFKClasse() : \$$nomeCampo;" : "\$this->$nomeCampo = \$$nomeCampo;";
                $aAtribuicao[]    = "\t\t$auxAtributos";
            }

            # Monta demais valores a serem substituidos
            $atributos      = join($aAtributo,"\n");
            $listaAtributos = join(", ",   $aListaAtributo);
            $atribuicao     = join("\n",   $aAtribuicao);

            # Substitui todas os parametros pelas variaveis ja processadas
            $copiaModelo = str_replace('%%NOME_CLASSE%%',     $nomeClasse,     $copiaModelo);
            $copiaModelo = str_replace('%%ATRIBUTOS%%',       $atributos,      $copiaModelo);
            $copiaModelo = str_replace('%%LISTA_ATRIBUTOS%%', $listaAtributos, $copiaModelo);
            $copiaModelo = str_replace('%%ATRIBUICAO%%',      $atribuicao,     $copiaModelo);
            $copiaModelo = str_replace('%%TOSTRING%%',        $this->getTituloObjeto((string)$aTabela['NOME']), $copiaModelo);

            $dir = dirname(dirname(__FILE__))."/geradas/".$this->projeto."/classes/core/model";
            if(!file_exists($dir)) 
                mkdir($dir);

            $fp = fopen("$dir/$nomeClasse.class.php","w");
            fputs($fp, $copiaModelo);
            fclose($fp);
        }
        return true;	
    }
    
    /**
     * Geracao das Controllers das Classes de negócio
     *
     * @access public
     * @return bool
     */
    public function geraClasseController(){
        # Abre o template da classe Controle e armazena conteudo do modelo
        $modeloController = Util::getConteudoTemplate('Modelo.Controller.class.tpl');
        
        # Abre o template dos metodos de cadastros e armazena conteudo do modelo
        $modeloCadastrar    = Util::getConteudoTemplate('metodoCadastrar.tpl');
        $modeloAlterar    	= Util::getConteudoTemplate('metodoAlterar.tpl');
        $modeloExcluir     	= Util::getConteudoTemplate('metodoExcluir.tpl');
        $modeloGet 			= Util::getConteudoTemplate('metodoGet.tpl');
        $modeloGetAll     	= Util::getConteudoTemplate('metodoGetAll.tpl');
        $modeloConsultar  	= Util::getConteudoTemplate('metodoConsultar.tpl');
        $modeloTotalColecao = Util::getConteudoTemplate('metodoTotalColecao.tpl');
        
        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);
        
        # Varre a estrutura das tabelas
        $copiaModeloController = $modeloController;
        
        //Util::trace($aBanco);exit;
        
        foreach($aBanco as $aTabela){
            //Util::trace($aTabela);

            $aPKDoc = $aPK = [];
            
            foreach($aTabela as $oCampo){
                if($oCampo['CHAVE'] == '1'){
                    $aPKDoc[] = "\t * @param integer \$".$oCampo['NOME'];
                    $aPK[]    = "\$".$oCampo['NOME'];
                }
            }
            
            # Montar a Lista de DOC do metodo selecionar
            $listaPKDoc = join("\n", $aPKDoc);
            $listaPK    = join(",", $aPK);
            
            # Recupera o nome da tabela e gera os valores a serem gerados
            $nomeClasse = ucfirst($this->getCamelMode($aTabela['NOME']));
            
            //Util::trace($nomeClasse);

            $montaObjetoCAD   = $this->getObjetosMontados($aTabela['NOME']);
            $montaObjetoEDIT  = $this->getObjetosMontados($aTabela['NOME'], "edit");
            
            $montaObjetoBD = $this->getObjetoBDMontado($aTabela['NOME']);
            
            # Cadastrar
            $copiaModeloCadastrar = str_replace('%%NOME_CLASSE%%',    $nomeClasse, $modeloCadastrar);
            $copiaModeloCadastrar = str_replace('%%MONTA_OBJETO%%',   $montaObjetoCAD,  $copiaModeloCadastrar);
            $copiaModeloCadastrar = str_replace('%%MONTA_OBJETOBD%%', $montaObjetoBD,   $copiaModeloCadastrar);

            # Alterar
            $copiaModeloAlterar   = str_replace('%%NOME_CLASSE%%',    $nomeClasse,      $modeloAlterar);
            $copiaModeloAlterar	  = str_replace('%%MONTA_OBJETO%%',   $montaObjetoEDIT, $copiaModeloAlterar);
            $copiaModeloAlterar   = str_replace('%%MONTA_OBJETOBD%%', $montaObjetoBD,   $copiaModeloAlterar);
            
            # Excluir
            $copiaModeloExcluir   = str_replace('%%NOME_CLASSE%%',    $nomeClasse,    $modeloExcluir);
            $copiaModeloExcluir   = str_replace('%%MONTA_OBJETOBD%%', $montaObjetoBD, $copiaModeloExcluir);
            
            # Get
            $copiaModeloGet  	  = str_replace('%%NOME_CLASSE%%',    $nomeClasse,    $modeloGet);
            $copiaModeloGet       = str_replace('%%MONTA_OBJETOBD%%', $montaObjetoBD, $copiaModeloGet);
            $copiaModeloGet       = str_replace('%%DOC_LISTA_PK%%',   $listaPKDoc,    $copiaModeloGet);
            $copiaModeloGet       = str_replace('%%LISTA_PK%%', 	  $listaPK,       $copiaModeloGet);
            
            # GetAll
            $copiaModeloGetAll    = str_replace('%%NOME_CLASSE%%', $nomeClasse,    $modeloGetAll);
            $copiaModeloGetAll    = str_replace('%%MONTA_OBJETOBD%%', $montaObjetoBD, $copiaModeloGetAll);
            
            # Consultar
            $copiaModeloConsultar = str_replace('%%NOME_CLASSE%%', $nomeClasse,    $modeloConsultar);
            $copiaModeloConsultar = str_replace('%%MONTA_OBJETOBD%%', $montaObjetoBD, $copiaModeloConsultar);

            # Total Colecao
            $copiaModeloTotalColecao = str_replace('%%NOME_CLASSE%%', $nomeClasse, $modeloTotalColecao);
            
            # ==== Geração das Controllers das Classes =====
            $copiaModeloController = str_replace('%%NOME_CLASSE%%',	  $nomeClasse,		  	 	$modeloController);
            $copiaModeloController = str_replace('%%METODO_CREATE%%', $copiaModeloCadastrar, 	$copiaModeloController);
            $copiaModeloController = str_replace('%%METODO_UPDATE%%', $copiaModeloAlterar,	 	$copiaModeloController);
            $copiaModeloController = str_replace('%%METODO_DEL%%',    $copiaModeloExcluir,	 	$copiaModeloController);
            $copiaModeloController = str_replace('%%METODO_GET%%',	  $copiaModeloGet,		 	$copiaModeloController);
            $copiaModeloController = str_replace('%%METODO_GETALL%%', $copiaModeloGetAll,	    $copiaModeloController);
            $copiaModeloController = str_replace('%%METODO_SEARCH%%', $copiaModeloConsultar,    $copiaModeloController);
            $copiaModeloController = str_replace('%%METODO_TOTAL%%',  $copiaModeloTotalColecao, $copiaModeloController);
            
            //Util::trace($copiaModeloController);
            //Util::trace($copiaModeloCadastrar);
            
            $dir = dirname(dirname(__FILE__))."/geradas/".$this->projeto."/classes";
            if(!file_exists($dir)) mkdir($dir);
            
            //echo "@@".$dir; 
            
            $fController = fopen("$dir/Controller$nomeClasse.class.php","w");
            fputs($fController, $copiaModeloController);
            fclose($fController);
            
            //Util::trace($copiaModeloController);
            //Util::trace("$dir/Controller$nomeClasse.class.php");
        }
                
        # ============ Adicionando Classes de core/Config =========
        $modeloConfig = Util::getConteudoTemplate("Modelo.Config.".$aBanco['SGBD'].".tpl");
        $modeloConfig = str_replace('%%DATABASE%%', $this->projeto, $modeloConfig);
        $modeloConfig = str_replace('%%HOST%%', $aBanco['HOST'], $modeloConfig);
        $modeloConfig = str_replace('%%USER%%', $aBanco['USER'], $modeloConfig);
        $modeloConfig = str_replace('%%SENHA%%', $aBanco['SENHA'], $modeloConfig);
        
        $fpConfig = fopen("$dir/core/config.ini","w");
        
        //echo "@@$dir/core/config.ini";
        
        fputs($fpConfig, $modeloConfig); 
        fclose($fpConfig);
        
        //copy(dirname(__FILE__)."/MAP.class.php", "$dir/core/MAP.class.php");
        copy(dirname(dirname(__FILE__))."/templates/Controller.class.php", "$dir/Controller.class.php");
        copy(dirname(__FILE__)."/autoload.php",                            "$dir/autoload.php");
        copy(dirname(__FILE__)."/Util.class.php",	                       "$dir/core/Util.class.php");
        copy(dirname(__FILE__)."/Conexao.class.php",                       "$dir/core/Conexao.class.php");
        
        return true;
    }

    /**
     * Geracao da Classe Validador Formulario
     *
     * @return bool
     */
    function geraClasseValidadorFormulario(){
        # Abre o template da classe basica e armazena conteudo do modelo
        $modelo1 = Util::getConteudoTemplate('Modelo.ValidadorFormulario.class.tpl');
        $modelo2 = Util::getConteudoTemplate('metodoValidaForm.tpl');

        # abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);
        $aModeloFinal = array();
        
        # varre a estrutura das tabelas
        foreach($aBanco as $aTabela){
            $nomeClasse = ucfirst($this->getCamelMode((string)$aTabela['NOME']));
            $copiaModelo1 = $modelo1;
            $copiaModelo2 = $modelo2;

            # ==== varre a estrutura dos campos da tabela em questao ====
            $camposForm = array();
            foreach($aTabela as $oCampo){
                # recupera campo e tabela e campos (chave estrangeira)
                $nomeCampoOriginal = (string)$oCampo['NOME'];
                # processa nome original da tabela estrangeira
                $nomeFKClasse = (string)$oCampo['FKTABELA'];

                # monta parametros a serem substituidos posteriormente
                $label = ($nomeFKClasse != '') ? ucfirst(strtolower($nomeFKClasse)) : ucfirst(str_replace($nomeClasse,"",$nomeCampoOriginal));
                $camposForm[] = ((int)$oCampo['CHAVE'] == 1) ? "if(\$acao == 2){\n\t\t\tif(\$$nomeCampoOriginal == ''){\n\t\t\t\t\$this->msg = \"$label inválido!\";\n\t\t\t\treturn false;\n\t\t\t}\n\t\t}" : "if(\$$nomeCampoOriginal == ''){\n\t\t\t\$this->msg = \"$label inválido!\";\n\t\t\treturn false;\n\t\t}\t";
            }
            # monta demais valores a serem substituidos
            $camposForm = join($camposForm,"\n\t\t");

            # substitui todas os parametros pelas variaveis já processadas
            $copiaModelo2 = str_replace('%%NOME_CLASSE%%', $nomeClasse, $copiaModelo2);
            $copiaModelo2 = str_replace('%%ATRIBUICAO%%',  $camposForm, $copiaModelo2);

            $aModeloFinal[] = $copiaModelo2;
        }

        $modeloFinal = str_replace('%%FUNCOES%%', join("\n\n", $aModeloFinal), $copiaModelo1);

        $dir = dirname(dirname(__FILE__))."/geradas/".$this->projeto."/classes";
        if(!file_exists($dir)) mkdir($dir);

        $fp = fopen("$dir/ValidadorFormulario.class.php","w"); fputs($fp, $modeloFinal); fclose($fp);

        return true;	
    }

    /**
     * Geracao da Classe Dados Formulario
     *
     * @return bool
     */
    function geraClasseDadosFormulario(){
        # Abre o template da classe basica e armazena conteudo do modelo
        $modelo1 = Util::getConteudoTemplate('Modelo.DadosFormulario.class.tpl');
        $modelo2 = Util::getConteudoTemplate('metodoDadosForm.tpl');

        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);

        $aModeloFinal = [];

        # Varre a estrutura das tabelas
        foreach($aBanco as $aTabela){
            $nomeClasse = ucfirst($this->getCamelMode($aTabela['NOME']));

            $copiaModelo1 = $modelo1;
            $copiaModelo2 = $modelo2;

            # varre a estrutura dos campos da tabela em questao
            $camposForm = array();
            foreach($aTabela as $oCampo){
                # recupera campo e tabela e campos (chave estrangeira)
                $nomeCampoOriginal = (string)$oCampo['NOME'];
                
                # monta parametros a serem substituidos posteriormente
                switch ((string)$oCampo['TIPO']) {
                    case 'date':
                        $camposForm[] = "\$post[\"$nomeCampoOriginal\"] = Util::formataDataFormBanco(strip_tags(addslashes(trim(\$post[\"$nomeCampoOriginal\"]))));";
                    break;

                    case 'datetime':
                    case 'timestamp':
                        $camposForm[] = "\$post[\"$nomeCampoOriginal\"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim(\$post[\"$nomeCampoOriginal\"]))));";
                    break;

                    default:
                    	if(preg_match("#decimal#i", $oCampo['TIPO'])){
                    		if(preg_match("#(?:preco|valor)#i", $oCampo['NOME'])){
                    			$camposForm[] = "\$post[\"$nomeCampoOriginal\"] = Util::formataMoedaBanco(strip_tags(addslashes(trim(\$post[\"$nomeCampoOriginal\"]))));";
                    		}
                    	} else {
                    		
	                        if((int)$oCampo['CHAVE'] == 1)
	                            if((string)$aTabela['TIPO_TABELA'] != 'NORMAL')
	                                $camposForm[] = "\$post[\"$nomeCampoOriginal\"] = strip_tags(addslashes(trim(\$post[\"$nomeCampoOriginal\"])));";
	                            else
	                                $camposForm[] = "if(\$acao == 2){\n\t\t\t\$post[\"$nomeCampoOriginal\"] = strip_tags(addslashes(trim(\$post[\"$nomeCampoOriginal\"])));\n\t\t}";
	                        else
	                            $camposForm[] = "\$post[\"$nomeCampoOriginal\"] = strip_tags(addslashes(trim(\$post[\"$nomeCampoOriginal\"])));";
                    	}
                    break;
                }
            }
            # monta demais valores a serem substituidos
            $camposForm = join($camposForm,"\n\t\t");

            # substitui todas os parametros pelas variaveis ja processadas
            $copiaModelo2 = str_replace('%%NOME_CLASSE%%', $nomeClasse, $copiaModelo2);
            $copiaModelo2 = str_replace('%%ATRIBUICAO%%', $camposForm, $copiaModelo2);

            $aModeloFinal[] = $copiaModelo2;
            //echo $copiaModelo2."<br />";
        }
        
        //Util::trace($aModeloFinal); 
        
        $modeloFinal = str_replace('%%FUNCOES%%', join("\n\n", $aModeloFinal), $copiaModelo1);
        
        $dir = dirname(dirname(__FILE__))."/geradas/".$this->projeto."/classes";
        if(!file_exists($dir)) 
            mkdir($dir);

        $fp = fopen("$dir/DadosFormulario.class.php","w");
        fputs($fp, $modeloFinal);
        fclose($fp);
        return true;	
    }	

    /**
     * Geracao das Interfaces do sistema
     *
     * @access public
     * @return bool
     */
    public function geraInterface(){
        # Abre o template da classe basica e armazena conteudo do modelo
        $modeloAdm    = Util::getConteudoTemplate($this->gui.'/Modelo.adm.tpl');
        $modeloFrm    = Util::getConteudoTemplate($this->gui.'/Modelo.frm.tpl');
        $modeloDetail = Util::getConteudoTemplate($this->gui.'/Modelo.detail.tpl');

        $dir = '';

        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);

        # Varre a estrutura das tabelas
        foreach($aBanco as $aTabela){
            // === Nao gerar interface de tabelas n:m
            if((string)$aTabela['TIPO_TABELA'] == 'N:M')
                continue;

            $copiaModeloAdm    = $modeloAdm;
            $copiaModeloFrm    = $modeloFrm;
            $copiaModeloDetail = $modeloDetail;
            
            $nomeClasse	  = ucfirst($this->getCamelMode((string)$aTabela['NOME']));
            $objetoClasse = "\$o$nomeClasse";

            # Varre a estrutura dos campos da tabela em questao
            $aPKRequest = $aCampoPK = $aCampoFrm = $aTituloAdm = $aCampoAdm = $aGetAll = $aCampoDetail = [];
            $PK = $ID_PK = $label = $campoAdm = $componenteFrm = $campoDetail = NULL;

            foreach($aTabela as $oCampo){
            	
                $nomeFKClasse = ucfirst($this->getCamelMode((string)$oCampo['FKTABELA']));
                //$label        = ((string)$oCampo['FKCAMPO'] != '') ? ucfirst(preg_replace("#^(?:id_?|cd_?)(.*?)#is", "$1", (string)$oCampo['NOME'])) : 
                $label        = ((string)$oCampo['FKCAMPO'] != '') ? $nomeFKClasse :
                                ucfirst(str_replace((string)$aTabela['NOME'], "", (string)$oCampo['NOME']));

                $campoAdm = ((string)$oCampo['FKCAMPO'] != '') ? $objetoClasse."->o$label"."->".$this->getTituloObjeto((string)$oCampo['FKTABELA']) :
                            $objetoClasse."->".$oCampo['NOME'];
                
                if((int)$oCampo['CHAVE'] == 1){
                    $aPKRequest[] = "\$_REQUEST['{$oCampo['NOME']}']";
                    $aCampoPK[]   = Form::geraHidden((string)$oCampo['NOME']);

                    if((string)$oCampo['FKTABELA'] != ''){ // Tabela cuja PK = FK => Relacao 1:1
                        $PK    = "o$nomeFKClasse"."->".$oCampo['FKCAMPO'];
                        $ID_PK = $oCampo['FKCAMPO'];

                        //print "($objetoClasse, {$oCampo['NOME']}, $label, $nomeFKClasse, ".$this->getTituloObjeto((string)$oCampo['FKTABELA']).", 'CAD')\n";
                        $componenteFrm = Form::geraSelect($objetoClasse, (string)$oCampo['NOME'], $label, $oCampo['FKCAMPO'], $this->getTituloObjeto((string)$oCampo['FKTABELA']), 'EDIT', $this->gui);
                        
                    } else {
                        $PK    = (string)$oCampo['NOME'];
                        $ID_PK = (string)$oCampo['NOME'];
                    }
                } else {
                    switch((string)$oCampo['TIPO']){
                        case "date":
                        	$componenteFrm = Form::geraCalendario($objetoClasse, (string)$oCampo['NOME'], $label, 'EDIT', false, $this->gui);
                        	$campoAdm      = Form::geraCalendario($objetoClasse, (string)$oCampo['NOME'], $label, 'ADM', false, $this->gui);
                        break;

                        case "datetime":
                        case "timestamp":
                        	$componenteFrm = Form::geraCalendario($objetoClasse, (string)$oCampo['NOME'], $label, 'EDIT', true, $this->gui);
                        	$campoAdm      = Form::geraCalendario($objetoClasse, (string)$oCampo['NOME'], $label, 'ADM', true, $this->gui);
                        break;

                        case "text": 
                            $componenteFrm = Form::geraTextArea($objetoClasse, (string)$oCampo['NOME'], $label, 'EDIT', $this->gui);
                        break;

                        case "tinyint(1)": 
                            $componenteFrm = Form::geraCheckBox($objetoClasse, (string)$oCampo['NOME'], $label, 'EDIT', $this->gui);
                        break;

                        default:
                            if($oCampo['FKCAMPO'] != ''){
                                $componenteFrm = Form::geraSelect($objetoClasse, (string)$oCampo['NOME'], $label, $oCampo['FKCAMPO'], $this->getTituloObjeto((string)$oCampo['FKTABELA']), 'EDIT', $this->gui);
                            }
                            else{
                                $componenteFrm = (preg_match("#(?:senha|password)#is", $oCampo['NOME']))   ? 
                                                  Form::geraPassword($objetoClasse, (string)$oCampo['NOME'], $label, 'EDIT', $this->gui) :
                                                  Form::geraInput($objetoClasse,    (string)$oCampo['NOME'], $label, 'EDIT', (string)$oCampo['TIPO'], $this->gui);
                                //Util::trace($oCampo);
                            }
                            # ============ Campo Enum =============
                            if(preg_match("#enum#i", (string)$oCampo['TIPO'])){
                                $componenteFrm = Form::geraEnum($objetoClasse, (string)$oCampo['NOME'], (string)$oCampo['TIPO'], $label, 'EDIT', $this->gui);	
                            }
                        break;
                    }
                }
                
                $campoDetail = Form::geraDetailText($campoAdm, $label, $this->gui);
                
                $aCampoFrm[] = $componenteFrm;
                $aTituloAdm[] = "<th>$label</th>";
                $aCampoAdm[]  = "<td><?=$campoAdm?></td>";
                $aCampoDetail[] = $campoDetail;
            }

            # ===== Montar lista dos metodos Carregar Colecao =======
            $aTabelaFK = $this->getAllTabelaFK((string)$aTabela['NOME']);

            foreach($aTabelaFK as $oCampoFK => $oDadosTabelaFK){
                $nomeClasseFK = ucfirst($this->getCamelMode($oDadosTabelaFK['FKTABELA']));
                $aGetAll[]    = "\$oController$nomeClasseFK = new Controller$nomeClasseFK();\r\$a$nomeClasseFK = \$oController{$nomeClasseFK}->getAll([], []);"; 
            }

            # monta demais valores a serem substituidos
            $sPKRequest      = join($aPKRequest, ", ");
            $sTituloAdm      = join($aTituloAdm, "\n\t\t\t\t\t");
            $sCampoAdm       = join($aCampoAdm,  "\n\t\t\t\t\t");
            $sCampoFrm      = join($aCampoFrm, "\n");
            $sCampoPK        = join($aCampoPK,   "\n");
            $sCampoDetail    = join($aCampoDetail,   "\n");
            
            $sGetAll = (count($aGetAll) > 0) ? join($aGetAll,"\n") : "";

            # substitui todas os parametros pelas variaveis ja processadas
            $copiaModeloAdm = str_replace('%%NOME_CLASSE%%',     $nomeClasse, $copiaModeloAdm);
            $copiaModeloAdm = str_replace('%%TITULOATRIBUTOS%%', $sTituloAdm, $copiaModeloAdm);
            $copiaModeloAdm = str_replace('%%VALORATRIBUTOS%%',  $sCampoAdm,  $copiaModeloAdm);
            $copiaModeloAdm = str_replace('%%ADM_INFO%%',  	     (($PK != '') ? Form::geraAdmInfo($nomeClasse, $ID_PK, $PK, $this->gui) : ''),  $copiaModeloAdm);
            $copiaModeloAdm = str_replace('%%ADM_EDIT%%',  	     (($PK != '') ? Form::geraAdmEdit($nomeClasse, $ID_PK, $PK, $this->gui) : ''),  $copiaModeloAdm);
            $copiaModeloAdm = str_replace('%%ADM_DELETE%%',      (($PK != '') ? Form::geraAdmDelete($nomeClasse, $ID_PK, $PK, $this->gui) : ''), $copiaModeloAdm);
            
            /* ========= 2 devido as colunas Editar e Excluir ============= */
            $copiaModeloAdm = str_replace('%%NUMERO_COLUNAS%%', count($aTituloAdm)+3, $copiaModeloAdm);
            $copiaModeloAdm = str_replace('%%PK_REQUEST%%',     $sPKRequest,           $copiaModeloAdm);
            $copiaModeloAdm = str_replace('%%PK%%',     		"{$aTabela['NOME']}.$ID_PK", $copiaModeloAdm);
            
            # ================ Template Frm ==================
            $copiaModeloFrm = str_replace('%%NOME_CLASSE%%',     $nomeClasse, $copiaModeloFrm);
            $copiaModeloFrm = str_replace('%%CARREGA_COLECAO%%', $sGetAll,    $copiaModeloFrm);
            $copiaModeloFrm = str_replace('%%ATRIBUICAO%%',      $sCampoFrm, $copiaModeloFrm);
            $copiaModeloFrm = str_replace('%%CHAVE_PRIMARIA%%',  $sCampoPK,   $copiaModeloFrm);
            $copiaModeloFrm = str_replace('%%PK%%',              $PK,         $copiaModeloFrm);
            $copiaModeloFrm = str_replace('%%ID_PK%%',           $ID_PK,      $copiaModeloFrm);
            
            # ================ Template Detail ==================
            $copiaModeloDetail = str_replace('%%NOME_CLASSE%%', $nomeClasse,   $copiaModeloDetail);
            $copiaModeloDetail = str_replace('%%ATRIBUICAO%%',  $sCampoDetail, $copiaModeloDetail);
            $copiaModeloDetail = str_replace('%%ID_PK%%',       $ID_PK,        $copiaModeloDetail);
          
            $dir = dirname(dirname(__FILE__))."/geradas/".$this->projeto."/";

            if(!file_exists($dir)) mkdir($dir);

            $fpAdm 	  = fopen("$dir/adm$nomeClasse.php",  "w");   fputs($fpAdm, $copiaModeloAdm);       fclose($fpAdm);
            $fpFrm    = fopen("$dir/frm$nomeClasse.php", "w");    fputs($fpFrm, $copiaModeloFrm);       fclose($fpFrm);
            $fpDetail = fopen("$dir/detail$nomeClasse.php", "w"); fputs($fpDetail, $copiaModeloDetail); fclose($fpDetail);
            
            // ======= Limpa arrays ======= 
            unset($aGetAll);
            unset($aTituloAdm);
            unset($aCampoAdm);
            unset($aCampoFrm);
            unset($aPKRequest);
            unset($aCampoPK);
            unset($aCampoDetail);
        }

        # ==== Alterar arquivo index =====
        $modeloIndex = Util::getConteudoTemplate($this->gui.'/index.php');
        $modeloIndex = str_replace('%%PROJETO%%', ucfirst($aBanco['NOME']), $modeloIndex);

        $fpIndex = fopen("$dir/index.php",  "w");
        fputs($fpIndex, $modeloIndex);
        fclose($fpIndex);
        
        # ============== Arquivo de titulo ===================
        $modeloTitulo = Util::getConteudoTemplate($this->gui.'/Modelo.titulo.tpl');
        $modeloTitulo = str_replace('%%DATABASE%%', ucfirst($aBanco['NOME']), $modeloTitulo);

        $fpTitulo = fopen($dir."includes/titulo.php",  "w");
        fputs($fpTitulo, $modeloTitulo);
        fclose($fpTitulo);
        
        // ========= Copiar arquivos adicionais do projeto ========
        copy(dirname(dirname(__FILE__))."/templates/{$this->gui}/home.php",   "$dir/home.php");

        return true;	
    }

    /**
     * Geracao das Classes de Mapeamento
     *
     * @return bool
     */
	function geraClassesMAP(){
        # Abre o template da classe basica e armazena conteudo do modelo
        $modelo = Util::getConteudoTemplate('ModeloMAP.class.tpl');

        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);

        # Varre a estrutura das tabelas
        foreach($aBanco as $aTabela){
            $copiaModelo = $modelo;
            # Recupera o nome da tabela e gera o nome da classe
            $nomeTabela         = ucfirst((string)$aTabela['NOME']);
            $nomeTabelaOriginal = (string)$aTabela['NOME'];
            
            $nomeClasse   = ucfirst($this->getCamelMode($nomeTabela));
            $objetoClasse = "\$o$nomeClasse";
            # Varre a estrutura dos campos da tabela em questao
            $aTabelaCampos = $objToReg = $regToObj = $objToRegInsert = array();

            $aTabelaCampos = $this->getCamposArray($nomeTabelaOriginal);
            
            foreach($aTabela as $oCampo){
                # Processa nome original da tabela estrangeira
                $objetoFK 	   = ucfirst($this->getCamelMode((string)$oCampo['FKTABELA']));
                $tabelaFK 	   = (string)$oCampo['FKTABELA'];
                
                # Testando nova implementacao - Tirar caso ocorrer erro
                /*
                if($nomeFKClasse == $nomeClasse)
                    $objetoFK = ucfirst(preg_replace("#^(?:id_?|cd_?)(.*?)#is", "$1", (string)$oCampo['NOME']));
				
                
                if((string)$oCampo['FKTABELA'] != ''){
                	$objetoFK = ucfirst(preg_replace("#^(?:id_?|cd_?)(.*?)#is", "$1", (string)$oCampo['NOME']));
                }
                */
                
                //$nomeCampo = $this->getCamelMode((string)$oCampo['NOME']); Alteracao SUDAM
                $nomeCampo = (string)$oCampo['NOME'];

                # Monta parametros a serem substituidos posteriormente
                if($oCampo['FKTABELA'] == ''){
                    $objToReg[]       = "\t\t\$reg['".(string)$oCampo['NOME']."'] = $objetoClasse"."->$nomeCampo;";
                    if($oCampo['CHAVE'] == "0"){
                        $objToRegInsert[] = "\t\t\$reg['".(string)$oCampo['NOME']."'] = $objetoClasse"."->$nomeCampo;";
                    }
                    $regToObj[] = "\t\t$objetoClasse"."->$nomeCampo = \$reg['$nomeTabelaOriginal"."_".(string)$oCampo['NOME']."'];";
                    
                }
                else{
                    $objToReg[] = "\t\t\$o$objetoFK = $objetoClasse"."->o$objetoFK;\n\t\t\$reg['".(string)$oCampo['NOME']."'] = \$o$objetoFK"."->".(string)$oCampo['FKCAMPO'].";";
                    if($oCampo['CHAVE'] == "0"){
                        $objToRegInsert[] = "\t\t\$o$objetoFK = $objetoClasse"."->o$objetoFK;\n\t\t\$reg['".(string)$oCampo['NOME']."'] = \$o$objetoFK"."->".(string)$oCampo['FKCAMPO'].";";
                    }
                    $aux 		= $this->getArvoreObjeto($tabelaFK, $objetoFK);
                    $regToObj[] = "\n$aux\t\t$objetoClasse"."->o$objetoFK = \$o$objetoFK;";
                }
            }
	
            # Monta demais valores a serem substituidos
            $objToReg       = join($objToReg,"\n");
            $objToRegInsert = join($objToRegInsert,"\n");
            $regToObj       = join($regToObj,"\n");

            # Substitui todas os parametros pelas variaveis ja processadas
            
                        
            $sTabelaCampos = $this->serializeCamposTabela($aTabelaCampos);
            
            $copiaModelo = str_replace('%%ARRAY_CAMPOS%%',      $sTabelaCampos,	$copiaModelo);
            $copiaModelo = str_replace('%%NOME_CLASSE%%',       $nomeClasse,    $copiaModelo);
            $copiaModelo = str_replace('%%OBJETO_CLASSE%%',     $objetoClasse,  $copiaModelo);
            $copiaModelo = str_replace('%%OBJ_TO_REG%%',        $objToReg,      $copiaModelo);
            $copiaModelo = str_replace('%%OBJ_TO_REG_INSERT%%', $objToRegInsert,$copiaModelo);
            $copiaModelo = str_replace('%%REG_TO_OBJ%%',        $regToObj,      $copiaModelo);

            $dir = dirname(dirname(__FILE__))."/geradas/".$this->projeto."/classes/core/map";

            if(!file_exists($dir)) 
                mkdir($dir);

            $fp = fopen("$dir/$nomeClasse"."MAP.class.php","w");
            fputs($fp,$copiaModelo);
            fclose($fp);
        }
        return true;	
    }

    /**
     * Geracao das Classes BDBase
     *
     * @return bool
     */
    function geraClassesBDBase(){
        # Abre o template da classe BD e armazena conteudo do modelo
        $modelo = Util::getConteudoTemplate('ModeloBDBase.class.tpl');

        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);

        # Varre a estrutura das tabelas
        foreach($aBanco as $aTabela){
            $copiaModelo  = $modelo;
            $nomeClasse	 = $this->getCamelMode(ucfirst((string)$aTabela['NOME']));
            $objetoClasse = "\$o$nomeClasse";
            # varre a estrutura dos campos da tabela em questao
            $aCampoInsert = $aValorInsert = $aCampoUpdate   = $aChaveWhere = $aCampoConsulta = array();
            $aChaveAltera = $aChave       = $aChaveWhereSel = $aChaveWhereDel = $aFKJoin     = $aVerificaPK =  array();
            
            $i = 2;

            foreach($aTabela as $oCampo){
                $nomeCampo = (string)$oCampo['NOME'];
                if($oCampo['CHAVE'] == 1){
                    $autoInc = $oCampo['AI'];
                }
                # recupera valores a serem substituidos no modelo
                $aCampoInsert[] = $nomeCampo;
                if((int)$oCampo['CHAVE'] == 1){
                    $aChaveWhere[]    = "$nomeCampo = {\$reg['$nomeCampo']}";
                    $aChaveWhereSel[] = (string)$aTabela['NOME'].".$nomeCampo = \$$nomeCampo";
                    $aChaveWhereDel[] = "$nomeCampo = \$$nomeCampo";
                    $aChave[]         = "\$$nomeCampo";
                    $aVerificaPK[]    = $nomeCampo;
                    $aChaveAltera[]    = "\$cv == \"$nomeCampo\"";
                    if((string)$oCampo['FKTABELA'] != ''){
                        $aCampoUpdate[] = "$nomeCampo = \".\$reg['$nomeCampo'].\"";
                    }
                }
                else{
                    $aCampoUpdate[] = ((string)$oCampo['FKTABELA'] != '') ? 
                                        "$nomeCampo = \".\$reg['$nomeCampo'].\"" : 
                                        "$nomeCampo = '\".\$reg['$nomeCampo'].\"'";				
                }

                if((string)$oCampo['FKTABELA'] != ''){
                    $aValorInsert[] = (preg_match("#[dD]ata.*[Cc]adastro#is", $nomeCampo)) ? "\".\$oConexao->data_cadastro_padrao.\"" : "\".\$reg['$nomeCampo'].\"";
                    $tabelaFK       = ((string)$aTabela['SCHEMA'] != "") ? (string)$aTabela['SCHEMA'].".".(string)$oCampo['FKTABELA'] : (string)$oCampo['FKTABELA'];
                    $aFKJoin[]      = "$tabelaFK \n\t\t\t\t\ton (".(string)$aTabela['NOME'].".$nomeCampo = ".(string)$oCampo['FKTABELA'].".".(string)$oCampo['FKCAMPO'].")";
                    
                    $i++;
                }
                else{
                    $aValorInsert[] = ((int)$oCampo['CHAVE'] == 1) ? 
                                                      "\".\$reg['$nomeCampo'].\"" : 
                                                      "'\".\$reg['$nomeCampo'].\"'";
                }

                // =========== Montagem dos Campos da Consulta =============
                if((int)$oCampo['CHAVE'] != 1){
                    $aCampoConsulta[] = (string)$aTabela['NOME'].".$nomeCampo like '\$valor'";
                }	
            }
            # =========== Monta demais valores a serem substituidos ========
            $aCampoInsert   = join($aCampoInsert,   ",\n\t\t\t\t\t");
            $aValorInsert   = join($aValorInsert,   ",\n\t\t\t\t\t");
            $aCampoUpdate   = join($aCampoUpdate,   ",\n\t\t\t\t\t");
            $aChaveWhere    = join($aChaveWhere,    " \n\t\t\t\t\tand ");
            $aChaveWhereSel = join($aChaveWhereSel, " \n\t\t\t\t\tand ");
            $aChaveWhereDel = join($aChaveWhereDel, " \n\t\t\t\t\tand ");
            $sCampoConsulta = join($aCampoConsulta, " \n\t\t\t\t\tor ");
            $aChave         = join($aChave,	    ",");
            $aColuna        = $this->getCamposSelect((string)$aTabela['NOME']);
            $aColuna        = join($aColuna, ",\n\t\t\t\t\t");

            $tabelaJoin     = (((string)$aTabela['SCHEMA'] != "") ? (string)$aTabela['SCHEMA'].".".(string)$aTabela['NOME'] : (string)$aTabela['NOME']);

            $sVerificaPK = NULL;
            foreach($aVerificaPK as $v){
                $sVerificaPK .= "\t\t\$reg['$v'] = (\$reg['$v'] != '') ? \$reg['$v'] : \"null\";\n";
            }

            if(count($aFKJoin) > 0){
                $tabelaJoin .= " \n\t\t\t\tleft join ".join($aFKJoin,"\n\t\t\t\tleft join ");
            }
            
            $nomeTabela          = (((string)$aTabela['SCHEMA'] != "") ? (string)$aTabela['SCHEMA'].".".(string)$aTabela['NOME'] : (string)$aTabela['NOME']);
            $chavesWhereConsulta = (($sCampoConsulta!='') ? $sCampoConsulta : '1=1');
            $sChaveAltera        = (count($aChaveAltera)>0) ? "if(".implode(" || ", $aChaveAltera).") continue;" : "";
           
            # ======== Substitui todas os parametros pelas variaveis ja processadas ==========
            $copiaModelo = str_replace('%%NOME_CLASSE%%',           $nomeClasse,          $copiaModelo);
            $copiaModelo = str_replace('%%VERIFICA_PK%%',           $sVerificaPK,         $copiaModelo);
            $copiaModelo = str_replace('%%OBJETO_CLASSE%%',         $objetoClasse,        $copiaModelo);
            $copiaModelo = str_replace('%%RETURN_CADASTRAR%%',      ($autoInc == "1") ? "\$this->oConexao->lastID()" : "true", $copiaModelo);
            $copiaModelo = str_replace('%%TABELA%%',                $nomeTabela,          $copiaModelo);
            $copiaModelo = str_replace('%%CAMPOS_INS%%',            $aCampoInsert,        $copiaModelo);
            $copiaModelo = str_replace('%%VAL_CAMPOS_INS%%',        $aValorInsert,        $copiaModelo);
            $copiaModelo = str_replace('%%CAMPOS_UPD%%',            $aCampoUpdate,        $copiaModelo);
            $copiaModelo = str_replace('%%CHAVES_WHERE%%',          $aChaveWhere,         $copiaModelo);
            $copiaModelo = str_replace('%%LISTA_CHAVES%%',          $aChave,              $copiaModelo);
            $copiaModelo = str_replace('%%CHAVES_WHERE_SEL%%',      $aChaveWhereSel,      $copiaModelo);
            $copiaModelo = str_replace('%%CHAVES_WHERE_DEL%%',      $aChaveWhereDel,      $copiaModelo);
            $copiaModelo = str_replace('%%TABELA_JOIN%%',           $tabelaJoin,          $copiaModelo);
            $copiaModelo = str_replace('%%CHAVES_WHERE_CONS%%',     $chavesWhereConsulta, $copiaModelo);
            $copiaModelo = str_replace('%%COLUNAS%%',               $aColuna,             $copiaModelo); //Por Enquanto
            $copiaModelo = str_replace('%%CAMPOS_CHAVE_ALTERAR%%',  $sChaveAltera,        $copiaModelo);
            
            unset($sCampoConsulta);

            $dir = dirname(dirname(__FILE__))."/geradas/".$this->projeto."/classes/core/bdbase";
            if(!file_exists($dir)) 
                mkdir($dir);
            $fp = fopen("$dir/$nomeClasse"."BDBase.class.php","w");
            fputs($fp,$copiaModelo); 
            fclose($fp);
        }
        return true;
    }

    /**
     * Geracao das Classes BD
     *
     * @return bool
     */
    function geraClassesBD(){
        # Abre o template da classe BD e armazena conteudo do modelo
        $modelo = Util::getConteudoTemplate('ModeloBD.class.tpl');

        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);

        # Varre a estrutura das tabelas
        foreach($aBanco as $aTabela){
            $nomeTabela  = ucfirst((string)$aTabela['NOME']);
            $nomeClasse  = $this->getCamelMode($nomeTabela);
            $copiaModelo = $modelo;

            # substitui todas os parametros pelas variaveis ja processadas
            $copiaModelo = str_replace('%%NOME_CLASSE%%',$nomeClasse,$copiaModelo);

            # Complementos adicionais para classes especificas
            $copiaModelo = str_replace('%%COMPLEMENTO%%','',$copiaModelo);
            /*
            $modeloTemp  = NULL;
            
            switch($nomeClasse){
                case 'Grupoprograma':
                case 'Modulo':
                case 'Programa':
                case 'Usuario':
                case 'Usuariogrupo':
                    $modeloTemp  = Util::getConteudoTemplate("Modelo.$nomeClasse"."BD.class.php");			
                    $copiaModelo = str_replace('%%COMPLEMENTO%%',$modeloTemp,$copiaModelo);
                break;

                default: 
                    	
                break;
            }
            */
            $dir = dirname(dirname(__FILE__))."/geradas/".$this->projeto."/classes/bd";
            if(!file_exists($dir)) 
                mkdir($dir);
            $fp = fopen("$dir/$nomeClasse"."BD.class.php","w");
            fputs($fp, $copiaModelo);
            fclose($fp);
        }
        return true;	
    }

    /**
     * 
     * Gera menu estatico, caso nao use o modulo de seguranca
     * 
     * @return void
     */
    function geraMenuEstatico(){
        try{
            # Abre o template da classe BD e armazena conteudo do modelo
            $modelo 		 = Util::getConteudoTemplate($this->gui.'/Modelo.menu.tpl');
            $modeloItem 	 = Util::getConteudoTemplate($this->gui.'/Modelo.menu.item.tpl');
            $copiaModelo 	 = $modelo;
            $copiaModeloItem = $modeloItem;

            # Abre arquivo xml para navegacao
            $aBanco = simplexml_load_string($this->xml);
            $aItem = [];
            
            foreach($aBanco as $aTabela){
                if($aTabela['TIPO_TABELA'] == 'N:M')
                    continue;
                
				$aItem[] = str_replace('%%NOME_CLASSE%%', ucfirst($this->getCamelMode($aTabela['NOME'])), $copiaModeloItem);
            }
			
            $listaItens = join("\n\n", $aItem);
            
            $copiaModelo = str_replace('%%MODELO_MENU%%', $listaItens, $copiaModelo);
            $copiaModelo = str_replace('%%PROJETO%%',	  ucfirst($aBanco['NOME']), $copiaModelo);

            $dir = dirname(dirname(__FILE__))."/geradas/".$this->projeto."/includes";
            if(!file_exists($dir)) mkdir($dir);
            $fp = fopen("$dir/menu.php","w"); fputs($fp, $copiaModelo); fclose($fp);
            return true;
        } catch (Exception $e){
            return false;
        }
    }

    /**
     * Retorna os atributos q serão usados no comando select de uma tabela
     * 
     * @param string $tabela
     * @param string $alias
     * @param boolean $desceNivel
     * @return string[]
     */
    function getCamposSelect($tabela, $alias=null, $desceNivel=true){
        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);
        $aCampo = $aAux = $aAux2 = [];
        
        foreach($aBanco as $aTabela){
            if((string)$aTabela['NOME'] == $tabela){
                //print_r($aTabela);
                foreach($aTabela as $oCampo){
                    //print_r($oCampo);
                	if($alias == null){
                		$alias = $tabela;
                	}
                	
                	$aCampo[] = "$alias.{$oCampo['NOME']} as $alias"."_{$oCampo['NOME']}";
                	             	
                    //print_r($aCampo);
                    if($desceNivel){
                        if($oCampo['FKTABELA'] != ''){
                        	//TODO: Definir regras de geração de alias para tabelas que possuem mais de uma referência para uma mesma tabela
                        	/*if(preg_match("#^(?:id_?|cd_?)(.*?)#is", $oCampo['NOME'])){
                        		$alias = strtolower(preg_replace("#^(?:id_?|cd_?)(.*?)#is", "$1", $oCampo['NOME']));
                        	}*/
                        	$aAux[(string)$oCampo['FKTABELA']] = $oCampo['FKTABELA'];
                        }
                    }
                    $alias = null;
                }
            } else {
				continue;
            }
        }
        
        
        //Util::trace($aAux);
        
        // ========= Tabelas_FK =======
        if(count($aAux) > 0){
            foreach($aAux as $alias => $tab){
                $aAux2[] = $this->getCamposSelect($tab, $alias, false);
            }
        }

        if(count($aAux2) > 0){
            foreach($aAux2 as $a){
                foreach($a as $s){
                    $aCampo[] = $s;
                }
            }
        }

        return $aCampo;
    }
    
    /**
     * Retorna os atributos q serão usados no comando select de uma tabela
     *
     * @param string $tabela
     * @param string $alias
     * @param boolean $desceNivel
     * @return string[]
     */
    function getCamposArray($tabela, $alias=null, $desceNivel=true){
    	# Abre arquivo xml para navegacao
    	$aBanco = simplexml_load_string($this->xml);
    	$aCampo = $aAux = [];

    	foreach($aBanco as $aTabela){
    		if((string)$aTabela['NOME'] == $tabela){
    			//print_r($aTabela);
    			foreach($aTabela as $oCampo){
    				//print_r($oCampo);
    				if($alias == null || $alias == ''){
    					$alias = $tabela;
    				}
    				 
    				$aCampo[(string)$alias][] = (string)$oCampo['NOME'];
    				 
    				//print_r($aCampo);
    				if($desceNivel){
    					if($oCampo['FKTABELA'] != ''){
    						//TODO: Definir regras de geração de alias para tabelas que possuem mais de uma referência para uma mesma tabela
    						/*if(preg_match("#^(?:id_?|cd_?)(.*?)#is", $oCampo['NOME'])){
    						 $alias = strtolower(preg_replace("#^(?:id_?|cd_?)(.*?)#is", "$1", $oCampo['NOME']));
    						 }*/
    						$aAux[(string)$oCampo['FKTABELA']] = (string)$oCampo['FKTABELA'];
    					}
    				}
    				$alias = null;
    			}
    		} else {
    			continue;
    		}
    	}
    
    	// ========= Tabelas_FK =======
    	if(count($aAux) > 0){
    		foreach($aAux as $alias => $tab){
    			$aCampo = array_merge($aCampo, $this->getCamposArray($tab, $alias, false));
    		}
    	}
    
    	return $aCampo;
    }

    /**
     * Converte a lista de campos de um array uma string
     *  
     * @param string[] $array
     * @return string
     */
    function serializeCamposTabela($array){
        $i=0;
        $sAux = [];
        foreach($array as $c1=>$aValor){
    		foreach($aValor as $c2=>$v){
    			$aux1 = $v;
    			$aux1 = ($i==0) ? "'$v'" : "\t\t\t\t\t\t'$v'"; 
    			$array[$c1][$c2] = $aux1;
    			
    			$i++;
    		}
    	}
    	
    	$j=0;
    	foreach($array as $c=>$aValor){
    	    $aux = "'{$c}' => [".join($aValor, ", \n")."]";
    	    $aux = ($j==0) ? $aux : "\t\t\t\t$aux";
    	    $sAux[] = $aux;
    		$j++;
    	}
    	return "[".join($sAux,", \n")."]";
    }
    
    /**
     * Retorna as tabelas 
     *
     * @param string $tabela
     * @param boolean $desceNivel
     * @return string[]
     */
    function getAllTabelasJoin($tabela, $desceNivel=true){
        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);
        $aTab = $aAux = array();
        foreach($aBanco as $aTabela){
            if((string)$aTabela['NOME'] == $tabela){
                foreach($aTabela as $oCampo){
                    if((int)$oCampo['CHAVE'] == 1){
                        if($desceNivel){
//                          $aTab[$tabela] = $tabela;
                            $aTab[$tabela][] = array("tab_rel" => (string)$oCampo['FKTABELA'],
                                                     "campo"   => (string)$oCampo['NOME'],
                                                     "fk"      => (string)$oCampo['FKCAMPO']);
                        }
                    }
                    if((string)$oCampo['FKTABELA'] != ''){
                        //$aTab[] = (string)$oCampo['FKTABELA'];
                        $aTab[(string)$oCampo['FKTABELA']] = array("tab_rel" => $tabela,
                                                                 "campo"   => (string)$oCampo['NOME'],
                                                                 "fk" 	   => (string)$oCampo['FKCAMPO']);
                        if($desceNivel){
                            $aAux[] = $this->getAllTabelasJoin((string)$oCampo['FKTABELA'], false);
                        }
                    }
                }
            } else {
                continue;
            }
        }

        foreach($aAux as $a){
            foreach($a as $ch=>$vl){
                $aTab[$ch] = $vl;
            }
        }

        return $aTab;
    }

    /**
     * Retorna arvore de objetos de uma tabela. Método usado na geracao de Classes Mapeamento
     *
     * @param string $tabelaRaiz
     * @param string $objetoFK
     * @param int $key
     * @return string[] 
     */
    function getArvoreObjeto($tabelaRaiz, $objetoFK, $key = 0){
    	//TODO: Criar a instância da classe derivada do nome do atributo, e não do nome da classe pelo fato de uma tabela se relacionar mais de uma vez com outra tabela 
        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);

        # Varre a estrutura das tabelas
        foreach($aBanco as $aTabela){
            # Recupera o nome da tabela e procura pela raiz
            if((string)$aTabela['NOME'] != $tabelaRaiz) 
                continue;
			
            $nomeClasse   = ucfirst($this->getCamelMode((string)$aTabela['NOME']));
            $objetoClasse = "\$o$objetoFK";

            # Varre a estrutura dos campos da tabela em questao
            $resultado = array("\t\t$objetoClasse = new $nomeClasse();");
            
            foreach($aTabela as $oCampo){
                # recupera nome e tabela (chave estrangeira)
                if($key){
                    if((int)$oCampo['CHAVE'] == 0) continue;
                }

                $nomeCampo = (string)$oCampo['NOME'];

                # monta parametros a serem substituidos posteriormente
                if((string)$oCampo['FKTABELA'] == '')
                    $resultado[] = "\t\t$objetoClasse"."->$nomeCampo = \$reg['$tabelaRaiz"."_".(string)$oCampo['NOME']."'];";
                //else
                    //$resultado[] = $this->getArvoreObjeto((string)$oCampo['FKTABELA'], 0)."\t\t$objetoClasse"."->o$nomeFKClasse = \$o$nomeFKClasse;";
            }
            return join($resultado,"\n")."\n";
        }
    }

    /**
     * Retorna o Database do XML 
     *
     * @return string[]
     */
    function getDatabase(){
        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);
        return (string)$aBanco['NOME'];
    }

    /**
     * Retorna as tabelas do XML 
     *
     * @return array[string]
     */
    function getAllTabela(){
        # Abre arquivo xml para navegacao
        $aBanco   = simplexml_load_string($this->xml);
        $aRetorno = array();

        # Varre a estrutura das tabelas
        foreach($aBanco as $aTabela){
            # Recupera o nome da tabela e gera o nome da classe
            $aRetorno[] = (string)$aTabela['NOME'];
        }
        return $aRetorno;
    }

    /**
     * Retorna os campos da tabela selecionada do XML
     *
     * @param string $tabelaProcura
     * @return string[]
     */
    function getAllCampo($tabelaProcura){
        # Abre arquivo xml para navegacao
        $aBanco   = simplexml_load_string($this->xml);
        $aRetorno = array();

        # Varre a estrutura das tabelas
        foreach($aBanco as $aTabela){
            # Recupera o nome da tabela e gera o nome da classe
            if($tabelaProcura != (string)$aTabela['NOME']) 
                continue;
            # Varre a estrutura dos campos da tabela em questao
            foreach($aTabela as $oCampo){
                # Recupera valores a serem substituidos no modelo
                $aRetorno[] = (string)$oCampo['FKTABELA'];
            }
            break;
        }
        return $aRetorno;
    }


    /**
     * Retorna o nome campo a ser usado como titulo do combo que represente o objeto(tabela) selecionado. Alusão ao método __to_string() da classe Object
     * 
     * @param $tabelaProcura
     * @return String
     */
    function getTituloObjeto($tabelaProcura){
        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);
        $retorno = $pk = '';
        # Varre a estrutura das tabelas
        foreach($aBanco as $aTabela){
            # Recupera o nome da tabela e gera o nome da classe
            if($tabelaProcura != $aTabela['NOME']) 
                continue;

            # Varre a estrutura dos campos da tabela em questao
            foreach($aTabela as $oCampo){                
                //print "@@{$oCampo['NOME']}\n";
                //print_r($aTabela); exit;
                # Se o campo for chave, nao sera usado
                if($oCampo['CHAVE'] == 1){
                    $pk = $oCampo['NOME'];
                    
                    if((String)$oCampo['FKTABELA'] == ''){
                        continue;
                    }
                }

                # Se o campo for do tipo numerico, nao sera usado, nao sera usado
                if(!preg_match("#varchar#is", (String)$oCampo['TIPO'])) continue;
                
                # Se o campo tiver nomenclatura que nao remeta a nome/descricao sera eliminado 
                if(preg_match("#(?:nome|descricao)#is", (String)$oCampo['NOME'])){
                    $retorno = (String)$oCampo['NOME'];
                    break;
                }
                
                # Se o campo tiver nomenclatura que nao remeta a nome/descricao sera eliminado 
                if(preg_match("#(?:usuario|login|nome_?(?:pessoa|cliente|servidor)|descricao|titulo|nm_(?:pessoa|cliente|servidor|estado_?civil|lotacao|credenciado)|desc_)#is", (String)$oCampo['NOME'])){
                    $retorno = (String)$oCampo['NOME'];
                    break;
                }
                
                # E-mail
                if(preg_match("#(?:email)#is", (String)$oCampo['NOME'])){
                	$retorno = (String)$oCampo['NOME'];
                	break;
                }
                
                # Numero
                if(preg_match("#(?:numero|nota.*fiscal)#is", (String)$oCampo['NOME'])){
                	$retorno = (String)$oCampo['NOME'];
                	break;
                }
            }
            break;
        }
        if($retorno == '')
            $retorno = $pk;
        return (string)$retorno;
    }


    /**
     * Retorna as tabelas de FK da tabela selecionada do XML
     *
     * @param string $tabelaProcura
     * @return string[]
     */ 
    function getAllTabelaFK($tabelaProcura){
        # abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);
        $aRetorno = array();
        # varre a estrutura das tabelas
        foreach($aBanco as $aTabela){
            # recupera o nome da tabela e gera o nome da classe
            $nomeTabela = (string)$aTabela['NOME'];
            if($nomeTabela != $tabelaProcura) continue;
            # varre a estrutura dos campos da tabela em questao
            foreach($aTabela as $oCampo){
                # recupera valores a serem substituidos no modelo
                if(trim($oCampo['FKTABELA']) == "") 
                    continue;
                $aRetorno[trim($oCampo['NOME'])] = [
                                                    "CHAVE"    => trim($oCampo['CHAVE']),
                                                    "FKTABELA" => trim($oCampo['FKTABELA']),
                                                    "FKCAMPO"  => trim($oCampo['FKCAMPO'])
                                                    ];
            }
            break;
        }
        return $aRetorno;	
    }

    /**
     * Retorna os atributos da classe relacionada a tabela selecionada do XML
     *
     * @param string $tabelaProcura
     * @return string[]
     */
    function getAllAtributo($tabelaProcura){
        # abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);
        $aRetorno = array();
        # varre a estrutura das tabelas
        foreach($aBanco as $aTabela){
            # recupera o nome da tabela e gera o nome da classe
            $nomeTabela = (string)$aTabela['NOME'];
            if($nomeTabela != $tabelaProcura) continue;
            # varre a estrutura dos campos da tabela em questao
            foreach($aTabela as $oCampo){
                # recupera valores a serem substituidos no modelo
                $sFKTabela = (string)$oCampo['FKTABELA'];
                if($sFKTabela != ''){
                    $nomeClasse = ucfirst($this->getCamelMode($sFKTabela));
                    $aRetorno[] = "\$o".$nomeClasse;
                }
                else{
                    $aRetorno[] = "\$".(string)$oCampo['NOME'];
                }
            }
            break;
        }
        //print_r($aRetorno);
        return $aRetorno;	
    }

    /**
     * Retorna a instancia o objeto montada relacionada a tabela selecionada
     *
     * @param string $tabela
     * @param string $tipo 
     * @return string
     */ 
    function getObjetosMontados($tabela, $tipo="cad"){		
        $nomeClasse = ucfirst($this->getCamelMode($tabela));
        $sAtributos = join(",",$this->getAllAtributo($tabela));
        $aTabelaFK  = $this->getAllTabelaFK($tabela);
        
/*        
        Util::trace($nomeClasse);
        echo('-------------------------');
        Util::trace($sAtributos);
        echo('-------------------------');
        Util::trace($aTabelaFK);
        echo('-------------------------');
*/        
        $str = [];
        
        foreach($aTabelaFK as $sCampoFK => $aDadosTabelaFK){
            $argClasse = "\$$sCampoFK";
            $sTabelaFK  = ucfirst($this->getCamelMode($aDadosTabelaFK['FKTABELA']));
            $aTabelaFK2 = $this->getAllTabelaFK($aDadosTabelaFK['FKTABELA']);
            
//            Util::trace($aTabelaFK2);
//            echo('-------------------------');
            
            if(count($aTabelaFK2) > 0){
                foreach($aTabelaFK2 as $sCampoFK2 => $aDadosTabelaFK2){
                    if($aDadosTabelaFK2['CHAVE'] == '1'){
                        $sTabelaFK2 = ucfirst($this->getCamelMode($aDadosTabelaFK2['FKTABELA']));
                        $str[] = "\$o$sTabelaFK2 = new $sTabelaFK2(\$$sCampoFK2);";
                        $argClasse = "\$o$sTabelaFK2";
                    }
                }
            }
            
            $str[] = "\$o$sTabelaFK = new $sTabelaFK($argClasse);";
        }
        $str[] = "\$o$nomeClasse = new $nomeClasse(".$sAtributos.");";
        return ($tipo == "cad") ? join($str,"\n\t\t") : join($str,"\n\t\t\t");;
    }

    /**
     * Retorna a instancia o objeto BD montada relacionada a tabela selecionada
     *
     * @param string $tabela
     * @return string
     */
    function getObjetoBDMontado($tabela){
        $nomeClasse = ucfirst($this->getCamelMode($tabela));
        return "\$o$nomeClasse"."BD = new $nomeClasse"."BD();";
    }
    
    /**
     * Retorna o nome da variável no formato Camel Mode
     * 
     * @param string $v
     * @return string
     */
    function getCamelMode($v){
        $vet = explode("_", $v);
        foreach($vet as $ch => $val){
            $vet[$ch] = ($ch > 0) ? ucfirst($val) : $val;
        }

        return join($vet, "");
    }
}