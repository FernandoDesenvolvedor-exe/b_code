const menu = document.querySelector('#toggle-btn');
const main = document.getElementById('principal');

if(sessionStorage.getItem('menuOpen') == 'true'){
    document.querySelector("#sidebar").classList.add("expand");    
    main.style.marginLeft = '20%';
}

menu.addEventListener("click", function(){
    document.querySelector("#sidebar").classList.toggle("expand");
    
    if(document.querySelector('#sidebar').classList.contains("expand")){
        main.style.marginLeft = '20%';
        sessionStorage.setItem('menuOpen', true);
    } else {
        main.style.marginLeft = '5%';
        sessionStorage.setItem('menuOpen', false);
    }        
});

function ativaItem(element){    
    element.classList.add('active');
}