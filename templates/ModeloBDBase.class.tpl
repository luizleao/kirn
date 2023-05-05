<?php
class %%NOME_CLASSE%%BDBase {
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
	 * Cadastrar instância da classe %%NOME_CLASSE%%
	 * 
	 * @param %%NOME_CLASSE%% %%OBJETO_CLASSE%%
	 * @return integer|boolean
	 */	
    function cadastrar(%%OBJETO_CLASSE%%){
		$reg = %%NOME_CLASSE%%MAP::objToRs(%%OBJETO_CLASSE%%);
		$aCampo = array_keys($reg);
		$sql = "
				insert into %%TABELA%%(
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
			return %%RETURN_CADASTRAR%%;
		}
		catch(PDOException $e){
			$this->msg = $e->getMessage();
			return false;
		}
	}
	
	/**
	 * Alterar instância da classe %%NOME_CLASSE%%
	 * 
	 * @param %%NOME_CLASSE%% %%OBJETO_CLASSE%%
	 * @return boolean
	 */	
	function alterar(%%OBJETO_CLASSE%%){
    	$reg = %%NOME_CLASSE%%MAP::objToRs(%%OBJETO_CLASSE%%);
        $sql = "
                update 
                    %%TABELA%% 
                set
                    ";
        foreach($reg as $cv=>$vl){
            %%CAMPOS_CHAVE_ALTERAR%%
            $a[] = "$cv = :$cv";
        }
        $sql .= implode(",\n", $a);
        $sql .= "
                where
                    %%CHAVES_WHERE%%";

        foreach($reg as $cv=>$vl){
            %%CAMPOS_CHAVE_ALTERAR%%
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
	 * Excluir instância da classe %%NOME_CLASSE%%
	 * 
	 * @param integer %%LISTA_CHAVES%%
	 * @return boolean
	 */
	function excluir(%%LISTA_CHAVES%%){
        $sql = "
                delete from
                    %%TABELA%% 
                where
                    %%CHAVES_WHERE_DEL%%";

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
	 * Retorna instância da classe %%NOME_CLASSE%%
	 * 
	 * @param integer %%LISTA_CHAVES%%
	 * @return %%NOME_CLASSE%%|boolean
	 */
	function get(%%LISTA_CHAVES%%){
        $sql = "
                select 
					".%%NOME_CLASSE%%MAP::dataToSelect()." 
                from
					%%TABELA_JOIN%% 
                where
					%%CHAVES_WHERE_SEL%%";
        try{
            $this->oConexao->execute($sql);
            if($this->oConexao->numRows() != 0){
                $oReg = $this->oConexao->fetchReg();
                return %%NOME_CLASSE%%MAP::rsToObj($oReg);
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
	 * Retorna a lista de registros da tabela %%NOME_CLASSE%%
	 * 
	 * @param string[] $aFiltro
	 * @param string[] $aOrdenacao
	 * @param integer $qtd
	 * @param integer $pagina
	 * @return %%NOME_CLASSE%%[]|boolean
	 */
    function getAll($aFiltro = [], $aOrdenacao = [], $qtd = NULL, $pagina = NULL){
        $sql = "
				select
					".%%NOME_CLASSE%%MAP::dataToSelect()." 
				from
					%%TABELA_JOIN%%";
        
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
                    $aObj[] = %%NOME_CLASSE%%MAP::rsToObj($oReg);
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
	 * Consultar instâncias da classe %%NOME_CLASSE%%
	 * 
	 * @param string $valor
	 * @return %%NOME_CLASSE%%[]|boolean
	 */
    function consultar($valor){
    	$valor = Util::formataConsultaLike($valor); 

        $sql = "
				select
					".%%NOME_CLASSE%%MAP::dataToSelect()." 
				from
					%%TABELA_JOIN%%
                where
					".%%NOME_CLASSE%%MAP::filterLike($valor);
					
        //print "<pre>$sql</pre>";
        try{
            $this->oConexao->execute($sql);
            $aObj = array();
            if($this->oConexao->numRows() != 0){
                while ($oReg = $this->oConexao->fetchReg()){
                    $aObj[] = %%NOME_CLASSE%%MAP::rsToObj($oReg);
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
	 * Retorna o total de instâncias da classe %%NOME_CLASSE%%
	 * 
	 * @return integer|boolean
	 */
    function totalColecao(){
        $sql = "select count(*) from %%TABELA%%";
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