<?php
class ConsultanatelavisualizarrotaBDBase {
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
	 * Cadastrar instância da classe Consultanatelavisualizarrota
	 * 
	 * @param Consultanatelavisualizarrota $oConsultanatelavisualizarrota
	 * @return integer|boolean
	 */	
    function cadastrar($oConsultanatelavisualizarrota){
		$reg = ConsultanatelavisualizarrotaMAP::objToRs($oConsultanatelavisualizarrota);
		$aCampo = array_keys($reg);
		$sql = "
				insert into consultanatelavisualizarrota(
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
	 * Alterar instância da classe Consultanatelavisualizarrota
	 * 
	 * @param Consultanatelavisualizarrota $oConsultanatelavisualizarrota
	 * @return boolean
	 */	
	function alterar($oConsultanatelavisualizarrota){
    	$reg = ConsultanatelavisualizarrotaMAP::objToRs($oConsultanatelavisualizarrota);
        $sql = "
                update 
                    consultanatelavisualizarrota 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "id") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    id = {$reg['id']}";

        foreach($reg as $cv=>$vl){
            if($cv == "id") continue;
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
	 * Excluir instância da classe Consultanatelavisualizarrota
	 * 
	 * @param integer $id
	 * @return boolean
	 */
	function excluir($id){
        $sql = "
                delete from
                    consultanatelavisualizarrota 
                where
                    id = $id";

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
	 * Retorna instância da classe Consultanatelavisualizarrota
	 * 
	 * @param integer $id
	 * @return Consultanatelavisualizarrota|boolean
	 */
	function get($id){
        $sql = "
                select 
					".ConsultanatelavisualizarrotaMAP::dataToSelect()." 
                from
					consultanatelavisualizarrota 
				left join indicador 
					on (consultanatelavisualizarrota.id = indicador.id) 
                where
					consultanatelavisualizarrota.id = $id";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return ConsultanatelavisualizarrotaMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela Consultanatelavisualizarrota
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return Consultanatelavisualizarrota[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".ConsultanatelavisualizarrotaMAP::dataToSelect()." 
				from
					consultanatelavisualizarrota 
				left join indicador 
					on (consultanatelavisualizarrota.id = indicador.id)";
        
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
                    $aObj[] = ConsultanatelavisualizarrotaMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe Consultanatelavisualizarrota
	 * 
	 * @param string $valor
	 * @return Consultanatelavisualizarrota[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".ConsultanatelavisualizarrotaMAP::dataToSelect()." 
				from
					consultanatelavisualizarrota 
				left join indicador 
					on (consultanatelavisualizarrota.id = indicador.id)
                where
					".ConsultanatelavisualizarrotaMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = ConsultanatelavisualizarrotaMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe Consultanatelavisualizarrota
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from consultanatelavisualizarrota";
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