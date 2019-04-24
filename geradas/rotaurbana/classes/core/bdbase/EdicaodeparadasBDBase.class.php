<?php
class EdicaodeparadasBDBase {
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
	 * Cadastrar instância da classe Edicaodeparadas
	 * 
	 * @param Edicaodeparadas $oEdicaodeparadas
	 * @return integer|boolean
	 */	
    function cadastrar($oEdicaodeparadas){
		$reg = EdicaodeparadasMAP::objToRs($oEdicaodeparadas);
		$aCampo = array_keys($reg);
		$sql = "
				insert into edicaodeparadas(
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
	 * Alterar instância da classe Edicaodeparadas
	 * 
	 * @param Edicaodeparadas $oEdicaodeparadas
	 * @return boolean
	 */	
	function alterar($oEdicaodeparadas){
    	$reg = EdicaodeparadasMAP::objToRs($oEdicaodeparadas);
        $sql = "
                update 
                    edicaodeparadas 
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
	 * Excluir instância da classe Edicaodeparadas
	 * 
	 * @param integer $id
	 * @return boolean
	 */
	function excluir($id){
        $sql = "
                delete from
                    edicaodeparadas 
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
	 * Retorna instância da classe Edicaodeparadas
	 * 
	 * @param integer $id
	 * @return Edicaodeparadas|boolean
	 */
	function get($id){
        $sql = "
                select 
					".EdicaodeparadasMAP::dataToSelect()." 
                from
					edicaodeparadas 
				left join indicador 
					on (edicaodeparadas.id = indicador.id) 
                where
					edicaodeparadas.id = $id";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return EdicaodeparadasMAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela Edicaodeparadas
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return Edicaodeparadas[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".EdicaodeparadasMAP::dataToSelect()." 
				from
					edicaodeparadas 
				left join indicador 
					on (edicaodeparadas.id = indicador.id)";
        
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
                    $aObj[] = EdicaodeparadasMAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe Edicaodeparadas
	 * 
	 * @param string $valor
	 * @return Edicaodeparadas[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".EdicaodeparadasMAP::dataToSelect()." 
				from
					edicaodeparadas 
				left join indicador 
					on (edicaodeparadas.id = indicador.id)
                where
					".EdicaodeparadasMAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = EdicaodeparadasMAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe Edicaodeparadas
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from edicaodeparadas";
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