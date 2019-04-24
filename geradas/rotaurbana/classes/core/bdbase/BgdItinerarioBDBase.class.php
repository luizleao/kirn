<?php
class BgdItinerarioBDBase {
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
	 * Cadastrar instância da classe BgdItinerario
	 * 
	 * @param BgdItinerario $oBgdItinerario
	 * @return integer|boolean
	 */	
    function cadastrar($oBgdItinerario){
		$reg = BgdItinerarioMAP::objToRs($oBgdItinerario);
		$aCampo = array_keys($reg);
		$sql = "
				insert into bgd_itinerario(
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
	 * Alterar instância da classe BgdItinerario
	 * 
	 * @param BgdItinerario $oBgdItinerario
	 * @return boolean
	 */	
	function alterar($oBgdItinerario){
    	$reg = BgdItinerarioMAP::objToRs($oBgdItinerario);
        $sql = "
                update 
                    bgd_itinerario 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "fk_bgd_itinerario_oficial_de_rota_id" || $cv == "fk_bgd_ponto_tracado_trajeto_id") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    fk_bgd_itinerario_oficial_de_rota_id = {$reg['fk_bgd_itinerario_oficial_de_rota_id']} 
					and fk_bgd_ponto_tracado_trajeto_id = {$reg['fk_bgd_ponto_tracado_trajeto_id']}";

        foreach($reg as $cv=>$vl){
            if($cv == "fk_bgd_itinerario_oficial_de_rota_id" || $cv == "fk_bgd_ponto_tracado_trajeto_id") continue;
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
	 * Excluir instância da classe BgdItinerario
	 * 
	 * @param integer $fk_bgd_itinerario_oficial_de_rota_id,$fk_bgd_ponto_tracado_trajeto_id
	 * @return boolean
	 */
	function excluir($fk_bgd_itinerario_oficial_de_rota_id,$fk_bgd_ponto_tracado_trajeto_id){
        $sql = "
                delete from
                    bgd_itinerario 
                where
                    fk_bgd_itinerario_oficial_de_rota_id = $fk_bgd_itinerario_oficial_de_rota_id 
					and fk_bgd_ponto_tracado_trajeto_id = $fk_bgd_ponto_tracado_trajeto_id";

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
	 * Retorna instância da classe BgdItinerario
	 * 
	 * @param integer $fk_bgd_itinerario_oficial_de_rota_id,$fk_bgd_ponto_tracado_trajeto_id
	 * @return BgdItinerario|boolean
	 */
	function get($fk_bgd_itinerario_oficial_de_rota_id,$fk_bgd_ponto_tracado_trajeto_id){
        $sql = "
                select 
					".BgdItinerarioMAP::dataToSelect()." 
                from
					bgd_itinerario 
				left join bgd_itinerario_oficial_de_rota 
					on (bgd_itinerario.fk_bgd_itinerario_oficial_de_rota_id = bgd_itinerario_oficial_de_rota.id) 
                where
					bgd_itinerario.fk_bgd_itinerario_oficial_de_rota_id = $fk_bgd_itinerario_oficial_de_rota_id 
					and bgd_itinerario.fk_bgd_ponto_tracado_trajeto_id = $fk_bgd_ponto_tracado_trajeto_id";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return BgdItinerarioMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela BgdItinerario
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return BgdItinerario[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".BgdItinerarioMAP::dataToSelect()." 
				from
					bgd_itinerario 
				left join bgd_itinerario_oficial_de_rota 
					on (bgd_itinerario.fk_bgd_itinerario_oficial_de_rota_id = bgd_itinerario_oficial_de_rota.id)";
        
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
                    $aObj[] = BgdItinerarioMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe BgdItinerario
	 * 
	 * @param string $valor
	 * @return BgdItinerario[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".BgdItinerarioMAP::dataToSelect()." 
				from
					bgd_itinerario 
				left join bgd_itinerario_oficial_de_rota 
					on (bgd_itinerario.fk_bgd_itinerario_oficial_de_rota_id = bgd_itinerario_oficial_de_rota.id)
                where
					".BgdItinerarioMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = BgdItinerarioMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe BgdItinerario
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from bgd_itinerario";
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