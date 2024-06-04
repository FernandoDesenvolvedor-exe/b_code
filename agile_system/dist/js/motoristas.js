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
    Name: 'Luis Fernando',
    Idade: '24',
    Documento: '234.432.489-79',
    pracaExperiencia: 'SC,PR',
    fotoMotorista:'img_motorista.jpeg',
};
const Motorista3 = {
    id: '2',
    Name: 'Miguel Angelo Duflow',
    Idade: '19',
    Documento: '678.432.489-79',
    pracaExperiencia: 'RJ,PR',
    fotoMotorista:'img_motorista.jpeg',
};
const Motorista4 = {
    id: '3',
    Name: 'Alisson Vida Loka',
    Idade: '26',
    Documento: '123.432.489-79',
    pracaExperiencia: 'SP,PR',
    fotoMotorista:'img_motorista.jpeg',
};
const Motorista5 = {
    id: '4',
    Name: 'Vinicius O cara',
    Idade: '28',
    Documento: '801.432.489-79',
    pracaExperiencia: 'SC,PR',
    fotoMotorista:'img_motorista.jpeg',
};
const Motorista6 = {
    id: '5',
    Name: 'Lucca Beludo',
    Idade: '25',
    Documento: '801.231.489-79',
    pracaExperiencia: 'PE,PR',
    fotoMotorista:'img_motorista.jpeg',
};
const Motorista7 = {
    id: '6',
    Name: 'Lucas de Ferney',
    Idade: '22',
    Documento: '801.432.867-79',
    pracaExperiencia: 'GO,MT',
    fotoMotorista:'img_motorista.jpeg',
};
const Motorista8 = {
    id: '7',
    Name: 'Marcus Ramiro',
    Idade: '45',
    Documento: '343.432.489-79',
    pracaExperiencia: 'DF,PR',
    fotoMotorista:'img_motorista.jpeg',
};
const Motorista9= {
    id: '8',
    Name: 'Casimiro ou naomiro',
    Idade: '78',
    Documento: '801.432.999-79',
    pracaExperiencia: 'SC,BA',
    fotoMotorista:'img_motorista.jpeg',
};
const Motorista10 = {
    id: '9',
    Name: 'Joao Pedro Antonio',
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

function loadLibrary(){
    pagebody.innerHTML = '';
    for(let index = 0; index < motoristas.length; index ++){
        pagebody.innerHTML += `
        <div class="card d-flex flex-column align-items-center" style="width: 18rem; height: 40rem">
            <img src="dist/img/${motoristas[index].fotoMotorista}" class="card-img-top" style= "width: 18rem; height: 225px" alt="Foto Motorista">
            <div class="card-body d-flex flex-column ">
                <h5 class="card-title border-top border-dark">NOME:</h5>
                <p class="border-bottom border-dark">${motoristas[index].Name}</p>
                <h5 class="card-text border-top border-dark">IDADE</h5>
                <p class="border-bottom border-dark">${motoristas[index].Idade}</p>
                <h5 class="card-text border-top border-dark">DOCUMENTO</h5>
                <p class="border-bottom border-dark">${motoristas[index].Documento}</p>
                <h5 class="card-text border-top border-dark">PRAÇA DE EXPERIENCIA</h5>
                <p class="border-bottom border-dark">${motoristas[index].pracaExperiencia}</p>
                <div class="d-flex justify-content-between">
                    <button  class="btn btn-outline-primary">Adicionar Rota<i class="bi bi-geo-alt"></i></button>
                    <button  class="btn btn-outline-primary">Editar Motorista<i class="bi bi-person-gear"></i></button>
                </div>
            </div>
        </div>
        `;
    }
}

loadLibrary();