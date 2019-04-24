<?php
class ARBITROAUXBDBase {
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
	 * Cadastrar instância da classe ARBITROAUX
	 * 
	 * @param ARBITROAUX $oARBITROAUX
	 * @return integer|boolean
	 */	
    function cadastrar($oARBITROAUX){
		$reg = ARBITROAUXMAP::objToRs($oARBITROAUX);
		$aCampo = array_keys($reg);
		$sql = "
				insert into ARBITRO_AUX(
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
	 * Alterar instância da classe ARBITROAUX
	 * 
	 * @param ARBITROAUX $oARBITROAUX
	 * @return boolean
	 */	
	function alterar($oARBITROAUX){
    	$reg = ARBITROAUXMAP::objToRs($oARBITROAUX);
        $sql = "
                update 
                    ARBITRO_AUX 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "id" || $cv == "PARTIDA_id") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    id = {$reg['id']} 
					and PARTIDA_id = {$reg['PARTIDA_id']}";

        foreach($reg as $cv=>$vl){
            if($cv == "id" || $cv == "PARTIDA_id") continue;
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
	 * Excluir instância da classe ARBITROAUX
	 * 
	 * @param integer $id,$PARTIDA_id
	 * @return boolean
	 */
	function excluir($id,$PARTIDA_id){
        $sql = "
                delete from
                    ARBITRO_AUX 
                where
                    id = $id 
					and PARTIDA_id = $PARTIDA_id";

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
	 * Retorna instância da classe ARBITROAUX
	 * 
	 * @param integer $id,$PARTIDA_id
	 * @return ARBITROAUX|boolean
	 */
	function get($id,$PARTIDA_id){
        $sql = "
                select 
					".ARBITROAUXMAP::dataToSelect()." 
                from
					ARBITRO_AUX 
				left join PARTIDA 
					on (ARBITRO_AUX.PARTIDA_id = PARTIDA.id) 
                where
					ARBITRO_AUX.id = $id 
					and ARBITRO_AUX.PARTIDA_id = $PARTIDA_id";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return ARBITROAUXMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela ARBITROAUX
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return ARBITROAUX[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".ARBITROAUXMAP::dataToSelect()." 
				from
					ARBITRO_AUX 
				left join PARTIDA 
					on (ARBITRO_AUX.PARTIDA_id = PARTIDA.id)";
        
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
                    $aObj[] = ARBITROAUXMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe ARBITROAUX
	 * 
	 * @param string $valor
	 * @return ARBITROAUX[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".ARBITROAUXMAP::dataToSelect()." 
				from
					ARBITRO_AUX 
				left join PARTIDA 
					on (ARBITRO_AUX.PARTIDA_id = PARTIDA.id)
                where
					".ARBITROAUXMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = ARBITROAUXMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe ARBITROAUX
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from ARBITRO_AUX";
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