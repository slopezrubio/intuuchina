-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-01-2020 a las 16:37:07
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `intuuchina`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_09_13_161025_create_states_table', 1),
(2, '2014_10_12_000000_create_users_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_04_26_110328_create_offers_table', 1),
(5, '2019_05_03_000001_create_customer_columns', 1),
(6, '2019_05_03_000002_create_subscriptions_table', 1),
(7, '2019_06_04_173904_testimonials', 1),
(8, '2019_12_25_153306_add_api_token_to_users_table', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `industry` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `picture` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `offers`
--

INSERT INTO `offers` (`id`, `created_at`, `updated_at`, `title`, `location`, `industry`, `duration`, `description`, `picture`) VALUES
(1, '2020-01-07 11:23:16', '2020-01-07 11:23:16', 'Computer Scientist', 'honk-kong', 'consultant', 9, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_consultant_picture.jpg'),
(2, '2020-01-07 11:03:57', '2020-01-07 11:03:57', 'Production Inspector', 'beijing', 'hospitality', 4, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_hospitality_picture.jpg'),
(3, '2020-01-07 11:03:57', '2020-01-07 11:03:57', 'Nursing Aide', 'shanghai', 'marketing_business', 6, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_marketing_business_picture.jpg'),
(4, '2020-01-07 11:23:16', '2020-01-07 11:23:16', 'Surveying and Mapping Technician', 'shenzhen', 'legal', 23, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_legal_picture.jpg'),
(5, '2020-01-07 11:03:57', '2020-01-07 11:03:57', 'Valve Repairer OR Regulator Repairer', 'shenzhen', 'it', 22, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_it_picture.jpg'),
(6, '2020-01-07 12:06:35', '2020-01-07 12:06:35', 'Anesthesiologist', 'honk-kong', 'education', 14, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_education_picture.jpg'),
(7, '2020-01-07 12:06:35', '2020-01-07 12:06:35', 'Freight and Material Mover', 'shenzhen', 'legal', 5, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_legal_picture.jpg'),
(8, '2020-01-07 12:06:35', '2020-01-07 12:06:35', 'Preschool Teacher', 'shenzhen', 'legal', 22, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_legal_picture.jpg'),
(9, '2020-01-07 12:06:35', '2020-01-07 12:06:35', 'Bicycle Repairer', 'honk-kong', 'it', 5, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_it_picture.jpg'),
(10, '2020-01-07 12:06:35', '2020-01-07 12:06:35', 'Agricultural Equipment Operator', 'beijing', 'design', 6, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_design_picture.jpg'),
(11, '2019-10-24 09:52:00', '2007-11-04 21:57:22', 'Sales Representative', 'beijing', 'hospitality', 20, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_hospitality_picture.jpg'),
(12, '2019-09-04 17:43:04', '1978-09-18 11:41:03', 'Artillery Crew Member', 'shanghai', 'finance', 17, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_finance_picture.jpg'),
(13, '2019-03-13 09:58:16', '1970-01-02 03:22:23', 'Agricultural Product Grader Sorter', 'beijing', 'legal', 14, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_legal_picture.jpg'),
(14, '2019-09-06 23:56:26', '1996-01-08 09:20:31', 'Bartender', 'beijing', 'education', 7, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_education_picture.jpg'),
(15, '2019-05-20 14:32:21', '2012-05-20 15:08:52', 'Insurance Sales Agent', 'beijing', 'legal', 13, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_legal_picture.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `states`
--

INSERT INTO `states` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'unverified', '2019-12-25 15:19:37', '2019-12-25 15:19:37'),
(2, 'verified', '2019-12-25 15:19:37', '2019-12-25 15:19:37'),
(3, 'paid', '2019-12-25 15:19:37', '2019-12-25 15:19:37'),
(4, 'accepted', '2019-12-25 15:19:37', '2019-12-25 15:19:37'),
(5, 'done', '2019-12-25 15:19:37', '2019-12-25 15:19:37'),
(6, 'unaltered', '2019-12-25 15:19:37', '2019-12-25 15:19:37');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_id` varchar(191) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `stripe_status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stripe_plan` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL,
  `ends_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `surnames` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `program` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `industry` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `study` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `university` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cv` longtext COLLATE utf8mb4_unicode_ci,
  `status_id` bigint(20) UNSIGNED DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stripe_id` varchar(191) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `card_brand` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `card_last_four` varchar(4) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_ends_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `name`, `surnames`, `email`, `phone_number`, `nationality`, `program`, `industry`, `study`, `university`, `type`, `cv`, `status_id`, `email_verified_at`, `password`, `api_token`, `remember_token`, `created_at`, `updated_at`, `stripe_id`, `card_brand`, `card_last_four`, `trial_ends_at`) VALUES
(2, 'Confucio', 'Shandong', 'confucio@confucio.es', '{\"prefix\":\"chn\",\"number\":\"496589588\"}', 'chinese', NULL, NULL, NULL, NULL, 'admin', NULL, NULL, '2019-12-25 15:19:37', '$2y$10$PbgAldbttRQ6izey2gScJOOci/Eqb4sNRBx48sZNoDdOpRp.XcQqG', 'wnJiZLKQy2pDem3dS5fPCQ3xRRusu71CcPJ4aY1ZnsarB3PDXbEKsiIPSpeN', '1ktDFRJuEM', '2019-12-25 15:19:37', '2019-12-25 15:19:37', NULL, NULL, NULL, NULL),
(3, 'Christiansen', 'Mekhi Cartwright', 'alycia88@example.org', '{\"prefix\":\"fra\",\"number\":\"920866760\"}', 'chinese', 'inter_relocat', 'legal', NULL, NULL, 'user', 'cv/K3OgXBBluduzeA7qSHO5hpJxnzOKrhLGQsByREC3.docx', 1, '2019-12-25 15:19:37', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'D6U5TYFUo1RKcLUIzvTHyAikltlcSfy2ugfl8e22inYN6UAdfw3bvJcmnvBj', 'RJjWf72mRH', '2019-12-25 15:19:37', '2019-12-25 15:19:37', NULL, NULL, NULL, NULL),
(4, 'Bashirian', 'Vince Crona V', 'alia80@example.com', '{\"prefix\":\"fra\",\"number\":\"184310354\"}', 'chinese', 'internship', 'hospitality', NULL, NULL, 'user', 'cv/oikWuto3uHziEfp22ANGEbnVVFQZMJ5VY2AIeKZR.docx', 1, '2019-12-25 15:19:37', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'asdSINzqCmDpzy556USsX4V9XYOa32N7zXwXDMzgrNQW52qLhnwbI3y3wRnd', 'bVlDlUGefEljs3ZbUOSpRR5YJnhliHQ70A6f3V0nAfVP5I8xIVBF8QUSDnmx', '2019-12-25 15:19:37', '2019-12-26 16:50:51', 'cus_GQrG6YspEB5Mqz', NULL, NULL, NULL),
(5, 'Hills', 'Mr. Delaney Runte', 'koelpin.holly@example.com', '{\"prefix\":\"fra\",\"number\":\"908772984\"}', 'chinese', 'internship', 'design', NULL, NULL, 'user', 'cv/dpe8SzcrSWc0lnpyD578ccxw1Ytj2tkYWoFiGhef.docx', 1, '2019-12-25 15:19:37', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '3yAQYoRv8bm8vOcrQPbvWgVXqVT4mngoSIeAGb3iGNhGoAM0SEnrCuqWbxvs', 'UR9iBi3hBV', '2019-12-25 15:19:37', '2019-12-25 15:19:37', NULL, NULL, NULL, NULL),
(149, 'Odo', 'Marquard', 'odomarquard@intu.com', '{\"prefix\":\"afg\",\"number\":\"4343434\"}', 'belarusian', 'inter_relocat', '[\"finance\"]', NULL, NULL, 'user', 'cv/WKyMRAOXGl7JP9lyO8uLs7pzq1LkmBGTerZS3uzt.pdf', 1, NULL, '$2y$10$t5EAVy4zSaksHQG85pJi4uOf1eGlaZdxK9E/Kb2.C9iki036knHsW', 'mCraGiUvisBAaJkVZnS9prIZsTPIgwuiGKHu76XITYUjeu5txFuqyPopMaiA', NULL, '2020-01-11 11:40:39', '2020-01-11 11:40:39', NULL, NULL, NULL, NULL),
(150, 'Stifmeister', 'Stifler', 'stifmeiser@ampie.com', '{\"prefix\":\"afg\",\"number\":\"4343425\"}', 'afghan', 'university', NULL, NULL, '[\"other\"]', 'user', 'cv/1cdtrqY4xfWel3O8BZU1Vtd2JHXelAQaDKgj6fDU.pdf', 2, '2020-01-13 17:39:57', '$2y$10$wm5cLUiASKnQEa0oeGXOVu35jYhez1VxUkJX5Q/Mwuct6rFDq7LcC', 'BzffkAPI152kfbOqHVgsRRtiDUSEcPTN0dc42s4F2RMhXhM6SKBEVQMkpPAD', NULL, '2020-01-13 11:19:10', '2020-01-13 17:39:57', NULL, NULL, NULL, NULL),
(151, 'Odo', 'Marquard', 'odomarquard@kj.com', '{\"prefix\":\"afg\",\"number\":\"434343\"}', 'afghan', 'inter_relocat', '[\"education\"]', NULL, NULL, 'user', 'cv/dix7RsWQJIO1pvafWo8pYuvrEIkVtkkedQ7MtiPp.pdf', 2, '2020-01-13 18:03:05', '$2y$10$attslHBKdPw1H5WpJO2za.zVU9OYJSFBmrzp2/QCqpSJhaktlhpq.', '7oEvx9inAi9G0ZMktiW2UVOrXf6RaCRjh1sG8K5eEhjhvw3Z9fAZWTwqCxxH', NULL, '2020-01-13 18:00:31', '2020-01-13 18:03:05', NULL, NULL, NULL, NULL),
(152, 'Slavoj', 'Zizek', 'slavojzizek@gmai.ce', '{\"prefix\":\"afg\",\"number\":\"664664\"}', 'afghan', 'study', NULL, '[\"in-person\"]', NULL, 'user', NULL, 2, NULL, '$2y$10$l6r9m4hg/2MJsgFwzybMxOqKUfjPH83dgV6mA3cIwAR4Fl6kMo9/W', 'z3DtSywIBi6vvoG2ZV6ywWrSDhcfwxbogKV5HfWVPGRiPN0gpCMZ8uwywlre', NULL, '2020-01-13 18:06:01', '2020-01-13 18:06:01', NULL, NULL, NULL, NULL),
(153, 'Peter', 'Sloterdijk', 'petersloterdijk@philosopher.de', '{\"prefix\":\"afg\",\"number\":\"6656\"}', 'andorran', 'inter_relocat', '[\"education\"]', NULL, NULL, 'user', 'cv/LGc10ZQwnndKj8ADM7Mfjqt4U8BUd6aUlC5u9dL8.pdf', 2, NULL, '$2y$10$EXtJUlorXYaicuolyKBqEO2dkySlEG3UstKqCZRGuo.fiGQaR2HWm', 'v07h3ORBUnkBV0vuNAOasWFURhZ5yw5rubcKSbMNwYLAlRfdJgCGxPSlNncm', NULL, '2020-01-14 08:15:26', '2020-01-14 09:06:51', 'cus_GXr4oXQNGyc5QO', NULL, NULL, NULL),
(154, 'cacalavaca', 'cacalavaca', 'recmanvideos@gmail.com', '{\"prefix\":\"afg\",\"number\":\"43434344\"}', 'batswana', 'inter_relocat', '[\"education\"]', NULL, NULL, 'user', 'cv/hVg9FpawAnB3VOQz1BYlJrRrBuOcoHIdTdutyFpy.pdf', 1, NULL, '$2y$10$mcsbgHk3v.KtKhfPeRVXc.oHsR5MMF.1INJer8O7Btd6uHPK0sQ42', 'KxpIk4XVu6fdhwFWZxuGPE0PUKiVVjj2gaI4EKQINEMqMEkLjk49GkCP8fae', NULL, '2020-01-14 09:22:00', '2020-01-14 09:22:00', NULL, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indices de la tabla `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subscriptions_user_id_stripe_status_index` (`user_id`,`stripe_status`);

--
-- Indices de la tabla `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_api_token_unique` (`api_token`),
  ADD KEY `users_status_id_foreign` (`status_id`),
  ADD KEY `users_stripe_id_index` (`stripe_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `states` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
