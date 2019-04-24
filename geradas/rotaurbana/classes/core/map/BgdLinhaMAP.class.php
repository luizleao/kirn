<?php
class BgdLinhaMAP {
	static function getMetaData() {
		return ['bgd_linha' => ['id', 
						'codigo', 
						'comentario', 
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

	static function objToRs($oBgdLinha){
		$reg['id'] = $oBgdLinha->id;
		$reg['codigo'] = $oBgdLinha->codigo;
		$reg['comentario'] = $oBgdLinha->comentario;
		$reg['nome'] = $oBgdLinha->nome;
		return $reg;		   
	}

	static function objToRsInsert($oBgdLinha){
		$reg['codigo'] = $oBgdLinha->codigo;
		$reg['comentario'] = $oBgdLinha->comentario;
		$reg['nome'] = $oBgdLinha->nome;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oBgdLinha = new BgdLinha();
		$oBgdLinha->id = $reg['bgd_linha_id'];
		$oBgdLinha->codigo = $reg['bgd_linha_codigo'];
		$oBgdLinha->comentario = $reg['bgd_linha_comentario'];
		$oBgdLinha->nome = $reg['bgd_linha_nome'];
		return $oBgdLinha;		   
	}
}
