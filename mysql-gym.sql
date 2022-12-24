
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
DROP TABLE IF EXISTS `abonnements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abonnements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tarif` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `duree` int(11) DEFAULT NULL,
  `nbrsemaine` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activity` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `abonnements` WRITE;
/*!40000 ALTER TABLE `abonnements` DISABLE KEYS */;
INSERT INTO `abonnements` VALUES (90,'1 F/S','2400',NULL,1,'2022-12-24 16:58:53','2022-12-24 16:58:53',NULL,NULL),(91,'3 F/S','3600',NULL,3,'2022-12-24 16:59:10','2022-12-24 16:59:10',NULL,NULL),(92,'4 F/S','4200',NULL,4,'2022-12-24 16:59:51','2022-12-24 16:59:51',NULL,NULL),(89,'2 F/S','2900',NULL,2,'2022-12-24 16:37:44','2022-12-24 16:37:44',NULL,NULL);
/*!40000 ALTER TABLE `abonnements` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `prix` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_super` tinyint(1) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `password_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `solde` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'amine','admin','$2y$10$owMlo3pyZ6TaUHPVL8i/4OaWpSrfFZ3Pmw24f9dFba.Z.KYa8MWyu',0,'cApSkwMZBH89hBimhzxOYP104sOlXiOtRn8bt20ENZGyFWS1c9rqIAiLNR4h','2020-07-03 16:10:32','2020-12-16 19:49:46','lsrapide',NULL);
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `assurances`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assurances` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `membre` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `activity` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_prenom` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `sexe` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `assurances` WRITE;
/*!40000 ALTER TABLE `assurances` DISABLE KEYS */;
INSERT INTO `assurances` VALUES (1,NULL,'2022-12-24 16:50:11','2022-12-24 16:50:11',1000,NULL,NULL,'ammrai mohamed',14,'homme');
/*!40000 ALTER TABLE `assurances` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `crenaus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `crenaus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jour` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `plage` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `debut` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fin` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `crenaus` WRITE;
/*!40000 ALTER TABLE `crenaus` DISABLE KEYS */;
/*!40000 ALTER TABLE `crenaus` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `decharges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `decharges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `montant` bigint(20) DEFAULT NULL,
  `designation` text DEFAULT NULL,
  `remarque` text DEFAULT NULL,
  `date_decharge` timestamp NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `decharges` WRITE;
/*!40000 ALTER TABLE `decharges` DISABLE KEYS */;
/*!40000 ALTER TABLE `decharges` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `inscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inscriptions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `debut` date DEFAULT NULL,
  `fin` date DEFAULT NULL,
  `reste` int(11) DEFAULT NULL,
  `nbsseance` int(11) DEFAULT NULL,
  `membre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `abonnement` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `remise` int(11) DEFAULT NULL,
  `nbrmois` int(11) DEFAULT NULL,
  `versement` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sexe` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarque` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `activities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assurance` int(11) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `inscriptions` WRITE;
/*!40000 ALTER TABLE `inscriptions` DISABLE KEYS */;
INSERT INTO `inscriptions` VALUES (4,'2022-10-26','2022-12-26',6,16,'6','89','1',5800,0,2,5800,'2022-12-24 16:42:25','2022-12-24 16:51:52','homme',NULL,'null',NULL,14),(5,'2022-12-16','2023-01-16',6,8,'7','89','1',2900,0,1,2900,'2022-12-24 16:57:46','2022-12-24 16:58:19','homme',NULL,'null',NULL,14);
/*!40000 ALTER TABLE `inscriptions` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `membres`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `membres` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `prenom` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `adresse` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sexe` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `naissance` date DEFAULT NULL,
  `photo` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `matricule` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `etat` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sang` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assurance` int(11) DEFAULT 1,
  `identite` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `source` int(11) DEFAULT NULL,
  `cn` int(11) DEFAULT NULL,
  `dm` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `membres` WRITE;
/*!40000 ALTER TABLE `membres` DISABLE KEYS */;
INSERT INTO `membres` VALUES (7,'ZAIDI','ABDELKRIM','0550914230',NULL,'homme',NULL,'2thE6MzVHxXQGUL.jpg','15803477',NULL,'2022-12-24 16:57:46','2022-12-24 16:57:46','A+',NULL,NULL,NULL,NULL,2,0,0),(6,'AMMARI','MOHAMED','0553022724',NULL,'homme',NULL,'c3IqSWlRJtGqiGK.jpg','4251355',NULL,'2022-12-24 16:42:25','2022-12-24 16:47:47','A+',NULL,NULL,NULL,NULL,2,0,0);
/*!40000 ALTER TABLE `membres` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2021_03_13_181551_create_membres_table',1),(4,'2021_03_13_194057_create_inscriptions_table',1),(5,'2021_03_13_194203_create_abonnements_table',1),(18,'2021_03_14_071452_create_presences_table',9),(12,'2021_03_25_215603_create_crenaus_table',3),(8,'2021_03_27_170753_add_sanguin_to_members_table',1),(9,'2021_03_27_171133_make_sang_null',1),(11,'2021_03_29_061952_create_settings_table',2),(13,'2021_03_30_120156_add_type_to_abo',4),(14,'2021_04_03_201930_add_type_to_inscriptions',5),(15,'2021_04_03_210331_create_produits_table',6),(16,'2021_04_03_212149_create_categories_table',7),(17,'2021_04_03_212822_add_email_to_members',8),(19,'2021_04_19_162051_add_remarque',10);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `ouvertures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ouvertures` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `ouvertures` WRITE;
/*!40000 ALTER TABLE `ouvertures` DISABLE KEYS */;
/*!40000 ALTER TABLE `ouvertures` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `presences`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `presences` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `inscription` int(11) DEFAULT NULL,
  `membre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `prix` int(11) DEFAULT NULL,
  `activity` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nom_prenom` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `sexe` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `presences` WRITE;
/*!40000 ALTER TABLE `presences` DISABLE KEYS */;
INSERT INTO `presences` VALUES (1,4,'6','2022-12-24 16:45:06','2022-12-24 16:45:06',1,NULL,NULL,NULL,NULL,NULL,NULL),(2,4,'6','2022-12-24 16:45:28','2022-12-24 16:45:28',1,NULL,NULL,NULL,NULL,NULL,NULL),(3,4,'6','2022-12-24 16:45:34','2022-12-24 16:45:34',1,NULL,NULL,NULL,NULL,NULL,NULL),(4,4,'6','2022-12-24 16:45:41','2022-12-24 16:45:41',1,NULL,NULL,NULL,NULL,NULL,NULL),(5,4,'6','2022-12-24 16:45:43','2022-12-24 16:45:43',1,NULL,NULL,NULL,NULL,NULL,NULL),(6,4,'6','2022-12-24 16:45:48','2022-12-24 16:45:48',1,NULL,NULL,NULL,NULL,NULL,NULL),(7,5,'7','2022-12-24 16:58:02','2022-12-24 16:58:02',1,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `presences` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `produits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `produits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categorie` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `setting` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `produits` WRITE;
/*!40000 ALTER TABLE `produits` DISABLE KEYS */;
/*!40000 ALTER TABLE `produits` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titre` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `password_text` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isadmin` int(11) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `telephone` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lang` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (14,'Admin','gym','$2y$10$5H6ZcpKmu2fePfMdLeW1QOFe2/7m1atOkTDsOvsdgmFVYDoIyxmJS','ZXk9NyK1893YEsD1YiZbzwEURrTQrHYUZ3JSgVElccLbwoi4IkrCc7R0YbdJ','2022-11-13 12:40:12','2022-11-13 12:40:12','gym',1,NULL,NULL,'en'),(13,'mehdi','mehdi','$2y$10$3FxO/vMAVMoBWB2ajL64fOUnZBcbBAyXG.ExBLIcVh43vnMq8E4yK','AD82iX8mwSGsb87Ver3Erd7CDBtTFdOF50iFrvCOg1IxWC17a4puuRQ75NPb','2022-11-13 11:30:52','2022-11-13 11:30:52','ffarid',2,NULL,NULL,'en'),(10,'ali','ali','$2y$10$Qvkj7Vw0OApfRjXkVv29Le04f0dWtGa92eMQIPnlbajJbjLW5gXAO','fgMW1NLPSqdcrewL3UGFbGSZMoFlVoo2WQWz951nundbpBMdRArsCy6mMb5Q','2022-11-13 10:48:35','2022-11-13 11:22:05','1103',2,NULL,NULL,'en'),(12,'norah','norah','$2y$10$Aal6/P9qs76VNWGwNwV/QuQklLVbFIck.mheeQr4EXq7phsddiKX.','kZ8jxjqEG1BYclbcBawW6XYffAAJNocbSppdlS9mhR1xD7kxYWdjd0sx34V8','2022-11-13 11:27:46','2022-11-13 11:27:46','020788',2,NULL,NULL,'en'),(15,'seif','seif','$2y$10$KGR10FRsp1VSHYddLi0xo.bNv9BFeq.Xr6FOZh17OcpHqqVk7zz1S',NULL,'2022-12-12 16:28:49','2022-12-12 16:28:49','1234',2,NULL,NULL,'en'),(16,'ramy','ramy','$2y$10$SEuQRzYfMkn0Mc/WgJhd7.hA/X9h3z4uWBwDvw5Oc8ilty5b6SdPm','B5WTII4bWcpvbnOJ3HvOMNKGkmxgxGqzJNCLVsgDPXZ88FZTf1oT7bJWlG5r','2022-12-16 15:33:37','2022-12-16 15:33:37','12345',1,NULL,NULL,'en'),(17,'ramy2','ramy2','$2y$10$Ho7LTdEwdxIbDpKjTVPnUumeeAFMT7KisngurmE/e/L9qcSUCQUSe','MWr1APbQE6D3YlNzloSeTAEoNNKMdEDfjGjWHXAFGMF4lqFiUTMtOxexzNpD','2022-12-24 17:02:07','2022-12-24 17:02:07','007007',1,NULL,NULL,'en'),(18,'sifou','sifou','$2y$10$dVQHjlc8qqtN8gfzk.dW6.P6RF3kKlgMFINOBNZJxr0dIVL87agSy','CJkSvY7unP3uVg2hpYaMPKAPsBQLYBnJAkcv3aYiR8hhVms5ZO8fmRJNZ7oT','2022-12-24 17:02:27','2022-12-24 17:02:27','sifou',2,NULL,NULL,'en');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
DROP TABLE IF EXISTS `versements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `versements` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `montant` int(11) DEFAULT NULL,
  `inscription` int(11) DEFAULT NULL,
  `membre` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_versement` date DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=90 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

LOCK TABLES `versements` WRITE;
/*!40000 ALTER TABLE `versements` DISABLE KEYS */;
INSERT INTO `versements` VALUES (1,1000,24,112,'2022-10-17 10:02:51','2022-10-17 10:02:51','2022-10-17',0),(2,3000,343,311,'2022-11-13 10:36:01','2022-11-13 10:36:01','2022-11-13',3),(3,0,344,312,'2022-11-13 11:36:48','2022-11-13 11:36:48','2022-11-13',3),(4,2000,344,312,'2022-11-13 11:44:43','2022-11-13 11:44:43','2022-11-13',3),(5,1000,344,312,'2022-11-13 12:28:07','2022-11-13 12:28:07','2022-11-13',3),(6,1000,345,313,'2022-11-13 13:05:45','2022-11-13 13:05:45','2022-11-13',10),(7,1500,345,313,'2022-11-13 13:06:40','2022-11-13 13:06:40','2022-11-13',10),(8,500,345,313,'2022-11-13 13:06:53','2022-11-13 13:06:53','2022-11-13',10),(9,4000,346,314,'2022-11-13 13:40:42','2022-11-13 13:40:42','2022-11-13',10),(10,4000,347,315,'2022-11-13 14:01:19','2022-11-13 14:01:19','2022-11-13',10),(11,4000,348,316,'2022-11-13 14:41:54','2022-11-13 14:41:54','2022-11-13',10),(12,3000,350,317,'2022-11-13 15:27:55','2022-11-13 15:27:55','2022-11-13',13),(13,4000,354,318,'2022-11-13 16:19:18','2022-11-13 16:19:18','2022-11-13',13),(14,3000,355,319,'2022-11-13 16:28:26','2022-11-13 16:28:26','2022-11-13',13),(15,4000,356,320,'2022-11-13 16:46:19','2022-11-13 16:46:19','2022-11-13',13),(16,3000,361,321,'2022-11-14 10:26:20','2022-11-14 10:26:20','2022-11-14',10),(17,3000,362,322,'2022-11-14 10:28:35','2022-11-14 10:28:35','2022-11-14',10),(18,4000,364,323,'2022-11-14 13:29:25','2022-11-14 13:29:25','2022-11-14',10),(19,4000,365,324,'2022-11-14 13:33:23','2022-11-14 13:33:23','2022-11-14',10),(20,4500,366,325,'2022-11-14 15:29:43','2022-11-14 15:29:43','2022-11-14',13),(21,1000,355,319,'2022-11-14 16:42:25','2022-11-14 16:42:25','2022-11-14',13),(22,2000,330,302,'2022-11-14 16:43:03','2022-11-14 16:43:03','2022-11-14',13),(23,4500,368,326,'2022-11-14 17:21:05','2022-11-14 17:21:05','2022-11-14',13),(24,3500,370,327,'2022-11-14 17:59:20','2022-11-14 17:59:20','2022-11-14',13),(25,4000,371,328,'2022-11-14 18:13:16','2022-11-14 18:13:16','2022-11-14',13),(26,4000,373,329,'2022-11-15 13:44:30','2022-11-15 13:44:30','2022-11-15',10),(27,8000,375,330,'2022-11-15 14:54:36','2022-11-15 14:54:36','2022-11-15',10),(28,4000,376,331,'2022-11-15 14:58:46','2022-11-15 14:58:46','2022-11-15',10),(29,3000,377,332,'2022-11-15 15:01:29','2022-11-15 15:01:29','2022-11-15',10),(30,3000,382,333,'2022-11-15 17:13:45','2022-11-15 17:13:45','2022-11-15',13),(31,1500,361,321,'2022-11-16 11:07:09','2022-11-16 11:07:09','2022-11-16',10),(32,1500,362,322,'2022-11-16 11:08:28','2022-11-16 11:08:28','2022-11-16',10),(33,3000,385,334,'2022-11-16 15:56:28','2022-11-16 15:56:28','2022-11-16',13),(34,2500,389,335,'2022-11-16 17:33:23','2022-11-16 17:33:23','2022-11-16',13),(35,4500,397,336,'2022-11-17 15:21:16','2022-11-17 15:21:16','2022-11-17',13),(36,3000,399,337,'2022-11-18 13:09:22','2022-11-18 13:09:22','2022-11-18',10),(37,4000,400,338,'2022-11-18 13:11:36','2022-11-18 13:11:36','2022-11-18',10),(38,2500,401,339,'2022-11-18 14:43:20','2022-11-18 14:43:20','2022-11-18',10),(39,4000,403,340,'2022-11-19 15:09:41','2022-11-19 15:09:41','2022-11-19',13),(40,8000,404,341,'2022-11-19 15:50:28','2022-11-19 15:50:28','2022-11-19',13),(41,3000,405,342,'2022-11-19 16:01:25','2022-11-19 16:01:25','2022-11-19',13),(42,4000,407,343,'2022-11-19 16:27:10','2022-11-19 16:27:10','2022-11-19',13),(43,4000,408,344,'2022-11-19 16:48:11','2022-11-19 16:48:11','2022-11-19',13),(44,5000,409,345,'2022-11-19 17:14:21','2022-11-19 17:14:21','2022-11-19',13),(45,4000,411,346,'2022-11-20 10:26:47','2022-11-20 10:26:47','2022-11-20',10),(46,6000,412,347,'2022-11-20 10:58:38','2022-11-20 10:58:38','2022-11-20',10),(47,6000,414,348,'2022-11-20 13:03:56','2022-11-20 13:03:56','2022-11-20',10),(48,6000,415,349,'2022-11-20 13:41:01','2022-11-20 13:41:01','2022-11-20',10),(49,4000,416,350,'2022-11-20 13:46:50','2022-11-20 13:46:50','2022-11-20',10),(50,2500,417,351,'2022-11-20 13:59:37','2022-11-20 13:59:37','2022-11-20',10),(51,4500,422,352,'2022-11-20 16:22:56','2022-11-20 16:22:56','2022-11-20',13),(52,4000,423,353,'2022-11-20 16:28:27','2022-11-20 16:28:27','2022-11-20',13),(53,1500,424,354,'2022-11-20 17:10:32','2022-11-20 17:10:32','2022-11-20',13),(54,2000,388,39,'2022-11-20 17:55:26','2022-11-20 17:55:26','2022-11-20',13),(55,4000,428,355,'2022-11-20 18:27:20','2022-11-20 18:27:20','2022-11-20',13),(56,4000,429,356,'2022-11-20 18:30:19','2022-11-20 18:30:19','2022-11-20',13),(57,4500,430,357,'2022-11-20 18:44:20','2022-11-20 18:44:20','2022-11-20',13),(58,4500,431,358,'2022-11-20 18:48:18','2022-11-20 18:48:18','2022-11-20',13),(59,4000,432,359,'2022-11-20 19:01:20','2022-11-20 19:01:20','2022-11-20',13),(60,0,434,360,'2022-11-21 06:08:16','2022-11-21 06:08:16','2022-11-21',10),(61,4000,435,361,'2022-11-21 11:26:16','2022-11-21 11:26:16','2022-11-21',10),(62,4000,436,362,'2022-11-21 11:28:45','2022-11-21 11:28:45','2022-11-21',10),(63,5000,440,363,'2022-11-21 15:57:00','2022-11-21 15:57:00','2022-11-21',13),(64,4000,449,364,'2022-11-22 16:37:06','2022-11-22 16:37:06','2022-11-22',13),(65,3000,450,365,'2022-11-22 16:43:59','2022-11-22 16:43:59','2022-11-22',13),(66,500,401,339,'2022-11-22 17:42:21','2022-11-22 17:42:21','2022-11-22',13),(67,4000,454,366,'2022-11-23 08:54:30','2022-11-23 08:54:30','2022-11-23',10),(68,4000,459,367,'2022-11-23 18:10:23','2022-11-23 18:10:23','2022-11-23',13),(69,4000,460,368,'2022-11-24 08:22:40','2022-11-24 08:22:40','2022-11-24',10),(70,4000,461,369,'2022-11-24 08:24:51','2022-11-24 08:24:51','2022-11-24',10),(71,0,471,370,'2022-11-26 14:03:33','2022-11-26 14:03:33','2022-11-26',13),(72,2000,463,151,'2022-11-27 13:45:19','2022-11-27 13:45:19','2022-11-27',10),(73,4000,478,371,'2022-11-27 14:33:38','2022-11-27 14:33:38','2022-11-27',10),(74,500,464,161,'2022-11-27 14:43:29','2022-11-27 14:43:29','2022-11-27',10),(75,4500,480,372,'2022-11-27 15:36:42','2022-11-27 15:36:42','2022-11-27',13),(76,5000,481,373,'2022-11-27 15:42:32','2022-11-27 15:42:32','2022-11-27',13),(77,5000,483,374,'2022-11-27 17:14:49','2022-11-27 17:14:49','2022-11-27',13),(78,27000,484,375,'2022-11-27 19:49:26','2022-11-27 19:49:26','2022-11-27',13),(79,1000,452,135,'2022-11-28 07:29:34','2022-11-28 07:29:34','2022-11-28',10),(80,25500,486,376,'2022-11-28 15:23:45','2022-11-28 15:23:45','2022-11-28',13),(81,5000,492,377,'2022-11-29 09:26:17','2022-11-29 09:26:17','2022-11-29',10),(82,5000,493,378,'2022-11-29 13:03:29','2022-11-29 13:03:29','2022-11-29',10),(83,2000,497,379,'2022-12-12 16:38:57','2022-12-12 16:38:57','2022-12-12',14),(84,1000,498,380,'2022-12-16 15:38:27','2022-12-16 15:38:27','2022-12-16',16),(85,0,1,3,'2022-12-24 16:33:46','2022-12-24 16:33:46','2022-12-24',14),(86,8000,2,4,'2022-12-24 16:34:25','2022-12-24 16:34:25','2022-12-24',14),(87,5800,3,5,'2022-12-24 16:39:57','2022-12-24 16:39:57','2022-12-24',14),(88,5800,4,6,'2022-12-24 16:42:25','2022-12-24 16:42:25','2022-12-24',14),(89,2900,5,7,'2022-12-24 16:57:46','2022-12-24 16:57:46','2022-12-24',14);
/*!40000 ALTER TABLE `versements` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

