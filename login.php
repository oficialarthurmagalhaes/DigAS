<?php
require_once("funcoes.php");
require_once("conexao.php");
exigir_post();

$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

// Consulta com prepared statement: o e-mail nunca é colado direto no SQL.
$stmt = $conn->prepare("SELECT nome, email, senha, is_admin FROM usuarios WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if ($user && password_verify($senha, $user['senha'])) {
    session_regenerate_id(true); // evita fixação de sessão
    $_SESSION['email']    = $user['email'];
    $_SESSION['nome']     = $user['nome'];
    $_SESSION['is_admin'] = (bool) $user['is_admin'];
    header("Location: index.php");
    exit();
}

echo "Login inválido.";
