<?php
class BgdPontoTracadoTrajetoBDBase {
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
	 * Cadastrar instância da classe BgdPontoTracadoTrajeto
	 * 
	 * @param BgdPontoTracadoTrajeto $oBgdPontoTracadoTrajeto
	 * @return integer|boolean
	 */	
    function cadastrar($oBgdPontoTracadoTrajeto){
		$reg = BgdPontoTracadoTrajetoMAP::objToRs($oBgdPontoTracadoTrajeto);
		$aCampo = array_keys($reg);
		$sql = "
				insert into bgd_ponto_tracado_trajeto(
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
	 * Alterar instância da classe BgdPontoTracadoTrajeto
	 * 
	 * @param BgdPontoTracadoTrajeto $oBgdPontoTracadoTrajeto
	 * @return boolean
	 */	
	function alterar($oBgdPontoTracadoTrajeto){
    	$reg = BgdPontoTracadoTrajetoMAP::objToRs($oBgdPontoTracadoTrajeto);
        $sql = "
                update 
                    bgd_ponto_tracado_trajeto 
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
	 * Excluir instância da classe BgdPontoTracadoTrajeto
	 * 
	 * @param integer $id
	 * @return boolean
	 */
	function excluir($id){
        $sql = "
                delete from
                    bgd_ponto_tracado_trajeto 
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
	 * Retorna instância da classe BgdPontoTracadoTrajeto
	 * 
	 * @param integer $id
	 * @return BgdPontoTracadoTrajeto|boolean
	 */
	function get($id){
        $sql = "
                select 
					".BgdPontoTracadoTrajetoMAP::dataToSelect()." 
                from
					bgd_ponto_tracado_trajeto 
				left join bgd_linha 
					on (bgd_ponto_tracado_trajeto.fk_bgd_linha = bgd_linha.id) 
                where
					bgd_ponto_tracado_trajeto.id = $id";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return BgdPontoTracadoTrajetoMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela BgdPontoTracadoTrajeto
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return BgdPontoTracadoTrajeto[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".BgdPontoTracadoTrajetoMAP::dataToSelect()." 
				from
					bgd_ponto_tracado_trajeto 
				left join bgd_linha 
					on (bgd_ponto_tracado_trajeto.fk_bgd_linha = bgd_linha.id)";
        
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
                    $aObj[] = BgdPontoTracadoTrajetoMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe BgdPontoTracadoTrajeto
	 * 
	 * @param string $valor
	 * @return BgdPontoTracadoTrajeto[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".BgdPontoTracadoTrajetoMAP::dataToSelect()." 
				from
					bgd_ponto_tracado_trajeto 
				left join bgd_linha 
					on (bgd_ponto_tracado_trajeto.fk_bgd_linha = bgd_linha.id)
                where
					".BgdPontoTracadoTrajetoMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = BgdPontoTracadoTrajetoMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe BgdPontoTracadoTrajeto
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from bgd_ponto_tracado_trajeto";
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