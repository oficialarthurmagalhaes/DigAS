<?php
// Lista as publicações do feed (incluído pelo index.php).
// Todo conteúdo vindo do banco passa por e() antes de ir para a tela (evita XSS).
require_once("funcoes.php");
require_once("conexao.php");

$busca = trim($_POST['busca'] ?? '');

if ($busca !== '') {
    $termo = "%" . $busca . "%";
    $stmt = $conn->prepare("SELECT * FROM publicacoes WHERE conteudo LIKE ? OR autor LIKE ? ORDER BY data DESC");
    $stmt->bind_param("ss", $termo, $termo);
} else {
    $stmt = $conn->prepare("SELECT * FROM publicacoes ORDER BY data DESC");
}
$stmt->execute();
$res = $stmt->get_result();

$stmtCurtidas = $conn->prepare("SELECT COUNT(*) AS total FROM curtidas WHERE publicacao_id = ?");
$stmtComentarios = $conn->prepare("SELECT autor, texto, data FROM comentarios WHERE publicacao_id = ? ORDER BY data ASC");

$extensoesImagem = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
$extensoesVideo  = ['mp4', 'mov', 'webm'];

while ($row = $res->fetch_assoc()) {
    $post_id = (int) $row['id'];
    echo "<div class='publicacao-feed'>";
    echo "  <p class='publicacao-feed-autor'>" . e($row['autor']) . ": <span class='publicacao-feed-data'>" . e($row['data']) . "</span>";

    // Botão de excluir só aparece para o dono da publicação (exclusão via POST + CSRF)
    if (usuario_logado() && ($row['usuario_email'] ?? null) === $_SESSION['email']) {
        echo " <form action='excluir_publicacao.php' method='POST' style='display:inline' onsubmit=\"return confirm('Excluir esta publicação?');\">"
           . csrf_campo()
           . "<input type='hidden' name='id' value='{$post_id}'>"
           . "<button type='submit' class='publicacao-feed-excluir-publicacao' style='background:none;border:none;padding:0;cursor:pointer'>"
           . "<img src='assets/img/hero/excluir_publicacao.png' alt='Excluir publicação'></button></form>";
    }
    echo "</p>";
    echo "  <p class='publicacao-feed-texto'>" . nl2br(e($row['conteudo'])) . "</p>";

    if (!empty($row['imagem'])) {
        $arquivoMidia = e(basename($row['imagem']));
        $ext = strtolower(pathinfo($row['imagem'], PATHINFO_EXTENSION));
        if (in_array($ext, $extensoesImagem, true)) {
            echo "<img class='publicacao-feed-imagem' src='uploads/{$arquivoMidia}' alt=''>";
        } elseif (in_array($ext, $extensoesVideo, true)) {
            echo "<video class='publicacao-feed-video' src='uploads/{$arquivoMidia}' controls style='max-width:100%;height:auto;'></video>";
        }
    }

    if (!empty($row['arquivo'])) {
        $arquivoDownload = e(basename($row['arquivo']));
        $nomeArquivoOriginal = e($row['arquivo_nome_original']);
        echo "<a class='publicacao-feed-arquivo' href='uploads/{$arquivoDownload}' download='{$nomeArquivoOriginal}' target='_blank' rel='noopener'>📎 Baixar arquivo: {$nomeArquivoOriginal}</a>";
    }

    // Curtidas
    $stmtCurtidas->bind_param("i", $post_id);
    $stmtCurtidas->execute();
    $curtidas = (int) $stmtCurtidas->get_result()->fetch_assoc()['total'];

    // Comentários
    $stmtComentarios->bind_param("i", $post_id);
    $stmtComentarios->execute();
    $comentarios = $stmtComentarios->get_result();
    if ($comentarios->num_rows > 0) {
        echo "<div class='publicacao-feed-comentarios'>";
        while ($coment = $comentarios->fetch_assoc()) {
            echo "<p class='publicacao-feed-comentarios-autor'>" . e($coment['autor']) . ": <span class='publicacao-feed-comentarios-data'>" . e($coment['data']) . "</span></p>";
            echo "<p class='publicacao-feed-comentarios-texto'>" . e($coment['texto']) . "</p>";
        }
        echo "</div>";
    }

    // Curtir e comentar
    echo "<div class='publicacao-feed-curtir-comentar'>";
    echo "  <form class='publicacao-feed-curtir' action='curtir.php' method='POST'>";
    echo        csrf_campo();
    echo "      <input type='hidden' name='publicacao_id' value='{$post_id}'>";
    echo "      <button class='publicacao-feed-curtir-botao' type='submit'>
                    <img src='assets/img/hero/curtir_publicacao.png' alt=''>
                    <p>Curtir ({$curtidas})</p>
                </button>";
    echo "  </form>";
    echo "  <form class='publicacao-feed-comentar' action='comentar.php' method='POST'>";
    echo        csrf_campo();
    echo "      <input type='hidden' name='publicacao_id' value='{$post_id}'>";
    echo "      <input class='publicacao-feed-comentar-texto' type='text' name='comentario' placeholder='Comente algo...' required>";
    echo "      <button class='publicacao-feed-comentar-botao' type='submit'>Comentar</button>";
    echo "  </form>";
    echo "</div>";
    echo "</div><hr>";
}
