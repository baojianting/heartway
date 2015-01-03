SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `heartway` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `heartway` ;

-- -----------------------------------------------------
-- Table `heartway`.`hw_user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heartway`.`hw_user` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `phone_number` VARCHAR(20) NOT NULL,
  `email` VARCHAR(45) NULL,
  `create_time` TIMESTAMP NOT NULL,
  `nick_name` VARCHAR(45) NOT NULL,
  `signature` VARCHAR(200) NULL,
  `gender` INT NOT NULL,
  `password` VARCHAR(200) NOT NULL,
  `avatar` VARCHAR(200) NULL,
  `islock` INT NOT NULL,
  `sub_account` VARCHAR(100) NULL,
  `sub_token` VARCHAR(100) NULL,
  `voip_account` VARCHAR(100) NULL,
  `voip_password` VARCHAR(100) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heartway`.`hw_friend_relationship`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heartway`.`hw_friend_relationship` (
  `subject_user_id` INT NOT NULL,
  `friend_user_id` INT NOT NULL,
  PRIMARY KEY (`subject_user_id`, `friend_user_id`),
  INDEX `fk_hw_user_has_hw_user_hw_user1_idx` (`friend_user_id` ASC),
  INDEX `fk_hw_user_has_hw_user_hw_user_idx` (`subject_user_id` ASC),
  CONSTRAINT `fk_hw_user_has_hw_user_hw_user`
    FOREIGN KEY (`subject_user_id`)
    REFERENCES `heartway`.`hw_user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_hw_user_has_hw_user_hw_user1`
    FOREIGN KEY (`friend_user_id`)
    REFERENCES `heartway`.`hw_user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heartway`.`hw_message`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heartway`.`hw_message` (
  `id` INT NOT NULL,
  `from_user_id` INT NOT NULL,
  `to_user_id` INT NULL,
  `message_content` VARCHAR(200) NULL,
  `message_type` INT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `heartway`.`hw_configure`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heartway`.`hw_configure` (
  `id` INT NOT NULL,
  `access_token` VARCHAR(100) NULL,
  `expires_in` TIME NULL,
  `preference` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `heartway`.`hw_group`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heartway`.`hw_group` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `group_name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(400) NULL,
  `create_time` TIMESTAMP NULL,
  `creator_id` INT NOT NULL,
  `creator_nickname` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;



-- -----------------------------------------------------
-- Table `heartway`.`hw_group_member`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heartway`.`hw_group_member` (
  `hw_user_id` INT NOT NULL,
  `hw_group_id` INT NOT NULL,
  PRIMARY KEY (`hw_user_id`, `hw_group_id`),
  INDEX `fk_hw_user_has_hw_group_hw_group1_idx` (`hw_group_id` ASC),
  INDEX `fk_hw_user_has_hw_group_hw_user1_idx` (`hw_user_id` ASC),
  CONSTRAINT `fk_hw_user_has_hw_group_hw_user1`
    FOREIGN KEY (`hw_user_id`)
    REFERENCES `heartway`.`hw_user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_hw_user_has_hw_group_hw_group1`
    FOREIGN KEY (`hw_group_id`)
    REFERENCES `heartway`.`hw_group` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heartway`.`hw_route_area`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heartway`.`hw_route_area` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `route_num` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heartway`.`hw_route`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heartway`.`hw_route` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `route_description` VARCHAR(500) NOT NULL,
  `route_location` VARCHAR(255) NULL,
  `route_points` VARCHAR(510) NOT NULL,
  `is_lock` BINARY NOT NULL DEFAULT false,
  `participate_number` INT NOT NULL DEFAULT 0,
  `route_area_id` INT NOT NULL,
  `route_title` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`, `route_area_id`),
  INDEX `fk_hw_route_hw_route_area1_idx` (`route_area_id` ASC),
  CONSTRAINT `fk_hw_route_hw_route_area1`
    FOREIGN KEY (`route_area_id`)
    REFERENCES `heartway`.`hw_route_area` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `heartway`.`hw_rankinglist`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `heartway`.`hw_rankinglist` (
  `hw_user_id` INT NOT NULL,
  `hw_route_id` INT NOT NULL,
  `average_speed` INT NOT NULL,
  `route_points` VARCHAR(510) NOT NULL,
  PRIMARY KEY (`hw_user_id`, `hw_route_id`),
  INDEX `fk_hw_user_has_hw_route_hw_route1_idx` (`hw_route_id` ASC),
  INDEX `fk_hw_user_has_hw_route_hw_user1_idx` (`hw_user_id` ASC),
  CONSTRAINT `fk_hw_user_has_hw_route_hw_user1`
    FOREIGN KEY (`hw_user_id`)
    REFERENCES `heartway`.`hw_user` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_hw_user_has_hw_route_hw_route1`
    FOREIGN KEY (`hw_route_id`)
    REFERENCES `heartway`.`hw_route` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
