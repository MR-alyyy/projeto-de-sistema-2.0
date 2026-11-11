<?php
use PHPMailer\PHPMailer\PHPMailer;

header('Content-Type: application/json; charset=utf-8');

function responder($status, $dados) {
    http_response_code($status);
    echo json_encode($dados, JSON_UNESCAPED_UNICODE);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    responder(405, ['error' => 'Método não permitido.']);
}

if (!preg_match('/^application\/json(?:\s*;|$)/i', $_SERVER['CONTENT_TYPE'] ?? '')) {
    responder(415, ['error' => 'Tipo de conteúdo inválido.']);
}

$dados = json_decode(file_get_contents('php://input'));
if (!($dados instanceof stdClass) || count((array) $dados) !== 0) {
    responder(400, ['error' => 'Requisição inválida.']);
}

session_start();
if (($_SESSION['tipo'] ?? '') !== 'bibliotecario') {
    responder(401, ['error' => 'Faça login como bibliotecário para enviar o e-mail.']);
}
session_write_close();

$usuario = getenv('SMTP_USERNAME');
$senha = getenv('SMTP_PASSWORD');
if (!$usuario || !$senha || !filter_var($usuario, FILTER_VALIDATE_EMAIL)) {
    responder(500, ['error' => 'Configure SMTP_USERNAME e SMTP_PASSWORD no ambiente do servidor.']);
}

$autoload = __DIR__ . '/vendor/autoload.php';
if (!is_file($autoload)) {
    responder(500, ['error' => 'Dependências de e-mail ausentes. Execute composer install.']);
}
require $autoload;

try {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $usuario;
    $mail->Password = preg_replace('/\s+/', '', $senha);
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';
    $mail->setFrom($usuario, 'Painel do Bibliotecário');
    $mail->addAddress('aly.matheus2342@gmail.com');
    $mail->Subject = 'Mensagem de teste - Sistema da Biblioteca';
    $mail->Body = 'Esta mensagem foi enviada pelo painel do bibliotecário.';
    $mail->send();

    responder(200, ['message' => 'E-mail enviado com sucesso.']);
} catch (Throwable $erro) {
    error_log('Falha no envio de e-mail SMTP: ' . $erro->getMessage());
    responder(500, ['error' => 'Não foi possível enviar o e-mail. Verifique a configuração SMTP do servidor.']);
}
