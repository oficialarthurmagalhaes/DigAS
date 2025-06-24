<?php
include("conexao.php");

$busca = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['busca'])) {
    $busca = $conn->real_escape_string($_POST['busca']);
}

$filtro = $busca ? "WHERE conteudo LIKE '%$busca%' OR autor LIKE '%$busca%'" : "";

$sql = "SELECT * FROM publicacoes $filtro ORDER BY data DESC";
$res = $conn->query($sql);

while ($row = $res->fetch_assoc()) {
    $post_id = $row['id'];
    echo "<div class='publicacao-feed'>";
    echo "  <p class='publicacao-feed-autor'>{$row['autor']}: <span class='publicacao-feed-data'>{$row['data']}</span>";
    if (isset($_SESSION['nome']) && $_SESSION['nome'] === $row['autor']) {
        echo " <a href='excluir_publicacao.php?id={$post_id}' class='publicacao-feed-excluir-publicacao'><img src='assets/img/hero/excluir_publicacao.png'></a>";
    }
    echo "</p>";
    echo "  <p class='publicacao-feed-texto'>{$row['conteudo']}</p>";
    
    if (!empty($row['imagem'])) {
        // Exibe imagem ou vídeo
        $ext = strtolower(pathinfo($row['imagem'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
            echo "<img class='publicacao-feed-imagem' src='uploads/{$row['imagem']}'>";
        } elseif (in_array($ext, ['mp4', 'mov', 'avi', 'webm', 'mkv'])) {
            echo "<video class='publicacao-feed-video' src='uploads/{$row['imagem']}' controls style='max-width:100%;height:auto;'></video>";
        }
    }

    // Exibe link para download de arquivo, se existir
    if (!empty($row['arquivo'])) {
        // Mostra o nome original do arquivo para o usuário
        $nomeArquivoOriginal = htmlspecialchars($row['arquivo_nome_original']);
        echo "<a class='publicacao-feed-arquivo' href='uploads/{$row['arquivo']}' download target='_blank'>📎 Baixar arquivo: $nomeArquivoOriginal</a>";
    }

    // Curtidas na publicação
    $curtidas = $conn->query("SELECT COUNT(*) as total FROM curtidas WHERE publicacao_id = $post_id")->fetch_assoc()['total'];

    // Comentário na publicação
    $comentarios = $conn->query("SELECT * FROM comentarios WHERE publicacao_id = $post_id ORDER BY data ASC");
    if ($comentarios->num_rows > 0){
        echo "<div class='publicacao-feed-comentarios'>";
        while ($coment = $comentarios->fetch_assoc()) {
            echo "<p class='publicacao-feed-comentarios-autor'>{$coment['autor']}: <span class='publicacao-feed-comentarios-data'>{$coment['data']}</span></p>";
            echo "<p class='publicacao-feed-comentarios-texto'>{$coment['texto']}</p>";
        }
        echo "</div>";
    }
    
    // Botão de curtidas e Formulário de comentário na publicação
    echo "<div class='publicacao-feed-curtir-comentar'>";
    echo "  <form class='publicacao-feed-curtir' action='curtir.php' method='POST'>";
    echo "      <input type='hidden' name='publicacao_id' value='$post_id'>";
    echo "      <button class='publicacao-feed-curtir-botao' type='submit' id='curtir'>
                    <img src='assets/img/hero/curtir_publicacao.png'>
                    <p>Curtir ($curtidas)</p>
                </button>";    
    echo "  </form>";
    echo "  <form class='publicacao-feed-comentar' action='comentar.php' method='POST'>";
    echo "      <input type='hidden' name='publicacao_id' value='$post_id'>";
    echo "      <input class='publicacao-feed-comentar-texto' type='text' name='comentario' placeholder='Comente algo...' required>";
    echo "      <button class='publicacao-feed-comentar-botao' type='submit'>Comentar</button>";
    echo "  </form>";
    echo "</div>";

    echo "</div><hr>";
}
?>