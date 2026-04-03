SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;

CREATE SCHEMA IF NOT EXISTS `projeto_gerenciamento_adocao_animais`
DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE `projeto_gerenciamento_adocao_animais`;

-- =========================
-- TABELA: USERS
-- =========================
CREATE TABLE `users` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` ENUM('ADOTANTE', 'PROTETOR') NOT NULL DEFAULT 'ADOTANTE',
  `cnpj` VARCHAR(45) UNIQUE NULL,
  `cpf` VARCHAR(45) UNIQUE NULL,
  `telefone` VARCHAR(45) NULL,
  `celular` VARCHAR(45) NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
) ENGINE=InnoDB;

-- =========================
-- TABELA: ENDERECOS
-- =========================
CREATE TABLE `enderecos` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `logradouro` VARCHAR(255) NOT NULL,
  `numero` VARCHAR(10) NOT NULL,
  `complemento` VARCHAR(45) NULL,
  `cidade` VARCHAR(255) NOT NULL,
  `estado` VARCHAR(255) NOT NULL,
  `cep` VARCHAR(20) NOT NULL,
  `user_id` BIGINT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
    ON DELETE CASCADE
) ENGINE=InnoDB;

-- =========================
-- TABELA: ESPECIES
-- =========================
CREATE TABLE `especies` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(255) NOT NULL UNIQUE,
  `descricao` TEXT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL
) ENGINE=InnoDB;

-- =========================
-- TABELA: RACAS
-- =========================
CREATE TABLE `racas` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(255) NOT NULL,
  `descricao` TEXT NULL,
  `especie_id` BIGINT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,
  UNIQUE (`nome`, `especie_id`),
  FOREIGN KEY (`especie_id`) REFERENCES `especies`(`id`)
    ON DELETE CASCADE
) ENGINE=InnoDB;

-- =========================
-- TABELA: ANIMAIS
-- =========================
CREATE TABLE `animais` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nome` VARCHAR(255) NOT NULL,
  `data_nascimento` DATE NULL,
  `sexo` ENUM('MACHO', 'FEMEA') NOT NULL,
  `porte` ENUM('PEQUENO', 'MEDIO', 'GRANDE') NULL,
  `descricao` TEXT NULL,
  `status` ENUM('DISPONIVEL', 'EM_PROCESSO', 'ADOTADO') NOT NULL DEFAULT 'DISPONIVEL',
  `user_id` BIGINT UNSIGNED NOT NULL,
  `raca_id` BIGINT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,

  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
    ON DELETE RESTRICT,

  FOREIGN KEY (`raca_id`) REFERENCES `racas`(`id`)
    ON DELETE RESTRICT
) ENGINE=InnoDB;

-- =========================
-- TABELA: ADOCOES
-- =========================
CREATE TABLE `adocoes` (
  `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `data_requisicao` DATETIME NULL,
  `data_adocao` DATETIME NULL,
  `descricao` TEXT NULL,
  `status` ENUM('PENDENTE', 'APROVADA', 'RECUSADA') NOT NULL DEFAULT 'PENDENTE',
  `user_id` BIGINT UNSIGNED NOT NULL,
  `animal_id` BIGINT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NULL,
  `updated_at` TIMESTAMP NULL,

  UNIQUE (`user_id`, `animal_id`),

  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
    ON DELETE CASCADE,

  FOREIGN KEY (`animal_id`) REFERENCES `animais`(`id`)
    ON DELETE CASCADE
) ENGINE=InnoDB;

SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;