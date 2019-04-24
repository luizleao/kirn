<?php
class ConsultasnatelavisualizarrotaandroidBDBase {
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
	 * Cadastrar instância da classe Consultasnatelavisualizarrotaandroid
	 * 
	 * @param Consultasnatelavisualizarrotaandroid $oConsultasnatelavisualizarrotaandroid
	 * @return integer|boolean
	 */	
    function cadastrar($oConsultasnatelavisualizarrotaandroid){
		$reg = ConsultasnatelavisualizarrotaandroidMAP::objToRs($oConsultasnatelavisualizarrotaandroid);
		$aCampo = array_keys($reg);
		$sql = "
				insert into consultasnatelavisualizarrotaandroid(
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
	 * Alterar instância da classe Consultasnatelavisualizarrotaandroid
	 * 
	 * @param Consultasnatelavisualizarrotaandroid $oConsultasnatelavisualizarrotaandroid
	 * @return boolean
	 */	
	function alterar($oConsultasnatelavisualizarrotaandroid){
    	$reg = ConsultasnatelavisualizarrotaandroidMAP::objToRs($oConsultasnatelavisualizarrotaandroid);
        $sql = "
                update 
                    consultasnatelavisualizarrotaandroid 
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
	 * Excluir instância da classe Consultasnatelavisualizarrotaandroid
	 * 
	 * @param integer $id
	 * @return boolean
	 */
	function excluir($id){
        $sql = "
                delete from
                    consultasnatelavisualizarrotaandroid 
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
	 * Retorna instância da classe Consultasnatelavisualizarrotaandroid
	 * 
	 * @param integer $id
	 * @return Consultasnatelavisualizarrotaandroid|boolean
	 */
	function get($id){
        $sql = "
                select 
					".ConsultasnatelavisualizarrotaandroidMAP::dataToSelect()." 
                from
					consultasnatelavisualizarrotaandroid 
                where
					consultasnatelavisualizarrotaandroid.id = $id";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return ConsultasnatelavisualizarrotaandroidMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela Consultasnatelavisualizarrotaandroid
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return Consultasnatelavisualizarrotaandroid[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".ConsultasnatelavisualizarrotaandroidMAP::dataToSelect()." 
				from
					consultasnatelavisualizarrotaandroid";
        
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
                    $aObj[] = ConsultasnatelavisualizarrotaandroidMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe Consultasnatelavisualizarrotaandroid
	 * 
	 * @param string $valor
	 * @return Consultasnatelavisualizarrotaandroid[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".ConsultasnatelavisualizarrotaandroidMAP::dataToSelect()." 
				from
					consultasnatelavisualizarrotaandroid
                where
					".ConsultasnatelavisualizarrotaandroidMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = ConsultasnatelavisualizarrotaandroidMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe Consultasnatelavisualizarrotaandroid
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from consultasnatelavisualizarrotaandroid";
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