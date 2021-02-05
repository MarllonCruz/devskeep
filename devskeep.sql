-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Fev-2021 às 20:39
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `devskeep`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `marks`
--

CREATE TABLE `marks` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `cor` varchar(11) DEFAULT '#333'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `marks`
--

INSERT INTO `marks` (`id`, `title`, `cor`) VALUES
(26, 'Treino', '#333'),
(28, 'Trabalho', '#333'),
(39, 'Corrida', '#333');

-- --------------------------------------------------------

--
-- Estrutura da tabela `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `id_mark` int(11) DEFAULT NULL,
  `title` varchar(100) NOT NULL,
  `txt` text NOT NULL,
  `created_at` datetime NOT NULL,
  `cor` varchar(11) DEFAULT '#FFF',
  `status_trash` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `notes`
--

INSERT INTO `notes` (`id`, `id_mark`, `title`, `txt`, `created_at`, `cor`, `status_trash`) VALUES
(3, NULL, 'Testando', 'teste....', '2021-02-04 13:52:39', '#FFF', 0),
(5, NULL, 'Carro', 'Limpar o carro amanha \n10 hrs da noite\nna cidade asdasdasdasd\nasdasd asd asd asdasda\n asd asd asd a as das d asdas3', '2021-02-04 13:53:44', '#FFF', 1),
(7, NULL, 'Teste', 'asdas', '2021-02-04 21:24:58', '#FFF', 0),
(9, 26, 'asdsa2233', 'asdasdsadasdasdas22233', '2021-02-04 23:03:04', '#FFF', 0),
(12, NULL, '1', '1', '2021-02-05 18:26:47', '#FFF', 0),
(13, NULL, '2', '2', '2021-02-05 18:26:49', '#FFF', 0),
(14, NULL, '3', '3', '2021-02-05 18:26:52', '#FFF', 0),
(15, NULL, '4', '4', '2021-02-05 18:26:53', '#FFF', 0),
(16, NULL, '5', '5', '2021-02-05 18:26:56', '#FFF', 0),
(17, NULL, '6', '6', '2021-02-05 18:26:58', '#FFF', 0),
(18, NULL, '7', '7', '2021-02-05 18:27:00', '#FFF', 0),
(19, NULL, '8', '8', '2021-02-05 18:27:02', '#FFF', 0),
(20, NULL, '9', '9', '2021-02-05 18:27:05', '#FFF', 0),
(21, NULL, '10', '10', '2021-02-05 18:27:15', '#FFF', 0),
(22, NULL, '11', '11', '2021-02-05 18:27:22', '#FFF', 0),
(23, 26, '12', '12', '2021-02-05 18:27:26', '#FFF', 0),
(24, 26, '13', '13', '2021-02-05 18:27:30', '#FFF', 0),
(25, 26, '14', '14', '2021-02-05 18:27:35', '#FFF', 1),
(26, NULL, 'teste', 'asdsa', '2021-02-05 20:22:17', '#FFF', 0),
(27, NULL, 'Titulo', 'asdas', '2021-02-05 20:22:20', '#FFF', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de tabela `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
