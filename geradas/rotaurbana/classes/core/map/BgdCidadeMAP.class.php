<?php
class BgdCidadeMAP {
	static function getMetaData() {
		return ['bgd_cidade' => ['id', 
						'nome']];
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

	static function objToRs($oBgdCidade){
		$reg['id'] = $oBgdCidade->id;
		$reg['nome'] = $oBgdCidade->nome;
		return $reg;		   
	}

	static function objToRsInsert($oBgdCidade){
		$reg['nome'] = $oBgdCidade->nome;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oBgdCidade = new BgdCidade();
		$oBgdCidade->id = $reg['bgd_cidade_id'];
		$oBgdCidade->nome = $reg['bgd_cidade_nome'];
		return $oBgdCidade;		   
	}
}
