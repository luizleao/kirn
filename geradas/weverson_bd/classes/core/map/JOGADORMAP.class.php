<?php
class JOGADORMAP {
	static function getMetaData() {
		return ['JOGADOR' => ['cpf', 
						'nome', 
						'n_camisa', 
						'status', 
						'TIME_id'], 
				'TIME' => [						'id', 
						'pais', 
						'tecnico']];
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

	static function objToRs($oJOGADOR){
		$reg['cpf'] = $oJOGADOR->cpf;
		$reg['nome'] = $oJOGADOR->nome;
		$reg['n_camisa'] = $oJOGADOR->n_camisa;
		$reg['status'] = $oJOGADOR->status;
		$oTIME = $oJOGADOR->oTIME;
		$reg['TIME_id'] = $oTIME->id;
		return $reg;		   
	}

	static function objToRsInsert($oJOGADOR){
		$reg['nome'] = $oJOGADOR->nome;
		$reg['n_camisa'] = $oJOGADOR->n_camisa;
		$reg['status'] = $oJOGADOR->status;
		$oTIME = $oJOGADOR->oTIME;
		$reg['TIME_id'] = $oTIME->id;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oJOGADOR = new JOGADOR();
		$oJOGADOR->cpf = $reg['JOGADOR_cpf'];
		$oJOGADOR->nome = $reg['JOGADOR_nome'];
		$oJOGADOR->n_camisa = $reg['JOGADOR_n_camisa'];
		$oJOGADOR->status = $reg['JOGADOR_status'];

		$oTIME = new TIME();
		$oTIME->id = $reg['TIME_id'];
		$oTIME->pais = $reg['TIME_pais'];
		$oTIME->tecnico = $reg['TIME_tecnico'];
		$oJOGADOR->oTIME = $oTIME;
		return $oJOGADOR;		   
	}
}
