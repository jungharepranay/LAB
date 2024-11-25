CREATE DATABASE attendance;

USE attendance;

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` enum('Present','Absent') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;



INSERT INTO `attendance` (`id`, `student_id`, `date`, `status`) VALUES
(1, 1, '2024-11-24', 'Present'),
(2, 2, '2024-11-24', 'Present'),
(3, 3, '2024-11-24', 'Absent'),
(4, 4, '2024-11-24', 'Present'),
(5, 1, '2024-11-25', 'Present'),
(6, 2, '2024-11-25', 'Present'),
(7, 3, '2024-11-25', 'Present'),
(8, 4, '2024-11-25', 'Absent');



CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `roll_no` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `students` (`id`, `roll_no`, `name`, `email`, `created_at`) VALUES
(1, '49', 'smeet', 'smeet@gmail.com', '2024-11-24 10:58:26'),
(2, '50', 'dev', 'dev@gmail.com', '2024-11-24 10:58:36'),
(3, '52', 'bhavesh', 'bhavesh@gmail.com', '2024-11-24 10:58:49'),
(4, '54', 'anurag', 'anurag@gmail.com', '2024-11-24 10:59:01');


CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


INSERT INTO `teachers` (`id`, `username`, `password`) VALUES
(1, 'OmDeshmukh', '$2y$10$nuAiv8IZOPmLh1tmBNVvCODCoE6TDosVr/u1uH9Urvk1uYpshxIO6');


ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);


ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roll_no` (`roll_no`),
  ADD UNIQUE KEY `email` (`email`);


ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);


ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;


ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;


ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

COMMIT;

-------------------------------------------------------------------------------

http://localhost:8080/27/attendance-system/index.php
