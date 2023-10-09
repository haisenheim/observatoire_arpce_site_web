-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : lun. 09 oct. 2023 à 11:02
-- Version du serveur :  8.0.34-0ubuntu0.20.04.1
-- Version de PHP : 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `arpce_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `annees`
--

CREATE TABLE `annees` (
  `id` int NOT NULL,
  `name` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

CREATE TABLE `articles` (
  `id` int NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `body` text,
  `image_uri` varchar(100) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `category_id` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `token` varchar(100) DEFAULT NULL,
  `fichier_uri` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `name`, `body`, `image_uri`, `active`, `category_id`, `created_at`, `updated_at`, `user_id`, `token`, `fichier_uri`) VALUES
(1, 'Les impacts du changement climatique', 'Texte : \"Découvrez comment vous pouvez contribuer à réduire l\'empreinte carbone du\r\nnumérique. Apprenez les bonnes pratiques, adoptez des technologies éco-responsables et\r\nparticipez à des initiatives pour un impact positif sur l\'environnement.', 'articles/1686508698.jpg', 0, 1, '2023-06-11 18:38:18', '2023-09-06 11:04:37', 1, 'hjfjkjfjklsncbbcjx', 'articles/1686558532.pdf'),
(2, 'La Consommation Électrique des Centres de Données : Un Enjeu Majeur pour un Numérique Soutenable', 'L\'ère numérique dans laquelle nous vivons est caractérisée par une explosion des données. Chaque jour, des pétaoctets d\'informations sont générés, stockés, traités et transmis à travers le monde. Au cœur de cette révolution se trouvent les centres de données, de véritables forteresses numériques qui hébergent une grande partie de cette infrastructure. Mais derrière ces façades technologiques se cache un défi environnemental de taille : leur consommation électrique.\r\n\r\n1. Une consommation énergétique croissante\r\nLa demande incessante de puissance de calcul et de capacités de stockage a entraîné une augmentation massive de la taille et du nombre de centres de données. Ces installations sont en fonctionnement 24 heures sur 24, nécessitant non seulement de l\'énergie pour alimenter les serveurs, mais aussi pour les systèmes de refroidissement, indispensables à la régulation thermique. Selon certaines estimations, les centres de données pourraient représenter jusqu\'à 3% de la consommation électrique mondiale d\'ici quelques années.\r\n\r\n2. Les implications environnementales\r\nLa consommation d\'électricité est directement liée aux émissions de gaz à effet de serre, en particulier dans les régions où l\'électricité est principalement produite à partir de combustibles fossiles. Ainsi, plus un data center consomme d\'électricité, plus son empreinte carbone est élevée. Cette empreinte s\'ajoute à celle des nombreux équipements électroniques qui, en fin de vie, viennent alourdir la facture environnementale du numérique.\r\n\r\n3. Vers des centres de données plus verts\r\nFace à ce défi, l\'industrie des centres de données évolue. De nombreuses entreprises mettent en place des initiatives pour réduire leur consommation d\'électricité, à travers des architectures plus efficientes ou l\'utilisation de sources d\'énergie renouvelable. Les technologies de refroidissement évoluent également, avec des solutions plus éco-responsables, comme le refroidissement par immersion ou l\'utilisation de l\'air extérieur.\r\n\r\nConclusion\r\nL\'Observatoire du Numérique Soutenable est en première ligne pour suivre, évaluer et anticiper les impacts du numérique sur notre environnement. La consommation électrique des centres de données est l\'un des nombreux domaines sous surveillance, témoignant de l\'importance d\'allier progrès technologique et préservation de notre planète. Les défis sont immenses, mais avec une prise de conscience collective et des actions concrètes, un numérique plus vert est à notre portée.', 'articles/1686558677.jpg', 0, 1, '2023-06-12 08:31:17', '2023-10-09 10:55:03', 12, '20e956085a80481d81a799500c549a2e9337f6ca', 'articles/1686558677.pdf');

-- --------------------------------------------------------

--
-- Structure de la table `article_tag`
--

CREATE TABLE `article_tag` (
  `id` int NOT NULL,
  `article_id` int NOT NULL DEFAULT '0',
  `tag_id` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `categories`
--

CREATE TABLE `categories` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Environnement');

-- --------------------------------------------------------

--
-- Structure de la table `communes`
--

CREATE TABLE `communes` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `departement_id` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `communes`
--

INSERT INTO `communes` (`id`, `name`, `departement_id`) VALUES
(1, 'Loango', 2),
(2, 'Lumumba 1', 1),
(3, 'Dolisie 1', 4);

-- --------------------------------------------------------

--
-- Structure de la table `datacenters`
--

CREATE TABLE `datacenters` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `owner` varchar(100) DEFAULT NULL,
  `operateur` varchar(100) DEFAULT NULL,
  `start` date DEFAULT NULL,
  `commune_id` int DEFAULT '0',
  `entreprise_id` int NOT NULL DEFAULT '0',
  `active_id` tinyint(1) NOT NULL DEFAULT '1',
  `token` varchar(100) DEFAULT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `datacenters`
--

INSERT INTO `datacenters` (`id`, `name`, `owner`, `operateur`, `start`, `commune_id`, `entreprise_id`, `active_id`, `token`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'ALT 1', 'Alliages Technologies', 'Syn-apps', '2019-04-15', 1, 2, 1, '5366e8afbcefc0b45b1eab08f272c850ba5de275', 0, '2023-06-09 07:33:25', '2023-06-09 07:33:25'),
(2, 'SynX33', 'OBAC Capital', 'Synapp Inc', '2023-07-14', 2, 2, 1, '1fb1cd31140b0398e76b5aa0afdd31abd959a748', 0, '2023-07-01 18:36:26', '2023-07-01 18:36:26'),
(3, 'WVG45', 'Alliages Technologies', 'SynApps Inc', '2019-02-23', 2, 2, 1, '51368cd950b4975686048553334ccc4cdc6ce89c', 0, '2023-07-05 20:09:47', '2023-07-05 20:09:47');

-- --------------------------------------------------------

--
-- Structure de la table `datacenter_fiches`
--

CREATE TABLE `datacenter_fiches` (
  `id` int NOT NULL,
  `fiche_id` int NOT NULL DEFAULT '0',
  `datacenter_id` int NOT NULL DEFAULT '0',
  `conso_elec_dc` double NOT NULL DEFAULT '0',
  `conso_elec_equip` double NOT NULL DEFAULT '0',
  `vol_eau_entrant` double NOT NULL DEFAULT '0',
  `vol_eau_sortant` double NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `datacenter_fiches`
--

INSERT INTO `datacenter_fiches` (`id`, `fiche_id`, `datacenter_id`, `conso_elec_dc`, `conso_elec_equip`, `vol_eau_entrant`, `vol_eau_sortant`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 39, 45, 16, 19, '2023-06-09 08:58:32', '2023-06-09 08:58:32'),
(4, 5, 2, 45, 34, 345, 345, '2023-07-05 13:43:00', '2023-07-05 13:43:00');

-- --------------------------------------------------------

--
-- Structure de la table `departements`
--

CREATE TABLE `departements` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `departements`
--

INSERT INTO `departements` (`id`, `name`) VALUES
(1, 'Pointe-Noire'),
(2, 'Kouilou'),
(3, 'Brazzaville'),
(4, 'Niari'),
(5, 'Pool'),
(6, 'Sanga'),
(7, 'Bouenza'),
(8, 'Likouala');

-- --------------------------------------------------------

--
-- Structure de la table `entreprises`
--

CREATE TABLE `entreprises` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `secteur_id` int DEFAULT '0',
  `image_uri` varchar(100) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT '1',
  `token` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `entreprises`
--

INSERT INTO `entreprises` (`id`, `name`, `email`, `phone`, `secteur_id`, `image_uri`, `created_at`, `updated_at`, `active`, `token`) VALUES
(4, 'Agence de Régulation des Postes et des Communications Electroniques (ARPCE)', 'stany.louvouezo@arpce.cg', '06 836 75 75', 3, 'entreprise/1692869817.jpg', '2023-08-24 09:36:57', '2023-08-24 09:36:57', 1, '7257af4480027af5fc8a7b34e8f193c5ac29d1f8'),
(5, 'CONGO TELECOM', 'simon.babedila@congotelecom.cg', '226 010 457', 1, 'entreprise/1692892171.jpg', '2023-08-24 15:49:31', '2023-08-24 15:49:31', 1, '8bd6a12f0dfd31d6368cbbed51bd9b25d899ef21'),
(6, 'MTN-CONGO', 'Helga.OSSENZA@mtn.com', '066691333', 1, 'entreprise/1692892327.png', '2023-08-24 15:52:07', '2023-08-24 15:52:07', 1, '5dc29ad4c7d9e5fd157e4254f003a5308c541d97'),
(7, 'Airtel Congo S.A', 'sandra.becale@cg.airtel.com', '+242 05 500 90 05', 1, 'entreprise/1692892466.png', '2023-08-24 15:54:26', '2023-08-24 15:54:26', 1, '6847e948de8b57167f7c75c322856503c83f85d0'),
(8, 'ARAP (Agence de Régulation de l\'Aval Pétrolier)', 'e.tchicaillat@arap.cg', '069423443', 3, 'entreprise/1692892795.jpg', '2023-08-24 15:59:55', '2023-08-24 15:59:55', 1, '6acd57ef56b2759dd0ccf66bf7587720d4be2343'),
(9, 'MCUH (Ministère de la construction, de l\'urbanisme et de l\'habitat)', 'wilfridngamba@gmail.com', '066726086', 3, 'entreprise/1692893418.png', '2023-08-24 16:10:18', '2023-08-24 16:10:18', 1, '603e2f0b87112c677c2b5cfac4b19610c1375058');

-- --------------------------------------------------------

--
-- Structure de la table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `faqs`
--

CREATE TABLE `faqs` (
  `id` int NOT NULL,
  `question` varchar(255) DEFAULT NULL,
  `reponse` text,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `categorie_id` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `faqs`
--

INSERT INTO `faqs` (`id`, `question`, `reponse`, `active`, `categorie_id`) VALUES
(2, 'Qu\'est-ce que l\'Observatoire du Numérique Soutenable ?', 'L\'Observatoire du Numérique Soutenable est une initiative lancée par l\'Agence de Régulation des Postes et Communications Électroniques (ARPCE) au Congo. Son objectif est d\'anticiper les impacts environnementaux du développement du numérique et de mettre en place des solutions durables pour préserver l\'environnement tout en favorisant la croissance du secteur numérique.', 1, 0),
(3, 'Quels sont les objectifs de l\'Observatoire du Numérique Soutenable ?', 'Les objectifs de l\'Observatoire sont multiples : collecter des données sur l\'impact environnemental du numérique, surveiller les progrès dans la réduction de l\'empreinte carbone du secteur, sensibiliser les acteurs du numérique sur les enjeux environnementaux, et fournir des informations pertinentes aux parties prenantes.', 1, 0),
(4, 'Comment les entreprises du numérique peuvent-elles contribuer à l\'Observatoire ?', 'Les entreprises du numérique peuvent contribuer en fournissant chaque année un rapport environnemental sur leurs activités, et en s\'engageant dans des initiatives de réduction des émissions de carbone.', 1, 0),
(5, 'Comment puis-je contacter l\'équipe de l\'Observatoire ?', 'Vous pouvez nous contacter via le formulaire de contact disponible sur notre site web. Nous sommes ravis de répondre à vos questions et de recevoir vos suggestions concernant l\'Observatoire du Numérique Soutenable.', 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `fiches`
--

CREATE TABLE `fiches` (
  `id` int NOT NULL,
  `annee` int NOT NULL DEFAULT '0',
  `entreprise_id` int NOT NULL DEFAULT '0',
  `type_id` int NOT NULL DEFAULT '0',
  `ges_ge` double NOT NULL DEFAULT '0',
  `ges_reseaux` double NOT NULL DEFAULT '0',
  `ges_infra` double NOT NULL DEFAULT '0',
  `ges_equip_dc` int NOT NULL DEFAULT '0',
  `conso_reseaux` double NOT NULL DEFAULT '0',
  `conso_dc` double NOT NULL DEFAULT '0',
  `conso_box` double NOT NULL DEFAULT '0',
  `conso_autres` double NOT NULL DEFAULT '0',
  `equip_phone_achat_new_public` int NOT NULL DEFAULT '0',
  `equip_phone_achat_new_private` int NOT NULL DEFAULT '0',
  `equip_phone_achat_old_public` int NOT NULL DEFAULT '0',
  `equip_phone_achat_old_private` int NOT NULL DEFAULT '0',
  `equip_phone_vente_new_public` int NOT NULL DEFAULT '0',
  `equip_phone_vente_new_private` int NOT NULL DEFAULT '0',
  `equip_phone_vente_old_public` int NOT NULL DEFAULT '0',
  `equip_phone_vente_old_private` int NOT NULL DEFAULT '0',
  `nb_phone_new_sm_2g` int NOT NULL DEFAULT '0',
  `nb_phone_new_sm_3g` int NOT NULL DEFAULT '0',
  `nb_phone_new_sm_4g` int NOT NULL DEFAULT '0',
  `nb_phone_new_md_2g` int NOT NULL DEFAULT '0',
  `nb_phone_new_md_3g` int NOT NULL DEFAULT '0',
  `nb_phone_new_md_4g` int NOT NULL DEFAULT '0',
  `nb_phone_new_lg_2g` int NOT NULL DEFAULT '0',
  `nb_phone_new_lg_3g` int NOT NULL DEFAULT '0',
  `nb_phone_new_lg_4g` int NOT NULL DEFAULT '0',
  `nb_phone_old_sm_2g` int NOT NULL DEFAULT '0',
  `nb_phone_old_sm_3g` int NOT NULL DEFAULT '0',
  `nb_phone_old_sm_4g` int NOT NULL DEFAULT '0',
  `nb_phone_old_md_2g` int NOT NULL DEFAULT '0',
  `nb_phone_old_md_3g` int NOT NULL DEFAULT '0',
  `nb_phone_old_md_4g` int NOT NULL DEFAULT '0',
  `nb_phone_old_lg_2g` int NOT NULL DEFAULT '0',
  `nb_phone_old_lg_3g` int NOT NULL DEFAULT '0',
  `nb_phone_old_lg_4g` int NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `token` varchar(130) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `fiches`
--

INSERT INTO `fiches` (`id`, `annee`, `entreprise_id`, `type_id`, `ges_ge`, `ges_reseaux`, `ges_infra`, `ges_equip_dc`, `conso_reseaux`, `conso_dc`, `conso_box`, `conso_autres`, `equip_phone_achat_new_public`, `equip_phone_achat_new_private`, `equip_phone_achat_old_public`, `equip_phone_achat_old_private`, `equip_phone_vente_new_public`, `equip_phone_vente_new_private`, `equip_phone_vente_old_public`, `equip_phone_vente_old_private`, `nb_phone_new_sm_2g`, `nb_phone_new_sm_3g`, `nb_phone_new_sm_4g`, `nb_phone_new_md_2g`, `nb_phone_new_md_3g`, `nb_phone_new_md_4g`, `nb_phone_new_lg_2g`, `nb_phone_new_lg_3g`, `nb_phone_new_lg_4g`, `nb_phone_old_sm_2g`, `nb_phone_old_sm_3g`, `nb_phone_old_sm_4g`, `nb_phone_old_md_2g`, `nb_phone_old_md_3g`, `nb_phone_old_md_4g`, `nb_phone_old_lg_2g`, `nb_phone_old_lg_3g`, `nb_phone_old_lg_4g`, `created_at`, `updated_at`, `token`) VALUES
(1, 2018, 1, 1, 12.5, 34, 17.8, 0, 31.5, 40.9, 11.9, 43.3, 27, 31, 36, 21, 43, 34, 22, 20, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2023-06-08 17:53:15', '2023-06-08 17:53:15', 'hdggfgfas5gdshjhjsd792657612gdstyweu787981297gu'),
(2, 2018, 2, 3, 38, 0, 64.9, 47, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2023-06-09 07:51:13', '2023-06-09 07:51:13', '5f101848c37c899a9bb9055aad6eaf2e819b0846'),
(3, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2023-06-30 00:45:29', '2023-06-30 00:45:29', 'c0e9e7eab446855364566cdcced6f4bfba179fbe'),
(4, 2019, 1, 1, 290, 230, 430, 0, 440, 330, 420, 640, 444, 350, 450, 480, 567, 760, 450, 330, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2023-06-30 00:47:06', '2023-06-30 00:47:06', '34f0e26cf9c4b75cc6272a0e4de37bb2941b0950'),
(5, 2019, 2, 3, 400, 0, 560, 345, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2023-06-30 16:47:43', '2023-06-30 16:47:43', 'b1fa8ca5cd5fb59b341c31cb765619fc4f58ca66');

-- --------------------------------------------------------

--
-- Structure de la table `forms`
--

CREATE TABLE `forms` (
  `id` int NOT NULL,
  `entreprise_id` int NOT NULL DEFAULT '0',
  `type_id` int NOT NULL DEFAULT '1',
  `annee` int NOT NULL DEFAULT '0',
  `qt_eau` double NOT NULL DEFAULT '0',
  `energie_elec` double NOT NULL DEFAULT '0',
  `per_renew` double NOT NULL DEFAULT '0',
  `conso_elec_infra` double NOT NULL DEFAULT '0',
  `qt_carburant` double NOT NULL DEFAULT '0',
  `carburant_ge` varchar(200) DEFAULT NULL,
  `qt_moy_papier` double NOT NULL DEFAULT '0',
  `how_about_old_equip` text,
  `nb_datacenter` int NOT NULL DEFAULT '0',
  `conso_elec_datacenter` double NOT NULL DEFAULT '0',
  `puissance_datacenter` double NOT NULL DEFAULT '0',
  `nb_router` int NOT NULL DEFAULT '0',
  `conso_elec_router` double NOT NULL DEFAULT '0',
  `nb_server` int NOT NULL DEFAULT '0',
  `conso_elec_server` double NOT NULL DEFAULT '0',
  `nb_switch` int NOT NULL DEFAULT '0',
  `conso_elec_switch` double NOT NULL DEFAULT '0',
  `nb_clim` int NOT NULL DEFAULT '0',
  `conso_elec_clim` double NOT NULL DEFAULT '0',
  `nb_onduleur` int NOT NULL DEFAULT '0',
  `conso_elec_onduleur` double NOT NULL DEFAULT '0',
  `nb_ge` int NOT NULL DEFAULT '0',
  `puissance_ge` double NOT NULL DEFAULT '0',
  `nb_tv` int NOT NULL DEFAULT '0',
  `conso_tv` double NOT NULL DEFAULT '0',
  `nb_laptop` int NOT NULL DEFAULT '0',
  `conso_laptop` double NOT NULL DEFAULT '0',
  `nb_ordi` int NOT NULL DEFAULT '0',
  `conso_ordi` double NOT NULL DEFAULT '0',
  `nb_box` int NOT NULL DEFAULT '0',
  `conso_box` double NOT NULL DEFAULT '0',
  `nb_tablet` int NOT NULL DEFAULT '0',
  `conso_tablet` double NOT NULL DEFAULT '0',
  `nb_phone` int NOT NULL DEFAULT '0',
  `conso_phone` double NOT NULL DEFAULT '0',
  `nb_projector` int NOT NULL DEFAULT '0',
  `conso_projector` double NOT NULL DEFAULT '0',
  `has_policy` tinyint(1) NOT NULL DEFAULT '0',
  `nb_staff` int NOT NULL DEFAULT '0',
  `comment` text,
  `token` varchar(255) DEFAULT NULL,
  `user_id` int NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `forms`
--

INSERT INTO `forms` (`id`, `entreprise_id`, `type_id`, `annee`, `qt_eau`, `energie_elec`, `per_renew`, `conso_elec_infra`, `qt_carburant`, `carburant_ge`, `qt_moy_papier`, `how_about_old_equip`, `nb_datacenter`, `conso_elec_datacenter`, `puissance_datacenter`, `nb_router`, `conso_elec_router`, `nb_server`, `conso_elec_server`, `nb_switch`, `conso_elec_switch`, `nb_clim`, `conso_elec_clim`, `nb_onduleur`, `conso_elec_onduleur`, `nb_ge`, `puissance_ge`, `nb_tv`, `conso_tv`, `nb_laptop`, `conso_laptop`, `nb_ordi`, `conso_ordi`, `nb_box`, `conso_box`, `nb_tablet`, `conso_tablet`, `nb_phone`, `conso_phone`, `nb_projector`, `conso_projector`, `has_policy`, `nb_staff`, `comment`, `token`, `user_id`, `active`, `created_at`, `updated_at`) VALUES
(8, 4, 3, 2021, 29280, 871133, 0, 0, 89560, 'GO', 0, NULL, 1, 0, 0, 20, 0.1854, 89, 0.4091, 22, 0.2124, 5, 4.752, 3, 24, 3, 755, 40, 0.098, 110, 0.095, 83, 0.25, 18, 0.009, 20, 0.044, 230, 0.007, 4, 0.25, 0, 0, NULL, '65dd39adcef9bfc189485d2b465096edf486e662', 17, 1, '2023-08-25 12:43:15', '2023-08-25 12:43:15'),
(9, 4, 3, 2022, 29280, 1076217, 0, 0, 76716, 'GO', 0, NULL, 1, 0, 0, 20, 0.1854, 89, 0.4091, 22, 0.2124, 5, 4.752, 3, 24, 3, 755, 40, 0.098, 110, 0.095, 83, 0.25, 18, 0.009, 20, 0.044, 230, 0.007, 4, 0.25, 0, 0, NULL, '4105030803266f0117489bab6f78ef9221e65d9e', 17, 1, '2023-08-25 13:25:15', '2023-08-25 13:25:15'),
(10, 4, 3, 2023, 29280, 718984, 0, 0, 56700, 'GO', 0, NULL, 1, 0, 0, 20, 0.1854, 89, 0.4091, 22, 0.2124, 5, 4.752, 3, 24, 3, 755, 40, 0.098, 110, 0.095, 83, 0.25, 18, 0.009, 20, 0.044, 230, 0.007, 4, 0.25, 0, 0, NULL, '2ad07020fe82db44668f9728aca8ee4def1cf6b6', 17, 1, '2023-08-25 13:56:01', '2023-08-25 13:56:01'),
(11, 7, 1, 2023, 9050, 691431, 0, 10395.5, 0, 'Gasoil', 0, NULL, 2, 145915, 0, 26, 11.54, 13, 11.54, 18, 11.52, 28, 33, 12, 50, 26, 131.2, 41, 34.8, 167, 88.844, 161, 463.7, 4, 0.0432, 0, 0, 16, 1.23, 3, 0.008, 1, 124, NULL, '095b59f1d227ee277a1484999bdb122dfad386fb', 20, 1, '2023-08-25 16:46:55', '2023-08-25 16:46:55'),
(12, 5, 1, 2021, 0, 15654, 0, 10952, 0, '0', 0, NULL, 1, 4657, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 4214, 0, 0, 0, 0, 1, 7, 1, 38, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '0319ac1d7c1dae01b737e56166614528ad2631b6', 18, 1, '2023-08-28 09:55:26', '2023-08-28 09:55:26'),
(13, 5, 1, 2022, 0, 15671, 0, 10952, 0, '0', 0, NULL, 1, 4657, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 4200.5, 0, 0, 0, 0, 1, 7, 1, 55, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'bbc12905673d1b1ebde661804792075a417a35e3', 18, 1, '2023-08-28 10:03:44', '2023-08-28 10:03:44'),
(14, 5, 1, 2023, 0, 7844, 0, 5476, 0, '0', 0, NULL, 1, 2328, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 4200.5, 0, 0, 0, 0, 0, 4, 0, 35, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '3d14c828267aa67ad1546098589924eafb25f13a', 18, 1, '2023-08-28 14:38:45', '2023-08-28 14:38:45'),
(15, 9, 3, 2023, 0, 0, 0, 6250, 0, '0', 0, NULL, 0, 0, 0, 6, 1050, 0, 0, 0, 0, 15, 1920, 2, 5, 1, 5000, 4, 1600, 11, 220, 7, 4200, 4, 340, 0, 0, 0, 0, 1, 0, 0, 0, NULL, '803bee6a39b726dad65949877830de9ac5daae8c', 22, 1, '2023-08-28 15:51:52', '2023-08-28 15:51:52'),
(16, 6, 1, 2021, 0, 0, 0, 2404.97, 0, 'Gasoil', 0, NULL, 2, 314910, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '5211174761ebf5a03a0c560908417bc8fa8e70d9', 19, 1, '2023-08-30 10:39:14', '2023-08-30 10:39:14'),
(17, 6, 1, 2022, 0, 0, 0, 2405.255, 0, 'Gasoil', 0, NULL, 2, 310700, 0, 0, 0, 1, 287.37075, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '1d50028c7b2e7168c84024d0437defd879d1a9b5', 19, 1, '2023-08-30 10:47:04', '2023-08-30 10:47:04'),
(18, 6, 1, 2023, 0, 0, 0, 2459.69, 0, 'Gasoil', 0, NULL, 2, 135680, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3864, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, '3fa81f278775afc70dd49f0bd64e799f8b714f89', 19, 1, '2023-08-30 10:59:56', '2023-08-30 10:59:56'),
(19, 6, 1, 2023, 0, 271360, 0, 2459.69, 0, 'Gasoil', 0, NULL, 2, 135680, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 3864, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, 'bf2535772c517534d85da8ba9ff861ebb2b06c07', 19, 1, '2023-09-06 08:42:34', '2023-09-06 08:42:34');

-- --------------------------------------------------------

--
-- Structure de la table `indicateurs`
--

CREATE TABLE `indicateurs` (
  `id` int NOT NULL,
  `entreprise_id` int NOT NULL DEFAULT '0',
  `annee` int NOT NULL DEFAULT '0',
  `type_id` int NOT NULL DEFAULT '0',
  `valeur` double NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `indicateurs`
--

INSERT INTO `indicateurs` (`id`, `entreprise_id`, `annee`, `type_id`, `valeur`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 0, 2018, 1, 6000, '2023-06-07 22:26:58', '2023-06-12 08:40:14', 0),
(2, 0, 2019, 1, 6200, '2023-06-07 22:27:49', '2023-06-07 22:27:49', 0),
(3, 0, 2020, 1, 6500, '2023-06-07 22:28:25', '2023-06-07 22:28:25', 0),
(4, 0, 2021, 1, 6800, '2023-06-07 22:29:01', '2023-06-07 22:29:01', 0),
(5, 0, 2022, 1, 298000, '2023-06-07 22:29:28', '2023-09-07 14:15:02', 0),
(6, 0, 2023, 1, 6900, '2023-06-07 22:29:52', '2023-06-07 22:29:52', 0),
(7, 0, 2018, 2, 60, '2023-06-07 22:30:36', '2023-06-07 22:30:36', 0),
(8, 0, 2019, 2, 78, '2023-06-07 22:31:01', '2023-06-07 22:31:01', 0),
(9, 0, 2020, 2, 89, '2023-06-07 22:31:24', '2023-06-07 22:31:24', 0),
(10, 0, 2021, 2, 87, '2023-06-07 22:31:50', '2023-06-07 22:31:50', 0),
(11, 0, 2022, 2, 90, '2023-06-07 22:32:14', '2023-06-07 22:32:14', 0),
(12, 0, 2023, 2, 93, '2023-06-07 22:32:42', '2023-06-07 22:32:42', 0),
(13, 0, 2018, 3, 7, '2023-06-07 22:54:49', '2023-06-07 22:54:49', 0),
(14, 0, 2019, 3, 7.3, '2023-06-07 22:55:06', '2023-06-07 22:55:06', 0),
(15, 0, 2020, 3, 6, '2023-06-07 22:55:23', '2023-06-07 22:55:23', 0),
(16, 0, 2021, 3, 6.2, '2023-06-07 22:55:59', '2023-06-07 22:55:59', 0),
(17, 0, 2022, 3, 7.1, '2023-06-07 22:56:24', '2023-06-07 22:56:24', 0),
(18, 0, 2023, 3, 7.5, '2023-06-07 22:56:42', '2023-06-07 22:56:42', 0);

-- --------------------------------------------------------

--
-- Structure de la table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Structure de la table `params`
--

CREATE TABLE `params` (
  `id` int NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `contact` varchar(100) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `facebook_uri` varchar(100) DEFAULT NULL,
  `linkedin_uri` varchar(100) DEFAULT NULL,
  `twitter_uri` varchar(100) DEFAULT NULL,
  `instagram_uri` varchar(100) DEFAULT NULL,
  `arpce_contact` varchar(100) DEFAULT NULL,
  `arpce_phone` varchar(30) DEFAULT NULL,
  `arpce_email` varchar(100) DEFAULT NULL,
  `about_photo` varchar(200) DEFAULT NULL,
  `about_text` text,
  `nb_rapports` int NOT NULL DEFAULT '0',
  `nb_partenaires` int NOT NULL DEFAULT '0',
  `nb_entreprises` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `params`
--

INSERT INTO `params` (`id`, `email`, `phone`, `contact`, `logo`, `facebook_uri`, `linkedin_uri`, `twitter_uri`, `instagram_uri`, `arpce_contact`, `arpce_phone`, `arpce_email`, `about_photo`, `about_text`, `nb_rapports`, `nb_partenaires`, `nb_entreprises`) VALUES
(1, 'text@example.com', '0678787989', '07878989', NULL, NULL, NULL, NULL, NULL, 'Cabinet SBV Consulting ', '064871477 ', 'contact@sbv-consulting.cg', 'param/about.jpg', '<p>Le numérique occupe une place importante dans nos vies, mais son empreinte écologique est souvent sous-estimée, lesquels produits par l’extraction des matières premières, la consommation électrique, la fabrication des équipements et leur usage. Une étude récente relève que la pollution numérique représentait 4 % des émissions de gaz à effet de serre (GES) dans le monde, <strong>2% au Congo </strong>selon les études menées par le Ministère de l’Environnement, du Développement durable et du Bassin du Congo.</p><p>Cependant, le gouvernement souhaiterait baisser ce taux à <strong>1,8%</strong>. Pour pallier à cela, l\'Agence de Régulation des Postes et Communications Électroniques (ARPCE) à travers le projet <strong>Internet Soutenable </strong>s’engage à mettre en place <strong>l’observatoire des impacts environnementaux sur le numérique </strong>afin d’évaluer et quantifier l’empreinte carbone émis par les équipements et infrastructures du numérique au Congo.</p><p>Une première démarche consiste à faire le bilan carbone du secteur du numérique en <strong>collectant les données environnementales </strong>auprès des principaux opérateurs de communications électroniques à savoir&nbsp;: <strong>les Opérateurs, les fournisseurs d’accès Internet, les fabricants des terminaux et aux centres de données ou Datacenter</strong>.</p><p><strong>Notre mission</strong></p><p>Reconnaissant le rôle prédominant du numérique dans la société moderne et les opportunités qu’il offre, notre mission consiste à mesurer l’empreinte environnementale du numérique au Congo, d’évaluer l’évolution de cet impact dans les prochaines années, de formuler des pistes d’action et les bonnes pratiques pour la réduire, afin d’engager la République du Congo dans une transition numérique écologique, compatible pour lutter contre le réchauffement climatique.</p><p><strong>Rejoignez-nous</strong></p><p>Que vous soyez une entreprise du secteur numérique, un décideur politique, un chercheur ou simplement un citoyen engagé, votre contribution est essentielle pour la réussite de cette initiative. Nous vous invitons à nous contacter, à participer à nos ateliers de sensibilisation, à partager vos idées et à œuvrer ensemble pour un futur numérique respectueux de notre environnement.</p>', 3, 10, 10);

-- --------------------------------------------------------

--
-- Structure de la table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'auth_token', 'a9e5f97ee2e6a887952feb07aef5c36b3739493e40a8c00c38b8e5c35de746c3', '[\"*\"]', NULL, NULL, '2023-06-25 13:32:12', '2023-06-25 13:32:12'),
(2, 'App\\Models\\User', 3, 'auth_token', '77c4d61986ef31301d7660972b31807c13a33bda67bf0d84476cdc1a90b47a63', '[\"*\"]', NULL, NULL, '2023-06-25 14:25:55', '2023-06-25 14:25:55'),
(3, 'App\\Models\\User', 4, 'auth_token', 'e36e2e4c03ed904802bd3cfd4fc771cc92be6de4081a9cd59b2a03ecd55b4949', '[\"*\"]', NULL, NULL, '2023-06-25 14:30:06', '2023-06-25 14:30:06'),
(4, 'App\\Models\\User', 5, 'auth_token', 'eb70781cce0ee64ea2ca25587ccca0552d441b11910dc333d3fb66eefa9d2ffc', '[\"*\"]', NULL, NULL, '2023-06-25 14:34:56', '2023-06-25 14:34:56'),
(5, 'App\\Models\\User', 6, 'auth_token', 'db836a08bc72c575fe228dbd42cd4ba0b95378479943822bbc3727706c2e79db', '[\"*\"]', NULL, NULL, '2023-06-25 14:40:57', '2023-06-25 14:40:57'),
(6, 'App\\Models\\User', 6, 'auth_token', 'e8d00ceccb3364deb19bc2d7943e53a2d181c3eb675389e9da39c00d65d911ab', '[\"*\"]', NULL, NULL, '2023-06-25 19:03:16', '2023-06-25 19:03:16'),
(7, 'App\\Models\\User', 6, 'auth_token', '3a14b500c8fca869905ba01381f0d99f2084099c41f0ccc9e02c7cce2f2191b4', '[\"*\"]', NULL, NULL, '2023-06-25 19:04:32', '2023-06-25 19:04:32'),
(8, 'App\\Models\\User', 6, 'auth_token', 'b597176b48c57a46923b616caf1b9e1a18a46dd76fabe7290d8275f1c3d81139', '[\"*\"]', NULL, NULL, '2023-06-25 19:04:47', '2023-06-25 19:04:47'),
(9, 'App\\Models\\User', 4, 'auth_token', '0bd154f50d759cf5d7a70119c576d9c3f87e6452a12355fc9f6aea0f564c2994', '[\"*\"]', NULL, NULL, '2023-06-25 19:10:26', '2023-06-25 19:10:26'),
(10, 'App\\Models\\User', 4, 'auth_token', '586be4e0063cd40314f83d2ccba6d0141a050ef4b97cb8db2b3b952cf740e731', '[\"*\"]', NULL, NULL, '2023-06-25 19:12:21', '2023-06-25 19:12:21'),
(11, 'App\\Models\\User', 4, 'auth_token', '575dc563aaada9e561a9484a502d02c9bec735eb53ddfd31c7d5f8cb7b94c6f6', '[\"*\"]', NULL, NULL, '2023-06-25 19:12:49', '2023-06-25 19:12:49'),
(12, 'App\\Models\\User', 4, 'auth_token', 'a4fe9ecff4bafd67d1192149fe1151d44a194328cc4237d4e0ce47cea9f2fbf7', '[\"*\"]', NULL, NULL, '2023-06-25 19:14:34', '2023-06-25 19:14:34'),
(13, 'App\\Models\\User', 4, 'auth_token', '70b882294b242cfde6d6b583f7c1fa7b394debada07212cd08b8209ad68227e4', '[\"*\"]', NULL, NULL, '2023-06-25 20:10:22', '2023-06-25 20:10:22'),
(14, 'App\\Models\\User', 4, 'auth_token', '95e04c0c0a65f5424b73c20c91677ae709f71669a9338448414a4bcab535fa85', '[\"*\"]', NULL, NULL, '2023-06-25 20:37:12', '2023-06-25 20:37:12'),
(15, 'App\\Models\\User', 4, 'auth_token', '0e086214c65961de79c241d1ecfefb01333ae2e7a33678998037654ab6ec821f', '[\"*\"]', NULL, NULL, '2023-06-25 20:44:16', '2023-06-25 20:44:16'),
(16, 'App\\Models\\User', 4, 'auth_token', '200b2ec80a2065af4eda5980c318dae98e1aa9911125b597bcbd2de549c3b937', '[\"*\"]', NULL, NULL, '2023-06-25 21:03:31', '2023-06-25 21:03:31'),
(17, 'App\\Models\\User', 4, 'auth_token', '8526a1b2fe4d0d39d1ff1f86a09807d0bc6d8624b61ad592b6e5a148833922bc', '[\"*\"]', NULL, NULL, '2023-06-25 21:04:41', '2023-06-25 21:04:41'),
(18, 'App\\Models\\User', 4, 'auth_token', '1a42bb03e244d5dfb9639b8449ce736a2e7927ed7741894f5ba94785a303f55f', '[\"*\"]', NULL, NULL, '2023-06-25 21:05:02', '2023-06-25 21:05:02'),
(19, 'App\\Models\\User', 4, 'auth_token', 'c58a11b40948400622cf506e58cc5102585f757f95997b79f70a98ef28ac839d', '[\"*\"]', NULL, NULL, '2023-06-25 21:05:34', '2023-06-25 21:05:34'),
(20, 'App\\Models\\User', 4, 'auth_token', 'd0938bba63c4d6b5b4ffacaa1078febc15963c3c106e579246dc4426790522de', '[\"*\"]', NULL, NULL, '2023-06-25 21:06:11', '2023-06-25 21:06:11'),
(21, 'App\\Models\\User', 4, 'auth_token', '37b705eb6fbeb7e97665f2a8966a863dcda3256b5fced8833edc3a9624ab0774', '[\"*\"]', NULL, NULL, '2023-06-25 21:06:52', '2023-06-25 21:06:52');

-- --------------------------------------------------------

--
-- Structure de la table `pratiques`
--

CREATE TABLE `pratiques` (
  `id` int NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `description` text,
  `fichier_uri` varchar(130) DEFAULT NULL,
  `entreprise_id` int NOT NULL DEFAULT '0',
  `user_id` int NOT NULL DEFAULT '0',
  `annee` int NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rapports`
--

CREATE TABLE `rapports` (
  `id` int NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `description` text,
  `fichier_uri` varchar(130) DEFAULT NULL,
  `entreprise_id` int NOT NULL DEFAULT '0',
  `user_id` int NOT NULL DEFAULT '0',
  `annee` int NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Administrateur'),
(2, 'Entreprise');

-- --------------------------------------------------------

--
-- Structure de la table `secteurs`
--

CREATE TABLE `secteurs` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `secteurs`
--

INSERT INTO `secteurs` (`id`, `name`) VALUES
(1, 'Opérateurs réseaux '),
(2, 'Fabricants d’équipements informatiques '),
(3, 'Centre des données ');

-- --------------------------------------------------------

--
-- Structure de la table `slides`
--

CREATE TABLE `slides` (
  `id` int NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `caption` text,
  `image_uri` varchar(100) DEFAULT NULL,
  `active` tinyint NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `slides`
--

INSERT INTO `slides` (`id`, `name`, `caption`, `image_uri`, `active`, `created_at`, `updated_at`) VALUES
(1, 'Nous sommes le numerique', 'We are digital', 'slides/1686059421.jpg', 1, '2023-06-06 13:50:21', '2023-06-06 13:50:21');

-- --------------------------------------------------------

--
-- Structure de la table `sources`
--

CREATE TABLE `sources` (
  `id` int NOT NULL,
  `e2c` double NOT NULL DEFAULT '0',
  `ge` double NOT NULL DEFAULT '0',
  `er` double NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `sources`
--

INSERT INTO `sources` (`id`, `e2c`, `ge`, `er`) VALUES
(1, 87, 11, 2);

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE `tags` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `textes`
--

CREATE TABLE `textes` (
  `id` int NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `description` text,
  `fichier_uri` varchar(130) DEFAULT NULL,
  `entreprise_id` int NOT NULL DEFAULT '0',
  `user_id` int NOT NULL DEFAULT '0',
  `annee` int NOT NULL DEFAULT '0',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `tindicateurs`
--

CREATE TABLE `tindicateurs` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `unite` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `tindicateurs`
--

INSERT INTO `tindicateurs` (`id`, `name`, `unite`) VALUES
(1, 'consommation d\'électricité ', 'Kwh'),
(2, 'consommation eau ', 'm3'),
(3, 'Emission de Gaz à effet de serre ', 'KtCO2e');

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE `types` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int NOT NULL DEFAULT '4',
  `active` tinyint(1) NOT NULL DEFAULT '1',
  `entreprise_id` int NOT NULL DEFAULT '0',
  `email` varchar(90) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `role_id`, `active`, `entreprise_id`, `email`, `password`, `last_login`, `created_at`, `updated_at`, `token`) VALUES
(1, 'Admin', '0678999999', 1, 1, 0, 'admin@admin.cg', '$2y$10$44Z2w82lhNMH6IZZ5zMj9OEQFsXRnMET8vnA15UmzMj5HzNRLsOEq', NULL, '2019-05-30 21:35:40', '2019-05-30 21:35:40', 'c4ca4238a0b923820dcc509a6f75849b'),
(12, 'Administrateur', '064567878', 1, 1, 0, 'admin@observatoire.cg', '$2y$10$FjrtIZZffeLA5qtTPvyU.eeWBkbqQBZiB6gyFMoTUfF7xMiOyJs26', NULL, NULL, NULL, '86b83e2c14dfe66e18e8c838d17036b44408e2d7'),
(15, 'Danielle', '068764530', 2, 1, 4, 'danielle.ouanounga@arpce.cg', '$2y$10$gEJgvULCEy5CTj0yF/Jm2uvsSPn8q5xdvZzwMa57EEQLM1bP3/7R2', NULL, NULL, NULL, '2973593be92f970746f1835cc55f90632037fb04'),
(17, 'ARPCE', '06 836 75 75', 2, 1, 4, 'stany.louvouezo@arpce.cg', '$2y$10$veRMiq2hjz452Lcpi7eZYu8UGtbQdqzdwfdBPiFQrMygs1mvBV0Iy', NULL, NULL, NULL, '7257af4480027af5fc8a7b34e8f193c5ac29d1f8'),
(18, 'CONGO TELECOM', '226 010 457', 2, 1, 5, 'simon.babedila@congotelecom.cg', '$2y$10$aLbfNdBj4lHGJiZOjgpeE..rPXERctqpuCdGThuFWPEbHfryPTmvO', NULL, NULL, NULL, '8bd6a12f0dfd31d6368cbbed51bd9b25d899ef21'),
(19, 'MTN-CONGO', '066691333', 2, 1, 6, 'Helga.OSSENZA@mtn.com', '$2y$10$9h0AG2dAp0q6QCt3Fom6xuigsuZrsTFCbksSWgxs49a0ece4.6lum', NULL, NULL, NULL, '5dc29ad4c7d9e5fd157e4254f003a5308c541d97'),
(20, 'Airtel Congo S.A', '+242 05 500 90 05', 2, 1, 7, 'sandra.becale@cg.airtel.com', '$2y$10$WYNOnW7wCDsyHyObT/2aOO3Lq5U2yg0TGlfa0OWfsrMkf.K0KGYzi', NULL, NULL, NULL, '6847e948de8b57167f7c75c322856503c83f85d0'),
(21, 'ARAP (Agence de Régulation de l\'Aval Pétrolier)', '069423443', 2, 1, 8, 'e.tchicaillat@arap.cg', '$2y$10$YO5Zr.DzctWOf5nyQ3/i6ukNwYb4dpqvAa1EQRxxGZqCLzV9I.l3W', NULL, NULL, NULL, '6acd57ef56b2759dd0ccf66bf7587720d4be2343'),
(22, 'MCUH (Ministère de la construction, de l\'urbanisme et de l\'habitat)', '066726086', 2, 1, 9, 'wilfridngamba@gmail.com', '$2y$10$74XoGmYGT1ck/7b7pb845.APBxiwXGg5klaYXANTKsrSHtMlTBQb6', NULL, NULL, NULL, '603e2f0b87112c677c2b5cfac4b19610c1375058');

-- --------------------------------------------------------

--
-- Structure de la table `users_old`
--

CREATE TABLE `users_old` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int NOT NULL DEFAULT '2',
  `entreprise_id` int NOT NULL DEFAULT '0',
  `active` int NOT NULL DEFAULT '1',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users_old`
--

INSERT INTO `users_old` (`id`, `name`, `phone`, `role_id`, `entreprise_id`, `active`, `email`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `two_factor_confirmed_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Solange Abena', NULL, 2, 0, 1, 'solabena@gmail.com', NULL, '$2y$10$aAoYyiNIM8ByMM5tBpad..V4BosZSwXsEpkNH1G2BCh5vCuYhkpmi', NULL, NULL, NULL, NULL, '2023-06-25 13:15:17', '2023-06-25 13:15:17'),
(2, 'Asalfo ruben', NULL, 2, 0, 1, 'asalruben@gmail.com', NULL, '$2y$10$mWXMH.P1TFpUL/ZcmoRWlOidij4eRSeFAG35/lADPNIRrxWRtmdDe', NULL, NULL, NULL, NULL, '2023-06-25 13:32:12', '2023-06-25 13:32:12'),
(3, 'Asalfo ruben2', NULL, 2, 0, 1, 'asalruben2@gmail.com', NULL, '$2y$10$RQ.Gyimrw11XSuA.BvUtiupm7orcad.zJmWvmsOjawLViefrReC4y', NULL, NULL, NULL, NULL, '2023-06-25 14:25:55', '2023-06-25 14:25:55'),
(4, 'Essomba clement', '8923898329', 2, 1, 1, 'adminat@gmail.com', NULL, '$2y$10$26VpzfzRRArwg.u0OWk7Y.PUO62M2.fN4qeW0KRCoMxOSVDJruO8W', NULL, NULL, NULL, NULL, '2023-06-25 14:30:06', '2023-06-29 19:52:08'),
(5, 'Jojo 1', NULL, 2, 1, 1, 'jojo1@gmail.com', NULL, '$2y$10$ua8NKAF7nv4UfUqvB7UTWOIS/wW5ACDrCH1yqNjEnIYWU5vPK9hEu', NULL, NULL, NULL, NULL, '2023-06-25 14:34:56', '2023-06-25 14:34:56'),
(6, 'Assako26', NULL, 2, 2, 1, 'assako26@gmail.com', NULL, '$2y$10$FVgRmnQLlxKhr7ACAwgpz.oek0vlqDCpq.9EpjBPLO83ZIzPkvqJq', NULL, NULL, NULL, NULL, '2023-06-25 14:40:57', '2023-06-25 14:40:57'),
(7, 'Essomba Clement', '064576186', 1, 0, 1, 'clementessomba@gmail.com', '2023-07-09 00:55:58', '$2y$10$44Z2w82lhNMH6IZZ5zMj9OEQFsXRnMET8vnA15UmzMj5HzNRLsOEq', NULL, NULL, NULL, NULL, '2023-07-09 00:55:58', '2023-07-09 00:55:58');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `annees`
--
ALTER TABLE `annees`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `article_tag`
--
ALTER TABLE `article_tag`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `communes`
--
ALTER TABLE `communes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `datacenters`
--
ALTER TABLE `datacenters`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `datacenter_fiches`
--
ALTER TABLE `datacenter_fiches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `entreprises`
--
ALTER TABLE `entreprises`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Index pour la table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `fiches`
--
ALTER TABLE `fiches`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `indicateurs`
--
ALTER TABLE `indicateurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `params`
--
ALTER TABLE `params`
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
-- Index pour la table `pratiques`
--
ALTER TABLE `pratiques`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `rapports`
--
ALTER TABLE `rapports`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `secteurs`
--
ALTER TABLE `secteurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `sources`
--
ALTER TABLE `sources`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `textes`
--
ALTER TABLE `textes`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `tindicateurs`
--
ALTER TABLE `tindicateurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `types`
--
ALTER TABLE `types`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Index pour la table `users_old`
--
ALTER TABLE `users_old`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `annees`
--
ALTER TABLE `annees`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `article_tag`
--
ALTER TABLE `article_tag`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `communes`
--
ALTER TABLE `communes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `datacenters`
--
ALTER TABLE `datacenters`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `datacenter_fiches`
--
ALTER TABLE `datacenter_fiches`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `entreprises`
--
ALTER TABLE `entreprises`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `fiches`
--
ALTER TABLE `fiches`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `indicateurs`
--
ALTER TABLE `indicateurs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `params`
--
ALTER TABLE `params`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `pratiques`
--
ALTER TABLE `pratiques`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `rapports`
--
ALTER TABLE `rapports`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `secteurs`
--
ALTER TABLE `secteurs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `slides`
--
ALTER TABLE `slides`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `sources`
--
ALTER TABLE `sources`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `textes`
--
ALTER TABLE `textes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `tindicateurs`
--
ALTER TABLE `tindicateurs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `types`
--
ALTER TABLE `types`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `users_old`
--
ALTER TABLE `users_old`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
