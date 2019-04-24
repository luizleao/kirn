<?php
class BgdEdicaoParadaBDBase {
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
	 * Cadastrar instância da classe BgdEdicaoParada
	 * 
	 * @param BgdEdicaoParada $oBgdEdicaoParada
	 * @return integer|boolean
	 */	
    function cadastrar($oBgdEdicaoParada){
		$reg = BgdEdicaoParadaMAP::objToRs($oBgdEdicaoParada);
		$aCampo = array_keys($reg);
		$sql = "
				insert into bgd_edicao_parada(
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
	 * Alterar instância da classe BgdEdicaoParada
	 * 
	 * @param BgdEdicaoParada $oBgdEdicaoParada
	 * @return boolean
	 */	
	function alterar($oBgdEdicaoParada){
    	$reg = BgdEdicaoParadaMAP::objToRs($oBgdEdicaoParada);
        $sql = "
                update 
                    bgd_edicao_parada 
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
	 * Excluir instância da classe BgdEdicaoParada
	 * 
	 * @param integer $id
	 * @return boolean
	 */
	function excluir($id){
        $sql = "
                delete from
                    bgd_edicao_parada 
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
	 * Retorna instância da classe BgdEdicaoParada
	 * 
	 * @param integer $id
	 * @return BgdEdicaoParada|boolean
	 */
	function get($id){
        $sql = "
                select 
					".BgdEdicaoParadaMAP::dataToSelect()." 
                from
					bgd_edicao_parada 
				left join bgd_cidade 
					on (bgd_edicao_parada.bgd_cidade = bgd_cidade.id)
				left join bgd_cidade 
					on (bgd_edicao_parada.fk_bgd_cidade_prox_usuario = bgd_cidade.id)
				left join bgd_parada 
					on (bgd_edicao_parada.fk_bgd_parada = bgd_parada.id) 
                where
					bgd_edicao_parada.id = $id";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return BgdEdicaoParadaMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela BgdEdicaoParada
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return BgdEdicaoParada[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".BgdEdicaoParadaMAP::dataToSelect()." 
				from
					bgd_edicao_parada 
				left join bgd_cidade 
					on (bgd_edicao_parada.bgd_cidade = bgd_cidade.id)
				left join bgd_cidade 
					on (bgd_edicao_parada.fk_bgd_cidade_prox_usuario = bgd_cidade.id)
				left join bgd_parada 
					on (bgd_edicao_parada.fk_bgd_parada = bgd_parada.id)";
        
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
                    $aObj[] = BgdEdicaoParadaMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe BgdEdicaoParada
	 * 
	 * @param string $valor
	 * @return BgdEdicaoParada[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".BgdEdicaoParadaMAP::dataToSelect()." 
				from
					bgd_edicao_parada 
				left join bgd_cidade 
					on (bgd_edicao_parada.bgd_cidade = bgd_cidade.id)
				left join bgd_cidade 
					on (bgd_edicao_parada.fk_bgd_cidade_prox_usuario = bgd_cidade.id)
				left join bgd_parada 
					on (bgd_edicao_parada.fk_bgd_parada = bgd_parada.id)
                where
					".BgdEdicaoParadaMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = BgdEdicaoParadaMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe BgdEdicaoParada
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from bgd_edicao_parada";
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