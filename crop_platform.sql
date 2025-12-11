-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 11, 2025 at 04:02 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `crop_platform`
--

-- --------------------------------------------------------

--
-- Table structure for table `crops`
--

CREATE TABLE `crops` (
  `id` int(11) NOT NULL,
  `crop_name` varchar(100) NOT NULL,
  `category` enum('grains','leafy','fruit','root','stem') NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `growth_period` varchar(50) NOT NULL,
  `preferred_season` enum('dry','wet','all') NOT NULL,
  `soil_type` varchar(100) NOT NULL,
  `soil_ph` varchar(50) NOT NULL,
  `crop_calendar` text NOT NULL,
  `soil_properties` text NOT NULL,
  `weather_season` text NOT NULL,
  `field_topography` text DEFAULT NULL,
  `common_pests_diseases` text NOT NULL,
  `recommended_pesticides` text NOT NULL,
  `spray_method` text NOT NULL,
  `recommended_fertilizers` text NOT NULL,
  `fertilizer_application` text NOT NULL,
  `average_yields` varchar(100) DEFAULT NULL,
  `harvesting_methods` text DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `crops`
--

INSERT INTO `crops` (`id`, `crop_name`, `category`, `image_path`, `description`, `growth_period`, `preferred_season`, `soil_type`, `soil_ph`, `crop_calendar`, `soil_properties`, `weather_season`, `field_topography`, `common_pests_diseases`, `recommended_pesticides`, `spray_method`, `recommended_fertilizers`, `fertilizer_application`, `average_yields`, `harvesting_methods`, `created_by`, `created_at`, `updated_at`) VALUES
(4, 'Mustard / Mustasa', 'leafy', '1760366392__vegies.jpeg', 'Kabilang ang mustasa(Brassica juncea) sa mga dahong gulay. Sa kabila ng kakaibang amoy at lasa nito, ang mustasa ay nagtataglay ng bitamina A, K, calcium, iron, at phosphorous. Maaari itong kainin nang hilaw, binuro o hinahalo sa ulam.', '80-95', 'wet', 'Porous soil', '5.5-6.5', '2 months and 2 weeks', 'Buhaghag na lupa o Sandy Loam', 'Wet season', '', 'Aphids, Diamondback Moth Caterpillar, Diamondback Moth Adult', 'Dinurog na sili, Tubig na may sabon. Pagtatanim ng sibuyas o cosmos sa tabi ng halaman.', 'Mag-spray ng 100 gramo na dinurog na sili na inihalo sa tubig at sabon at 16 litrong tubig: 1 kutsarang sabon', 'Fermented Plant Juice, binulok na dumi ng manok, carbonized rice hull', 'Maglagay ng 1 kilong organikong pataba o binulok na dumi ng manok at 300 gramong carbonized rice hull kada metro kuwadrado.', NULL, NULL, 1, '2025-09-10 21:56:35', '2025-10-13 18:10:27'),
(5, 'Lady’s Fingers / Okra', 'fruit', '1757859219_okra.jpg', 'Ang okra (Hibiscus esculentes L, Abelmoschus esculentus L. Moench) ay kabilang sa pamilya ng Solanaceous. Kilala ito bilang &amp;amp;amp;amp;quot;saluyot a bunga&amp;amp;amp;amp;quot; sa Ilocano at kaluyot sa Ifugao. Isa itong kilala at karaniwang gulay sa merkado. Ang mga bunga nito ay maaaring kaining hilaw, pinakuluan o pinitrito. Nagtataglay ang mga buto ng okra ng dekalidad na klase ng langis at protina.', '50-70', 'dry', 'Buhaghag na lupa o Sandy Loam', '5.5-7.0', '40-45 beses sa buong cropping season', 'Lupang buhaghag (Sandy Loam)', 'Dry season', '', 'Aphids, Diamondback Moth, Whitefly, Cotton Stainer, Mealybug, Sting bug', 'Magtanim ng sibuyas at cosmos, Organic Fermented Juice', 'Diligan ang mga halaman araw-araw o 2-3 beses sa isang linggo.', 'Vermicompost o komersyal na abono, Carbonized Rice Hull (CRH)', 'Maglagay ng 5 kilong pataba Vermicompost o komersyal na abono, Carbonized Rice Hull (CRH), kada metro-kuwadrado (5 kg/m). Para sa (Basal Application) 500 gramo kada tudling, maglagay ng abono 30 araw pagkatapos sumibol.', NULL, NULL, 1, '2025-09-14 07:13:39', '2025-10-13 18:07:08'),
(6, 'Tomatoe / Kamatis', 'fruit', '1757862852_tomatoe.png', 'Ang kamatis (Lycopersicum esculentum Miller) ay isa sa mga pangunahing gulay na pinaparami sa ating bansa. Nagtataglay ito ng bitamina A at C. Gayundin, mayroong mataas na dietary fiber, beta carotene, iron, lycopene, magnesium, niacin, potassium, phosphorous, riboflavin at thiamine.', '60-100', 'dry', 'Sandy Loam at Clay Loam', '5.5-8.0', '2 months', 'Sandy loam / Clay loam', 'Dry season', '', 'Pest: Thrips, Whiteflies, and Fruit worm \r\nDiseases: Mosaic virus, bacterial wilt, and nematodes infection', 'Magtanim ng basil, sibuyas, at amarilyo sa tabi ng halaman.', 'Diligan ng mainit na tubig upang mamatay ang mga peste.', 'Kompos, Carbonized Rice Hull (CRH) at garden soil (1:1:1), Urea (14-14-14)', 'Magdilig ng 1 kutsarang Urea  sa bawat galon ng tubig ika-10 araw ng pagsibol', NULL, NULL, 1, '2025-09-14 07:40:47', '2025-10-13 18:16:09'),
(7, 'Chilli / Sili', 'fruit', '1757862426_sili.jpg', 'Ang tanim na sili (Capsium annuum L) ay kabilang sa mga solanaceous crops. Mainam itong itanim sa sandy loam na lupa na sagana sa organikong bagay. Maaari itong itanim sa anumang buwan ng taon sa mga lugar na mabababa o medyo mataas. Mainam itong pampagana ng kain. Nagtataglay ito ng bitamina A at C, iron at calcium. Ginagamit itong panghalo sa mga nilulutong pagkain o sawsawan.', '60-75', 'all', 'Lupang buhaghag (Sandy Loam)', '5.5-7.0', '2 months', 'Buhaghag na lupa / Sandy loam', 'Dry or wet season', '', 'Thrips, Hanip, Uod, Langaw', 'Maaari ring magtanim ng sibuyas, amarilyo, mais, zinnia, at cosmos sa paligid ng halaman.', 'Diligan ang taniman araw-araw o kung kinakailangan', 'Nabulok na dumi ng hayop / Kompos, Carbonized Rice Hull (CRH)', 'Paglalagay ng mulch ay makababawas ng 50 porsiyentong pagdidilig. Tiyaking walang damo ang taniman lalo sa panahong ika-12 hanggang 48 araw pagkalipat-tanim dahil sensitibo ang tanim sa panahong ito. Magtanggal ng damo kung kinakailangan.', NULL, NULL, 1, '2025-09-14 08:07:06', '2025-10-13 18:19:11'),
(8, 'Bitter gourd / Ampalaya', 'fruit', '1757949913_ampalaya.webp', 'Ang ampalaya (Momordica charantia) o amorgoso ay isa sa mga masustansyang gulay na kapamilya ng Cucurbitae o mga gulay na baging (vine). Ang mga bunga at dahon nito ay kilala sa pagkakaroon ng mapait na lasa dahil sa taglay na momordicin . Ito ay gamot para sa mga taong anemic dahil sa taglay nitong makapagpapadagdag ng dugo sa katawan. Taglay din nito ang insulin na nakatutulong para pigilan ang pagtaas o pagbaba ng blood sugar. May taglay din na mga minerals tulad ng calcium, potassium, copper, at iron, at mga bitamina tulad ng A, B1, B2, AT C.', '35-70', 'dry', 'Buhaghag na lupa (Sandy Loam o Clay Loam)', '6.0-6.7', '3 months', 'Sandy Loam / Clay Loam', 'Dry season', '', 'Pest: Aphids, Fruit Flies, Melon Worms, Cutworms\r\n\r\nDiseases: Powdery Mildew, Anthracnose, Downy Mildew', 'Malathion na natagpuang epektibo sa ilang mga pagsubok o permethrin.', 'Mag isprey ng fermented plant juice o FPJ bago mamulaklak at fermented fruit juice o FFJ kapag mag-umpisa nang mamunga.', '21-0-0 (Ammonium Sulfate), 14-14-14 (Complete Granular Fertilizer), 16-20-0 (Ammonium Phosphate)', '14-14-14 (Complete Granular Fertilizer) 3 sako sa pagtatanim (Basal)\r\n21-0-0 (Ammonium Sulfate) at 16-20-0 (Ammonium Phosphate) 6 sako 28 araw pagkatanim (Side Dress)', NULL, NULL, 1, '2025-09-15 08:25:13', '2025-10-13 18:19:42'),
(9, 'Eggplant / Talong', 'fruit', '1760366263_fresh_eggplant_vegetable_healthy_food_eggplant_vegetable_fresh_png.jpeg', 'Ang talong (Solanum melongena) ay miyembro ng tinatawag na nightshade family at nabibilang na kaanak ng kamatis, sili, at patatas. Kung tag-araw , mainam na itanim ang gulay na ito sa mga buwan ng Oktubre hanggang Pebrero at mula Mayo hanggang Setyembre naman kung tag-ulan.', '70-90', 'dry', 'Sandy Loam at Clay Loam', '6.0-6.5', '2 months and 1 week', 'Sandy loam / Clay loam', 'Dry season', '', 'Pest: White flies, Flee beetles, Colorado potato beetles, Hornworms, Spider Mites, Lace bugs\r\n\r\nDiseases: Bacterial wilt, Fungal blights, Cucumber mosaic virus', 'Botanical pesticides (neem tree, sili, at bawang) sa pagkontrol ng insekto.', 'Conventional o hindi naka- plastic mulch, diligan sa pagitan ng bawat hilera upang matunaw ang mga pataba at maiwasan ang direct contact nito sa ugat ng mga punla.', 'Organikong pataba, Garden Soil, Inuling na ipa (1:1:1 ratio), Urea (Nitrogen Fertilizer), 0-0-60 (Muriate Potash), 14-14-14 (Complete Fertilizer)', 'Seedbed Method / Pamumunla sa Lupa: 1 kutsarang Urea sa bawat galon ng tubig ika-7 araw pagkatubo.\r\n6 gramo (0.4 tbsp) urea (46-0-0) bawat tudling 3-9 linggo pagkalipat-tanim. 3 gramo ng 0-0-60 (Muriate Potash) bawat tudling 6-12 na linggo. 8 gramo ng 14-14-14 (Complete Fertilizer) bawat tudling 15 na linggo pagkalipat-tanim.', NULL, NULL, 1, '2025-09-15 09:01:51', '2025-10-13 18:20:46'),
(10, 'Silk Squash / Patola', 'fruit', '1757952883_patola.webp', 'Ang patola (Luffa acutangula) o kabatiti sa Iluko at Ibanag ay mayaman sa phosphorous, calcium, at iron. Ang mga lalaking bulaklak ng patola ay nagkukumpol-kumpolv samantalang ang mga babaeng bulaklak ay maaaring isahan lamang o kaya ay kasama ng mga lalaking bulaklak.', '60-90', 'wet', 'Sandy Loam at Clay Loam', '6.0-6.8', '3 months', 'Fertile Soil / Clay Loam / Sandy Loam', 'Wet season', '', 'Fruit fly, downy mildew, at powdery mildew', 'Neem oil, Insecticidal Soap solutions, Mineral oils', 'Mag ispray ng isang galong tubig na may tinunaw na 1 kutsarang sabon', '14-14-14 (Complete Fertilizer), 46-0-0 (Urea / Nitrogen Fertilizer), Organic (nabulok na dumi ng hayop o komersiyal na organikong pataba)', 'Basal: 14-14-14 (Complete Fertilizer): 1 kutsara o 10 gramo bawat butas bago magtanim o kapag umusbong na 2-3 dahon;\r\nOrganic 3,000 na sako kada ektarya sa panahon ng pagtatanim;\r\nSidedress: 46-0-0 (Urea / Nitrogen Fertilizer): 1 kutsara o 10 gramo bawat butas 28-araw pagka usbong; 14-14-14 (Complete Fertilizer): 1 kutsara o 10 gramo bawat butas 28-araw pagka usbong; 46-0-0 (Urea / Nitrogen Fertilizer): 1 kutsara o 40 gramo bawat butas 56,70 at 84 araw pagka-usbong; 14-14-14 (Complete Fertilizer): 1 kutsara o 40 gramo bawat butas 56,70 at 84 araw pagka-usbong.', NULL, NULL, 1, '2025-09-15 09:14:43', '2025-10-13 18:42:09'),
(11, 'Bottle gourd/ Upo', 'fruit', '1760366184_Long_Bottle_Gourd_Seeds___Calabash_Gourd__F1___NON-GMO.jpeg', 'Ang upo (Lagenaria siceraria [Moilina] Standley) ay mas kilala sa tawag na Tabungaw sa mga Ilokano at Kandol naman sa mga Ibanag. Ito ay mayaman sa bitamina A at C, calcium, potassium, at carbohydrates.', '60-80', 'all', 'Sandy Loam or Loamy soil', '5.5-7.5', '2 months and 2 weeks', 'Well-drained at Sandy loam na lupa', 'Wet/Dry', '', 'Powdery mildew, Leaf spot, Fusarium wilt, Gummy stem blight, at Leaf miner', 'Neem oil, malathion, dimethoate, imidacloprid, o fenvalerate', 'Gumamit ng mga organik na opsyon tulad ng neem oil na hinaluan ng tubig at shampoo, o mga kemikal na opsyon tulad ng mga partikular na growth regulator.', 'Organikong pataba (compost, dumi ng baka, o vermicompost), 14-14-14 (Complete Fertilizer), 46-0-0 (Nitrogen Fertilizer)', 'Basal: 14-14-14 (Complete Fertilizer): 2 sako kada ektarya o 20 gramo bawat butas bago magtanim o kapag may umusbong na 2-3 dahon; Organikong pataba (compost, dumi ng baka, o vermicompost): 20 sako kada ektarya.\r\n\r\nSidedress: 46-0-0 (Nitrogen Fertilizer: 1 sako kada ektarya o 10 gramo bawat butas 28-araw pagka-usbong; 46-0-0 (Nitrogen Fertilizer): 2 sako kada ektarya o 20 gramo bawat butas 56, 70 at 84 araw pagkausbong at parehong dami.', NULL, NULL, 1, '2025-10-13 14:36:24', '2025-10-13 18:52:56'),
(12, 'Squash / Kalabasa', 'fruit', '1760372039_download__2_.jpeg', 'Ang kalabasa (Cucurbita maxima L.) ay kadalasang itinatanim sa bakuran ng bahay at komersyal na lugar dahil sa prutas, talbos, bulaklak, at buto nito. Sa ibang lugar, karaniwang ginagawa ang pagtatanim ng kalabasa sa pagitan ng mga tanim gaya ng mais, tubo, at niyog. \r\nPara sa mas masaganang ani, magtanim sa mga buwan ng Oktubre hanggang Disyembre sa mababang lugar at Mayo hanggang Hulyo naman sa matataas na lugar.', '80-115', 'dry', 'Sandy loam', '5.5-6.5', '3 months and 3 weeks', 'Well-drained at Sandy loam', 'Dry', '', 'Aphids, 28 Spotted Lady Beetle, at Mosaic Virus', 'Dinurog ng siling maanghang, Tubig na may sabon, at Abo ng sinunog na kahoy sa dahon ng halaman', 'Mag-isprey ng pinaghalong 2 kutsarang dinurog ng siling maanghang at 1 kutsarang sabon sa isang gallon na tubig. Maglagay ng abo ng sinunog na kahoy sa dahon ng halaman.', 'Nabulok na tuyong damo at halaman o organikong pataba sa lupa, 14-14-14 (Complete Fertilizer) 0-0-60 (Potash / High Potassium Fertilizer), 0-60-0 (Solophos)', 'Mag-apply ng 100 gramo ng organikong pataba at haluan ng 1 kutsara ng (14-14-14) na pataba sa bawat butas bago magtanim. Mag side-dress ng 1 kutsarang Urea bawat tudling isang buwan matapos ang pagtatanim o kung ang mga halaman ay mayroon ng 1 metro ang haba. Mag-apply ng 10 gramo ng Potash (0-0-60) at 60 gramo ng Solophos (0-60-0) bawat halaman dalawang linggo pagkatapos ng unang side-dressing. Maaaring magdagdag ng Urea o Potash tuwing 15 araw depende sa crop stand.', NULL, NULL, 1, '2025-10-13 16:13:59', '2025-10-13 19:03:19');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `user_id`, `login_time`) VALUES
(1, 1, '2025-08-22 06:47:56'),
(2, 2, '2025-10-17 06:48:46'),
(3, 22, '2025-10-17 06:49:21'),
(4, 23, '2025-10-17 06:50:00'),
(5, 1, '2025-11-17 06:52:47'),
(6, 1, '2025-10-22 08:15:23'),
(7, 2, '2025-10-22 08:30:45'),
(8, 22, '2025-10-22 09:15:12'),
(9, 23, '2025-10-22 09:45:33'),
(10, 24, '2025-10-22 10:20:18'),
(11, 25, '2025-10-22 11:05:47'),
(12, 26, '2025-10-22 13:30:22'),
(13, 27, '2025-10-22 14:15:39'),
(14, 28, '2025-10-22 15:00:51'),
(15, 1, '2025-10-23 08:20:15'),
(16, 2, '2025-10-23 08:45:30'),
(17, 29, '2025-10-23 09:30:42'),
(18, 30, '2025-10-23 10:15:28'),
(19, 31, '2025-10-23 11:00:19'),
(20, 32, '2025-10-23 13:45:33'),
(21, 33, '2025-10-23 14:30:47'),
(22, 34, '2025-10-23 15:15:22'),
(23, 1, '2025-10-24 08:25:18'),
(24, 35, '2025-10-24 09:10:45'),
(25, 36, '2025-10-24 09:55:33'),
(26, 37, '2025-10-24 10:40:27'),
(27, 38, '2025-10-24 11:25:19'),
(28, 39, '2025-10-24 13:50:44'),
(29, 40, '2025-10-24 14:35:38'),
(30, 41, '2025-10-24 15:20:29'),
(31, 1, '2025-10-27 08:18:33'),
(32, 2, '2025-10-27 08:42:15'),
(33, 42, '2025-10-27 09:27:48'),
(34, 43, '2025-10-27 10:12:36'),
(35, 44, '2025-10-27 10:57:24'),
(36, 45, '2025-10-27 11:42:19'),
(37, 46, '2025-10-27 13:17:55'),
(38, 47, '2025-10-27 14:02:41'),
(39, 22, '2025-10-27 14:47:33'),
(40, 23, '2025-10-27 15:32:28'),
(41, 1, '2025-10-28 08:22:47'),
(42, 48, '2025-10-28 09:07:35'),
(43, 49, '2025-10-28 09:52:29'),
(44, 50, '2025-10-28 10:37:18'),
(45, 51, '2025-10-28 11:22:14'),
(46, 24, '2025-10-28 13:47:39'),
(47, 25, '2025-10-28 14:32:25'),
(48, 26, '2025-10-28 15:17:16'),
(49, 1, '2025-10-29 08:28:19'),
(50, 27, '2025-10-29 09:13:42'),
(51, 28, '2025-10-29 09:58:37'),
(52, 29, '2025-10-29 10:43:25'),
(53, 30, '2025-10-29 11:28:19'),
(54, 31, '2025-10-29 13:53:44'),
(55, 32, '2025-10-29 14:38:31'),
(56, 33, '2025-10-29 15:23:27'),
(57, 1, '2025-10-30 08:32:28'),
(58, 34, '2025-10-30 09:17:15'),
(59, 35, '2025-10-30 10:02:39'),
(60, 36, '2025-10-30 10:47:26'),
(61, 37, '2025-10-30 11:32:18'),
(62, 38, '2025-10-30 13:57:43'),
(63, 39, '2025-10-30 14:42:37'),
(64, 40, '2025-10-30 15:27:29'),
(65, 1, '2025-10-31 08:35:42'),
(66, 41, '2025-10-31 09:20:35'),
(67, 42, '2025-10-31 10:05:28'),
(68, 43, '2025-10-31 10:50:19'),
(69, 44, '2025-10-31 11:35:14'),
(70, 45, '2025-10-31 14:00:39'),
(71, 46, '2025-10-31 14:45:33'),
(72, 47, '2025-10-31 15:30:27'),
(73, 1, '2025-11-03 08:25:33'),
(74, 2, '2025-11-03 08:48:19'),
(75, 48, '2025-11-03 09:33:42'),
(76, 49, '2025-11-03 10:18:35'),
(77, 50, '2025-11-03 11:03:28'),
(78, 51, '2025-11-03 13:28:53'),
(79, 22, '2025-11-03 14:13:47'),
(80, 23, '2025-11-03 14:58:39'),
(81, 1, '2025-11-04 08:28:47'),
(82, 24, '2025-11-04 09:13:35'),
(83, 25, '2025-11-04 09:58:29'),
(84, 26, '2025-11-04 10:43:18'),
(85, 27, '2025-11-04 11:28:14'),
(86, 28, '2025-11-04 13:53:39'),
(87, 29, '2025-11-04 14:38:25'),
(88, 30, '2025-11-04 15:23:16'),
(89, 1, '2025-11-05 08:32:19'),
(90, 31, '2025-11-05 09:17:42'),
(91, 32, '2025-11-05 09:58:37'),
(92, 33, '2025-11-05 10:43:25'),
(93, 34, '2025-11-05 11:28:19'),
(94, 35, '2025-11-05 13:53:44'),
(95, 36, '2025-11-05 14:38:31'),
(96, 37, '2025-11-05 15:23:27'),
(97, 1, '2025-10-22 13:45:18'),
(98, 1, '2025-10-23 14:20:33'),
(99, 1, '2025-10-24 15:05:47'),
(100, 1, '2025-10-27 16:30:22'),
(101, 1, '2025-10-28 17:15:39'),
(102, 1, '2025-10-29 18:00:51'),
(103, 1, '2025-10-30 16:45:18'),
(104, 1, '2025-10-31 17:30:33'),
(105, 1, '2025-11-03 18:15:47'),
(106, 1, '2025-11-04 16:50:22'),
(107, 1, '2025-11-05 17:35:39'),
(108, 22, '2025-11-17 07:33:08'),
(109, 22, '2025-11-17 07:35:57'),
(110, 1, '2025-11-17 08:07:55'),
(111, 22, '2025-11-17 08:10:40'),
(112, 1, '2025-11-17 08:11:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uli` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL DEFAULT 'Sample',
  `last_name` varchar(50) NOT NULL,
  `number_street` varchar(20) DEFAULT NULL,
  `barangay` varchar(20) DEFAULT NULL,
  `district` varchar(20) DEFAULT NULL,
  `city_municipality` varchar(20) DEFAULT NULL,
  `province` varchar(20) DEFAULT NULL,
  `region` varchar(20) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `nationality` varchar(20) NOT NULL DEFAULT 'Filipino',
  `password` varchar(255) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `birthplace_city` varchar(50) DEFAULT NULL,
  `birthplace_province` varchar(50) DEFAULT NULL,
  `birthplace_region` varchar(50) DEFAULT NULL,
  `civil_status` varchar(20) DEFAULT NULL,
  `employment_status` enum('employed','self-employed','unemployed') DEFAULT NULL,
  `education_level` enum('no_grade','elementary','elementary_grad','hs_grad','hs_level','post_secondary','college_level','college_grad') DEFAULT NULL,
  `classification` varchar(100) DEFAULT NULL,
  `profile_picture` varchar(100) DEFAULT NULL,
  `role` enum('admin','farmer') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uli`, `first_name`, `middle_name`, `last_name`, `number_street`, `barangay`, `district`, `city_municipality`, `province`, `region`, `email`, `phone`, `nationality`, `password`, `gender`, `birthdate`, `birthplace_city`, `birthplace_province`, `birthplace_region`, `civil_status`, `employment_status`, `education_level`, `classification`, `profile_picture`, `role`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Administrator', 'Sample', 'Admin', NULL, NULL, NULL, NULL, NULL, NULL, 'Admin@ramis.agrofarm.com', '123-456-7890', 'Filipino', '$2y$10$ynliQBS8pQhKldHpJupwNuhnCKEPcY8TW1I7iz.pVXOrGbCxPorWq', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'admin', '2025-08-20 00:30:53', '2025-11-16 23:55:28'),
(2, 'ALF-90-606-02031-001', 'John', 'Sample', 'Farmer', NULL, NULL, NULL, NULL, NULL, NULL, 'farmer@gmail.com', '098-765-4321', 'Filipino', '$2y$10$CRSBtzdQDu2Kyf7FaQgbn.XWCGR41f9qgkJy5SMbCBLk1qqpwCqF6', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-08-20 00:30:53', '2025-08-21 08:42:09'),
(22, 'ALF-90-606-02031-002', 'Lovely  Gay', 'Sample', 'Albano', NULL, NULL, NULL, NULL, NULL, NULL, 'albano@gmail.com', '09758688299', 'Filipino', '$2y$10$VSeonkr8zZVf5N5qsI5jD.8TvRgF44o86btMBvYakYoeWFdf9eiae', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 01:03:11', '2025-10-27 01:03:11'),
(23, 'ALF-90-606-02031-003', 'Joen Benedict', 'Sample', 'Alvarez', NULL, NULL, NULL, NULL, NULL, NULL, 'joenalvarez0805@gmail.com', '09283597764', 'Filipino', '$2y$10$q.7tU9AEyT0f17GAuR47LOhH.MG4ZZMnExUQFXalHzRMfss356RT6', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 01:08:05', '2025-11-16 23:52:36'),
(24, 'ALF-90-606-02031-004', 'Jose Ronaldo', 'Sample', 'Cadiz', NULL, NULL, NULL, NULL, NULL, NULL, 'joseronaldocadiz@gmail.com', '09051962163', 'Filipino', '$2y$10$cQV2/QPmqfWKZIPfpodq8..QrA/94hYUrZNUy6fF28vGJU24wRrzi', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 01:12:43', '2025-10-27 01:12:43'),
(25, 'ALF-90-606-02031-005', 'Decery Claire', 'Sample', 'Cadiz', NULL, NULL, NULL, NULL, NULL, NULL, 'cadizdecery@gmail.com', '09279920342', 'Filipino', '$2y$10$K2Aj8qyQfmjgvjJ9KP1WZOGzwlNfe0kPP4Z70TsZhtq00Xl1VVoxq', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 01:14:16', '2025-10-27 01:14:16'),
(26, 'ALF-90-606-02031-006', 'Ericson', 'Sample', 'Cuizon', NULL, NULL, NULL, NULL, NULL, NULL, 'bigjuderic@gmail.com', '09976621428', 'Filipino', '$2y$10$sa4nftEPFNomEqkH07xc7.REAaxtIwJKKmJuJEMVq/CPyMm9iMsQ2', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 01:20:01', '2025-10-27 01:20:01'),
(27, 'ALF-90-606-02031-007', 'Grace', 'Sample', 'Dasalla', NULL, NULL, NULL, NULL, NULL, NULL, 'dasallagrace11@gmail.com', '09659545048', 'Filipino', '$2y$10$4Fk.chmlaxSfIFWYseFyQu.7l9z122D61al2aZCcHxziGbKj1.8Te', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 12:46:47', '2025-10-27 12:46:47'),
(28, 'ALF-90-606-02031-008', 'Esmeralda', 'Sample', 'Del Rosario', NULL, NULL, NULL, NULL, NULL, NULL, 'esmeraldadelrosario4@gmail.com', '09558990549', 'Filipino', '$2y$10$XGU6UqNZzKxamLnSlo.geuEzyHiBDXiG6.w3CFMKh/FzvnoaZvosm', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 12:49:13', '2025-10-27 12:49:13'),
(29, 'ALF-90-606-02031-009', 'Marinelli', 'Sample', 'Domingo', NULL, NULL, NULL, NULL, NULL, NULL, 'ryanvpascua@gmail.com', '09675112406', 'Filipino', '$2y$10$/ljzZgZFCoMe9tv2yzUVRuiyruuvjkw9hA4RGcXqfKHnkmzGlBL2.', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 12:51:04', '2025-10-27 12:51:04'),
(30, 'ALF-90-606-02031-010', 'Nobemer', 'Sample', 'Domingo', NULL, NULL, NULL, NULL, NULL, NULL, 'nobed238@gmail.com', '09759079144', 'Filipino', '$2y$10$KHiDcTqcLDI4ENOmx/CGVeYIckJ2O/c6N5FCzQo.5AqX3o89S25ai', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 12:53:10', '2025-10-27 12:53:10'),
(31, 'ALF-90-606-02031-011', 'Josefina', 'Sample', 'Esteves', NULL, NULL, NULL, NULL, NULL, NULL, 'josefinasapon955@gmail.com', '09391130404', 'Filipino', '$2y$10$jgNVssMEIxY6TuUZUMOqzewku390xWUOxLj2WlJuVQOkIm9zlje6C', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 12:54:53', '2025-10-27 12:54:53'),
(32, 'ALF-90-606-02031-012', 'Rosario', 'Sample', 'Florentino', NULL, NULL, NULL, NULL, NULL, NULL, 'rosarioflorentino27@gmail.com', '09367781883', 'Filipino', '$2y$10$5Tspu8qeSfIvFeKuA5LgjOR2sJtEBH8qugLRL0YOGV52YnKHXdhnm', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 12:57:02', '2025-10-27 12:57:02'),
(33, 'ALF-90-606-02031-013', 'Jessan', 'Sample', 'Fontanilla', NULL, NULL, NULL, NULL, NULL, NULL, 'fontanillajessan1017@gmail.com', '09655710729', 'Filipino', '$2y$10$ZpWpzr6OcJRS/EwOc76OReBIWL4QM03.oHup2JREXdEwbXnyU6FY2', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 12:59:03', '2025-10-27 12:59:03'),
(34, 'ALF-90-606-02031-014', 'Earl Andrew', 'Sample', 'Galutan', NULL, NULL, NULL, NULL, NULL, NULL, 'earlandrewgalutan@gmail.com', '09751035746', 'Filipino', '$2y$10$V1OL2BdKXutx4FtW31wV9uD65bkDAdnKIgAe6KaR9q36YdnrX6r0W', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 13:00:41', '2025-10-27 13:00:41'),
(35, 'ALF-90-606-02031-015', 'Archie', 'Sample', 'Limon', NULL, NULL, NULL, NULL, NULL, NULL, 'archielimon8@gmail.com', '09772785133', 'Filipino', '$2y$10$KjgbpjuW1iknmpDcqirYleIn6wWTefdR31gv16oOCjlj5zMYZnxN6', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 13:02:39', '2025-10-27 13:02:39'),
(36, 'ALF-90-606-02031-016', 'Imelda', 'Sample', 'Malabad', NULL, NULL, NULL, NULL, NULL, NULL, 'imeldamalabad@gmail.com', '09066434984', 'Filipino', '$2y$10$4PW2ZkzYFuicgpwHi3bnF.K8N4FjjC9K7K3zZHkeI2v8pXSAc/nJ2', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 13:05:19', '2025-10-27 13:05:19'),
(37, 'ALF-90-606-02031-017', 'Maricon', 'Sample', 'Marquez', NULL, NULL, NULL, NULL, NULL, NULL, 'mariconmarquezjuan@gmail.com', '09296918218', 'Filipino', '$2y$10$7wHsIuKTYC7Vx7RYpiPG/ePCbc2uvJBwB9nvWsQA/HXKV8rvg0UmS', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 13:07:05', '2025-10-27 13:07:05'),
(38, 'ALF-90-606-02031-018', 'Ruena', 'Sample', 'Ramos', NULL, NULL, NULL, NULL, NULL, NULL, 'ramosruena7@gmail.com', '09158483692', 'Filipino', '$2y$10$LHZW/uADnvC7e7yZAjgFPe8afE41iG.DND0PXLmdBuW4OjC70C9SG', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 13:08:48', '2025-10-27 13:08:48'),
(39, 'ALF-90-606-02031-019', 'Billy Joe', 'Sample', 'Sagaysay', NULL, NULL, NULL, NULL, NULL, NULL, 'sagaysaybillyjoe1990@gmail.com', '09264492287', 'Filipino', '$2y$10$RXrvPmK79c/l./KJ4WCSjeVX2zAwOoOLqsIsx5ldKMBSV3jNDPxhC', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 13:10:29', '2025-10-27 13:10:29'),
(40, 'ALF-90-606-02031-020', 'Eric Jun', 'Sample', 'Sarmiento', NULL, NULL, NULL, NULL, NULL, NULL, 'efrengracejavar@gmail.com', '09303183245', 'Filipino', '$2y$10$7t92q9x.MNg8nwSDDuDJcek.4NBLYx6PzfZtfMAoXtaVxYq.XhMm.', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 13:12:33', '2025-10-27 13:12:33'),
(41, 'ALF-90-606-02031-021', 'Princess Shairah', 'Sample', 'Silao', NULL, NULL, NULL, NULL, NULL, NULL, 'silaoprincessshairah@gmail.com', '09263424356', 'Filipino', '$2y$10$K9c1jQE64FTLsCmv/SHIBehgCdy7zjA2Fc93Xcohbd6JRwU/MZEcK', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 13:14:15', '2025-10-27 13:14:15'),
(42, 'ALF-90-606-02031-022', 'Edeliza', 'Sample', 'Soriano', NULL, NULL, NULL, NULL, NULL, NULL, 'edelizasoriano5@gmail.com', '09263022744', 'Filipino', '$2y$10$WcIF5vXcmSPzRgJk4KEyS.0A3vXVSk31FjfNsMhrrXo30XYfycr3G', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 13:16:08', '2025-10-27 13:16:08'),
(43, 'ALF-90-606-02031-023', 'Alex', 'Sample', 'Torres', NULL, NULL, NULL, NULL, NULL, NULL, 'rebeccacastorerde@gmail.com', '09475012191', 'Filipino', '$2y$10$y1kAiX6/g4wr08bHcRLXVeOSu1xLPnr5xcy5JTxKW9bPf9kjqXFRS', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 13:17:48', '2025-10-27 13:17:48'),
(44, 'ALF-90-606-02031-024', 'Carmelita', 'Sample', 'Ulnagan', NULL, NULL, NULL, NULL, NULL, NULL, 'carmenulnagan20@gmail.com', '09162760125', 'Filipino', '$2y$10$xP4vsubmmFVQnShcb2KzheRKvX8Tg1swj4yDW1zK5l37R2hsX80V6', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 13:20:14', '2025-10-27 13:20:14'),
(45, 'ALF-90-606-02031-025', 'John Carlo', 'Sample', 'Ulnagan', NULL, NULL, NULL, NULL, NULL, NULL, 'johncarloulnagan@gmail.com', '09655539390', 'Filipino', '$2y$10$PpIm3toAVQul.EXyV/Mjsuir6KzYV1xwklddaGgnq2O7c1.a0uofu', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 13:21:53', '2025-10-27 13:21:53'),
(46, 'ALF-90-606-02031-026', 'Mark Kennedy', 'Sample', 'Villacentino', NULL, NULL, NULL, NULL, NULL, NULL, 'villacentinomarkkennedy@gmail.com', '09533147634', 'Filipino', '$2y$10$pvHV19ksRW4Sd0Gl.3/pj.1GR2COJS9dmfx4BfVOij2NCpLiMJoaW', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 13:23:23', '2025-10-27 13:23:23'),
(47, 'ALF-90-606-02031-027', 'Arnel', 'Sample', 'Ancheta', NULL, NULL, NULL, NULL, NULL, NULL, 'anchetaarnel94@gmail.com', '09538639331', 'Filipino', '$2y$10$MR0S2FIo0tKWuwPOuv5i/O1z.NvGJ37./WM6wuzvmfHRWk0vPjs2W', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 01:58:35', '2025-11-06 01:58:35'),
(48, 'ALF-90-606-02031-028', 'Jennyver Keith', 'Sample', 'Babas', NULL, NULL, NULL, NULL, NULL, NULL, 'babaskeith@gmail.com', '09059382322', 'Filipino', '$2y$10$7ebAQhQ.D0wqz7VYyMmi/.Aw0pp2NEuj.RLqZtDOX8d2L7VjxoEBq', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 02:00:47', '2025-11-06 02:00:47'),
(49, 'ALF-90-606-02031-029', 'Edjane', 'Sample', 'Babas', NULL, NULL, NULL, NULL, NULL, NULL, 'edjanebabas@gmail.com', '09166366107', 'Filipino', '$2y$10$Ze1UyHtO0QVqF4ylM2gOUukTmSNUmU5DbzfHJNbocUVL4pFnm8ufy', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 02:02:03', '2025-11-06 02:02:03'),
(50, 'ALF-90-606-02031-030', 'Maryjane', 'Sample', 'Babas', NULL, NULL, NULL, NULL, NULL, NULL, 'babasmaryjane@gmail.com', '09158227217', 'Filipino', '$2y$10$J571VYh/DF2ur.aWr4L9TOGel7ShQiiW9jBy40inLV/4Q5n6ZcIEa', 'Female', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 02:03:42', '2025-11-06 02:03:42'),
(51, 'ALF-90-606-02031-031', 'Ethan Brix', 'Sample', 'Detera', NULL, NULL, NULL, NULL, NULL, NULL, 'brixmartin@gmail.com', '09357997186', 'Filipino', '$2y$10$FEYBsR.tXk0M/amP2Nszye/zGnSH5i67X9eBBUkMNFz.U83HJThX2', 'Male', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'farmer', '2025-10-22 02:32:05', '2025-11-06 02:32:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crops`
--
ALTER TABLE `crops`
  ADD PRIMARY KEY (`id`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crops`
--
ALTER TABLE `crops`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `crops`
--
ALTER TABLE `crops`
  ADD CONSTRAINT `crops_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
