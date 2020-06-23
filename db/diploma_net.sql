-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июн 23 2020 г., 22:44
-- Версия сервера: 8.0.20-0ubuntu0.20.04.1
-- Версия PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `diploma_net`
--

-- --------------------------------------------------------

--
-- Структура таблицы `contact`
--

CREATE TABLE `contact` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `icon` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `contact`
--

INSERT INTO `contact` (`id`, `name`, `value`, `icon`) VALUES
(5, 'Telegram', 'telegram_help', 'fab fa-telegram'),
(6, 'E-mail', 'help@mail.com', 'fas fa-envelope-square'),
(7, 'Телефон', '+380957777777', 'fas fa-phone-square');

-- --------------------------------------------------------

--
-- Структура таблицы `currency`
--

CREATE TABLE `currency` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `icon` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `code` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `reserve` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `currency`
--

INSERT INTO `currency` (`id`, `name`, `icon`, `code`, `reserve`) VALUES
(20, 'Bitcoin', 'btc.png', 'BTC', 2.45),
(21, 'Приват 24', 'PRIVAT24UAH.png', 'P24UAH', 777),
(23, 'Etherium', 'BTCEETH.png', 'ETH', 1),
(24, 'Сбер', 'SBERRUB.png', 'SBERRUB', 333);

-- --------------------------------------------------------

--
-- Структура таблицы `exch_direction`
--

CREATE TABLE `exch_direction` (
  `id` int NOT NULL,
  `from_currency` int NOT NULL,
  `to_currency` int NOT NULL,
  `status` varchar(50) NOT NULL,
  `rate_from` float NOT NULL,
  `rate_to` float NOT NULL,
  `min_amount_from` float NOT NULL,
  `min_amount_to` float NOT NULL,
  `max_amount_from` float NOT NULL,
  `max_amount_to` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `exch_direction`
--

INSERT INTO `exch_direction` (`id`, `from_currency`, `to_currency`, `status`, `rate_from`, `rate_to`, `min_amount_from`, `min_amount_to`, `max_amount_from`, `max_amount_to`) VALUES
(22, 20, 21, '1', 1, 252858, 0.01, 0.01, 50000, 50000000000),
(23, 21, 20, '1', 1, 1, 1, 1, 1, 1),
(24, 20, 23, '1', 1, 1, 1, 1, 1, 1),
(25, 23, 20, '1', 1, 1, 1, 1, 1, 1),
(26, 23, 21, '1', 1, 1, 1, 1, 1, 1),
(27, 23, 24, '1', 1, 1, 1, 1, 1, 1),
(28, 20, 24, '1', 1, 1, 1, 1, 1, 1),
(29, 21, 23, '1', 1, 1, 1, 1, 1, 1),
(30, 21, 24, '1', 1, 1, 1, 1, 1, 1),
(31, 24, 20, '1', 1, 1, 1, 1, 1, 1),
(33, 24, 21, '1', 1, 1, 1, 1, 1, 1),
(34, 24, 23, '1', 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `exch_order`
--

CREATE TABLE `exch_order` (
  `id` int NOT NULL,
  `date` varchar(100) NOT NULL,
  `rate` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `from_currency` varchar(30) NOT NULL,
  `to_currency` varchar(30) NOT NULL,
  `from_amount` float NOT NULL,
  `to_amount` float NOT NULL,
  `from_account` varchar(30) NOT NULL,
  `to_account` varchar(30) NOT NULL,
  `person` varchar(100) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `email` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `status` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `update_date` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ip_address` varchar(30) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `exch_order`
--

INSERT INTO `exch_order` (`id`, `date`, `rate`, `from_currency`, `to_currency`, `from_amount`, `to_amount`, `from_account`, `to_account`, `person`, `phone_number`, `email`, `status`, `update_date`, `ip_address`) VALUES
(3, '1592560743', '1 -> 200000', 'BTC', 'SBERRUB', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592560743', '172.17.112.1'),
(4, '1592560765', '1 -> 200000', 'BTC', 'SBERRUB', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592560765', '172.17.112.1'),
(5, '1592560828', '3132 -> 294348', 'SBERRUB', 'P24UAH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592560828', '172.17.112.1'),
(6, '1592561542', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592561542', '172.17.112.1'),
(7, '1592561598', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592561598', '172.17.112.1'),
(8, '1592561614', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592561614', '172.17.112.1'),
(9, '1592561635', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592561635', '172.17.112.1'),
(10, '1592561650', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592561650', '172.17.112.1'),
(11, '1592565534', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592565534', '172.17.112.1'),
(12, '1592566046', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592566046', '172.17.112.1'),
(13, '1592566100', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592566100', '172.17.112.1'),
(14, '1592566112', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592566112', '172.17.112.1'),
(15, '1592566164', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592566164', '172.17.112.1'),
(16, '1592566201', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592566201', '172.17.112.1'),
(17, '1592566206', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592566206', '172.17.112.1'),
(18, '1592566381', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592566381', '172.17.112.1'),
(19, '1592566859', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592566859', '172.17.112.1'),
(20, '1592566985', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592566985', '172.17.112.1'),
(21, '1592567325', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592567325', '172.17.112.1'),
(22, '1592567362', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592567362', '172.17.112.1'),
(24, '1592576845', '33 -> 33', 'ETH', 'P24UAH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592576845', '172.17.112.1'),
(25, '1592577199', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592577199', '172.17.112.1'),
(26, '1592577306', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592577306', '172.17.112.1'),
(27, '1592577317', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592577317', '172.17.112.1'),
(28, '1592577324', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592577324', '172.17.112.1'),
(29, '1592577443', '3132 -> 294348', 'SBERRUB', 'P24UAH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592577443', '172.17.112.1'),
(30, '1592577532', '3132 -> 294348', 'SBERRUB', 'P24UAH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592577532', '172.17.112.1'),
(31, '1592577550', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592577550', '172.17.112.1'),
(32, '1592577573', '21312 -> 123312', 'ETH', 'BTC', 0, 0, '0', '0', '00', '0', '0', 'Новая заявка', '1592577573', '172.17.112.1'),
(33, '1592577597', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '0', '0', '00', '0', '0', 'Новая заявка', '1592577597', '172.17.112.1'),
(34, '1592577624', '21312 -> 123312', 'ETH', 'BTC', 0, 0, '0', '00', '0', '0', '0', 'Новая заявка', '1592577624', '172.17.112.1'),
(35, '1592577802', '1 -> 200000', 'BTC', 'SBERRUB', 0, 0, '0', '0', '0', '0', '0', 'Новая заявка', '1592577802', '172.17.112.1'),
(36, '1592586338', '1 -> 200000', 'BTC', 'SBERRUB', 0, 0, '0', '00', '00', '0', '0', 'Новая заявка', '1592586338', '172.17.112.1'),
(37, '1592593840', '3132 -> 312312', 'P24UAH', 'ETH', 0, 0, '4444111122226666', '0x9cfaaE48FF109E1314980EBE5017', 'Иванов Иван Иванович', '13', 'mail@mail.com', 'Новая заявка', '1592593840', '172.17.112.1'),
(38, '1592641272', '1 -> 1', 'SBERRUB', 'BTC', 1, 1, '0', '00', '0', '0', '0', 'Не оплачена', '1592641272', '172.17.112.1'),
(39, '1592649882', '1 -> 1', 'ETH', 'SBERRUB', 1, 1, '0', '0', '0', '0', '0', 'Не оплачена', '1592649882', '172.17.112.1'),
(40, '1592649916', '1 -> 1', 'ETH', 'SBERRUB', 1, 1, '0', '0', '0', '0', '0', 'Не оплачена', '1592649916', '172.17.112.1'),
(41, '1592649926', '1 -> 1', 'ETH', 'SBERRUB', 1, 1, '0', '0', '0', '0', '0', 'Не оплачена', '1592649926', '172.17.112.1'),
(42, '1592649931', '1 -> 1', 'ETH', 'SBERRUB', 1, 1, '0', '0', '0', '0', '0', 'Не оплачена', '1592649931', '172.17.112.1'),
(43, '1592649945', '1 -> 1', 'ETH', 'SBERRUB', 1, 1, '0', '0', '0', '0', '0', 'Не оплачена', '1592649945', '172.17.112.1'),
(44, '1592649979', '1 -> 1', 'ETH', 'SBERRUB', 1, 1, '0', '0', '0', '0', '0', 'Не оплачена', '1592649979', '172.17.112.1'),
(45, '1592650129', '1 -> 1', 'SBERRUB', 'ETH', 1, 1, '0', '00', '0', '0', '0', 'Не оплачена', '1592650129', '172.17.112.1'),
(46, '1592650212', '1 -> 1', 'SBERRUB', 'BTC', 1, 1, '0', '00', '0', '0', '0', 'Не оплачена', '1592650212', '172.17.112.1'),
(47, '1592650218', '1 -> 1', 'SBERRUB', 'BTC', 1, 1, '0', '00', '0', '0', '0', 'Не оплачена', '1592650218', '172.17.112.1'),
(48, '1592650223', '1 -> 1', 'SBERRUB', 'BTC', 1, 1, '0', '00', '0', '0', '0', 'Не оплачена', '1592650223', '172.17.112.1'),
(49, '1592650228', '1 -> 1', 'SBERRUB', 'BTC', 1, 1, '0', '00', '0', '0', '0', 'Не оплачена', '1592650228', '172.17.112.1'),
(50, '1592650233', '1 -> 1', 'SBERRUB', 'BTC', 1, 1, '0', '00', '0', '0', '0', 'Не оплачена', '1592650233', '172.17.112.1'),
(51, '1592650240', '1 -> 1', 'SBERRUB', 'BTC', 1, 1, '0', '00', '0', '0', '0', 'Не оплачена', '1592650240', '172.17.112.1'),
(52, '1592650262', '1 -> 1', 'SBERRUB', 'BTC', 1, 1, '0', '00', '0', '0', '0', 'Не оплачена', '1592842576', '172.17.112.1'),
(53, '1592650272', '1 -> 1', 'SBERRUB', 'BTC', 1, 1, '0', '00', '0', '0', '0', 'Не оплачена', '1592842576', '172.17.112.1'),
(54, '1592650277', '1 -> 1', 'SBERRUB', 'BTC', 1, 1, '0', '00', '0', '0', '0', 'Не оплачена', '1592842576', '172.17.112.1'),
(55, '1592650290', '1 -> 1', 'SBERRUB', 'BTC', 1, 1, '0', '00', '0', '0', '0', 'Не оплачена', '1592842576', '172.17.112.1'),
(56, '1592650322', '1 -> 1', 'SBERRUB', 'BTC', 1, 1, '0', '00', '0', '0', '0', 'Не оплачена', '1592842575', '172.17.112.1'),
(57, '1592650441', '1 -> 1', 'SBERRUB', 'ETH', 1, 1, '0', '0', '0', '0', '0', 'Не оплачена', '1592842575', '172.17.112.1'),
(58, '1592650486', '1 -> 1', 'P24UAH', 'SBERRUB', 1, 1, '0', '0', '0', '0', '0', 'Не оплачена', '1592842575', '172.17.112.1'),
(59, '1592657151', '1 -> 1', 'ETH', 'P24UAH', 1, 1, '1', 'ё', '1', '1', '1', 'Не оплачена', '1592842575', '172.17.112.1'),
(60, '1592669879', '1 -> 1', 'ETH', 'P24UAH', 1, 1, '1', 'ё', '1', '1', '1', 'Не оплачена', '1592842574', '172.17.112.1'),
(61, '1592678020', '1 -> 1', 'ETH', 'BTC', 1, 1, '1', '1', '1', '1', '1', 'Не оплачена', '1592842574', '172.17.112.1'),
(62, '1592678643', '1 -> 1', 'SBERRUB', 'BTC', 1, 1, '1', '1', '1', '1', '1', 'Не оплачена', '1592842574', '172.17.112.1'),
(63, '1592683068', '1 -> 1', 'ETH', 'BTC', 1, 1, '1', '1', '1', '1', '1', 'Не оплачена', '1592842574', '172.17.112.1'),
(64, '1592753025', '1 -> 1', 'ETH', 'SBERRUB', 1, 1, '1', '1', '1', '1', '1', 'Не оплачена', '1592842573', '172.28.32.1'),
(65, '1592768269', '1 -> 252858', 'BTC', 'P24UAH', 0.12, 30343, '1234123412341234', '1234123412341234', 'Лайкович', '12', 'E-mail', 'Не оплачена', '1592842573', '172.28.32.1'),
(66, '1592775461', '1 -> 252858', 'BTC', 'P24UAH', 1, 252858, '1234123412341234', '1234123412341234', 'fds', '12', 'E-mail', 'Не оплачена', '1592842573', '172.28.32.1'),
(67, '1592775491', '1 -> 252858', 'BTC', 'P24UAH', 0.01, 2528.58, '1234123412341234', '1234123412341234', 'fds', '12', 'E-mail', 'Не оплачена', '1592842573', '172.28.32.1'),
(68, '1592775503', '1 -> 252858', 'BTC', 'P24UAH', 0.01, 2528.58, '1234123412341234', '1234123412341234', 'fds', '12', 'E-mail', 'Не оплачена', '1592842572', '172.28.32.1'),
(69, '1592775540', '1 -> 252858', 'BTC', 'P24UAH', 0.01, 2528.58, '1234123412341234', '1234123412341234', 'fds', '12', 'E-mail', 'Не оплачена', '1592842572', '172.28.32.1'),
(70, '1592777030', '1 -> 252858', 'BTC', 'P24UAH', 0.01, 2528.58, '12fds34123fds4123fsd41234', '1234123412341234', 'Лайкович Владимир', '+380952079353', 'mail@mail.com', 'Не оплачена', '1592842572', '172.28.32.1'),
(71, '1592777755', '1 -> 252858', 'BTC', 'P24UAH', 0.01, 2528.58, '12fds34123fds4123fsd41234', '1234123412341234', 'Лайкович Владимир', '+380952079353', 'mail@mail.com', 'В обработке', '1592850267', '172.28.32.1'),
(72, '1592853011', '1 -> 1', 'P24UAH', 'ETH', 1, 1, '1234123412341234', '1234123412341234', 'Лайкович Владимир', '0952079353', 'mail@mail.com', 'В обработке', '1592853017', '172.28.32.1'),
(73, '1592853073', '1 -> 1', 'SBERRUB', 'BTC', 1, 1, '1234123412341234', '1234123412341234', 'Лайкович Владимир', '0952079353', 'mail@mail.com', 'В обработке', '1592853114', '172.28.32.1'),
(74, '1592853412', '1 -> 1', 'SBERRUB', 'BTC', 1, 1, '1234123412341234', '1234123412341234', 'Лайкович Владимир', '0952079353', 'mail@mail.com', 'В обработке', '1592856421', '172.28.32.1'),
(75, '1592892306', '1 -> 1', 'ETH', 'SBERRUB', 1, 1, '1234123412341234', '1234123412341234', 'Лайкович Владимир', '0952079353', 'mail@mail.com', 'Ошибка', '1592893156', '172.28.32.1'),
(76, '1592894686', '1 -> 1', 'P24UAH', 'SBERRUB', 1, 1, '1234123412341234', '1234123412341234', 'Лайкович Владимир', '0952079353', 'mail@mail.com', 'Выполнена', '1592897261', '172.28.32.1'),
(77, '1592903641', '1 → 1', 'SBERRUB', 'BTC', 1, 1, '1234123412341234', '1234123412341234', 'Лайкович Владимир', '0952079353', 'mail@mail.com', 'Удалена', '1592903832', '172.28.32.1'),
(78, '1592903847', '1SBERRUB → 1ETH', 'SBERRUB', 'ETH', 1, 1, '1234123412341234', '1234123412341234', 'Лайкович Владимир', '0952079353', 'mail@mail.com', 'Удалена', '1592903919', '172.28.32.1'),
(79, '1592903933', '1SBERRUB  → 1 ETH', 'SBERRUB', 'ETH', 1, 1, '12fds34123fds4123fsd41234', '1234123412341234', 'Лайкович Владимир', '0952079353', 'mail@mail.com', 'Не оплачена', '1592903933', '172.28.32.1'),
(80, '1592903967', '1 SBERRUB → 1 ETH', 'SBERRUB', 'ETH', 1, 1, '12fds34123fds4123fsd41234', '1234123412341234', 'Лайкович Владимир', '0952079353', 'mail@mail.com', 'Удалена', '1592905404', '172.28.32.1'),
(81, '1592906310', '1 SBERRUB → 1 BTC', 'SBERRUB', 'BTC', 1, 1, '1234123412341234', '1234123412341234', 'Лайкович Владимир', '0952079353', 'mail@mail.com', 'Выполнена', '1592906650', '172.28.32.1'),
(82, '1592907797', '1 P24UAH → 1 ETH', 'P24UAH', 'ETH', 1, 1, '1234123412341234', '1234123412341234', 'Лайкович Владимир', '0952079353', 'mail@mail.com', 'Не оплачена', '1592907797', '172.28.32.1'),
(83, '1592908527', '1 ETH → 1 SBERRUB', 'ETH', 'SBERRUB', 1, 1, '1234123412341234', '1234123412341234', 'Лайкович Владимир', '0952079353', 'mail@mail.com', 'В обработке', '1592908532', '172.28.32.1');

-- --------------------------------------------------------

--
-- Структура таблицы `migration`
--

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1590838975),
('m130524_201442_init', 1590838981),
('m190124_110200_add_verification_token_column_to_user_table', 1590838982);

-- --------------------------------------------------------

--
-- Структура таблицы `review`
--

CREATE TABLE `review` (
  `id` int NOT NULL,
  `created_at` int NOT NULL,
  `created_by` varchar(50) NOT NULL,
  `text` varchar(300) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `review`
--

INSERT INTO `review` (`id`, `created_at`, `created_by`, `text`) VALUES
(3, 1592922932, 'Владимир', 'Спасибо, очень быстро!'),
(4, 1592925559, 'Сергей', 'Хороший курс!'),
(5, 1592926197, 'Владимир', 'Класс!!!');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint NOT NULL DEFAULT '10',
  `created_at` int NOT NULL,
  `updated_at` int NOT NULL,
  `verification_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`, `verification_token`) VALUES
(3, 'admin', 'pZgiQdH2g6BtNc0rw90-9xzmDJXGkPlv', '$2y$13$ioGSlPbC3ocdKJGy.zQbf.FJwGbqGhJF/Q68wuJRidRDe2UIGD7Ia', NULL, 'wlawallay@gmail.com', 10, 1590840164, 1590840164, 'P0Rf5tHhNt26jx1aRAhx0nTzc0eJPkak_1590840164');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `currency`
--
ALTER TABLE `currency`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `exch_direction`
--
ALTER TABLE `exch_direction`
  ADD PRIMARY KEY (`id`),
  ADD KEY `give_currency` (`from_currency`),
  ADD KEY `receive_currency` (`to_currency`);

--
-- Индексы таблицы `exch_order`
--
ALTER TABLE `exch_order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migration`
--
ALTER TABLE `migration`
  ADD PRIMARY KEY (`version`);

--
-- Индексы таблицы `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `password_reset_token` (`password_reset_token`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `currency`
--
ALTER TABLE `currency`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `exch_direction`
--
ALTER TABLE `exch_direction`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `exch_order`
--
ALTER TABLE `exch_order`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT для таблицы `review`
--
ALTER TABLE `review`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `exch_direction`
--
ALTER TABLE `exch_direction`
  ADD CONSTRAINT `exch_direction_ibfk_1` FOREIGN KEY (`from_currency`) REFERENCES `currency` (`id`),
  ADD CONSTRAINT `exch_direction_ibfk_2` FOREIGN KEY (`to_currency`) REFERENCES `currency` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
