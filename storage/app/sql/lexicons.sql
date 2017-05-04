# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.17)
# Database: glossari
# Generation Time: 2017-05-04 01:24:20 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table lexicons
# ------------------------------------------------------------

LOCK TABLES `lexicons` WRITE;
/*!40000 ALTER TABLE `lexicons` DISABLE KEYS */;

INSERT INTO `lexicons` (`id`, `parent_id`, `name`, `tag`, `created_at`, `updated_at`)
VALUES
	(1,NULL,'Kata Nama','KN','2014-12-29 11:13:23','2014-12-29 11:13:23'),
	(2,NULL,'Kata Kerja','KK','2014-12-29 11:13:23','2014-12-29 11:13:23'),
	(3,NULL,'Kata Adjektif','ADJ','2014-12-29 11:13:23','2014-12-29 11:13:23'),
	(4,NULL,'Kata Sendi Nama','KSN','2014-12-29 11:13:23','2014-12-29 11:13:23'),
	(5,NULL,'Kata Bantu','KB','2014-12-29 11:13:23','2014-12-29 11:13:23'),
	(6,NULL,'Kata Ganti Nama','KG','2014-12-29 11:13:23','2014-12-29 11:13:23'),
	(7,NULL,'Kata Hubung','KH','2014-12-29 11:13:23','2014-12-29 11:13:23'),
	(8,NULL,'Kata Adverba','ADV','2014-12-29 11:13:23','2014-12-29 11:13:23'),
	(9,NULL,'Kata Seru','SR','2014-12-29 11:13:23','2014-12-29 11:13:23'),
	(10,NULL,'Kata Tanya','KT','2014-12-29 11:13:23','2014-12-29 11:13:23'),
	(11,NULL,'Kata Bilangan','KBIL','2014-12-29 11:13:23','2014-12-29 11:13:23'),
	(12,NULL,'Kata Pemeri','KPM','2014-12-29 11:13:23','2014-12-29 11:13:23'),
	(13,NULL,'Kata Perintah','KP','2014-12-29 11:13:23','2014-12-29 11:13:23'),
	(14,NULL,'Kata Arah','KAR','2014-12-29 11:13:23','2014-12-29 11:13:23'),
	(15,NULL,'Penanda Wacana','PW','2014-12-29 11:13:23','2014-12-29 11:13:23'),
	(16,NULL,'Awalan','AWL','2014-12-29 11:13:23','2014-12-29 11:13:23'),
	(17,NULL,'Ringkasan','KEP','2014-12-29 11:13:23','2014-12-29 11:13:23'),
	(18,NULL,'Kata Nafi','KNF','2014-12-29 11:13:23','2014-12-29 11:13:23'),
	(19,NULL,'Tiada','NON','2014-12-30 03:17:09','2014-12-30 03:17:09'),
	(20,NULL,'Kata Nama Khas','KNK','2015-01-28 15:12:29','2015-01-28 15:12:29'),
	(21,NULL,'Kata Ganti Nama Diri','KGN','2015-01-28 15:12:51','2015-01-28 15:12:51'),
	(22,NULL,'Kata Ganti Nama Tunjuk','KGT','2015-01-28 15:13:11','2015-01-28 15:13:11'),
	(23,NULL,'Bahasa Asing','BA','2015-01-28 15:14:23','2015-01-28 15:14:28'),
	(24,NULL,'Akronim','AKR','2015-01-28 15:16:33','2015-01-28 15:16:33'),
	(25,NULL,'Noktah','.','2015-02-16 22:48:21','2015-02-16 22:48:26'),
	(26,NULL,'Koma',',','2015-02-16 22:48:21','2015-02-16 22:48:25'),
	(27,NULL,'Tanda Seru','!','2015-02-16 22:48:22','2015-02-16 22:48:24'),
	(28,NULL,'Tanda Soal','?','2015-02-16 22:48:24','2015-02-16 22:48:24'),
	(29,6,'Kata Ganti Nama Diri Pertama','KGNP','2017-05-04 04:38:03','2017-05-04 04:38:03'),
	(30,6,'Kata Ganti Nama Diri Kedua','KGND','2017-05-04 04:38:26','2017-05-04 04:38:26'),
	(31,6,'Kata Ganti Nama Diri Ketiga','KGNT','2017-05-04 04:38:46','2017-05-04 04:38:46'),
	(32,29,'Kata Ganti Nama Diri Pertama Tunggal','KGNPT','2017-05-04 04:41:43','2017-05-04 04:41:43'),
	(33,29,'Kata Ganti Nama Diri Pertama Jamak','KGNPJ','2017-05-04 04:42:17','2017-05-04 04:42:17'),
	(34,31,'Kata Ganti Nama Diri Ketiga Tunggal','KGNTT','2017-05-04 04:42:54','2017-05-04 04:42:54'),
	(35,31,'Kata Ganti Nama Diri Ketiga Jamak','KGNTJ','2017-05-04 04:43:17','2017-05-04 04:43:17');

/*!40000 ALTER TABLE `lexicons` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
