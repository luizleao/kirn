<?php
class BgdRequisicaoInfoParadaBDBase {
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
	 * Cadastrar instância da classe BgdRequisicaoInfoParada
	 * 
	 * @param BgdRequisicaoInfoParada $oBgdRequisicaoInfoParada
	 * @return integer|boolean
	 */	
    function cadastrar($oBgdRequisicaoInfoParada){
		$reg = BgdRequisicaoInfoParadaMAP::objToRs($oBgdRequisicaoInfoParada);
		$aCampo = array_keys($reg);
		$sql = "
				insert into bgd_requisicao_info_parada(
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
	 * Alterar instância da classe BgdRequisicaoInfoParada
	 * 
	 * @param BgdRequisicaoInfoParada $oBgdRequisicaoInfoParada
	 * @return boolean
	 */	
	function alterar($oBgdRequisicaoInfoParada){
    	$reg = BgdRequisicaoInfoParadaMAP::objToRs($oBgdRequisicaoInfoParada);
        $sql = "
                update 
                    bgd_requisicao_info_parada 
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
	 * Excluir instância da classe BgdRequisicaoInfoParada
	 * 
	 * @param integer $id
	 * @return boolean
	 */
	function excluir($id){
        $sql = "
                delete from
                    bgd_requisicao_info_parada 
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
	 * Retorna instância da classe BgdRequisicaoInfoParada
	 * 
	 * @param integer $id
	 * @return BgdRequisicaoInfoParada|boolean
	 */
	function get($id){
        $sql = "
                select 
					".BgdRequisicaoInfoParadaMAP::dataToSelect()." 
                from
					bgd_requisicao_info_parada 
				left join bgd_cidade 
					on (bgd_requisicao_info_parada.fk_bgd_cidade = bgd_cidade.id)
				left join bgd_cidade 
					on (bgd_requisicao_info_parada.fk_bgd_cidade_prox_usuario = bgd_cidade.id)
				left join bgd_parada 
					on (bgd_requisicao_info_parada.fk_bgd_parada = bgd_parada.id) 
                where
					bgd_requisicao_info_parada.id = $id";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return BgdRequisicaoInfoParadaMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela BgdRequisicaoInfoParada
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return BgdRequisicaoInfoParada[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".BgdRequisicaoInfoParadaMAP::dataToSelect()." 
				from
					bgd_requisicao_info_parada 
				left join bgd_cidade 
					on (bgd_requisicao_info_parada.fk_bgd_cidade = bgd_cidade.id)
				left join bgd_cidade 
					on (bgd_requisicao_info_parada.fk_bgd_cidade_prox_usuario = bgd_cidade.id)
				left join bgd_parada 
					on (bgd_requisicao_info_parada.fk_bgd_parada = bgd_parada.id)";
        
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
                    $aObj[] = BgdRequisicaoInfoParadaMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe BgdRequisicaoInfoParada
	 * 
	 * @param string $valor
	 * @return BgdRequisicaoInfoParada[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".BgdRequisicaoInfoParadaMAP::dataToSelect()." 
				from
					bgd_requisicao_info_parada 
				left join bgd_cidade 
					on (bgd_requisicao_info_parada.fk_bgd_cidade = bgd_cidade.id)
				left join bgd_cidade 
					on (bgd_requisicao_info_parada.fk_bgd_cidade_prox_usuario = bgd_cidade.id)
				left join bgd_parada 
					on (bgd_requisicao_info_parada.fk_bgd_parada = bgd_parada.id)
                where
					".BgdRequisicaoInfoParadaMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = BgdRequisicaoInfoParadaMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe BgdRequisicaoInfoParada
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from bgd_requisicao_info_parada";
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