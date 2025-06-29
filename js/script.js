// ==========================
// Função para criar o cabeçalho do site
// ==========================
function criarHeader() {
    // Log para verificar se a função está sendo chamada
    console.log("A função do  cabeçalho está sendo chamada!");
    let adminLink = '';
    if (typeof isAdmin !== "undefined" && isAdmin) {
      adminLink = `<a href="admin.php" class="link">Painel Admin</a>`;
}

    // Monta o HTML do cabeçalho
    const headerHTML =` 
        <header class="header">
            <div class="nav">
                <a href="index.php" class="logo">
                    <img src="assets/img/logo/logo_AS.png"/>
                </a>

                <nav class="links">
                    <a href="index.php" class="link ativo">Início</a>
                    <a href="contato.php" class="link">Contato</a>
                    <a href="sobre.php" class="link">Sobre</a>
                    ${adminLink}
                    
                    <form class="busca" action="index.php" method="POST">
                        <input type="text" placeholder="Buscar conteúdo ou autor..." id=busca name=busca value="" />
                        <button type="submit">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true"><path clip-rule="evenodd" d="M16.296 16.996a8 8 0 11.707-.708l3.909 3.91-.707.707-3.909-3.909zM18 11a7 7 0 00-14 0 7 7 0 1014 0z" fill-rule="evenodd"></path></svg>
                        </button>
                    </form>
                    <div class="menu">
                        <button class="link">•••</button>
                        <ul class="submenu">
                            <li><a href="editar_perfil.html">Editar Perfil</a></li>
                            <li><a href="#">Publicações Salvas</a></li>
                            <li><hr /></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>`;
    // Insere o HTML do cabeçalho no elemento com id "header"
    document.getElementById("header").innerHTML = headerHTML;
}

// ==========================
// Função para criar o rodapé do site dinamicamente
// ==========================
function criarFooter() {
    // Log para verificar se a função está sendo chamada
    console.log("A função do rodapé está sendo chamada!")

    // Monta o HTML do rodapé
    const FooterHTML = `
        <br>
        <p>AS ® 2025</p>
        <a href="https://docs.google.com/document/d/1MQCXd3q-jdZDjXXAWY3i8GacN3UbDNyhw1ExE0k093E/edit?usp=sharing" target="_blank">Saiba Mais</a>
    `;

    // Insere o HTML do rodapé no elemento com id "footer"
    document.getElementById("footer").innerHTML = FooterHTML
}

// ==========================
// Botão de voltar ao topo
// ==========================

// Mostra o botão ao rolar a página para baixo
  window.addEventListener("scroll", function () {
    const botao = document.querySelector(".btn-topo");
    if (window.scrollY > 300) {
      botao.style.display = "block";
    } else {
      botao.style.display = "none";
    }
  });

// Função para rolar suavemente até o topo da página
  function voltarAoTopo() {
    window.scrollTo({ top: 0, behavior: "smooth" });
  }
