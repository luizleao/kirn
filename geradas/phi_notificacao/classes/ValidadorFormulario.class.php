<?php
class ValidadorFormulario {
	
	public $msg;
	
	function __construct($msg = NULL){
		$this->msg = $msg;
	}

	function validaFormBat(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($id_bat == ''){
				$this->msg = "Id_bat inválido!";
				return false;
			}
		}
		if($locasens == ''){
			$this->msg = "Sensor inválido!";
			return false;
		}	
		if($pessoa == ''){
			$this->msg = "Usuario inválido!";
			return false;
		}	
		if($descricao == ''){
			$this->msg = "Descricao inválido!";
			return false;
		}	
		if($data == ''){
			$this->msg = "Data inválido!";
			return false;
		}	
		if($raiva == ''){
			$this->msg = "Raiva inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormContato(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($id_tel == ''){
				$this->msg = "Id_tel inválido!";
				return false;
			}
		}
		if($numero == ''){
			$this->msg = "Numero inválido!";
			return false;
		}	
		if($ddd == ''){
			$this->msg = "Ddd inválido!";
			return false;
		}	
		if($email == ''){
			$this->msg = "Email inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormPlantao(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($p_id == ''){
				$this->msg = "P_id inválido!";
				return false;
			}
		}
		if($p_usuario_id == ''){
			$this->msg = "Usuario inválido!";
			return false;
		}	
		if($p_id_sensor == ''){
			$this->msg = "Sensor inválido!";
			return false;
		}	
		if($datai == ''){
			$this->msg = "Datai inválido!";
			return false;
		}	
		if($dataf == ''){
			$this->msg = "Dataf inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormSensor(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($id_sensor == ''){
				$this->msg = "Id_sensor inválido!";
				return false;
			}
		}
		if($localizacao == ''){
			$this->msg = "Localizacao inválido!";
			return false;
		}	
		if($descricao == ''){
			$this->msg = "Descricao inválido!";
			return false;
		}	
		*/
		return true;		
	}

	function validaFormUsuario(&$post, $acao=''){
		// cria variaveis para validacao com as chaves do array
		foreach($post as $i => $v) 
			$$i = $v;
		// valida formulario - Inicia comentado para facilitar depuracao
		/*
		if($acao == 2){
			if($id == ''){
				$this->msg = "Id inválido!";
				return false;
			}
		}
		if($nome == ''){
			$this->msg = "Nome inválido!";
			return false;
		}	
		if($status == ''){
			$this->msg = "Status inválido!";
			return false;
		}	
		if($id_contato == ''){
			$this->msg = "Contato inválido!";
			return false;
		}	
		*/
		return true;		
	}

}