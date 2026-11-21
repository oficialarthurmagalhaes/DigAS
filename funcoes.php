<?php
// Funções de apoio usadas em todo o sistema: sessão, autenticação,
// proteção contra CSRF, escape de HTML e validação de uploads.

if (session_status() === PHP_SESSION_NONE) {
    // Cookie de sessão protegido: inacessível via JavaScript e não enviado
    // em requisições vindas de outros sites (ajuda contra CSRF).
    session_set_cookie_params([
        'httponly' => true,
        'samesite' => 'Lax',
        'secure'   => !empty($_SERVER['HTTPS']),
    ]);
    session_start();
}

// Escapa um texto antes de exibi-lo na página (evita XSS).
function e($texto): string
{
    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

function usuario_logado(): bool
{
    return isset($_SESSION['email']);
}

function eh_admin(): bool
{
    return !empty($_SESSION['is_admin']);
}

// Redireciona para o login se não houver usuário na sessão.
function exigir_login(): void
{
    if (!usuario_logado()) {
        header("Location: login.html");
        exit();
    }
}

function exigir_admin(): void
{
    exigir_login();
    if (!eh_admin()) {
        http_response_code(403);
        die("<div style='color:red; font-weight:bold; margin:40px;'>Acesso negado.</div>");
    }
}

// Aceita apenas requisições POST (ações que alteram dados).
function exigir_post(): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        die("Método não permitido.");
    }
}

// ---------- CSRF ----------

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

// Campo oculto para colocar dentro dos formulários.
function csrf_campo(): string
{
    return "<input type='hidden' name='csrf_token' value='" . e(csrf_token()) . "'>";
}

function validar_csrf(): void
{
    $enviado = $_POST['csrf_token'] ?? '';
    if (!is_string($enviado) || !hash_equals(csrf_token(), $enviado)) {
        http_response_code(403);
        die("Requisição inválida. Recarregue a página e tente novamente.");
    }
}

// ---------- Uploads ----------

const TAMANHO_MAXIMO_UPLOAD = 20 * 1024 * 1024; // 20 MB

const TIPOS_MIDIA = [
    'jpg'  => ['image/jpeg'],
    'jpeg' => ['image/jpeg'],
    'png'  => ['image/png'],
    'gif'  => ['image/gif'],
    'webp' => ['image/webp'],
    'mp4'  => ['video/mp4'],
    'mov'  => ['video/quicktime'],
    'webm' => ['video/webm'],
];

const TIPOS_ARQUIVO = [
    'pdf'  => ['application/pdf'],
    'txt'  => ['text/plain'],
    'doc'  => ['application/msword', 'application/vnd.ms-office', 'application/octet-stream'],
    'xls'  => ['application/vnd.ms-excel', 'application/vnd.ms-office', 'application/octet-stream'],
    'ppt'  => ['application/vnd.ms-powerpoint', 'application/vnd.ms-office', 'application/octet-stream'],
    'docx' => ['application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'application/zip', 'application/octet-stream'],
    'xlsx' => ['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/zip', 'application/octet-stream'],
    'pptx' => ['application/vnd.openxmlformats-officedocument.presentationml.presentation', 'application/zip', 'application/octet-stream'],
    'zip'  => ['application/zip', 'application/x-zip-compressed'],
    'rar'  => ['application/x-rar', 'application/vnd.rar', 'application/x-rar-compressed', 'application/octet-stream'],
];

/**
 * Valida e salva um arquivo enviado em uploads/.
 * Confere extensão, tipo real do conteúdo (MIME) e tamanho.
 * Retorna [nome_salvo, nome_original], [null, null] se nada foi enviado,
 * ou interrompe com erro se o arquivo for inválido.
 */
function salvar_upload(string $campo, array $tiposPermitidos): array
{
    if (!isset($_FILES[$campo]) || $_FILES[$campo]['error'] === UPLOAD_ERR_NO_FILE) {
        return [null, null];
    }

    $arquivo = $_FILES[$campo];
    if ($arquivo['error'] !== UPLOAD_ERR_OK) {
        die("Erro no envio do arquivo.");
    }
    if ($arquivo['size'] > TAMANHO_MAXIMO_UPLOAD) {
        die("Arquivo muito grande (máximo de 20 MB).");
    }

    $nomeOriginal = basename($arquivo['name']);
    $ext = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));
    if (!isset($tiposPermitidos[$ext])) {
        die("Tipo de arquivo não permitido.");
    }

    $mime = (new finfo(FILEINFO_MIME_TYPE))->file($arquivo['tmp_name']);
    if (!in_array($mime, $tiposPermitidos[$ext], true)) {
        die("O conteúdo do arquivo não corresponde à extensão.");
    }

    // Nome aleatório: impede sobrescrever arquivos e adivinhar nomes.
    $nomeSalvo = bin2hex(random_bytes(16)) . "." . $ext;
    if (!move_uploaded_file($arquivo['tmp_name'], __DIR__ . "/uploads/" . $nomeSalvo)) {
        die("Não foi possível salvar o arquivo.");
    }

    return [$nomeSalvo, $nomeOriginal];
}
