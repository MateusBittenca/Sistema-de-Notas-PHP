#create database feitaTecnica
#use feitaTencinca

CREATE TABLE IF NOT EXISTS `feitaTecnica`.`Curso` (
  `idCurso` INT NOT NULL AUTO_INCREMENT,
  `nomeCurso` VARCHAR(45) NULL,
  PRIMARY KEY (`idCurso`))
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `feitaTecnica`.`Trabalho` (
  `idTrabalho` INT NOT NULL AUTO_INCREMENT,
  `nomeTrabalho` VARCHAR(128) NOT NULL,
  `resumo` VARCHAR(256) NULL,
  `Curso_idCurso` INT NOT NULL,
  PRIMARY KEY (`idTrabalho`),
  INDEX `fk_Trabalho_Curso1_idx` (`Curso_idCurso` ASC),
  CONSTRAINT `fk_Trabalho_Curso1`
    FOREIGN KEY (`Curso_idCurso`)
    REFERENCES `feitaTecnica`.`Curso` (`idCurso`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `feitaTecnica`.`AlunosGrupo` (
  `Trabalho_idTrabalho` INT NOT NULL,
  `matriculaAluno` VARCHAR(45) NOT NULL,
  `nomeAluno` VARCHAR(45) NOT NULL,
  `turmaAluno` VARCHAR(45) NULL,
  INDEX `fk_Trabalho_has_Curso_Trabalho_idx` (`Trabalho_idTrabalho` ASC),
  PRIMARY KEY (`matriculaAluno`, `Trabalho_idTrabalho`),
  CONSTRAINT `fk_Trabalho_has_Curso_Trabalho`
    FOREIGN KEY (`Trabalho_idTrabalho`)
    REFERENCES `feitaTecnica`.`Trabalho` (`idTrabalho`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS `feitaTecnica`.`professor` (
  `registro` INT NOT NULL,
  `nome` VARCHAR(45) NULL,
  `nascimento` VARCHAR(45) NULL,
  PRIMARY KEY (`registro`))
ENGINE = InnoDB;


CREATE TABLE IF NOT EXISTS `feitaTecnica`.`Avaliacao` (
  `idAvaliacao` INT NOT NULL AUTO_INCREMENT,
  `professor_registro` INT NULL,
  `notaGeral` FLOAT NULL,
  `obs` VARCHAR(45) NULL,
  `Trabalho_idTrabalho` INT NOT NULL,
  PRIMARY KEY (`idAvaliacao`),
  INDEX `fk_Avaliacao_professor1_idx` (`professor_registro` ASC),
  INDEX `fk_Avaliacao_Trabalho1_idx` (`Trabalho_idTrabalho` ASC),
  CONSTRAINT `fk_Avaliacao_professor1`
    FOREIGN KEY (`professor_registro`)
    REFERENCES `feitaTecnica`.`professor` (`registro`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Avaliacao_Trabalho1`
    FOREIGN KEY (`Trabalho_idTrabalho`)
    REFERENCES `feitaTecnica`.`Trabalho` (`idTrabalho`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;











