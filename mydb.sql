SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `mydb` ;
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET latin1 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(45) NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `trn_date` DATETIME NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mydb`.`fecha`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`fecha` (
  `id_fecha` INT(11) NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(255) NULL DEFAULT NULL ,
  `start` DATETIME NULL DEFAULT NULL ,
  `end` DATETIME NULL DEFAULT NULL ,
  `users_id` INT(11) NOT NULL ,
  `url` VARCHAR(255) NULL DEFAULT NULL ,
  `allDay` VARCHAR(255) NULL DEFAULT NULL ,
  PRIMARY KEY (`id_fecha`, `users_id`) ,
  INDEX `fk_fecha_users1_idx` (`users_id` ASC) ,
  CONSTRAINT `fk_fecha_users1`
    FOREIGN KEY (`users_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 18
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mydb`.`ramo`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`ramo` (
  `id_ramo` INT(11) NOT NULL AUTO_INCREMENT ,
  `nombre_ramo` VARCHAR(45) NULL DEFAULT NULL ,
  `dificultad_ramo` FLOAT NULL DEFAULT NULL ,
  `promedio_ramo` FLOAT NULL DEFAULT NULL ,
  `users_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id_ramo`, `users_id`) ,
  INDEX `fk_ramo_users_idx` (`users_id` ASC) ,
  CONSTRAINT `fk_ramo_users`
    FOREIGN KEY (`users_id` )
    REFERENCES `mydb`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 12
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `mydb`.`nota`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`nota` (
  `id_nota` INT(11) NOT NULL AUTO_INCREMENT ,
  `nota` FLOAT NULL DEFAULT NULL ,
  `ponderacion` FLOAT NULL DEFAULT NULL ,
  `ramo_id_ramo` INT(11) NOT NULL ,
  `ramo_users_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id_nota`, `ramo_id_ramo`, `ramo_users_id`) ,
  INDEX `fk_nota_ramo1_idx` (`ramo_id_ramo` ASC, `ramo_users_id` ASC) ,
  CONSTRAINT `fk_nota_ramo1`
    FOREIGN KEY (`ramo_id_ramo` , `ramo_users_id` )
    REFERENCES `mydb`.`ramo` (`id_ramo` , `users_id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
