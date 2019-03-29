create schema fproject;
USE `fproject` ;

-- -----------------------------------------------------
-- Table `fproject`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fproject`.`category` (
  `catID` INT(11) NOT NULL AUTO_INCREMENT,
  `catName` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`catID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `fproject`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fproject`.`users` (
  `userID` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `email` VARCHAR(100) NOT NULL,
  `password` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC),
  UNIQUE INDEX `password_UNIQUE` (`password` ASC),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `fproject`.`cookbook`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fproject`.`cookbook` (
  `bookID` INT(11) NOT NULL AUTO_INCREMENT,
  `bookName` VARCHAR(200) NOT NULL,
  `bookDesc` TEXT NOT NULL,
  `cb_userID` INT(11) NOT NULL,
  PRIMARY KEY (`bookID`),
  INDEX `fk_cookBook_users_idx` (`cb_userID` ASC),
  CONSTRAINT `fk_cookBook_users`
    FOREIGN KEY (`cb_userID`)
    REFERENCES `fproject`.`users` (`userID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `fproject`.`recipes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fproject`.`recipes` (
  `recipeID` INT(11) NOT NULL AUTO_INCREMENT,
  `image` MEDIUMBLOB NOT NULL,
  `recipeTitle` TEXT NOT NULL,
  `recipeDesc` TEXT NOT NULL,
  `ingredients` TEXT NOT NULL,
  `directions` TEXT NOT NULL,
  `prepTime` VARCHAR(45) NOT NULL,
  `cookTime` VARCHAR(45) NOT NULL,
  `servings` INT(11) NOT NULL,
  `view` VARCHAR(45) NOT NULL,
  `r_catID` INT(11) NOT NULL,
  `r_userID` INT(11) NOT NULL,
  PRIMARY KEY (`recipeID`),
  INDEX `fk_recipes_category1_idx` (`r_catID` ASC),
  INDEX `fk_recipes_users1_idx` (`r_userID` ASC),
  CONSTRAINT `fk_recipes_category1`
    FOREIGN KEY (`r_catID`)
    REFERENCES `fproject`.`category` (`catID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_recipes_users1`
    FOREIGN KEY (`r_userID`)
    REFERENCES `fproject`.`users` (`userID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `fproject`.`cookbook_has_recipes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fproject`.`cookbook_has_recipes` (
  `cookBook_bookID` INT(11) NOT NULL,
  `recipes_recipeID` INT(11) NOT NULL,
  PRIMARY KEY (`cookBook_bookID`, `recipes_recipeID`),
  INDEX `fk_cookBook_has_recipes_recipes1_idx` (`recipes_recipeID` ASC),
  INDEX `fk_cookBook_has_recipes_cookBook1_idx` (`cookBook_bookID` ASC),
  CONSTRAINT `fk_cookBook_has_recipes_cookBook1`
    FOREIGN KEY (`cookBook_bookID`)
    REFERENCES `fproject`.`cookbook` (`bookID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_cookBook_has_recipes_recipes1`
    FOREIGN KEY (`recipes_recipeID`)
    REFERENCES `fproject`.`recipes` (`recipeID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `fproject`.`review`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `fproject`.`review` (
  `reviewID` INT(11) NOT NULL AUTO_INCREMENT,
  `reviewComment` TEXT NOT NULL,
  `reviewDate` DATETIME NOT NULL,
  `review_recipeID` INT(11) NOT NULL,
  `review_userID` INT(11) NOT NULL,
  PRIMARY KEY (`reviewID`),
  INDEX `fk_review_recipes1_idx` (`review_recipeID` ASC),
  INDEX `fk_review_users1_idx` (`review_userID` ASC),
  CONSTRAINT `fk_review_recipes1`
    FOREIGN KEY (`review_recipeID`)
    REFERENCES `fproject`.`recipes` (`recipeID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_review_users1`
    FOREIGN KEY (`review_userID`)
    REFERENCES `fproject`.`users` (`userID`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;

insert into users ( `userID`, `username`, `email`, `password`)
Values ('1', 'zero', 'zero@gmail.com', '1234');

delete from recipes;

select * from recipes;

select * from users;