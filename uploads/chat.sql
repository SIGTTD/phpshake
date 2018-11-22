-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 07 2018 г., 11:55
-- Версия сервера: 5.7.20
-- Версия PHP: 5.6.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `chat`
--

-- --------------------------------------------------------

--
-- Структура таблицы `adminR`
--

CREATE TABLE `adminR` (
  `id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `userIP` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `adminV`
--

CREATE TABLE `adminV` (
  `id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `userIP` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `unresolved`
--

CREATE TABLE `unresolved` (
  `id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `userIP` text NOT NULL,
  `date` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `unresolved`
--

INSERT INTO `unresolved` (`id`, `msg`, `userIP`, `date`) VALUES
(1, 'massege', '127.0.0.1', '26, July, 15:24'),
(2, 'aww', '127.0.0.1', '26, July, 15:33'),
(3, 'aa', '127.0.0.1', '26, July, 15:34'),
(4, 'aa', '127.0.0.1', '26, July, 15:39'),
(5, '', '127.0.0.1', '27, July, 15:37'),
(6, '', '127.0.0.1', '27, July, 15:38');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `adminR`
--
ALTER TABLE `adminR`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `adminV`
--
ALTER TABLE `adminV`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `unresolved`
--
ALTER TABLE `unresolved`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `adminR`
--
ALTER TABLE `adminR`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `adminV`
--
ALTER TABLE `adminV`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `unresolved`
--
ALTER TABLE `unresolved`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
