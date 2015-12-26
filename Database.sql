/*
SQLyog Ultimate v11.5 (64 bit)
MySQL - 5.6.24 : Database - _kampus_db_perpustakaan
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/*Table structure for table `anggota` */

DROP TABLE IF EXISTS `anggota`;

CREATE TABLE `anggota` (
  `nia` varchar(10) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `jk` varchar(2) DEFAULT NULL,
  `ttl` date DEFAULT NULL,
  `alamat` varchar(10) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`nia`),
  KEY `id_alamat` (`alamat`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `anggota` */

insert  into `anggota`(`nia`,`nama`,`jk`,`ttl`,`alamat`,`image`) values ('1122','dadd','L','2015-10-26','asa','index.jpg'),('13132','sxc','P','2015-12-15','dfff',''),('14241','bjxbjs','P','2015-11-02','rt_03',''),('15553',' smfsf','L','2015-12-08','aaddad',''),('2545442','nsjwsj','L','2015-10-27','swhduwhdhd','');

/*Table structure for table `buku` */

DROP TABLE IF EXISTS `buku`;

CREATE TABLE `buku` (
  `kode_buku` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `judul` varchar(100) NOT NULL,
  `id_pengarang` int(11) unsigned NOT NULL,
  `id_penerbit` int(11) unsigned NOT NULL,
  `id_klasifikasi` int(11) unsigned NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`kode_buku`),
  UNIQUE KEY `kode_buku` (`kode_buku`),
  KEY `id_pengarang` (`id_pengarang`),
  KEY `id_penerbit` (`id_penerbit`),
  KEY `id_klasifikasi` (`id_klasifikasi`),
  CONSTRAINT `buku_ibfk_1` FOREIGN KEY (`id_pengarang`) REFERENCES `pengarang` (`id_pengarang`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `buku_ibfk_2` FOREIGN KEY (`id_penerbit`) REFERENCES `penerbit` (`id_penerbit`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `buku_ibfk_3` FOREIGN KEY (`id_klasifikasi`) REFERENCES `klasifikasi` (`id_klasifikasi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `buku` */

insert  into `buku`(`kode_buku`,`judul`,`id_pengarang`,`id_penerbit`,`id_klasifikasi`,`image`) values (1,'Ommu Platfom 2 1233',1,1,1,'dialog.png'),(2,'judul buku 2',1,1,1,'logo_top.png'),(3,'test 2',2,2,2,'logo_tamsis.gif');

/*Table structure for table `klasifikasi` */

DROP TABLE IF EXISTS `klasifikasi`;

CREATE TABLE `klasifikasi` (
  `id_klasifikasi` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `jenis_klasifikasi` varchar(50) CHARACTER SET latin1 NOT NULL,
  `keterangan` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_klasifikasi`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `klasifikasi` */

insert  into `klasifikasi`(`id_klasifikasi`,`jenis_klasifikasi`,`keterangan`) values (1,'Komputer','<p>komputer, internet dll</p>'),(2,'Komputer 2','');

/*Table structure for table `penerbit` */

DROP TABLE IF EXISTS `penerbit`;

CREATE TABLE `penerbit` (
  `id_penerbit` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `penerbit` varchar(50) CHARACTER SET latin1 NOT NULL,
  `alamat_penerbit` varchar(60) CHARACTER SET latin1 NOT NULL,
  `keterangan` varchar(50) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_penerbit`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

/*Data for the table `penerbit` */

insert  into `penerbit`(`id_penerbit`,`penerbit`,`alamat_penerbit`,`keterangan`) values (1,'Ommu Platfom','Ommu Platfom','<p>Ommu Platfom</p>'),(2,'Ommu Platfom 2','','');

/*Table structure for table `pengarang` */

DROP TABLE IF EXISTS `pengarang`;

CREATE TABLE `pengarang` (
  `id_pengarang` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nama_pengarang` varchar(50) CHARACTER SET latin1 NOT NULL,
  `keterangan` varchar(50) CHARACTER SET latin1 NOT NULL,
  `image` varchar(100) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id_pengarang`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `pengarang` */

insert  into `pengarang`(`id_pengarang`,`nama_pengarang`,`keterangan`,`image`) values (1,'Ommu Platfom','<p>Ommu Platfom</p>','0_(3).jpg'),(2,'Ommu Platfom 2','',''),(3,'aaaaa','<p>aaaa</p>','');

/*Table structure for table `pengembalian` */

DROP TABLE IF EXISTS `pengembalian`;

CREATE TABLE `pengembalian` (
  `id_transaksi` varchar(12) DEFAULT NULL,
  `tgl_pengembalian` date DEFAULT NULL,
  `denda` varchar(2) DEFAULT NULL,
  `nominal` double DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `pengembalian` */

insert  into `pengembalian`(`id_transaksi`,`tgl_pengembalian`,`denda`,`nominal`,`id_petugas`) values ('20151226001','2015-12-26','N',0,NULL),('20151226001','2015-12-26','N',0,NULL);

/*Table structure for table `petugas` */

DROP TABLE IF EXISTS `petugas`;

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(45) DEFAULT NULL,
  `password` text,
  PRIMARY KEY (`id_petugas`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `petugas` */

insert  into `petugas`(`id_petugas`,`user`,`password`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3');

/*Table structure for table `tmp` */

DROP TABLE IF EXISTS `tmp`;

CREATE TABLE `tmp` (
  `kode_buku` varchar(7) NOT NULL,
  `judul` varchar(100) NOT NULL,
  `pengarang` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `tmp` */

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_transaksi` varchar(12) NOT NULL DEFAULT '',
  `nia` varchar(10) DEFAULT NULL,
  `kode_buku` varchar(7) DEFAULT NULL,
  `tanggal_pinjam` date DEFAULT NULL,
  `tanggal_kembali` date DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `id_petugas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

/*Data for the table `transaksi` */

insert  into `transaksi`(`id`,`id_transaksi`,`nia`,`kode_buku`,`tanggal_pinjam`,`tanggal_kembali`,`status`,`id_petugas`) values (1,'20151226001','15553','001.001','2015-12-26','2016-01-02','Y',NULL),(2,'20151226001','15553','002.003','2015-12-26','2016-01-02','Y',NULL),(3,'','14241',NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `view_buku` */

DROP TABLE IF EXISTS `view_buku`;

/*!50001 DROP VIEW IF EXISTS `view_buku` */;
/*!50001 DROP TABLE IF EXISTS `view_buku` */;

/*!50001 CREATE TABLE  `view_buku`(
 `kode_buku` int(11) unsigned ,
 `buku` varchar(7) ,
 `judul` varchar(100) ,
 `image` varchar(100) ,
 `jenis_klasifikasi` varchar(50) ,
 `penerbit` varchar(50) ,
 `nama_pengarang` varchar(50) 
)*/;

/*View structure for view view_buku */

/*!50001 DROP TABLE IF EXISTS `view_buku` */;
/*!50001 DROP VIEW IF EXISTS `view_buku` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_buku` AS select `a`.`kode_buku` AS `kode_buku`,concat(lpad(`b`.`id_klasifikasi`,3,'0'),'.',lpad(`a`.`kode_buku`,3,'0')) AS `buku`,`a`.`judul` AS `judul`,`a`.`image` AS `image`,`b`.`jenis_klasifikasi` AS `jenis_klasifikasi`,`c`.`penerbit` AS `penerbit`,`d`.`nama_pengarang` AS `nama_pengarang` from (((`buku` `a` left join `klasifikasi` `b` on((`a`.`id_klasifikasi` = `b`.`id_klasifikasi`))) left join `penerbit` `c` on((`a`.`id_penerbit` = `c`.`id_penerbit`))) left join `pengarang` `d` on((`a`.`id_pengarang` = `d`.`id_pengarang`))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
