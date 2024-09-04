<?php

header('Content-Type: application/json');



$response = array();
$httpCode = 500; // Código padrão de erro inicial

try {
    require_once '../../class/ApiInterna.php';
    require_once '../../class/Session.php';

    // Verifica se a requisição é POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $httpCode = 405; // Método não permitido
        throw new Exception("Método de requisição não permitido");
    }

    // Obtém os dados do POST
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Valida os dados recebidos
    if (!isset($data['email']) || empty($data['email'])) {
        $httpCode = 400; // Bad Request
        throw new Exception("O campo 'email' é obrigatório");
    }

    if (!isset($data['pass']) || empty($data['pass'])) {
        $httpCode = 400; // Bad Request
        throw new Exception("O campo 'pass' é obrigatório");
    }

    $apiKey = new ApiInterna();

    // Define a URL e os cabeçalhos da requisição cURL
    $url = $apiKey->getEndPoint('login/validate');

    $ch = curl_init($url);

    // Prepara os dados para a requisição cURL
    $payload = json_encode(array(
        'email' => $data['email'],
        'pass' => $data['pass']
    ));

    // Configurações do cURL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'API-KEY: ' . $apiKey->getKey(),
        'Content-Type: application/json'
    ));

    // Executa a requisição cURL e obtém a resposta
    $apiResponse = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if ($apiResponse === false) {
        $error = curl_error($ch);
        curl_close($ch);
        $httpCode = 500; // Internal Server Error
        throw new Exception("Erro no cURL: " . $error);
    }

    curl_close($ch);

    // Retorna a resposta da API para o cliente
    $response = json_decode($apiResponse, true);

    // Se a resposta decodificada for nula e houver erro de JSON, ajuste o código HTTP
    if ($response === null && json_last_error() !== JSON_ERROR_NONE) {
        $httpCode = 500; // Internal Server Error
        throw new Exception("Erro ao decodificar a resposta JSON: " . json_last_error_msg());
    }

    $session = new Session();
    if (!$session->create($httpCode, $response)) {
        $httpCode = 500;
        throw new Exception("Erro ao instanciar a sessão");
    }
} catch (Exception $e) {
    $response = array('error' => $e->getMessage());
}

// Define o código de resposta HTTP e retorna a resposta JSON
http_response_code($httpCode);
echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
exit();
