<?php
/**
 * Class Conexao | classes/Class.Conexao.php
 *
 * @package     classes
 * @author      Luiz Leão <luizleao@gmail.com>
 * @version     v.2.0 (06/12/2018)
 * @copyright   Copyright (c) 2018, Luiz
 */
/**
 * Classe de Conexão PDO
 * 
 * Classe de conexão com o banco de dados baseado na biblioteca PDO. É usada nas aplicações geradas pela ferramenta
 */
class Conexao {
    /**
     * Armazena a consulta
     * 
     * @var resource
     */
    public $consulta;
    /**
     * Mensagem do sistema
     * 
     * @var string
     */
    public $msg;
    /**
     * Informação sobre o servidor utilizado: Produção, Desenvolvimento ou Homologacao
     * 
     * @var string
     */
    public $local = "producao";
    /**
     * Armazena dados da conexao
     * 
     * @var resource
     */
    public $conexao;
    /**
     * Data de Cadastro Padrão
     * 
     * @var string
     */
    public $data_cadastro_padrao = "now()";
    
    /**
     * Método construtor
     */
    function __construct() {
        try {
            $config = parse_ini_file(dirname(__FILE__) . "/config.ini", true);
            //print "<pre>"; print_r($config); print "</pre>";
            $this->conexao = new PDO("{$config[$this->local]['tipo_sgbd']}={$config[$this->local]['server']};{$config[$this->local]['label_db']}={$config[$this->local]['db']}", 
                    $config[$this->local]['username'], 
                    $config[$this->local]['pw']);

            $this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            //print "<pre>"; print_r($e); print "</pre>";
            $this->msg = $e->getMessage();
        }
    }

    /**
     * Executar consulta
     * 
     * @param string $sql
     * @throws PDOException
     * @return boolean
     */
    function execute($sql) {
        //print "<pre>$sql</pre>";
        $this->consulta = $this->conexao->query($sql);
        if (!$this->consulta) {
            $aErro = $this->consulta->errorInfo();
            $this->msg = $aErro[2];
            throw new PDOException($aErro[2], $aErro[1]);
        }
        return true;
    }
	
    /**
     * Executar consulta prepare
     * @param string $sql
     * @param string[] $aDados
     * @throws PDOException
     * @return boolean
     */
    function executePrepare($sql, $aDados = NULL) {
        try {
            $this->consulta = $this->conexao->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            if (!$this->consulta->execute($aDados)) {
                $aErro = $this->consulta->errorInfo();
                $this->msg = $aErro[2];
                throw new PDOException($aErro[2], $aErro[1]);
            }
            return true;
        } catch (PDOException $e) {
            //print "<pre>"; print_r($e); print "</pre>";
            $this->msg = $e->getMessage();
            return false;
        }
    }

    /**
     * Numero de linhas
     * 
     * @param object $consulta
     * @return number
     */
    function numRows($consulta = NULL) {
        if (!$consulta){
            $consulta = $this->consulta;
        }
        return (int) $consulta->rowCount();
    }

    /**
     * Lista de registros 
     * 
     * @param object $consulta
     * @return string[]
     */
    function fetchReg($consulta = NULL) {
        if (!$consulta){
            $consulta = $this->consulta;
        }
        return $this->consulta->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Lista de Registros
     * 
     * @param object $consulta
     * @return string[]
     */
    function fetchRow($consulta = NULL) {
        if (!$consulta){
            $consulta = $this->consulta;
        }
        return $this->consulta->fetch();
    }

    /**
     * Ultimo ID inserido
     * 
     * @return number
     */
    function lastID() {
        return $this->conexao->lastInsertId();
    }

    /**
     * Fechar conexao
     * @return void
     */
    function close() {
        try {
            if ($this->consulta){
                $this->consulta->closeCursor();
            }
        } catch (PDOException $e) {
            $this->msg = $e->getMessage();
        }
    }

    /**
     * Iniciar transacao
     * @return void
     */
    function beginTrans() {
        $this->conexao->beginTransaction();
    }
    
    /**
     * Concluir transacao
     * @return void
     */
    function commitTrans() {
        $this->conexao->commit();
    }
    
    /**
     * Abortar transacao
     * @return void
     */
    function rollBackTrans() {
        $this->conexao->rollBack();
    }

}