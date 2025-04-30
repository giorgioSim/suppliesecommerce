-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Εξυπηρετητής: 127.0.0.1
-- Χρόνος δημιουργίας: 29 Απρ 2025 στις 10:03:23
-- Έκδοση διακομιστή: 10.4.32-MariaDB
-- Έκδοση PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `student_store`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `total_price` decimal(10,2) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `customer_email`, `total_price`, `created_at`) VALUES
(1, 'Γεώργιος Συμεωνιδης', 'giorgio.simeon@gmail.com', 0.80, '2025-04-19 16:19:33'),
(2, 'Γεώργιος Συμεωνιδης', 'giorgio.simeon@gmail.com', 50.47, '2025-04-18 16:20:08'),
(3, 'George Symeonidis', 'giorgio.simeon@gmail.com', 12.49, '2025-04-11 16:20:17'),
(4, 'Solonas Poliviou', 'solonas1258@gmail.com', 40.59, '2025-04-20 16:44:47'),
(5, 'George Symeonidis', 'giorgio.simeon@gmail.com', 0.00, '2025-04-20 16:49:53'),
(6, 'George Symeonidis', 'giorgio.simeon@gmail.com', 0.00, '2025-04-20 16:49:54'),
(7, 'George Symeonidis', 'giorgio.simeon@gmail.com', 0.00, '2025-04-20 16:49:55'),
(8, 'Γεώργιος Συμεωνιδης', 'giorgio.simeon@gmail.com', 21.60, '2025-04-20 16:58:58'),
(9, 'Γεώργιος Συμεωνιδης', 'giorgio.simeon@gmail.com', 21.60, '2025-04-20 17:00:33'),
(10, 'Γεώργιος Συμεωνιδης', 'giorgio.simeon@gmail.com', 21.60, '2025-04-20 17:00:36'),
(11, 'Γεώργιος Συμεωνιδης', 'giorgio.simeon@gmail.com', 0.00, '2025-04-20 19:16:36'),
(12, 'Γεώργιος Συμεωνιδης', 'giorgio.simeon@gmail.com', 0.00, '2025-04-20 19:16:37'),
(13, 'Γεώργιος Συμεωνιδης', 'giorgio.simeon@gmail.com', 0.00, '2025-04-20 19:16:39'),
(14, 'Γεώργιος Συμεωνιδης', 'giorgio.simeon@gmail.com', 0.00, '2025-04-20 19:18:31'),
(15, 'Γεώργιος Συμεωνιδης', 'giorgio.simeon@gmail.com', 0.00, '2025-04-20 19:37:54'),
(16, 'Γεώργιος Συμεωνιδης', 'giorgio.simeon@gmail.com', 0.00, '2025-04-20 19:37:56'),
(17, 'George Symeonidis', 'giorgio.simeon@gmail.com', 31.48, '2025-04-22 22:47:06'),
(18, 'George Symeonidis', 'giorgio.simeon@gmail.com', 12.49, '2025-04-22 22:53:37'),
(19, 'George Symeonidis', 'giorgio.simeon@gmail.com', 49.82, '2025-04-23 23:29:27'),
(20, 'George Symeonidis', 'giorgio.simeon@gmail.com', 260.85, '2025-04-25 11:43:01');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`) VALUES
(1, 1, 4, 1),
(2, 2, 3, 2),
(3, 2, 4, 1),
(4, 3, 4, 1),
(5, 4, 3, 1),
(6, 4, 6, 1),
(7, 5, NULL, NULL),
(8, 5, NULL, NULL),
(9, 5, NULL, NULL),
(10, 6, NULL, NULL),
(11, 6, NULL, NULL),
(12, 6, NULL, NULL),
(13, 7, NULL, NULL),
(14, 7, NULL, NULL),
(15, 7, NULL, NULL),
(16, 8, 6, 1),
(17, 9, 6, 1),
(18, 10, 6, 1),
(19, 11, NULL, NULL),
(20, 11, NULL, NULL),
(21, 12, NULL, NULL),
(22, 12, NULL, NULL),
(23, 13, NULL, NULL),
(24, 13, NULL, NULL),
(25, 14, NULL, NULL),
(26, 14, NULL, NULL),
(27, 15, NULL, NULL),
(28, 16, NULL, NULL),
(29, 17, 3, 1),
(30, 17, 4, 1),
(31, 18, 4, 1),
(32, 19, 12, 1),
(33, 20, 8, 1),
(34, 20, 9, 2),
(35, 20, 10, 1),
(36, 20, 12, 3);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Άδειασμα δεδομένων του πίνακα `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `image`, `category`) VALUES
(3, 'Unicorn Notebook', 'Really cute with furr!', 18.99, 'https://i.etsystatic.com/56459136/r/il/452b9e/6671524528/il_600x600.6671524528_ny19.jpg', 'Notebooks'),
(4, 'Paw Highlighter', 'Kawaii and ready to use!', 12.49, 'https://i.etsystatic.com/13103566/r/il/41b192/4025796478/il_600x600.4025796478_1y1q.jpg', 'Pens'),
(5, 'Beige Backpack', 'A nice and stylish bag.', 15.99, 'https://i.etsystatic.com/32348993/r/il/a86604/3625786784/il_fullxfull.3625786784_hvqu.jpg', 'Backpacks'),
(6, 'Pencil Bag', 'It can really fit everything!', 21.60, 'https://i.etsystatic.com/18164750/r/il/d35901/5095743933/il_600x600.5095743933_rnn9.jpg', 'Accessories'),
(7, 'Monet Highlighters', 'Coloured marker pens & highlighters', 13.80, 'https://i.etsystatic.com/18882223/c/750/750/0/115/il/573a5a/4619967114/il_600x600.4619967114_k6x9.jpg', 'Pens'),
(8, 'Custom Journal', 'Your own personal journal!', 25.99, 'https://i.etsystatic.com/24243397/r/il/a4769b/6113599948/il_600x600.6113599948_kiro.jpg', 'Notebooks'),
(9, 'Leather Notebook', 'Leather lined notebook. A5', 32.45, 'https://i.etsystatic.com/18882223/c/766/766/11/11/il/573bff/5959678147/il_600x600.5959678147_1mua.jpg', 'Notebooks'),
(10, 'Toddler Backpack', 'Fun and customizable toddler bag', 20.50, 'https://i.etsystatic.com/55509932/r/il/f8808f/6689442954/il_600x600.6689442954_1oms.jpg', 'Backpacks'),
(11, 'Erasable Pen', 'Cute erasable gel pen!', 1.49, 'https://i.etsystatic.com/17769918/c/2102/2102/97/358/il/7e92a0/6808944988/il_600x600.6808944988_dd9j.jpg', 'Pens'),
(12, 'Cow Backpack', 'A strawberry cow backpack. Ita bag style.', 49.82, 'https://i.etsystatic.com/17358414/c/2803/2803/133/0/il/ff1cb1/6234692463/il_600x600.6234692463_5zan.jpg', 'Backpacks'),
(13, 'Bunny Backpack', 'Kawaai bunny embroidered backpack. ', 47.72, 'https://i.etsystatic.com/33528037/r/il/8c78e5/5494396573/il_600x600.5494396573_fjyc.jpg', 'Backpacks');

--
-- Ευρετήρια για άχρηστους πίνακες
--

--
-- Ευρετήρια για πίνακα `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Ευρετήρια για πίνακα `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Ευρετήρια για πίνακα `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT για άχρηστους πίνακες
--

--
-- AUTO_INCREMENT για πίνακα `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT για πίνακα `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT για πίνακα `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Περιορισμοί για άχρηστους πίνακες
--

--
-- Περιορισμοί για πίνακα `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
