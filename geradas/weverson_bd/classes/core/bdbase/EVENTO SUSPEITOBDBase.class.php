<?php
class EVENTO SUSPEITOBDBase {
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
	 * Cadastrar instância da classe EVENTO SUSPEITO
	 * 
	 * @param EVENTO SUSPEITO $oEVENTO SUSPEITO
	 * @return integer|boolean
	 */	
    function cadastrar($oEVENTO SUSPEITO){
		$reg = EVENTO SUSPEITOMAP::objToRs($oEVENTO SUSPEITO);
		$aCampo = array_keys($reg);
		$sql = "
				insert into EVENTO SUSPEITO(
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
			return true;
		}
		catch(PDOException $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}
	
	/**
	 * Alterar instância da classe EVENTO SUSPEITO
	 * 
	 * @param EVENTO SUSPEITO $oEVENTO SUSPEITO
	 * @return boolean
	 */	
	function alterar($oEVENTO SUSPEITO){
    	$reg = EVENTO SUSPEITOMAP::objToRs($oEVENTO SUSPEITO);
        $sql = "
                update 
                    EVENTO SUSPEITO 
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
	 * Excluir instância da classe EVENTO SUSPEITO
	 * 
	 * @param integer 
	 * @return boolean
	 */
	function excluir(){
        $sql = "
                delete from
                    EVENTO SUSPEITO 
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
	 * Retorna instância da classe EVENTO SUSPEITO
	 * 
	 * @param integer 
	 * @return EVENTO SUSPEITO|boolean
	 */
	function get(){
        $sql = "
                select 
					".EVENTO SUSPEITOMAP::dataToSelect()." 
                from
					EVENTO SUSPEITO 
                where
					";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return EVENTO SUSPEITOMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela EVENTO SUSPEITO
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return EVENTO SUSPEITO[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".EVENTO SUSPEITOMAP::dataToSelect()." 
				from
					EVENTO SUSPEITO";
        
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
                    $aObj[] = EVENTO SUSPEITOMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe EVENTO SUSPEITO
	 * 
	 * @param string $valor
	 * @return EVENTO SUSPEITO[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".EVENTO SUSPEITOMAP::dataToSelect()." 
				from
					EVENTO SUSPEITO
                where
					".EVENTO SUSPEITOMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = EVENTO SUSPEITOMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe EVENTO SUSPEITO
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from EVENTO SUSPEITO";
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