<?php
class DadosFormulario {

	static function formBat($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id_bat"] = strip_tags(addslashes(trim($post["id_bat"])));
		}
		$post["locasens"] = strip_tags(addslashes(trim($post["locasens"])));
		$post["pessoa"] = strip_tags(addslashes(trim($post["pessoa"])));
		$post["descricao"] = strip_tags(addslashes(trim($post["descricao"])));
		$post["data"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["data"]))));
		$post["raiva"] = strip_tags(addslashes(trim($post["raiva"])));
	
		return $post;		
	}

	static function formContato($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id_tel"] = strip_tags(addslashes(trim($post["id_tel"])));
		}
		$post["numero"] = strip_tags(addslashes(trim($post["numero"])));
		$post["ddd"] = strip_tags(addslashes(trim($post["ddd"])));
		$post["email"] = strip_tags(addslashes(trim($post["email"])));
	
		return $post;		
	}

	static function formPlantao($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["p_id"] = strip_tags(addslashes(trim($post["p_id"])));
		}
		$post["p_usuario_id"] = strip_tags(addslashes(trim($post["p_usuario_id"])));
		$post["p_id_sensor"] = strip_tags(addslashes(trim($post["p_id_sensor"])));
		$post["datai"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["datai"]))));
		$post["dataf"] = Util::formataDataHoraFormBanco(strip_tags(addslashes(trim($post["dataf"]))));
	
		return $post;		
	}

	static function formSensor($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id_sensor"] = strip_tags(addslashes(trim($post["id_sensor"])));
		}
		$post["localizacao"] = strip_tags(addslashes(trim($post["localizacao"])));
		$post["descricao"] = strip_tags(addslashes(trim($post["descricao"])));
	
		return $post;		
	}

	static function formUsuario($post=NULL, $acao=''){
		if($post == NULL)
			$post = $_REQUEST;

		if($acao == 2){
			$post["id"] = strip_tags(addslashes(trim($post["id"])));
		}
		$post["nome"] = strip_tags(addslashes(trim($post["nome"])));
		$post["status"] = strip_tags(addslashes(trim($post["status"])));
		$post["id_contato"] = strip_tags(addslashes(trim($post["id_contato"])));
	
		return $post;		
	}

}
