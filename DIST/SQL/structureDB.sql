# localhost/phpmyadmin/
# C:\xampp\htdocs\SA
# localhost/SA/login.php

/*
_ORDEM DE CRIAÇÃO_
turmas
usuarios
maquinas
tipoferramental
produtos
pedidos
ferramental
ferramental_maquinas
produtos_maquinas
fornecedores
tipopigmentos
pigmentos
pigmentos_fornecedores
tipomaterial
classematerial
materiaprima
materiaprima_pigmentos
materiaprima_fornecedores
receitas
*/

create database LabPlasticos;

use LabPlasticos;

create table turmas(
    idTurma int(11) primary key auto-increment,
    turno varchar(40) not null,
    statusTurma int(2) not null 
);

create table usuarios(
    idUsuario int(11) primary key auto_increment,
    matricula varchar(11) not null,
    senha varchar(8) not null,
    nome varchar(30) not null,
    tipo int(1) not null,
    ativo int(1) not null,
    turmas_idTurma int not null,
    CONSTRAINT turmas
    FOREIGN KEY (turmas_idTurma)
    REFERENCES LabPlasticos.turmas(idTurma)
);

create table maquinas(
    idMaquina int(11) primary key auto-increment,
    descricao varchar(80) not null
);

create table tipoFerramental(
    idTipoFerramental int(11) primary key auto_increment,
    descricao varchar(80) not null
);


create table produtos(
    idProduto int(11) primary key auto_increment,
    descricao varchar(80) not null
);

create table ferramental(
    idMolde int(11) primary key auto_increment,
    descricao varchar(80) not null,
    tipoFerramental_idTipoFerramental int not null,
    produtos_idProduto int not null,
    CONSTRAINT tipoFerramental
    FOREIGN KEY (tipoFerramental_idTipoFerramental) 
    REFERENCES LabPlasticos.tipoFerramental(idTipoFerramental),
    CONSTRAINT produtos
    FOREIGN KEY (produtos_idProduto)
    REFERENCES LabPlasticos.produtos(idProduto)

);

create table ferramental_maquina(
    descricao varchar(80) not null,
    maquinas_idMaquina int not null,
    ferramental_idMolde int not null,
    CONSTRAINT maquinas
    FOREIGN KEY (maquinas_idMaquina)
    REFERENCES LabPlasticos.maquinas(idMaquina),
    CONSTRAINT ferramental
    FOREIGN KEY (ferramental_idMolde)
    REFERENCES LabPlasticos.ferramental(idMolde),
    primary key(maquinas_idMaquina, ferramental_idMolde)
);

create table produtos_maquinas(
    descricao varchar(80) not null,
    produtos_idProduto int not null,
    maquinas_idMaquina int not null,
    CONSTRAINT produtos
    FOREIGN KEY (produtos_idProduto)
    REFERENCES LabPlasticos.produtos(idProduto),
    CONSTRAINT maquinas
    FOREIGN KEY (maquinas_idMaquina)
    REFERENCES LabPlasticos.maquinas(idMaquina),
    primary key (produtos_idProduto, maquinas_idMaquina)
);

create table fornecedores(
    idFornecedor int(11) primary key auto_increment,
    descricao varchar(80) not null,
    ativo int(1) not null
);

create table tipoPigmentos(
    idTipoPigmento int(11) primary key auto_increment,
    descricao varchar(80) not null
);

create table pigmentos(
    idPigmento int(11) primary key auto_increment,
    descricao varchar(80),
    tipoPigmentos_idTipoPigmento int not null,
    CONSTRAINT tipoPigmentos
    FOREIGN KEY (tipoPigmentos_idTipoPigmento)
    REFERENCES LabPlasticos.tipoPigmentos(idTipoPigmento)
);

create table pigmentos_fornecedores(
    descricao varchar(80) not null,
    fornecedores_idFornecedor int not null,
    pigmentos_idPigmento int not null,
    CONSTRAINT fornecedores
    FOREIGN KEY (fornecedores_idFornecedor)
    REFERENCES LabPlasticos.fornecedores(idFornecedor),
    CONSTRAINT pigmentos
    FOREIGN KEY (pigmentos_idPigmento)
    REFERENCES LabPlasticos.pigmentos(idPigmento),
    primary key (fornecedores_idFornecedor, pigmentos_idPigmento)
);

create table tipoMaterial(
    idTipoMaterial int(11) primary key auto_increment,
    descricao varchar(80) not null
);

create table classeMaterial(
    idClasseMaterial int(11) primary key auto_increment,
    descricao varchar(80) not null
);

create table materiaPrima(
    idMateriaPrima int(11) primary key auto_increment,
    descricao varchar(80) not null,
    tipoMaterial_idTipoMaterial int not null,
    classeMaterial_idClasseMaterial int not null,
    CONSTRAINT tipoMaterial
    FOREIGN KEY (tipoMaterial_idTipoMaterial)
    REFERENCES LabPlasticos.tipoMaterial(idTipoMaterial),
    CONSTRAINT classeMaterial
    FOREIGN KEY (classeMaterial_idClasseMaterial)
    REFERENCES LabPlasticos.classeMaterial(idClasseMaterial)
);

create table materiaPrima_pigmentos(
    descricao varchar(80) not null,
    materiaPrima_idMateriaPrima int not null,
    pigmentos_idPigmento int not null,
    CONSTRAINT materiaPrima
    FOREIGN KEY (materiaPrima_idMateriaPrima)
    REFERENCES LabPlasticos.materiaPrima(idMateriaPrima),
    CONSTRAINT pigmentos
    FOREIGN KEY (pigmentos_idPigmento)
    REFERENCES LabPlasticos.pigmentos(idPigmento),
    primary key (materiaPrima_idMateriaPrima, pigmentos_idPigmento)
);

create table materiaPrima_fornecedores(
    descricao varchar(80) not null,
    materiaPrima_idMateriaPrima int not null,
    fornecedores_idFornecedor int not null,
    CONSTRAINT materiaPrima
    FOREIGN KEY (materiaPrima_idMateriaPrima)
    REFERENCES LabPlasticos.materiaPrima(idMateriaPrima),
    CONSTRAINT fornecedores
    FOREIGN KEY (fornecedores_idFornecedor)
    REFERENCES LabPlasticos.fornecedores(idFornecedor),
    primary key (materiaPrima_idMateriaPrima, fornecedores_idFornecedor)
);



create table receitas(
    descricao varchar(80) not null,
    materiaPrima_idMateriaPrima int not null,
    produtos_idProduto int not null,
    CONSTRAINT materiaPrima
    FOREIGN KEY (materiaPrima_idMateriaPrima)
    REFERENCES LabPlasticos.materiaPrima(idMateriaPrima),
    CONSTRAINT produtos
    FOREIGN KEY (produtos_idProduto)
    REFERENCES LabPlasticos.produtos(idProduto),
    primary key (materiaPrima_idMateriaPrima, produtos_idProduto)
);


create table pedidos(
    idPedido int(11) primary key auto_increment,
    data date not null,
    hora time not null,
    status varchar(50) not null,
    observações varchar(100) not null,
    produtos_idProduto int not null,
    usuarios_idUsuario int not null,
    CONSTRAINT produtos
    FOREIGN KEY (produtos_idProduto)
    REFERENCES LabPlasticos.produtos(idProduto),
    primary key (materiaPrima_idMateriaPrima, produtos_idProduto),
    CONSTRAINT usuarios
    FOREIGN KEY (usuarios_idUsuario)
    REFERENCES LabPlasticos.usuarios(idUsuario)
);





/*
No pedido como sabe o pigmento do produto? A materia prima? O molde?

Exemplos chaves extrangeiras

__Relação: N para N__

CREATE TABLE lolja.produtos_has_vendas(
produtos_id_produto INT NOT NULL,
vendas_id_venda INT NOT NULL,
CONSTRAINT prod_vend FOREIGN KEY (produtos_id_produto) REFERENCES lolja.produtos(id_produto),
CONSTRAINT vend_prod FOREIGN KEY (vendas_id_venda) REFERENCES lolja.vendas(id_venda),
quantidade INT NOT NULL,
PRIMARY KEY(produtos_id_produto,vendas_id_venda)
);
OBS: chave primaria é as extrangeiras provenientes das duas tabelas



__Relação: 1 para N__

CREATE TABLE lolja.vendas(
id_venda INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
data_venda DATE NOT NULL,
clientes_cpf BIGINT(11) NOT NULL,
CONSTRAINT ven_cli FOREIGN KEY (clientes_cpf)
REFERENCES lolja.clientes(cpf)
); 
OBS: chave primaria é da propia tabela

*/
