SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';


-- -----------------------------------------------------
-- Table `papers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `papers` ;

CREATE  TABLE IF NOT EXISTS `papers` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `DOI` VARCHAR(255) NULL DEFAULT NULL ,
  `APA` TEXT NULL ,
  `title` VARCHAR(255) NULL ,
  `first_author` VARCHAR(255) NULL ,
  `journal` VARCHAR(255) NULL ,
  `volume` VARCHAR(45) NULL ,
  `issue` VARCHAR(45) NULL ,
  `publisher` VARCHAR(255) NULL ,
  `URL` VARCHAR(255) NULL ,
  `year` INT NULL ,
  `page` VARCHAR(45) NULL ,
  `type` VARCHAR(100) NULL ,
  `abstract` TEXT NULL ,
  `readers` INT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `groups`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `groups` ;

CREATE  TABLE IF NOT EXISTS `groups` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(255) NULL DEFAULT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `users` ;

CREATE  TABLE IF NOT EXISTS `users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `group_id` INT(11) NOT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  `username` VARCHAR(255) NULL DEFAULT NULL ,
  `password` VARCHAR(255) NULL DEFAULT NULL ,
  `email` VARCHAR(255) NULL DEFAULT NULL ,
  `affiliated_institution` VARCHAR(255) NULL ,
  `occupation` VARCHAR(255) NULL ,
  `your_expertise` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_users_groups1_idx` (`group_id` ASC) ,
  CONSTRAINT `fk_users_groups1`
    FOREIGN KEY (`group_id` )
    REFERENCES `groups` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `codedpapers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `codedpapers` ;

CREATE  TABLE IF NOT EXISTS `codedpapers` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `paper_id` INT(11) NOT NULL ,
  `user_id` INT(11) NOT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_codedpapers_papers_idx` (`paper_id` ASC) ,
  INDEX `fk_codedpapers_users1_idx` (`user_id` ASC) ,
  UNIQUE INDEX `paper_user` (`paper_id` ASC, `user_id` ASC) ,
  CONSTRAINT `fk_codedpapers_papers`
    FOREIGN KEY (`paper_id` )
    REFERENCES `papers` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_codedpapers_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `studies`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `studies` ;

CREATE  TABLE IF NOT EXISTS `studies` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `codedpaper_id` INT(11) NOT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  `name` VARCHAR(255) NULL DEFAULT NULL ,
  `replication_code` VARCHAR(255) NULL DEFAULT NULL ,
  `replicates_study_id` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_studies_codedpapers1_idx` (`codedpaper_id` ASC) ,
  INDEX `fk_studies_studies1_idx` (`replicates_study_id` ASC) ,
  CONSTRAINT `fk_studies_codedpapers1`
    FOREIGN KEY (`codedpaper_id` )
    REFERENCES `codedpapers` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_studies_studies1`
    FOREIGN KEY (`replicates_study_id` )
    REFERENCES `studies` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `effects`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `effects` ;

CREATE  TABLE IF NOT EXISTS `effects` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `study_id` INT(11) NOT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  `name` VARCHAR(255) NULL DEFAULT NULL ,
  `prior_hypothesis` TEXT NULL DEFAULT NULL ,
  `novel_effect` VARCHAR(45) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_effects_studies1_idx` (`study_id` ASC) ,
  CONSTRAINT `fk_effects_studies1`
    FOREIGN KEY (`study_id` )
    REFERENCES `studies` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `tests`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tests` ;

CREATE  TABLE IF NOT EXISTS `tests` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `effect_id` INT(11) NOT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
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
    REFERENCES `effects` (`id` )
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `cake_sessions`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `cake_sessions` ;

CREATE  TABLE IF NOT EXISTS `cake_sessions` (
  `id` VARCHAR(255) NOT NULL ,
  `data` TEXT NULL ,
  `expires` INT(11) NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `papers`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `papers` (`id`, `DOI`, `APA`, `title`, `first_author`, `journal`, `volume`, `issue`, `publisher`, `URL`, `year`, `page`, `type`, `abstract`, `readers`) VALUES (1, 'testpaper', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `groups`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `groups` (`id`, `name`, `created`, `modified`) VALUES (1, 'admin', '2012-11-08 00:00:00', '2012-11-08 00:00:00');
INSERT INTO `groups` (`id`, `name`, `created`, `modified`) VALUES (2, 'manager', '2012-11-08 00:00:00', '2012-11-08 00:00:00');
INSERT INTO `groups` (`id`, `name`, `created`, `modified`) VALUES (3, 'user', '2012-11-08 00:00:00', '2012-11-08 00:00:00');

COMMIT;

-- -----------------------------------------------------
-- Data for table `users`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `users` (`id`, `group_id`, `created`, `modified`, `username`, `password`, `email`, `affiliated_institution`, `occupation`, `your_expertise`) VALUES (1, 1, '2012-11-08 00:00:00', NULL, 'ruben', 'e24396d1f42befa5f644081e395228c71027d94e', 'rubenarslan@gmail.com', NULL, NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `codedpapers`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `codedpapers` (`id`, `paper_id`, `user_id`, `created`, `modified`) VALUES (1, 1, 1, NULL, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `studies`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `studies` (`id`, `codedpaper_id`, `created`, `modified`, `name`, `replication_code`, `replicates_study_id`) VALUES (1, 1, NULL, NULL, NULL, 'NON', NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `effects`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `effects` (`id`, `study_id`, `created`, `modified`, `name`, `prior_hypothesis`, `novel_effect`) VALUES (1, 1, NULL, NULL, NULL, 'None', 'Yes');

COMMIT;

-- -----------------------------------------------------
-- Data for table `tests`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `tests` (`id`, `effect_id`, `created`, `modified`, `analytic_design_code`, `methodology_codes`, `independent_variables`, `dependent_variables`, `other_variables`, `data_points_excluded`, `reasons_for_exclusions`, `type_statistical_test`, `N_used`, `inferential_test_statistic`, `inferential_test_statistic_value`, `degrees_of_freedom`, `reported_significance_of_test`, `computed_significance_of_test`, `main_result_of_test`, `reported_effect_size`, `computed_effect_size`, `reported_statistical_power`, `computed_statistical_power`) VALUES (1, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

COMMIT;
