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
  `completed` TINYINT(1) NULL ,
  `number_of_citations` INT NULL ,
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
  `replication_freetext` TEXT NULL DEFAULT NULL ,
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
-- Table `tests`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tests` ;

CREATE  TABLE IF NOT EXISTS `tests` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `study_id` INT(11) NOT NULL ,
  `created` DATETIME NULL DEFAULT NULL ,
  `modified` DATETIME NULL DEFAULT NULL ,
  `name` VARCHAR(255) NULL ,
  `hypothesized` VARCHAR(45) NULL ,
  `prior_hypothesis` TEXT NULL ,
  `analytic_design_code` VARCHAR(45) NULL DEFAULT NULL ,
  `data_points_excluded` INT(11) NULL DEFAULT NULL ,
  `reasons_for_exclusions` TEXT NULL DEFAULT NULL ,
  `type_of_statistical_test_used` VARCHAR(255) NULL DEFAULT NULL ,
  `N_used_in_analysis` INT(11) NULL DEFAULT NULL ,
  `inferential_test_statistic` VARCHAR(255) NULL DEFAULT NULL ,
  `inferential_test_statistic_value` DOUBLE NULL DEFAULT NULL ,
  `degrees_of_freedom` VARCHAR(45) NULL DEFAULT NULL ,
  `reported_significance_of_test` VARCHAR(45) NULL DEFAULT NULL ,
  `computed_significance_of_test` DOUBLE NULL DEFAULT NULL ,
  `hypothesis_supported` VARCHAR(255) NULL DEFAULT NULL ,
  `reported_effect_size_statistic` VARCHAR(45) NULL ,
  `reported_effect_size_statistic_value` DOUBLE NULL DEFAULT NULL ,
  `comment` TEXT NULL DEFAULT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_tests_studies1_idx` (`study_id` ASC) ,
  CONSTRAINT `fk_tests_studies1`
    FOREIGN KEY (`study_id` )
    REFERENCES `studies` (`id` )
    ON DELETE NO ACTION
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


-- -----------------------------------------------------
-- Table `methodology_codes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `methodology_codes` ;

CREATE  TABLE IF NOT EXISTS `methodology_codes` (
  `id` INT NOT NULL ,
  `name` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `independent_variables`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `independent_variables` ;

CREATE  TABLE IF NOT EXISTS `independent_variables` (
  `id` INT NOT NULL ,
  `test_id` INT(11) NOT NULL ,
  `name` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_independent_variables_tests1_idx` (`test_id` ASC) ,
  INDEX `unique_var` (`test_id` ASC, `name` ASC) ,
  CONSTRAINT `fk_independent_variables_tests1`
    FOREIGN KEY (`test_id` )
    REFERENCES `tests` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `dependent_variables`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `dependent_variables` ;

CREATE  TABLE IF NOT EXISTS `dependent_variables` (
  `id` INT NOT NULL ,
  `test_id` INT(11) NOT NULL ,
  `name` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_independent_variables_tests1_idx` (`test_id` ASC) ,
  INDEX `unique_var` (`test_id` ASC, `name` ASC) ,
  CONSTRAINT `fk_independent_variables_tests10`
    FOREIGN KEY (`test_id` )
    REFERENCES `tests` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `other_variables`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `other_variables` ;

CREATE  TABLE IF NOT EXISTS `other_variables` (
  `id` INT NOT NULL ,
  `test_id` INT(11) NOT NULL ,
  `name` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_independent_variables_tests1_idx` (`test_id` ASC) ,
  INDEX `unique_var` (`test_id` ASC, `name` ASC) ,
  CONSTRAINT `fk_independent_variables_tests100`
    FOREIGN KEY (`test_id` )
    REFERENCES `tests` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `tests_to_methodology_codes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `tests_to_methodology_codes` ;

CREATE  TABLE IF NOT EXISTS `tests_to_methodology_codes` (
  `methodology_code_id` INT NOT NULL ,
  `test_id` INT(11) NOT NULL ,
  INDEX `fk_tests_to_methodology_codes_methodology_codes1_idx` (`methodology_code_id` ASC) ,
  INDEX `fk_tests_to_methodology_codes_tests1_idx` (`test_id` ASC) ,
  CONSTRAINT `fk_tests_to_methodology_codes_methodology_codes1`
    FOREIGN KEY (`methodology_code_id` )
    REFERENCES `methodology_codes` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_tests_to_methodology_codes_tests1`
    FOREIGN KEY (`test_id` )
    REFERENCES `tests` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Placeholder table for view `joined_codedpapers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `joined_codedpapers` (`DOI` INT, `APA` INT, `title` INT, `first_author` INT, `journal` INT, `volume` INT, `issue` INT, `publisher` INT, `URL` INT, `year` INT, `page` INT, `type` INT, `abstract` INT, `readers` INT, `paper_id` INT, `user_id` INT, `created` INT, `modified` INT, `completed` INT, `group_id` INT, `username` INT, `email` INT, `affiliated_institution` INT, `occupation` INT, `your_expertise` INT, `codedpaper_id` INT, `study_name` INT, `replication_code` INT, `replicates_study_id` INT, `study_id` INT, `test_name` INT, `analytic_design_code` INT, `methodology_codes` INT, `independent_variables` INT, `dependent_variables` INT, `other_variables` INT, `hypothesized` INT, `prior_hypothesis` INT, `data_points_excluded` INT, `reasons_for_exclusions` INT, `type_of_statistical_test_used` INT, `N_used_in_analysis` INT, `inferential_test_statistic` INT, `inferential_test_statistic_value` INT, `degrees_of_freedom` INT, `reported_significance_of_test` INT, `computed_significance_of_test` INT, `hypothesis_supported` INT, `reported_effect_size_statistic` INT, `reported_effect_size_statistic_value` INT);

-- -----------------------------------------------------
-- View `joined_codedpapers`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `joined_codedpapers` ;
DROP TABLE IF EXISTS `joined_codedpapers`;
CREATE  OR REPLACE VIEW `joined_codedpapers` AS
SELECT papers.DOI, papers.APA, papers.title, papers.first_author, papers.journal, papers.volume, 
papers.issue, papers.publisher, papers.URL, papers.year, papers.page, papers.type, 
papers.abstract, papers.readers,

codedpapers.paper_id, user_id, codedpapers.created, codedpapers.modified, codedpapers.completed,

users.group_id, users.username, users.email, users.affiliated_institution, users.occupation, 
users.your_expertise,

studies.codedpaper_id, studies.name AS study_name, studies.replication_code, studies.replicates_study_id,
tests.study_id, tests.name AS test_name, tests.analytic_design_code, 
GROUP_CONCAT(methodology_codes.name SEPARATOR ', ') AS methodology_codes,
GROUP_CONCAT(independent_variables.name SEPARATOR ', ') AS independent_variables,
GROUP_CONCAT(dependent_variables.name SEPARATOR ', ') AS dependent_variables,
GROUP_CONCAT(other_variables.name SEPARATOR ', ') AS other_variables,
tests.hypothesized, tests.prior_hypothesis, tests.data_points_excluded,
tests.reasons_for_exclusions, tests.type_of_statistical_test_used, tests.N_used_in_analysis,
tests.inferential_test_statistic, tests.inferential_test_statistic_value, tests.degrees_of_freedom,
tests.reported_significance_of_test, tests.computed_significance_of_test, tests.hypothesis_supported,
tests.reported_effect_size_statistic, tests.reported_effect_size_statistic_value
	FROM papers 
	INNER JOIN codedpapers
		ON papers.id = codedpapers.paper_id
	LEFT JOIN users
		ON codedpapers.user_id = users.id
	LEFT JOIN studies
		ON codedpapers.id = studies.codedpaper_id
	LEFT JOIN tests
		ON studies.id = tests.study_id
	LEFT JOIN tests_to_methodology_codes
		ON tests.id = tests_to_methodology_codes.test_id	
	LEFT JOIN methodology_codes
		ON tests_to_methodology_codes.methodology_code_id = methodology_codes.id	
	LEFT JOIN independent_variables
		ON tests.id = independent_variables.test_id
	LEFT JOIN dependent_variables
		ON tests.id = dependent_variables.test_id
	LEFT JOIN other_variables
		ON tests.id = other_variables.test_id
	GROUP BY tests.id;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `papers`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `papers` (`id`, `DOI`, `APA`, `title`, `first_author`, `journal`, `volume`, `issue`, `publisher`, `URL`, `year`, `page`, `type`, `abstract`, `readers`) VALUES (1, '10.1080/10463280701489053', 'Nosek, B. A., Smyth, F. L., Hansen, J. J., Devos, T., Lindner, N. M., Ranganath, K. A., ... & Banaji, M. R. (2007). Pervasiveness and correlates of implicit attitudes and stereotypes. European Review of Social Psychology, 18(1), 36-88.', 'Pervasiveness and correlates of implicit attitudes and stereotypes', 'Nosek', 'EUROPEAN REVIEW OF SOCIAL PSYCHOLOGY', '18', NULL, NULL, NULL, NULL, '36-88', 'journal', 'http://implicit.harvard.edu/ was created to provide experience with the Implicit Association Test (IAT), a procedure designed to measure social knowledge that may operate outside awareness or control. Significant by-products of the website’s existence are large datasets contributed to by the site’s many visitors. This article summarises data from more than 2.5 million completed IATs and self-reports across 17 topics obtained between July 2000 and May 2006. In addition to reinforcing several published findings with a heterogeneous sample, the data help to establish that: (a) implicit preferences and stereotypes are pervasive across demographic groups and topics, (b) as with self-report, there is substantial inter-individual variability in implicit attitudes and stereotypes, (c) variations in gender, ethnicity, age, and political orientation predict variation in implicit and explicit measures, and (d) implicit and explicit attitudes and stereotypes are related, but distinct.', NULL);

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
INSERT INTO `codedpapers` (`id`, `paper_id`, `user_id`, `created`, `modified`, `completed`, `number_of_citations`) VALUES (1, 1, 1, NULL, NULL, 0, NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `studies`
-- -----------------------------------------------------
START TRANSACTION;
INSERT INTO `studies` (`id`, `codedpaper_id`, `created`, `modified`, `name`, `replication_code`, `replicates_study_id`, `replication_freetext`) VALUES (1, 1, NULL, NULL, NULL, 'NON', NULL, NULL);

COMMIT;
