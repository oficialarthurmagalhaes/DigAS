<?php
require_once("funcoes.php");
require_once("conexao.php");
exigir_login();
exigir_post();
validar_csrf();

$conteudo = trim($_POST['conteudo'] ?? '');
if ($conteudo === '') {
    die("A publicação não pode estar vazia.");
}

$autor = $_SESSION['nome'];
$email = $_SESSION['email'];

// Cada upload é validado (extensão, tipo real e tamanho) antes de ser salvo
[$imagem_nome, $imagem_nome_original] = salvar_upload('imagem', TIPOS_MIDIA);
[$arquivo_nome, $arquivo_nome_original] = salvar_upload('arquivo', TIPOS_ARQUIVO);

$stmt = $conn->prepare(
    "INSERT INTO publicacoes (conteudo, autor, usuario_email, imagem, imagem_nome_original, arquivo, arquivo_nome_original)
     VALUES (?, ?, ?, ?, ?, ?, ?)"
);
$stmt->bind_param("sssssss", $conteudo, $autor, $email, $imagem_nome, $imagem_nome_original, $arquivo_nome, $arquivo_nome_original);
$stmt->execute();

header("Location: index.php");
