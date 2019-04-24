<?php
class BgdDistanciaRotaSelecionadaBDBase {
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
	 * Cadastrar instância da classe BgdDistanciaRotaSelecionada
	 * 
	 * @param BgdDistanciaRotaSelecionada $oBgdDistanciaRotaSelecionada
	 * @return integer|boolean
	 */	
    function cadastrar($oBgdDistanciaRotaSelecionada){
		$reg = BgdDistanciaRotaSelecionadaMAP::objToRs($oBgdDistanciaRotaSelecionada);
		$aCampo = array_keys($reg);
		$sql = "
				insert into bgd_distancia_rota_selecionada(
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
	 * Alterar instância da classe BgdDistanciaRotaSelecionada
	 * 
	 * @param BgdDistanciaRotaSelecionada $oBgdDistanciaRotaSelecionada
	 * @return boolean
	 */	
	function alterar($oBgdDistanciaRotaSelecionada){
    	$reg = BgdDistanciaRotaSelecionadaMAP::objToRs($oBgdDistanciaRotaSelecionada);
        $sql = "
                update 
                    bgd_distancia_rota_selecionada 
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
	 * Excluir instância da classe BgdDistanciaRotaSelecionada
	 * 
	 * @param integer $id
	 * @return boolean
	 */
	function excluir($id){
        $sql = "
                delete from
                    bgd_distancia_rota_selecionada 
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
	 * Retorna instância da classe BgdDistanciaRotaSelecionada
	 * 
	 * @param integer $id
	 * @return BgdDistanciaRotaSelecionada|boolean
	 */
	function get($id){
        $sql = "
                select 
					".BgdDistanciaRotaSelecionadaMAP::dataToSelect()." 
                from
					bgd_distancia_rota_selecionada 
				left join bgd_cidade 
					on (bgd_distancia_rota_selecionada.fk_bgd_cidade = bgd_cidade.id)
				left join bgd_cidade 
					on (bgd_distancia_rota_selecionada.fk_bgd_cidade_prox_usuario = bgd_cidade.id)
				left join bgd_linha 
					on (bgd_distancia_rota_selecionada.fk_bgd_linha = bgd_linha.id) 
                where
					bgd_distancia_rota_selecionada.id = $id";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return BgdDistanciaRotaSelecionadaMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela BgdDistanciaRotaSelecionada
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return BgdDistanciaRotaSelecionada[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".BgdDistanciaRotaSelecionadaMAP::dataToSelect()." 
				from
					bgd_distancia_rota_selecionada 
				left join bgd_cidade 
					on (bgd_distancia_rota_selecionada.fk_bgd_cidade = bgd_cidade.id)
				left join bgd_cidade 
					on (bgd_distancia_rota_selecionada.fk_bgd_cidade_prox_usuario = bgd_cidade.id)
				left join bgd_linha 
					on (bgd_distancia_rota_selecionada.fk_bgd_linha = bgd_linha.id)";
        
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
                    $aObj[] = BgdDistanciaRotaSelecionadaMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe BgdDistanciaRotaSelecionada
	 * 
	 * @param string $valor
	 * @return BgdDistanciaRotaSelecionada[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".BgdDistanciaRotaSelecionadaMAP::dataToSelect()." 
				from
					bgd_distancia_rota_selecionada 
				left join bgd_cidade 
					on (bgd_distancia_rota_selecionada.fk_bgd_cidade = bgd_cidade.id)
				left join bgd_cidade 
					on (bgd_distancia_rota_selecionada.fk_bgd_cidade_prox_usuario = bgd_cidade.id)
				left join bgd_linha 
					on (bgd_distancia_rota_selecionada.fk_bgd_linha = bgd_linha.id)
                where
					".BgdDistanciaRotaSelecionadaMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = BgdDistanciaRotaSelecionadaMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe BgdDistanciaRotaSelecionada
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from bgd_distancia_rota_selecionada";
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