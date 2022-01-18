-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 18 2022 г., 18:14
-- Версия сервера: 8.0.24
-- Версия PHP: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `game`
--

-- --------------------------------------------------------

--
-- Структура таблицы `ban_list`
--

CREATE TABLE `ban_list` (
  `user_id` int NOT NULL,
  `user` varchar(24) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `timestamp` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `contracts`
--

CREATE TABLE `contracts` (
  `id` int NOT NULL,
  `store_name` text NOT NULL,
  `item` text NOT NULL,
  `image` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `contracts`
--

INSERT INTO `contracts` (`id`, `store_name`, `item`, `image`) VALUES
(265, 'Шашлычная', 'a:4:{i:0;a:5:{s:4:\"name\";s:6:\"turnip\";s:7:\"ru_name\";s:8:\"Репа\";s:5:\"price\";i:330;s:6:\"season\";s:6:\"spring\";s:8:\"quantity\";i:8;}i:1;a:5:{s:4:\"name\";s:4:\"beet\";s:7:\"ru_name\";s:12:\"Свекла\";s:5:\"price\";i:120;s:6:\"season\";s:6:\"autumn\";s:8:\"quantity\";i:8;}i:2;a:5:{s:4:\"name\";s:8:\"eggplant\";s:7:\"ru_name\";s:16:\"Баклажан\";s:5:\"price\";i:60;s:6:\"season\";s:6:\"autumn\";s:8:\"quantity\";i:24;}i:3;d:76;}', '/img/food/salad.png'),
(266, 'Таверна', 'a:2:{i:0;a:5:{s:4:\"name\";s:6:\"potato\";s:7:\"ru_name\";s:18:\"Кортофель\";s:5:\"price\";i:80;s:6:\"season\";s:6:\"spring\";s:8:\"quantity\";i:10;}i:1;d:12;}', '/img/food/ribs.png'),
(267, 'Кафетерий', 'a:3:{i:0;a:5:{s:4:\"name\";s:7:\"pumpkin\";s:7:\"ru_name\";s:10:\"Тыква\";s:5:\"price\";i:450;s:6:\"season\";s:6:\"autumn\";s:8:\"quantity\";i:9;}i:1;a:5:{s:4:\"name\";s:6:\"radish\";s:7:\"ru_name\";s:10:\"Редис\";s:5:\"price\";i:180;s:6:\"season\";s:6:\"summer\";s:8:\"quantity\";i:27;}i:2;d:134;}', '/img/food/pizza.png'),
(268, 'Кафетерий', 'a:3:{i:0;a:5:{s:4:\"name\";s:6:\"potato\";s:7:\"ru_name\";s:18:\"Кортофель\";s:5:\"price\";i:80;s:6:\"season\";s:6:\"spring\";s:8:\"quantity\";i:8;}i:1;a:5:{s:4:\"name\";s:12:\"chin_cabbage\";s:7:\"ru_name\";s:33:\"Китайская капуста\";s:5:\"price\";i:80;s:6:\"season\";s:6:\"autumn\";s:8:\"quantity\";i:24;}i:2;d:38;}', '/img/food/kebab.png'),
(269, 'Фаст-фуд', 'a:4:{i:0;a:5:{s:4:\"name\";s:6:\"pepper\";s:7:\"ru_name\";s:10:\"Перец\";s:5:\"price\";i:390;s:6:\"season\";s:6:\"summer\";s:8:\"quantity\";i:3;}i:1;a:5:{s:4:\"name\";s:4:\"beet\";s:7:\"ru_name\";s:12:\"Свекла\";s:5:\"price\";i:120;s:6:\"season\";s:6:\"autumn\";s:8:\"quantity\";i:9;}i:2;a:5:{s:4:\"name\";s:8:\"cucumber\";s:7:\"ru_name\";s:12:\"Огурец\";s:5:\"price\";i:110;s:6:\"season\";s:6:\"spring\";s:8:\"quantity\";i:27;}i:3;d:78;}', '/img/food/cake.png'),
(270, 'Шашлычная', 'a:4:{i:0;a:5:{s:4:\"name\";s:4:\"corn\";s:7:\"ru_name\";s:16:\"Кукуруза\";s:5:\"price\";i:300;s:6:\"season\";s:6:\"summer\";s:8:\"quantity\";i:6;}i:1;a:5:{s:4:\"name\";s:9:\"artichoke\";s:7:\"ru_name\";s:14:\"Артишок\";s:5:\"price\";i:160;s:6:\"season\";s:6:\"autumn\";s:8:\"quantity\";i:6;}i:2;a:5:{s:4:\"name\";s:8:\"cucumber\";s:7:\"ru_name\";s:12:\"Огурец\";s:5:\"price\";i:110;s:6:\"season\";s:6:\"spring\";s:8:\"quantity\";i:12;}i:3;d:61;}', '/img/food/tacos.png'),
(271, 'Бар', 'a:4:{i:0;a:5:{s:4:\"name\";s:6:\"turnip\";s:7:\"ru_name\";s:8:\"Репа\";s:5:\"price\";i:330;s:6:\"season\";s:6:\"spring\";s:8:\"quantity\";i:7;}i:1;a:5:{s:4:\"name\";s:6:\"radish\";s:7:\"ru_name\";s:10:\"Редис\";s:5:\"price\";i:180;s:6:\"season\";s:6:\"summer\";s:8:\"quantity\";i:14;}i:2;a:5:{s:4:\"name\";s:6:\"tomato\";s:7:\"ru_name\";s:10:\"Томат\";s:5:\"price\";i:60;s:6:\"season\";s:6:\"summer\";s:8:\"quantity\";i:28;}i:3;d:98;}', '/img/food/cutlets.png'),
(272, 'Шашлычная', 'a:4:{i:0;a:5:{s:4:\"name\";s:11:\"cauliflower\";s:7:\"ru_name\";s:29:\"Цветная капуста\";s:5:\"price\";i:175;s:6:\"season\";s:6:\"spring\";s:8:\"quantity\";i:4;}i:1;a:5:{s:4:\"name\";s:9:\"artichoke\";s:7:\"ru_name\";s:14:\"Артишок\";s:5:\"price\";i:160;s:6:\"season\";s:6:\"autumn\";s:8:\"quantity\";i:4;}i:2;a:5:{s:4:\"name\";s:8:\"cucumber\";s:7:\"ru_name\";s:12:\"Огурец\";s:5:\"price\";i:110;s:6:\"season\";s:6:\"spring\";s:8:\"quantity\";i:8;}i:3;d:33;}', '/img/food/ribs.png'),
(273, 'Фаст-фуд', 'a:4:{i:0;a:5:{s:4:\"name\";s:6:\"pepper\";s:7:\"ru_name\";s:10:\"Перец\";s:5:\"price\";i:390;s:6:\"season\";s:6:\"summer\";s:8:\"quantity\";i:6;}i:1;a:5:{s:4:\"name\";s:4:\"corn\";s:7:\"ru_name\";s:16:\"Кукуруза\";s:5:\"price\";i:300;s:6:\"season\";s:6:\"summer\";s:8:\"quantity\";i:6;}i:2;a:5:{s:4:\"name\";s:6:\"radish\";s:7:\"ru_name\";s:10:\"Редис\";s:5:\"price\";i:180;s:6:\"season\";s:6:\"summer\";s:8:\"quantity\";i:6;}i:3;d:78;}', '/img/food/pizza.png'),
(274, 'Кафетерий', 'a:3:{i:0;a:5:{s:4:\"name\";s:6:\"squash\";s:7:\"ru_name\";s:14:\"Кабачок\";s:5:\"price\";i:220;s:6:\"season\";s:6:\"spring\";s:8:\"quantity\";i:4;}i:1;a:5:{s:4:\"name\";s:6:\"potato\";s:7:\"ru_name\";s:18:\"Кортофель\";s:5:\"price\";i:80;s:6:\"season\";s:6:\"spring\";s:8:\"quantity\";i:4;}i:2;d:18;}', '/img/food/fast_food.png'),
(275, 'Бар', 'a:4:{i:0;a:5:{s:4:\"name\";s:6:\"squash\";s:7:\"ru_name\";s:14:\"Кабачок\";s:5:\"price\";i:220;s:6:\"season\";s:6:\"spring\";s:8:\"quantity\";i:10;}i:1;a:5:{s:4:\"name\";s:9:\"artichoke\";s:7:\"ru_name\";s:14:\"Артишок\";s:5:\"price\";i:160;s:6:\"season\";s:6:\"autumn\";s:8:\"quantity\";i:20;}i:2;a:5:{s:4:\"name\";s:8:\"eggplant\";s:7:\"ru_name\";s:16:\"Баклажан\";s:5:\"price\";i:60;s:6:\"season\";s:6:\"autumn\";s:8:\"quantity\";i:60;}i:3;d:135;}', '/img/food/pita.png');

-- --------------------------------------------------------

--
-- Структура таблицы `farms`
--

CREATE TABLE `farms` (
  `id` int NOT NULL,
  `level` int NOT NULL,
  `exp` int NOT NULL,
  `max_exp` int NOT NULL,
  `size` int NOT NULL,
  `products` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `logs`
--

CREATE TABLE `logs` (
  `id` int NOT NULL,
  `timestamp` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `user_id` int NOT NULL,
  `action` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `marketplace`
--

CREATE TABLE `marketplace` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `productName` text NOT NULL,
  `productNameRU` text NOT NULL,
  `quantity` int NOT NULL,
  `lotPrice` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `objects`
--

CREATE TABLE `objects` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `price` int NOT NULL,
  `service` int NOT NULL,
  `class` text NOT NULL,
  `img` text NOT NULL,
  `level` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `objects`
--

INSERT INTO `objects` (`id`, `name`, `price`, `service`, `class`, `img`, `level`) VALUES
(1, 'Ферма', 1280, 120, 'сельское хозяйство', 'img/farm.svg', 1),
(2, 'Огород', 1980, 300, '', 'img/farm.svg', 1),
(3, 'Поле', 3200, 420, '', 'img/farm.svg', 2),
(4, 'Амбар', 4000, 810, '', 'img/farm.svg', 2),
(5, 'Сад', 5480, 720, '', 'img/farm.svg', 3),
(6, 'Колодец', 7200, 1140, '', 'img/farm.svg', 3),
(7, 'Теплица', 7800, 1410, '', 'img/farm.svg', 4),
(8, 'Загон с поросятами', 9000, 1800, '', 'img/farm.svg', 4),
(9, 'Мельница', 12800, 2700, '', 'img/farm.svg', 5),
(10, 'Загон с овцами', 20000, 6000, '', 'img/farm.svg', 5),
(11, 'Мастерская', 24500, 7590, '', 'img/farm.svg', 6),
(12, 'Рыбный пруд', 42800, 17100, '', 'img/farm.svg', 6);

-- --------------------------------------------------------

--
-- Структура таблицы `rules`
--

CREATE TABLE `rules` (
  `season` text NOT NULL,
  `days` int NOT NULL,
  `fuel` float NOT NULL,
  `sales` int NOT NULL,
  `purchases` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `rules`
--

INSERT INTO `rules` (`season`, `days`, `fuel`, `sales`, `purchases`) VALUES
('spring', 14, 280, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `sawmills`
--

CREATE TABLE `sawmills` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` text NOT NULL,
  `research` tinyint(1) NOT NULL,
  `days` int NOT NULL,
  `speed` int NOT NULL,
  `service_cost` int NOT NULL,
  `prod_volume` int NOT NULL,
  `mined` int NOT NULL,
  `mining` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `seeds`
--

CREATE TABLE `seeds` (
  `id` int NOT NULL,
  `name` text NOT NULL,
  `class` text NOT NULL,
  `sale` int NOT NULL,
  `maturation` int NOT NULL,
  `price` int NOT NULL,
  `en_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Дамп данных таблицы `seeds`
--

INSERT INTO `seeds` (`id`, `name`, `class`, `sale`, `maturation`, `price`, `en_name`) VALUES
(1, 'Салат', 'spring', 42, 6, 20, 'salad'),
(2, 'Огурец', 'spring', 165, 10, 70, 'cucumber'),
(3, 'Картофель', 'spring', 120, 10, 50, 'potato'),
(4, 'Репа', 'spring', 330, 12, 100, 'turnip'),
(5, 'Кабачок', 'spring', 262, 12, 100, 'squash'),
(6, 'Цветная капуста', 'spring', 262, 14, 80, 'cauliflower'),
(7, 'Кукуруза', 'summer', 300, 14, 150, 'corn'),
(8, 'Помидор', 'summer', 90, 4, 50, 'tomato'),
(9, 'Редис', 'summer', 335, 6, 200, 'radish'),
(10, 'Перец', 'summer', 390, 10, 100, 'pepper'),
(11, 'Баклажан', 'autumn', 90, 8, 20, 'eggplant'),
(13, 'Свекла', 'autumn', 120, 10, 60, 'beet'),
(14, 'Тыква', 'autumn', 550, 12, 125, 'pumpkin'),
(15, 'Китайская капуста', 'autumn', 120, 6, 50, 'chin_cabbage'),
(16, 'Артишок', 'autumn', 240, 10, 60, 'artichoke');

-- --------------------------------------------------------

--
-- Структура таблицы `storage`
--

CREATE TABLE `storage` (
  `user_id` int NOT NULL,
  `level` int NOT NULL,
  `capacity` int NOT NULL,
  `requirement` int NOT NULL,
  `salad` int NOT NULL,
  `cucumber` int NOT NULL,
  `potato` int NOT NULL,
  `turnip` int NOT NULL,
  `squash` int NOT NULL,
  `cauliflower` int NOT NULL,
  `corn` int NOT NULL,
  `tomato` int NOT NULL,
  `radish` int NOT NULL,
  `pepper` int NOT NULL,
  `eggplant` int NOT NULL,
  `beet` int NOT NULL,
  `pumpkin` int NOT NULL,
  `chin_cabbage` int NOT NULL,
  `artichoke` int NOT NULL,
  `material` int NOT NULL,
  `fuel` int NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `user` varchar(24) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `ref` int NOT NULL,
  `bonus` text NOT NULL,
  `money` int NOT NULL,
  `coins` int NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(128) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `user_feg`
--

CREATE TABLE `user_feg` (
  `feg_id` int NOT NULL,
  `user_id` int NOT NULL,
  `class` text NOT NULL,
  `maturation` int NOT NULL,
  `sale` int NOT NULL,
  `name` text NOT NULL,
  `price` int NOT NULL,
  `en_name` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Структура таблицы `user_objects`
--

CREATE TABLE `user_objects` (
  `object_id` int NOT NULL,
  `user_id` int NOT NULL,
  `name` text NOT NULL,
  `exp` int NOT NULL,
  `price` int NOT NULL,
  `service` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `ban_list`
--
ALTER TABLE `ban_list`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `contracts`
--
ALTER TABLE `contracts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `farms`
--
ALTER TABLE `farms`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `marketplace`
--
ALTER TABLE `marketplace`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `objects`
--
ALTER TABLE `objects`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `sawmills`
--
ALTER TABLE `sawmills`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `seeds`
--
ALTER TABLE `seeds`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `storage`
--
ALTER TABLE `storage`
  ADD PRIMARY KEY (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`);

--
-- Индексы таблицы `user_feg`
--
ALTER TABLE `user_feg`
  ADD PRIMARY KEY (`feg_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `user_objects`
--
ALTER TABLE `user_objects`
  ADD PRIMARY KEY (`object_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `contracts`
--
ALTER TABLE `contracts`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=276;

--
-- AUTO_INCREMENT для таблицы `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `marketplace`
--
ALTER TABLE `marketplace`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `objects`
--
ALTER TABLE `objects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `sawmills`
--
ALTER TABLE `sawmills`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user_feg`
--
ALTER TABLE `user_feg`
  MODIFY `feg_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user_objects`
--
ALTER TABLE `user_objects`
  MODIFY `object_id` int NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
