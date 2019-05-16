-- Create by : Diego Sanchez
-- Description : Projet TPI, TaskAndGo, gestion de tâches et rendez-vous
-- Date : 14.05.2019



-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema TaskAndGo
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema TaskAndGo
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `TaskAndGo` DEFAULT CHARACTER SET utf8 ;
USE `TaskAndGo` ;

-- -----------------------------------------------------
-- Table `TaskAndGo`.`DisplayMode`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TaskAndGo`.`displayMode` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TaskAndGo`.`User`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TaskAndGo`.`user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `firstName` VARCHAR(30) NOT NULL,
  `lastName` VARCHAR(30) NOT NULL,
  `password` VARCHAR(30) NOT NULL,
  `email` VARCHAR(75) NOT NULL,
  `reminder` TINYINT NOT NULL,
  `termBefore` TIME NOT NULL,
  `id_DisplayMode` INT NOT NULL,
  `displayNumber` INT NOT NULL,
  `isAdmin` TINYINT(1) NOT NULL,
  `isActive` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `id_Role_idx` (`id_DisplayMode` ASC) VISIBLE,
  CONSTRAINT `id_Display`
    FOREIGN KEY (`id_DisplayMode`)
    REFERENCES `TaskAndGo`.`displayMode` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TaskAndGo`.`Meet`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TaskAndGo`.`meet` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(100) NOT NULL,
  `hour` DATETIME NOT NULL,
  `term` TIME NOT NULL,
  `place` VARCHAR(40) NOT NULL,
  `comment` VARCHAR(100) NOT NULL,
  `id_Meeting_User` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `id_User_idx` (`id_Meeting_User` ASC) VISIBLE,
  CONSTRAINT `id_Meeting_User`
    FOREIGN KEY (`id_Meeting_User`)
    REFERENCES `TaskAndGo`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TaskAndGo`.`State`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TaskAndGo`.`state` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TaskAndGo`.`Task`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `TaskAndGo`.`task` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(100) NOT NULL,
  `hour` DATETIME NOT NULL,
  `id_Task_User` INT NOT NULL,
  `id_State` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `id_User_idx` (`id_Task_User` ASC) VISIBLE,
  INDEX `id_State_idx` (`id_State` ASC) VISIBLE,
  CONSTRAINT `id_Task_Userr`
    FOREIGN KEY (`id_Task_User`)
    REFERENCES `TaskAndGo`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `id_State`
    FOREIGN KEY (`id_State`)
    REFERENCES `TaskAndGo`.`state` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
