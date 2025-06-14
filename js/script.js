// ==========================
// Função para criar o cabeçalho
// ==========================
function criarHeader() {
    console.log("A função está sendo chamada!");

    const headerHTML =` 
        <header class="header">
            <div class="nav">
                <a href="index.html" class="logo">
                    <img src="/assets/img/logo_DigAS_semfundo.png" alt="Logo DigAS" height="40" />
                    <span>DigAS</span>
                </a>

                <nav class="links">
                    <a href="contato.html" class="link ativo">Contato</a>
                    <a href="sobre.html" class="link">Sobre</a>
                    
                    <form class="busca">
                        <input type="text" placeholder="Buscar..." />
                        <button type="submit">Buscar</button>
                    </form>
                    <div class="menu">
                        <button class="link">•••</button>
                        <ul class="submenu">
                            <li><a href="#">Ação</a></li>
                            <li><a href="#">Outra ação</a></li>
                            <li><hr /></li>
                            <li><a href="#">Mais alguma coisa</a></li>
                        </ul>
                    </div>
                </nav>
                
            </div>
        </header>
    </header>
        `;
    document.getElementById("header").innerHTML = headerHTML;


    document.getElementById("header").innerHTML = headerHTML;
}
function criarFooter() {
    console.log("A função do rodapé está sendo chamada!")

    const FooterHTML = `
        <br>
        <p>Equipe: Arthur Magalhães, Sérgio Henrique, Eduardo Vasconcelos e Leonardo Botelho</p>
        <a href="">Saiba Mais</a>
    `;

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
              <img src="/assets/img/IMG_20250112_163915.jpg" alt="IMG-20250112-163915"">
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

        tweetsContainer.insertBefore(tweetDiv, tweetsContainer.firstChild);
    }

    // Evento de clique no botão "Publicar"
    tweetButton.addEventListener('click', () => {
        const tweetText = tweetInput.value.trim();

        if (tweetText) {
            createTweet(tweetText);
            tweetInput.value = '';
        } else {
            alert("Digite algo para tweetar!");
        }
    });

    // Evento de tecla Enter para enviar tweet
    tweetInput.addEventListener('keypress', (event) => {
        if (event.key === 'Enter' && !event.shiftKey) {
            event.preventDefault();
            tweetButton.click();
        }
    });
});

// Mostrar botão ao rolar para baixo
  window.addEventListener("scroll", function () {
    const botao = document.querySelector(".btn-topo");
    if (window.scrollY > 300) {
      botao.style.display = "block";
    } else {
      botao.style.display = "none";
    }
  });

  // Rolar suavemente ao topo
  function voltarAoTopo() {
    window.scrollTo({ top: 0, behavior: "smooth" });
  }
