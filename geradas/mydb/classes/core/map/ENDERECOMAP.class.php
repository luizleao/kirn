<?php
class ENDERECOMAP {
	static function getMetaData() {
		return ['ENDERECO' => ['id', 
						'rua', 
						'bairro', 
						'cep', 
						'numero', 
						'complemento', 
						'CIDADE_id'], 
				'CIDADE' => [						'id', 
						'nome', 
						'ESTADO_id']];
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

	static function objToRs($oENDERECO){
		$reg['id'] = $oENDERECO->id;
		$reg['rua'] = $oENDERECO->rua;
		$reg['bairro'] = $oENDERECO->bairro;
		$reg['cep'] = $oENDERECO->cep;
		$reg['numero'] = $oENDERECO->numero;
		$reg['complemento'] = $oENDERECO->complemento;
		$oCIDADE = $oENDERECO->oCIDADE;
		$reg['CIDADE_id'] = $oCIDADE->id;
		return $reg;		   
	}

	static function objToRsInsert($oENDERECO){
		$reg['rua'] = $oENDERECO->rua;
		$reg['bairro'] = $oENDERECO->bairro;
		$reg['cep'] = $oENDERECO->cep;
		$reg['numero'] = $oENDERECO->numero;
		$reg['complemento'] = $oENDERECO->complemento;
		$oCIDADE = $oENDERECO->oCIDADE;
		$reg['CIDADE_id'] = $oCIDADE->id;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oENDERECO = new ENDERECO();
		$oENDERECO->id = $reg['ENDERECO_id'];
		$oENDERECO->rua = $reg['ENDERECO_rua'];
		$oENDERECO->bairro = $reg['ENDERECO_bairro'];
		$oENDERECO->cep = $reg['ENDERECO_cep'];
		$oENDERECO->numero = $reg['ENDERECO_numero'];
		$oENDERECO->complemento = $reg['ENDERECO_complemento'];

		$oCIDADE = new CIDADE();
		$oCIDADE->id = $reg['CIDADE_id'];
		$oCIDADE->nome = $reg['CIDADE_nome'];
		$oENDERECO->oCIDADE = $oCIDADE;
		return $oENDERECO;		   
	}
}
