-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 01, 2022 lúc 05:32 PM
-- Phiên bản máy phục vụ: 10.4.19-MariaDB
-- Phiên bản PHP: 8.0.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `php2_asm1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `answers`
--

CREATE TABLE `answers` (
  `id` int(11) NOT NULL,
  `content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `question_id` int(11) DEFAULT NULL,
  `is_correct` int(11) DEFAULT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `answers`
--

INSERT INTO `answers` (`id`, `content`, `question_id`, `is_correct`, `img`) VALUES
(36, '63', 40, 1, NULL),
(37, '61', 40, 0, NULL),
(38, '62', 40, 0, NULL),
(39, '64', 40, 0, NULL),
(40, 'Tên ai đó', 41, 0, NULL),
(41, 'Ngôn ngữ lập trình', 41, 1, NULL),
(42, 'Tên đồ vật', 41, 0, NULL),
(43, 'Tên ai đó', 41, 0, NULL),
(60, '1', 46, 0, NULL),
(61, '2', 46, 0, NULL),
(62, '3', 46, 1, NULL),
(63, '4', 46, 0, NULL),
(84, '60', 52, 0, NULL),
(85, '63', 52, 1, NULL),
(86, '61', 52, 0, NULL),
(87, '62', 52, 0, NULL),
(88, '73', 53, 1, NULL),
(89, '222', 53, 0, NULL),
(90, '62', 53, 0, NULL),
(91, '44', 53, 0, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `questions`
--

INSERT INTO `questions` (`id`, `name`, `quiz_id`, `img`) VALUES
(40, 'Việt nam có bao nhiêu tỉnh???', 20, NULL),
(41, 'Php là gì?', 20, NULL),
(46, 'FPOLY', 20, NULL),
(52, 'Việt Nam có bao nhiêu tỉnh?', 31, NULL),
(53, '50+23=?', 31, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quizs`
--

CREATE TABLE `quizs` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `duration_minutes` int(11) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `is_shuffle` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `quizs`
--

INSERT INTO `quizs` (`id`, `name`, `subject_id`, `duration_minutes`, `start_time`, `end_time`, `status`, `is_shuffle`) VALUES
(16, 'quiz 2', 1, 15, '1970-01-01 01:00:00', '1970-01-01 01:00:00', 1, 0),
(20, 'quiz 1', 3, 15, '2022-02-22 17:41:00', '2022-02-28 09:06:00', 1, 0),
(31, 'quiz 2', 3, 15, '2022-04-02 00:00:00', '2022-03-16 00:00:00', 1, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Giáo viên'),
(2, 'Sinh viên');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student_quizs`
--

CREATE TABLE `student_quizs` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `quiz_id` int(11) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `count_asnwer` int(2) DEFAULT NULL,
  `count_asnwer_correct` int(2) DEFAULT NULL,
  `score` decimal(4,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `student_quizs`
--

INSERT INTO `student_quizs` (`id`, `student_id`, `quiz_id`, `start_time`, `end_time`, `count_asnwer`, `count_asnwer_correct`, `score`) VALUES
(33, 10, 20, '2022-03-01 21:48:42', '2022-03-01 21:48:51', 3, 3, '10.00'),
(34, 9, 31, '2022-03-01 23:01:44', '2022-03-01 23:01:52', 2, 1, '5.00');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `student_quiz_detail`
--

CREATE TABLE `student_quiz_detail` (
  `student_quiz_id` int(11) NOT NULL,
  `quiz_id` int(11) NOT NULL,
  `answer_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `student_quiz_detail`
--

INSERT INTO `student_quiz_detail` (`student_quiz_id`, `quiz_id`, `answer_id`, `question_id`) VALUES
(33, 20, 36, 40),
(33, 20, 41, 41),
(33, 20, 62, 46),
(34, 31, 85, 52),
(34, 31, 89, 53);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `author_id`) VALUES
(1, 'Tin học cơ sở3', 10),
(2, 'Nhập môn lập trình', 10),
(3, 'Lập trình PHP2', 10),
(5, 'Lập trình C++', 10);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role_id` int(11) DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`, `role_id`) VALUES
(9, 'sv quan', 'quandmph13848@fpt.edu.vn', '$2y$10$7O.5WZ3gT9EGe3C/1SXTruThYl44n.xBwY9YkmTUZ.wgNwF2Wf1va', NULL, 2),
(10, 'gv quan', 'admin@gmail.com', '$2y$10$dXopDjJJPpYdaueww8c0jeylNFWkWVaH9kfyY6GY/hrCwYVE8qKQ2', NULL, 1),
(11, 'Quân Đỗ Minh Quân', 'quandmph13848@fpt.edu.vn', '$2y$10$aYxntK1E/XKf0anYS3iGg.3FuCmIecbI73j9ByZbaYcDVVW/vLtxG', NULL, 1),
(12, 'Quân Đỗ Minh Quân', 'quandmph13848@fpt.edu.vn', '$2y$10$UvTDCnbOfiMyM6kONHt9vu0GYeLhSvXD0PmQIzF08VeVndw7R.MvS', NULL, 1),
(13, 'Quân Đỗ Minh Quân', 'quandmph13848d@fpt.edu.vn', '$2y$10$0kMS726mE/NeA0ph6M4WrePRz/WGJSFu72nrQPB0mMZPlQBa3NG3i', NULL, 1),
(14, 'Quân Đỗ Minh Quân3', 'admin@gmail.com22', '$2y$10$XeMDVf.AgZDDBESzmrSWKeZz8A8Xi9CqOB8RmMDPw28y.rW0QQy9O', NULL, 1),
(15, 'Quân Đỗ Minh Quân', 'admin@gmail.com123', '$2y$10$AZtTISFGrjDnFXv3OyHBfecGb9WgFpWPFShdUBffzR.iuohVoaGPe', NULL, 2);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_answer_quesion` (`question_id`);

--
-- Chỉ mục cho bảng `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ques_quiz` (`quiz_id`);

--
-- Chỉ mục cho bảng `quizs`
--
ALTER TABLE `quizs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_quiz_sub` (`subject_id`);

--
-- Chỉ mục cho bảng `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `student_quizs`
--
ALTER TABLE `student_quizs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_stuQuiz_quizs` (`quiz_id`),
  ADD KEY `fk_stuQuiz_user` (`student_id`);

--
-- Chỉ mục cho bảng `student_quiz_detail`
--
ALTER TABLE `student_quiz_detail`
  ADD PRIMARY KEY (`student_quiz_id`,`quiz_id`,`answer_id`),
  ADD KEY `fk_stuQuizDetail_answers` (`answer_id`),
  ADD KEY `fk_stuQuizDetail_quiz` (`quiz_id`);

--
-- Chỉ mục cho bảng `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sub_user` (`author_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_role` (`role_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT cho bảng `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT cho bảng `quizs`
--
ALTER TABLE `quizs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT cho bảng `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `student_quizs`
--
ALTER TABLE `student_quizs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT cho bảng `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `fk_answer_quesion` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Các ràng buộc cho bảng `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `fk_ques_quiz` FOREIGN KEY (`quiz_id`) REFERENCES `quizs` (`id`);

--
-- Các ràng buộc cho bảng `quizs`
--
ALTER TABLE `quizs`
  ADD CONSTRAINT `fk_quiz_sub` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);

--
-- Các ràng buộc cho bảng `student_quizs`
--
ALTER TABLE `student_quizs`
  ADD CONSTRAINT `fk_stuQuiz_quizs` FOREIGN KEY (`quiz_id`) REFERENCES `quizs` (`id`),
  ADD CONSTRAINT `fk_stuQuiz_user` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `student_quiz_detail`
--
ALTER TABLE `student_quiz_detail`
  ADD CONSTRAINT `fk_stuQuizDetail_answers` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`),
  ADD CONSTRAINT `fk_stuQuizDetail_quiz` FOREIGN KEY (`quiz_id`) REFERENCES `quizs` (`id`),
  ADD CONSTRAINT `fk_stuQuizDetail_stuQuiz` FOREIGN KEY (`student_quiz_id`) REFERENCES `student_quizs` (`id`);

--
-- Các ràng buộc cho bảng `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `fk_sub_user` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);

--
-- Các ràng buộc cho bảng `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
