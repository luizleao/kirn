<?php
class TELAMAP {
	static function getMetaData() {
		return ['TELA' => ['id', 
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

	static function objToRs($oTELA){
		$reg['id'] = $oTELA->id;
		$reg['nome'] = $oTELA->nome;
		return $reg;		   
	}

	static function objToRsInsert($oTELA){
		$reg['nome'] = $oTELA->nome;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oTELA = new TELA();
		$oTELA->id = $reg['TELA_id'];
		$oTELA->nome = $reg['TELA_nome'];
		return $oTELA;		   
	}
}
