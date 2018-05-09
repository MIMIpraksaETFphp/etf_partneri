-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema etf_partneri
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema etf_partneri
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `etf_partneri` DEFAULT CHARACTER SET latin1 ;
USE `etf_partneri` ;

-- -----------------------------------------------------
-- Table `etf_partneri`.`status_ugovora`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etf_partneri`.`status_ugovora` (
  `opis` VARCHAR(100) NOT NULL,
  `idstatus_ugovora` INT(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`idstatus_ugovora`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `etf_partneri`.`partner`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etf_partneri`.`partner` (
  `idPartner` INT(11) NOT NULL AUTO_INCREMENT,
  `PIB` INT(11) NOT NULL,
  `naziv` VARCHAR(45) NOT NULL,
  `adresa` VARCHAR(80) NOT NULL,
  `grad` VARCHAR(45) NOT NULL,
  `postanski_broj` VARCHAR(45) NOT NULL,
  `drzava` VARCHAR(45) NOT NULL,
  `ziro_racun` VARCHAR(45) NOT NULL,
  `valuta_racuna` VARCHAR(10) NOT NULL,
  `ime_kontakt_osobe` VARCHAR(45) NOT NULL,
  `prezime_kontakt_osobe` VARCHAR(45) NOT NULL,
  `telefon_kontakt_osobe` VARCHAR(45) NOT NULL,
  `email_kontakt_osobe` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idPartner`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `etf_partneri`.`paketi`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etf_partneri`.`paketi` (
  `idPaketi` INT(11) NOT NULL AUTO_INCREMENT,
  `naziv_paketa` VARCHAR(45) NOT NULL,
  `vrednost_paketa` INT(11) NOT NULL,
  `trajanje_paketa` INT(11) NOT NULL,
  `maks_broj_partnera` INT(11) NOT NULL,
  PRIMARY KEY (`idPaketi`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `etf_partneri`.`ugovor`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etf_partneri`.`ugovor` (
  `idugovor` INT NOT NULL AUTO_INCREMENT,
  `datum_potpisivanja` DATETIME NOT NULL,
  `datum_isticanja` DATETIME NOT NULL,
  `partner_idPartner` INT(11) NOT NULL,
  `paketi_idPaketi` INT(11) NOT NULL,
  PRIMARY KEY (`idugovor`),
  INDEX `fk_ugovor_partner1_idx` (`partner_idPartner` ASC),
  INDEX `fk_ugovor_paketi1_idx` (`paketi_idPaketi` ASC),
  CONSTRAINT `fk_ugovor_partner1`
    FOREIGN KEY (`partner_idPartner`)
    REFERENCES `etf_partneri`.`partner` (`idPartner`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_ugovor_paketi1`
    FOREIGN KEY (`paketi_idPaketi`)
    REFERENCES `etf_partneri`.`paketi` (`idPaketi`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etf_partneri`.`donatorski_ugovori`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etf_partneri`.`donatorski_ugovori` (
  `paket` VARCHAR(45) NOT NULL,
  `procenjena_vrednost` DOUBLE NOT NULL,
  `opis` VARCHAR(1000) NOT NULL,
  `valuta` VARCHAR(10) NOT NULL,
  `datum_isporuke` DATETIME NOT NULL,
  `komentar` VARCHAR(1000) NULL DEFAULT NULL,
  `status_ugovora_idstatus_ugovora` INT(11) NOT NULL,
  `ugovor_idugovor` INT NOT NULL,
  PRIMARY KEY (`ugovor_idugovor`),
  INDEX `fk_donatorski_ugovori_status_ugovora1_idx` (`status_ugovora_idstatus_ugovora` ASC),
  INDEX `fk_donatorski_ugovori_ugovor1_idx` (`ugovor_idugovor` ASC),
  CONSTRAINT `fk_donatorski_ugovori_status_ugovora1`
    FOREIGN KEY (`status_ugovora_idstatus_ugovora`)
    REFERENCES `etf_partneri`.`status_ugovora` (`idstatus_ugovora`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_donatorski_ugovori_ugovor1`
    FOREIGN KEY (`ugovor_idugovor`)
    REFERENCES `etf_partneri`.`ugovor` (`idugovor`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `etf_partneri`.`email_partnera`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etf_partneri`.`email_partnera` (
  `idEmail_partnera` INT(11) NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(45) NOT NULL,
  `partner_idPartner` INT(11) NOT NULL,
  PRIMARY KEY (`idEmail_partnera`),
  INDEX `fk_email_partnera_partner1_idx` (`partner_idPartner` ASC),
  CONSTRAINT `fk_email_partnera_partner1`
    FOREIGN KEY (`partner_idPartner`)
    REFERENCES `etf_partneri`.`partner` (`idPartner`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `etf_partneri`.`oglas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etf_partneri`.`oglas` (
  `idoglas` INT(11) NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45) NOT NULL,
  `opis` VARCHAR(1000) NOT NULL,
  `praksa` TINYINT(4) NOT NULL,
  `zaposlenje` TINYINT(4) NOT NULL,
  `datum_unosenja` DATETIME NOT NULL,
  `partner_idPartner` INT(11) NOT NULL,
  PRIMARY KEY (`idoglas`),
  INDEX `fk_oglas_partner1_idx` (`partner_idPartner` ASC),
  CONSTRAINT `fk_oglas_partner1`
    FOREIGN KEY (`partner_idPartner`)
    REFERENCES `etf_partneri`.`partner` (`idPartner`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `etf_partneri`.`fajl`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etf_partneri`.`fajl` (
  `idfajl` INT(11) NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45) NOT NULL,
  `oglas_idoglas` INT(11) NOT NULL,
  `putanja` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idfajl`),
  INDEX `fk_fajl_oglas1_idx` (`oglas_idoglas` ASC),
  CONSTRAINT `fk_fajl_oglas1`
    FOREIGN KEY (`oglas_idoglas`)
    REFERENCES `etf_partneri`.`oglas` (`idoglas`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `etf_partneri`.`status_korisnika`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etf_partneri`.`status_korisnika` (
  `idtable1` INT NOT NULL AUTO_INCREMENT,
  `opis` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idtable1`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `etf_partneri`.`korisnik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etf_partneri`.`korisnik` (
  `idKorisnik` INT(11) NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `ime` VARCHAR(45) NOT NULL,
  `prezime` VARCHAR(45) NOT NULL,
  `datum_rodjenja` DATE NOT NULL,
  `telefon` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `status_korisnika_idtable1` INT NOT NULL,
  PRIMARY KEY (`idKorisnik`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC),
  INDEX `fk_korisnik_status_korisnika1_idx` (`status_korisnika_idtable1` ASC),
  CONSTRAINT `fk_korisnik_status_korisnika1`
    FOREIGN KEY (`status_korisnika_idtable1`)
    REFERENCES `etf_partneri`.`status_korisnika` (`idtable1`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `etf_partneri`.`mejl`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etf_partneri`.`mejl` (
  `idmejl` INT(11) NOT NULL AUTO_INCREMENT,
  `datum_slanja` DATETIME NOT NULL,
  `sadrzaj` VARCHAR(10000) NOT NULL,
  `korisnik_idKorisnik` INT(11) NOT NULL,
  PRIMARY KEY (`idmejl`),
  INDEX `fk_mejl_korisnik1_idx` (`korisnik_idKorisnik` ASC),
  CONSTRAINT `fk_mejl_korisnik1`
    FOREIGN KEY (`korisnik_idKorisnik`)
    REFERENCES `etf_partneri`.`korisnik` (`idKorisnik`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `etf_partneri`.`novcani_ugovori`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etf_partneri`.`novcani_ugovori` (
  `paket` VARCHAR(45) NOT NULL,
  `vrednost` DOUBLE NOT NULL,
  `faktura` TINYINT(4) NOT NULL,
  `uplata` TINYINT(4) NOT NULL,
  `datum_uplate` VARCHAR(45) NULL DEFAULT NULL,
  `valuta` VARCHAR(10) NOT NULL,
  `status_ugovora_idstatus_ugovora` INT(11) NOT NULL,
  `ugovor_idugovor` INT NOT NULL,
  PRIMARY KEY (`ugovor_idugovor`),
  INDEX `fk_novcani_ugovori_status_ugovora1_idx` (`status_ugovora_idstatus_ugovora` ASC),
  INDEX `fk_novcani_ugovori_ugovor1_idx` (`ugovor_idugovor` ASC),
  CONSTRAINT `fk_novcani_ugovori_status_ugovora1`
    FOREIGN KEY (`status_ugovora_idstatus_ugovora`)
    REFERENCES `etf_partneri`.`status_ugovora` (`idstatus_ugovora`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_novcani_ugovori_ugovor1`
    FOREIGN KEY (`ugovor_idugovor`)
    REFERENCES `etf_partneri`.`ugovor` (`idugovor`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `etf_partneri`.`predavanje`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etf_partneri`.`predavanje` (
  `idpredavanje` INT(11) NOT NULL AUTO_INCREMENT,
  `naslov_srpski` VARCHAR(45) NOT NULL,
  `naslov_engleski` VARCHAR(45) NULL DEFAULT NULL,
  `opis_srpski` VARCHAR(1000) NOT NULL,
  `opis_engleski` VARCHAR(1000) NULL DEFAULT NULL,
  `cv_srpski` VARCHAR(1000) NULL DEFAULT NULL,
  `cv_engleski` VARCHAR(1000) NULL DEFAULT NULL,
  `sala` VARCHAR(45) NOT NULL,
  `vreme_predavanja` DATETIME NOT NULL,
  `ime_predavaca` VARCHAR(45) NOT NULL,
  `prezime_predavaca` VARCHAR(45) NOT NULL,
  `partner_idPartner` INT(11) NOT NULL,
  PRIMARY KEY (`idpredavanje`),
  INDEX `fk_predavanje_partner1_idx` (`partner_idPartner` ASC),
  CONSTRAINT `fk_predavanje_partner1`
    FOREIGN KEY (`partner_idPartner`)
    REFERENCES `etf_partneri`.`partner` (`idPartner`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `etf_partneri`.`primalac_mejla`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etf_partneri`.`primalac_mejla` (
  `email_primaoca` VARCHAR(45) NOT NULL,
  `mejl_idmejl` INT(11) NOT NULL,
  PRIMARY KEY (`email_primaoca`, `mejl_idmejl`),
  INDEX `fk_primalac_mejla_mejl_idx` (`mejl_idmejl` ASC),
  CONSTRAINT `fk_primalac_mejla_mejl`
    FOREIGN KEY (`mejl_idmejl`)
    REFERENCES `etf_partneri`.`mejl` (`idmejl`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `etf_partneri`.`stavke`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etf_partneri`.`stavke` (
  `idstavke` INT(11) NOT NULL AUTO_INCREMENT,
  `opis` VARCHAR(1000) NOT NULL,
  `paketi_idPaketi` INT(11) NOT NULL,
  PRIMARY KEY (`idstavke`),
  INDEX `fk_stavke_paketi1_idx` (`paketi_idPaketi` ASC),
  CONSTRAINT `fk_stavke_paketi1`
    FOREIGN KEY (`paketi_idPaketi`)
    REFERENCES `etf_partneri`.`paketi` (`idPaketi`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `etf_partneri`.`telefon_partnera`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etf_partneri`.`telefon_partnera` (
  `idTelefon_partnera` INT(11) NOT NULL AUTO_INCREMENT,
  `telefon` VARCHAR(45) NOT NULL,
  `partner_idPartner` INT(11) NOT NULL,
  PRIMARY KEY (`idTelefon_partnera`),
  INDEX `fk_telefon_partnera_partner1_idx` (`partner_idPartner` ASC),
  CONSTRAINT `fk_telefon_partnera_partner1`
    FOREIGN KEY (`partner_idPartner`)
    REFERENCES `etf_partneri`.`partner` (`idPartner`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `etf_partneri`.`korisnik_ima_partner`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etf_partneri`.`korisnik_ima_partner` (
  `korisnik_idKorisnik` INT(11) NOT NULL,
  `partner_idPartner` INT(11) NOT NULL,
  PRIMARY KEY (`korisnik_idKorisnik`, `partner_idPartner`),
  INDEX `fk_korisnik_has_partner_partner1_idx` (`partner_idPartner` ASC),
  INDEX `fk_korisnik_has_partner_korisnik1_idx` (`korisnik_idKorisnik` ASC),
  CONSTRAINT `fk_korisnik_has_partner_korisnik1`
    FOREIGN KEY (`korisnik_idKorisnik`)
    REFERENCES `etf_partneri`.`korisnik` (`idKorisnik`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE,
  CONSTRAINT `fk_korisnik_has_partner_partner1`
    FOREIGN KEY (`partner_idPartner`)
    REFERENCES `etf_partneri`.`partner` (`idPartner`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = latin1;


-- -----------------------------------------------------
-- Table `etf_partneri`.`logo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `etf_partneri`.`logo` (
  `idlogo` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45) NOT NULL,
  `putanja` VARCHAR(45) NOT NULL,
  `partner_idPartner` INT(11) NOT NULL,
  PRIMARY KEY (`idlogo`),
  INDEX `fk_logo_partner1_idx` (`partner_idPartner` ASC),
  CONSTRAINT `fk_logo_partner1`
    FOREIGN KEY (`partner_idPartner`)
    REFERENCES `etf_partneri`.`partner` (`idPartner`)
    ON DELETE NO ACTION
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
