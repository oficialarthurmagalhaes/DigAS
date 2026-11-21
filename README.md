# 📰 AS — Site de Publicações Acadêmicas (DigAS)

Rede de publicações dinâmicas para **compartilhar trabalhos acadêmicos** (artigos, TCCs, projetos e experimentos) entre alunos e professores. Projeto desenvolvido em equipe por estudantes de Sistemas de Informação do IFTO.

![PHP](https://img.shields.io/badge/PHP-777BB4?style=flat-square&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=flat-square&logo=javascript&logoColor=black)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat-square&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=flat-square&logo=css3&logoColor=white)

## ✨ Funcionalidades

- 👤 Cadastro, login e edição de perfil
- 📝 Publicações com texto, imagem/vídeo e arquivo para download
- ❤️ Curtidas (uma por usuário) e 💬 comentários
- 🔎 Busca por conteúdo ou autor
- 🛡️ Painel administrativo para moderar publicações

## 🔐 Segurança

- **Senhas** armazenadas com `password_hash` (bcrypt)
- **Consultas SQL** com *prepared statements* (proteção contra SQL Injection)
- **Saída escapada** com `htmlspecialchars` (proteção contra XSS)
- **Token CSRF** em todas as ações do feed, que só aceitam `POST`
- **Uploads validados** por extensão, tipo real do conteúdo (MIME) e tamanho (máx. 20 MB), salvos com nome aleatório; a pasta `uploads/` bloqueia a execução de scripts
- **Exclusão** permitida só ao autor da publicação ou a um administrador
- **Administrador** definido no banco de dados (coluna `is_admin`)

## ▶️ Como rodar localmente

Pré-requisitos: [XAMPP](https://www.apachefriends.org/) (ou Apache + PHP 8 + MySQL/MariaDB).

1. Clone o repositório dentro da pasta `htdocs` do XAMPP:
   ```bash
   git clone https://github.com/oficialarthurmagalhaes/DigAS.git
   ```
2. Inicie o **Apache** e o **MySQL** no painel do XAMPP.
3. Crie o banco importando o arquivo `banco.sql` no phpMyAdmin (ou pelo terminal):
   ```bash
   mysql -u root < banco.sql
   ```
4. Acesse `http://localhost/DigAS/login.html` e crie sua conta.
5. Para tornar sua conta administradora, rode no banco:
   ```sql
   UPDATE usuarios SET is_admin = 1 WHERE email = 'seu-email@exemplo.com';
   ```

> Já tinha o banco de uma versão anterior? Rode `migracao_v2.sql` uma vez para atualizá-lo.

As credenciais do banco podem ser definidas pelas variáveis de ambiente `DB_HOST`, `DB_USER`, `DB_PASS` e `DB_NAME`. Sem elas, o sistema usa o padrão do XAMPP (`root` sem senha).

> ⚠️ O projeto precisa de um servidor com PHP. Ele **não funciona no GitHub Pages**, que só hospeda páginas estáticas.

## 🗂️ Estrutura

```
├── funcoes.php                  # sessão, CSRF, escape de HTML e validação de uploads
├── conexao.php                  # conexão com o MySQL
├── index.php                    # feed (formulário de publicação + listagem)
├── listar_publicacoes.php       # renderização das publicações, curtidas e comentários
├── publicar.php / curtir.php / comentar.php
├── excluir_publicacao*.php      # exclusão pelo autor ou pelo admin
├── admin.php                    # painel administrativo
├── login.* / cadastro.* / editar_perfil.* / logout.php
├── banco.sql / migracao_v2.sql  # criação e atualização do banco
├── css/ js/ assets/             # estilos, scripts e imagens
└── uploads/                     # arquivos enviados (não versionados)
```

## 🤝 Equipe

Arthur Magalhães · Sérgio Henrique Martins · Eduardo Vasconcelos · Leonardo Santos Botelho
