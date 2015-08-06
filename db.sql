-- phpMyAdmin SQL Dump
-- version 4.2.10
-- http://www.phpmyadmin.net
--
-- Хост: localhost:3306
-- Время создания: Авг 06 2015 г., 15:09
-- Версия сервера: 5.5.38
-- Версия PHP: 5.6.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- База данных: `shopster`
--

-- --------------------------------------------------------

--
-- Структура таблицы `auth_assignment`
--

CREATE TABLE `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('admin', '1', 1428145829),
('admin', '2', 1428145829);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('admin', 1, 'Админ', NULL, NULL, 1428145822, 1428145822),
('user', 1, 'Пользователь', NULL, NULL, 1428145822, 1428145822);

-- --------------------------------------------------------

--
-- Структура таблицы `auth_item_child`
--

CREATE TABLE `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `auth_rule`
--

CREATE TABLE `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `banner`
--

CREATE TABLE `banner` (
`id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `banner`
--

INSERT INTO `banner` (`id`, `category`, `image`, `link`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '55a60880f108a.jpg', 'http://www.vk.com', 1, 1434824987, 1436944513),
(2, 1, '55a6107cecce5.jpg', 'http://asdasd.com', 1, 1435297836, 1436946556),
(3, 2, '558ce85411564.jpg', 'http://lol.kz', 1, 1435297876, 1435297876),
(4, 3, '55a6120ac6990.jpg', 'http://asdfasd.ru', 1, 1435297903, 1436946954),
(5, 1, '55a60d1532ad6.jpg', 'asd.ru', 1, 1435861193, 1436945685);

-- --------------------------------------------------------

--
-- Структура таблицы `category`
--

CREATE TABLE `category` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `category`
--

INSERT INTO `category` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Магазин', 1, 1432984709, 1432984757),
(2, 'Торговый центр', 1, 1432984780, 1432984780);

-- --------------------------------------------------------

--
-- Структура таблицы `city`
--

CREATE TABLE `city` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `city`
--

INSERT INTO `city` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Алматы', 1, 1432983270, 1432984397),
(2, 'Астана', 1, 1434523432, 1434839012);

-- --------------------------------------------------------

--
-- Структура таблицы `log`
--

CREATE TABLE `log` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action` text NOT NULL,
  `comment` text NOT NULL,
  `created` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `log`
--

INSERT INTO `log` (`id`, `user_id`, `action`, `comment`, `created`) VALUES
(3, 1, 'Баннер номер: 1', '{"old":{"link":"http:\\/\\/vk.com"},"new":{"link":"http:\\/\\/www.vk.com"}}', 1434838485),
(4, 1, 'Город номер: 1', '{"old":{"status":1},"new":{"status":"0"}}', 1434838540),
(5, 1, 'Город номер: 1', '{"old":{"status":0},"new":{"status":"1"}}', 1434838552),
(6, 1, 'Город номер: 2', '{"old":{"status":1},"new":{"status":"0"}}', 1434838995),
(7, 1, 'Город номер: 2', '{"old":{"status":0},"new":{"status":"1"}}', 1434839012),
(8, 1, 'Баннер номер: 1', '{"old":{"image":"5585b172a1116.jpg"},"new":{"image":"5585e7f4acff5.jpg"}}', 1434839028),
(9, 1, 'Акции номер: 2', '[]', 1434839212),
(10, 1, 'Магазины и Тц. номер: 1', '{"old":{"shops":"\\"\\"","status":1,"changes":"[]"},"new":{"shops":"[\\"2\\"]","status":0,"changes":"{\\"shops\\":\\"\\\\\\"\\\\\\"\\",\\"status\\":1}"}}', 1434839419),
(11, 1, 'Магазины и Тц. номер: 1', '{"old":{"status":0,"changes":"{\\"shops\\":\\"\\\\\\"\\\\\\"\\",\\"status\\":1}"},"new":{"status":1,"changes":"[]"}}', 1434839455),
(12, 1, 'Магазины и Тц. номер: 1', '{"old":{"longitude":76.90491413797,"category_id":2},"new":{"longitude":"76.90491413796997","category_id":"1"}}', 1434839480),
(13, 1, 'Магазины и Тц. номер: 1', '{"old":{"longitude":76.90491413797,"category_id":1},"new":{"longitude":"76.90491413796997","category_id":"2"}}', 1434839494),
(14, 1, 'Магазины и Тц. номер: 1', '[]', 1434839507),
(15, 1, 'Магазины и Тц. номер: 2', '[]', 1434839507),
(16, 1, 'Магазины и Тц. номер: 1', '{"old":{"status":1,"changes":"[]"},"new":{"status":0,"changes":"{\\"status\\":1}"}}', 1434955234),
(17, 1, 'Магазины и Тц. номер: 1', '{"old":{"status":1},"new":{"status":0}}', 1435057887),
(18, 1, 'Магазины и Тц. номер: 1', '{"old":{"status":0,"changes":"{\\"status\\":1}"},"new":{"status":1,"changes":"[]"}}', 1435122800),
(19, 1, 'Баннер номер: ', '[]', 1435297835),
(20, 1, 'Баннер номер: ', '[]', 1435297876),
(21, 1, 'Баннер номер: ', '[]', 1435297903),
(22, 5, 'Магазины и Тц. номер: 2', '{"old":{"image":"556b116460e14.jpg","banner":null,"status":1,"changes":"[]"},"new":{"image":"5592c478022de.jpg","banner":"5592c47802355.png","status":0,"changes":"{\\"image\\":\\"556b116460e14.jpg\\",\\"banner\\":null,\\"status\\":1}"}}', 1435681912),
(23, 5, 'Магазины и Тц. номер: 2', '{"old":{"image":"5592c478022de.jpg","banner":"5592c47802355.png","changes":"{\\"image\\":\\"556b116460e14.jpg\\",\\"banner\\":null,\\"status\\":1}"},"new":{"image":"5592c5da36b9b.png","banner":"5592c5da36c0c.png","changes":"{\\"image\\":\\"5592c478022de.jpg\\",\\"banner\\":\\"5592c47802355.png\\"}"}}', 1435682266),
(24, 5, 'Магазины и Тц. номер: 2', '{"old":{"image":"5592c5da36b9b.png","banner":"5592c5da36c0c.png","changes":"{\\"image\\":\\"5592c478022de.jpg\\",\\"banner\\":\\"5592c47802355.png\\"}"},"new":{"image":"5592c78198e15.png","banner":"5592c78198e82.jpg","changes":"{\\"image\\":\\"5592c5da36b9b.png\\",\\"banner\\":\\"5592c5da36c0c.png\\"}"}}', 1435682689),
(25, 5, 'Магазины и Тц. номер: 2', '{"old":{"image":"5592c78198e15.png","banner":"5592c78198e82.jpg","changes":"{\\"image\\":\\"5592c5da36b9b.png\\",\\"banner\\":\\"5592c5da36c0c.png\\"}"},"new":{"image":"5592c8255aeac.png","banner":"5592c8255af39.jpg","changes":"{\\"image\\":\\"5592c78198e15.png\\",\\"banner\\":\\"5592c78198e82.jpg\\"}"}}', 1435682853),
(26, 1, 'Магазины и Тц. номер: 2', '{"old":{"status":0,"changes":"{\\"image\\":\\"5592c78198e15.png\\",\\"banner\\":\\"5592c78198e82.jpg\\"}"},"new":{"status":1,"changes":"[]"}}', 1435818063),
(27, 1, 'Магазины и Тц. номер: 1', '[]', 1435818071),
(28, 1, 'Магазины и Тц. номер: 2', '[]', 1435818071),
(29, 1, 'Магазины и Тц. номер: 2', '{"old":{"image":"5592c8255aeac.png"},"new":{"image":"55957a9e5f321.jpg"}}', 1435859614),
(30, 1, 'Баннер номер: ', '[]', 1435861193),
(31, 1, 'Баннер номер: 5', '{"old":{"image":""},"new":{"image":"559580dfe7f9c.jpg"}}', 1435861215),
(32, 1, 'Магазины и Тц. номер: 2', '{"old":{"image":"55957a9e5f321.jpg"},"new":{"image":"559580fe51fd3.jpg"}}', 1435861246),
(33, 1, 'Магазины и Тц. номер: 2', '{"old":{"image":"559580fe51fd3.jpg"},"new":{"image":"559582a3846b1.jpg"}}', 1435861667),
(34, 1, 'Магазины и Тц. номер: 2', '{"old":{"image":"559582a3846b1.jpg"},"new":{"image":"5595830c258aa.jpg"}}', 1435861772),
(35, 1, 'Магазины и Тц. номер: 2', '{"old":{"image":"5595830c258aa.jpg"},"new":{"image":"5595835ba32e3.jpg"}}', 1435861851),
(36, 1, 'Магазины и Тц. номер: 1', '{"old":{"status":1,"changes":"[]"},"new":{"status":0,"changes":"{\\"status\\":1}"}}', 1435862077),
(37, 1, 'Магазины и Тц. номер: 1', '{"old":{"map":"","changes":"{\\"status\\":1}"},"new":{"map":"559585582dc9f.jpg","changes":"{\\"map\\":\\"\\"}"}}', 1435862360),
(38, 1, 'Магазины и Тц. номер: 1', '{"old":{"longitude":76.90491413797,"map":"559585582dc9f.jpg"},"new":{"longitude":"76.90491413796997","map":"5595862771f75.jpg"}}', 1435862567),
(39, 1, 'Магазины и Тц. номер: 1', '{"old":{"longitude":76.90491413797,"map":"5595862771f75.jpg"},"new":{"longitude":"76.90491413796997","map":"5595869575323.jpg"}}', 1435862677),
(40, 1, 'Магазины и Тц. номер: 1', '{"old":{"longitude":76.90491413797,"map":"5595869575323.jpg"},"new":{"longitude":"76.90491413796997","map":"55958778ce064.jpg"}}', 1435862904),
(41, 1, 'Магазины и Тц. номер: 2', '{"old":{"map":null},"new":{"map":"5595878fbdcca.jpg"}}', 1435862927),
(42, 1, 'Магазины и Тц. номер: 1', '{"old":{"longitude":76.90491413797,"map":"55958778ce064.jpg"},"new":{"longitude":"76.90491413796997","map":"559587aa7db21.jpg"}}', 1435862954),
(43, 1, 'Магазины и Тц. номер: 1', '{"old":{"status":0,"changes":"{\\"map\\":\\"\\"}"},"new":{"status":1,"changes":"[]"}}', 1435862958),
(44, 1, 'Магазины и Тц. номер: 1', '{"old":{"latitude":43.215681559563,"longitude":76.90491413797,"status":1,"changes":"[]"},"new":{"latitude":"43.218777794848556","longitude":"76.90126633370971","status":0,"changes":"{\\"latitude\\":43.215681559563,\\"longitude\\":76.90491413797,\\"status\\":1}"}}', 1435863053),
(45, 1, 'Магазины и Тц. номер: 1', '{"old":{"map":"559587aa7db21.jpg","changes":"{\\"latitude\\":43.215681559563,\\"longitude\\":76.90491413797,\\"status\\":1}"},"new":{"map":"5595881b750e4.jpg","changes":"{\\"latitude\\":43.215681559563,\\"longitude\\":76.90491413797,\\"status\\":1,\\"map\\":\\"559587aa7db21.jpg\\"}"}}', 1435863067),
(46, 5, 'Акции номер: 2', '{"old":{"description":"test","status":1},"new":{"description":"\\u0410\\u043a\\u0446\\u0438\\u044f","status":0}}', 1436449027),
(47, 1, 'Магазины и Тц. номер: 1', '{"old":{"status":0,"changes":"{\\"latitude\\":43.215681559563,\\"longitude\\":76.90491413797,\\"status\\":1,\\"map\\":\\"559587aa7db21.jpg\\"}"},"new":{"status":1,"changes":"[]"}}', 1436449086),
(48, 1, 'Акции номер: 2', '{"old":{"status":0},"new":{"status":1}}', 1436449094),
(49, 1, 'Магазины и Тц. номер: 1', '{"old":{"map":"5595881b750e4.jpg","status":1,"changes":"[]"},"new":{"map":"559e7aa353802.jpg","status":0,"changes":"{\\"map\\":\\"5595881b750e4.jpg\\",\\"status\\":1}"}}', 1436449443),
(50, 1, 'Магазины и Тц. номер: 1', '{"old":{"status":0,"changes":"{\\"map\\":\\"5595881b750e4.jpg\\",\\"status\\":1}"},"new":{"status":1,"changes":"[]"}}', 1436449597),
(51, 1, 'Магазины и Тц. номер: 1', '{"old":{"longitude":76.90126633371,"map":"559e7aa353802.jpg","status":1,"changes":"[]"},"new":{"longitude":"76.90126633371005","map":"559f09c27c855.jpg","status":0,"changes":"{\\"longitude\\":76.90126633371,\\"map\\":\\"559e7aa353802.jpg\\",\\"status\\":1}"}}', 1436486082),
(52, 1, 'Магазины и Тц. номер: 1', '{"old":{"longitude":76.90126633371,"map":"559f09c27c855.jpg","changes":"{\\"longitude\\":76.90126633371,\\"map\\":\\"559e7aa353802.jpg\\",\\"status\\":1}"},"new":{"longitude":"76.90126633371005","map":"559f09dd38a3d.jpg","changes":"{\\"longitude\\":76.90126633371,\\"map\\":\\"559f09c27c855.jpg\\"}"}}', 1436486109),
(53, 1, 'Магазины и Тц. номер: 1', '{"old":{"longitude":76.90126633371,"map":"559f09dd38a3d.jpg","changes":"{\\"longitude\\":76.90126633371,\\"map\\":\\"559f09c27c855.jpg\\"}"},"new":{"longitude":"76.90126633371005","map":"559f09fdbcf85.jpg","changes":"{\\"longitude\\":76.90126633371,\\"map\\":\\"559f09dd38a3d.jpg\\"}"}}', 1436486141),
(54, 1, 'Магазины и Тц. номер: 1', '{"old":{"status":0,"changes":"{\\"longitude\\":76.90126633371,\\"map\\":\\"559f09dd38a3d.jpg\\"}"},"new":{"status":1,"changes":"[]"}}', 1436486286),
(55, 1, 'Магазины и Тц. номер: 1', '{"old":{"map":"559f09fdbcf85.jpg","status":1,"changes":"[]"},"new":{"map":"55a510e727675.jpg","status":0,"changes":"{\\"map\\":\\"559f09fdbcf85.jpg\\",\\"status\\":1}"}}', 1436881127),
(56, 1, 'Магазины и Тц. номер: 1', '{"old":{"status":0,"changes":"{\\"map\\":\\"559f09fdbcf85.jpg\\",\\"status\\":1}"},"new":{"status":1,"changes":"[]"}}', 1436881158),
(57, 1, 'Акции номер: 1', '{"old":{"description":"test","status":1},"new":{"description":"\\u0410\\u043a\\u0446\\u0438\\u044f Green","status":0}}', 1436881243),
(58, 1, 'Акции номер: 1', '{"old":{"image":"556abed190e24.jpg"},"new":{"image":"55a5132330b1f.jpg"}}', 1436881699),
(59, 1, 'Акции номер: 1', '[]', 1436881739),
(60, 1, 'Акции номер: 1', '{"old":{"status":0},"new":{"status":1}}', 1436881746),
(61, 1, 'Магазины и Тц. номер: ', '[]', 1436882831),
(62, 1, 'Магазины и Тц. номер: ', '[]', 1436882956),
(63, 1, 'Магазины и Тц. номер: ', '[]', 1436883240),
(64, 1, 'Баннер номер: 1', '[]', 1436943469),
(65, 1, 'Баннер номер: 1', '{"old":{"image":"5585e7f4acff5.jpg"},"new":{"image":"55a6049c7b192.jpg"}}', 1436943516),
(66, 1, 'Категории магазинов номер: ', '[]', 1436944049),
(67, 1, 'Категории магазинов номер: ', '[]', 1436944069),
(68, 1, 'Категории магазинов номер: ', '[]', 1436944095),
(69, 1, 'Категории магазинов номер: ', '[]', 1436944113),
(70, 1, 'Категории магазинов номер: 6', '{"old":{"status":0},"new":{"status":"1"}}', 1436944197),
(71, 1, 'Баннер номер: 1', '{"old":{"image":"55a6049c7b192.jpg"},"new":{"image":"55a60880f108a.jpg"}}', 1436944513),
(72, 1, 'Баннер номер: 2', '{"old":{"image":"558ce82bdb3b5.jpg"},"new":{"image":"55a60a0035fc3.jpg"}}', 1436944896),
(73, 1, 'Баннер номер: 2', '[]', 1436944937),
(74, 1, 'Баннер номер: 2', '{"old":{"image":"55a60a0035fc3.jpg"},"new":{"image":"55a60a5101422.jpg"}}', 1436944977),
(75, 1, 'Баннер номер: 2', '{"old":{"image":"55a60a5101422.jpg"},"new":{"image":"55a60bdd10efa.jpg"}}', 1436945373),
(76, 1, 'Баннер номер: 2', '{"old":{"image":"55a60bdd10efa.jpg"},"new":{"image":"55a60c82959e0.jpg"}}', 1436945538),
(77, 1, 'Баннер номер: 2', '{"old":{"image":"55a60c82959e0.jpg"},"new":{"image":"55a60cc96592f.jpg"}}', 1436945609),
(78, 1, 'Баннер номер: 5', '{"old":{"image":"559580dfe7f9c.jpg"},"new":{"image":"55a60d1532ad6.jpg"}}', 1436945685),
(79, 1, 'Магазины и Тц. номер: 5', '{"old":{"description":"","phone":"","status":0},"new":{"description":"\\u0444\\u044b\\u0432","phone":"+7 (123) 12-31-231","status":"1"}}', 1436946287),
(80, 1, 'Магазины и Тц. номер: 5', '{"old":{"map":"55a5192828bca.jpg"},"new":{"map":"55a60f89daa6e.jpg"}}', 1436946313),
(81, 1, 'Баннер номер: 2', '{"old":{"image":"55a60cc96592f.jpg"},"new":{"image":"55a6107cecce5.jpg"}}', 1436946556),
(82, 1, 'Баннер номер: 4', '{"old":{"image":"558ce86f3ce1b.jpg"},"new":{"image":"55a6120ac6990.jpg"}}', 1436946954),
(83, 1, 'Магазины и Тц. номер: 2', '{"old":{"user_id":5,"title":"Intertop 2","image":"5595835ba32e3.jpg","banner":"5592c8255af39.jpg","map":"5595878fbdcca.jpg","shop_category_id":1},"new":{"user_id":"1","title":"Intertop","image":"55a61676091c9.png","banner":"55a6167609243.jpg","map":"55a61676092c0.png","shop_category_id":"5"}}', 1436948086),
(84, 1, 'Акции номер: 2', '{"old":{"image":"556b152f20748.jpg"},"new":{"image":"55a616d6aa55b.png"}}', 1436948182),
(85, 1, 'Акции номер: 2', '{"old":{"image":"55a616d6aa55b.png","duration":"2015-06-30"},"new":{"image":"55a617852007f.jpg","duration":"2015-07-30"}}', 1436948357),
(86, 1, 'Акции номер: 2', '{"old":{"image":"55a617852007f.jpg"},"new":{"image":"55a6187adcf40.png"}}', 1436948602),
(87, 1, 'Акции номер: 2', '{"old":{"image":"55a6187adcf40.png"},"new":{"image":"55a61bcc4df79.jpg"}}', 1436949452),
(88, 1, 'Акции номер: 2', '{"old":{"description":"\\u0410\\u043a\\u0446\\u0438\\u044f"},"new":{"description":"70% \\u043d\\u0430 \\u0437\\u0438\\u043c\\u043d\\u044e\\u044e \\u043a\\u043e\\u043b\\u043b\\u0435\\u043a\\u0446\\u0438\\u044e \\u0436\\u0435\\u043d\\u0441\\u043a\\u043e\\u0439, \\u043c\\u0443\\u0436\\u0441\\u043a\\u043e\\u0439 \\u0438 \\u0434\\u0435\\u0442\\u0441\\u043a\\u043e\\u0439 \\u043e\\u0431\\u0443\\u0432\\u0438 \\u0432 Intertop \\u0434\\u043e 30.07.15!!!!!!!"}}', 1436949654),
(89, 1, 'Акции номер: 2', '{"old":{"description":"70% \\u043d\\u0430 \\u0437\\u0438\\u043c\\u043d\\u044e\\u044e \\u043a\\u043e\\u043b\\u043b\\u0435\\u043a\\u0446\\u0438\\u044e \\u0436\\u0435\\u043d\\u0441\\u043a\\u043e\\u0439, \\u043c\\u0443\\u0436\\u0441\\u043a\\u043e\\u0439 \\u0438 \\u0434\\u0435\\u0442\\u0441\\u043a\\u043e\\u0439 \\u043e\\u0431\\u0443\\u0432\\u0438 \\u0432 Intertop \\u0434\\u043e 30.07.15!!!!!!!"},"new":{"description":"70% \\u043d\\u0430 \\u0437\\u0438\\u043c\\u043d\\u044e\\u044e \\u043a\\u043e\\u043b\\u043b\\u0435\\u043a\\u0446\\u0438\\u044e \\u0436\\u0435\\u043d\\u0441\\u043a\\u043e\\u0439, \\u043c\\u0443\\u0436\\u0441\\u043a\\u043e\\u0439 \\u0438 \\u0434\\u0435\\u0442\\u0441\\u043a\\u043e\\u0439 \\u043e\\u0431\\u0443\\u0432\\u0438 \\u0432 Intertop \\u0434\\u043e 30.07.15!"}}', 1436949817),
(90, 1, 'Категории магазинов номер: ', '[]', 1436950407),
(91, 1, 'Магазины и Тц. номер: ', '[]', 1436951245),
(92, 1, 'Магазины и Тц. номер: ', '[]', 1436951446),
(93, 1, 'Магазины и Тц. номер: 7', '{"old":{"banner":null,"shops":"[\\"6\\"]"},"new":{"banner":"55a6242391dcb.jpg","shops":"\\"\\""}}', 1436951587),
(94, 1, 'Магазины и Тц. номер: 7', '{"old":{"shops":"\\"\\""},"new":{"shops":"[\\"1\\"]"}}', 1436951715),
(95, 1, 'Магазины и Тц. номер: ', '[]', 1436953784),
(96, 1, 'Магазины и Тц. номер: 2', '{"old":{"map":"55a61676092c0.png","shops":"[\\"1\\"]"},"new":{"map":"55a66d4274384.jpg","shops":"\\"\\""}}', 1436970306),
(97, 1, 'Магазины и Тц. номер: ', '[]', 1437043856),
(98, 1, 'Акции номер: ', '[]', 1437156050),
(99, 1, 'Акции номер: 1', '[]', 1437156147),
(100, 1, 'Акции номер: 1', '{"old":{"content_id":1},"new":{"content_id":"7"}}', 1437329854),
(101, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":""},"new":{"maps":"[\\"55abfa133c327.jpg\\"]"}}', 1437334035),
(102, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"[\\"55abfa133c327.jpg\\"]"},"new":{"maps":"[\\"55abfa133c327.jpg\\",\\"55abfa54941cd.jpg\\"]"}}', 1437334100),
(103, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"[\\"55abfa133c327.jpg\\",\\"55abfa54941cd.jpg\\"]"},"new":{"maps":"[\\"55abfa133c327.jpg\\",\\"55abfa54941cd.jpg\\",\\"55abfc5ee73b5.jpg\\"]"}}', 1437334623),
(104, 1, 'Магазины и Тц. номер: 9', '[]', 1437334804),
(105, 1, 'Магазины и Тц. номер: 9', '[]', 1437334818),
(106, 1, 'Магазины и Тц. номер: 9', '[]', 1437334818),
(107, 1, 'Магазины и Тц. номер: 9', '[]', 1437334818),
(108, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"[\\"55abfa133c327.jpg\\",\\"55abfa54941cd.jpg\\",\\"55abfc5ee73b5.jpg\\"]"},"new":{"maps":"{\\"0\\":\\"55abfa133c327.jpg\\",\\"2\\":\\"55abfc5ee73b5.jpg\\"}"}}', 1437335165),
(109, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"0\\":\\"55abfa133c327.jpg\\",\\"2\\":\\"55abfc5ee73b5.jpg\\"}"},"new":{"maps":"[\\"55abfa133c327.jpg\\"]"}}', 1437335170),
(110, 1, 'Магазины и Тц. номер: 9', '[]', 1437335496),
(111, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"[\\"55abfa133c327.jpg\\"]"},"new":{"maps":"[\\"55abfa133c327.jpg\\",\\"55abffe3dfec1.jpg\\"]"}}', 1437335524),
(112, 1, 'Магазины и Тц. номер: 9', '[]', 1437335831),
(113, 1, 'Магазины и Тц. номер: 9', '[]', 1437335836),
(114, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"[\\"55abfa133c327.jpg\\",\\"55abffe3dfec1.jpg\\"]"},"new":{"maps":"{\\"1\\":\\"55abffe3dfec1.jpg\\",\\"undefined\\":\\"55abfa133c327.jpg\\"}"}}', 1437335865),
(115, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"1\\":\\"55abffe3dfec1.jpg\\",\\"undefined\\":\\"55abfa133c327.jpg\\"}"},"new":{"maps":"{\\"undefined\\":\\"55abfa133c327.jpg\\",\\"1\\":\\"55abffe3dfec1.jpg\\"}"}}', 1437335950),
(116, 1, 'Магазины и Тц. номер: 9', '[]', 1437335954),
(117, 1, 'Магазины и Тц. номер: 9', '[]', 1437335965),
(118, 1, 'Магазины и Тц. номер: 9', '[]', 1437335982),
(119, 1, 'Магазины и Тц. номер: 9', '[]', 1437336009),
(120, 1, 'Магазины и Тц. номер: 9', '[]', 1437336028),
(121, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"undefined\\":\\"55abfa133c327.jpg\\",\\"1\\":\\"55abffe3dfec1.jpg\\"}"},"new":{"maps":"{\\"undefined\\":\\"55abfa133c327.jpg\\",\\"12\\":\\"55abffe3dfec1.jpg\\"}"}}', 1437336048),
(122, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"undefined\\":\\"55abfa133c327.jpg\\",\\"12\\":\\"55abffe3dfec1.jpg\\"}"},"new":{"maps":"{\\"undefined\\":\\"55abffe3dfec1.jpg\\"}"}}', 1437336060),
(123, 1, 'Магазины и Тц. номер: 9', '[]', 1437336066),
(124, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"undefined\\":\\"55abffe3dfec1.jpg\\"}"},"new":{"maps":"{\\"undefined\\":\\"55abffe3dfec1.jpg\\",\\"0\\":\\"55ac0229c022f.jpg\\"}"}}', 1437336105),
(125, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"55abffe3dfec1.jpg\\",\\"55ac0229c022f.jpg\\"}"},"new":{"maps":"[\\"55ac029722331.jpg\\"]"}}', 1437336215),
(126, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"[\\"55ac029722331.jpg\\"]"},"new":{"maps":"[\\"55ac029722331.jpg\\",\\"55ac02af5acb5.jpg\\"]"}}', 1437336239),
(127, 1, 'Магазины и Тц. номер: 9', '[]', 1437336244),
(128, 1, 'Магазины и Тц. номер: 9', '[]', 1437336254),
(129, 1, 'Магазины и Тц. номер: 9', '[]', 1437336301),
(130, 1, 'Магазины и Тц. номер: 9', '[]', 1437336308),
(131, 1, 'Магазины и Тц. номер: 9', '[]', 1437336336),
(132, 1, 'Магазины и Тц. номер: 9', '[]', 1437336338),
(133, 1, 'Магазины и Тц. номер: 9', '[]', 1437336358),
(134, 1, 'Магазины и Тц. номер: 9', '[]', 1437336370),
(135, 1, 'Магазины и Тц. номер: 9', '[]', 1437336372),
(136, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"[\\"55ac029722331.jpg\\",\\"55ac02af5acb5.jpg\\"]"},"new":{"maps":"{\\"1\\":\\"55ac02af5acb5.jpg\\",\\"undefined\\":\\"55ac029722331.jpg\\"}"}}', 1437336413),
(137, 1, 'Магазины и Тц. номер: 9', '[]', 1437336417),
(138, 1, 'Магазины и Тц. номер: 9', '[]', 1437336420),
(139, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"1\\":\\"55ac02af5acb5.jpg\\",\\"2\\":\\"55ac029722331.jpg\\"}"},"new":{"maps":"{\\"2\\":\\"55ac029722331.jpg\\",\\"undefined\\":\\"55ac02af5acb5.jpg\\"}"}}', 1437336473),
(140, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"2\\":\\"55ac029722331.jpg\\",\\"undefined\\":\\"55ac02af5acb5.jpg\\"}"},"new":{"maps":"{\\"undefined\\":\\"55ac029722331.jpg\\"}"}}', 1437336501),
(141, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"0\\":\\"55ac029722331.jpg\\"}"},"new":{"maps":"{\\"undefined\\":\\"55ac029722331.jpg\\"}"}}', 1437336561),
(142, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"undefined\\":\\"55ac029722331.jpg\\"}"},"new":{"maps":"{\\"undefined\\":\\"55ac029722331.jpg\\",\\"0\\":\\"55ac0417caf16.jpg\\"}"}}', 1437336599),
(143, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"undefined\\":\\"55ac029722331.jpg\\",\\"0\\":\\"55ac0417caf16.jpg\\"}"},"new":{"maps":"{\\"undefined\\":\\"55ac0417caf16.jpg\\"}"}}', 1437336605),
(144, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"undefined\\":\\"55ac0417caf16.jpg\\"}"},"new":{"maps":"[]"}}', 1437336624),
(145, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"[]"},"new":{"maps":"[\\"55ac044694ba2.jpg\\"]"}}', 1437336646),
(146, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"[\\"55ac044694ba2.jpg\\"]"},"new":{"maps":"[\\"55ac044694ba2.jpg\\",\\"55ac044d961ba.jpg\\"]"}}', 1437336653),
(147, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"[\\"55ac044694ba2.jpg\\",\\"55ac044d961ba.jpg\\"]"},"new":{"maps":"[\\"55ac044694ba2.jpg\\",\\"55ac044d961ba.jpg\\",\\"55ac057ba6f12.jpg\\"]"}}', 1437336955),
(148, 1, 'Магазины и Тц. номер: 9', '[]', 1437336962),
(149, 1, 'Магазины и Тц. номер: 9', '{"old":{"changes":""},"new":{"changes":"[]"}}', 1437336965),
(150, 1, 'Магазины и Тц. номер: 9', '[]', 1437336968),
(151, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"[\\"55ac044694ba2.jpg\\",\\"55ac044d961ba.jpg\\",\\"55ac057ba6f12.jpg\\"]"},"new":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"1\\":\\"55ac044d961ba.jpg\\",\\"3\\":\\"55ac057ba6f12.jpg\\"}"}}', 1437337047),
(152, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"1\\":\\"55ac044d961ba.jpg\\",\\"3\\":\\"55ac057ba6f12.jpg\\"}"},"new":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"1\\":\\"55ac044d961ba.jpg\\",\\"4\\":\\"55ac057ba6f12.jpg\\"}"}}', 1437337051),
(153, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"1\\":\\"55ac044d961ba.jpg\\",\\"4\\":\\"55ac057ba6f12.jpg\\"}"},"new":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"1\\":\\"55ac044d961ba.jpg\\",\\"5\\":\\"55ac057ba6f12.jpg\\"}"}}', 1437337056),
(154, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"1\\":\\"55ac044d961ba.jpg\\",\\"5\\":\\"55ac057ba6f12.jpg\\"}"},"new":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"1\\":\\"55ac044d961ba.jpg\\",\\"3\\":\\"55ac057ba6f12.jpg\\"}"}}', 1437337078),
(155, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"1\\":\\"55ac044d961ba.jpg\\",\\"3\\":\\"55ac057ba6f12.jpg\\"}"},"new":{"maps":"[\\"55ac044694ba2.jpg\\",\\"55ac044d961ba.jpg\\",\\"55ac057ba6f12.jpg\\"]"}}', 1437337081),
(156, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"[\\"55ac044694ba2.jpg\\",\\"55ac044d961ba.jpg\\",\\"55ac057ba6f12.jpg\\"]"},"new":{"maps":"[\\"55ac044694ba2.jpg\\",\\"55ac057ba6f12.jpg\\"]"}}', 1437337086),
(157, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"[\\"55ac044694ba2.jpg\\",\\"55ac057ba6f12.jpg\\"]"},"new":{"maps":"[\\"55ac044694ba2.jpg\\",\\"55ac057ba6f12.jpg\\",\\"55ac060e8730f.jpg\\"]"}}', 1437337102),
(158, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"[\\"55ac044694ba2.jpg\\",\\"55ac057ba6f12.jpg\\",\\"55ac060e8730f.jpg\\"]"},"new":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\"}"}}', 1437337108),
(159, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\"}"},"new":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"3\\":\\"55ac061f1c691.png\\"}"}}', 1437337119),
(160, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"3\\":\\"55ac061f1c691.png\\"}"},"new":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac061f1c691.png\\"}"}}', 1437337125),
(161, 1, 'Магазины и Тц. номер: 9', '{"old":{"user_id":4},"new":{"user_id":"1"}}', 1437337688),
(162, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac061f1c691.png\\"}"},"new":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac061f1c691.png\\",\\"3\\":\\"55ac08bb6add2.jpg\\"}"}}', 1437337787),
(163, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac061f1c691.png\\",\\"3\\":\\"55ac08bb6add2.jpg\\"}"},"new":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac08bb6add2.jpg\\"}"}}', 1437337802),
(164, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac08bb6add2.jpg\\"}"},"new":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac08bb6add2.jpg\\",\\"3\\":\\"55ac08e442829.jpg\\"}"}}', 1437337828),
(165, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac08bb6add2.jpg\\",\\"3\\":\\"55ac08e442829.jpg\\"}"},"new":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac08bb6add2.jpg\\"}"}}', 1437337836),
(166, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac08bb6add2.jpg\\"}"},"new":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac08bb6add2.jpg\\",\\"3\\":\\"55ac159bac69e.jpg\\"}"}}', 1437341083),
(167, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac08bb6add2.jpg\\",\\"3\\":\\"55ac159bac69e.jpg\\"}"},"new":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac08bb6add2.jpg\\"}"}}', 1437341089),
(168, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac08bb6add2.jpg\\"}"},"new":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac08bb6add2.jpg\\",\\"3\\":\\"55ac15be8d3b9.jpg\\"}"}}', 1437341118),
(169, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac08bb6add2.jpg\\",\\"3\\":\\"55ac15be8d3b9.jpg\\"}"},"new":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac08bb6add2.jpg\\"}"}}', 1437341125),
(170, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac08bb6add2.jpg\\"}"},"new":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac08bb6add2.jpg\\",\\"3\\":\\"55ac15d09ce36.jpg\\"}"}}', 1437341136),
(171, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac08bb6add2.jpg\\",\\"3\\":\\"55ac15d09ce36.jpg\\"}"},"new":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac08bb6add2.jpg\\",\\"3\\":\\"55ac15d09ce36.jpg\\",\\"4\\":\\"55ac15f171f6f.jpg\\"}"}}', 1437341169),
(172, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"0\\":\\"55ac044694ba2.jpg\\",\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac08bb6add2.jpg\\",\\"3\\":\\"55ac15d09ce36.jpg\\",\\"4\\":\\"55ac15f171f6f.jpg\\"}"},"new":{"maps":"{\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac08bb6add2.jpg\\",\\"3\\":\\"55ac15d09ce36.jpg\\",\\"4\\":\\"55ac15f171f6f.jpg\\"}"}}', 1437341176),
(173, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"2\\":\\"55ac057ba6f12.jpg\\",\\"1\\":\\"55ac08bb6add2.jpg\\",\\"3\\":\\"55ac15d09ce36.jpg\\",\\"4\\":\\"55ac15f171f6f.jpg\\"}"},"new":{"maps":"{\\"1\\":\\"55ac08bb6add2.jpg\\",\\"3\\":\\"55ac15d09ce36.jpg\\",\\"4\\":\\"55ac15f171f6f.jpg\\"}"}}', 1437341178),
(174, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"1\\":\\"55ac08bb6add2.jpg\\",\\"3\\":\\"55ac15d09ce36.jpg\\",\\"4\\":\\"55ac15f171f6f.jpg\\"}"},"new":{"maps":"{\\"3\\":\\"55ac15d09ce36.jpg\\",\\"4\\":\\"55ac15f171f6f.jpg\\"}"}}', 1437341179),
(175, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"3\\":\\"55ac15d09ce36.jpg\\",\\"4\\":\\"55ac15f171f6f.jpg\\"}"},"new":{"maps":"{\\"4\\":\\"55ac15f171f6f.jpg\\",\\"0\\":\\"55ac15d09ce36.jpg\\"}"}}', 1437341182),
(176, 1, 'Магазины и Тц. номер: 9', '{"old":{"maps":"{\\"4\\":\\"55ac15f171f6f.jpg\\",\\"0\\":\\"55ac15d09ce36.jpg\\"}"},"new":{"maps":"[\\"55ac15d09ce36.jpg\\",\\"55ac15f171f6f.jpg\\"]"}}', 1437341185),
(177, 1, 'Магазины и Тц. номер: 8', '{"old":{"image":"55a62cb8e65cd.gif","status":1,"changes":""},"new":{"image":"55bf45f3ea2eb.jpeg","status":0,"changes":"{\\"image\\":\\"55a62cb8e65cd.gif\\",\\"status\\":1}"}}', 1438598644);

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1428143222),
('m140506_102106_rbac_init', 1428145810),
('m150404_102556_create_user_table', 1428143224),
('m150404_102652_create_user_table', 1428143224),
('m150404_102819_create_user_table', 1428143319);

-- --------------------------------------------------------

--
-- Структура таблицы `promo`
--

CREATE TABLE `promo` (
`id` int(11) NOT NULL,
  `content_id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `promo`
--

INSERT INTO `promo` (`id`, `content_id`, `image`, `description`, `duration`, `created_at`, `updated_at`, `status`) VALUES
(1, 7, '55a5132330b1f.jpg', 'Акция Green', '2015-05-31', 1432995188, 1437329854, 1),
(2, 2, '55a61bcc4df79.jpg', '70% на зимнюю коллекцию женской, мужской и детской обуви в Intertop до 30.07.15!', '2015-07-30', 1433080883, 1436949817, 1),
(3, 9, '55a942d2d9210.jpg', 'testset', '2015-07-31', 1437156050, 1437156050, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `register`
--

CREATE TABLE `register` (
`id` int(11) NOT NULL,
  `push_id` varchar(255) NOT NULL,
  `os` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `register`
--

INSERT INTO `register` (`id`, `push_id`, `os`) VALUES
(1, '5d137208-6378-43aa-8ce3-ad28ee7c63e4', 'Android'),
(2, '7077c47a-5aad-4d9b-bdd3-790387616be0', 'Android'),
(3, 'be127094-aa0e-46f6-8a52-861efd34e640', 'Android'),
(4, '89a57b59-5ec6-459e-85ed-e37c2aa7964f', 'Android'),
(5, '65cce934-e1f1-429c-8604-60d21d8e00df', 'Android'),
(6, '15d785e1-9039-4051-9956-43e482995be9', 'Android'),
(7, '7bf2e7eb-c003-4085-b3a5-6192f3d00b07', 'Android'),
(8, '00b4144c-a607-4de5-8e8e-dbc621f3ff72', 'Android'),
(9, 'b24a974e-3aa9-4853-beb3-487d2016ad3f', 'Android'),
(10, '33bc6305-6785-4212-abd1-ab47d046d7da', 'Android'),
(11, 'e7d861a6-28c1-494e-a0df-e0a4c8a2d643', 'Android'),
(12, 'dbe360ab-3c48-4682-9734-79136c736488', 'Android'),
(13, '41304c5f-8412-4ae0-a31f-8f6342b8cba7', 'Android'),
(14, '799af9f8-9d77-4121-82e7-52aa1531800a', 'Android'),
(15, '9f1a01f9-0ed8-416e-a2d0-d10db0fbd9ba', 'Android'),
(16, '66b3160f-eb95-4d2b-bf73-8a6d5e675e38', 'Android'),
(17, 'a931017f-27c9-4019-b07e-72f3ac69174e', 'Android'),
(18, 'ba443747-880f-4880-8579-bfc28923a8ed', 'Android'),
(19, 'bf26f2fb-b66d-4a9e-9881-724a3322abec', 'Android'),
(20, 'aee753c2-5e5b-4568-ab7b-da8425f1cd72', 'Android'),
(21, '19f3e79e-88a2-4998-8e53-47ee6c204c0f', 'Android'),
(22, 'c09a0bc2-e089-4469-81cb-e0a7be97ce08', 'Android'),
(23, 'e48f58fc-8b61-4882-be8b-c3cef96f25a4', 'Android'),
(24, 'c62a0d07-60ad-4b71-87fe-421f459c339b', 'Android');

-- --------------------------------------------------------

--
-- Структура таблицы `shop_category`
--

CREATE TABLE `shop_category` (
`id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `shop_category`
--

INSERT INTO `shop_category` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Спортивные', 1, 1433666554, 1433666554),
(2, 'Детские', 1, 1433680318, 1433680318),
(4, 'Женская одежда', 1, 1436944049, 1436944049),
(5, 'Мужская одежда', 1, 1436944069, 1436944069),
(6, 'Аксессуары', 1, 1436944095, 1436944197),
(7, 'Обувь', 1, 1436944113, 1436944113),
(8, 'Нижнее белье и одежда для дома', 1, 1436950407, 1436950407);

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
`id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `auth_key` varchar(32) DEFAULT NULL,
  `email_confirm_token` varchar(255) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `password_reset_token` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '0',
  `image` varchar(255) NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `created_at`, `updated_at`, `username`, `auth_key`, `email_confirm_token`, `password_hash`, `password_reset_token`, `email`, `status`, `image`, `type`) VALUES
(1, 1428144567, 1436954682, 'admin', 'TcaU3_nOuyv7TXalaYxvqyrKbNzKEzt9', NULL, '$2y$13$JI2PO3tBK99ta6F2V9f1L.T8RgApk5Ill5/2FsXjbbIDPAqYvul9m', 'HnoAoclfQN6PpwXKzygR2rP3kZWytKws_1431036827', 'ekeu@list.ru', 1, '55a6303a689a7.jpg', 1),
(3, 1431322630, 1432362679, 'mom', 'X_olGbR5zuqwJ1jGp8-67eX-OVdYuyfy', 't3yFFAUCXvClwatbCS3Ae7bEV_NqeAmo', '$2y$13$VkJ7P.Ib7cMqT7CZNRdmuOB4PVwlXILF2nug2y.0hVuPbBhQxR/j6', NULL, 'mom@m.com', 1, '55601eb71d1d1.jpg', 2),
(4, 1432985831, 1433059208, 'test', 'UfhYR4kWM44FH-opD5gPZDdvAS-7rp0J', NULL, '$2y$13$lTgu8Cz0F18LLauDWTNOfOk11cYRnEFSdR31TJXhQZ6LEYXxBtyuW', NULL, 'test@test.ru', 1, '556abf88b0530.jpg', 2),
(5, 1433079545, 1433079545, 'Oljas', '5n7qboe_mnZDZ5OjshtPBJcSpYLSBR99', NULL, '$2y$13$0DGdC.FflbinxOgVCWBRX.LV3AwIWJpAXPfP4tHKiTcDfW1A3m04G', NULL, 'manel_o@mail.ru', 1, '556b0ef944c31.jpg', 1),
(6, 1436882426, 1436882488, 'oljas1', 'e5cJrRsJZECwFQGyCxLrN65dciB2TfE3', NULL, '$2y$13$5okbWp5ZeVRQZ.BO/FlEZelrpGDCi0LTpDjfMm9CH6P03yp8qAGWy', NULL, 'maneloljas@gmail.com', 1, '55a516384e7a0.jpg', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `user_call`
--

CREATE TABLE `user_call` (
`id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `text` text NOT NULL,
  `paid_status` int(11) NOT NULL DEFAULT '0',
  `user_content_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_call`
--

INSERT INTO `user_call` (`id`, `status`, `type`, `user_id`, `created_at`, `updated_at`, `text`, `paid_status`, `user_content_id`) VALUES
(1, 3, 1, 4, 1433071056, 1437329251, 'Прошу добавить вас новый магазин', 1, 0),
(5, 3, 1, 1, 1433073193, 1437156177, 'Прошу добавить вас новый магазин', 1, 0),
(6, 3, 2, 1, 1433075112, 1434839175, 'Прошу вас добавить расширенные услуги', 1, 1),
(7, 3, 3, 1, 1433076603, 1434839174, 'Прошу вас добавить акцию', 1, 1),
(8, 3, 1, 5, 1433079587, 1434839179, 'Прошу добавить вас новый магазин', 1, 0),
(9, 3, 2, 5, 1433080307, 1434839182, 'Прошу вас добавить расширенные услуги', 1, 2),
(10, 3, 3, 5, 1433080609, 1437329500, 'Прошу вас добавить акцию', 1, 2),
(11, 3, 2, 1, 1437329076, 1437329257, 'Прошу вас добавить расширенные услуги', 1, 2),
(12, 3, 3, 1, 1437329488, 1437329509, 'Прошу вас добавить акцию', 1, 2),
(13, 3, 2, 1, 1437329522, 1437329536, 'Прошу вас добавить расширенные услуги', 1, 7),
(14, 3, 3, 1, 1437329879, 1437329892, 'Прошу вас добавить акцию', 1, 7),
(15, 3, 3, 1, 1437329911, 1437329927, 'Прошу вас добавить акцию', 1, 8),
(16, 0, 2, 1, 1437337700, 1437337700, 'Прошу вас добавить расширенные услуги', 0, 9);

-- --------------------------------------------------------

--
-- Структура таблицы `user_content`
--

CREATE TABLE `user_content` (
`id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `banner` varchar(255) DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `working_hours` varchar(255) DEFAULT NULL,
  `map` varchar(255) DEFAULT NULL,
  `shops` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `shop_category_id` int(11) NOT NULL,
  `changes` text NOT NULL,
  `img_map` varchar(255) NOT NULL,
  `maps` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user_content`
--

INSERT INTO `user_content` (`id`, `user_id`, `title`, `image`, `description`, `latitude`, `longitude`, `city_id`, `category_id`, `phone`, `banner`, `website`, `working_hours`, `map`, `shops`, `created_at`, `updated_at`, `status`, `shop_category_id`, `changes`, `img_map`, `maps`) VALUES
(2, 1, 'Intertop', '55a61676091c9.png', 'test', NULL, NULL, 1, 1, '+7 (702) 97-65-999', '55a6167609243.jpg', 'mediasolution.kz', '08:00 - 20:00', '55a66d4274384.jpg', '""', 1433080132, 1436970306, 1, 5, '[]', '', ''),
(7, 1, 'Amirlanushka', '55a623962cf5f.jpg', 'Магазин нижнего белья и домашней одежды для Амира и его друзей которые любят смотреть на женское белье.', 43.2220146, 76.8512485, 1, 1, '+7 (777) 77-77-777', '55a6242391dcb.jpg', 'www.lasenza.com', '10:00-22:00', NULL, '["1"]', 1436951446, 1436951715, 1, 8, '', '', ''),
(8, 1, 'Aport', '55bf45f3ea2eb.jpeg', '', 43.2220146, 76.8512485, 1, 2, '', '55a62cb8e6654.jpg', 'www.aport.kz', '10:00-22:00', NULL, '["7","2"]', 1436953784, 1438598644, 0, 8, '{"image":"55a62cb8e65cd.gif","status":1}', '', ''),
(9, 1, 'asdf', '55a78c901e783.jpg', 'asfasd', 43.2220146, 76.8512485, 1, 2, '+7 (123) 12-31-231', '55a78c901e80f.jpg', 'afsdf.asdfasd', '123123', '55a78c901e886.jpg', '""', 1437043856, 1437341185, 1, 1, '[]', '', '["55ac15d09ce36.jpg","55ac15f171f6f.jpg"]');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
 ADD PRIMARY KEY (`item_name`,`user_id`);

--
-- Индексы таблицы `auth_item`
--
ALTER TABLE `auth_item`
 ADD PRIMARY KEY (`name`), ADD KEY `rule_name` (`rule_name`), ADD KEY `idx-auth_item-type` (`type`);

--
-- Индексы таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
 ADD PRIMARY KEY (`parent`,`child`), ADD KEY `child` (`child`);

--
-- Индексы таблицы `auth_rule`
--
ALTER TABLE `auth_rule`
 ADD PRIMARY KEY (`name`);

--
-- Индексы таблицы `banner`
--
ALTER TABLE `banner`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `category`
--
ALTER TABLE `category`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `city`
--
ALTER TABLE `city`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `log`
--
ALTER TABLE `log`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
 ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `promo`
--
ALTER TABLE `promo`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `register`
--
ALTER TABLE `register`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `shop_category`
--
ALTER TABLE `shop_category`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`id`), ADD KEY `idx_user_username` (`username`), ADD KEY `idx_user_email` (`email`), ADD KEY `idx_user_status` (`status`);

--
-- Индексы таблицы `user_call`
--
ALTER TABLE `user_call`
 ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_content`
--
ALTER TABLE `user_content`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `banner`
--
ALTER TABLE `banner`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `category`
--
ALTER TABLE `category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `city`
--
ALTER TABLE `city`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `log`
--
ALTER TABLE `log`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=178;
--
-- AUTO_INCREMENT для таблицы `promo`
--
ALTER TABLE `promo`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT для таблицы `register`
--
ALTER TABLE `register`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT для таблицы `shop_category`
--
ALTER TABLE `shop_category`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT для таблицы `user_call`
--
ALTER TABLE `user_call`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT для таблицы `user_content`
--
ALTER TABLE `user_content`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `auth_assignment`
--
ALTER TABLE `auth_assignment`
ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item`
--
ALTER TABLE `auth_item`
ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `auth_item_child`
--
ALTER TABLE `auth_item_child`
ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;
