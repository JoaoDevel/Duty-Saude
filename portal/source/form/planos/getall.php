<?php

// Controle de acesso
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: *");
header("Access-Control-Allow-Headers: *");
header('Content-Type: application/json');

// Cache
header("Cache-Control: no-cache, must-revalidate");

// Aumentar tempo de processamento do arquivo
ini_set('max_execution_time', 8 * 60 * 60);

// Destino
header('X-Powered-By: DutyMobile');

// Limpar cabeçalhos desnecessários
header('Content-Encoding: ');
header('Content-Length: ');
header('Date: ');
header('Platform: ');
header('Server: ');
header('Vary: ');

// Remover cabeçalhos desnecessários
header_remove('Content-Encoding');
header_remove('Content-Length');
header_remove('Date');
header_remove('Platform');
header_remove('Server');
header_remove('Vary');

// Tratativas de Erro
set_error_handler("manipuladorDeErros");

function manipuladorDeErros($codigo, $mensagem, $arquivo, $linha) {
    throw new ErrorException($mensagem, 0, $codigo, $arquivo, $linha);
}

$retorno = [];
$httpcode = 500;

// Tratamento para solicitações OPTIONS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Defina os cabeçalhos CORS apropriados
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: POST, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, API-KEY");

    // Retorne um código de status HTTP OK (200)
    http_response_code(200);
    exit;
}

try {

    require_once "../../class/ApiInterna.php";

    $apiKey = new ApiInterna();

    // Configuração da requisição cURL
    $headers = array();
    $headers[] = 'Accept: application/json';
    $headers[] = 'API-KEY: ' . $apiKey->getKey();
    $headers[] = 'Content-Type: application/json';

    // Inicia uma nova requisição cURL
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $apiKey->getEndPoint('plano/listall'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    // Executa a requisição cURL
    $result = curl_exec($ch);
    if (curl_errno($ch)) {
        throw new Exception("cURL Error #:" . curl_error($ch));
    }
    curl_close($ch);

    // Decodifica o JSON de retorno
    $jsonreturn = json_decode($result);

    if ($jsonreturn === null && json_last_error() !== JSON_ERROR_NONE) {
        throw new Exception("Erro ao decodificar o JSON: " . json_last_error_msg());
    }

    // Obtém o código de status HTTP da requisição cURL
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $retorno = $jsonreturn;
} catch (Exception $exc) {
    $retorno["error_message"] = $exc->getMessage();
}

// Limpar o Buffer
ob_clean();

// Define o código de status HTTP e retorna a resposta
http_response_code($httpcode);
$json = json_encode($retorno, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
echo $json;
exit();
