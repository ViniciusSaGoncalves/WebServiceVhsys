<?php
	/*!
	 * NFe VHSYS
	 *
	 * Copyright 2013, (http://www.vhsys.com.br)
	 * API DE COMUNICA��O WEBSERVICE
	 * Vers�o da API: v1.0
	 *
	 * TOKEN (NUMERO GERADO PELO NFE VHSYS) 
	 */
	 
	//FAZ A COMUNICA��O COM O NFE VHSYS
	include("VHSYSAPI.Class.php");
	$vhsys = new CommunicationVHSYS();
	$vhsys->params 	= array(
		//CABE�ARIO
		"API" => "Categorias",
		"TOKEN" => "SEU_TOKEN",
		"METODO" => "CADASTRAR",
		
		//CAMPOS
		"nome_categoria" => "teste de integra��oxxxx",
		"status_categoria" => "Ativo",
		"id_categoria" => "" //UTILIZADO APENAS PARA ALTERAR E EXCLUIR
		);
	$response = $vhsys->transmit();
	
	//TRATA O response DO NFE VHSYS
	if ($response) {
		if (@$xml = simplexml_load_string($response)) {
			//CRIA AS VARIAVEIS
			$error = $xml->error;
			$reason = $xml->xReason; //MENSAGEM DE MOTIVO
			$status = $xml->status; //STATUS DO response
			$id_categoria = $xml->id_categoria; //ID DA CATEGORIA
					
			if ($error == 1) {
				//SE HOUVER ALGUM error
				echo "error: ".$reason."<br>";
			} else {
				echo $reason;
				print_r($xml);
			}
		} else {
			echo "Houve uma falha na leitura da resposta!<br>".$response;	
		}
	} else {
		echo "Houve uma falha na comunica��o!";	
	}