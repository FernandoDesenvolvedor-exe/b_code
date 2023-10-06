drop database lab_plasticos;
create database lab_plasticos;
use lab_plasticos;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `estoque`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `classe_material`
--

CREATE TABLE `classe_material` (
  `idClasse` int(11) NOT NULL COMMENT 'PK - chave identificadora que guarda a id de cada classe da matéria prima',
  `descricao` varchar(32) COLLATE utf8_bin NOT NULL COMMENT 'Descrição da classe da matéria prima(comodities, engenharia)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Registro da classe associada a uma matéria prima';

-- --------------------------------------------------------

--
-- Estrutura da tabela `ferramental`
--

CREATE TABLE `ferramental` (
  `idFerramental` int(11) NOT NULL COMMENT 'PK - chave identificadora da tabela ferramental.',
  `idProduto` int(11) NOT NULL COMMENT 'FK - chave estrangeira que irá identificar o produto relacionado ao ferramental usado.',
  `idTipoFerramental` int(11) NOT NULL COMMENT 'FK - chave estrangeira que irá relacionar o tipo de ferramenta com o ferramental.',
  `descricao` varchar(80) COLLATE utf8_bin NOT NULL COMMENT 'Descrição do ferramental usado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela com os registros do ferramental usado na receita';

-- --------------------------------------------------------

--
-- Estrutura da tabela `ferramental_maquinas`
--

CREATE TABLE `ferramental_maquinas` (
  `idFerramentalMaquina` int(11) NOT NULL COMMENT 'PK - chave identificadora da tabela associativa ferramental_maquinas',
  `idFerramental` int(11) NOT NULL COMMENT 'FK - chave estrangeira que registra o ferramental usado na relação ferramental/maquina',
  `idMaquina` int(11) NOT NULL COMMENT 'FK - chave estrangeira que registra o id da maquina usada na relação ferramental/maquina',
  `descricao` int(11) DEFAULT NULL COMMENT 'Uma observação do processo não obrigatória.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='tabela associativa resultante de relação muitos pra muitos';

-- --------------------------------------------------------

--
-- Estrutura da tabela `maquinas`
--

CREATE TABLE `maquinas` (
  `idMaquina` int(11) NOT NULL COMMENT 'PK - chave identificadora das maquinas usadas para fazer os produtos',
  `decricao` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'descrição da maquina registrada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela para registro das maquinas a serem usadas na receita';

-- --------------------------------------------------------

--
-- Estrutura da tabela `materia_pigmentos`
--

CREATE TABLE `materia_pigmentos` (
  `idMaterialPigmento` int(11) NOT NULL COMMENT 'PK - codigo identificador da tebela materia_pigmentos',
  `idMateriaPrima` int(11) NOT NULL COMMENT 'FK - chave estrangeira da tabela materiaPrima',
  `idPigmento` int(11) NOT NULL COMMENT 'FK - chave estrangeira da tabela do pigmento',
  `descricao` varchar(80) NOT NULL COMMENT 'descricao da materia_pigmentos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='tabela com as relações permitidas entre materia e pigmento';

-- --------------------------------------------------------

--
-- Estrutura da tabela `materia_prima`
--

CREATE TABLE `materia_prima` (
  `idMateriaPrima` int(11) NOT NULL COMMENT 'PK - chave identificadora das matérias primas salvas no estoque ',
  `idClasse` int(11) NOT NULL COMMENT 'FK - chave estrangeira que identifica a classe da matéria prima(comodities e engenharia) ',
  `idTipoMateria` int(11) NOT NULL COMMENT 'FK - chave estrangeira que identifica o tipo de matéria prima(virgem, reciclado, remoido, scrap). ',
  `descricao` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'Descrição da matéria prima(Nome). '
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Salva os registros de Cadastros e alterações no estoque';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pedidos`
--

CREATE TABLE `pedidos` (
  `idPedido` int(11) NOT NULL COMMENT 'PK - chave identificadora da tabela Pedidos.',
  `idProduto` int(11) NOT NULL COMMENT 'FK - Chave estrangeira para identificar qual o produto relacionado ao pedido',
  `idUsuario` int(11) NOT NULL COMMENT 'FK - Chave estrangeira para identificar qual o usuário abriu o pedido',
  `DataHora_aberto` datetime NOT NULL COMMENT 'Salva a data e a hora em que o pedido foi aberto',
  `DataHora_fechado` datetime NOT NULL COMMENT 'Salva a data e a hora em que o pedido foi fechado',
  `Status` tinyint(1) NOT NULL COMMENT 'Identifica se um pedido está em aberto ou se ja foi fechado:\r\naberto(1);\r\nfechado(2)',
  `Observacoes` varchar(80) COLLATE utf8_bin DEFAULT NULL COMMENT 'Permite gravar observações sobre um pedido. Ex: \r\npedido feito programou 500g de matéria prima para fazer 500 copos mas acabou fazendo apenas 490 copos.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela que registra os pedidos feito pelo usuário';

-- --------------------------------------------------------

--
-- Estrutura da tabela `pigmentos`
--

CREATE TABLE `pigmentos` (
  `idPigmento` int(11) NOT NULL COMMENT 'PK - codigo identificador do pigmento',
  `descricao` varchar(80) NOT NULL COMMENT 'descricao do pigmento',
  `idTipoPigmento` int(11) NOT NULL COMMENT 'FK - tipo de pigmento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `idProduto` int(11) NOT NULL COMMENT 'PK - chave identificadora da tabela produtos, onde cada id representa um produto feito.',
  `decricao` varchar(80) COLLATE utf8_bin NOT NULL COMMENT 'descrição do produto feito'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela que identifica o produto feito ';

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos_maquinas`
--

CREATE TABLE `produtos_maquinas` (
  `idProduto_maquina` int(11) NOT NULL COMMENT 'PK - chave identificadora da tabela associativa produtos_maquinas. Mostra qual maquina esta sendo usada para qual produto',
  `idProduto` int(11) NOT NULL COMMENT 'FK - chave estrangeira que identifica qual produto uma maquina esta fazendo.',
  `idMaquina` int(11) NOT NULL COMMENT 'FK - chave estrangeira que identifica qual maquina esta realizando uma tarefa conforme indicada no pedido.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela associatica entre produtos e maquinas ';

-- --------------------------------------------------------

--
-- Estrutura da tabela `receita`
--

CREATE TABLE `receita` (
  `idReceita` int(11) NOT NULL COMMENT 'PK - chave identificadora da relação da do produto e as matérias primas.',
  `idProduto` int(11) NOT NULL COMMENT 'Fk - chave estrangeira que identifica o produto usado relacionado com a matéria prima',
  `idMateriaPrima` int(11) NOT NULL COMMENT 'Fk - chave estrangeira que identifica o matéria prima usada relacionado com o produto.',
  `descricao` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT 'Descrição da situação onde as duas ids de produto e matéria prima se relacionam'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela que registra a relação de um produto com uma matéria ';

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos_ferramental`
--

CREATE TABLE `tipos_ferramental` (
  `idTipoFerramental` int(11) NOT NULL COMMENT 'PK - chave identificadora dos registros salvos em tiposFerramental.',
  `descricao` int(11) NOT NULL COMMENT 'Descrição dos tipos de ferramental.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela com os registros dos tipos de Ferramental dos moldes ';

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_materia_prima`
--

CREATE TABLE `tipo_materia_prima` (
  `idTipoMateriaPrima` int(11) NOT NULL COMMENT 'PK - chave identificadora de id dos tipos de matéria prima',
  `descricao` varchar(32) COLLATE utf8_bin NOT NULL COMMENT 'Descrição dos tipos de matéria prima(virgem, reciclado, remoído, scrap);'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela identificadora dos tipos de matéria prima ';

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_pigmentos`
--

CREATE TABLE `tipo_pigmentos` (
  `idTipoPigmento` int(11) NOT NULL COMMENT 'PK - codigo identificador dos tipos de pigmentos',
  `descricao` varchar(80) NOT NULL COMMENT 'descricao do tipo pigmento'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `turma`
--

CREATE TABLE `turma` (
  `idTurma` int(11) NOT NULL COMMENT 'PK - chave identificadora da turma a qual o usuário pertence\r\nOBS: o admin não necessita estar em uma turma',
  `turno` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT 'Mostra a qual turno uma turma pertence',
  `nomeTurma` varchar(32) COLLATE utf8_bin DEFAULT NULL COMMENT 'Nome da turma. \r\nEx: TDesi Senai/N1',
  `ativo` char(1) COLLATE utf8_bin DEFAULT NULL COMMENT 'Se a conta podea ou não pode ser usada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela que salva as informações sobre a turma dos usuários ';

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idUsuario` int(11) NOT NULL COMMENT 'Pk - Chave identificadora dos usuários que farão uso do sistema',
  `login` varchar(50) COLLATE utf8_bin NOT NULL COMMENT 'Identificação de login do usuário',
  `senha` varchar(32) COLLATE utf8_bin NOT NULL COMMENT 'Senha de acesso ao sistema para o usuário.',
  `nome` varchar(80) COLLATE utf8_bin NOT NULL COMMENT 'Nome do usuário.',
  `idTurma` int(11) NOT NULL COMMENT 'FK - Chave estrangeira da tabela turma que permite ver a qual turma um usuário está cadastrado.',
  `tipo` tinyint(1) NOT NULL COMMENT 'Nível de acesso dos usuários:\r\nadministrador(1);\r\nusuário comum(2).  ',
  `ativo` char(1) COLLATE utf8_bin NOT NULL COMMENT 'Serve para ver se uma conta ainda está ativa.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela de registro dos usuários cadastrados  no sistema';

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `classe_material`
--
ALTER TABLE `classe_material`
  ADD PRIMARY KEY (`idClasse`);

--
-- Índices para tabela `ferramental`
--
ALTER TABLE `ferramental`
  ADD PRIMARY KEY (`idFerramental`),
  ADD KEY `FK_idProduto` (`idProduto`) USING BTREE,
  ADD KEY `FK_idTipoFerramental` (`idTipoFerramental`) USING BTREE;

--
-- Índices para tabela `ferramental_maquinas`
--
ALTER TABLE `ferramental_maquinas`
  ADD PRIMARY KEY (`idFerramentalMaquina`),
  ADD KEY `FK_idMaquina` (`idMaquina`) USING BTREE,
  ADD KEY `FK_idFerramental` (`idFerramental`) USING BTREE;

--
-- Índices para tabela `maquinas`
--
ALTER TABLE `maquinas`
  ADD PRIMARY KEY (`idMaquina`);

--
-- Índices para tabela `materia_pigmentos`
--
ALTER TABLE `materia_pigmentos`
  ADD PRIMARY KEY (`idMaterialPigmento`),
  ADD KEY `FK_idPigmento` (`idPigmento`),
  ADD KEY `FK_idMateriaPrima` (`idMateriaPrima`);

--
-- Índices para tabela `materia_prima`
--
ALTER TABLE `materia_prima`
  ADD PRIMARY KEY (`idMateriaPrima`),
  ADD KEY `FK_idClasse` (`idClasse`) USING BTREE,
  ADD KEY `FK_idTipoMateria` (`idTipoMateria`);

--
-- Índices para tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`idPedido`),
  ADD KEY `FK_idUsuario` (`idUsuario`),
  ADD KEY `FK_idProduto` (`idProduto`);

--
-- Índices para tabela `pigmentos`
--
ALTER TABLE `pigmentos`
  ADD PRIMARY KEY (`idPigmento`),
  ADD KEY `FK_idTipoPigmento` (`idTipoPigmento`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`idProduto`);

--
-- Índices para tabela `produtos_maquinas`
--
ALTER TABLE `produtos_maquinas`
  ADD PRIMARY KEY (`idProduto_maquina`),
  ADD KEY `FK_idProduto` (`idProduto`),
  ADD KEY `FK_idMaquina` (`idMaquina`) USING BTREE;

--
-- Índices para tabela `receita`
--
ALTER TABLE `receita`
  ADD PRIMARY KEY (`idReceita`),
  ADD KEY `FK_idProduto` (`idProduto`),
  ADD KEY `FK_idMateriaPrima` (`idMateriaPrima`);

--
-- Índices para tabela `tipo_materia_prima`
--
ALTER TABLE `tipo_materia_prima`
  ADD PRIMARY KEY (`idTipoMateriaPrima`);
  
alter table `tipos_ferramental`
  ADD PRIMARY KEY (`idTipoFerramental`);
--
-- Índices para tabela `tipo_pigmentos`
--
ALTER TABLE `tipo_pigmentos`
  ADD PRIMARY KEY (`idTipoPigmento`);

--
-- Índices para tabela `turma`
--
ALTER TABLE `turma`
  ADD PRIMARY KEY (`idTurma`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idUsuario`),
  ADD KEY `FK_idTurma` (`idTurma`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `classe_material`
--
ALTER TABLE `classe_material`
  MODIFY `idClasse` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora que guarda a id de cada classe da matéria prima';

--
-- AUTO_INCREMENT de tabela `ferramental`
--
ALTER TABLE `ferramental`
  MODIFY `idFerramental` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora da tabela ferramental.';

--
-- AUTO_INCREMENT de tabela `ferramental_maquinas`
--
ALTER TABLE `ferramental_maquinas`
  MODIFY `idFerramentalMaquina` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora da tabela associativa ferramental_maquinas';

--
-- AUTO_INCREMENT de tabela `maquinas`
--
ALTER TABLE `maquinas`
  MODIFY `idMaquina` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora das maquinas usadas para fazer os produtos';

--
-- AUTO_INCREMENT de tabela `materia_pigmentos`
--
ALTER TABLE `materia_pigmentos`
  MODIFY `idMaterialPigmento` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - codigo identificador da tebela materia_pigmentos';

--
-- AUTO_INCREMENT de tabela `materia_prima`
--
ALTER TABLE `materia_prima`
  MODIFY `idMateriaPrima` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora das matérias primas salvas no estoque ';

--
-- AUTO_INCREMENT de tabela `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `idPedido` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora da tabela Pedidos.';

--
-- AUTO_INCREMENT de tabela `pigmentos`
--
ALTER TABLE `pigmentos`
  MODIFY `idPigmento` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - codigo identificador do pigmento';

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora da tabela produtos, onde cada id representa um produto feito.';

--
-- AUTO_INCREMENT de tabela `produtos_maquinas`
--
ALTER TABLE `produtos_maquinas`
  MODIFY `idProduto_maquina` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora da tabela associativa produtos_maquinas. Mostra qual maquina esta sendo usada para qual produto';

--
-- AUTO_INCREMENT de tabela `receita`
--
ALTER TABLE `receita`
  MODIFY `idReceita` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora da relação da do produto e as matérias primas.';

--
-- AUTO_INCREMENT de tabela `tipo_materia_prima`
--
ALTER TABLE `tipo_materia_prima`
  MODIFY `idTipoMateriaPrima` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora de id dos tipos de matéria prima';

--
-- AUTO_INCREMENT de tabela `tipo_pigmentos`
--
ALTER TABLE `tipo_pigmentos`
  MODIFY `idTipoPigmento` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - codigo identificador dos tipos de pigmentos';

--
-- AUTO_INCREMENT de tabela `turma`
--
ALTER TABLE `turma`
  MODIFY `idTurma` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora da turma a qual o usuário pertence\r\nOBS: o admin não necessita estar em uma turma';

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Pk - Chave identificadora dos usuários que farão uso do sistema';

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `ferramental`
ALTER TABLE `usuarios`
  ADD CONSTRAINT `turma_ibfk_1` FOREIGN KEY (`idTurma`) REFERENCES `turma` (`idTurma`);
  

ALTER TABLE `ferramental`
  ADD CONSTRAINT `ferramental_ibfk_1` FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`idProduto`),
  ADD CONSTRAINT `ferramental_ibfk_2` FOREIGN KEY (`idTipoFerramental`) REFERENCES `tipos_ferramental` (`idTipoFerramental`);

--
-- Limitadores para a tabela `ferramental_maquinas`
--
ALTER TABLE `ferramental_maquinas`
  ADD CONSTRAINT `ferramental_maquinas_ibfk_1` FOREIGN KEY (`idFerramental`) REFERENCES `ferramental` (`idFerramental`),
  ADD CONSTRAINT `ferramental_maquinas_ibfk_2` FOREIGN KEY (`idMaquina`) REFERENCES `maquinas` (`idMaquina`);

--
-- Limitadores para a tabela `materia_pigmentos`
--
ALTER TABLE `materia_pigmentos`
  ADD CONSTRAINT `materia_pigmentos_ibfk_1` FOREIGN KEY (`idPigmento`) REFERENCES `pigmentos` (`idPigmento`),
  ADD CONSTRAINT `materia_pigmentos_ibfk_2` FOREIGN KEY (`idMateriaPrima`) REFERENCES `materia_prima` (`idMateriaPrima`);

--
-- Limitadores para a tabela `materia_prima`
--
ALTER TABLE `materia_prima`
  ADD CONSTRAINT `materia_prima_ibfk_1` FOREIGN KEY (`idClasse`) REFERENCES `classe_material` (`idClasse`),
  ADD CONSTRAINT `materia_prima_ibfk_2` FOREIGN KEY (`idTipoMateria`) REFERENCES `tipo_materia_prima` (`idTipoMateriaPrima`);

--
-- Limitadores para a tabela `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`idProduto`);

--
-- Limitadores para a tabela `produtos_maquinas`
--
ALTER TABLE `produtos_maquinas`
  ADD CONSTRAINT `produtos_maquinas_ibfk_1` FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`idProduto`),
  ADD CONSTRAINT `produtos_maquinas_ibfk_2` FOREIGN KEY (`idMaquina`) REFERENCES `maquinas` (`idMaquina`);

--
-- Limitadores para a tabela `receita`
--
ALTER TABLE `receita`
  ADD CONSTRAINT `receita_ibfk_1` FOREIGN KEY (`idProduto`) REFERENCES `produtos` (`idProduto`),
  ADD CONSTRAINT `receita_ibfk_2` FOREIGN KEY (`idMateriaPrima`) REFERENCES `materia_prima` (`idMateriaPrima`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
