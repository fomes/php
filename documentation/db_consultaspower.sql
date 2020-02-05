-- phpMyAdmin SQL Dump
-- version 4.6.5.1deb3+deb.cihar.com~precise.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 22/01/2020 às 11:59
-- Versão do servidor: 5.6.36
-- Versão do PHP: 7.1.1-1+deb.sury.org~precise+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_consultaspower`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_agendamentos`
--

CREATE TABLE `tb_agendamentos` (
  `id_agendamento` int(11) NOT NULL,
  `agendamento_horario` varchar(255) NOT NULL,
  `medico_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `agendamento_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_medicos`
--

CREATE TABLE `tb_medicos` (
  `id_medico` int(11) NOT NULL,
  `medico_nome` varchar(255) NOT NULL,
  `medico_especialidade` varchar(50) NOT NULL,
  `medico_endereco` varchar(255) NOT NULL,
  `medico_telefone` varchar(30) NOT NULL,
  `medico_crm` varchar(35) NOT NULL,
  `medico_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_perfis`
--

CREATE TABLE `tb_perfis` (
  `id_perfil` int(11) NOT NULL,
  `perfil_nome` varchar(50) NOT NULL,
  `perfil_pagina` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `tb_perfis`
--

INSERT INTO `tb_perfis` (`id_perfil`, `perfil_nome`, `perfil_pagina`) VALUES
(1, 'Admin', 'admin.php'),
(2, 'Médico', 'medical.php');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuarios`
--

CREATE TABLE `tb_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `usuario_nome` varchar(255) NOT NULL,
  `usuario_email` varchar(255) NOT NULL,
  `usuario_senha` varchar(255) NOT NULL,
  `usuario_contato` varchar(30) NOT NULL,
  `usuario_cpf` varchar(25) NOT NULL,
  `usuario_dt_nasc` date NOT NULL,
  `usuario_endereco` varchar(255) NOT NULL,
  `usuario_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `perfil_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Fazendo dump de dados para tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id_usuario`, `usuario_nome`, `usuario_email`, `usuario_senha`, `usuario_contato`, `usuario_cpf`, `usuario_dt_nasc`, `usuario_endereco`, `usuario_criacao`, `perfil_id`) VALUES
(1, 'Anthony Jefferson', 'utd.anthony@gmail.com', '$2y$10$q7ThC1WMvzSi4Mh1OOOPSOWemyJoIs.ya8cgT/SKrlV5AUEzBAt9m', '(85) 99999-0000', '603.935.073-35', '1990-01-01', 'Rua Bem Alí, 32, Good Garden', '2020-01-17 12:18:55', 1),
(2, 'Patricia da Silva', 'paty@email.com', '$2y$10$X8nCNqa2KUElLASvLW92o.tcmd3Bvk6srOWjwF6t4FPXuVib3OwD2', '(85) 999544262', '123.123.123-90', '1992-04-07', 'Rua Belos Portos, 38, Passaré', '2020-01-22 12:02:52', 1);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `tb_agendamentos`
--
ALTER TABLE `tb_agendamentos`
  ADD PRIMARY KEY (`id_agendamento`),
  ADD KEY `medico_id` (`medico_id`,`usuario_id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `tb_medicos`
--
ALTER TABLE `tb_medicos`
  ADD PRIMARY KEY (`id_medico`);

--
-- Índices de tabela `tb_perfis`
--
ALTER TABLE `tb_perfis`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Índices de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `usuario_email` (`usuario_email`),
  ADD UNIQUE KEY `usuario_cpf` (`usuario_cpf`),
  ADD KEY `perfil_id` (`perfil_id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `tb_agendamentos`
--
ALTER TABLE `tb_agendamentos`
  MODIFY `id_agendamento` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `tb_medicos`
--
ALTER TABLE `tb_medicos`
  MODIFY `id_medico` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de tabela `tb_perfis`
--
ALTER TABLE `tb_perfis`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de tabela `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `tb_agendamentos`
--
ALTER TABLE `tb_agendamentos`
  ADD CONSTRAINT `tb_agendamentos_ibfk_1` FOREIGN KEY (`medico_id`) REFERENCES `tb_medicos` (`id_medico`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tb_agendamentos_ibfk_2` FOREIGN KEY (`usuario_id`) REFERENCES `tb_usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Restrições para tabelas `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
  ADD CONSTRAINT `tb_usuarios_ibfk_1` FOREIGN KEY (`perfil_id`) REFERENCES `tb_perfis` (`id_perfil`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
