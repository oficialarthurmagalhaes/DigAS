// ==========================
// Função para criar o cabeçalho do site
// ==========================
function criarHeader() {
    // Log para verificar se a função está sendo chamada
    console.log("A função do  cabeçalho está sendo chamada!");

    // Monta o HTML do cabeçalho
    const headerHTML =` 
        <header class="header">
            <div class="nav">
                <a href="index.html" class="logo">
                    <img src="/assets/img/logo/logo_AS.png" alt="Logo AS - Home" height="40" />
                </a>

                <nav class="links">
                    <a href="contato.html" class="link ativo">Contato</a>
                    <a href="sobre.html" class="link">Sobre</a>
                    
                    <form class="busca" action="\#">
                        <input type="text" placeholder="Buscar..." id=busca name=busca/>
                        <button type="submit"><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" height="24" viewBox="0 0 24 24" width="24" focusable="false" aria-hidden="true" style="pointer-events: none; display: inherit; width: 100%; height: 100%;"><path clip-rule="evenodd" d="M16.296 16.996a8 8 0 11.707-.708l3.909 3.91-.707.707-3.909-3.909zM18 11a7 7 0 00-14 0 7 7 0 1014 0z" fill-rule="evenodd"></path></svg></button>
                    </form>
                    <div class="menu">
                        <button class="link">•••</button>
                        <ul class="submenu">
                            <li><a href="#">Meu Perfil</a></li>
                            <li><a href="#">Publicações Salvas</a></li>
                            <li><hr /></li>
                            <li><a href="#">Logout</a></li>
                        </ul>
                    </div>
                </nav>
                
            </div>
        </header>
    </header>
        `;
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
        <p>Equipe: Arthur Magalhães, Sérgio Henrique, Eduardo Vasconcelos e Leonardo Botelho</p>
        <a href="">Saiba Mais</a>
    `;

    // Insere o HTML do rodapé no elemento com id "footer"
    document.getElementById("footer").innerHTML = FooterHTML
}

// ==========================
// Lógica dos Tweets
// ==========================

// Espera o DOM carregar para garantir que os elementos existam
window.addEventListener("DOMContentLoaded", () => {
    const tweetButton = document.getElementById('tweet-button');
    const tweetInput = document.getElementById('tweet-input');
    const tweetsContainer = document.getElementById('tweets-container');

    // Função para criar um novo tweet
    function createTweet(tweetText) {
        const tweetDiv = document.createElement('div');
        tweetDiv.classList.add('tweet');

        tweetDiv.innerHTML = `
          <div class="tweet-header">
              <img src="/assets/img/fotoPerfil_teste.jpg" alt="IMG-20250112-163915"">
              <div class="tweet-info">
                  <strong>Arthur Magalhães</strong>
                  <span>@magaltotal</span>
              </div>
          </div>
          <p>${tweetText}</p>
          <div class="tweet-footer">
              <button>Curtir</button>
              <button>Comentar</button>
              <button>Compartilhar</button>
          </div>
      `;
        // Adiciona o tweet no início da lista
        tweetsContainer.insertBefore(tweetDiv, tweetsContainer.firstChild);
    }

    // Evento de clique no botão "Publicar" para criar tweet
    tweetButton.addEventListener('click', () => {
        const tweetText = tweetInput.value.trim();

        if (tweetText) {
            createTweet(tweetText);
            tweetInput.value = '';
        } else {
            alert("Digite algo para tweetar!");
        }
    });

    // Permite enviar tweet pressionando Enter (sem Shift)
    tweetInput.addEventListener('keypress', (event) => {
        if (event.key === 'Enter' && !event.shiftKey) {
            event.preventDefault();
            tweetButton.click();
        }
    });
});

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
