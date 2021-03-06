-- MySQL Script generated by MySQL Workbench
-- 02/09/17 15:55:32
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema beerecipe
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `beerecipe` ;

-- -----------------------------------------------------
-- Schema beerecipe
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `beerecipe` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `beerecipe` ;

-- -----------------------------------------------------
-- Table `beerecipe`.`recipe`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `beerecipe`.`recipe` ;

CREATE TABLE IF NOT EXISTS `beerecipe`.`recipe` (
  `uid` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Unique Identifier Number Key',
  `name` VARCHAR(256) NOT NULL COMMENT 'Name of single item',
  `description` VARCHAR(256) NOT NULL COMMENT 'Short description for this item',
  PRIMARY KEY (`uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `beerecipe`.`ingredients`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `beerecipe`.`ingredients` ;

CREATE TABLE IF NOT EXISTS `beerecipe`.`ingredients` (
  `uid` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Unique Identifier Number Key',
  `name` VARCHAR(256) NOT NULL COMMENT 'Name of single item',
  `description` VARCHAR(256) NOT NULL COMMENT 'Short description for this item',
  PRIMARY KEY (`uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `beerecipe`.`products`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `beerecipe`.`products` ;

CREATE TABLE IF NOT EXISTS `beerecipe`.`products` (
  `uid` INT UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Unique Identifier Number Key',
  `name` VARCHAR(256) NOT NULL COMMENT 'Name of single item',
  `description` VARCHAR(256) NOT NULL COMMENT 'Short description for this item',
  `price` DOUBLE NOT NULL COMMENT 'Cad. price for this item',
  `ingredients_uid` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`uid`, `ingredients_uid`),
  UNIQUE INDEX `uid_UNIQUE` (`uid` ASC),
  INDEX `fk_products_ingredients_idx` (`ingredients_uid` ASC),
  CONSTRAINT `fk_products_ingredients`
    FOREIGN KEY (`ingredients_uid`)
    REFERENCES `beerecipe`.`ingredients` (`uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `beerecipe`.`recipe_has_ingredients`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `beerecipe`.`recipe_has_ingredients` ;

CREATE TABLE IF NOT EXISTS `beerecipe`.`recipe_has_ingredients` (
  `recipe_uid` INT UNSIGNED NOT NULL,
  `ingredients_uid` INT UNSIGNED NOT NULL,
  `quantity` INT UNSIGNED NULL COMMENT 'Quantity for each single item',
  PRIMARY KEY (`recipe_uid`, `ingredients_uid`),
  INDEX `fk_recipe_has_ingredients_ingredients1_idx` (`ingredients_uid` ASC),
  INDEX `fk_recipe_has_ingredients_recipe1_idx` (`recipe_uid` ASC),
  CONSTRAINT `fk_recipe_has_ingredients_recipe1`
    FOREIGN KEY (`recipe_uid`)
    REFERENCES `beerecipe`.`recipe` (`uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_recipe_has_ingredients_ingredients1`
    FOREIGN KEY (`ingredients_uid`)
    REFERENCES `beerecipe`.`ingredients` (`uid`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
