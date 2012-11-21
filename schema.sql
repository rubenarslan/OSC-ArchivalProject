SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `archival` ;
CREATE SCHEMA IF NOT EXISTS `archival` DEFAULT CHARACTER SET latin1 ;
USE `archival` ;

-- -----------------------------------------------------
-- Table `archival`.`groups`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `archival`.`groups` ;

CREATE  TABLE IF NOT EXISTS `archival`.`groups` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `archival`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `archival`.`users` ;

CREATE  TABLE IF NOT EXISTS `archival`.`users` (
  `id` INT NOT NULL ,
  `group_id` INT NOT NULL ,
  `username` VARCHAR(255) NULL ,
  `password` VARCHAR(255) NULL ,
  `email` VARCHAR(255) NULL ,
  `created` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_users_groups1_idx` (`group_id` ASC) ,
  CONSTRAINT `fk_users_groups1`
    FOREIGN KEY (`group_id` )
    REFERENCES `archival`.`groups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `archival`.`papers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `archival`.`papers` ;

CREATE  TABLE IF NOT EXISTS `archival`.`papers` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `doi` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `archival`.`codedpapers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `archival`.`codedpapers` ;

CREATE  TABLE IF NOT EXISTS `archival`.`codedpapers` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `paper_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  `created` DATETIME NULL ,
  `modified` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_codedpapers_papers_idx` (`paper_id` ASC) ,
  INDEX `fk_codedpapers_users1_idx` (`user_id` ASC) ,
  INDEX `paper_user` (`paper_id` ASC, `user_id` ASC) ,
  CONSTRAINT `fk_codedpapers_papers`
    FOREIGN KEY (`paper_id` )
    REFERENCES `archival`.`papers` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_codedpapers_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `archival`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `archival`.`studies`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `archival`.`studies` ;

CREATE  TABLE IF NOT EXISTS `archival`.`studies` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `replication_code` VARCHAR(255) NULL ,
  `codedpaper_id` INT NOT NULL ,
  `replicates_study_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_studies_codedpapers1_idx` (`codedpaper_id` ASC) ,
  INDEX `fk_studies_studies1_idx` (`replicates_study_id` ASC) ,
  CONSTRAINT `fk_studies_codedpapers1`
    FOREIGN KEY (`codedpaper_id` )
    REFERENCES `archival`.`codedpapers` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_studies_studies1`
    FOREIGN KEY (`replicates_study_id` )
    REFERENCES `archival`.`studies` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `archival`.`effects`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `archival`.`effects` ;

CREATE  TABLE IF NOT EXISTS `archival`.`effects` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `prior_hypothesis` TEXT NULL ,
  `novel_effect` VARCHAR(45) NULL ,
  `study_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_effects_studies1_idx` (`study_id` ASC) ,
  CONSTRAINT `fk_effects_studies1`
    FOREIGN KEY (`study_id` )
    REFERENCES `archival`.`studies` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `archival`.`tests`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `archival`.`tests` ;

CREATE  TABLE IF NOT EXISTS `archival`.`tests` (
  `effect_id` INT NOT NULL AUTO_INCREMENT ,
  `id` INT NOT NULL ,
  `analytic_design_code` VARCHAR(45) NULL ,
  `methodology_codes` VARCHAR(45) NULL ,
  `independent_variables` TEXT NULL ,
  `dependent_variables` TEXT NULL ,
  `other_variables` TEXT NULL ,
  `data_points_excuded` INT NULL ,
  `reasons_for_exclusions` TEXT NULL ,
  `type_statistical_test` VARCHAR(255) NULL ,
  `N_used` INT NULL ,
  `inferential_test_statistic` VARCHAR(255) NULL ,
  `inferential_test_statistic_value` DOUBLE NULL ,
  `degrees_of_freedom` DOUBLE NULL ,
  `reported_significance_of_test` DOUBLE NULL ,
  `computed_significance_of_test` DOUBLE NULL ,
  `main_result_of_test` VARCHAR(255) NULL ,
  `reported_effect_size` DOUBLE NULL ,
  `computed_effect_size` DOUBLE NULL ,
  `reported_statistical_power` DOUBLE NULL ,
  `computed_statistical_power` DOUBLE NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `test_id_UNIQUE` (`id` ASC) ,
  INDEX `fk_tests_effects1_idx` (`effect_id` ASC) ,
  CONSTRAINT `fk_tests_effects1`
    FOREIGN KEY (`effect_id` )
    REFERENCES `archival`.`effects` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `archival`.`testtables`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `archival`.`testtables` ;

CREATE  TABLE IF NOT EXISTS `archival`.`testtables` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `prior_hypothesis` TEXT NULL ,
  `novel_effect` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
