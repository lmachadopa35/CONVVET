document.addEventListener('DOMContentLoaded', function() {
    // Criando o conteúdo HTML e CSS dinamicamente
    const body = document.body;
  
    // Estilo CSS para a página
    const style = document.createElement('style');
    style.textContent = `
      /* Corpo da página */
      body {
        font-family: Arial, Helvetica, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #DCA1FF;
      }
  
      /* Botão para abrir a navbar */
      .open-btn {
        position: fixed;
        top: 20px;
        left: 20px;
        padding: 10px 20px;
        background-color: #a070c2;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        cursor: pointer;
        border: none;
      }
  
      /* Navbar */
      .navbar {
        position: fixed;
        top: 0;
        left: 0;
        width: 250px;
        height: 100%;
        background-color: #be73f0;
        color: white;
        transform: translateX(-100%);
        transition: transform 0.3s ease-in-out;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);
        border-right: 2px solid black;
        display: flex;
        flex-direction: column;
        padding: 20px;
      }
  
      .navbar.open {
        transform: translateX(0);
      }
  
      /* Cabeçalho da navbar */
      .navbar-header {
        padding: 20px;
        background-color: #9e55fd;
        text-align: center;
        font-size: 1.5em;
        font-weight: bold;
        border-bottom: 2px solid black;
      }
  
      /* Menu da navbar */
      .navbar-menu {
        display: flex;
        flex-direction: column;
        gap: 10px; /* Espaçamento entre os itens */
        padding: 0 20px;
        flex-grow: 1; /* Faz com que os links principais cresçam */
      }
  
      .navbar-menu a {
        color: white;
        text-decoration: none;
        padding: 10px;
        background-color: #9e55fd;
        border-radius: 8px;
        font-weight: bold;
        transition: background-color 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        width: 100%;
      }
  
      .navbar-menu a:hover {
        background-color: #8e3cfa;
      }
  
      /* Botão para fechar a navbar */
      .close-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        background-color: #8046cc;
        color: white;
        border: none;
        padding: 10px;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1em;
      }
  
      .close-btn:hover {
        background-color: #562696;
      }
  
      /* Estilo especial para o Logout */
      .logout-btn {
        color: white;
        background-color: red;
        font-weight: bold;
        border-radius: 8px;
        text-align: center;
        padding: 10px;
        transition: background-color 0.3s ease;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-top: auto; /* Faz o logout ficar no final da navbar */
      }
  
      .logout-btn:hover {
        background-color: darkred;
      }
  
      /* Estilo para os links dinâmicos */
      #dynamic-links {
        display: flex;
        flex-direction: column;
        gap: 20px; /* Espaçamento entre os links */
        justify-content: flex-start;
        padding: 10px 0;
        width: 100%;
      }
  
      #dynamic-links a {
        color: white;
        padding: 10px;
        background-color: rgb(142, 60, 250);
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
        transition: background-color 0.3s ease;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center; /* Alinha o texto horizontalmente */
        text-align: center; /* Garante o alinhamento do texto */
      }
  
      #dynamic-links a:hover {
        background-color: rgb(116, 44, 220);
      }
    `;
    document.head.appendChild(style);
  
    // Criando a estrutura HTML
    const openBtn = document.createElement('button');
    openBtn.classList.add('open-btn');
    openBtn.id = 'open-btn';
    openBtn.innerHTML = '&#9776; Abrir';
    
    const navbar = document.createElement('div');
    navbar.classList.add('navbar');
    navbar.id = 'navbar';
    
    const navbarHeader = document.createElement('div');
    navbarHeader.classList.add('navbar-header');
    navbarHeader.innerText = 'Menu';
    
    const closeBtn = document.createElement('button');
    closeBtn.classList.add('close-btn');
    closeBtn.id = 'close-btn';
    closeBtn.innerHTML = '&times;';
    
    const navbarMenu = document.createElement('div');
    navbarMenu.classList.add('navbar-menu');
    
    // Div para links dinâmicos
    const dynamicLinksContainer = document.createElement('div');
    dynamicLinksContainer.id = 'dynamic-links';
    navbarMenu.appendChild(dynamicLinksContainer);
    
    navbar.appendChild(navbarHeader);
    navbar.appendChild(closeBtn);
    navbar.appendChild(navbarMenu);
    
    body.appendChild(openBtn);
    body.appendChild(navbar);
  
    // Funções de abertura e fechamento da navbar
    openBtn.addEventListener('click', () => {
      navbar.classList.add('open');
    });
    
    closeBtn.addEventListener('click', () => {
      navbar.classList.remove('open');
    });
  
    // Função para adicionar links dinâmicos
    function addDynamicLinks(page) {
      dynamicLinksContainer.innerHTML = ''; // Limpar os links anteriores
  
      let dynamicLinks = [];
  
      // Verifica se a página contém "client_dashboard" ou "client"
      if (page.includes('client_dashboard') || page.includes('client')) {
        dynamicLinks = [
          { text: 'Home', href: '/client_dashboard' },
          { text: 'Ver Pets', href: '/client/pets' },
          { text: 'SAC', href: '/sac/sac_view' },
        ];
      } else if (page.includes('clinic') || page.includes('clinic_dashboard')) {
        dynamicLinks = [
          { text: 'Dashboard', href: '/clinic_dashboard' },
          { text: 'Appointments', href: '/clinic_dashboard/pending_appointments' },
          { text: 'Ver Pets', href: '/clinic_dashboard/view_pets' },
        ];
      }  else if (page.includes('/')) {
        dynamicLinks = [
          { text: 'Home', href: '/' },
          { text: 'Login', href: '/auth/login' }
        ];
      }
  
      // Adicionando os links dinâmicos
      dynamicLinks.forEach(link => {
        const linkElement = document.createElement('a');
        linkElement.href = link.href;
        linkElement.innerText = link.text;
        dynamicLinksContainer.appendChild(linkElement);
      });
  
      // Adicionando o link de Logout
      if (page.includes('clinic') || page.includes('clinic_dashboard') || page.includes('client_dashboard') || page.includes('client')) {
      const logoutLink = document.createElement('a');
      logoutLink.href = '/auth/logout';  // Coloque aqui o caminho real para o logout
      logoutLink.innerText = 'Logout';
      logoutLink.classList.add('logout-btn');
      dynamicLinksContainer.appendChild(logoutLink);
    }
    }
  
    // Detecta a página atual e chama a função para adicionar links dinâmicos
    const currentPage = window.location.pathname; // Obtém o caminho completo da URL
    addDynamicLinks(currentPage); // Passa o caminho completo para verificar qual página estamos
  });
  