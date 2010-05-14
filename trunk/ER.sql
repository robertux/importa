-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.0.51a-community-nt

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `importa` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci ;
USE `importa`;

-- -----------------------------------------------------
-- Table `importa`.`marca`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `importa`.`marca` ;

CREATE  TABLE IF NOT EXISTS `importa`.`marca` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(100) NOT NULL ,
  `url_imagen` VARCHAR(200) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `importa`.`tipo_articulo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `importa`.`tipo_articulo` ;

CREATE  TABLE IF NOT EXISTS `importa`.`tipo_articulo` (
  `id` INT UNSIGNED NOT NULL ,
  `nombre` VARCHAR(200) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `importa`.`articulo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `importa`.`articulo` ;

CREATE  TABLE IF NOT EXISTS `importa`.`articulo` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `tipo` INT UNSIGNED NOT NULL ,
  `modelo` VARCHAR(200) NOT NULL ,
  `anio` INT NOT NULL ,
  `marca` INT UNSIGNED NOT NULL ,
  `estado` INT NOT NULL COMMENT 'se manejaran los estados desde php y no se almacenaran en una tabla aparte' ,
  `url_imagen` VARCHAR(200) NULL ,
  `precio` DOUBLE UNSIGNED NOT NULL ,
  `descripcion` TEXT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_articulo_marca` (`marca` ASC) ,
  INDEX `fk_articulo_tipo` (`tipo` ASC) ,
  CONSTRAINT `fk_articulo_marca`
    FOREIGN KEY (`marca` )
    REFERENCES `importa`.`marca` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_articulo_tipo`
    FOREIGN KEY (`tipo` )
    REFERENCES `importa`.`tipo_articulo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `importa`.`accesorio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `importa`.`accesorio` ;

CREATE  TABLE IF NOT EXISTS `importa`.`accesorio` (
  `id` INT UNSIGNED NOT NULL ,
  `nombre` VARCHAR(200) NOT NULL ,
  `marca` INT UNSIGNED NOT NULL ,
  `modelo` VARCHAR(200) NOT NULL ,
  `url_imagen` VARCHAR(200) NULL ,
  `precio` DOUBLE UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_accesorio_marca` (`marca` ASC) ,
  CONSTRAINT `fk_accesorio_marca`
    FOREIGN KEY (`marca` )
    REFERENCES `importa`.`marca` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `importa`.`compatible_articulo_acc`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `importa`.`compatible_articulo_acc` ;

CREATE  TABLE IF NOT EXISTS `importa`.`compatible_articulo_acc` (
  `id` INT UNSIGNED NOT NULL ,
  `idarticulo` INT UNSIGNED NOT NULL ,
  `idaccesorio` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_compatible_articulo_acc` (`idarticulo` ASC) ,
  INDEX `fk_compatible_accesorio_acc` (`idaccesorio` ASC) ,
  CONSTRAINT `fk_compatible_articulo_acc`
    FOREIGN KEY (`idarticulo` )
    REFERENCES `importa`.`articulo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_compatible_accesorio_acc`
    FOREIGN KEY (`idaccesorio` )
    REFERENCES `importa`.`accesorio` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `importa`.`repuesto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `importa`.`repuesto` ;

CREATE  TABLE IF NOT EXISTS `importa`.`repuesto` (
  `id` INT UNSIGNED NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `marca` INT UNSIGNED NOT NULL ,
  `modelo` VARCHAR(200) NOT NULL ,
  `url_imagen` VARCHAR(200) NULL ,
  `precio` DOUBLE UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_repuesto_marca` (`marca` ASC) ,
  CONSTRAINT `fk_repuesto_marca`
    FOREIGN KEY (`marca` )
    REFERENCES `importa`.`marca` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `importa`.`compatible_articulo_rep`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `importa`.`compatible_articulo_rep` ;

CREATE  TABLE IF NOT EXISTS `importa`.`compatible_articulo_rep` (
  `id` INT UNSIGNED NOT NULL ,
  `idarticulo` INT UNSIGNED NOT NULL ,
  `idrepuesto` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_compatible_articulo_rep` (`idarticulo` ASC) ,
  INDEX `fk_compatible_repuesto_rep` (`idrepuesto` ASC) ,
  CONSTRAINT `fk_compatible_articulo_rep`
    FOREIGN KEY (`idarticulo` )
    REFERENCES `importa`.`articulo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_compatible_repuesto_rep`
    FOREIGN KEY (`idrepuesto` )
    REFERENCES `importa`.`repuesto` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `importa`.`oferta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `importa`.`oferta` ;

CREATE  TABLE IF NOT EXISTS `importa`.`oferta` (
  `id` INT UNSIGNED NOT NULL ,
  `descripcion` VARCHAR(500) NOT NULL ,
  `fecha_inicio` DATETIME NOT NULL ,
  `fecha_fin` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `importa`.`Usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `importa`.`Usuario` ;

CREATE  TABLE IF NOT EXISTS `importa`.`Usuario` (
  `id` INT UNSIGNED NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `clave` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `importa`.`item_oferta`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `importa`.`item_oferta` ;

CREATE  TABLE IF NOT EXISTS `importa`.`item_oferta` (
  `id` INT UNSIGNED NOT NULL ,
  `oferta` INT UNSIGNED NOT NULL ,
  `iditem` INT UNSIGNED NOT NULL ,
  `tipoitem` INT UNSIGNED NOT NULL ,
  `cantidaditem` INT UNSIGNED NOT NULL ,
  `descuento` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_item_oferta_oferta` (`oferta` ASC) ,
  CONSTRAINT `fk_item_oferta_oferta`
    FOREIGN KEY (`oferta` )
    REFERENCES `importa`.`oferta` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
