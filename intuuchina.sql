-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 25-01-2020 a las 23:27:57
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
(1, '2019-04-26 04:20:55', '1994-06-28 15:55:35', 'Claims Adjuster', 'honk-kong', 'education', 19, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_education_picture.jpg'),
(2, '2019-05-26 04:31:48', '2019-09-21 02:19:48', 'Agricultural Crop Worker', 'honk-kong', 'hospitality', 24, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_hospitality_picture.jpg'),
(3, '2019-05-08 07:24:09', '1980-12-26 04:26:19', 'Dot Etcher', 'honk-kong', 'it', 16, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_it_picture.jpg'),
(4, '2019-10-24 10:27:49', '1987-01-13 16:07:14', 'Mathematical Technician', 'shenzhen', 'consultant', 3, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_consultant_picture.jpg'),
(5, '2019-06-12 21:42:46', '1996-03-12 02:37:57', 'City', 'shenzhen', 'finance', 22, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_finance_picture.jpg'),
(6, '2019-06-12 21:42:46', '1996-03-12 02:37:57', 'City', 'shenzhen', 'finance', 22, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_finance_picture.jpg'),
(7, '2019-06-12 21:42:46', '1996-03-12 02:37:57', 'City', 'shenzhen', 'finance', 22, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_finance_picture.jpg'),
(8, '2019-06-12 21:42:46', '1996-03-12 02:37:57', 'City', 'shenzhen', 'finance', 22, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_finance_picture.jpg'),
(9, '2019-06-12 21:42:46', '1996-03-12 02:37:57', 'City', 'shenzhen', 'finance', 22, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_finance_picture.jpg'),
(10, '2019-06-12 21:42:46', '1996-03-12 02:37:57', 'City', 'shenzhen', 'finance', 22, '{\"ops\":[{\"insert\":\"Established in 2007, this international preschool centre provides a wide variety of activities for pre-kindergarten children. Toddler Time programs for kids aged between 18 months to 4 years encourage the learning of fundamental academic and life concepts in fun and creative ways. Full-day and half-day courses are offered from Mondays to Fridays. The children in the school are from a wide variety of countries, including China.\"},{\"attributes\":{\"align\":\"justify\"},\"insert\":\"\\n\"},{\"insert\":\"Our school team consists of both local Chinese as well as expatriates from America, UK, Philippines and Singapore.\\nA teacher aide will work alongside the lead English and Chinese teachers in our classes. He or she will support the teachers and enable them to focus more fully on academics and management of the students. The aide will interact daily with students, giving them additional attention and instruction. He or she will help in implementing the daily teaching schedules and also assist in maintaining the materials and teaching resources necessary for each classroom. \\n\\n\"},{\"attributes\":{\"underline\":true},\"insert\":\"Preferred Skills\"},{\"attributes\":{\"header\":4},\"insert\":\"\\n\"},{\"insert\":\"English fluency is essential.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Young, sociable and energetic.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Degree holder preferred.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"Work Hours: Mondays to Thursdays, 8.45am to 5pm. Fridays, 8.45am to 12.15pm.\"},{\"attributes\":{\"list\":\"bullet\"},\"insert\":\"\\n\"},{\"insert\":\"\\n\"}]}', 'generic_finance_picture.jpg');

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
(1, 'unverified', '2020-01-21 20:34:26', '2020-01-21 20:34:26'),
(2, 'verified', '2020-01-21 20:34:26', '2020-01-21 20:34:26'),
(3, 'paid', '2020-01-21 20:34:26', '2020-01-21 20:34:26'),
(4, 'accepted', '2020-01-21 20:34:26', '2020-01-21 20:34:26'),
(5, 'done', '2020-01-21 20:34:26', '2020-01-21 20:34:26'),
(6, 'unaltered', '2020-01-21 20:34:26', '2020-01-21 20:34:26');

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
  `id` bigint(20) UNSIGNED NOT NULL,
  `quotes` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `occupation` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `testimonials`
--

INSERT INTO `testimonials` (`id`, `quotes`, `occupation`, `company`, `created_at`, `updated_at`, `user_id`) VALUES
(1, '{\"es\":\"\",\"en\":\"Inntuchina was my go-to partner for everything China related\"}', 'Junior Analyst', NULL, '2020-01-21 20:34:26', '2020-01-21 20:34:26', 8),
(2, '{\"es\":\"\",\"en\":\"They are a very focused and intelligent people who develop a very successful company\"}', 'BD Executive', 'SIP Project Management', '2020-01-21 20:34:26', '2020-01-21 20:34:26', 9),
(3, '{\"es\":\"\",\"en\":\"IntuuChina is a great one-stop shop that really makes your life easier\"}', 'Digital Analyst', NULL, '2020-01-21 20:34:26', '2020-01-21 20:34:26', 10);

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
  `avatar` longtext COLLATE utf8mb4_unicode_ci,
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

INSERT INTO `users` (`id`, `name`, `surnames`, `email`, `phone_number`, `nationality`, `program`, `industry`, `study`, `university`, `type`, `cv`, `avatar`, `status_id`, `email_verified_at`, `password`, `api_token`, `remember_token`, `created_at`, `updated_at`, `stripe_id`, `card_brand`, `card_last_four`, `trial_ends_at`) VALUES
(4, 'Confucio', 'Shandong', 'confucio@confucio.es', '{\"prefix\":\"chn\",\"number\":\"550442769\"}', 'chinese', NULL, NULL, NULL, NULL, 'admin', NULL, NULL, NULL, '2020-01-21 20:34:26', '$2y$10$LYE2zzlai8bWPHtUtqSfuem7POCAO/Gpxvf9LbwLcuLY9Zftv9.Ja', 'fBCMYGLiKMXouLHAr0pFMECdJGIekBTvjxLiKvKXo4Wf5tZ5LmwtyBSgaqkC', 'fQm59kFL8e', '2020-01-21 20:34:26', '2020-01-21 20:34:26', NULL, NULL, NULL, NULL),
(5, 'Grimes', 'Orlando Nikolaus', 'khilpert@example.org', '{\"prefix\":\"fra\",\"number\":\"648667782\"}', 'chinese', 'internship', '[\"education\"]', NULL, NULL, 'user', 'cv/tk1qLR1woXIBdyUW9TygM6sLR6RgWTtixlcnJQ2s.docx', NULL, 1, '2020-01-21 20:34:26', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'CA9qCC31ssKbobHBFIRwphqIM1EeT364T2RchD5YxzrIByZsKKHqX56vUa75', 'TMXPyLZu8H', '2020-01-21 20:34:26', '2020-01-21 20:34:26', NULL, NULL, NULL, NULL),
(6, 'Luettgen', 'Camylle Bradtke', 'lreinger@example.net', '{\"prefix\":\"fra\",\"number\":\"470167857\"}', 'chinese', 'internship', '[\"other_industries\"]', NULL, NULL, 'user', 'cv/YX1Tqw2e7IIHiizk7oeMRkc9DEloKOL3xVklfnl4.docx', NULL, 1, '2020-01-21 20:34:26', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'tg9DgTqJMDfbpsEbIFhllFJcdGqRT2B0RU0bxdOaL7NM87JU24XulOOogpBr', 'LcUkvpcitd', '2020-01-21 20:34:26', '2020-01-21 20:34:26', NULL, NULL, NULL, NULL),
(7, 'Schmitt', 'Fleta Stokes', 'smitham.anna@example.com', '{\"prefix\":\"fra\",\"number\":\"684560741\"}', 'chinese', 'inter_relocat', '[\"design\"]', NULL, NULL, 'user', 'cv/JQZ80sQuUAq9Xoou6Du2LcgDSjBVZ1lhhdf6wLVr.docx', NULL, 1, '2020-01-21 20:34:26', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2opcGdS5Y9CWRgN6vwCOvFvvNh7Owy6BLr4QwOE0VHabvhbMsRgWZwZAyYfy', 'Rq2bEqYbgk', '2020-01-21 20:34:26', '2020-01-21 20:34:26', NULL, NULL, NULL, NULL),
(8, 'Santiago', 'Barba Bullón de Mendoza', 'zlehner@example.com', '{\"prefix\":\"fra\",\"number\":\"088357714\"}', 'chinese', 'inter_relocat', '[\"it\"]', NULL, NULL, 'user', 'cv/EJXaewzAp1DMRKlyJsPBQsgbacVQxZHfIi0hO5UU.docx', 'public/profiles/8/kp4vB9yERjejgSNwmgZPpk4BkVzpzlsKyQPTGWkN.jpeg', 1, '2020-01-21 20:34:26', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'l4ut3oqnZmk4mvdBEk3WSPvWVuFtBuFfGpVStWNvRPYRWBDd4ZhXNy1nmU1h', 'PaoIoNRxyV', '2020-01-21 20:34:26', '2020-01-21 20:34:26', NULL, NULL, NULL, NULL),
(9, 'Maria Alejandra', 'Sanabria Aguilar', 'mosciski.ahmed@example.org', '{\"prefix\":\"fra\",\"number\":\"785711148\"}', 'chinese', 'internship', '[\"it\"]', NULL, NULL, 'user', 'cv/QxorwbFUwIY4PFwbTvEQ5TieLsLQNHb2BGkiusSK.docx', 'public/profiles/9/BxUQZZ4UDI9rTYf6uBZDwrsrQ3slbYeHaceVFaGq.jpeg', 1, '2020-01-21 20:34:26', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '7Ckqj41IyawSuIjCCQVJvwihnrOByEPJdqOaDHI5gYbGInUszWI8LAaq2eui', 'S2YN8c2i9L', '2020-01-21 20:34:26', '2020-01-21 20:34:26', NULL, NULL, NULL, NULL),
(10, 'Mario', 'Juárez Camacho', 'auer.maureen@example.net', '{\"prefix\":\"fra\",\"number\":\"342208622\"}', 'chinese', 'internship', '[\"consultant\"]', NULL, NULL, 'user', 'cv/rTeKJMwh3O5ivemRBt8Iz6RHmPh104Ce67BzSZ0S.docx', 'public/profiles/10/Ufo9f8z7FCrGOutMczpl53BGkldUdCAnLceelHtY.jpeg', 1, '2020-01-21 20:34:26', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'xw1GH0gXDRi7cEq3STivtdv5htXdy4U5qxjbkSnCkbsMYx0KNIqy8qXW9icE', '7If3QodsPU', '2020-01-21 20:34:26', '2020-01-21 20:34:26', NULL, NULL, NULL, NULL);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `testimonials_user_id_foreign` (`user_id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `testimonials`
--
ALTER TABLE `testimonials`
  ADD CONSTRAINT `testimonials_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_status_id_foreign` FOREIGN KEY (`status_id`) REFERENCES `states` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
