const menu = document.querySelector('#toggle-btn');
const main = document.getElementById('principal');
const dropdown = document.getElementById('menu-dropdown');
const janela = window.innerWidth;

if(sessionStorage.getItem('menuOpen') == 'true'){
    document.querySelector("#sidebar").classList.add("expand");    
    main.style.marginLeft = '20%';
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
        
    if(janela > 576){
        if(document.querySelector('#sidebar').classList.contains("expand")){
            main.style.marginLeft = '20%';
            sessionStorage.setItem('menuOpen', true);
        } else {
            main.style.marginLeft = '5%';
            sessionStorage.setItem('menuOpen', false);
        }  
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