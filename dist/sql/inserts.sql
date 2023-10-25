#delete from usuarios;
#delete from turma;
#delete from materia_prima;
#delete from tipo_materia_prima;
#delete from classe_material;
#delete from materia_prima;

#drop database lab_plasticos;
#create database lab_plasticos;
#use lab_plasticos;

INSERT INTO `tipo_pigmentos` (descricao,ativo) VALUES
('MB',1),
('MTB',1);

INSERT INTO `pigmentos` (descricao, idTipoPigmento, quantidade, codigo, lote,ativo,observacoes) VALUES
('Verde claro', 1, 200, '5415466','B/656482',1,''),
('Azul escuro', 2, 245, '48684Ad874','C/64882',1,''),
('Vermelho', 1, 300, '94686545','A/48654',1,''); 

INSERT INTO `turma` (`turno`, `nomeTurma`, `ativo`) VALUES
('N', 'T DESI 2022', 'S'),
('M','Estilos de Moda','S'),
('V','Mecânica','S');

INSERT INTO `usuarios` (`login`, `senha`, `nome`, `sobrenome`, `idTurma`, `tipo`, `ativo`) VALUES
('a@teste.com', '202cb962ac59075b964b07152d234b70', 'Luis', 'Fernando Pereira', 1, 1, 'S'),
('b@teste.com', '202cb962ac59075b964b07152d234b70', 'Marco', 'dos Santos', 1, 2, 'S'),
('c@teste.com', '202cb962ac59075b964b07152d234b70', 'Teste', 'Testudo de teste', 1, 2, 'N');

INSERT INTO `tipo_materia_prima` (`descricao`,ativo) VALUES
('Virgem',1),
('Reciclado',1),
('Remoido',1),
('Scrap',1);

INSERT INTO `classe_material` (`descricao`,ativo) VALUES
('Comodities',1),
('Engenharia',1);

INSERT INTO `materia_prima` (`idClasse`, `idTipoMateriaPrima`, `descricao`, `quantidade`,ativo) VALUES
(1, 2, 'plastico', 500,1),
(1, 1, 'Polistileno', 300,1),
(2, 4, 'Polioneto de carbonato', 400,1),
(1, 3, 'Sódio', 200,1),
(2, 1, 'Polistileno', 100,1),
(2, 3, 'Exopor', 50,1),
(1, 1, 'Java', 1,1);