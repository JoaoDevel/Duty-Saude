<?php
header('Content-Type: application/json');

$response = [];
$httpCode = 500; // Código de erro inicial

try {
    // Verifica se a requisição é POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $httpCode = 405;
        throw new Exception("Método de requisição não permitido");
    }

    // Recebe os dados do POST
    $data = json_decode(file_get_contents('php://input'), true);

    // Verifica se a decodificação JSON foi bem-sucedida
    if (json_last_error() !== JSON_ERROR_NONE) {
        $httpCode = 400;
        throw new Exception("Dados JSON inválidos");
    }

    // Imprime os dados recebidos para depuração 
    error_log(print_r($data, true));

    // Validação dos campos obrigatórios
    if (empty($data['cpf']) || empty($data['nome']) || empty($data['email']) || empty($data['endereco'])) {
        $httpCode = 400;
        throw new Exception("Campos obrigatórios não preenchidos.");
    }

    // Verifica se o campo 'endereco' está presente e se tem todos os sub-campos
    $endereco = $data['endereco'];
    if (
        empty($endereco['rua']) || empty($endereco['numero']) || empty($endereco['bairro']) ||
        empty($endereco['cidade']) || empty($endereco['uf']) || empty($endereco['cep'])
    ) {
        $httpCode = 400;
        throw new Exception("Campos obrigatórios do endereço não preenchidos.");
    }

    // chave de API
    $apiKey = '!EYsCiszmzwaDKr2@bGTA^s$M3kJP^anK7Vzq@Tnbj^pLBFB&H';

    // Configura cURL para enviar os dados para o endpoint
    $ch = curl_init('https://api.dutysaude.com.br/cliente/create');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json',
        'API-KEY: ' . $apiKey,
    ]);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // requisição e captura a resposta
    $result = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $curlError = curl_error($ch);
    curl_close($ch);

    // Verifica se houve erro de cURL
    if ($curlError) {
        throw new Exception("Erro cURL: " . $curlError);
    }

    // Verifica a resposta HTTP
    if ($httpCode === 200) {
        $response = ['message' => 'Cliente cadastrado e enviado com sucesso!'];
    } else {
        $response = ['error' => 'Falha ao enviar os dados para o endpoint. Código HTTP: ' . $httpCode . ' Resposta: ' . $result];
    }
} catch (Exception $e) {
    $response = ['error' => $e->getMessage()];
}

// Define o código de resposta HTTP e retorna a resposta JSON
http_response_code($httpCode);
echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
exit();
