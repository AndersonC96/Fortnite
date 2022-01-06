<?php
	include 'config.php';
	function getPlayerStats( $platform, $epicNickname ){
		$apiUrlPlayerStatsEndpoint = 'https://api.fortnitetracker.com/v1/profile/' . $platform . '/' . $epicNickname;
		$ch = curl_init();// Inicializar cURL
		curl_setopt( $ch, CURLOPT_URL, $apiUrlPlayerStatsEndpoint );// Establecer URL
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array(// Establecer cabeçalhos
			'TRN-Api-Key:' . FN_API_KEY// Adicionar a chave da API
		) );
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, TRUE );// Retornar o resultado
		curl_setopt( $ch, CURLOPT_HEADER, FALSE );// Não exibir o cabeçalho
		curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );// Não verificar o certificado SSL
		$response = curl_exec( $ch );// Executar a requisição
		curl_close( $ch );// Fechar a conexão
		return json_decode( $response, true );// Retornar o resultado
	}