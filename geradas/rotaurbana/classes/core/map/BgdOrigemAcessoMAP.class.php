<?php
class BgdOrigemAcessoMAP {
	static function getMetaData() {
		return ['bgd_origem_acesso' => ['id', 
						'data_captura', 
						'lat_proxma_usuario', 
						'lng_proxma_usuario', 
						'origem_acesso', 
						'fk_bgd_cidade_prox_usuario', 
						'fonte'], 
				'bgd_cidade' => [						'id', 
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

	static function objToRs($oBgdOrigemAcesso){
		$reg['id'] = $oBgdOrigemAcesso->id;
		$reg['data_captura'] = $oBgdOrigemAcesso->data_captura;
		$reg['lat_proxma_usuario'] = $oBgdOrigemAcesso->lat_proxma_usuario;
		$reg['lng_proxma_usuario'] = $oBgdOrigemAcesso->lng_proxma_usuario;
		$reg['origem_acesso'] = $oBgdOrigemAcesso->origem_acesso;
		$oBgdCidade = $oBgdOrigemAcesso->oBgdCidade;
		$reg['fk_bgd_cidade_prox_usuario'] = $oBgdCidade->id;
		$reg['fonte'] = $oBgdOrigemAcesso->fonte;
		return $reg;		   
	}

	static function objToRsInsert($oBgdOrigemAcesso){
		$reg['data_captura'] = $oBgdOrigemAcesso->data_captura;
		$reg['lat_proxma_usuario'] = $oBgdOrigemAcesso->lat_proxma_usuario;
		$reg['lng_proxma_usuario'] = $oBgdOrigemAcesso->lng_proxma_usuario;
		$reg['origem_acesso'] = $oBgdOrigemAcesso->origem_acesso;
		$oBgdCidade = $oBgdOrigemAcesso->oBgdCidade;
		$reg['fk_bgd_cidade_prox_usuario'] = $oBgdCidade->id;
		$reg['fonte'] = $oBgdOrigemAcesso->fonte;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oBgdOrigemAcesso = new BgdOrigemAcesso();
		$oBgdOrigemAcesso->id = $reg['bgd_origem_acesso_id'];
		$oBgdOrigemAcesso->data_captura = $reg['bgd_origem_acesso_data_captura'];
		$oBgdOrigemAcesso->lat_proxma_usuario = $reg['bgd_origem_acesso_lat_proxma_usuario'];
		$oBgdOrigemAcesso->lng_proxma_usuario = $reg['bgd_origem_acesso_lng_proxma_usuario'];
		$oBgdOrigemAcesso->origem_acesso = $reg['bgd_origem_acesso_origem_acesso'];

		$oBgdCidade = new BgdCidade();
		$oBgdCidade->id = $reg['bgd_cidade_id'];
		$oBgdCidade->nome = $reg['bgd_cidade_nome'];
		$oBgdOrigemAcesso->oBgdCidade = $oBgdCidade;
		$oBgdOrigemAcesso->fonte = $reg['bgd_origem_acesso_fonte'];
		return $oBgdOrigemAcesso;		   
	}
}
