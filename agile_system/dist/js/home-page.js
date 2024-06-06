const rotaBtn = document.getElementById('btnRota');
const gastosBtn = document.getElementById('btnMGastos');
const suporteBtn = document.getElementById('btnSuporte');

rotaBtn.addEventListener('click', function(){  
    if(rotaBtn.style.backgroundColor == 'rgb(18, 101, 224)'){
        document.getElementById('gereRota').hidden = true;
        rotaBtn.style.backgroundColor = '#212529';
    } else {
        rotaBtn.style.backgroundColor = 'rgb(18, 101, 224)';
        gastosBtn.style.backgroundColor = '#212529';
        suporteBtn.style.backgroundColor = '#212529';

        document.getElementById('gereRota').hidden = false;
        document.getElementById('moniGastos').hidden = true;
        document.getElementById('supMot').hidden = true;
        
        document.getElementById('slide1').classList.add('active');
        document.getElementById('slide2').classList.remove('active');
        document.getElementById('slide3').classList.remove('active');
    }
});

gastosBtn.addEventListener('click', function(){
    if(gastosBtn.style.backgroundColor == 'rgb(18, 101, 224)'){
        document.getElementById('moniGastos').hidden = true;
        gastosBtn.style.backgroundColor = '#212529';
    } else {
        rotaBtn.style.backgroundColor = '#212529';
        gastosBtn.style.backgroundColor = 'rgb(18, 101, 224)';
        suporteBtn.style.backgroundColor = '#212529';

        document.getElementById('gereRota').hidden = true;
        document.getElementById('moniGastos').hidden = false;
        document.getElementById('supMot').hidden = true;
        
        document.getElementById('slide1').classList.remove('active');
        document.getElementById('slide2').classList.add('active');
        document.getElementById('slide3').classList.remove('active');
    }
});

suporteBtn.addEventListener('click', function(){
    if(suporteBtn.style.backgroundColor == 'rgb(18, 101, 224)'){
        document.getElementById('supMot').hidden = true;
        suporteBtn.style.backgroundColor = '#212529';
    } else {
        rotaBtn.style.backgroundColor = '#212529';
        gastosBtn.style.backgroundColor = '#212529';
        suporteBtn.style.backgroundColor = 'rgb(18, 101, 224)';

        document.getElementById('gereRota').hidden = true;
        document.getElementById('moniGastos').hidden = true;
        document.getElementById('supMot').hidden = false;
        
        document.getElementById('slide1').classList.remove('active');
        document.getElementById('slide2').classList.remove('active');
        document.getElementById('slide3').classList.add('active');
    }
});