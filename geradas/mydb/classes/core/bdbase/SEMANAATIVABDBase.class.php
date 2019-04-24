<?php
class SEMANAATIVABDBase {
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
	 * Cadastrar instância da classe SEMANAATIVA
	 * 
	 * @param SEMANAATIVA $oSEMANAATIVA
	 * @return integer|boolean
	 */	
    function cadastrar($oSEMANAATIVA){
		$reg = SEMANAATIVAMAP::objToRs($oSEMANAATIVA);
		$aCampo = array_keys($reg);
		$sql = "
				insert into SEMANA_ATIVA(
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
	 * Alterar instância da classe SEMANAATIVA
	 * 
	 * @param SEMANAATIVA $oSEMANAATIVA
	 * @return boolean
	 */	
	function alterar($oSEMANAATIVA){
    	$reg = SEMANAATIVAMAP::objToRs($oSEMANAATIVA);
        $sql = "
                update 
                    SEMANA_ATIVA 
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
	 * Excluir instância da classe SEMANAATIVA
	 * 
	 * @param integer 
	 * @return boolean
	 */
	function excluir(){
        $sql = "
                delete from
                    SEMANA_ATIVA 
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
	 * Retorna instância da classe SEMANAATIVA
	 * 
	 * @param integer 
	 * @return SEMANAATIVA|boolean
	 */
	function get(){
        $sql = "
                select 
					".SEMANAATIVAMAP::dataToSelect()." 
                from
					SEMANA_ATIVA 
				left join PERFIL_ACESSO 
					on (SEMANA_ATIVA.PERFIL_ACESSO_id = PERFIL_ACESSO.id) 
                where
					";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return SEMANAATIVAMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela SEMANAATIVA
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return SEMANAATIVA[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".SEMANAATIVAMAP::dataToSelect()." 
				from
					SEMANA_ATIVA 
				left join PERFIL_ACESSO 
					on (SEMANA_ATIVA.PERFIL_ACESSO_id = PERFIL_ACESSO.id)";
        
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
                    $aObj[] = SEMANAATIVAMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe SEMANAATIVA
	 * 
	 * @param string $valor
	 * @return SEMANAATIVA[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".SEMANAATIVAMAP::dataToSelect()." 
				from
					SEMANA_ATIVA 
				left join PERFIL_ACESSO 
					on (SEMANA_ATIVA.PERFIL_ACESSO_id = PERFIL_ACESSO.id)
                where
					".SEMANAATIVAMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = SEMANAATIVAMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe SEMANAATIVA
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from SEMANA_ATIVA";
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