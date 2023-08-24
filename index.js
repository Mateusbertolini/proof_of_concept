function corrigirLinksRelativos() {
    const links = document.querySelectorAll('a');
    const isRoot = location.pathname === '/'; // Verifica se a página está na raiz do servidor
    const isGithub = location.href.includes('github.io'); // Verifica se a URL da página contém "github.io"

    links.forEach(link => {
        const href = link.getAttribute('href');
        if (href && !href.startsWith('http') && !href.startsWith('#') && !href.startsWith('mailto')) {
            let newHref = href;
            if (!isRoot) {
              const pathSegments = location.pathname.split('/').filter(segment => segment !== ''); // Divide o caminho atual da página em segmentos
              let depth = pathSegments.length - 1; // Calcula a profundidade da pasta atual em relação à raiz
              
              if (isGithub) {
                 depth -= 1; 
                }

                const prefix = Array(depth).fill('..').join('/'); // Cria a marcação de retorno

                newHref = prefix + '/' + href; // Adiciona a marcação de retorno ao caminho relativo
            }
            link.setAttribute('href', newHref);
        }
    });
}

// Chame a função para corrigir os links relativos quando a página carregar
window.addEventListener('load', corrigirLinksRelativos);


    // Função para executar quando uma tag âncora for clicada
    function handleClick(event) {
      // Evitando o comportamento padrão de seguir o link
      event.preventDefault();

      // Obtendo o valor do atributo href da âncora clicada
      const linkHref = event.target.getAttribute('href');

      // Obtendo o elemento iframe
      const iframe = document.getElementById('iframe');

      // Carregando o link no iframe
      iframe.src = linkHref;
    }

    // Selecionando todos os elementos âncora da página
    const anchorLinks = document.querySelectorAll('a');

    // Adicionando o evento de clique a cada âncora
    anchorLinks.forEach(anchorLink => {
      anchorLink.addEventListener('click', handleClick);
    });

    document.getElementById('Nome_usuario').innerHTML = JSON.parse(localStorage.getItem('usuario')).Nome 