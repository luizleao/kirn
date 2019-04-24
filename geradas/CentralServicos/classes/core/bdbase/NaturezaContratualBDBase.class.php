<?php
class NaturezaContratualBDBase {
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
	 * Cadastrar instância da classe NaturezaContratual
	 * 
	 * @param NaturezaContratual $oNaturezaContratual
	 * @return integer|boolean
	 */	
    function cadastrar($oNaturezaContratual){
		$reg = NaturezaContratualMAP::objToRs($oNaturezaContratual);
		$aCampo = array_keys($reg);
		$sql = "
				insert into NaturezaContratual(
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
	 * Alterar instância da classe NaturezaContratual
	 * 
	 * @param NaturezaContratual $oNaturezaContratual
	 * @return boolean
	 */	
	function alterar($oNaturezaContratual){
    	$reg = NaturezaContratualMAP::objToRs($oNaturezaContratual);
        $sql = "
                update 
                    NaturezaContratual 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "idNaturezaContratual") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    idNaturezaContratual = {$reg['idNaturezaContratual']}";

        foreach($reg as $cv=>$vl){
            if($cv == "idNaturezaContratual") continue;
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
	 * Excluir instância da classe NaturezaContratual
	 * 
	 * @param integer $idNaturezaContratual
	 * @return boolean
	 */
	function excluir($idNaturezaContratual){
        $sql = "
                delete from
                    NaturezaContratual 
                where
                    idNaturezaContratual = $idNaturezaContratual";

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
	 * Retorna instância da classe NaturezaContratual
	 * 
	 * @param integer $idNaturezaContratual
	 * @return NaturezaContratual|boolean
	 */
	function get($idNaturezaContratual){
        $sql = "
                select 
					".NaturezaContratualMAP::dataToSelect()." 
                from
					NaturezaContratual 
                where
					NaturezaContratual.idNaturezaContratual = $idNaturezaContratual";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return NaturezaContratualMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela NaturezaContratual
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return NaturezaContratual[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".NaturezaContratualMAP::dataToSelect()." 
				from
					NaturezaContratual";
        
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
                    $aObj[] = NaturezaContratualMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe NaturezaContratual
	 * 
	 * @param string $valor
	 * @return NaturezaContratual[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".NaturezaContratualMAP::dataToSelect()." 
				from
					NaturezaContratual
                where
					".NaturezaContratualMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = NaturezaContratualMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe NaturezaContratual
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from NaturezaContratual";
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