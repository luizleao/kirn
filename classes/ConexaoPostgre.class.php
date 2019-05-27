<?php
/**
 * Class ConexaoPostgre | classes/Conexao.Postgre.class.php
 *
 * @package     classes
 * @author      Luiz Leão <luizleao@gmail.com>
 * @version     v.2.0 (06/12/2018)
 * @copyright   Copyright (c) 2018, Luiz
 */
/** 
 * Conexão Postgre
 *  
 * Classe de conexão nativa com o SGBD PostgreSQL
 */
class ConexaoPostgre implements IConexao {
    /**
     * Dados da conexão
     * 
     * @var resource
     */
    public $conexao;
    /**
     * Dados da consulta
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
     * Método construtor da classe
     * 
     * @param string $servidor Servidor a ser utilizado
     * @return void
     */
    function __construct($servidor = 'Producao'){
        switch ($servidor){
            case 'Local':
                $this->set_conexao("192.168.200.25","apsuser","seduc@control","seduc_desenv");
            break;
            case 'Producao':				
                $this->set_conexao("192.168.200.42","apsuser","seduc@control","seduc_oficial");
            break;
            case 'Vazia':
            break;
            default:
				die("Servidor $servidor inexistente");
            break;
        }

    }
    
    /**
     * Seleciona a conexão com o SGBD
     * 
     * @param string $host Endereço do servidor
     * @param string $user Usuário do banco
     * @param string $senha Senha do banco
     * @param string $bd Banco de dados selecionado
     * @return void
     */
    function set_conexao($host,$user,$senha,$bd=NULL){
        try{
        	$conn = "host=$host user=$user password=$senha";
        	if($bd != "")
        		$conn .= " dbname=$bd";
        	
    		$this->conexao = @pg_connect($conn);
    		
        }catch (Exception $e){
            $this->msg = $e->getMessage();
        }
		
    }
    
    /**
     * Executa uma instrução SQL do SGBD
     * 
     * @param string $sql
     * @return boolean
     */
    function execute($sql){
        $consulta = @pg_query($this->conexao,$sql);
        if($consulta){
            $this->consulta = $consulta;
            return true;
        } else{
            $this->msg = pg_last_error();
            return false;
        }
    }
    
    /**
     * Retorna a quantidades de linhas afetadas pela Query
     * 
     * @param resource $consulta Consulta executada
     * @return int
     */
    function numRows($consulta = NULL){
        if(!$consulta) $consulta = $this->consulta;
        return (int) @pg_num_rows($consulta);
    }
    
    /**
     * Retorna os dados da consulta em forma de array
     * 
     * @param resource $consulta
     * @return string[]
     */
    function fetchReg($consulta = NULL){
        if(!$consulta) $consulta = $this->consulta;
        return pg_fetch_array($consulta);
    }
    
    /**
     * Retorna os dados da consulta em forma de HASH, 
     * 
     * @param resource $consulta
     * @return string[]
     */
    function fetchRow($consulta = NULL){
        if(!$consulta) 
            $consulta = $this->consulta;
        return pg_fetch_row($consulta);
    }
    
    /**
     * Retorna o ultimo ID inserido por uma consulta recente
     * 
     * @return int
     */
    function lastID(){
        return pg_last_oid($this->consulta);
    }
    
    /**
     * Encerra a conexão
     * 
     * @return void
     */
    function close(){
        pg_close($this->conexao);
    }
		
    /**
     * Executa o inicio da transação
     * 
     * @return void
     */
    function beginTrans(){
        $this->execute("BEGIN");	
    }
    
    /**
     * Executa o fim da transação
     * 
     * @return void
     */
    function commitTrans(){
        $this->execute("COMMIT");		
    }
    
    /**
     * Executa o cancelamento da transação
     * 
     * @return void
     */
    function rollBackTrans(){
        $this->execute("ROLLBACK");
    }
    
    /**
     * Returna a lista de databases do servidor
     * 
     * @return string[]
     */
    function databases(){
        $this->execute("SELECT datname FROM pg_database WHERE datistemplate = false;");
        $aDatabases = array();
        while ($aReg = $this->fetchRow()){
            $aDatabases[] = $aReg[0];
        }
        return $aDatabases;
    }
    
    /**
     * Lista as colunas da tabela
     * 
     * @param string $tabela
     * @return string[]
     */
    public function getAllColunasTabela($tabela) {
    	$sql = "SELECT 
					a.attname as Field, 
					format_type(t.oid, null) as Type,
					a.attnotnull as Null,
					NULL as Key,
					NULL as Default,
					NULL as Extra
				--	n.nspname as esquema, 
				--	c.relname as tabela, 
				--	c.*
				FROM 
					pg_namespace n 
				inner join pg_class c
					on (n.oid = c.relnamespace)
				inner join pg_attribute a
					on (a.attrelid = c.oid)
				inner join pg_type t
					on (a.atttypid = t.oid)
					-- pg_index i
				 WHERE 
					c.relkind = 'r'     -- no indices
					and n.nspname not like 'pg\\_%' -- no catalogs
					and n.nspname != 'information_schema' -- no information_schema
					and a.attnum > 0        -- no system att's
					and not a.attisdropped   -- no dropped columns
					and n.nspname = 'public'
					and c.relname = '$tabela'
				 ORDER BY 
					nspname, relname, attname;";
    	$this->execute($sql);
    	
    	$aDados = array();
    	while ($aReg = $this->fetchReg()){
    		$aDados[] = $aReg;
    	}
    	return $aDados;
    }
    
    /**
     * Retorna a lista de tabelas do servidor
     * 
     * @return string[]
     */
    public function getAllTabelas() {
    	$sql = "select
   					table_name,
   					table_schema
				from
					INFORMATION_SCHEMA.TABLES
				where
					TABLE_TYPE = 'BASE TABLE'";
    	
    	$this->execute($sql);
    	$aDados = array();
    	while ($aReg = $this->fetchReg()){
    		$aDados[] = $aReg;
    	}
    	return $aDados;
    }
    
    /**
     * Retorna os dados das FK da tabela selecionada
     * 
     * @param string $db Banco de dados selecionado
     * @param string $tabela Nome da tabela
     * @param string $coluna Nome da coluna
     * @return string[]
     */
    public function dadosForeignKeyColuna($db, $tabela, $coluna) {
    	$sql = "SELECT
	/*				n.nspname AS esquema_de,
					nf.nspname AS esquema_para,
					ct.conname AS chave,
					pg_get_constraintdef(ct.oid) AS criar_sql,			
					cl.relname AS tabela_de,
					a.attname AS coluna_de,
	*/
					clf.relname AS tabela_para,
					af.attname AS coluna_para
				
				FROM 
					pg_catalog.pg_attribute a
				JOIN pg_catalog.pg_class cl 
					ON (a.attrelid = cl.oid 
						AND cl.relkind = 'r')
				JOIN pg_catalog.pg_namespace n 
					ON (n.oid = cl.relnamespace)
				JOIN pg_catalog.pg_constraint ct 
					ON (a.attrelid = ct.conrelid 
						AND ct.confrelid != 0 
						AND ct.conkey[1] = a.attnum)
				JOIN pg_catalog.pg_class clf 
					ON (ct.confrelid = clf.oid 
						AND clf.relkind = 'r')
				JOIN pg_catalog.pg_namespace nf 
					ON (nf.oid = clf.relnamespace)
				JOIN pg_catalog.pg_attribute af 
					ON (af.attrelid = ct.confrelid 
						AND af.attnum = ct.confkey[1])
				where
					cl.relname 	  = '$tabela'
					and a.attname = '$coluna'";
    	 
    	$this->execute($sql);
    	return $this->fetchReg();
    }
}
