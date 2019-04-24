<?php
class BgdItinerario {
	
	public $oBgdItinerarioOficialDeRota;
	public $fk_bgd_ponto_tracado_trajeto_id;
	
	function __construct(BgdItinerarioOficialDeRota $oBgdItinerarioOficialDeRota = NULL, $fk_bgd_ponto_tracado_trajeto_id = NULL){
		$this->oBgdItinerarioOficialDeRota = ($oBgdItinerarioOficialDeRota == NULL) ? new BgdItinerarioOficialDeRota() : $oBgdItinerarioOficialDeRota;
		$this->fk_bgd_ponto_tracado_trajeto_id = $fk_bgd_ponto_tracado_trajeto_id;
	}

	function __toString(){
		return $this->fk_bgd_ponto_tracado_trajeto_id;
	}
}