<?php
class PARTIDABDBase {
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
	 * Cadastrar instância da classe PARTIDA
	 * 
	 * @param PARTIDA $oPARTIDA
	 * @return integer|boolean
	 */	
    function cadastrar($oPARTIDA){
		$reg = PARTIDAMAP::objToRs($oPARTIDA);
		$aCampo = array_keys($reg);
		$sql = "
				insert into PARTIDA(
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
	 * Alterar instância da classe PARTIDA
	 * 
	 * @param PARTIDA $oPARTIDA
	 * @return boolean
	 */	
	function alterar($oPARTIDA){
    	$reg = PARTIDAMAP::objToRs($oPARTIDA);
        $sql = "
                update 
                    PARTIDA 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "id" || $cv == "idmadante" || $cv == "idvisitante") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    id = {$reg['id']} 
					and idmadante = {$reg['idmadante']} 
					and idvisitante = {$reg['idvisitante']}";

        foreach($reg as $cv=>$vl){
            if($cv == "id" || $cv == "idmadante" || $cv == "idvisitante") continue;
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
	 * Excluir instância da classe PARTIDA
	 * 
	 * @param integer $id,$idmadante,$idvisitante
	 * @return boolean
	 */
	function excluir($id,$idmadante,$idvisitante){
        $sql = "
                delete from
                    PARTIDA 
                where
                    id = $id 
					and idmadante = $idmadante 
					and idvisitante = $idvisitante";

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
	 * Retorna instância da classe PARTIDA
	 * 
	 * @param integer $id,$idmadante,$idvisitante
	 * @return PARTIDA|boolean
	 */
	function get($id,$idmadante,$idvisitante){
        $sql = "
                select 
					".PARTIDAMAP::dataToSelect()." 
                from
					PARTIDA 
				left join TIME 
					on (PARTIDA.idmadante = TIME.id)
				left join TIME 
					on (PARTIDA.idvisitante = TIME.id) 
                where
					PARTIDA.id = $id 
					and PARTIDA.idmadante = $idmadante 
					and PARTIDA.idvisitante = $idvisitante";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return PARTIDAMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela PARTIDA
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return PARTIDA[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".PARTIDAMAP::dataToSelect()." 
				from
					PARTIDA 
				left join TIME 
					on (PARTIDA.idmadante = TIME.id)
				left join TIME 
					on (PARTIDA.idvisitante = TIME.id)";
        
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
                    $aObj[] = PARTIDAMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe PARTIDA
	 * 
	 * @param string $valor
	 * @return PARTIDA[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".PARTIDAMAP::dataToSelect()." 
				from
					PARTIDA 
				left join TIME 
					on (PARTIDA.idmadante = TIME.id)
				left join TIME 
					on (PARTIDA.idvisitante = TIME.id)
                where
					".PARTIDAMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = PARTIDAMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe PARTIDA
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from PARTIDA";
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