-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Хост: mysql:3306
-- Время создания: Ноя 29 2019 г., 04:57
-- Версия сервера: 5.7.28
-- Версия PHP: 7.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `docker`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `date_create` date NOT NULL,
  `date_mod` date NOT NULL,
  `description` varchar(255) NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `name`, `date_create`, `date_mod`, `description`, `parent_id`) VALUES
(10, 'News', '2019-11-05', '2019-11-06', 'Cat news', 11),
(11, 'Catalog', '2019-11-05', '2019-11-06', 'Main catagory', 0),
(12, 'Stat', '2019-11-05', '2019-11-06', 'Cat stat', 11),
(13, 'Otzivy', '2019-11-05', '2019-11-06', 'Cat otzivy', 11),
(14, 'Comment', '2019-11-05', '2019-11-06', 'Cat comment', 11),
(17, 'test', '2019-11-27', '2019-11-27', '', 16),
(18, 'test', '2019-11-27', '2019-11-27', '', 17),
(19, 'test', '2019-11-27', '2019-11-27', '', 17),
(20, 'test', '2019-11-27', '2019-11-27', '', 17),
(22, 'react test', '2019-11-27', '2019-11-27', '', 18),
(23, 'react test', '2019-11-27', '2019-11-27', '', 15),
(25, 'react test', '2019-11-27', '2019-11-27', '', 19),
(29, 'ffffffff', '2019-11-27', '2019-11-27', '', 23),
(34, 'aaa', '2019-11-27', '2019-11-27', '', 21),
(39, 'name', '2019-11-28', '2019-11-28', 'description', 33),
(42, 'name2', '2019-11-28', '2019-11-28', 'description2', 41),
(43, 'name3', '2019-11-28', '2019-11-28', 'n', 42),
(45, 'name1', '2019-11-28', '2019-11-28', 'nam', 15),
(52, 'tttt', '2019-11-28', '2019-11-28', 'tttt', 22),
(53, '123123', '2019-11-28', '2019-11-28', '', 20),
(54, '123123', '2019-11-28', '2019-11-28', '', 20),
(55, '123123', '2019-11-28', '2019-11-28', '123123', 20),
(56, '123123', '2019-11-28', '2019-11-28', '', 52),
(57, '123123', '2019-11-28', '2019-11-28', '', 56),
(59, '234', '2019-11-28', '2019-11-28', '', 35),
(60, '234', '2019-11-28', '2019-11-28', '', 35),
(61, '234', '2019-11-28', '2019-11-28', '', 35),
(62, '234', '2019-11-28', '2019-11-28', '', 35),
(68, '2234', '2019-11-28', '2019-11-28', '', 48),
(69, '2234', '2019-11-28', '2019-11-28', '', 48),
(82, '32414', '2019-11-28', '2019-11-28', '', 81),
(83, '24234', '2019-11-28', '2019-11-28', '', 57),
(84, '121', '2019-11-28', '2019-11-28', '', 70),
(85, 'aaa', '2019-11-28', '2019-11-28', '', 34),
(86, '111', '2019-11-28', '2019-11-28', '', 83),
(87, '111', '2019-11-28', '2019-11-28', '', 83);

-- --------------------------------------------------------

--
-- Структура таблицы `elements`
--

CREATE TABLE `elements` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `date_create` date NOT NULL,
  `date_mod` date NOT NULL,
  `type_el` int(10) UNSIGNED NOT NULL,
  `other` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `elements`
--

INSERT INTO `elements` (`id`, `name`, `category_id`, `date_create`, `date_mod`, `type_el`, `other`) VALUES
(22, 'Comment 1', 14, '2019-11-05', '2019-11-06', 4, 'Comment'),
(23, 'Otziv 1', 13, '2019-11-05', '2019-11-06', 3, 'Otziv'),
(31, '111', 84, '2019-11-28', '2019-11-28', 1, '111'),
(32, '111', 83, '2019-11-28', '2019-11-28', 1, '111'),
(33, '111', 83, '2019-11-28', '2019-11-28', 1, '111'),
(34, '111', 83, '2019-11-28', '2019-11-28', 1, '111'),
(35, '111', 83, '2019-11-28', '2019-11-28', 1, '111'),
(36, '111', 83, '2019-11-28', '2019-11-28', 1, '111'),
(37, '111', 83, '2019-11-28', '2019-11-28', 1, '111'),
(38, '111', 86, '2019-11-28', '2019-11-28', 1, '111'),
(42, '123', 84, '2019-11-28', '2019-11-28', 1, '123123'),
(45, '234', 82, '2019-11-28', '2019-11-28', 1, '234'),
(46, 'sddss', 22, '2019-11-28', '2019-11-28', 1, 'sdsd');

-- --------------------------------------------------------

--
-- Структура таблицы `type_elem`
--

CREATE TABLE `type_elem` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `type_elem`
--

INSERT INTO `type_elem` (`id`, `name`) VALUES
(1, 'News'),
(2, 'Statya'),
(3, 'Otziv'),
(4, 'Comment');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `elements`
--
ALTER TABLE `elements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_id` (`category_id`),
  ADD KEY `type_el` (`type_el`);

--
-- Индексы таблицы `type_elem`
--
ALTER TABLE `type_elem`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT для таблицы `elements`
--
ALTER TABLE `elements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT для таблицы `type_elem`
--
ALTER TABLE `type_elem`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `elements`
--
ALTER TABLE `elements`
  ADD CONSTRAINT `elements_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`),
  ADD CONSTRAINT `elements_ibfk_2` FOREIGN KEY (`type_el`) REFERENCES `type_elem` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
