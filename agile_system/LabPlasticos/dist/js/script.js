var btn = document.querySelector('#btn-show-hide');
var container = document.querySelector('.container-btn');
var add_Btn = document.querySelector('.btn-adicionar');

document.getElementById

btn.addEventListener('click', function(){
    if(container.style.display === 'block'){
        container.style.display = 'none';
    }else if(container.style.display === 'none'){
        container.style.display = 'block';
    }
})

