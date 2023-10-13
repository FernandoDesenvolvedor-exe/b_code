INSERT INTO `usuarios` (`idUsuario`, `login`, `senha`, `nome`, `sobrenome`, `idTurma`, `tipo`, `ativo`) VALUES
(1, 'a@teste.com', '202cb962ac59075b964b07152d234b70', 'Luis', 'Fernando Pereira', 1, 1, 'S'),
(2, 'b@teste.com', '202cb962ac59075b964b07152d234b70', 'Marco', 'dos Santos', 1, 2, 'S'),
(3, 'c@teste.com', '202cb962ac59075b964b07152d234b70', 'Teste', 'Testudo de teste', 1, 2, 'N');

INSERT INTO `turma` (`idTurma`, `turno`, `nomeTurma`, `ativo`) VALUES
(1, 'N', 'T DESI 2022', 'S');

INSERT INTO `tipo_materia_prima` (`idTipoMateriaPrima`, `descricao`) VALUES
(1, 'Virgem'),
(2, 'Reciclado'),
(3, 'Remoido'),
(4, 'Scrap');

INSERT INTO `materia_prima` (`idMateriaPrima`, `idClasse`, `idTipoMateriaPrima`, `descricao`, `quantidade`) VALUES
(1, 1, 2, 'plastico', 500),
(2, 1, 1, 'Polistileno', 300),
(3, 2, 4, 'Polioneto de carbonato', 400),
(4, 1, 3, 'Sódio', 200),
(5, 2, 1, 'Polistileno', 100),
(6, 2, 3, 'Exopor', 50),
(7, 1, 1, 'Java', 1);

INSERT INTO `classe_material` (`idClasse`, `descricao`) VALUES
(1, 'Comodities'),
(2, 'Engenharia');