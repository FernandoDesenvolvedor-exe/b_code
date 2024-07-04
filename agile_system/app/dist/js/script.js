const menu = document.querySelector('#toggle-btn');
const main = document.getElementById('principal');
const dropdown = document.getElementById('menu-dropdown');

if(sessionStorage.getItem('menuOpen') == 'true'){
    document.querySelector("#sidebar").classList.add("expand");    
    main.style.left = '15%';
    main.style.width = '85%';
}

if(sessionStorage.getItem('menu_dropdown') == 'true'){
    dropdown.classList.remove('collapsed');
    dropdown.setAttribute('aria-expanded', 'true');
    document.querySelector('#auth').classList.add('show');
}

dropdown.addEventListener('click', function(){
    sessionStorage.setItem('menu_dropdown', dropdown.getAttribute('aria-expanded'));
});

menu.addEventListener("click", function(event){

    document.querySelector("#sidebar").classList.toggle("expand");
    
    if(document.querySelector('#sidebar').classList.contains("expand")){
        main.style.left = '15%';
        main.style.width = '85%';
        sessionStorage.setItem('menuOpen', true);
    } else {
        main.style.left = '5%';
        main.style.width = '95%';
        sessionStorage.setItem('menuOpen', false);
    }  
        
});

function ativaItem(element){    
    element.classList.add('active');
}

function sairSistema(){
    window.location.href = "index.html";
    sessionStorage.setItem('logout', true);
}

function acessoIndevido(){
    var logado = sessionStorage.getItem('logado');  

    if(logado != 'true'){
        window.location.href = "index.html";
        sessionStorage.setItem('acesso_indevido',true);
    }
}