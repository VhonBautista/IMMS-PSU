-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 06, 2024 at 03:23 PM
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
(11, 'Bachelor of Science in Electrical Engineering', 9, '2023-12-16 07:52:02', '2023-12-16 07:52:02');

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
(10, 'Mathematics Department', 9, '2023-12-15 23:58:53', '2023-12-15 23:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_stages`
--

CREATE TABLE `evaluation_stages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `matrix_id` bigint(20) UNSIGNED NOT NULL,
  `material_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `evaluation_stages`
--

INSERT INTO `evaluation_stages` (`id`, `matrix_id`, `material_id`, `created_at`, `updated_at`) VALUES
(6, 1, 7, '2024-01-06 05:37:31', '2024-01-06 05:37:31');

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
(8, 12, 1, '2024-01-06 01:32:06', '2024-01-06 01:32:06');

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
  `type` enum('course_book','textbook','modules','laboratory manual','prototype','others') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','evaluating','resubmission','approved') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `instructional_materials`
--

INSERT INTO `instructional_materials` (`id`, `title`, `pdf_path`, `proponents`, `course_id`, `department_id`, `campus_id`, `submitter_id`, `type`, `status`, `created_at`, `updated_at`) VALUES
(7, 'TeST', 'storage/pdfs/1704548251_Bautista-Jeamkely-Vhon-S-Midterm-Portfolio.pdf', 'AXDASD', 2, 1, 1, 13, 'textbook', 'pending', '2024-01-06 05:37:31', '2024-01-06 05:37:31');

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
(2, 'admin.campus_management', 'New Campus Added', 'added', 'Admin Main added a new campus \"test\".', 1, '2024-01-02 08:07:59', '2024-01-02 08:07:59'),
(3, 'admin.campus_management', 'Campus Deleted', 'deleted', 'Admin Main deleted the campus \"test\".', 1, '2024-01-02 11:42:54', '2024-01-02 11:42:54'),
(4, 'admin.user_management', 'New User Registered', 'registered', 'Ben Teneson just created their account.', 12, '2024-01-03 10:02:43', '2024-01-03 10:02:43'),
(5, 'admin.user_management', 'New User Registered', 'registered', 'Vhon Bautista just created their account.', 13, '2024-01-03 10:23:47', '2024-01-03 10:23:47'),
(6, 'submission_management', 'New Instructional Material Added', 'added', 'Vhon Bautista added a new IM \"asdw\".', 13, '2024-01-05 20:44:47', '2024-01-05 20:44:47'),
(7, 'submission_management', 'New Instructional Material Added', 'submitted', 'Vhon Bautista submitted a new Instructional Material titled \"System Integration\".', 13, '2024-01-06 00:50:36', '2024-01-06 00:50:36'),
(8, 'evaluation_management', 'New Instructional Material Added', 'submitted', 'Vhon Bautista submitted a new Instructional Material titled \"asdwasd\".', 13, '2024-01-06 01:45:39', '2024-01-06 01:45:39'),
(9, 'evaluation_management', 'New Instructional Material Added', 'submitted', 'Vhon Bautista submitted a new Instructional Material titled \"asdwasd\".', 13, '2024-01-06 01:47:18', '2024-01-06 01:47:18'),
(10, 'evaluation_management', 'New Instructional Material Added', 'submitted', 'Vhon Bautista submitted a new Instructional Material titled \"asdwasd\".', 13, '2024-01-06 05:25:31', '2024-01-06 05:25:31'),
(11, 'evaluation_management', 'New Instructional Material Added', 'submitted', 'Vhon Bautista submitted a new Instructional Material titled \"titit\".', 13, '2024-01-06 05:35:03', '2024-01-06 05:35:03'),
(12, 'evaluation_management', 'New Instructional Material Added', 'submitted', 'Vhon Bautista submitted a new Instructional Material titled \"TeST\".', 13, '2024-01-06 05:37:31', '2024-01-06 05:37:31');

-- --------------------------------------------------------

--
-- Table structure for table `matrices`
--

CREATE TABLE `matrices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `matrix_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `matrices`
--

INSERT INTO `matrices` (`id`, `matrix_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Department Matrix', 'The Department Matrix for Instructional Materials, systematically evaluates educational materials to ensure alignment with curriculum goals and standards. Using categories, sub-matrices, and detailed criteria, the matrix facilitates a quality assurance process through standardized scoring and feedback loops. This strategic tool empowers decision-makers to make informed choices, fostering continual improvement in instructional materials for an enhanced educational experience.', '2024-01-29 05:56:33', '2024-01-03 05:08:01');

-- --------------------------------------------------------

--
-- Table structure for table `matrix_items`
--

CREATE TABLE `matrix_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sub_matrix_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `matrix_items`
--

INSERT INTO `matrix_items` (`id`, `item`, `text`, `sub_matrix_id`, `created_at`, `updated_at`) VALUES
(1, 'Content Relevance', 'Assess the alignment of instructional content with defined learning objectives and curriculum standards. Evaluate whether the material addresses key concepts, skills, and competencies essential for the targeted educational level.', 1, '2024-01-31 06:01:46', '2024-01-31 06:01:46'),
(2, 'Clarity and Coherence', 'Examine the clarity and coherence of the instructional content. Evaluate how well the material presents information, ensuring it is easily understandable for the intended audience and follows a logical progression.', 1, '2023-07-16 05:22:48', '2023-07-16 05:22:48'),
(3, 'Multimodal Presentation', 'Gauge the incorporation of multiple modes of presentation, such as text, visuals, audio, and interactive elements. Assess how well the material caters to diverse learning styles, enhancing engagement and understanding.', 1, '2023-07-16 05:22:48', '2023-07-16 05:22:48'),
(4, 'Assessment Alignment', 'Evaluate the alignment of assessment tools within the instructional material with the learning objectives. Ensure that assessments effectively measure student understanding and mastery of the content.', 1, '2023-07-16 05:22:48', '2023-07-16 05:22:48'),
(5, 'Inclusivity and Diversity', 'Consider the inclusivity and diversity of the instructional content, assessing whether it reflects a variety of perspectives, cultures, and experiences. Ensure that the material is accessible and resonates with a diverse student population.', 1, '2023-07-16 05:22:48', '2023-07-16 05:22:48'),
(6, 'Visual Hierarchy', 'Assess the visual hierarchy of the instructional material\'s layout, examining how well it guides the reader\'s attention. Evaluate the use of headings, subheadings, and other design elements to prioritize information and enhance overall readability.', 2, '2023-06-26 07:04:23', '2023-07-16 07:12:19'),
(7, 'Consistency in Design', 'Evaluate the consistency in design elements throughout the instructional material. Check for uniformity in fonts, colors, and formatting to create a cohesive and visually pleasing layout that contributes to a seamless reading experience.', 2, '2023-07-16 07:12:19', '2023-07-16 07:12:19'),
(8, 'Use of Visual Elements', 'Examine the integration of visual elements, such as images, charts, graphs, and multimedia. Evaluate their relevance, clarity, and effectiveness in enhancing understanding, engagement, and overall aesthetic appeal.', 2, '2023-07-16 05:22:48', '2023-07-16 05:22:48'),
(9, 'Whitespace and Margins', 'Evaluate the utilization of whitespace and margins in the layout. Assess whether the spacing between text, images, and other elements enhances readability and prevents visual clutter, contributing to a clean and organized appearance.', 2, '2023-07-16 05:22:48', '2023-07-16 05:22:48'),
(10, 'Accessibility and Navigation', 'Consider the accessibility and navigation features of the instructional material. Evaluate the use of clear navigation cues, hyperlinks, and a user-friendly interface to facilitate easy access to different sections and resources within the material.', 2, '2024-01-29 06:05:01', '2023-07-16 05:22:48');

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
(22, '2024_01_06_073416_create_evaluation_stages_table', 8);

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
('017b4003-e7de-423d-8c34-aba22a277cf2', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"title\":\"New User Registered\",\"action\":\"registered\",\"description\":\"Ben Teneson just created their account.\",\"route\":\"admin.user_management\"}', '2024-01-03 10:11:21', '2024-01-03 10:02:44', '2024-01-03 10:11:21'),
('25cf634c-c66b-42d9-834d-a7657827b87c', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 12, '{\"title\":\"New Instructional Material Added\",\"action\":\"submitted\",\"description\":\"Vhon Bautista submitted a new Instructional Material titled \\\"asdwasd\\\".\",\"route\":\"evaluation_management\"}', NULL, '2024-01-06 05:25:31', '2024-01-06 05:25:31'),
('3396b9bc-4d94-421a-8df8-52a5fc10ad1e', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"title\":\"New Instructional Material Added\",\"action\":\"added\",\"description\":\"Vhon Bautista added a new IM \\\"asdw\\\".\",\"route\":\"submission_management\"}', '2024-01-06 01:14:20', '2024-01-05 20:44:48', '2024-01-06 01:14:20'),
('45e9d447-33c3-4a0f-a8f9-a5b1579186c6', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 12, '{\"title\":\"New Instructional Material Added\",\"action\":\"submitted\",\"description\":\"Vhon Bautista submitted a new Instructional Material titled \\\"asdwasd\\\".\",\"route\":\"evaluation_management\"}', NULL, '2024-01-06 01:47:18', '2024-01-06 01:47:18'),
('55bc46f6-82d8-4ec3-82c0-e81b3b46a47c', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 12, '{\"title\":\"New Instructional Material Added\",\"action\":\"submitted\",\"description\":\"Vhon Bautista submitted a new Instructional Material titled \\\"TeST\\\".\",\"route\":\"evaluation_management\"}', NULL, '2024-01-06 05:37:31', '2024-01-06 05:37:31'),
('68f04e93-4d48-4fa7-8b91-69b52334894e', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"title\":\"New User Registered\",\"action\":\"registered\",\"description\":\"Vhon Bautista just created their account.\",\"route\":\"admin.user_management\"}', '2024-01-03 10:56:23', '2024-01-03 10:23:47', '2024-01-03 10:56:23'),
('c05a1f0b-5701-4555-83fb-5cc1500628da', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 1, '{\"title\":\"Campus Deleted\",\"action\":\"deleted\",\"description\":\"Admin Main deleted the campus \\\"test\\\".\",\"route\":\"admin.campus_management\"}', '2024-01-02 11:43:08', '2024-01-02 11:42:54', '2024-01-02 11:43:08'),
('ec927229-74d7-48af-919b-64b74c7361e5', 'App\\Notifications\\SystemNotification', 'App\\Models\\User', 12, '{\"title\":\"New Instructional Material Added\",\"action\":\"submitted\",\"description\":\"Vhon Bautista submitted a new Instructional Material titled \\\"titit\\\".\",\"route\":\"evaluation_management\"}', NULL, '2024-01-06 05:35:03', '2024-01-06 05:35:03');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(2, 'Layout', 1, '2023-07-16 05:21:48', '2023-07-16 05:22:48');

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
(1, 'Main', 'Admin', NULL, 'main@psu.edu.ph', NULL, '$2y$10$rv.l.uiJGGucv3bYGJElxupvkRiTx8KYlYHfzuO4N0Y2VP6yniR2q', NULL, 1, 1, 1, '2023-12-15 23:58:54', '2023-12-15 23:58:54'),
(12, 'Teneson', 'Ben', 'T.', 'ben@example.com', NULL, '$2y$10$PDseINxqTJB7zXrg.To5YexS06tkefIZmDQ9LvaFUllWbvr9iRCa.', NULL, 3, 6, 9, '2024-01-03 10:02:42', '2024-01-06 01:31:49'),
(13, 'Bautista', 'Vhon', 'S.', 'vhon@gmail.com', NULL, '$2y$10$/64XD0iTYZil1n064Xr3Fuk57azjUNcR58ABYWOIuulXj1xk1HPLm', NULL, 4, 6, 9, '2024-01-03 10:23:47', '2024-01-05 20:11:36');

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
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `course_colleges`
--
ALTER TABLE `course_colleges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `evaluation_stages`
--
ALTER TABLE `evaluation_stages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `evaluator_matrices`
--
ALTER TABLE `evaluator_matrices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `instructional_materials`
--
ALTER TABLE `instructional_materials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `matrices`
--
ALTER TABLE `matrices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `matrix_items`
--
ALTER TABLE `matrix_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `university_roles`
--
ALTER TABLE `university_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
