-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 16 Sep 2025 pada 16.39
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `akademik_db_w4`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `course_code` varchar(10) NOT NULL,
  `course_name` varchar(150) NOT NULL,
  `credits` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `courses`
--

INSERT INTO `courses` (`id`, `course_code`, `course_name`, `credits`) VALUES
(1, 'IF101', 'Algoritma dan Pemrograman', 3),
(2, 'IF102', 'Struktur Data', 3),
(3, 'UM101', 'Pendidikan Pancasila', 2),
(4, 'IF201', 'Basis Data', 3),
(5, 'IF202', 'Pemrograman Berorientasi Objek', 4),
(6, 'IF301', 'Rekayasa Perangkat Lunak', 4),
(7, 'IF302', 'Jaringan Komputer', 3),
(8, 'IF303', 'Sistem Operasi', 3),
(9, 'IF401', 'Kecerdasan Buatan', 3),
(10, 'IF402', 'Pemrograman Web Lanjut', 4),
(11, 'IF403', 'Keamanan Informasi', 3),
(12, 'IF501', 'Pemrograman Mobile', 4),
(13, 'IF502', 'Manajemen Proyek TI', 3),
(14, 'IF503', 'Interaksi Manusia dan Komputer', 3),
(15, 'IF601', 'Data Mining dan Data Warehouse', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `nim` varchar(20) NOT NULL,
  `age` int(3) DEFAULT NULL,
  `entry_year` year(4) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `students`
--

INSERT INTO `students` (`id`, `nim`, `age`, `entry_year`, `user_id`) VALUES
(8, '-', 90, '2000', 8),
(9, '241511083', 23, '2006', 9),
(10, '241511089', 18, '2025', 10),
(11, '241511079_', 19, '2024', 11);

-- --------------------------------------------------------

--
-- Struktur dari tabel `takes`
--

CREATE TABLE `takes` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `enroll_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `takes`
--

INSERT INTO `takes` (`id`, `student_id`, `course_id`, `enroll_date`) VALUES
(23, 9, 1, '2025-09-16'),
(24, 9, 2, '2025-09-16'),
(25, 9, 3, '2025-09-16'),
(26, 9, 4, '2025-09-16'),
(27, 9, 5, '2025-09-16'),
(34, 10, 1, '2025-09-16'),
(35, 10, 2, '2025-09-16'),
(36, 10, 4, '2025-09-16'),
(37, 10, 13, '2025-09-16'),
(38, 10, 15, '2025-09-16'),
(39, 11, 1, '2025-09-16'),
(40, 11, 2, '2025-09-16'),
(41, 11, 4, '2025-09-16'),
(42, 11, 5, '2025-09-16'),
(43, 11, 7, '2025-09-16'),
(44, 11, 8, '2025-09-16'),
(45, 11, 9, '2025-09-16'),
(46, 11, 10, '2025-09-16'),
(47, 11, 12, '2025-09-16'),
(48, 11, 15, '2025-09-16');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(150) NOT NULL,
  `role` enum('admin','mahasiswa') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `role`, `created_at`) VALUES
(8, 'admin', '$2y$10$H5PwR.rwJQhwfnfxUdeUtOH3lpUVPNho/Al1E31ImrDuiokTVsUly', 'administrator', 'admin', '2025-09-16 05:43:20'),
(9, 'ihsan', '$2y$10$0BB9eaP5EahBIMiWfzMkEuMGhn/vmp8nkfw22AcP8Lh9F7saXSszK', 'Ihsan', 'mahasiswa', '2025-09-16 06:07:49'),
(10, 'mistik', '$2y$10$lnXk83j4t60Kr0Kq.rm6J.lpQz1WGlRYCIOQQ4Vjxlp37oHwHR2lO', 'mistik', 'mahasiswa', '2025-09-16 06:20:15'),
(11, 'ibnuu', '$2y$10$jneH5UbEzbjQBTHFWfEdqeeyZJ4KFy8s8HVy5na9MjnUmirVJunNa', 'ibnu', 'mahasiswa', '2025-09-16 07:02:17');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `course_code` (`course_code`);

--
-- Indeks untuk tabel `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nim` (`nim`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `takes`
--
ALTER TABLE `takes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `takes`
--
ALTER TABLE `takes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `takes`
--
ALTER TABLE `takes`
  ADD CONSTRAINT `takes_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `takes_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
