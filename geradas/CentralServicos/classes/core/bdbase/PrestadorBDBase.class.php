<?php
class PrestadorBDBase {
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
	 * Cadastrar instância da classe Prestador
	 * 
	 * @param Prestador $oPrestador
	 * @return integer|boolean
	 */	
    function cadastrar($oPrestador){
		$reg = PrestadorMAP::objToRs($oPrestador);
		$aCampo = array_keys($reg);
		$sql = "
				insert into Prestador(
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
	 * Alterar instância da classe Prestador
	 * 
	 * @param Prestador $oPrestador
	 * @return boolean
	 */	
	function alterar($oPrestador){
    	$reg = PrestadorMAP::objToRs($oPrestador);
        $sql = "
                update 
                    Prestador 
                set
                    ";
        foreach($reg as $cv=>$vl){
            if($cv == "idPrestador") continue;
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    idPrestador = {$reg['idPrestador']}";

        foreach($reg as $cv=>$vl){
            if($cv == "idPrestador") continue;
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
	 * Excluir instância da classe Prestador
	 * 
	 * @param integer $idPrestador
	 * @return boolean
	 */
	function excluir($idPrestador){
        $sql = "
                delete from
                    Prestador 
                where
                    idPrestador = $idPrestador";

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
	 * Retorna instância da classe Prestador
	 * 
	 * @param integer $idPrestador
	 * @return Prestador|boolean
	 */
	function get($idPrestador){
        $sql = "
                select 
					".PrestadorMAP::dataToSelect()." 
                from
					Prestador 
				left join NaturezaContratual 
					on (Prestador.idNaturezaContratual = NaturezaContratual.idNaturezaContratual) 
                where
					Prestador.idPrestador = $idPrestador";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return PrestadorMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela Prestador
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return Prestador[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".PrestadorMAP::dataToSelect()." 
				from
					Prestador 
				left join NaturezaContratual 
					on (Prestador.idNaturezaContratual = NaturezaContratual.idNaturezaContratual)";
        
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
                    $aObj[] = PrestadorMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe Prestador
	 * 
	 * @param string $valor
	 * @return Prestador[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".PrestadorMAP::dataToSelect()." 
				from
					Prestador 
				left join NaturezaContratual 
					on (Prestador.idNaturezaContratual = NaturezaContratual.idNaturezaContratual)
                where
					".PrestadorMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = PrestadorMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe Prestador
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from Prestador";
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