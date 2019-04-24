<?php
class InsumoBDBase {
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
	 * Cadastrar instância da classe Insumo
	 * 
	 * @param Insumo $oInsumo
	 * @return integer|boolean
	 */	
    function cadastrar($oInsumo){
		$reg = InsumoMAP::objToRs($oInsumo);
		$aCampo = array_keys($reg);
		$sql = "
				insert into Insumo(
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
	 * Alterar instância da classe Insumo
	 * 
	 * @param Insumo $oInsumo
	 * @return boolean
	 */	
	function alterar($oInsumo){
    	$reg = InsumoMAP::objToRs($oInsumo);
        $sql = "
                update 
                    Insumo 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "idInsumo") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    idInsumo = {$reg['idInsumo']}";

        foreach($reg as $cv=>$vl){
            if($cv == "idInsumo") continue;
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
	 * Excluir instância da classe Insumo
	 * 
	 * @param integer $idInsumo
	 * @return boolean
	 */
	function excluir($idInsumo){
        $sql = "
                delete from
                    Insumo 
                where
                    idInsumo = $idInsumo";

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
	 * Retorna instância da classe Insumo
	 * 
	 * @param integer $idInsumo
	 * @return Insumo|boolean
	 */
	function get($idInsumo){
        $sql = "
                select 
					".InsumoMAP::dataToSelect()." 
                from
					Insumo 
				left join NaturezaContratual 
					on (Insumo.idNaturezaContratual = NaturezaContratual.idNaturezaContratual) 
                where
					Insumo.idInsumo = $idInsumo";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return InsumoMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela Insumo
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return Insumo[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".InsumoMAP::dataToSelect()." 
				from
					Insumo 
				left join NaturezaContratual 
					on (Insumo.idNaturezaContratual = NaturezaContratual.idNaturezaContratual)";
        
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
                    $aObj[] = InsumoMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe Insumo
	 * 
	 * @param string $valor
	 * @return Insumo[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".InsumoMAP::dataToSelect()." 
				from
					Insumo 
				left join NaturezaContratual 
					on (Insumo.idNaturezaContratual = NaturezaContratual.idNaturezaContratual)
                where
					".InsumoMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = InsumoMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe Insumo
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from Insumo";
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