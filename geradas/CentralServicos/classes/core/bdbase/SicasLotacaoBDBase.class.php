<?php
class SicasLotacaoBDBase {
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
	 * Cadastrar instância da classe SicasLotacao
	 * 
	 * @param SicasLotacao $oSicasLotacao
	 * @return integer|boolean
	 */	
    function cadastrar($oSicasLotacao){
		$reg = SicasLotacaoMAP::objToRs($oSicasLotacao);
		$aCampo = array_keys($reg);
		$sql = "
				insert into Sicas_Lotacao(
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
	 * Alterar instância da classe SicasLotacao
	 * 
	 * @param SicasLotacao $oSicasLotacao
	 * @return boolean
	 */	
	function alterar($oSicasLotacao){
    	$reg = SicasLotacaoMAP::objToRs($oSicasLotacao);
        $sql = "
                update 
                    Sicas_Lotacao 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "cd_lotacao") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    cd_lotacao = {$reg['cd_lotacao']}";

        foreach($reg as $cv=>$vl){
            if($cv == "cd_lotacao") continue;
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
	 * Excluir instância da classe SicasLotacao
	 * 
	 * @param integer $cd_lotacao
	 * @return boolean
	 */
	function excluir($cd_lotacao){
        $sql = "
                delete from
                    Sicas_Lotacao 
                where
                    cd_lotacao = $cd_lotacao";

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
	 * Retorna instância da classe SicasLotacao
	 * 
	 * @param integer $cd_lotacao
	 * @return SicasLotacao|boolean
	 */
	function get($cd_lotacao){
        $sql = "
                select 
					".SicasLotacaoMAP::dataToSelect()." 
                from
					Sicas_Lotacao 
                where
					Sicas_Lotacao.cd_lotacao = $cd_lotacao";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return SicasLotacaoMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela SicasLotacao
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return SicasLotacao[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".SicasLotacaoMAP::dataToSelect()." 
				from
					Sicas_Lotacao";
        
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
                    $aObj[] = SicasLotacaoMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe SicasLotacao
	 * 
	 * @param string $valor
	 * @return SicasLotacao[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".SicasLotacaoMAP::dataToSelect()." 
				from
					Sicas_Lotacao
                where
					".SicasLotacaoMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = SicasLotacaoMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe SicasLotacao
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from Sicas_Lotacao";
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