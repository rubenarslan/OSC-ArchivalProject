SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `archival` ;
CREATE SCHEMA IF NOT EXISTS `archival` DEFAULT CHARACTER SET latin1 ;
USE `archival` ;

-- -----------------------------------------------------
-- Table `archival`.`papers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `archival`.`papers` ;

CREATE  TABLE IF NOT EXISTS `archival`.`papers` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `doi` VARCHAR(255) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `archival`.`groups`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `archival`.`groups` ;

CREATE  TABLE IF NOT EXISTS `archival`.`groups` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL DEFAULT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `archival`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `archival`.`users` ;

CREATE  TABLE IF NOT EXISTS `archival`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `group_id` INT(11) NOT NULL ,
  `username` VARCHAR(255) NULL DEFAULT NULL ,
  `password` VARCHAR(255) NULL DEFAULT NULL ,
  `email` VARCHAR(255) NULL DEFAULT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_users_groups1_idx` (`group_id` ASC) ,
  CONSTRAINT `fk_users_groups1`
    FOREIGN KEY (`group_id` )
    REFERENCES `archival`.`groups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `archival`.`codedpapers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `archival`.`codedpapers` ;

CREATE  TABLE IF NOT EXISTS `archival`.`codedpapers` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `paper_id` INT(11) NOT NULL ,
  `user_id` INT(11) NOT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
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
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `archival`.`studies`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `archival`.`studies` ;

CREATE  TABLE IF NOT EXISTS `archival`.`studies` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `replication_code` VARCHAR(255) NULL DEFAULT NULL ,
  `codedpaper_id` INT(11) NOT NULL ,
  `replicates_study_id` INT(11) NULL DEFAULT NULL ,
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
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `archival`.`effects`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `archival`.`effects` ;

CREATE  TABLE IF NOT EXISTS `archival`.`effects` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `study_id` INT(11) NOT NULL ,
  `prior_hypothesis` TEXT NULL DEFAULT NULL ,
  `novel_effect` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_effects_studies1_idx` (`study_id` ASC) ,
  CONSTRAINT `fk_effects_studies1`
    FOREIGN KEY (`study_id` )
    REFERENCES `archival`.`studies` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `archival`.`tests`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `archival`.`tests` ;

CREATE  TABLE IF NOT EXISTS `archival`.`tests` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `effect_id` INT(11) NOT NULL ,
  `analytic_design_code` VARCHAR(45) NULL DEFAULT NULL ,
  `methodology_codes` VARCHAR(45) NULL DEFAULT NULL ,
  `independent_variables` TEXT NULL DEFAULT NULL ,
  `dependent_variables` TEXT NULL DEFAULT NULL ,
  `other_variables` TEXT NULL DEFAULT NULL ,
  `data_points_excluded` INT(11) NULL DEFAULT NULL ,
  `reasons_for_exclusions` TEXT NULL DEFAULT NULL ,
  `type_statistical_test` VARCHAR(255) NULL DEFAULT NULL ,
  `N_used` INT(11) NULL DEFAULT NULL ,
  `inferential_test_statistic` VARCHAR(255) NULL DEFAULT NULL ,
  `inferential_test_statistic_value` DOUBLE NULL DEFAULT NULL ,
  `degrees_of_freedom` DOUBLE NULL DEFAULT NULL ,
  `reported_significance_of_test` DOUBLE NULL DEFAULT NULL ,
  `computed_significance_of_test` DOUBLE NULL DEFAULT NULL ,
  `main_result_of_test` VARCHAR(255) NULL DEFAULT NULL ,
  `reported_effect_size` DOUBLE NULL DEFAULT NULL ,
  `computed_effect_size` DOUBLE NULL DEFAULT NULL ,
  `reported_statistical_power` DOUBLE NULL DEFAULT NULL ,
  `computed_statistical_power` DOUBLE NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  UNIQUE INDEX `test_id_UNIQUE` (`id` ASC) ,
  INDEX `fk_tests_effects1_idx` (`effect_id` ASC) ,
  CONSTRAINT `fk_tests_effects1`
    FOREIGN KEY (`effect_id` )
    REFERENCES `archival`.`effects` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `archival`.`papers`
-- -----------------------------------------------------
START TRANSACTION;
USE `archival`;
INSERT INTO `archival`.`papers` (`id`, `doi`) VALUES (1, 'testpaper');

COMMIT;

-- -----------------------------------------------------
-- Data for table `archival`.`groups`
-- -----------------------------------------------------
START TRANSACTION;
USE `archival`;
INSERT INTO `archival`.`groups` (`id`, `name`, `created`, `modified`) VALUES (1, 'admin', '2012-11-08 00:00:00', '2012-11-08 00:00:00');
INSERT INTO `archival`.`groups` (`id`, `name`, `created`, `modified`) VALUES (2, 'manager', '2012-11-08 00:00:00', '2012-11-08 00:00:00');
INSERT INTO `archival`.`groups` (`id`, `name`, `created`, `modified`) VALUES (3, 'user', '2012-11-08 00:00:00', '2012-11-08 00:00:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `archival`.`users`
-- -----------------------------------------------------
START TRANSACTION;
USE `archival`;
INSERT INTO `archival`.`users` (`id`, `group_id`, `username`, `password`, `email`, `created`) VALUES (1, 1, 'ruben', 'e24396d1f42befa5f644081e395228c71027d94e', 'rubenarslan@gmail.com', '2012-11-08 00:00:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `archival`.`codedpapers`
-- -----------------------------------------------------
START TRANSACTION;
USE `archival`;
INSERT INTO `archival`.`codedpapers` (`id`, `paper_id`, `user_id`, `created`, `modified`) VALUES (1, 1, 1, NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `archival`.`studies`
-- -----------------------------------------------------
START TRANSACTION;
USE `archival`;
INSERT INTO `archival`.`studies` (`id`, `replication_code`, `codedpaper_id`, `replicates_study_id`) VALUES (1, 'NON', 1, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `archival`.`effects`
-- -----------------------------------------------------
START TRANSACTION;
USE `archival`;
INSERT INTO `archival`.`effects` (`id`, `study_id`, `prior_hypothesis`, `novel_effect`) VALUES (1, 1, 'None', 'Yes');

COMMIT;

-- -----------------------------------------------------
-- Data for table `archival`.`tests`
-- -----------------------------------------------------
START TRANSACTION;
USE `archival`;
INSERT INTO `archival`.`tests` (`id`, `effect_id`, `analytic_design_code`, `methodology_codes`, `independent_variables`, `dependent_variables`, `other_variables`, `data_points_excluded`, `reasons_for_exclusions`, `type_statistical_test`, `N_used`, `inferential_test_statistic`, `inferential_test_statistic_value`, `degrees_of_freedom`, `reported_significance_of_test`, `computed_significance_of_test`, `main_result_of_test`, `reported_effect_size`, `computed_effect_size`, `reported_statistical_power`, `computed_statistical_power`) VALUES (1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

COMMIT;
