<?php
class BgdDistanciaRotaConsultaBDBase {
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
	 * Cadastrar instância da classe BgdDistanciaRotaConsulta
	 * 
	 * @param BgdDistanciaRotaConsulta $oBgdDistanciaRotaConsulta
	 * @return integer|boolean
	 */	
    function cadastrar($oBgdDistanciaRotaConsulta){
		$reg = BgdDistanciaRotaConsultaMAP::objToRs($oBgdDistanciaRotaConsulta);
		$aCampo = array_keys($reg);
		$sql = "
				insert into bgd_distancia_rota_consulta(
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
	 * Alterar instância da classe BgdDistanciaRotaConsulta
	 * 
	 * @param BgdDistanciaRotaConsulta $oBgdDistanciaRotaConsulta
	 * @return boolean
	 */	
	function alterar($oBgdDistanciaRotaConsulta){
    	$reg = BgdDistanciaRotaConsultaMAP::objToRs($oBgdDistanciaRotaConsulta);
        $sql = "
                update 
                    bgd_distancia_rota_consulta 
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
	 * Excluir instância da classe BgdDistanciaRotaConsulta
	 * 
	 * @param integer $id
	 * @return boolean
	 */
	function excluir($id){
        $sql = "
                delete from
                    bgd_distancia_rota_consulta 
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
	 * Retorna instância da classe BgdDistanciaRotaConsulta
	 * 
	 * @param integer $id
	 * @return BgdDistanciaRotaConsulta|boolean
	 */
	function get($id){
        $sql = "
                select 
					".BgdDistanciaRotaConsultaMAP::dataToSelect()." 
                from
					bgd_distancia_rota_consulta 
				left join bgd_cidade 
					on (bgd_distancia_rota_consulta.fk_bgd_cidade = bgd_cidade.id)
				left join bgd_linha 
					on (bgd_distancia_rota_consulta.fk_bgd_linha = bgd_linha.id) 
                where
					bgd_distancia_rota_consulta.id = $id";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return BgdDistanciaRotaConsultaMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela BgdDistanciaRotaConsulta
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return BgdDistanciaRotaConsulta[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".BgdDistanciaRotaConsultaMAP::dataToSelect()." 
				from
					bgd_distancia_rota_consulta 
				left join bgd_cidade 
					on (bgd_distancia_rota_consulta.fk_bgd_cidade = bgd_cidade.id)
				left join bgd_linha 
					on (bgd_distancia_rota_consulta.fk_bgd_linha = bgd_linha.id)";
        
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
                    $aObj[] = BgdDistanciaRotaConsultaMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe BgdDistanciaRotaConsulta
	 * 
	 * @param string $valor
	 * @return BgdDistanciaRotaConsulta[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".BgdDistanciaRotaConsultaMAP::dataToSelect()." 
				from
					bgd_distancia_rota_consulta 
				left join bgd_cidade 
					on (bgd_distancia_rota_consulta.fk_bgd_cidade = bgd_cidade.id)
				left join bgd_linha 
					on (bgd_distancia_rota_consulta.fk_bgd_linha = bgd_linha.id)
                where
					".BgdDistanciaRotaConsultaMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = BgdDistanciaRotaConsultaMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe BgdDistanciaRotaConsulta
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from bgd_distancia_rota_consulta";
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