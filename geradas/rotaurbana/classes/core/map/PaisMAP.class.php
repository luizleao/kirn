<?php
class PaisMAP {
	static function getMetaData() {
		return ['pais' => ['id', 
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

	static function objToRs($oPais){
		$reg['id'] = $oPais->id;
		$reg['nome'] = $oPais->nome;
		$reg['sigla'] = $oPais->sigla;
		return $reg;		   
	}

	static function objToRsInsert($oPais){
		$reg['nome'] = $oPais->nome;
		$reg['sigla'] = $oPais->sigla;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oPais = new Pais();
		$oPais->id = $reg['pais_id'];
		$oPais->nome = $reg['pais_nome'];
		$oPais->sigla = $reg['pais_sigla'];
		return $oPais;		   
	}
}
