-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for dbtermin
DROP DATABASE IF EXISTS `dbtermin`;
CREATE DATABASE IF NOT EXISTS `dbtermin` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `dbtermin`;

-- Dumping structure for table dbtermin.chapters
DROP TABLE IF EXISTS `chapters`;
CREATE TABLE IF NOT EXISTS `chapters` (
  `idchapter` int NOT NULL AUTO_INCREMENT,
  `nomor_chapter` varchar(50) NOT NULL DEFAULT '',
  `namachapter` varchar(255) NOT NULL,
  `nama_singkat` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`idchapter`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dbtermin.chapters: ~22 rows (approximately)
DELETE FROM `chapters`;
INSERT INTO `chapters` (`idchapter`, `nomor_chapter`, `namachapter`, `nama_singkat`) VALUES
	(1, 'I', 'Certain infectious and parasitic diseases', 'Infeksi dan Parasit'),
	(2, 'II', 'Neoplasms', 'Neoplasma'),
	(3, 'III', 'Diseases of the blood and blood-forming organs and certain disorders involving the immune mechanism', NULL),
	(4, 'IV', 'Endocrine, nutritional and metabolic diseases', 'Endokrin'),
	(5, 'V', 'Mental and behavioural disorders', NULL),
	(6, 'VI', 'Diseases of the nervous system', NULL),
	(7, 'VII', 'Diseases of the eye and adnexa', NULL),
	(8, 'VIII', 'Diseases of the ear and mastoid process', NULL),
	(9, 'IX', 'Diseases of the circulatory system', NULL),
	(10, 'X', 'Diseases of the respiratory system', NULL),
	(11, 'XI', 'Diseases of the digestive system', NULL),
	(12, 'XII', 'Diseases of the skin and subcutaneous tissue', NULL),
	(13, 'XIII', 'Diseases of the musculoskeletal system and connective tissue', NULL),
	(14, 'XIV', 'Diseases of the genitourinary system', NULL),
	(15, 'XV', 'Pregnancy, childbirth and the puerperium', NULL),
	(16, 'XVI', 'Certain conditions originating in the perinatal period', NULL),
	(17, 'XVII', 'Congenital malformations, deformations and chromosomal abnormalities', NULL),
	(18, 'XVIII', 'Symptoms, signs and abnormal clinical and laboratory findings, not elsewhere classified', NULL),
	(19, 'XIX', 'Injury, poisoning and certain other consequences of external causes', NULL),
	(20, 'XX', 'External causes of morbidity and mortality', NULL),
	(21, 'XXI', 'Factors influencing health status and contact with health services', NULL),
	(22, 'XXII', 'Codes for special purposes', NULL);

-- Dumping structure for table dbtermin.tabeltermin
DROP TABLE IF EXISTS `tabeltermin`;
CREATE TABLE IF NOT EXISTS `tabeltermin` (
  `idtermin` int NOT NULL AUTO_INCREMENT,
  `idcicitblok` int DEFAULT NULL,
  `namatermin` varchar(255) NOT NULL,
  `pengertian` text NOT NULL,
  `keterangan` text,
  `wordroot` varchar(255) DEFAULT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `pseudosuffix` varchar(255) DEFAULT NULL,
  `pseudoroot` varchar(255) DEFAULT NULL,
  `prefix` varchar(255) DEFAULT NULL,
  `penyakit_terkait` text,
  `gambar` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idtermin`),
  KEY `idcicitblok` (`idcicitblok`),
  CONSTRAINT `tabeltermin_ibfk_1` FOREIGN KEY (`idcicitblok`) REFERENCES `tb_block_roots` (`icblockroot`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dbtermin.tabeltermin: ~0 rows (approximately)
DELETE FROM `tabeltermin`;

-- Dumping structure for table dbtermin.tb_blocks
DROP TABLE IF EXISTS `tb_blocks`;
CREATE TABLE IF NOT EXISTS `tb_blocks` (
  `idblocks` int NOT NULL AUTO_INCREMENT,
  `idchapter` int DEFAULT NULL,
  `kodeblok` varchar(50) NOT NULL,
  `namablok` varchar(255) NOT NULL,
  PRIMARY KEY (`idblocks`),
  KEY `idchapter` (`idchapter`),
  CONSTRAINT `tb_blocks_ibfk_1` FOREIGN KEY (`idchapter`) REFERENCES `chapters` (`idchapter`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dbtermin.tb_blocks: ~0 rows (approximately)
DELETE FROM `tb_blocks`;
INSERT INTO `tb_blocks` (`idblocks`, `idchapter`, `kodeblok`, `namablok`) VALUES
	(1, 1, 'A00-A09', 'Intestinal infectious diseases'),
	(2, 1, 'A15-A19', 'Tuberculosis'),
	(3, 1, 'A20-A28', 'Certain zoonotic bacterial diseases'),
	(4, 1, 'A30-A49', 'Other bacterial diseases'),
	(5, 1, 'A50-A64', 'Infections with a predominantly sexual mode of transmission'),
	(6, 1, 'A65-A69', 'Other spirochaetal diseases'),
	(7, 1, 'A70-A74', 'Other diseases caused by chlamydiae'),
	(8, 1, 'A75-A79', 'Rickettsioses'),
	(9, 1, 'A80-A89', 'Viral infections of the central nervous system'),
	(10, 1, 'A92-A99', 'Arthropod-borne viral fevers and viral haemorrhagic fevers'),
	(11, 1, 'B00-B09', 'Viral infections characterized by skin and mucous membrane lesions'),
	(12, 1, 'B15-B19', 'Viral hepatitis'),
	(13, 1, 'B20-B24', 'Human immunodeficiency virus [HIV] disease'),
	(14, 1, 'B25-B34', 'Other viral diseases'),
	(15, 1, 'B35-B49', 'Mycoses'),
	(16, 1, 'B50-B64', 'Protozoal diseases'),
	(17, 1, 'B65-B83', 'Helminthiases'),
	(18, 1, 'B85-B89', 'Pediculosis, acariasis and other infestations'),
	(19, 1, 'B90-B94', 'Sequelae of infectious and parasitic diseases'),
	(20, 1, 'B95-B98', 'Bacterial, viral and other infectious agents'),
	(21, 1, 'B99-B99', 'Other infectious diseases'),
	(22, 2, 'C00-C97', 'Malignant neoplasms'),
	(23, 2, 'D00-D09', 'In situ neoplasms'),
	(24, 2, 'D10-D36', 'Benign neoplasms'),
	(25, 2, 'D37-D48', 'Neoplasms of uncertain or unknown behaviour'),
	(26, 3, 'D50-D53', 'Nutritional anaemias'),
	(27, 3, 'D55-D59', 'Haemolytic anaemias'),
	(28, 3, 'D60-D64', 'Aplastic and other anaemias'),
	(29, 3, 'D65-D69', 'Coagulation defects, purpura and other haemorrhagic conditions'),
	(30, 3, 'D70-D77', 'Other diseases of blood and blood-forming organs'),
	(31, 3, 'D80-D89', 'Certain disorders involving the immune mechanism');

-- Dumping structure for table dbtermin.tb_block_child
DROP TABLE IF EXISTS `tb_block_child`;
CREATE TABLE IF NOT EXISTS `tb_block_child` (
  `idblockchild` int NOT NULL AUTO_INCREMENT,
  `idblock` int DEFAULT NULL,
  `kodeanakblok` varchar(50) NOT NULL,
  `keterangananakblok` text NOT NULL,
  PRIMARY KEY (`idblockchild`),
  KEY `idblock` (`idblock`),
  CONSTRAINT `tb_block_child_ibfk_1` FOREIGN KEY (`idblock`) REFERENCES `tb_blocks` (`idblocks`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dbtermin.tb_block_child: ~0 rows (approximately)
DELETE FROM `tb_block_child`;

-- Dumping structure for table dbtermin.tb_block_roots
DROP TABLE IF EXISTS `tb_block_roots`;
CREATE TABLE IF NOT EXISTS `tb_block_roots` (
  `icblockroot` int NOT NULL AUTO_INCREMENT,
  `idblockchild` int DEFAULT NULL,
  `kodeblockroots` varchar(50) NOT NULL,
  `keteranganblockroots` text NOT NULL,
  PRIMARY KEY (`icblockroot`),
  KEY `idblockchild` (`idblockchild`),
  CONSTRAINT `tb_block_roots_ibfk_1` FOREIGN KEY (`idblockchild`) REFERENCES `tb_block_child` (`idblockchild`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table dbtermin.tb_block_roots: ~0 rows (approximately)
DELETE FROM `tb_block_roots`;

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
