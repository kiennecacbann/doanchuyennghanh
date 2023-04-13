-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 24, 2022 lúc 09:06 AM
-- Phiên bản máy phục vụ: 10.4.25-MariaDB
-- Phiên bản PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `restaurant10`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `room_category`
--

CREATE TABLE `room_category` (
  `id` int(2) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `room_category`
--

INSERT INTO `room_category` (`id`, `name`) VALUES
(1, 'VIP'),
(2, 'COUPLE'),
(3, 'FAMILY'),
(4, 'NORMAL');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_admin`
--

INSERT INTO `tbl_admin` (`id`, `username`, `password`, `name`) VALUES
(1, 'admin1', '21232f297a57a5a743894a0e4a801fc3', 'Kien');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`id`, `category_name`) VALUES
(1, 'FOOD'),
(2, 'DRINK'),
(3, 'DESSERT');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order`
--

CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `user_id` varchar(25) NOT NULL,
  `order_status` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `time` time NOT NULL,
  `payment_method` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_order`
--

INSERT INTO `tbl_order` (`id`, `date`, `address`, `user_id`, `order_status`, `payment_status`, `note`, `time`, `payment_method`) VALUES
(12, '2022-11-22', '123', '107503072198668732017', 0, 0, 'Gửi cho ku tèo', '19:23:54', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order_detail`
--

CREATE TABLE `tbl_order_detail` (
  `id` int(11) NOT NULL,
  `product_id` int(15) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_order_detail`
--

INSERT INTO `tbl_order_detail` (`id`, `product_id`, `quantity`) VALUES
(12, 6, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `price` varchar(30) NOT NULL,
  `category_id` int(11) NOT NULL,
  `details` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`id`, `name`, `image`, `price`, `category_id`, `details`) VALUES
(1, 'Carrot Juice', 'carot.jpg', '20', 2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse ex incidunt magnam vero similique modi quaerat nihil earum cum sapiente, ab tempora deserunt nisi non perferendis odio totam, cupiditate possimus.'),
(2, 'Hamburger', 'hamburger.jpg', '15', 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse ex incidunt magnam vero similique modi quaerat nihil earum cum sapiente, ab tempora deserunt nisi non perferendis odio totam, cupiditate possimus.'),
(3, 'Sandwich', 'sandwich.jpg', '15', 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse ex incidunt magnam vero similique modi quaerat nihil earum cum sapiente, ab tempora deserunt nisi non perferendis odio totam, cupiditate possimus.'),
(4, 'Spaghetti', 'spagetti.jpg', '30', 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse ex incidunt magnam vero similique modi quaerat nihil earum cum sapiente, ab tempora deserunt nisi non perferendis odio totam, cupiditate possimus.'),
(5, 'Braised beef short ribs', 'suon.jpg', '50', 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse ex incidunt magnam vero similique modi quaerat nihil earum cum sapiente, ab tempora deserunt nisi non perferendis odio totam, cupiditate possimus.'),
(6, 'Salad', 'br3.jpg', '10', 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse ex incidunt magnam vero similique modi quaerat nihil earum cum sapiente, ab tempora deserunt nisi non perferendis odio totam, cupiditate possimus.'),
(7, 'Pan-fried goose breast', 'br4.jpg', '50', 1, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse ex incidunt magnam vero similique modi quaerat nihil earum cum sapiente, ab tempora deserunt nisi non perferendis odio totam, cupiditate possimus.'),
(8, 'Watermelon Juice', 'duahau.jpg', '15', 2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse ex incidunt magnam vero similique modi quaerat nihil earum cum sapiente, ab tempora deserunt nisi non perferendis odio totam, cupiditate possimus.'),
(9, 'Guava Juice', 'oi.jpg', '15', 2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse ex incidunt magnam vero similique modi quaerat nihil earum cum sapiente, ab tempora deserunt nisi non perferendis odio totam, cupiditate possimus.'),
(10, 'Fragrant Juice', 'thom.jpg', '15', 2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse ex incidunt magnam vero similique modi quaerat nihil earum cum sapiente, ab tempora deserunt nisi non perferendis odio totam, cupiditate possimus.'),
(11, 'Orange Juice', 'cam.jpg', '15', 2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse ex incidunt magnam vero similique modi quaerat nihil earum cum sapiente, ab tempora deserunt nisi non perferendis odio totam, cupiditate possimus.'),
(12, 'Tomato Juice', 'cachua.jpg', '10', 2, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse ex incidunt magnam vero similique modi quaerat nihil earum cum sapiente, ab tempora deserunt nisi non perferendis odio totam, cupiditate possimus.'),
(13, 'Flan Cake', 'trangmieng1.png', '10', 3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse ex incidunt magnam vero similique modi quaerat nihil earum cum sapiente, ab tempora deserunt nisi non perferendis odio totam, cupiditate possimus.'),
(14, 'Pudding Cake', 'trangmieng2.jpeg', '10', 3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse ex incidunt magnam vero similique modi quaerat nihil earum cum sapiente, ab tempora deserunt nisi non perferendis odio totam, cupiditate possimus.'),
(15, 'Mauri Cake', 'trangmieng3.jpg', '20', 3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse ex incidunt magnam vero similique modi quaerat nihil earum cum sapiente, ab tempora deserunt nisi non perferendis odio totam, cupiditate possimus.'),
(16, 'Ice Cream', 'kem.jpg', '3', 3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse ex incidunt magnam vero similique modi quaerat nihil earum cum sapiente, ab tempora deserunt nisi non perferendis odio totam, cupiditate possimus.'),
(17, 'Fruits', 'traicay.jpg', '20', 3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse ex incidunt magnam vero similique modi quaerat nihil earum cum sapiente, ab tempora deserunt nisi non perferendis odio totam, cupiditate possimus.'),
(18, 'Crepe Cake', 'crepe.jpg', '7', 3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse ex incidunt magnam vero similique modi quaerat nihil earum cum sapiente, ab tempora deserunt nisi non perferendis odio totam, cupiditate possimus.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_room`
--

CREATE TABLE `tbl_room` (
  `id` int(3) NOT NULL,
  `table_amount` int(2) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(50) DEFAULT NULL,
  `current_table` int(2) NOT NULL,
  `room_category_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_room`
--

INSERT INTO `tbl_room` (`id`, `table_amount`, `name`, `image`, `current_table`, `room_category_id`) VALUES
(1, 10, '1-01', '1-01.png', 4, 1),
(2, 10, '1-02', '1-02.png', 1, 2),
(3, 20, '1-03', '1-03.png', 6, 3),
(4, 50, '1-04', '1-04.png', 1, 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_table_booking`
--

CREATE TABLE `tbl_table_booking` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `aop` int(11) NOT NULL,
  `occasion` varchar(50) DEFAULT NULL,
  `time` time NOT NULL,
  `user_id` varchar(25) NOT NULL,
  `status` int(11) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `room_id` int(3) DEFAULT NULL,
  `table_cat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_table_booking`
--

INSERT INTO `tbl_table_booking` (`id`, `date`, `aop`, `occasion`, `time`, `user_id`, `status`, `note`, `room_id`, `table_cat`) VALUES
(13, '2022-11-25', 6, '', '20:05:00', '2955765021394212', 3, '2 em be', 3, 5),
(14, '2022-11-25', 5, '', '17:47:00', '107503072198668732017', 3, 'Gửi cho ku tèo', 3, 2),
(15, '2022-11-25', 104, '', '17:47:00', '107503072198668732017', 0, 'Gửi cho ku tèo', 3, 2);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user_account`
--

CREATE TABLE `tbl_user_account` (
  `id` varchar(25) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `fullname` varchar(255) NOT NULL,
  `phone_number` varchar(10) DEFAULT NULL,
  `email` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `tbl_user_account`
--

INSERT INTO `tbl_user_account` (`id`, `username`, `password`, `fullname`, `phone_number`, `email`) VALUES
('', 'sasa', '202cb962ac59075b964b07152d234b70', 'Yoshino Sae', '0938232936', 'saeyoshino29@gmail.com'),
('107503072198668732017', NULL, NULL, '6430_Nguyễn Đức Minh Trung', NULL, 'saeyoshino2901@gmail.com'),
('2955765021394212', NULL, NULL, 'Nguyễn Đức Minh Trung', NULL, 'saeyoshino2901@gmail.com');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `room_category`
--
ALTER TABLE `room_category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD PRIMARY KEY (`id`,`product_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `tbl_room`
--
ALTER TABLE `tbl_room`
  ADD PRIMARY KEY (`id`),
  ADD KEY `room_category_id` (`room_category_id`);

--
-- Chỉ mục cho bảng `tbl_table_booking`
--
ALTER TABLE `tbl_table_booking`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Chỉ mục cho bảng `tbl_user_account`
--
ALTER TABLE `tbl_user_account`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `room_category`
--
ALTER TABLE `room_category`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT cho bảng `tbl_room`
--
ALTER TABLE `tbl_room`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbl_table_booking`
--
ALTER TABLE `tbl_table_booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD CONSTRAINT `tbl_order_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_user_account` (`id`);

--
-- Các ràng buộc cho bảng `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD CONSTRAINT `tbl_order_detail_ibfk_1` FOREIGN KEY (`id`) REFERENCES `tbl_order` (`id`),
  ADD CONSTRAINT `tbl_order_detail_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `tbl_product` (`id`);

--
-- Các ràng buộc cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `tbl_product_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `tbl_category` (`id`);

--
-- Các ràng buộc cho bảng `tbl_room`
--
ALTER TABLE `tbl_room`
  ADD CONSTRAINT `tbl_room_ibfk_1` FOREIGN KEY (`room_category_id`) REFERENCES `room_category` (`id`);

--
-- Các ràng buộc cho bảng `tbl_table_booking`
--
ALTER TABLE `tbl_table_booking`
  ADD CONSTRAINT `tbl_table_booking_ibfk_3` FOREIGN KEY (`user_id`) REFERENCES `tbl_user_account` (`id`),
  ADD CONSTRAINT `tbl_table_booking_ibfk_4` FOREIGN KEY (`room_id`) REFERENCES `tbl_room` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
