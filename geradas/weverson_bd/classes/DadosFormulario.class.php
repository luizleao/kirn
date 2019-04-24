<?php
class DadosFormulario {

	static function formARBITROAUX($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["id"] = strip_tags(addslashes(trim($post["id"])));
		$post["PARTIDA_id"] = strip_tags(addslashes(trim($post["PARTIDA_id"])));
	
		return $post;		
	}

	static function formCAMPEONATO($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["id"] = strip_tags(addslashes(trim($post["id"])));
	
		return $post;		
	}

	static function formCAMPEONATOHasTIME($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["CAMPEONATO_id"] = strip_tags(addslashes(trim($post["CAMPEONATO_id"])));
		$post["TIME_id"] = strip_tags(addslashes(trim($post["TIME_id"])));
	
		return $post;		
	}

	static function formEVENTO SUSPEITO($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		
	
		return $post;		
	}

	static function formEVENTOS INTERNOS($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		
	
		return $post;		
	}

	static function formJOGADOR($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["cpf"] = strip_tags(addslashes(trim($post["cpf"])));
		$post["nome"] = strip_tags(addslashes(trim($post["nome"])));
		$post["n_camisa"] = strip_tags(addslashes(trim($post["n_camisa"])));
		$post["status"] = strip_tags(addslashes(trim($post["status"])));
		$post["TIME_id"] = strip_tags(addslashes(trim($post["TIME_id"])));
	
		return $post;		
	}

	static function formPARTIDA($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		if($acao == 2){
			$post["idmadante"] = strip_tags(addslashes(trim($post["idmadante"])));
		}
		if($acao == 2){
			$post["idvisitante"] = strip_tags(addslashes(trim($post["idvisitante"])));
		}
	
		return $post;		
	}

	static function formTIME($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["pais"] = strip_tags(addslashes(trim($post["pais"])));
		$post["tecnico"] = strip_tags(addslashes(trim($post["tecnico"])));
	
		return $post;		
	}

	static function formUNIFORME($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["idUNIFORME"] = strip_tags(addslashes(trim($post["idUNIFORME"])));
		$post["camisa"] = strip_tags(addslashes(trim($post["camisa"])));
		$post["shot"] = strip_tags(addslashes(trim($post["shot"])));
		$post["meia"] = strip_tags(addslashes(trim($post["meia"])));
		$post["UNIFORMEcol"] = strip_tags(addslashes(trim($post["UNIFORMEcol"])));
		$post["TIME_id"] = strip_tags(addslashes(trim($post["TIME_id"])));
	
		return $post;		
	}

	static function formVAR($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		$post["id"] = strip_tags(addslashes(trim($post["id"])));
		$post["PARTIDA_id"] = strip_tags(addslashes(trim($post["PARTIDA_id"])));
	
		return $post;		
	}

}
