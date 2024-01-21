-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2024 at 05:25 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `imms_psu`
--

-- --------------------------------------------------------

--
-- Table structure for table `campuses`
--

CREATE TABLE `campuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `campus_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `location` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campuses`
--

INSERT INTO `campuses` (`id`, `campus_name`, `location`, `created_at`, `updated_at`) VALUES
(1, 'Lingayen', 'Alvear E, Poblacion, Lingayen, Pangasinan', '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(2, 'Alaminos', 'Bolaney, Alaminos City, Pangasinan', '2023-12-15 23:58:53', '2023-12-28 05:30:21'),
(3, 'Asingan', 'Domanpot, Asingan, Pangasinan', '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(4, 'Bayambang', 'Quezon Blvd, Bayambang, Pangasinan', '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(5, 'Binmaley', 'Barangay San Isidro Norte, Binmaley, Pangasinan', '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(6, 'Infanta', 'Brgy. Bamban, Infanta, Pangasinan', '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(7, 'San Carlos', 'Roxas Boulevard, San Carlos City, Pangasinan', '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(8, 'Sta Maria', 'Sitio Cuangao, Namagbagan Sta. Maria, Pangasinan', '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(9, 'Urdaneta', 'San Vicente Urdaneta, Pangasinan', '2023-12-15 23:58:53', '2023-12-15 23:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `colleges`
--

CREATE TABLE `colleges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `college_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `campus_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colleges`
--

INSERT INTO `colleges` (`id`, `college_name`, `description`, `campus_id`, `created_at`, `updated_at`) VALUES
(1, 'College of Computing', 'The College of Computing is a dynamic hub for computer science and technology education, offering a comprehensive curriculum and hands-on projects that prepare students to thrive in the fast-paced world of technology.', 9, '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(2, 'College of Arts and Education', 'The College of Arts and Education is a vibrant academic institution fostering creativity and excellence in the fine arts, humanities, social sciences, and education. Our diverse curriculum, supportive faculty, and emphasis on experiential learning equip graduates for impactful roles in the arts, education, and beyond.', 9, '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(3, 'College of Engineering and Architecture', 'The College of Engineering and Architecture is a premier institution focused on excellence in engineering and architectural education. Our hands-on approach, guided by experienced faculty, equips students with the skills and knowledge for impactful careers in these dynamic fields.', 9, '2023-12-15 23:58:53', '2023-12-15 23:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `campus_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_name`, `campus_id`, `created_at`, `updated_at`) VALUES
(1, 'Bachelor of Science in Information Technology', 9, '2023-12-16 07:52:02', '2023-12-16 07:52:02'),
(2, 'Bachelor of Science in Mathematics', 9, '2023-12-16 07:52:02', '2023-12-16 07:52:02'),
(3, 'Bachelor of Secondary Education major in Filipino', 9, '2023-12-16 07:52:02', '2023-12-16 07:52:02'),
(4, 'Bachelor of Secondary Education major in Science', 9, '2023-12-16 07:52:02', '2023-12-16 07:52:02'),
(5, 'Bachelor of Arts in English Language', 9, '2023-12-16 07:52:02', '2023-12-27 10:37:54'),
(6, 'Bachelor of Early Childhood Education', 9, '2023-12-16 07:52:02', '2023-12-16 07:52:02'),
(7, 'Bachelor of Science in Architecture', 9, '2023-12-16 07:52:02', '2023-12-16 07:52:02'),
(8, 'Bachelor of Science in Civil Engineering', 9, '2023-12-16 07:52:02', '2023-12-16 07:52:02'),
(9, 'Bachelor of Science in Computer Engineering', 9, '2023-12-16 07:52:02', '2023-12-16 07:52:02'),
(10, 'Bachelor of Science in Mechanical Engineering', 9, '2023-12-16 07:52:02', '2023-12-16 07:52:02'),
(11, 'Bachelor of Science in Electrical Engineering', 9, '2023-12-16 07:52:02', '2023-12-16 07:52:02'),
(17, 'Bachelor Of Science In Civil Engineering', 1, '2024-01-11 06:30:46', '2024-01-11 06:30:46');

-- --------------------------------------------------------

--
-- Table structure for table `course_colleges`
--

CREATE TABLE `course_colleges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `college_id` bigint(20) UNSIGNED NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `course_colleges`
--

INSERT INTO `course_colleges` (`id`, `college_id`, `course_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2023-12-16 07:52:37', '2023-12-16 07:52:37'),
(2, 1, 2, '2023-12-16 07:52:37', '2023-12-16 07:52:37'),
(3, 2, 3, '2023-12-16 07:52:37', '2023-12-16 07:52:37'),
(4, 2, 4, '2023-12-16 07:52:37', '2023-12-16 07:52:37'),
(5, 2, 5, '2023-12-16 07:52:37', '2023-12-16 07:52:37'),
(6, 2, 6, '2023-12-16 07:52:37', '2023-12-16 07:52:37'),
(7, 3, 7, '2023-12-16 07:52:37', '2023-12-16 07:52:37'),
(8, 3, 8, '2023-12-16 07:52:37', '2023-12-16 07:52:37'),
(9, 3, 9, '2023-12-16 07:52:37', '2023-12-16 07:52:37'),
(10, 3, 10, '2023-12-16 07:52:37', '2023-12-16 07:52:37'),
(11, 3, 11, '2023-12-16 07:52:37', '2023-12-16 07:52:37');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `department_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `campus_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `department_name`, `campus_id`, `created_at`, `updated_at`) VALUES
(1, 'Information Technology Department', 9, '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(2, 'Secondary Education Department', 9, '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(3, 'Arts in English Language Department', 9, '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(4, 'Early Childhood Education Department', 9, '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(5, 'Architecture Department', 9, '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(6, 'Civil Engineering Department', 9, '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(7, 'Computer Engineering Department', 9, '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(8, 'Mechanical Engineering Department', 9, '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(9, 'Electrical Engineering Department', 9, '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(10, 'Mathematics Department', 9, '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(13, 'Civil Engineering Department', 1, '2024-01-11 06:31:05', '2024-01-11 06:31:05');

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

CREATE TABLE `evaluations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `matrix_id` bigint(20) UNSIGNED NOT NULL,
  `material_id` bigint(20) UNSIGNED NOT NULL,
  `evaluator_id` bigint(20) UNSIGNED NOT NULL,
  `passed_criteria` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('passed','failed') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evaluations`
--

INSERT INTO `evaluations` (`id`, `matrix_id`, `material_id`, `evaluator_id`, `passed_criteria`, `comment`, `status`, `created_at`, `updated_at`) VALUES
(47, 1, 28, 15, '<div class=\"mb-2 text-md font-medium text-gray-800 dark:text-white\">Content<ul class=\"max-w-md space-y-1 list-disc list-inside\"><li class=\"font-normal text-gray-600\">Assessment Alignment (10%) : Score 0%</li><li class=\"font-normal text-gray-600\">Clarity and Coherence (20%) : Score 0%</li><li class=\"font-normal text-gray-600\">Content Relevance (40%) : Score 0%</li><li class=\"font-normal text-gray-600\">Inclusivity and Diversity (20%) : Score 0%</li><li class=\"font-normal text-gray-600\">Multimodal Presentation (10%) : Score 0%</li></ul></div><div class=\"mb-2 text-md font-medium text-gray-800 dark:text-white\">Layout<ul class=\"max-w-md space-y-1 list-disc list-inside\"><li class=\"font-normal text-gray-600\">Accessibility and Navigation (20%) : Score 0%</li><li class=\"font-normal text-gray-600\">Consistency in Design (20%) : Score 0%</li><li class=\"font-normal text-gray-600\">Use of Visual Elements (10%) : Score 0%</li><li class=\"font-normal text-gray-600\">Visual Hierarchy (30%) : Score 0%</li><li class=\"font-normal text-gray-600\">Whitespace and Margins (20%) : Score 0%</li></ul></div><p class=\"font-medium text-md text-gray-800 dark:text-white\">Average Score: 0%</p>', 'cant view should be pdf', 'failed', '2024-01-15 07:36:55', '2024-01-15 07:36:55'),
(48, 1, 28, 15, '<div class=\"mb-2 text-md font-medium text-gray-800 dark:text-white\">Content<ul class=\"max-w-md space-y-1 list-disc list-inside\"><li class=\"font-normal text-gray-600\">Assessment Alignment : 10%</li><li class=\"font-normal text-gray-600\">Clarity and Coherence : 11%</li><li class=\"font-normal text-gray-600\">Content Relevance : 10%</li><li class=\"font-normal text-gray-600\">Inclusivity and Diversity : 10%</li></ul></div><div class=\"mb-2 text-md font-medium text-gray-800 dark:text-white\">Layout<ul class=\"max-w-md space-y-1 list-disc list-inside\"><li class=\"font-normal text-gray-600\">Accessibility and Navigation : 2%</li><li class=\"font-normal text-gray-600\">Consistency in Design : 10%</li><li class=\"font-normal text-gray-600\">Use of Visual Elements : 10%</li><li class=\"font-normal text-gray-600\">Visual Hierarchy : 2%</li><li class=\"font-normal text-gray-600\">Whitespace and Margins : 0%</li></ul></div><p class=\"font-medium text-md text-gray-800 dark:text-white\">Total Score: 65%</p>', 'kulang', 'failed', '2024-01-15 08:16:22', '2024-01-15 08:16:22');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_stages`
--

CREATE TABLE `evaluation_stages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `matrix_id` bigint(20) UNSIGNED NOT NULL,
  `material_id` bigint(20) UNSIGNED NOT NULL,
  `stage` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evaluation_stages`
--

INSERT INTO `evaluation_stages` (`id`, `matrix_id`, `material_id`, `stage`, `created_at`, `updated_at`) VALUES
(27, 1, 28, 1, '2024-01-15 07:35:34', '2024-01-15 07:35:34');

-- --------------------------------------------------------

--
-- Table structure for table `evaluator_matrices`
--

CREATE TABLE `evaluator_matrices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `evaluator_id` bigint(20) UNSIGNED NOT NULL,
  `matrix_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evaluator_matrices`
--

INSERT INTO `evaluator_matrices` (`id`, `evaluator_id`, `matrix_id`, `created_at`, `updated_at`) VALUES
(17, 15, 1, '2024-01-07 11:12:07', '2024-01-07 11:12:07'),
(19, 13, 4, '2024-01-07 11:16:24', '2024-01-07 11:16:24'),
(21, 18, 1, '2024-01-08 23:30:29', '2024-01-08 23:30:29'),
(24, 12, 7, '2024-01-11 06:16:49', '2024-01-11 06:16:49'),
(26, 17, 10, '2024-01-11 10:58:32', '2024-01-11 10:58:32'),
(27, 19, 1, '2024-01-11 10:59:35', '2024-01-11 10:59:35');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `instructional_materials`
--

CREATE TABLE `instructional_materials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pdf_path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `proponents` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `course_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `campus_id` bigint(20) UNSIGNED NOT NULL,
  `submitter_id` bigint(20) UNSIGNED NOT NULL,
  `type` enum('course_book','textbook','modules','laboratory_manual','prototype','others') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','evaluating','resubmission','approved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instructional_materials`
--

INSERT INTO `instructional_materials` (`id`, `title`, `pdf_path`, `proponents`, `course_id`, `department_id`, `campus_id`, `submitter_id`, `type`, `status`, `created_at`, `updated_at`) VALUES
(28, 'Test IM', 'storage/pdfs/1705333123_chart.png', 'Vhon Bautista', 7, 6, 9, 20, 'course_book', 'resubmission', '2024-01-15 07:35:34', '2024-01-15 08:16:22');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `area`, `title`, `action`, `description`, `user_id`, `created_at`, `updated_at`) VALUES
(43, 'submission_management', 'Evaluation Submitted', 'submitted', 'Campus Evaluator submitted an evaluation regarding your Instructional Material titled \"In similique cupidit\".', 15, '2024-01-11 10:36:56', '2024-01-11 10:36:56'),
(45, 'submission_management', 'Evaluation Submitted', 'submitted', 'Campus Evaluator submitted an evaluation regarding your Instructional Material titled \"In similique cupidit\".', 15, '2024-01-11 10:46:26', '2024-01-11 10:46:26'),
(46, 'evaluator.evaluation_management', 'New Material for Evaluation', 'added', 'Campus2 Evaluator has given approval for the instructional material titled \",\" advancing it to the next stage of evaluation.', 18, '2024-01-11 10:49:14', '2024-01-11 10:49:14'),
(47, 'submission_management', 'Evaluation Submitted', 'submitted', 'Campus2 Evaluator submitted an evaluation regarding your Instructional Material titled \"In similique cupidit\".', 18, '2024-01-11 10:49:14', '2024-01-11 10:49:14'),
(48, 'submission_management', 'Evaluation Submitted', 'submitted', 'CFL Evaluator submitted an evaluation regarding your Instructional Material titled \"In similique cupidit\".', 12, '2024-01-11 10:50:05', '2024-01-11 10:50:05'),
(50, 'evaluator.evaluation_management', 'New Material for Evaluation', 'added', 'CFL Evaluator has given approval for the instructional material titled \",\" advancing it to the next stage of evaluation.', 12, '2024-01-11 10:51:11', '2024-01-11 10:51:11'),
(51, 'submission_management', 'Evaluation Submitted', 'submitted', 'CFL Evaluator submitted an evaluation regarding your Instructional Material titled \"In similique cupidit\".', 12, '2024-01-11 10:51:11', '2024-01-11 10:51:11'),
(52, 'submission_management', 'Evaluation Submitted', 'submitted', 'University Evaluator submitted an evaluation regarding your Instructional Material titled \"In similique cupidit\".', 13, '2024-01-11 10:52:16', '2024-01-11 10:52:16'),
(53, 'evaluator.evaluation_management', 'New Material for Evaluation', 'added', 'University Evaluator has given approval for the instructional material titled \",\" advancing it to the next stage of evaluation.', 13, '2024-01-11 11:05:07', '2024-01-11 11:05:07'),
(54, 'submission_management', 'Evaluation Submitted', 'submitted', 'University Evaluator submitted an evaluation regarding your Instructional Material titled \"In similique cupidit\".', 13, '2024-01-11 11:05:08', '2024-01-11 11:05:08'),
(55, 'submission_management', 'Evaluation Submitted', 'submitted', 'Vice President submitted an evaluation regarding your Instructional Material titled \"In similique cupidit\".', 17, '2024-01-11 11:05:36', '2024-01-11 11:05:36'),
(58, 'submission_management', 'Evaluation Submitted', 'submitted', 'Campus Evaluator submitted an evaluation regarding your Instructional Material titled \"Mollitia amet quis\".', 15, '2024-01-12 00:18:50', '2024-01-12 00:18:50'),
(60, 'submission_management', 'Evaluation Submitted', 'submitted', 'Campus Evaluator submitted an evaluation regarding your Instructional Material titled \"Mollitia amet quis\".', 15, '2024-01-12 00:20:50', '2024-01-12 00:20:50'),
(61, 'submission_management', 'Evaluation Submitted', 'submitted', 'Campus2 Evaluator submitted an evaluation regarding your Instructional Material titled \"Mollitia amet quis\".', 18, '2024-01-12 00:22:01', '2024-01-12 00:22:01'),
(62, 'evaluator.evaluation_management', 'New Instructional Material Submitted', 'submitted', 'User Regular submitted a new Instructional Material titled \"Test IM\".', 20, '2024-01-15 07:35:34', '2024-01-15 07:35:34'),
(63, 'submission_management', 'Evaluation Submitted', 'submitted', 'Campus Evaluator submitted an evaluation regarding your Instructional Material titled \"Test IM\".', 15, '2024-01-15 07:36:55', '2024-01-15 07:36:55'),
(64, 'evaluator.evaluation_management', 'Instructional Material Resubmitted', 'submitted', 'User Regular resubmitted the Instructional Material titled \"Test IM\".', 20, '2024-01-15 07:38:43', '2024-01-15 07:38:43'),
(65, 'submission_management', 'Evaluation Submitted', 'submitted', 'Campus Evaluator submitted an evaluation regarding your Instructional Material titled \"Test IM\".', 15, '2024-01-15 08:16:22', '2024-01-15 08:16:22');

-- --------------------------------------------------------

--
-- Table structure for table `matrices`
--

CREATE TABLE `matrices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `matrix_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `campus_id` bigint(20) UNSIGNED DEFAULT NULL,
  `level` enum('campus','university') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'campus',
  `stage` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `matrices`
--

INSERT INTO `matrices` (`id`, `matrix_name`, `description`, `campus_id`, `level`, `stage`, `created_at`, `updated_at`) VALUES
(1, 'Material Content Evaluation', 'The Department Matrix for Instructional Materials, systematically evaluates educational materials to ensure alignment with curriculum goals and standards. Using categories, sub-matrices, and detailed criteria, the matrix facilitates a quality assurance process through standardized scoring and feedback loops. This strategic tool empowers decision-makers to make informed choices, fostering continual improvement in instructional materials for an enhanced educational experience.', 9, 'campus', 1, '2024-01-29 05:56:33', '2024-01-06 20:20:41'),
(4, 'Academic Institution Evaluation', 'Academic Institution Evaluation is a comprehensive and structured framework designed to assess the overall performance and effectiveness of educational institutions. This systematic approach involves the meticulous examination of various key facets that contribute to the institution\'s quality, reputation, and impact within the academic landscape.', 1, 'university', 3, '2024-01-07 10:53:27', '2024-01-07 10:53:27'),
(7, 'Plagiarism Evaluation', 'The Plagiarism Evaluation Matrix is designed to assess instructional materials for the presence of plagiarized content. Plagiarism can undermine the integrity of educational resources and compromise the learning experience. This matrix focuses on identifying and mitigating instances of plagiarism in instructional materials, ensuring that the content is original, properly cited, and adheres to ethical standards.', 1, 'university', 2, '2024-01-11 05:46:17', '2024-01-11 05:46:17'),
(10, 'Vice President Evaluation', 'The Vice President of Evaluation oversees the critical task of assessing instructional materials to ensure they meet the highest standards of quality and effectiveness. This role involves evaluating various educational resources, considering factors such as accuracy, alignment with learning objectives, and overall instructional value. The Vice President of Evaluation plays a key role in shaping the educational experience by ensuring that instructional materials contribute positively to the learning outcomes of students and educators alike.', 1, 'university', 4, '2024-01-11 10:55:51', '2024-01-11 10:55:51');

-- --------------------------------------------------------

--
-- Table structure for table `matrix_items`
--

CREATE TABLE `matrix_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` int(11) NOT NULL DEFAULT 0,
  `sub_matrix_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `matrix_items`
--

INSERT INTO `matrix_items` (`id`, `item`, `text`, `score`, `sub_matrix_id`, `created_at`, `updated_at`) VALUES
(1, 'Content Relevance', 'Assess the alignment of instructional content with defined learning objectives and curriculum standards. Evaluate whether the material addresses key concepts, skills, and competencies essential for the targeted educational level.', 10, 1, '2024-01-31 06:01:46', '2024-01-31 06:01:46'),
(2, 'Clarity and Coherence', 'Examine the clarity and coherence of the instructional content. Evaluate how well the material presents information, ensuring it is easily understandable for the intended audience and follows a logical progression.', 20, 1, '2023-07-16 05:22:48', '2023-07-16 05:22:48'),
(4, 'Assessment Alignment', 'Evaluate the alignment of assessment tools within the instructional material with the learning objectives. Ensure that assessments effectively measure student understanding and mastery of the content.', 10, 1, '2023-07-16 05:22:48', '2023-07-16 05:22:48'),
(5, 'Inclusivity and Diversity', 'Consider the inclusivity and diversity of the instructional content, assessing whether it reflects a variety of perspectives, cultures, and experiences. Ensure that the material is accessible and resonates with a diverse student population.', 10, 1, '2023-07-16 05:22:48', '2023-07-16 05:22:48'),
(6, 'Visual Hierarchy', 'Assess the visual hierarchy of the instructional material\'s layout, examining how well it guides the reader\'s attention. Evaluate the use of headings, subheadings, and other design elements to prioritize information and enhance overall readability.', 10, 2, '2023-06-26 07:04:23', '2023-07-16 07:12:19'),
(7, 'Consistency in Design', 'Evaluate the consistency in design elements throughout the instructional material. Check for uniformity in fonts, colors, and formatting to create a cohesive and visually pleasing layout that contributes to a seamless reading experience.', 10, 2, '2023-07-16 07:12:19', '2023-07-16 07:12:19'),
(8, 'Use of Visual Elements', 'Examine the integration of visual elements, such as images, charts, graphs, and multimedia. Evaluate their relevance, clarity, and effectiveness in enhancing understanding, engagement, and overall aesthetic appeal.', 10, 2, '2023-07-16 05:22:48', '2023-07-16 05:22:48'),
(9, 'Whitespace and Margins', 'Evaluate the utilization of whitespace and margins in the layout. Assess whether the spacing between text, images, and other elements enhances readability and prevents visual clutter, contributing to a clean and organized appearance.', 10, 2, '2023-07-16 05:22:48', '2023-07-16 05:22:48'),
(10, 'Accessibility and Navigation', 'Consider the accessibility and navigation features of the instructional material. Evaluate the use of clear navigation cues, hyperlinks, and a user-friendly interface to facilitate easy access to different sections and resources within the material.', 10, 2, '2024-01-29 06:05:01', '2023-07-16 05:22:48'),
(26, 'Originality', 'Assess the extent to which the instructional material demonstrates originality.', 15, 16, '2024-01-11 06:06:16', '2024-01-11 06:06:16'),
(27, 'Citation and Referencing', 'Evaluate the accuracy and completeness of citation and referencing.', 15, 16, '2024-01-11 06:06:35', '2024-01-11 06:06:35'),
(28, 'Avoidance of Plagiarism', 'Check for instances of plagiarism and how effectively they are avoided.', 20, 16, '2024-01-11 06:06:53', '2024-01-11 06:06:53'),
(29, 'Ethical Use of Sources', 'Assess whether the material adheres to ethical standards in using external sources.', 20, 16, '2024-01-11 06:07:11', '2024-01-11 06:07:11'),
(30, 'Clarity of Attribution', 'Evaluate how clearly the material attributes ideas to their original sources.', 30, 16, '2024-01-11 06:08:54', '2024-01-11 06:08:54'),
(32, 'Campus Level', 'Average result of campus evaluation for this Instructional Material.', 20, 18, '2024-01-11 10:57:05', '2024-01-11 10:57:05'),
(33, 'CFL Evaluation', 'Plagiarism result for this Instructional Material.', 30, 18, '2024-01-11 10:57:33', '2024-01-11 10:57:33'),
(34, 'University Level', 'Average result of university evaluation for this Instructional Material. The most important Evaluation', 50, 18, '2024-01-11 10:58:08', '2024-01-11 10:58:08'),
(35, 'Clear Language and Terminology', 'Ensuring communication clarity through precise language and well-defined terminology for an enhanced understanding of content.', 20, 19, '2024-01-15 07:29:03', '2024-01-15 07:29:03'),
(37, 'Logical Structure', 'Organizing information in a coherent and logical manner, facilitating an intuitive flow and ease of comprehension.', 40, 19, '2024-01-15 07:31:16', '2024-01-15 07:31:16'),
(38, 'Interactive Exercises and Assessments', 'Enhancing engagement and learning through hands-on activities, quizzes, and assessments that encourage active participation.\r\n', 30, 20, '2024-01-15 07:31:38', '2024-01-15 07:31:38'),
(40, 'Multimedia Integration', 'Incorporating diverse multimedia elements such as images, videos, and audio to enrich content and cater to different learning styles.', 10, 20, '2024-01-15 07:34:33', '2024-01-15 07:34:33');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(4, '2023_12_15_152716_create_campuses_table', 1),
(5, '2023_12_15_153102_create_colleges_table', 1),
(7, '2023_12_15_154313_create_departments_table', 1),
(9, '2023_12_15_161658_create_roles_table', 1),
(10, '2023_12_15_161905_create_university_roles_table', 1),
(11, '2023_12_15_161906_create_users_table', 1),
(12, '2023_12_15_153103_create_courses_table', 2),
(13, '2023_12_15_154340_create_course_colleges_table', 2),
(14, '2024_01_02_140646_create_logs_table', 3),
(15, '2024_01_02_154139_create_notifications_table', 4),
(16, '2024_01_02_200547_create_matrices_table', 5),
(17, '2024_01_02_200738_create_sub_matrices_table', 5),
(18, '2024_01_02_201023_create_matrix_items_table', 5),
(20, '2024_01_05_113144_create_instructional_materials_table', 6),
(21, '2024_01_03_054848_create_evaluator_matrices_table', 7),
(22, '2024_01_06_073416_create_evaluation_stages_table', 8),
(23, '2024_01_07_072813_create_evaluations_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `notifiable_type`, `notifiable_id`, `data`, `read_at`, `created_at`, `updated_at`) VALUES
('03b9e8a1-afdd-4aad-8b57-910f0118d284', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 15, '{\"title\":\"New Instructional Material Submitted\",\"action\":\"submitted\",\"description\":\"User Regular submitted a new Instructional Material titled \\\"In similique cupidit\\\".\",\"route\":\"evaluator.evaluation_management\"}', '2024-01-11 10:36:23', '2024-01-11 10:35:41', '2024-01-11 10:36:23'),
('09f5211a-0f9b-4173-a27b-dbf530802af5', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 18, '{\"title\":\"Instructional Material Resubmitted\",\"action\":\"submitted\",\"description\":\"User Regular resubmitted the Instructional Material titled \\\"Test IM\\\".\",\"route\":\"evaluator.evaluation_management\"}', NULL, '2024-01-15 07:38:43', '2024-01-15 07:38:43'),
('0f9a3b7c-bf5e-4b0a-80b9-9aea58f27b94', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 17, '{\"title\":\"New Material for Evaluation\",\"action\":\"added\",\"description\":\"University Evaluator has given approval for the instructional material titled \\\",\\\" advancing it to the next stage of evaluation.\",\"route\":\"evaluator.evaluation_management\"}', '2024-01-11 11:05:21', '2024-01-11 11:05:07', '2024-01-11 11:05:21'),
('1a060809-c49c-45b3-a846-5d96c9d7500c', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 16, '{\"title\":\"Evaluation Submitted\",\"action\":\"submitted\",\"description\":\"Campus Evaluator submitted an evaluation regarding your Instructional Material titled \\\"In similique cupidit\\\".\",\"route\":\"submission_management\"}', '2024-01-11 10:44:02', '2024-01-11 10:36:56', '2024-01-11 10:44:02'),
('229c9036-430f-4c23-b462-d27ebbb7f467', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 15, '{\"title\":\"Instructional Material Resubmitted\",\"action\":\"submitted\",\"description\":\"User Regular resubmitted the Instructional Material titled \\\"Test IM\\\".\",\"route\":\"evaluator.evaluation_management\"}', NULL, '2024-01-15 07:38:43', '2024-01-15 07:38:43'),
('27d64544-ab39-4897-8204-2acf83129374', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 15, '{\"title\":\"Instructional Material Resubmitted\",\"action\":\"submitted\",\"description\":\"User Regular resubmitted the Instructional Material titled \\\"In similique cupidit\\\".\",\"route\":\"evaluator.evaluation_management\"}', '2024-01-11 10:45:55', '2024-01-11 10:44:58', '2024-01-11 10:45:55'),
('2c55593e-b0bf-410f-aa6c-608b46c143f0', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 12, '{\"title\":\"New Material for Evaluation\",\"action\":\"added\",\"description\":\"Campus2 Evaluator has given approval for the instructional material titled \\\",\\\" advancing it to the next stage of evaluation.\",\"route\":\"evaluator.evaluation_management\"}', '2024-01-11 10:49:30', '2024-01-11 10:49:14', '2024-01-11 10:49:30'),
('2ec10789-9e0d-4e7d-9f1d-fa785d3014b0', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 16, '{\"title\":\"Evaluation Submitted\",\"action\":\"submitted\",\"description\":\"University Evaluator submitted an evaluation regarding your Instructional Material titled \\\"In similique cupidit\\\".\",\"route\":\"submission_management\"}', '2024-01-11 11:28:30', '2024-01-11 10:52:16', '2024-01-11 11:28:30'),
('31f5753a-a3e4-418f-bbf1-4e21fac1bc57', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 16, '{\"title\":\"Evaluation Submitted\",\"action\":\"submitted\",\"description\":\"CFL Evaluator submitted an evaluation regarding your Instructional Material titled \\\"In similique cupidit\\\".\",\"route\":\"submission_management\"}', '2024-01-11 11:28:30', '2024-01-11 10:51:11', '2024-01-11 11:28:30'),
('332afedf-092a-4754-b8bc-43cd63dc670e', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 13, '{\"title\":\"New Material for Evaluation\",\"action\":\"added\",\"description\":\"CFL Evaluator has given approval for the instructional material titled \\\",\\\" advancing it to the next stage of evaluation.\",\"route\":\"evaluator.evaluation_management\"}', '2024-01-11 10:51:35', '2024-01-11 10:51:11', '2024-01-11 10:51:35'),
('40910d23-72f6-41cf-9a18-ee97a8a117d6', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 16, '{\"title\":\"Evaluation Submitted\",\"action\":\"submitted\",\"description\":\"Campus2 Evaluator submitted an evaluation regarding your Instructional Material titled \\\"Mollitia amet quis\\\".\",\"route\":\"submission_management\"}', '2024-01-12 01:06:21', '2024-01-12 00:22:01', '2024-01-12 01:06:21'),
('47b4aad3-b93e-41a2-b987-f9873df80726', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 16, '{\"title\":\"Evaluation Submitted\",\"action\":\"submitted\",\"description\":\"University Evaluator submitted an evaluation regarding your Instructional Material titled \\\"In similique cupidit\\\".\",\"route\":\"submission_management\"}', '2024-01-11 11:28:30', '2024-01-11 11:05:08', '2024-01-11 11:28:30'),
('47f1cb60-a6fd-4d1b-90f7-95c1f55feb28', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 18, '{\"title\":\"New Instructional Material Submitted\",\"action\":\"submitted\",\"description\":\"User Regular submitted a new Instructional Material titled \\\"In similique cupidit\\\".\",\"route\":\"evaluator.evaluation_management\"}', '2024-01-11 10:48:05', '2024-01-11 10:35:41', '2024-01-11 10:48:05'),
('49135e54-b169-4e54-bf06-0ecc486b3e24', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 16, '{\"title\":\"Evaluation Submitted\",\"action\":\"submitted\",\"description\":\"Campus2 Evaluator submitted an evaluation regarding your Instructional Material titled \\\"In similique cupidit\\\".\",\"route\":\"submission_management\"}', '2024-01-11 11:28:30', '2024-01-11 10:49:14', '2024-01-11 11:28:30'),
('492552bf-6925-4bd3-b3e0-f91f55bfc8f3', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 19, '{\"title\":\"New Instructional Material Submitted\",\"action\":\"submitted\",\"description\":\"User Regular submitted a new Instructional Material titled \\\"Test IM\\\".\",\"route\":\"evaluator.evaluation_management\"}', NULL, '2024-01-15 07:35:34', '2024-01-15 07:35:34'),
('4e4c2095-a10a-4193-b0c6-8aa4554a4f07', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 15, '{\"title\":\"New Instructional Material Submitted\",\"action\":\"submitted\",\"description\":\"User Regular submitted a new Instructional Material titled \\\"Test IM\\\".\",\"route\":\"evaluator.evaluation_management\"}', NULL, '2024-01-15 07:35:34', '2024-01-15 07:35:34'),
('5382cb32-a1ec-4ba6-802f-8bfed8cf510d', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 16, '{\"title\":\"Evaluation Submitted\",\"action\":\"submitted\",\"description\":\"Campus Evaluator submitted an evaluation regarding your Instructional Material titled \\\"Mollitia amet quis\\\".\",\"route\":\"submission_management\"}', '2024-01-15 05:57:42', '2024-01-12 00:20:51', '2024-01-15 05:57:42'),
('6a571b59-87bf-4643-96ef-af405e72db0a', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 19, '{\"title\":\"Instructional Material Resubmitted\",\"action\":\"submitted\",\"description\":\"User Regular resubmitted the Instructional Material titled \\\"Test IM\\\".\",\"route\":\"evaluator.evaluation_management\"}', NULL, '2024-01-15 07:38:43', '2024-01-15 07:38:43'),
('73edf317-f5c5-4fb4-8337-9c09f66106bb', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 16, '{\"title\":\"Evaluation Submitted\",\"action\":\"submitted\",\"description\":\"Campus Evaluator submitted an evaluation regarding your Instructional Material titled \\\"In similique cupidit\\\".\",\"route\":\"submission_management\"}', '2024-01-11 11:28:30', '2024-01-11 10:46:26', '2024-01-11 11:28:30'),
('88af08b0-0ab5-44c9-bd54-a730751e0588', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 16, '{\"title\":\"Evaluation Submitted\",\"action\":\"submitted\",\"description\":\"Vice President submitted an evaluation regarding your Instructional Material titled \\\"In similique cupidit\\\".\",\"route\":\"submission_management\"}', '2024-01-11 11:28:30', '2024-01-11 11:05:36', '2024-01-11 11:28:30'),
('98afc6df-d878-4fae-a3bf-ce14c3248c94', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 18, '{\"title\":\"New Instructional Material Submitted\",\"action\":\"submitted\",\"description\":\"User Regular submitted a new Instructional Material titled \\\"Test IM\\\".\",\"route\":\"evaluator.evaluation_management\"}', NULL, '2024-01-15 07:35:34', '2024-01-15 07:35:34'),
('a5ec71a0-bdc0-44f1-8d23-2e39702ed388', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 19, '{\"title\":\"New Instructional Material Submitted\",\"action\":\"submitted\",\"description\":\"User Regular submitted a new Instructional Material titled \\\"Mollitia amet quis\\\".\",\"route\":\"evaluator.evaluation_management\"}', NULL, '2024-01-12 00:16:57', '2024-01-12 00:16:57'),
('a8c85b63-0f92-493d-bba5-a91761c2743a', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 15, '{\"title\":\"New Instructional Material Submitted\",\"action\":\"submitted\",\"description\":\"User Regular submitted a new Instructional Material titled \\\"Mollitia amet quis\\\".\",\"route\":\"evaluator.evaluation_management\"}', NULL, '2024-01-12 00:16:57', '2024-01-12 00:16:57'),
('ad5780ec-777b-47d7-bd58-8c1c631655b2', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 20, '{\"title\":\"Evaluation Submitted\",\"action\":\"submitted\",\"description\":\"Campus Evaluator submitted an evaluation regarding your Instructional Material titled \\\"Test IM\\\".\",\"route\":\"submission_management\"}', NULL, '2024-01-15 08:16:22', '2024-01-15 08:16:22'),
('b0fb1d78-38b6-4761-b737-81601021186d', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 12, '{\"title\":\"Instructional Material Resubmitted\",\"action\":\"submitted\",\"description\":\"User Regular resubmitted the Instructional Material titled \\\"In similique cupidit\\\".\",\"route\":\"evaluator.evaluation_management\"}', '2024-01-11 10:51:15', '2024-01-11 10:50:37', '2024-01-11 10:51:15'),
('b3384485-6846-435a-ba06-76e54e54b0f6', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 18, '{\"title\":\"New Instructional Material Submitted\",\"action\":\"submitted\",\"description\":\"User Regular submitted a new Instructional Material titled \\\"Dolor consectetur d\\\".\",\"route\":\"evaluator.evaluation_management\"}', NULL, '2024-01-12 00:17:21', '2024-01-12 00:17:21'),
('bd0cb353-3e8b-42d9-95f4-d920da1957d9', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 20, '{\"title\":\"Evaluation Submitted\",\"action\":\"submitted\",\"description\":\"Campus Evaluator submitted an evaluation regarding your Instructional Material titled \\\"Test IM\\\".\",\"route\":\"submission_management\"}', NULL, '2024-01-15 07:36:55', '2024-01-15 07:36:55'),
('c668f888-5c75-4fe0-9bad-ef0e50b98c35', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 15, '{\"title\":\"Instructional Material Resubmitted\",\"action\":\"submitted\",\"description\":\"User Regular resubmitted the Instructional Material titled \\\"Mollitia amet quis\\\".\",\"route\":\"evaluator.evaluation_management\"}', NULL, '2024-01-12 00:19:46', '2024-01-12 00:19:46'),
('cee2170d-0b0c-4fdd-b917-b88701fcfae0', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 19, '{\"title\":\"New Instructional Material Submitted\",\"action\":\"submitted\",\"description\":\"User Regular submitted a new Instructional Material titled \\\"Dolor consectetur d\\\".\",\"route\":\"evaluator.evaluation_management\"}', NULL, '2024-01-12 00:17:21', '2024-01-12 00:17:21'),
('d4328cc7-4a88-419e-abf2-3cd986a18163', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 19, '{\"title\":\"Instructional Material Resubmitted\",\"action\":\"submitted\",\"description\":\"User Regular resubmitted the Instructional Material titled \\\"Mollitia amet quis\\\".\",\"route\":\"evaluator.evaluation_management\"}', NULL, '2024-01-12 00:19:46', '2024-01-12 00:19:46'),
('db00fe32-b912-4dae-bb07-1462f3d21b24', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 18, '{\"title\":\"New Instructional Material Submitted\",\"action\":\"submitted\",\"description\":\"User Regular submitted a new Instructional Material titled \\\"Mollitia amet quis\\\".\",\"route\":\"evaluator.evaluation_management\"}', NULL, '2024-01-12 00:16:57', '2024-01-12 00:16:57'),
('e33bdca1-35b9-4ef9-9a62-66890ceb441b', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 18, '{\"title\":\"Instructional Material Resubmitted\",\"action\":\"submitted\",\"description\":\"User Regular resubmitted the Instructional Material titled \\\"In similique cupidit\\\".\",\"route\":\"evaluator.evaluation_management\"}', '2024-01-11 10:48:09', '2024-01-11 10:44:58', '2024-01-11 10:48:09'),
('e793b7c4-fc7a-47e3-8524-69df879296b4', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 15, '{\"title\":\"New Instructional Material Submitted\",\"action\":\"submitted\",\"description\":\"User Regular submitted a new Instructional Material titled \\\"Dolor consectetur d\\\".\",\"route\":\"evaluator.evaluation_management\"}', NULL, '2024-01-12 00:17:21', '2024-01-12 00:17:21'),
('eeb0b7e9-d391-44ee-8a32-34cfba31f7da', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 16, '{\"title\":\"Evaluation Submitted\",\"action\":\"submitted\",\"description\":\"Campus Evaluator submitted an evaluation regarding your Instructional Material titled \\\"Mollitia amet quis\\\".\",\"route\":\"submission_management\"}', '2024-01-15 05:57:42', '2024-01-12 00:18:50', '2024-01-15 05:57:42'),
('f09dc39e-7bf6-41eb-b5d6-f71700f306c7', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 16, '{\"title\":\"Evaluation Submitted\",\"action\":\"submitted\",\"description\":\"CFL Evaluator submitted an evaluation regarding your Instructional Material titled \\\"In similique cupidit\\\".\",\"route\":\"submission_management\"}', '2024-01-11 10:50:13', '2024-01-11 10:50:05', '2024-01-11 10:50:13'),
('f758e69c-08da-4508-ba35-5614df339dce', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 18, '{\"title\":\"Instructional Material Resubmitted\",\"action\":\"submitted\",\"description\":\"User Regular resubmitted the Instructional Material titled \\\"Mollitia amet quis\\\".\",\"route\":\"evaluator.evaluation_management\"}', NULL, '2024-01-12 00:19:46', '2024-01-12 00:19:46');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('main@psu.edu.ph', '$2y$10$DibFefrd/WeT4BOQRtJ7SuCRxaGME0hKaE5182VQXoxl3sHlFs16C', '2024-01-15 07:16:32'),
('reg@psu.edu.ph', '$2y$10$0uJaP7b78J9hjs2/atTPN.u4zM.hLDIpYTIcGls5TP/1H2mwSIZiO', '2024-01-15 07:14:51');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No description',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'An administrator has full access to the system and can perform administrative tasks such as user management, system configuration, and other privileged actions.', '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(2, 'Moderator', 'A moderator has the ability to oversee and manage specific aspects of the system. They may have elevated permissions for utility management.', '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(3, 'Evaluator', 'An evaluator is responsible for assessing and reviewing instructional materials, submissions, or other items within the system. They may have specific roles related to evaluation and decision-making.', '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(4, 'Normal User', 'A normal user has standard access to the system with no special privileges.', '2023-12-15 23:58:53', '2023-12-15 23:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `sub_matrices`
--

CREATE TABLE `sub_matrices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `matrix_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_matrices`
--

INSERT INTO `sub_matrices` (`id`, `title`, `matrix_id`, `created_at`, `updated_at`) VALUES
(1, 'Content', 1, '2024-01-30 05:58:49', '2024-01-31 05:58:49'),
(2, 'Layout', 1, '2023-07-16 05:21:48', '2023-07-16 05:22:48'),
(16, 'Plagiarism Free', 7, '2024-01-11 06:05:59', '2024-01-11 06:05:59'),
(18, 'Evaluated', 10, '2024-01-11 10:56:10', '2024-01-11 10:56:10'),
(19, 'Clarity and Organization', 4, '2024-01-15 07:28:40', '2024-01-15 07:28:40'),
(20, 'Engagement And Interactivity', 4, '2024-01-15 07:31:25', '2024-01-15 07:31:25');

-- --------------------------------------------------------

--
-- Table structure for table `university_roles`
--

CREATE TABLE `university_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `university_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'No description',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `university_roles`
--

INSERT INTO `university_roles` (`id`, `university_role`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Master of Information Systems', 'Holder of the Master of Information Systems degree.', '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(2, 'President', 'The President of the university, responsible for overall leadership and decision-making.', '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(3, 'Vice President', 'The Vice President of the university, supporting the President and overseeing specific areas of responsibility.', '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(4, 'College Dean', 'The Dean of a college, responsible for academic and administrative leadership within the college.', '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(5, 'Chairman', 'The Chairman of a department, providing leadership and coordination within a specific academic department.', '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(6, 'Senior Faculty', 'A senior faculty member with extensive experience and expertise in their field.', '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(7, 'Faculty', 'A faculty member involved in teaching and research activities.', '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(8, 'Campus Executive Director', 'The executive leader of a university campus, responsible for campus-wide administration and coordination.', '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(9, 'Center of Foreign Languages', 'Responsible for overseeing activities related to foreign languages within the university.', '2023-12-15 23:58:53', '2023-12-15 23:58:53'),
(10, 'Curriculum & Instruction', 'Responsible for curriculum development and instructional strategies within the university.', '2023-12-15 23:58:53', '2023-12-15 23:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `univ_role_id` bigint(20) UNSIGNED NOT NULL,
  `campus_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `lastname`, `firstname`, `middlename`, `email`, `email_verified_at`, `password`, `remember_token`, `role_id`, `univ_role_id`, `campus_id`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'Main', NULL, 'main@psu.edu.ph', NULL, '$2y$10$rv.l.uiJGGucv3bYGJElxupvkRiTx8KYlYHfzuO4N0Y2VP6yniR2q', NULL, 1, 1, 1, '2023-12-15 23:58:54', '2023-12-15 23:58:54'),
(12, 'Evaluator', 'CFL', NULL, 'cfl@psu.edu.ph', NULL, '$2y$10$PDseINxqTJB7zXrg.To5YexS06tkefIZmDQ9LvaFUllWbvr9iRCa.', NULL, 3, 9, 9, '2024-01-03 10:02:42', '2024-01-07 07:52:46'),
(13, 'Evaluator', 'University', NULL, 'uni@psu.edu.ph', NULL, '$2y$10$/64XD0iTYZil1n064Xr3Fuk57azjUNcR58ABYWOIuulXj1xk1HPLm', NULL, 3, 10, 9, '2024-01-03 10:23:47', '2024-01-07 04:10:03'),
(14, 'Moderator', 'Main', NULL, 'mod@psu.edu.ph', NULL, '$2y$10$Bq6I8ITK5iqwCoIBP95ouOeKQz/5snHRfQnrZOFrIG3VVczfRQSXG', NULL, 2, 1, 1, '2024-01-07 10:58:01', '2024-01-07 11:02:01'),
(15, 'Evaluator', 'Campus', NULL, 'camp@psu.edu.ph', NULL, '$2y$10$iHnwzNgIq9AKr9UwknA3eehWaszQAS6phmfbu2SDZBnwxF4u.7f9u', NULL, 3, 5, 9, '2024-01-07 10:58:59', '2024-01-08 21:58:23'),
(17, 'President', 'Vice', NULL, 'vice@psu.edu.ph', NULL, '$2y$10$B8kjUOnYcY0.Hf1s6MMVvuU.Su6DfAFwv1KPdSjxVE93hbds37Ud6', NULL, 3, 3, 1, '2024-01-07 11:00:38', '2024-01-07 11:01:16'),
(18, 'Evaluator', 'Campus2', NULL, 'camp2@psu.edu.ph', NULL, '$2y$10$jkJg7dJ/quieJdYalDjjK.bK79z7.aSRW1wQnFBJWNFxw/wtZKw5W', NULL, 3, 5, 9, '2024-01-08 23:17:21', '2024-01-08 23:17:21'),
(19, 'Evaluator', 'Chairman', NULL, 'chair@psu.edu.ph', NULL, '$2y$10$SgxNB8H2znWr4EUK0ilBVu8svzY7zxR/57w.CsPGoljq5mO7.K8wi', NULL, 3, 5, 9, '2024-01-08 23:19:35', '2024-01-08 23:19:35'),
(20, 'Regular', 'User', NULL, 'reg@psu.edu.ph', NULL, '$2y$10$dgeRKqGrNc1hiv6eQSc6t.8RGBjROSnJEJB8SPJIC5Pj.RnKrbJgG', NULL, 4, 7, 9, '2024-01-15 06:25:48', '2024-01-15 06:25:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `campuses`
--
ALTER TABLE `campuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colleges`
--
ALTER TABLE `colleges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `colleges_campus_id_foreign` (`campus_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courses_campus_id_foreign` (`campus_id`);

--
-- Indexes for table `course_colleges`
--
ALTER TABLE `course_colleges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_colleges_college_id_foreign` (`college_id`),
  ADD KEY `course_colleges_course_id_foreign` (`course_id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departments_campus_id_foreign` (`campus_id`);

--
-- Indexes for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluations_matrix_id_foreign` (`matrix_id`),
  ADD KEY `evaluations_material_id_foreign` (`material_id`),
  ADD KEY `evaluations_evaluator_id_foreign` (`evaluator_id`);

--
-- Indexes for table `evaluation_stages`
--
ALTER TABLE `evaluation_stages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluation_stages_matrix_id_foreign` (`matrix_id`),
  ADD KEY `evaluation_stages_material_id_foreign` (`material_id`);

--
-- Indexes for table `evaluator_matrices`
--
ALTER TABLE `evaluator_matrices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `evaluator_matrices_evaluator_id_foreign` (`evaluator_id`),
  ADD KEY `evaluator_matrices_matrix_id_foreign` (`matrix_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `instructional_materials`
--
ALTER TABLE `instructional_materials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `instructional_materials_course_id_foreign` (`course_id`),
  ADD KEY `instructional_materials_department_id_foreign` (`department_id`),
  ADD KEY `instructional_materials_campus_id_foreign` (`campus_id`),
  ADD KEY `instructional_materials_submitter_id_foreign` (`submitter_id`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `logs_user_id_foreign` (`user_id`);

--
-- Indexes for table `matrices`
--
ALTER TABLE `matrices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_matrices_campus` (`campus_id`);

--
-- Indexes for table `matrix_items`
--
ALTER TABLE `matrix_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `matrix_items_sub_matrix_id_foreign` (`sub_matrix_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_matrices`
--
ALTER TABLE `sub_matrices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_matrices_matrix_id_foreign` (`matrix_id`);

--
-- Indexes for table `university_roles`
--
ALTER TABLE `university_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_univ_role_id_foreign` (`univ_role_id`),
  ADD KEY `users_campus_id_foreign` (`campus_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `campuses`
--
ALTER TABLE `campuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `colleges`
--
ALTER TABLE `colleges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `course_colleges`
--
ALTER TABLE `course_colleges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `evaluations`
--
ALTER TABLE `evaluations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `evaluation_stages`
--
ALTER TABLE `evaluation_stages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `evaluator_matrices`
--
ALTER TABLE `evaluator_matrices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructional_materials`
--
ALTER TABLE `instructional_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `matrices`
--
ALTER TABLE `matrices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `matrix_items`
--
ALTER TABLE `matrix_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `sub_matrices`
--
ALTER TABLE `sub_matrices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `university_roles`
--
ALTER TABLE `university_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `colleges`
--
ALTER TABLE `colleges`
  ADD CONSTRAINT `colleges_campus_id_foreign` FOREIGN KEY (`campus_id`) REFERENCES `campuses` (`id`);

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_campus_id_foreign` FOREIGN KEY (`campus_id`) REFERENCES `campuses` (`id`);

--
-- Constraints for table `course_colleges`
--
ALTER TABLE `course_colleges`
  ADD CONSTRAINT `course_colleges_college_id_foreign` FOREIGN KEY (`college_id`) REFERENCES `colleges` (`id`),
  ADD CONSTRAINT `course_colleges_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `departments`
--
ALTER TABLE `departments`
  ADD CONSTRAINT `departments_campus_id_foreign` FOREIGN KEY (`campus_id`) REFERENCES `campuses` (`id`);

--
-- Constraints for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD CONSTRAINT `evaluations_evaluator_id_foreign` FOREIGN KEY (`evaluator_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `evaluations_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `instructional_materials` (`id`),
  ADD CONSTRAINT `evaluations_matrix_id_foreign` FOREIGN KEY (`matrix_id`) REFERENCES `matrices` (`id`);

--
-- Constraints for table `evaluation_stages`
--
ALTER TABLE `evaluation_stages`
  ADD CONSTRAINT `evaluation_stages_material_id_foreign` FOREIGN KEY (`material_id`) REFERENCES `instructional_materials` (`id`),
  ADD CONSTRAINT `evaluation_stages_matrix_id_foreign` FOREIGN KEY (`matrix_id`) REFERENCES `matrices` (`id`);

--
-- Constraints for table `evaluator_matrices`
--
ALTER TABLE `evaluator_matrices`
  ADD CONSTRAINT `evaluator_matrices_evaluator_id_foreign` FOREIGN KEY (`evaluator_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `evaluator_matrices_matrix_id_foreign` FOREIGN KEY (`matrix_id`) REFERENCES `matrices` (`id`);

--
-- Constraints for table `instructional_materials`
--
ALTER TABLE `instructional_materials`
  ADD CONSTRAINT `instructional_materials_campus_id_foreign` FOREIGN KEY (`campus_id`) REFERENCES `campuses` (`id`),
  ADD CONSTRAINT `instructional_materials_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `instructional_materials_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`),
  ADD CONSTRAINT `instructional_materials_submitter_id_foreign` FOREIGN KEY (`submitter_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `logs_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `matrices`
--
ALTER TABLE `matrices`
  ADD CONSTRAINT `fk_matrices_campus` FOREIGN KEY (`campus_id`) REFERENCES `campuses` (`id`);

--
-- Constraints for table `matrix_items`
--
ALTER TABLE `matrix_items`
  ADD CONSTRAINT `matrix_items_sub_matrix_id_foreign` FOREIGN KEY (`sub_matrix_id`) REFERENCES `sub_matrices` (`id`);

--
-- Constraints for table `sub_matrices`
--
ALTER TABLE `sub_matrices`
  ADD CONSTRAINT `sub_matrices_matrix_id_foreign` FOREIGN KEY (`matrix_id`) REFERENCES `matrices` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_campus_id_foreign` FOREIGN KEY (`campus_id`) REFERENCES `campuses` (`id`),
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`),
  ADD CONSTRAINT `users_univ_role_id_foreign` FOREIGN KEY (`univ_role_id`) REFERENCES `university_roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
