SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `importa` ;
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
-- Table `importa`.`tipo_vehiculo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `importa`.`tipo_vehiculo` ;

CREATE  TABLE IF NOT EXISTS `importa`.`tipo_vehiculo` (
  `id` INT UNSIGNED NOT NULL ,
  `nombre` VARCHAR(200) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `importa`.`vehiculo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `importa`.`vehiculo` ;

CREATE  TABLE IF NOT EXISTS `importa`.`vehiculo` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT ,
  `tipo` INT UNSIGNED NOT NULL ,
  `modelo` VARCHAR(200) NOT NULL ,
  `anio` INT NOT NULL ,
  `marca` INT UNSIGNED NOT NULL ,
  `estado` INT NOT NULL COMMENT 'se manejaran los estados desde php y no se almacenaran en una tabla aparte' ,
  `url_imagen` VARCHAR(200) NULL ,
  PRIMARY KEY (`id`, `tipo`) ,
  INDEX `fk_vehiculo_marca` (`marca` ASC) ,
  INDEX `fk_vehiculo_tipo` (`tipo` ASC) ,
  CONSTRAINT `fk_vehiculo_marca`
    FOREIGN KEY (`marca` )
    REFERENCES `importa`.`marca` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vehiculo_tipo`
    FOREIGN KEY (`tipo` )
    REFERENCES `importa`.`tipo_vehiculo` (`id` )
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
  PRIMARY KEY (`id`) ,
  INDEX `fk_accesorio_marca` (`marca` ASC) ,
  CONSTRAINT `fk_accesorio_marca`
    FOREIGN KEY (`marca` )
    REFERENCES `importa`.`marca` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `importa`.`compatible_vehiculo_acc`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `importa`.`compatible_vehiculo_acc` ;

CREATE  TABLE IF NOT EXISTS `importa`.`compatible_vehiculo_acc` (
  `id` INT UNSIGNED NOT NULL ,
  `idvehiculo` INT UNSIGNED NOT NULL ,
  `idaccesorio` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_compatible_vehiculo` (`idvehiculo` ASC) ,
  INDEX `fk_compatible_accesorio` (`idaccesorio` ASC) ,
  CONSTRAINT `fk_compatible_vehiculo`
    FOREIGN KEY (`idvehiculo` )
    REFERENCES `importa`.`vehiculo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_compatible_accesorio`
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
  PRIMARY KEY (`id`) ,
  INDEX `fk_repuesto_marca` (`marca` ASC) ,
  CONSTRAINT `fk_repuesto_marca`
    FOREIGN KEY (`marca` )
    REFERENCES `importa`.`marca` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `importa`.`compatible_vehiculo_rep`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `importa`.`compatible_vehiculo_rep` ;

CREATE  TABLE IF NOT EXISTS `importa`.`compatible_vehiculo_rep` (
  `id` INT UNSIGNED NOT NULL ,
  `idvehiculo` INT UNSIGNED NOT NULL ,
  `idrepuesto` INT UNSIGNED NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_compatible_vehiculo` (`idvehiculo` ASC) ,
  INDEX `fk_compatible_repuesto` (`idrepuesto` ASC) ,
  CONSTRAINT `fk_compatible_vehiculo`
    FOREIGN KEY (`idvehiculo` )
    REFERENCES `importa`.`vehiculo` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_compatible_repuesto`
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
  `iditem` INT NOT NULL COMMENT 'El id del item al que se le aplica la oferta. Puede ser el id de un vehiculo, de un repuesto o de un accesorio. Dependera de la tabla tipoitem\n' ,
  `tipoitem` INT NOT NULL COMMENT 'vehiculo, repuesto  o accesorio. Definir cada uno con un numero' ,
  `descuento` INT NOT NULL ,
  `fecha_inicio` DATETIME NOT NULL ,
  `fecha_fin` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;