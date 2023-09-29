

CREATE TABLE `accounts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `initial_balance` double DEFAULT NULL,
  `total_balance` double NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_default` tinyint(1) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO accounts VALUES("1","11111","Sales Account","","0","this is first account","1","1","2018-12-18 02:58:02","2021-03-01 18:44:55");
INSERT INTO accounts VALUES("3","21211","Sa","","0","","0","1","2018-12-18 02:58:56","2021-03-01 18:42:41");
INSERT INTO accounts VALUES("4","12","121","100","100","","0","1","2021-03-01 18:44:40","2021-03-01 18:44:55");



CREATE TABLE `adjustments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total_qty` double NOT NULL,
  `item` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `attendances` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `employee_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `checkin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkout` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO attendances VALUES("1","2021-03-06","1","1","10:00am","6:00pm","1","","2021-03-06 09:38:29","2021-03-06 09:38:29");



CREATE TABLE `billers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vat_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO billers VALUES("1","Ivania","","Tk Jakarta","","niaiva98@gmail.com","-","-","-","","","","1","2021-03-07 12:01:11","2021-03-07 12:01:11");



CREATE TABLE `brands` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO brands VALUES("1","Cardinal","","1","2021-03-07 03:57:16","2021-03-07 03:57:16");
INSERT INTO brands VALUES("2","Rolun","","1","2021-03-08 04:05:08","2021-03-08 04:05:08");
INSERT INTO brands VALUES("3","-","","1","2021-04-09 08:16:25","2021-04-09 08:16:25");
INSERT INTO brands VALUES("4","No Brand","","1","2021-04-09 08:48:37","2021-04-09 09:18:06");
INSERT INTO brands VALUES("5","Lotto","","1","2021-04-09 11:59:43","2021-04-09 11:59:43");
INSERT INTO brands VALUES("6","No Btrand","","1","2021-04-13 06:44:49","2021-04-13 06:44:49");



CREATE TABLE `cash_registers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cash_in_hand` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO cash_registers VALUES("1","0","31","1","1","2021-03-07 12:00:12","2021-03-07 12:00:12");
INSERT INTO cash_registers VALUES("2","10","1","1","1","2021-03-21 03:03:11","2021-03-21 03:03:11");



CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO categories VALUES("1","Pria","","","0","2021-03-06 12:33:41","2021-03-07 04:21:11");
INSERT INTO categories VALUES("2","Celana Pria","","","1","2021-03-06 12:34:01","2021-03-07 04:21:06");
INSERT INTO categories VALUES("3","Atasan Pria","","1","0","2021-03-06 12:34:16","2021-03-07 04:19:50");
INSERT INTO categories VALUES("4","Celana Chinos Pendek","","7","1","2021-03-06 12:37:54","2021-03-07 04:18:41");
INSERT INTO categories VALUES("5","Celana Cargo Pria","","2","1","2021-03-07 04:15:39","2021-03-07 04:19:07");
INSERT INTO categories VALUES("6","Celana Chinos Panjang","","7","1","2021-03-07 04:16:18","2021-03-07 04:18:49");
INSERT INTO categories VALUES("7","Celana Chinos Pria","","2","1","2021-03-07 04:18:31","2021-03-07 04:18:31");
INSERT INTO categories VALUES("8","Celana Cargo Pendek","","5","1","2021-03-07 04:21:46","2021-03-07 04:21:46");
INSERT INTO categories VALUES("9","Celana Cargo Panjang","","5","1","2021-03-07 04:22:17","2021-03-07 04:22:17");
INSERT INTO categories VALUES("10","Celana Jeans Pria","","2","1","2021-03-07 04:24:13","2021-03-07 04:24:39");
INSERT INTO categories VALUES("11","Celana Jeans Pendek","","10","1","2021-03-07 04:24:27","2021-03-07 04:24:27");
INSERT INTO categories VALUES("12","Celana Jeans Panjang","","10","1","2021-03-07 04:25:15","2021-03-07 04:25:15");
INSERT INTO categories VALUES("13","Celana Kantor Pria","","2","1","2021-03-07 04:25:39","2021-03-23 10:01:16");
INSERT INTO categories VALUES("14","Celana Olahraga","","","0","2021-03-07 04:26:01","2021-03-23 09:39:11");
INSERT INTO categories VALUES("15","Atasan Wanita","","","1","2021-03-08 04:00:15","2021-03-08 04:00:15");
INSERT INTO categories VALUES("16","Bawahan Wanita","","","1","2021-03-08 04:00:24","2021-03-08 04:00:24");
INSERT INTO categories VALUES("17","Bawahan Pria","","","1","2021-03-08 04:00:33","2021-03-08 04:00:33");
INSERT INTO categories VALUES("18","Jacket Wanita","","15","1","2021-03-08 04:00:51","2021-03-08 04:00:51");
INSERT INTO categories VALUES("19","Celana Kantor Wanita","","16","1","2021-03-08 04:55:39","2021-03-08 04:55:39");
INSERT INTO categories VALUES("20","Celana Kain Wanita","","16","1","2021-03-08 04:55:57","2021-03-08 04:55:57");
INSERT INTO categories VALUES("21","Overall Wanita","","15","1","2021-03-08 05:05:29","2021-03-23 03:58:50");
INSERT INTO categories VALUES("22","Rok Wanita","","16","1","2021-03-08 05:05:51","2021-03-08 05:05:51");
INSERT INTO categories VALUES("23","Celana Kain Pria","","2","1","2021-03-08 07:36:43","2021-03-08 07:36:43");
INSERT INTO categories VALUES("24","Atasan Pria","","","1","2021-03-13 15:50:38","2021-03-13 15:50:38");
INSERT INTO categories VALUES("25","Jacket Pria","","24","1","2021-03-13 15:50:55","2021-03-13 15:50:55");
INSERT INTO categories VALUES("26","Kemeja Pria","","24","1","2021-03-13 15:51:09","2021-03-13 15:51:09");
INSERT INTO categories VALUES("27","T-Shirt Pria","","24","1","2021-03-13 15:51:26","2021-03-13 15:51:26");
INSERT INTO categories VALUES("28","Kaus Polo Pria","","24","1","2021-03-13 15:51:43","2021-03-13 15:51:43");
INSERT INTO categories VALUES("29","Sweater Pria","","24","1","2021-03-13 15:51:59","2021-03-13 15:51:59");
INSERT INTO categories VALUES("30","Kemeja/Blouse Wanita","","15","1","2021-03-23 03:47:20","2021-03-23 03:47:20");
INSERT INTO categories VALUES("31","Kaus Wanita","","15","1","2021-03-23 03:47:45","2021-03-23 03:47:45");
INSERT INTO categories VALUES("32","Knitted Wear Wanita","","15","1","2021-03-23 03:48:56","2021-03-23 03:48:56");
INSERT INTO categories VALUES("33","Jilbab","","","1","2021-03-23 03:49:37","2021-03-23 03:49:37");
INSERT INTO categories VALUES("34","Blazer Wanita","","15","1","2021-03-23 03:49:54","2021-03-23 03:49:54");
INSERT INTO categories VALUES("35","Celana Jeans Wanita","","16","1","2021-03-23 03:50:44","2021-03-23 03:50:44");
INSERT INTO categories VALUES("36","Legging","","16","1","2021-03-23 03:51:44","2021-03-23 03:51:44");
INSERT INTO categories VALUES("37","Daster","","15","1","2021-03-23 09:40:13","2021-03-23 09:40:13");
INSERT INTO categories VALUES("38","Batik Dress","","15","1","2021-03-23 09:40:49","2021-03-23 09:40:49");
INSERT INTO categories VALUES("39","Batik Atasan","","15","1","2021-03-23 09:41:10","2021-03-23 09:41:10");
INSERT INTO categories VALUES("40","Gamis","","15","1","2021-03-23 09:41:24","2021-03-23 09:41:24");
INSERT INTO categories VALUES("41","Pakaian Tidur Wanita","","15","1","2021-03-23 09:42:18","2021-03-23 09:42:18");
INSERT INTO categories VALUES("42","Outer Wanita","","15","1","2021-03-23 09:42:36","2021-03-23 09:42:36");
INSERT INTO categories VALUES("43","Celana Cullotes","","16","1","2021-03-23 09:44:25","2021-03-23 09:44:25");
INSERT INTO categories VALUES("44","Kaus Pria","","24","1","2021-03-23 09:56:24","2021-03-23 09:56:24");
INSERT INTO categories VALUES("45","Batik Pria","","24","1","2021-03-23 09:57:20","2021-03-23 09:57:20");
INSERT INTO categories VALUES("46","Pakaian Muslim Pria","","24","1","2021-03-23 09:59:11","2021-03-23 09:59:11");
INSERT INTO categories VALUES("47","Celana Sirwal","","2","1","2021-03-23 10:00:12","2021-03-23 10:00:12");
INSERT INTO categories VALUES("48","Others","","","1","2021-03-23 10:02:54","2021-03-23 10:02:54");
INSERT INTO categories VALUES("49","UNISEX","","","1","2021-03-23 10:03:02","2021-03-23 10:03:02");
INSERT INTO categories VALUES("50","Underwear","","","1","2021-03-23 10:03:12","2021-03-23 10:03:12");
INSERT INTO categories VALUES("51","Baby and Kids","","","1","2021-03-23 10:03:30","2021-03-23 10:03:30");
INSERT INTO categories VALUES("52","Pakaian Anak Perempuan","","","1","2021-03-23 10:03:48","2021-03-23 10:03:48");
INSERT INTO categories VALUES("53","Pakaian Anak Laki-laki","","","1","2021-03-23 10:04:04","2021-03-23 10:04:04");
INSERT INTO categories VALUES("54","Bra","","50","1","2021-03-23 10:05:21","2021-03-23 10:05:21");
INSERT INTO categories VALUES("55","Celana Dalam Wanita","","50","1","2021-03-23 10:05:38","2021-03-23 10:05:38");
INSERT INTO categories VALUES("56","Short Wanita","","50","1","2021-03-23 10:06:01","2021-03-23 10:06:01");
INSERT INTO categories VALUES("57","Tanktop","","50","1","2021-03-23 10:06:13","2021-03-23 10:06:13");
INSERT INTO categories VALUES("58","Miniset","","50","1","2021-03-23 10:06:26","2021-03-23 10:06:26");
INSERT INTO categories VALUES("59","Manset","","50","1","2021-03-23 10:06:45","2021-03-23 10:06:45");
INSERT INTO categories VALUES("60","Korset","","50","1","2021-03-23 10:07:04","2021-03-23 10:07:04");
INSERT INTO categories VALUES("61","Gurita Ibu","","50","1","2021-03-23 10:07:17","2021-03-23 10:07:17");
INSERT INTO categories VALUES("62","Celana Dalam Pria","","50","1","2021-03-23 10:07:35","2021-03-23 10:07:35");
INSERT INTO categories VALUES("63","Boxer Pria","","50","1","2021-03-23 10:07:52","2021-03-23 10:07:52");
INSERT INTO categories VALUES("64","Singlet Pria","","50","1","2021-03-23 10:24:18","2021-03-23 10:24:18");
INSERT INTO categories VALUES("65","Kaus Dalam Oblong","","50","1","2021-03-23 10:24:40","2021-03-23 10:24:40");
INSERT INTO categories VALUES("66","Celana Dalam Anak","","51","1","2021-03-23 10:27:01","2021-03-23 10:27:01");
INSERT INTO categories VALUES("67","Singlet Anak / Baby","","51","1","2021-03-23 10:27:33","2021-03-23 10:27:33");
INSERT INTO categories VALUES("68","Lampin Baby","","51","1","2021-03-23 10:27:52","2021-03-23 10:27:52");
INSERT INTO categories VALUES("69","Popok Baby","","51","1","2021-03-23 10:28:18","2021-03-23 10:28:18");
INSERT INTO categories VALUES("70","Baju Baby","","51","1","2021-03-23 10:28:51","2021-03-23 10:28:51");
INSERT INTO categories VALUES("71","Celana Baby","","51","1","2021-03-23 10:29:17","2021-03-23 10:29:17");
INSERT INTO categories VALUES("72","Celana Kodok Baby","","51","1","2021-03-23 10:29:39","2021-03-23 10:29:39");
INSERT INTO categories VALUES("73","Gurita Baby","","51","1","2021-03-23 10:30:07","2021-03-23 10:30:07");
INSERT INTO categories VALUES("74","Baby Gloves","","51","1","2021-03-23 10:30:58","2021-03-23 10:30:58");
INSERT INTO categories VALUES("75","Baby Shoes","","51","1","2021-03-23 10:31:19","2021-03-23 10:31:19");
INSERT INTO categories VALUES("76","Topi Baby","","51","1","2021-03-23 10:35:26","2021-03-23 10:35:26");
INSERT INTO categories VALUES("77","Celemek Baby","","51","1","2021-03-23 10:36:04","2021-03-23 10:36:04");
INSERT INTO categories VALUES("78","Baby Socks","","51","1","2021-03-23 10:36:25","2021-03-23 10:36:25");
INSERT INTO categories VALUES("79","Kasur Baby","","51","1","2021-03-23 10:36:45","2021-03-23 10:36:45");
INSERT INTO categories VALUES("80","Bantal Baby","","51","1","2021-03-23 10:37:03","2021-03-23 10:37:03");
INSERT INTO categories VALUES("81","Jacket Baby / Anak","","51","1","2021-03-23 10:37:44","2021-03-23 10:37:44");
INSERT INTO categories VALUES("82","Kids Apparel (Girl)","","","1","2021-03-23 10:41:35","2021-03-23 10:41:35");
INSERT INTO categories VALUES("83","Kids Apparel (Boy)","","","1","2021-03-23 10:41:52","2021-03-23 10:41:52");
INSERT INTO categories VALUES("84","Girl T-Shirt","","82","1","2021-03-23 10:42:32","2021-03-23 10:42:32");
INSERT INTO categories VALUES("85","Girl Pants","","82","1","2021-03-23 10:42:43","2021-03-23 10:42:43");
INSERT INTO categories VALUES("86","Girl Dress","","82","1","2021-03-23 10:42:52","2021-03-23 10:42:52");
INSERT INTO categories VALUES("87","Girl Overall","","82","1","2021-03-23 10:43:03","2021-03-23 10:43:03");
INSERT INTO categories VALUES("88","Pakaian Muslim / Gamis Anak (Girl)","","82","1","2021-03-23 10:43:39","2021-03-23 10:43:39");
INSERT INTO categories VALUES("89","Boy T-shirt","","83","1","2021-03-23 10:46:17","2021-03-23 10:46:17");
INSERT INTO categories VALUES("90","Boy Polo T-Shirt","","83","1","2021-03-23 10:46:42","2021-03-23 10:46:42");
INSERT INTO categories VALUES("91","Celana Denim Boy","","83","1","2021-03-23 10:47:05","2021-03-23 10:47:05");
INSERT INTO categories VALUES("92","Celana Kain Boy","","83","1","2021-03-23 10:47:34","2021-03-23 10:47:34");
INSERT INTO categories VALUES("93","Kemeja Boy","","83","1","2021-03-23 10:47:52","2021-03-23 10:47:52");
INSERT INTO categories VALUES("94","Pakaian Muslim / Stelan Anak (Boy)","","83","1","2021-03-23 10:48:27","2021-03-23 10:48:27");
INSERT INTO categories VALUES("95","Celana Training Pendek","","49","1","2021-03-23 10:49:20","2021-03-23 10:49:20");
INSERT INTO categories VALUES("96","Celana Pendek Kaus","","49","1","2021-03-23 10:49:42","2021-03-23 10:49:42");
INSERT INTO categories VALUES("97","Celana Pendek Kain UNI","","49","1","2021-03-23 10:50:33","2021-03-23 10:50:33");
INSERT INTO categories VALUES("98","Celana Sepeda","","49","1","2021-03-23 10:51:20","2021-03-23 10:51:20");
INSERT INTO categories VALUES("99","Celana Training Panjang","","49","1","2021-03-23 10:51:49","2021-03-23 10:51:49");
INSERT INTO categories VALUES("100","Legging Olahraga","","49","1","2021-03-23 10:52:04","2021-03-23 10:52:04");
INSERT INTO categories VALUES("101","Kaus Drifit","","49","1","2021-03-23 10:52:17","2021-03-23 10:52:17");
INSERT INTO categories VALUES("102","Kaus Couple","","49","1","2021-03-23 10:52:28","2021-03-23 10:52:28");
INSERT INTO categories VALUES("103","Batik Couple","","49","1","2021-03-23 10:52:45","2021-03-23 10:52:45");
INSERT INTO categories VALUES("104","Handuk","","48","1","2021-03-23 10:53:13","2021-03-23 10:53:13");
INSERT INTO categories VALUES("105","Sarung","","48","1","2021-03-23 10:53:30","2021-03-23 10:53:30");
INSERT INTO categories VALUES("106","Kain Jarik","","48","1","2021-03-23 10:53:51","2021-03-23 10:53:51");
INSERT INTO categories VALUES("107","Songkok","","48","1","2021-03-23 10:54:05","2021-03-23 10:54:05");
INSERT INTO categories VALUES("108","Sorban","","48","1","2021-03-23 10:54:20","2021-03-23 10:54:20");
INSERT INTO categories VALUES("109","Socks","","48","1","2021-03-23 10:54:43","2021-03-23 10:54:43");
INSERT INTO categories VALUES("110","Sajadah","","48","1","2021-03-23 10:54:59","2021-03-23 10:54:59");
INSERT INTO categories VALUES("111","Kemeja / Blouse Wanita","","","1","2021-03-24 02:15:31","2021-03-24 02:15:31");
INSERT INTO categories VALUES("112","Set Seprai","","48","1","2021-03-24 04:07:48","2021-03-24 04:07:48");
INSERT INTO categories VALUES("113","Sarung Bantal","","48","1","2021-03-24 04:08:10","2021-03-24 04:08:10");
INSERT INTO categories VALUES("114","Selimut","","48","1","2021-03-24 04:08:22","2021-03-24 04:08:22");
INSERT INTO categories VALUES("115","Kelambu","","48","1","2021-03-24 04:08:35","2021-03-24 04:08:35");
INSERT INTO categories VALUES("116","accessories","","","1","2021-04-09 11:59:43","2021-04-09 11:59:43");
INSERT INTO categories VALUES("117","","","","1","2021-04-11 04:38:14","2021-04-11 04:38:14");



CREATE TABLE `coupons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `minimum_amount` double DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `used` int(11) NOT NULL,
  `expired_date` date NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `currencies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `exchange_rate` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO currencies VALUES("1","Rupiah","Rp","1","2020-11-01 00:22:58","2021-02-25 04:47:33");



CREATE TABLE `customer_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `percentage` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO customer_groups VALUES("1","Jual Eceran","0","1","2021-03-07 11:58:58","2021-03-07 11:58:58");
INSERT INTO customer_groups VALUES("2","Reseller","0","1","2021-04-19 06:53:23","2021-04-19 06:53:23");
INSERT INTO customer_groups VALUES("3","Internal","0","1","2021-04-19 06:53:42","2021-04-19 06:53:42");



CREATE TABLE `customers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_group_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_no` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deposit` double DEFAULT NULL,
  `expense` double DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO customers VALUES("1","1","","-","","","-","","-","-","","","","","","1","2021-03-07 11:59:44","2021-03-07 11:59:44");
INSERT INTO customers VALUES("2","3","","IRPAN","-","","01","","Tk Jakarta","Tj Selor","","","","","","1","2021-04-19 06:55:37","2021-04-19 06:55:37");
INSERT INTO customers VALUES("3","3","","Ratna","-","","02","","Tk Jakarta","Tj Selor","","","","","","1","2021-04-19 06:56:18","2021-04-19 06:56:18");
INSERT INTO customers VALUES("4","3","","Reva","-","","03","","Tk Jakarta","Tj Selor","","","","","","1","2021-04-19 06:56:44","2021-04-19 06:56:44");
INSERT INTO customers VALUES("5","3","","Andi","","","04","","Tk Jakarta","Tj Selor","","","","","","1","2021-04-19 06:57:16","2021-04-19 06:58:49");
INSERT INTO customers VALUES("6","3","","Rina","","","05","","Tk Jakarta","Tj Selor","","","","","","1","2021-04-19 06:57:42","2021-04-19 06:59:03");
INSERT INTO customers VALUES("7","3","","Valen","","","06","","Tk Jakarta","Tj Selor","","","","","","1","2021-04-19 06:58:03","2021-04-19 06:59:12");
INSERT INTO customers VALUES("8","2","","Mama Amir","","","001","","Pasar Induk","Tj Selor","","","","","","1","2021-04-19 06:58:35","2021-04-19 06:59:24");



CREATE TABLE `deliveries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sale_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `delivered_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recieved_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO departments VALUES("1","Karyawan","1","2021-03-06 09:37:22","2021-03-06 09:37:22");



CREATE TABLE `deposits` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` double NOT NULL,
  `customer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `employees` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO employees VALUES("1","Dian","dian@mail.com","0494948474","1","","","","","","1","2021-03-06 09:38:12","2021-03-06 09:38:12");



CREATE TABLE `expense_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `expenses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expense_category_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cash_register_id` int(11) DEFAULT NULL,
  `amount` double NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `general_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `site_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `currency` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `staff_access` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date_format` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `developed_by` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `invoice_format` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `theme` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `currency_position` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO general_settings VALUES("1","Nania Store","20210406121308.png","1","own","d/m/Y","manajemen.co.id","standard","1","default.css","2018-07-06 06:13:11","2021-04-06 12:13:08","prefix");



CREATE TABLE `gift_card_recharges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `gift_card_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `gift_cards` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `card_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `expense` double NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `expired_date` date DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `holidays` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_approved` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `hrm_settings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `checkin` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `checkout` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO hrm_settings VALUES("1","10:00am","6:00pm","2019-01-02 02:20:08","2019-01-02 04:20:53");



CREATE TABLE `languages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO languages VALUES("1","en","2018-07-07 22:59:17","2019-12-24 17:34:20");



CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES("1","2014_10_12_000000_create_users_table","1");
INSERT INTO migrations VALUES("2","2014_10_12_100000_create_password_resets_table","1");
INSERT INTO migrations VALUES("3","2018_02_17_060412_create_categories_table","1");
INSERT INTO migrations VALUES("4","2018_02_20_035727_create_brands_table","1");
INSERT INTO migrations VALUES("5","2018_02_25_100635_create_suppliers_table","1");
INSERT INTO migrations VALUES("6","2018_02_27_101619_create_warehouse_table","1");
INSERT INTO migrations VALUES("7","2018_03_03_040448_create_units_table","1");
INSERT INTO migrations VALUES("8","2018_03_04_041317_create_taxes_table","1");
INSERT INTO migrations VALUES("9","2018_03_10_061915_create_customer_groups_table","1");
INSERT INTO migrations VALUES("10","2018_03_10_090534_create_customers_table","1");
INSERT INTO migrations VALUES("11","2018_03_11_095547_create_billers_table","1");
INSERT INTO migrations VALUES("12","2018_04_05_054401_create_products_table","1");
INSERT INTO migrations VALUES("13","2018_04_06_133606_create_purchases_table","1");
INSERT INTO migrations VALUES("14","2018_04_06_154600_create_product_purchases_table","1");
INSERT INTO migrations VALUES("15","2018_04_06_154915_create_product_warhouse_table","1");
INSERT INTO migrations VALUES("16","2018_04_10_085927_create_sales_table","1");
INSERT INTO migrations VALUES("17","2018_04_10_090133_create_product_sales_table","1");
INSERT INTO migrations VALUES("18","2018_04_10_090254_create_payments_table","1");
INSERT INTO migrations VALUES("19","2018_04_10_090341_create_payment_with_cheque_table","1");
INSERT INTO migrations VALUES("20","2018_04_10_090509_create_payment_with_credit_card_table","1");
INSERT INTO migrations VALUES("21","2018_04_13_121436_create_quotation_table","1");
INSERT INTO migrations VALUES("22","2018_04_13_122324_create_product_quotation_table","1");
INSERT INTO migrations VALUES("23","2018_04_14_121802_create_transfers_table","1");
INSERT INTO migrations VALUES("24","2018_04_14_121913_create_product_transfer_table","1");
INSERT INTO migrations VALUES("25","2018_05_13_082847_add_payment_id_and_change_sale_id_to_payments_table","2");
INSERT INTO migrations VALUES("26","2018_05_13_090906_change_customer_id_to_payment_with_credit_card_table","3");
INSERT INTO migrations VALUES("27","2018_05_20_054532_create_adjustments_table","4");
INSERT INTO migrations VALUES("28","2018_05_20_054859_create_product_adjustments_table","4");
INSERT INTO migrations VALUES("29","2018_05_21_163419_create_returns_table","5");
INSERT INTO migrations VALUES("30","2018_05_21_163443_create_product_returns_table","5");
INSERT INTO migrations VALUES("31","2018_06_02_050905_create_roles_table","6");
INSERT INTO migrations VALUES("32","2018_06_02_073430_add_columns_to_users_table","7");
INSERT INTO migrations VALUES("33","2018_06_03_053738_create_permission_tables","8");
INSERT INTO migrations VALUES("36","2018_06_21_063736_create_pos_setting_table","9");
INSERT INTO migrations VALUES("37","2018_06_21_094155_add_user_id_to_sales_table","10");
INSERT INTO migrations VALUES("38","2018_06_21_101529_add_user_id_to_purchases_table","11");
INSERT INTO migrations VALUES("39","2018_06_21_103512_add_user_id_to_transfers_table","12");
INSERT INTO migrations VALUES("40","2018_06_23_061058_add_user_id_to_quotations_table","13");
INSERT INTO migrations VALUES("41","2018_06_23_082427_add_is_deleted_to_users_table","14");
INSERT INTO migrations VALUES("42","2018_06_25_043308_change_email_to_users_table","15");
INSERT INTO migrations VALUES("43","2018_07_06_115449_create_general_settings_table","16");
INSERT INTO migrations VALUES("44","2018_07_08_043944_create_languages_table","17");
INSERT INTO migrations VALUES("45","2018_07_11_102144_add_user_id_to_returns_table","18");
INSERT INTO migrations VALUES("46","2018_07_11_102334_add_user_id_to_payments_table","18");
INSERT INTO migrations VALUES("47","2018_07_22_130541_add_digital_to_products_table","19");
INSERT INTO migrations VALUES("49","2018_07_24_154250_create_deliveries_table","20");
INSERT INTO migrations VALUES("50","2018_08_16_053336_create_expense_categories_table","21");
INSERT INTO migrations VALUES("51","2018_08_17_115415_create_expenses_table","22");
INSERT INTO migrations VALUES("55","2018_08_18_050418_create_gift_cards_table","23");
INSERT INTO migrations VALUES("56","2018_08_19_063119_create_payment_with_gift_card_table","24");
INSERT INTO migrations VALUES("57","2018_08_25_042333_create_gift_card_recharges_table","25");
INSERT INTO migrations VALUES("58","2018_08_25_101354_add_deposit_expense_to_customers_table","26");
INSERT INTO migrations VALUES("59","2018_08_26_043801_create_deposits_table","27");
INSERT INTO migrations VALUES("60","2018_09_02_044042_add_keybord_active_to_pos_setting_table","28");
INSERT INTO migrations VALUES("61","2018_09_09_092713_create_payment_with_paypal_table","29");
INSERT INTO migrations VALUES("62","2018_09_10_051254_add_currency_to_general_settings_table","30");
INSERT INTO migrations VALUES("63","2018_10_22_084118_add_biller_and_store_id_to_users_table","31");
INSERT INTO migrations VALUES("65","2018_10_26_034927_create_coupons_table","32");
INSERT INTO migrations VALUES("66","2018_10_27_090857_add_coupon_to_sales_table","33");
INSERT INTO migrations VALUES("67","2018_11_07_070155_add_currency_position_to_general_settings_table","34");
INSERT INTO migrations VALUES("68","2018_11_19_094650_add_combo_to_products_table","35");
INSERT INTO migrations VALUES("69","2018_12_09_043712_create_accounts_table","36");
INSERT INTO migrations VALUES("70","2018_12_17_112253_add_is_default_to_accounts_table","37");
INSERT INTO migrations VALUES("71","2018_12_19_103941_add_account_id_to_payments_table","38");
INSERT INTO migrations VALUES("72","2018_12_20_065900_add_account_id_to_expenses_table","39");
INSERT INTO migrations VALUES("73","2018_12_20_082753_add_account_id_to_returns_table","40");
INSERT INTO migrations VALUES("74","2018_12_26_064330_create_return_purchases_table","41");
INSERT INTO migrations VALUES("75","2018_12_26_144210_create_purchase_product_return_table","42");
INSERT INTO migrations VALUES("76","2018_12_26_144708_create_purchase_product_return_table","43");
INSERT INTO migrations VALUES("77","2018_12_27_110018_create_departments_table","44");
INSERT INTO migrations VALUES("78","2018_12_30_054844_create_employees_table","45");
INSERT INTO migrations VALUES("79","2018_12_31_125210_create_payrolls_table","46");
INSERT INTO migrations VALUES("80","2018_12_31_150446_add_department_id_to_employees_table","47");
INSERT INTO migrations VALUES("81","2019_01_01_062708_add_user_id_to_expenses_table","48");
INSERT INTO migrations VALUES("82","2019_01_02_075644_create_hrm_settings_table","49");
INSERT INTO migrations VALUES("83","2019_01_02_090334_create_attendances_table","50");
INSERT INTO migrations VALUES("84","2019_01_27_160956_add_three_columns_to_general_settings_table","51");
INSERT INTO migrations VALUES("85","2019_02_15_183303_create_stock_counts_table","52");
INSERT INTO migrations VALUES("86","2019_02_17_101604_add_is_adjusted_to_stock_counts_table","53");
INSERT INTO migrations VALUES("87","2019_04_13_101707_add_tax_no_to_customers_table","54");
INSERT INTO migrations VALUES("89","2019_10_14_111455_create_holidays_table","55");
INSERT INTO migrations VALUES("90","2019_11_13_145619_add_is_variant_to_products_table","56");
INSERT INTO migrations VALUES("91","2019_11_13_150206_create_product_variants_table","57");
INSERT INTO migrations VALUES("92","2019_11_13_153828_create_variants_table","57");
INSERT INTO migrations VALUES("93","2019_11_25_134041_add_qty_to_product_variants_table","58");
INSERT INTO migrations VALUES("94","2019_11_25_134922_add_variant_id_to_product_purchases_table","58");
INSERT INTO migrations VALUES("95","2019_11_25_145341_add_variant_id_to_product_warehouse_table","58");
INSERT INTO migrations VALUES("96","2019_11_29_182201_add_variant_id_to_product_sales_table","59");
INSERT INTO migrations VALUES("97","2019_12_04_121311_add_variant_id_to_product_quotation_table","60");
INSERT INTO migrations VALUES("98","2019_12_05_123802_add_variant_id_to_product_transfer_table","61");
INSERT INTO migrations VALUES("100","2019_12_08_114954_add_variant_id_to_product_returns_table","62");
INSERT INTO migrations VALUES("101","2019_12_08_203146_add_variant_id_to_purchase_product_return_table","63");
INSERT INTO migrations VALUES("102","2020_02_28_103340_create_money_transfers_table","64");
INSERT INTO migrations VALUES("103","2020_07_01_193151_add_image_to_categories_table","65");
INSERT INTO migrations VALUES("105","2020_09_26_130426_add_user_id_to_deliveries_table","66");
INSERT INTO migrations VALUES("107","2020_10_11_125457_create_cash_registers_table","67");
INSERT INTO migrations VALUES("108","2020_10_13_155019_add_cash_register_id_to_sales_table","68");
INSERT INTO migrations VALUES("109","2020_10_13_172624_add_cash_register_id_to_returns_table","69");
INSERT INTO migrations VALUES("110","2020_10_17_212338_add_cash_register_id_to_payments_table","70");
INSERT INTO migrations VALUES("111","2020_10_18_124200_add_cash_register_id_to_expenses_table","71");
INSERT INTO migrations VALUES("112","2020_10_21_121632_add_developed_by_to_general_settings_table","72");
INSERT INTO migrations VALUES("113","2019_08_19_000000_create_failed_jobs_table","73");
INSERT INTO migrations VALUES("114","2020_10_30_135557_create_notifications_table","73");
INSERT INTO migrations VALUES("115","2020_11_01_044954_create_currencies_table","74");
INSERT INTO migrations VALUES("116","2020_11_01_140736_add_price_to_product_warehouse_table","75");
INSERT INTO migrations VALUES("117","2020_11_02_050633_add_is_diff_price_to_products_table","76");
INSERT INTO migrations VALUES("118","2020_11_09_055222_add_user_id_to_customers_table","77");
INSERT INTO migrations VALUES("119","2020_11_17_054806_add_invoice_format_to_general_settings_table","78");
INSERT INTO migrations VALUES("120","2021_02_10_074859_add_variant_id_to_product_adjustments_table","79");



CREATE TABLE `money_transfers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from_account_id` int(11) NOT NULL,
  `to_account_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) unsigned NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `payment_with_cheque` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payment_id` int(11) NOT NULL,
  `cheque_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO payment_with_cheque VALUES("1","111","01","2021-03-26 12:53:08","2021-03-26 12:53:08");



CREATE TABLE `payment_with_credit_card` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payment_id` int(11) NOT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `customer_stripe_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `charge_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `payment_with_gift_card` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payment_id` int(11) NOT NULL,
  `gift_card_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `payment_with_paypal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payment_id` int(11) NOT NULL,
  `transaction_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payment_reference` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `purchase_id` int(11) DEFAULT NULL,
  `sale_id` int(11) DEFAULT NULL,
  `cash_register_id` int(11) DEFAULT NULL,
  `account_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `change` double NOT NULL,
  `paying_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payment_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO payments VALUES("1","spr-20210308-083628","31","","5","1","1","330000","0","Cash","","2021-03-08 08:36:28","2021-03-08 08:36:28");
INSERT INTO payments VALUES("2","spr-20210308-083638","31","","4","1","1","350000","0","Cash","","2021-03-08 08:36:38","2021-03-08 08:36:38");
INSERT INTO payments VALUES("3","spr-20210308-083649","31","","2","1","1","340000","0","Cash","","2021-03-08 08:36:49","2021-03-08 08:36:49");
INSERT INTO payments VALUES("4","spr-20210308-083656","31","","1","1","1","283000","0","Cash","","2021-03-08 08:36:56","2021-03-08 08:36:56");
INSERT INTO payments VALUES("5","spr-20210308-102055","31","","6","1","1","280000","0","Cash","","2021-03-08 10:20:55","2021-03-08 10:20:55");
INSERT INTO payments VALUES("6","spr-20210319-064148","31","","7","1","1","180000","0","Cash","","2021-03-19 06:41:48","2021-03-19 06:41:48");
INSERT INTO payments VALUES("7","spr-20210319-064400","31","","8","1","1","260000","0","Cash","","2021-03-19 06:44:00","2021-03-19 06:44:00");
INSERT INTO payments VALUES("8","spr-20210319-064444","31","","9","1","1","220000","0","Cash","","2021-03-19 06:44:44","2021-03-19 06:44:44");
INSERT INTO payments VALUES("9","spr-20210319-064742","31","","10","1","1","150000","0","Cash","","2021-03-19 06:47:42","2021-03-19 06:47:42");
INSERT INTO payments VALUES("10","spr-20210319-064916","31","","11","1","1","220000","0","Cash","Harga jual 220.000","2021-03-19 06:49:16","2021-03-19 06:49:16");
INSERT INTO payments VALUES("11","spr-20210319-065019","31","","12","1","1","230000","0","Cash","","2021-03-19 06:50:19","2021-03-19 06:50:19");
INSERT INTO payments VALUES("12","spr-20210319-070751","31","","17","1","1","280000","0","Cash","","2021-03-19 07:07:51","2021-03-19 07:07:51");
INSERT INTO payments VALUES("13","spr-20210319-070823","31","","18","1","1","180000","0","Cash","","2021-03-19 07:08:23","2021-03-19 07:08:23");
INSERT INTO payments VALUES("14","spr-20210319-071255","31","","21","1","1","354000","0","Cash","","2021-03-19 07:12:55","2021-03-19 07:12:55");
INSERT INTO payments VALUES("15","spr-20210319-071750","31","","22","1","1","185000","0","Cash","","2021-03-19 07:17:50","2021-03-19 07:17:50");
INSERT INTO payments VALUES("16","spr-20210319-071929","31","","20","1","1","140000","0","Cash","","2021-03-19 07:19:29","2021-03-19 07:19:29");
INSERT INTO payments VALUES("17","spr-20210319-071936","31","","19","1","1","220000","0","Cash","","2021-03-19 07:19:36","2021-03-19 07:19:36");
INSERT INTO payments VALUES("18","spr-20210319-072014","31","","16","1","1","200000","0","Cash","","2021-03-19 07:20:14","2021-03-19 07:20:14");
INSERT INTO payments VALUES("19","spr-20210319-072300","31","","15","1","1","354000","0","Cash","","2021-03-19 07:23:00","2021-03-19 07:23:00");
INSERT INTO payments VALUES("20","spr-20210319-072307","31","","13","1","1","260000","0","Cash","","2021-03-19 07:23:07","2021-03-19 07:23:07");
INSERT INTO payments VALUES("21","spr-20210319-072313","31","","14","1","1","220000","0","Cash","","2021-03-19 07:23:13","2021-03-19 07:23:13");
INSERT INTO payments VALUES("22","spr-20210319-072622","31","","23","1","1","340000","0","Cash","","2021-03-19 07:26:22","2021-03-19 07:26:22");
INSERT INTO payments VALUES("23","spr-20210319-072748","31","","24","1","1","190000","0","Cash","","2021-03-19 07:27:48","2021-03-19 07:27:48");
INSERT INTO payments VALUES("24","spr-20210319-073249","31","","25","1","1","354000","0","Cash","","2021-03-19 07:32:49","2021-03-19 07:32:49");
INSERT INTO payments VALUES("25","spr-20210319-073317","31","","26","1","1","180000","0","Cash","","2021-03-19 07:33:17","2021-03-19 07:33:17");
INSERT INTO payments VALUES("26","spr-20210319-073425","31","","27","1","1","260000","0","Cash","","2021-03-19 07:34:25","2021-03-19 07:34:25");
INSERT INTO payments VALUES("27","spr-20210319-073609","31","","28","1","1","220000","0","Cash","","2021-03-19 07:36:09","2021-03-19 07:36:09");
INSERT INTO payments VALUES("28","spr-20210319-073828","31","","29","1","1","170000","0","Cash","","2021-03-19 07:38:28","2021-03-19 07:38:28");
INSERT INTO payments VALUES("29","spr-20210319-094313","31","","30","1","1","340000","0","Cash","","2021-03-19 09:43:13","2021-03-19 09:43:13");
INSERT INTO payments VALUES("30","spr-20210319-094522","31","","31","1","1","280000","0","Cash","","2021-03-19 09:45:22","2021-03-19 09:45:22");
INSERT INTO payments VALUES("31","spr-20210319-094651","31","","32","1","1","230000","0","Cash","","2021-03-19 09:46:51","2021-03-19 09:46:51");
INSERT INTO payments VALUES("32","spr-20210319-094829","31","","33","1","1","240000","0","Cash","","2021-03-19 09:48:29","2021-03-19 09:48:29");
INSERT INTO payments VALUES("33","spr-20210319-095123","31","","34","1","1","590000","0","Cash","","2021-03-19 09:51:23","2021-03-19 09:51:23");
INSERT INTO payments VALUES("34","spr-20210319-095223","31","","35","1","1","320000","0","Cash","","2021-03-19 09:52:23","2021-03-19 09:52:23");
INSERT INTO payments VALUES("35","spr-20210319-095521","31","","36","1","1","354000","0","Cash","","2021-03-19 09:55:21","2021-03-19 09:55:21");
INSERT INTO payments VALUES("36","spr-20210319-095611","31","","37","1","1","180000","0","Cash","","2021-03-19 09:56:11","2021-03-19 09:56:11");
INSERT INTO payments VALUES("37","spr-20210319-120241","31","","38","1","1","230000","0","Cash","","2021-03-19 12:02:41","2021-03-19 12:02:41");
INSERT INTO payments VALUES("38","spr-20210319-120425","31","","39","1","1","260000","0","Cash","","2021-03-19 12:04:25","2021-03-19 12:04:25");
INSERT INTO payments VALUES("39","spr-20210319-120521","31","","40","1","1","350000","0","Cash","","2021-03-19 12:05:21","2021-03-19 12:05:21");
INSERT INTO payments VALUES("40","spr-20210319-120652","31","","41","1","1","230000","0","Cash","","2021-03-19 12:06:52","2021-03-19 12:06:52");
INSERT INTO payments VALUES("41","spr-20210319-120912","31","","42","1","1","354000","0","Cash","","2021-03-19 12:09:12","2021-03-19 12:09:12");
INSERT INTO payments VALUES("42","spr-20210319-120959","31","","43","1","1","320000","0","Cash","","2021-03-19 12:09:59","2021-03-19 12:09:59");
INSERT INTO payments VALUES("43","spr-20210319-121158","31","","44","1","1","1000000","0","Cash","","2021-03-19 12:11:58","2021-03-19 12:11:58");
INSERT INTO payments VALUES("44","spr-20210319-121227","31","","45","1","1","170000","0","Cash","","2021-03-19 12:12:27","2021-03-19 12:12:27");
INSERT INTO payments VALUES("45","spr-20210319-121428","31","","46","1","1","680000","0","Cash","","2021-03-19 12:14:28","2021-03-19 12:14:28");
INSERT INTO payments VALUES("46","spr-20210319-121609","31","","47","1","1","280000","0","Cash","","2021-03-19 12:16:09","2021-03-19 12:16:09");
INSERT INTO payments VALUES("47","spr-20210319-121804","31","","48","1","1","290000","0","Cash","","2021-03-19 12:18:04","2021-03-19 12:18:04");
INSERT INTO payments VALUES("48","spr-20210319-122221","31","","49","1","1","180000","0","Cash","","2021-03-19 12:22:21","2021-03-19 12:22:21");
INSERT INTO payments VALUES("49","spr-20210319-122345","31","","50","1","1","240000","0","Cash","","2021-03-19 12:23:45","2021-03-19 12:23:45");
INSERT INTO payments VALUES("50","spr-20210319-124219","31","","51","1","1","1210000","0","Cash","","2021-03-19 12:42:19","2021-03-19 12:42:19");
INSERT INTO payments VALUES("51","spr-20210319-125130","31","","52","1","1","310000","0","Cash","","2021-03-19 12:51:30","2021-03-19 12:51:30");
INSERT INTO payments VALUES("52","spr-20210320-025747","31","","53","1","1","200000","0","Cash","","2021-03-20 02:57:47","2021-03-20 02:57:47");
INSERT INTO payments VALUES("53","spr-20210320-032018","31","","54","1","1","450000","0","Cash","","2021-03-20 03:20:18","2021-03-20 03:20:18");
INSERT INTO payments VALUES("54","spr-20210320-051416","31","","55","1","1","420000","0","Cash","","2021-03-20 05:14:16","2021-03-20 05:14:16");
INSERT INTO payments VALUES("55","spr-20210320-062822","31","","56","1","1","240000","0","Cash","","2021-03-20 06:28:22","2021-03-20 06:28:22");
INSERT INTO payments VALUES("56","spr-20210321-071204","31","","57","1","1","220000","0","Cash","","2021-03-21 07:12:04","2021-03-21 07:12:04");
INSERT INTO payments VALUES("57","spr-20210321-071540","31","","58","1","1","350000","0","Cash","","2021-03-21 07:15:40","2021-03-21 07:15:40");
INSERT INTO payments VALUES("58","spr-20210321-071634","31","","59","1","1","220000","0","Cash","","2021-03-21 07:16:34","2021-03-21 07:16:34");
INSERT INTO payments VALUES("59","spr-20210321-071724","31","","60","1","1","690000","0","Cash","","2021-03-21 07:17:24","2021-03-21 07:17:24");
INSERT INTO payments VALUES("60","spr-20210321-072125","31","","61","1","1","270000","0","Cash","","2021-03-21 07:21:25","2021-03-21 07:21:25");
INSERT INTO payments VALUES("61","spr-20210321-072523","31","","62","1","1","150000","0","Cash","","2021-03-21 07:25:23","2021-03-21 07:25:23");
INSERT INTO payments VALUES("62","spr-20210321-074949","31","","63","1","1","370000","0","Cash","","2021-03-21 07:49:49","2021-03-21 07:49:49");
INSERT INTO payments VALUES("63","spr-20210321-075347","31","","64","1","1","480000","0","Cash","","2021-03-21 07:53:47","2021-03-21 07:53:47");
INSERT INTO payments VALUES("64","spr-20210321-075536","31","","65","1","1","360000","0","Cash","","2021-03-21 07:55:36","2021-03-21 07:55:36");
INSERT INTO payments VALUES("65","spr-20210321-075923","31","","66","1","1","740000","0","Cash","","2021-03-21 07:59:23","2021-03-21 07:59:23");
INSERT INTO payments VALUES("66","spr-20210321-081137","31","","67","1","1","450000","0","Cash","","2021-03-21 08:11:37","2021-03-21 08:11:37");
INSERT INTO payments VALUES("67","spr-20210321-085422","31","","68","1","1","180000","0","Cash","","2021-03-21 08:54:22","2021-03-21 08:54:22");
INSERT INTO payments VALUES("68","spr-20210321-085648","31","","69","1","1","400000","0","Cash","","2021-03-21 08:56:48","2021-03-21 08:56:48");
INSERT INTO payments VALUES("69","spr-20210321-090208","31","","70","1","1","1690000","0","Cash","","2021-03-21 09:02:08","2021-03-21 09:02:08");
INSERT INTO payments VALUES("70","spr-20210321-090607","31","","71","1","1","1920000","0","Cash","","2021-03-21 09:06:07","2021-03-21 09:06:07");
INSERT INTO payments VALUES("71","spr-20210321-090657","31","","72","1","1","190000","0","Cash","","2021-03-21 09:06:57","2021-03-21 09:06:57");
INSERT INTO payments VALUES("72","spr-20210321-091256","31","","73","1","1","790000","0","Cash","","2021-03-21 09:12:56","2021-03-21 09:12:56");
INSERT INTO payments VALUES("73","spr-20210321-092013","31","","74","1","1","1050000","0","Cash","","2021-03-21 09:20:13","2021-03-21 09:20:13");
INSERT INTO payments VALUES("74","spr-20210321-092754","31","","75","1","1","760000","0","Cash","","2021-03-21 09:27:54","2021-03-21 09:27:54");
INSERT INTO payments VALUES("75","spr-20210321-092948","31","","76","1","1","960000","0","Cash","","2021-03-21 09:29:48","2021-03-21 09:29:48");
INSERT INTO payments VALUES("76","spr-20210321-093323","31","","77","1","1","1080000","0","Cash","","2021-03-21 09:33:23","2021-03-21 09:33:23");
INSERT INTO payments VALUES("77","spr-20210321-093605","31","","78","1","1","900000","0","Cash","","2021-03-21 09:36:05","2021-03-21 09:36:05");
INSERT INTO payments VALUES("78","spr-20210321-093825","31","","79","1","1","805000","0","Cash","","2021-03-21 09:38:25","2021-03-21 09:38:25");
INSERT INTO payments VALUES("79","spr-20210321-094233","31","","80","1","1","1515000","0","Cash","","2021-03-21 09:42:33","2021-03-21 09:42:33");
INSERT INTO payments VALUES("80","spr-20210321-094448","31","","81","1","1","650000","0","Cash","","2021-03-21 09:44:48","2021-03-21 09:44:48");
INSERT INTO payments VALUES("81","spr-20210321-094538","31","","82","1","1","370000","0","Cash","","2021-03-21 09:45:38","2021-03-21 09:45:38");
INSERT INTO payments VALUES("82","spr-20210321-095140","31","","84","1","1","440000","0","Cash","","2021-03-21 09:51:40","2021-03-21 09:51:40");
INSERT INTO payments VALUES("83","spr-20210322-045442","31","","87","1","1","740000","0","Cash","","2021-03-22 04:54:42","2021-03-22 04:54:42");
INSERT INTO payments VALUES("84","spr-20210322-045526","31","","83","1","1","1270000","0","Cash","","2021-03-22 04:55:26","2021-03-22 04:55:26");
INSERT INTO payments VALUES("85","spr-20210322-045533","31","","85","1","1","780000","0","Cash","","2021-03-22 04:55:33","2021-03-22 04:55:33");
INSERT INTO payments VALUES("86","spr-20210322-045542","31","","86","1","1","1020000","0","Cash","","2021-03-22 04:55:42","2021-03-22 04:55:42");
INSERT INTO payments VALUES("87","spr-20210322-045655","31","","88","1","1","460000","0","Cash","","2021-03-22 04:56:55","2021-03-22 04:56:55");
INSERT INTO payments VALUES("88","spr-20210322-050152","31","","89","1","1","640000","0","Cash","","2021-03-22 05:01:52","2021-03-22 05:01:52");
INSERT INTO payments VALUES("89","spr-20210322-050625","31","","90","1","1","1510000","0","Cash","","2021-03-22 05:06:25","2021-03-22 05:06:25");
INSERT INTO payments VALUES("90","spr-20210323-074013","31","","91","1","1","260000","0","Cash","","2021-03-23 07:40:13","2021-03-23 07:40:13");
INSERT INTO payments VALUES("91","spr-20210324-015137","31","","92","1","1","620000","0","Cash","","2021-03-24 01:51:37","2021-03-24 01:51:37");
INSERT INTO payments VALUES("92","spr-20210324-121010","31","","93","1","1","500000","0","Cash","","2021-03-24 12:10:10","2021-03-24 12:10:10");
INSERT INTO payments VALUES("93","spr-20210324-124401","31","","95","1","1","220000","0","Cash","","2021-03-24 12:44:01","2021-03-24 12:44:01");
INSERT INTO payments VALUES("94","spr-20210325-081350","31","","94","1","1","170000","0","Cash","","2021-03-25 08:13:50","2021-03-25 08:13:50");
INSERT INTO payments VALUES("95","spr-20210325-081431","31","","96","1","1","260000","0","Cash","","2021-03-25 08:14:31","2021-03-25 08:14:31");
INSERT INTO payments VALUES("96","spr-20210325-121440","31","","98","1","1","190000","0","Cash","","2021-03-25 12:14:40","2021-03-25 12:14:40");
INSERT INTO payments VALUES("97","spr-20210325-121720","31","","99","1","1","260000","0","Cash","","2021-03-25 12:17:20","2021-03-25 12:17:20");
INSERT INTO payments VALUES("98","spr-20210325-121744","31","","100","1","1","220000","0","Cash","","2021-03-25 12:17:44","2021-03-25 12:17:44");
INSERT INTO payments VALUES("99","spr-20210326-050222","31","","101","1","1","460000","0","Cash","","2021-03-26 05:02:22","2021-03-26 05:02:22");
INSERT INTO payments VALUES("100","ppr-20210326-061513","31","21","","","1","3456000","0","Cash","","2021-03-26 06:15:13","2021-03-26 06:15:13");
INSERT INTO payments VALUES("101","ppr-20210326-061520","31","20","","","1","4256000","0","Cash","","2021-03-26 06:15:20","2021-03-26 06:15:20");
INSERT INTO payments VALUES("102","ppr-20210326-061530","31","14","","","1","3990000","0","Cash","","2021-03-26 06:15:30","2021-03-26 06:15:30");
INSERT INTO payments VALUES("103","ppr-20210326-061536","31","15","","","1","12430000","0","Cash","","2021-03-26 06:15:36","2021-03-26 06:15:36");
INSERT INTO payments VALUES("104","ppr-20210326-061548","31","16","","","1","16800000","0","Cash","","2021-03-26 06:15:48","2021-03-26 06:15:48");
INSERT INTO payments VALUES("105","ppr-20210326-061601","31","17","","","1","7205000","0","Cash","","2021-03-26 06:16:01","2021-03-26 06:16:01");
INSERT INTO payments VALUES("106","ppr-20210326-061614","31","18","","","1","30180000","0","Cash","","2021-03-26 06:16:14","2021-03-26 06:16:14");
INSERT INTO payments VALUES("107","ppr-20210326-061626","31","19","","","1","8298000","0","Cash","","2021-03-26 06:16:26","2021-03-26 06:16:26");
INSERT INTO payments VALUES("108","ppr-20210326-061841","31","22","","","1","21816000","0","Cash","","2021-03-26 06:18:41","2021-03-26 06:18:41");
INSERT INTO payments VALUES("109","ppr-20210326-062034","31","23","","","1","19200000","0","Cash","","2021-03-26 06:20:34","2021-03-26 06:20:34");
INSERT INTO payments VALUES("110","ppr-20210326-062730","31","24","","","1","7000000","0","Cash","","2021-03-26 06:27:30","2021-03-26 06:27:30");
INSERT INTO payments VALUES("111","ppr-20210326-125308","31","25","","","1","56484000","0","Cheque","Cicilan tempo","2021-03-26 12:53:08","2021-03-26 12:53:08");
INSERT INTO payments VALUES("112","ppr-20210326-010337","31","26","","","1","2539000","0","Cash","","2021-03-26 13:03:37","2021-03-26 13:03:37");
INSERT INTO payments VALUES("113","ppr-20210405-032815","31","27","","","1","6400000","0","Cash","","2021-04-05 03:28:15","2021-04-05 03:28:15");
INSERT INTO payments VALUES("114","ppr-20210405-034338","31","28","","","1","14160000","0","Cash","","2021-04-05 03:43:38","2021-04-05 03:43:38");
INSERT INTO payments VALUES("115","ppr-20210405-035257","31","29","","","1","25200000","0","Cash","","2021-04-05 03:52:57","2021-04-05 03:52:57");
INSERT INTO payments VALUES("116","ppr-20210405-073853","31","30","","","1","17586000","0","Cash","","2021-04-05 07:38:53","2021-04-05 07:38:53");
INSERT INTO payments VALUES("117","ppr-20210411-042313","31","31","","","1","12480000","0","Cash","","2021-04-11 04:23:13","2021-04-11 04:23:13");
INSERT INTO payments VALUES("118","ppr-20210411-044601","31","32","","","1","9420000","0","Cash","","2021-04-11 04:46:01","2021-04-11 04:46:01");
INSERT INTO payments VALUES("119","ppr-20210416-082333","31","35","","","1","16368000","0","Cash","","2021-04-16 08:23:33","2021-04-16 08:23:33");
INSERT INTO payments VALUES("120","ppr-20210416-083620","31","36","","","1","12528000","0","Cash","","2021-04-16 08:36:20","2021-04-16 08:36:20");
INSERT INTO payments VALUES("121","ppr-20210416-122409","31","38","","","1","10572000","0","Cash","","2021-04-16 12:24:09","2021-04-16 12:24:09");
INSERT INTO payments VALUES("122","ppr-20210416-123204","31","39","","","1","17068000","0","Cash","","2021-04-16 12:32:04","2021-04-16 12:32:04");
INSERT INTO payments VALUES("123","ppr-20210417-062730","31","40","","","1","35610000","0","Cash","","2021-04-17 06:27:30","2021-04-17 06:27:30");
INSERT INTO payments VALUES("124","ppr-20210417-063040","31","41","","","1","7200000","0","Cash","","2021-04-17 06:30:40","2021-04-17 06:30:40");
INSERT INTO payments VALUES("125","ppr-20210417-065756","31","42","","","1","4920000","0","Cash","","2021-04-17 06:57:56","2021-04-17 06:57:56");
INSERT INTO payments VALUES("126","ppr-20210417-071555","31","43","","","1","22800000","0","Cash","","2021-04-17 07:15:55","2021-04-17 07:15:55");
INSERT INTO payments VALUES("127","ppr-20210418-075835","31","44","","","1","8508000","0","Cash","","2021-04-18 07:58:35","2021-04-18 07:58:35");
INSERT INTO payments VALUES("128","spr-20210418-081319","31","","102","1","1","1240000","0","Cash","","2021-04-18 08:13:19","2021-04-18 08:13:19");
INSERT INTO payments VALUES("129","ppr-20210418-082048","31","45","","","1","6801000","0","Cash","","2021-04-18 08:20:48","2021-04-18 08:20:48");
INSERT INTO payments VALUES("130","ppr-20210418-082300","31","46","","","1","13292000","0","Cash","","2021-04-18 08:23:00","2021-04-18 08:23:00");
INSERT INTO payments VALUES("131","ppr-20210418-084318","31","47","","","1","21504000","0","Cash","","2021-04-18 08:43:18","2021-04-18 08:43:18");
INSERT INTO payments VALUES("132","ppr-20210419-064947","31","48","","","1","12000000","0","Cash","","2021-04-19 06:49:47","2021-04-19 06:49:47");



CREATE TABLE `payrolls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `employee_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` double NOT NULL,
  `paying_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO payrolls VALUES("1","payroll-20210306-093903","1","1","1","1000000","0","","2021-03-06 09:39:03","2021-03-06 09:39:03");



CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO permissions VALUES("4","products-edit","web","2018-06-03 01:00:09","2018-06-03 01:00:09");
INSERT INTO permissions VALUES("5","products-delete","web","2018-06-03 22:54:22","2018-06-03 22:54:22");
INSERT INTO permissions VALUES("6","products-add","web","2018-06-04 00:34:14","2018-06-04 00:34:14");
INSERT INTO permissions VALUES("7","products-index","web","2018-06-04 03:34:27","2018-06-04 03:34:27");
INSERT INTO permissions VALUES("8","purchases-index","web","2018-06-04 08:03:19","2018-06-04 08:03:19");
INSERT INTO permissions VALUES("9","purchases-add","web","2018-06-04 08:12:25","2018-06-04 08:12:25");
INSERT INTO permissions VALUES("10","purchases-edit","web","2018-06-04 09:47:36","2018-06-04 09:47:36");
INSERT INTO permissions VALUES("11","purchases-delete","web","2018-06-04 09:47:36","2018-06-04 09:47:36");
INSERT INTO permissions VALUES("12","sales-index","web","2018-06-04 10:49:08","2018-06-04 10:49:08");
INSERT INTO permissions VALUES("13","sales-add","web","2018-06-04 10:49:52","2018-06-04 10:49:52");
INSERT INTO permissions VALUES("14","sales-edit","web","2018-06-04 10:49:52","2018-06-04 10:49:52");
INSERT INTO permissions VALUES("15","sales-delete","web","2018-06-04 10:49:53","2018-06-04 10:49:53");
INSERT INTO permissions VALUES("16","quotes-index","web","2018-06-04 22:05:10","2018-06-04 22:05:10");
INSERT INTO permissions VALUES("17","quotes-add","web","2018-06-04 22:05:10","2018-06-04 22:05:10");
INSERT INTO permissions VALUES("18","quotes-edit","web","2018-06-04 22:05:10","2018-06-04 22:05:10");
INSERT INTO permissions VALUES("19","quotes-delete","web","2018-06-04 22:05:10","2018-06-04 22:05:10");
INSERT INTO permissions VALUES("20","transfers-index","web","2018-06-04 22:30:03","2018-06-04 22:30:03");
INSERT INTO permissions VALUES("21","transfers-add","web","2018-06-04 22:30:03","2018-06-04 22:30:03");
INSERT INTO permissions VALUES("22","transfers-edit","web","2018-06-04 22:30:03","2018-06-04 22:30:03");
INSERT INTO permissions VALUES("23","transfers-delete","web","2018-06-04 22:30:03","2018-06-04 22:30:03");
INSERT INTO permissions VALUES("24","returns-index","web","2018-06-04 22:50:24","2018-06-04 22:50:24");
INSERT INTO permissions VALUES("25","returns-add","web","2018-06-04 22:50:24","2018-06-04 22:50:24");
INSERT INTO permissions VALUES("26","returns-edit","web","2018-06-04 22:50:25","2018-06-04 22:50:25");
INSERT INTO permissions VALUES("27","returns-delete","web","2018-06-04 22:50:25","2018-06-04 22:50:25");
INSERT INTO permissions VALUES("28","customers-index","web","2018-06-04 23:15:54","2018-06-04 23:15:54");
INSERT INTO permissions VALUES("29","customers-add","web","2018-06-04 23:15:55","2018-06-04 23:15:55");
INSERT INTO permissions VALUES("30","customers-edit","web","2018-06-04 23:15:55","2018-06-04 23:15:55");
INSERT INTO permissions VALUES("31","customers-delete","web","2018-06-04 23:15:55","2018-06-04 23:15:55");
INSERT INTO permissions VALUES("32","suppliers-index","web","2018-06-04 23:40:12","2018-06-04 23:40:12");
INSERT INTO permissions VALUES("33","suppliers-add","web","2018-06-04 23:40:12","2018-06-04 23:40:12");
INSERT INTO permissions VALUES("34","suppliers-edit","web","2018-06-04 23:40:12","2018-06-04 23:40:12");
INSERT INTO permissions VALUES("35","suppliers-delete","web","2018-06-04 23:40:12","2018-06-04 23:40:12");
INSERT INTO permissions VALUES("36","product-report","web","2018-06-24 23:05:33","2018-06-24 23:05:33");
INSERT INTO permissions VALUES("37","purchase-report","web","2018-06-24 23:24:56","2018-06-24 23:24:56");
INSERT INTO permissions VALUES("38","sale-report","web","2018-06-24 23:33:13","2018-06-24 23:33:13");
INSERT INTO permissions VALUES("39","customer-report","web","2018-06-24 23:36:51","2018-06-24 23:36:51");
INSERT INTO permissions VALUES("40","due-report","web","2018-06-24 23:39:52","2018-06-24 23:39:52");
INSERT INTO permissions VALUES("41","users-index","web","2018-06-25 00:00:10","2018-06-25 00:00:10");
INSERT INTO permissions VALUES("42","users-add","web","2018-06-25 00:00:10","2018-06-25 00:00:10");
INSERT INTO permissions VALUES("43","users-edit","web","2018-06-25 00:01:30","2018-06-25 00:01:30");
INSERT INTO permissions VALUES("44","users-delete","web","2018-06-25 00:01:30","2018-06-25 00:01:30");
INSERT INTO permissions VALUES("45","profit-loss","web","2018-07-14 21:50:05","2018-07-14 21:50:05");
INSERT INTO permissions VALUES("46","best-seller","web","2018-07-14 22:01:38","2018-07-14 22:01:38");
INSERT INTO permissions VALUES("47","daily-sale","web","2018-07-14 22:24:21","2018-07-14 22:24:21");
INSERT INTO permissions VALUES("48","monthly-sale","web","2018-07-14 22:30:41","2018-07-14 22:30:41");
INSERT INTO permissions VALUES("49","daily-purchase","web","2018-07-14 22:36:46","2018-07-14 22:36:46");
INSERT INTO permissions VALUES("50","monthly-purchase","web","2018-07-14 22:48:17","2018-07-14 22:48:17");
INSERT INTO permissions VALUES("51","payment-report","web","2018-07-14 23:10:41","2018-07-14 23:10:41");
INSERT INTO permissions VALUES("52","warehouse-stock-report","web","2018-07-14 23:16:55","2018-07-14 23:16:55");
INSERT INTO permissions VALUES("53","product-qty-alert","web","2018-07-14 23:33:21","2018-07-14 23:33:21");
INSERT INTO permissions VALUES("54","supplier-report","web","2018-07-30 03:00:01","2018-07-30 03:00:01");
INSERT INTO permissions VALUES("55","expenses-index","web","2018-09-05 01:07:10","2018-09-05 01:07:10");
INSERT INTO permissions VALUES("56","expenses-add","web","2018-09-05 01:07:10","2018-09-05 01:07:10");
INSERT INTO permissions VALUES("57","expenses-edit","web","2018-09-05 01:07:10","2018-09-05 01:07:10");
INSERT INTO permissions VALUES("58","expenses-delete","web","2018-09-05 01:07:11","2018-09-05 01:07:11");
INSERT INTO permissions VALUES("59","general_setting","web","2018-10-19 23:10:04","2018-10-19 23:10:04");
INSERT INTO permissions VALUES("60","mail_setting","web","2018-10-19 23:10:04","2018-10-19 23:10:04");
INSERT INTO permissions VALUES("61","pos_setting","web","2018-10-19 23:10:04","2018-10-19 23:10:04");
INSERT INTO permissions VALUES("62","hrm_setting","web","2019-01-02 10:30:23","2019-01-02 10:30:23");
INSERT INTO permissions VALUES("63","purchase-return-index","web","2019-01-02 21:45:14","2019-01-02 21:45:14");
INSERT INTO permissions VALUES("64","purchase-return-add","web","2019-01-02 21:45:14","2019-01-02 21:45:14");
INSERT INTO permissions VALUES("65","purchase-return-edit","web","2019-01-02 21:45:14","2019-01-02 21:45:14");
INSERT INTO permissions VALUES("66","purchase-return-delete","web","2019-01-02 21:45:14","2019-01-02 21:45:14");
INSERT INTO permissions VALUES("67","account-index","web","2019-01-02 22:06:13","2019-01-02 22:06:13");
INSERT INTO permissions VALUES("68","balance-sheet","web","2019-01-02 22:06:14","2019-01-02 22:06:14");
INSERT INTO permissions VALUES("69","account-statement","web","2019-01-02 22:06:14","2019-01-02 22:06:14");
INSERT INTO permissions VALUES("70","department","web","2019-01-02 22:30:01","2019-01-02 22:30:01");
INSERT INTO permissions VALUES("71","attendance","web","2019-01-02 22:30:01","2019-01-02 22:30:01");
INSERT INTO permissions VALUES("72","payroll","web","2019-01-02 22:30:01","2019-01-02 22:30:01");
INSERT INTO permissions VALUES("73","employees-index","web","2019-01-02 22:52:19","2019-01-02 22:52:19");
INSERT INTO permissions VALUES("74","employees-add","web","2019-01-02 22:52:19","2019-01-02 22:52:19");
INSERT INTO permissions VALUES("75","employees-edit","web","2019-01-02 22:52:19","2019-01-02 22:52:19");
INSERT INTO permissions VALUES("76","employees-delete","web","2019-01-02 22:52:19","2019-01-02 22:52:19");
INSERT INTO permissions VALUES("77","user-report","web","2019-01-16 06:48:18","2019-01-16 06:48:18");
INSERT INTO permissions VALUES("78","stock_count","web","2019-02-17 10:32:01","2019-02-17 10:32:01");
INSERT INTO permissions VALUES("79","adjustment","web","2019-02-17 10:32:02","2019-02-17 10:32:02");
INSERT INTO permissions VALUES("80","sms_setting","web","2019-02-22 05:18:03","2019-02-22 05:18:03");
INSERT INTO permissions VALUES("81","create_sms","web","2019-02-22 05:18:03","2019-02-22 05:18:03");
INSERT INTO permissions VALUES("82","print_barcode","web","2019-03-07 05:02:19","2019-03-07 05:02:19");
INSERT INTO permissions VALUES("83","empty_database","web","2019-03-07 05:02:19","2019-03-07 05:02:19");
INSERT INTO permissions VALUES("84","customer_group","web","2019-03-07 05:37:15","2019-03-07 05:37:15");
INSERT INTO permissions VALUES("85","unit","web","2019-03-07 05:37:15","2019-03-07 05:37:15");
INSERT INTO permissions VALUES("86","tax","web","2019-03-07 05:37:15","2019-03-07 05:37:15");
INSERT INTO permissions VALUES("87","gift_card","web","2019-03-07 06:29:38","2019-03-07 06:29:38");
INSERT INTO permissions VALUES("88","coupon","web","2019-03-07 06:29:38","2019-03-07 06:29:38");
INSERT INTO permissions VALUES("89","holiday","web","2019-10-19 08:57:15","2019-10-19 08:57:15");
INSERT INTO permissions VALUES("90","warehouse-report","web","2019-10-22 06:00:23","2019-10-22 06:00:23");
INSERT INTO permissions VALUES("91","warehouse","web","2020-02-26 06:47:32","2020-02-26 06:47:32");
INSERT INTO permissions VALUES("92","brand","web","2020-02-26 06:59:59","2020-02-26 06:59:59");
INSERT INTO permissions VALUES("93","billers-index","web","2020-02-26 07:11:15","2020-02-26 07:11:15");
INSERT INTO permissions VALUES("94","billers-add","web","2020-02-26 07:11:15","2020-02-26 07:11:15");
INSERT INTO permissions VALUES("95","billers-edit","web","2020-02-26 07:11:15","2020-02-26 07:11:15");
INSERT INTO permissions VALUES("96","billers-delete","web","2020-02-26 07:11:15","2020-02-26 07:11:15");
INSERT INTO permissions VALUES("97","money-transfer","web","2020-03-02 05:41:48","2020-03-02 05:41:48");
INSERT INTO permissions VALUES("98","category","web","2020-07-13 12:13:16","2020-07-13 12:13:16");
INSERT INTO permissions VALUES("99","delivery","web","2020-07-13 12:13:16","2020-07-13 12:13:16");
INSERT INTO permissions VALUES("100","send_notification","web","2020-10-31 06:21:31","2020-10-31 06:21:31");
INSERT INTO permissions VALUES("101","today_sale","web","2020-10-31 06:57:04","2020-10-31 06:57:04");
INSERT INTO permissions VALUES("102","today_profit","web","2020-10-31 06:57:04","2020-10-31 06:57:04");
INSERT INTO permissions VALUES("103","currency","web","2020-11-09 00:23:11","2020-11-09 00:23:11");
INSERT INTO permissions VALUES("104","backup_database","web","2020-11-15 00:16:55","2020-11-15 00:16:55");



CREATE TABLE `pos_setting` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `biller_id` int(11) NOT NULL,
  `product_number` int(11) NOT NULL,
  `keybord_active` tinyint(1) NOT NULL,
  `stripe_public_key` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stripe_secret_key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  UNIQUE KEY `pos_setting_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO pos_setting VALUES("1","1","1","1","4","0","pk_test_ITN7KOYiIsHSCQ0UMRcgaYUB","sk_test_TtQQaawhEYRwa3mU9CzttrEy","2018-09-02 03:17:04","2021-03-01 07:45:17");



CREATE TABLE `product_adjustments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `adjustment_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `qty` double NOT NULL,
  `action` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `product_purchases` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `purchase_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `qty` double NOT NULL,
  `recieved` double NOT NULL,
  `purchase_unit_id` int(11) NOT NULL,
  `net_unit_cost` double NOT NULL,
  `discount` double NOT NULL,
  `tax_rate` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=468 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO product_purchases VALUES("147","13","71","","24","24","1","150000","0","0","0","3600000","2021-03-13 16:51:05","2021-03-13 16:51:05");
INSERT INTO product_purchases VALUES("148","13","70","","24","24","1","145000","0","0","0","3480000","2021-03-13 16:51:05","2021-03-13 16:51:05");
INSERT INTO product_purchases VALUES("149","13","69","","12","12","1","150000","0","0","0","1800000","2021-03-13 16:51:05","2021-03-13 16:51:05");
INSERT INTO product_purchases VALUES("150","13","68","","36","36","1","107500","0","0","0","3870000","2021-03-13 16:51:05","2021-03-13 16:51:05");
INSERT INTO product_purchases VALUES("151","13","67","","60","60","1","102500","0","0","0","6150000","2021-03-13 16:51:05","2021-03-13 16:51:05");
INSERT INTO product_purchases VALUES("152","12","65","","48","48","1","70000","0","0","0","3360000","2021-03-13 16:51:18","2021-03-13 16:51:18");
INSERT INTO product_purchases VALUES("153","12","66","","60","60","1","73000","0","0","0","4380000","2021-03-13 16:51:18","2021-03-13 16:51:18");
INSERT INTO product_purchases VALUES("154","12","64","","12","12","1","76000","0","0","0","912000","2021-03-13 16:51:18","2021-03-13 16:51:18");
INSERT INTO product_purchases VALUES("155","12","63","","12","12","1","72500","0","0","0","870000","2021-03-13 16:51:18","2021-03-13 16:51:18");
INSERT INTO product_purchases VALUES("156","12","62","","84","84","1","54000","0","0","0","4536000","2021-03-13 16:51:18","2021-03-13 16:51:18");
INSERT INTO product_purchases VALUES("157","12","61","","72","72","1","60000","0","0","0","4320000","2021-03-13 16:51:18","2021-03-13 16:51:18");
INSERT INTO product_purchases VALUES("158","12","59","","60","60","1","105000","0","0","0","6300000","2021-03-13 16:51:18","2021-03-13 16:51:18");
INSERT INTO product_purchases VALUES("159","12","60","","60","60","1","95000","0","0","0","5700000","2021-03-13 16:51:18","2021-03-13 16:51:18");
INSERT INTO product_purchases VALUES("160","12","58","","96","96","1","110000","0","0","0","10560000","2021-03-13 16:51:18","2021-03-13 16:51:18");
INSERT INTO product_purchases VALUES("161","11","57","","24","24","1","235000","0","0","0","5640000","2021-03-13 16:51:31","2021-03-13 16:51:31");
INSERT INTO product_purchases VALUES("162","11","56","","36","36","1","230000","0","0","0","8280000","2021-03-13 16:51:31","2021-03-13 16:51:31");
INSERT INTO product_purchases VALUES("163","11","55","","36","36","1","222500","0","0","0","8010000","2021-03-13 16:51:31","2021-03-13 16:51:31");
INSERT INTO product_purchases VALUES("164","11","54","","24","24","1","235000","0","0","0","5640000","2021-03-13 16:51:31","2021-03-13 16:51:31");
INSERT INTO product_purchases VALUES("165","11","53","","24","24","1","230000","0","0","0","5520000","2021-03-13 16:51:31","2021-03-13 16:51:31");
INSERT INTO product_purchases VALUES("166","11","52","","84","84","1","103000","0","0","0","8652000","2021-03-13 16:51:31","2021-03-13 16:51:31");
INSERT INTO product_purchases VALUES("167","11","51","","12","12","1","100000","0","0","0","1200000","2021-03-13 16:51:31","2021-03-13 16:51:31");
INSERT INTO product_purchases VALUES("168","11","50","","60","60","1","110000","0","0","0","6600000","2021-03-13 16:51:31","2021-03-13 16:51:31");
INSERT INTO product_purchases VALUES("169","11","49","","48","48","1","130000","0","0","0","6240000","2021-03-13 16:51:31","2021-03-13 16:51:31");
INSERT INTO product_purchases VALUES("170","11","48","","36","36","1","130000","0","0","0","4680000","2021-03-13 16:51:31","2021-03-13 16:51:31");
INSERT INTO product_purchases VALUES("171","10","41","","36","36","1","160000","0","0","0","5760000","2021-03-13 16:51:44","2021-03-13 16:51:44");
INSERT INTO product_purchases VALUES("172","10","33","","24","24","1","120000","0","0","0","2880000","2021-03-13 16:51:44","2021-03-13 16:51:44");
INSERT INTO product_purchases VALUES("173","10","40","","48","48","1","155000","0","0","0","7440000","2021-03-13 16:51:44","2021-03-13 16:51:44");
INSERT INTO product_purchases VALUES("174","10","47","","24","24","1","85000","0","0","0","2040000","2021-03-13 16:51:44","2021-03-13 16:51:44");
INSERT INTO product_purchases VALUES("175","10","46","","24","24","1","80000","0","0","0","1920000","2021-03-13 16:51:44","2021-03-13 16:51:44");
INSERT INTO product_purchases VALUES("176","10","45","","24","24","1","105000","0","0","0","2520000","2021-03-13 16:51:44","2021-03-13 16:51:44");
INSERT INTO product_purchases VALUES("177","10","44","","84","84","1","100000","0","0","0","8400000","2021-03-13 16:51:44","2021-03-13 16:51:44");
INSERT INTO product_purchases VALUES("178","10","43","","36","36","1","130000","0","0","0","4680000","2021-03-13 16:51:44","2021-03-13 16:51:44");
INSERT INTO product_purchases VALUES("179","10","42","","48","48","1","125000","0","0","0","6000000","2021-03-13 16:51:44","2021-03-13 16:51:44");
INSERT INTO product_purchases VALUES("180","10","32","","60","60","1","110000","0","0","0","6600000","2021-03-13 16:51:45","2021-03-13 16:51:45");
INSERT INTO product_purchases VALUES("181","10","31","","84","84","1","105000","0","0","0","8820000","2021-03-13 16:51:45","2021-03-13 16:51:45");
INSERT INTO product_purchases VALUES("182","9","39","","12","12","1","162500","0","0","0","1950000","2021-03-13 16:52:09","2021-03-13 16:52:09");
INSERT INTO product_purchases VALUES("183","9","38","","12","12","1","157500","0","0","0","1890000","2021-03-13 16:52:09","2021-03-13 16:52:09");
INSERT INTO product_purchases VALUES("184","9","36","","36","36","1","160000","0","0","0","5760000","2021-03-13 16:52:09","2021-03-13 16:52:09");
INSERT INTO product_purchases VALUES("185","9","37","","24","24","1","155000","0","0","0","3720000","2021-03-13 16:52:09","2021-03-13 16:52:09");
INSERT INTO product_purchases VALUES("186","9","35","","36","36","1","130000","0","0","0","4680000","2021-03-13 16:52:09","2021-03-13 16:52:09");
INSERT INTO product_purchases VALUES("187","9","34","","24","24","1","125000","0","0","0","3000000","2021-03-13 16:52:09","2021-03-13 16:52:09");
INSERT INTO product_purchases VALUES("188","8","28","","36","36","1","162500","0","0","0","5850000","2021-03-13 16:52:32","2021-03-13 16:52:32");
INSERT INTO product_purchases VALUES("189","8","27","","36","36","1","157500","0","0","0","5670000","2021-03-13 16:52:32","2021-03-13 16:52:32");
INSERT INTO product_purchases VALUES("190","8","30","","60","60","1","187000","0","0","0","11220000","2021-03-13 16:52:32","2021-03-13 16:52:32");
INSERT INTO product_purchases VALUES("191","8","29","","48","48","1","180000","0","0","0","8640000","2021-03-13 16:52:32","2021-03-13 16:52:32");
INSERT INTO product_purchases VALUES("207","6","5","14","12","12","1","235400","0","0","0","2824800","2021-03-13 16:52:58","2021-03-13 16:52:58");
INSERT INTO product_purchases VALUES("208","6","5","13","12","12","1","235400","0","0","0","2824800","2021-03-13 16:52:58","2021-03-13 16:52:58");
INSERT INTO product_purchases VALUES("209","6","6","14","12","12","1","235400","0","0","0","2824800","2021-03-13 16:52:58","2021-03-13 16:52:58");
INSERT INTO product_purchases VALUES("210","6","6","13","12","12","1","235400","0","0","0","2824800","2021-03-13 16:52:58","2021-03-13 16:52:58");
INSERT INTO product_purchases VALUES("211","6","7","14","12","12","1","213400","0","0","0","2560800","2021-03-13 16:52:58","2021-03-13 16:52:58");
INSERT INTO product_purchases VALUES("212","6","7","13","12","12","1","213400","0","0","0","2560800","2021-03-13 16:52:58","2021-03-13 16:52:58");
INSERT INTO product_purchases VALUES("213","6","8","13","12","12","1","213400","0","0","0","2560800","2021-03-13 16:52:58","2021-03-13 16:52:58");
INSERT INTO product_purchases VALUES("214","6","8","14","12","12","1","213400","0","0","0","2560800","2021-03-13 16:52:58","2021-03-13 16:52:58");
INSERT INTO product_purchases VALUES("215","6","9","15","3","3","1","224400","0","0","0","673200","2021-03-13 16:52:58","2021-03-13 16:52:58");
INSERT INTO product_purchases VALUES("216","6","9","16","2","2","1","224400","0","0","0","448800","2021-03-13 16:52:58","2021-03-13 16:52:58");
INSERT INTO product_purchases VALUES("217","6","9","17","1","1","1","224400","0","0","0","224400","2021-03-13 16:52:58","2021-03-13 16:52:58");
INSERT INTO product_purchases VALUES("218","6","10","14","12","12","1","235400","0","0","0","2824800","2021-03-13 16:52:58","2021-03-13 16:52:58");
INSERT INTO product_purchases VALUES("219","6","10","13","12","12","1","235400","0","0","0","2824800","2021-03-13 16:52:58","2021-03-13 16:52:58");
INSERT INTO product_purchases VALUES("220","6","11","14","12","12","1","235400","0","0","0","2824800","2021-03-13 16:52:58","2021-03-13 16:52:58");
INSERT INTO product_purchases VALUES("221","6","11","13","12","12","1","235400","0","0","0","2824800","2021-03-13 16:52:58","2021-03-13 16:52:58");
INSERT INTO product_purchases VALUES("222","5","4","14","12","12","1","235400","0","0","0","2824800","2021-03-13 16:53:10","2021-03-13 16:53:10");
INSERT INTO product_purchases VALUES("223","5","4","13","12","12","1","235400","0","0","0","2824800","2021-03-13 16:53:10","2021-03-13 16:53:10");
INSERT INTO product_purchases VALUES("224","4","3","12","12","12","1","224400","0","0","0","2692800","2021-03-13 16:53:21","2021-03-13 16:53:21");
INSERT INTO product_purchases VALUES("240","7","19","","24","24","1","117500","0","0","0","2820000","2021-03-13 17:02:36","2021-03-13 17:02:36");
INSERT INTO product_purchases VALUES("241","7","26","","24","24","1","130000","0","0","0","3120000","2021-03-13 17:02:36","2021-03-13 17:02:36");
INSERT INTO product_purchases VALUES("242","7","25","","36","36","1","130000","0","0","0","4680000","2021-03-13 17:02:36","2021-03-13 17:02:36");
INSERT INTO product_purchases VALUES("243","7","24","","12","12","1","155000","0","0","0","1860000","2021-03-13 17:02:36","2021-03-13 17:02:36");
INSERT INTO product_purchases VALUES("244","7","23","","12","12","1","135000","0","0","0","1620000","2021-03-13 17:02:36","2021-03-13 17:02:36");
INSERT INTO product_purchases VALUES("245","7","22","","48","48","1","132500","0","0","0","6360000","2021-03-13 17:02:36","2021-03-13 17:02:36");
INSERT INTO product_purchases VALUES("246","7","21","","24","24","1","170000","0","0","0","4080000","2021-03-13 17:02:36","2021-03-13 17:02:36");
INSERT INTO product_purchases VALUES("247","7","20","","24","24","1","122500","0","0","0","2940000","2021-03-13 17:02:36","2021-03-13 17:02:36");
INSERT INTO product_purchases VALUES("248","7","18","","24","24","1","125000","0","0","0","3000000","2021-03-13 17:02:36","2021-03-13 17:02:36");
INSERT INTO product_purchases VALUES("249","7","17","","12","12","1","205000","0","0","0","2460000","2021-03-13 17:02:36","2021-03-13 17:02:36");
INSERT INTO product_purchases VALUES("250","7","15","","6","6","1","200000","0","0","0","1200000","2021-03-13 17:02:36","2021-03-13 17:02:36");
INSERT INTO product_purchases VALUES("251","7","16","","12","12","1","205000","0","0","0","2460000","2021-03-13 17:02:36","2021-03-13 17:02:36");
INSERT INTO product_purchases VALUES("252","7","14","","6","6","1","200000","0","0","0","1200000","2021-03-13 17:02:36","2021-03-13 17:02:36");
INSERT INTO product_purchases VALUES("253","7","13","","12","12","1","210000","0","0","0","2520000","2021-03-13 17:02:36","2021-03-13 17:02:36");
INSERT INTO product_purchases VALUES("254","7","12","","12","12","1","205000","0","0","0","2460000","2021-03-13 17:02:36","2021-03-13 17:02:36");
INSERT INTO product_purchases VALUES("255","3","3","11","1","1","1","224400","0","0","0","224400","2021-03-13 17:05:07","2021-03-13 17:05:07");
INSERT INTO product_purchases VALUES("256","3","3","10","1","1","1","224400","0","0","0","224400","2021-03-13 17:05:07","2021-03-13 17:05:07");
INSERT INTO product_purchases VALUES("257","3","3","9","2","2","1","224400","0","0","0","448800","2021-03-13 17:05:07","2021-03-13 17:05:07");
INSERT INTO product_purchases VALUES("258","3","3","8","2","2","1","224400","0","0","0","448800","2021-03-13 17:05:07","2021-03-13 17:05:07");
INSERT INTO product_purchases VALUES("259","3","3","7","3","3","1","224400","0","0","0","673200","2021-03-13 17:05:07","2021-03-13 17:05:07");
INSERT INTO product_purchases VALUES("260","3","3","6","3","3","1","224400","0","0","0","673200","2021-03-13 17:05:07","2021-03-13 17:05:07");
INSERT INTO product_purchases VALUES("261","2","2","4","3","3","1","188100","0","0","0","564300","2021-03-13 17:05:23","2021-03-13 17:05:23");
INSERT INTO product_purchases VALUES("262","2","2","5","3","3","1","188100","0","0","0","564300","2021-03-13 17:05:23","2021-03-13 17:05:23");
INSERT INTO product_purchases VALUES("263","2","2","3","2","2","1","188100","0","0","0","376200","2021-03-13 17:05:23","2021-03-13 17:05:23");
INSERT INTO product_purchases VALUES("264","2","2","2","2","2","1","188100","0","0","0","376200","2021-03-13 17:05:23","2021-03-13 17:05:23");
INSERT INTO product_purchases VALUES("265","2","2","1","2","2","1","188100","0","0","0","376200","2021-03-13 17:05:23","2021-03-13 17:05:23");
INSERT INTO product_purchases VALUES("266","1","1","11","1","1","1","188100","0","0","0","188100","2021-03-13 17:05:35","2021-03-13 17:05:35");
INSERT INTO product_purchases VALUES("267","1","1","10","1","1","1","188100","0","0","0","188100","2021-03-13 17:05:35","2021-03-13 17:05:35");
INSERT INTO product_purchases VALUES("268","1","1","9","2","2","1","188100","0","0","0","376200","2021-03-13 17:05:35","2021-03-13 17:05:35");
INSERT INTO product_purchases VALUES("269","1","1","8","2","2","1","188100","0","0","0","376200","2021-03-13 17:05:35","2021-03-13 17:05:35");
INSERT INTO product_purchases VALUES("270","1","1","7","3","3","1","188100","0","0","0","564300","2021-03-13 17:05:35","2021-03-13 17:05:35");
INSERT INTO product_purchases VALUES("271","1","1","6","3","3","1","188100","0","0","0","564300","2021-03-13 17:05:35","2021-03-13 17:05:35");
INSERT INTO product_purchases VALUES("272","14","72","","12","12","1","56000","0","0","0","672000","2021-03-25 13:05:22","2021-03-25 13:05:22");
INSERT INTO product_purchases VALUES("273","14","78","","6","6","1","68000","0","0","0","408000","2021-03-25 13:05:22","2021-03-25 13:05:22");
INSERT INTO product_purchases VALUES("274","14","77","","12","12","1","63000","0","0","0","756000","2021-03-25 13:05:22","2021-03-25 13:05:22");
INSERT INTO product_purchases VALUES("275","14","76","","12","12","1","64000","0","0","0","768000","2021-03-25 13:05:22","2021-03-25 13:05:22");
INSERT INTO product_purchases VALUES("276","14","73","","6","6","1","51000","0","0","0","306000","2021-03-25 13:05:22","2021-03-25 13:05:22");
INSERT INTO product_purchases VALUES("277","14","75","","12","12","1","45000","0","0","0","540000","2021-03-25 13:05:22","2021-03-25 13:05:22");
INSERT INTO product_purchases VALUES("278","14","74","","12","12","1","45000","0","0","0","540000","2021-03-25 13:05:22","2021-03-25 13:05:22");
INSERT INTO product_purchases VALUES("279","15","109","","72","72","1","110000","0","0","0","7920000","2021-03-26 05:37:34","2021-03-26 05:37:34");
INSERT INTO product_purchases VALUES("280","15","110","","11","11","1","110000","0","0","0","1210000","2021-03-26 05:37:34","2021-03-26 05:37:34");
INSERT INTO product_purchases VALUES("281","15","95","","9","9","1","110000","0","0","0","990000","2021-03-26 05:37:34","2021-03-26 05:37:34");
INSERT INTO product_purchases VALUES("282","15","94","","21","21","1","110000","0","0","0","2310000","2021-03-26 05:37:34","2021-03-26 05:37:34");
INSERT INTO product_purchases VALUES("283","16","113","","12","12","1","100000","0","0","0","1200000","2021-03-26 05:44:42","2021-03-26 05:44:42");
INSERT INTO product_purchases VALUES("284","16","97","","54","54","1","100000","0","0","0","5400000","2021-03-26 05:44:42","2021-03-26 05:44:42");
INSERT INTO product_purchases VALUES("285","16","115","","12","12","1","100000","0","0","0","1200000","2021-03-26 05:44:42","2021-03-26 05:44:42");
INSERT INTO product_purchases VALUES("286","16","114","","6","6","1","100000","0","0","0","600000","2021-03-26 05:44:42","2021-03-26 05:44:42");
INSERT INTO product_purchases VALUES("287","16","112","","27","27","1","100000","0","0","0","2700000","2021-03-26 05:44:42","2021-03-26 05:44:42");
INSERT INTO product_purchases VALUES("288","16","111","","12","12","1","100000","0","0","0","1200000","2021-03-26 05:44:42","2021-03-26 05:44:42");
INSERT INTO product_purchases VALUES("289","16","96","","45","45","1","100000","0","0","0","4500000","2021-03-26 05:44:42","2021-03-26 05:44:42");
INSERT INTO product_purchases VALUES("290","17","102","","22","22","1","95000","0","0","0","2090000","2021-03-26 05:48:12","2021-03-26 05:48:12");
INSERT INTO product_purchases VALUES("291","17","101","","6","6","1","65000","0","0","0","390000","2021-03-26 05:48:12","2021-03-26 05:48:12");
INSERT INTO product_purchases VALUES("292","17","100","","9","9","1","60000","0","0","0","540000","2021-03-26 05:48:12","2021-03-26 05:48:12");
INSERT INTO product_purchases VALUES("293","17","99","","54","54","1","60000","0","0","0","3240000","2021-03-26 05:48:12","2021-03-26 05:48:12");
INSERT INTO product_purchases VALUES("294","17","98","","9","9","1","105000","0","0","0","945000","2021-03-26 05:48:12","2021-03-26 05:48:12");
INSERT INTO product_purchases VALUES("295","18","108","22","12","12","1","220000","0","0","0","2640000","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_purchases VALUES("296","18","108","24","12","12","1","220000","0","0","0","2640000","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_purchases VALUES("297","18","108","23","12","12","1","220000","0","0","0","2640000","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_purchases VALUES("298","18","108","20","12","12","1","220000","0","0","0","2640000","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_purchases VALUES("299","18","107","","18","18","1","140000","0","0","0","2520000","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_purchases VALUES("300","18","104","","36","36","1","125000","0","0","0","4500000","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_purchases VALUES("301","18","106","18","12","12","1","150000","0","0","0","1800000","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_purchases VALUES("302","18","106","21","12","12","1","150000","0","0","0","1800000","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_purchases VALUES("303","18","106","20","12","12","1","150000","0","0","0","1800000","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_purchases VALUES("304","18","106","19","12","12","1","150000","0","0","0","1800000","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_purchases VALUES("305","18","105","","21","21","1","150000","0","0","0","3150000","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_purchases VALUES("306","18","116","","18","18","1","125000","0","0","0","2250000","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_purchases VALUES("307","19","85","","174","174","1","27000","0","0","0","4698000","2021-03-26 06:11:15","2021-03-26 06:11:15");
INSERT INTO product_purchases VALUES("308","19","84","","120","120","1","30000","0","0","0","3600000","2021-03-26 06:11:15","2021-03-26 06:11:15");
INSERT INTO product_purchases VALUES("309","20","83","","40","40","1","28000","0","0","0","1120000","2021-03-26 06:12:37","2021-03-26 06:12:37");
INSERT INTO product_purchases VALUES("310","20","82","","112","112","1","28000","0","0","0","3136000","2021-03-26 06:12:37","2021-03-26 06:12:37");
INSERT INTO product_purchases VALUES("314","21","88","","6","6","1","122000","0","0","0","732000","2021-03-26 06:14:59","2021-03-26 06:14:59");
INSERT INTO product_purchases VALUES("315","21","86","","12","12","1","112000","0","0","0","1344000","2021-03-26 06:14:59","2021-03-26 06:14:59");
INSERT INTO product_purchases VALUES("316","21","87","","12","12","1","115000","0","0","0","1380000","2021-03-26 06:14:59","2021-03-26 06:14:59");
INSERT INTO product_purchases VALUES("321","23","93","","480","480","1","40000","0","0","0","19200000","2021-03-26 06:20:29","2021-03-26 06:20:29");
INSERT INTO product_purchases VALUES("322","24","117","","50","50","1","100000","0","0","0","5000000","2021-03-26 06:26:19","2021-03-26 06:26:19");
INSERT INTO product_purchases VALUES("323","24","118","","20","20","1","100000","0","0","0","2000000","2021-03-26 06:26:19","2021-03-26 06:26:19");
INSERT INTO product_purchases VALUES("324","25","121","","144","144","1","121000","0","0","0","17424000","2021-03-26 06:46:41","2021-03-26 06:46:41");
INSERT INTO product_purchases VALUES("325","25","120","","12","12","1","125000","0","0","0","1500000","2021-03-26 06:46:41","2021-03-26 06:46:41");
INSERT INTO product_purchases VALUES("326","25","122","","180","180","1","134000","0","0","0","24120000","2021-03-26 06:46:41","2021-03-26 06:46:41");
INSERT INTO product_purchases VALUES("327","25","119","","168","168","1","80000","0","0","0","13440000","2021-03-26 06:46:41","2021-03-26 06:46:41");
INSERT INTO product_purchases VALUES("328","26","126","","4","4","1","90000","0","0","0","360000","2021-03-26 13:02:18","2021-03-26 13:02:18");
INSERT INTO product_purchases VALUES("329","26","129","","4","4","1","88000","0","0","0","352000","2021-03-26 13:02:18","2021-03-26 13:02:18");
INSERT INTO product_purchases VALUES("330","26","130","","4","4","1","95000","0","0","0","380000","2021-03-26 13:02:18","2021-03-26 13:02:18");
INSERT INTO product_purchases VALUES("331","26","128","","4","4","1","88000","0","0","0","352000","2021-03-26 13:02:18","2021-03-26 13:02:18");
INSERT INTO product_purchases VALUES("332","26","127","","4","4","1","72000","0","0","0","288000","2021-03-26 13:02:18","2021-03-26 13:02:18");
INSERT INTO product_purchases VALUES("333","26","125","","3","3","1","85000","0","0","0","255000","2021-03-26 13:02:18","2021-03-26 13:02:18");
INSERT INTO product_purchases VALUES("334","26","124","","4","4","1","68000","0","0","0","272000","2021-03-26 13:02:18","2021-03-26 13:02:18");
INSERT INTO product_purchases VALUES("335","26","123","","4","4","1","70000","0","0","0","280000","2021-03-26 13:02:18","2021-03-26 13:02:18");
INSERT INTO product_purchases VALUES("336","27","135","","10","10","1","95000","0","0","0","950000","2021-04-05 03:28:05","2021-04-05 03:28:05");
INSERT INTO product_purchases VALUES("337","27","132","","10","10","1","110000","0","0","0","1100000","2021-04-05 03:28:05","2021-04-05 03:28:05");
INSERT INTO product_purchases VALUES("338","27","136","","10","10","1","115000","0","0","0","1150000","2021-04-05 03:28:05","2021-04-05 03:28:05");
INSERT INTO product_purchases VALUES("339","27","134","","10","10","1","110000","0","0","0","1100000","2021-04-05 03:28:05","2021-04-05 03:28:05");
INSERT INTO product_purchases VALUES("340","27","133","","10","10","1","110000","0","0","0","1100000","2021-04-05 03:28:05","2021-04-05 03:28:05");
INSERT INTO product_purchases VALUES("341","27","131","","10","10","1","100000","0","0","0","1000000","2021-04-05 03:28:05","2021-04-05 03:28:05");
INSERT INTO product_purchases VALUES("342","28","138","","120","120","1","40000","0","0","0","4800000","2021-04-05 03:43:24","2021-04-05 03:43:24");
INSERT INTO product_purchases VALUES("343","28","137","","288","288","1","32500","0","0","0","9360000","2021-04-05 03:43:24","2021-04-05 03:43:24");
INSERT INTO product_purchases VALUES("344","22","92","","108","108","1","43000","0","0","0","4644000","2021-04-05 03:44:22","2021-04-05 03:44:22");
INSERT INTO product_purchases VALUES("345","22","91","","108","108","1","42000","0","0","0","4536000","2021-04-05 03:44:22","2021-04-05 03:44:22");
INSERT INTO product_purchases VALUES("346","22","90","","108","108","1","39000","0","0","0","4212000","2021-04-05 03:44:22","2021-04-05 03:44:22");
INSERT INTO product_purchases VALUES("347","22","89","","216","216","1","39000","0","0","0","8424000","2021-04-05 03:44:22","2021-04-05 03:44:22");
INSERT INTO product_purchases VALUES("348","29","142","","24","24","1","120000","0","0","0","2880000","2021-04-05 03:52:49","2021-04-05 03:52:49");
INSERT INTO product_purchases VALUES("349","29","141","","60","60","1","75000","0","0","0","4500000","2021-04-05 03:52:49","2021-04-05 03:52:49");
INSERT INTO product_purchases VALUES("350","29","140","","132","132","1","65000","0","0","0","8580000","2021-04-05 03:52:49","2021-04-05 03:52:49");
INSERT INTO product_purchases VALUES("351","29","139","","132","132","1","70000","0","0","0","9240000","2021-04-05 03:52:49","2021-04-05 03:52:49");
INSERT INTO product_purchases VALUES("381","30","157","","24","24","1","38000","0","0","0","912000","2021-04-05 07:38:35","2021-04-05 07:38:35");
INSERT INTO product_purchases VALUES("382","30","153","","24","24","1","33000","0","0","0","792000","2021-04-05 07:38:35","2021-04-05 07:38:35");
INSERT INTO product_purchases VALUES("383","30","156","","24","24","1","42000","0","0","0","1008000","2021-04-05 07:38:35","2021-04-05 07:38:35");
INSERT INTO product_purchases VALUES("384","30","155","","6","6","1","39000","0","0","0","234000","2021-04-05 07:38:35","2021-04-05 07:38:35");
INSERT INTO product_purchases VALUES("385","30","152","","24","24","1","36000","0","0","0","864000","2021-04-05 07:38:35","2021-04-05 07:38:35");
INSERT INTO product_purchases VALUES("386","30","151","","24","24","1","38000","0","0","0","912000","2021-04-05 07:38:35","2021-04-05 07:38:35");
INSERT INTO product_purchases VALUES("387","30","150","","36","36","1","30000","0","0","0","1080000","2021-04-05 07:38:35","2021-04-05 07:38:35");
INSERT INTO product_purchases VALUES("388","30","154","","12","12","1","37000","0","0","0","444000","2021-04-05 07:38:35","2021-04-05 07:38:35");
INSERT INTO product_purchases VALUES("389","30","149","","36","36","1","33000","0","0","0","1188000","2021-04-05 07:38:35","2021-04-05 07:38:35");
INSERT INTO product_purchases VALUES("390","30","148","","36","36","1","50000","0","0","0","1800000","2021-04-05 07:38:35","2021-04-05 07:38:35");
INSERT INTO product_purchases VALUES("391","30","146","","36","36","1","52500","0","0","0","1890000","2021-04-05 07:38:35","2021-04-05 07:38:35");
INSERT INTO product_purchases VALUES("392","30","144","","36","36","1","45000","0","0","0","1620000","2021-04-05 07:38:35","2021-04-05 07:38:35");
INSERT INTO product_purchases VALUES("393","30","147","","36","36","1","51000","0","0","0","1836000","2021-04-05 07:38:35","2021-04-05 07:38:35");
INSERT INTO product_purchases VALUES("394","30","145","","36","36","1","43500","0","0","0","1566000","2021-04-05 07:38:35","2021-04-05 07:38:35");
INSERT INTO product_purchases VALUES("395","30","143","","36","36","1","40000","0","0","0","1440000","2021-04-05 07:38:35","2021-04-05 07:38:35");
INSERT INTO product_purchases VALUES("396","31","168","","44","44","1","90000","0","0","0","3960000","2021-04-11 04:23:03","2021-04-11 04:23:03");
INSERT INTO product_purchases VALUES("397","31","167","","12","12","1","70000","0","0","0","840000","2021-04-11 04:23:03","2021-04-11 04:23:03");
INSERT INTO product_purchases VALUES("398","31","166","","24","24","1","65000","0","0","0","1560000","2021-04-11 04:23:03","2021-04-11 04:23:03");
INSERT INTO product_purchases VALUES("399","31","165","","72","72","1","65000","0","0","0","4680000","2021-04-11 04:23:03","2021-04-11 04:23:03");
INSERT INTO product_purchases VALUES("400","31","164","","24","24","1","60000","0","0","0","1440000","2021-04-11 04:23:03","2021-04-11 04:23:03");
INSERT INTO product_purchases VALUES("401","32","170","","42","42","1","70000","0","0","0","2940000","2021-04-11 04:45:52","2021-04-11 04:45:52");
INSERT INTO product_purchases VALUES("402","32","171","","24","24","1","75000","0","0","0","1800000","2021-04-11 04:45:52","2021-04-11 04:45:52");
INSERT INTO product_purchases VALUES("403","32","169","","72","72","1","65000","0","0","0","4680000","2021-04-11 04:45:52","2021-04-11 04:45:52");
INSERT INTO product_purchases VALUES("404","35","176","","48","48","1","50000","0","0","0","2400000","2021-04-16 08:22:36","2021-04-16 08:22:36");
INSERT INTO product_purchases VALUES("405","35","175","","96","96","1","58000","0","0","0","5568000","2021-04-16 08:22:36","2021-04-16 08:22:36");
INSERT INTO product_purchases VALUES("406","35","174","","84","84","1","49000","0","0","0","4116000","2021-04-16 08:22:36","2021-04-16 08:22:36");
INSERT INTO product_purchases VALUES("407","35","173","","12","12","1","45000","0","0","0","540000","2021-04-16 08:22:36","2021-04-16 08:22:36");
INSERT INTO product_purchases VALUES("408","35","172","","72","72","1","52000","0","0","0","3744000","2021-04-16 08:22:36","2021-04-16 08:22:36");
INSERT INTO product_purchases VALUES("409","36","181","","36","36","1","80000","0","0","0","2880000","2021-04-16 08:27:17","2021-04-16 08:27:17");
INSERT INTO product_purchases VALUES("410","36","180","","36","36","1","73500","0","0","0","2646000","2021-04-16 08:27:17","2021-04-16 08:27:17");
INSERT INTO product_purchases VALUES("411","36","182","","36","36","1","67500","0","0","0","2430000","2021-04-16 08:27:17","2021-04-16 08:27:17");
INSERT INTO product_purchases VALUES("412","36","179","","72","72","1","63500","0","0","0","4572000","2021-04-16 08:27:17","2021-04-16 08:27:17");
INSERT INTO product_purchases VALUES("419","38","184","","36","36","1","24000","0","0","0","864000","2021-04-16 12:23:59","2021-04-16 12:23:59");
INSERT INTO product_purchases VALUES("420","38","188","","60","60","1","32000","0","0","0","1920000","2021-04-16 12:23:59","2021-04-16 12:23:59");
INSERT INTO product_purchases VALUES("421","38","187","","48","48","1","26000","0","0","0","1248000","2021-04-16 12:23:59","2021-04-16 12:23:59");
INSERT INTO product_purchases VALUES("422","38","186","","60","60","1","28000","0","0","0","1680000","2021-04-16 12:23:59","2021-04-16 12:23:59");
INSERT INTO product_purchases VALUES("423","38","185","","36","36","1","20000","0","0","0","720000","2021-04-16 12:23:59","2021-04-16 12:23:59");
INSERT INTO product_purchases VALUES("424","38","183","","180","180","1","23000","0","0","0","4140000","2021-04-16 12:23:59","2021-04-16 12:23:59");
INSERT INTO product_purchases VALUES("425","39","192","","40","40","1","40000","0","0","0","1600000","2021-04-16 12:31:45","2021-04-16 12:31:45");
INSERT INTO product_purchases VALUES("426","39","190","","96","96","1","30000","0","0","0","2880000","2021-04-16 12:31:45","2021-04-16 12:31:45");
INSERT INTO product_purchases VALUES("427","39","189","","84","84","1","47000","0","0","0","3948000","2021-04-16 12:31:45","2021-04-16 12:31:45");
INSERT INTO product_purchases VALUES("428","39","191","","240","240","1","36000","0","0","0","8640000","2021-04-16 12:31:45","2021-04-16 12:31:45");
INSERT INTO product_purchases VALUES("429","40","201","","60","60","1","82500","0","0","0","4950000","2021-04-17 06:27:23","2021-04-17 06:27:23");
INSERT INTO product_purchases VALUES("430","40","200","","60","60","1","77500","0","0","0","4650000","2021-04-17 06:27:23","2021-04-17 06:27:23");
INSERT INTO product_purchases VALUES("431","40","199","","36","36","1","90000","0","0","0","3240000","2021-04-17 06:27:23","2021-04-17 06:27:23");
INSERT INTO product_purchases VALUES("432","40","198","","72","72","1","82500","0","0","0","5940000","2021-04-17 06:27:23","2021-04-17 06:27:23");
INSERT INTO product_purchases VALUES("433","40","197","","12","12","1","72500","0","0","0","870000","2021-04-17 06:27:23","2021-04-17 06:27:23");
INSERT INTO product_purchases VALUES("434","40","196","","48","48","1","67500","0","0","0","3240000","2021-04-17 06:27:23","2021-04-17 06:27:23");
INSERT INTO product_purchases VALUES("435","40","195","","48","48","1","55000","0","0","0","2640000","2021-04-17 06:27:23","2021-04-17 06:27:23");
INSERT INTO product_purchases VALUES("436","40","194","","96","96","1","52500","0","0","0","5040000","2021-04-17 06:27:23","2021-04-17 06:27:23");
INSERT INTO product_purchases VALUES("437","40","193","","96","96","1","52500","0","0","0","5040000","2021-04-17 06:27:23","2021-04-17 06:27:23");
INSERT INTO product_purchases VALUES("438","41","202","","180","180","1","40000","0","0","0","7200000","2021-04-17 06:30:19","2021-04-17 06:30:19");
INSERT INTO product_purchases VALUES("439","42","203","","40","40","1","85000","0","0","0","3400000","2021-04-17 06:57:49","2021-04-17 06:57:49");
INSERT INTO product_purchases VALUES("440","42","204","","16","16","1","95000","0","0","0","1520000","2021-04-17 06:57:49","2021-04-17 06:57:49");
INSERT INTO product_purchases VALUES("441","43","206","","240","240","1","45000","0","0","0","10800000","2021-04-17 07:15:41","2021-04-17 07:15:41");
INSERT INTO product_purchases VALUES("442","43","205","","480","480","1","25000","0","0","0","12000000","2021-04-17 07:15:41","2021-04-17 07:15:41");
INSERT INTO product_purchases VALUES("447","44","207","","156","156","1","38000","0","0","0","5928000","2021-04-18 07:58:26","2021-04-18 07:58:26");
INSERT INTO product_purchases VALUES("448","44","210","","36","36","1","40000","0","0","0","1440000","2021-04-18 07:58:26","2021-04-18 07:58:26");
INSERT INTO product_purchases VALUES("449","44","209","","12","12","1","50000","0","0","0","600000","2021-04-18 07:58:26","2021-04-18 07:58:26");
INSERT INTO product_purchases VALUES("450","44","208","","12","12","1","45000","0","0","0","540000","2021-04-18 07:58:26","2021-04-18 07:58:26");
INSERT INTO product_purchases VALUES("451","45","212","","6","6","1","92000","0","0","0","552000","2021-04-18 08:12:35","2021-04-18 08:12:35");
INSERT INTO product_purchases VALUES("452","45","214","","24","24","1","60000","0","0","0","1440000","2021-04-18 08:12:35","2021-04-18 08:12:35");
INSERT INTO product_purchases VALUES("453","45","213","","48","48","1","93000","0","0","0","4464000","2021-04-18 08:12:35","2021-04-18 08:12:35");
INSERT INTO product_purchases VALUES("454","45","211","","3","3","1","115000","0","0","0","345000","2021-04-18 08:12:35","2021-04-18 08:12:35");
INSERT INTO product_purchases VALUES("456","46","216","","60","60","1","45000","0","0","0","2700000","2021-04-18 08:22:19","2021-04-18 08:22:19");
INSERT INTO product_purchases VALUES("457","46","217","","72","72","1","36000","0","0","0","2592000","2021-04-18 08:22:19","2021-04-18 08:22:19");
INSERT INTO product_purchases VALUES("458","46","215","","200","200","1","40000","0","0","0","8000000","2021-04-18 08:22:19","2021-04-18 08:22:19");
INSERT INTO product_purchases VALUES("459","47","225","","60","60","1","27000","0","0","0","1620000","2021-04-18 08:43:10","2021-04-18 08:43:10");
INSERT INTO product_purchases VALUES("460","47","224","","36","36","1","32000","0","0","0","1152000","2021-04-18 08:43:10","2021-04-18 08:43:10");
INSERT INTO product_purchases VALUES("461","47","223","","24","24","1","33000","0","0","0","792000","2021-04-18 08:43:10","2021-04-18 08:43:10");
INSERT INTO product_purchases VALUES("462","47","220","","120","120","1","39000","0","0","0","4680000","2021-04-18 08:43:10","2021-04-18 08:43:10");
INSERT INTO product_purchases VALUES("463","47","222","","60","60","1","43000","0","0","0","2580000","2021-04-18 08:43:10","2021-04-18 08:43:10");
INSERT INTO product_purchases VALUES("464","47","218","","120","120","1","34000","0","0","0","4080000","2021-04-18 08:43:10","2021-04-18 08:43:10");
INSERT INTO product_purchases VALUES("465","47","221","","60","60","1","48000","0","0","0","2880000","2021-04-18 08:43:10","2021-04-18 08:43:10");
INSERT INTO product_purchases VALUES("466","47","219","","120","120","1","31000","0","0","0","3720000","2021-04-18 08:43:10","2021-04-18 08:43:10");
INSERT INTO product_purchases VALUES("467","48","226","","100","100","1","120000","0","0","0","12000000","2021-04-19 06:48:21","2021-04-19 06:48:21");



CREATE TABLE `product_quotation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quotation_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `qty` double NOT NULL,
  `sale_unit_id` int(11) NOT NULL,
  `net_unit_price` double NOT NULL,
  `discount` double NOT NULL,
  `tax_rate` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `product_returns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `return_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `qty` double NOT NULL,
  `sale_unit_id` int(11) NOT NULL,
  `net_unit_price` double NOT NULL,
  `discount` double NOT NULL,
  `tax_rate` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `product_sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sale_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `qty` double NOT NULL,
  `sale_unit_id` int(11) NOT NULL,
  `net_unit_price` double NOT NULL,
  `discount` double NOT NULL,
  `tax_rate` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO product_sales VALUES("1","1","2","3","1","1","283000","0","0","0","283000","2021-03-07 12:06:03","2021-03-07 12:06:03");
INSERT INTO product_sales VALUES("2","2","15","","1","1","340000","0","0","0","340000","2021-03-08 07:15:20","2021-03-08 07:21:58");
INSERT INTO product_sales VALUES("4","4","12","","1","1","350000","0","0","0","350000","2021-03-08 07:23:23","2021-03-08 07:23:23");
INSERT INTO product_sales VALUES("5","5","16","","1","1","350000","0","0","0","350000","2021-03-08 08:28:23","2021-03-08 08:28:23");
INSERT INTO product_sales VALUES("6","6","2","2","1","1","283000","0","0","0","283000","2021-03-08 08:48:45","2021-03-08 08:48:45");
INSERT INTO product_sales VALUES("7","7","52","","1","1","180000","0","0","0","180000","2021-03-19 06:41:48","2021-03-19 06:41:48");
INSERT INTO product_sales VALUES("8","8","37","","1","1","250000","0","0","0","250000","2021-03-19 06:44:00","2021-03-19 06:44:00");
INSERT INTO product_sales VALUES("9","9","49","","1","1","220000","0","0","0","220000","2021-03-19 06:44:44","2021-03-19 06:44:44");
INSERT INTO product_sales VALUES("10","10","47","","1","1","150000","0","0","0","150000","2021-03-19 06:47:42","2021-03-19 06:47:42");
INSERT INTO product_sales VALUES("11","11","42","","1","1","210000","0","0","0","210000","2021-03-19 06:49:16","2021-03-19 06:49:16");
INSERT INTO product_sales VALUES("12","12","25","","1","1","220000","0","0","0","220000","2021-03-19 06:50:19","2021-03-19 06:50:19");
INSERT INTO product_sales VALUES("13","13","28","","1","1","260000","0","0","0","260000","2021-03-19 06:58:50","2021-03-19 06:58:50");
INSERT INTO product_sales VALUES("14","14","22","","1","1","230000","0","0","0","230000","2021-03-19 06:59:45","2021-03-19 06:59:45");
INSERT INTO product_sales VALUES("15","15","5","13","1","1","354000","0","0","0","354000","2021-03-19 07:01:58","2021-03-19 07:01:58");
INSERT INTO product_sales VALUES("16","16","58","","1","1","190000","0","0","0","190000","2021-03-19 07:07:06","2021-03-19 07:07:06");
INSERT INTO product_sales VALUES("17","17","36","","1","1","260000","0","0","0","260000","2021-03-19 07:07:51","2021-03-19 07:07:51");
INSERT INTO product_sales VALUES("18","18","44","","1","1","180000","0","0","0","180000","2021-03-19 07:08:23","2021-03-19 07:08:23");
INSERT INTO product_sales VALUES("19","19","39","","1","1","220000","0","0","0","220000","2021-03-19 07:09:38","2021-03-19 07:09:38");
INSERT INTO product_sales VALUES("20","20","66","","1","1","140000","0","0","0","140000","2021-03-19 07:10:03","2021-03-19 07:10:03");
INSERT INTO product_sales VALUES("21","21","4","13","1","1","354000","0","0","0","354000","2021-03-19 07:12:55","2021-03-19 07:12:55");
INSERT INTO product_sales VALUES("22","22","31","","1","1","190000","0","0","0","190000","2021-03-19 07:17:50","2021-03-19 07:17:50");
INSERT INTO product_sales VALUES("23","23","60","","2","1","170000","0","0","0","340000","2021-03-19 07:26:22","2021-03-19 07:26:22");
INSERT INTO product_sales VALUES("24","24","59","","1","1","180000","0","0","0","180000","2021-03-19 07:27:48","2021-03-19 07:27:48");
INSERT INTO product_sales VALUES("25","25","5","14","1","1","354000","0","0","0","354000","2021-03-19 07:32:49","2021-03-19 07:32:49");
INSERT INTO product_sales VALUES("26","26","44","","1","1","180000","0","0","0","180000","2021-03-19 07:33:17","2021-03-19 07:33:17");
INSERT INTO product_sales VALUES("27","27","40","","1","1","250000","0","0","0","250000","2021-03-19 07:34:25","2021-03-19 07:34:25");
INSERT INTO product_sales VALUES("28","28","20","","1","1","210000","0","0","0","210000","2021-03-19 07:36:09","2021-03-19 07:36:09");
INSERT INTO product_sales VALUES("29","29","60","","1","1","170000","0","0","0","170000","2021-03-19 07:38:28","2021-03-19 07:38:28");
INSERT INTO product_sales VALUES("30","30","12","","1","1","350000","0","0","0","350000","2021-03-19 09:43:13","2021-03-19 09:43:13");
INSERT INTO product_sales VALUES("31","31","21","","1","1","280000","0","0","0","280000","2021-03-19 09:45:22","2021-03-19 09:45:22");
INSERT INTO product_sales VALUES("32","32","26","","1","1","220000","0","0","0","220000","2021-03-19 09:46:51","2021-03-19 09:46:51");
INSERT INTO product_sales VALUES("33","33","22","","1","1","230000","0","0","0","230000","2021-03-19 09:48:29","2021-03-19 09:48:29");
INSERT INTO product_sales VALUES("34","34","44","","1","1","180000","0","0","0","180000","2021-03-19 09:51:23","2021-03-19 09:51:23");
INSERT INTO product_sales VALUES("35","34","31","","1","1","190000","0","0","0","190000","2021-03-19 09:51:23","2021-03-19 09:51:23");
INSERT INTO product_sales VALUES("36","34","22","","1","1","230000","0","0","0","230000","2021-03-19 09:51:23","2021-03-19 09:51:23");
INSERT INTO product_sales VALUES("37","35","30","","1","1","300000","0","0","0","300000","2021-03-19 09:52:23","2021-03-19 09:52:23");
INSERT INTO product_sales VALUES("38","36","4","13","1","1","354000","0","0","0","354000","2021-03-19 09:55:21","2021-03-19 09:55:21");
INSERT INTO product_sales VALUES("39","37","44","","1","1","180000","0","0","0","180000","2021-03-19 09:56:11","2021-03-19 09:56:11");
INSERT INTO product_sales VALUES("40","38","49","","1","1","220000","0","0","0","220000","2021-03-19 12:02:41","2021-03-19 12:02:41");
INSERT INTO product_sales VALUES("41","39","41","","1","1","260000","0","0","0","260000","2021-03-19 12:04:25","2021-03-19 12:04:25");
INSERT INTO product_sales VALUES("42","40","55","","1","1","350000","0","0","0","350000","2021-03-19 12:05:21","2021-03-19 12:05:21");
INSERT INTO product_sales VALUES("43","41","22","","1","1","230000","0","0","0","230000","2021-03-19 12:06:52","2021-03-19 12:06:52");
INSERT INTO product_sales VALUES("44","42","4","13","1","1","354000","0","0","0","354000","2021-03-19 12:09:12","2021-03-19 12:09:12");
INSERT INTO product_sales VALUES("45","43","30","","1","1","300000","0","0","0","300000","2021-03-19 12:09:59","2021-03-19 12:09:59");
INSERT INTO product_sales VALUES("46","44","28","","2","1","260000","0","0","0","520000","2021-03-19 12:11:58","2021-03-19 12:11:58");
INSERT INTO product_sales VALUES("47","44","25","","1","1","220000","0","0","0","220000","2021-03-19 12:11:58","2021-03-19 12:11:58");
INSERT INTO product_sales VALUES("48","44","27","","1","1","260000","0","0","0","260000","2021-03-19 12:11:58","2021-03-19 12:11:58");
INSERT INTO product_sales VALUES("49","45","60","","1","1","170000","0","0","0","170000","2021-03-19 12:12:27","2021-03-19 12:12:27");
INSERT INTO product_sales VALUES("50","46","16","","2","1","350000","0","0","0","700000","2021-03-19 12:14:28","2021-03-19 12:14:28");
INSERT INTO product_sales VALUES("51","47","2","5","1","1","283000","0","0","0","283000","2021-03-19 12:16:09","2021-03-19 12:16:09");
INSERT INTO product_sales VALUES("52","48","29","","1","1","290000","0","0","0","290000","2021-03-19 12:18:04","2021-03-19 12:18:04");
INSERT INTO product_sales VALUES("53","49","51","","1","1","180000","0","0","0","180000","2021-03-19 12:22:21","2021-03-19 12:22:21");
INSERT INTO product_sales VALUES("54","50","26","","1","1","220000","0","0","0","220000","2021-03-19 12:23:45","2021-03-19 12:23:45");
INSERT INTO product_sales VALUES("55","51","29","","2","1","290000","0","0","0","580000","2021-03-19 12:42:19","2021-03-19 12:42:19");
INSERT INTO product_sales VALUES("56","51","2","3","1","1","283000","0","0","0","283000","2021-03-19 12:42:19","2021-03-19 12:42:19");
INSERT INTO product_sales VALUES("57","51","15","","1","1","340000","0","0","0","340000","2021-03-19 12:42:19","2021-03-19 12:42:19");
INSERT INTO product_sales VALUES("58","52","29","","1","1","290000","0","0","0","290000","2021-03-19 12:51:30","2021-03-19 12:51:30");
INSERT INTO product_sales VALUES("59","53","58","","1","1","190000","0","0","0","190000","2021-03-20 02:57:47","2021-03-20 02:57:47");
INSERT INTO product_sales VALUES("60","54","60","","3","1","170000","0","0","0","510000","2021-03-20 03:20:18","2021-03-20 03:20:18");
INSERT INTO product_sales VALUES("61","55","49","","1","1","220000","0","0","0","220000","2021-03-20 05:14:16","2021-03-20 05:14:16");
INSERT INTO product_sales VALUES("62","55","58","","1","1","190000","0","0","0","190000","2021-03-20 05:14:16","2021-03-20 05:14:16");
INSERT INTO product_sales VALUES("63","56","25","","1","1","220000","0","0","0","220000","2021-03-20 06:28:22","2021-03-20 06:28:22");
INSERT INTO product_sales VALUES("64","57","35","","1","1","230000","0","0","0","230000","2021-03-21 07:12:04","2021-03-21 07:12:04");
INSERT INTO product_sales VALUES("65","58","29","","1","1","290000","0","0","0","290000","2021-03-21 07:15:40","2021-03-21 07:15:40");
INSERT INTO product_sales VALUES("66","59","48","","1","1","220000","0","0","0","220000","2021-03-21 07:16:34","2021-03-21 07:16:34");
INSERT INTO product_sales VALUES("67","60","27","","3","1","260000","0","0","0","780000","2021-03-21 07:17:24","2021-03-21 07:17:24");
INSERT INTO product_sales VALUES("68","61","41","","1","1","260000","0","0","0","260000","2021-03-21 07:21:25","2021-03-21 07:21:25");
INSERT INTO product_sales VALUES("69","62","47","","1","1","150000","0","0","0","150000","2021-03-21 07:25:23","2021-03-21 07:25:23");
INSERT INTO product_sales VALUES("70","63","60","","1","1","170000","0","0","0","170000","2021-03-21 07:49:49","2021-03-21 07:49:49");
INSERT INTO product_sales VALUES("71","63","58","","1","1","190000","0","0","0","190000","2021-03-21 07:49:49","2021-03-21 07:49:49");
INSERT INTO product_sales VALUES("72","64","34","","1","1","220000","0","0","0","220000","2021-03-21 07:53:47","2021-03-21 07:53:47");
INSERT INTO product_sales VALUES("73","64","28","","1","1","260000","0","0","0","260000","2021-03-21 07:53:47","2021-03-21 07:53:47");
INSERT INTO product_sales VALUES("74","65","58","","1","1","190000","0","0","0","190000","2021-03-21 07:55:36","2021-03-21 07:55:36");
INSERT INTO product_sales VALUES("75","65","60","","1","1","170000","0","0","0","170000","2021-03-21 07:55:36","2021-03-21 07:55:36");
INSERT INTO product_sales VALUES("76","66","58","","1","1","190000","0","0","0","190000","2021-03-21 07:59:23","2021-03-21 07:59:23");
INSERT INTO product_sales VALUES("77","66","41","","1","1","260000","0","0","0","260000","2021-03-21 07:59:23","2021-03-21 07:59:23");
INSERT INTO product_sales VALUES("78","66","66","","2","1","140000","0","0","0","280000","2021-03-21 07:59:23","2021-03-21 07:59:23");
INSERT INTO product_sales VALUES("79","67","58","","1","1","190000","0","0","0","190000","2021-03-21 08:11:37","2021-03-21 08:11:37");
INSERT INTO product_sales VALUES("80","67","27","","1","1","260000","0","0","0","260000","2021-03-21 08:11:37","2021-03-21 08:11:37");
INSERT INTO product_sales VALUES("81","68","67","","1","1","180000","0","0","0","180000","2021-03-21 08:54:22","2021-03-21 08:54:22");
INSERT INTO product_sales VALUES("82","69","65","","1","1","130000","0","0","0","130000","2021-03-21 08:56:48","2021-03-21 08:56:48");
INSERT INTO product_sales VALUES("83","69","60","","1","1","170000","0","0","0","170000","2021-03-21 08:56:48","2021-03-21 08:56:48");
INSERT INTO product_sales VALUES("84","69","62","","1","1","100000","0","0","0","100000","2021-03-21 08:56:48","2021-03-21 08:56:48");
INSERT INTO product_sales VALUES("85","70","66","","1","1","140000","0","0","0","140000","2021-03-21 09:02:08","2021-03-21 09:02:08");
INSERT INTO product_sales VALUES("86","70","34","","2","1","220000","0","0","0","440000","2021-03-21 09:02:08","2021-03-21 09:02:08");
INSERT INTO product_sales VALUES("87","70","43","","1","1","220000","0","0","0","220000","2021-03-21 09:02:08","2021-03-21 09:02:08");
INSERT INTO product_sales VALUES("88","70","55","","1","1","350000","0","0","0","350000","2021-03-21 09:02:08","2021-03-21 09:02:08");
INSERT INTO product_sales VALUES("89","70","52","","2","1","180000","0","0","0","360000","2021-03-21 09:02:08","2021-03-21 09:02:08");
INSERT INTO product_sales VALUES("90","70","67","","1","1","180000","0","0","0","180000","2021-03-21 09:02:08","2021-03-21 09:02:08");
INSERT INTO product_sales VALUES("91","71","58","","1","1","190000","0","0","0","190000","2021-03-21 09:06:07","2021-03-21 09:06:07");
INSERT INTO product_sales VALUES("92","71","14","","1","1","340000","0","0","0","340000","2021-03-21 09:06:07","2021-03-21 09:06:07");
INSERT INTO product_sales VALUES("93","71","36","","1","1","260000","0","0","0","260000","2021-03-21 09:06:07","2021-03-21 09:06:07");
INSERT INTO product_sales VALUES("94","71","40","","1","1","250000","0","0","0","250000","2021-03-21 09:06:07","2021-03-21 09:06:07");
INSERT INTO product_sales VALUES("95","71","67","","1","1","180000","0","0","0","180000","2021-03-21 09:06:07","2021-03-21 09:06:07");
INSERT INTO product_sales VALUES("96","71","27","","1","1","260000","0","0","0","260000","2021-03-21 09:06:07","2021-03-21 09:06:07");
INSERT INTO product_sales VALUES("97","71","62","","1","1","100000","0","0","0","100000","2021-03-21 09:06:07","2021-03-21 09:06:07");
INSERT INTO product_sales VALUES("98","71","61","","1","1","110000","0","0","0","110000","2021-03-21 09:06:07","2021-03-21 09:06:07");
INSERT INTO product_sales VALUES("99","71","18","","1","1","210000","0","0","0","210000","2021-03-21 09:06:07","2021-03-21 09:06:07");
INSERT INTO product_sales VALUES("100","72","67","","1","1","180000","0","0","0","180000","2021-03-21 09:06:57","2021-03-21 09:06:57");
INSERT INTO product_sales VALUES("101","73","16","","1","1","350000","0","0","0","350000","2021-03-21 09:12:56","2021-03-21 09:12:56");
INSERT INTO product_sales VALUES("102","73","26","","1","1","220000","0","0","0","220000","2021-03-21 09:12:56","2021-03-21 09:12:56");
INSERT INTO product_sales VALUES("103","73","39","","1","1","220000","0","0","0","220000","2021-03-21 09:12:56","2021-03-21 09:12:56");
INSERT INTO product_sales VALUES("104","74","58","","1","1","190000","0","0","0","190000","2021-03-21 09:20:13","2021-03-21 09:20:13");
INSERT INTO product_sales VALUES("105","74","29","","1","1","290000","0","0","0","290000","2021-03-21 09:20:13","2021-03-21 09:20:13");
INSERT INTO product_sales VALUES("106","74","41","","1","1","260000","0","0","0","260000","2021-03-21 09:20:13","2021-03-21 09:20:13");
INSERT INTO product_sales VALUES("107","74","31","","1","1","190000","0","0","0","190000","2021-03-21 09:20:13","2021-03-21 09:20:13");
INSERT INTO product_sales VALUES("108","74","61","","1","1","110000","0","0","0","110000","2021-03-21 09:20:13","2021-03-21 09:20:13");
INSERT INTO product_sales VALUES("109","75","58","","1","1","190000","0","0","0","190000","2021-03-21 09:27:54","2021-03-21 09:27:54");
INSERT INTO product_sales VALUES("110","75","39","","1","1","220000","0","0","0","220000","2021-03-21 09:27:54","2021-03-21 09:27:54");
INSERT INTO product_sales VALUES("111","75","16","","1","1","350000","0","0","0","350000","2021-03-21 09:27:54","2021-03-21 09:27:54");
INSERT INTO product_sales VALUES("112","76","46","","1","1","150000","0","0","0","150000","2021-03-21 09:29:48","2021-03-21 09:29:48");
INSERT INTO product_sales VALUES("113","76","44","","1","1","180000","0","0","0","180000","2021-03-21 09:29:48","2021-03-21 09:29:48");
INSERT INTO product_sales VALUES("114","76","29","","1","1","290000","0","0","0","290000","2021-03-21 09:29:48","2021-03-21 09:29:48");
INSERT INTO product_sales VALUES("115","76","60","","2","1","170000","0","0","0","340000","2021-03-21 09:29:48","2021-03-21 09:29:48");
INSERT INTO product_sales VALUES("116","77","38","","1","1","260000","0","0","0","260000","2021-03-21 09:33:23","2021-03-21 09:33:23");
INSERT INTO product_sales VALUES("117","77","55","","1","1","350000","0","0","0","350000","2021-03-21 09:33:23","2021-03-21 09:33:23");
INSERT INTO product_sales VALUES("118","77","44","","2","1","180000","0","0","0","360000","2021-03-21 09:33:23","2021-03-21 09:33:23");
INSERT INTO product_sales VALUES("119","77","61","","1","1","110000","0","0","0","110000","2021-03-21 09:33:23","2021-03-21 09:33:23");
INSERT INTO product_sales VALUES("120","78","47","","1","1","150000","0","0","0","150000","2021-03-21 09:36:05","2021-03-21 09:36:05");
INSERT INTO product_sales VALUES("121","78","28","","1","1","260000","0","0","0","260000","2021-03-21 09:36:05","2021-03-21 09:36:05");
INSERT INTO product_sales VALUES("122","78","58","","1","1","190000","0","0","0","190000","2021-03-21 09:36:05","2021-03-21 09:36:05");
INSERT INTO product_sales VALUES("123","78","30","","1","1","300000","0","0","0","300000","2021-03-21 09:36:05","2021-03-21 09:36:05");
INSERT INTO product_sales VALUES("124","79","43","","3","1","220000","0","0","0","660000","2021-03-21 09:38:25","2021-03-21 09:38:25");
INSERT INTO product_sales VALUES("125","79","48","","1","1","220000","0","0","0","220000","2021-03-21 09:38:25","2021-03-21 09:38:25");
INSERT INTO product_sales VALUES("126","80","65","","7","1","130000","0","0","0","910000","2021-03-21 09:42:33","2021-03-21 09:42:33");
INSERT INTO product_sales VALUES("127","80","42","","1","1","210000","0","0","0","210000","2021-03-21 09:42:33","2021-03-21 09:42:33");
INSERT INTO product_sales VALUES("128","80","39","","1","1","220000","0","0","0","220000","2021-03-21 09:42:33","2021-03-21 09:42:33");
INSERT INTO product_sales VALUES("129","80","30","","1","1","300000","0","0","0","300000","2021-03-21 09:42:33","2021-03-21 09:42:33");
INSERT INTO product_sales VALUES("130","81","51","","1","1","180000","0","0","0","180000","2021-03-21 09:44:48","2021-03-21 09:44:48");
INSERT INTO product_sales VALUES("131","81","60","","1","1","170000","0","0","0","170000","2021-03-21 09:44:48","2021-03-21 09:44:48");
INSERT INTO product_sales VALUES("132","81","30","","1","1","300000","0","0","0","300000","2021-03-21 09:44:48","2021-03-21 09:44:48");
INSERT INTO product_sales VALUES("133","82","44","","2","1","180000","0","0","0","360000","2021-03-21 09:45:38","2021-03-21 09:45:38");
INSERT INTO product_sales VALUES("134","83","22","","1","1","230000","0","0","0","230000","2021-03-21 09:50:45","2021-03-22 04:55:08");
INSERT INTO product_sales VALUES("135","83","44","","4","1","180000","0","0","0","720000","2021-03-21 09:50:45","2021-03-22 04:55:08");
INSERT INTO product_sales VALUES("136","83","62","","1","1","100000","0","0","0","100000","2021-03-21 09:50:45","2021-03-22 04:55:08");
INSERT INTO product_sales VALUES("137","83","66","","2","1","140000","0","0","0","280000","2021-03-21 09:50:45","2021-03-22 04:55:08");
INSERT INTO product_sales VALUES("138","84","39","","1","1","220000","0","0","0","220000","2021-03-21 09:51:40","2021-03-21 09:51:40");
INSERT INTO product_sales VALUES("139","84","49","","1","1","220000","0","0","0","220000","2021-03-21 09:51:40","2021-03-21 09:51:40");
INSERT INTO product_sales VALUES("140","85","23","","1","1","230000","0","0","0","230000","2021-03-21 09:55:19","2021-03-21 09:55:19");
INSERT INTO product_sales VALUES("141","85","44","","1","1","180000","0","0","0","180000","2021-03-21 09:55:19","2021-03-21 09:55:19");
INSERT INTO product_sales VALUES("142","85","46","","1","1","150000","0","0","0","150000","2021-03-21 09:55:19","2021-03-21 09:55:19");
INSERT INTO product_sales VALUES("143","85","48","","1","1","220000","0","0","0","220000","2021-03-21 09:55:19","2021-03-21 09:55:19");
INSERT INTO product_sales VALUES("144","86","31","","3","1","190000","0","0","0","570000","2021-03-22 04:52:02","2021-03-22 04:52:02");
INSERT INTO product_sales VALUES("145","86","60","","2","1","170000","0","0","0","340000","2021-03-22 04:52:02","2021-03-22 04:52:02");
INSERT INTO product_sales VALUES("146","86","44","","1","1","180000","0","0","0","180000","2021-03-22 04:52:02","2021-03-22 04:52:02");
INSERT INTO product_sales VALUES("147","87","44","","1","1","180000","0","0","0","180000","2021-03-22 04:54:42","2021-03-22 04:54:42");
INSERT INTO product_sales VALUES("148","87","67","","1","1","180000","0","0","0","180000","2021-03-22 04:54:42","2021-03-22 04:54:42");
INSERT INTO product_sales VALUES("149","87","65","","1","1","130000","0","0","0","130000","2021-03-22 04:54:42","2021-03-22 04:54:42");
INSERT INTO product_sales VALUES("150","87","37","","1","1","250000","0","0","0","250000","2021-03-22 04:54:42","2021-03-22 04:54:42");
INSERT INTO product_sales VALUES("151","88","21","","1","1","280000","0","0","0","280000","2021-03-22 04:56:55","2021-03-22 04:56:55");
INSERT INTO product_sales VALUES("152","88","44","","1","1","180000","0","0","0","180000","2021-03-22 04:56:55","2021-03-22 04:56:55");
INSERT INTO product_sales VALUES("153","89","22","","1","1","230000","0","0","0","230000","2021-03-22 05:01:52","2021-03-22 05:01:52");
INSERT INTO product_sales VALUES("154","89","33","","1","1","210000","0","0","0","210000","2021-03-22 05:01:52","2021-03-22 05:01:52");
INSERT INTO product_sales VALUES("155","89","32","","1","1","200000","0","0","0","200000","2021-03-22 05:01:52","2021-03-22 05:01:52");
INSERT INTO product_sales VALUES("156","90","71","","1","1","250000","0","0","0","250000","2021-03-22 05:06:25","2021-03-22 05:06:25");
INSERT INTO product_sales VALUES("157","90","65","","1","1","130000","0","0","0","130000","2021-03-22 05:06:25","2021-03-22 05:06:25");
INSERT INTO product_sales VALUES("158","90","29","","1","1","290000","0","0","0","290000","2021-03-22 05:06:25","2021-03-22 05:06:25");
INSERT INTO product_sales VALUES("159","90","43","","1","1","220000","0","0","0","220000","2021-03-22 05:06:25","2021-03-22 05:06:25");
INSERT INTO product_sales VALUES("160","90","32","","1","1","200000","0","0","0","200000","2021-03-22 05:06:25","2021-03-22 05:06:25");
INSERT INTO product_sales VALUES("161","90","42","","2","1","210000","0","0","0","420000","2021-03-22 05:06:25","2021-03-22 05:06:25");
INSERT INTO product_sales VALUES("162","91","38","","1","1","260000","0","0","0","260000","2021-03-23 07:40:13","2021-03-23 07:40:13");
INSERT INTO product_sales VALUES("163","92","53","","1","1","360000","0","0","0","360000","2021-03-24 01:51:16","2021-03-24 01:51:16");
INSERT INTO product_sales VALUES("164","92","38","","1","1","260000","0","0","0","260000","2021-03-24 01:51:16","2021-03-24 01:51:16");
INSERT INTO product_sales VALUES("165","93","71","","1","1","250000","0","0","0","250000","2021-03-24 12:10:10","2021-03-24 12:10:10");
INSERT INTO product_sales VALUES("166","93","37","","1","1","250000","0","0","0","250000","2021-03-24 12:10:10","2021-03-24 12:10:10");
INSERT INTO product_sales VALUES("167","94","60","","1","1","170000","0","0","0","170000","2021-03-24 12:39:20","2021-03-24 12:39:20");
INSERT INTO product_sales VALUES("168","95","34","","1","1","220000","0","0","0","220000","2021-03-24 12:44:01","2021-03-24 12:44:01");
INSERT INTO product_sales VALUES("169","96","39","","1","1","260000","0","0","0","260000","2021-03-25 08:10:58","2021-03-25 08:14:24");
INSERT INTO product_sales VALUES("170","97","28","","1","1","260000","0","0","0","260000","2021-03-25 09:07:07","2021-03-25 09:07:07");
INSERT INTO product_sales VALUES("171","98","58","","1","1","190000","0","0","0","190000","2021-03-25 12:14:40","2021-03-25 12:14:40");
INSERT INTO product_sales VALUES("172","99","28","","1","1","260000","0","0","0","260000","2021-03-25 12:17:20","2021-03-25 12:17:20");
INSERT INTO product_sales VALUES("173","100","49","","1","1","220000","0","0","0","220000","2021-03-25 12:17:44","2021-03-25 12:17:44");
INSERT INTO product_sales VALUES("174","101","32","","1","1","200000","0","0","0","200000","2021-03-26 05:02:22","2021-03-26 05:02:22");
INSERT INTO product_sales VALUES("175","101","41","","1","1","260000","0","0","0","260000","2021-03-26 05:02:22","2021-03-26 05:02:22");
INSERT INTO product_sales VALUES("176","102","211","","3","1","200000","0","0","0","600000","2021-04-18 08:13:19","2021-04-18 08:13:19");
INSERT INTO product_sales VALUES("177","102","212","","4","1","160000","0","0","0","640000","2021-04-18 08:13:19","2021-04-18 08:13:19");



CREATE TABLE `product_transfer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `transfer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `qty` double NOT NULL,
  `purchase_unit_id` int(11) NOT NULL,
  `net_unit_cost` double NOT NULL,
  `tax_rate` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `product_variants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `position` int(11) NOT NULL,
  `item_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `additional_price` double DEFAULT NULL,
  `qty` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO product_variants VALUES("6","1","6","1","33-77B05A","","3","2021-03-07 04:05:14","2021-03-13 17:05:35");
INSERT INTO product_variants VALUES("7","1","7","2","34-77B05A","","3","2021-03-07 04:05:14","2021-03-13 17:05:35");
INSERT INTO product_variants VALUES("8","1","8","3","35-77B05A","","2","2021-03-07 04:05:14","2021-03-13 17:05:35");
INSERT INTO product_variants VALUES("9","1","9","4","36-77B05A","","2","2021-03-07 04:05:14","2021-03-13 17:05:35");
INSERT INTO product_variants VALUES("10","1","10","5","37-77B05A","","1","2021-03-07 04:05:14","2021-03-13 17:05:35");
INSERT INTO product_variants VALUES("11","1","11","6","38-77B05A","","1","2021-03-07 04:05:14","2021-03-13 17:05:35");
INSERT INTO product_variants VALUES("12","2","1","1","28-77K05A","","2","2021-03-07 04:32:10","2021-03-13 17:05:23");
INSERT INTO product_variants VALUES("13","2","2","2","29-77K05A","","1","2021-03-07 04:32:10","2021-03-13 17:05:23");
INSERT INTO product_variants VALUES("14","2","3","3","30-77K05A","","0","2021-03-07 04:32:10","2021-03-19 12:42:19");
INSERT INTO product_variants VALUES("15","2","4","4","31-77K05A","","3","2021-03-07 04:32:10","2021-03-13 17:05:23");
INSERT INTO product_variants VALUES("16","2","5","5","32-77K05A","","2","2021-03-07 04:32:10","2021-03-19 12:16:09");
INSERT INTO product_variants VALUES("17","3","6","1","33-002B4H","","3","2021-03-07 11:57:45","2021-03-13 17:05:07");
INSERT INTO product_variants VALUES("18","3","7","2","34-002B4H","","3","2021-03-07 11:57:45","2021-03-13 17:05:07");
INSERT INTO product_variants VALUES("19","3","8","3","35-002B4H","","2","2021-03-07 11:57:45","2021-03-13 17:05:07");
INSERT INTO product_variants VALUES("20","3","9","4","36-002B4H","","2","2021-03-07 11:57:45","2021-03-13 17:05:07");
INSERT INTO product_variants VALUES("21","3","10","5","37-002B4H","","1","2021-03-07 11:57:45","2021-03-13 17:05:07");
INSERT INTO product_variants VALUES("22","3","11","6","38-002B4H","","1","2021-03-07 11:57:45","2021-03-13 17:05:07");
INSERT INTO product_variants VALUES("23","3","12","7","28-32-002B4H","","12","2021-03-07 12:22:50","2021-03-13 16:53:21");
INSERT INTO product_variants VALUES("24","4","13","1","Size 28-32-1B1K03G","","9","2021-03-07 12:27:49","2021-03-19 12:09:11");
INSERT INTO product_variants VALUES("25","4","14","2","Size 33-38-1B1K03G","","12","2021-03-07 12:27:49","2021-03-13 16:53:10");
INSERT INTO product_variants VALUES("26","5","13","1","Size 28-32-70B70K05A","","11","2021-03-07 12:31:43","2021-03-19 07:01:58");
INSERT INTO product_variants VALUES("27","5","14","2","Size 33-38-70B70K05A","","11","2021-03-07 12:31:43","2021-03-19 07:32:49");
INSERT INTO product_variants VALUES("28","6","13","1","Size 28-32-7B7K04C","","12","2021-03-07 12:33:28","2021-03-13 16:52:58");
INSERT INTO product_variants VALUES("29","6","14","2","Size 33-38-7B7K04C","","12","2021-03-07 12:33:28","2021-03-13 16:52:58");
INSERT INTO product_variants VALUES("30","7","13","1","Size 28-32-34B34K05C","","12","2021-03-07 12:35:31","2021-03-13 16:52:58");
INSERT INTO product_variants VALUES("31","7","14","2","Size 33-38-34B34K05C","","12","2021-03-07 12:35:31","2021-03-13 16:52:58");
INSERT INTO product_variants VALUES("32","8","13","1","Size 28-32-80B80K05E","","12","2021-03-07 12:39:56","2021-03-13 16:52:58");
INSERT INTO product_variants VALUES("33","8","14","2","Size 33-38-80B80K05E","","12","2021-03-07 12:39:56","2021-03-13 16:52:58");
INSERT INTO product_variants VALUES("34","9","15","1","40-88C05B","","3","2021-03-07 12:42:01","2021-03-13 16:52:58");
INSERT INTO product_variants VALUES("35","9","16","2","42-88C05B","","2","2021-03-07 12:42:01","2021-03-13 16:52:58");
INSERT INTO product_variants VALUES("36","9","17","3","44-88C05B","","1","2021-03-07 12:42:01","2021-03-13 16:52:58");
INSERT INTO product_variants VALUES("37","10","13","1","Size 28-32-31B31K03H","","12","2021-03-07 12:43:27","2021-03-13 16:52:58");
INSERT INTO product_variants VALUES("38","10","14","2","Size 33-38-31B31K03H","","12","2021-03-07 12:43:27","2021-03-13 16:52:58");
INSERT INTO product_variants VALUES("39","11","13","1","Size 28-32-37B37K12H","","12","2021-03-07 12:44:54","2021-03-13 16:52:58");
INSERT INTO product_variants VALUES("40","11","14","2","Size 33-38-37B37K12H","","12","2021-03-07 12:44:54","2021-03-13 16:52:58");
INSERT INTO product_variants VALUES("41","106","18","1","Beige-EBH-88500462","","12","2021-03-25 12:50:48","2021-03-26 05:53:05");
INSERT INTO product_variants VALUES("42","106","19","2","Peanut-EBH-88500462","","12","2021-03-25 12:50:48","2021-03-26 05:53:05");
INSERT INTO product_variants VALUES("43","106","20","3","Khaky-EBH-88500462","","12","2021-03-25 12:50:48","2021-03-26 05:53:05");
INSERT INTO product_variants VALUES("44","106","21","4","Deep Taupe-EBH-88500462","","12","2021-03-25 12:50:48","2021-03-26 05:53:05");
INSERT INTO product_variants VALUES("45","108","20","1","Khaky-RHT-01297308","","12","2021-03-25 12:54:12","2021-03-26 05:53:05");
INSERT INTO product_variants VALUES("46","108","22","2","Coklat Muda-RHT-01297308","","12","2021-03-25 12:54:12","2021-03-26 05:53:05");
INSERT INTO product_variants VALUES("47","108","23","3","Brown Morris-RHT-01297308","","12","2021-03-25 12:54:12","2021-03-26 05:53:05");
INSERT INTO product_variants VALUES("48","108","24","4","Black-RHT-01297308","","12","2021-03-25 12:54:12","2021-03-26 05:53:05");



CREATE TABLE `product_warehouse` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) NOT NULL,
  `qty` double NOT NULL,
  `price` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=245 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO product_warehouse VALUES("1","1","6","1","3","","2021-03-07 04:05:58","2021-03-13 17:05:35");
INSERT INTO product_warehouse VALUES("2","1","11","1","1","","2021-03-07 04:10:18","2021-03-13 17:05:35");
INSERT INTO product_warehouse VALUES("3","1","10","1","1","","2021-03-07 04:10:18","2021-03-13 17:05:35");
INSERT INTO product_warehouse VALUES("4","1","9","1","2","","2021-03-07 04:10:18","2021-03-13 17:05:35");
INSERT INTO product_warehouse VALUES("5","1","8","1","2","","2021-03-07 04:10:18","2021-03-13 17:05:35");
INSERT INTO product_warehouse VALUES("6","1","7","1","3","","2021-03-07 04:10:18","2021-03-13 17:05:35");
INSERT INTO product_warehouse VALUES("7","2","5","1","2","","2021-03-07 04:37:40","2021-03-19 12:16:09");
INSERT INTO product_warehouse VALUES("8","2","3","1","0","","2021-03-07 04:37:40","2021-03-19 12:42:19");
INSERT INTO product_warehouse VALUES("9","2","2","1","1","","2021-03-07 04:37:40","2021-03-13 17:05:23");
INSERT INTO product_warehouse VALUES("10","2","1","1","2","","2021-03-07 04:37:40","2021-03-13 17:05:23");
INSERT INTO product_warehouse VALUES("11","3","8","1","2","","2021-03-07 12:10:29","2021-03-13 17:05:07");
INSERT INTO product_warehouse VALUES("12","3","7","1","3","","2021-03-07 12:10:29","2021-03-13 17:05:07");
INSERT INTO product_warehouse VALUES("13","3","6","1","3","","2021-03-07 12:10:29","2021-03-13 17:05:07");
INSERT INTO product_warehouse VALUES("14","3","11","1","1","","2021-03-07 12:17:48","2021-03-13 17:05:07");
INSERT INTO product_warehouse VALUES("15","3","10","1","1","","2021-03-07 12:17:48","2021-03-13 17:05:07");
INSERT INTO product_warehouse VALUES("16","3","9","1","2","","2021-03-07 12:17:48","2021-03-13 17:05:07");
INSERT INTO product_warehouse VALUES("17","3","12","1","12","","2021-03-07 12:24:58","2021-03-13 16:53:21");
INSERT INTO product_warehouse VALUES("18","4","14","1","12","","2021-03-07 12:29:35","2021-03-13 16:53:10");
INSERT INTO product_warehouse VALUES("19","4","13","1","9","","2021-03-07 12:29:35","2021-03-19 12:09:11");
INSERT INTO product_warehouse VALUES("20","6","14","1","12","","2021-03-07 12:52:27","2021-03-13 16:52:58");
INSERT INTO product_warehouse VALUES("21","6","13","1","12","","2021-03-07 12:52:27","2021-03-13 16:52:58");
INSERT INTO product_warehouse VALUES("22","7","14","1","12","","2021-03-07 12:52:27","2021-03-13 16:52:58");
INSERT INTO product_warehouse VALUES("23","7","13","1","12","","2021-03-07 12:52:27","2021-03-13 16:52:58");
INSERT INTO product_warehouse VALUES("24","8","13","1","12","","2021-03-07 12:52:27","2021-03-13 16:52:58");
INSERT INTO product_warehouse VALUES("25","8","14","1","12","","2021-03-07 12:52:27","2021-03-13 16:52:58");
INSERT INTO product_warehouse VALUES("26","9","15","1","3","","2021-03-07 12:52:27","2021-03-13 16:52:58");
INSERT INTO product_warehouse VALUES("27","9","16","1","2","","2021-03-07 12:52:27","2021-03-13 16:52:58");
INSERT INTO product_warehouse VALUES("28","9","17","1","1","","2021-03-07 12:52:27","2021-03-13 16:52:58");
INSERT INTO product_warehouse VALUES("29","10","14","1","12","","2021-03-07 12:52:27","2021-03-13 16:52:58");
INSERT INTO product_warehouse VALUES("30","10","13","1","12","","2021-03-07 12:52:27","2021-03-13 16:52:58");
INSERT INTO product_warehouse VALUES("31","11","14","1","12","","2021-03-07 12:52:27","2021-03-13 16:52:58");
INSERT INTO product_warehouse VALUES("32","11","13","1","12","","2021-03-07 12:52:27","2021-03-13 16:52:58");
INSERT INTO product_warehouse VALUES("33","5","14","1","11","","2021-03-07 12:59:05","2021-03-19 07:32:49");
INSERT INTO product_warehouse VALUES("34","5","13","1","11","","2021-03-07 12:59:05","2021-03-19 07:01:58");
INSERT INTO product_warehouse VALUES("35","2","4","1","3","","2021-03-07 13:03:54","2021-03-13 17:05:23");
INSERT INTO product_warehouse VALUES("36","26","","1","21","","2021-03-08 06:01:30","2021-03-21 09:12:56");
INSERT INTO product_warehouse VALUES("37","25","","1","33","","2021-03-08 06:01:30","2021-03-20 06:28:22");
INSERT INTO product_warehouse VALUES("38","24","","1","12","","2021-03-08 06:01:30","2021-03-13 17:02:36");
INSERT INTO product_warehouse VALUES("39","23","","1","11","","2021-03-08 06:01:30","2021-03-21 09:55:19");
INSERT INTO product_warehouse VALUES("40","22","","1","42","","2021-03-08 06:01:30","2021-03-22 05:01:52");
INSERT INTO product_warehouse VALUES("41","21","","1","22","","2021-03-08 06:01:30","2021-03-22 04:56:55");
INSERT INTO product_warehouse VALUES("42","20","","1","23","","2021-03-08 06:01:30","2021-03-19 07:36:09");
INSERT INTO product_warehouse VALUES("43","19","","1","24","","2021-03-08 06:01:30","2021-03-13 17:02:36");
INSERT INTO product_warehouse VALUES("44","18","","1","23","","2021-03-08 06:01:30","2021-03-21 09:06:07");
INSERT INTO product_warehouse VALUES("45","17","","1","12","","2021-03-08 06:01:30","2021-03-13 17:02:36");
INSERT INTO product_warehouse VALUES("46","15","","1","4","","2021-03-08 06:01:30","2021-03-19 12:42:19");
INSERT INTO product_warehouse VALUES("47","16","","1","7","","2021-03-08 06:01:30","2021-03-21 09:27:54");
INSERT INTO product_warehouse VALUES("48","14","","1","5","","2021-03-08 06:01:30","2021-03-21 09:06:07");
INSERT INTO product_warehouse VALUES("49","13","","1","12","","2021-03-08 06:01:30","2021-03-13 17:02:36");
INSERT INTO product_warehouse VALUES("50","12","","1","10","","2021-03-08 06:01:30","2021-03-19 09:43:13");
INSERT INTO product_warehouse VALUES("51","29","","1","40","","2021-03-08 09:03:20","2021-03-22 05:06:25");
INSERT INTO product_warehouse VALUES("52","28","","1","29","","2021-03-08 09:07:20","2021-03-25 12:17:20");
INSERT INTO product_warehouse VALUES("53","27","","1","30","","2021-03-08 09:07:20","2021-03-21 09:06:07");
INSERT INTO product_warehouse VALUES("54","30","","1","55","","2021-03-08 09:07:20","2021-03-21 09:44:48");
INSERT INTO product_warehouse VALUES("55","39","","1","6","","2021-03-09 07:30:30","2021-03-25 08:14:24");
INSERT INTO product_warehouse VALUES("56","38","","1","9","","2021-03-09 07:30:30","2021-03-24 01:51:16");
INSERT INTO product_warehouse VALUES("57","36","","1","34","","2021-03-09 07:30:30","2021-03-21 09:06:07");
INSERT INTO product_warehouse VALUES("58","37","","1","21","","2021-03-09 07:30:30","2021-03-24 12:10:10");
INSERT INTO product_warehouse VALUES("59","35","","1","35","","2021-03-09 07:30:30","2021-03-21 07:12:04");
INSERT INTO product_warehouse VALUES("60","34","","1","20","","2021-03-09 07:30:30","2021-03-24 12:44:01");
INSERT INTO product_warehouse VALUES("61","32","","1","57","","2021-03-09 10:04:17","2021-03-26 05:02:22");
INSERT INTO product_warehouse VALUES("62","31","","1","78","","2021-03-09 10:04:17","2021-03-22 04:52:02");
INSERT INTO product_warehouse VALUES("63","47","","1","21","","2021-03-09 10:08:33","2021-03-21 09:36:05");
INSERT INTO product_warehouse VALUES("64","46","","1","22","","2021-03-09 10:08:33","2021-03-21 09:55:19");
INSERT INTO product_warehouse VALUES("65","45","","1","24","","2021-03-09 10:08:33","2021-03-13 16:51:44");
INSERT INTO product_warehouse VALUES("66","44","","1","67","","2021-03-09 10:08:33","2021-03-22 04:56:55");
INSERT INTO product_warehouse VALUES("67","43","","1","31","","2021-03-09 10:08:33","2021-03-22 05:06:25");
INSERT INTO product_warehouse VALUES("68","42","","1","44","","2021-03-09 10:08:33","2021-03-22 05:06:25");
INSERT INTO product_warehouse VALUES("69","41","","1","31","","2021-03-09 10:15:07","2021-03-26 05:02:22");
INSERT INTO product_warehouse VALUES("70","33","","1","23","","2021-03-09 10:15:07","2021-03-22 05:01:52");
INSERT INTO product_warehouse VALUES("71","40","","1","46","","2021-03-09 10:15:07","2021-03-21 09:06:07");
INSERT INTO product_warehouse VALUES("72","57","","1","24","","2021-03-13 16:20:46","2021-03-13 16:51:31");
INSERT INTO product_warehouse VALUES("73","56","","1","36","","2021-03-13 16:20:46","2021-03-13 16:51:31");
INSERT INTO product_warehouse VALUES("74","55","","1","33","","2021-03-13 16:20:46","2021-03-21 09:33:23");
INSERT INTO product_warehouse VALUES("75","54","","1","24","","2021-03-13 16:20:46","2021-03-13 16:51:31");
INSERT INTO product_warehouse VALUES("76","53","","1","23","","2021-03-13 16:20:46","2021-03-24 01:51:16");
INSERT INTO product_warehouse VALUES("77","52","","1","81","","2021-03-13 16:20:46","2021-03-21 09:02:08");
INSERT INTO product_warehouse VALUES("78","51","","1","10","","2021-03-13 16:20:46","2021-03-21 09:44:48");
INSERT INTO product_warehouse VALUES("79","50","","1","60","","2021-03-13 16:20:46","2021-03-13 16:51:31");
INSERT INTO product_warehouse VALUES("80","49","","1","43","","2021-03-13 16:20:46","2021-03-25 12:17:44");
INSERT INTO product_warehouse VALUES("81","48","","1","33","","2021-03-13 16:20:46","2021-03-21 09:55:19");
INSERT INTO product_warehouse VALUES("82","66","","1","54","","2021-03-13 16:26:19","2021-03-22 04:55:08");
INSERT INTO product_warehouse VALUES("83","64","","1","12","","2021-03-13 16:26:19","2021-03-13 16:51:18");
INSERT INTO product_warehouse VALUES("84","63","","1","12","","2021-03-13 16:26:19","2021-03-13 16:51:18");
INSERT INTO product_warehouse VALUES("85","62","","1","81","","2021-03-13 16:26:19","2021-03-22 04:55:08");
INSERT INTO product_warehouse VALUES("86","61","","1","69","","2021-03-13 16:26:19","2021-03-21 09:33:23");
INSERT INTO product_warehouse VALUES("87","59","","1","59","","2021-03-13 16:26:19","2021-03-19 07:27:48");
INSERT INTO product_warehouse VALUES("88","60","","1","44","","2021-03-13 16:26:19","2021-03-24 12:39:20");
INSERT INTO product_warehouse VALUES("89","58","","1","84","","2021-03-13 16:26:19","2021-03-25 12:14:40");
INSERT INTO product_warehouse VALUES("90","65","","1","38","","2021-03-13 16:29:04","2021-03-22 05:06:25");
INSERT INTO product_warehouse VALUES("91","71","","1","22","","2021-03-13 16:40:12","2021-03-24 12:10:10");
INSERT INTO product_warehouse VALUES("92","70","","1","24","","2021-03-13 16:40:12","2021-03-13 16:51:05");
INSERT INTO product_warehouse VALUES("93","69","","1","12","","2021-03-13 16:40:12","2021-03-13 16:51:05");
INSERT INTO product_warehouse VALUES("94","68","","1","36","","2021-03-13 16:40:12","2021-03-13 16:51:05");
INSERT INTO product_warehouse VALUES("95","67","","1","55","","2021-03-13 16:40:12","2021-03-22 04:54:42");
INSERT INTO product_warehouse VALUES("96","72","","1","12","","2021-03-25 13:05:22","2021-03-25 13:05:22");
INSERT INTO product_warehouse VALUES("97","78","","1","6","","2021-03-25 13:05:22","2021-03-25 13:05:22");
INSERT INTO product_warehouse VALUES("98","77","","1","12","","2021-03-25 13:05:22","2021-03-25 13:05:22");
INSERT INTO product_warehouse VALUES("99","76","","1","12","","2021-03-25 13:05:22","2021-03-25 13:05:22");
INSERT INTO product_warehouse VALUES("100","73","","1","6","","2021-03-25 13:05:22","2021-03-25 13:05:22");
INSERT INTO product_warehouse VALUES("101","75","","1","12","","2021-03-25 13:05:22","2021-03-25 13:05:22");
INSERT INTO product_warehouse VALUES("102","74","","1","12","","2021-03-25 13:05:22","2021-03-25 13:05:22");
INSERT INTO product_warehouse VALUES("103","109","","1","72","","2021-03-26 05:37:34","2021-03-26 05:37:34");
INSERT INTO product_warehouse VALUES("104","110","","1","11","","2021-03-26 05:37:34","2021-03-26 05:37:34");
INSERT INTO product_warehouse VALUES("105","95","","1","9","","2021-03-26 05:37:34","2021-03-26 05:37:34");
INSERT INTO product_warehouse VALUES("106","94","","1","21","","2021-03-26 05:37:34","2021-03-26 05:37:34");
INSERT INTO product_warehouse VALUES("107","113","","1","12","","2021-03-26 05:44:42","2021-03-26 05:44:42");
INSERT INTO product_warehouse VALUES("108","97","","1","54","","2021-03-26 05:44:42","2021-03-26 05:44:42");
INSERT INTO product_warehouse VALUES("109","115","","1","12","","2021-03-26 05:44:42","2021-03-26 05:44:42");
INSERT INTO product_warehouse VALUES("110","114","","1","6","","2021-03-26 05:44:42","2021-03-26 05:44:42");
INSERT INTO product_warehouse VALUES("111","112","","1","27","","2021-03-26 05:44:42","2021-03-26 05:44:42");
INSERT INTO product_warehouse VALUES("112","111","","1","12","","2021-03-26 05:44:42","2021-03-26 05:44:42");
INSERT INTO product_warehouse VALUES("113","96","","1","45","","2021-03-26 05:44:42","2021-03-26 05:44:42");
INSERT INTO product_warehouse VALUES("114","102","","1","22","","2021-03-26 05:48:12","2021-03-26 05:48:12");
INSERT INTO product_warehouse VALUES("115","101","","1","6","","2021-03-26 05:48:12","2021-03-26 05:48:12");
INSERT INTO product_warehouse VALUES("116","100","","1","9","","2021-03-26 05:48:12","2021-03-26 05:48:12");
INSERT INTO product_warehouse VALUES("117","99","","1","54","","2021-03-26 05:48:12","2021-03-26 05:48:12");
INSERT INTO product_warehouse VALUES("118","98","","1","9","","2021-03-26 05:48:12","2021-03-26 05:48:12");
INSERT INTO product_warehouse VALUES("119","108","22","1","12","","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_warehouse VALUES("120","108","24","1","12","","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_warehouse VALUES("121","108","23","1","12","","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_warehouse VALUES("122","108","20","1","12","","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_warehouse VALUES("123","107","","1","18","","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_warehouse VALUES("124","104","","1","36","","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_warehouse VALUES("125","106","18","1","12","","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_warehouse VALUES("126","106","21","1","12","","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_warehouse VALUES("127","106","20","1","12","","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_warehouse VALUES("128","106","19","1","12","","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_warehouse VALUES("129","105","","1","21","","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_warehouse VALUES("130","116","","1","18","","2021-03-26 05:53:05","2021-03-26 05:53:05");
INSERT INTO product_warehouse VALUES("131","85","","1","174","","2021-03-26 06:11:15","2021-03-26 06:11:15");
INSERT INTO product_warehouse VALUES("132","84","","1","120","","2021-03-26 06:11:15","2021-03-26 06:11:15");
INSERT INTO product_warehouse VALUES("133","83","","1","40","","2021-03-26 06:12:37","2021-03-26 06:12:37");
INSERT INTO product_warehouse VALUES("134","82","","1","112","","2021-03-26 06:12:37","2021-03-26 06:12:37");
INSERT INTO product_warehouse VALUES("135","88","","1","6","","2021-03-26 06:14:34","2021-03-26 06:14:59");
INSERT INTO product_warehouse VALUES("136","86","","1","12","","2021-03-26 06:14:34","2021-03-26 06:14:59");
INSERT INTO product_warehouse VALUES("137","87","","1","12","","2021-03-26 06:14:34","2021-03-26 06:14:59");
INSERT INTO product_warehouse VALUES("138","92","","1","108","","2021-03-26 06:18:33","2021-04-05 03:44:22");
INSERT INTO product_warehouse VALUES("139","91","","1","108","","2021-03-26 06:18:33","2021-04-05 03:44:22");
INSERT INTO product_warehouse VALUES("140","90","","1","108","","2021-03-26 06:18:33","2021-04-05 03:44:22");
INSERT INTO product_warehouse VALUES("141","89","","1","216","","2021-03-26 06:18:33","2021-04-05 03:44:22");
INSERT INTO product_warehouse VALUES("142","93","","1","480","","2021-03-26 06:20:29","2021-03-26 06:20:29");
INSERT INTO product_warehouse VALUES("143","117","","1","50","","2021-03-26 06:26:19","2021-03-26 06:26:19");
INSERT INTO product_warehouse VALUES("144","118","","1","20","","2021-03-26 06:26:19","2021-03-26 06:26:19");
INSERT INTO product_warehouse VALUES("145","121","","1","144","","2021-03-26 06:46:41","2021-03-26 06:46:41");
INSERT INTO product_warehouse VALUES("146","120","","1","12","","2021-03-26 06:46:41","2021-03-26 06:46:41");
INSERT INTO product_warehouse VALUES("147","122","","1","180","","2021-03-26 06:46:41","2021-03-26 06:46:41");
INSERT INTO product_warehouse VALUES("148","119","","1","168","","2021-03-26 06:46:41","2021-03-26 06:46:41");
INSERT INTO product_warehouse VALUES("149","126","","1","4","","2021-03-26 13:02:18","2021-03-26 13:02:18");
INSERT INTO product_warehouse VALUES("150","129","","1","4","","2021-03-26 13:02:18","2021-03-26 13:02:18");
INSERT INTO product_warehouse VALUES("151","130","","1","4","","2021-03-26 13:02:18","2021-03-26 13:02:18");
INSERT INTO product_warehouse VALUES("152","128","","1","4","","2021-03-26 13:02:18","2021-03-26 13:02:18");
INSERT INTO product_warehouse VALUES("153","127","","1","4","","2021-03-26 13:02:18","2021-03-26 13:02:18");
INSERT INTO product_warehouse VALUES("154","125","","1","3","","2021-03-26 13:02:18","2021-03-26 13:02:18");
INSERT INTO product_warehouse VALUES("155","124","","1","4","","2021-03-26 13:02:18","2021-03-26 13:02:18");
INSERT INTO product_warehouse VALUES("156","123","","1","4","","2021-03-26 13:02:18","2021-03-26 13:02:18");
INSERT INTO product_warehouse VALUES("157","135","","1","10","","2021-04-05 03:28:05","2021-04-05 03:28:05");
INSERT INTO product_warehouse VALUES("158","132","","1","10","","2021-04-05 03:28:05","2021-04-05 03:28:05");
INSERT INTO product_warehouse VALUES("159","136","","1","10","","2021-04-05 03:28:05","2021-04-05 03:28:05");
INSERT INTO product_warehouse VALUES("160","134","","1","10","","2021-04-05 03:28:05","2021-04-05 03:28:05");
INSERT INTO product_warehouse VALUES("161","133","","1","10","","2021-04-05 03:28:05","2021-04-05 03:28:05");
INSERT INTO product_warehouse VALUES("162","131","","1","10","","2021-04-05 03:28:05","2021-04-05 03:28:05");
INSERT INTO product_warehouse VALUES("163","138","","1","120","","2021-04-05 03:43:24","2021-04-05 03:43:24");
INSERT INTO product_warehouse VALUES("164","137","","1","288","","2021-04-05 03:43:24","2021-04-05 03:43:24");
INSERT INTO product_warehouse VALUES("165","142","","1","24","","2021-04-05 03:52:49","2021-04-05 03:52:49");
INSERT INTO product_warehouse VALUES("166","141","","1","60","","2021-04-05 03:52:49","2021-04-05 03:52:49");
INSERT INTO product_warehouse VALUES("167","140","","1","132","","2021-04-05 03:52:49","2021-04-05 03:52:49");
INSERT INTO product_warehouse VALUES("168","139","","1","132","","2021-04-05 03:52:49","2021-04-05 03:52:49");
INSERT INTO product_warehouse VALUES("169","153","","1","24","","2021-04-05 07:34:32","2021-04-05 07:38:35");
INSERT INTO product_warehouse VALUES("170","156","","1","24","","2021-04-05 07:34:32","2021-04-05 07:38:35");
INSERT INTO product_warehouse VALUES("171","155","","1","6","","2021-04-05 07:34:32","2021-04-05 07:38:35");
INSERT INTO product_warehouse VALUES("172","152","","1","24","","2021-04-05 07:34:32","2021-04-05 07:38:35");
INSERT INTO product_warehouse VALUES("173","151","","1","24","","2021-04-05 07:34:32","2021-04-05 07:38:35");
INSERT INTO product_warehouse VALUES("174","150","","1","36","","2021-04-05 07:34:32","2021-04-05 07:38:35");
INSERT INTO product_warehouse VALUES("175","154","","1","12","","2021-04-05 07:34:32","2021-04-05 07:38:35");
INSERT INTO product_warehouse VALUES("176","149","","1","36","","2021-04-05 07:34:32","2021-04-05 07:38:35");
INSERT INTO product_warehouse VALUES("177","148","","1","36","","2021-04-05 07:34:32","2021-04-05 07:38:35");
INSERT INTO product_warehouse VALUES("178","146","","1","36","","2021-04-05 07:34:32","2021-04-05 07:38:35");
INSERT INTO product_warehouse VALUES("179","144","","1","36","","2021-04-05 07:34:32","2021-04-05 07:38:35");
INSERT INTO product_warehouse VALUES("180","147","","1","36","","2021-04-05 07:34:32","2021-04-05 07:38:35");
INSERT INTO product_warehouse VALUES("181","145","","1","36","","2021-04-05 07:34:32","2021-04-05 07:38:35");
INSERT INTO product_warehouse VALUES("182","143","","1","36","","2021-04-05 07:34:32","2021-04-05 07:38:35");
INSERT INTO product_warehouse VALUES("183","157","","1","24","","2021-04-05 07:38:17","2021-04-05 07:38:35");
INSERT INTO product_warehouse VALUES("184","168","","1","44","","2021-04-11 04:23:03","2021-04-11 04:23:03");
INSERT INTO product_warehouse VALUES("185","167","","1","12","","2021-04-11 04:23:03","2021-04-11 04:23:03");
INSERT INTO product_warehouse VALUES("186","166","","1","24","","2021-04-11 04:23:03","2021-04-11 04:23:03");
INSERT INTO product_warehouse VALUES("187","165","","1","72","","2021-04-11 04:23:03","2021-04-11 04:23:03");
INSERT INTO product_warehouse VALUES("188","164","","1","24","","2021-04-11 04:23:03","2021-04-11 04:23:03");
INSERT INTO product_warehouse VALUES("189","170","","1","42","","2021-04-11 04:45:52","2021-04-11 04:45:52");
INSERT INTO product_warehouse VALUES("190","171","","1","24","","2021-04-11 04:45:52","2021-04-11 04:45:52");
INSERT INTO product_warehouse VALUES("191","169","","1","72","","2021-04-11 04:45:52","2021-04-11 04:45:52");
INSERT INTO product_warehouse VALUES("192","176","","1","48","","2021-04-16 08:22:36","2021-04-16 08:22:36");
INSERT INTO product_warehouse VALUES("193","175","","1","96","","2021-04-16 08:22:36","2021-04-16 08:22:36");
INSERT INTO product_warehouse VALUES("194","174","","1","84","","2021-04-16 08:22:36","2021-04-16 08:22:36");
INSERT INTO product_warehouse VALUES("195","173","","1","12","","2021-04-16 08:22:36","2021-04-16 08:22:36");
INSERT INTO product_warehouse VALUES("196","172","","1","72","","2021-04-16 08:22:36","2021-04-16 08:22:36");
INSERT INTO product_warehouse VALUES("197","181","","1","36","","2021-04-16 08:27:17","2021-04-16 08:27:17");
INSERT INTO product_warehouse VALUES("198","180","","1","36","","2021-04-16 08:27:17","2021-04-16 08:27:17");
INSERT INTO product_warehouse VALUES("199","182","","1","36","","2021-04-16 08:27:17","2021-04-16 08:27:17");
INSERT INTO product_warehouse VALUES("200","179","","1","72","","2021-04-16 08:27:17","2021-04-16 08:27:17");
INSERT INTO product_warehouse VALUES("201","184","","1","36","","2021-04-16 12:21:34","2021-04-16 12:23:59");
INSERT INTO product_warehouse VALUES("202","188","","1","60","","2021-04-16 12:21:34","2021-04-16 12:23:59");
INSERT INTO product_warehouse VALUES("203","187","","1","48","","2021-04-16 12:21:34","2021-04-16 12:23:59");
INSERT INTO product_warehouse VALUES("204","186","","1","60","","2021-04-16 12:21:34","2021-04-16 12:23:59");
INSERT INTO product_warehouse VALUES("205","185","","1","36","","2021-04-16 12:21:34","2021-04-16 12:23:59");
INSERT INTO product_warehouse VALUES("206","183","","1","180","","2021-04-16 12:21:34","2021-04-16 12:23:59");
INSERT INTO product_warehouse VALUES("207","192","","1","40","","2021-04-16 12:31:45","2021-04-16 12:31:45");
INSERT INTO product_warehouse VALUES("208","190","","1","96","","2021-04-16 12:31:45","2021-04-16 12:31:45");
INSERT INTO product_warehouse VALUES("209","189","","1","84","","2021-04-16 12:31:45","2021-04-16 12:31:45");
INSERT INTO product_warehouse VALUES("210","191","","1","240","","2021-04-16 12:31:45","2021-04-16 12:31:45");
INSERT INTO product_warehouse VALUES("211","201","","1","60","","2021-04-17 06:27:23","2021-04-17 06:27:23");
INSERT INTO product_warehouse VALUES("212","200","","1","60","","2021-04-17 06:27:23","2021-04-17 06:27:23");
INSERT INTO product_warehouse VALUES("213","199","","1","36","","2021-04-17 06:27:23","2021-04-17 06:27:23");
INSERT INTO product_warehouse VALUES("214","198","","1","72","","2021-04-17 06:27:23","2021-04-17 06:27:23");
INSERT INTO product_warehouse VALUES("215","197","","1","12","","2021-04-17 06:27:23","2021-04-17 06:27:23");
INSERT INTO product_warehouse VALUES("216","196","","1","48","","2021-04-17 06:27:23","2021-04-17 06:27:23");
INSERT INTO product_warehouse VALUES("217","195","","1","48","","2021-04-17 06:27:23","2021-04-17 06:27:23");
INSERT INTO product_warehouse VALUES("218","194","","1","96","","2021-04-17 06:27:23","2021-04-17 06:27:23");
INSERT INTO product_warehouse VALUES("219","193","","1","96","","2021-04-17 06:27:23","2021-04-17 06:27:23");
INSERT INTO product_warehouse VALUES("220","202","","1","180","","2021-04-17 06:30:19","2021-04-17 06:30:19");
INSERT INTO product_warehouse VALUES("221","203","","1","40","","2021-04-17 06:57:49","2021-04-17 06:57:49");
INSERT INTO product_warehouse VALUES("222","204","","1","16","","2021-04-17 06:57:49","2021-04-17 06:57:49");
INSERT INTO product_warehouse VALUES("223","206","","1","240","","2021-04-17 07:15:41","2021-04-17 07:15:41");
INSERT INTO product_warehouse VALUES("224","205","","1","480","","2021-04-17 07:15:41","2021-04-17 07:15:41");
INSERT INTO product_warehouse VALUES("225","207","","1","156","","2021-04-18 07:57:22","2021-04-18 07:58:26");
INSERT INTO product_warehouse VALUES("226","210","","1","36","","2021-04-18 07:57:22","2021-04-18 07:58:26");
INSERT INTO product_warehouse VALUES("227","209","","1","12","","2021-04-18 07:57:22","2021-04-18 07:58:26");
INSERT INTO product_warehouse VALUES("228","208","","1","12","","2021-04-18 07:57:22","2021-04-18 07:58:26");
INSERT INTO product_warehouse VALUES("229","212","","1","2","","2021-04-18 08:12:35","2021-04-18 08:13:19");
INSERT INTO product_warehouse VALUES("230","214","","1","24","","2021-04-18 08:12:35","2021-04-18 08:12:35");
INSERT INTO product_warehouse VALUES("231","213","","1","48","","2021-04-18 08:12:35","2021-04-18 08:12:35");
INSERT INTO product_warehouse VALUES("232","211","","1","0","","2021-04-18 08:12:35","2021-04-18 08:13:19");
INSERT INTO product_warehouse VALUES("233","215","","1","200","","2021-04-18 08:20:40","2021-04-18 08:22:19");
INSERT INTO product_warehouse VALUES("234","216","","1","60","","2021-04-18 08:22:19","2021-04-18 08:22:19");
INSERT INTO product_warehouse VALUES("235","217","","1","72","","2021-04-18 08:22:19","2021-04-18 08:22:19");
INSERT INTO product_warehouse VALUES("236","225","","1","60","","2021-04-18 08:43:10","2021-04-18 08:43:10");
INSERT INTO product_warehouse VALUES("237","224","","1","36","","2021-04-18 08:43:10","2021-04-18 08:43:10");
INSERT INTO product_warehouse VALUES("238","223","","1","24","","2021-04-18 08:43:10","2021-04-18 08:43:10");
INSERT INTO product_warehouse VALUES("239","220","","1","120","","2021-04-18 08:43:10","2021-04-18 08:43:10");
INSERT INTO product_warehouse VALUES("240","222","","1","60","","2021-04-18 08:43:10","2021-04-18 08:43:10");
INSERT INTO product_warehouse VALUES("241","218","","1","120","","2021-04-18 08:43:10","2021-04-18 08:43:10");
INSERT INTO product_warehouse VALUES("242","221","","1","60","","2021-04-18 08:43:10","2021-04-18 08:43:10");
INSERT INTO product_warehouse VALUES("243","219","","1","120","","2021-04-18 08:43:10","2021-04-18 08:43:10");
INSERT INTO product_warehouse VALUES("244","226","","1","100","","2021-04-19 06:48:21","2021-04-19 06:48:21");



CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `barcode_symbology` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `purchase_unit_id` int(11) NOT NULL,
  `sale_unit_id` int(11) NOT NULL,
  `cost` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `qty` double DEFAULT NULL,
  `alert_quantity` double DEFAULT NULL,
  `promotion` tinyint(4) DEFAULT NULL,
  `promotion_price` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `starting_date` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_date` date DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `tax_method` int(11) DEFAULT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_variant` tinyint(1) DEFAULT NULL,
  `is_diffPrice` tinyint(1) DEFAULT NULL,
  `featured` tinyint(4) DEFAULT NULL,
  `product_list` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty_list` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price_list` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_details` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=227 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO products VALUES("1","Cardinal Chinos Pendek size Jumbo","77B05A","standard","C128","1","4","1","1","1","188100","283000","12","","","","","","","1","zummXD2dvAtI.png","","1","0","0","","","","","1","2021-03-06 12:48:11","2021-03-13 17:05:35");
INSERT INTO products VALUES("2","Cardinal Chinos Pendek size Reguler","77K05A","standard","C128","1","4","1","1","1","188100","283000","8","","","","","","","1","zummXD2dvAtI.png","","1","","","","","","","1","2021-03-07 04:32:10","2021-03-19 12:42:19");
INSERT INTO products VALUES("3","Cardinal Chinos Telur Asin","002B4H","standard","C128","1","6","1","1","1","224400","337000","24","","","","","","","1","zummXD2dvAtI.png","","1","0","0","","","","","1","2021-03-07 11:57:45","2021-03-13 17:05:07");
INSERT INTO products VALUES("4","Cardinal Chinos Cappucino","1B1K03G","standard","C128","1","6","1","1","1","235400","354000","21","","","","","","","1","zummXD2dvAtI.png","","1","","","","","","","1","2021-03-07 12:27:49","2021-03-19 12:09:11");
INSERT INTO products VALUES("5","Cardinal Bermuda Cream","70B70K05A","standard","C128","1","6","1","1","1","235400","354000","22","","","","","","","1","zummXD2dvAtI.png","","1","0","0","","","","","1","2021-03-07 12:31:43","2021-03-19 07:32:49");
INSERT INTO products VALUES("6","Cardinal Chinos Cream","7B7K04C","standard","C128","1","6","1","1","1","235400","354000","24","","","","","","","1","zummXD2dvAtI.png","","1","","","","","","","1","2021-03-07 12:33:28","2021-03-13 16:52:58");
INSERT INTO products VALUES("7","Cardinal Cream Reddish","34B34K05C","standard","C128","1","8","1","1","1","213400","320000","24","","","","","","","1","zummXD2dvAtI.png","","1","","","","","","","1","2021-03-07 12:35:31","2021-03-13 16:52:58");
INSERT INTO products VALUES("8","Cardinal Cream BMD","80B80K05E","standard","C128","1","8","1","1","1","213400","320000","24","","","","","","","1","zummXD2dvAtI.png","","1","","","","","","","1","2021-03-07 12:39:56","2021-03-13 16:52:58");
INSERT INTO products VALUES("9","Cardinal Cream Greenish","88C05B","standard","C128","1","8","1","1","1","224400","337000","6","","","","","","","1","zummXD2dvAtI.png","","1","0","0","","","","","1","2021-03-07 12:42:01","2021-03-13 16:52:58");
INSERT INTO products VALUES("10","Cardinal Coklat Sawo","31B31K03H","standard","C128","1","8","1","1","1","235400","354000","24","","","","","","","1","zummXD2dvAtI.png","","1","","","","","","","1","2021-03-07 12:43:27","2021-03-13 16:52:58");
INSERT INTO products VALUES("11","Cardinal Khaky V Houtten","37B37K12H","standard","C128","1","8","1","1","1","235400","354000","24","","","","","","","1","zummXD2dvAtI.png","","1","","","","","","","1","2021-03-07 12:44:54","2021-03-13 16:52:58");
INSERT INTO products VALUES("12","Jacket Nylon Hoodie","ETU-22679100","standard","C128","2","18","1","1","1","205000","350000","10","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-08 04:11:28","2021-03-19 09:43:12");
INSERT INTO products VALUES("13","Jacket Nylon Hoodie Jumbo","EIA-19194328","standard","C128","2","18","1","1","1","210000","360000","12","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-08 04:27:35","2021-03-13 17:02:36");
INSERT INTO products VALUES("14","Jacket Nylon Non Hoodie","ETH-39164975","standard","C128","2","18","1","1","1","200000","340000","5","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-08 04:30:16","2021-03-21 09:06:07");
INSERT INTO products VALUES("15","Jacket Nylon Parka non Hoodie","ETH-50629972","standard","C128","2","18","1","1","1","200000","340000","4","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-08 04:31:05","2021-03-19 12:42:19");
INSERT INTO products VALUES("16","Jacket Nylon non Hoodie Jumbo","ETU-99202136","standard","C128","2","18","1","1","1","205000","350000","7","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-08 04:39:56","2021-03-21 09:27:54");
INSERT INTO products VALUES("17","Jacket Nylon Parka non Hoodie Jumbo","ETU-54046632","standard","C128","2","18","1","1","1","205000","350000","12","","","","","","","1","zummXD2dvAtI.png","","","0","0","","","","","1","2021-03-08 04:42:31","2021-03-13 17:02:36");
INSERT INTO products VALUES("18","Celana Flui Depan + Sabuk","BUS-86021543","standard","C128","2","20","1","1","1","125000","210000","23","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-08 04:57:16","2021-03-21 09:06:07");
INSERT INTO products VALUES("19","Celana Panjang Ban Karet","BPA-48497730","standard","C128","2","20","1","1","1","117500","Rp 200.000","24","","","","","","","1","zummXD2dvAtI.png","","","0","0","","","","","1","2021-03-08 05:01:59","2021-03-13 17:02:36");
INSERT INTO products VALUES("20","Celana Ban Karet Jumbo","BUB-26734309","standard","C128","2","20","1","1","1","122500","210000","23","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-08 05:03:36","2021-03-19 07:36:09");
INSERT INTO products VALUES("21","Overall Hoodie Rok Panjang","ERT-15744368","standard","C128","2","21","1","1","1","170000","280000","22","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-08 05:10:03","2021-03-22 04:56:55");
INSERT INTO products VALUES("22","Overall Rok Panjang","BTS-15779046","standard","C128","2","21","1","1","1","132500","230000","42","","","","","","","1","zummXD2dvAtI.png","","","0","0","","","","","1","2021-03-08 05:33:01","2021-03-22 05:01:52");
INSERT INTO products VALUES("23","Overall Rok Panjang Kancing","BTI-67253220","standard","C128","2","21","1","1","1","135000","230000","11","","","","","","","1","zummXD2dvAtI.png","","","0","0","","","","","1","2021-03-08 05:35:47","2021-03-21 09:55:19");
INSERT INTO products VALUES("24","Overall Rok Panjang Kerah Lebar","EBU-45792811","standard","C128","2","21","1","1","1","155000","250000","12","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-08 05:38:41","2021-03-13 17:02:36");
INSERT INTO products VALUES("25","Rok Panjang Kancing","BTE-49726287","standard","C128","2","22","1","1","1","130000","220000","33","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-08 05:49:14","2021-03-20 06:28:22");
INSERT INTO products VALUES("26","Rok Panjang Tali","BTE-00335202","standard","C128","2","22","1","1","1","130000","220000","21","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-08 05:50:02","2021-03-21 09:12:56");
INSERT INTO products VALUES("27","Celana Panjang Rib Zipper","EEH-80317662","standard","C128","2","23","1","1","1","157500","260000","30","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-08 07:46:32","2021-03-21 09:06:07");
INSERT INTO products VALUES("28","Celana Panjang Rib Zipper Jumbo","EEU-90017459","standard","C128","2","23","1","1","1","162500","260000","29","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-08 07:47:46","2021-03-25 12:17:20");
INSERT INTO products VALUES("29","Celana Rib Zipper Cargo Panjang","ESE-53289203","standard","C128","2","9","1","1","1","180000","290000","40","","","","","","","1","zummXD2dvAtI.png","","","0","0","","","","","1","2021-03-08 07:54:19","2021-03-22 05:06:25");
INSERT INTO products VALUES("30","Celana Rib Zipper Cargo Panjang Jumbo","EPB-77402632","standard","C128","2","9","1","1","1","187000","300000","55","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-08 07:56:39","2021-03-21 09:44:48");
INSERT INTO products VALUES("31","Celana Pendek Rib Printing","BAU-20756978","standard","C128","2","23","1","1","1","105000","190000","78","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-08 09:06:08","2021-03-22 04:52:02");
INSERT INTO products VALUES("32","Celana Pendek Rib Printing Jumbo","BSA-69720331","standard","C128","2","23","1","1","1","110000","200000","57","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-09 06:24:57","2021-03-26 05:02:22");
INSERT INTO products VALUES("33","Celana Rib Pendek Polos","BPT-37124690","standard","C128","2","23","1","1","1","120000","210000","23","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-09 06:28:00","2021-03-22 05:01:52");
INSERT INTO products VALUES("34","Celana Chinos Pendek ROLUN","BUS-32793955","standard","C128","2","4","1","1","1","125000","220000","20","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-09 06:30:23","2021-03-24 12:44:01");
INSERT INTO products VALUES("35","Celana Chinos Pendek ROLUN Jumbo","BTE-07448239","standard","C128","2","4","1","1","1","130000","230000","35","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-09 06:31:54","2021-03-21 07:12:04");
INSERT INTO products VALUES("36","Celana Chinos Panjang ROLUN Jumbo","EEA-48790392","standard","C128","2","6","1","1","1","160000","260000","34","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-09 07:17:52","2021-03-21 09:06:07");
INSERT INTO products VALUES("37","Celana Chinos Panjang ROLUN","EBU-21363531","standard","C128","2","6","1","1","1","155000","250000","21","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-09 07:20:14","2021-03-24 12:10:10");
INSERT INTO products VALUES("38","Celana Chinos Panjang Standard","EEH-48191276","standard","C128","2","6","1","1","1","157500","260000","9","","","","","","","1","zummXD2dvAtI.png","","","0","0","","","","","1","2021-03-09 07:22:05","2021-03-24 01:51:16");
INSERT INTO products VALUES("39","Celana Chinos Panjang Standard Jumbo","EEU-36309694","standard","C128","2","6","1","1","1","162500","260000","6","","","","","","","1","zummXD2dvAtI.png","","","0","0","","","","","1","2021-03-09 07:23:01","2021-03-25 08:14:24");
INSERT INTO products VALUES("40","Celana Rib Zipper Cargo Pendek","EBU-54773682","standard","C128","2","8","1","1","1","155000","250000","46","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-09 09:38:18","2021-03-21 09:06:07");
INSERT INTO products VALUES("41","Celana Rib Zipper Cargo Pendek Jumbo","EEA-82390923","standard","C128","2","8","1","1","1","160000","260000","31","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-09 09:39:04","2021-03-26 05:02:22");
INSERT INTO products VALUES("42","Celana Rib Zipper Pendek","BUS-89372129","standard","C128","2","23","1","1","1","125000","210000","44","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-09 09:50:50","2021-03-22 05:06:25");
INSERT INTO products VALUES("43","Celana Rib Zipper Pendek Jumbo","BTE-40163200","standard","C128","2","23","1","1","1","130000","220000","31","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-09 09:51:37","2021-03-22 05:06:25");
INSERT INTO products VALUES("44","Celana Rib Baby Kanvas","BAH-32610149","standard","C128","2","23","1","1","1","100000","180000","67","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-09 09:53:44","2021-03-22 04:56:55");
INSERT INTO products VALUES("45","Celana Rib Baby Kanvas Jumbo","BAU-32137532","standard","C128","2","23","1","1","1","105000","147000","24","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-09 09:54:27","2021-03-13 16:51:44");
INSERT INTO products VALUES("46","Celana Rib Baby Terry","BBE-28706630","standard","C128","2","23","1","1","1","80000","150000","22","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-09 09:55:40","2021-03-21 09:55:19");
INSERT INTO products VALUES("47","Celana Rib Baby Terry Jumbo","BBI-57139022","standard","C128","2","23","1","1","1","85000","150000","21","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-09 09:56:16","2021-03-21 09:36:05");
INSERT INTO products VALUES("48","Jumper Rolun Standar","BTE-16077405","standard","C128","2","25","1","1","1","130000","220000","33","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-13 15:53:11","2021-03-21 09:55:19");
INSERT INTO products VALUES("49","Jumper Rolun Kombinasi","BTE-20197258","standard","C128","2","25","1","1","1","130000","220000","43","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-13 15:54:26","2021-03-25 12:17:44");
INSERT INTO products VALUES("50","Sweater Hoodie Rolun Kombinasi","BSA-37618609","standard","C128","2","25","1","1","1","110000","190000","60","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-13 15:55:22","2021-03-13 16:51:31");
INSERT INTO products VALUES("51","Sweater Raglan Kombinasi","BAH-01943926","standard","C128","2","25","1","1","1","100000","180000","10","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-13 15:56:16","2021-03-21 09:44:48");
INSERT INTO products VALUES("52","Sweater Rolun non Hoodie","BAA-97658161","standard","C128","2","25","1","1","1","103000","180000","81","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-13 15:57:29","2021-03-21 09:02:08");
INSERT INTO products VALUES("53","Jacket Nylon Hoodie P","REE-24175203","standard","C128","2","25","1","1","1","230000","360000","23","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-13 15:58:53","2021-03-24 01:51:16");
INSERT INTO products VALUES("54","Jacket Nylon Hoodie Jumbo P","REI-71651360","standard","C128","2","25","1","1","1","235000","360000","24","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-13 15:59:39","2021-03-13 16:51:31");
INSERT INTO products VALUES("55","Jacket Nylon Non Hoodie P","RBE-59137786","standard","C128","2","25","1","1","1","222500","350000","33","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-13 16:01:03","2021-03-21 09:33:23");
INSERT INTO products VALUES("56","Jacket Nylon non Hoodie Jumbo P","REE-88491920","standard","C128","2","25","1","1","1","230000","360000","36","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-13 16:02:08","2021-03-13 16:51:31");
INSERT INTO products VALUES("57","Jacket Woven non Hoodie P","REI-24337119","standard","C128","2","25","1","1","1","235000","360000","24","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-13 16:03:19","2021-03-13 16:51:31");
INSERT INTO products VALUES("58","Kemeja Casual PJG printing saku Bobok/OXF Saku Tempel","BSA-66540232","standard","C128","2","26","1","1","1","110000","190000","84","","","","","","","1","zummXD2dvAtI.png","","","0","0","","","","","1","2021-03-13 16:05:10","2021-03-25 12:14:40");
INSERT INTO products VALUES("59","Kemeja Casual PJG Saku Tempel","BAU-31945502","standard","C128","2","26","1","1","1","105000","180000","59","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-13 16:07:18","2021-03-19 07:27:48");
INSERT INTO products VALUES("60","Kemeja Casual PDK OXF/CNV","BRR-14741029","standard","C128","2","26","1","1","1","95000","170000","44","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-13 16:08:19","2021-03-24 12:39:20");
INSERT INTO products VALUES("61","T-Shirt Rolun PDK Jumbo","TA-16830811","standard","C128","2","27","1","1","1","60000","110000","69","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-13 16:09:26","2021-03-21 09:33:23");
INSERT INTO products VALUES("62","T-Shirt Rolun PDK","US-13288293","standard","C128","2","27","1","1","1","54000","100000","81","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-13 16:10:20","2021-03-22 04:55:08");
INSERT INTO products VALUES("63","Polo Shirt Rolun Ciangi","BHB-95218908","standard","C128","2","28","1","1","1","72500","140000","12","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-13 16:13:32","2021-03-13 16:51:18");
INSERT INTO products VALUES("64","Polo Shirt Rolun Ciangi Jumbo","BHP-09143324","standard","C128","2","28","1","1","1","76000","140000","12","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-13 16:14:18","2021-03-13 16:51:18");
INSERT INTO products VALUES("65","Polo Shirt Rolun","IT-92415297","standard","C128","2","28","1","1","1","70000","130000","38","","","","","","","1","zummXD2dvAtI.png","","","0","0","","","","","1","2021-03-13 16:15:08","2021-03-22 05:06:25");
INSERT INTO products VALUES("66","Polo Shirt Rolun Jumbo","BHE-27606041","standard","C128","2","28","1","1","1","73000","140000","54","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-13 16:15:54","2021-03-22 04:55:08");
INSERT INTO products VALUES("67","Celana Pendek Woven M5T","BAA-94306420","standard","C128","2","23","1","1","1","102500","180000","55","","","","","","","1","zummXD2dvAtI.png","","","0","0","","","","","1","2021-03-13 16:31:14","2021-03-22 04:54:42");
INSERT INTO products VALUES("68","Celana Pendek Woven FUBU","BSH-65516182","standard","C128","2","23","1","1","1","107500","190000","36","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-13 16:32:43","2021-03-13 16:51:05");
INSERT INTO products VALUES("69","Celana Panjang M5T Jum","EBH-34275341","standard","C128","2","23","1","1","1","150000","250000","12","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-13 16:34:02","2021-03-13 16:51:05");
INSERT INTO products VALUES("70","Celana Panjang M5T Big","EHR-54838614","standard","C128","2","23","1","1","1","145000","240000","24","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-13 16:35:14","2021-03-13 16:51:05");
INSERT INTO products VALUES("71","Celana Panjang Rib M5T Jumbo","EBH-31076149","standard","C128","2","23","1","1","1","150000","250000","22","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-13 16:36:29","2021-03-24 12:10:10");
INSERT INTO products VALUES("72","Kemeja Putih Crepe Wanita 3L","UT-43641980","standard","C128","","30","1","1","1","56000","100000","12","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 01:57:46","2021-03-25 13:05:22");
INSERT INTO products VALUES("73","Kemeja Putih Crepe L/XL 71458Kemeja Cewe ewPutih Crepe Wanita L/XL","UB-99332505","standard","C128","","30","1","1","1","51000","100000","6","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 02:34:49","2021-03-25 13:05:22");
INSERT INTO products VALUES("74","Kemeja Wanita Polos 68350 L/XL","PR-55112794","standard","C128","","30","1","1","1","45000","90000","12","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 02:37:07","2021-03-25 13:05:22");
INSERT INTO products VALUES("75","Kemeja RI Wanita L/XL","PR-29862302","standard","C128","","30","1","1","1","45000","90000","12","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 02:37:59","2021-03-25 13:05:22");
INSERT INTO products VALUES("76","Kemeja Kantong L/XL Wanita","TI-44131007","standard","C128","","30","1","1","1","64000","120000","12","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 02:39:11","2021-03-25 13:05:22");
INSERT INTO products VALUES("77","Kemeja Katun Panjang L/XL Wanita","TT-27390203","standard","C128","","30","1","1","1","63000","120000","12","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 02:42:14","2021-03-25 13:05:22");
INSERT INTO products VALUES("78","Kemeja Katun Panjang Wanita 3L","IS-56638453","standard","C128","","30","1","1","1","68000","130000","6","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 02:43:15","2021-03-25 13:05:22");
INSERT INTO products VALUES("79","Celana Kantor Poinplus Hitam Wool 27-32","BHS-43516417","standard","C128","","13","1","1","1","75000","140000","0","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 03:39:36","2021-03-24 03:39:36");
INSERT INTO products VALUES("80","Celana Kantor Hitam dan Abu 33-38","BBU-29409673","standard","C128","","13","1","1","1","84000","150000","0","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 03:41:44","2021-03-24 03:41:44");
INSERT INTO products VALUES("81","Celana Kantor Poinplus Abu 27-32","BHS-91091827","standard","C128","","13","1","1","1","75000","140000","0","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 03:42:53","2021-03-24 03:42:53");
INSERT INTO products VALUES("82","Kaus REDMEE Wanita Bordir Pdk Jumbo","RI-91130367","standard","C128","","31","1","1","1","28000","60000","112","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 03:46:25","2021-03-26 06:12:37");
INSERT INTO products VALUES("83","Kaus REDMEE Wanita Motif Pendek Jumbo","RI-73999765","standard","C128","","31","1","1","1","28000","60000","40","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 03:55:45","2021-03-26 06:12:37");
INSERT INTO products VALUES("84","Kaos Olahraga Misty Panjang","AE-75670624","standard","C128","","101","1","1","1","30000","60000","120","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 04:03:31","2021-03-26 06:11:15");
INSERT INTO products VALUES("85","Kaos Olahraga Misty Pendek","RU-00627753","standard","C128","","101","1","1","1","27000","55000","174","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 04:04:24","2021-03-26 06:11:15");
INSERT INTO products VALUES("86","Celana Jogger TKMY","BSP-81221307","standard","C128","","20","1","1","1","112000","200000","12","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 04:21:45","2021-03-26 06:14:59");
INSERT INTO products VALUES("87","Celana Kulot TKMY","BPB-70612448","standard","C128","","20","1","1","1","115000","200000","12","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 06:31:56","2021-03-26 06:14:59");
INSERT INTO products VALUES("88","Rok Panjang TKMY","BUB-12169328","standard","C128","","22","1","1","1","122000","220000","6","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 06:33:06","2021-03-26 06:14:59");
INSERT INTO products VALUES("89","Kaus Oblong JAVANO Motif Tulisan Pria","SA-07243186","standard","C128","","44","1","1","1","39000","80000","216","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 06:36:00","2021-04-05 03:44:22");
INSERT INTO products VALUES("90","Kaus Oblong JAVANO Motif Buildings/Automotive Pria","SA-64882199","standard","C128","","44","1","1","1","39000","80000","108","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 06:37:06","2021-04-05 03:44:22");
INSERT INTO products VALUES("91","Kaus Oblong JAVANO Kombinasi Pria","ST-70523396","standard","C128","","44","1","1","1","42000","80000","108","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 06:38:45","2021-04-05 03:44:22");
INSERT INTO products VALUES("92","Kaus Oblong JAVANO Panjang Pria","PH-23669530","standard","C128","","44","1","1","1","43000","90000","108","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 06:40:25","2021-04-05 03:44:22");
INSERT INTO products VALUES("93","Kaus Pria Fullprint Peremium","SP-09215065","standard","C128","","44","1","1","1","40000","80000","480","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 06:42:29","2021-03-26 06:20:29");
INSERT INTO products VALUES("94","Hugo Oblong Sweater / Kaus","BSA-61070534","standard","C128","","44","1","1","1","110000","190000","21","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 07:42:36","2021-03-26 05:37:34");
INSERT INTO products VALUES("95","Hugo Kerah Spandex Bordir","BSA-82086299","standard","C128","","28","1","1","1","110000","190000","9","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-24 07:49:05","2021-03-26 05:37:34");
INSERT INTO products VALUES("96","Kaus Kerah RBJ Spandex","BAH-37493562","standard","C128","","28","1","1","1","100000","180000","45","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-25 01:50:07","2021-03-26 05:44:42");
INSERT INTO products VALUES("97","Hugo Oblong Emboss MFCP/MIX/SALUR","BAH-91021936","standard","C128","","44","1","1","1","100000","180000","54","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-25 01:55:46","2021-03-26 05:44:42");
INSERT INTO products VALUES("98","Kaus Kerah RBJ Spandex Kombinasi","BAU-90185328","standard","C128","","28","1","1","1","105000","190000","9","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-25 12:38:58","2021-03-26 05:48:12");
INSERT INTO products VALUES("99","Hugo T-Shirt Jeans Oblong","TA-95860407","standard","C128","","44","1","1","1","60000","120000","54","","","","","","","1","zummXD2dvAtI.png","","","0","0","","","","","1","2021-03-25 12:40:21","2021-03-26 05:48:12");
INSERT INTO products VALUES("100","Hugo T-Shirt Jeans Oblong Bordir","TA-42909312","standard","C128","","44","1","1","1","60000","120000","9","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-25 12:41:30","2021-03-26 05:48:12");
INSERT INTO products VALUES("101","Hugo Jeans Oblong L/S","IB-54634713","standard","C128","","44","1","1","1","65000","120000","6","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-25 12:43:10","2021-03-26 05:48:12");
INSERT INTO products VALUES("102","RBJ T-shirt Oblong Emboss","BRR-16943713","standard","C128","","44","1","1","1","95000","170000","22","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-25 12:44:23","2021-03-26 05:48:12");
INSERT INTO products VALUES("103","Hugo Sweater Oblong Emboss","65431285","standard","C128","","29","1","1","1","125000","220000","0","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-25 12:47:38","2021-03-25 12:47:38");
INSERT INTO products VALUES("104","Hugo Sweater Oblong L/S","BUS-99620743","standard","C128","","44","1","1","1","125000","220000","36","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-25 12:48:25","2021-03-26 05:53:05");
INSERT INTO products VALUES("105","Jumper Hugo (Zipper and Hoodie)","EBH-23351412","standard","C128","","25","1","1","1","150000","250000","21","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-25 12:49:09","2021-03-26 05:53:05");
INSERT INTO products VALUES("106","Celana Chinos Hugo","EBH-88500462","standard","C128","","6","1","1","1","150000","250000","48","","","","","","","1","zummXD2dvAtI.png","","1","","","","","","","1","2021-03-25 12:50:48","2021-03-26 05:53:05");
INSERT INTO products VALUES("107","Jumper Hugo Hoodie","BIP-59728142","standard","C128","","25","1","1","1","140000","240000","18","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-25 12:51:43","2021-03-26 05:53:05");
INSERT INTO products VALUES("108","Celana HSL Hugo","RHT-01297308","standard","C128","","12","1","1","1","220000","350000","48","","","","","","","1","zummXD2dvAtI.png","","1","","","","","","","1","2021-03-25 12:54:12","2021-03-26 05:53:05");
INSERT INTO products VALUES("109","Hugo Kerah Spandex Emboss/MFCP","BSA-10518873","standard","C128","","28","1","1","1","110000","200000","72","","","","","","","1","zummXD2dvAtI.png","","","0","0","","","","","1","2021-03-25 14:26:30","2021-03-26 05:37:34");
INSERT INTO products VALUES("110","Hugo Kerah Wangki Salur","BSA-58191094","standard","C128","","28","1","1","1","110000","200000","11","","","","","","","1","zummXD2dvAtI.png","","","0","0","","","","","1","2021-03-25 14:27:38","2021-03-26 05:37:34");
INSERT INTO products VALUES("111","Hugo Oblong Spandex Bordir","BAH-13992358","standard","C128","","44","1","1","1","100000","180000","12","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-26 05:22:26","2021-03-26 05:44:42");
INSERT INTO products VALUES("112","Hugo Oblong SGM/MFCP/CMHC Mix","BAH-18293769","standard","C128","","44","1","1","1","100000","180000","27","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-26 05:24:32","2021-03-26 05:44:42");
INSERT INTO products VALUES("113","Hugo Oblong Sablon","BAH-72004331","standard","C128","","44","1","1","1","100000","140000","12","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-26 05:32:48","2021-03-26 05:44:42");
INSERT INTO products VALUES("114","Hugo Kerah Emboss","BAH-38329694","standard","C128","","28","1","1","1","100000","180000","6","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-26 05:34:11","2021-03-26 05:44:42");
INSERT INTO products VALUES("115","RBJ Oblong Emboss Mix","BAH-81514672","standard","C128","","44","1","1","1","100000","180000","12","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-26 05:34:46","2021-03-26 05:44:42");
INSERT INTO products VALUES("116","Hugo Oblong Sweater Emboss","BUS-97034782","standard","C128","","29","1","1","1","125000","220000","18","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-26 05:49:54","2021-03-26 05:53:05");
INSERT INTO products VALUES("117","Kulot Lebar Motif Gio-F","BAH-02386910","standard","C128","","20","1","1","1","100000","180000","50","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-26 06:23:38","2021-03-26 06:26:19");
INSERT INTO products VALUES("118","Rok Motif Import Gio-F","BAH-49086059","standard","C128","","22","1","1","1","100000","140000","20","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-26 06:24:17","2021-03-26 06:26:19");
INSERT INTO products VALUES("119","Lois Jeans Pendek (LMC)","BHU-90625339","standard","C128","","11","1","1","1","80000","140000","168","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-26 06:34:37","2021-03-26 06:46:41");
INSERT INTO products VALUES("120","Levis 501 Jeans Panjang (LMC)","BPI-17520479","standard","C128","","12","1","1","1","125000","210000","12","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-26 06:35:52","2021-03-26 06:46:41");
INSERT INTO products VALUES("121","Jeans Bomboogie Panjang (LMC)","BPA-25051608","standard","C128","","12","1","1","1","121000","210000","144","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-26 06:37:07","2021-03-26 06:46:41");
INSERT INTO products VALUES("122","Levis 501 Jeans Panjang Hitam (LMC)","BUI-93154722","standard","C128","","12","1","1","1","134000","220000","180","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-26 06:40:37","2021-03-26 06:46:41");
INSERT INTO products VALUES("123","Kaus Panjang Wanita Bordir Drinks (KLARA)","IT-97140368","standard","C128","","31","1","1","1","70000","130000","4","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-26 06:54:48","2021-03-26 13:02:18");
INSERT INTO products VALUES("124","Kaus Panjang Wanita OH HONEY (KLARA)","IS-53963717","standard","C128","","31","1","1","1","68000","120000","4","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-26 06:55:32","2021-03-26 13:02:18");
INSERT INTO products VALUES("125","Kaus Panjang Wanita HERE TODAY (KLARA)","BBI-39002182","standard","C128","","31","1","1","1","85000","150000","3","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-26 07:09:31","2021-03-26 13:02:18");
INSERT INTO products VALUES("126","Kaus Panjang Wanita Moon (KLARA)","BEP-09812733","standard","C128","","31","1","1","1","90000","160000","4","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-26 07:11:19","2021-03-26 13:02:18");
INSERT INTO products VALUES("127","Kaus Panjang Wanita Nobody (KLARA)","BHH-63160303","standard","C128","","31","1","1","1","72000","140000","4","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-26 07:16:03","2021-03-26 13:02:18");
INSERT INTO products VALUES("128","Kaus Panjang Wanita LONG JUST SMILE (KLARA)","BER-091602441","standard","C128","","31","1","1","1","88000","160000","4","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-26 07:17:02","2021-03-26 13:02:18");
INSERT INTO products VALUES("129","Kaus Panjang Wanita BE NICE LONG (KLARA)","BER-91718932","standard","C128","","31","1","1","1","88000","160000","4","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-26 07:18:28","2021-03-26 13:02:18");
INSERT INTO products VALUES("130","Kaus Panjang Wanita LONG JUST LOVE (KLARA)","BRR-02033495","standard","C128","","31","1","1","1","95000","170000","4","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-03-26 07:20:26","2021-03-26 13:02:18");
INSERT INTO products VALUES("131","Celana Sirwal Polos","BAH-23861029","standard","C128","","47","1","1","1","100000","180000","10","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 03:08:03","2021-04-05 03:28:05");
INSERT INTO products VALUES("132","Celana Sirwal Motif Kotak","BSA-26731829","standard","C128","","47","1","1","1","110000","200000","10","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 03:13:44","2021-04-05 03:28:05");
INSERT INTO products VALUES("133","Celana Sirwal Zipper","BSA-40623709","standard","C128","","47","1","1","1","110000","200000","10","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 03:15:20","2021-04-05 03:28:05");
INSERT INTO products VALUES("134","Celana Sirwal Jeans","BSA-20981572","standard","C128","","47","1","1","1","110000","200000","10","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 03:16:17","2021-04-05 03:28:05");
INSERT INTO products VALUES("135","Celana Sirwal Loreng","BRR-82532942","standard","C128","","47","1","1","1","95000","170000","10","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 03:18:03","2021-04-05 03:28:05");
INSERT INTO products VALUES("136","Celana Sirwal Kantor","BPB-06432209","standard","C128","","47","1","1","1","115000","210000","10","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 03:25:42","2021-04-05 03:28:05");
INSERT INTO products VALUES("137","Kaos Erkape Pendek size M-L","AS-02421834","standard","C128","","44","1","1","1","32500","70000","288","","","","","","","1","zummXD2dvAtI.png","","","0","0","","","","","1","2021-04-05 03:40:43","2021-04-05 03:43:24");
INSERT INTO products VALUES("138","Kaos Erkape Pendek Jumbo","SP-03017324","standard","C128","","44","1","1","1","40000","80000","120","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 03:41:22","2021-04-05 03:43:24");
INSERT INTO products VALUES("139","Kemeja Edge Polos Panjang","IT-36508319","standard","C128","","26","1","1","1","70000","130000","132","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 03:47:02","2021-04-05 03:52:49");
INSERT INTO products VALUES("140","Kemeja Edge Polos Pendek","IB-09577298","standard","C128","","26","1","1","1","65000","120000","132","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 03:47:59","2021-04-05 03:52:49");
INSERT INTO products VALUES("141","Kemeja Edge Polos Panjang JUMBO","BHS-09013106","standard","C128","","26","1","1","1","75000","140000","60","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 03:49:07","2021-04-05 03:52:49");
INSERT INTO products VALUES("142","Kemeja Levis Panjang (Premium)","BPT-60091438","standard","C128","","26","1","1","1","120000","210000","24","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 03:50:06","2021-04-05 03:52:49");
INSERT INTO products VALUES("143","Stelan Tidur Tessa 3/4","SP-72815629","standard","C128","","41","1","1","1","40000","80000","36","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 06:34:25","2021-04-05 07:38:35");
INSERT INTO products VALUES("144","Stelan Tidur Tessa CP","PR-41230509","standard","C128","","41","1","1","1","45000","90000","36","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 06:36:12","2021-04-05 07:38:35");
INSERT INTO products VALUES("145","Stelan Tidur Tessa Kulot","PH-30802755","standard","C128","","41","1","1","1","43500","90000","36","","","","","","","1","zummXD2dvAtI.png","","","0","0","","","","","1","2021-04-05 06:37:51","2021-04-05 07:38:35");
INSERT INTO products VALUES("146","Stelan Tidur Tessa PP Jumbo","UR-13411600","standard","C128","","41","1","1","1","52500","100000","36","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 06:55:08","2021-04-05 07:38:35");
INSERT INTO products VALUES("147","Stelan Tidur Tessa CP Jumbo","UB-41223986","standard","C128","","41","1","1","1","51000","100000","36","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 06:56:35","2021-04-05 07:38:35");
INSERT INTO products VALUES("148","Stelan Tidur Tessa PP","UH-72408589","standard","C128","","41","1","1","1","50000","100000","36","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 06:58:04","2021-04-05 07:38:35");
INSERT INTO products VALUES("149","Stelan Tidur Patricia CP","AP-69189229","standard","C128","","41","1","1","1","33000","70000","36","","","","","","","1","zummXD2dvAtI.png","","","0","0","","","","","1","2021-04-05 07:14:40","2021-04-05 07:38:35");
INSERT INTO products VALUES("150","Stelan Tidur Patricia 3/4","AE-18503263","standard","C128","","41","1","1","1","30000","60000","36","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 07:15:47","2021-04-05 07:38:35");
INSERT INTO products VALUES("151","Stelan Tidur Tessa Tanggung PP","SR-28014903","standard","C128","","41","1","1","1","38000","80000","24","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 07:19:04","2021-04-05 07:38:35");
INSERT INTO products VALUES("152","Stelan Tidur Tessa Tanggung CP","SH-48028643","standard","C128","","41","1","1","1","36000","80000","24","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 07:20:48","2021-04-05 07:38:35");
INSERT INTO products VALUES("153","Stelan Tidur Tessa Tanggung 3/4","AP-10961242","standard","C128","","41","1","1","1","33000","70000","24","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 07:22:37","2021-04-05 07:38:35");
INSERT INTO products VALUES("154","Stelan Tidur Patricia Tanggung CP","SB-86903054","standard","C128","","41","1","1","1","37000","80000","12","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 07:24:04","2021-04-05 07:38:35");
INSERT INTO products VALUES("155","Stelan Tidur Patricia Tanggung PP","SA-02820099","standard","C128","","41","1","1","1","39000","80000","6","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 07:24:58","2021-04-05 07:38:35");
INSERT INTO products VALUES("156","Stelan Tidur Patricia Kulot","ST-27659702","standard","C128","","41","1","1","1","42000","80000","24","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 07:25:57","2021-04-05 07:38:35");
INSERT INTO products VALUES("157","Stelan Tidur Patricia 3/4 Jumbo","SR-57321308","standard","C128","","41","1","1","1","38000","80000","24","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-05 07:26:48","2021-04-05 07:38:35");
INSERT INTO products VALUES("158","Celana Pendek Olahraga Misty Import","TA-320211","standard","C128","4","49","1","1","1","60000","120000","0","","","","","","","1","zummXD2dvAtI.png","","","","","","","","this is test product without variant","0","2021-04-09 11:05:50","2021-04-09 11:10:01");
INSERT INTO products VALUES("159","Celana Pendek Olahraga Micro Import","IB-320212","standard","C128","4","49","1","1","1","60000","120000","0","","","","","","","1","zummXD2dvAtI.png","","","","","","","","this is test product without variant","0","2021-04-09 11:05:50","2021-04-09 11:10:35");
INSERT INTO products VALUES("160","Celana Pendek Olahraga Misty Import","TA-320211","standard","C128","4","49","1","1","1","60000","120000","0","","","","","","","1","zummXD2dvAtI.png","","","","","","","","this is test product without variant","0","2021-04-09 11:10:58","2021-04-09 11:58:32");
INSERT INTO products VALUES("161","Celana Pendek Olahraga Micro Import","IB-320212","standard","C128","4","49","1","1","1","60000","120000","0","","","","","","","1","zummXD2dvAtI.png","","","","","","","","this is test product without variant","0","2021-04-09 11:10:58","2021-04-09 11:58:24");
INSERT INTO products VALUES("162","Celana Pendek Olahraga Misty Import","TA-320211","standard","C128","4","49","1","1","1","60000","120000","0","","","","","","","1","zummXD2dvAtI.png","","","","","","","","this is test product without variant","0","2021-04-09 12:02:35","2021-04-09 12:10:30");
INSERT INTO products VALUES("163","Celana Pendek Olahraga Micro Import","IB-320212","standard","C128","4","49","1","1","1","60000","120000","0","","","","","","","1","zummXD2dvAtI.png","","","","","","","","this is test product without variant","0","2021-04-09 12:02:35","2021-04-09 12:12:41");
INSERT INTO products VALUES("164","Celana Pendek Olahraga Misty Import","TA-320211","standard","C128","4","49","1","1","1","60000","120000","0","","","","","","","1","zummXD2dvAtI.png","","","","","","","","this is test product without variant","1","2021-04-11 03:45:41","2021-04-11 04:38:14");
INSERT INTO products VALUES("165","Celana Pendek Olahraga Micro Import","IB-320212","standard","C128","4","49","1","1","1","65000","120000","0","","","","","","","1","zummXD2dvAtI.png","","","","","","","","this is test product without variant","1","2021-04-11 03:45:41","2021-04-11 04:38:14");
INSERT INTO products VALUES("166","Celana Pendek Olahraga UARMR/ADIDAS","IB-320213","standard","C128","4","49","1","1","1","65000","120000","0","","","","","","","1","zummXD2dvAtI.png","","","","","","","","this is test product without variant","1","2021-04-11 03:45:41","2021-04-11 04:38:14");
INSERT INTO products VALUES("167","Legging Olahraga Import UARMR","IT-320214","standard","C128","4","49","1","1","1","70000","130000","0","","","","","","","1","zummXD2dvAtI.png","","","","","","","","this is test product without variant","1","2021-04-11 03:45:41","2021-04-11 04:38:14");
INSERT INTO products VALUES("168","Training Panjang/Jogger Import ADDS UARMR","BEP-320215","standard","C128","4","49","1","1","1","90000","160000","0","","","","","","","1","zummXD2dvAtI.png","","","","","","","","this is test product without variant","1","2021-04-11 03:45:41","2021-04-11 04:38:14");
INSERT INTO products VALUES("169","T-SHIRT Drifit Pendek UA//NK/ADS","IB-320216","standard","C128","4","49","1","1","1","65000","120000","72","","","","","","","1","zummXD2dvAtI.png","","","","","","","","this is test product without variant","1","2021-04-11 04:38:14","2021-04-11 04:45:52");
INSERT INTO products VALUES("170","T-SHIRT Drifit Panjang UA//NK","IT-320217","standard","C128","4","49","1","1","1","70000","130000","42","","","","","","","1","zummXD2dvAtI.png","","","","","","","","this is test product without variant","1","2021-04-11 04:38:14","2021-04-11 04:45:52");
INSERT INTO products VALUES("171","T-SHIRT Drifit Panjang Turtleneck UA//NK","BHS-320218","standard","C128","4","49","1","1","1","75000","140000","24","","","","","","","1","zummXD2dvAtI.png","","","","","","","","this is test product without variant","1","2021-04-11 04:38:14","2021-04-11 04:45:52");
INSERT INTO products VALUES("172","Celana Kain Misty Yingya","UE-2903211","standard","C128","4","20","1","1","1","52000","100000","72","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-13 06:44:49","2021-04-16 08:22:36");
INSERT INTO products VALUES("173","Celana Motif Kotak Tali Mawi","PR-2903212","standard","C128","6","20","1","1","1","45000","90000","12","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-13 06:44:49","2021-04-16 08:22:36");
INSERT INTO products VALUES("174","Celana Motif Kotak Transparan Mawi","PT-2903213","standard","C128","4","20","1","1","1","49000","90000","84","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-13 06:44:49","2021-04-16 08:22:36");
INSERT INTO products VALUES("175","Celana Motif Kotak Flanel Mawi","TB-2903214","standard","C128","4","20","1","1","1","58000","110000","96","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-13 06:44:49","2021-04-16 08:22:36");
INSERT INTO products VALUES("176","Celana Motif Kotak Velove Mawi","UH-2903215","standard","C128","4","20","1","1","1","50000","100000","48","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-13 06:44:49","2021-04-16 08:22:36");
INSERT INTO products VALUES("177","Baggy Pants Wanita Jumbo","SB-3103211","standard","C128","4","20","1","1","1","37000","80000","0","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-13 06:44:49","2021-04-16 08:12:23");
INSERT INTO products VALUES("178","Baggy Pants Standar Wanita/Cargo Tyra","SH-3103212","standard","C128","4","20","1","1","1","36000","80000","0","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-13 06:44:49","2021-04-16 08:12:23");
INSERT INTO products VALUES("179","Handuk Eternal/ TP Exalus","TI-2903211","standard","C128","4","48","1","1","1","63500","120000","72","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-16 08:12:23","2021-04-16 08:27:17");
INSERT INTO products VALUES("180","Handuk Magnolia XL","BHR-2903212","standard","C128","4","48","1","1","1","73500","140000","36","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-16 08:12:23","2021-04-16 08:27:17");
INSERT INTO products VALUES("181","Handuk Luxury XL","BBE-2903213","standard","C128","4","48","1","1","1","80000","150000","36","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-16 08:12:23","2021-04-16 08:27:17");
INSERT INTO products VALUES("182","Handuk TP Bambu Super","IA-2903214","standard","C128","4","48","1","1","1","67500","120000","36","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-16 08:12:23","2021-04-16 08:27:17");
INSERT INTO products VALUES("183","Kaus Anak Girl Wayne  (Kode RS)","RS-3003211","standard","C128","4","82","1","1","1","23000","50000","180","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-16 12:13:32","2021-04-16 12:23:59");
INSERT INTO products VALUES("184","Kaus Anak Girl Wayne  (Kode RP)","RP-3003212","standard","C128","","82","1","1","1","24000","50000","36","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-16 12:14:23","2021-04-16 12:23:59");
INSERT INTO products VALUES("185","Kaus Anak Girl Wayne  (Kode RH)","RH-3003213","standard","C128","","82","1","1","1","20000","50000","36","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-16 12:15:15","2021-04-16 12:23:59");
INSERT INTO products VALUES("186","Kaus Anak Girl Wayne  (Kode AE)","AE-3003214","standard","C128","","82","1","1","1","28000","60000","60","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-16 12:16:15","2021-04-16 12:23:59");
INSERT INTO products VALUES("187","Kaus Anak Girl Wayne  (Kode AH)","AH-3003214","standard","C128","","82","1","1","1","26000","60000","48","","","","","","","1","zummXD2dvAtI.png","","","0","0","","","","","1","2021-04-16 12:17:03","2021-04-16 12:23:59");
INSERT INTO products VALUES("188","Kaus Anak Girl Wayne  (Kode AT)","AT-3003215","standard","C128","","82","1","1","1","32000","70000","60","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-16 12:17:55","2021-04-16 12:23:59");
INSERT INTO products VALUES("189","Sweater Boy Kids with Topi (Jumbo)","UB-3003211","standard","C128","","83","1","1","1","47000","100000","84","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-16 12:26:14","2021-04-16 12:31:45");
INSERT INTO products VALUES("190","T-Shirt Boy Kids Kaijili","AS-3003212","standard","C128","","83","1","1","1","30000","60000","96","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-16 12:27:26","2021-04-16 12:31:45");
INSERT INTO products VALUES("191","Jogger Kids Boy or Girl (15-19)","SA-3003213","standard","C128","","83","1","1","1","36000","80000","240","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-16 12:28:33","2021-04-16 12:31:45");
INSERT INTO products VALUES("192","Jeans Sablon Karakter for Kids (Girl)","PH-3003214","standard","C128","","82","1","1","1","40000","90000","40","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-16 12:29:55","2021-04-16 12:31:45");
INSERT INTO products VALUES("193","Jeans Standard Cargo Wanita Zreg","UH-290121","standard","C128","","35","1","1","1","52500","100000","96","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-17 05:49:24","2021-04-17 06:27:23");
INSERT INTO products VALUES("194","Jeans Wanita Karet Jumbo (Bluejeans)","UH-2901212","standard","C128","","35","1","1","1","52500","100000","96","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-17 05:50:33","2021-04-17 06:27:23");
INSERT INTO products VALUES("195","Jeans Wanita Super JUMBO Ban (Bluejeans)","UA-2901213","standard","C128","","35","1","1","1","55000","100000","48","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-17 05:54:39","2021-04-17 06:27:23");
INSERT INTO products VALUES("196","Boyfriend Light Stone (BlueJeans)","IB-2901211","standard","C128","","35","1","1","1","67500","120000","48","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-17 06:09:15","2021-04-17 06:27:23");
INSERT INTO products VALUES("197","Boyfriend Light (BlueJeans)","IU-2901212","standard","C128","","35","1","1","1","72500","130000","12","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-17 06:10:42","2021-04-17 06:27:23");
INSERT INTO products VALUES("198","Jeans KS Snow (Bluejeans)","BBB-2901213","standard","C128","","35","1","1","1","82500","150000","72","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-17 06:12:43","2021-04-17 06:27:23");
INSERT INTO products VALUES("199","Jeans KS Snow JUMBO (Bluejeans)","BEB-2901214","standard","C128","","35","1","1","1","90000","160000","36","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-17 06:20:12","2021-04-17 06:27:23");
INSERT INTO products VALUES("200","Jeans Highwaist Semua Model (Bluejeans)","BHA-2901215","standard","C128","","35","1","1","1","77500","140000","60","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-17 06:22:08","2021-04-17 06:27:23");
INSERT INTO products VALUES("201","Jeans Highwaist Semua Model JUMBO (Bluejeans)","BBB-2901216","standard","C128","","35","1","1","1","82500","150000","60","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-17 06:23:44","2021-04-17 06:27:23");
INSERT INTO products VALUES("202","Celana Pendek Katun Twill model Supreme","PH-2901211","standard","C128","","97","1","1","1","40000","90000","180","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-17 06:29:50","2021-04-17 06:30:19");
INSERT INTO products VALUES("203","Boyfriend Jeans Youngtrend (CKEY)","BBI-2701211","standard","C128","","35","1","1","1","85000","150000","40","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-17 06:34:11","2021-04-17 06:57:49");
INSERT INTO products VALUES("204","Boyfriend Youngtrend Lebar (CKEY)","BRR-2701213","standard","C128","","35","1","1","1","95000","170000","16","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-17 06:35:18","2021-04-17 06:57:49");
INSERT INTO products VALUES("205","Oblong Katun Redrooster","RS-2901211","standard","C128","","44","1","1","1","25000","50000","480","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-17 07:12:17","2021-04-17 07:15:41");
INSERT INTO products VALUES("206","Oblong Levis Katun Redrooster","UH-29012121","standard","C128","","44","1","1","1","45000","100000","240","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-17 07:15:08","2021-04-17 07:15:41");
INSERT INTO products VALUES("207","Celana Kain Wanita Faiza","SU-2701211","standard","C128","","20","1","1","1","38000","80000","156","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-18 07:47:19","2021-04-18 07:58:26");
INSERT INTO products VALUES("208","Celana Jogger Wanita Faiza","PR-2701212","standard","C128","","20","1","1","1","45000","90000","12","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-18 07:53:04","2021-04-18 07:58:26");
INSERT INTO products VALUES("209","Celana Kain Jumbo Wanita Faiza","UH-2701213","standard","C128","","20","1","1","1","50000","100000","12","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-18 07:54:26","2021-04-18 07:58:26");
INSERT INTO products VALUES("210","Celana Kain Wanita Twill Faiza","SP-2701214","standard","C128","","20","1","1","1","40000","80000","36","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-18 07:55:40","2021-04-18 07:58:26");
INSERT INTO products VALUES("211","Polo Shirt CF Black","BPB-2801211","standard","C128","","28","1","1","1","115000","200000","0","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-18 08:07:46","2021-04-18 08:13:19");
INSERT INTO products VALUES("212","Polo Shirt CF Grey","BET-2801212","standard","C128","","28","1","1","1","92000","160000","2","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-18 08:08:48","2021-04-18 08:13:19");
INSERT INTO products VALUES("213","CF T-shirt Sablon Depan","BRH-2801212","standard","C128","","44","1","1","1","93000","170000","48","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-18 08:09:53","2021-04-18 08:12:35");
INSERT INTO products VALUES("214","CF Aboben T-Shirt","TA-2801214","standard","C128","","44","1","1","1","60000","120000","24","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-18 08:10:52","2021-04-18 08:12:35");
INSERT INTO products VALUES("215","CD KING M2","SP-0401211","standard","C128","","50","1","1","1","40000","60000","200","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-18 08:17:20","2021-04-18 08:22:19");
INSERT INTO products VALUES("216","CD King Magadha","PR-0401212","standard","C128","","50","1","1","1","45000","70000","60","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-18 08:18:01","2021-04-18 08:22:19");
INSERT INTO products VALUES("217","Singlet King","SH-0401213","standard","C128","","50","1","1","1","36000","60000","72","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-18 08:18:52","2021-04-18 08:22:19");
INSERT INTO products VALUES("218","Piyama Micro CP NARITA Lie","AU-2101211","standard","C128","","41","1","1","1","34000","70000","120","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-18 08:29:02","2021-04-18 08:43:10");
INSERT INTO products VALUES("219","Piyama Micro HP NARITA Lie","AE-2101212","standard","C128","","41","1","1","1","31000","60000","120","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-18 08:30:40","2021-04-18 08:43:10");
INSERT INTO products VALUES("220","Piyama Micro PP NARITA Lie","SA-2101213","standard","C128","","41","1","1","1","39000","80000","120","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-18 08:31:23","2021-04-18 08:43:10");
INSERT INTO products VALUES("221","Piyama Katun CP Narita Lie","PU-2101214","standard","C128","","41","1","1","1","48000","90000","60","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-18 08:32:31","2021-04-18 08:43:10");
INSERT INTO products VALUES("222","Piyama Katun HP Narita Lie","PH-2101215","standard","C128","","41","1","1","1","43000","90000","60","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-18 08:33:52","2021-04-18 08:43:10");
INSERT INTO products VALUES("223","Piyama Motif Tanggung NARITA Lie","AP-2101216","standard","C128","","41","1","1","1","33000","60000","24","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-18 08:35:17","2021-04-18 08:43:10");
INSERT INTO products VALUES("224","Piyama Motif Anak CP 6/10 Narita Lie","AA-2101217","standard","C128","","41","1","1","1","32000","60000","36","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-18 08:37:54","2021-04-18 08:43:10");
INSERT INTO products VALUES("225","Piyama Motif Anak CP S/M Narita Lie","RU-2101218","standard","C128","","41","1","1","1","27000","50000","60","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-18 08:39:03","2021-04-18 08:43:10");
INSERT INTO products VALUES("226","Boxer Pria Nike Pro/PUMA/LEVIS/LACOSTE/PIERRE CARDIN/OTHERS","BPT-1601211","standard","C128","","50","1","1","1","120000","180000","100","","","","","","","1","zummXD2dvAtI.png","","","","","","","","","1","2021-04-19 06:44:43","2021-04-19 06:48:21");



CREATE TABLE `purchase_product_return` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `return_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) DEFAULT NULL,
  `qty` double NOT NULL,
  `purchase_unit_id` int(11) NOT NULL,
  `net_unit_cost` double NOT NULL,
  `discount` double NOT NULL,
  `tax_rate` double NOT NULL,
  `tax` double NOT NULL,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `purchases` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `item` int(11) NOT NULL,
  `total_qty` double NOT NULL,
  `total_discount` double NOT NULL,
  `total_tax` double NOT NULL,
  `total_cost` double NOT NULL,
  `order_tax_rate` double DEFAULT NULL,
  `order_tax` double DEFAULT NULL,
  `order_discount` double DEFAULT NULL,
  `shipping_cost` double DEFAULT NULL,
  `grand_total` double NOT NULL,
  `paid_amount` double NOT NULL,
  `status` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO purchases VALUES("1","pr-20210307-040558","31","1","2","6","12","0","0","2257200","0","0","0","0","2257200","0","1","1","","","2021-03-07 04:05:58","2021-03-13 17:05:35");
INSERT INTO purchases VALUES("2","pr-20210307-043740","31","1","2","5","12","0","0","2257200","0","0","0","0","2257200","0","1","1","","","2021-03-07 04:37:40","2021-03-13 17:05:23");
INSERT INTO purchases VALUES("3","pr-20210307-121029","31","1","2","6","12","0","0","2692800","0","0","0","0","2692800","0","1","1","","","2021-03-07 12:10:29","2021-03-13 17:05:07");
INSERT INTO purchases VALUES("4","pr-20210307-122458","31","1","2","1","12","0","0","2692800","0","0","0","0","2692800","0","1","1","","","2021-03-07 12:24:58","2021-03-13 16:53:21");
INSERT INTO purchases VALUES("5","pr-20210307-122935","31","1","2","2","24","0","0","5649600","0","0","0","0","5649600","0","1","1","","","2021-03-07 12:29:35","2021-03-13 16:53:10");
INSERT INTO purchases VALUES("6","pr-20210307-125227","31","1","2","15","150","0","0","34188000","0","0","0","0","34188000","0","1","1","","","2021-03-07 12:52:27","2021-03-13 16:52:58");
INSERT INTO purchases VALUES("7","pr-20210308-060130","31","1","1","15","288","0","0","42780000","0","0","0","0","42780000","0","1","1","","","2021-03-08 06:01:30","2021-03-13 17:02:36");
INSERT INTO purchases VALUES("8","pr-20210308-090320","31","1","1","4","180","0","0","31380000","0","0","0","0","31380000","0","1","1","","","2021-03-08 09:03:20","2021-03-13 16:52:32");
INSERT INTO purchases VALUES("9","pr-20210309-073030","31","1","1","6","144","0","0","21000000","0","0","0","0","21000000","0","1","1","","","2021-03-09 07:30:30","2021-03-13 16:52:09");
INSERT INTO purchases VALUES("10","pr-20210309-100417","31","1","1","11","492","0","0","57060000","0","0","0","0","57060000","0","1","1","","","2021-03-09 10:04:17","2021-03-13 16:51:45");
INSERT INTO purchases VALUES("11","pr-20210313-042046","31","1","1","10","384","0","0","60462000","0","0","0","0","60462000","0","1","1","","","2021-03-13 16:20:46","2021-03-13 16:51:31");
INSERT INTO purchases VALUES("12","pr-20210313-042619","31","1","1","9","504","0","0","40938000","0","0","0","0","40938000","0","1","1","","","2021-03-13 16:26:19","2021-03-13 16:51:18");
INSERT INTO purchases VALUES("13","pr-20210313-044012","31","1","1","5","156","0","0","18900000","0","0","0","0","18900000","0","1","1","","","2021-03-13 16:40:12","2021-03-13 16:51:05");
INSERT INTO purchases VALUES("14","pr-20210325-010522","31","1","4","7","72","0","0","3990000","0","0","0","0","3990000","3990000","1","2","","","2021-03-25 13:05:22","2021-03-26 06:15:30");
INSERT INTO purchases VALUES("15","pr-20210326-053734","31","1","5","4","113","0","0","12430000","0","0","0","0","12430000","12430000","1","2","","","2021-03-26 05:37:34","2021-03-26 06:15:36");
INSERT INTO purchases VALUES("16","pr-20210326-054442","31","1","5","7","168","0","0","16800000","0","0","0","0","16800000","16800000","1","2","","","2021-03-26 05:44:42","2021-03-26 06:15:48");
INSERT INTO purchases VALUES("17","pr-20210326-054812","31","1","5","5","100","0","0","7205000","0","0","0","0","7205000","7205000","1","2","","","2021-03-26 05:48:12","2021-03-26 06:16:01");
INSERT INTO purchases VALUES("18","pr-20210326-055305","31","1","5","12","189","0","0","30180000","0","0","0","0","30180000","30180000","1","2","","","2021-03-26 05:53:05","2021-03-26 06:16:14");
INSERT INTO purchases VALUES("19","pr-20210326-061115","31","1","9","2","294","0","0","8298000","0","0","0","0","8298000","8298000","1","2","","","2021-03-26 06:11:15","2021-03-26 06:16:26");
INSERT INTO purchases VALUES("20","pr-20210326-061237","31","1","8","2","152","0","0","4256000","0","0","0","0","4256000","4256000","1","2","","","2021-03-26 06:12:37","2021-03-26 06:15:20");
INSERT INTO purchases VALUES("21","pr-20210326-061434","31","1","10","3","30","0","0","3456000","0","0","0","0","3456000","3456000","1","2","","","2021-03-26 06:14:34","2021-03-26 06:15:13");
INSERT INTO purchases VALUES("22","pr-20210326-061833","31","1","11","4","540","0","0","21816000","0","0","0","0","21816000","21816000","1","2","","Nota Tanggal 12 Januari 2021","2021-03-26 06:18:33","2021-04-05 03:44:22");
INSERT INTO purchases VALUES("23","pr-20210326-062029","31","1","12","1","480","0","0","19200000","0","0","0","0","19200000","19200000","1","2","","","2021-03-26 06:20:29","2021-03-26 06:20:34");
INSERT INTO purchases VALUES("24","pr-20210326-062619","31","1","14","2","70","0","0","7000000","0","0","0","0","7000000","7000000","1","2","","","2021-03-26 06:26:19","2021-03-26 06:27:30");
INSERT INTO purchases VALUES("25","pr-20210326-064641","31","1","15","4","504","0","0","56484000","0","0","0","0","56484000","56484000","1","2","","","2021-03-26 06:46:41","2021-03-26 12:53:08");
INSERT INTO purchases VALUES("26","pr-20210326-010218","31","1","16","8","31","0","0","2539000","0","0","0","0","2539000","2539000","1","2","","","2021-03-26 13:02:18","2021-03-26 13:03:37");
INSERT INTO purchases VALUES("27","pr-20210405-032805","31","1","17","6","60","0","0","6400000","0","0","0","0","6400000","6400000","1","2","","Nota Tanggal 6 Januari","2021-04-05 03:28:05","2021-04-05 03:28:15");
INSERT INTO purchases VALUES("28","pr-20210405-034324","31","1","18","2","408","0","0","14160000","0","0","0","0","14160000","14160000","1","2","","Nota tanggal 11 Januari 2021","2021-04-05 03:43:24","2021-04-05 03:43:38");
INSERT INTO purchases VALUES("29","pr-20210405-035249","31","1","19","4","348","0","0","25200000","0","0","0","0","25200000","25200000","1","2","","Nota Tanggal 14 Januari 2021","2021-04-05 03:52:49","2021-04-05 03:52:57");
INSERT INTO purchases VALUES("30","pr-20210405-073432","31","1","20","15","426","0","0","17586000","0","0","0","0","17586000","17586000","1","2","","Nota Tanggal 21 Januari 2021","2021-04-05 07:34:32","2021-04-05 07:38:53");
INSERT INTO purchases VALUES("31","pr-20210411-042303","31","1","","5","176","0","0","12480000","0","0","0","0","12480000","12480000","1","2","","Nota tanggal 3 Februari 2021","2021-04-11 04:23:03","2021-04-11 04:23:13");
INSERT INTO purchases VALUES("32","pr-20210411-044552","31","1","","3","138","0","0","9420000","0","0","0","0","9420000","9420000","1","2","","Nota tanggal 3 Februari 2021","2021-04-11 04:45:52","2021-04-11 04:46:01");
INSERT INTO purchases VALUES("33","pr-20210416-081415","31","1","","0","0","0","0","0","0","0","","","0","0","1","1","","","2021-04-16 08:14:15","2021-04-16 08:14:15");
INSERT INTO purchases VALUES("34","pr-20210416-081454","31","1","","0","0","0","0","0","0","0","","","0","0","1","1","","","2021-04-16 08:14:54","2021-04-16 08:14:54");
INSERT INTO purchases VALUES("35","pr-20210416-082236","31","1","","5","312","0","0","16368000","0","0","0","0","16368000","16368000","1","2","","Toko Mawi","2021-04-16 08:22:36","2021-04-16 08:23:33");
INSERT INTO purchases VALUES("36","pr-20210416-082717","31","1","","4","180","0","0","12528000","0","0","0","0","12528000","12528000","1","2","","Toko Cabaru","2021-04-16 08:27:17","2021-04-16 08:36:20");
INSERT INTO purchases VALUES("38","pr-20210416-122359","31","1","","6","420","0","0","10572000","0","0","0","0","10572000","10572000","1","2","","","2021-04-16 12:23:59","2021-04-16 12:24:09");
INSERT INTO purchases VALUES("39","pr-20210416-123145","31","1","","4","460","0","0","17068000","0","0","0","0","17068000","17068000","1","2","","","2021-04-16 12:31:45","2021-04-16 12:32:04");
INSERT INTO purchases VALUES("40","pr-20210417-062723","31","1","21","9","528","0","0","35610000","0","0","0","0","35610000","35610000","1","2","","","2021-04-17 06:27:23","2021-04-17 06:27:30");
INSERT INTO purchases VALUES("41","pr-20210417-063019","31","1","","1","180","0","0","7200000","0","0","0","0","7200000","7200000","1","2","","","2021-04-17 06:30:19","2021-04-17 06:30:40");
INSERT INTO purchases VALUES("42","pr-20210417-065749","31","1","","2","56","0","0","4920000","0","0","0","0","4920000","4920000","1","2","","","2021-04-17 06:57:49","2021-04-17 06:57:56");
INSERT INTO purchases VALUES("43","pr-20210417-071541","31","1","","2","720","0","0","22800000","0","0","0","0","22800000","22800000","1","2","","","2021-04-17 07:15:41","2021-04-17 07:15:55");
INSERT INTO purchases VALUES("44","pr-20210418-075722","31","1","22","4","216","0","0","8508000","0","0","0","0","8508000","8508000","1","2","","","2021-04-18 07:57:22","2021-04-18 07:58:35");
INSERT INTO purchases VALUES("45","pr-20210418-081235","31","1","23","4","81","0","0","6801000","0","0","0","0","6801000","6801000","1","2","","","2021-04-18 08:12:35","2021-04-18 08:20:48");
INSERT INTO purchases VALUES("46","pr-20210418-082040","31","1","24","3","332","0","0","13292000","0","0","0","0","13292000","13292000","1","2","","","2021-04-18 08:20:40","2021-04-18 08:23:00");
INSERT INTO purchases VALUES("47","pr-20210418-084310","31","1","25","8","600","0","0","21504000","0","0","0","0","21504000","21504000","1","2","","","2021-04-18 08:43:10","2021-04-18 08:43:18");
INSERT INTO purchases VALUES("48","pr-20210419-064821","31","1","26","1","100","0","0","12000000","0","0","0","0","12000000","12000000","1","2","","","2021-04-19 06:48:21","2021-04-19 06:49:47");



CREATE TABLE `quotations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `biller_id` int(11) NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `total_qty` double NOT NULL,
  `total_discount` double NOT NULL,
  `total_tax` double NOT NULL,
  `total_price` double NOT NULL,
  `order_tax_rate` double DEFAULT NULL,
  `order_tax` double DEFAULT NULL,
  `order_discount` double DEFAULT NULL,
  `shipping_cost` double DEFAULT NULL,
  `grand_total` double NOT NULL,
  `quotation_status` int(11) NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `return_purchases` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `total_qty` double NOT NULL,
  `total_discount` double NOT NULL,
  `total_tax` double NOT NULL,
  `total_cost` double NOT NULL,
  `order_tax_rate` double DEFAULT NULL,
  `order_tax` double DEFAULT NULL,
  `grand_total` double NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `returns` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `cash_register_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `biller_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `total_qty` double NOT NULL,
  `total_discount` double NOT NULL,
  `total_tax` double NOT NULL,
  `total_price` double NOT NULL,
  `order_tax_rate` double DEFAULT NULL,
  `order_tax` double DEFAULT NULL,
  `grand_total` double NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `return_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `role_has_permissions` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO role_has_permissions VALUES("4","1");
INSERT INTO role_has_permissions VALUES("4","2");
INSERT INTO role_has_permissions VALUES("4","4");
INSERT INTO role_has_permissions VALUES("4","7");
INSERT INTO role_has_permissions VALUES("5","1");
INSERT INTO role_has_permissions VALUES("5","2");
INSERT INTO role_has_permissions VALUES("5","7");
INSERT INTO role_has_permissions VALUES("6","1");
INSERT INTO role_has_permissions VALUES("6","2");
INSERT INTO role_has_permissions VALUES("6","4");
INSERT INTO role_has_permissions VALUES("6","7");
INSERT INTO role_has_permissions VALUES("7","1");
INSERT INTO role_has_permissions VALUES("7","2");
INSERT INTO role_has_permissions VALUES("7","4");
INSERT INTO role_has_permissions VALUES("7","7");
INSERT INTO role_has_permissions VALUES("8","1");
INSERT INTO role_has_permissions VALUES("8","2");
INSERT INTO role_has_permissions VALUES("8","4");
INSERT INTO role_has_permissions VALUES("8","7");
INSERT INTO role_has_permissions VALUES("9","1");
INSERT INTO role_has_permissions VALUES("9","2");
INSERT INTO role_has_permissions VALUES("9","4");
INSERT INTO role_has_permissions VALUES("9","7");
INSERT INTO role_has_permissions VALUES("10","1");
INSERT INTO role_has_permissions VALUES("10","2");
INSERT INTO role_has_permissions VALUES("10","7");
INSERT INTO role_has_permissions VALUES("11","1");
INSERT INTO role_has_permissions VALUES("11","2");
INSERT INTO role_has_permissions VALUES("11","7");
INSERT INTO role_has_permissions VALUES("12","1");
INSERT INTO role_has_permissions VALUES("12","2");
INSERT INTO role_has_permissions VALUES("12","4");
INSERT INTO role_has_permissions VALUES("12","6");
INSERT INTO role_has_permissions VALUES("12","7");
INSERT INTO role_has_permissions VALUES("13","1");
INSERT INTO role_has_permissions VALUES("13","2");
INSERT INTO role_has_permissions VALUES("13","4");
INSERT INTO role_has_permissions VALUES("13","6");
INSERT INTO role_has_permissions VALUES("13","7");
INSERT INTO role_has_permissions VALUES("14","1");
INSERT INTO role_has_permissions VALUES("14","2");
INSERT INTO role_has_permissions VALUES("14","6");
INSERT INTO role_has_permissions VALUES("14","7");
INSERT INTO role_has_permissions VALUES("15","1");
INSERT INTO role_has_permissions VALUES("15","2");
INSERT INTO role_has_permissions VALUES("15","6");
INSERT INTO role_has_permissions VALUES("15","7");
INSERT INTO role_has_permissions VALUES("16","1");
INSERT INTO role_has_permissions VALUES("16","2");
INSERT INTO role_has_permissions VALUES("16","7");
INSERT INTO role_has_permissions VALUES("17","1");
INSERT INTO role_has_permissions VALUES("17","2");
INSERT INTO role_has_permissions VALUES("17","7");
INSERT INTO role_has_permissions VALUES("18","1");
INSERT INTO role_has_permissions VALUES("18","2");
INSERT INTO role_has_permissions VALUES("18","7");
INSERT INTO role_has_permissions VALUES("19","1");
INSERT INTO role_has_permissions VALUES("19","2");
INSERT INTO role_has_permissions VALUES("19","7");
INSERT INTO role_has_permissions VALUES("20","1");
INSERT INTO role_has_permissions VALUES("20","2");
INSERT INTO role_has_permissions VALUES("20","4");
INSERT INTO role_has_permissions VALUES("20","7");
INSERT INTO role_has_permissions VALUES("21","1");
INSERT INTO role_has_permissions VALUES("21","2");
INSERT INTO role_has_permissions VALUES("21","4");
INSERT INTO role_has_permissions VALUES("21","7");
INSERT INTO role_has_permissions VALUES("22","1");
INSERT INTO role_has_permissions VALUES("22","2");
INSERT INTO role_has_permissions VALUES("22","4");
INSERT INTO role_has_permissions VALUES("22","7");
INSERT INTO role_has_permissions VALUES("23","1");
INSERT INTO role_has_permissions VALUES("23","2");
INSERT INTO role_has_permissions VALUES("23","7");
INSERT INTO role_has_permissions VALUES("24","1");
INSERT INTO role_has_permissions VALUES("24","2");
INSERT INTO role_has_permissions VALUES("24","4");
INSERT INTO role_has_permissions VALUES("24","7");
INSERT INTO role_has_permissions VALUES("25","1");
INSERT INTO role_has_permissions VALUES("25","2");
INSERT INTO role_has_permissions VALUES("25","4");
INSERT INTO role_has_permissions VALUES("25","7");
INSERT INTO role_has_permissions VALUES("26","1");
INSERT INTO role_has_permissions VALUES("26","2");
INSERT INTO role_has_permissions VALUES("26","7");
INSERT INTO role_has_permissions VALUES("27","1");
INSERT INTO role_has_permissions VALUES("27","2");
INSERT INTO role_has_permissions VALUES("27","7");
INSERT INTO role_has_permissions VALUES("28","1");
INSERT INTO role_has_permissions VALUES("28","2");
INSERT INTO role_has_permissions VALUES("28","4");
INSERT INTO role_has_permissions VALUES("29","1");
INSERT INTO role_has_permissions VALUES("29","2");
INSERT INTO role_has_permissions VALUES("29","4");
INSERT INTO role_has_permissions VALUES("30","1");
INSERT INTO role_has_permissions VALUES("30","2");
INSERT INTO role_has_permissions VALUES("31","1");
INSERT INTO role_has_permissions VALUES("31","2");
INSERT INTO role_has_permissions VALUES("32","1");
INSERT INTO role_has_permissions VALUES("32","2");
INSERT INTO role_has_permissions VALUES("33","1");
INSERT INTO role_has_permissions VALUES("33","2");
INSERT INTO role_has_permissions VALUES("34","1");
INSERT INTO role_has_permissions VALUES("34","2");
INSERT INTO role_has_permissions VALUES("35","1");
INSERT INTO role_has_permissions VALUES("35","2");
INSERT INTO role_has_permissions VALUES("36","1");
INSERT INTO role_has_permissions VALUES("36","2");
INSERT INTO role_has_permissions VALUES("37","1");
INSERT INTO role_has_permissions VALUES("37","2");
INSERT INTO role_has_permissions VALUES("37","7");
INSERT INTO role_has_permissions VALUES("38","1");
INSERT INTO role_has_permissions VALUES("38","2");
INSERT INTO role_has_permissions VALUES("38","7");
INSERT INTO role_has_permissions VALUES("39","1");
INSERT INTO role_has_permissions VALUES("39","2");
INSERT INTO role_has_permissions VALUES("40","1");
INSERT INTO role_has_permissions VALUES("40","2");
INSERT INTO role_has_permissions VALUES("40","7");
INSERT INTO role_has_permissions VALUES("41","1");
INSERT INTO role_has_permissions VALUES("41","7");
INSERT INTO role_has_permissions VALUES("42","1");
INSERT INTO role_has_permissions VALUES("43","1");
INSERT INTO role_has_permissions VALUES("44","1");
INSERT INTO role_has_permissions VALUES("45","1");
INSERT INTO role_has_permissions VALUES("45","2");
INSERT INTO role_has_permissions VALUES("45","7");
INSERT INTO role_has_permissions VALUES("46","1");
INSERT INTO role_has_permissions VALUES("46","2");
INSERT INTO role_has_permissions VALUES("46","7");
INSERT INTO role_has_permissions VALUES("47","1");
INSERT INTO role_has_permissions VALUES("47","2");
INSERT INTO role_has_permissions VALUES("48","1");
INSERT INTO role_has_permissions VALUES("48","2");
INSERT INTO role_has_permissions VALUES("49","1");
INSERT INTO role_has_permissions VALUES("49","2");
INSERT INTO role_has_permissions VALUES("49","7");
INSERT INTO role_has_permissions VALUES("50","1");
INSERT INTO role_has_permissions VALUES("50","2");
INSERT INTO role_has_permissions VALUES("50","7");
INSERT INTO role_has_permissions VALUES("51","1");
INSERT INTO role_has_permissions VALUES("51","2");
INSERT INTO role_has_permissions VALUES("52","1");
INSERT INTO role_has_permissions VALUES("52","2");
INSERT INTO role_has_permissions VALUES("53","1");
INSERT INTO role_has_permissions VALUES("53","2");
INSERT INTO role_has_permissions VALUES("53","7");
INSERT INTO role_has_permissions VALUES("54","1");
INSERT INTO role_has_permissions VALUES("54","2");
INSERT INTO role_has_permissions VALUES("55","1");
INSERT INTO role_has_permissions VALUES("55","2");
INSERT INTO role_has_permissions VALUES("55","4");
INSERT INTO role_has_permissions VALUES("55","7");
INSERT INTO role_has_permissions VALUES("56","1");
INSERT INTO role_has_permissions VALUES("56","2");
INSERT INTO role_has_permissions VALUES("56","4");
INSERT INTO role_has_permissions VALUES("56","7");
INSERT INTO role_has_permissions VALUES("57","1");
INSERT INTO role_has_permissions VALUES("57","2");
INSERT INTO role_has_permissions VALUES("57","4");
INSERT INTO role_has_permissions VALUES("57","7");
INSERT INTO role_has_permissions VALUES("58","1");
INSERT INTO role_has_permissions VALUES("58","2");
INSERT INTO role_has_permissions VALUES("58","7");
INSERT INTO role_has_permissions VALUES("59","1");
INSERT INTO role_has_permissions VALUES("60","1");
INSERT INTO role_has_permissions VALUES("61","1");
INSERT INTO role_has_permissions VALUES("62","1");
INSERT INTO role_has_permissions VALUES("62","2");
INSERT INTO role_has_permissions VALUES("63","1");
INSERT INTO role_has_permissions VALUES("63","2");
INSERT INTO role_has_permissions VALUES("63","4");
INSERT INTO role_has_permissions VALUES("63","7");
INSERT INTO role_has_permissions VALUES("64","1");
INSERT INTO role_has_permissions VALUES("64","2");
INSERT INTO role_has_permissions VALUES("64","4");
INSERT INTO role_has_permissions VALUES("64","7");
INSERT INTO role_has_permissions VALUES("65","1");
INSERT INTO role_has_permissions VALUES("65","2");
INSERT INTO role_has_permissions VALUES("65","7");
INSERT INTO role_has_permissions VALUES("66","1");
INSERT INTO role_has_permissions VALUES("66","2");
INSERT INTO role_has_permissions VALUES("66","7");
INSERT INTO role_has_permissions VALUES("67","1");
INSERT INTO role_has_permissions VALUES("67","2");
INSERT INTO role_has_permissions VALUES("68","1");
INSERT INTO role_has_permissions VALUES("68","2");
INSERT INTO role_has_permissions VALUES("69","1");
INSERT INTO role_has_permissions VALUES("69","2");
INSERT INTO role_has_permissions VALUES("70","1");
INSERT INTO role_has_permissions VALUES("70","2");
INSERT INTO role_has_permissions VALUES("71","1");
INSERT INTO role_has_permissions VALUES("71","2");
INSERT INTO role_has_permissions VALUES("72","1");
INSERT INTO role_has_permissions VALUES("72","2");
INSERT INTO role_has_permissions VALUES("73","1");
INSERT INTO role_has_permissions VALUES("73","2");
INSERT INTO role_has_permissions VALUES("73","7");
INSERT INTO role_has_permissions VALUES("74","1");
INSERT INTO role_has_permissions VALUES("74","2");
INSERT INTO role_has_permissions VALUES("74","7");
INSERT INTO role_has_permissions VALUES("75","1");
INSERT INTO role_has_permissions VALUES("75","2");
INSERT INTO role_has_permissions VALUES("75","7");
INSERT INTO role_has_permissions VALUES("76","1");
INSERT INTO role_has_permissions VALUES("76","2");
INSERT INTO role_has_permissions VALUES("77","1");
INSERT INTO role_has_permissions VALUES("77","2");
INSERT INTO role_has_permissions VALUES("78","1");
INSERT INTO role_has_permissions VALUES("78","2");
INSERT INTO role_has_permissions VALUES("79","1");
INSERT INTO role_has_permissions VALUES("79","2");
INSERT INTO role_has_permissions VALUES("80","1");
INSERT INTO role_has_permissions VALUES("81","1");
INSERT INTO role_has_permissions VALUES("82","1");
INSERT INTO role_has_permissions VALUES("82","2");
INSERT INTO role_has_permissions VALUES("83","1");
INSERT INTO role_has_permissions VALUES("84","1");
INSERT INTO role_has_permissions VALUES("84","2");
INSERT INTO role_has_permissions VALUES("85","1");
INSERT INTO role_has_permissions VALUES("85","2");
INSERT INTO role_has_permissions VALUES("86","1");
INSERT INTO role_has_permissions VALUES("86","2");
INSERT INTO role_has_permissions VALUES("87","1");
INSERT INTO role_has_permissions VALUES("87","2");
INSERT INTO role_has_permissions VALUES("88","1");
INSERT INTO role_has_permissions VALUES("88","2");
INSERT INTO role_has_permissions VALUES("89","1");
INSERT INTO role_has_permissions VALUES("89","2");
INSERT INTO role_has_permissions VALUES("90","1");
INSERT INTO role_has_permissions VALUES("90","2");
INSERT INTO role_has_permissions VALUES("91","1");
INSERT INTO role_has_permissions VALUES("91","2");
INSERT INTO role_has_permissions VALUES("92","1");
INSERT INTO role_has_permissions VALUES("92","2");
INSERT INTO role_has_permissions VALUES("93","1");
INSERT INTO role_has_permissions VALUES("93","2");
INSERT INTO role_has_permissions VALUES("94","1");
INSERT INTO role_has_permissions VALUES("94","2");
INSERT INTO role_has_permissions VALUES("95","1");
INSERT INTO role_has_permissions VALUES("95","2");
INSERT INTO role_has_permissions VALUES("96","1");
INSERT INTO role_has_permissions VALUES("96","2");
INSERT INTO role_has_permissions VALUES("97","1");
INSERT INTO role_has_permissions VALUES("97","2");
INSERT INTO role_has_permissions VALUES("98","1");
INSERT INTO role_has_permissions VALUES("98","2");
INSERT INTO role_has_permissions VALUES("99","1");
INSERT INTO role_has_permissions VALUES("99","2");
INSERT INTO role_has_permissions VALUES("100","1");
INSERT INTO role_has_permissions VALUES("100","2");
INSERT INTO role_has_permissions VALUES("101","1");
INSERT INTO role_has_permissions VALUES("101","2");
INSERT INTO role_has_permissions VALUES("102","1");
INSERT INTO role_has_permissions VALUES("102","2");
INSERT INTO role_has_permissions VALUES("103","1");
INSERT INTO role_has_permissions VALUES("104","1");
INSERT INTO role_has_permissions VALUES("104","2");



CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `guard_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO roles VALUES("1","Super Admin","Super Admin dapat mengakses semua data...","web","1","2018-06-01 23:46:44","2021-03-01 18:36:08");
INSERT INTO roles VALUES("2","Owner","Owner dapat melihat semua data...","web","1","2018-10-22 02:38:13","2021-03-01 18:36:33");
INSERT INTO roles VALUES("4","Staff","Staff memiliki akses khusus ...","web","1","2018-06-02 00:05:27","2021-03-01 18:38:31");
INSERT INTO roles VALUES("5","Customer","Customer hanya dapat mengakses pembeliannya masing-masing...","web","1","2020-11-05 06:43:16","2021-03-01 18:40:04");
INSERT INTO roles VALUES("6","Cashier","Cashier hanya dapat menginput penjualan...","web","1","2021-02-25 08:12:27","2021-03-01 18:39:13");
INSERT INTO roles VALUES("7","Tes","","web","0","2021-03-02 20:31:04","2021-03-02 20:36:55");
INSERT INTO roles VALUES("8","Kayawan Umum","","web","1","2021-03-06 09:10:29","2021-03-06 09:10:29");



CREATE TABLE `sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `cash_register_id` int(11) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `biller_id` int(11) DEFAULT NULL,
  `item` int(11) NOT NULL,
  `total_qty` double NOT NULL,
  `total_discount` double NOT NULL,
  `total_tax` double NOT NULL,
  `total_price` double NOT NULL,
  `grand_total` double NOT NULL,
  `order_tax_rate` double DEFAULT NULL,
  `order_tax` double DEFAULT NULL,
  `order_discount` double DEFAULT NULL,
  `coupon_id` int(11) DEFAULT NULL,
  `coupon_discount` double DEFAULT NULL,
  `shipping_cost` double DEFAULT NULL,
  `sale_status` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paid_amount` double DEFAULT NULL,
  `sale_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `staff_note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=103 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO sales VALUES("1","sr-20210307-120603","31","1","1","1","1","1","1","0","0","283000","283000","0","0","","","","","1","4","","283000","","","2021-03-07 12:06:03","2021-03-08 08:36:56");
INSERT INTO sales VALUES("2","sr-20210308-071520","31","1","1","1","1","1","1","0","0","340000","340000","0","0","0","","","0","1","4","","340000","Harga Jual 350.000","","2021-03-08 07:15:20","2021-03-08 08:36:49");
INSERT INTO sales VALUES("4","sr-20210308-072323","31","1","1","1","1","1","1","0","0","350000","350000","0","0","","","","","1","4","","350000","","","2021-03-08 07:23:23","2021-03-08 08:36:38");
INSERT INTO sales VALUES("5","sr-20210308-082823","31","1","1","1","1","1","1","0","0","350000","330000","0","0","20000","","","","1","4","","330000","","","2021-03-08 08:28:23","2021-03-08 08:36:28");
INSERT INTO sales VALUES("6","sr-20210308-084845","31","1","1","1","1","1","1","0","0","283000","280000","0","0","3000","","","","1","4","","280000","","","2021-03-08 08:48:45","2021-03-08 10:20:55");
INSERT INTO sales VALUES("7","sr-20210319-064148","31","1","1","1","1","1","1","0","0","180000","180000","0","0","","","","","1","4","","180000","","","2021-03-19 06:41:48","2021-03-19 06:41:48");
INSERT INTO sales VALUES("8","sr-20210319-064400","31","1","1","1","1","1","1","0","0","250000","260000","0","0","","","","10000","1","4","","260000","","","2021-03-19 06:44:00","2021-03-19 06:44:00");
INSERT INTO sales VALUES("9","sr-20210319-064444","31","1","1","1","1","1","1","0","0","220000","220000","0","0","","","","","1","4","","220000","","","2021-03-19 06:44:44","2021-03-19 06:44:44");
INSERT INTO sales VALUES("10","sr-20210319-064742","31","1","1","1","1","1","1","0","0","150000","150000","0","0","","","","","1","4","","150000","","","2021-03-19 06:47:42","2021-03-19 06:47:42");
INSERT INTO sales VALUES("11","sr-20210319-064916","31","1","1","1","1","1","1","0","0","210000","220000","0","0","","","","10000","1","4","","220000","","","2021-03-19 06:49:16","2021-03-19 06:49:16");
INSERT INTO sales VALUES("12","sr-20210319-065019","31","1","1","1","1","1","1","0","0","220000","230000","0","0","","","","10000","1","4","","230000","","","2021-03-19 06:50:19","2021-03-19 06:50:19");
INSERT INTO sales VALUES("13","sr-20210319-065850","31","1","1","1","1","1","1","0","0","260000","260000","0","0","","","","","1","4","","260000","","","2021-03-19 06:58:50","2021-03-19 07:23:07");
INSERT INTO sales VALUES("14","sr-20210319-065945","31","1","1","1","1","1","1","0","0","230000","220000","0","0","10000","","","","1","4","","220000","","","2021-03-19 06:59:45","2021-03-19 07:23:13");
INSERT INTO sales VALUES("15","sr-20210319-070158","31","1","1","1","1","1","1","0","0","354000","354000","0","0","","","","","1","4","","354000","","","2021-03-19 07:01:58","2021-03-19 07:23:00");
INSERT INTO sales VALUES("16","sr-20210319-070706","31","1","1","1","1","1","1","0","0","190000","200000","0","0","","","","10000","1","4","","200000","","","2021-03-19 07:07:06","2021-03-19 07:20:14");
INSERT INTO sales VALUES("17","sr-20210319-070751","31","1","1","1","1","1","1","0","0","260000","280000","0","0","","","","20000","1","4","","280000","","","2021-03-19 07:07:51","2021-03-19 07:07:51");
INSERT INTO sales VALUES("18","sr-20210319-070823","31","1","1","1","1","1","1","0","0","180000","180000","0","0","","","","","1","4","","180000","","","2021-03-19 07:08:23","2021-03-19 07:08:23");
INSERT INTO sales VALUES("19","sr-20210319-070938","31","1","1","1","1","1","1","0","0","220000","220000","0","0","","","","","1","4","","220000","","","2021-03-19 07:09:38","2021-03-19 07:19:36");
INSERT INTO sales VALUES("20","sr-20210319-071003","31","1","1","1","1","1","1","0","0","140000","140000","0","0","","","","","1","4","","140000","","","2021-03-19 07:10:03","2021-03-19 07:19:29");
INSERT INTO sales VALUES("21","sr-20210319-071255","31","1","1","1","1","1","1","0","0","354000","354000","0","0","","","","","1","4","","354000","","","2021-03-19 07:12:55","2021-03-19 07:12:55");
INSERT INTO sales VALUES("22","sr-20210319-071750","31","1","1","1","1","1","1","0","0","190000","185000","0","0","5000","","","","1","4","","185000","","","2021-03-19 07:17:50","2021-03-19 07:17:50");
INSERT INTO sales VALUES("23","sr-20210319-072622","31","1","1","1","1","1","2","0","0","340000","340000","0","0","","","","","1","4","","340000","","","2021-03-19 07:26:22","2021-03-19 07:26:22");
INSERT INTO sales VALUES("24","sr-20210319-072748","31","1","1","1","1","1","1","0","0","180000","190000","0","0","","","","10000","1","4","","190000","","","2021-03-19 07:27:48","2021-03-19 07:27:48");
INSERT INTO sales VALUES("25","sr-20210319-073249","31","1","1","1","1","1","1","0","0","354000","354000","0","0","","","","","1","4","","354000","","","2021-03-19 07:32:49","2021-03-19 07:32:49");
INSERT INTO sales VALUES("26","sr-20210319-073317","31","1","1","1","1","1","1","0","0","180000","180000","0","0","","","","","1","4","","180000","","","2021-03-19 07:33:17","2021-03-19 07:33:17");
INSERT INTO sales VALUES("27","sr-20210319-073425","31","1","1","1","1","1","1","0","0","250000","260000","0","0","","","","10000","1","4","","260000","","","2021-03-19 07:34:25","2021-03-19 07:34:25");
INSERT INTO sales VALUES("28","sr-20210319-073609","31","1","1","1","1","1","1","0","0","210000","220000","0","0","","","","10000","1","4","","220000","","","2021-03-19 07:36:09","2021-03-19 07:36:09");
INSERT INTO sales VALUES("29","sr-20210319-073828","31","1","1","1","1","1","1","0","0","170000","170000","0","0","","","","","1","4","","170000","","","2021-03-19 07:38:28","2021-03-19 07:38:28");
INSERT INTO sales VALUES("30","sr-20210319-094312","31","1","1","1","1","1","1","0","0","350000","340000","0","0","10000","","","","1","4","","340000","","","2021-03-19 09:43:12","2021-03-19 09:43:12");
INSERT INTO sales VALUES("31","sr-20210319-094522","31","1","1","1","1","1","1","0","0","280000","280000","0","0","","","","","1","4","","280000","","","2021-03-19 09:45:22","2021-03-19 09:45:22");
INSERT INTO sales VALUES("32","sr-20210319-094651","31","1","1","1","1","1","1","0","0","220000","230000","0","0","","","","10000","1","4","","230000","","","2021-03-19 09:46:51","2021-03-19 09:46:51");
INSERT INTO sales VALUES("33","sr-20210319-094829","31","1","1","1","1","1","1","0","0","230000","240000","0","0","","","","10000","1","4","","240000","","","2021-03-19 09:48:29","2021-03-19 09:48:29");
INSERT INTO sales VALUES("34","sr-20210319-095123","31","1","1","1","1","3","3","0","0","600000","590000","0","0","10000","","","","1","4","","590000","","","2021-03-19 09:51:23","2021-03-19 09:51:23");
INSERT INTO sales VALUES("35","sr-20210319-095223","31","1","1","1","1","1","1","0","0","300000","320000","0","0","","","","20000","1","4","","320000","","","2021-03-19 09:52:23","2021-03-19 09:52:23");
INSERT INTO sales VALUES("36","sr-20210319-095520","31","1","1","1","1","1","1","0","0","354000","354000","0","0","","","","","1","4","","354000","","","2021-03-19 09:55:20","2021-03-19 09:55:20");
INSERT INTO sales VALUES("37","sr-20210319-095611","31","1","1","1","1","1","1","0","0","180000","180000","0","0","","","","","1","4","","180000","","","2021-03-19 09:56:11","2021-03-19 09:56:11");
INSERT INTO sales VALUES("38","sr-20210319-120241","31","1","1","1","1","1","1","0","0","220000","230000","0","0","","","","10000","1","4","","230000","","","2021-03-19 12:02:41","2021-03-19 12:02:41");
INSERT INTO sales VALUES("39","sr-20210319-120425","31","1","1","1","1","1","1","0","0","260000","260000","0","0","","","","","1","4","","260000","","","2021-03-19 12:04:25","2021-03-19 12:04:25");
INSERT INTO sales VALUES("40","sr-20210319-120521","31","1","1","1","1","1","1","0","0","350000","350000","0","0","","","","","1","4","","350000","","","2021-03-19 12:05:21","2021-03-19 12:05:21");
INSERT INTO sales VALUES("41","sr-20210319-120652","31","1","1","1","1","1","1","0","0","230000","230000","0","0","","","","","1","4","","230000","","","2021-03-19 12:06:52","2021-03-19 12:06:52");
INSERT INTO sales VALUES("42","sr-20210319-120911","31","1","1","1","1","1","1","0","0","354000","354000","0","0","","","","","1","4","","354000","","","2021-03-19 12:09:11","2021-03-19 12:09:11");
INSERT INTO sales VALUES("43","sr-20210319-120959","31","1","1","1","1","1","1","0","0","300000","320000","0","0","","","","20000","1","4","","320000","","","2021-03-19 12:09:59","2021-03-19 12:09:59");
INSERT INTO sales VALUES("44","sr-20210319-121158","31","1","1","1","1","3","4","0","0","1000000","1000000","0","0","","","","","1","4","","1000000","","","2021-03-19 12:11:58","2021-03-19 12:11:58");
INSERT INTO sales VALUES("45","sr-20210319-121227","31","1","1","1","1","1","1","0","0","170000","170000","0","0","","","","","1","4","","170000","","","2021-03-19 12:12:27","2021-03-19 12:12:27");
INSERT INTO sales VALUES("46","sr-20210319-121428","31","1","1","1","1","1","2","0","0","700000","680000","0","0","20000","","","","1","4","","680000","","","2021-03-19 12:14:28","2021-03-19 12:14:28");
INSERT INTO sales VALUES("47","sr-20210319-121609","31","1","1","1","1","1","1","0","0","283000","280000","0","0","3000","","","","1","4","","280000","","","2021-03-19 12:16:09","2021-03-19 12:16:09");
INSERT INTO sales VALUES("48","sr-20210319-121804","31","1","1","1","1","1","1","0","0","290000","290000","0","0","","","","","1","4","","290000","","","2021-03-19 12:18:04","2021-03-19 12:18:04");
INSERT INTO sales VALUES("49","sr-20210319-122221","31","1","1","1","1","1","1","0","0","180000","180000","0","0","","","","","1","4","","180000","","","2021-03-19 12:22:21","2021-03-19 12:22:21");
INSERT INTO sales VALUES("50","sr-20210319-122345","31","1","1","1","1","1","1","0","0","220000","240000","0","0","","","","20000","1","4","","240000","","","2021-03-19 12:23:45","2021-03-19 12:23:45");
INSERT INTO sales VALUES("51","sr-20210319-124219","31","1","1","1","1","3","4","0","0","1203000","1210000","0","0","","","","7000","1","4","","1210000","","","2021-03-19 12:42:19","2021-03-19 12:42:19");
INSERT INTO sales VALUES("52","sr-20210319-125130","31","1","1","1","1","1","1","0","0","290000","310000","0","0","","","","20000","1","4","","310000","","","2021-03-19 12:51:30","2021-03-19 12:51:30");
INSERT INTO sales VALUES("53","sr-20210320-025747","31","1","1","1","1","1","1","0","0","190000","200000","0","0","","","","10000","1","4","","200000","","","2021-03-20 02:57:47","2021-03-20 02:57:47");
INSERT INTO sales VALUES("54","sr-20210320-032018","31","1","1","1","1","1","3","0","0","510000","450000","0","0","60000","","","","1","4","","450000","","","2021-03-20 03:20:18","2021-03-20 03:20:18");
INSERT INTO sales VALUES("55","sr-20210320-051416","31","1","1","1","1","2","2","0","0","410000","420000","0","0","","","","10000","1","4","","420000","","","2021-03-20 05:14:16","2021-03-20 05:14:16");
INSERT INTO sales VALUES("56","sr-20210320-062822","31","1","1","1","1","1","1","0","0","220000","240000","0","0","","","","20000","1","4","","240000","","","2021-03-20 06:28:22","2021-03-20 06:28:22");
INSERT INTO sales VALUES("57","sr-20210321-071204","31","1","1","1","1","1","1","0","0","230000","220000","0","0","10000","","","","1","4","","220000","","","2021-03-21 07:12:04","2021-03-21 07:12:04");
INSERT INTO sales VALUES("58","sr-20210321-071540","31","1","1","1","1","1","1","0","0","290000","350000","0","0","","","","60000","1","4","","350000","","","2021-03-21 07:15:40","2021-03-21 07:15:40");
INSERT INTO sales VALUES("59","sr-20210321-071634","31","1","1","1","1","1","1","0","0","220000","220000","0","0","","","","","1","4","","220000","","","2021-03-21 07:16:34","2021-03-21 07:16:34");
INSERT INTO sales VALUES("60","sr-20210321-071724","31","1","1","1","1","1","3","0","0","780000","690000","0","0","90000","","","","1","4","","690000","","","2021-03-21 07:17:24","2021-03-21 07:17:24");
INSERT INTO sales VALUES("61","sr-20210321-072125","31","1","1","1","1","1","1","0","0","260000","270000","0","0","","","","10000","1","4","","270000","","","2021-03-21 07:21:25","2021-03-21 07:21:25");
INSERT INTO sales VALUES("62","sr-20210321-072523","31","1","1","1","1","1","1","0","0","150000","150000","0","0","","","","","1","4","","150000","","","2021-03-21 07:25:23","2021-03-21 07:25:23");
INSERT INTO sales VALUES("63","sr-20210321-074949","31","1","1","1","1","2","2","0","0","360000","370000","0","0","","","","10000","1","4","","370000","","","2021-03-21 07:49:49","2021-03-21 07:49:49");
INSERT INTO sales VALUES("64","sr-20210321-075347","31","1","1","1","1","2","2","0","0","480000","480000","0","0","","","","","1","4","","480000","","","2021-03-21 07:53:47","2021-03-21 07:53:47");
INSERT INTO sales VALUES("65","sr-20210321-075536","31","1","1","1","1","2","2","0","0","360000","360000","0","0","","","","","1","4","","360000","","","2021-03-21 07:55:36","2021-03-21 07:55:36");
INSERT INTO sales VALUES("66","sr-20210321-075923","31","1","1","1","1","3","4","0","0","730000","740000","0","0","","","","10000","1","4","","740000","","","2021-03-21 07:59:23","2021-03-21 07:59:23");
INSERT INTO sales VALUES("67","sr-20210321-081137","31","1","1","1","1","2","2","0","0","450000","450000","0","0","","","","","1","4","","450000","","","2021-03-21 08:11:37","2021-03-21 08:11:37");
INSERT INTO sales VALUES("68","sr-20210321-085422","31","1","1","1","1","1","1","0","0","180000","180000","0","0","","","","","1","4","","180000","","","2021-03-21 08:54:22","2021-03-21 08:54:22");
INSERT INTO sales VALUES("69","sr-20210321-085648","31","1","1","1","1","3","3","0","0","400000","400000","0","0","","","","","1","4","","400000","","","2021-03-21 08:56:48","2021-03-21 08:56:48");
INSERT INTO sales VALUES("70","sr-20210321-090208","31","1","1","1","1","6","8","0","0","1690000","1690000","0","0","","","","","1","4","","1690000","","","2021-03-21 09:02:08","2021-03-21 09:02:08");
INSERT INTO sales VALUES("71","sr-20210321-090607","31","1","1","1","1","9","9","0","0","1900000","1920000","0","0","","","","20000","1","4","","1920000","","","2021-03-21 09:06:07","2021-03-21 09:06:07");
INSERT INTO sales VALUES("72","sr-20210321-090657","31","1","1","1","1","1","1","0","0","180000","190000","0","0","","","","10000","1","4","","190000","","","2021-03-21 09:06:57","2021-03-21 09:06:57");
INSERT INTO sales VALUES("73","sr-20210321-091256","31","1","1","1","1","3","3","0","0","790000","790000","0","0","","","","","1","4","","790000","","","2021-03-21 09:12:56","2021-03-21 09:12:56");
INSERT INTO sales VALUES("74","sr-20210321-092013","31","1","1","1","1","5","5","0","0","1040000","1050000","0","0","","","","10000","1","4","","1050000","","","2021-03-21 09:20:13","2021-03-21 09:20:13");
INSERT INTO sales VALUES("75","sr-20210321-092754","31","1","1","1","1","3","3","0","0","760000","760000","0","0","","","","","1","4","","760000","","","2021-03-21 09:27:54","2021-03-21 09:27:54");
INSERT INTO sales VALUES("76","sr-20210321-092948","31","1","1","1","1","4","5","0","0","960000","960000","0","0","","","","","1","4","","960000","","","2021-03-21 09:29:48","2021-03-21 09:29:48");
INSERT INTO sales VALUES("77","sr-20210321-093323","31","1","1","1","1","4","5","0","0","1080000","1080000","0","0","","","","","1","4","","1080000","","","2021-03-21 09:33:23","2021-03-21 09:33:23");
INSERT INTO sales VALUES("78","sr-20210321-093605","31","1","1","1","1","4","4","0","0","900000","900000","0","0","","","","","1","4","","900000","","","2021-03-21 09:36:05","2021-03-21 09:36:05");
INSERT INTO sales VALUES("79","sr-20210321-093825","31","1","1","1","1","2","4","0","0","880000","805000","0","0","75000","","","","1","4","","805000","","","2021-03-21 09:38:25","2021-03-21 09:38:25");
INSERT INTO sales VALUES("80","sr-20210321-094233","31","1","1","1","1","4","10","0","0","1640000","1515000","0","0","175000","","","50000","1","4","","1515000","","","2021-03-21 09:42:33","2021-03-21 09:42:33");
INSERT INTO sales VALUES("81","sr-20210321-094448","31","1","1","1","1","3","3","0","0","650000","650000","0","0","","","","","1","4","","650000","","","2021-03-21 09:44:48","2021-03-21 09:44:48");
INSERT INTO sales VALUES("82","sr-20210321-094538","31","1","1","1","1","1","2","0","0","360000","370000","0","0","","","","10000","1","4","","370000","","","2021-03-21 09:45:38","2021-03-21 09:45:38");
INSERT INTO sales VALUES("83","sr-20210321-095045","31","1","1","1","1","4","8","0","0","1330000","1270000","0","0","70000","","","10000","1","4","","1270000","","","2021-03-21 09:50:45","2021-03-22 04:55:26");
INSERT INTO sales VALUES("84","sr-20210321-095140","31","1","1","1","1","2","2","0","0","440000","440000","0","0","","","","","1","4","","440000","","","2021-03-21 09:51:40","2021-03-21 09:51:40");
INSERT INTO sales VALUES("85","sr-20210321-095519","31","1","1","1","1","4","4","0","0","780000","780000","0","0","","","","","1","4","","780000","","","2021-03-21 09:55:19","2021-03-22 04:55:33");
INSERT INTO sales VALUES("86","sr-20210322-045202","31","1","1","1","1","3","6","0","0","1090000","1020000","0","0","90000","","","20000","1","4","","1020000","","","2021-03-22 04:52:02","2021-03-22 04:55:42");
INSERT INTO sales VALUES("87","sr-20210322-045442","31","1","1","1","1","4","4","0","0","740000","740000","0","0","","","","","1","4","","740000","","","2021-03-22 04:54:42","2021-03-22 04:54:42");
INSERT INTO sales VALUES("88","sr-20210322-045655","31","1","1","1","1","2","2","0","0","460000","460000","0","0","","","","","1","4","","460000","","","2021-03-22 04:56:55","2021-03-22 04:56:55");
INSERT INTO sales VALUES("89","sr-20210322-050152","31","1","1","1","1","3","3","0","0","640000","640000","0","0","","","","","1","4","","640000","","","2021-03-22 05:01:52","2021-03-22 05:01:52");
INSERT INTO sales VALUES("90","sr-20210322-050625","31","1","1","1","1","6","7","0","0","1510000","1510000","0","0","","","","","1","4","","1510000","","","2021-03-22 05:06:25","2021-03-22 05:06:25");
INSERT INTO sales VALUES("91","sr-20210323-074013","31","1","1","1","1","1","1","0","0","260000","260000","0","0","","","","","1","4","","260000","","","2021-03-23 07:40:13","2021-03-23 07:40:13");
INSERT INTO sales VALUES("92","sr-20210324-015116","31","1","1","1","1","2","2","0","0","620000","620000","0","0","","","","","1","4","","620000","","","2021-03-24 01:51:16","2021-03-24 01:51:37");
INSERT INTO sales VALUES("93","sr-20210324-121010","31","1","1","1","1","2","2","0","0","500000","500000","0","0","","","","","1","4","","500000","","","2021-03-24 12:10:10","2021-03-24 12:10:10");
INSERT INTO sales VALUES("94","sr-20210324-123920","31","1","1","1","1","1","1","0","0","170000","170000","0","0","","","","","1","4","","170000","","","2021-03-24 12:39:20","2021-03-25 08:13:50");
INSERT INTO sales VALUES("95","sr-20210324-124401","31","1","1","1","1","1","1","0","0","220000","220000","0","0","","","","","1","4","","220000","","","2021-03-24 12:44:01","2021-03-24 12:44:01");
INSERT INTO sales VALUES("96","sr-20210325-081058","31","1","1","1","1","1","1","0","0","260000","260000","0","0","0","","","0","1","4","","260000","","","2021-03-25 08:10:58","2021-03-25 08:14:31");
INSERT INTO sales VALUES("97","sr-20210325-090707","31","1","1","1","1","1","1","0","0","260000","265000","0","0","","","","5000","1","1","","","","","2021-03-25 09:07:07","2021-03-25 09:07:07");
INSERT INTO sales VALUES("98","sr-20210325-121440","31","1","1","1","1","1","1","0","0","190000","190000","0","0","","","","","1","4","","190000","","","2021-03-25 12:14:40","2021-03-25 12:14:40");
INSERT INTO sales VALUES("99","sr-20210325-121720","31","1","1","1","1","1","1","0","0","260000","260000","0","0","","","","","1","4","","260000","","","2021-03-25 12:17:20","2021-03-25 12:17:20");
INSERT INTO sales VALUES("100","sr-20210325-121744","31","1","1","1","1","1","1","0","0","220000","220000","0","0","","","","","1","4","","220000","","","2021-03-25 12:17:44","2021-03-25 12:17:44");
INSERT INTO sales VALUES("101","sr-20210326-050222","31","1","1","1","1","2","2","0","0","460000","460000","0","0","","","","","1","4","","460000","","","2021-03-26 05:02:22","2021-03-26 05:02:22");
INSERT INTO sales VALUES("102","sr-20210418-081319","31","1","1","1","1","2","7","0","0","1240000","1240000","0","0","","","","","1","4","","1240000","","","2021-04-18 08:13:19","2021-04-18 08:13:19");



CREATE TABLE `stock_counts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `category_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `brand_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `initial_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `final_file` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_adjusted` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `suppliers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vat_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `state` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postal_code` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO suppliers VALUES("1","ROLUN-M5T","","PT Jaya Abadi Garment","","rolun@gmail.com","-","Taman Holis Indah","Bandung","","","","1","2021-03-13 16:48:27","2021-03-13 16:48:27");
INSERT INTO suppliers VALUES("2","Cardinal","","PT Multi Garmenjaya","","cardinal@gmail.com","-","Samarinda","Samarinda","","","","1","2021-03-13 16:50:05","2021-03-13 16:50:05");
INSERT INTO suppliers VALUES("3","Cressida","","PT GRAHASARANA INTI SENTOSA","","cressida@gmail.com","-","Samarinda","Samarinda","","","","1","2021-03-13 16:50:46","2021-03-13 16:50:46");
INSERT INTO suppliers VALUES("4","Orlena","","Toko Orlena Metro","","orlena@gmail.com","-","Tanah Abang","Jakarta","","","","1","2021-03-25 12:56:04","2021-03-25 12:59:14");
INSERT INTO suppliers VALUES("5","Hugo-RBJ","","Toko Hugo RBJ Mangga Dua","","mangdu@gmail.com","-","Pasar Pagi manggadua","Jakarta","","","","1","2021-03-25 12:58:04","2021-03-25 12:58:04");
INSERT INTO suppliers VALUES("6","Beibz","","Toko Beibz METRO","","beibz@gmail.com","-","Tanah Abang","Jakarta","","","","1","2021-03-25 12:58:58","2021-03-25 12:58:58");
INSERT INTO suppliers VALUES("7","Poinplus","","Toko Poinplus","","poinplus@gmail.com","-","Tanah Abang","Jakarta","","","","1","2021-03-26 05:54:39","2021-03-26 05:54:39");
INSERT INTO suppliers VALUES("8","Redmee","","Toko Redmee","","redmee@gmail.com","-","Tanah Abang","Jakarta","","","","1","2021-03-26 05:55:34","2021-03-26 05:55:34");
INSERT INTO suppliers VALUES("9","Fabio","","Toko Fabio","","fabio@gmail.com","-","Tanah Abang","Jakarta","","","","1","2021-03-26 06:06:26","2021-03-26 06:06:26");
INSERT INTO suppliers VALUES("10","TKMY","","Toko Takashimaya","","tkmy@gmail.com","-","Tanah Abang","Jakarta","","","","1","2021-03-26 06:07:12","2021-03-26 06:07:12");
INSERT INTO suppliers VALUES("11","Javano","","Toko Javano","","javano@gmail.com","-","Tanah Abang","Jakarta","","","","1","2021-03-26 06:08:00","2021-03-26 06:08:00");
INSERT INTO suppliers VALUES("12","W AND D","","Toko W&D","","wendi@gmail.com","-","Tanah Abang","Jakarta","","","","1","2021-03-26 06:08:31","2021-03-26 06:08:31");
INSERT INTO suppliers VALUES("13","Sinar Cahaya","","Toko Sinar Cahaya","","sinarc@gmail.com","-","Tanah Abang","Jakarta","","","","1","2021-03-26 06:09:15","2021-03-26 06:09:15");
INSERT INTO suppliers VALUES("14","Gio","","Toko Gio-F","","giof@gmail.com","081383608814","Tanah Abang","Jakarta","","","","1","2021-03-26 06:22:41","2021-03-26 06:22:41");
INSERT INTO suppliers VALUES("15","LMC","","LMC Sporty Jeans","","lmc@gmail.com","082125890516","Tanah Abang","Jakarta","","","","1","2021-03-26 06:28:47","2021-03-26 06:28:47");
INSERT INTO suppliers VALUES("16","KLARA","","Toko KLARA","","KLARA@GMAIL.COM","081585354445","Tanah Abang","Jakarta","","","","1","2021-03-26 06:49:22","2021-03-26 06:49:22");
INSERT INTO suppliers VALUES("17","Al-Fajri","","Toko Al-Fajri","","alfajri@gmail.com","081322855995","Tanah Abang","Jakarta","","","","1","2021-04-05 03:00:30","2021-04-05 03:00:30");
INSERT INTO suppliers VALUES("18","Erkape","","Toko Erkape","","erkape@gmail.com","081398991167","Cipulir","Jakarta","","","","1","2021-04-05 03:39:20","2021-04-05 03:39:20");
INSERT INTO suppliers VALUES("19","Pratama","","Toko Pratama","","pratama@gmail.com","081286264943","Tanah Abang","Jakarta","","","","1","2021-04-05 03:45:20","2021-04-05 03:45:20");
INSERT INTO suppliers VALUES("20","Hausi","","Toko Hausi","","hausi@gmail.com","081385809397","Tanah Abang","Jakarta","","","","1","2021-04-05 07:28:04","2021-04-05 07:28:04");
INSERT INTO suppliers VALUES("21","BLUEJEANS","","TOKO BLUE JEANS","","bluejeans@gmail.com","081317348828","Cipulir","Jakarta","","","","1","2021-04-17 06:24:54","2021-04-17 06:24:54");
INSERT INTO suppliers VALUES("22","Faiza","","Toko Faiza","","faiza@gmail.com","085697764163","Tanah Abang","Jakarta","","","","1","2021-04-18 07:45:13","2021-04-18 07:45:13");
INSERT INTO suppliers VALUES("23","Super Grosir","","Toko Super Grosir Group","","supergrosir@gmail.com","0213904604","-","Jakarta","","","","1","2021-04-18 08:06:20","2021-04-18 08:06:20");
INSERT INTO suppliers VALUES("24","Chandra","","Rockshow/KING M","","chandra@gmail.com","0812","Samarinda","Samarinda","","","","1","2021-04-18 08:15:28","2021-04-18 08:15:28");
INSERT INTO suppliers VALUES("25","Narita Lie","","Narita Lie Collection","","naritalie@gmail.com","082234544778","Tanah Abang","Jakarta","","","","1","2021-04-18 08:27:32","2021-04-18 08:27:32");
INSERT INTO suppliers VALUES("26","Wewe Jaya","","Toko Wewe Jaya","","wewejaya@gmail.com","081242588860","Tanah Abang","Jakarta","","","","1","2021-04-18 08:48:39","2021-04-18 08:48:39");



CREATE TABLE `taxes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` double NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `transfers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reference_no` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `from_warehouse_id` int(11) NOT NULL,
  `to_warehouse_id` int(11) NOT NULL,
  `item` int(11) NOT NULL,
  `total_qty` double NOT NULL,
  `total_tax` double NOT NULL,
  `total_cost` double NOT NULL,
  `shipping_cost` double DEFAULT NULL,
  `grand_total` double NOT NULL,
  `document` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;




CREATE TABLE `units` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `unit_code` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `unit_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `base_unit` int(11) DEFAULT NULL,
  `operator` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `operation_value` double DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO units VALUES("1","Unit","Pieces","","*","1","1","2021-03-06 12:44:53","2021-03-07 12:55:30");
INSERT INTO units VALUES("2","Grosir","Grosir","","*","1","1","2021-04-19 06:51:31","2021-04-19 06:51:31");
INSERT INTO units VALUES("3","Reseller","Reseller","","*","1","1","2021-04-19 06:51:53","2021-04-19 06:51:53");



CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `biller_id` int(11) DEFAULT NULL,
  `warehouse_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO users VALUES("1","manajemen_nania","admin@manajemen.co.id","$2y$10$EoIHCoGURCJOfh5AslGgYuOg6HDThbp3KIoPItRfJRzXJ9o9Z.SMW","g6tiU7GVSy9Mt7Drbi0SnbqGilwWO1aWfDdQuEXGfQ4GoYNFNNnPx3zlGw6b","085215886354","Manajemen Indonesia","1","","","1","0","2018-06-02 03:24:15","2021-03-14 11:34:48");
INSERT INTO users VALUES("3","dhiman da","dhiman@gmail.com","$2y$10$Fef6vu5E67nm11hX7V5a2u1ThNCQ6n9DRCvRF9TD7stk.Pmt2R6O.","5ehQM6JIfiQfROgTbB5let0Z93vjLHS7rd9QD5RPNgOxli3xdo7fykU7vtTt","212","lioncoders","1","","","0","1","2018-06-13 22:00:31","2020-11-05 07:06:51");
INSERT INTO users VALUES("6","test","test@gmail.com","$2y$10$TDAeHcVqHyCmurki0wjLZeIl1SngKX3WLOhyTiCoZG3souQfqv.LS","KpW1gYYlOFacumklO2IcRfSsbC3KcWUZzOI37gqoqM388Xie6KdhaOHIFEYm","1234","212312","4","","","0","1","2018-06-23 03:05:33","2018-06-23 03:13:45");
INSERT INTO users VALUES("8","test","test@yahoo.com","$2y$10$hlMigidZV0j2/IPkgE/xsOSb8WM2IRlsMv.1hg1NM7kfyd6bGX3hC","","31231","","4","","","0","1","2018-06-24 22:35:49","2018-07-02 01:07:39");
INSERT INTO users VALUES("9","owner","owner@mail.com","$2y$10$Am1LH.DJFfbWYnrieJ44WOSValxml2Byhh53VdHCHGIiTV3MnQQYe","DIDsmdI5kMZfkk2n4OkOpuH8yYHs3O0aPp9xUO0zuY4TwPvylsW5H6ovgE0K","12345","Klien","2","","","0","1","2018-07-02 01:08:08","2021-03-02 20:18:12");
INSERT INTO users VALUES("10","abul","abul@alpha.com","$2y$10$5zgB2OOMyNBNVAd.QOQIju5a9fhNnTqPx5H6s4oFlXhNiF6kXEsPq","x7HlttI5bM0vSKViqATaowHFJkLS3PHwfvl7iJdFl5Z1SsyUgWCVbLSgAoi0","1234","anda","1","","","0","1","2018-09-07 23:44:48","2021-03-01 18:49:54");
INSERT INTO users VALUES("11","teststaff","a@a.com","$2y$10$5KNBIIhZzvvZEQEhkHaZGu.Q8bbQNfqYvYgL5N55B8Pb4P5P/b/Li","DkHDEcCA0QLfsKPkUK0ckL0CPM6dPiJytNa0k952gyTbeAyMthW3vi7IRitp","111","aa","4","5","1","0","1","2018-10-22 02:47:56","2018-10-23 02:10:56");
INSERT INTO users VALUES("12","john","john@gmail.com","$2y$10$P/pN2J/uyTYNzQy2kRqWwuSv7P2f6GE/ykBwtHdda7yci3XsfOKWe","O0f1WJBVjT5eKYl3Js5l1ixMMtoU6kqrH7hbHDx9I1UCcD9CmiSmCBzHbQZg","10001","","4","2","2","0","1","2018-12-30 00:48:37","2019-03-06 04:59:49");
INSERT INTO users VALUES("13","jjj","test@test.com","$2y$10$/Qx3gHWYWUhlF1aPfzXaCeZA7fRzfSEyCIOnk/dcC4ejO8PsoaalG","","1213","","1","","","0","1","2019-01-03 00:08:31","2019-03-03 04:02:29");
INSERT INTO users VALUES("19","pelanggan","pelanggan@mail.com","$2y$10$7CWPZlLNIBo/itr7YNPeTO60D42xSVON1QYaIPmEshyKizbmUR6AK","","12345","Klien A","5","","","0","1","2020-11-09 00:07:16","2021-03-06 09:31:32");
INSERT INTO users VALUES("21","modon","modon@gmail.com","$2y$10$7VpoeGMkP8QCvL5zLwFW..6MYJ5MRumDLDoX.TTQtClS561rpFHY.","","2222","modon company","5","","","0","1","2020-11-13 07:12:08","2021-03-01 18:50:17");
INSERT INTO users VALUES("22","dhiman","dhiman@gmail.com","$2y$10$3mPygsC6wwnDtw/Sg85IpuExtUhgaHx52Lwp7Rz0.FNfuFdfKVpRq","","+8801111111101","lioncoders","5","","","0","1","2020-11-15 06:14:58","2021-03-01 18:50:17");
INSERT INTO users VALUES("29","Kasir1","oce@gmail.com","$2y$10$p70f8uTT.cTrp2FhbdrLUePIPu5mmZjb7PJ94A08rZSP3e7tfVBxy","","123","PT Haz Alfabet Indonesia","6","1","1","1","0","2021-02-25 08:14:33","2021-02-25 08:14:33");
INSERT INTO users VALUES("30","faldo","faldo@nania.store","$2y$10$CSexw28R55Uw7BT6Jko5meaMHCF6dsatzR1R/qckfWHUOlD39ow/q","","081314651247","Nania Store","2","","","1","0","2021-03-02 20:17:50","2021-03-02 20:17:50");
INSERT INTO users VALUES("31","ivania","ivania@nania.store","$2y$10$zeYHpNb0EpfA21GvpqQE7..kEFZshhp1qHaDC8w1OE2BNC1zv/xU.","","081281680748","Nania Store","2","","","1","0","2021-03-02 20:19:15","2021-03-02 20:19:15");
INSERT INTO users VALUES("32","andri","ahgada@mail.com","$2y$10$pm.ibz62COcnnrCuOaZRQuKK/YQysIsnAOvydfIzZx0cklCGQv3fK","","822625242","","5","","","0","1","2021-03-06 08:58:23","2021-03-06 09:01:03");
INSERT INTO users VALUES("33","andrian","ahagag@mail.com","$2y$10$epRcojr/w2DBmprPfVU0VO91vqAw7kb4LiPeCW0B9TP/ZQBMI6zxW","","1425242","","5","","","1","0","2021-03-06 09:01:41","2021-03-06 09:01:41");
INSERT INTO users VALUES("34","irwan","irwan@mail.com","$2y$10$ma1KCnmMJOo4ycZqMMtI6O0PJl/Cnf9Z.bV13hQmq3WEndBVFUXye","","0928337733","","8","1","2","0","1","2021-03-06 09:14:21","2021-03-06 09:30:34");
INSERT INTO users VALUES("35","ando","ando@mail.com","$2y$10$YynxIUfOnTmaR.BAi6t2Y./CrMC5CdUXxHLqRn4JLAFce5jxXNu0K","","7565857565","","8","1","3","1","0","2021-03-06 09:17:08","2021-03-06 09:17:08");



CREATE TABLE `variants` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO variants VALUES("1","28","2021-03-06 12:48:11","2021-03-06 12:48:11");
INSERT INTO variants VALUES("2","29","2021-03-06 12:48:11","2021-03-06 12:48:11");
INSERT INTO variants VALUES("3","30","2021-03-06 12:48:11","2021-03-06 12:48:11");
INSERT INTO variants VALUES("4","31","2021-03-06 12:48:11","2021-03-06 12:48:11");
INSERT INTO variants VALUES("5","32","2021-03-06 12:48:11","2021-03-06 12:48:11");
INSERT INTO variants VALUES("6","33","2021-03-07 04:05:14","2021-03-07 04:05:14");
INSERT INTO variants VALUES("7","34","2021-03-07 04:05:14","2021-03-07 04:05:14");
INSERT INTO variants VALUES("8","35","2021-03-07 04:05:14","2021-03-07 04:05:14");
INSERT INTO variants VALUES("9","36","2021-03-07 04:05:14","2021-03-07 04:05:14");
INSERT INTO variants VALUES("10","37","2021-03-07 04:05:14","2021-03-07 04:05:14");
INSERT INTO variants VALUES("11","38","2021-03-07 04:05:14","2021-03-07 04:05:14");
INSERT INTO variants VALUES("12","28-32","2021-03-07 12:22:50","2021-03-07 12:22:50");
INSERT INTO variants VALUES("13","Size 28-32","2021-03-07 12:27:49","2021-03-07 12:27:49");
INSERT INTO variants VALUES("14","Size 33-38","2021-03-07 12:27:49","2021-03-07 12:27:49");
INSERT INTO variants VALUES("15","40","2021-03-07 12:42:01","2021-03-07 12:42:01");
INSERT INTO variants VALUES("16","42","2021-03-07 12:42:01","2021-03-07 12:42:01");
INSERT INTO variants VALUES("17","44","2021-03-07 12:42:01","2021-03-07 12:42:01");
INSERT INTO variants VALUES("18","Beige","2021-03-25 12:50:48","2021-03-25 12:50:48");
INSERT INTO variants VALUES("19","Peanut","2021-03-25 12:50:48","2021-03-25 12:50:48");
INSERT INTO variants VALUES("20","Khaky","2021-03-25 12:50:48","2021-03-25 12:50:48");
INSERT INTO variants VALUES("21","Deep Taupe","2021-03-25 12:50:48","2021-03-25 12:50:48");
INSERT INTO variants VALUES("22","Coklat Muda","2021-03-25 12:54:12","2021-03-25 12:54:12");
INSERT INTO variants VALUES("23","Brown Morris","2021-03-25 12:54:12","2021-03-25 12:54:12");
INSERT INTO variants VALUES("24","Black","2021-03-25 12:54:12","2021-03-25 12:54:12");



CREATE TABLE `warehouses` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO warehouses VALUES("1","Toko Tanjung Selor","081387481801","","Jl. Katamso No. 11","1","2021-03-07 03:59:30","2021-03-07 03:59:30");

