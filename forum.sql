-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13-Abr-2021 às 17:03
-- Versão do servidor: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `forum`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `titulo` text,
  `conteudo` text,
  `data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `posts`
--

INSERT INTO `posts` (`id`, `id_usuario`, `titulo`, `conteudo`, `data`) VALUES
(5, 20, 'Testa aqui os Comentarios!', 'Ola Mundo, eu sou  Luciana!\nOla Mundo!\n\nEditado a partir da pagina POST!\nEditado a partir da pagina POST!\nEditado a partir da pagina POST!\nEditado a partir da pagina POST!', '2021-04-07'),
(10, 20, '     ', 'Este eh um post sem Titulo!\nEste eh um post sem Titulo!\nEste eh um post sem Titulo!\nEste eh um post sem Titulo!', '2021-04-09'),
(16, 8, '', 'Post de teste', '2021-04-10'),
(17, 8, '', 'Mais outro post!', '2021-04-10'),
(18, 8, 'Titulo do post', 'Mais um, e mais outro!', '2021-04-10'),
(19, 8, 'Mais um post', 'Ola Mundo!\nEsta tudo funcionando bem!', '2021-04-10'),
(20, 8, 'No ambiente de producao esta tudo fixe', 'Obaahhhh, ta tudo bem!', '2021-04-10'),
(21, 21, 'Meu primeiro Post', 'Ola Mundo, estao todos bem!', '2021-04-10'),
(22, 21, 'Meu segundo Post', 'Ola Mundo, todos estao bem!', '2021-04-10'),
(23, 22, 'Este eh o meu primeiro post', 'Ola Mundo!', '2021-04-11');

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts_comentarios`
--

CREATE TABLE `posts_comentarios` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_post` int(11) DEFAULT NULL,
  `conteudo` text,
  `data` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `posts_comentarios`
--

INSERT INTO `posts_comentarios` (`id`, `id_usuario`, `id_post`, `conteudo`, `data`) VALUES
(5, 20, 5, 'Comentario de um post!', '2021-04-07'),
(9, 8, 10, 'Os comentarios funcionam perfeitamente!', '2021-04-09'),
(10, 8, 10, 'Eh, funcionam perfeitamente mesmo!\na funcao de editar tambem!', '2021-04-09'),
(19, 8, 19, 'Um comentario de teste!', '2021-04-10'),
(20, 8, 10, 'Mais um comentario, a partir do ambiente de producao!\nMuito bem!', '2021-04-10'),
(22, 21, 20, 'Obbaaa , estÃ¡ tudo funcionando bem!', '2021-04-10'),
(23, 21, 17, 'Ola Mundo!', '2021-04-10'),
(24, 21, 17, 'Meu segundo comentario!', '2021-04-10'),
(25, 21, 17, 'Meu terceiro comentario!', '2021-04-10'),
(27, 8, 20, 'Mais um comentario!', '2021-04-11'),
(28, 8, 20, 'Ola Mundo!!', '2021-04-11'),
(29, 8, 21, 'Ola Mundo....', '2021-04-11'),
(30, 8, 19, '.....', '2021-04-11'),
(31, 8, 19, '......', '2021-04-11'),
(33, 8, 17, '....', '2021-04-11'),
(34, 8, 17, 'vvvv', '2021-04-11'),
(35, 21, 20, '........ ....', '2021-04-11'),
(36, 22, 22, 'Ola Mundo.....', '2021-04-11'),
(38, 23, 23, 'Ola Mundo.....', '2021-04-12'),
(39, 23, 23, 'Ola mundo......... !', '2021-04-12'),
(40, 23, 5, '......', '2021-04-13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts_comentarios_gostos`
--

CREATE TABLE `posts_comentarios_gostos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_comentario` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `posts_comentarios_gostos`
--

INSERT INTO `posts_comentarios_gostos` (`id`, `id_usuario`, `id_comentario`) VALUES
(12, 8, 14),
(14, 8, 16),
(17, 21, 22),
(20, 8, 22),
(27, 8, 19),
(28, 8, 27),
(29, 8, 28),
(35, 21, 10);

-- --------------------------------------------------------

--
-- Estrutura da tabela `posts_gostos`
--

CREATE TABLE `posts_gostos` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `id_post` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `posts_gostos`
--

INSERT INTO `posts_gostos` (`id`, `id_usuario`, `id_post`) VALUES
(13, 20, 5),
(15, 8, 5),
(19, 21, 20),
(20, 21, 19),
(22, 21, 21),
(23, 21, 17),
(24, 8, 10),
(37, 8, 17),
(39, 8, 19),
(42, 8, 20),
(43, 8, 22),
(44, 8, 21),
(45, 22, 22),
(46, 22, 10),
(49, 23, 23);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` text NOT NULL,
  `genero` varchar(1) NOT NULL,
  `num_tel` int(9) NOT NULL,
  `senha` text NOT NULL,
  `foto` text NOT NULL,
  `permitido` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `genero`, `num_tel`, `senha`, `foto`, `permitido`) VALUES
(8, 'Francisco Fetapi', 'M', 111111111, '96e79218965eb72c92a549dd5a330112', '7786e29e35f8edb72a2a101f60883d9c.jpg', 'sim'),
(20, 'Luciana Mateus', 'F', 222222222, 'e3ceb5881a0a1fdaad01296d7554868d', '37e24b0787c076160902d750a508be8d.jpg', 'sim'),
(21, 'Adriano Gunga', 'M', 333333333, '1a100d2c0dab19c4430e7d73762b3423', '20a4a51cf7e3caf2a0ff02e0d9acbc0f.jpg', 'sim'),
(22, 'Adalberto Victor', 'M', 444444444, '73882ab1fa529d7273da0db6b49cc4f3', 'b6895c7ae9eabb8c297f39f1a5a5ff8d.jpg', 'sim'),
(23, 'Emanuel Tavares', 'M', 555555555, '5b1b68a9abf4d2cd155c81a9225fd158', '06c82d35d42c52e2d9a39adf3ca35db5.jpg', 'sim');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts_comentarios`
--
ALTER TABLE `posts_comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts_comentarios_gostos`
--
ALTER TABLE `posts_comentarios_gostos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts_gostos`
--
ALTER TABLE `posts_gostos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `posts_comentarios`
--
ALTER TABLE `posts_comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `posts_comentarios_gostos`
--
ALTER TABLE `posts_comentarios_gostos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `posts_gostos`
--
ALTER TABLE `posts_gostos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
