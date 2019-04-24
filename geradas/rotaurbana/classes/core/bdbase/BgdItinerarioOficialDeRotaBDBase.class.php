<?php
class BgdItinerarioOficialDeRotaBDBase {
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
	 * Cadastrar instância da classe BgdItinerarioOficialDeRota
	 * 
	 * @param BgdItinerarioOficialDeRota $oBgdItinerarioOficialDeRota
	 * @return integer|boolean
	 */	
    function cadastrar($oBgdItinerarioOficialDeRota){
		$reg = BgdItinerarioOficialDeRotaMAP::objToRs($oBgdItinerarioOficialDeRota);
		$aCampo = array_keys($reg);
		$sql = "
				insert into bgd_itinerario_oficial_de_rota(
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
	 * Alterar instância da classe BgdItinerarioOficialDeRota
	 * 
	 * @param BgdItinerarioOficialDeRota $oBgdItinerarioOficialDeRota
	 * @return boolean
	 */	
	function alterar($oBgdItinerarioOficialDeRota){
    	$reg = BgdItinerarioOficialDeRotaMAP::objToRs($oBgdItinerarioOficialDeRota);
        $sql = "
                update 
                    bgd_itinerario_oficial_de_rota 
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
	 * Excluir instância da classe BgdItinerarioOficialDeRota
	 * 
	 * @param integer $id
	 * @return boolean
	 */
	function excluir($id){
        $sql = "
                delete from
                    bgd_itinerario_oficial_de_rota 
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
	 * Retorna instância da classe BgdItinerarioOficialDeRota
	 * 
	 * @param integer $id
	 * @return BgdItinerarioOficialDeRota|boolean
	 */
	function get($id){
        $sql = "
                select 
					".BgdItinerarioOficialDeRotaMAP::dataToSelect()." 
                from
					bgd_itinerario_oficial_de_rota 
				left join bgd_cidade 
					on (bgd_itinerario_oficial_de_rota.fk_bgd_cidade = bgd_cidade.id)
				left join bgd_cidade 
					on (bgd_itinerario_oficial_de_rota.fk_bgd_cidade_prox_usuario = bgd_cidade.id)
				left join bgd_linha 
					on (bgd_itinerario_oficial_de_rota.fk_bgd_linha = bgd_linha.id)
				left join bgd_usuario 
					on (bgd_itinerario_oficial_de_rota.fk_bgd_usuario = bgd_usuario.id) 
                where
					bgd_itinerario_oficial_de_rota.id = $id";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return BgdItinerarioOficialDeRotaMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela BgdItinerarioOficialDeRota
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return BgdItinerarioOficialDeRota[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".BgdItinerarioOficialDeRotaMAP::dataToSelect()." 
				from
					bgd_itinerario_oficial_de_rota 
				left join bgd_cidade 
					on (bgd_itinerario_oficial_de_rota.fk_bgd_cidade = bgd_cidade.id)
				left join bgd_cidade 
					on (bgd_itinerario_oficial_de_rota.fk_bgd_cidade_prox_usuario = bgd_cidade.id)
				left join bgd_linha 
					on (bgd_itinerario_oficial_de_rota.fk_bgd_linha = bgd_linha.id)
				left join bgd_usuario 
					on (bgd_itinerario_oficial_de_rota.fk_bgd_usuario = bgd_usuario.id)";
        
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
                    $aObj[] = BgdItinerarioOficialDeRotaMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe BgdItinerarioOficialDeRota
	 * 
	 * @param string $valor
	 * @return BgdItinerarioOficialDeRota[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".BgdItinerarioOficialDeRotaMAP::dataToSelect()." 
				from
					bgd_itinerario_oficial_de_rota 
				left join bgd_cidade 
					on (bgd_itinerario_oficial_de_rota.fk_bgd_cidade = bgd_cidade.id)
				left join bgd_cidade 
					on (bgd_itinerario_oficial_de_rota.fk_bgd_cidade_prox_usuario = bgd_cidade.id)
				left join bgd_linha 
					on (bgd_itinerario_oficial_de_rota.fk_bgd_linha = bgd_linha.id)
				left join bgd_usuario 
					on (bgd_itinerario_oficial_de_rota.fk_bgd_usuario = bgd_usuario.id)
                where
					".BgdItinerarioOficialDeRotaMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = BgdItinerarioOficialDeRotaMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe BgdItinerarioOficialDeRota
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from bgd_itinerario_oficial_de_rota";
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