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
  `pubmed_id` INT NULL ,
  `pubmed_nr_of_citations` INT NULL ,
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
  `replication_freetext_study` TEXT NULL ,
  `certainty_key_effect_tests` VARCHAR(45) NULL ,
  `certainty_replication_status` VARCHAR(45) NULL ,
  `study_comment` VARCHAR(45) NULL ,
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
  `name` VARCHAR(255) NULL DEFAULT NULL ,
  `hypothesized` VARCHAR(45) NULL DEFAULT NULL ,
  `prior_hypothesis` TEXT NULL DEFAULT NULL ,
  `analytic_design_code` VARCHAR(45) NULL DEFAULT NULL ,
  `methodology_codes` TEXT NULL DEFAULT NULL ,
  `independent_variables` TEXT NULL DEFAULT NULL ,
  `dependent_variables` TEXT NULL DEFAULT NULL ,
  `other_variables` TEXT NULL DEFAULT NULL ,
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
  `reported_effect_size_statistic` VARCHAR(45) NULL DEFAULT NULL ,
  `reported_effect_size_statistic_value` DOUBLE NULL DEFAULT NULL ,
  `certainty_hypothesis` VARCHAR(45) NULL ,
  `certainty_meth_var` VARCHAR(45) NULL ,
  `certainty_statistics` VARCHAR(45) NULL ,
  `certainty_hypothesis_supported` VARCHAR(45) NULL ,
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
-- Placeholder table for view `joined_codedpapers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `joined_codedpapers` (`DOI` INT, `APA` INT, `title` INT, `first_author` INT, `journal` INT, `volume` INT, `issue` INT, `publisher` INT, `URL` INT, `year` INT, `page` INT, `type` INT, `abstract` INT, `readers` INT, `pubmed_id` INT, `pubmed_nr_of_citations` INT, `paper_id` INT, `user_id` INT, `created` INT, `modified` INT, `completed` INT, `number_of_citations` INT, `group_id` INT, `username` INT, `email` INT, `affiliated_institution` INT, `occupation` INT, `your_expertise` INT, `codedpaper_id` INT, `study_name` INT, `replication_code` INT, `replicates_study_id` INT, `replication_freetext` INT, `study_id` INT, `test_name` INT, `analytic_design_code` INT, `methodology_codes` INT, `independent_variables` INT, `dependent_variables` INT, `other_variables` INT, `hypothesized` INT, `prior_hypothesis` INT, `data_points_excluded` INT, `reasons_for_exclusions` INT, `type_of_statistical_test_used` INT, `N_used_in_analysis` INT, `inferential_test_statistic` INT, `inferential_test_statistic_value` INT, `degrees_of_freedom` INT, `reported_significance_of_test` INT, `computed_significance_of_test` INT, `hypothesis_supported` INT, `reported_effect_size_statistic` INT, `reported_effect_size_statistic_value` INT, `comment` INT);

-- -----------------------------------------------------
-- View `joined_codedpapers`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `joined_codedpapers` ;
DROP TABLE IF EXISTS `joined_codedpapers`;
CREATE  OR REPLACE VIEW `joined_codedpapers` AS
SELECT papers.DOI, papers.APA, papers.title, papers.first_author, papers.journal, papers.volume, 
papers.issue, papers.publisher, papers.URL, papers.year, papers.page, papers.type, 
papers.abstract, papers.readers, papers.pubmed_id, papers.pubmed_nr_of_citations,

codedpapers.paper_id, user_id, codedpapers.created, codedpapers.modified, codedpapers.completed, 
codedpapers.number_of_citations,

users.group_id, users.username, users.email, users.affiliated_institution, users.occupation, 
users.your_expertise,

studies.codedpaper_id, studies.name AS study_name, 
studies.replication_code, studies.replicates_study_id, studies.replication_freetext,

tests.study_id, tests.name AS test_name, tests.analytic_design_code, tests.methodology_codes, 
tests.independent_variables, tests.dependent_variables, tests.other_variables,
tests.hypothesized, tests.prior_hypothesis, tests.data_points_excluded,
tests.reasons_for_exclusions, tests.type_of_statistical_test_used, tests.N_used_in_analysis,
tests.inferential_test_statistic, tests.inferential_test_statistic_value, tests.degrees_of_freedom,
tests.reported_significance_of_test, tests.computed_significance_of_test, tests.hypothesis_supported,
tests.reported_effect_size_statistic, tests.reported_effect_size_statistic_value, tests.`comment`
	FROM papers 
	INNER JOIN codedpapers
		ON papers.id = codedpapers.paper_id
	LEFT JOIN users
		ON codedpapers.user_id = users.id
	LEFT JOIN studies
		ON codedpapers.id = studies.codedpaper_id
	LEFT JOIN tests
		ON studies.id = tests.study_id;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
