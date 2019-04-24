<?php
class EstadoMAP {
	static function getMetaData() {
		return ['estado' => ['id', 
						'nome', 
						'uf', 
						'pais_id'], 
				'pais' => [						'id', 
						'nome', 
						'sigla']];
	}

	static function dataToSelect() {
        foreach(self::getMetaData() as $tabela => $aCampo){
            foreach($aCampo as $sCampo){
                $aux[] = "$tabela.$sCampo as $tabela"."_$sCampo";
            }
        }
        
        return implode(",\n", $aux);
    }
    
    static function filterLike($valor) {
        foreach(self::getMetaData() as $tabela => $aCampo){
            foreach($aCampo as $sCampo){
                $aux[] = "$tabela.$sCampo like '$valor'";
            }
        }
        
        return implode("\nor ", $aux);
    }

	static function objToRs($oEstado){
		$reg['id'] = $oEstado->id;
		$reg['nome'] = $oEstado->nome;
		$reg['uf'] = $oEstado->uf;
		$oPais = $oEstado->oPais;
		$reg['pais_id'] = $oPais->id;
		return $reg;		   
	}

	static function objToRsInsert($oEstado){
		$reg['nome'] = $oEstado->nome;
		$reg['uf'] = $oEstado->uf;
		$oPais = $oEstado->oPais;
		$reg['pais_id'] = $oPais->id;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oEstado = new Estado();
		$oEstado->id = $reg['estado_id'];
		$oEstado->nome = $reg['estado_nome'];
		$oEstado->uf = $reg['estado_uf'];

		$oPais = new Pais();
		$oPais->id = $reg['pais_id'];
		$oPais->nome = $reg['pais_nome'];
		$oPais->sigla = $reg['pais_sigla'];
		$oEstado->oPais = $oPais;
		return $oEstado;		   
	}
}
