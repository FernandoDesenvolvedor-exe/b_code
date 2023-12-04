
--
-- Banco de dados: `lab_plasticos`
--

--
-- Despejando dados para a tabela `classe_material`
--

INSERT INTO `classe_material` (`idClasse`, `descricao`, `ativo`) VALUES
(1, 'Comodities', 1),
(2, 'Engenharia', 1);

--
-- Despejando dados para a tabela `ferramental`
--

INSERT INTO `ferramental` (`idFerramental`, `descricao`, `ativo`, `idTiposFerramental`, `idProduto`) VALUES
(1, 'LIX81864', 1, 1, 1),
(2, 'GARR8484654', 1, 1, 2),
(3, 'GAL35921', 1, 2, 3),
(4, 'COP654841', 1, 3, 4);

--
-- Despejando dados para a tabela `ferramental_maquina`
--

INSERT INTO `ferramental_maquina` (`idFerramental`, `idMaquina`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(2, 2),
(2, 3),
(3, 4),
(4, 4);

--
-- Despejando dados para a tabela `fornecedores`
--

INSERT INTO `fornecedores` (`idFornecedor`, `descricao`, `ativo`) VALUES
(1, 'COLORFIX', 1),
(2, 'CRISTAL MASTER', 1),
(3, 'ROYAL QUÍMICA', 1),
(4, 'SGS Polímeros', 1);

--
-- Despejando dados para a tabela `maquinas`
--

INSERT INTO `maquinas` (`idMaquina`, `descricao`, `ativo`, `observacoes`) VALUES
(1, 'VF - 32', 1, ''),
(2, 'VF - 35', 1, ''),
(3, 'VF - 44', 1, ''),
(4, 'VF - 29', 1, '');

--
-- Despejando dados para a tabela `materia_fornecedor`
--

INSERT INTO `materia_fornecedor` (`idMateriaPrima`, `idFornecedor`) VALUES
(1, 2),
(2, 4),
(3, 3),
(4, 3);

--
-- Despejando dados para a tabela `materia_pigmento`
--

INSERT INTO `materia_pigmento` (`idMateriaPrima`, `idPigmento`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 2),
(2, 3),
(3, 1),
(3, 3),
(4, 1),
(4, 3);

--
-- Despejando dados para a tabela `materia_prima`
--

INSERT INTO `materia_prima` (`idMateriaPrima`, `idClasse`, `idTipoMateriaPrima`, `descricao`, `quantidade`, `ativo`, `observacoes`) VALUES
(1, 1, 1, 'Poliéster', 1800, 1, ''),
(2, 1, 1, 'Poliéster', 1800, 1, ''),
(3, 2, 1, 'Etil-Benzeno', 1600, 1, ''),
(4, 1, 2, 'Etil-Benzeno', 600, 1, '');

--
-- Despejando dados para a tabela `pigmentos`
--

INSERT INTO `pigmentos` (`idPigmento`, `descricao`, `idTipoPigmento`, `quantidade`, `codigo`, `lote`, `ativo`, `observacoes`) VALUES
(1, 'Azul', 1, 800, '3901.20.21', '', 1, ''),
(2, 'Amarelo', 2, 700, '3907.30', '', 1, ''),
(3, 'Vermelho', 1, 856, '3907301', '4539562169526', 1, '');

--
-- Despejando dados para a tabela `pigmento_fornecedor`
--

INSERT INTO `pigmento_fornecedor` (`idPigmento`, `idFornecedor`) VALUES
(1, 1),
(2, 2),
(3, 1);

--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`idProduto`, `descricao`, `peso`, `imagem`, `ativo`) VALUES
(1, 'Lixeira vermelha', 600, 'dist/img/291522c169fa378218bbadc70382a935.jpg', 1),
(2, 'Garrafinha', 20, 'dist/img/55f6eeaae931694ffc7688ca02acafbf.jpg', 1),
(3, 'Galao', 120, 'dist/img/830efa3c5a7019425f7c21b66817b2b5.webp', 1),
(4, 'Copo plástico transparente', 2, 'dist/img/b59d0c0e1e92afab8c1b0ebb75f4c587.webp', 1);

--
-- Despejando dados para a tabela `tipos_ferramental`
--

INSERT INTO `tipos_ferramental` (`idTiposFerramental`, `descricao`, `ativo`) VALUES
(1, 'Injetadas Auto.', 1),
(2, 'Injetadas Eletro.', 1),
(3, 'Injetadas Escolar', 1);

--
-- Despejando dados para a tabela `tipo_materia_prima`
--

INSERT INTO `tipo_materia_prima` (`idTipoMateriaPrima`, `descricao`, `ativo`) VALUES
(1, 'Virgem', 1),
(2, 'Reciclado', 1),
(3, 'Remoido', 1),
(4, 'Scrap', 1);

--
-- Despejando dados para a tabela `tipo_pigmentos`
--

INSERT INTO `tipo_pigmentos` (`idTipoPigmento`, `descricao`, `ativo`) VALUES
(1, 'MB', 1),
(2, 'MTB', 1);

--
-- Despejando dados para a tabela `turma`
--

INSERT INTO `turma` (`idTurma`, `turno`, `nomeTurma`, `ativo`) VALUES
(1, 'N', 'T DESI 2022', 1),
(2, 'M', 'Estilos de Moda', 1),
(3, 'V', 'Mecânica', 1);

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `login`, `senha`, `nome`, `sobrenome`, `idTurma`, `tipo`, `ativo`) VALUES
(1, 'adm@adm.com', '202cb962ac59075b964b07152d234b70', 'Adm', 'Adm', NULL, 1, 1),
(2, 'Luis@LabPlasticos.com.br', '202cb962ac59075b964b07152d234b70', 'Luis', 'Fernando Pereira', NULL, 1, 1),
(3, 'b@teste.com', '202cb962ac59075b964b07152d234b70', 'Marco', 'dos Santos', 1, 2, 1),
(4, 'c@teste.com', '202cb962ac59075b964b07152d234b70', 'Teste', 'sobrenome teste', 1, 2, 1),
(5, 'adm1@adm.com', '202cb962ac59075b964b07152d234b70', 'adm', 'adm', NULL, 1, 1),
(6, 'ad@ad.v', '202cb962ac59075b964b07152d234b70', 'daniel', 'dani', 2, 2, 1);

