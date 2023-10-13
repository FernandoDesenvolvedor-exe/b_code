#delete from usuarios;
#delete from turma;
#delete from materia_prima;
#delete from tipo_materia_prima;
#delete from classe_material;

INSERT INTO `turma` (`idTurma`, `turno`, `nomeTurma`, `ativo`) VALUES
(1, 'N', 'T DESI 2022', 'S');

INSERT INTO `usuarios` (`login`, `senha`, `nome`, `sobrenome`, `idTurma`, `tipo`, `ativo`) VALUES
('a@teste.com', '202cb962ac59075b964b07152d234b70', 'Luis', 'Fernando Pereira', 1, 1, 'S'),
('b@teste.com', '202cb962ac59075b964b07152d234b70', 'Marco', 'dos Santos', 1, 2, 'S'),
('c@teste.com', '202cb962ac59075b964b07152d234b70', 'Teste', 'Testudo de teste', 1, 2, 'N');

INSERT INTO `tipo_materia_prima` (`descricao`) VALUES
('Virgem'),
('Reciclado'),
('Remoido'),
('Scrap');

INSERT INTO `classe_material` (`descricao`) VALUES
('Comodities'),
('Engenharia');

INSERT INTO `materia_prima` (`idClasse`, `idTipoMateria`, `descricao`, `quantidade`) VALUES
(1, 2, 'plastico', 500),
(1, 1, 'Polistileno', 300),
(2, 4, 'Polioneto de carbonato', 400),
(1, 3, 'Sódio', 200),
(2, 1, 'Polistileno', 100),
(2, 3, 'Exopor', 50),
(1, 1, 'Java', 1);
