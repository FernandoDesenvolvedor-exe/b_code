const menu = document.querySelector('#toggle-btn');
const height = window.innerHeight;
const width = window.innerWidth;

var janela = width;






menu.addEventListener("click", function(){
    document.querySelector("#sidebar").classList.toggle("expand");
    var menu = document.getElementsByClassName('sidebar-item');

    if(document.querySelector('#sidebar').classList.contains("expand")){


        for(i=0; i<menu.length; i++) {
            menu[i].style.visibility = 'hidden';
        }

        document.getElementById('main').style.left = width*0.20+'px';
        document.getElementById('main').style.width = width*0.80+'px';  
    } else {

        for(i=0; i<menu.length; i++) {
            menu[i].style.visibility = 'visible';
        }
        document.getElementById('main').style.left = width*0.05+'px';
        document.getElementById('main').style.width = width*0.95+'px';
    }        
});