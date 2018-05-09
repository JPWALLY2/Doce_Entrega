-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema doce_entrega
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema doce_entrega
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `doce_entrega` DEFAULT CHARACTER SET utf8 ;
USE `doce_entrega` ;

-- -----------------------------------------------------
-- Table `doce_entrega`.`usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `doce_entrega`.`usuarios` (
  `idUsuarios` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(15) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `senha` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`idUsuarios`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `doce_entrega`.`produtos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `doce_entrega`.`produtos` (
  `idProdutos` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(20) NOT NULL,
  `nome` VARCHAR(20) NOT NULL,
  `preco` DOUBLE NOT NULL,
  `descricao` VARCHAR(100) NOT NULL,
  `usuarios_id` INT NOT NULL,
  PRIMARY KEY (`idProdutos`),
  INDEX `fk_produto_usuarios1_idx` (`usuarios_id` ASC),
  CONSTRAINT `fk_produto_usuarios1`
    FOREIGN KEY (`usuarios_id`)
    REFERENCES `doce_entrega`.`usuarios` (`idUsuarios`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `doce_entrega`.`status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `doce_entrega`.`status` (
  `idStatus` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(10) NOT NULL,
  PRIMARY KEY (`idStatus`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `doce_entrega`.`estoques`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `doce_entrega`.`estoques` (
  `idEstoques` INT NOT NULL AUTO_INCREMENT,
  `quantidade` INT NOT NULL,
  `status_id` INT NOT NULL,
  `produtos_id` INT NOT NULL,
  PRIMARY KEY (`idEstoques`),
  INDEX `fk_estoque_estatus1_idx` (`status_id` ASC),
  INDEX `fk_estoque_produto1_idx` (`produtos_id` ASC),
  CONSTRAINT `fk_estoque_estatus1`
    FOREIGN KEY (`status_id`)
    REFERENCES `doce_entrega`.`status` (`idStatus`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_estoque_produto1`
    FOREIGN KEY (`produtos_id`)
    REFERENCES `doce_entrega`.`produtos` (`idProdutos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `doce_entrega`.`clientes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `doce_entrega`.`clientes` (
  `idClientes` INT NOT NULL,
  `nome` VARCHAR(15) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `senha` VARCHAR(50) NOT NULL,
  `telefone` INT NOT NULL,
  PRIMARY KEY (`idClientes`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `doce_entrega`.`enderecos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `doce_entrega`.`enderecos` (
  `idEnderecos` INT NOT NULL AUTO_INCREMENT,
  `bairro` VARCHAR(40) NOT NULL,
  `rua` VARCHAR(35) NOT NULL,
  `numero` INT NOT NULL,
  `adicional` VARCHAR(40) NULL,
  PRIMARY KEY (`idEnderecos`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `doce_entrega`.`pedidos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `doce_entrega`.`pedidos` (
  `idPedidos` INT NOT NULL AUTO_INCREMENT,
  `quantidade` INT NOT NULL,
  `preco_total` DOUBLE NOT NULL,
  `produtos_id` INT NOT NULL,
  `clientes_id` INT NOT NULL,
  `enderecos_id` INT NOT NULL,
  PRIMARY KEY (`idPedidos`),
  INDEX `fk_pedido_produto1_idx` (`produtos_id` ASC),
  INDEX `fk_pedido_clientes1_idx` (`clientes_id` ASC),
  INDEX `fk_pedido_endereco1_idx` (`enderecos_id` ASC),
  CONSTRAINT `fk_pedido_produto1`
    FOREIGN KEY (`produtos_id`)
    REFERENCES `doce_entrega`.`produtos` (`idProdutos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_clientes1`
    FOREIGN KEY (`clientes_id`)
    REFERENCES `doce_entrega`.`clientes` (`idClientes`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pedido_endereco1`
    FOREIGN KEY (`enderecos_id`)
    REFERENCES `doce_entrega`.`enderecos` (`idEnderecos`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
