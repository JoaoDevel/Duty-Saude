<?php
header('Content-Type: application/json');

$response = [];
$httpCode = 500; // Código de erro inicial

try {
    // Verifica se a requisição é POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $httpCode = 405; // Método não permitido
        throw new Exception("Método de requisição não permitido");
    }

    // Recebe os dados do POST
    $data = json_decode(file_get_contents('php://input'), true);

    if (json_last_error() !== JSON_ERROR_NONE) {
        $httpCode = 400; // JSON inválido
        throw new Exception("JSON inválido.");
    }

    // Validação dos campos obrigatórios
    $requiredFields = ['cnpj', 'razao_social', 'nome_fantasia', 'natureza_juridica', 'inscricao_estadual', 'inscricao_municipal', 'data_fundacao', 'email', 'telefone', 'responsavel_cpf', 'responsavel_nome', 'cep', 'rua', 'numero', 'bairro', 'cidade', 'estado'];
    foreach ($requiredFields as $field) {
        if (empty($data[$field])) {
            $httpCode = 400; // Campos obrigatórios não preenchidos
            throw new Exception("Campo $field não preenchido.");
        }
    }

    // Se chegou até aqui, tudo está correto
    $httpCode = 200; // Sucesso
    $response = ['message' => 'Empresa cadastrada com sucesso!'];
} catch (Exception $e) {
    $response = ['error' => $e->getMessage()];
}

// Define o código de resposta HTTP e retorna a resposta JSON
http_response_code($httpCode);
echo json_encode($response, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
exit();
