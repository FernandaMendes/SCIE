SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `scie` ;
CREATE SCHEMA IF NOT EXISTS `scie` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `scie` ;

-- -----------------------------------------------------
-- Table `scie`.`user`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scie`.`user` ;

CREATE TABLE IF NOT EXISTS `scie`.`user` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `cpf` VARCHAR(11) NOT NULL,
  `telefone` VARCHAR(15) NOT NULL,
  `endereco` VARCHAR(255) NOT NULL,
  `cidade` VARCHAR(255) NOT NULL,
  `estado` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `senha` VARCHAR(255) NOT NULL,
  `tipo` TINYINT NOT NULL DEFAULT 0,
  `departamento` VARCHAR(255) NULL,
  `status` TINYINT NOT NULL DEFAULT 0,
  `salt` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cpf_UNIQUE` (`cpf` ASC),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scie`.`armazem`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scie`.`armazem` ;

CREATE TABLE IF NOT EXISTS `scie`.`armazem` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `endereco` VARCHAR(255) NOT NULL,
  `cidade` VARCHAR(255) NOT NULL,
  `estado` VARCHAR(255) NOT NULL,
  `telefone` VARCHAR(15) NOT NULL,
  `codigo` VARCHAR(45) NOT NULL,
  `status` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scie`.`fornecedor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scie`.`fornecedor` ;

CREATE TABLE IF NOT EXISTS `scie`.`fornecedor` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `enderaco` VARCHAR(255) NOT NULL,
  `cidade` VARCHAR(255) NOT NULL,
  `estado` VARCHAR(255) NOT NULL,
  `telefone` VARCHAR(255) NOT NULL,
  `dtIclusao` DATETIME NOT NULL,
  `status` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `scie`.`item`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `scie`.`item` ;

CREATE TABLE IF NOT EXISTS `scie`.`item` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `armazem_id` INT UNSIGNED NOT NULL,
  `fornecedor_id` INT UNSIGNED NOT NULL,
  `nome` VARCHAR(255) NOT NULL,
  `dtCriacao` DATETIME NOT NULL,
  `descricao` TEXT NOT NULL,
  `custo` DOUBLE NOT NULL,
  `quantidade` INT NOT NULL DEFAULT 0,
  `status` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `fk_item_armazem_idx` (`armazem_id` ASC),
  INDEX `fk_item_fornecedor1_idx` (`fornecedor_id` ASC),
  CONSTRAINT `fk_item_armazem`
    FOREIGN KEY (`armazem_id`)
    REFERENCES `scie`.`armazem` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_item_fornecedor1`
    FOREIGN KEY (`fornecedor_id`)
    REFERENCES `scie`.`fornecedor` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
