<?php
class BgdRequisicaoInfoParadaMAP {
	static function getMetaData() {
		return ['bgd_requisicao_info_parada' => ['id', 
						'commentsParada', 
						'data_captura', 
						'titleParada', 
						'fk_bgd_cidade', 
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

	static function objToRs($oBgdRequisicaoInfoParada){
		$reg['id'] = $oBgdRequisicaoInfoParada->id;
		$reg['commentsParada'] = $oBgdRequisicaoInfoParada->commentsParada;
		$reg['data_captura'] = $oBgdRequisicaoInfoParada->data_captura;
		$reg['titleParada'] = $oBgdRequisicaoInfoParada->titleParada;
		$oBgdCidade = $oBgdRequisicaoInfoParada->oBgdCidade;
		$reg['fk_bgd_cidade'] = $oBgdCidade->id;
		$oBgdCidade = $oBgdRequisicaoInfoParada->oBgdCidade;
		$reg['fk_bgd_cidade_prox_usuario'] = $oBgdCidade->id;
		$oBgdParada = $oBgdRequisicaoInfoParada->oBgdParada;
		$reg['fk_bgd_parada'] = $oBgdParada->id;
		$reg['lat_proxma_usuario'] = $oBgdRequisicaoInfoParada->lat_proxma_usuario;
		$reg['lng_proxma_usuario'] = $oBgdRequisicaoInfoParada->lng_proxma_usuario;
		$reg['fonte'] = $oBgdRequisicaoInfoParada->fonte;
		return $reg;		   
	}

	static function objToRsInsert($oBgdRequisicaoInfoParada){
		$reg['commentsParada'] = $oBgdRequisicaoInfoParada->commentsParada;
		$reg['data_captura'] = $oBgdRequisicaoInfoParada->data_captura;
		$reg['titleParada'] = $oBgdRequisicaoInfoParada->titleParada;
		$oBgdCidade = $oBgdRequisicaoInfoParada->oBgdCidade;
		$reg['fk_bgd_cidade'] = $oBgdCidade->id;
		$oBgdCidade = $oBgdRequisicaoInfoParada->oBgdCidade;
		$reg['fk_bgd_cidade_prox_usuario'] = $oBgdCidade->id;
		$oBgdParada = $oBgdRequisicaoInfoParada->oBgdParada;
		$reg['fk_bgd_parada'] = $oBgdParada->id;
		$reg['lat_proxma_usuario'] = $oBgdRequisicaoInfoParada->lat_proxma_usuario;
		$reg['lng_proxma_usuario'] = $oBgdRequisicaoInfoParada->lng_proxma_usuario;
		$reg['fonte'] = $oBgdRequisicaoInfoParada->fonte;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oBgdRequisicaoInfoParada = new BgdRequisicaoInfoParada();
		$oBgdRequisicaoInfoParada->id = $reg['bgd_requisicao_info_parada_id'];
		$oBgdRequisicaoInfoParada->commentsParada = $reg['bgd_requisicao_info_parada_commentsParada'];
		$oBgdRequisicaoInfoParada->data_captura = $reg['bgd_requisicao_info_parada_data_captura'];
		$oBgdRequisicaoInfoParada->titleParada = $reg['bgd_requisicao_info_parada_titleParada'];

		$oBgdCidade = new BgdCidade();
		$oBgdCidade->id = $reg['bgd_cidade_id'];
		$oBgdCidade->nome = $reg['bgd_cidade_nome'];
		$oBgdRequisicaoInfoParada->oBgdCidade = $oBgdCidade;

		$oBgdCidade = new BgdCidade();
		$oBgdCidade->id = $reg['bgd_cidade_id'];
		$oBgdCidade->nome = $reg['bgd_cidade_nome'];
		$oBgdRequisicaoInfoParada->oBgdCidade = $oBgdCidade;

		$oBgdParada = new BgdParada();
		$oBgdParada->id = $reg['bgd_parada_id'];
		$oBgdParada->comments = $reg['bgd_parada_comments'];
		$oBgdParada->latitude = $reg['bgd_parada_latitude'];
		$oBgdParada->longitude = $reg['bgd_parada_longitude'];
		$oBgdParada->title = $reg['bgd_parada_title'];
		$oBgdRequisicaoInfoParada->oBgdParada = $oBgdParada;
		$oBgdRequisicaoInfoParada->lat_proxma_usuario = $reg['bgd_requisicao_info_parada_lat_proxma_usuario'];
		$oBgdRequisicaoInfoParada->lng_proxma_usuario = $reg['bgd_requisicao_info_parada_lng_proxma_usuario'];
		$oBgdRequisicaoInfoParada->fonte = $reg['bgd_requisicao_info_parada_fonte'];
		return $oBgdRequisicaoInfoParada;		   
	}
}
