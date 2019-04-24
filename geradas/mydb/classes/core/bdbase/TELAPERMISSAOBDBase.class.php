<?php
class TELAPERMISSAOBDBase {
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
	 * Cadastrar instância da classe TELAPERMISSAO
	 * 
	 * @param TELAPERMISSAO $oTELAPERMISSAO
	 * @return integer|boolean
	 */	
    function cadastrar($oTELAPERMISSAO){
		$reg = TELAPERMISSAOMAP::objToRs($oTELAPERMISSAO);
		$aCampo = array_keys($reg);
		$sql = "
				insert into TELA_PERMISSAO(
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
	 * Alterar instância da classe TELAPERMISSAO
	 * 
	 * @param TELAPERMISSAO $oTELAPERMISSAO
	 * @return boolean
	 */	
	function alterar($oTELAPERMISSAO){
    	$reg = TELAPERMISSAOMAP::objToRs($oTELAPERMISSAO);
        $sql = "
                update 
                    TELA_PERMISSAO 
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
	 * Excluir instância da classe TELAPERMISSAO
	 * 
	 * @param integer 
	 * @return boolean
	 */
	function excluir(){
        $sql = "
                delete from
                    TELA_PERMISSAO 
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
	 * Retorna instância da classe TELAPERMISSAO
	 * 
	 * @param integer 
	 * @return TELAPERMISSAO|boolean
	 */
	function get(){
        $sql = "
                select 
					".TELAPERMISSAOMAP::dataToSelect()." 
                from
					TELA_PERMISSAO 
				left join TELA 
					on (TELA_PERMISSAO.TELA_id = TELA.id)
				left join PERMISSAO 
					on (TELA_PERMISSAO.PERMISSAO_id = PERMISSAO.id)
				left join PERFIL 
					on (TELA_PERMISSAO.PERFIL_id = PERFIL.id) 
                where
					";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return TELAPERMISSAOMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela TELAPERMISSAO
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return TELAPERMISSAO[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".TELAPERMISSAOMAP::dataToSelect()." 
				from
					TELA_PERMISSAO 
				left join TELA 
					on (TELA_PERMISSAO.TELA_id = TELA.id)
				left join PERMISSAO 
					on (TELA_PERMISSAO.PERMISSAO_id = PERMISSAO.id)
				left join PERFIL 
					on (TELA_PERMISSAO.PERFIL_id = PERFIL.id)";
        
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
                    $aObj[] = TELAPERMISSAOMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe TELAPERMISSAO
	 * 
	 * @param string $valor
	 * @return TELAPERMISSAO[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".TELAPERMISSAOMAP::dataToSelect()." 
				from
					TELA_PERMISSAO 
				left join TELA 
					on (TELA_PERMISSAO.TELA_id = TELA.id)
				left join PERMISSAO 
					on (TELA_PERMISSAO.PERMISSAO_id = PERMISSAO.id)
				left join PERFIL 
					on (TELA_PERMISSAO.PERFIL_id = PERFIL.id)
                where
					".TELAPERMISSAOMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = TELAPERMISSAOMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe TELAPERMISSAO
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from TELA_PERMISSAO";
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