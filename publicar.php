<?php
// Inicia a sessão para acessar variáveis de sessão
session_start();

// Inclui o arquivo de conexão com o banco de dados
include("conexao.php");

// Recebe o conteúdo da publicação enviado pelo formulário
$conteudo = $_POST['conteudo'];
// Pega o nome do autor a partir da sessão
$autor = $_SESSION['nome'];

// Inicializa as variáveis para armazenar os nomes dos arquivos (salvo e original)
$imagem_nome = "";
$imagem_nome_original = "";
$arquivo_nome = "";
$arquivo_nome_original = "";

// Verifica se um arquivo de imagem/vídeo foi enviado e se não houve erro no upload
if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] == 0) {
    // Pega o nome original do arquivo enviado
    $imagem_nome_original = $_FILES['imagem']['name'];
    // Pega a extensão do arquivo enviado
    $ext = strtolower(pathinfo($imagem_nome_original, PATHINFO_EXTENSION));
    // Gera um nome único para o arquivo salvo
    $imagem_nome = uniqid() . "." . $ext;
    // Move o arquivo enviado para a pasta 'uploads'
    move_uploaded_file($_FILES['imagem']['tmp_name'], "uploads/" . $imagem_nome);
}

// Verifica se um arquivo para download foi enviado e se não houve erro no upload
if (isset($_FILES['arquivo']) && $_FILES['arquivo']['error'] == 0) {
    // Pega o nome original do arquivo enviado
    $arquivo_nome_original = $_FILES['arquivo']['name'];
    // Pega a extensão do arquivo enviado
    $ext = strtolower(pathinfo($arquivo_nome_original, PATHINFO_EXTENSION));
    // Gera um nome único para o arquivo salvo
    $arquivo_nome = uniqid() . "." . $ext;
    // Move o arquivo enviado para a pasta 'uploads'
    move_uploaded_file($_FILES['arquivo']['tmp_name'], "uploads/" . $arquivo_nome);
}

// Insere a publicação no banco de dados, incluindo os nomes originais e salvos dos arquivos
$sql = "INSERT INTO publicacoes (conteudo, autor, imagem, imagem_nome_original, arquivo, arquivo_nome_original) 
        VALUES ('$conteudo', '$autor', '$imagem_nome', '$imagem_nome_original', '$arquivo_nome', '$arquivo_nome_original')";
$conn->query($sql);

// Redireciona o usuário de volta para a página inicial após a publicação
header("Location: index.php");
?>