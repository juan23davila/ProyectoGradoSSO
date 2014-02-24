SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `SSO_Uniquindio` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `SSO_Uniquindio` ;

-- -----------------------------------------------------
-- Table `SSO_Uniquindio`.`Usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SSO_Uniquindio`.`Usuario` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NULL COMMENT '	',
  `apellido` VARCHAR(45) NULL,
  `correo` TINYBLOB NULL,
  `direccion` VARCHAR(45) NULL COMMENT '	',
  `cedula` VARCHAR(45) NULL,
  `telefono` VARCHAR(45) NULL,
  `fecha_creacion` DATETIME NULL,
  `fecha_modificacion` DATETIME NULL,
  `activo` BINARY NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC))
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
