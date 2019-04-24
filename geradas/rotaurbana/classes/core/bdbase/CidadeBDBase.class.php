<?php
class CidadeBDBase {
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
	 * Cadastrar instância da classe Cidade
	 * 
	 * @param Cidade $oCidade
	 * @return integer|boolean
	 */	
    function cadastrar($oCidade){
		$reg = CidadeMAP::objToRs($oCidade);
		$aCampo = array_keys($reg);
		$sql = "
				insert into cidade(
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
	 * Alterar instância da classe Cidade
	 * 
	 * @param Cidade $oCidade
	 * @return boolean
	 */	
	function alterar($oCidade){
    	$reg = CidadeMAP::objToRs($oCidade);
        $sql = "
                update 
                    cidade 
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
	 * Excluir instância da classe Cidade
	 * 
	 * @param integer $id
	 * @return boolean
	 */
	function excluir($id){
        $sql = "
                delete from
                    cidade 
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
	 * Retorna instância da classe Cidade
	 * 
	 * @param integer $id
	 * @return Cidade|boolean
	 */
	function get($id){
        $sql = "
                select 
					".CidadeMAP::dataToSelect()." 
                from
					cidade 
				left join estado 
					on (cidade.estado_id = estado.id)
				left join cidade 
					on (cidade.belongsTo_id = cidade.id) 
                where
					cidade.id = $id";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return CidadeMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela Cidade
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return Cidade[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".CidadeMAP::dataToSelect()." 
				from
					cidade 
				left join estado 
					on (cidade.estado_id = estado.id)
				left join cidade 
					on (cidade.belongsTo_id = cidade.id)";
        
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
                    $aObj[] = CidadeMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe Cidade
	 * 
	 * @param string $valor
	 * @return Cidade[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".CidadeMAP::dataToSelect()." 
				from
					cidade 
				left join estado 
					on (cidade.estado_id = estado.id)
				left join cidade 
					on (cidade.belongsTo_id = cidade.id)
                where
					".CidadeMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = CidadeMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe Cidade
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from cidade";
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