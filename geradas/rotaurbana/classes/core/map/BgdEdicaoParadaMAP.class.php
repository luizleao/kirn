<?php
class BgdEdicaoParadaMAP {
	static function getMetaData() {
		return ['bgd_edicao_parada' => ['id', 
						'commentsParada', 
						'data_captura', 
						'titleParada', 
						'bgd_cidade', 
						'fk_bgd_cidade_prox_usuario', 
						'fk_bgd_parada', 
						'lat_proxma_usuario', 
						'lng_proxma_usuario', 
						'fonte'], 
				'bgd_cidade' => [						'id', 
						'nome'], 
				'bgd_parada' => [						'id', 
						'comments', 
						'latitude', 
						'longitude', 
						'title']];
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

	static function objToRs($oBgdEdicaoParada){
		$reg['id'] = $oBgdEdicaoParada->id;
		$reg['commentsParada'] = $oBgdEdicaoParada->commentsParada;
		$reg['data_captura'] = $oBgdEdicaoParada->data_captura;
		$reg['titleParada'] = $oBgdEdicaoParada->titleParada;
		$oBgdCidade = $oBgdEdicaoParada->oBgdCidade;
		$reg['bgd_cidade'] = $oBgdCidade->id;
		$oBgdCidade = $oBgdEdicaoParada->oBgdCidade;
		$reg['fk_bgd_cidade_prox_usuario'] = $oBgdCidade->id;
		$oBgdParada = $oBgdEdicaoParada->oBgdParada;
		$reg['fk_bgd_parada'] = $oBgdParada->id;
		$reg['lat_proxma_usuario'] = $oBgdEdicaoParada->lat_proxma_usuario;
		$reg['lng_proxma_usuario'] = $oBgdEdicaoParada->lng_proxma_usuario;
		$reg['fonte'] = $oBgdEdicaoParada->fonte;
		return $reg;		   
	}

	static function objToRsInsert($oBgdEdicaoParada){
		$reg['commentsParada'] = $oBgdEdicaoParada->commentsParada;
		$reg['data_captura'] = $oBgdEdicaoParada->data_captura;
		$reg['titleParada'] = $oBgdEdicaoParada->titleParada;
		$oBgdCidade = $oBgdEdicaoParada->oBgdCidade;
		$reg['bgd_cidade'] = $oBgdCidade->id;
		$oBgdCidade = $oBgdEdicaoParada->oBgdCidade;
		$reg['fk_bgd_cidade_prox_usuario'] = $oBgdCidade->id;
		$oBgdParada = $oBgdEdicaoParada->oBgdParada;
		$reg['fk_bgd_parada'] = $oBgdParada->id;
		$reg['lat_proxma_usuario'] = $oBgdEdicaoParada->lat_proxma_usuario;
		$reg['lng_proxma_usuario'] = $oBgdEdicaoParada->lng_proxma_usuario;
		$reg['fonte'] = $oBgdEdicaoParada->fonte;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oBgdEdicaoParada = new BgdEdicaoParada();
		$oBgdEdicaoParada->id = $reg['bgd_edicao_parada_id'];
		$oBgdEdicaoParada->commentsParada = $reg['bgd_edicao_parada_commentsParada'];
		$oBgdEdicaoParada->data_captura = $reg['bgd_edicao_parada_data_captura'];
		$oBgdEdicaoParada->titleParada = $reg['bgd_edicao_parada_titleParada'];

		$oBgdCidade = new BgdCidade();
		$oBgdCidade->id = $reg['bgd_cidade_id'];
		$oBgdCidade->nome = $reg['bgd_cidade_nome'];
		$oBgdEdicaoParada->oBgdCidade = $oBgdCidade;

		$oBgdCidade = new BgdCidade();
		$oBgdCidade->id = $reg['bgd_cidade_id'];
		$oBgdCidade->nome = $reg['bgd_cidade_nome'];
		$oBgdEdicaoParada->oBgdCidade = $oBgdCidade;

		$oBgdParada = new BgdParada();
		$oBgdParada->id = $reg['bgd_parada_id'];
		$oBgdParada->comments = $reg['bgd_parada_comments'];
		$oBgdParada->latitude = $reg['bgd_parada_latitude'];
		$oBgdParada->longitude = $reg['bgd_parada_longitude'];
		$oBgdParada->title = $reg['bgd_parada_title'];
		$oBgdEdicaoParada->oBgdParada = $oBgdParada;
		$oBgdEdicaoParada->lat_proxma_usuario = $reg['bgd_edicao_parada_lat_proxma_usuario'];
		$oBgdEdicaoParada->lng_proxma_usuario = $reg['bgd_edicao_parada_lng_proxma_usuario'];
		$oBgdEdicaoParada->fonte = $reg['bgd_edicao_parada_fonte'];
		return $oBgdEdicaoParada;		   
	}
}
