-- MySQL Script generated by MySQL Workbench
-- Mon Mar 22 11:44:00 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema parkio
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema parkio
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `parkio` DEFAULT CHARACTER SET utf8 ;
USE `parkio` ;

-- -----------------------------------------------------
-- Table `parkio`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `parkio`.`user` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  `login` VARCHAR(40) NOT NULL,
  `password` CHAR(32) NOT NULL,
  `type` CHAR(1) NOT NULL COMMENT 'P - Porteiro\nA - Admin\nR - Ronda\nS - Sindico',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `login_UNIQUE` (`login` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `parkio`.`destination`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `parkio`.`destination` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `block` VARCHAR(20) NOT NULL,
  `apartament` VARCHAR(20) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `parkio`.`visitor_category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `parkio`.`visitor_category` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(45) NOT NULL,
  `time` SMALLINT UNSIGNED NOT NULL COMMENT 'Recommended time',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `parkio`.`gate`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `parkio`.`gate` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(45) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `parkio`.`vehicle`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `parkio`.`vehicle` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `driver_name` VARCHAR(255) NOT NULL,
  `cpf` CHAR(14) NULL,
  `plate` CHAR(10) NOT NULL,
  `model` VARCHAR(80) NULL,
  `color` VARCHAR(45) NULL,
  `time` SMALLINT UNSIGNED NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `left_at` TIMESTAMP NULL,
  `score` ENUM('G', 'B') NULL,
  `destination_id` INT NOT NULL,
  `visitor_category_id` INT NOT NULL,
  `gate_id` INT NOT NULL,
  `user_in_id` INT UNSIGNED NOT NULL,
  `user_out_id` INT UNSIGNED NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_vehicle_destination_idx` (`destination_id` ASC) VISIBLE,
  INDEX `fk_vehicle_visitor_category1_idx` (`visitor_category_id` ASC) VISIBLE,
  INDEX `fk_vehicle_gate1_idx` (`gate_id` ASC) VISIBLE,
  INDEX `fk_vehicle_user1_idx` (`user_in_id` ASC) VISIBLE,
  INDEX `fk_vehicle_user2_idx` (`user_out_id` ASC) VISIBLE,
  CONSTRAINT `fk_vehicle_destination`
    FOREIGN KEY (`destination_id`)
    REFERENCES `parkio`.`destination` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vehicle_visitor_category1`
    FOREIGN KEY (`visitor_category_id`)
    REFERENCES `parkio`.`visitor_category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vehicle_gate1`
    FOREIGN KEY (`gate_id`)
    REFERENCES `parkio`.`gate` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vehicle_user1`
    FOREIGN KEY (`user_in_id`)
    REFERENCES `parkio`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_vehicle_user2`
    FOREIGN KEY (`user_out_id`)
    REFERENCES `parkio`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `parkio`.`delay`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `parkio`.`delay` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` TEXT NOT NULL,
  `time` SMALLINT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vehicle_id` INT NOT NULL,
  `user_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_delay_vehicle1_idx` (`vehicle_id` ASC) VISIBLE,
  INDEX `fk_delay_user1_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_delay_vehicle1`
    FOREIGN KEY (`vehicle_id`)
    REFERENCES `parkio`.`vehicle` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_delay_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `parkio`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `parkio`.`complain`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `parkio`.`complain` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `plate` CHAR(10) NOT NULL,
  `description` TEXT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `vehicle_id` INT NOT NULL,
  `user_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_complain_vehicle1_idx` (`vehicle_id` ASC) VISIBLE,
  INDEX `fk_complain_user1_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_complain_vehicle1`
    FOREIGN KEY (`vehicle_id`)
    REFERENCES `parkio`.`vehicle` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_complain_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `parkio`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `parkio`.`block_manager_has_destination`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `parkio`.`block_manager_has_destination` (
  `user_id` INT UNSIGNED NOT NULL COMMENT 'Block manager - Sindico',
  `destination_id` INT NOT NULL,
  PRIMARY KEY (`user_id`, `destination_id`),
  INDEX `fk_user_has_destination_destination1_idx` (`destination_id` ASC) VISIBLE,
  INDEX `fk_user_has_destination_user1_idx` (`user_id` ASC) VISIBLE,
  CONSTRAINT `fk_user_has_destination_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `parkio`.`user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_destination_destination1`
    FOREIGN KEY (`destination_id`)
    REFERENCES `parkio`.`destination` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;