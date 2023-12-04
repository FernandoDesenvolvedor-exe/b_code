
INSERT INTO `classe_material` (`idClasse`, `descricao`, `ativo`) VALUES
(1, 'Comodities', 1),
(2, 'Engenharia', 1);

INSERT INTO `ferramental` (idFerramental, descricao, ativo, idTiposFerramental, idProduto) VALUES
(1, 'CAPCEL84854', 1, 1, 1),
(2, 'BEQ51848', 1, 1, 2),
(3, 'LIX1246317', 1, 1, 3);

INSERT INTO `fornecedores` (`idFornecedor`, `descricao`, `ativo`) VALUES
(1, 'COLORFIX', 1),
(2, 'CRISTAL MASTER', 1),
(3, 'QUIMIDROL', 1),
(4, 'QUIMIOTEC', 1),
(5, 'EMBRACO', 0),

INSERT INTO `historico_pedidos` (`idHistorico`, `nomeUsuario`, `tipoUsuario`, `turma`, `turno`, `idPedido`, `materiaPrima`, `tipoMateria_prima`, `classeMateria_prima`, `fornecedorMateria_Prima`, `pigmento`, `tipoPigmento`, `codigo`, `lote`, `fornecedorPigmento`, `produto`, `ferramental`, `tipoFerramental`, `maquina`, `producaoPrevista`, `refugo`, `producaoRealizada`, `quantidadeMateria_prima`, `quantidadePigmento`, `dataHora_aberto`, `dataHora_producao`, `dataHora_fechado`, `dataHora_alterado`, `statusPedido`, `obsPedido`) VALUES
(1, 'adm adm', 1, '', '', 1, 'Poliéster', 'Virgem', 'Comodities', 'QUIMIOTEC', 'Amarelo', 'MTB', '', 0, 'COLORFIX', 'Béquer', 'BEQ51848', 'Aluminio', 'VF - 29', 50, NULL, NULL, 150, 50, '2023-12-04 14:29:56', '2023-12-04 14:33:51', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '2', '');

INSERT INTO `maquinas` (`idMaquina`, `descricao`, `ativo`, `observacoes`) VALUES
(1, 'VF - 32', 1, ''),
(2, 'VF - 35', 0, ''),
(3, 'VF - 44', 1, ''),
(4, 'VF - 29', 1, '');

INSERT INTO `materia_fornecedor` (`idMateriaPrima`, `idFornecedor`) VALUES
(1, 2),
(2, 5),
(8, 2),
(9, 5);

INSERT INTO `materia_pigmento` (`idMateriaPrima`, `idPigmento`) VALUES
(1, 4),
(1, 5),
(3, 4),
(5, 4),
(5, 5),
(8, 1),
(8, 4),
(9, 4),
(9, 5);


INSERT INTO `materia_prima` (`idMateriaPrima`, `idClasse`, `idTipoMateriaPrima`, `descricao`, `quantidade`, `ativo`, `observacoes`) VALUES
(1, 1, 2, 'plastico', 500, 0, NULL),
(2, 1, 1, 'Polistileno', 500, 0, NULL),
(3, 2, 4, 'Polioneto de carbonato', 500, 0, NULL),
(4, 1, 3, 'Sódio', 500, 0, NULL),
(5, 2, 1, 'Polistileno', 500, 1, NULL),
(6, 2, 3, 'Exopor', 500, 0, NULL),
(7, 1, 1, 'Java', 500, 0, NULL),
(8, 1, 1, 'Etil-benzeno', 500, 1, 'Não usar sem autorização do professor '),
(9, 1, 1, 'Poliéster', 500, 1, '');

--
-- Extraindo dados da tabela `pedidos`
--

INSERT INTO `pedidos` (`idPedido`, `idUsuario`, `idReceita`, `idMaquina`, `dataHora_aberto`, `dataHora_producao`, `dataHora_fechado`, `status`, `observacoes`, `refugo`, `producaoPrevista`, `producaoRealizada`) VALUES
(1, 89, 8, 4, '2023-12-04 14:29:56', '2023-12-04 14:33:51', NULL, 2, '', NULL, 50, NULL);

-- --------------------------------------------------------


--
-- Extraindo dados da tabela `pigmentos`
--

INSERT INTO `pigmentos` (`idPigmento`, `descricao`, `idTipoPigmento`, `quantidade`, `codigo`, `lote`, `ativo`, `observacoes`) VALUES
(1, 'Verde claro', 1, 200, '5415466', 'B/656482', 0, ''),
(2, 'Azul escuro', 2, 245, '48684Ad874', 'C/64882', 0, ''),
(3, 'Vermelho', 1, 300, '94686545', 'A/48654', 0, ''),
(4, 'Amarelo', 2, -1155, '', '', 1, ''),
(5, 'Roxo', 1, -1465, 'SDDES496-7', '9598D', 1, '');

-- --------------------------------------------------------


--
-- Extraindo dados da tabela `pigmento_fornecedor`
--

INSERT INTO `pigmento_fornecedor` (`idPigmento`, `idFornecedor`) VALUES
(4, 1),
(5, 2);

-- --------------------------------------------------------


--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`idProduto`, `descricao`, `peso`, `imagem`, `ativo`) VALUES
(1, 'Capa de celular', 15, 'dist/img/6a1cb27f23349ecd35c9f3894556b28b.png', 1),
(2, 'Béquer', 4, 'dist/img/8667e7985a0a448473a07fdc4db88495.webp', 1),
(3, 'Lixeira vermelha', 600, 'dist/img/5c3da83b5b1d90301622553e03fc01e4.jpg', 1);


----------------------------------------------------------------


--
-- Extraindo dados da tabela `receitas`
--

INSERT INTO `receitas` (`idReceita`, `idProduto`, `idPigmento`, `quantidadePigmento`, `observacoes`, `ativo`) VALUES
(1, 12, 5, 15, NULL, 1),
(2, 13, 4, 5, NULL, 1),
(3, 13, 5, 5, NULL, 1),
(4, 2, 4, 1, NULL, 1),
(8, 2, 4, 1, NULL, 1);

-- --------------------------------------------------------


--
-- Extraindo dados da tabela `receita_materia_prima`
--

INSERT INTO `receita_materia_prima` (`idReceita`, `idMateriaPrima`, `quantidadeMaterial`) VALUES
(1, 8, 30),
(2, 8, 15),
(2, 9, 15),
(3, 2, 45),
(8, 9, 3);

-- --------------------------------------------------------

--
-- Extraindo dados da tabela `tipos_ferramental`
--

INSERT INTO `tipos_ferramental` (`idTiposFerramental`, `descricao`, `ativo`) VALUES
(1, 'Aluminio', 1),
(2, 'Aço', 1),
(3, 'Madeira', 1),
(4, 'Pedra', 1);

-- --------------------------------------------------------

--
-- Extraindo dados da tabela `tipo_materia_prima`
--

INSERT INTO `tipo_materia_prima` (`idTipoMateriaPrima`, `descricao`, `ativo`) VALUES
(1, 'Virgem', 1),
(2, 'Reciclado', 1),
(3, 'Remoido', 1),
(4, 'Scrap', 1);


--------------------------------------------------------------------------------

--
-- Extraindo dados da tabela `tipo_pigmentos`
--

INSERT INTO `tipo_pigmentos` (`idTipoPigmento`, `descricao`, `ativo`) VALUES
(1, 'MB', 1),
(2, 'MTB', 1);

-- --------------------------------------------------------

--
-- Extraindo dados da tabela `turma`
--

INSERT INTO `turma` (`idTurma`, `turno`, `nomeTurma`, `ativo`) VALUES
(1, 'N', 'T DESI 2022', 0),
(2, 'M', 'Estilos de Moda', 0),
(3, 'V', 'Mecânica', 0);

-- --------------------------------------------------------

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idUsuario`, `login`, `senha`, `nome`, `sobrenome`, `idTurma`, `tipo`, `ativo`) VALUES
(1, 'adm@adm.com', '202cb962ac59075b964b07152d234b70', 'Adm', 'Adm', NULL, 1, 0),
(2, 'a@teste.com', '202cb962ac59075b964b07152d234b70', 'Luis', 'Fernando Pereira', NULL, 1, 0),
(3, 'b@teste.com', '202cb962ac59075b964b07152d234b70', 'Marco', 'dos Santos', 1, 2, 1),
(4, 'c@teste.com', '202cb962ac59075b964b07152d234b70', 'Teste', 'Testudo de teste', 1, 2, 1),
(5, 'adm1@adm.com', '81dc9bdb52d04dc20036dbd8313ed055', 'adm', 'adm', NULL, 1, 1),
(6, 'ad@ad.v', '81dc9bdb52d04dc20036dbd8313ed055', 'daniel', 'dani', 2, 2, 1),
(7, 'joao@teste.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Joao', 'cacilds', 3, 2, 1),
(8, 'da@dada.da', '81dc9bdb52d04dc20036dbd8313ed055', 'da', 'da', NULL, 1, 1);

--------------------------------------------------------------------------------------------------