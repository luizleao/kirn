<?php


use Exception, ZipArchive, RecursiveIteratorIterator, RecursiveDirectoryIterator;
/**
 * Class Controller | classes/Controller.class.php
 *
 * @package     classes
 * @author      Luiz Leão <luizleao@gmail.com>
 * @version     v.2.0 (06/12/2018)
 * @copyright   Copyright (c) 2018, Luiz
 */
/**
 * Façade do framework
 *
 * Concentra as funcionalidades da ferramenta
 */
class Controller
{

    /**
     * Mensagem do sistema
     *
     * @var string
     */
    public $msg;

    /**
     * Método construtor
     *
     * @return void
     */
    function __construct(){
        
    }

    /**
     * Conecta com o banco de dados selecionado
     *
     * @param string $sgbd Tipo de SGBD
     * @param string $host Endereço do servidor
     * @param string $usuario Usuário do banco
     * @param string $senha Senha do Usuário
     * @param string $bd Banco de dados selecionado
     * @return boolean ConexaoSqlServer| ConexaoMySql| ConexaoPostgre
     */
    function conexao($sgbd, $host, $usuario, $senha, $bd = NULL)
    {
        switch ($sgbd) {
            // case "mysql": $oConexao = new ConexaoMySql('Vazia'); break;
            case "mysql":
                $oConexao = new ConexaoMySqli('Vazia');
                break;
            case "sqlserver":
                $oConexao = new ConexaoSqlServer('Vazia');
                break;
            case "postgre":
                $oConexao = new ConexaoPostgre('Vazia');
                break;
        }

        $oConexao->set_conexao($host, $usuario, $senha, $bd);

        if ($oConexao->conexao) {
            return $oConexao;
        } else {
            $this->msg = "Ocorreu o seguinte erro: " . $oConexao->msg;
            return false;
        }
    }

    /**
     * Gera o XML que contém as meta-informações do banco de dados
     *
     * @param string $sgbd Tipo de SGBD
     * @param string $host Endereço do servidor
     * @param string $usuario Usuário do banco
     * @param string $senha Senha do Usuário
     * @param string $bd Banco de dados selecionado
     * @return boolean
     */
    function gerarXML($sgbd, $host, $usuario, $senha, $bd)
    {
        // die("$sgbd, $host, $usuario, $senha, $bd");
        $oConexao = $this->conexao($sgbd, $host, $usuario, $senha, $bd);

        if ($oConexao) {
            $oXML = simplexml_load_string("<?xml version=\"1.0\" encoding=\"UTF-8\"?> <database name=\"$bd\" dbms=\"$sgbd\" host=\"$host\" user=\"$usuario\" passwd=\"$senha\"></database>");
            $aTabela = $oConexao->getAllTabelas();
            // print"<pre>"; print_r($aTabela); print"</pre>"; exit;

            foreach ($aTabela as $sTabela) {
                // print"<pre>"; print_r($sTabela); print"</pre>"; exit;
                $oTabela = $oXML->addChild("table");
                $oTabela->addAttribute("name", $sTabela[0]);

                switch ($sgbd) {
                    case "mysql":
                        $oTabela->addAttribute("schema", "");
                        break;
                    case "sqlserver":
                        $oTabela->addAttribute("schema", $sTabela[1]);
                        break;
                }

                $aColuna = $oConexao->getAllColunasTabela($sTabela[0]);
                // print "<pre>"; print_r($aColuna); print "</pre>"; exit;

                $qtd_pk_sem_incremento = 0;
                $qtd_pk_com_incremento = 0;

                foreach ($aColuna as $sColuna) {
                    if ($sColuna[3] == 'PRI') {
                        if ($sColuna[5] == 'auto_increment') {
                            $qtd_pk_com_incremento ++;
                        } else {
                            $qtd_pk_sem_incremento ++;
                        }
                    }

                    $oCampo = $oTabela->addChild("column");
                    $oCampo->addAttribute("name", $sColuna[0]);
                    $oCampo->addAttribute("type", $sColuna[1]);
                    $oCampo->addAttribute("null", $sColuna[2]);
                    $oCampo->addAttribute("pk", (($sColuna[3] == 'PRI') ? "true" : "false"));
                    $oCampo->addAttribute("ai", ($sColuna[5] == 'auto_increment') ? "true" : "false");

                    $oFK = [];
                    $oFK = $oConexao->dadosForeignKeyColuna($bd, $sTabela[0], $sColuna[0]);

                    if (isset($oFK[0])) {
                        $oCampo->addAttribute("fkTable", $oFK[0]);
                        $oCampo->addAttribute("fkColumn", $oFK[1]);
                    } else {
                        $oCampo->addAttribute("fkTable", "");
                        $oCampo->addAttribute("fkColumn", "");
                    }
                }

                // print "Tabela: {$reg[0]}\n qtd_pk_com_incremento: $qtd_pk_com_incremento \n qtd_pk_sem_incremento: $qtd_pk_sem_incremento\n\n";
                // ========== Verificar tipo da tabela ============
                if ($qtd_pk_com_incremento == 1) {
                    $oTabela->addAttribute("type", 'NORMAL');
                } else {
                    if ($qtd_pk_sem_incremento == 2) {
                        $oTabela->addAttribute("type", 'N:M');
                    } elseif ($qtd_pk_sem_incremento == 1) {
                        $oTabela->addAttribute("type", '1:1');
                    } else {
                        $oTabela->addAttribute("type", 'NORMAL');
                    }
                }
            }

            $fp = fopen(dirname(dirname(__FILE__)) . "/xml/$bd.xml", "w+");
            fputs($fp, $oXML->asXML());
            fclose($fp);

            // print "<pre>".$oXML->asXML()."</pre>"; exit;
            $this->msg = ""; // Arquivo XML gerado com sucesso
            return true;
        } else {
            $this->msg = "Falha na geração do XML";
            return false;
        }
    }

    /**
     * Gera o Json que contém as meta-informações do banco de dados
     *
     * @param string $sgbd Tipo de SGBD
     * @param string $host Endereço do servidor
     * @param string $usuario Usuário do banco
     * @param string $senha Senha do Usuário
     * @param string $bd Banco de dados selecionado
     * @return boolean
     */
    function gerarJson($sgbd, $host, $usuario, $senha, $bd)
    {
        $oConexao = $this->conexao($sgbd, $host, $usuario, $senha, $bd);

        if ($oConexao) {
            $oXML = simplexml_load_string("<?xml version=\"1.0\" encoding=\"UTF-8\"?> <DATABASE NOME=\"$bd\" SGBD=\"$sgbd\" HOST=\"$host\" USER=\"$usuario\" SENHA=\"$senha\"></DATABASE>");
            $aTabela = $oConexao->getAllTabelas();
            // print"<pre>"; print_r($aTabela); print"</pre>"; exit;

            foreach ($aTabela as $sTabela) {
                // Util::trace($sTabela);exit;
                $oTabela = $oXML->addChild("TABELA");
                $oTabela->addAttribute("NOME", $sTabela[0]);

                switch ($sgbd) {
                    case "mysql":
                        $oTabela->addAttribute("SCHEMA", "");
                        break;
                    case "sqlserver":
                        $oTabela->addAttribute("SCHEMA", $sTabela[1]);
                        break;
                }

                $aColuna = $oConexao->getAllColunasTabela($sTabela[0]);
                // Util::trace($aColuna);exit;

                $qtd_pk_sem_incremento = 0;
                $qtd_pk_com_incremento = 0;

                foreach ($aColuna as $sColuna) {
                    if ($sColuna[3] == 'PRI') {
                        if ($sColuna[5] == 'auto_increment') {
                            $qtd_pk_com_incremento ++;
                        } else {
                            $qtd_pk_sem_incremento ++;
                        }
                    }

                    $oCampo = $oTabela->addChild("CAMPO");
                    /*
                     * $oCampo->addChild("NOME", $sColuna[0]);
                     * $oCampo->addChild("TIPO", $sColuna[1]);
                     * $oCampo->addChild("NULO", $sColuna[2]);
                     * $oCampo->addChild("CHAVE", (($sColuna[3] == 'PRI') ? 1 : 0));
                     */
                    $oCampo->addAttribute("NOME", $sColuna[0]);
                    $oCampo->addAttribute("TIPO", $sColuna[1]);
                    $oCampo->addAttribute("NULO", $sColuna[2]);
                    $oCampo->addAttribute("CHAVE", (($sColuna[3] == 'PRI') ? 1 : 0));

                    $oFK = $oConexao->dadosForeignKeyColuna($bd, $sTabela[0], $sColuna[0]);

                    if ($oFK[0] != '') {
                        /*
                         * $oCampo->addChild("FKTABELA", $oFK[0]);
                         * $oCampo->addChild("FKCAMPO", $oFK[1]);
                         */
                        $oCampo->addAttribute("FKTABELA", $oFK[0]);
                        $oCampo->addAttribute("FKCAMPO", $oFK[1]);
                    } else {
                        /*
                         * $oCampo->addChild("FKTABELA", "");
                         * $oCampo->addChild("FKCAMPO", "");
                         */
                        $oCampo->addAttribute("FKTABELA", "");
                        $oCampo->addAttribute("FKCAMPO", "");
                    }
                }

                // print "Tabela: {$reg[0]}\n qtd_pk_com_incremento: $qtd_pk_com_incremento \n qtd_pk_sem_incremento: $qtd_pk_sem_incremento\n\n";
                // ========== Verificar tipo da tabela ============
                if ($qtd_pk_com_incremento == 1) {
                    $oTabela->addAttribute("TIPO_TABELA", 'NORMAL');
                } else {
                    if ($qtd_pk_sem_incremento == 2) {
                        $oTabela->addAttribute("TIPO_TABELA", 'N:M');
                    } elseif ($qtd_pk_sem_incremento == 1) {
                        $oTabela->addAttribute("TIPO_TABELA", '1:1');
                    } else {
                        $oTabela->addAttribute("TIPO_TABELA", 'NORMAL');
                    }
                }
            }

            $fp = fopen(dirname(dirname(__FILE__)) . "/xml/$bd.xml", "w+");
            fputs($fp, $oXML->asXML());
            fclose($fp);

            // Util::trace($oXML->asXML()); exit;
            $this->msg = ""; // Arquivo XML gerado com sucesso
            return true;
        } else {
            $this->msg = "Falha na geração do XML";
            return false;
        }
    }

    /**
     * Gera os artefatos de software
     *
     * @param string $xml Arquivo XML que contém o schema do banco de dados
     * @param string $gui Tipo de interface gráfica escolhida
     * @param boolean $moduloSeguranca Opção de gerar a aplicaççao com o módulo de segurança ou não
     * @return string
     */
    public function gerarArtefatos($xml, $gui, $moduloSeguranca)
    {
        try {
            Util::excluirDiretorio("geradas/$xml");

            $oGeracao = new Geracao(dirname(dirname(__FILE__)) . "/xml/$xml.xml", $gui, $xml);

            // Util::trace($oGeracao);

            $msg = "Projeto: <strong>$xml</strong>: <br />";
            $msg .= "Framework Front-End: <strong>$gui</strong>: <br />";
            $msg .= "Framework Back-End: <strong>Kirn Framework</strong>: <br />";
            $msg .= "Log de Geração de Artefatos<hr /><pre>";
            $msg .= str_pad("Pastas do template ", 50, ".") . ((! Util::copydir("templates/$gui/dir/", "geradas/$xml/")) ? "Falha" : "Ok") . "\n";
            $msg .= str_pad("Pacote comum ", 50, ".") . ((! Util::copydir("templates/comum/", "geradas/$xml/")) ? "Falha" : "Ok") . "\n";
            $msg .= str_pad("Geracao de Classes Model ", 50, ".") . ((! $oGeracao->geraClassesBasicas()) ? "Falha" : "Ok") . "\n";
            $msg .= str_pad("Geracao de Classes BDBase ", 50, ".") . ((! $oGeracao->geraClassesBDBase()) ? "Falha" : "Ok") . "\n";
            $msg .= str_pad("Geracao de Classes Controller ", 50, ".") . ((! $oGeracao->geraClasseController()) ? "Falha" : "Ok") . "\n";
            $msg .= str_pad("Geracao de Classes BD ", 50, ".") . ((! $oGeracao->geraClassesBD()) ? "Falha" : "Ok") . "\n";
            $msg .= str_pad("Geracao de Classe ValidadorFormulario ", 50, ".") . ((! $oGeracao->geraClasseValidadorFormulario()) ? "Falha" : "Ok") . "\n";
            $msg .= str_pad("Geracao de Classe DadosFormulario ", 50, ".") . ((! $oGeracao->geraClasseDadosFormulario()) ? "Falha" : "Ok") . "\n";
            $msg .= str_pad("Geracao de Classes MAP ", 50, ".") . ((! $oGeracao->geraClassesMAP()) ? "Falha" : "Ok") . "\n";
            $msg .= str_pad("Geracao de Interfaces ", 50, ".") . ((! $oGeracao->geraInterface()) ? "Falha" : "Ok") . "\n";

            if (! $moduloSeguranca) {
                $msg .= str_pad("Geracao Menu Estático ", 51, ".") . ((! $oGeracao->geraMenuEstatico()) ? "Falha" : "Ok") . "\n";
            }

            $settings = $this->getSettings();
            $valorPF = $settings['settings']['valorPf'];
            $prodEquipe = $settings['settings']['prodEquipe'];

            $totalPF = Project::getTotalPFProject(dirname(dirname(__FILE__)) . "/xml/$xml.xml");
            $msg .= "</pre>Relatório de Indicadores<hr /><pre>";
            $msg .= str_pad("Total de linhas de codigo geradas", 50, ".") . Project::getTotalLineProject("geradas/$xml/") . "\n";
            $msg .= str_pad("Tamanho do Software Gerado (PF)", 50, ".") . $totalPF . "\n";
            $msg .= str_pad("Produtividade da Equipe (PF/Dia)", 50, ".") . "$prodEquipe\n";
            $msg .= str_pad("Valor do PF (R$)", 50, ".") . "$valorPF\n";
            $msg .= str_pad("Valor Estimado do Projeto Gerado (R$)", 50, ".") . Util::formataMoeda($totalPF * $valorPF) . "\n";
            $msg .= str_pad("Prazo Estimado de Entrega (Dias Uteis)", 50, ".") . (int) round($totalPF / 8) . "</pre>";

            $this->updateXmlDataProject($xml, $gui);

            return $msg;
        } catch (Exception $e) {
            return "Erro na operação";
        }
    }

    /**
     * Exclui o arquivo XML
     *
     * @param string $xml
     *            Arquivo XML
     * @return boolean
     */
    public function excluirXML($xml)
    {
        try {
            unlink("xml/$xml.xml");
            $this->msg = "";
            return true;
        } 
        catch (Exception $e) {
            $this->msg = $e->getMessage();
            return false;
        }
    }

    /**
     * Listar arquivos XML
     *
     * @access public
     * @return string[]
     */
    public function getAllXML()
    {
        $aArq = [];
        $dir = dirname(__FILE__) . "/../xml/";
        $dh = opendir($dir);
        while (($file = readdir($dh)) !== false) {
            if (filetype($dir . $file) == "file" && substr($file, - 4) == ".xml") {
                $aArq[] = substr($file, 0, strrpos($file, ".xml"));
            }
        }
        return $aArq;
    }

    /**
     * Disponibiliza o projeto para downdoal
     *
     * @param string $xml
     *            Arquivo XML
     * @return boolean
     */
    public function downloadProjeto($xml)
    {
        try {
            $path = "geradas/$xml";

            $arqZip = "$xml.zip";
            $zip = new ZipArchive();
            $zip->open($arqZip, ZipArchive::CREATE);

            // add folder structure
            // Create recursive directory iterator
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path), RecursiveIteratorIterator::LEAVES_ONLY);

            foreach ($files as $name => $file) {
                if ($file->getFilename() != '.' && $file->getFilename() != '..') {
                    // Get real path for current file
                    $filePath = $file->getRealPath();

                    $temp = explode("/", $name);
                    array_shift($temp);
                    $newName = implode("/", $temp);

                    // Add current file to archive
                    $zip->addFile($filePath, $newName);
                }
            }

            $zip->close();

            // https://perishablepress.com/press/2010/11/17/http-headers-file-downloads/
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"" . $arqZip . "\"");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: " . filesize($arqZip));
            ob_end_flush();
            @readfile($arqZip);

            unlink($arqZip);
        } 
        catch (Exception $e) {
            $this->msg = $e->getMessage();
            return false;
        }
    }

    /**
     * Retorna os dados de configuração da ferramenta
     *
     * @return array
     */
    public function getSettings()
    {
        return parse_ini_file(dirname(__FILE__) . "/settings.ini", true);
    }

    public function updateXmlDataProject($project, $gui)
    {
        $xml = simplexml_load_file(dirname(dirname(__FILE__)) . "/xml/$project.xml");

        $xml["frontEnd"] = $gui;
        $xml["backEnd"] = "Kirn Framework";
        $xml["totalPf"] = Project::getTotalPFProject(dirname(dirname(__FILE__)) . "/xml/$project.xml");
        $xml["numLineCode"] = Project::getTotalLineProject("geradas/$project/");

        // Util::trace($xml);
        file_put_contents(dirname(dirname(__FILE__)) . "/xml/$project.xml", $xml->asXML());
    }
}
