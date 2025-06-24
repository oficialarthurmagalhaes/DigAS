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
    echo "  <p class='publicacao-feed-autor'>{$row['autor']}:</p>";
    echo "  <p class='publicacao-feed-texto'>{$row['conteudo']}</p>";
    
    if (!empty($row['imagem'])) {
        echo "<img class='publicacao-feed-imagem' src='uploads/{$row['imagem']}'><br>";
    }

    // Curtidas
    $curtidas = $conn->query("SELECT COUNT(*) as total FROM curtidas WHERE publicacao_id = $post_id")->fetch_assoc()['total'];

    // Comentários
    echo "<div style='margin-left: 25px;'>";
    $comentarios = $conn->query("SELECT * FROM comentarios WHERE publicacao_id = $post_id ORDER BY data ASC");
    while ($coment = $comentarios->fetch_assoc()) {
        echo "<p><strong>{$coment['autor']}:</strong> {$coment['texto']}</p>";
    }
    echo "</div>";

    // Formulário de comentário
    echo "<div class='publicacao-feed-curtir-comentar'>";
    echo "  <form class='publicacao-feed-curtir' action='curtir.php' method='POST'>";
    echo "      <input type='hidden' name='publicacao_id' value='$post_id'>";
    echo "      <button class='publicacao-feed-curtir-botao' type='submit' id='curtir'>
                    <img src='assets/img/hero/coracao.png'>
                    <p>Curtir ($curtidas)</p>
                </button>";    
    echo "  </form>";
    echo "  <form class='publicacao-feed-comentar' action='comentar.php' method='POST'>";
    echo "      <input type='hidden' name='publicacao_id' value='$post_id'>";
    echo "      <input class='publicacao-feed-comentar-texto' type='text' name='comentario' placeholder='Comente algo...' required>";
    echo "      <button class='publicacao-feed-comentar-botao' type='submit'>Comentar</button>";
    echo "  </form>";
    echo "</div>";

    if (isset($_SESSION['nome']) && $_SESSION['nome'] === $row['autor']) {
        echo "<br><a href='excluir_publicacao.php?id={$post_id}'>Excluir</a>";
    }

    echo "</div><hr>";
}
?>
