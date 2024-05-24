const menu = document.querySelector('#toggle-btn');
const height = window.innerHeight;
const width = window.innerWidth;

var janela = width;






menu.addEventListener("click", function(){
    document.querySelector("#sidebar").classList.toggle("expand");
    const menu = document.getElementsByClassName('sidebar-item');
    const main = document.getElementById('principal');

    if(document.querySelector('#sidebar').classList.contains("expand")){
        main.style.marginLeft = '20%';
    } else {
        main.style.marginLeft = '5%';
    }        
});