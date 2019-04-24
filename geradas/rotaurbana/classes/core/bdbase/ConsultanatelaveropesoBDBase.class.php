<?php
class ConsultanatelaveropesoBDBase {
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
	 * Cadastrar instância da classe Consultanatelaveropeso
	 * 
	 * @param Consultanatelaveropeso $oConsultanatelaveropeso
	 * @return integer|boolean
	 */	
    function cadastrar($oConsultanatelaveropeso){
		$reg = ConsultanatelaveropesoMAP::objToRs($oConsultanatelaveropeso);
		$aCampo = array_keys($reg);
		$sql = "
				insert into consultanatelaveropeso(
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
	 * Alterar instância da classe Consultanatelaveropeso
	 * 
	 * @param Consultanatelaveropeso $oConsultanatelaveropeso
	 * @return boolean
	 */	
	function alterar($oConsultanatelaveropeso){
    	$reg = ConsultanatelaveropesoMAP::objToRs($oConsultanatelaveropeso);
        $sql = "
                update 
                    consultanatelaveropeso 
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
	 * Excluir instância da classe Consultanatelaveropeso
	 * 
	 * @param integer $id
	 * @return boolean
	 */
	function excluir($id){
        $sql = "
                delete from
                    consultanatelaveropeso 
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
	 * Retorna instância da classe Consultanatelaveropeso
	 * 
	 * @param integer $id
	 * @return Consultanatelaveropeso|boolean
	 */
	function get($id){
        $sql = "
                select 
					".ConsultanatelaveropesoMAP::dataToSelect()." 
                from
					consultanatelaveropeso 
				left join indicador 
					on (consultanatelaveropeso.id = indicador.id) 
                where
					consultanatelaveropeso.id = $id";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return ConsultanatelaveropesoMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela Consultanatelaveropeso
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return Consultanatelaveropeso[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".ConsultanatelaveropesoMAP::dataToSelect()." 
				from
					consultanatelaveropeso 
				left join indicador 
					on (consultanatelaveropeso.id = indicador.id)";
        
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
                    $aObj[] = ConsultanatelaveropesoMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe Consultanatelaveropeso
	 * 
	 * @param string $valor
	 * @return Consultanatelaveropeso[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".ConsultanatelaveropesoMAP::dataToSelect()." 
				from
					consultanatelaveropeso 
				left join indicador 
					on (consultanatelaveropeso.id = indicador.id)
                where
					".ConsultanatelaveropesoMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = ConsultanatelaveropesoMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe Consultanatelaveropeso
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from consultanatelaveropeso";
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