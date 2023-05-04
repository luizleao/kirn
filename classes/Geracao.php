<?php
namespace classes;

use Exception;
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
class Geracao
{

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
     * @param string $xml
     *            arquivo xml
     * @param string $gui
     *            modelo de GUI escolhido
     * @param string $projeto
     *            nome do projeto
     * @return void
     */
    function __construct($xml, $gui = NULL, $projeto = NULL)
    {
        require_once ('Autoload.php');

        $this->projeto = $projeto;
        $file = file($xml);
        $this->xml = join("", $file);
        $this->gui = $gui;

        if ($projeto != NULL) {
            $dir = dirname(dirname(__FILE__)) . "/geradas";
            if (! file_exists($dir))
                mkdir($dir);

            $dir = dirname(dirname(__FILE__)) . "/geradas/" . $this->projeto;
            if (! file_exists($dir))
                mkdir($dir);

            $dir = dirname(dirname(__FILE__)) . "/geradas/" . $this->projeto . "/classes";
            if (! file_exists($dir))
                mkdir($dir);

            $dir = dirname(dirname(__FILE__)) . "/geradas/" . $this->projeto . "/classes/core";
            if (! file_exists($dir))
                mkdir($dir);
        }

        // Util::trace($this);
    }

    /**
     * Geracao das Classes Basicas
     *
     * @return bool
     */
    function geraClassesBasicas()
    {
        # Abre o template da classe basica e armazena conteudo do modelo
        $modelo = Util::getConteudoTemplate('Modelo.class.tpl');

        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);
        // print_r($aBanco);
        # varre a estrutura das tabelas
        foreach ($aBanco as $aTabela) {
            $copiaModelo = $modelo;
            $nomeClasse = ucfirst($this->getCamelMode($aTabela['name']));
            # Varre a estrutura dos campos da tabela em questao
            $aAtributo = $aListaAtributo = $aAtribuicao = array();
            foreach ($aTabela as $oCampo) {
                $nomeCampo = (string) $oCampo['name'];
                if ((string) $oCampo['fkTable'] != '') {
                    # Processa nome original da tabela estrangeira
                    $nomeFKClasse = ucfirst($this->getCamelMode((string) $oCampo['fkTable']));

                    // if($nomeFKClasse == $nomeClasse){
                    $nomeCampo = "o" . ucfirst(preg_replace("#^(?:id_?|cd_?)(.*?)#is", "$1", $nomeCampo));
                    // }
                    // else {
                    $nomeCampo = "o$nomeFKClasse";
                    // }
                }

                # Atribui resultados
                $aAtributo[] = "\tpublic \$$nomeCampo;";
                $aListaAtributo[] = ($oCampo['fkTable'] != '') ? "$nomeFKClasse \$$nomeCampo = NULL" : "\$$nomeCampo = NULL";
                $auxAtributos = ($oCampo['fkTable'] != '') ? "\$this->$nomeCampo = (\$$nomeCampo == NULL) ? new $nomeFKClasse() : \$$nomeCampo;" : "\$this->$nomeCampo = \$$nomeCampo;";
                $aAtribuicao[] = "\t\t$auxAtributos";
            }

            # Monta demais valores a serem substituidos
            $atributos = join("\n", $aAtributo);
            $listaAtributos = join(", ", $aListaAtributo);
            $atribuicao = join("\n", $aAtribuicao);

            # Substitui todas os parametros pelas variaveis ja processadas
            $copiaModelo = str_replace('%%NOME_CLASSE%%', $nomeClasse, $copiaModelo);
            $copiaModelo = str_replace('%%ATRIBUTOS%%', $atributos, $copiaModelo);
            $copiaModelo = str_replace('%%LISTA_ATRIBUTOS%%', $listaAtributos, $copiaModelo);
            $copiaModelo = str_replace('%%ATRIBUICAO%%', $atribuicao, $copiaModelo);
            $copiaModelo = str_replace('%%TOSTRING%%', $this->getTituloObjeto((string) $aTabela['name']), $copiaModelo);

            $dir = dirname(dirname(__FILE__)) . "/geradas/" . $this->projeto . "/classes/core/model";
            if (! file_exists($dir))
                mkdir($dir);

            $fp = fopen("$dir/$nomeClasse.class.php", "w");
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
    public function geraClasseController()
    {
        # Abre o template da classe Controle e armazena conteudo do modelo
        $modeloController = Util::getConteudoTemplate('Modelo.Controller.class.tpl');

        # Abre o template dos metodos de cadastros e armazena conteudo do modelo
        $modeloCadastrar = Util::getConteudoTemplate('metodoCadastrar.tpl');
        $modeloAlterar = Util::getConteudoTemplate('metodoAlterar.tpl');
        $modeloExcluir = Util::getConteudoTemplate('metodoExcluir.tpl');
        $modeloGet = Util::getConteudoTemplate('metodoGet.tpl');
        $modeloGetAll = Util::getConteudoTemplate('metodoGetAll.tpl');
        $modeloConsultar = Util::getConteudoTemplate('metodoConsultar.tpl');
        $modeloTotalColecao = Util::getConteudoTemplate('metodoTotalColecao.tpl');

        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);

        # Varre a estrutura das tabelas
        $copiaModeloController = $modeloController;

        // Util::trace($aBanco);exit;

        foreach ($aBanco as $aTabela) {
            // Util::trace($aTabela);

            $aPKDoc = $aPK = [];

            foreach ($aTabela as $oCampo) {
                if ($oCampo['pk'] == 'true') {
                    $aPKDoc[] = "\t * @param integer \$" . $oCampo['name'];
                    $aPK[] = "\$" . $oCampo['name'];
                }
            }

            # Montar a Lista de DOC do metodo selecionar
            $listaPKDoc = join("\n", $aPKDoc);
            $listaPK = join(",", $aPK);

            # Recupera o nome da tabela e gera os valores a serem gerados
            $nomeClasse = ucfirst($this->getCamelMode($aTabela['name']));

            // Util::trace($nomeClasse);

            $montaObjetoCAD = $this->getObjetosMontados($aTabela['name']);
            $montaObjetoEDIT = $this->getObjetosMontados($aTabela['name'], "edit");

            $montaObjetoBD = $this->getObjetoBDMontado($aTabela['name']);

            # Cadastrar
            $copiaModeloCadastrar = str_replace('%%NOME_CLASSE%%', $nomeClasse, $modeloCadastrar);
            $copiaModeloCadastrar = str_replace('%%MONTA_OBJETO%%', $montaObjetoCAD, $copiaModeloCadastrar);
            $copiaModeloCadastrar = str_replace('%%MONTA_OBJETOBD%%', $montaObjetoBD, $copiaModeloCadastrar);

            # Alterar
            $copiaModeloAlterar = str_replace('%%NOME_CLASSE%%', $nomeClasse, $modeloAlterar);
            $copiaModeloAlterar = str_replace('%%MONTA_OBJETO%%', $montaObjetoEDIT, $copiaModeloAlterar);
            $copiaModeloAlterar = str_replace('%%MONTA_OBJETOBD%%', $montaObjetoBD, $copiaModeloAlterar);

            # Excluir
            $copiaModeloExcluir = str_replace('%%NOME_CLASSE%%', $nomeClasse, $modeloExcluir);
            $copiaModeloExcluir = str_replace('%%MONTA_OBJETOBD%%', $montaObjetoBD, $copiaModeloExcluir);
            $copiaModeloExcluir = str_replace('%%DOC_LISTA_PK%%', $listaPKDoc, $copiaModeloExcluir);
            $copiaModeloExcluir = str_replace('%%LISTA_PK%%', $listaPK, $copiaModeloExcluir);

            # Get
            $copiaModeloGet = str_replace('%%NOME_CLASSE%%', $nomeClasse, $modeloGet);
            $copiaModeloGet = str_replace('%%MONTA_OBJETOBD%%', $montaObjetoBD, $copiaModeloGet);
            $copiaModeloGet = str_replace('%%DOC_LISTA_PK%%', $listaPKDoc, $copiaModeloGet);
            $copiaModeloGet = str_replace('%%LISTA_PK%%', $listaPK, $copiaModeloGet);

            # GetAll
            $copiaModeloGetAll = str_replace('%%NOME_CLASSE%%', $nomeClasse, $modeloGetAll);
            $copiaModeloGetAll = str_replace('%%MONTA_OBJETOBD%%', $montaObjetoBD, $copiaModeloGetAll);

            # Consultar
            $copiaModeloConsultar = str_replace('%%NOME_CLASSE%%', $nomeClasse, $modeloConsultar);
            $copiaModeloConsultar = str_replace('%%MONTA_OBJETOBD%%', $montaObjetoBD, $copiaModeloConsultar);

            # Total Colecao
            $copiaModeloTotalColecao = str_replace('%%NOME_CLASSE%%', $nomeClasse, $modeloTotalColecao);

            # ==== Geração das Controllers das Classes =====
            $copiaModeloController = str_replace('%%NOME_CLASSE%%', $nomeClasse, $modeloController);
            $copiaModeloController = str_replace('%%METODO_CREATE%%', $copiaModeloCadastrar, $copiaModeloController);
            $copiaModeloController = str_replace('%%METODO_UPDATE%%', $copiaModeloAlterar, $copiaModeloController);
            $copiaModeloController = str_replace('%%METODO_DEL%%', $copiaModeloExcluir, $copiaModeloController);
            $copiaModeloController = str_replace('%%METODO_GET%%', $copiaModeloGet, $copiaModeloController);
            $copiaModeloController = str_replace('%%METODO_GETALL%%', $copiaModeloGetAll, $copiaModeloController);
            $copiaModeloController = str_replace('%%METODO_SEARCH%%', $copiaModeloConsultar, $copiaModeloController);
            $copiaModeloController = str_replace('%%METODO_TOTAL%%', $copiaModeloTotalColecao, $copiaModeloController);

            // Util::trace($copiaModeloController);
            // Util::trace($copiaModeloCadastrar);

            $dir = dirname(dirname(__FILE__)) . "/geradas/" . $this->projeto . "/classes";
            if (! file_exists($dir))
                mkdir($dir);

            // echo "@@".$dir;

            $fController = fopen("$dir/Controller$nomeClasse.class.php", "w");
            fputs($fController, $copiaModeloController);
            fclose($fController);

            // Util::trace($copiaModeloController);
            // Util::trace("$dir/Controller$nomeClasse.class.php");
        }

        # ============ Adicionando Classes de core/Config =========
        $modeloConfig = Util::getConteudoTemplate("Modelo.Config." . $aBanco['dbms'] . ".tpl");
        $modeloConfig = str_replace('%%DATABASE%%', $this->projeto, $modeloConfig);
        $modeloConfig = str_replace('%%HOST%%', $aBanco['host'], $modeloConfig);
        $modeloConfig = str_replace('%%USER%%', $aBanco['user'], $modeloConfig);
        $modeloConfig = str_replace('%%SENHA%%', $aBanco['passwd'], $modeloConfig);

        $fpConfig = fopen("$dir/core/config.ini", "w");

        // echo "@@$dir/core/config.ini";

        fputs($fpConfig, $modeloConfig);
        fclose($fpConfig);

        // copy(dirname(__FILE__)."/MAP.class.php", "$dir/core/MAP.class.php");
        copy(dirname(dirname(__FILE__)) . "/templates/Controller.class.php", "$dir/Controller.class.php");
        copy(dirname(__FILE__) . "/autoload.php", "$dir/autoload.php");
        copy(dirname(__FILE__) . "/Util.class.php", "$dir/core/Util.class.php");
        copy(dirname(__FILE__) . "/Conexao.class.php", "$dir/core/Conexao.class.php");

        return true;
    }

    /**
     * Geracao da Classe Validador Formulario
     *
     * @return bool
     */
    function geraClasseValidadorFormulario()
    {
        # Abre o template da classe basica e armazena conteudo do modelo
        $modelo1 = Util::getConteudoTemplate('Modelo.ValidadorFormulario.class.tpl');
        $modelo2 = Util::getConteudoTemplate('metodoValidaForm.tpl');

        # abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);
        $aModeloFinal = array();

        # varre a estrutura das tabelas
        foreach ($aBanco as $aTabela) {
            $nomeClasse = ucfirst($this->getCamelMode((string) $aTabela['name']));
            $copiaModelo1 = $modelo1;
            $copiaModelo2 = $modelo2;

            # ==== varre a estrutura dos campos da tabela em questao ====
            $camposForm = array();
            foreach ($aTabela as $oCampo) {
                # recupera campo e tabela e campos (chave estrangeira)
                $nomeCampoOriginal = (string) $oCampo['name'];
                # processa nome original da tabela estrangeira
                $nomeFKClasse = (string) $oCampo['fkTable'];

                # monta parametros a serem substituidos posteriormente
                $label = ($nomeFKClasse != '') ? ucfirst(strtolower($nomeFKClasse)) : ucfirst(str_replace($nomeClasse, "", $nomeCampoOriginal));
                $camposForm[] = ((string) $oCampo['pk'] == 'true') ? "if(\$acao == 2){\n\t\t\tif(\$$nomeCampoOriginal == ''){\n\t\t\t\t\$this->msg = \"$label inválido!\";\n\t\t\t\treturn false;\n\t\t\t}\n\t\t}" : "if(\$$nomeCampoOriginal == ''){\n\t\t\t\$this->msg = \"$label inválido!\";\n\t\t\treturn false;\n\t\t}\t";
            }
            # monta demais valores a serem substituidos
            $camposForm = join("\n\t\t", $camposForm);

            # substitui todas os parametros pelas variaveis já processadas
            $copiaModelo2 = str_replace('%%NOME_CLASSE%%', $nomeClasse, $copiaModelo2);
            $copiaModelo2 = str_replace('%%ATRIBUICAO%%', $camposForm, $copiaModelo2);

            $aModeloFinal[] = $copiaModelo2;
        }

        $modeloFinal = str_replace('%%FUNCOES%%', join("\n\n", $aModeloFinal), $copiaModelo1);

        $dir = dirname(dirname(__FILE__)) . "/geradas/" . $this->projeto . "/classes";
        if (! file_exists($dir))
            mkdir($dir);

        $fp = fopen("$dir/ValidadorFormulario.class.php", "w");
        fputs($fp, $modeloFinal);
        fclose($fp);

        return true;
    }

    /**
     * Geracao da Classe Dados Formulario
     *
     * @return bool
     */
    function geraClasseDadosFormulario()
    {
        # Abre o template da classe basica e armazena conteudo do modelo
        $modelo1 = Util::getConteudoTemplate('Modelo.DadosFormulario.class.tpl');
        $modelo2 = Util::getConteudoTemplate('metodoDadosForm.tpl');

        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);

        $aModeloFinal = [];

        # Varre a estrutura das tabelas
        foreach ($aBanco as $aTabela) {
            $nomeClasse = ucfirst($this->getCamelMode($aTabela['name']));

            $copiaModelo1 = $modelo1;
            $copiaModelo2 = $modelo2;

            # varre a estrutura dos campos da tabela em questao
            $camposForm = array();
            foreach ($aTabela as $oCampo) {
                # recupera campo e tabela e campos (chave estrangeira)
                $nomeCampoOriginal = (string) $oCampo['name'];

                # monta parametros a serem substituidos posteriormente
                switch ((string) $oCampo['type']) {
                    case 'date':
                        $camposForm[] = "\$post[\"$nomeCampoOriginal\"] = strip_tags(addslashes(trim(\$post[\"$nomeCampoOriginal\"] ?? \"\")));";
                        break;

                    case 'datetime':
                    case 'timestamp':
                        $camposForm[] = "\$post[\"$nomeCampoOriginal\"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim(\$post[\"$nomeCampoOriginal\"] ?? \"\"))));";
                        break;

                    default:
                        if (preg_match("#decimal#i", $oCampo['type'])) {
                            if (preg_match("#(?:preco|valor)#i", $oCampo['name'])) {
                                $camposForm[] = "\$post[\"$nomeCampoOriginal\"] = Util::formataMoedaBanco(strip_tags(addslashes(trim(\$post[\"$nomeCampoOriginal\"] ?? \"\"))));";
                            }
                        } else {

                            if ((string) $oCampo['pk'] == 'true')
                                if ((string) $aTabela['type'] != 'NORMAL')
                                    $camposForm[] = "\$post[\"$nomeCampoOriginal\"] = strip_tags(addslashes(trim(\$post[\"$nomeCampoOriginal\"] ?? \"\")));";
                                else
                                    $camposForm[] = "if(\$acao == 2){\n\t\t\t\$post[\"$nomeCampoOriginal\"] = strip_tags(addslashes(trim(\$post[\"$nomeCampoOriginal\"] ?? \"\")));\n\t\t}";
                            else
                                $camposForm[] = "\$post[\"$nomeCampoOriginal\"] = strip_tags(addslashes(trim(\$post[\"$nomeCampoOriginal\" ?? \"\"])));";
                        }
                        break;
                }
            }
            # monta demais valores a serem substituidos
            $camposForm = join("\n\t\t", $camposForm);

            # substitui todas os parametros pelas variaveis ja processadas
            $copiaModelo2 = str_replace('%%NOME_CLASSE%%', $nomeClasse, $copiaModelo2);
            $copiaModelo2 = str_replace('%%ATRIBUICAO%%', $camposForm, $copiaModelo2);

            $aModeloFinal[] = $copiaModelo2;
            // echo $copiaModelo2."<br />";
        }

        // Util::trace($aModeloFinal);

        $modeloFinal = str_replace('%%FUNCOES%%', join("\n\n", $aModeloFinal), $copiaModelo1);

        $dir = dirname(dirname(__FILE__)) . "/geradas/" . $this->projeto . "/classes";
        if (! file_exists($dir))
            mkdir($dir);

        $fp = fopen("$dir/DadosFormulario.class.php", "w");
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
    public function geraInterface()
    {
        # Abre o template da classe basica e armazena conteudo do modelo
        $modeloAdm = Util::getConteudoTemplate($this->gui . '/Modelo.adm.tpl');
        $modeloFrm = Util::getConteudoTemplate($this->gui . '/Modelo.frm.tpl');
        $modeloDetail = Util::getConteudoTemplate($this->gui . '/Modelo.detail.tpl');

        $dir = '';

        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);

        # Varre a estrutura das tabelas
        foreach ($aBanco as $aTabela) {
            // === Nao gerar interface de tabelas n:m
            if ((string) $aTabela['type'] == 'N:M')
                continue;

            $copiaModeloAdm = $modeloAdm;
            $copiaModeloFrm = $modeloFrm;
            $copiaModeloDetail = $modeloDetail;

            $nomeClasse = ucfirst($this->getCamelMode((string) $aTabela['name']));
            $objetoClasse = "\$o$nomeClasse";

            # Varre a estrutura dos campos da tabela em questao
            $aPKRequest = $aCampoPK = $aCampoFrm = $aTituloAdm = $aCampoAdm = $aGetAll = $aCampoDetail = [];
            $PK = $ID_PK = $label = $campoAdm = $componenteFrm = $campoDetail = NULL;

            foreach ($aTabela as $oCampo) {

                $nomeFKClasse = ucfirst($this->getCamelMode((string) $oCampo['fkTable']));
                // $label = ((string)$oCampo['fkColumn'] != '') ? ucfirst(preg_replace("#^(?:id_?|cd_?)(.*?)#is", "$1", (string)$oCampo['name'])) :
                $label = ((string) $oCampo['fkColumn'] != '') ? $nomeFKClasse : ucfirst(str_replace((string) $aTabela['name'], "", (string) $oCampo['name']));

                $campoAdm = ((string) $oCampo['fkColumn'] != '') ? $objetoClasse . "->o$label" . "->" . $this->getTituloObjeto((string) $oCampo['fkTable']) : $objetoClasse . "->" . $oCampo['name'];

                if ((string) $oCampo['pk'] == "true") {
                    $aPKRequest[] = "\$_REQUEST['{$oCampo['name']}']";
                    $aCampoPK[] = Form::geraHidden((string) $oCampo['name']);

                    if ((string) $oCampo['fkTable'] != '') { // Tabela cuja PK = FK => Relacao 1:1
                        $PK = "o$nomeFKClasse" . "->" . $oCampo['fkColumn'];
                        $ID_PK = $oCampo['fkColumn'];

                        // print "($objetoClasse, {$oCampo['name']}, $label, $nomeFKClasse, ".$this->getTituloObjeto((string)$oCampo['fkTable']).", 'CAD')\n";
                        $componenteFrm = Form::geraSelect($objetoClasse, (string) $oCampo['name'], $label, $oCampo['fkColumn'], $this->getTituloObjeto((string) $oCampo['fkTable']), 'EDIT', $this->gui);
                    } else {
                        $PK = (string) $oCampo['name'];
                        $ID_PK = (string) $oCampo['name'];
                    }
                } else {
                    switch ((string) $oCampo['type']) {
                        case "date":
                            $componenteFrm = Form::geraCalendario($objetoClasse, (string) $oCampo['name'], $label, 'EDIT', false, $this->gui);
                            $campoAdm = Form::geraCalendario($objetoClasse, (string) $oCampo['name'], $label, 'ADM', false, $this->gui);
                            break;

                        case "datetime":
                        case "timestamp":
                            $componenteFrm = Form::geraCalendario($objetoClasse, (string) $oCampo['name'], $label, 'EDIT', true, $this->gui);
                            $campoAdm = Form::geraCalendario($objetoClasse, (string) $oCampo['name'], $label, 'ADM', true, $this->gui);
                            break;

                        case "text":
                            $componenteFrm = Form::geraTextArea($objetoClasse, (string) $oCampo['name'], $label, 'EDIT', $this->gui);
                            break;

                        case "tinyint(1)":
                            $componenteFrm = Form::geraCheckBox($objetoClasse, (string) $oCampo['name'], $label, 'EDIT', $this->gui);
                            break;

                        default:
                            if ($oCampo['fkColumn'] != '') {
                                $componenteFrm = Form::geraSelect($objetoClasse, (string) $oCampo['name'], $label, $oCampo['fkColumn'], $this->getTituloObjeto((string) $oCampo['fkTable']), 'EDIT', $this->gui);
                            } else {
                                $componenteFrm = (preg_match("#(?:senha|password)#is", $oCampo['name'])) ? Form::geraPassword($objetoClasse, (string) $oCampo['name'], $label, 'EDIT', $this->gui) : Form::geraInput($objetoClasse, (string) $oCampo['name'], $label, 'EDIT', (string) $oCampo['type'], $this->gui);
                                // Util::trace($oCampo);
                            }
                            # ============ Campo Enum =============
                            if (preg_match("#enum#i", (string) $oCampo['type'])) {
                                $componenteFrm = Form::geraEnum($objetoClasse, (string) $oCampo['name'], (string) $oCampo['type'], $label, 'EDIT', $this->gui);
                            }
                            break;
                    }
                }

                $campoDetail = Form::geraDetailText($campoAdm, $label, $this->gui);

                $aCampoFrm[] = $componenteFrm;
                $aTituloAdm[] = "<th>$label</th>";
                $aCampoAdm[] = "<td><?=$campoAdm?></td>";
                $aCampoDetail[] = $campoDetail;
            }

            # ===== Montar lista dos metodos Carregar Colecao =======
            $aTabelaFK = $this->getAllTabelaFK((string) $aTabela['name']);

            foreach ($aTabelaFK as $oCampoFK => $oDadosTabelaFK) {
                $nomeClasseFK = ucfirst($this->getCamelMode($oDadosTabelaFK['fkTable']));
                $aGetAll[] = "\$a$nomeClasseFK = (new Controller$nomeClasseFK())->getAll([], []);";
            }

            # monta demais valores a serem substituidos
            $sPKRequest = join(", ", $aPKRequest);
            $sTituloAdm = join("\n\t\t\t\t\t", $aTituloAdm);
            $sCampoAdm = join("\n\t\t\t\t\t", $aCampoAdm);
            $sCampoFrm = join("\n", $aCampoFrm);
            $sCampoPK = join("\n", $aCampoPK);
            $sCampoDetail = join("\n", $aCampoDetail);

            $sGetAll = (count($aGetAll) > 0) ? join("\n", $aGetAll) : "";

            # substitui todas os parametros pelas variaveis ja processadas
            $copiaModeloAdm = str_replace('%%NOME_CLASSE%%', $nomeClasse, $copiaModeloAdm);
            $copiaModeloAdm = str_replace('%%TITULOATRIBUTOS%%', $sTituloAdm, $copiaModeloAdm);
            $copiaModeloAdm = str_replace('%%VALORATRIBUTOS%%', $sCampoAdm, $copiaModeloAdm);
            $copiaModeloAdm = str_replace('%%ADM_INFO%%', (($PK != '') ? Form::geraAdmInfo($nomeClasse, $ID_PK, $PK, $this->gui) : ''), $copiaModeloAdm);
            $copiaModeloAdm = str_replace('%%ADM_EDIT%%', (($PK != '') ? Form::geraAdmEdit($nomeClasse, $ID_PK, $PK, $this->gui) : ''), $copiaModeloAdm);
            $copiaModeloAdm = str_replace('%%ADM_DELETE%%', (($PK != '') ? Form::geraAdmDelete($nomeClasse, $ID_PK, $PK, $this->gui) : ''), $copiaModeloAdm);

            /* ========= 2 devido as colunas Editar e Excluir ============= */
            $copiaModeloAdm = str_replace('%%NUMERO_COLUNAS%%', count($aTituloAdm) + 3, $copiaModeloAdm);
            $copiaModeloAdm = str_replace('%%PK_REQUEST%%', $sPKRequest, $copiaModeloAdm);
            $copiaModeloAdm = str_replace('%%PK%%', "{$aTabela['name']}.$ID_PK", $copiaModeloAdm);

            # ================ Template Frm ==================
            $copiaModeloFrm = str_replace('%%NOME_CLASSE%%', $nomeClasse, $copiaModeloFrm);
            $copiaModeloFrm = str_replace('%%CARREGA_COLECAO%%', $sGetAll, $copiaModeloFrm);
            $copiaModeloFrm = str_replace('%%ATRIBUICAO%%', $sCampoFrm, $copiaModeloFrm);
            $copiaModeloFrm = str_replace('%%CHAVE_PRIMARIA%%', $sCampoPK, $copiaModeloFrm);
            $copiaModeloFrm = str_replace('%%PK%%', $PK, $copiaModeloFrm);
            $copiaModeloFrm = str_replace('%%ID_PK%%', $ID_PK, $copiaModeloFrm);

            # ================ Template Detail ==================
            $copiaModeloDetail = str_replace('%%NOME_CLASSE%%', $nomeClasse, $copiaModeloDetail);
            $copiaModeloDetail = str_replace('%%ATRIBUICAO%%', $sCampoDetail, $copiaModeloDetail);
            $copiaModeloDetail = str_replace('%%ID_PK%%', $ID_PK, $copiaModeloDetail);

            $dir = dirname(dirname(__FILE__)) . "/geradas/" . $this->projeto . "/";

            if (! file_exists($dir))
                mkdir($dir);

            $fpAdm = fopen("$dir/adm$nomeClasse.php", "w");
            fputs($fpAdm, $copiaModeloAdm);
            fclose($fpAdm);
            $fpFrm = fopen("$dir/frm$nomeClasse.php", "w");
            fputs($fpFrm, $copiaModeloFrm);
            fclose($fpFrm);
            $fpDetail = fopen("$dir/detail$nomeClasse.php", "w");
            fputs($fpDetail, $copiaModeloDetail);
            fclose($fpDetail);

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
        $modeloIndex = Util::getConteudoTemplate($this->gui . '/index.php');
        $modeloIndex = str_replace('%%PROJETO%%', ucfirst($aBanco['name']), $modeloIndex);

        $fpIndex = fopen("$dir/index.php", "w");
        fputs($fpIndex, $modeloIndex);
        fclose($fpIndex);

        # ============== Arquivo de titulo ===================
        $modeloTitulo = Util::getConteudoTemplate($this->gui . '/Modelo.titulo.tpl');
        $modeloTitulo = str_replace('%%DATABASE%%', ucfirst($aBanco['name']), $modeloTitulo);

        $fpTitulo = fopen($dir . "includes/titulo.php", "w");
        fputs($fpTitulo, $modeloTitulo);
        fclose($fpTitulo);

        // ========= Copiar arquivos adicionais do projeto ========
        copy(dirname(dirname(__FILE__)) . "/templates/{$this->gui}/home.php", "$dir/home.php");

        return true;
    }

    /**
     * Geracao das Interfaces do sistema
     *
     * @access public
     * @return bool
     */
    public function geraInterfaceAux()
    {
        $dir = dirname(dirname(__FILE__)) . "/geradas/" . $this->projeto . "/";
        if (! file_exists($dir))
            mkdir($dir);

        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);

        # ==== Alterar arquivo index =====
        $modeloIndex = Util::getConteudoTemplate($this->gui . '/index.php');
        $modeloIndex = str_replace('%%PROJETO%%', ucfirst($aBanco['name']), $modeloIndex);

        $fpIndex = fopen("$dir/index.php", "w");
        fputs($fpIndex, $modeloIndex);
        fclose($fpIndex);

        # ============== Arquivo de titulo ===================
        $modeloTitulo = Util::getConteudoTemplate($this->gui . '/Modelo.titulo.tpl');
        $modeloTitulo = str_replace('%%DATABASE%%', ucfirst($aBanco['name']), $modeloTitulo);

        $fpTitulo = fopen($dir . "includes/titulo.php", "w");
        fputs($fpTitulo, $modeloTitulo);
        fclose($fpTitulo);

        // ========= Copiar arquivos adicionais do projeto ========
        copy(dirname(dirname(__FILE__)) . "/templates/{$this->gui}/home.php", "$dir/home.php");

        $this->geraInterfaceAdm();
        $this->geraInterfaceFrm();
        $this->geraInterfaceDetail();
        return true;
    }

    /**
     * Geracao das Interfaces Detail do sistema
     *
     * @access public
     * @return bool
     */
    public function geraInterfaceDetail()
    {
        # Abre o template da classe basica e armazena conteudo do modelo
        $modeloDetail = Util::getConteudoTemplate($this->gui . '/Modelo.detail.tpl');

        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);

        # Varre a estrutura das tabelas
        foreach ($aBanco as $aTabela) {
            // === Nao gerar interface de tabelas n:m
            if ((string) $aTabela['type'] == 'N:M')
                continue;
            $copiaModeloDetail = $modeloDetail;

            $nomeClasse = ucfirst($this->getCamelMode((string) $aTabela['name']));
            $objetoClasse = "\$o$nomeClasse";

            # Varre a estrutura dos campos da tabela em questao
            $aPKRequest = $aCampoPK = $aGetAll = $aCampoDetail = [];
            $ID_PK = $label = NULL;

            foreach ($aTabela as $oCampo) {

                $nomeFKClasse = ucfirst($this->getCamelMode((string) $oCampo['fkTable']));
                // $label = ((string)$oCampo['fkColumn'] != '') ? ucfirst(preg_replace("#^(?:id_?|cd_?)(.*?)#is", "$1", (string)$oCampo['name'])) :
                $label = ((string) $oCampo['fkColumn'] != '') ? $nomeFKClasse : ucfirst(str_replace((string) $aTabela['name'], "", (string) $oCampo['name']));

                $campoAdm = ((string) $oCampo['fkColumn'] != '') ? $objetoClasse . "->o$label" . "->" . $this->getTituloObjeto((string) $oCampo['fkTable']) : $objetoClasse . "->" . $oCampo['name'];

                if ((string) $oCampo['pk'] == "true") {
                    $aPKRequest[] = "\$_REQUEST['{$oCampo['name']}']";
                    $aCampoPK[] = Form::geraHidden((string) $oCampo['name']);

                    $ID_PK = ((string) $oCampo['fkTable'] != '') ? $oCampo['fkColumn'] : (string) $oCampo['name'];
                } else {
                    switch ((string) $oCampo['type']) {
                        case "date":
                            $campoAdm = Form::geraCalendario($objetoClasse, (string) $oCampo['name'], $label, 'ADM', false, $this->gui);
                            break;

                        case "datetime":
                        case "timestamp":
                            $campoAdm = Form::geraCalendario($objetoClasse, (string) $oCampo['name'], $label, 'ADM', true, $this->gui);
                            break;
                    }
                }

                $aCampoDetail[] = Form::geraDetailText($campoAdm, $label, $this->gui);
            }

            # ===== Montar lista dos metodos Carregar Colecao =======
            $aTabelaFK = $this->getAllTabelaFK((string) $aTabela['name']);

            foreach ($aTabelaFK as $oCampoFK => $oDadosTabelaFK) {
                $nomeClasseFK = ucfirst($this->getCamelMode($oDadosTabelaFK['fkTable']));
                $aGetAll[] = "\$oController$nomeClasseFK = new Controller$nomeClasseFK();\r\$a$nomeClasseFK = \$oController{$nomeClasseFK}->getAll([], []);";
            }

            # monta demais valores a serem substituidos
            $sCampoDetail = join($aCampoDetail, "\n");

            # substitui todas os parametros pelas variaveis ja processadas
            # ================ Template Detail ==================
            $copiaModeloDetail = str_replace('%%NOME_CLASSE%%', $nomeClasse, $copiaModeloDetail);
            $copiaModeloDetail = str_replace('%%ATRIBUICAO%%', $sCampoDetail, $copiaModeloDetail);
            $copiaModeloDetail = str_replace('%%ID_PK%%', $ID_PK, $copiaModeloDetail);

            $dir = dirname(dirname(__FILE__)) . "/geradas/" . $this->projeto . "/";

            if (! file_exists($dir))
                mkdir($dir);

            $fpDetail = fopen("$dir/detail$nomeClasse.php", "w");
            fputs($fpDetail, $copiaModeloDetail);
            fclose($fpDetail);

            // ======= Limpa arrays =======
            unset($aGetAll);
            unset($aPKRequest);
            unset($aCampoPK);
            unset($aCampoDetail);
        }

        return true;
    }

    /**
     * Geracao das Interfaces Frm do sistema
     *
     * @access public
     * @return bool
     */
    public function geraInterfaceFrm()
    {
        # Abre o template da classe basica e armazena conteudo do modelo
        $modeloFrm = Util::getConteudoTemplate($this->gui . '/Modelo.frm.tpl');

        $dir = '';

        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);

        # Varre a estrutura das tabelas
        foreach ($aBanco as $aTabela) {
            // === Nao gerar interface de tabelas n:m
            if ((string) $aTabela['type'] == 'N:M')
                continue;
            $copiaModeloFrm = $modeloFrm;

            $nomeClasse = ucfirst($this->getCamelMode((string) $aTabela['name']));
            $objetoClasse = "\$o$nomeClasse";

            # Varre a estrutura dos campos da tabela em questao
            $aPKRequest = $aCampoPK = $aCampoFrm = $aGetAll = [];
            $PK = $ID_PK = $label = $componenteFrm = NULL;

            foreach ($aTabela as $oCampo) {
                $nomeFKClasse = ucfirst($this->getCamelMode((string) $oCampo['fkTable']));
                // $label = ((string)$oCampo['fkColumn'] != '') ? ucfirst(preg_replace("#^(?:id_?|cd_?)(.*?)#is", "$1", (string)$oCampo['name'])) :
                $label = ((string) $oCampo['fkColumn'] != '') ? $nomeFKClasse : ucfirst(str_replace((string) $aTabela['name'], "", (string) $oCampo['name']));

                if ((string) $oCampo['pk'] == "true") {
                    $aPKRequest[] = "\$_REQUEST['{$oCampo['name']}']";
                    $aCampoPK[] = Form::geraHidden((string) $oCampo['name']);

                    if ((string) $oCampo['fkTable'] != '') { // Tabela cuja PK = FK => Relacao 1:1
                        $PK = "o$nomeFKClasse" . "->" . $oCampo['fkColumn'];
                        $ID_PK = $oCampo['fkColumn'];

                        // print "($objetoClasse, {$oCampo['name']}, $label, $nomeFKClasse, ".$this->getTituloObjeto((string)$oCampo['fkTable']).", 'CAD')\n";
                        $componenteFrm = Form::geraSelect($objetoClasse, (string) $oCampo['name'], $label, $oCampo['fkColumn'], $this->getTituloObjeto((string) $oCampo['fkTable']), 'EDIT', $this->gui);
                    } else {
                        $PK = (string) $oCampo['name'];
                        $ID_PK = (string) $oCampo['name'];
                    }
                } else {
                    switch ((string) $oCampo['type']) {
                        case "date":
                            $componenteFrm = Form::geraCalendario($objetoClasse, (string) $oCampo['name'], $label, 'EDIT', false, $this->gui);
                            break;

                        case "datetime":
                        case "timestamp":
                            $componenteFrm = Form::geraCalendario($objetoClasse, (string) $oCampo['name'], $label, 'EDIT', true, $this->gui);
                            break;

                        case "text":
                            $componenteFrm = Form::geraTextArea($objetoClasse, (string) $oCampo['name'], $label, 'EDIT', $this->gui);
                            break;

                        case "tinyint(1)":
                            $componenteFrm = Form::geraCheckBox($objetoClasse, (string) $oCampo['name'], $label, 'EDIT', $this->gui);
                            break;

                        default:
                            if ($oCampo['fkColumn'] != '') {
                                $componenteFrm = Form::geraSelect($objetoClasse, (string) $oCampo['name'], $label, $oCampo['fkColumn'], $this->getTituloObjeto((string) $oCampo['fkTable']), 'EDIT', $this->gui);
                            } else {
                                $componenteFrm = (preg_match("#(?:senha|password)#is", $oCampo['name'])) ? Form::geraPassword($objetoClasse, (string) $oCampo['name'], $label, 'EDIT', $this->gui) : Form::geraInput($objetoClasse, (string) $oCampo['name'], $label, 'EDIT', (string) $oCampo['type'], $this->gui);
                                // Util::trace($oCampo);
                            }
                            # ============ Campo Enum =============
                            if (preg_match("#enum#i", (string) $oCampo['type'])) {
                                $componenteFrm = Form::geraEnum($objetoClasse, (string) $oCampo['name'], (string) $oCampo['type'], $label, 'EDIT', $this->gui);
                            }
                            break;
                    }
                }

                $aCampoFrm[] = $componenteFrm;
            }

            # ===== Montar lista dos metodos Carregar Colecao =======
            $aTabelaFK = $this->getAllTabelaFK((string) $aTabela['name']);

            foreach ($aTabelaFK as $oCampoFK => $oDadosTabelaFK) {
                $nomeClasseFK = ucfirst($this->getCamelMode($oDadosTabelaFK['fkTable']));
                $aGetAll[] = "\$oController$nomeClasseFK = new Controller$nomeClasseFK();\r\$a$nomeClasseFK = \$oController{$nomeClasseFK}->getAll([], []);";
            }

            # monta demais valores a serem substituidos
            $sCampoFrm = join($aCampoFrm, "\n");
            $sCampoPK = join($aCampoPK, "\n");

            $sGetAll = (count($aGetAll) > 0) ? join($aGetAll, "\n") : "";

            # substitui todas os parametros pelas variaveis ja processadas

            # ================ Template Frm ==================
            $copiaModeloFrm = str_replace('%%NOME_CLASSE%%', $nomeClasse, $copiaModeloFrm);
            $copiaModeloFrm = str_replace('%%CARREGA_COLECAO%%', $sGetAll, $copiaModeloFrm);
            $copiaModeloFrm = str_replace('%%ATRIBUICAO%%', $sCampoFrm, $copiaModeloFrm);
            $copiaModeloFrm = str_replace('%%CHAVE_PRIMARIA%%', $sCampoPK, $copiaModeloFrm);
            $copiaModeloFrm = str_replace('%%PK%%', $PK, $copiaModeloFrm);
            $copiaModeloFrm = str_replace('%%ID_PK%%', $ID_PK, $copiaModeloFrm);

            $dir = dirname(dirname(__FILE__)) . "/geradas/" . $this->projeto . "/";

            if (! file_exists($dir))
                mkdir($dir);

            $fpFrm = fopen("$dir/frm$nomeClasse.php", "w");
            fputs($fpFrm, $copiaModeloFrm);
            fclose($fpFrm);

            // ======= Limpa arrays =======
            unset($aGetAll);
            unset($aCampoFrm);
            unset($aPKRequest);
            unset($aCampoPK);
        }

        return true;
    }

    /**
     * Geracao das Interfaces Adm do sistema
     *
     * @access public
     * @return bool
     */
    public function geraInterfaceAdm()
    {
        # Abre o template da classe basica e armazena conteudo do modelo
        $modeloAdm = Util::getConteudoTemplate($this->gui . '/Modelo.adm.tpl');
        $dir = '';

        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);

        # Varre a estrutura das tabelas
        foreach ($aBanco as $aTabela) {
            // === Nao gerar interface de tabelas n:m
            if ((string) $aTabela['type'] == 'N:M')
                continue;

            $copiaModeloAdm = $modeloAdm;

            $nomeClasse = ucfirst($this->getCamelMode((string) $aTabela['name']));
            $objetoClasse = "\$o$nomeClasse";

            # Varre a estrutura dos campos da tabela em questao
            $aPKRequest = $aTituloAdm = $aCampoAdm = $aGetAll = [];
            $PK = $ID_PK = $label = $campoAdm = NULL;

            foreach ($aTabela as $oCampo) {
                $nomeFKClasse = ucfirst($this->getCamelMode((string) $oCampo['fkTable']));
                $label = ((string) $oCampo['fkColumn'] != '') ? $nomeFKClasse : ucfirst(str_replace((string) $aTabela['name'], "", (string) $oCampo['name']));

                $campoAdm = ((string) $oCampo['fkColumn'] != '') ? $objetoClasse . "->o$label" . "->" . $this->getTituloObjeto((string) $oCampo['fkTable']) : $objetoClasse . "->" . $oCampo['name'];

                if ((string) $oCampo['pk'] == "true") {
                    $aPKRequest[] = "\$_REQUEST['{$oCampo['name']}']";

                    # Tabela cuja PK = FK => Relacao 1:1
                    $PK = ((string) $oCampo['fkTable'] != '') ? "o$nomeFKClasse" . "->" . $oCampo['fkColumn'] : (string) $oCampo['name'];
                    $ID_PK = ((string) $oCampo['fkTable'] != '') ? $oCampo['fkColumn'] : (string) $oCampo['name'];
                } else {
                    switch ((string) $oCampo['type']) {
                        case "date":
                            $campoAdm = Form::geraCalendario($objetoClasse, (string) $oCampo['name'], $label, 'ADM', false, $this->gui);
                            break;

                        case "datetime":
                        case "timestamp":
                            $campoAdm = Form::geraCalendario($objetoClasse, (string) $oCampo['name'], $label, 'ADM', true, $this->gui);
                            break;
                    }
                }
                $aTituloAdm[] = "<th>$label</th>";
                $aCampoAdm[] = "<td><?=$campoAdm?></td>";
            }

            # ===== Montar lista dos metodos Carregar Colecao =======
            $aTabelaFK = $this->getAllTabelaFK((string) $aTabela['name']);

            foreach ($aTabelaFK as $oCampoFK => $oDadosTabelaFK) {
                $nomeClasseFK = ucfirst($this->getCamelMode($oDadosTabelaFK['fkTable']));
                $aGetAll[] = "\$oController$nomeClasseFK = new Controller$nomeClasseFK();\r\$a$nomeClasseFK = \$oController{$nomeClasseFK}->getAll([], []);";
            }

            # monta demais valores a serem substituidos
            $sPKRequest = join($aPKRequest, ", ");
            $sTituloAdm = join($aTituloAdm, "\n\t\t\t\t\t");
            $sCampoAdm = join($aCampoAdm, "\n\t\t\t\t\t");

            # substitui todas os parametros pelas variaveis ja processadas
            $copiaModeloAdm = str_replace('%%NOME_CLASSE%%', $nomeClasse, $copiaModeloAdm);
            $copiaModeloAdm = str_replace('%%TITULOATRIBUTOS%%', $sTituloAdm, $copiaModeloAdm);
            $copiaModeloAdm = str_replace('%%VALORATRIBUTOS%%', $sCampoAdm, $copiaModeloAdm);
            $copiaModeloAdm = str_replace('%%ADM_INFO%%', (($PK != '') ? Form::geraAdmInfo($nomeClasse, $ID_PK, $PK, $this->gui) : ''), $copiaModeloAdm);
            $copiaModeloAdm = str_replace('%%ADM_EDIT%%', (($PK != '') ? Form::geraAdmEdit($nomeClasse, $ID_PK, $PK, $this->gui) : ''), $copiaModeloAdm);
            $copiaModeloAdm = str_replace('%%ADM_DELETE%%', (($PK != '') ? Form::geraAdmDelete($nomeClasse, $ID_PK, $PK, $this->gui) : ''), $copiaModeloAdm);

            /* ========= 2 devido as colunas Editar e Excluir ============= */
            $copiaModeloAdm = str_replace('%%NUMERO_COLUNAS%%', count($aTituloAdm) + 3, $copiaModeloAdm);
            $copiaModeloAdm = str_replace('%%PK_REQUEST%%', $sPKRequest, $copiaModeloAdm);
            $copiaModeloAdm = str_replace('%%PK%%', "{$aTabela['name']}.$ID_PK", $copiaModeloAdm);

            $dir = dirname(dirname(__FILE__)) . "/geradas/" . $this->projeto . "/";

            if (! file_exists($dir))
                mkdir($dir);

            $fpAdm = fopen("$dir/adm$nomeClasse.php", "w");
            fputs($fpAdm, $copiaModeloAdm);
            fclose($fpAdm);

            // ======= Limpa arrays =======
            unset($aGetAll);
            unset($aTituloAdm);
            unset($aCampoAdm);
            unset($aPKRequest);
        }
        return true;
    }

    /**
     * Geracao das Classes de Mapeamento
     *
     * @return bool
     */
    function geraClassesMAP()
    {
        # Abre o template da classe basica e armazena conteudo do modelo
        $modelo = Util::getConteudoTemplate('ModeloMAP.class.tpl');

        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);

        # Varre a estrutura das tabelas
        foreach ($aBanco as $aTabela) {
            $copiaModelo = $modelo;
            # Recupera o nome da tabela e gera o nome da classe
            $nomeTabela = ucfirst((string) $aTabela['name']);
            $nomeTabelaOriginal = (string) $aTabela['name'];

            $nomeClasse = ucfirst($this->getCamelMode($nomeTabela));
            $objetoClasse = "\$o$nomeClasse";
            # Varre a estrutura dos campos da tabela em questao
            $aTabelaCampos = $objToReg = $regToObj = $objToRegInsert = [];

            $aTabelaCampos = $this->getCamposArray($nomeTabelaOriginal);

            foreach ($aTabela as $oCampo) {
                # Processa nome original da tabela estrangeira
                $objetoFK = ucfirst($this->getCamelMode((string) $oCampo['fkTable']));
                $tabelaFK = (string) $oCampo['fkTable'];

                # Testando nova implementacao - Tirar caso ocorrer erro
                /*
                 * if($nomeFKClasse == $nomeClasse)
                 * $objetoFK = ucfirst(preg_replace("#^(?:id_?|cd_?)(.*?)#is", "$1", (string)$oCampo['name']));
                 *
                 *
                 * if((string)$oCampo['fkTable'] != ''){
                 * $objetoFK = ucfirst(preg_replace("#^(?:id_?|cd_?)(.*?)#is", "$1", (string)$oCampo['name']));
                 * }
                 */

                // $nomeCampo = $this->getCamelMode((string)$oCampo['name']); Alteracao SUDAM
                $nomeCampo = (string) $oCampo['name'];

                # Monta parametros a serem substituidos posteriormente
                if ($oCampo['fkTable'] == '') {
                    $objToReg[] = "\t\t\$reg['" . (string) $oCampo['name'] . "'] = $objetoClasse" . "->$nomeCampo;";
                    if ((string) $oCampo['pk'] == "false") {
                        $objToRegInsert[] = "\t\t\$reg['" . (string) $oCampo['name'] . "'] = $objetoClasse" . "->$nomeCampo;";
                    }
                    $regToObj[] = "\t\t$objetoClasse" . "->$nomeCampo = \$reg['$nomeTabelaOriginal" . "_" . (string) $oCampo['name'] . "'];";
                } else {
                    $objToReg[] = "\t\t\$o$objetoFK = $objetoClasse" . "->o$objetoFK;\n\t\t\$reg['" . (string) $oCampo['name'] . "'] = \$o$objetoFK" . "->" . (string) $oCampo['fkColumn'] . ";";
                    if ($oCampo['pk'] == "false") {
                        $objToRegInsert[] = "\t\t\$o$objetoFK = $objetoClasse" . "->o$objetoFK;\n\t\t\$reg['" . (string) $oCampo['name'] . "'] = \$o$objetoFK" . "->" . (string) $oCampo['fkColumn'] . ";";
                    }
                    $aux = $this->getArvoreObjeto($tabelaFK, $objetoFK);
                    $regToObj[] = "\n$aux\t\t$objetoClasse" . "->o$objetoFK = \$o$objetoFK;";
                }
            }

            # Monta demais valores a serem substituidos
            $objToReg = join("\n", $objToReg);
            $objToRegInsert = join("\n", $objToRegInsert);
            $regToObj = join("\n", $regToObj);

            # Substitui todas os parametros pelas variaveis ja processadas

            $sTabelaCampos = $this->serializeCamposTabela($aTabelaCampos);

            $copiaModelo = str_replace('%%ARRAY_CAMPOS%%', $sTabelaCampos, $copiaModelo);
            $copiaModelo = str_replace('%%NOME_CLASSE%%', $nomeClasse, $copiaModelo);
            $copiaModelo = str_replace('%%NOME_TABELA%%', $nomeTabela, $copiaModelo);
            $copiaModelo = str_replace('%%OBJETO_CLASSE%%', $objetoClasse, $copiaModelo);
            $copiaModelo = str_replace('%%OBJ_TO_REG%%', $objToReg, $copiaModelo);
            $copiaModelo = str_replace('%%OBJ_TO_REG_INSERT%%', $objToRegInsert, $copiaModelo);
            $copiaModelo = str_replace('%%REG_TO_OBJ%%', $regToObj, $copiaModelo);

            $dir = dirname(dirname(__FILE__)) . "/geradas/" . $this->projeto . "/classes/core/map";

            if (! file_exists($dir))
                mkdir($dir);

            $fp = fopen("$dir/$nomeClasse" . "MAP.class.php", "w");
            fputs($fp, $copiaModelo);
            fclose($fp);
        }
        return true;
    }

    /**
     * Geracao das Classes BDBase
     *
     * @return bool
     */
    function geraClassesBDBase()
    {
        # Abre o template da classe BD e armazena conteudo do modelo
        $modelo = Util::getConteudoTemplate('ModeloBDBase.class.tpl');

        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);

        # Varre a estrutura das tabelas
        foreach ($aBanco as $aTabela) {
            $copiaModelo = $modelo;
            $nomeClasse = $this->getCamelMode(ucfirst((string) $aTabela['name']));
            $objetoClasse = "\$o$nomeClasse";
            # varre a estrutura dos campos da tabela em questao
            $aCampoInsert = $aValorInsert = $aCampoUpdate = $aChaveWhere = $aCampoConsulta = [];
            $aChaveAltera = $aChave = $aChaveWhereSel = $aChaveWhereDel = $aFKJoin = $aVerificaPK = [];

            $i = 2;

            foreach ($aTabela as $oCampo) {
                $nomeCampo = (string) $oCampo['name'];
                if ($oCampo['pk'] == 'true') {
                    $autoInc = $oCampo['ai'];
                }
                # recupera valores a serem substituidos no modelo
                $aCampoInsert[] = $nomeCampo;
                if ((string) $oCampo['pk'] == 'true') {
                    $aChaveWhere[] = "$nomeCampo = {\$reg['$nomeCampo']}";
                    $aChaveWhereSel[] = (string) $aTabela['name'] . ".$nomeCampo = \$$nomeCampo";
                    $aChaveWhereDel[] = "$nomeCampo = \$$nomeCampo";
                    $aChave[] = "\$$nomeCampo";
                    $aVerificaPK[] = $nomeCampo;
                    $aChaveAltera[] = "\$cv == \"$nomeCampo\"";
                    if ((string) $oCampo['fkTable'] != '') {
                        $aCampoUpdate[] = "$nomeCampo = \".\$reg['$nomeCampo'].\"";
                    }
                } else {
                    $aCampoUpdate[] = ((string) $oCampo['fkTable'] != '') ? "$nomeCampo = \".\$reg['$nomeCampo'].\"" : "$nomeCampo = '\".\$reg['$nomeCampo'].\"'";
                }

                if ((string) $oCampo['fkTable'] != '') {
                    $aValorInsert[] = (preg_match("#[dD]ata.*[Cc]adastro#is", $nomeCampo)) ? "\".\$oConexao->data_cadastro_padrao.\"" : "\".\$reg['$nomeCampo'].\"";
                    $tabelaFK = ((string) $aTabela['schema'] != "") ? (string) $aTabela['schema'] . "." . (string) $oCampo['fkTable'] : (string) $oCampo['fkTable'];
                    $aFKJoin[] = "$tabelaFK \n\t\t\t\t\ton (" . (string) $aTabela['name'] . ".$nomeCampo = " . (string) $oCampo['fkTable'] . "." . (string) $oCampo['fkColumn'] . ")";

                    $i ++;
                } else {
                    $aValorInsert[] = ((string) $oCampo['pk'] == 'true') ? "\".\$reg['$nomeCampo'].\"" : "'\".\$reg['$nomeCampo'].\"'";
                }

                // =========== Montagem dos Campos da Consulta =============
                if ((string) $oCampo['pk'] != 'true') {
                    $aCampoConsulta[] = (string) $aTabela['name'] . ".$nomeCampo like '\$valor'";
                }
            }
            # =========== Monta demais valores a serem substituidos ========
            $aCampoInsert = join(",\n\t\t\t\t\t", $aCampoInsert);
            $aValorInsert = join(",\n\t\t\t\t\t", $aValorInsert);
            $aCampoUpdate = join(",\n\t\t\t\t\t", $aCampoUpdate);
            $aChaveWhere = join(" \n\t\t\t\t\tand ", $aChaveWhere);
            $aChaveWhereSel = join(" \n\t\t\t\t\tand ", $aChaveWhereSel);
            $aChaveWhereDel = join(" \n\t\t\t\t\tand ", $aChaveWhereDel);
            $sCampoConsulta = join(" \n\t\t\t\t\tor ", $aCampoConsulta);
            $aChave = join(",", $aChave);
            $aColuna = $this->getCamposSelect((string) $aTabela['name']);
            $aColuna = join(",\n\t\t\t\t\t", $aColuna);

            $tabelaJoin = (((string) $aTabela['schema'] != "") ? (string) $aTabela['schema'] . "." . (string) $aTabela['name'] : (string) $aTabela['name']);

            $sVerificaPK = NULL;
            foreach ($aVerificaPK as $v) {
                $sVerificaPK .= "\t\t\$reg['$v'] = (\$reg['$v'] != '') ? \$reg['$v'] : \"null\";\n";
            }

            if (count($aFKJoin) > 0) {
                $tabelaJoin .= " \n\t\t\t\tleft join " . join("\n\t\t\t\tleft join ", $aFKJoin);
            }

            $nomeTabela = (((string) $aTabela['schema'] != "") ? (string) $aTabela['schema'] . "." . (string) $aTabela['name'] : (string) $aTabela['name']);
            $chavesWhereConsulta = (($sCampoConsulta != '') ? $sCampoConsulta : '1=1');
            $sChaveAltera = (count($aChaveAltera) > 0) ? "if(" . implode(" || ", $aChaveAltera) . ") continue;" : "";

            # ======== Substitui todas os parametros pelas variaveis ja processadas ==========
            $copiaModelo = str_replace('%%NOME_CLASSE%%', $nomeClasse, $copiaModelo);
            $copiaModelo = str_replace('%%VERIFICA_PK%%', $sVerificaPK, $copiaModelo);
            $copiaModelo = str_replace('%%OBJETO_CLASSE%%', $objetoClasse, $copiaModelo);
            $copiaModelo = str_replace('%%RETURN_CADASTRAR%%', ($autoInc == "1") ? "\$this->oConexao->lastID()" : "true", $copiaModelo);
            $copiaModelo = str_replace('%%TABELA%%', $nomeTabela, $copiaModelo);
            $copiaModelo = str_replace('%%CAMPOS_INS%%', $aCampoInsert, $copiaModelo);
            $copiaModelo = str_replace('%%VAL_CAMPOS_INS%%', $aValorInsert, $copiaModelo);
            $copiaModelo = str_replace('%%CAMPOS_UPD%%', $aCampoUpdate, $copiaModelo);
            $copiaModelo = str_replace('%%CHAVES_WHERE%%', $aChaveWhere, $copiaModelo);
            $copiaModelo = str_replace('%%LISTA_CHAVES%%', $aChave, $copiaModelo);
            $copiaModelo = str_replace('%%CHAVES_WHERE_SEL%%', $aChaveWhereSel, $copiaModelo);
            $copiaModelo = str_replace('%%CHAVES_WHERE_DEL%%', $aChaveWhereDel, $copiaModelo);
            $copiaModelo = str_replace('%%TABELA_JOIN%%', $tabelaJoin, $copiaModelo);
            $copiaModelo = str_replace('%%CHAVES_WHERE_CONS%%', $chavesWhereConsulta, $copiaModelo);
            $copiaModelo = str_replace('%%COLUNAS%%', $aColuna, $copiaModelo); // Por Enquanto
            $copiaModelo = str_replace('%%CAMPOS_CHAVE_ALTERAR%%', $sChaveAltera, $copiaModelo);

            unset($sCampoConsulta);

            $dir = dirname(dirname(__FILE__)) . "/geradas/" . $this->projeto . "/classes/core/bdbase";
            if (! file_exists($dir))
                mkdir($dir);
            $fp = fopen("$dir/$nomeClasse" . "BDBase.class.php", "w");
            fputs($fp, $copiaModelo);
            fclose($fp);
        }
        return true;
    }

    /**
     * Geracao das Classes BD
     *
     * @return bool
     */
    function geraClassesBD()
    {
        # Abre o template da classe BD e armazena conteudo do modelo
        $modelo = Util::getConteudoTemplate('ModeloBD.class.tpl');

        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);

        # Varre a estrutura das tabelas
        foreach ($aBanco as $aTabela) {
            $nomeTabela = ucfirst((string) $aTabela['name']);
            $nomeClasse = $this->getCamelMode($nomeTabela);
            $copiaModelo = $modelo;

            # substitui todas os parametros pelas variaveis ja processadas
            $copiaModelo = str_replace('%%NOME_CLASSE%%', $nomeClasse, $copiaModelo);

            # Complementos adicionais para classes especificas
            $copiaModelo = str_replace('%%COMPLEMENTO%%', '', $copiaModelo);
            /*
             * $modeloTemp = NULL;
             *
             * switch($nomeClasse){
             * case 'Grupoprograma':
             * case 'Modulo':
             * case 'Programa':
             * case 'Usuario':
             * case 'Usuariogrupo':
             * $modeloTemp = Util::getConteudoTemplate("Modelo.$nomeClasse"."BD.class.php");
             * $copiaModelo = str_replace('%%COMPLEMENTO%%',$modeloTemp,$copiaModelo);
             * break;
             *
             * default:
             *
             * break;
             * }
             */
            $dir = dirname(dirname(__FILE__)) . "/geradas/" . $this->projeto . "/classes/bd";
            if (! file_exists($dir))
                mkdir($dir);
            $fp = fopen("$dir/$nomeClasse" . "BD.class.php", "w");
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
    function geraMenuEstatico()
    {
        try {
            # Abre o template da classe BD e armazena conteudo do modelo
            $modelo = Util::getConteudoTemplate($this->gui . '/Modelo.menu.tpl');
            $modeloItem = Util::getConteudoTemplate($this->gui . '/Modelo.menu.item.tpl');
            $copiaModelo = $modelo;
            $copiaModeloItem = $modeloItem;

            # Abre arquivo xml para navegacao
            $aBanco = simplexml_load_string($this->xml);
            $aItem = [];

            foreach ($aBanco as $aTabela) {
                if ($aTabela['type'] == 'N:M')
                    continue;

                $aItem[] = str_replace('%%NOME_CLASSE%%', ucfirst($this->getCamelMode($aTabela['name'])), $copiaModeloItem);
            }

            $listaItens = join("\n\n", $aItem);

            $copiaModelo = str_replace('%%MODELO_MENU%%', $listaItens, $copiaModelo);
            $copiaModelo = str_replace('%%PROJETO%%', ucfirst($aBanco['name']), $copiaModelo);

            $dir = dirname(dirname(__FILE__)) . "/geradas/" . $this->projeto . "/includes";
            if (! file_exists($dir))
                mkdir($dir);
            $fp = fopen("$dir/menu.php", "w");
            fputs($fp, $copiaModelo);
            fclose($fp);
            return true;
        } catch (Exception $e) {
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
    function getCamposSelect($tabela, $alias = null, $desceNivel = true)
    {
        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);
        $aCampo = $aAux = $aAux2 = [];

        foreach ($aBanco as $aTabela) {
            if ((string) $aTabela['name'] == $tabela) {
                // print_r($aTabela);
                foreach ($aTabela as $oCampo) {
                    // print_r($oCampo);
                    if ($alias == null) {
                        $alias = $tabela;
                    }

                    $aCampo[] = "$alias.{$oCampo['name']} as $alias" . "_{$oCampo['name']}";

                    // print_r($aCampo);
                    if ($desceNivel) {
                        if ($oCampo['fkTable'] != '') {
                            // TODO: Definir regras de geração de alias para tabelas que possuem mais de uma referência para uma mesma tabela
                            /*
                             * if(preg_match("#^(?:id_?|cd_?)(.*?)#is", $oCampo['name'])){
                             * $alias = strtolower(preg_replace("#^(?:id_?|cd_?)(.*?)#is", "$1", $oCampo['name']));
                             * }
                             */
                            $aAux[(string) $oCampo['fkTable']] = $oCampo['fkTable'];
                        }
                    }
                    $alias = null;
                }
            } else {
                continue;
            }
        }

        // Util::trace($aAux);

        // ========= Tabelas_FK =======
        if (count($aAux) > 0) {
            foreach ($aAux as $alias => $tab) {
                $aAux2[] = $this->getCamposSelect($tab, $alias, false);
            }
        }

        if (count($aAux2) > 0) {
            foreach ($aAux2 as $a) {
                foreach ($a as $s) {
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
    function getCamposArray($tabela, $alias = null, $desceNivel = true)
    {
        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);
        $aCampo = $aAux = [];

        foreach ($aBanco as $aTabela) {
            if ((string) $aTabela['name'] == $tabela) {
                // print_r($aTabela);
                foreach ($aTabela as $oCampo) {
                    // print_r($oCampo);
                    if ($alias == null || $alias == '') {
                        $alias = $tabela;
                    }

                    $aCampo[(string) $alias][] = (string) $oCampo['name'];

                    // print_r($aCampo);
                    if ($desceNivel) {
                        if ($oCampo['fkTable'] != '') {
                            // TODO: Definir regras de geração de alias para tabelas que possuem mais de uma referência para uma mesma tabela
                            /*
                             * if(preg_match("#^(?:id_?|cd_?)(.*?)#is", $oCampo['name'])){
                             * $alias = strtolower(preg_replace("#^(?:id_?|cd_?)(.*?)#is", "$1", $oCampo['name']));
                             * }
                             */
                            $aAux[(string) $oCampo['fkTable']] = (string) $oCampo['fkTable'];
                        }
                    }
                    $alias = null;
                }
            } else {
                continue;
            }
        }

        // ========= Tabelas_FK =======
        if (count($aAux) > 0) {
            foreach ($aAux as $alias => $tab) {
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
    function serializeCamposTabela($array)
    {
        $i = 0;
        $sAux = [];
        foreach ($array as $c1 => $aValor) {
            foreach ($aValor as $c2 => $v) {
                $aux1 = $v;
                $aux1 = ($i == 0) ? "'$v'" : "\t\t\t\t\t\t'$v'";
                $array[$c1][$c2] = $aux1;

                $i ++;
            }
        }

        $j = 0;
        foreach ($array as $c => $aValor) {
            $aux = "'{$c}' => [" . join(", \n", $aValor) . "]";
            $aux = ($j == 0) ? $aux : "\t\t\t\t$aux";
            $sAux[] = $aux;
            $j ++;
        }
        return "[" . join(", \n", $sAux) . "]";
    }

    /**
     * Retorna as tabelas
     *
     * @param string $tabela
     * @param boolean $desceNivel
     * @return string[]
     */
    function getAllTabelasJoin($tabela, $desceNivel = true)
    {
        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);
        $aTab = $aAux = array();
        foreach ($aBanco as $aTabela) {
            if ((string) $aTabela['name'] == $tabela) {
                foreach ($aTabela as $oCampo) {
                    if ((string) $oCampo['pk'] == 'true') {
                        if ($desceNivel) {
                            // $aTab[$tabela] = $tabela;
                            $aTab[$tabela][] = array(
                                "tab_rel" => (string) $oCampo['fkTable'],
                                "campo" => (string) $oCampo['name'],
                                "fk" => (string) $oCampo['fkColumn']
                            );
                        }
                    }
                    if ((string) $oCampo['fkTable'] != '') {
                        // $aTab[] = (string)$oCampo['fkTable'];
                        $aTab[(string) $oCampo['fkTable']] = array(
                            "tab_rel" => $tabela,
                            "campo" => (string) $oCampo['name'],
                            "fk" => (string) $oCampo['fkColumn']
                        );
                        if ($desceNivel) {
                            $aAux[] = $this->getAllTabelasJoin((string) $oCampo['fkTable'], false);
                        }
                    }
                }
            } else {
                continue;
            }
        }

        foreach ($aAux as $a) {
            foreach ($a as $ch => $vl) {
                $aTab[$ch] = $vl;
            }
        }

        return $aTab;
    }

    /**
     * Retorna arvore de objetos de uma tabela.
     * Método usado na geracao de Classes Mapeamento
     *
     * @param string $tabelaRaiz
     * @param string $objetoFK
     * @param int $key
     * @return string[]
     */
    function getArvoreObjeto($tabelaRaiz, $objetoFK, $key = 0)
    {
        // TODO: Criar a instância da classe derivada do nome do atributo, e não do nome da classe pelo fato de uma tabela se relacionar mais de uma vez com outra tabela
        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);

        # Varre a estrutura das tabelas
        foreach ($aBanco as $aTabela) {
            # Recupera o nome da tabela e procura pela raiz
            if ((string) $aTabela['name'] != $tabelaRaiz)
                continue;

            $nomeClasse = ucfirst($this->getCamelMode((string) $aTabela['name']));
            $objetoClasse = "\$o$objetoFK";

            # Varre a estrutura dos campos da tabela em questao
            $resultado = array(
                "\t\t$objetoClasse = new $nomeClasse();"
            );

            foreach ($aTabela as $oCampo) {
                # recupera nome e tabela (chave estrangeira)
                if ($key) {
                    if ((string) $oCampo['pk'] == 'false')
                        continue;
                }

                $nomeCampo = (string) $oCampo['name'];

                # monta parametros a serem substituidos posteriormente
                if ((string) $oCampo['fkTable'] == '')
                    $resultado[] = "\t\t$objetoClasse" . "->$nomeCampo = \$reg['$tabelaRaiz" . "_" . (string) $oCampo['name'] . "'];";
                // else
                // $resultado[] = $this->getArvoreObjeto((string)$oCampo['fkTable'], 0)."\t\t$objetoClasse"."->o$nomeFKClasse = \$o$nomeFKClasse;";
            }
            return join("\n", $resultado) . "\n";
        }
    }

    /**
     * Retorna o Database do XML
     *
     * @return string[]
     */
    function getDatabase()
    {
        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);
        return (string) $aBanco['name'];
    }

    /**
     * Retorna as tabelas do XML
     *
     * @return array[string]
     */
    function getAllTabela()
    {
        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);
        $aRetorno = array();

        # Varre a estrutura das tabelas
        foreach ($aBanco as $aTabela) {
            # Recupera o nome da tabela e gera o nome da classe
            $aRetorno[] = (string) $aTabela['name'];
        }
        return $aRetorno;
    }

    /**
     * Retorna os campos da tabela selecionada do XML
     *
     * @param string $tabelaProcura
     * @return string[]
     */
    function getAllCampo($tabelaProcura)
    {
        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);
        $aRetorno = array();

        # Varre a estrutura das tabelas
        foreach ($aBanco as $aTabela) {
            # Recupera o nome da tabela e gera o nome da classe
            if ($tabelaProcura != (string) $aTabela['name'])
                continue;
            # Varre a estrutura dos campos da tabela em questao
            foreach ($aTabela as $oCampo) {
                # Recupera valores a serem substituidos no modelo
                $aRetorno[] = (string) $oCampo['fkTable'];
            }
            break;
        }
        return $aRetorno;
    }

    /**
     * Retorna o nome campo a ser usado como titulo do combo que represente o objeto(tabela) selecionado.
     * Alusão ao método __to_string() da classe Object
     *
     * @param
     *            $tabelaProcura
     * @return String
     */
    function getTituloObjeto($tabelaProcura)
    {
        # Abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);
        $retorno = $pk = '';
        # Varre a estrutura das tabelas
        foreach ($aBanco as $aTabela) {
            # Recupera o nome da tabela e gera o nome da classe
            if ($tabelaProcura != $aTabela['name'])
                continue;

            # Varre a estrutura dos campos da tabela em questao
            foreach ($aTabela as $oCampo) {
                // Util::trace((string)$oCampo["name"]);
                # Se o campo for chave, nao sera usado
                if ((string) $oCampo['pk'] == 'true') {
                    $pk = (string) $oCampo['name'];

                    if ($oCampo['fkTable'] == '') {
                        continue;
                    }
                }
                # Se o campo for do tipo numerico, nao sera usado, nao sera usado
                if (! preg_match("#varchar#is", (string) $oCampo['type']))
                    continue;

                # Se o campo tiver nomenclatura que nao remeta a nome/descricao sera eliminado
                if (preg_match("#(?:usuario|login|nome_?(?:pessoa|cliente|servidor)?|titulo|nm_(?:pessoa|cliente|servidor|estado_?civil|lotacao|credenciado))#is", (string) $oCampo['name'])) {
                    $retorno = $oCampo['name'];
                    break;
                }

                # Se o campo tiver nomenclatura que nao remeta a nome/descricao sera eliminado
                if (preg_match("#(?:descricao|desc_)#is", (string) $oCampo['name'])) {
                    $retorno = $oCampo['name'];
                    break;
                }

                # E-mail
                if (preg_match("#(?:email)#is", (string) $oCampo['name'])) {
                    $retorno = $oCampo['name'];
                    break;
                }

                # Numero
                if (preg_match("#(?:numero|nota.*fiscal)#is", (string) $oCampo['name'])) {
                    $retorno = $oCampo['name'];
                    break;
                }
            }
            break;
        }
        if ($retorno == '')
            $retorno = $pk;
        return (string) $retorno;
    }

    /**
     * Retorna as tabelas de FK da tabela selecionada do XML
     *
     * @param string $tabelaProcura
     * @return string[]
     */
    function getAllTabelaFK($tabelaProcura)
    {
        # abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);
        $aRetorno = array();
        # varre a estrutura das tabelas
        foreach ($aBanco as $aTabela) {
            # recupera o nome da tabela e gera o nome da classe
            $nomeTabela = (string) $aTabela['name'];
            if ($nomeTabela != $tabelaProcura)
                continue;
            # varre a estrutura dos campos da tabela em questao
            foreach ($aTabela as $oCampo) {
                # recupera valores a serem substituidos no modelo
                if (trim($oCampo['fkTable']) == "")
                    continue;
                $aRetorno[trim($oCampo['name'])] = [
                    "pk" => trim($oCampo['pk']),
                    "fkTable" => trim($oCampo['fkTable']),
                    "fkColumn" => trim($oCampo['fkColumn'])
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
    function getAllAtributo($tabelaProcura)
    {
        # abre arquivo xml para navegacao
        $aBanco = simplexml_load_string($this->xml);
        $aRetorno = array();
        # varre a estrutura das tabelas
        foreach ($aBanco as $aTabela) {
            # recupera o nome da tabela e gera o nome da classe
            $nomeTabela = (string) $aTabela['name'];
            if ($nomeTabela != $tabelaProcura)
                continue;
            # varre a estrutura dos campos da tabela em questao
            foreach ($aTabela as $oCampo) {
                # recupera valores a serem substituidos no modelo
                $sFKTabela = (string) $oCampo['fkTable'];
                if ($sFKTabela != '') {
                    $nomeClasse = ucfirst($this->getCamelMode($sFKTabela));
                    $aRetorno[] = "\$o" . $nomeClasse;
                } else {
                    $aRetorno[] = "\$" . (string) $oCampo['name'];
                }
            }
            break;
        }
        // print_r($aRetorno);
        return $aRetorno;
    }

    /**
     * Retorna a instancia o objeto montada relacionada a tabela selecionada
     *
     * @param string $tabela
     * @param string $tipo
     * @return string
     */
    function getObjetosMontados($tabela, $tipo = "cad")
    {
        $nomeClasse = ucfirst($this->getCamelMode($tabela));
        $sAtributos = join(",", $this->getAllAtributo($tabela));
        $aTabelaFK = $this->getAllTabelaFK($tabela);

        /*
         * Util::trace($nomeClasse);
         * echo('-------------------------');
         * Util::trace($sAtributos);
         * echo('-------------------------');
         * Util::trace($aTabelaFK);
         * echo('-------------------------');
         */
        $str = [];

        foreach ($aTabelaFK as $sCampoFK => $aDadosTabelaFK) {
            $argClasse = "\$$sCampoFK";
            $sTabelaFK = ucfirst($this->getCamelMode($aDadosTabelaFK['fkTable']));
            $aTabelaFK2 = $this->getAllTabelaFK($aDadosTabelaFK['fkTable']);

            // Util::trace($aTabelaFK2);
            // echo('-------------------------');

            if (count($aTabelaFK2) > 0) {
                foreach ($aTabelaFK2 as $sCampoFK2 => $aDadosTabelaFK2) {
                    if ($aDadosTabelaFK2['pk'] == 'true') {
                        $sTabelaFK2 = ucfirst($this->getCamelMode($aDadosTabelaFK2['fkTable']));
                        $str[] = "\$o$sTabelaFK2 = new $sTabelaFK2(\$$sCampoFK2);";
                        $argClasse = "\$o$sTabelaFK2";
                    }
                }
            }

            $str[] = "\$o$sTabelaFK = new $sTabelaFK($argClasse);";
        }
        $str[] = "\$o$nomeClasse = new $nomeClasse(" . $sAtributos . ");";
        return ($tipo == "cad") ? join("\n\t\t", $str) : join("\n\t\t\t", $str);
    }

    /**
     * Retorna a instancia o objeto BD montada relacionada a tabela selecionada
     *
     * @param string $tabela
     * @return string
     */
    function getObjetoBDMontado($tabela)
    {
        $nomeClasse = ucfirst($this->getCamelMode($tabela));
        return "\$o$nomeClasse" . "BD = new $nomeClasse" . "BD();";
    }

    /**
     * Retorna o nome da variável no formato Camel Mode
     *
     * @param string $v
     * @return string
     */
    function getCamelMode($v)
    {
        $vet = explode("_", $v);
        foreach ($vet as $ch => $val) {
            $vet[$ch] = ($ch > 0) ? ucfirst($val) : $val;
        }

        return join("", $vet);
    }
}