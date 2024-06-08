---------------------
-- Schema mydb
---------------------
DROP SCHEMA IF EXISTS `mydb` ; 
---------------------
-- Schema mydb
---------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE 
utf8_general_ci ; 
USE `mydb` ; 
---------------------
-- Table `mydb`.`regions`
---------------------
DROP TABLE IF EXISTS `mydb`.`regions` ; 
CREATE TABLE IF NOT EXISTS `mydb`.`regions` (
`id_reg` INT NOT NULL AUTO_INCREMENT COMMENT '', `description` VARCHAR(90) 
NOT NULL COMMENT '',
`status` ENUM('A', 'I', 'trash') NOT NULL DEFAULT 'A' COMMENT '', PRIMARY KEY 
(`id_reg`) COMMENT '') 
ENGINE = MyISAM;
---------------------
-- Table `mydb`.`communes`
---------------------
DROP TABLE IF EXISTS `mydb`.`communes` ; 
CREATE TABLE IF NOT EXISTS `mydb`.`communes` (
`id_com` INT NOT NULL AUTO_INCREMENT COMMENT '', `id_reg` INT NOT NULL 
COMMENT '',
`description` VARCHAR(90) NOT NULL COMMENT '',
`status` ENUM('A', 'I', 'trash') NOT NULL DEFAULT 'A' COMMENT '', PRIMARY KEY 
(`id_com`, `id_reg`) COMMENT '',
INDEX `fk_communes_region_idx` (`id_reg` ASC) COMMENT '') 
ENGINE = MyISAM; 
---------------------
-- Table `mydb`.`customers`
---------------------
DROP TABLE IF EXISTS `mydb`.`customers` ; 
CREATE TABLE IF NOT EXISTS `mydb`.`customers` (
`dni` VARCHAR(45) NOT NULL COMMENT 'Documento de Identidad',
`id_reg` INT NOT NULL COMMENT '',
`id_com` INT NOT NULL COMMENT '',
`email` VARCHAR(120) NOT NULL COMMENT 'Correo Electrónico',
`name` VARCHAR(45) NOT NULL COMMENT 'Nombre',
`last_name` VARCHAR(45) NOT NULL COMMENT 'Apellido',
`address` VARCHAR(255) NULL COMMENT 'Dirección',
`date_reg` DATETIME NOT NULL COMMENT 'Fecha y hora del registro',
`status` ENUM('A', 'I', 'trash') NOT NULL DEFAULT 'A' COMMENT 'estado del registro:\nA 
: Activo\nI : Desactivo\ntrash : Registro eliminado',
PRIMARY KEY (`dni`, `id_reg`, `id_com`) COMMENT '',
INDEX `fk_customers_communes1_idx` (`id_com` ASC, `id_reg` ASC) COMMENT '', 
UNIQUE INDEX `email_UNIQUE` (`email` ASC) COMMENT '') 
ENGINE = MyISAM;
 