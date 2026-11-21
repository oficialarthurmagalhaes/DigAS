<?php
require_once("funcoes.php");
require_once("conexao.php");
exigir_admin();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>AS - Painel Administrativo</title>
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo/icone_AS.svg">
    <link rel="icon" type="image/svg" href="assets/img/logo/icone_AS.svg">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Importa o CSS-->
    <link rel="stylesheet" href="css/style.css">
    <!-- Importa a fonte Inter do Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <!-- Importa o JavaScript do header e footer-->
    <script type="text/JavaScript" src="js/script.js"></script>
    <!-- Script para carregar cabeçalho e rodapé -->
    <script>
        var isAdmin = <?php echo eh_admin() ? 'true' : 'false'; ?>;
        window.addEventListener("load", criarHeader);
        window.addEventListener("load", criarFooter);
    </script>
    <style>
        .admin-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            padding: 32px 24px;
            margin: 40px auto 24px auto;
            max-width: 800px;
        }
        .admin-section-title {
            color: #0b5481;
            margin-top: 24px;
            margin-bottom: 12px;
            font-size: 1.3em;
            border-bottom: 1px solid #e1e8ed;
            padding-bottom: 4px;
        }
        .admin-list {
            margin-bottom: 24px;
        }
        .admin-user, .admin-pub {
            padding: 8px 0;
            border-bottom: 1px solid #f1f1f1;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .admin-pub-content {
            flex: 1;
            margin-right: 10px;
            color: #333;
        }
        .admin-excluir {
            color: #c00;
            font-size: 0.95em;
            text-decoration: underline;
            margin-left: 10px;
        }
        .admin-excluir:hover {
            color: #f00;
        }
    </style>
</head>
<body>
    <header>
        <div class="header" id="header"></div>
    </header>
    <main class="container">
        <div class="feed admin-card">
            <h1 style="margin-bottom: 24px;">Painel Administrativo</h1>

            <div class="admin-section-title">Usuários</div>
            <div class="admin-list">
                <?php
                $res = $conn->query("SELECT nome, email FROM usuarios ORDER BY nome");
                while ($row = $res->fetch_assoc()) {
                    echo "<div class='admin-user'><span>" . e($row['nome']) . " <span style='color:#888;'>(" . e($row['email']) . ")</span></span></div>";
                }
                ?>
            </div>

            <div class="admin-section-title">Publicações</div>
            <div class="admin-list">
                <?php
                $res = $conn->query("SELECT * FROM publicacoes ORDER BY data DESC");
                while ($row = $res->fetch_assoc()) {
                    echo "<div class='admin-pub'>";
                    echo "<span class='admin-pub-content'><strong>" . e($row['autor']) . "</strong>: " . e($row['conteudo']) . "</span>";
                    echo "<form action='excluir_publicacao_admin.php' method='POST' style='display:inline' onsubmit=\"return confirm('Excluir esta publicação?');\">"
                       . csrf_campo()
                       . "<input type='hidden' name='id' value='" . (int) $row['id'] . "'>"
                       . "<button type='submit' class='admin-excluir' style='background:none;border:none;cursor:pointer'>[Excluir]</button></form>";
                    echo "</div>";
                }
                ?>
            </div>
        </div>
    </main>
    <footer>
        <div class="footer" id="footer"></div>
    </footer>
</body>
</html>