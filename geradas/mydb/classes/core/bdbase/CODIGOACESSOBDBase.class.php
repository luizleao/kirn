<?php
class CODIGOACESSOBDBase {
    public $oConexao;
    public $msg;

    function __construct(Conexao $oConexao){
        try{
            $this->oConexao = $oConexao;
        } 
        catch (PDOException $e){
            $this->msg = $e->getMessage();
        }
    }
    
	/**
	 * Cadastrar instância da classe CODIGOACESSO
	 * 
	 * @param CODIGOACESSO $oCODIGOACESSO
	 * @return integer|boolean
	 */	
    function cadastrar($oCODIGOACESSO){
		$reg = CODIGOACESSOMAP::objToRs($oCODIGOACESSO);
		$aCampo = array_keys($reg);
		$sql = "
				insert into CODIGO_ACESSO(
					".implode(',', $aCampo)."
				)
				values(
					:".implode(", :", $aCampo).")";

		foreach($reg as $cv=>$vl)
			$regTemp[":$cv"] = ($vl=='') ? NULL : $vl;

		try{
			$this->oConexao->executePrepare($sql, $regTemp);
			if($this->oConexao->msg != ""){
				$this->msg = $this->oConexao->msg;
				return false;
			}
			return $this->oConexao->lastID();
		}
		catch(PDOException $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}
	
	/**
	 * Alterar instância da classe CODIGOACESSO
	 * 
	 * @param CODIGOACESSO $oCODIGOACESSO
	 * @return boolean
	 */	
	function alterar($oCODIGOACESSO){
    	$reg = CODIGOACESSOMAP::objToRs($oCODIGOACESSO);
        $sql = "
                update 
                    CODIGO_ACESSO 
                set
                    ";
        foreach($reg as $cv=>$vl){
            
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    ";

        foreach($reg as $cv=>$vl){
            
            $regTemp[":$cv"] = ($vl=='') ? NULL : $vl;
        }
        try{
            $this->oConexao->executePrepare($sql, $regTemp);
            if($this->oConexao->msg != ""){
                $this->msg = $this->oConexao->msg;
                return false;
            }
            return true;
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
	}
	
	/**
	 * Excluir instância da classe CODIGOACESSO
	 * 
	 * @param integer 
	 * @return boolean
	 */
	function excluir(){
        $sql = "
                delete from
                    CODIGO_ACESSO 
                where
                    ";

        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->msg != ""){
                $this->msg = $this->oConexao->msg;
                return false;
            }
            return true;
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
	}
	
	/**
	 * Retorna instância da classe CODIGOACESSO
	 * 
	 * @param integer 
	 * @return CODIGOACESSO|boolean
	 */
	function get(){
        $sql = "
                select 
					".CODIGOACESSOMAP::dataToSelect()." 
                from
					CODIGO_ACESSO 
				left join PESSOA 
					on (CODIGO_ACESSO.PESSOA_id = PESSOA.id) 
                where
					";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return CODIGOACESSOMAP::rsToObj($oReg);
            } else {
                $this->msg = "Nenhum registro encontrado!";
                return false;
            }
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
	}
	
	/**
	 * Retorna a lista de registros da tabela CODIGOACESSO
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return CODIGOACESSO[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".CODIGOACESSOMAP::dataToSelect()." 
				from
					CODIGO_ACESSO 
				left join PESSOA 
					on (CODIGO_ACESSO.PESSOA_id = PESSOA.id)";
        
        if(count($aFiltro)>0){
            $sql .= " where ";
            $sql .= implode(" and ", $aFiltro);
        }
        
        if(count($aOrdenacao)>0){
            $sql .= " order by ";
            $sql .= implode(",", $aOrdenacao);
        }
        
        $sql .= ($pagina != NULL) ? "
        		limit ".$qtd*($pagina-1).", $qtd" : "";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = CODIGOACESSOMAP::rsToObj($oReg);
                }
                return $aObj;
            } else {
                return false;
            }
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }

	/**
	 * Consultar instâncias da classe CODIGOACESSO
	 * 
	 * @param string $valor
	 * @return CODIGOACESSO[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".CODIGOACESSOMAP::dataToSelect()." 
				from
					CODIGO_ACESSO 
				left join PESSOA 
					on (CODIGO_ACESSO.PESSOA_id = PESSOA.id)
                where
					".CODIGOACESSOMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = CODIGOACESSOMAP::rsToObj($oReg);
                }
                return $aObj;
            } else {
                return false;
            }
        }
    	catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }

	/**
	 * Retorna o total de instâncias da classe CODIGOACESSO
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from CODIGO_ACESSO";
        try{
            $this->oConexao->execute($sql);
            $oReg = $this->oConexao->fetchRow();
            return (int) $oReg[0];
        }
        catch(PDOException $e){
            $this->msg = $e->getMessage();
            return false;
        }
    }
}