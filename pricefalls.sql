-- MySQL dump 10.16  Distrib 10.1.21-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: localhost
-- ------------------------------------------------------
-- Server version	10.1.21-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `faq`
--

DROP TABLE IF EXISTS `faq`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `query` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `marketplace` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faq`
--

LOCK TABLES `faq` WRITE;
/*!40000 ALTER TABLE `faq` DISABLE KEYS */;
/*!40000 ALTER TABLE `faq` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `latest_updates`
--

DROP TABLE IF EXISTS `latest_updates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `latest_updates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `marketplace` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `latest_updates`
--

LOCK TABLES `latest_updates` WRITE;
/*!40000 ALTER TABLE `latest_updates` DISABLE KEYS */;
INSERT INTO `latest_updates` VALUES (1,'Register and get price','very new pricefalls app user will get a assured gift on registration','pricefalls','2017-10-11 06:11:32','2017-10-11 06:11:32');
/*!40000 ALTER TABLE `latest_updates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `merchant`
--

DROP TABLE IF EXISTS `merchant`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `merchant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) DEFAULT NULL,
  `shopurl` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shopname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `currency` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shop_json` text COLLATE utf8_unicode_ci,
  `status` smallint(6) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `merchant_id` (`merchant_id`),
  UNIQUE KEY `email` (`email`),
  CONSTRAINT `fk-merchant-merchant_id` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_db` (`merchant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `merchant`
--

LOCK TABLES `merchant` WRITE;
/*!40000 ALTER TABLE `merchant` DISABLE KEYS */;
INSERT INTO `merchant` VALUES (1,1,'https://fashionshop-plus.myshopify.com','Fashion Shop Plus+','owner_1','owner1@gmail.com','dollars','{\"name\":\"owner\"}',1,'2017-10-12 03:51:46','2017-10-12 03:51:46'),(2,2,'https://shopallcategory.myshopify.com','shop all category','owner_2','owner2@gmail.com','rupees','{\"name\":\"Shop All Category\"}',1,'2017-10-12 06:21:19','2017-10-12 06:21:19');
/*!40000 ALTER TABLE `merchant` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `merchant_db`
--

DROP TABLE IF EXISTS `merchant_db`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `merchant_db` (
  `merchant_id` int(11) NOT NULL AUTO_INCREMENT,
  `shop_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `db_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `app_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`merchant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `merchant_db`
--

LOCK TABLES `merchant_db` WRITE;
/*!40000 ALTER TABLE `merchant_db` DISABLE KEYS */;
INSERT INTO `merchant_db` VALUES (1,'fashion shop-plus+','db','pricefalls'),(2,'shop all category','db','pricefalls');
/*!40000 ALTER TABLE `merchant_db` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration`
--

DROP TABLE IF EXISTS `migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration`
--

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT INTO `migration` VALUES ('m000000_000000_base',1507637220),('m171007_072153_merchant_db',1507637223),('m171009_093402_merchant',1507637224),('m171009_110043_products',1507637226),('m171009_110104_product_variants',1507637228),('m171009_110600_latest_updates',1507637229),('m171009_114037_notifications',1507637229),('m171009_114340_faq',1507637230),('m171009_120946_product_options',1507637232),('m171009_131905_tophatter_shopdetails',1507637234),('m171009_133923_pricefalls_configuration_setting',1507637235),('m171009_134334_pricefalls_shop_details',1507637237),('m171009_134414_pricefalls_category_map',1507637238),('m171009_134439_pricefalls_attribute_map',1507637240),('m171009_135526_pricefalls_installation',1507637241),('m171009_141757_pricefalls_registration',1507637242),('m171009_143155_tophatter_category_map',1507637244),('m171010_044012_tophatter_attribute_map',1507637245),('m171010_063653_pridefalls_products',1507637248),('m171010_065102_pridefalls_product_variants',1507637253),('m171010_065149_pridefalls_payment',1507637254),('m171010_065200_pridefalls_orders',1507637256),('m171010_065249_pridefalls_failed_orders',1507637258),('m171010_093240_update_createdatupdatedat',1507637258),('m171010_101235_update_newt',1507637283);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `html_content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort_order` text COLLATE utf8_unicode_ci,
  `from_date` datetime NOT NULL,
  `to_date` datetime NOT NULL,
  `enable` int(11) DEFAULT NULL,
  `marketplace` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `enable_merchant` int(11) DEFAULT NULL,
  `seen_clients` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pricefalls_attribute_map`
--

DROP TABLE IF EXISTS `pricefalls_attribute_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pricefalls_attribute_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shopify_attribute_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attribute_value_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attribute_value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-pricefalls_attribute_map-merchant_id` (`merchant_id`),
  CONSTRAINT `fk-pricefalls_attribute_map-merchant_id` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_db` (`merchant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pricefalls_attribute_map`
--

LOCK TABLES `pricefalls_attribute_map` WRITE;
/*!40000 ALTER TABLE `pricefalls_attribute_map` DISABLE KEYS */;
/*!40000 ALTER TABLE `pricefalls_attribute_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pricefalls_category_map`
--

DROP TABLE IF EXISTS `pricefalls_category_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pricefalls_category_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shopify_product_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pricefalls_category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-pricefalls_category_map-merchant_id` (`merchant_id`),
  CONSTRAINT `fk-pricefalls_category_map-merchant_id` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_db` (`merchant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pricefalls_category_map`
--

LOCK TABLES `pricefalls_category_map` WRITE;
/*!40000 ALTER TABLE `pricefalls_category_map` DISABLE KEYS */;
/*!40000 ALTER TABLE `pricefalls_category_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pricefalls_config`
--

DROP TABLE IF EXISTS `pricefalls_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pricefalls_config` (
  `id` int(11) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `data` varchar(100) NOT NULL,
  `value` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-pricefalls_config-merchant_id` (`merchant_id`),
  CONSTRAINT `fk-pricefalls_config-merchant_id` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_db` (`merchant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pricefalls_config`
--

LOCK TABLES `pricefalls_config` WRITE;
/*!40000 ALTER TABLE `pricefalls_config` DISABLE KEYS */;
/*!40000 ALTER TABLE `pricefalls_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pricefalls_configuration_setting`
--

DROP TABLE IF EXISTS `pricefalls_configuration_setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pricefalls_configuration_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL,
  `config_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-pricefalls_configuration_setting-merchant_id` (`merchant_id`),
  CONSTRAINT `fk-pricefalls_configuration_setting-merchant_id` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_db` (`merchant_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pricefalls_configuration_setting`
--

LOCK TABLES `pricefalls_configuration_setting` WRITE;
/*!40000 ALTER TABLE `pricefalls_configuration_setting` DISABLE KEYS */;
INSERT INTO `pricefalls_configuration_setting` VALUES (1,1,'inventory_threshold','5');
/*!40000 ALTER TABLE `pricefalls_configuration_setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pricefalls_failed_orders`
--

DROP TABLE IF EXISTS `pricefalls_failed_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pricefalls_failed_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL,
  `pricefalls_order_id` int(11) NOT NULL,
  `reason` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk-pricefalls_failed_orders-merchant_id` (`merchant_id`),
  KEY `fk-pricefalls_failed_orders-pricefalls_order_id` (`pricefalls_order_id`),
  CONSTRAINT `fk-pricefalls_failed_orders-merchant_id` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_db` (`merchant_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk-pricefalls_failed_orders-pricefalls_order_id` FOREIGN KEY (`pricefalls_order_id`) REFERENCES `pricefalls_orders` (`pricefalls_order_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pricefalls_failed_orders`
--

LOCK TABLES `pricefalls_failed_orders` WRITE;
/*!40000 ALTER TABLE `pricefalls_failed_orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `pricefalls_failed_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pricefalls_installation`
--

DROP TABLE IF EXISTS `pricefalls_installation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pricefalls_installation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `step` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-pricefalls_installation-merchant_id` (`merchant_id`),
  CONSTRAINT `fk-pricefalls_installation-merchant_id` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_db` (`merchant_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pricefalls_installation`
--

LOCK TABLES `pricefalls_installation` WRITE;
/*!40000 ALTER TABLE `pricefalls_installation` DISABLE KEYS */;
/*!40000 ALTER TABLE `pricefalls_installation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pricefalls_orders`
--

DROP TABLE IF EXISTS `pricefalls_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pricefalls_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL,
  `pricefalls_order_id` int(11) DEFAULT NULL,
  `shopify_order_id` int(11) NOT NULL,
  `shopify_order_name` text COLLATE utf8_unicode_ci NOT NULL,
  `order_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_real_status` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `SKU` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `order_data` text COLLATE utf8_unicode_ci NOT NULL,
  `shipped_at` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `shopify_order_id` (`shopify_order_id`),
  UNIQUE KEY `pricefalls_order_id` (`pricefalls_order_id`),
  KEY `fk-pricefalls_orders-merchant_id` (`merchant_id`),
  CONSTRAINT `fk-pricefalls_orders-merchant_id` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_db` (`merchant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pricefalls_orders`
--

LOCK TABLES `pricefalls_orders` WRITE;
/*!40000 ALTER TABLE `pricefalls_orders` DISABLE KEYS */;
INSERT INTO `pricefalls_orders` VALUES (1,1,111111,111222,'order for Men suits','complete','','product-101','\n{\"price_total\":\n{\"item_price\":\n{\"item_tax\":56.0,\"item_shipping_price\":20.0,\"item_shipping_tax\":2.0,\"base_price\":120.0}\n}\n}','10','2017-10-11 05:30:06','2017-10-11 05:30:06');
/*!40000 ALTER TABLE `pricefalls_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pricefalls_payment`
--

DROP TABLE IF EXISTS `pricefalls_payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pricefalls_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL,
  `plan_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_data` text COLLATE utf8_unicode_ci NOT NULL,
  `order_data` text COLLATE utf8_unicode_ci NOT NULL,
  `billing_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `archived_on` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-pricefalls_payment-merchant_id` (`merchant_id`),
  CONSTRAINT `fk-pricefalls_payment-merchant_id` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_db` (`merchant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pricefalls_payment`
--

LOCK TABLES `pricefalls_payment` WRITE;
/*!40000 ALTER TABLE `pricefalls_payment` DISABLE KEYS */;
/*!40000 ALTER TABLE `pricefalls_payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pricefalls_product_variants`
--

DROP TABLE IF EXISTS `pricefalls_product_variants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pricefalls_product_variants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `attribute_options` text COLLATE utf8_unicode_ci NOT NULL,
  `weight` decimal(10,2) DEFAULT NULL,
  `weight_unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `barcode` bigint(13) NOT NULL,
  `image` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk-pricefalls_product_variants-merchant_id` (`merchant_id`),
  KEY `fk-pricefalls_product_variants-product_id` (`product_id`),
  KEY `fk-pricefalls_product_variants-variant_id` (`variant_id`),
  CONSTRAINT `fk-pricefalls_product_variants-merchant_id` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_db` (`merchant_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk-pricefalls_product_variants-product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk-pricefalls_product_variants-variant_id` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`variant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pricefalls_product_variants`
--

LOCK TABLES `pricefalls_product_variants` WRITE;
/*!40000 ALTER TABLE `pricefalls_product_variants` DISABLE KEYS */;
INSERT INTO `pricefalls_product_variants` VALUES (1,1,123456,2323,'Test1','Test product is available in all colors and size','450','Available for Purchase','{\"men_clothin\":\"S\"}',0.06,'kg',12345678901,'1.jpeg','2017-10-11 10:30:22','2017-10-11 10:30:22');
/*!40000 ALTER TABLE `pricefalls_product_variants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pricefalls_products`
--

DROP TABLE IF EXISTS `pricefalls_products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pricefalls_products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `inventory` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `images` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk-pricefalls_products-merchant_id` (`merchant_id`),
  KEY `fk-pricefalls_products-product_id` (`product_id`),
  CONSTRAINT `fk-pricefalls_products-merchant_id` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_db` (`merchant_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk-pricefalls_products-product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pricefalls_products`
--

LOCK TABLES `pricefalls_products` WRITE;
/*!40000 ALTER TABLE `pricefalls_products` DISABLE KEYS */;
INSERT INTO `pricefalls_products` VALUES (1,1,123456,'Test Product',4,'Great product available here at very less price','{\"images\":\r\n{\r\n\"men.jpeg\",\"men1.jpeg\",\"men2.jpeg\"\r\n}\r\n}','2017-10-11 11:35:47','2017-10-11 11:35:47');
/*!40000 ALTER TABLE `pricefalls_products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pricefalls_registration`
--

DROP TABLE IF EXISTS `pricefalls_registration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pricefalls_registration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL,
  `agreement` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `other_reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shipping_source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `other_shipping_source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk-pricefalls_registration-merchant_id` (`merchant_id`),
  CONSTRAINT `fk-pricefalls_registration-merchant_id` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_db` (`merchant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pricefalls_registration`
--

LOCK TABLES `pricefalls_registration` WRITE;
/*!40000 ALTER TABLE `pricefalls_registration` DISABLE KEYS */;
/*!40000 ALTER TABLE `pricefalls_registration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pricefalls_shop_details`
--

DROP TABLE IF EXISTS `pricefalls_shop_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pricefalls_shop_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `install_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `install_date` date NOT NULL,
  `uninstall_date` date NOT NULL,
  `uninstall_status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expire_date` date NOT NULL,
  `purchase_status` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk-pricefalls_shop_details-merchant_id` (`merchant_id`),
  CONSTRAINT `fk-pricefalls_shop_details-merchant_id` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_db` (`merchant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pricefalls_shop_details`
--

LOCK TABLES `pricefalls_shop_details` WRITE;
/*!40000 ALTER TABLE `pricefalls_shop_details` DISABLE KEYS */;
INSERT INTO `pricefalls_shop_details` VALUES (1,1,'abcdefghijklmnopqrstuvwxyz','complete','2017-10-09','0000-00-00','','2017-10-31','','2017-10-11 09:02:25','2017-10-11 09:02:25');
/*!40000 ALTER TABLE `pricefalls_shop_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_options`
--

DROP TABLE IF EXISTS `product_options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_options` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci,
  `variant_id` int(11) NOT NULL,
  `option_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `option_value` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-product_options-merchant_id` (`product_id`),
  KEY `fk-product_options-product_id` (`variant_id`),
  CONSTRAINT `fk-product_options-merchant_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  CONSTRAINT `fk-product_options-product_id` FOREIGN KEY (`variant_id`) REFERENCES `product_variants` (`variant_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_options`
--

LOCK TABLES `product_options` WRITE;
/*!40000 ALTER TABLE `product_options` DISABLE KEYS */;
/*!40000 ALTER TABLE `product_options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_variants`
--

DROP TABLE IF EXISTS `product_variants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_variants` (
  `variant_id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci,
  `merchant_id` int(11) NOT NULL,
  `SKU` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `position` int(11) NOT NULL,
  `inventory` int(11) NOT NULL,
  `barcode` bigint(11) NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `inventory_policy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `weight` decimal(10,0) DEFAULT NULL,
  `weight_unit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`variant_id`),
  KEY `fk-product_variants-merchant_id` (`merchant_id`),
  KEY `fk-product_variants-product_id` (`product_id`),
  CONSTRAINT `fk-product_variants-merchant_id` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_db` (`merchant_id`) ON DELETE CASCADE,
  CONSTRAINT `fk-product_variants-product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2324 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_variants`
--

LOCK TABLES `product_variants` WRITE;
/*!40000 ALTER TABLE `product_variants` DISABLE KEYS */;
INSERT INTO `product_variants` VALUES (2323,123456,'test101',1,'product-101',234.00,1,23,12345678901,'i.jpeg','shopify',NULL,'kg','2017-10-10 12:14:48','2017-10-10 12:14:48');
/*!40000 ALTER TABLE `product_variants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `inventory` int(11) NOT NULL,
  `vendor` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `product_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `handle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `images` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`product_id`),
  KEY `fk-products-merchant_id` (`merchant_id`),
  CONSTRAINT `fk-products-merchant_id` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_db` (`merchant_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=123457 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (123456,1,'test',10,'testvendor','testdescription','testtype','test_type','type','img.jpeg','2017-10-10 12:13:30','2017-10-10 12:13:30');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tophatter_attribute_map`
--

DROP TABLE IF EXISTS `tophatter_attribute_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tophatter_attribute_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL,
  `shopify_product_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attribut_value_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tophatter_attribute_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attribute_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKmerchant-attribute` (`merchant_id`),
  CONSTRAINT `FKmerchant-attribute` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_db` (`merchant_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tophatter_attribute_map`
--

LOCK TABLES `tophatter_attribute_map` WRITE;
/*!40000 ALTER TABLE `tophatter_attribute_map` DISABLE KEYS */;
/*!40000 ALTER TABLE `tophatter_attribute_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tophatter_category_map`
--

DROP TABLE IF EXISTS `tophatter_category_map`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tophatter_category_map` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL,
  `shopify_product_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tophatter_category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FKmerchant-category` (`merchant_id`),
  CONSTRAINT `FKmerchant-category` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_db` (`merchant_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tophatter_category_map`
--

LOCK TABLES `tophatter_category_map` WRITE;
/*!40000 ALTER TABLE `tophatter_category_map` DISABLE KEYS */;
/*!40000 ALTER TABLE `tophatter_category_map` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tophatter_shopdetails`
--

DROP TABLE IF EXISTS `tophatter_shopdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tophatter_shopdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `merchant_id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `install_status` int(11) DEFAULT '0',
  `install_date` datetime NOT NULL,
  `uninstall_dates` datetime DEFAULT NULL,
  `purchase_status` int(11) DEFAULT NULL,
  `expire_date` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FKmerchant` (`merchant_id`),
  CONSTRAINT `FKmerchant` FOREIGN KEY (`merchant_id`) REFERENCES `merchant_db` (`merchant_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tophatter_shopdetails`
--

LOCK TABLES `tophatter_shopdetails` WRITE;
/*!40000 ALTER TABLE `tophatter_shopdetails` DISABLE KEYS */;
/*!40000 ALTER TABLE `tophatter_shopdetails` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-10-12 18:59:40
