-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 01 mars 2022 à 14:45
-- Version du serveur : 5.7.24
-- Version de PHP : 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `milo.laravel`
--

-- --------------------------------------------------------

--
-- Structure de la table `associate_user`
--

CREATE TABLE `associate_user` (
  `creator_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `associate_user`
--

INSERT INTO `associate_user` (`creator_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 29, NULL, NULL),
(1, 30, NULL, NULL),
(1, 31, NULL, NULL),
(1, 32, NULL, NULL),
(1, 33, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `championships`
--

CREATE TABLE `championships` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `image_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `championships`
--

INSERT INTO `championships` (`id`, `title`, `user_id`, `image_id`, `created_at`, `updated_at`) VALUES
(45, 'Championnat de milo', 1, NULL, '2022-03-01 12:28:37', '2022-03-01 12:28:37');

-- --------------------------------------------------------

--
-- Structure de la table `championship_user`
--

CREATE TABLE `championship_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `championship_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `championship_user`
--

INSERT INTO `championship_user` (`user_id`, `championship_id`, `created_at`, `updated_at`) VALUES
(1, 45, NULL, NULL),
(29, 45, NULL, NULL),
(30, 45, NULL, NULL),
(31, 45, NULL, NULL),
(32, 45, NULL, NULL),
(33, 45, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `decks`
--

CREATE TABLE `decks` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `image_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `decks`
--

INSERT INTO `decks` (`id`, `title`, `user_id`, `image_id`, `created_at`, `updated_at`) VALUES
(22, 'Milo deck', 1, NULL, NULL, NULL),
(23, 'Porthos deck', 29, NULL, NULL, NULL),
(24, 'Helias deck', 30, NULL, NULL, NULL),
(25, 'Buzz Deck', 31, NULL, NULL, NULL),
(26, 'Fab Deck', 32, NULL, NULL, NULL),
(27, 'Flo deck', 33, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

CREATE TABLE `images` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `kills`
--

CREATE TABLE `kills` (
  `result_id` int(10) UNSIGNED NOT NULL,
  `user_killed_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `kills`
--

INSERT INTO `kills` (`result_id`, `user_killed_id`, `created_at`, `updated_at`) VALUES
(36, 33, '2022-03-01 12:31:48', '2022-03-01 12:31:48'),
(40, 33, '2022-03-01 12:33:38', '2022-03-01 12:33:38'),
(40, 32, '2022-03-01 12:33:43', '2022-03-01 12:33:43'),
(40, 31, '2022-03-01 12:33:47', '2022-03-01 12:33:47'),
(43, 1, '2022-03-01 12:34:05', '2022-03-01 12:34:05'),
(43, 29, '2022-03-01 12:34:09', '2022-03-01 12:34:09'),
(46, 29, '2022-03-01 12:35:16', '2022-03-01 12:35:16'),
(47, 30, '2022-03-01 12:35:31', '2022-03-01 12:35:31'),
(47, 31, '2022-03-01 12:35:34', '2022-03-01 12:35:34'),
(49, 31, '2022-03-01 12:37:08', '2022-03-01 12:37:08'),
(49, 30, '2022-03-01 12:37:12', '2022-03-01 12:37:12'),
(49, 33, '2022-03-01 12:37:16', '2022-03-01 12:37:16'),
(52, 1, '2022-03-01 12:37:30', '2022-03-01 12:37:30'),
(54, 31, '2022-03-01 12:38:51', '2022-03-01 12:38:51'),
(55, 1, '2022-03-01 12:38:58', '2022-03-01 12:38:58'),
(58, 30, '2022-03-01 12:39:06', '2022-03-01 12:39:06'),
(63, 30, '2022-03-01 12:40:06', '2022-03-01 12:40:06'),
(59, 1, '2022-03-01 12:40:15', '2022-03-01 12:40:15'),
(70, 1, '2022-03-01 12:43:04', '2022-03-01 12:43:04'),
(71, 29, '2022-03-01 12:43:14', '2022-03-01 12:43:14'),
(71, 33, '2022-03-01 12:43:19', '2022-03-01 12:43:19'),
(75, 31, '2022-03-01 12:43:28', '2022-03-01 12:43:28'),
(75, 32, '2022-03-01 12:43:39', '2022-03-01 12:43:39'),
(81, 30, '2022-03-01 12:46:06', '2022-03-01 12:46:06'),
(81, 1, '2022-03-01 12:46:10', '2022-03-01 12:46:10'),
(78, 33, '2022-03-01 12:46:22', '2022-03-01 12:46:22'),
(77, 31, '2022-03-01 12:46:31', '2022-03-01 12:46:31'),
(77, 29, '2022-03-01 12:46:39', '2022-03-01 12:46:39'),
(77, 32, '2022-03-01 12:46:45', '2022-03-01 12:46:45'),
(83, 32, '2022-03-01 13:06:20', '2022-03-01 13:06:20'),
(83, 29, '2022-03-01 13:06:24', '2022-03-01 13:06:24'),
(82, 1, '2022-03-01 13:06:30', '2022-03-01 13:06:30'),
(82, 33, '2022-03-01 13:06:35', '2022-03-01 13:06:35'),
(82, 31, '2022-03-01 13:06:41', '2022-03-01 13:06:41'),
(88, 30, '2022-03-01 13:08:10', '2022-03-01 13:08:10'),
(88, 1, '2022-03-01 13:08:15', '2022-03-01 13:08:15'),
(88, 31, '2022-03-01 13:08:19', '2022-03-01 13:08:19'),
(92, 30, '2022-03-01 13:09:26', '2022-03-01 13:09:26'),
(92, 1, '2022-03-01 13:09:29', '2022-03-01 13:09:29'),
(100, 30, '2022-03-01 13:10:37', '2022-03-01 13:10:37'),
(100, 1, '2022-03-01 13:10:41', '2022-03-01 13:10:41'),
(99, 29, '2022-03-01 13:10:55', '2022-03-01 13:10:55'),
(103, 1, '2022-03-01 13:12:13', '2022-03-01 13:12:13'),
(103, 31, '2022-03-01 13:12:16', '2022-03-01 13:12:16'),
(106, 30, '2022-03-01 13:12:57', '2022-03-01 13:12:57'),
(106, 31, '2022-03-01 13:13:00', '2022-03-01 13:13:00'),
(107, 1, '2022-03-01 13:13:09', '2022-03-01 13:13:09'),
(110, 32, '2022-03-01 13:14:41', '2022-03-01 13:14:41'),
(111, 1, '2022-03-01 13:14:49', '2022-03-01 13:14:49'),
(113, 30, '2022-03-01 13:15:04', '2022-03-01 13:15:04'),
(119, 1, '2022-03-01 13:16:11', '2022-03-01 13:16:11'),
(114, 30, '2022-03-01 13:16:20', '2022-03-01 13:16:20'),
(120, 30, '2022-03-01 13:17:17', '2022-03-01 13:17:17'),
(120, 1, '2022-03-01 13:17:21', '2022-03-01 13:17:21'),
(123, 33, '2022-03-01 13:17:29', '2022-03-01 13:17:29'),
(126, 1, '2022-03-01 13:18:15', '2022-03-01 13:18:15'),
(126, 32, '2022-03-01 13:18:20', '2022-03-01 13:18:20'),
(126, 33, '2022-03-01 13:18:25', '2022-03-01 13:18:25'),
(130, 1, '2022-03-01 13:21:00', '2022-03-01 13:21:00'),
(131, 33, '2022-03-01 13:21:10', '2022-03-01 13:21:10'),
(131, 29, '2022-03-01 13:21:13', '2022-03-01 13:21:13'),
(134, 31, '2022-03-01 13:22:40', '2022-03-01 13:22:40'),
(134, 33, '2022-03-01 13:22:45', '2022-03-01 13:22:45'),
(134, 1, '2022-03-01 13:22:50', '2022-03-01 13:22:50'),
(135, 29, '2022-03-01 13:22:58', '2022-03-01 13:22:58'),
(143, 30, '2022-03-01 13:23:49', '2022-03-01 13:23:49'),
(143, 29, '2022-03-01 13:23:54', '2022-03-01 13:23:54'),
(139, 31, '2022-03-01 13:24:01', '2022-03-01 13:24:01'),
(139, 1, '2022-03-01 13:24:05', '2022-03-01 13:24:05'),
(146, 30, '2022-03-01 13:24:46', '2022-03-01 13:24:46'),
(144, 1, '2022-03-01 13:24:53', '2022-03-01 13:24:53'),
(144, 33, '2022-03-01 13:24:59', '2022-03-01 13:24:59'),
(150, 29, '2022-03-01 13:30:14', '2022-03-01 13:30:14'),
(150, 30, '2022-03-01 13:30:18', '2022-03-01 13:30:18'),
(150, 31, '2022-03-01 13:30:22', '2022-03-01 13:30:22'),
(152, 31, '2022-03-01 13:31:13', '2022-03-01 13:31:13'),
(153, 1, '2022-03-01 13:31:18', '2022-03-01 13:31:18'),
(155, 30, '2022-03-01 13:31:23', '2022-03-01 13:31:23'),
(156, 1, '2022-03-01 13:32:59', '2022-03-01 13:32:59'),
(162, 29, '2022-03-01 13:33:43', '2022-03-01 13:33:43'),
(162, 30, '2022-03-01 13:33:47', '2022-03-01 13:33:47'),
(162, 31, '2022-03-01 13:33:51', '2022-03-01 13:33:51'),
(164, 1, '2022-03-01 13:36:09', '2022-03-01 13:36:09'),
(164, 31, '2022-03-01 13:36:12', '2022-03-01 13:36:12'),
(166, 33, '2022-03-01 13:36:25', '2022-03-01 13:36:25'),
(171, 29, '2022-03-01 13:37:14', '2022-03-01 13:37:14'),
(168, 31, '2022-03-01 13:37:21', '2022-03-01 13:37:21'),
(173, 33, '2022-03-01 13:38:11', '2022-03-01 13:38:11'),
(174, 29, '2022-03-01 13:38:18', '2022-03-01 13:38:18'),
(174, 1, '2022-03-01 13:38:22', '2022-03-01 13:38:22'),
(177, 1, '2022-03-01 13:39:31', '2022-03-01 13:39:31'),
(183, 1, '2022-03-01 13:40:46', '2022-03-01 13:40:46'),
(180, 30, '2022-03-01 13:40:54', '2022-03-01 13:40:54'),
(180, 33, '2022-03-01 13:40:58', '2022-03-01 13:40:58'),
(185, 33, '2022-03-01 13:41:52', '2022-03-01 13:41:52');

-- --------------------------------------------------------

--
-- Structure de la table `matchs`
--

CREATE TABLE `matchs` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `championship_id` int(10) UNSIGNED NOT NULL,
  `image_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `matchs`
--

INSERT INTO `matchs` (`id`, `title`, `championship_id`, `image_id`, `created_at`, `updated_at`) VALUES
(13, '21/04/21 match 1', 45, NULL, '2022-03-01 12:29:23', '2022-03-01 12:29:23'),
(14, '21/04/21 match 2', 45, NULL, '2022-03-01 12:29:37', '2022-03-01 12:29:37'),
(15, '25/04/21 match 1', 45, NULL, '2022-03-01 12:29:51', '2022-03-01 12:29:51'),
(16, '25/04/21 match 2', 45, NULL, '2022-03-01 12:30:03', '2022-03-01 12:30:03'),
(17, '25/04/21 match 3', 45, NULL, '2022-03-01 12:30:12', '2022-03-01 12:30:12'),
(18, '25/04/21 match 4', 45, NULL, '2022-03-01 12:30:20', '2022-03-01 12:30:20'),
(19, '02/05/2021 match 1', 45, NULL, '2022-03-01 12:30:42', '2022-03-01 12:30:42'),
(20, '02/05/2021 match 2', 45, NULL, '2022-03-01 12:41:59', '2022-03-01 12:41:59'),
(21, '02/05/2021 match 3', 45, NULL, '2022-03-01 12:44:47', '2022-03-01 12:44:47'),
(22, '02/05/2021 match 4', 45, NULL, '2022-03-01 13:05:19', '2022-03-01 13:05:19'),
(23, '23/05/2021 match 1', 45, NULL, '2022-03-01 13:07:05', '2022-03-01 13:07:05'),
(24, '23/05/2021 match 2', 45, NULL, '2022-03-01 13:07:15', '2022-03-01 13:07:15'),
(25, '23/05/2021 match 3', 45, NULL, '2022-03-01 13:07:20', '2022-03-01 13:07:20'),
(26, '30/05/2021 match 1', 45, NULL, '2022-03-01 13:11:17', '2022-03-01 13:11:17'),
(27, '30/05/2021 match 2', 45, NULL, '2022-03-01 13:11:23', '2022-03-01 13:11:23'),
(28, '20/06/2021 match 1', 45, NULL, '2022-03-01 13:13:42', '2022-03-01 13:13:42'),
(29, '20/06/2021 match 2', 45, NULL, '2022-03-01 13:13:47', '2022-03-01 13:13:47'),
(30, '20/06/2021 match 3', 45, NULL, '2022-03-01 13:13:55', '2022-03-01 13:13:55'),
(31, '20/06/2021 match 4', 45, NULL, '2022-03-01 13:14:02', '2022-03-01 13:14:02'),
(32, '04/07/2021 match 1', 45, NULL, '2022-03-01 13:19:48', '2022-03-01 13:19:48'),
(33, '04/07/2021 match 2', 45, NULL, '2022-03-01 13:19:52', '2022-03-01 13:19:52'),
(34, '04/07/2021 match 3', 45, NULL, '2022-03-01 13:19:58', '2022-03-01 13:19:58'),
(35, '04/07/2021 match 4', 45, NULL, '2022-03-01 13:20:04', '2022-03-01 13:20:04'),
(36, '18/07/2021 match 1', 45, NULL, '2022-03-01 13:25:40', '2022-03-01 13:25:40'),
(37, '18/07/2021 match 2', 45, NULL, '2022-03-01 13:25:44', '2022-03-01 13:25:44'),
(38, '18/07/2021 match 3', 45, NULL, '2022-03-01 13:25:50', '2022-03-01 13:25:50'),
(39, '18/07/2021 match 4', 45, NULL, '2022-03-01 13:25:55', '2022-03-01 13:25:55'),
(40, '25/07/2021 match 1', 45, NULL, '2022-03-01 13:34:21', '2022-03-01 13:34:21'),
(41, '25/07/2021 match 2', 45, NULL, '2022-03-01 13:34:32', '2022-03-01 13:34:32'),
(42, '25/07/2021 match 3', 45, NULL, '2022-03-01 13:34:35', '2022-03-01 13:34:45'),
(43, '28/11/2021 match 1', 45, NULL, '2022-03-01 13:35:07', '2022-03-01 13:35:07'),
(44, '28/11/2021 match 2', 45, NULL, '2022-03-01 13:35:11', '2022-03-01 13:35:11'),
(45, '28/11/2021 match 3', 45, NULL, '2022-03-01 13:35:18', '2022-03-01 13:35:18');

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(94, '2022_02_14_124250_create_user_in_championship_table', 1),
(110, '2013_02_14_124000_create_images_table', 2),
(111, '2014_10_12_000000_create_users_table', 2),
(112, '2014_10_12_100000_create_password_resets_table', 2),
(113, '2019_08_19_000000_create_failed_jobs_table', 2),
(114, '2019_12_14_000001_create_personal_access_tokens_table', 2),
(115, '2022_02_14_123832_create_decks_table', 2),
(116, '2022_02_14_124248_create_championships_table', 2),
(117, '2022_02_14_124249_create_matchs_table', 2),
(119, '2022_02_14_124303_create_results_table', 2),
(120, '2022_02_14_124343_create_kills_table', 2),
(121, '2022_02_16_133757_create_associate_user_table', 2),
(123, '2022_02_14_124250_championship_user_table', 3);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `results`
--

CREATE TABLE `results` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `deck_id` int(10) UNSIGNED NOT NULL,
  `match_id` int(10) UNSIGNED NOT NULL,
  `place` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `results`
--

INSERT INTO `results` (`id`, `user_id`, `deck_id`, `match_id`, `place`, `score`, `created_at`, `updated_at`) VALUES
(34, 29, 23, 13, 2, 5, '2022-03-01 12:31:05', '2022-03-01 12:31:05'),
(35, 1, 22, 13, 1, 7, '2022-03-01 12:31:11', '2022-03-01 12:31:11'),
(36, 31, 25, 13, 3, 4, '2022-03-01 12:31:21', '2022-03-01 12:31:48'),
(37, 32, 26, 13, 4, 2, '2022-03-01 12:31:32', '2022-03-01 12:31:32'),
(38, 33, 27, 13, 5, 1, '2022-03-01 12:31:40', '2022-03-01 12:31:40'),
(39, 29, 23, 14, 4, 2, '2022-03-01 12:32:19', '2022-03-01 12:32:19'),
(40, 30, 24, 14, 1, 10, '2022-03-01 12:32:25', '2022-03-01 12:33:47'),
(41, 1, 22, 14, 5, 1, '2022-03-01 12:32:35', '2022-03-01 12:32:35'),
(42, 31, 25, 14, 6, 0, '2022-03-01 12:32:41', '2022-03-01 12:32:41'),
(43, 32, 26, 14, 2, 7, '2022-03-01 12:32:50', '2022-03-01 12:34:09'),
(44, 33, 27, 14, 3, 3, '2022-03-01 12:32:58', '2022-03-01 12:33:10'),
(45, 29, 23, 15, 3, 3, '2022-03-01 12:34:39', '2022-03-01 12:34:39'),
(46, 30, 24, 15, 2, 6, '2022-03-01 12:34:47', '2022-03-01 12:35:16'),
(47, 1, 22, 15, 1, 9, '2022-03-01 12:34:54', '2022-03-01 12:35:34'),
(48, 31, 25, 15, 4, 2, '2022-03-01 12:35:00', '2022-03-01 12:35:00'),
(49, 29, 23, 16, 1, 10, '2022-03-01 12:36:25', '2022-03-01 12:37:16'),
(50, 30, 24, 16, 3, 3, '2022-03-01 12:36:33', '2022-03-01 12:36:33'),
(51, 1, 22, 16, 5, 1, '2022-03-01 12:36:41', '2022-03-01 12:36:41'),
(52, 31, 25, 16, 4, 3, '2022-03-01 12:36:49', '2022-03-01 12:37:30'),
(53, 33, 27, 16, 2, 5, '2022-03-01 12:36:57', '2022-03-01 12:36:57'),
(54, 29, 23, 17, 2, 6, '2022-03-01 12:38:08', '2022-03-01 12:38:51'),
(55, 30, 24, 17, 4, 3, '2022-03-01 12:38:17', '2022-03-01 12:38:58'),
(56, 1, 22, 17, 5, 1, '2022-03-01 12:38:25', '2022-03-01 12:38:25'),
(57, 31, 25, 17, 3, 3, '2022-03-01 12:38:32', '2022-03-01 12:38:32'),
(58, 33, 27, 17, 1, 8, '2022-03-01 12:38:43', '2022-03-01 12:39:06'),
(59, 29, 23, 18, 1, 8, '2022-03-01 12:39:28', '2022-03-01 12:40:15'),
(60, 30, 24, 18, 5, 1, '2022-03-01 12:39:33', '2022-03-01 12:39:33'),
(61, 1, 22, 18, 4, 2, '2022-03-01 12:39:41', '2022-03-01 12:39:41'),
(62, 31, 25, 18, 3, 3, '2022-03-01 12:39:49', '2022-03-01 12:39:49'),
(63, 33, 27, 18, 2, 6, '2022-03-01 12:39:57', '2022-03-01 12:40:06'),
(64, 29, 23, 19, 5, 1, '2022-03-01 12:40:49', '2022-03-01 12:40:49'),
(65, 30, 24, 19, 4, 2, '2022-03-01 12:40:55', '2022-03-01 12:40:55'),
(66, 1, 22, 19, 1, 7, '2022-03-01 12:41:01', '2022-03-01 12:41:01'),
(67, 31, 25, 19, 3, 3, '2022-03-01 12:41:08', '2022-03-01 12:41:08'),
(68, 32, 26, 19, 2, 5, '2022-03-01 12:41:16', '2022-03-01 12:41:16'),
(69, 33, 27, 19, 6, 0, '2022-03-01 12:41:22', '2022-03-01 12:41:22'),
(70, 29, 23, 20, 2, 6, '2022-03-01 12:42:09', '2022-03-01 12:43:04'),
(71, 30, 24, 20, 1, 9, '2022-03-01 12:42:15', '2022-03-01 12:43:19'),
(72, 1, 22, 20, 6, 0, '2022-03-01 12:42:22', '2022-03-01 12:42:22'),
(73, 31, 25, 20, 5, 1, '2022-03-01 12:42:31', '2022-03-01 12:42:31'),
(74, 32, 26, 20, 4, 2, '2022-03-01 12:42:52', '2022-03-01 12:42:52'),
(75, 33, 27, 20, 3, 5, '2022-03-01 12:42:58', '2022-03-01 12:43:39'),
(76, 29, 23, 21, 6, 0, '2022-03-01 12:45:02', '2022-03-01 12:45:02'),
(77, 30, 24, 21, 2, 8, '2022-03-01 12:45:17', '2022-03-01 12:46:45'),
(78, 1, 22, 21, 3, 4, '2022-03-01 12:45:27', '2022-03-01 12:46:22'),
(79, 31, 25, 21, 5, 1, '2022-03-01 12:45:40', '2022-03-01 12:45:40'),
(80, 32, 26, 21, 4, 2, '2022-03-01 12:45:52', '2022-03-01 12:45:52'),
(81, 33, 27, 21, 1, 9, '2022-03-01 12:45:56', '2022-03-01 12:46:10'),
(82, 29, 23, 22, 2, 8, '2022-03-01 13:05:31', '2022-03-01 13:06:41'),
(83, 30, 24, 22, 1, 9, '2022-03-01 13:05:38', '2022-03-01 13:06:24'),
(84, 1, 22, 22, 6, 0, '2022-03-01 13:05:46', '2022-03-01 13:05:46'),
(85, 31, 25, 22, 4, 2, '2022-03-01 13:05:54', '2022-03-01 13:05:54'),
(86, 32, 26, 22, 3, 3, '2022-03-01 13:06:00', '2022-03-01 13:06:00'),
(87, 33, 27, 22, 5, 1, '2022-03-01 13:06:07', '2022-03-01 13:06:07'),
(88, 29, 23, 23, 1, 10, '2022-03-01 13:07:37', '2022-03-01 13:08:19'),
(89, 30, 24, 23, 4, 2, '2022-03-01 13:07:48', '2022-03-01 13:07:48'),
(90, 1, 22, 23, 3, 3, '2022-03-01 13:07:54', '2022-03-01 13:07:54'),
(91, 31, 25, 23, 2, 5, '2022-03-01 13:08:03', '2022-03-01 13:08:03'),
(92, 29, 23, 24, 1, 9, '2022-03-01 13:08:49', '2022-03-01 13:09:29'),
(93, 30, 24, 24, 5, 1, '2022-03-01 13:08:56', '2022-03-01 13:08:56'),
(94, 1, 22, 24, 4, 2, '2022-03-01 13:09:02', '2022-03-01 13:09:02'),
(95, 31, 25, 24, 2, 5, '2022-03-01 13:09:09', '2022-03-01 13:09:09'),
(96, 33, 27, 24, 3, 3, '2022-03-01 13:09:15', '2022-03-01 13:09:15'),
(97, 29, 23, 25, 4, 2, '2022-03-01 13:10:00', '2022-03-01 13:10:00'),
(98, 30, 24, 25, 5, 1, '2022-03-01 13:10:08', '2022-03-01 13:10:08'),
(99, 1, 22, 25, 3, 4, '2022-03-01 13:10:14', '2022-03-01 13:10:55'),
(100, 31, 25, 25, 2, 7, '2022-03-01 13:10:19', '2022-03-01 13:10:41'),
(101, 33, 27, 25, 1, 7, '2022-03-01 13:10:29', '2022-03-01 13:10:29'),
(102, 29, 23, 26, 1, 7, '2022-03-01 13:11:40', '2022-03-01 13:11:40'),
(103, 30, 24, 26, 2, 7, '2022-03-01 13:11:47', '2022-03-01 13:12:16'),
(104, 1, 22, 26, 4, 2, '2022-03-01 13:11:55', '2022-03-01 13:11:55'),
(105, 31, 25, 26, 3, 3, '2022-03-01 13:12:02', '2022-03-01 13:12:02'),
(106, 29, 23, 27, 1, 9, '2022-03-01 13:12:29', '2022-03-01 13:13:00'),
(107, 30, 24, 27, 2, 6, '2022-03-01 13:12:38', '2022-03-01 13:13:09'),
(108, 1, 22, 27, 4, 2, '2022-03-01 13:12:42', '2022-03-01 13:12:42'),
(109, 31, 25, 27, 3, 3, '2022-03-01 13:12:48', '2022-03-01 13:12:48'),
(110, 29, 23, 28, 1, 8, '2022-03-01 13:14:12', '2022-03-01 13:14:41'),
(111, 30, 24, 28, 3, 4, '2022-03-01 13:14:19', '2022-03-01 13:14:49'),
(112, 1, 22, 28, 4, 2, '2022-03-01 13:14:26', '2022-03-01 13:14:26'),
(113, 32, 26, 28, 2, 6, '2022-03-01 13:14:32', '2022-03-01 13:15:04'),
(114, 29, 23, 29, 1, 8, '2022-03-01 13:15:25', '2022-03-01 13:16:20'),
(115, 30, 24, 29, 4, 2, '2022-03-01 13:15:32', '2022-03-01 13:15:32'),
(116, 1, 22, 29, 6, 0, '2022-03-01 13:15:43', '2022-03-01 13:15:43'),
(117, 31, 25, 29, 5, 1, '2022-03-01 13:15:49', '2022-03-01 13:15:49'),
(118, 32, 26, 29, 3, 3, '2022-03-01 13:15:55', '2022-03-01 13:15:55'),
(119, 33, 27, 29, 2, 6, '2022-03-01 13:16:00', '2022-03-01 13:16:11'),
(120, 29, 23, 30, 3, 5, '2022-03-01 13:16:40', '2022-03-01 13:17:21'),
(121, 30, 24, 30, 5, 1, '2022-03-01 13:16:46', '2022-03-01 13:16:46'),
(122, 1, 22, 30, 4, 2, '2022-03-01 13:16:53', '2022-03-01 13:16:53'),
(123, 31, 25, 30, 2, 6, '2022-03-01 13:16:58', '2022-03-01 13:17:29'),
(124, 32, 26, 30, 1, 7, '2022-03-01 13:17:03', '2022-03-01 13:17:03'),
(125, 33, 27, 30, 6, 0, '2022-03-01 13:17:08', '2022-03-01 13:17:08'),
(126, 30, 24, 31, 1, 10, '2022-03-01 13:17:46', '2022-03-01 13:18:25'),
(127, 1, 22, 31, 3, 3, '2022-03-01 13:17:53', '2022-03-01 13:17:53'),
(128, 32, 26, 31, 4, 2, '2022-03-01 13:17:59', '2022-03-01 13:17:59'),
(129, 33, 27, 31, 2, 5, '2022-03-01 13:18:06', '2022-03-01 13:18:06'),
(130, 29, 23, 32, 2, 6, '2022-03-01 13:20:38', '2022-03-01 13:21:00'),
(131, 30, 24, 32, 1, 9, '2022-03-01 13:20:41', '2022-03-01 13:21:13'),
(132, 1, 22, 32, 4, 2, '2022-03-01 13:20:47', '2022-03-01 13:20:47'),
(133, 33, 27, 32, 3, 3, '2022-03-01 13:20:55', '2022-03-01 13:20:55'),
(134, 29, 23, 33, 2, 8, '2022-03-01 13:21:29', '2022-03-01 13:22:50'),
(135, 30, 24, 33, 1, 8, '2022-03-01 13:21:35', '2022-03-01 13:22:58'),
(136, 1, 22, 33, 4, 2, '2022-03-01 13:21:40', '2022-03-01 13:21:40'),
(137, 31, 25, 33, 3, 3, '2022-03-01 13:21:47', '2022-03-01 13:21:47'),
(138, 33, 27, 33, 4, 2, '2022-03-01 13:21:54', '2022-03-01 13:21:54'),
(139, 29, 23, 34, 2, 7, '2022-03-01 13:23:20', '2022-03-01 13:24:05'),
(140, 30, 24, 34, 3, 3, '2022-03-01 13:23:26', '2022-03-01 13:23:26'),
(141, 1, 22, 34, 4, 2, '2022-03-01 13:23:32', '2022-03-01 13:23:32'),
(142, 31, 25, 34, 5, 1, '2022-03-01 13:23:40', '2022-03-01 13:23:40'),
(143, 33, 27, 34, 1, 9, '2022-03-01 13:23:44', '2022-03-01 13:23:54'),
(144, 29, 23, 35, 1, 9, '2022-03-01 13:24:22', '2022-03-01 13:24:59'),
(145, 30, 24, 35, 3, 3, '2022-03-01 13:24:27', '2022-03-01 13:24:27'),
(146, 1, 22, 35, 2, 6, '2022-03-01 13:24:33', '2022-03-01 13:24:46'),
(147, 33, 27, 35, 4, 2, '2022-03-01 13:24:38', '2022-03-01 13:24:38'),
(148, 29, 23, 36, 2, 5, '2022-03-01 13:26:16', '2022-03-01 13:26:16'),
(149, 30, 24, 36, 3, 3, '2022-03-01 13:26:22', '2022-03-01 13:26:22'),
(150, 1, 22, 36, 1, 10, '2022-03-01 13:26:27', '2022-03-01 13:30:22'),
(151, 31, 25, 36, 4, 2, '2022-03-01 13:26:33', '2022-03-01 13:26:33'),
(152, 29, 23, 37, 1, 8, '2022-03-01 13:30:42', '2022-03-01 13:31:13'),
(153, 30, 24, 37, 3, 4, '2022-03-01 13:30:48', '2022-03-01 13:31:18'),
(154, 1, 22, 37, 4, 2, '2022-03-01 13:30:55', '2022-03-01 13:30:55'),
(155, 31, 25, 37, 2, 6, '2022-03-01 13:31:05', '2022-03-01 13:31:23'),
(156, 29, 23, 38, 3, 4, '2022-03-01 13:32:27', '2022-03-01 13:32:59'),
(157, 30, 24, 38, 1, 7, '2022-03-01 13:32:33', '2022-03-01 13:32:33'),
(158, 1, 22, 38, 4, 2, '2022-03-01 13:32:41', '2022-03-01 13:32:41'),
(159, 31, 25, 38, 2, 5, '2022-03-01 13:32:51', '2022-03-01 13:32:51'),
(160, 29, 23, 39, 4, 2, '2022-03-01 13:33:17', '2022-03-01 13:33:17'),
(161, 30, 24, 39, 2, 5, '2022-03-01 13:33:23', '2022-03-01 13:33:23'),
(162, 1, 22, 39, 1, 10, '2022-03-01 13:33:31', '2022-03-01 13:33:51'),
(163, 31, 25, 39, 3, 3, '2022-03-01 13:33:37', '2022-03-01 13:33:37'),
(164, 29, 23, 40, 1, 9, '2022-03-01 13:35:37', '2022-03-01 13:36:12'),
(165, 1, 22, 40, 4, 2, '2022-03-01 13:35:47', '2022-03-01 13:35:47'),
(166, 31, 25, 40, 2, 6, '2022-03-01 13:35:54', '2022-03-01 13:36:25'),
(167, 33, 27, 40, 3, 3, '2022-03-01 13:36:01', '2022-03-01 13:36:01'),
(168, 29, 23, 41, 3, 4, '2022-03-01 13:36:51', '2022-03-01 13:37:21'),
(169, 1, 22, 41, 2, 5, '2022-03-01 13:36:57', '2022-03-01 13:36:57'),
(170, 31, 25, 41, 4, 2, '2022-03-01 13:37:04', '2022-03-01 13:37:04'),
(171, 33, 27, 41, 1, 8, '2022-03-01 13:37:08', '2022-03-01 13:37:14'),
(172, 29, 23, 42, 2, 5, '2022-03-01 13:37:40', '2022-03-01 13:37:40'),
(173, 1, 22, 42, 3, 4, '2022-03-01 13:37:46', '2022-03-01 13:38:11'),
(174, 31, 25, 42, 1, 9, '2022-03-01 13:37:53', '2022-03-01 13:38:22'),
(175, 33, 27, 42, 4, 2, '2022-03-01 13:37:58', '2022-03-01 13:37:58'),
(176, 29, 23, 43, 2, 5, '2022-03-01 13:39:06', '2022-03-01 13:39:06'),
(177, 30, 24, 43, 3, 4, '2022-03-01 13:39:12', '2022-03-01 13:39:31'),
(178, 1, 22, 43, 4, 2, '2022-03-01 13:39:19', '2022-03-01 13:39:19'),
(179, 33, 27, 43, 1, 7, '2022-03-01 13:39:24', '2022-03-01 13:39:24'),
(180, 29, 23, 44, 1, 9, '2022-03-01 13:40:18', '2022-03-01 13:40:58'),
(181, 30, 24, 44, 4, 2, '2022-03-01 13:40:24', '2022-03-01 13:40:24'),
(182, 1, 22, 44, 3, 3, '2022-03-01 13:40:31', '2022-03-01 13:40:31'),
(183, 33, 27, 44, 2, 6, '2022-03-01 13:40:38', '2022-03-01 13:40:46'),
(184, 29, 23, 45, 2, 5, '2022-03-01 13:41:23', '2022-03-01 13:41:23'),
(185, 30, 24, 45, 1, 8, '2022-03-01 13:41:28', '2022-03-01 13:41:52'),
(186, 1, 22, 45, 3, 3, '2022-03-01 13:41:34', '2022-03-01 13:41:34'),
(187, 33, 27, 45, 4, 2, '2022-03-01 13:41:42', '2022-03-01 13:41:42');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `pseudo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image_id` int(10) UNSIGNED DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `email`, `password`, `image_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'milo', 'milo@sfr.fr', '$2y$10$EMYJYOSqXLwbeHdP/l067OWDgveIETF0PaU4c2KOli.966aA3Lxay', NULL, NULL, '2022-02-16 13:23:12', '2022-02-16 13:23:12'),
(29, 'Porthos', NULL, NULL, NULL, NULL, '2022-03-01 12:17:57', '2022-03-01 12:17:57'),
(30, 'Helias', NULL, NULL, NULL, NULL, '2022-03-01 12:19:51', '2022-03-01 12:19:51'),
(31, 'Buzz', NULL, NULL, NULL, NULL, '2022-03-01 12:20:13', '2022-03-01 12:20:13'),
(32, 'Fab', NULL, NULL, NULL, NULL, '2022-03-01 12:20:24', '2022-03-01 12:20:24'),
(33, 'Flo', NULL, NULL, NULL, NULL, '2022-03-01 12:20:32', '2022-03-01 12:20:32');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `associate_user`
--
ALTER TABLE `associate_user`
  ADD KEY `associate_user_user_id_foreign` (`user_id`),
  ADD KEY `associate_user_creator_id_foreign` (`creator_id`);

--
-- Index pour la table `championships`
--
ALTER TABLE `championships`
  ADD PRIMARY KEY (`id`),
  ADD KEY `championships_image_id_foreign` (`image_id`),
  ADD KEY `championships_user_id_foreign` (`user_id`);

--
-- Index pour la table `championship_user`
--
ALTER TABLE `championship_user`
  ADD KEY `championship_user_user_id_foreign` (`user_id`),
  ADD KEY `championship_user_championship_id_foreign` (`championship_id`);

--
-- Index pour la table `decks`
--
ALTER TABLE `decks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `decks_image_id_foreign` (`image_id`),
  ADD KEY `decks_user_id_foreign` (`user_id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `kills`
--
ALTER TABLE `kills`
  ADD KEY `kills_result_id_foreign` (`result_id`),
  ADD KEY `kills_user_killed_id_foreign` (`user_killed_id`);

--
-- Index pour la table `matchs`
--
ALTER TABLE `matchs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matchs_image_id_foreign` (`image_id`),
  ADD KEY `matchs_championship_id_foreign` (`championship_id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Index pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Index pour la table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `results_user_id_foreign` (`user_id`),
  ADD KEY `results_deck_id_foreign` (`deck_id`),
  ADD KEY `results_match_id_foreign` (`match_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_image_id_foreign` (`image_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `championships`
--
ALTER TABLE `championships`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `decks`
--
ALTER TABLE `decks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `matchs`
--
ALTER TABLE `matchs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `results`
--
ALTER TABLE `results`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=188;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `associate_user`
--
ALTER TABLE `associate_user`
  ADD CONSTRAINT `associate_user_creator_id_foreign` FOREIGN KEY (`creator_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `associate_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `championships`
--
ALTER TABLE `championships`
  ADD CONSTRAINT `championships_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `championships_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `championship_user`
--
ALTER TABLE `championship_user`
  ADD CONSTRAINT `championship_user_championship_id_foreign` FOREIGN KEY (`championship_id`) REFERENCES `championships` (`id`),
  ADD CONSTRAINT `championship_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `decks`
--
ALTER TABLE `decks`
  ADD CONSTRAINT `decks_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`),
  ADD CONSTRAINT `decks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `kills`
--
ALTER TABLE `kills`
  ADD CONSTRAINT `kills_result_id_foreign` FOREIGN KEY (`result_id`) REFERENCES `results` (`id`),
  ADD CONSTRAINT `kills_user_killed_id_foreign` FOREIGN KEY (`user_killed_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `matchs`
--
ALTER TABLE `matchs`
  ADD CONSTRAINT `matchs_championship_id_foreign` FOREIGN KEY (`championship_id`) REFERENCES `championships` (`id`),
  ADD CONSTRAINT `matchs_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);

--
-- Contraintes pour la table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_deck_id_foreign` FOREIGN KEY (`deck_id`) REFERENCES `decks` (`id`),
  ADD CONSTRAINT `results_match_id_foreign` FOREIGN KEY (`match_id`) REFERENCES `matchs` (`id`),
  ADD CONSTRAINT `results_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_image_id_foreign` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
