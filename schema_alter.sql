SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `default_schema` ;

ALTER TABLE `archival`.`studies` ADD COLUMN `replication` VARCHAR(45) NULL DEFAULT NULL  AFTER `name` ;

ALTER TABLE `archival`.`tests` CHANGE COLUMN `N_used_in_analysis` `N_used_in_analysis` INT(11) NULL DEFAULT NULL  AFTER `data_points_excluded` , ADD COLUMN `N_total` INT(11) NULL DEFAULT NULL  AFTER `other_variables` , ADD COLUMN `subsample` TEXT NULL DEFAULT NULL  AFTER `comment` ;

ALTER TABLE `archival`.`users` ADD COLUMN `hashed_reset_token` VARCHAR(255) NULL DEFAULT NULL  AFTER `your_expertise` , ADD COLUMN `reset_token_expiration` DATETIME NULL DEFAULT NULL  AFTER `hashed_reset_token` ;


-- -----------------------------------------------------
-- Placeholder table for view `archival`.`joined_codedpapers`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `archival`.`joined_codedpapers` (`DOI` INT, `APA` INT, `title` INT, `first_author` INT, `journal` INT, `volume` INT, `issue` INT, `publisher` INT, `URL` INT, `year` INT, `page` INT, `type` INT, `abstract` INT, `readers` INT, `pubmed_id` INT, `pubmed_nr_of_citations` INT, `paper_id` INT, `user_id` INT, `created` INT, `modified` INT, `completed` INT, `number_of_citations` INT, `group_id` INT, `username` INT, `email` INT, `affiliated_institution` INT, `occupation` INT, `your_expertise` INT, `codedpaper_id` INT, `study_name` INT, `replication` INT, `replication_code` INT, `replicates_study_id` INT, `replication_freetext` INT, `replication_freetext_study` INT, `certainty_key_effect_tests` INT, `certainty_replication_status` INT, `study_comment` INT, `study_id` INT, `test_name` INT, `hypothesized` INT, `prior_hypothesis` INT, `analytic_design_code` INT, `methodology_codes` INT, `independent_variables` INT, `dependent_variables` INT, `other_variables` INT, `N_total` INT, `data_points_excluded` INT, `N_used_in_analysis` INT, `reasons_for_exclusions` INT, `type_of_statistical_test_used` INT, `inferential_test_statistic` INT, `inferential_test_statistic_value` INT, `degrees_of_freedom` INT, `reported_significance_of_test` INT, `computed_significance_of_test` INT, `hypothesis_supported` INT, `reported_effect_size_statistic` INT, `reported_effect_size_statistic_value` INT, `comment` INT);


USE `archival`;

-- -----------------------------------------------------
-- View `archival`.`joined_codedpapers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `archival`.`joined_codedpapers`;
USE `archival`;
CREATE  OR REPLACE VIEW `archival`.`joined_codedpapers` AS
SELECT papers.DOI, papers.APA, papers.title, papers.first_author, papers.journal, papers.volume, 
papers.issue, papers.publisher, papers.URL, papers.year, papers.page, papers.type, 
papers.abstract, papers.readers, papers.pubmed_id, papers.pubmed_nr_of_citations,

codedpapers.paper_id, user_id, codedpapers.created, codedpapers.modified, codedpapers.completed, 
codedpapers.number_of_citations,

users.group_id, users.username, users.email, users.affiliated_institution, users.occupation, 
users.your_expertise,

studies.codedpaper_id, studies.name AS study_name, 
studies.replication, studies.replication_code, 
studies.replicates_study_id, studies.replication_freetext, studies.replication_freetext_study,
studies.certainty_key_effect_tests, studies.certainty_replication_status,
studies.study_comment,

tests.study_id, tests.name AS test_name, 
tests.hypothesized, tests.prior_hypothesis, 
tests.analytic_design_code, tests.methodology_codes, 
tests.independent_variables, tests.dependent_variables, tests.other_variables,
tests.N_total, tests.data_points_excluded, tests.N_used_in_analysis, 
tests.reasons_for_exclusions, 
tests.type_of_statistical_test_used, 
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
