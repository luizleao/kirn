<?php
class UNIFORMEBDBase {
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
	 * Cadastrar instância da classe UNIFORME
	 * 
	 * @param UNIFORME $oUNIFORME
	 * @return integer|boolean
	 */	
    function cadastrar($oUNIFORME){
		$reg = UNIFORMEMAP::objToRs($oUNIFORME);
		$aCampo = array_keys($reg);
		$sql = "
				insert into UNIFORME(
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
	 * Alterar instância da classe UNIFORME
	 * 
	 * @param UNIFORME $oUNIFORME
	 * @return boolean
	 */	
	function alterar($oUNIFORME){
    	$reg = UNIFORMEMAP::objToRs($oUNIFORME);
        $sql = "
                update 
                    UNIFORME 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "idUNIFORME" || $cv == "TIME_id") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    idUNIFORME = {$reg['idUNIFORME']} 
					and TIME_id = {$reg['TIME_id']}";

        foreach($reg as $cv=>$vl){
            if($cv == "idUNIFORME" || $cv == "TIME_id") continue;
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
	 * Excluir instância da classe UNIFORME
	 * 
	 * @param integer $idUNIFORME,$TIME_id
	 * @return boolean
	 */
	function excluir($idUNIFORME,$TIME_id){
        $sql = "
                delete from
                    UNIFORME 
                where
                    idUNIFORME = $idUNIFORME 
					and TIME_id = $TIME_id";

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
	 * Retorna instância da classe UNIFORME
	 * 
	 * @param integer $idUNIFORME,$TIME_id
	 * @return UNIFORME|boolean
	 */
	function get($idUNIFORME,$TIME_id){
        $sql = "
                select 
					".UNIFORMEMAP::dataToSelect()." 
                from
					UNIFORME 
				left join TIME 
					on (UNIFORME.TIME_id = TIME.id) 
                where
					UNIFORME.idUNIFORME = $idUNIFORME 
					and UNIFORME.TIME_id = $TIME_id";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return UNIFORMEMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela UNIFORME
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return UNIFORME[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".UNIFORMEMAP::dataToSelect()." 
				from
					UNIFORME 
				left join TIME 
					on (UNIFORME.TIME_id = TIME.id)";
        
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
                    $aObj[] = UNIFORMEMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe UNIFORME
	 * 
	 * @param string $valor
	 * @return UNIFORME[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".UNIFORMEMAP::dataToSelect()." 
				from
					UNIFORME 
				left join TIME 
					on (UNIFORME.TIME_id = TIME.id)
                where
					".UNIFORMEMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = UNIFORMEMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe UNIFORME
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from UNIFORME";
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