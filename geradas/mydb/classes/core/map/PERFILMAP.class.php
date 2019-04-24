<?php
class PERFILMAP {
	static function getMetaData() {
		return ['PERFIL' => ['id', 
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

	static function objToRs($oPERFIL){
		$reg['id'] = $oPERFIL->id;
		$reg['nome'] = $oPERFIL->nome;
		return $reg;		   
	}

	static function objToRsInsert($oPERFIL){
		$reg['nome'] = $oPERFIL->nome;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oPERFIL = new PERFIL();
		$oPERFIL->id = $reg['PERFIL_id'];
		$oPERFIL->nome = $reg['PERFIL_nome'];
		return $oPERFIL;		   
	}
}
