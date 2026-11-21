<?php
// Conexão com o banco de dados MySQL.
// As credenciais podem vir de variáveis de ambiente (recomendado em produção);
// os valores padrão servem para o ambiente local (XAMPP/WAMP).
$host  = getenv('DB_HOST') ?: "localhost";
$user  = getenv('DB_USER') ?: "root";
$senha = getenv('DB_PASS') ?: "";
$banco = getenv('DB_NAME') ?: "digas";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $conn = new mysqli($host, $user, $senha, $banco);
    $conn->set_charset("utf8mb4");
} catch (mysqli_sql_exception $erro) {
    // Registra o detalhe no log do servidor, sem expor ao usuário.
    error_log("Erro de conexão com o banco: " . $erro->getMessage());
    http_response_code(500);
    die("Erro ao conectar ao banco de dados.");
}
