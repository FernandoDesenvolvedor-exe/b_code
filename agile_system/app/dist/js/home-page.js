const carousel = document.getElementsByClassName('carousel-item');

function ativaSlide(num){   
    if(num === 0){
        document.getElementById('btnRota').style.backgroundColor = 'rgb(18, 101, 224)';
        document.getElementById('btnGastos').style.backgroundColor = '#212529';
        document.getElementById('btnSuporte').style.backgroundColor = '#212529';

        document.getElementById('gereRota').hidden = false;
        document.getElementById('moniGastos').hidden = true;
        document.getElementById('supMot').hidden = true;
        
        document.getElementById('slide1').classList.add('active');
        document.getElementById('slide2').classList.remove('active');
        document.getElementById('slide3').classList.remove('active');

    } else if(num === 1){ 
        document.getElementById('btnRota').style.backgroundColor = '#212529';
        document.getElementById('btnGastos').style.backgroundColor = 'rgb(18, 101, 224)';
        document.getElementById('btnSuporte').style.backgroundColor = '#212529';

        document.getElementById('gereRota').hidden = true;
        document.getElementById('moniGastos').hidden = false;
        document.getElementById('supMot').hidden = true;
        
        document.getElementById('slide1').classList.remove('active');
        document.getElementById('slide2').classList.add('active');
        document.getElementById('slide3').classList.remove('active');
        
    } else if(num === 2){
        document.getElementById('btnRota').style.backgroundColor = '#212529';
        document.getElementById('btnGastos').style.backgroundColor = '#212529';
        document.getElementById('btnSuporte').style.backgroundColor = 'rgb(18, 101, 224)';

        document.getElementById('gereRota').hidden = true;
        document.getElementById('moniGastos').hidden = true;
        document.getElementById('supMot').hidden = false;
        
        document.getElementById('slide1').classList.remove('active');
        document.getElementById('slide2').classList.remove('active');
        document.getElementById('slide3').classList.add('active');
    }
}

document.getElementById('btnRota').addEventListener('click', function(){  
    ativaSlide(0);
});

document.getElementById('btnGastos').addEventListener('click', function(){    
    ativaSlide(1);
});

document.getElementById('btnSuporte').addEventListener('click', function(){
    ativaSlide(2);
});

