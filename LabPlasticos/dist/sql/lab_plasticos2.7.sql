-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 04/12/2023 às 07:02
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

DROP DATABASE lab_plasticos;
CREATE DATABASE lab_plasticos;
USE lab_plasticos;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Banco de dados: lab_plasticos
--

-- --------------------------------------------------------

--
-- Estrutura para tabela classe_material
--

CREATE TABLE classe_material (
  idClasse int(11) NOT NULL COMMENT 'PK - chave identificadora que guarda a id de cada classe da matéria prima',
  descricao varchar(32) NOT NULL COMMENT 'Descrição da classe da matéria prima(comodities, engenharia)',
  ativo tinyint(1) NOT NULL COMMENT 'Verifica se a classe esta ativa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Registro da classe associada a uma matéria prima';

--
-- Despejando dados para a tabela classe_material
--

INSERT INTO classe_material (idClasse, descricao, ativo) VALUES
(1, 'Comodities', 1),
(2, 'Engenharia', 1),
(3, 'Retrabalho', 0),
(4, 'Retrabalho', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela ferramental
--

CREATE TABLE ferramental (
  idFerramental int(11) NOT NULL COMMENT 'PK - chave identificadora de IDs da tabela ferramental',
  descricao varchar(80) NOT NULL COMMENT 'Descrição de um ferramental(Nome)',
  ativo tinyint(1) NOT NULL COMMENT 'Registra se este item esta ativo',
  idTiposFerramental int(11) NOT NULL COMMENT 'FK - chave estrangeira da tabela tipos_ferramental',
  idProduto int(11) NOT NULL COMMENT 'FK - chave estrangeira da tabela produtos '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela que registra os dados do ferramental cadastrado';

--
-- Despejando dados para a tabela ferramental
--

INSERT INTO ferramental (idFerramental, descricao, ativo, idTiposFerramental, idProduto) VALUES
(0, 'CAPCEL84854', 1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela ferramental_maquina
--

CREATE TABLE ferramental_maquina (
  idFerramental int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela ferramental',
  idMaquina int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela maquinas'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela associativa entre ferramental e maquinas';

--
-- Despejando dados para a tabela ferramental_maquina
--

INSERT INTO ferramental_maquina (idFerramental, idMaquina) VALUES
(5, 1),
(5, 2),
(6, 1),
(6, 2),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(10, 3),
(11, 3),
(12, 1),
(12, 3),
(12, 3),
(12, 4),
(12, 1),
(12, 3),
(12, 4),
(12, 1),
(12, 3),
(12, 1),
(12, 1),
(12, 3),
(12, 4),
(0, 1),
(0, 3),
(0, 4);

-- --------------------------------------------------------

--
-- Estrutura para tabela fornecedores
--

CREATE TABLE fornecedores (
  idFornecedor int(11) NOT NULL COMMENT 'PK - chave identificadora das ids de cada fornecedor',
  descricao varchar(50) NOT NULL COMMENT 'Descrição de cada fornecedor(Nome);',
  ativo tinyint(1) NOT NULL COMMENT 'Verifica se este fornecedor irá aparecer nas pesquisas.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Registro dos fornecedores de materiais do laboratório';

--
-- Despejando dados para a tabela fornecedores
--

INSERT INTO fornecedores (idFornecedor, descricao, ativo) VALUES
(1, 'COLORFIX', 1),
(2, 'CRISTAL MASTER', 1),
(3, 'sdsdsdsd', 0),
(4, 'QUIMIDROL', 1),
(5, 'QUIMIOTEC', 1),
(6, 'EMBRACO', 0),
(7, 'asdasdervz', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela historico_materia_prima
--

CREATE TABLE historico_materia_prima (
  idHistorico_materia int(11) NOT NULL COMMENT 'PK - chave identificadora de registro da tabela historico_materia_prima.',
  idMateria int(11) NOT NULL COMMENT 'ID da matéria prima que foi alterada.',
  nomeUsuario varchar(120) NOT NULL COMMENT 'Registra o nome do usuário.',
  turma varchar(50) DEFAULT NULL COMMENT 'Registra a turma do usuário que fez a alteração no estoque, caso não tenha sido feita por um adm.',
  turno char(1) DEFAULT NULL COMMENT 'Registra o turno do usuário que fez a alteração no estoque, caso não tenah sido feita por um adm.',
  tipoUsuario tinyint(1) NOT NULL COMMENT 'Registra o tipo de usuário que fez a alteração no estoque(1-adm/2-comum).  ',
  nomeMateria varchar(80) NOT NULL COMMENT 'Nome da matéria prima alterada.',
  quantidadeAlterada int(11) NOT NULL COMMENT 'Quantidade de matéria prima alterada.',
  dataAlteracao datetime NOT NULL COMMENT 'Registra a data e a hora em que a alteração foi feita',
  ativo tinyint(1) NOT NULL COMMENT 'Registra se este registro se encontra ativo ou não'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Registros da movimentação de matéria prima no estoque';

-- --------------------------------------------------------

--
-- Estrutura para tabela historico_pedidos
--

CREATE TABLE historico_pedidos (
  idHistorico int(11) NOT NULL COMMENT 'Chave identificadora de registros da tabela histórico',
  nomeUsuario varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o nome do usuário que fez o pedido',
  tipoUsuario tinyint(1) NOT NULL COMMENT 'Registra o nível de acesso de quem fez o pedido',
  turma varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra a turma de quem fez o pedido. Se foi um adm, este valor será nulo',
  turno char(1) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o turno de quem fez o pedido. Se foi um adm, este valor será nulo',
  idPedido int(11) NOT NULL COMMENT 'Chave identificadora de registros da tabela pedidos',
  materiaPrima varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra a matéria prima usada em um pedido',
  tipoMateria_prima varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o tipo de matéria prima usada em um pedido',
  classeMateria_prima varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra a classe de matéria prima usada em um pedido',
  fornecedorMateria_Prima varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o fornecedor da matéria prima usada',
  pigmento varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registro de pigmento usado em um pedido',
  tipoPigmento varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o tipo de pigmento usado em um pedido',
  codigo varchar(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o codigo do pigmento usado',
  lote int(30) NOT NULL COMMENT 'Registra o lote do pigmento usado',
  fornecedorPigmento varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o fornecedor do pigmento usado',
  produto varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registro de produto de um pedido',
  ferramental varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra no histórico de pedidos qual molde foi usado',
  tipoFerramental varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra no histórico de pedidos qual o tipo de molde usado',
  maquina varchar(80) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registro de máquina usada para atender um pedido',
  producaoPrevista int(11) NOT NULL COMMENT 'Registra a quantidade de produtos feitos em um pedido',
  refugo int(11) DEFAULT NULL COMMENT 'Registra a quantidade de refugos feita em uma ordem de produção',
  producaoRealizada int(11) DEFAULT NULL COMMENT 'Registra a quantidade real de produção(QUANTIDADE REALMENTE PRODUZIDA - REFUGO).',
  quantidadeMateria_prima float NOT NULL COMMENT 'Registra a quantidade de matéria prima usada em uma receita',
  quantidadePigmento float NOT NULL COMMENT 'registra a quantidade de pigmento usado em uma receita',
  dataHora_aberto datetime DEFAULT NULL COMMENT 'Registra a data e hora em que um pedido foi aberto ',
  dataHora_producao datetime DEFAULT NULL COMMENT 'Registra a data e hora em que é iniciado a produção de um pedido. ',
  dataHora_fechado datetime DEFAULT NULL COMMENT 'Registra a data e hora em que um pedido foi fechado',
  dataHora_alterado datetime DEFAULT NULL COMMENT 'Registra a data e hora em que um pedido foi alterado',
  statusPedido varchar(50) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'Registra o status de um pedido da tabela pedidos',
  obsPedido text CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL COMMENT 'Registra as observações registradas na tabela pedidos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Registro de histórico de pedidos';

-- --------------------------------------------------------

--
-- Estrutura para tabela maquinas
--

CREATE TABLE maquinas (
  idMaquina int(11) NOT NULL COMMENT 'PK - chave identificadora das maquinas usadas para fazer os produtos',
  descricao varchar(50) NOT NULL COMMENT 'descrição da maquina registrada',
  ativo tinyint(1) NOT NULL COMMENT 'Verifica se esta maquina esta ativa',
  observacoes text NOT NULL COMMENT 'Registra observações feitas pelo usuário sobre a máquina em questão'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela para registro das maquinas a serem usadas na receita';

--
-- Despejando dados para a tabela maquinas
--

INSERT INTO maquinas (idMaquina, descricao, ativo, observacoes) VALUES
(1, 'VF - 32', 1, ''),
(2, 'VF - 35', 0, ''),
(3, 'VF - 44', 1, ''),
(4, 'VF - 29', 1, '');

-- --------------------------------------------------------

--
-- Estrutura para tabela materia_fornecedor
--

CREATE TABLE materia_fornecedor (
  idMateriaPrima int(11) NOT NULL COMMENT 'PK/FK - chave composta desta tabela associativa com a tabela materia_prima',
  idFornecedor int(11) NOT NULL COMMENT 'PK/FK - chave composta desta tabela associativa com a tabela fornecedores'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela associatica entre materia_prima e fornecedores';

--
-- Despejando dados para a tabela materia_fornecedor
--

INSERT INTO materia_fornecedor (idMateriaPrima, idFornecedor) VALUES
(1, 2),
(2, 5),
(8, 2),
(9, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela materia_pigmento
--

CREATE TABLE materia_pigmento (
  idMateriaPrima int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela materia_prima',
  idPigmento int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela pigmentos'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela associatica entre materia_prima e pigmentos';

--
-- Despejando dados para a tabela materia_pigmento
--

INSERT INTO materia_pigmento (idMateriaPrima, idPigmento) VALUES
(1, 4),
(1, 5),
(3, 4),
(5, 4),
(5, 5),
(8, 1),
(8, 4),
(9, 4),
(9, 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela materia_prima
--

CREATE TABLE materia_prima (
  idMateriaPrima int(11) NOT NULL COMMENT 'PK - chave identificadora de IDs da tabela materia_prima',
  idClasse int(11) NOT NULL COMMENT 'FK - chave estrangeira da tabela pigmentos',
  idTipoMateriaPrima int(11) NOT NULL COMMENT 'FK - chave estrangeira da tabela tipo_materia_prima',
  descricao varchar(80) NOT NULL COMMENT 'Registra a descrição deste item ',
  quantidade float NOT NULL COMMENT 'registra a quantidade do item ',
  ativo tinyint(1) NOT NULL COMMENT 'Registra se este item está ativo',
  observacoes text DEFAULT NULL COMMENT 'Registra uma observação não obrigatória feita pelo usuário'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela que registra as matérias primas do laboratório';

--
-- Despejando dados para a tabela materia_prima
--

INSERT INTO materia_prima (idMateriaPrima, idClasse, idTipoMateriaPrima, descricao, quantidade, ativo, observacoes) VALUES
(1, 1, 2, 'plastico', 450, 0, NULL),
(2, 1, 1, 'Polistileno', -4860, 0, NULL),
(3, 2, 4, 'Polioneto de carbonato', 450, 0, NULL),
(4, 1, 3, 'Sódio', 450, 0, NULL),
(5, 2, 1, 'Polistileno', 450, 1, NULL),
(6, 2, 3, 'Exopor', 450, 0, NULL),
(7, 1, 1, 'Java', 450, 0, NULL),
(8, 1, 1, 'Etil-benzeno', 685, 1, 'Não usar sem autorização do professor '),
(9, 1, 1, 'Poliéster', -7365, 1, '');

-- --------------------------------------------------------

--
-- Estrutura para tabela pedidos
--

CREATE TABLE pedidos (
  idPedido int(11) NOT NULL COMMENT 'PK - chave identificadora de IDs da tabela pedidos',
  idUsuario int(11) NOT NULL COMMENT 'FK - chave estrangeira da tabela usuarios',
  idReceita int(11) NOT NULL COMMENT 'Registra a id de uma receita usada em um pedido',
  idMaquina int(11) DEFAULT NULL COMMENT 'Registra em qual máquina o pedido será atendido',
  dataHora_aberto datetime DEFAULT NULL COMMENT 'Data e hora da abertura deste pedido',
  dataHora_producao datetime DEFAULT NULL COMMENT 'Registra a data e hora em que um pedido iniciou produção',
  dataHora_fechado datetime DEFAULT NULL COMMENT 'Data e hora do fechamento deste pedido',
  status tinyint(1) NOT NULL COMMENT 'Status do pedido\r\n(0-cancelado/1-aberto/2-Em produção/3-concluido)',
  observacoes text DEFAULT NULL COMMENT 'Registro não obrigatório de observações do usuário',
  refugo int(11) DEFAULT NULL COMMENT 'Quantidade de refugo ',
  producaoPrevista int(11) DEFAULT NULL COMMENT 'Registra a quantidade de produtos selecionadas no pedido',
  producaoRealizada int(11) DEFAULT NULL COMMENT 'Registra a quantidade de produtos que realmente foi feita pela máquina'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela que registra no banco de dados  um pedido';

-- --------------------------------------------------------

--
-- Estrutura para tabela pigmentos
--

CREATE TABLE pigmentos (
  idPigmento int(11) NOT NULL COMMENT 'PK - chave identificadora de IDs da tabela pigmentos',
  descricao varchar(80) NOT NULL COMMENT 'Registra a descrição de um item desta tabela',
  idTipoPigmento int(11) NOT NULL COMMENT 'FK - chave estrangeira que identificadora de IDs da tabela tipos_pigmentos',
  quantidade float NOT NULL COMMENT 'Registra a quantidade de um item registrado ',
  codigo varchar(50) NOT NULL COMMENT 'Registra o código de um item ',
  lote varchar(50) NOT NULL COMMENT 'Registra o lote de um item ',
  ativo tinyint(1) NOT NULL COMMENT 'Registra se o item está ativo (1-ativo / 0-inativo)',
  observacoes text DEFAULT NULL COMMENT 'Registra observações não obrigatórias feitas pelo usuário '
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela que registra os pigmentos do laboratório de plásticos';

--
-- Despejando dados para a tabela pigmentos
--

INSERT INTO pigmentos (idPigmento, descricao, idTipoPigmento, quantidade, codigo, lote, ativo, observacoes) VALUES
(1, 'Verde claro', 1, 200, '5415466', 'B/656482', 0, ''),
(2, 'Azul escuro', 2, 245, '48684Ad874', 'C/64882', 0, ''),
(3, 'Vermelho', 1, 300, '94686545', 'A/48654', 0, ''),
(4, 'Amarelo', 2, -1155, '', '', 1, ''),
(5, 'Roxo', 1, -1465, 'SDDES496-7', '9598D', 1, '');

-- --------------------------------------------------------

--
-- Estrutura para tabela pigmento_fornecedor
--

CREATE TABLE pigmento_fornecedor (
  idPigmento int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela pigmentos',
  idFornecedor int(11) NOT NULL COMMENT 'PK/FK - chave composta identificadora de IDs da tabela fornecedores'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela que associa um pigmento com um fornecedor';

--
-- Despejando dados para a tabela pigmento_fornecedor
--

INSERT INTO pigmento_fornecedor (idPigmento, idFornecedor) VALUES
(4, 1),
(5, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela produtos
--

CREATE TABLE produtos (
  idProduto int(11) NOT NULL COMMENT 'PK - chave identificadora da tabela produtos, onde cada id representa um produto feito.',
  descricao varchar(80) NOT NULL COMMENT 'descrição do produto feito',
  peso int(11) NOT NULL COMMENT 'Grava o peso do produto mais canal ',
  imagem varchar(100) DEFAULT NULL COMMENT 'Guarda caminho da imagem do produto',
  ativo tinyint(1) NOT NULL COMMENT 'Verifica se este produto esta ativa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela que identifica o produto feito ';

--
-- Despejando dados para a tabela produtos
--

INSERT INTO produtos (idProduto, descricao, peso, imagem, ativo) VALUES
(1, 'Capa de celular', 15, 'dist/img/6a1cb27f23349ecd35c9f3894556b28b.png', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela receitas
--

CREATE TABLE receitas (
  idReceita int(11) NOT NULL COMMENT 'PK - chave identificadora de IDs da tabela receitas ',
  idProduto int(11) NOT NULL COMMENT 'FK - chave estrangeira referenciando um item da tabela produtos',
  idPigmento int(11) DEFAULT NULL COMMENT 'IND - chave identificadora do pigmento. Pode ser nulo.',
  quantidadePigmento float NOT NULL COMMENT 'quantidade de pigmento no produto.',
  observacoes text DEFAULT NULL COMMENT 'Registra observações não obrigatórias feitas pelo usuário',
  ativo tinyint(1) NOT NULL COMMENT 'Registra se este item está ativo\r\n(1- ativo/ 0 - inativo)'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela que registra as receitas geradas no pedido';

--
-- Despejando dados para a tabela receitas
--

INSERT INTO receitas (idReceita, idProduto, idPigmento, quantidadePigmento, observacoes, ativo) VALUES
(1, 12, 5, 15, NULL, 1),
(2, 13, 4, 5, NULL, 1),
(3, 13, 5, 5, NULL, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela receita_materia_prima
--

CREATE TABLE receita_materia_prima (
  idReceita int(11) NOT NULL COMMENT 'PK/FK- Chave identificadora de IDs da tabela receitas',
  idMateriaPrima int(11) NOT NULL COMMENT 'PK/FK- Chave identificadora de IDs da tabela materia_prima',
  quantidadeMaterial int(11) NOT NULL COMMENT 'Registra a quantidade de matéria prima usada nesta receita'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela associativa das tabelas receitas com materia_prima';

--
-- Despejando dados para a tabela receita_materia_prima
--

INSERT INTO receita_materia_prima (idReceita, idMateriaPrima, quantidadeMaterial) VALUES
(1, 8, 30),
(2, 8, 15),
(2, 9, 15),
(3, 2, 45);

-- --------------------------------------------------------

--
-- Estrutura para tabela tipos_ferramental
--

CREATE TABLE tipos_ferramental (
  idTiposFerramental int(11) NOT NULL COMMENT 'PK - chave identificadora das ids dos tipos de moldes das maquinas.',
  descricao varchar(50) NOT NULL COMMENT 'Descrição do molde a ser usado(Nome e algumas observações).',
  ativo tinyint(1) NOT NULL COMMENT 'Verifica se esta maquina esta ativa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela de registro dos tipos de moldes usados no laboratório';

--
-- Despejando dados para a tabela tipos_ferramental
--

INSERT INTO tipos_ferramental (idTiposFerramental, descricao, ativo) VALUES
(1, 'Aluminio', 1),
(2, 'Aço', 1),
(3, 'Madeira', 1),
(4, 'Pedra', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela tipo_materia_prima
--

CREATE TABLE tipo_materia_prima (
  idTipoMateriaPrima int(11) NOT NULL COMMENT 'PK - chave identificadora de id dos tipos de matéria prima',
  descricao varchar(32) NOT NULL COMMENT 'Descrição dos tipos de matéria prima(virgem, reciclado, remoído, scrap);',
  ativo tinyint(1) NOT NULL COMMENT 'Verifica se esta tipo de matéria prima esta ativa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela identificadora dos tipos de matéria prima ';

--
-- Despejando dados para a tabela tipo_materia_prima
--

INSERT INTO tipo_materia_prima (idTipoMateriaPrima, descricao, ativo) VALUES
(1, 'Virgem', 1),
(2, 'Reciclado', 1),
(3, 'Remoido', 1),
(4, 'Scrap', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela tipo_pigmentos
--

CREATE TABLE tipo_pigmentos (
  idTipoPigmento int(11) NOT NULL COMMENT 'PK - codigo identificador dos tipos de pigmentos',
  descricao varchar(80) NOT NULL COMMENT 'descricao do tipo pigmento',
  ativo tinyint(1) NOT NULL COMMENT 'Verifica se este tipo de pigmento esta ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela tipo_pigmentos
--

INSERT INTO tipo_pigmentos (idTipoPigmento, descricao, ativo) VALUES
(1, 'MB', 1),
(2, 'MTB', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela turma
--

CREATE TABLE turma (
  idTurma int(11) NOT NULL COMMENT 'PK - chave identificadora da turma a qual o usuário pertence\r\nOBS: o admin não necessita estar em uma turma',
  turno char(1) DEFAULT NULL COMMENT 'Mostra a qual turno uma turma pertence',
  nomeTurma varchar(32) DEFAULT NULL COMMENT 'Nome da turma. \r\nEx: TDesi Senai/N1',
  ativo tinyint(1) DEFAULT NULL COMMENT 'Se a conta podea ou não pode ser usada'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tabela que salva as informações sobre a turma dos usuários ';

--
-- Despejando dados para a tabela turma
--

INSERT INTO turma (idTurma, turno, nomeTurma, ativo) VALUES
(1, 'N', 'T DESI 2022', 0),
(2, 'M', 'Estilos de Moda', 0),
(3, 'V', 'Mecânica', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela usuarios
--

CREATE TABLE usuarios (
  idUsuario int(11) NOT NULL COMMENT 'PK - chave identificadora de IDs da tabela usuarios',
  login varchar(80) NOT NULL COMMENT 'Registra o login de um usuário',
  senha varchar(32) NOT NULL COMMENT 'Registra a senha de um usuário',
  nome varchar(80) NOT NULL COMMENT 'Registra o primeiro nome do usuário',
  sobrenome varchar(80) NOT NULL COMMENT 'Registra o sobrenome do usuário',
  idTurma int(11) DEFAULT NULL COMMENT 'FK - chave estrangeira que Registra a ID da turma do usuário',
  tipo tinyint(1) NOT NULL COMMENT 'Registra o tipo de usuário',
  ativo tinyint(1) NOT NULL COMMENT 'Registra se o usuário estiver ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='Tabela que registra os cadastros de suuarios';

--
-- Despejando dados para a tabela usuarios
--

INSERT INTO usuarios (idUsuario, login, senha, nome, sobrenome, idTurma, tipo, ativo) VALUES
(1, 'adm@adm.com', '202cb962ac59075b964b07152d234b70', 'Adm', 'Adm', NULL, 1, 0),
(2, 'a@teste.com', '202cb962ac59075b964b07152d234b70', 'Luis', 'Fernando Pereira', NULL, 1, 0),
(3, 'b@teste.com', '202cb962ac59075b964b07152d234b70', 'Marco', 'dos Santos', 1, 2, 1),
(4, 'c@teste.com', '202cb962ac59075b964b07152d234b70', 'Teste', 'Testudo de teste', 1, 2, 1),
(5, 'adm1@adm.com', '81dc9bdb52d04dc20036dbd8313ed055', 'adm', 'adm', NULL, 1, 1),
(6, 'ad@ad.v', '81dc9bdb52d04dc20036dbd8313ed055', 'daniel', 'dani', 2, 2, 1),
(7, 'joao@teste.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Joao', 'cacilds', 3, 2, 1),
(8, 'da@dada.da', '81dc9bdb52d04dc20036dbd8313ed055', 'da', 'da', NULL, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view view_altera_estoque
-- (Veja abaixo para a visão atual)
--
CREATE TABLE view_altera_estoque (
idPedido int(11)
,producao int(11)
,qtdMaterial int(11)
,qtdPigmento float
,idReceita int(11)
,idMaterial int(11)
,estoqueMaterial float
,nomeMaterial varchar(80)
,idPigmento int(11)
,estoquePigmento float
,nomePigmento varchar(80)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view view_materia_receitas
-- (Veja abaixo para a visão atual)
--
CREATE TABLE view_materia_receitas (
id int(11)
,quantidade int(11)
,material varchar(80)
,tipo varchar(32)
,classe varchar(32)
,fornecedor varchar(50)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view view_pedidos
-- (Veja abaixo para a visão atual)
--
CREATE TABLE view_pedidos (
pedidoId int(11)
,userId int(11)
,receitaId int(11)
,maquinaId int(11)
,abertoData_hora datetime
,producaoData_hora datetime
,fechadoData_hora datetime
,stats tinyint(1)
,obs text
,qtdRefugo int(11)
,qtdPrevista int(11)
,qtdRealizada int(11)
,turmaId int(11)
,name varchar(80)
,sobName varchar(80)
,nivel tinyint(1)
,turma varchar(32)
,turno char(1)
,maquina varchar(50)
,produtoId int(11)
,pigmentoId int(11)
,qtdePigmento float
,materiaId int(11)
,qtdeMateria int(11)
,classeId int(11)
,tipoMatId int(11)
,material varchar(80)
,tipoMat varchar(32)
,classeMat varchar(32)
,fornecedorM varchar(50)
,fornecedorP varchar(50)
,tipoCorId int(11)
,cor varchar(80)
,codCor varchar(50)
,loteCor varchar(50)
,tipoCor varchar(80)
,produto varchar(80)
,pesoPro int(11)
,img varchar(100)
,moldeId int(11)
,molde varchar(80)
,tipoMoldeId int(11)
,tipoMolde varchar(50)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para view view_receitas
-- (Veja abaixo para a visão atual)
--
CREATE TABLE view_receitas (
receitaId int(11)
,produtoId int(11)
,qtdePigmento float
,receitaObs text
,ativoReceita tinyint(1)
,materiaId int(11)
,qtdeMateria int(11)
,produtoNome varchar(80)
,produtoImg varchar(100)
,moldeId int(11)
,moldeNome varchar(80)
,tipoMolde_nome varchar(50)
,materialNome varchar(80)
,tipo_materiaNome varchar(32)
,classeMaterial varchar(32)
,pigmentoId int(11)
,pigmentoNome varchar(80)
,tipoPigmento varchar(80)
);

-- --------------------------------------------------------

--
-- Estrutura para view view_altera_estoque
--
DROP TABLE IF EXISTS view_altera_estoque;

CREATE  VIEW view_altera_estoque  AS SELECT p.idPedido AS idPedido, p.producaoPrevista AS producao, mr.quantidadeMaterial AS qtdMaterial, r.quantidadePigmento AS qtdPigmento, mr.idReceita AS idReceita, mr.idMateriaPrima AS idMaterial, mat.quantidade AS estoqueMaterial, mat.descricao AS nomeMaterial, r.idPigmento AS idPigmento, pig.quantidade AS estoquePigmento, pig.descricao AS nomePigmento FROM ((((pedidos p left join receitas r on(p.idReceita = r.idReceita)) left join receita_materia_prima mr on(r.idReceita = mr.idReceita)) left join materia_prima mat on(mr.idMateriaPrima = mat.idMateriaPrima)) left join pigmentos pig on(r.idPigmento = pig.idPigmento)) ;

-- --------------------------------------------------------

--
-- Estrutura para view view_materia_receitas
--
DROP TABLE IF EXISTS view_materia_receitas;

CREATE  VIEW view_materia_receitas  AS SELECT rmat.idReceita AS id, rmat.quantidadeMaterial AS quantidade, m.descricao AS material, t.descricao AS tipo, c.descricao AS classe, f.descricao AS fornecedor FROM (((((receita_materia_prima rmat left join materia_prima m on(rmat.idMateriaPrima = m.idMateriaPrima)) join materia_fornecedor mf on(m.idMateriaPrima = mf.idMateriaPrima)) left join fornecedores f on(mf.idFornecedor = f.idFornecedor)) left join tipo_materia_prima t on(t.idTipoMateriaPrima = m.idTipoMateriaPrima)) left join classe_material c on(m.idClasse = c.idClasse)) ;

-- --------------------------------------------------------

--
-- Estrutura para view view_pedidos
--
DROP TABLE IF EXISTS view_pedidos;

CREATE  VIEW view_pedidos  AS SELECT ped.idPedido AS pedidoId, ped.idUsuario AS userId, ped.idReceita AS receitaId, ped.idMaquina AS maquinaId, ped.dataHora_aberto AS abertoData_hora, ped.dataHora_producao AS producaoData_hora, ped.dataHora_fechado AS fechadoData_hora, ped.status AS stats, ped.observacoes AS obs, ped.refugo AS qtdRefugo, ped.producaoPrevista AS qtdPrevista, ped.producaoRealizada AS qtdRealizada, usu.idTurma AS turmaId, usu.nome AS name, usu.sobrenome AS sobName, usu.tipo AS nivel, tur.nomeTurma AS turma, tur.turno AS turno, maq.descricao AS maquina, rec.idProduto AS produtoId, rec.idPigmento AS pigmentoId, rec.quantidadePigmento AS qtdePigmento, rmp.idMateriaPrima AS materiaId, rmp.quantidadeMaterial AS qtdeMateria, mat.idClasse AS classeId, mat.idTipoMateriaPrima AS tipoMatId, mat.descricao AS material, tmat.descricao AS tipoMat, cmat.descricao AS classeMat, form.descricao AS fornecedorM, forp.descricao AS fornecedorP, pig.idTipoPigmento AS tipoCorId, pig.descricao AS cor, pig.codigo AS codCor, pig.lote AS loteCor, tpig.descricao AS tipoCor, pro.descricao AS produto, pro.peso AS pesoPro, pro.imagem AS img, fer.idFerramental AS moldeId, fer.descricao AS molde, fer.idTiposFerramental AS tipoMoldeId, tfer.descricao AS tipoMolde FROM (((((((ferramental fer left join ((classe_material cmat left join (tipo_materia_prima tmat left join (materia_fornecedor format left join ((receita_materia_prima rmp left join ((((pedidos ped left join usuarios usu on(ped.idUsuario = usu.idUsuario)) left join turma tur on(usu.idTurma = tur.idTurma)) left join maquinas maq on(ped.idMaquina = maq.idMaquina)) left join receitas rec on(ped.idReceita = rec.idReceita)) on(rmp.idReceita = rec.idReceita)) left join materia_prima mat on(rmp.idMateriaPrima = mat.idMateriaPrima)) on(mat.idMateriaPrima = format.idMateriaPrima)) on(mat.idTipoMateriaPrima = tmat.idTipoMateriaPrima)) on(mat.idClasse = cmat.idClasse)) left join produtos pro on(rec.idProduto = pro.idProduto)) on(pro.idProduto = fer.idProduto)) left join tipos_ferramental tfer on(fer.idTiposFerramental = tfer.idTiposFerramental)) left join fornecedores form on(format.idFornecedor = form.idFornecedor)) left join pigmentos pig on(rec.idPigmento = pig.idPigmento)) left join tipo_pigmentos tpig on(pig.idTipoPigmento = tpig.idTipoPigmento)) left join pigmento_fornecedor forpig on(pig.idPigmento = forpig.idPigmento)) left join fornecedores forp on(forp.idFornecedor = forpig.idFornecedor)) ;

-- --------------------------------------------------------

--
-- Estrutura para view view_receitas
--
DROP TABLE IF EXISTS view_receitas;

CREATE  VIEW view_receitas  AS SELECT r.idReceita AS receitaId, r.idProduto AS produtoId, r.quantidadePigmento AS qtdePigmento, r.observacoes AS receitaObs, r.ativo AS ativoReceita, rmp.idMateriaPrima AS materiaId, rmp.quantidadeMaterial AS qtdeMateria, pr.descricao AS produtoNome, pr.imagem AS produtoImg, f.idFerramental AS moldeId, f.descricao AS moldeNome, tfer.descricao AS tipoMolde_nome, mat.descricao AS materialNome, tm.descricao AS tipo_materiaNome, c.descricao AS classeMaterial, pg.idPigmento AS pigmentoId, pg.descricao AS pigmentoNome, tp.descricao AS tipoPigmento FROM ((((ferramental f left join (((((receita_materia_prima rmp left join receitas r on(rmp.idReceita = r.idReceita)) left join materia_prima mat on(rmp.idMateriaPrima = mat.idMateriaPrima)) left join classe_material c on(c.idClasse = mat.idClasse)) left join tipo_materia_prima tm on(tm.idTipoMateriaPrima = mat.idTipoMateriaPrima)) left join produtos pr on(r.idProduto = pr.idProduto)) on(f.idProduto = pr.idProduto)) left join tipos_ferramental tfer on(f.idTiposFerramental = tfer.idTiposFerramental)) left join pigmentos pg on(pg.idPigmento = r.idPigmento)) left join tipo_pigmentos tp on(tp.idTipoPigmento = pg.idTipoPigmento)) ;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela pedidos
--
ALTER TABLE pedidos
  ADD PRIMARY KEY (idPedido);

--
-- Índices de tabela produtos
--
ALTER TABLE produtos
  ADD PRIMARY KEY (idProduto);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela pedidos
--
ALTER TABLE pedidos
  MODIFY idPedido int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora de IDs da tabela pedidos';

--
-- AUTO_INCREMENT de tabela produtos
--
ALTER TABLE produtos
  MODIFY idProduto int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK - chave identificadora da tabela produtos, onde cada id representa um produto feito.', AUTO_INCREMENT=2;
COMMIT;