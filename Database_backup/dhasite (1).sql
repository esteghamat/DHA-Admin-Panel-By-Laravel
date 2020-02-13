-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 12 Şub 2020, 13:46:46
-- Sunucu sürümü: 10.4.11-MariaDB
-- PHP Sürümü: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `dhasite`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 1,
  `category_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category_slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `category_name`, `category_description`, `category_slug`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 0, 'sanatlar kategorı', 'Hepsi kı sanat ilgili', 'asdasd', 1, NULL, '2020-01-24 11:55:04', '2020-01-27 03:55:56'),
(5, 2, 'Ağız ve diş', 'Ağız ve diş sağlığı', 'Ağız-ve-diş', 1, NULL, '2020-01-27 03:58:40', '2020-01-27 03:58:40'),
(6, 2, 'Otomotiv - Motor Parçaları', 'Motor gövdesi, gövde, silindir ve piston', 'otomotiv-motor-parcalari-ghj-gjggj', 1, NULL, '2020-01-27 04:00:39', '2020-02-04 08:53:36'),
(7, 2, 'İç triatlonunuz', 'Sandalyeler, gösterge panoları ve tavanlar', 'İç-triatlonunuz', 1, NULL, '2020-01-27 04:01:43', '2020-01-27 04:01:43'),
(18, 0, 'Ana New', 'aaaaaaaaaaa', 'aaaaaaaaaaa', 1, NULL, '2020-02-04 05:30:46', '2020-02-04 05:30:46'),
(19, 18, 'fgbfgghnghn 1111', 'ghnghnghn', 'fgbfgghnghn-1111', 1, NULL, '2020-02-04 08:52:53', '2020-02-04 08:53:02');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `filters`
--

CREATE TABLE `filters` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `filter_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `filter_slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `filters`
--

INSERT INTO `filters` (`id`, `filter_name`, `filter_slug`, `created_at`, `updated_at`) VALUES
(1, 'Bilimsel', 'bilimsel', '2020-02-05 06:51:51', '2020-02-05 10:02:55'),
(2, 'klinik', 'klinik', '2020-02-05 06:54:16', '2020-02-05 10:02:38'),
(3, 'operasyon', 'operasyon', '2020-02-05 06:54:26', '2020-02-05 10:02:23'),
(4, 'Ev hizmetler', 'ev-hizmetler', '2020-02-05 06:54:34', '2020-02-05 10:02:11'),
(5, 'okullar', 'okullar', '2020-02-05 06:54:40', '2020-02-05 10:01:55');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `galleries`
--

CREATE TABLE `galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ref_id` int(11) NOT NULL,
  `ref_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ref_display_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gallery_image_count` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `galleries`
--

INSERT INTO `galleries` (`id`, `ref_id`, `ref_type`, `ref_display_type`, `gallery_image_count`, `created_at`, `updated_at`) VALUES
(5, 5, 'portfolio', 'işler', 6, '2020-01-28 05:38:06', '2020-01-29 07:25:35'),
(15, 24, 'portfolio', 'işler', 0, '2020-02-04 07:33:41', '2020-02-04 07:33:41');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gallery_id` int(11) NOT NULL,
  `image_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_file_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `gallery_id`, `image_title`, `image_file_name`, `created_at`, `updated_at`) VALUES
(11, 5, 'first image', 'img_uploaded_2020012814031236.jpg', '2020-01-28 11:49:03', '2020-01-30 03:58:53'),
(27, 5, '2222', 'img_uploaded_2020012909478617.jpg', '2020-01-29 06:13:47', '2020-01-29 08:38:13'),
(32, 5, 'asdasA', 'img_uploaded_2020012909057174.jpg', '2020-01-29 06:46:05', '2020-01-29 06:46:05'),
(33, 5, 'tkyukuytujuyu', 'img_uploaded_2020012909153579.jpg', '2020-01-29 06:46:15', '2020-01-29 06:46:15'),
(34, 5, 'tutyutyu', 'img_uploaded_2020012909249358.jpg', '2020-01-29 06:46:24', '2020-01-29 06:46:24'),
(35, 5, 'tyutyuty', 'img_uploaded_2020012909326226.jpg', '2020-01-29 06:46:32', '2020-01-29 06:46:32');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `markas`
--

CREATE TABLE `markas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `marka_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marka_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `marka_keywords` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marka_description` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `marka_logo_image_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `markas`
--

INSERT INTO `markas` (`id`, `marka_name`, `marka_slug`, `marka_keywords`, `marka_description`, `marka_logo_image_name`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'isotlar', 'isotlar2', NULL, 'isotlar', 'img_uploaded_2020012707314749.jpg', NULL, '2020-01-23 03:54:46', '2020-01-30 05:39:02'),
(3, 'disc', 'disc3', NULL, 'disc açiklama', 'img_uploaded_2020012707536551.jpg', NULL, '2020-01-23 06:39:09', '2020-01-30 05:39:02'),
(6, 'beykent_uni', 'beykent-uni6', NULL, 'beykent_uni açiklaması', 'img_uploaded_2020012707408337.jpg', NULL, '2020-01-23 06:43:28', '2020-01-30 05:39:02'),
(8, 'emay_insaat', 'emay-insaat8', NULL, 'emay_insaat açiklaması', 'img_uploaded_2020012707566583.jpg', NULL, '2020-01-24 08:26:55', '2020-01-30 05:39:02');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2020_01_23_062945_create_markas_table', 2),
(4, '2020_01_24_114326_create_portfolios_table', 3),
(5, '2020_01_24_131358_create_categories_table', 4),
(7, '2020_01_27_102855_create_galleries_table', 5),
(8, '2020_01_27_103501_create_gallery_images_table', 5),
(11, '2020_01_30_070944_add_slug_column_to_markas', 6),
(12, '2020_01_30_081920_set_slug_to_unıque_on_markas_table', 6),
(13, '2020_02_02_170200_create_model_dependencies_table', 7),
(14, '2020_02_05_090110_create_filters_table', 8),
(15, '2020_02_05_134401_create_site_content_types_table', 9),
(16, '2020_02_05_135700_create_site_head_contents_table', 10),
(17, '2020_02_07_111956_create_site_content_items_table', 11);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `model_dependencies`
--

CREATE TABLE `model_dependencies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `model_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `related_model_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eloquent_related_model_method` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_delete_allowed_with_all_children` tinyint(1) NOT NULL,
  `message_first_part` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_second_part` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `model_dependencies`
--

INSERT INTO `model_dependencies` (`id`, `model_name`, `related_model_name`, `eloquent_related_model_method`, `is_delete_allowed_with_all_children`, `message_first_part`, `message_second_part`, `created_at`, `updated_at`) VALUES
(1, 'Marka', 'Portfolio', 'portfolios', 0, 'Bu mraka ', ' iş/işler var.', NULL, NULL),
(2, 'Category', 'Category', 'get_children', 0, 'Bu kategori ', '  alt kategory var.', NULL, NULL),
(3, 'Filter', 'Portfolio', 'portfolios', 0, 'Bu filter ', ' işler var.', NULL, NULL),
(4, 'Portfolio', 'Gallery', 'get_galleries', 1, 'Bu iş ', ' galeri var.', NULL, NULL),
(5, 'Gallery', 'Gallery_Image', 'get_gallery_images', 1, 'Bu galeri ', ' görüntü var.', NULL, NULL),
(6, 'Site_Content_Type', 'Site_Content_Head', 'get_site_content_head', 0, 'Bu içerik türü', 'ana içeriğe sahip.', NULL, NULL),
(7, 'Site_Content_Type', 'Site_Content_Item', 'get_site_content_item', 0, 'Bu içerik türü', 'içerik öğesi var.', NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `portfolios`
--

CREATE TABLE `portfolios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `portfolio_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `portfolio_slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `portfolio_keywords` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `portfolio_description` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `portfolio_image_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marka_id` int(11) NOT NULL,
  `filter_id` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `portfolios`
--

INSERT INTO `portfolios` (`id`, `portfolio_title`, `portfolio_slug`, `portfolio_keywords`, `portfolio_description`, `portfolio_image_name`, `marka_id`, `filter_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(5, 'Bilimsel Makaleler', 'bilimsel-makaleler', 'Bilimsel,Makaleler', 'disc işi 1 11', 'img_uploaded_2020020512476654.jpg', 3, 1, NULL, '2020-01-27 11:24:28', '2020-02-05 09:20:47'),
(24, 'Sağlık Kuruluşları', 'saglik-kuruluslari', 'saglik-kuruluslari', 'saglik-kuruluslari', 'img_uploaded_2020020408072606.jpg', 2, 2, NULL, '2020-02-04 05:29:07', '2020-02-05 08:18:22'),
(25, 'Güzellik klinikleri', 'guzellik-klinikleri', 'ergerg', 'ergeg', 'img_uploaded_2020020411498265.jpg', 2, 2, NULL, '2020-02-04 08:54:49', '2020-02-04 11:24:07'),
(26, 'Modern operasyon', 'modern-operasyon', 'Modern,operasyon', 'Modern operasyon', 'img_uploaded_2020020510241851.jpg', 6, 3, NULL, '2020-02-05 07:41:24', '2020-02-05 07:41:24'),
(28, 'Ev hizmetler', 'ev-hizmetler', 'Ev hizmetler', 'Ev hizmetler', 'img_uploaded_2020020511215492.jpg', 2, 4, NULL, '2020-02-05 08:20:21', '2020-02-05 08:20:21'),
(29, 'okullar', 'okullar', 'sağlık okulları hizmetleri', 'sağlık okulları hizmetleri', 'img_uploaded_2020020709323031.jfif', 2, 5, NULL, '2020-02-05 08:23:54', '2020-02-07 06:55:55');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `site_content_heads`
--

CREATE TABLE `site_content_heads` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_content_type_id` int(11) NOT NULL,
  `contenthead_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenthead_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenthead_keywords` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contenthead_title_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contenthead_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contenthead_image_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contenthead_logo_image_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `site_content_heads`
--

INSERT INTO `site_content_heads` (`id`, `site_content_type_id`, `contenthead_title`, `contenthead_slug`, `contenthead_keywords`, `contenthead_title_description`, `contenthead_description`, `contenthead_image_name`, `contenthead_logo_image_name`, `created_at`, `updated_at`) VALUES
(5, 1, 'DİJİTAL SAĞLIK AJANSI 1111', 'dijital-saglik-ajansi-1111', 'DİJİTAL,SAĞLIK,AJANSI', 'D-Dinamik İçerik--- Dijital medyanın doktoru DHA ile tedavi planınız hazır!\r\n\r\nevet yeni hat.\r\nDHA, dijital pazarlama ve dijital repütasyonun öneminin yadsınamadığı günümüzde zaten işleri başından aşkın olan hekim ve kliniklerin bu alana ayırmaları gereken zaman ve enerjilerini koruyabilmeleri amacıyla ortaya çıktı.\r\n\r\nSiz bir çok yaşamı görünür kılarken, biz de sosyal medya hesaplarınızı görünür yapıyoruz. DHA; doğru tedaviyle markanızı iyileştir, çözüm üretir, yaratıcı fikirler geliştirir. Siz muayenenize devam edin gerisini biz hallederiz!', NULL, NULL, NULL, '2020-02-06 04:40:16', '2020-02-07 10:28:48'),
(6, 2, 'Biz Kimiz?', 'biz-kimiz', 'Biz,Kimiz', 'DHA, sadece sağlık sektörüne hizmet veren, alanında uzman ekibiyle kurulan dijital sağlık ajansıdır.\r\n\r\nDijital pazarlama ve dijital repütasyonun öneminin yadsınamadığı günümüzde zaten işleri başından aşkın olan hekim ve kliniklerin bu alana ayırmaları gereken zaman\r\n\r\nve enerjilerini koruyabilmeleri amacıyla ortaya çıkmıştır.\r\n\r\nSiz bir çok yaşamı görünür kılarken, biz de sosyal medya hesaplarınızı görünür yapıyoruz.\r\n\r\nDHA; doğru tedaviyle markanızı iyileştir, çözüm üretir, yaratıcı fikirler geliştirir.\r\n\r\nSiz dünyayı iyileştirmeye devam edin gerisini biz hallederiz!', NULL, NULL, NULL, '2020-02-06 04:41:48', '2020-02-11 05:47:09'),
(7, 3, 'İşlerimiz', 'islerimiz', 'İşlerimiz', 'D- Dinamik içerik. --- Lorem ipsum dolor sit Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam pariatur reiciendis in nihil magni est ad corporis sapiente consectetur ea!amet consectetur, adipisicing elit. Est, aut?', NULL, NULL, NULL, '2020-02-06 04:42:38', '2020-02-11 08:41:25'),
(9, 5, 'Referanslar', 'referanslar', NULL, NULL, NULL, NULL, NULL, '2020-02-06 06:40:49', '2020-02-12 06:26:14'),
(11, 4, 'Dijital Reçetemiz', 'dijital-recetemiz', NULL, 'Saglık ile ilgili ozel hizmetler', 'Saglık ile ilgili ozel hizmetler', NULL, 'img_uploaded_headlogo_2020021108477311.png', '2020-02-06 11:55:57', '2020-02-11 08:29:35'),
(14, 6, 'Blog', 'blog', NULL, NULL, NULL, '', '', '2020-02-12 08:35:08', '2020-02-12 08:35:08');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `site_content_items`
--

CREATE TABLE `site_content_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `site_content_type_id` int(11) NOT NULL,
  `contentitem_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contentitem_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contentitem_keywords` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contentitem_title_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contentitem_description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contentitem_image_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contentitem_logo_image_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contentitem_url` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `filter_id` int(11) DEFAULT NULL,
  `marka_id` int(11) DEFAULT NULL,
  `custom_order` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `site_content_items`
--

INSERT INTO `site_content_items` (`id`, `site_content_type_id`, `contentitem_title`, `contentitem_slug`, `contentitem_keywords`, `contentitem_title_description`, `contentitem_description`, `contentitem_image_name`, `contentitem_logo_image_name`, `contentitem_url`, `filter_id`, `marka_id`, `custom_order`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 2, 'DİJİTAL REKLAM YONETİMİ', 'dijital-reklam-yonetimi', 'dijital,reklam,yonetimi', 'Uzman grafiker ve editörlerimizle sosyal medya hesabınızı analiz ediyor, ihtiyaca uygun düzenliyor, büyütüyor ve raporluyoruz.', NULL, NULL, 'img_uploaded_headlogo_2020021006411486.png', NULL, NULL, NULL, 3, NULL, '2020-02-10 03:32:41', '2020-02-12 05:07:02'),
(2, 2, 'İÇERİK YONETİMİ VE YAZARLIGI', 'icerik-yonetimi-ve-yazarligi', 'icerik,yonetimi,yazarligi', 'Konusunda deneyimli metin yazarları ile branşınıza uygun içerikler ve bloglar üretiyor, SEO çalışmalarıyla isminizi arama motorlarında üst sıralara taşıyoruz.', NULL, NULL, 'img_uploaded_headlogo_2020021006262527.png', NULL, NULL, NULL, 1, NULL, '2020-02-10 03:33:26', '2020-02-12 05:07:02'),
(3, 2, 'REPUTASYON YONETİMİ', 'reputasyon-yonetimi', 'reputasyon, yonetimi', 'Dijital medyadaki kimlikleriniz; sosyal medya hesaplarınız ve web sitenizi sizi en iyi yansıtacak duruma getiriyoruz, bilinirlik ve güvenilirliğinizi ön plana çıkartıyoruz.', NULL, '', 'img_uploaded_headlogo_2020021006134719.png', NULL, NULL, NULL, 4, NULL, '2020-02-10 03:34:13', '2020-02-12 05:07:02'),
(4, 2, 'PRODUKSİYON', 'produksiyon', 'produksiyon', 'Söz uçar, görüntü kalır! Alanınızda röportaj, bilgi paylaşımı ve tanıtım filmleri hazırlıyor, tanınırlığınızı besliyoruz.', NULL, '', 'img_uploaded_headlogo_2020021006422858.png', NULL, NULL, NULL, 2, NULL, '2020-02-10 03:34:42', '2020-02-12 05:07:02'),
(5, 4, 'GRAFİK TASARIM', 'grafik-tasarim', 'grafik,tasarim', 'Alanınıza özel kreatif grafik çalışmaları,\r\n                                    animasyonlar, vektörel çalışmalar', 'Logo, kartvizit, antetli kağıt,\r\n                                    ajanda, kalem gibi ürünler\r\n                                    tasarlar ve sizin için kurumsal kimlik\r\n                                    oluştururuz. Sosyal medya tasarımları,\r\n                                    afiş ve broşür tasarımları hazırlıyoruz.\r\n444', 'img_uploaded_itemimage_2020021109261240.jpg', NULL, NULL, NULL, NULL, 1, NULL, '2020-02-10 03:36:20', '2020-02-12 04:58:46'),
(6, 4, 'GOOGLE ADS & SEO', 'google-ads-seo', 'google ads, seo', 'Arama motoru optimizasyonu, dijital\r\n                                    bilirliğin artması', 'Markanızın arama motorlarında daha\r\n                                    üst sıralarda çıkmasını sağlıyor,\r\n                                    dijital repütasyonunuzu yükseltiyoruz.', 'img_uploaded_itemimage_2020021109369030.jpg', NULL, NULL, NULL, NULL, 2, NULL, '2020-02-10 03:37:19', '2020-02-12 04:58:49'),
(7, 4, 'FOTOGRAF & VİDEO', 'fotograf-video', 'fotograf, video', 'Konsept fotoğraf ve video çekimler', 'Profesyonel makine ve uzman ekibimizle\r\n                                    muayenehane, hastane, poliklinik ve\r\n                                    ameliyathane çekimleri yapıyor,\r\n                                    hastalarınızın sizi görmesini sağlıyoruz.\r\n                                    Youtube kanalınıza yüklenmesi\r\n                                    işlemlerini yapıyoruz.', 'img_uploaded_itemimage_2020021109468738.jpg', NULL, NULL, NULL, NULL, 3, NULL, '2020-02-10 03:38:16', '2020-02-12 04:58:53'),
(13, 3, 'okullar', 'okullar', NULL, NULL, NULL, 'img_uploaded_itemimage_2020021112069119.jpg', '', NULL, 5, NULL, 1, NULL, '2020-02-11 09:31:06', '2020-02-12 04:59:31'),
(14, 3, 'Ev hizmetler', 'ev-hizmetler', NULL, NULL, NULL, 'img_uploaded_itemimage_2020021112558795.jfif', '', NULL, 4, NULL, 2, NULL, '2020-02-11 09:31:55', '2020-02-12 04:59:36'),
(15, 3, 'Modern operasyon', 'modern-operasyon', NULL, NULL, NULL, 'img_uploaded_itemimage_2020021112346124.png', '', NULL, 3, NULL, 3, NULL, '2020-02-11 09:33:34', '2020-02-12 04:59:36'),
(16, 3, 'Güzellik klinikleri', 'guzellik-klinikleri', NULL, NULL, NULL, 'img_uploaded_itemimage_2020021112293011.png', '', NULL, 2, NULL, 4, NULL, '2020-02-11 09:35:29', '2020-02-12 04:59:36'),
(17, 3, 'Sağlık Kuruluşları', 'saglik-kuruluslari', NULL, NULL, NULL, 'img_uploaded_itemimage_2020021112362993.png', NULL, NULL, 2, NULL, 5, NULL, '2020-02-11 09:36:36', '2020-02-12 04:59:36'),
(18, 3, 'Bilimsel Makaleler', 'bilimsel-makaleler', NULL, NULL, NULL, 'img_uploaded_itemimage_2020021112549088.png', '', NULL, 1, NULL, 6, NULL, '2020-02-11 09:37:54', '2020-02-12 04:59:36'),
(19, 5, 'SARAR', 'sarar', NULL, NULL, NULL, 'img_uploaded_itemimage_2020021209385831.jpg', NULL, 'https://sarar.com/en/homepage/', 1, NULL, 1, NULL, '2020-02-12 06:28:38', '2020-02-12 07:30:50'),
(20, 5, 'bp yildiz', 'bp-yildiz', NULL, NULL, NULL, 'img_uploaded_itemimage_2020021209204934.jpg', NULL, 'https://www.bp.com/', NULL, NULL, 2, NULL, '2020-02-12 06:52:20', '2020-02-12 07:31:37'),
(21, 5, 'SUDE', 'sude', NULL, NULL, NULL, 'img_uploaded_itemimage_2020021209583887.jpg', NULL, 'https://karnaval.com/sarkilar/sude-41914', NULL, NULL, 3, NULL, '2020-02-12 06:52:58', '2020-02-12 07:32:58'),
(22, 5, 'ALPET', 'alpet', NULL, NULL, NULL, 'img_uploaded_itemimage_2020021209321339.jpg', '', NULL, NULL, NULL, 4, NULL, '2020-02-12 06:53:32', '2020-02-12 06:53:32'),
(23, 5, 'Gökkuşağı', 'gokkusagi', NULL, NULL, NULL, 'img_uploaded_itemimage_2020021209179621.jpg', '', NULL, NULL, NULL, 5, NULL, '2020-02-12 06:54:17', '2020-02-12 06:54:17'),
(24, 5, 'Holbaek Hospital', 'holbaek-hospital', NULL, NULL, NULL, 'img_uploaded_itemimage_2020021209497785.jpg', '', NULL, NULL, NULL, 6, NULL, '2020-02-12 06:54:49', '2020-02-12 06:54:49'),
(25, 6, 'DİJİTAL SAGLIK', 'dijital-saglik', NULL, 'Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz. Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz. Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz. Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz. Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz. Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz. Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz. Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz.', NULL, 'img_uploaded_itemimage_2020021211286277.jpg', NULL, 'https://www.tkd.org.tr/dijital-saglik-proje-grubu', NULL, NULL, 1, NULL, '2020-02-12 08:36:28', '2020-02-12 08:42:54'),
(26, 6, 'GOOGLE ADS & SEO Blog', 'google-ads-seo-blog', NULL, 'Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz. Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz. Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz. Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz. Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz. Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz. Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz. Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz.', NULL, 'img_uploaded_itemimage_2020021211546500.jpg', NULL, 'https://www.wordstream.com/blog/ws/2012/08/27/using-google-ads-data-for-seo', NULL, NULL, 2, NULL, '2020-02-12 08:38:54', '2020-02-12 08:43:53'),
(27, 6, 'BLOG YAZILARI', 'blog-yazilari', NULL, 'Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz. Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz. Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz. Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz. Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz. Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz. Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz. Markanızın arama motorlarında daha üst sıralarda çıkmasını sağlıyor, dijital repütasyonunuzu yükseltiyoruz.', NULL, 'img_uploaded_itemimage_2020021211322321.jpg', NULL, 'http://blog.milliyet.com.tr/odule-layik-blog-yazilari/Blog/?BlogNo=118476', NULL, NULL, 3, NULL, '2020-02-12 08:39:32', '2020-02-12 08:44:47');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `site_content_types`
--

CREATE TABLE `site_content_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `contenttype_title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contenttype_slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `site_content_types`
--

INSERT INTO `site_content_types` (`id`, `contenttype_title`, `contenttype_slug`, `created_at`, `updated_at`) VALUES
(1, 'Anasayfa', 'anasayfa', NULL, NULL),
(2, 'Biz Kimiz', 'biz_kimiz', NULL, NULL),
(3, 'İşlerimiz', 'islerimiz', NULL, NULL),
(4, 'Dijital Reçetemiz', 'dijital-recetemiz', NULL, NULL),
(5, 'Referenslar', 'referenslar', NULL, NULL),
(6, 'Blog', 'blog', NULL, '2020-02-12 08:29:32');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `admin`, `created_at`, `updated_at`) VALUES
(2, 'Ali Esi', 'ali@gmail.com', NULL, '$2y$10$WZ7Ajy/adFubReI9zu8gD.Fy3kAvwNAA.C9OGot2.meRlaTS9DGFS', NULL, 0, '2020-01-22 09:37:27', '2020-01-22 09:37:27'),
(3, 'Mohammad esteghamat', 'sm_iransoftware@yahoo.com', NULL, '$2y$10$PNTxuUL4qebInsceO1jQ4u8RttMmIDw/TourvHb4kKDnu78hqe50S', NULL, 1, '2020-01-22 10:53:14', '2020-01-22 11:22:50');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug_unique_index` (`category_slug`);

--
-- Tablo için indeksler `filters`
--
ALTER TABLE `filters`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `galleries`
--
ALTER TABLE `galleries`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `markas`
--
ALTER TABLE `markas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `markas_slug_unique` (`marka_slug`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `model_dependencies`
--
ALTER TABLE `model_dependencies`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Tablo için indeksler `portfolios`
--
ALTER TABLE `portfolios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `portfolio_slug` (`portfolio_slug`);

--
-- Tablo için indeksler `site_content_heads`
--
ALTER TABLE `site_content_heads`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `site_content_items`
--
ALTER TABLE `site_content_items`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `site_content_items_contentitem_title_unique` (`contentitem_title`),
  ADD UNIQUE KEY `site_content_items_contentitem_slug_unique` (`contentitem_slug`);

--
-- Tablo için indeksler `site_content_types`
--
ALTER TABLE `site_content_types`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Tablo için AUTO_INCREMENT değeri `filters`
--
ALTER TABLE `filters`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Tablo için AUTO_INCREMENT değeri `galleries`
--
ALTER TABLE `galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Tablo için AUTO_INCREMENT değeri `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Tablo için AUTO_INCREMENT değeri `markas`
--
ALTER TABLE `markas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Tablo için AUTO_INCREMENT değeri `model_dependencies`
--
ALTER TABLE `model_dependencies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `portfolios`
--
ALTER TABLE `portfolios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Tablo için AUTO_INCREMENT değeri `site_content_heads`
--
ALTER TABLE `site_content_heads`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Tablo için AUTO_INCREMENT değeri `site_content_items`
--
ALTER TABLE `site_content_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Tablo için AUTO_INCREMENT değeri `site_content_types`
--
ALTER TABLE `site_content_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
