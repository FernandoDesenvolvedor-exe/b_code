
--
-- Banco de dados: `lab_plasticos`
--


--
-- Despejando dados para a tabela `produtos`
--

INSERT INTO `produtos` (`idProduto`, `descricao`, `peso`, `imagem`, `ativo`) VALUES
(1, 'Lixeira vermelha', 600, 'dist/img/291522c169fa378218bbadc70382a935.jpg', 1),
(2, 'Garrafinha', 20, 'dist/img/55f6eeaae931694ffc7688ca02acafbf.jpg', 1),
(3, 'Galao', 120, 'dist/img/830efa3c5a7019425f7c21b66817b2b5.webp', 1),
(4, 'Copo plástico transparente', 2, 'dist/img/b59d0c0e1e92afab8c1b0ebb75f4c587.webp', 1);


--
-- Despejando dados para a tabela `tipo_materia_prima`
--

INSERT INTO `tipo_materia_prima` (`idTipoMateriaPrima`, `descricao`, `ativo`) VALUES
(1, '', 1),
(2, 'Virgem', 1),
(3, 'Reciclado', 1),
(4, 'Remoido', 1),
(5, 'Scrap', 1);

--
-- Despejando dados para a tabela `classe_material`
--

INSERT INTO `classe_material` (`idClasse`, `descricao`, `ativo`) VALUES
(1, '', 1),
(2, 'Comodities', 1),
(3, 'Engenharia', 1);


--
-- Despejando dados para a tabela `tipos_ferramental`
--

INSERT INTO `tipos_ferramental` (`idTiposFerramental`, `descricao`, `ativo`) VALUES
(1, 'Injetadas Auto.', 1),
(2, 'Injetadas Eletro.', 1),
(3, 'Injetadas Escolar', 1);

--
-- Despejando dados para a tabela `ferramental`
--

INSERT INTO `ferramental` (`idFerramental`, `descricao`, `ativo`, `idTiposFerramental`, `idProduto`) VALUES
(1, 'LIX81864', 1, 1, 1),
(2, 'GARR8484654', 1, 1, 2),
(3, 'GAL35921', 1, 2, 3),
(4, 'COP654841', 1, 3, 4);


--
-- Despejando dados para a tabela `fornecedores`
--

INSERT INTO `fornecedores` (`idFornecedor`, `descricao`, `ativo`) VALUES
(1, '', 1),
(2, 'COLORFIX', 1),
(3, 'CRISTAL MASTER', 1),
(4, 'ROYAL QUÍMICA', 1),
(5, 'SGS Polímeros', 1);

--
-- Despejando dados para a tabela `maquinas`
--

INSERT INTO `maquinas` (`idMaquina`, `descricao`, `ativo`, `observacoes`) VALUES
(1, 'VF - 32', 1, ''),
(2, 'VF - 35', 1, ''),
(3, 'VF - 44', 1, ''),
(4, 'VF - 29', 1, '');

--
-- Despejando dados para a tabela `materia_prima`
--

INSERT INTO `materia_prima` (`idMateriaPrima`, `idClasse`, `idTipoMateriaPrima`, `descricao`, `quantidade`, `ativo`, `observacoes`) VALUES
(1, 1, 1, '', 0, 1, '');

--
-- Despejando dados para a tabela `tipo_pigmentos`
--

INSERT INTO `tipo_pigmentos` (`idTipoPigmento`, `descricao`, `ativo`) VALUES
(1, '', 1),
(2, 'MB', 1),
(3, 'MTB', 1);

--
-- Despejando dados para a tabela `pigmentos`
--

INSERT INTO `pigmentos` (`idPigmento`, `descricao`, `idTipoPigmento`, `quantidade`, `codigo`, `lote`, `ativo`, `observacoes`) VALUES
(1, 'Nenhum', 1, 0, '0', '0', 1, '');


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
(1, 'Admin@LabPlasticos.com', '202cb962ac59075b964b07152d234b70', 'Luis', 'Fernando Pereira', NULL, 1, 1);

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