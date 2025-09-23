/*
 Navicat Premium Data Transfer

 Source Server         : Localhost
 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Host           : localhost:3306
 Source Schema         : test_talikuat

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 23/09/2025 09:47:53
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for data_umum
-- ----------------------------
DROP TABLE IF EXISTS `data_umum`;
CREATE TABLE `data_umum`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pemda` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `opd` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nm_paket` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_kontrak` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_kontrak` date NOT NULL,
  `no_spmk` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tgl_spmk` date NOT NULL,
  `is_deleted` int(11) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `id_uptd` int(11) NOT NULL,
  `kategori_paket_id` int(11) NOT NULL,
  `ppk_kegiatan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of data_umum
-- ----------------------------
INSERT INTO `data_umum` VALUES (5, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', 'PEMBANGUNAN SIMPANG TIDAK SEBIDANG JL. DEWI SARTIKA (DEPOK)', '602/KTR.031/PPK.UPDS/UPTD I/2022', '2022-02-10', '602/SPMK-034/PPK.UPDS/UPTD I/2022', '2022-02-10', NULL, '2022-05-23 20:36:30', '2022-05-23 20:36:30', 1, 9, 'Pembangunan Underpas', 429);
INSERT INTO `data_umum` VALUES (6, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', '1 PEKERJAAN PELEBARAN DAN REKONTRUKSI JALAN RUAS JALAN TASIKMALAYA-KARANGNUGGAL (2,84 KM) (DAK)  KM.BDG. 117+375 - KM.BDG. 120+215', '602.1/99/KTR/PPK.PJMS/PJ2WP. V', '2022-03-04', '602.1/101/SPMK/PPK.PJMS/PJ2WP.V', '2022-03-04', NULL, '2022-05-25 18:50:47', '2022-05-25 18:50:47', 5, 2, 'Peningkatan Jalan Menuju Standart', 438);
INSERT INTO `data_umum` VALUES (7, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', 'Rekontruksi/Peningkatan Kapasitas Struktur Jalan Simpang Pancuh Tilu - Cikadu (1,03 Km) (DAK)', '188/KU.03.10.03/Ktr/01.08/UPTD-PJ2WPI', '2022-05-12', '191/KU.03.10.03/SPMK/01.08/UPTD-PJ2WPI', '2022-05-12', NULL, '2022-05-25 21:10:10', '2022-05-25 21:10:10', 1, 4, 'Rekontruksi jalan', 429);
INSERT INTO `data_umum` VALUES (8, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', 'Pemeliharaan Berkala Jalan Raya Cibeber, Cibeber - Sukanagara, Jalan Raya Sukanagara', '276/KU.03.10.03/SP/01.10/UPTD-PJ2WPI', '2022-05-19', '279/KU.03.10.03/SPMK/01.10/UPTD-PJ2WPI', '2022-05-20', NULL, '2022-05-30 16:17:48', '2022-05-30 16:17:48', 1, 6, 'Pemeliharaan Berkala Jalan', 429);
INSERT INTO `data_umum` VALUES (9, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', 'Pemeliharaan Berkala Jalan Sukanagara - Sindangbarang', '277/KU.03.10.03/SP/01.10/UPTD-PJ2WPI', '2022-05-19', '284/KU.03.10.03/SPMK/01.10/UPTD-PJ2WPI', '2022-05-20', NULL, '2022-06-01 01:54:10', '2022-06-01 01:54:10', 1, 6, 'Pemeliharaan Berkala Jalan', 429);
INSERT INTO `data_umum` VALUES (10, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', 'Pemeliharaan Berkala Jalan Cibarusah-Mekarmukti', '278/KU.03.10.03/SP/01.10/UPTD-PJ2WPI', '2022-05-19', '286/KU.03.10.03/SPMK/01.10/UPTD-PJ2WPI', '2022-05-20', NULL, '2022-06-01 23:14:52', '2022-06-01 23:14:52', 1, 6, 'Pemeliharaan Berkala Jalan', 429);
INSERT INTO `data_umum` VALUES (11, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', 'Pemeliharaan Berkala Jalan Cileungsi - Cibeet', '305/KU.03.10.03/Ktr/01/10/UPTD-PJ2WPI', '2022-05-20', '307/KU.03.10.03/SPMK/01/10/UPTD-PJ2WPI', '2022-05-20', NULL, '2022-06-01 23:31:45', '2022-06-01 23:31:45', 1, 6, 'Pemeliharaan Berkala Jalan', 429);
INSERT INTO `data_umum` VALUES (12, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', 'Peningkatan Jalan Cibarusah-Mekarmukti (2,3 KM)', '208/KU.03.10.03/Ktr/01/08/UPTD-PJ2WPI', '2022-05-17', '210/KU.03.10.03/Ktr/01/08/UPTD-PJ2WPI', '2022-05-17', NULL, '2022-06-01 23:39:11', '2022-06-01 23:39:11', 1, 4, 'Rekontruksi jalan', 429);
INSERT INTO `data_umum` VALUES (13, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', '1 PEKERJAAN REKONSTRUKSI JALAN RUAS JALAN PATROL - HAURGEULIS - BANTARWARU', '283/PUR.11.02/KTR/PPK.REKONS/PJ2WPVI', '2022-05-13', '285/PUR.11.02/SPMK/PPK.REKONS/PJ2WPVI', '2022-05-13', NULL, '2022-06-14 20:50:08', '2022-06-14 20:50:08', 6, 4, 'Sub Kegiatan Rekonstruksi Jalan', 336);
INSERT INTO `data_umum` VALUES (15, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', '1 Pekerjaan Peningkatan Jalan Palumbonsari - Johar - Tegalloa (Loji)', '123', '2022-02-18', '123', '2022-02-18', NULL, '2022-07-29 17:11:25', '2022-07-29 17:11:25', 3, 4, 'Dummy', 1);
INSERT INTO `data_umum` VALUES (16, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', '1 Pekerjaan 1KM Peningkatan Jl. Sp.Purwakarta - Jatiluhur', '1233', '2022-04-25', '1233', '2022-03-25', NULL, '2022-07-29 17:14:18', '2022-07-29 17:14:18', 3, 4, 'test', 1);
INSERT INTO `data_umum` VALUES (17, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', '1 Pekerjaan Relokasi Jalan Sp.Orion - Cihaliwung', '12344', '2022-02-18', '12344', '2022-02-18', NULL, '2022-07-29 17:16:20', '2022-07-29 17:16:20', 3, 4, 'tes', 1);
INSERT INTO `data_umum` VALUES (18, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', '1 Pekerjaan Peningkatan Jalan Ruas Jalan Pamanukan - Pagaden \"', '1234566', '2022-05-13', '1234566', '2022-05-13', NULL, '2022-07-29 17:21:14', '2022-07-29 17:21:14', 3, 4, '1234', 1);
INSERT INTO `data_umum` VALUES (19, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', '1 Pekerjaan Pembangunan Jembatan Cisaranten Baru', '123455', '2022-05-23', '123455', '2022-05-23', NULL, '2022-07-29 17:27:01', '2022-07-29 17:27:01', 3, 7, 'Dummy', 1);
INSERT INTO `data_umum` VALUES (20, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', '1 Pekerjaan Pelapisan Ulang Hotmix Ruas Jalan Bts. Karawang/Purwakarta (Curug) - Purwakarta', '70/PUR.08.01/e.03/KTR/PjPK/PJ2WP.III', '2022-05-20', '70/PUR.08.01/E.03/KTR/PJPK/PJ2WP.III', '2022-05-20', NULL, '2022-07-29 17:32:53', '2022-07-29 17:32:53', 3, 6, 'tes', 1);
INSERT INTO `data_umum` VALUES (21, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', '1 Pekerjaan Pelapisan Ulang Hotmix Ruas Jalan Kosambi - Bts. Karawang/Purwakarta (Curug)', '71/PUR.08.01/e.03/KTR/PjPK/PJ2WP.III', '2022-05-20', '71/PUR.08.01/e.03/KTR/PjPK/PJ2WP.III', '2022-05-20', NULL, '2022-07-29 17:35:27', '2022-07-29 17:35:27', 3, 6, 'dummy', 1);
INSERT INTO `data_umum` VALUES (22, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', '1 Pekerjaan Pelapisan Ulang Hotmix Ruas Jalan Subang - Bts. Kab. Bandung/Kab. Subang', '68/PUR.08.01/e.01/KTR/PjPK/PJ2WP.III', '2022-05-20', '68/PUR.08.01/e.01/KTR/PjPK/PJ2WP.III', '2022-05-20', NULL, '2022-07-29 17:37:47', '2022-07-29 17:37:47', 3, 6, 'dummy', 1);
INSERT INTO `data_umum` VALUES (23, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', '1 Pekerjaan Pelapisan Ulang Hotmix Ruas Jalan Pamanukan - Pagaden', '69/PUR.08.01/e.02/KTR/PjPK/PJ2WP.III', '2022-05-20', '69/PUR.08.01/e.02/KTR/PjPK/PJ2WP.III', '2022-05-20', NULL, '2022-07-29 17:39:22', '2022-07-29 17:39:22', 3, 6, '23213', 1);
INSERT INTO `data_umum` VALUES (24, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', '1 KM Pekerjaan Penunjang Peningkatan Jalan Ruas Jalan Sukabumi (Baros) -Sagaranten - Tegalbuleud (Tahun Jamak)', '620 / KTR-133 / PPK-2/REKONS / PJ2WP.II . 27 Oktober 2021', '2021-10-21', '620/SPMK.135/PPK-2/REKONS/PJ2 WP. II . 27 Oktober 2021', '2021-10-27', NULL, '2022-07-29 17:47:56', '2022-07-29 17:47:56', 2, 4, 'daasd', 1);
INSERT INTO `data_umum` VALUES (25, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', '1 KM Pekerjaan Penunjang Peningkatan Jalan Sumadra - Bungbulang - Sukarame (Tahun Jamak)', '622/04/KTR/PPK.Rekons/PJ2WP.IV \'27 September 2021', '2021-09-27', '622/04/KTR/PPK.Rekons/PJ2WP.IV \'27 September 2021', '2021-09-27', NULL, '2022-07-29 17:56:07', '2022-07-29 17:56:07', 4, 4, '23213', 1);
INSERT INTO `data_umum` VALUES (26, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', '1 Pekerjaan Perbaikan Badan Jalan Ruas Jalan BTS. Bandung - Subang', '101/PUR.08.01/Pemel.06/KTR/PJPK/PJ2WP.III', '2022-07-22', '101/PUR.08.01/Pemel.06/KTR/PJPK/PJ2WP.III', '2022-07-22', NULL, '2022-08-15 00:53:18', '2022-08-15 00:53:18', 3, 6, 'Rekonstruksi Jalan', 1);
INSERT INTO `data_umum` VALUES (27, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', '1 Pekerjaan pembuatan gorong-gorong dan saluran drainase ruas singaparna - tasikmalaya dan jalan ir.h. juanda km.bdg. 115+629 - km.bdg.. 107-835', '569/pur.08.01/ktr/ppk.pbj', '2022-06-29', '571/PUR.11.01.02/SPMK/PPK.PBJ', '2022-06-29', NULL, '2022-10-12 09:47:38', '2022-10-12 09:47:38', 5, 14, 'Pemeliharaan berkala jalan', 438);
INSERT INTO `data_umum` VALUES (28, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', '1 pEKERJAAN PEMELIHARAAN BERKALA RUAS JALAN PERINTIS (BANJAR) (0,64) KM.BDG. 147+375 - KM.BDG. 148+015', '1004/PUR.08.01/KTR-E/PPK.PBJ', '2022-11-08', '1007/PUR.11.01.02/SPMK/PPK.PBJ', '2022-11-08', NULL, '2022-11-15 12:12:50', '2022-11-15 12:12:50', 5, 6, 'Pemeliharaan berkala jalan', 438);
INSERT INTO `data_umum` VALUES (29, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', '1 pekerjaan pelebaran jalan ruas jalan warudoyong (bts.kab.tasikmalaya/ciamis) sp.3 winduraja (kawali) (2,16) km.bdg. 93+000 - km.bdg. 95+160', '1205/PUR.08.01/KTR-E/PPK.Pjms', '2022-11-08', '1208/PUR.11.01.02/SPMK/PPK.PJMS', '2022-11-08', NULL, '2022-11-20 21:28:12', '2022-11-20 21:28:12', 5, 2, 'Pelebaran Jalan Menuju Standar', 438);
INSERT INTO `data_umum` VALUES (30, 'PEMERINTAH PROVINSI JAWA BARAT', 'DINAS BINA MARGA DAN PENATAAN RUANG', 'Kegiatan Paket testing', '90/harbang/2023', '2023-02-02', '91/HARBANG/2023', '2023-02-02', NULL, '2023-02-02 13:40:14', '2023-02-02 13:40:14', 1, 1, 'PPK Kegiatan Paket testing', 1);

-- ----------------------------
-- Table structure for data_umum_detail
-- ----------------------------
DROP TABLE IF EXISTS `data_umum_detail`;
CREATE TABLE `data_umum_detail`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `nilai_kontrak` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `panjang_km` decimal(10, 3) NOT NULL,
  `lama_waktu` int(11) NOT NULL,
  `tgl_adendum` date NULL DEFAULT NULL,
  `data_umum_id` int(11) NOT NULL,
  `keterangan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `dirlap_id` int(11) NOT NULL,
  `kontraktor_id` bigint(20) NOT NULL,
  `konsultan_id` bigint(20) NOT NULL,
  `ppk_id` bigint(20) NOT NULL,
  `ft_id` bigint(20) NULL DEFAULT NULL,
  `gs_id` bigint(20) NULL DEFAULT NULL,
  `is_active` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `created_by` bigint(20) NOT NULL,
  `updated_by` bigint(20) NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  `jadual` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 31 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of data_umum_detail
-- ----------------------------
INSERT INTO `data_umum_detail` VALUES (4, 'Rp. 22.439.000.000,85', 1.000, 240, NULL, 4, 'Kontrak Awal', 107, 1, 1, 100, NULL, NULL, 1, 0, 1, NULL, '2022-05-22 00:32:28', '2022-06-14 17:59:56', 'Jadual Sudah Diinput');
INSERT INTO `data_umum_detail` VALUES (5, 'Rp. 108.627.717.151,93', 0.970, 321, NULL, 5, 'Kontrak Awal', 104, 27, 14, 101, NULL, NULL, 1, 0, 429, NULL, '2022-05-23 20:36:30', '2022-05-23 20:36:30', NULL);
INSERT INTO `data_umum_detail` VALUES (6, 'Rp. 13.645.104.395,76', 2.840, 210, NULL, 6, 'Kontrak Awal', 97, 26, 13, 96, NULL, NULL, 1, 0, 438, NULL, '2022-05-25 18:50:47', '2022-06-27 21:54:49', 'Jadual Sudah Diinput');
INSERT INTO `data_umum_detail` VALUES (7, 'Rp. 4.457.774.692,43', 1.030, 150, NULL, 7, 'Kontrak Awal', 111, 28, 14, 109, NULL, NULL, 1, 0, 429, NULL, '2022-05-25 21:10:10', '2022-06-21 18:07:43', 'Jadual Sudah Diinput');
INSERT INTO `data_umum_detail` VALUES (8, 'Rp. 18.773.704.206', 13.960, 90, NULL, 8, 'Kontrak Awal', 114, 29, 14, 109, NULL, NULL, 1, 0, 429, NULL, '2022-05-30 16:17:48', '2022-06-20 19:07:23', 'Jadual Sudah Diinput');
INSERT INTO `data_umum_detail` VALUES (9, 'Rp. 13.607.715.101,00', 12.990, 90, NULL, 9, 'Kontrak Awal', 112, 30, 14, 109, NULL, NULL, 1, 0, 429, NULL, '2022-06-01 01:54:10', '2022-06-06 17:31:46', 'Jadual Sudah Diinput');
INSERT INTO `data_umum_detail` VALUES (10, 'Rp. 3.876.289.243', 2.620, 45, NULL, 10, 'Kontrak Awal', 116, 29, 14, 115, NULL, NULL, 1, 0, 429, NULL, '2022-06-01 23:14:52', '2022-06-21 19:11:23', 'Jadual Sudah Diinput');
INSERT INTO `data_umum_detail` VALUES (11, 'Rp. 13.354.938.673,00', 6.550, 75, NULL, 11, 'Kontrak Awal', 118, 33, 14, 115, NULL, NULL, 1, 0, 429, NULL, '2022-06-01 23:31:45', '2022-06-20 18:30:12', 'Jadual Sudah Diinput');
INSERT INTO `data_umum_detail` VALUES (12, 'Rp. 17.650.426.595,88', 2.300, 220, NULL, 12, 'Kontrak Awal', 117, 32, 14, 110, NULL, NULL, 1, 0, 429, NULL, '2022-06-01 23:39:11', '2022-06-06 17:41:51', 'Jadual Sudah Diinput');
INSERT INTO `data_umum_detail` VALUES (13, 'Rp. 3.631.718.181,82', 0.475, 180, NULL, 13, 'Kontrak Awal', 90, 34, 15, 121, NULL, NULL, 1, 0, 336, NULL, '2022-06-14 20:50:08', '2022-06-14 22:17:57', 'Jadual Sudah Diinput');
INSERT INTO `data_umum_detail` VALUES (15, 'Rp. 4.687.199.433,28', 0.500, 240, NULL, 15, 'Kontrak Awal', 93, 37, 18, 92, NULL, NULL, 1, 0, 1, NULL, '2022-07-29 17:11:25', '2022-07-29 17:11:25', NULL);
INSERT INTO `data_umum_detail` VALUES (16, 'Rp. 5.874.023.075,15', 1.500, 210, NULL, 16, 'Kontrak Awal', 93, 35, 18, 92, NULL, NULL, 1, 0, 1, NULL, '2022-07-29 17:14:18', '2022-07-29 17:14:18', NULL);
INSERT INTO `data_umum_detail` VALUES (17, 'Rp. 3.599.275.008,76', 0.288, 150, NULL, 17, 'Kontrak Awal', 93, 1, 18, 92, NULL, NULL, 1, 0, 1, NULL, '2022-07-29 17:16:20', '2022-07-29 17:16:20', NULL);
INSERT INTO `data_umum_detail` VALUES (18, 'Rp. 6.049.076.400,40', 1.500, 180, NULL, 18, 'Kontrak Awal', 93, 38, 17, 92, NULL, NULL, 1, 0, 1, NULL, '2022-07-29 17:21:14', '2022-07-29 17:21:14', NULL);
INSERT INTO `data_umum_detail` VALUES (19, 'Rp. 11.757.643.001,00', 0.210, 220, NULL, 19, 'Kontrak Awal', 93, 36, 18, 92, NULL, NULL, 1, 0, 1, NULL, '2022-07-29 17:27:01', '2022-07-29 17:27:01', NULL);
INSERT INTO `data_umum_detail` VALUES (20, 'Rp. 3.335.040.851,00', 2.000, 90, NULL, 20, 'Kontrak Awal', 93, 33, 18, 92, NULL, NULL, 1, 0, 1, NULL, '2022-07-29 17:32:53', '2022-07-29 17:32:53', NULL);
INSERT INTO `data_umum_detail` VALUES (21, 'Rp. 3.991.267.027,00', 2.500, 30, NULL, 21, 'Kontrak Awal', 93, 33, 18, 92, NULL, NULL, 1, 0, 1, NULL, '2022-07-29 17:35:27', '2022-07-29 17:35:27', NULL);
INSERT INTO `data_umum_detail` VALUES (22, 'Rp. 13.225.985.050,00', 8.000, 60, NULL, 22, 'Kontrak Awal', 93, 40, 17, 92, NULL, NULL, 1, 0, 1, NULL, '2022-07-29 17:37:47', '2022-07-29 17:37:47', NULL);
INSERT INTO `data_umum_detail` VALUES (23, 'Rp. 11.091.611.192,00', 5.400, 45, NULL, 23, 'Kontrak Awal', 93, 39, 17, 92, NULL, NULL, 1, 0, 1, NULL, '2022-07-29 17:39:22', '2022-07-29 17:39:22', NULL);
INSERT INTO `data_umum_detail` VALUES (24, 'Rp. 86.248.827.300,68', 30.956, 420, NULL, 24, 'Kontrak Awal', 93, 24, 19, 92, NULL, NULL, 1, 0, 1, NULL, '2022-07-29 17:47:56', '2022-07-29 17:47:56', NULL);
INSERT INTO `data_umum_detail` VALUES (25, 'Rp. 111.097.835.000,00', 40.610, 460, NULL, 25, 'Kontrak Awal', 93, 41, 20, 92, NULL, NULL, 1, 0, 1, NULL, '2022-07-29 17:56:07', '2022-07-29 17:56:07', NULL);
INSERT INTO `data_umum_detail` VALUES (26, 'Rp. 1.238.948.249,45', 7.960, 150, NULL, 26, 'Kontrak Awal', 93, 38, 17, 92, NULL, NULL, 1, 0, 1, NULL, '2022-08-15 00:53:18', '2022-08-15 00:53:18', NULL);
INSERT INTO `data_umum_detail` VALUES (27, 'Rp. 1.183.624.746,98', 0.490, 150, NULL, 27, 'Kontrak Awal', 97, 43, 21, 133, NULL, NULL, 1, 0, 438, NULL, '2022-10-12 09:47:38', '2022-10-12 21:27:53', 'Jadual Sudah Diinput');
INSERT INTO `data_umum_detail` VALUES (28, 'Rp. 1.623.877.567,00', 0.640, 30, NULL, 28, 'Kontrak Awal', 97, 45, 21, 133, NULL, NULL, 1, 0, 438, NULL, '2022-11-15 12:12:50', '2022-11-23 13:07:39', 'Jadual Sudah Diinput');
INSERT INTO `data_umum_detail` VALUES (29, 'Rp. 4.354.650.982,00', 2.160, 40, NULL, 29, 'Kontrak Awal', 97, 24, 21, 96, NULL, NULL, 1, 0, 438, NULL, '2022-11-20 21:28:12', '2022-11-23 13:20:09', 'Jadual Sudah Diinput');
INSERT INTO `data_umum_detail` VALUES (30, 'Rp. 120.000.000', 8.600, 120, NULL, 30, 'Kontrak Awal', 78, 1, 1, 77, NULL, NULL, 1, 0, 1, NULL, '2023-02-02 13:40:14', '2023-02-02 13:40:14', NULL);

-- ----------------------------
-- Table structure for data_umum_ruas
-- ----------------------------
DROP TABLE IF EXISTS `data_umum_ruas`;
CREATE TABLE `data_umum_ruas`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `data_umum_detail_id` bigint(20) UNSIGNED NOT NULL,
  `id_ruas_jalan` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `segment_jalan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat_awal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_awal` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat_akhir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_akhir` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 57 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of data_umum_ruas
-- ----------------------------
INSERT INTO `data_umum_ruas` VALUES (26, 4, '290000', 'Km.Cn 49+600 s/d Km.Cn 50+350', '-6.762590', '108.168456', '-6.757754', '108.165182', '2022-05-23 09:00:48', '2022-05-23 09:00:48');
INSERT INTO `data_umum_ruas` VALUES (27, 4, '290000', 'Km.Cn 51+875 – Km.Cn 53+975', '-6.747637116112868', '108.15723295867777', '-6.731961', '108.166670', '2022-05-23 09:00:49', '2022-05-23 09:00:49');
INSERT INTO `data_umum_ruas` VALUES (28, 4, '290000', 'Km.Cn 54+275 – Km.Cn 55+600', '-6.730611', '108.168252', '-6.720105', '108.167417', '2022-05-23 09:00:49', '2022-05-23 09:00:49');
INSERT INTO `data_umum_ruas` VALUES (29, 4, '290000', 'Km.Cn 56+200 – Km.Cn 57+400', '-6.715243', '108.171359', '-6.706750020720728', '108.17824392467246', '2022-05-23 09:00:49', '2022-05-23 09:00:49');
INSERT INTO `data_umum_ruas` VALUES (30, 4, '290000', 'Km.Cn 60+400 – Km.Cn 60+950', '-6.682475', '108.188396', '-6.677641', '108.189063', '2022-05-23 09:00:49', '2022-05-23 09:00:49');
INSERT INTO `data_umum_ruas` VALUES (31, 5, '21312K', 'KM.JKT 43+233 s.d KM.JKT 44+128', '-6.399125', '106.813662', '-6.397609', '106.820616', '2022-05-23 20:36:30', '2022-05-23 20:36:30');
INSERT INTO `data_umum_ruas` VALUES (32, 6, '343000', 'Km.Bdg. 117+375 - Km.Bdg. 120+215', '-7.413918', '108.203849', '-7.433634S', '108.193517', '2022-05-25 18:50:47', '2022-05-25 18:50:47');
INSERT INTO `data_umum_ruas` VALUES (33, 7, '396000', 'Km. Bdg. 91+514 s.d Km.Bdg 92+544', '-7.366769', '107.218365', '-7.37307', '107.214438', '2022-05-25 21:10:10', '2022-05-25 21:10:10');
INSERT INTO `data_umum_ruas` VALUES (34, 8, '183000', 'Km.Bdg. 81+620 s.d Km.Bdg. 107+740', '-6.9399', '107.132300', '-7.103200', '107.130600', '2022-05-30 16:17:48', '2022-05-30 16:17:48');
INSERT INTO `data_umum_ruas` VALUES (35, 9, '184000', 'Km.Bdg. 127+000 s.d Km.Bdg. 169+000', '-7.199900', '107.143800', '-7.421100', '107.218365', '2022-06-01 01:54:10', '2022-06-01 01:54:10');
INSERT INTO `data_umum_ruas` VALUES (36, 10, '230110', 'KM JKT 57+600 s.d KM.JKT 76+250', '-6.308536867', '107.1438169', '-6.435098435', '107.0671377', '2022-06-01 23:14:52', '2022-06-01 23:14:52');
INSERT INTO `data_umum_ruas` VALUES (37, 11, '233000', 'KM JKT 66+800 s.d KM.JKT 97+750', '-6.4527004', '107.0604213', '-6.6471350', '107.1669975', '2022-06-01 23:31:45', '2022-06-01 23:31:45');
INSERT INTO `data_umum_ruas` VALUES (38, 12, '230110', 'Km.Jkt. 62+875 s.d Km.Jkt 65+175', '-6.3456263', '107.120601', '-6.3637472', '107.1173012', '2022-06-01 23:39:11', '2022-06-01 23:39:11');
INSERT INTO `data_umum_ruas` VALUES (39, 13, '394000', 'Km.Cn 113+750 - Km.Cn 113+819', '-6.458347226865234', '107.94366903011397', '-6.458902075505112', '107.94364304813561', '2022-06-14 20:50:08', '2022-06-14 20:50:08');
INSERT INTO `data_umum_ruas` VALUES (40, 13, '394000', 'Km.Cn 113+850 - Km.Cn 114+260', '-6.459028700144017', '107.94348629364998', '-6.459215668719502', '107.94008396421262', '2022-06-14 20:50:08', '2022-06-14 20:50:08');
INSERT INTO `data_umum_ruas` VALUES (41, 15, '391010', '123', '123', '123', '123', '123', '2022-07-29 17:11:25', '2022-07-29 17:11:25');
INSERT INTO `data_umum_ruas` VALUES (42, 16, '242000', '123', '123', '123', '123', '123', '2022-07-29 17:14:18', '2022-07-29 17:14:18');
INSERT INTO `data_umum_ruas` VALUES (43, 17, '245000', '123', '123', '1223', '123', '123', '2022-07-29 17:16:20', '2022-07-29 17:16:20');
INSERT INTO `data_umum_ruas` VALUES (44, 18, '260000', '123', '123', '123', '123', '123', '2022-07-29 17:21:14', '2022-07-29 17:21:14');
INSERT INTO `data_umum_ruas` VALUES (45, 19, '400000', '123', '123', '123', '123', '123', '2022-07-29 17:27:01', '2022-07-29 17:27:01');
INSERT INTO `data_umum_ruas` VALUES (46, 20, '244000', '123', '123', '123', '123', '123', '2022-07-29 17:32:53', '2022-07-29 17:32:53');
INSERT INTO `data_umum_ruas` VALUES (47, 21, '243000', '123', '123', '123', '123', '123', '2022-07-29 17:35:27', '2022-07-29 17:35:27');
INSERT INTO `data_umum_ruas` VALUES (48, 22, '252000', '123', '123', '123', '123', '123', '2022-07-29 17:37:47', '2022-07-29 17:37:47');
INSERT INTO `data_umum_ruas` VALUES (49, 23, '260000', '12', '312', '3123', '123', '123', '2022-07-29 17:39:22', '2022-07-29 17:39:22');
INSERT INTO `data_umum_ruas` VALUES (50, 24, '19114K', '123', '123', '123', '123', '123', '2022-07-29 17:47:56', '2022-07-29 17:47:56');
INSERT INTO `data_umum_ruas` VALUES (51, 25, '355000', '123', '123', '123', '123', '123', '2022-07-29 17:56:07', '2022-07-29 17:56:07');
INSERT INTO `data_umum_ruas` VALUES (52, 26, '251000', '123', '123', '123', '123', '123', '2022-08-15 00:53:18', '2022-08-15 00:53:18');
INSERT INTO `data_umum_ruas` VALUES (53, 27, '347000', 'Km.Bdg. 115+629 - Km.Bdg. 107+835', '-7.343242', '108.197171', '-7.343966', '108.193625', '2022-10-12 09:47:38', '2022-10-12 09:47:38');
INSERT INTO `data_umum_ruas` VALUES (54, 28, '33211K', 'KM.BDG. 147+375 - KM.BDG. 148+015', '-7.369636', '108.536777', '-7.369732', '108.538644', '2022-11-15 12:12:50', '2022-11-15 12:12:50');
INSERT INTO `data_umum_ruas` VALUES (55, 29, '404020', 'Km.Bdg. 93+000 - Km.Bdg. 95+160', '-7.12465843', '108.24647825', '-7.128374', '108.264921', '2022-11-20 21:28:12', '2022-11-20 21:28:12');
INSERT INTO `data_umum_ruas` VALUES (56, 30, '345000', 'Km. Bdg. 8+000 s/d 18+000', '-7.23215', '107.23287', '-7.3224', '107.873253', '2023-02-02 13:40:14', '2023-02-02 13:40:14');

-- ----------------------------
-- Table structure for feature_categories
-- ----------------------------
DROP TABLE IF EXISTS `feature_categories`;
CREATE TABLE `feature_categories`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `slug` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of feature_categories
-- ----------------------------
INSERT INTO `feature_categories` VALUES (1, 'Manajemen User', NULL, NULL, NULL);
INSERT INTO `feature_categories` VALUES (2, 'Data Utama', NULL, NULL, NULL);
INSERT INTO `feature_categories` VALUES (3, 'Input Data', NULL, NULL, NULL);
INSERT INTO `feature_categories` VALUES (4, 'Pusat Unduhan', NULL, NULL, NULL);
INSERT INTO `feature_categories` VALUES (5, 'Log', NULL, NULL, NULL);

-- ----------------------------
-- Table structure for features
-- ----------------------------
DROP TABLE IF EXISTS `features`;
CREATE TABLE `features`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feature_category_id` int(11) NULL DEFAULT NULL,
  `name` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `slug` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of features
-- ----------------------------

-- ----------------------------
-- Table structure for file_temp_jadual
-- ----------------------------
DROP TABLE IF EXISTS `file_temp_jadual`;
CREATE TABLE `file_temp_jadual`  (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `data_umum_detail_id` int(11) NULL DEFAULT NULL,
  `file_name` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of file_temp_jadual
-- ----------------------------

SET FOREIGN_KEY_CHECKS = 1;
