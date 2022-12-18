-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Dez-2022 às 05:59
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `streamline`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacoescliente`
--

CREATE TABLE `avaliacoescliente` (
  `Id_aval_cli` int(10) NOT NULL,
  `Id_prof` int(10) DEFAULT NULL,
  `Id_cli` int(10) DEFAULT NULL,
  `nome_prof` varchar(130) DEFAULT NULL,
  `nome_cli` varchar(130) DEFAULT NULL,
  `data_aval_cli` date DEFAULT NULL,
  `Comentario_cli` text DEFAULT NULL,
  `Avaliacao_cli` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `avaliacoescliente`
--

INSERT INTO `avaliacoescliente` (`Id_aval_cli`, `Id_prof`, `Id_cli`, `nome_prof`, `nome_cli`, `data_aval_cli`, `Comentario_cli`, `Avaliacao_cli`) VALUES
(1, 1, 4, 'Admin', '', '2022-11-11', 'Bom Trabalho!', 3),
(16, 2, 2, 'Rita Levinsky', 'Roger Almeida', '2022-12-18', '', 4),
(17, 2, 2, 'Rita Levinsky', 'Roger Almeida', '2022-12-18', '', 4),
(18, 1, 4, 'Admin', 'Admin', '2022-11-11', 'Bom Trabalho!', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacoesprofissional`
--

CREATE TABLE `avaliacoesprofissional` (
  `Id_aval_prof` int(10) NOT NULL,
  `Id_prof` int(10) DEFAULT NULL,
  `Id_cli` int(10) DEFAULT NULL,
  `nome_prof` varchar(130) DEFAULT NULL,
  `nome_cli` varchar(130) DEFAULT NULL,
  `data_aval_prof` date DEFAULT NULL,
  `Comentario_prof` text DEFAULT NULL,
  `Avaliacao_prof` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `avaliacoesprofissional`
--

INSERT INTO `avaliacoesprofissional` (`Id_aval_prof`, `Id_prof`, `Id_cli`, `nome_prof`, `nome_cli`, `data_aval_prof`, `Comentario_prof`, `Avaliacao_prof`) VALUES
(1, 2, 1, 'Admin', 'Admin', '2022-11-11', 'Bom Trabalho!', 3),
(18, 2, 2, '', 'Roger Almeida', '2022-12-18', 'Ótima no que faz!', 3),
(24, 0, 2, 'Rita Levinsky', 'Roger Almeida', '2022-12-18', 'Ótima no que faz!', 3),
(28, 2, 2, 'Rita Levinsky', 'Roger Almeida', '2022-12-18', 'Ótima no que faz!', 3),
(29, 2, 2, 'Rita Levinsky', 'Roger Almeida', '2022-12-18', 'Ótima no que faz!', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastrocliente`
--

CREATE TABLE `cadastrocliente` (
  `Id_cli` int(11) NOT NULL,
  `nome_cli` varchar(130) DEFAULT NULL,
  `genero` varchar(50) DEFAULT NULL,
  `email_cli` varchar(250) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `data_nacimento` date DEFAULT NULL,
  `Data_cadCli` date DEFAULT NULL,
  `contato` varchar(15) DEFAULT NULL,
  `cep` varchar(10) DEFAULT NULL,
  `numero_casa` varchar(50) DEFAULT NULL,
  `complemento` varchar(200) DEFAULT NULL,
  `estado` varchar(200) DEFAULT NULL,
  `cidade` varchar(200) DEFAULT NULL,
  `biografia` text DEFAULT NULL,
  `link` varchar(200) DEFAULT NULL,
  `foto_perfil` varchar(200) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL,
  `token` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cadastrocliente`
--

INSERT INTO `cadastrocliente` (`Id_cli`, `nome_cli`, `genero`, `email_cli`, `senha`, `data_nacimento`, `Data_cadCli`, `contato`, `cep`, `numero_casa`, `complemento`, `estado`, `cidade`, `biografia`, `link`, `foto_perfil`, `ativo`, `token`) VALUES
(1, 'StreamLine Admin', 'Não-Binário', 'mailstreamlineserver@gmail.com', '$2y$10$XuULgPclfOaM06bgxFvDw.CF1i0qUDuUgGJthSAljmR/WO2kvNUTC', '2000-12-09', '2022-12-05', '0', '03694-000', '', '', 'SP', '2633', 'Olá!', 'http://api.whatsapp.com/send?1=pt_BR&phone=5511982509430', 'perfis1.svg', 0, 'a87ff679a2f3e71d9181a67b7542122c'),
(2, 'Roger Almeida', 'Masculino', 'roger@gmail.com', '$2y$10$oe.jLfHiywp1j6.6wGtE7O5ryepZMDeWTiIpUgN3RODkOIUEmuNxW', '1997-03-05', '2022-12-05', '1198234568', '08245-000', '456', 'Portão B', 'SP', 'São Paulo', 'Olá, sou o Roger.', 'http://api.whatsapp.com/send?1=pt_BR&phone=551198234568', 'pexels-photo-2379004.jpeg', 1, 'a87ff679a2f3e71d9181a67b7542122c'),
(3, 'Bianca Silva', 'Feminino', 'bianca@gmail.com', '$2y$10$ufuCGvqYre/7tGgcHlkGde11lsvo6pS9tChR7V4aa461JzFq4RZmq', '1995-07-19', '2022-12-18', '11984895859', '08248-000', '', 'Lado B', 'SP', '14', 'Olá!', 'http://api.whatsapp.com/send?1=pt_BR&phone=5511984895859', 'perfis1.svg', 1, 'c81e728d9d4c2f636f067f89cc14862c'),
(4, 'Ana Catarina Fonseca', 'Feminino', 'anacata@gmail.com', '$2y$10$Aaa1G0eKDEzdoLja4lpzse6lcddKPX/zdPEeXpQWhJ0g4F5CqB1nC', '1987-06-17', '2022-12-18', '11975885484', '08230-000', '45', 'Lado A', 'SP', '67', 'Eu adoro café!', 'http://api.whatsapp.com/send?1=pt_BR&phone=5511975885484', 'pexels-photo-6184647.jpeg', 1, 'e4da3b7fbbce2345d7772b0674a318d5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastroprofissional`
--

CREATE TABLE `cadastroprofissional` (
  `Id_prof` int(10) NOT NULL,
  `nome_prof` varchar(130) DEFAULT NULL,
  `genero` varchar(50) DEFAULT NULL,
  `email_prof` varchar(250) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `profissao` varchar(180) NOT NULL,
  `tempo_exp` int(10) DEFAULT NULL,
  `espTempo` varchar(200) NOT NULL,
  `esp_exp` varchar(400) DEFAULT NULL,
  `biografia` text DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `data_cadProf` date DEFAULT NULL,
  `contato` varchar(15) DEFAULT NULL,
  `cep` varchar(10) NOT NULL,
  `numero_casa` varchar(50) DEFAULT NULL,
  `complemento` varchar(200) DEFAULT NULL,
  `cidade` varchar(200) NOT NULL,
  `estado` varchar(200) NOT NULL,
  `link` varchar(200) DEFAULT NULL,
  `preco_fixo` decimal(10,2) NOT NULL,
  `foto_perfil` varchar(200) DEFAULT NULL,
  `ativo` tinyint(1) NOT NULL,
  `token` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `cadastroprofissional`
--

INSERT INTO `cadastroprofissional` (`Id_prof`, `nome_prof`, `genero`, `email_prof`, `senha`, `profissao`, `tempo_exp`, `espTempo`, `esp_exp`, `biografia`, `data_nascimento`, `data_cadProf`, `contato`, `cep`, `numero_casa`, `complemento`, `cidade`, `estado`, `link`, `preco_fixo`, `foto_perfil`, `ativo`, `token`) VALUES
(1, 'StreamLine Admin', 'Não-Binário', 'mailstreamlineserver@gmail.com', '$2y$10$61uY/hkJbrFX7MxWCbcJ6uDpJAcWJIV.Y0FuxMKdrJ2BG45bRC2r6', 'Adm', 1, 'Ano(s)', 'Dono', 'Olá!', '2000-12-09', '2022-12-05', '0', '03694-000', '2633', '', 'São Paulo', 'SP', 'http://api.whatsapp.com/send?1=pt_BR&phone=5511982509430', '1.00', 'perfis1.svg', 0, 'a87ff679a2f3e71d9181a67b7542122c'),
(2, 'Rita Levinsky', 'Feminino', 'rita@gmail.com', '$2y$10$kT.h4EFgn2ANJs8g7k3goOT4XmjTWGlJXxJrKwXJVy1aMGJCkC8oq', 'Fotografia', 7, 'anos', 'Book de Gravidez', 'Olá, meu nome é Rita Levinsky!\r\nSou fotógrafa há 7 anos, realizo meu serviço em eventos de casamento.', '1987-12-31', '2022-12-05', '11985678921', '03694-000', '2633', '', 'São Paulo', 'SP', 'http://api.whatsapp.com/send?1=pt_BR&phone=5511985678921', '120.00', 'pexels-photo-8091665.jpeg', 1, 'eccbc87e4b5ce2fe28308fd9f2a7baf3');

-- --------------------------------------------------------

--
-- Estrutura da tabela `denuncia_cli`
--

CREATE TABLE `denuncia_cli` (
  `Id_denuncia` int(11) NOT NULL,
  `Id_prof` int(10) NOT NULL,
  `Id_cli` int(11) NOT NULL,
  `motivo` text NOT NULL,
  `reclamacao` text NOT NULL,
  `data_denuncia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `denuncia_prof`
--

CREATE TABLE `denuncia_prof` (
  `Id_denuncia` int(11) NOT NULL,
  `Id_prof` int(10) NOT NULL,
  `Id_cli` int(11) NOT NULL,
  `motivo` text NOT NULL,
  `reclamacao` text NOT NULL,
  `data_denuncia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `denuncia_prof`
--

INSERT INTO `denuncia_prof` (`Id_denuncia`, `Id_prof`, `Id_cli`, `motivo`, `reclamacao`, `data_denuncia`) VALUES
(1, 2, 2, 'Mal educada.', 'Me atendeu mal.', '2022-12-10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico`
--

CREATE TABLE `historico` (
  `id_quant_trabalho` int(11) NOT NULL,
  `Id_prof` int(11) NOT NULL,
  `quantidade_trabalho` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `orcamento`
--

CREATE TABLE `orcamento` (
  `id_orcamento` int(11) NOT NULL,
  `Id_cli` int(11) NOT NULL,
  `Id_prof` int(10) NOT NULL,
  `estimativa_preco` decimal(10,2) NOT NULL,
  `data_orcamento` date NOT NULL,
  `hora_orcamento` time NOT NULL,
  `preco_fixo` decimal(10,2) NOT NULL,
  `profissao` varchar(180) NOT NULL,
  `esp_exp` varchar(120) NOT NULL,
  `quantidade_horas` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `orcamento`
--

INSERT INTO `orcamento` (`id_orcamento`, `Id_cli`, `Id_prof`, `estimativa_preco`, `data_orcamento`, `hora_orcamento`, `preco_fixo`, `profissao`, `esp_exp`, `quantidade_horas`) VALUES
(15, 2, 2, '1080.00', '2022-12-18', '00:53:05', '120.00', 'Fotografia', 'Book Gravidez', '9.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servico`
--

CREATE TABLE `servico` (
  `Id_Serv` int(11) NOT NULL,
  `Id_prof` int(10) NOT NULL,
  `Id_cli` int(11) NOT NULL,
  `data_contratacao` date NOT NULL,
  `hora_contratacao` time NOT NULL,
  `data_finalizacao` date DEFAULT NULL,
  `hora_finalizacao` time DEFAULT NULL,
  `preco_final` decimal(10,2) NOT NULL,
  `quant_horas` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `servico`
--

INSERT INTO `servico` (`Id_Serv`, `Id_prof`, `Id_cli`, `data_contratacao`, `hora_contratacao`, `data_finalizacao`, `hora_finalizacao`, `preco_final`, `quant_horas`) VALUES
(1, 2, 2, '2022-12-09', '18:19:51', '2022-12-18', '00:17:04', '0.00', '0.00'),
(6, 2, 2, '2022-12-18', '22:59:16', '2022-12-18', '00:17:04', '240.00', '2.00'),
(11, 2, 2, '2022-12-18', '00:55:26', '0000-00-00', '00:00:00', '1080.00', '9.00'),
(12, 2, 2, '2022-12-18', '00:57:01', '0000-00-00', '00:00:00', '1080.00', '9.00'),
(13, 2, 2, '2022-12-18', '00:58:20', '0000-00-00', '00:00:00', '1080.00', '9.00'),
(14, 2, 2, '2022-12-18', '00:58:35', '0000-00-00', '00:00:00', '1080.00', '9.00'),
(15, 2, 2, '2022-12-18', '00:59:16', '0000-00-00', '00:00:00', '1080.00', '9.00'),
(16, 2, 2, '2022-12-18', '01:01:26', '0000-00-00', '00:00:00', '1080.00', '9.00'),
(17, 2, 2, '2022-12-18', '01:02:30', '0000-00-00', '00:00:00', '1080.00', '9.00'),
(18, 2, 2, '2022-12-18', '01:03:11', '0000-00-00', '00:00:00', '1080.00', '9.00');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `avaliacoescliente`
--
ALTER TABLE `avaliacoescliente`
  ADD PRIMARY KEY (`Id_aval_cli`);

--
-- Índices para tabela `avaliacoesprofissional`
--
ALTER TABLE `avaliacoesprofissional`
  ADD PRIMARY KEY (`Id_aval_prof`);

--
-- Índices para tabela `cadastrocliente`
--
ALTER TABLE `cadastrocliente`
  ADD PRIMARY KEY (`Id_cli`);

--
-- Índices para tabela `cadastroprofissional`
--
ALTER TABLE `cadastroprofissional`
  ADD PRIMARY KEY (`Id_prof`);

--
-- Índices para tabela `denuncia_cli`
--
ALTER TABLE `denuncia_cli`
  ADD PRIMARY KEY (`Id_denuncia`);

--
-- Índices para tabela `denuncia_prof`
--
ALTER TABLE `denuncia_prof`
  ADD PRIMARY KEY (`Id_denuncia`);

--
-- Índices para tabela `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id_quant_trabalho`);

--
-- Índices para tabela `orcamento`
--
ALTER TABLE `orcamento`
  ADD PRIMARY KEY (`id_orcamento`);

--
-- Índices para tabela `servico`
--
ALTER TABLE `servico`
  ADD PRIMARY KEY (`Id_Serv`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `avaliacoescliente`
--
ALTER TABLE `avaliacoescliente`
  MODIFY `Id_aval_cli` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `avaliacoesprofissional`
--
ALTER TABLE `avaliacoesprofissional`
  MODIFY `Id_aval_prof` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `cadastrocliente`
--
ALTER TABLE `cadastrocliente`
  MODIFY `Id_cli` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `cadastroprofissional`
--
ALTER TABLE `cadastroprofissional`
  MODIFY `Id_prof` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `denuncia_cli`
--
ALTER TABLE `denuncia_cli`
  MODIFY `Id_denuncia` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `denuncia_prof`
--
ALTER TABLE `denuncia_prof`
  MODIFY `Id_denuncia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `historico`
--
ALTER TABLE `historico`
  MODIFY `id_quant_trabalho` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `orcamento`
--
ALTER TABLE `orcamento`
  MODIFY `id_orcamento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `servico`
--
ALTER TABLE `servico`
  MODIFY `Id_Serv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
