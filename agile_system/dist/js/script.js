const menu = document.querySelector('#toggle-btn');
const height = window.innerHeight;
const width = window.innerWidth;

var janela = width;






menu.addEventListener("click", function(){
    document.querySelector("#sidebar").classList.toggle("expand");

    if(document.querySelector('#sidebar').classList.contains("expand")){

        if(width >= (janela*0.50)){
            document.getElementById('main').style.left = width*0.20+'px';
            document.getElementById('main').style.width = width*0.80+'px';
        }

    } else {

        if(width >= (janela*0.50)){
            document.getElementById('main').style.left = width*0.05+'px';
            document.getElementById('main').style.width = width*0.95+'px';
        }
    }
        
});