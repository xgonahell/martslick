-- MySQL dump 10.13  Distrib 5.5.46, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: martspulsa
-- ------------------------------------------------------
-- Server version	5.5.46-0ubuntu0.14.04.2

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
-- Table structure for table `bank`
--

DROP TABLE IF EXISTS `bank`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bank` (
  `bank_id` int(11) NOT NULL,
  `bank_nama` varchar(10) NOT NULL,
  `bank_createdat` date NOT NULL,
  `bank_createdby` varchar(25) NOT NULL,
  `bank_updatedat` date NOT NULL,
  `bank_updatedby` varchar(25) NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bank`
--

LOCK TABLES `bank` WRITE;
/*!40000 ALTER TABLE `bank` DISABLE KEYS */;
/*!40000 ALTER TABLE `bank` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barang_data`
--

DROP TABLE IF EXISTS `barang_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barang_data` (
  `barang_kode` varchar(20) NOT NULL,
  `barang_bargori_id` varchar(20) NOT NULL,
  `barang_desc` varchar(30) NOT NULL,
  `barang_qty` int(11) NOT NULL,
  `barang_harga_beli` int(11) NOT NULL,
  `barang_harga_jual` int(11) NOT NULL,
  `barang_createdat` datetime NOT NULL,
  `barang_createdby` varchar(20) NOT NULL,
  `barang_updatedat` date NOT NULL,
  `barang_updatedby` varchar(25) NOT NULL,
  PRIMARY KEY (`barang_kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang_data`
--

LOCK TABLES `barang_data` WRITE;
/*!40000 ALTER TABLE `barang_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `barang_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barang_kategori`
--

DROP TABLE IF EXISTS `barang_kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barang_kategori` (
  `bargori_id` int(11) NOT NULL AUTO_INCREMENT,
  `bargori_nama` varchar(20) NOT NULL,
  `bargori_prefix` varchar(5) NOT NULL,
  `bargori_createdat` datetime NOT NULL,
  `bargori_createdby` varchar(25) NOT NULL,
  `bargori_updatedat` datetime NOT NULL,
  `bargori_updatedby` varchar(25) NOT NULL,
  PRIMARY KEY (`bargori_id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang_kategori`
--

LOCK TABLES `barang_kategori` WRITE;
/*!40000 ALTER TABLE `barang_kategori` DISABLE KEYS */;
INSERT INTO `barang_kategori` VALUES (50,'Rem','REM','2016-03-18 00:23:42','nightwalker','0000-00-00 00:00:00',''),(51,'Pedal','PDL','2016-03-18 00:23:42','nightwalker','0000-00-00 00:00:00',''),(62,'Jok','JOK','0000-00-00 00:00:00','0','0000-00-00 00:00:00',''),(64,'Lonceng','LCG','0000-00-00 00:00:00','0','0000-00-00 00:00:00',''),(65,'Cakram','CKR','0000-00-00 00:00:00','0','0000-00-00 00:00:00',''),(66,'Stang','STG','0000-00-00 00:00:00','0','0000-00-00 00:00:00',''),(67,'Gear','GER','0000-00-00 00:00:00','0','0000-00-00 00:00:00',''),(68,'Lampu','LAM','0000-00-00 00:00:00','0','0000-00-00 00:00:00',''),(75,'Helm','HLM','0000-00-00 00:00:00','0','0000-00-00 00:00:00',''),(76,'Kacamata','KCM','0000-00-00 00:00:00','0','0000-00-00 00:00:00',''),(91,'Sprocket','SPK','0000-00-00 00:00:00','0','0000-00-00 00:00:00',''),(92,'Range','RNG','0000-00-00 00:00:00','0','0000-00-00 00:00:00','');
/*!40000 ALTER TABLE `barang_kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barang_merk`
--

DROP TABLE IF EXISTS `barang_merk`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barang_merk` (
  `barmerk_id` int(11) NOT NULL AUTO_INCREMENT,
  `barmerk_nama` varchar(20) NOT NULL,
  `barmerk_prefix` varchar(5) NOT NULL,
  `barmerk_createdat` datetime NOT NULL,
  `barmerk_createdby` varchar(25) NOT NULL,
  `barmerk_updatedat` datetime NOT NULL,
  `barmerk_updatedby` varchar(25) NOT NULL,
  PRIMARY KEY (`barmerk_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang_merk`
--

LOCK TABLES `barang_merk` WRITE;
/*!40000 ALTER TABLE `barang_merk` DISABLE KEYS */;
INSERT INTO `barang_merk` VALUES (1,'Federal','FDR','2016-03-18 00:00:00','nightwalker','0000-00-00 00:00:00',''),(2,'Shimano','SHM','2016-03-18 00:00:00','nightwalker','0000-00-00 00:00:00',''),(3,'Wimcycle','WCY','2016-03-18 00:00:00','nightwalker','0000-00-00 00:00:00',''),(10,'Honda','HND','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(11,'Yamaha','YMH','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(12,'Suzuki','SZK','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(14,'Kawasaki','KWS','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(15,'Mitsubishi','MTS','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(16,'Mercedez','MCD','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(18,'Mazda','MZD','0000-00-00 00:00:00','','0000-00-00 00:00:00',''),(20,'Daihatsu','DHT','0000-00-00 00:00:00','','0000-00-00 00:00:00','');
/*!40000 ALTER TABLE `barang_merk` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barang_ukuran`
--

DROP TABLE IF EXISTS `barang_ukuran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barang_ukuran` (
  `barsize_id` int(11) NOT NULL AUTO_INCREMENT,
  `barsize_workflow` char(1) NOT NULL,
  `barsize_prefix` varchar(5) NOT NULL,
  PRIMARY KEY (`barsize_id`)
) ENGINE=InnoDB AUTO_INCREMENT=113 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang_ukuran`
--

LOCK TABLES `barang_ukuran` WRITE;
/*!40000 ALTER TABLE `barang_ukuran` DISABLE KEYS */;
INSERT INTO `barang_ukuran` VALUES (96,'H','XS'),(97,'H','M'),(103,'A','42'),(104,'A','43'),(105,'A','44'),(106,'A','45'),(107,'A','35'),(109,'A','44'),(110,'A','33'),(111,'A','45'),(112,'H','L');
/*!40000 ALTER TABLE `barang_ukuran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `barang_warna`
--

DROP TABLE IF EXISTS `barang_warna`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barang_warna` (
  `barwar_kode` int(11) NOT NULL AUTO_INCREMENT,
  `barwar_nama` varchar(20) NOT NULL,
  `barwar_prefix` varchar(5) NOT NULL,
  PRIMARY KEY (`barwar_kode`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barang_warna`
--

LOCK TABLES `barang_warna` WRITE;
/*!40000 ALTER TABLE `barang_warna` DISABLE KEYS */;
INSERT INTO `barang_warna` VALUES (19,'Hitam','HTM'),(33,'Putih','PTH'),(34,'Hijau','HJU'),(35,'Cokelat','CKL'),(36,'Merah','MRH'),(37,'Kuning','KG'),(39,'Tosca','TSC');
/*!40000 ALTER TABLE `barang_warna` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `customer_kode` varchar(20) NOT NULL,
  `customer_nama` varchar(30) NOT NULL,
  `customer_alamat` text NOT NULL,
  `customer_kota` varchar(30) NOT NULL,
  `customer_createdat` date NOT NULL,
  `customer_createdby` varchar(25) NOT NULL,
  `customer_updatedat` date NOT NULL,
  `customer_updatedby` varchar(25) NOT NULL,
  PRIMARY KEY (`customer_kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `deposit`
--

DROP TABLE IF EXISTS `deposit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `deposit` (
  `deposit_id` int(11) NOT NULL AUTO_INCREMENT,
  `deposit_customer_code` varchar(20) NOT NULL,
  `deposit_nominal` int(11) NOT NULL,
  `deposit_createdat` date NOT NULL,
  `deposit_createdby` varchar(25) NOT NULL,
  `deposit_updatedat` date NOT NULL,
  `deposit_updatedby` varchar(25) NOT NULL,
  PRIMARY KEY (`deposit_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deposit`
--

LOCK TABLES `deposit` WRITE;
/*!40000 ALTER TABLE `deposit` DISABLE KEYS */;
/*!40000 ALTER TABLE `deposit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `module` (
  `module_id` int(11) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(100) DEFAULT NULL,
  `module_controller` varchar(100) DEFAULT NULL,
  `module_active_flag` int(11) DEFAULT NULL,
  `module_parent` int(11) DEFAULT NULL,
  `module_order` int(11) DEFAULT NULL,
  `module_icon` varchar(20) NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` VALUES (5,'Dashboard','dashboard',1,0,0,'fa fa-home'),(6,'Barang','#',1,0,2,'fa fa-database'),(7,'Data Barang','itemlist',1,6,0,''),(8,'Menu','menu',0,21,1,''),(10,'Konfigurasi','itemconfig',1,6,1,''),(12,'Supplier','supplier',1,0,4,'fa fa-share-alt'),(14,'Pegawai','pegawai',1,0,4,'fa fa-group'),(16,'Transaksi','transaksi',1,0,7,'fa fa-refresh'),(17,'Pengeluaran','#',1,0,8,'fa fa-briefcase'),(18,'Purchase Order','po',1,17,9,''),(19,'Operasional','operasional',1,17,9,''),(20,'Group Access','group_access',1,21,0,''),(21,'System Settings','#',0,0,0,'fa fa-cogs');
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `operasional`
--

DROP TABLE IF EXISTS `operasional`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `operasional` (
  `opr_kode` varchar(15) NOT NULL,
  `opr_desc` text NOT NULL,
  `opr_nominal` int(11) NOT NULL,
  `opr_createdat` datetime NOT NULL,
  `opr_createdby` varchar(25) NOT NULL,
  `opr_updatedat` datetime NOT NULL,
  `opr_updatedby` varchar(25) NOT NULL,
  PRIMARY KEY (`opr_kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `operasional`
--

LOCK TABLES `operasional` WRITE;
/*!40000 ALTER TABLE `operasional` DISABLE KEYS */;
INSERT INTO `operasional` VALUES ('OT160004','ongkos kirim gear 5 set',500000,'2016-03-29 03:43:26','nightwalker','0000-00-00 00:00:00','');
/*!40000 ALTER TABLE `operasional` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_kredit`
--

DROP TABLE IF EXISTS `payment_kredit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_kredit` (
  `paykred_id` int(11) NOT NULL AUTO_INCREMENT,
  `paykred_trahead_invoice` varchar(20) NOT NULL,
  `paykred_nominal` int(11) NOT NULL,
  `paykred_createdat` date NOT NULL,
  PRIMARY KEY (`paykred_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_kredit`
--

LOCK TABLES `payment_kredit` WRITE;
/*!40000 ALTER TABLE `payment_kredit` DISABLE KEYS */;
/*!40000 ALTER TABLE `payment_kredit` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `po_detail`
--

DROP TABLE IF EXISTS `po_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `po_detail` (
  `po_detail_id` int(11) NOT NULL AUTO_INCREMENT,
  `po_invoice` varchar(15) NOT NULL,
  `po_detail_merk` char(15) NOT NULL,
  `po_detail_kategori` char(15) NOT NULL,
  `po_detail_qty` int(11) NOT NULL,
  `po_detail_price` int(11) NOT NULL,
  PRIMARY KEY (`po_detail_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `po_detail`
--

LOCK TABLES `po_detail` WRITE;
/*!40000 ALTER TABLE `po_detail` DISABLE KEYS */;
INSERT INTO `po_detail` VALUES (8,'PO16001','1','51',5,50000),(9,'PO16001','2','64',5,40000),(10,'PO16001','11','67',10,150000),(11,'PO16002','1','51',5,250000),(12,'PO16002','3','62',5,50000),(13,'PO16003','3','65',5,150000),(14,'PO16004','3','51',5,50000),(15,'PO16004','3','65',5,50000),(16,'PO16005','3','64',5,10000),(17,'PO16005','11','65',5,15000),(18,'PO16006','11','66',5,25000),(19,'PO16006','12','62',5,75000),(20,'PO16007','2','62',6,50000),(21,'PO16007','10','64',5,35000),(22,'PO16008','3','51',5,50000);
/*!40000 ALTER TABLE `po_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `po_head`
--

DROP TABLE IF EXISTS `po_head`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `po_head` (
  `po_invoice` varchar(20) NOT NULL,
  `po_supplier` varchar(15) NOT NULL,
  `po_status` varchar(10) NOT NULL,
  `po_status_barang` char(17) NOT NULL,
  `po_createdat` datetime NOT NULL,
  `po_createdby` varchar(25) NOT NULL,
  `po_total_bayar` int(11) NOT NULL,
  `po_updatedat` datetime NOT NULL,
  `po_updatedby` varchar(25) NOT NULL,
  PRIMARY KEY (`po_invoice`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `po_head`
--

LOCK TABLES `po_head` WRITE;
/*!40000 ALTER TABLE `po_head` DISABLE KEYS */;
INSERT INTO `po_head` VALUES ('PO16001','1','1','Ready to transfer','2016-03-26 01:59:15','nightwalker',1950000,'0000-00-00 00:00:00',''),('PO16002','2','1','Ready to transfer','2016-03-26 02:00:58','nightwalker',1500000,'0000-00-00 00:00:00',''),('PO16003','2','1','Ready to transfer','2016-03-26 14:20:29','nightwalker',750000,'0000-00-00 00:00:00',''),('PO16004','2','1','Ready to transfer','2016-03-27 23:48:46','nightwalker',500000,'0000-00-00 00:00:00',''),('PO16005','2','1','Ready to transfer','2016-03-28 23:17:44','nightwalker',125000,'0000-00-00 00:00:00',''),('PO16006','2','1','Ready to transfer','2016-03-28 23:30:06','nightwalker',500000,'0000-00-00 00:00:00',''),('PO16007','SP16005','1','Ready to transfer','2016-03-29 05:51:48','cornnuclear',475000,'0000-00-00 00:00:00',''),('PO16008','SP16006','1','Ready to transfer','2016-03-29 17:07:08','nightwalker',250000,'0000-00-00 00:00:00','');
/*!40000 ALTER TABLE `po_head` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `return`
--

DROP TABLE IF EXISTS `return`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `return` (
  `return_id` int(11) NOT NULL AUTO_INCREMENT,
  `return_trahead_invoice` varchar(20) NOT NULL,
  `return_tradetail_kode_barcode` varchar(20) NOT NULL,
  `return_qty` int(11) NOT NULL,
  `return_keterangan` varchar(25) NOT NULL,
  `return_createdat` date NOT NULL,
  `return_createdby` varchar(25) NOT NULL,
  `return_updatedat` date NOT NULL,
  `return_updatedby` varchar(25) NOT NULL,
  PRIMARY KEY (`return_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `return`
--

LOCK TABLES `return` WRITE;
/*!40000 ALTER TABLE `return` DISABLE KEYS */;
/*!40000 ALTER TABLE `return` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `supplier`
--

DROP TABLE IF EXISTS `supplier`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `supplier` (
  `supplier_kode` varchar(15) NOT NULL,
  `supplier_nama` varchar(30) NOT NULL,
  `supplier_alamat` text NOT NULL,
  `supplier_kota` text NOT NULL,
  `supplier_hp` varchar(15) NOT NULL,
  `supplier_email` varchar(50) NOT NULL,
  `supplier_createdat` datetime NOT NULL,
  `supplier_createdby` varchar(25) NOT NULL,
  `supplier_updatedat` datetime NOT NULL,
  `supplier_updatedby` varchar(25) NOT NULL,
  PRIMARY KEY (`supplier_kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `supplier`
--

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` VALUES ('SP16005','herman','baleendah','bandung','085724842416','apocalypsix@gmail.com','2016-03-28 23:56:34','nightwalker','0000-00-00 00:00:00',''),('SP16006','Dery','Cimahi','Cimahi','085637236238','dery@gmail.com','2016-03-29 00:00:32','nightwalker','0000-00-00 00:00:00','');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system`
--

DROP TABLE IF EXISTS `system`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system` (
  `system_cd` varchar(100) NOT NULL,
  `system_val` varchar(255) NOT NULL,
  PRIMARY KEY (`system_cd`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system`
--

LOCK TABLES `system` WRITE;
/*!40000 ALTER TABLE `system` DISABLE KEYS */;
/*!40000 ALTER TABLE `system` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `toko_cabang`
--

DROP TABLE IF EXISTS `toko_cabang`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `toko_cabang` (
  `tocab_kode` varchar(25) NOT NULL,
  `tocab_alamat` text NOT NULL,
  `tocab_createdat` date NOT NULL,
  `tocab_createdby` varchar(25) NOT NULL,
  `tocab_updatedat` date NOT NULL,
  `tocab_updatedby` varchar(25) NOT NULL,
  PRIMARY KEY (`tocab_kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `toko_cabang`
--

LOCK TABLES `toko_cabang` WRITE;
/*!40000 ALTER TABLE `toko_cabang` DISABLE KEYS */;
/*!40000 ALTER TABLE `toko_cabang` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi`
--

DROP TABLE IF EXISTS `transaksi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaksi` (
  `transaksi_invoice` varchar(20) NOT NULL,
  `transaksi_payment` varchar(15) NOT NULL,
  `transaksi_pelanggan` varchar(50) NOT NULL,
  `transaksi_hp_pelanggan` varchar(15) NOT NULL,
  `transaksi_total_bayar` int(11) NOT NULL,
  `transaksi_date` datetime NOT NULL,
  `transaksi_operator` varchar(30) NOT NULL,
  PRIMARY KEY (`transaksi_invoice`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi`
--

LOCK TABLES `transaksi` WRITE;
/*!40000 ALTER TABLE `transaksi` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaksi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaksi_detail`
--

DROP TABLE IF EXISTS `transaksi_detail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaksi_detail` (
  `tradetail_id` int(11) NOT NULL AUTO_INCREMENT,
  `tradetail_invoice` varchar(20) NOT NULL,
  `tradetail_barang_barcode` varchar(25) NOT NULL,
  `tradetail_barjen_nama` varchar(20) NOT NULL,
  `tradetail_qty` int(11) NOT NULL,
  `tradetail_diskon` int(11) NOT NULL,
  `tradetail_harga` int(11) NOT NULL,
  PRIMARY KEY (`tradetail_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaksi_detail`
--

LOCK TABLES `transaksi_detail` WRITE;
/*!40000 ALTER TABLE `transaksi_detail` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaksi_detail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_username` varchar(25) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  `user_passwordx` varchar(100) NOT NULL,
  `user_nama` varchar(50) NOT NULL,
  `user_alamat` text NOT NULL,
  `user_kota` text NOT NULL,
  `user_hp` varchar(15) NOT NULL,
  `user_group_kode` int(11) NOT NULL,
  `user_createdat` date NOT NULL,
  `user_createdby` varchar(25) NOT NULL,
  `user_updatedat` date NOT NULL,
  `user_updatedby` varchar(25) NOT NULL,
  `user_state` char(1) NOT NULL,
  PRIMARY KEY (`user_username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES ('cornnuclear','4cbf82d5c76908cf51cce5e6ae4d9eec','hermanwinata','Hermansyah Handya Pranata','Pasirpogor Baleendah','Bandung','0857',1,'2016-03-29','nightwalker','0000-00-00','','1'),('nightwalker','57ab83937b71dc452b1e12c38e80e6dc','','Mohamad Yusuf Supriatna','Gatot Subroto','Bandung','085722760852',1,'2015-11-23','SYSTEM','0000-00-00','','1');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_group`
--

DROP TABLE IF EXISTS `user_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_group` (
  `usrgroup_id` int(11) NOT NULL AUTO_INCREMENT,
  `usrgroup_nama` varchar(25) NOT NULL,
  PRIMARY KEY (`usrgroup_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_group`
--

LOCK TABLES `user_group` WRITE;
/*!40000 ALTER TABLE `user_group` DISABLE KEYS */;
INSERT INTO `user_group` VALUES (1,'Administrator'),(2,'Operator');
/*!40000 ALTER TABLE `user_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_group_access`
--

DROP TABLE IF EXISTS `user_group_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_group_access` (
  `usergroup_id` int(11) NOT NULL,
  `module_id` int(11) NOT NULL,
  `status` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`usergroup_id`,`module_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_group_access`
--

LOCK TABLES `user_group_access` WRITE;
/*!40000 ALTER TABLE `user_group_access` DISABLE KEYS */;
INSERT INTO `user_group_access` VALUES (1,5,'1'),(1,7,'1'),(1,8,'1'),(1,9,'1'),(1,10,'1'),(1,12,'1'),(1,13,'1'),(1,14,'1'),(1,15,'1'),(1,16,'1'),(1,18,'1'),(1,19,'1'),(1,20,'1'),(2,5,'1'),(2,7,'1'),(2,9,'1'),(2,10,'1'),(2,12,'1'),(2,13,'1'),(2,14,'1'),(2,15,'1'),(2,16,'1'),(2,18,'1'),(2,19,'1');
/*!40000 ALTER TABLE `user_group_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_module`
--

DROP TABLE IF EXISTS `user_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_module` (
  `usrmod_id` int(11) NOT NULL AUTO_INCREMENT,
  `usrmod_usrgroup_id` int(11) NOT NULL,
  `usrmod_user_id` int(11) NOT NULL,
  `usrmod_module` varchar(15) NOT NULL,
  PRIMARY KEY (`usrmod_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_module`
--

LOCK TABLES `user_module` WRITE;
/*!40000 ALTER TABLE `user_module` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_module` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-03-29 21:28:14
