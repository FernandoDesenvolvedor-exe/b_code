const Motorista1 = {
    id: '0',
    Name: 'Miguel Angel Balladares Huertas',
    Idade: '20',
    Documento: '801.432.489-79',
    pracaExperiencia: 'SC,PR',
    fotoMotorista:'img_motorista.jpeg',
};
const Motorista2 = {
    id: '1',
    Name: 'Luis Fernando pereira pereira ',
    Idade: '24',
    Documento: '234.432.489-79',
    pracaExperiencia: 'SC,PR',
    fotoMotorista:'img_motorista.jpeg',
};
const Motorista3 = {
    id: '2',
    Name: 'Miguel Angelo Duflow duflow ',
    Idade: '19',
    Documento: '678.432.489-79',
    pracaExperiencia: 'RJ,PR',
    fotoMotorista:'img_motorista.jpeg',
};
const Motorista4 = {
    id: '3',
    Name: 'Alisson da silva  souza Souza',
    Idade: '26',
    Documento: '123.432.489-79',
    pracaExperiencia: 'SP,PR',
    fotoMotorista:'img_motorista.jpeg',
};
const Motorista5 = {
    id: '4',
    Name: 'Vinicius Candido da silva Souza ',
    Idade: '28',
    Documento: '801.432.489-79',
    pracaExperiencia: 'SC,PR',
    fotoMotorista:'img_motorista.jpeg',
};
const Motorista6 = {
    id: '5',
    Name: 'Lucca Gomez Ferney do Socorro',
    Idade: '25',
    Documento: '801.231.489-79',
    pracaExperiencia: 'PE,PR',
    fotoMotorista:'img_motorista.jpeg',
};
const Motorista7 = {
    id: '6',
    Name: 'Lucas Heineken Aristizabal ',
    Idade: '22',
    Documento: '801.432.867-79',
    pracaExperiencia: 'GO,MT',
    fotoMotorista:'img_motorista.jpeg',
};
const Motorista8 = {
    id: '7',
    Name: 'Marcus Ramiro Escandido Bedoya ',
    Idade: '45',
    Documento: '343.432.489-79',
    pracaExperiencia: 'DF,PR',
    fotoMotorista:'img_motorista.jpeg',
};
const Motorista9= {
    id: '8',
    Name: 'Casimiro Guzman Huertas ',
    Idade: '78',
    Documento: '801.432.999-79',
    pracaExperiencia: 'SC,BA',
    fotoMotorista:'img_motorista.jpeg',
};
const Motorista10 = {
    id: '9',
    Name: 'Joao Pedro Antonio Guzman',
    Idade: '67',
    Documento: '801.567.489-79',
    pracaExperiencia: 'MT,PR',
    fotoMotorista:'img_motorista.jpeg',
};

const motoristasLibrary = [
    Motorista1,
    Motorista2,
    Motorista3,
    Motorista4,
    Motorista5,
    Motorista6,
    Motorista7,
    Motorista8,
    Motorista9,
    Motorista10,
];

let motoristas = [...motoristasLibrary]

const pagebody = document.getElementById('page-body');
const searchTerm = document.getElementById('search-term');
const searchBtn = document.getElementById('search-button');
const dadosMotorista = document.getElementById('dadosMotorista');


function loadLibrary(){
    pagebody.innerHTML = '';
    for(let index = 0; index < motoristas.length; index ++){

        pagebody.innerHTML += `
        <div class="card d-flex flex-column align-items-center pt-3" style="width: 18rem; margin-top: 3rem;">
            <img  src="dist/img/${motoristas[index].fotoMotorista}" class="card-img-top" style= "width: 10rem;" alt="Foto Motorista">
            <div class="card-body">
                <h5 class="card-title">NOME:</h5>
                <p class="d-flex align-items-center justify-content-between border-bottom border-dark p-3">
                    ${motoristas[index].Name} 
                    <button class="btn btn-outline-primary">
                        <i class="bi bi-pencil-fill"></i>
                    </button>
                </p>
                <div class="collapse" id="collapseExample">
                    <div class="card card-body">
                        <h5 class="card-text border-top border-dark">IDADE</h5>
                        <p class=" d-flex justify-content-between border-bottom border-dark p-3">
                            ${motoristas[index].Idade}
                            <button class="btn btn-outline-primary">
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                        </p>
                        <h5 class="card-text border-top border-dark">DOCUMENTO</h5>
                        <p class=" d-flex justify-content-between border-bottom border-dark p-3">
                            ${motoristas[index].Documento}
                            <button class="btn btn-outline-primary">
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                        </p>
                        <h5 class="card-text border-top border-dark">PRAÇA DE EXPERIENCIA</h5>
                        <p class=" d-flex justify-content-between border-bottom border-dark p-3">
                             ${motoristas[index].pracaExperiencia}
                             <button class="btn btn-outline-primary">
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                        </p>
                    </div>
                </div>`;
    }
}

function searchClick(){
    if(searchTerm.value === '') return;
    motoristas = motoristas.filter((motorista) => motorista.Name.includes (searchTerm.value));
    loadLibrary();
}

function resetFilter(){
    if(searchTerm.value !== '') return;
    motoristas = [...motoristasLibrary];
    loadLibrary();
}

searchBtn.addEventListener('click', searchClick);
searchTerm.addEventListener('input', resetFilter);

loadLibrary();
