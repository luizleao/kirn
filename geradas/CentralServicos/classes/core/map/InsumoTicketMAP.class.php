<?php
class InsumoTicketMAP {
	static function getMetaData() {
		return ['InsumoTicket' => ['idTicket', 
						'idInsumo', 
						'quantidade'], 
				'Ticket' => [						'idTicket', 
						'idServico', 
						'cd_servidor_solicitante', 
						'cd_servidor_recebimento', 
						'numero', 
						'descricao', 
						'dataHoraAbertura', 
						'flagAprovado', 
						'flagAtendido', 
						'flagExecutado', 
						'status'], 
				'Insumo' => [						'idInsumo', 
						'idNaturezaContratual', 
						'descricao', 
						'estoque', 
						'valor', 
						'status']];
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

	static function objToRs($oInsumoTicket){
		$oTicket = $oInsumoTicket->oTicket;
		$reg['idTicket'] = $oTicket->idTicket;
		$oInsumo = $oInsumoTicket->oInsumo;
		$reg['idInsumo'] = $oInsumo->idInsumo;
		$reg['quantidade'] = $oInsumoTicket->quantidade;
		return $reg;		   
	}

	static function objToRsInsert($oInsumoTicket){
		$reg['quantidade'] = $oInsumoTicket->quantidade;
		return $reg;		   
	}
	
	static function rsToObj($reg){
		foreach($reg as $campo=>$valor){
			$reg[$campo] = $valor;
		}
		$oInsumoTicket = new InsumoTicket();

		$oTicket = new Ticket();
		$oTicket->idTicket = $reg['Ticket_idTicket'];
		$oTicket->cd_servidor_solicitante = $reg['Ticket_cd_servidor_solicitante'];
		$oTicket->cd_servidor_recebimento = $reg['Ticket_cd_servidor_recebimento'];
		$oTicket->numero = $reg['Ticket_numero'];
		$oTicket->descricao = $reg['Ticket_descricao'];
		$oTicket->dataHoraAbertura = $reg['Ticket_dataHoraAbertura'];
		$oTicket->flagAprovado = $reg['Ticket_flagAprovado'];
		$oTicket->flagAtendido = $reg['Ticket_flagAtendido'];
		$oTicket->flagExecutado = $reg['Ticket_flagExecutado'];
		$oTicket->status = $reg['Ticket_status'];
		$oInsumoTicket->oTicket = $oTicket;

		$oInsumo = new Insumo();
		$oInsumo->idInsumo = $reg['Insumo_idInsumo'];
		$oInsumo->descricao = $reg['Insumo_descricao'];
		$oInsumo->estoque = $reg['Insumo_estoque'];
		$oInsumo->valor = $reg['Insumo_valor'];
		$oInsumo->status = $reg['Insumo_status'];
		$oInsumoTicket->oInsumo = $oInsumo;
		$oInsumoTicket->quantidade = $reg['InsumoTicket_quantidade'];
		return $oInsumoTicket;		   
	}
}
