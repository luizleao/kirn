<?php
class TipoServicoBDBase {
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
	 * Cadastrar instância da classe TipoServico
	 * 
	 * @param TipoServico $oTipoServico
	 * @return integer|boolean
	 */	
    function cadastrar($oTipoServico){
		$reg = TipoServicoMAP::objToRs($oTipoServico);
		$aCampo = array_keys($reg);
		$sql = "
				insert into TipoServico(
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
	 * Alterar instância da classe TipoServico
	 * 
	 * @param TipoServico $oTipoServico
	 * @return boolean
	 */	
	function alterar($oTipoServico){
    	$reg = TipoServicoMAP::objToRs($oTipoServico);
        $sql = "
                update 
                    TipoServico 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "idTipoServico") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    idTipoServico = {$reg['idTipoServico']}";

        foreach($reg as $cv=>$vl){
            if($cv == "idTipoServico") continue;
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
	 * Excluir instância da classe TipoServico
	 * 
	 * @param integer $idTipoServico
	 * @return boolean
	 */
	function excluir($idTipoServico){
        $sql = "
                delete from
                    TipoServico 
                where
                    idTipoServico = $idTipoServico";

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
	 * Retorna instância da classe TipoServico
	 * 
	 * @param integer $idTipoServico
	 * @return TipoServico|boolean
	 */
	function get($idTipoServico){
        $sql = "
                select 
					".TipoServicoMAP::dataToSelect()." 
                from
					TipoServico 
				left join NaturezaContratual 
					on (TipoServico.idNaturezaContratual = NaturezaContratual.idNaturezaContratual) 
                where
					TipoServico.idTipoServico = $idTipoServico";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return TipoServicoMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela TipoServico
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return TipoServico[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".TipoServicoMAP::dataToSelect()." 
				from
					TipoServico 
				left join NaturezaContratual 
					on (TipoServico.idNaturezaContratual = NaturezaContratual.idNaturezaContratual)";
        
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
                    $aObj[] = TipoServicoMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe TipoServico
	 * 
	 * @param string $valor
	 * @return TipoServico[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".TipoServicoMAP::dataToSelect()." 
				from
					TipoServico 
				left join NaturezaContratual 
					on (TipoServico.idNaturezaContratual = NaturezaContratual.idNaturezaContratual)
                where
					".TipoServicoMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = TipoServicoMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe TipoServico
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from TipoServico";
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