-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2023 at 12:03 PM
-- Server version: 10.6.15-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u695403275_logomax`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us_contents`
--

CREATE TABLE `about_us_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` longtext DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us_contents`
--

INSERT INTO `about_us_contents` (`id`, `name`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Upper Text Title', 'upper-text-title', NULL, 'textarea', NULL, '2023-11-17 10:37:01'),
(2, 'Upper Text Left', 'upper-text-left', '<h2>About Logomax</h2>\n<p><em>Unveiling Unique Identities, One Logo at a Time</em></p>\n<p>Welcome to Logomax, where exclusivity meets design. In a digital world brimming with repetitive and overused logos, we stand out by oﬀering a unique proposition - exclusive, once-in-a-lifetime logos. Established 2012, Logomax has been dedicated to creating and curating a diverse range of logo designs, each sold only once. At Logomax, we understand that a logo is more than just a graphic; it\'s the face of your brand, a visual story waiting to be told. Our platform brings together skilled designers from across the globe, each contributing to our eclectic mix of styles. Whether you\'re a budding startup or a seasoned enterprise, our collection has something for every brand personality.</p>', 'textarea', NULL, '2023-11-20 10:48:50'),
(3, 'Upper Text Right', 'upper-text-right', '<h2>Our Vision</h2>\n<p><em>Crafting Distinctive Brands with Exclusive Designs</em></p>\n<p>Our vision at Logomax is simple yet profound - to empower businesses with the ability to own a distinctive piece of art that sets them apart. With Logomax, when you buy a logo, you\'re not just making a purchase; you\'re claiming exclusivity. You become the sole owner of a design that can deﬁne your brand for years to come.</p>\n<p>We specialize in two tiers of logos - Low-priced Logos and Premium Logos, catering to a wide range of budgets without compromising on the uniqueness and quality of designs. Our categories, including Leter Mark Logos, Pictorial Mark Logos, Abstract Logos, Emblem Logos, Dynamic Logos, Minimalistic Logos, Geometric Logos and Combination Logos, ensure that you ﬁnd a logo that resonates with your brand\'s ethos eﬀortlessly.</p>', 'textarea', NULL, '2023-11-20 10:48:50'),
(4, 'video image', 'video-image', '2023-11-09_102227_video-img.png', 'file', NULL, NULL),
(5, 'video link', 'video-link', 'https://www.youtube.com/embed/M2kSJbLbIgQ', 'link', NULL, NULL),
(6, 'Contact Us', 'contact-us', '<h2>Contact Us</h2>\n<p>Send us your questions, comments, or suggestions and we will address them as quickly as possible. You can also check out our Help Center. Have another question? Contact us and we will get back to you as quickly as possible</p>', 'textarea', NULL, '2023-11-17 10:37:01'),
(7, 'video Text Title', 'video-text-title', '<h2>Our Commitment</h2>\n<p>Ensuring Satisfaction with Every Logo Story</p>', 'textarea', NULL, '2023-11-17 11:09:33'),
(8, 'video Text', 'video-text', '<p>Your journey to an iconic brand identity is paramount to us. At Logomax, we<br>ensure that every interaction is seamless, from browsing to purchasing your<br>exclusive logo. Our dedicated support team is always on standby to assist, making<br>your experience smooth and enjoyable.</p>\r\n<p>Choosing Logomax means opening for originality, exclusivity, and a commitment to quality. Join us in redeﬁning the way the world sees logos. With Logomax, embark on a journey to a distinctive brand identity that\'s truly your own.</p>', 'textarea', NULL, '2023-11-20 10:44:05'),
(9, 'Join Us Image', 'join-us-image', '2023-11-09_133334_signup-bg 1.png', 'file', NULL, NULL),
(10, 'Join Us', 'join-us', '<h2>Want to work with us?</h2>\n<p>Choosing Logomax means opening for originality, exclusivity, and a commitment to quality. Join us in redeﬁning the way the world sees logos. With Logomax, embark on a journey to a distinctive brand identity that\'s truly your own.</p>', 'textarea', NULL, '2023-11-17 11:14:15'),
(11, 'Facebook link', 'facebook-link', '#', 'link', NULL, NULL),
(12, 'Instagram link', 'instagram-link', '#', 'link', NULL, NULL),
(13, 'Pinterest link', 'pinterest-link', '#', 'link', NULL, NULL),
(14, 'Linked In link', 'linked-in-link', '#', 'link', NULL, NULL),
(15, 'meta title', 'meta-title', 'about us', 'textarea', NULL, '2023-11-17 11:11:45'),
(16, 'meta description', 'meta-description', NULL, 'textarea', NULL, '2023-11-17 10:37:01'),
(17, 'meta language', 'meta-language', 'test', 'textarea', NULL, NULL),
(18, 'meta country', 'meta-country', NULL, 'textarea', NULL, '2023-11-17 10:37:01');

-- --------------------------------------------------------

--
-- Table structure for table `additional_options`
--

CREATE TABLE `additional_options` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `option_text` varchar(255) NOT NULL,
  `option_type` varchar(255) NOT NULL,
  `pricing_duration` varchar(255) DEFAULT NULL,
  `percentage` int(11) DEFAULT NULL,
  `amount` double(8,2) DEFAULT NULL,
  `currency` varchar(255) NOT NULL DEFAULT 'usd',
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `additional_options`
--

INSERT INTO `additional_options` (`id`, `option_text`, `option_type`, `pricing_duration`, `percentage`, `amount`, `currency`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Logo backup service', 'save-logo-for-future', 'fixed', NULL, 5.00, 'usd', 1, '2023-10-14 09:57:38', '2023-11-24 04:23:52'),
(2, 'Favicon design', 'get-favicon', 'fixed', NULL, 29.00, 'usd', 1, '2023-10-14 09:59:09', '2023-11-24 05:07:54'),
(3, 'VAT/GST/Sales taxes', 'taxes', 'fixed', 18, NULL, 'usd', 1, '2023-10-14 10:00:44', '2023-10-14 10:00:44');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `sub_title` varchar(255) NOT NULL,
  `banner_img` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `slug`, `sub_title`, `banner_img`, `description`, `category_id`, `tags`, `created_by`, `status`, `created_at`, `updated_at`) VALUES
(3, 'The standard Lorem Ipsum passage, used since.', 'the-standard-lorem-ipsum-passage,-used-since.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text', 'The standard Lorem Ipsum passage, used since.7.webp', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose</p><h4><strong>Where does it come from?</strong></h4><p><br>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p><p>Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32</p><h4><strong>Where can I get some?</strong></h4><p><br>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p><p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p><h4><br><strong>The standard Lorem Ipsum passage, used since the 1500s</strong></h4><p><br>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p><h4><strong>What is Lorem Ipsum?</strong></h4><p><br>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 1, '[\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\",\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\"]', 1, 1, '2023-10-21 06:56:39', '2023-10-21 06:59:44'),
(4, 'The standard Lorem Ipsum passage, used since2.', 'the-standard-lorem-ipsum-passage,-used-since2.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text', 'The standard Lorem Ipsum passage, used since2.24.webp', '<p><br>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose</p><p>Where does it come from?</p><p><br>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p><p>Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32</p><p>Where can I get some?</p><p><br>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p><p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p><p><br>The standard Lorem Ipsum passage, used since the 1500s</p><p><br>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p><p>What is Lorem Ipsum?<br>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 1, '[\"14\"]', 1, 1, '2023-10-21 06:58:44', '2023-10-21 06:58:44'),
(5, 'The standard Lorem Ipsum passage, used since3.', 'the-standard-lorem-ipsum-passage,-used-since3.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text', 'The standard Lorem Ipsum passage, used since3.65.webp', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose</p><h4><strong>Where does it come from?</strong></h4><p><br>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p><p>Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32</p><h4><strong>Where can I get some?</strong></h4><p><br>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p><p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p><h4><br><strong>The standard Lorem Ipsum passage, used since the 1500s</strong></h4><p><br>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p><h4><strong>What is Lorem Ipsum?</strong></h4><p><br>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 1, '[\"15\"]', 1, 1, '2023-10-21 07:00:20', '2023-10-21 07:00:20'),
(6, 'The standard Lorem Ipsum passage, used since4.', 'the-standard-lorem-ipsum-passage,-used-since4.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text', 'The standard Lorem Ipsum passage, used since4.78.webp', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose</p><h4><strong>Where does it come from?</strong></h4><p><br>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p><p>Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32</p><h4><strong>Where can I get some?</strong></h4><p><br>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p><p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p><h4><br><strong>The standard Lorem Ipsum passage, used since the 1500s</strong></h4><p><br>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p><h4><strong>What is Lorem Ipsum?</strong></h4><p><br>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 1, '[\"16\"]', 1, 1, '2023-10-21 07:05:05', '2023-10-21 07:05:05'),
(7, 'The standard Lorem Ipsum passage, used since5.', 'the-standard-lorem-ipsum-passage,-used-since5.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text', 'The standard Lorem Ipsum passage, used since5.81.webp', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose</p><h4><strong>Where does it come from?</strong></h4><p><br>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p><p>Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32</p><h4><strong>Where can I get some?</strong></h4><p><br>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p><p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p><h4><br><strong>The standard Lorem Ipsum passage, used since the 1500s</strong></h4><p><br>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p><h4><strong>What is Lorem Ipsum?</strong></h4><p><br>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 1, '[\"17\",\"18\"]', 1, 1, '2023-10-21 07:06:02', '2023-10-21 07:06:02'),
(8, 'The standard Lorem Ipsum passage, used since6.', 'the-standard-lorem-ipsum-passage,-used-since6.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text', 'The standard Lorem Ipsum passage, used since6.33.webp', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose</p><h4><strong>Where does it come from?</strong></h4><p><br>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p><p>Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32</p><h4><strong>Where can I get some?</strong></h4><p><br>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p><p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p><h4><br><strong>The standard Lorem Ipsum passage, used since the 1500s</strong></h4><p><br>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p><h4><strong>What is Lorem Ipsum?</strong></h4><p><br>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 1, '[\"17\"]', 1, 1, '2023-10-21 07:06:59', '2023-10-21 07:06:59'),
(9, 'The standard Lorem Ipsum passage, used since7.', 'the-standard-lorem-ipsum-passage,-used-since7.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text', 'The standard Lorem Ipsum passage, used since7.7.webp', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose</p><h4><strong>Where does it come from?</strong></h4><p><br>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p><p>Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32</p><h4><strong>Where can I get some?</strong></h4><p><br>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p><p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p><h4><br><strong>The standard Lorem Ipsum passage, used since the 1500s</strong></h4><p><br>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p><h4><strong>What is Lorem Ipsum?</strong></h4><p><br>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 1, '[\"14\"]', 1, 1, '2023-10-21 07:07:34', '2023-10-21 07:07:34'),
(10, 'The standard Lorem Ipsum passage, used since8.', 'the-standard-lorem-ipsum-passage,-used-since8.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text', 'The standard Lorem Ipsum passage, used since8.37.webp', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose</p><h4><strong>Where does it come from?</strong></h4><p><br>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p><p>Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32</p><h4><strong>Where can I get some?</strong></h4><p><br>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p><p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p><h4><br><strong>The standard Lorem Ipsum passage, used since the 1500s</strong></h4><p><br>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p><h4><strong>What is Lorem Ipsum?</strong></h4><p><br>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 1, '[\"17\"]', 1, 1, '2023-10-21 07:07:58', '2023-10-21 07:07:58'),
(11, 'The standard Lorem Ipsum passage, used since9.', 'the-standard-lorem-ipsum-passage,-used-since9.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text', 'The standard Lorem Ipsum passage, used since9.37.webp', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose</p><h4><strong>Where does it come from?</strong></h4><p><br>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p><p>Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32</p><h4><strong>Where can I get some?</strong></h4><p><br>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p><p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p><h4><br><strong>The standard Lorem Ipsum passage, used since the 1500s</strong></h4><p><br>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p><h4><strong>What is Lorem Ipsum?</strong></h4><p><br>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 1, '[\"14\"]', 1, 1, '2023-10-21 07:08:36', '2023-10-21 07:08:36'),
(12, 'The standard Lorem Ipsum passage, used since22.', 'the-standard-lorem-ipsum-passage,-used-since22.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text', 'The standard Lorem Ipsum passage, used since22.63.webp', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose</p><h4><strong>Where does it come from?</strong></h4><p><br>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p><p>Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32</p><h4><strong>Where can I get some?</strong></h4><p><br>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p><p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p><h4><br><strong>The standard Lorem Ipsum passage, used since the 1500s</strong></h4><p><br>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p><h4><strong>What is Lorem Ipsum?</strong></h4><p><br>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 1, '[\"14\",\"21\"]', 1, 1, '2023-10-21 07:09:34', '2023-10-21 07:09:34'),
(14, 'The standard Lorem Ipsum passage, used sincce.', 'the-standard-lorem-ipsum-passage,-used-sincce.', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text', 'The standard Lorem Ipsum passage, used sincce.13.webp', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p><p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose</p><h4><strong>Where does it come from?</strong></h4><p><br>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source.</p><p>Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32</p><h4><strong>Where can I get some?</strong></h4><p><br>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text.</p><p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p><h4><br><strong>The standard Lorem Ipsum passage, used since the 1500s</strong></h4><p><br>\"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum</p><h4><strong>What is Lorem Ipsum?</strong></h4><p><br>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.</p><p>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', 1, '[\"23\",\"30\"]', 1, 1, '2023-10-21 07:12:58', '2023-10-21 07:12:58');

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `category_name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'emblems', 'emblems', 1, '2023-10-09 05:43:51', '2023-10-09 05:43:51'),
(2, 'pictorial marks', 'pictorial-marks', 1, '2023-10-09 05:44:04', '2023-10-09 05:44:04'),
(3, 'combination logos', 'combination-logos', 1, '2023-10-09 05:44:20', '2023-10-09 05:44:20');

-- --------------------------------------------------------

--
-- Table structure for table `blog_content`
--

CREATE TABLE `blog_content` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blog_contents`
--

CREATE TABLE `blog_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_contents`
--

INSERT INTO `blog_contents` (`id`, `name`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES
(1, 'meta title', 'meta-title', 'test', 'textarea', NULL, NULL),
(2, 'meta description', 'meta-description', '', 'textarea', NULL, NULL),
(3, 'meta language', 'meta-language', 'test', 'textarea', NULL, NULL),
(4, 'meta country', 'meta-country', '', 'textarea', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Technology', 'technology', 1, '2023-11-17 12:14:00', '2023-11-17 12:14:00'),
(2, 'Healthcare', 'healthcare', 1, '2023-11-17 12:14:11', '2023-11-17 12:14:11'),
(3, 'Food & Beverage', 'food-beverage', 1, '2023-11-17 12:14:32', '2023-11-17 12:14:32'),
(4, 'Fashion & Retail', 'fashion-retail', 1, '2023-11-17 12:14:51', '2023-11-17 12:14:51'),
(5, 'Sports & Fitness', 'sports-fitness', 1, '2023-11-17 12:15:06', '2023-11-17 12:15:06'),
(6, 'Education & Learning', 'education-learning', 1, '2023-11-17 12:15:27', '2023-11-17 12:15:27'),
(7, 'Travel & Hospitality', 'travel-hospitality', 1, '2023-11-17 12:17:17', '2023-11-17 12:17:17'),
(8, 'Arts & Entertainment', 'arts-entertainment', 1, '2023-11-17 12:17:33', '2023-11-17 12:17:33'),
(9, 'Real Estate & Construction', 'real-estate-construction', 1, '2023-11-17 12:17:53', '2023-11-17 12:17:53'),
(10, 'Finance & Legal', 'finance-legal', 1, '2023-11-17 12:18:11', '2023-11-17 12:18:11'),
(11, 'Automotive', 'automotive', 1, '2023-11-17 12:18:34', '2023-11-17 12:18:34'),
(12, 'Agriculture & Environment', 'agriculture-environment', 1, '2023-11-17 12:18:55', '2023-11-17 12:18:55'),
(13, 'Beauty & Wellness', 'beauty-wellness', 1, '2023-11-17 12:19:14', '2023-11-17 12:19:14'),
(14, 'Media & Communications', 'media-communications', 1, '2023-11-17 12:19:35', '2023-11-17 12:19:35'),
(15, 'Non-Profit & Community', 'non-profit-community', 1, '2023-11-17 12:19:52', '2023-11-17 12:19:52'),
(16, 'Others', 'others', 1, '2023-11-17 12:20:20', '2023-11-17 12:20:20');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent_category` varchar(255) DEFAULT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `parent_category`, `image`, `created_at`, `updated_at`) VALUES
(11, 'Abstract', 'abstract', NULL, 'abstract81.png', '2023-10-21 05:58:00', '2023-11-16 17:30:19'),
(12, 'Emblem', 'emblem', NULL, 'emblem77.png', '2023-10-21 05:58:13', '2023-11-16 17:30:35'),
(13, 'Dynamic', 'dynamic', NULL, 'dynamic69.png', '2023-10-21 05:58:34', '2023-11-16 17:30:48'),
(14, 'Minimalistic', 'minimalistic', NULL, 'minimalistic24.png', '2023-10-21 05:58:58', '2023-11-16 17:31:06'),
(15, 'Geometric', 'geometric', NULL, 'geometric64.png', '2023-10-21 06:00:31', '2023-11-16 17:31:21'),
(16, 'Combination', 'combination', NULL, 'combination96.png', '2023-10-23 16:54:33', '2023-11-16 17:31:36'),
(17, '3D', '3d', NULL, '3d99.jpg', '2023-11-20 08:43:33', '2023-11-20 08:43:33'),
(18, 'Monogram', 'monogram', NULL, 'monogram4.png', '2023-11-20 08:46:23', '2023-11-20 08:46:23'),
(21, 'Vintage', 'vintage', NULL, 'vintage93.jpg', '2023-11-20 08:56:10', '2023-11-20 08:58:59'),
(22, 'Negative Space', 'negative-space', NULL, 'negative-space70.png', '2023-11-20 09:00:29', '2023-11-20 09:00:29');

-- --------------------------------------------------------

--
-- Table structure for table `checkout`
--

CREATE TABLE `checkout` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `completed_task`
--

CREATE TABLE `completed_task` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `task_id` varchar(255) NOT NULL,
  `revision_id` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `designer_id` varchar(255) NOT NULL,
  `logo_id` varchar(255) NOT NULL,
  `media_id` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_content`
--

CREATE TABLE `home_content` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` longtext DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_content`
--

INSERT INTO `home_content` (`id`, `name`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES
(1, 'register background image', 'register-background-image', '1_1699516775.png', 'image', NULL, NULL),
(2, 'unique logos from text', 'unique-logos-from-text', '<h5>Unique logos from            <span>$149</span>          </h5>', 'textarea', NULL, NULL),
(3, 'professional logos title', 'professional-logos-title', 'Thousands of Unique & Exclusive Logo Designs', 'textarea', NULL, '2023-11-20 11:48:52'),
(4, 'professional logos text', 'professional-logos-text', '<p>Explore our exclusive collection where each logo is sold only once, guaranteeing you a unique design that<br>becomes a symbol of your brand\'s identity. Created by a global network of designers, our range oﬀers<br>diverse styles and themes, perfect for startups, growing businesses, or established brands.</p>', 'textarea', NULL, '2023-11-17 09:02:13'),
(5, 'registerbanner title', 'registerbanner-title', 'Register to Find Your Perfect Logo', 'textarea', NULL, '2023-11-17 09:04:18'),
(6, 'register banner title desc', 'register-banner-title-desc', 'Why Choose Logomax?', 'textarea', NULL, '2023-11-17 08:59:45'),
(7, 'register banner title text desc', 'register-banner-title-text-desc', '<p>Logomax is more than just a logo marketplace &ndash; it\'s a gateway to defining your brand\'s identity. Each logo in our collection is an original masterpiece, created with care and creativity by talented designers. When you choose Logomax, you\'re not just picking a logo; you\'re selecting a unique design that represents your brand\'s story and vision.</p>', 'textarea', NULL, '2023-11-20 12:23:58'),
(8, 'customer review title', 'customer-review-title', 'Why our customers love Logomax', 'textarea', NULL, NULL),
(9, 'customer review text', 'customer-review-text', '<p>Thousands of customers have chosen Logomax to deﬁne their brand\'s identity. Our exclusive, one-of-a-kind logos have helped businesses of all sizes make a lasting impression. Discover their experiences and learn why they trust Logomax to bring their brand vision to life.</p>', 'textarea', NULL, '2023-11-17 09:14:46'),
(10, 'meta title', 'meta-title', NULL, 'textarea', NULL, '2023-11-17 09:00:41'),
(11, 'meta description', 'meta-description', NULL, 'textarea', NULL, '2023-11-17 08:59:45'),
(12, 'meta language', 'meta-language', '<p>test</p>', 'textarea', NULL, '2023-11-17 08:59:45'),
(13, 'meta country', 'meta-country', NULL, 'textarea', NULL, '2023-11-17 08:59:45'),
(14, 'discover trending title', 'discover-trending-title', 'Discover what\'s Trending', 'textarea', '2023-11-20 12:13:53', '2023-11-20 12:13:53');

-- --------------------------------------------------------

--
-- Table structure for table `login_contents`
--

CREATE TABLE `login_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `login_contents`
--

INSERT INTO `login_contents` (`id`, `name`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES
(1, 'meta title', 'meta-title', 'test', 'textarea', NULL, NULL),
(2, 'meta description', 'meta-description', '', 'textarea', NULL, NULL),
(3, 'meta language', 'meta-language', 'test', 'textarea', NULL, NULL),
(4, 'meta country', 'meta-country', '', 'textarea', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `logos`
--

CREATE TABLE `logos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo_unique_id` varchar(255) NOT NULL,
  `designer_id` varchar(255) NOT NULL,
  `logo_name` varchar(255) NOT NULL,
  `logo_slug` varchar(255) NOT NULL,
  `media_id` varchar(255) NOT NULL,
  `tags` varchar(255) NOT NULL,
  `category_id` varchar(255) NOT NULL,
  `style_id` varchar(255) NOT NULL,
  `logo_type` varchar(255) NOT NULL DEFAULT 'low-price',
  `branch_id` int(11) NOT NULL DEFAULT 1,
  `price_for_customer` double(8,2) NOT NULL DEFAULT 199.00,
  `price_for_designer` double(8,2) NOT NULL DEFAULT 50.00,
  `currency` varchar(255) NOT NULL DEFAULT 'usd',
  `approved_status` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 1,
  `admin_review` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logos`
--

INSERT INTO `logos` (`id`, `logo_unique_id`, `designer_id`, `logo_name`, `logo_slug`, `media_id`, `tags`, `category_id`, `style_id`, `logo_type`, `branch_id`, `price_for_customer`, `price_for_designer`, `currency`, `approved_status`, `status`, `admin_review`, `created_at`, `updated_at`) VALUES
(1, '479328132', '2', 'App Solution', 'app-solution', '33', '[\"14\"]', '11', '2', 'low-price', 1, 199.00, 50.00, 'usd', 1, 3, NULL, '2023-10-31 12:50:11', '2023-10-31 13:04:33'),
(2, '838874246', '2', 'LANDGASTHOF', 'landgasthof', '34', '[\"20\",\"23\",\"24\",\"33\"]', '11', '3', 'low-price', 1, 199.00, 50.00, 'usd', 1, 3, NULL, '2023-10-31 12:53:36', '2023-11-03 14:12:34'),
(3, '982360944', '2', 'Hamburger', 'hamburger', '35', '[\"16\",\"34\"]', '12', '1', 'low-price', 1, 199.00, 50.00, 'usd', 1, 3, NULL, '2023-10-31 12:56:04', '2023-11-10 07:02:41'),
(4, '754606287', '2', 'DrVita', 'drvita', '36', '[\"15\",\"21\",\"23\",\"26\",\"28\",\"31\"]', '11', '1', 'low-price', 10, 199.00, 50.00, 'usd', 1, 3, NULL, '2023-10-31 12:58:17', '2023-11-24 08:13:19'),
(5, '385651305', '2', 'WEBTEC', 'webtec', '37', '[\"15\",\"20\",\"23\",\"28\",\"31\",\"32\",\"35\"]', '14', '5', 'low-price', 6, 199.00, 50.00, 'usd', 1, 3, NULL, '2023-10-31 12:59:33', '2023-11-22 13:06:28'),
(6, '883976048', '2', 'Photruosch', 'photruosch', '38', '[\"13\",\"15\",\"19\",\"20\",\"21\",\"23\"]', '13', '4', 'low-price', 8, 199.00, 50.00, 'usd', 1, 3, NULL, '2023-10-31 13:01:09', '2023-11-24 10:11:09'),
(7, '945066345', '2', 'Enlighbened', 'enlighbened', '39', '[\"13\",\"15\",\"19\",\"20\",\"23\",\"26\",\"28\"]', '11', '3', 'low-price', 9, 199.00, 50.00, 'usd', 1, 1, NULL, '2023-10-31 13:02:37', '2023-10-31 13:25:40'),
(8, '804994388', '2', 'Schwabischeable', 'schwabischeable', '40', '[\"15\",\"20\",\"21\",\"22\",\"27\",\"28\",\"30\"]', '11', '2', 'low-price', 2, 199.00, 50.00, 'usd', 1, 3, NULL, '2023-10-31 13:04:20', '2023-11-24 08:38:46'),
(9, '170581633', '2', 'CAUBABAU', 'caubabau', '41', '[\"12\",\"13\",\"14\",\"15\",\"17\",\"22\",\"23\",\"25\",\"29\"]', '12', '3', 'low-price', 6, 199.00, 50.00, 'usd', 1, 1, NULL, '2023-10-31 13:05:36', '2023-10-31 13:26:06'),
(10, '885045446', '2', 'Bytelab', 'bytelab', '42', '[\"13\",\"14\",\"23\",\"26\",\"27\",\"29\",\"30\",\"31\"]', '11', '4', 'low-price', 5, 199.00, 50.00, 'usd', 1, 1, NULL, '2023-10-31 13:06:57', '2023-10-31 13:26:18'),
(11, '199708309', '2', 'Alisystems', 'alisystems', '43', '[\"13\",\"15\",\"16\",\"18\",\"20\",\"21\",\"23\",\"26\",\"28\"]', '13', '5', 'low-price', 4, 199.00, 50.00, 'usd', 1, 1, NULL, '2023-10-31 13:08:11', '2023-10-31 13:28:12'),
(12, '491650965', '2', 'Mommy', 'mommy', '44', '[\"12\",\"13\",\"14\",\"16\",\"17\",\"18\",\"22\",\"24\",\"25\",\"29\",\"30\"]', '14', '1', 'low-price', 3, 199.00, 50.00, 'usd', 1, 1, NULL, '2023-10-31 13:09:21', '2023-10-31 13:26:29'),
(13, '826810586', '2', 'Comenabag', 'comenabag', '45', '[\"12\",\"13\",\"19\",\"20\",\"21\",\"24\",\"28\",\"31\"]', '11', '2', 'low-price', 3, 199.00, 50.00, 'usd', 1, 1, NULL, '2023-10-31 13:10:37', '2023-10-31 13:27:57'),
(14, '333461680', '2', 'Twinsworld', 'twinsworld', '46', '[\"12\",\"13\",\"14\",\"15\",\"18\",\"20\",\"23\",\"26\",\"27\",\"28\"]', '11', '3', 'low-price', 5, 199.00, 50.00, 'usd', 1, 1, NULL, '2023-10-31 13:11:39', '2023-10-31 13:26:51'),
(15, '820306734', '2', 'Ensur Frejus moters', 'ensur-frejus-moters', '47', '[\"12\",\"13\",\"14\",\"15\",\"16\",\"19\",\"20\",\"23\",\"24\",\"25\",\"26\",\"30\",\"31\"]', '12', '4', 'low-price', 6, 199.00, 50.00, 'usd', 1, 1, NULL, '2023-10-31 13:13:41', '2023-10-31 13:26:40'),
(16, '522545430', '2', 'Kulinarium', 'kulinarium', '48', '[\"20\",\"21\",\"23\",\"24\",\"25\",\"28\",\"29\",\"30\",\"31\"]', '13', '5', 'low-price', 5, 199.00, 50.00, 'usd', 1, 1, NULL, '2023-10-31 13:14:54', '2023-10-31 13:27:23'),
(17, '152312764', '2', 'Ange dogt', 'ange-dogt', '49', '[\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"21\",\"23\",\"24\",\"27\"]', '14', '1', 'low-price', 11, 199.00, 50.00, 'usd', 1, 1, NULL, '2023-10-31 13:16:26', '2023-10-31 13:27:01'),
(18, '337192043', '2', 'Buy direct', 'buy-direct', '50', '[\"15\",\"16\",\"18\",\"19\",\"20\",\"21\",\"23\",\"27\",\"28\"]', '11', '3', 'low-price', 4, 199.00, 50.00, 'usd', 1, 1, NULL, '2023-10-31 13:17:54', '2023-10-31 13:27:13'),
(19, '976578076', '2', 'GWFK', 'gwfk', '51', '[\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"20\",\"21\",\"22\",\"23\",\"25\",\"26\"]', '12', '4', 'low-price', 5, 199.00, 50.00, 'usd', 1, 1, NULL, '2023-10-31 13:18:55', '2023-10-31 13:27:46'),
(20, '122316406', '2', 'Pastaholics', 'pastaholics', '52', '[\"12\",\"14\",\"16\",\"21\",\"25\",\"28\",\"29\",\"30\",\"34\"]', '14', '3', 'low-price', 4, 199.00, 50.00, 'usd', 1, 1, NULL, '2023-10-31 13:20:01', '2023-10-31 13:27:34'),
(21, '337377560', '20', 'Test', 'test', '58', '[\"15\"]', '12', '2', 'low-price', 5, 199.00, 50.00, 'usd', 0, 1, NULL, '2023-11-22 13:09:21', '2023-11-22 13:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `logo_facilities`
--

CREATE TABLE `logo_facilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `facilities_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logo_facilities`
--

INSERT INTO `logo_facilities` (`id`, `facilities_name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Rapid, Free Customization', 'Download your logo files instantly upon purchase. Need adjustments? Our complimentary customizaon service delivers changes within 1 business day. Enjoy up to 3 revisions, covering brand name, colors, and fonts to ensure your logo perfectly suits your vision.', 1, '2023-10-14 09:09:07', '2023-10-14 09:09:07'),
(2, 'Exclusivity Guaranteed', 'Each logo is designed to be one-of-a-kind and will only be sold to a single customer. This means your brand will have a unique identy that stands out from competors, and you can be confident in a logo that truly represents your business.', 1, '2023-10-14 09:09:47', '2023-10-14 09:09:47'),
(3, 'Immediate Use', 'As predesigned logos, they\'re ready to be used right away. No waing for designers to create something from scratch – you can start building your brand immediately.', 1, '2023-10-14 09:10:23', '2023-10-14 09:12:25'),
(4, 'Brand Registraon Allowed', 'We allow brand registraon, ensuring that your chosen logo is legally protected. This helps you establish your brand\'s authencity and safeguards it from potenal infringements.', 1, '2023-10-14 09:13:09', '2023-10-14 09:13:09'),
(5, 'Affordable Pricing', 'Building a brand doesn\'t have to break the bank. Our logos offer a cost-effecve soluon for businesses looking to establish a strong visual identy.', 1, '2023-10-14 09:13:33', '2023-10-14 09:13:33'),
(6, 'Unrestricted License: Your Brand, Your Terms', 'Our licensing agreement grants you exclusive ownership of the logo. Feel free to ulize it in any manner you prefer, without the need to acknowledge us. Shape your brand identy on your terms.', 1, '2023-10-14 09:14:03', '2023-10-14 09:14:03');

-- --------------------------------------------------------

--
-- Table structure for table `logo_reviews`
--

CREATE TABLE `logo_reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `logo_id` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `approved` varchar(255) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `home_page_status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logo_reviews`
--

INSERT INTO `logo_reviews` (`id`, `user_id`, `logo_id`, `title`, `description`, `approved`, `rating`, `status`, `home_page_status`, `created_at`, `updated_at`) VALUES
(1, 'admin', '1', 'Burno', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an ...', '1', '5', '1', 0, '2023-11-09 14:04:46', '2023-11-10 06:33:21'),
(2, 'admin', '1', 'Jenny', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an ...', '1', '5', '1', 0, '2023-11-09 14:04:56', '2023-11-10 06:33:21'),
(3, 'admin', '2', 'Jack', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an ...', '1', '4', '1', 0, '2023-11-09 14:05:12', '2023-11-10 06:33:22'),
(4, 'admin', '2', 'Beverly Gibson', '“The early pay off option and how easy it is to get the account approved.”', '1', '4', '1', 1, '2023-11-10 06:26:16', '2023-11-10 06:33:11'),
(5, 'admin', '1', 'Michael Warren ', '“Seems legit only complaint is cashout kinda high at 70 minimum but”', '1', '5', '1', 1, '2023-11-10 06:28:33', '2023-11-10 06:33:12'),
(6, 'admin', '1', 'Barbara Strange', '“I have used Approved Science for a few years now, they have really helped me with my RLS (restless leg syndrome) I use their product called Restlex and it helps...”', '1', '4', '1', 1, '2023-11-10 06:29:04', '2023-11-10 06:33:15'),
(7, 'admin', '1', 'Rachel Tara', '“The experience was smooth and easy. Travia was very nice and professional.”', '1', '5', '1', 1, '2023-11-10 06:29:37', '2023-11-10 06:50:38'),
(8, 'admin', '1', 'HAJARA FARUK TUKUR', '“I want to study thing about what is doing in the world”', '1', '5', '1', 0, '2023-11-10 06:30:24', '2023-11-10 06:30:24'),
(9, 'admin', '2', 'Wayne Burrows', '“Verifying excel skills without allowing the user to have feedback about what skills are claimed to be deficient is a very poor model. It seems like they are ju...”', '1', '4', '1', 1, '2023-11-10 06:30:50', '2023-11-10 06:33:24'),
(10, 'admin', '2', 'Janet Lytle', '“The site was super easy to use and selections were amazing!”', '1', '5', '1', 1, '2023-11-10 06:31:19', '2023-11-10 06:33:25'),
(11, 'admin', '2', 'Tricia Sproles', '“I\'ve lost everything , and needed help , thank you for your service”', '1', '4', '1', 0, '2023-11-10 06:31:55', '2023-11-10 06:31:55'),
(12, 'admin', '2', 'Samish Murugesan', '“Mumbai mahalaxshmi lounge All experience was great everyone did support Arzoo”', '1', '5', '1', 0, '2023-11-10 06:32:35', '2023-11-10 06:32:35'),
(13, '4', '1', 'Good', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an ...', '1', '5', '1', 0, '2023-11-23 06:44:18', '2023-11-23 06:45:36');

-- --------------------------------------------------------

--
-- Table structure for table `logo_revisions`
--

CREATE TABLE `logo_revisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `request_title` varchar(255) NOT NULL,
  `request_description` text NOT NULL,
  `logo_id` varchar(255) NOT NULL,
  `revision_time` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `assigned` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logo_revisions`
--

INSERT INTO `logo_revisions` (`id`, `order_id`, `request_title`, `request_description`, `logo_id`, `revision_time`, `status`, `assigned`, `created_at`, `updated_at`) VALUES
(2, '1', 'Change text', 'Change text to sagmetic infotech', '1', NULL, 0, 1, '2023-10-31 13:28:09', '2023-11-01 07:41:33'),
(3, '6', 'change the color', 'change the color', '8', 0, 0, 1, '2023-11-24 08:45:06', '2023-11-24 08:55:37');

-- --------------------------------------------------------

--
-- Table structure for table `logo_status`
--

CREATE TABLE `logo_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `logo_status`
--

INSERT INTO `logo_status` (`id`, `status`, `name`, `created_at`, `updated_at`) VALUES
(1, '1', 'for sale', NULL, NULL),
(2, '2', 'on revision', NULL, NULL),
(3, '3', 'sold', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `image_size` varchar(255) NOT NULL,
  `image_dimensions` varchar(255) NOT NULL,
  `image_format` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `image_name`, `image_path`, `image_size`, `image_dimensions`, `image_format`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Logo_169634201539.png', '/logos/Logo_169634201539.png', '14.005 KB', 'width=\"920\" height=\"512\"', 'image/png', 1, '2023-10-03 14:06:55', '2023-10-03 14:06:55'),
(2, 'Logo_169657889562.png', '/logos/Logo_169657889562.png', '14.005 KB', 'width=\"920\" height=\"512\"', 'image/png', 1, '2023-10-06 07:54:55', '2023-10-06 07:54:55'),
(3, 'Logo_16965789721.png', '/logos/Logo_16965789721.png', '14.005 KB', 'width=\"920\" height=\"512\"', 'image/png', 1, '2023-10-06 07:56:12', '2023-10-06 07:56:12'),
(4, 'Logo_169657899760.png', '/logos/Logo_169657899760.png', '14.005 KB', 'width=\"920\" height=\"512\"', 'image/png', 1, '2023-10-06 07:56:37', '2023-10-06 07:56:37'),
(5, 'Logo_169658829143.png', '/logos/Logo_169658829143.png', '14.005 KB', 'width=\"920\" height=\"512\"', 'image/png', 1, '2023-10-06 10:31:31', '2023-10-06 10:31:31'),
(6, 'Logo_169658840089.png', '/logos/Logo_169658840089.png', '14.005 KB', 'width=\"920\" height=\"512\"', 'image/png', 1, '2023-10-06 10:33:20', '2023-10-06 10:33:20'),
(7, 'Logo_169658893884.png', '/logos/Logo_169658893884.png', '14.005 KB', 'width=\"920\" height=\"512\"', 'image/png', 1, '2023-10-06 10:42:18', '2023-10-06 10:42:18'),
(8, 'Logo_169658969511.png', '/logos/Logo_169658969511.png', '14.005 KB', 'width=\"920\" height=\"512\"', 'image/png', 1, '2023-10-06 10:54:55', '2023-10-06 10:54:55'),
(9, 'Logo_169659535110.png', '/logos/Logo_169659535110.png', '14.005 KB', 'width=\"920\" height=\"512\"', 'image/png', 1, '2023-10-06 12:29:11', '2023-10-06 12:29:11'),
(10, 'Logo_169659581915.png', '/logos/Logo_169659581915.png', '33.647 KB', 'width=\"768\" height=\"591\"', 'image/png', 1, '2023-10-06 12:36:59', '2023-10-06 12:36:59'),
(11, 'Logo_169683172756.png', '/logos/Logo_169683172756.png', '39.276 KB', 'width=\"2560\" height=\"1646\"', 'image/png', 1, '2023-10-09 06:08:47', '2023-10-09 06:08:47'),
(12, 'Logo_169683178455.png', '/logos/Logo_169683178455.png', '39.276 KB', 'width=\"2560\" height=\"1646\"', 'image/png', 1, '2023-10-09 06:09:44', '2023-10-09 06:09:44'),
(13, 'Logo_169683192476.png', '/logos/Logo_169683192476.png', '50.406 KB', 'width=\"455\" height=\"258\"', 'image/png', 1, '2023-10-09 06:12:04', '2023-10-09 06:12:04'),
(14, 'Logo_169686004269.png', '/logos/Logo_169686004269.png', '22.527 KB', 'width=\"360\" height=\"257\"', 'image/png', 1, '2023-10-09 14:00:42', '2023-10-09 14:00:42'),
(15, 'Logo_169691870319.png', '/logos/Logo_169691870319.png', '10.547 KB', 'width=\"202\" height=\"144\"', 'image/png', 1, '2023-10-10 06:18:23', '2023-10-10 06:18:23'),
(16, 'Logo_169693261142.png', '/logos/Logo_169693261142.png', '39.276 KB', 'width=\"2560\" height=\"1646\"', 'image/png', 1, '2023-10-10 10:10:11', '2023-10-10 10:10:11'),
(17, 'Logo_169693261965.png', '/logos/Logo_169693261965.png', '39.276 KB', 'width=\"2560\" height=\"1646\"', 'image/png', 1, '2023-10-10 10:10:19', '2023-10-10 10:10:19'),
(18, 'Logo_169693263787.png', '/logos/Logo_169693263787.png', '39.276 KB', 'width=\"2560\" height=\"1646\"', 'image/png', 1, '2023-10-10 10:10:37', '2023-10-10 10:10:37'),
(19, 'Logo_169727937749.png', '/logos/Logo_169727937749.png', '52.227 KB', 'width=\"360\" height=\"360\"', 'image/png', 1, '2023-10-14 10:29:37', '2023-10-14 10:29:37'),
(20, 'Logo_169728139739.png', '/logos/Logo_169728139739.png', '52.227 KB', 'width=\"360\" height=\"360\"', 'image/png', 1, '2023-10-14 11:03:17', '2023-10-14 11:03:17'),
(21, 'Logo_169787755812.png', '/logos/Logo_169787755812.png', '14.61 KB', 'width=\"415\" height=\"295\"', 'image/png', 1, '2023-10-21 08:39:18', '2023-10-21 08:39:18'),
(22, 'Logo_169787817072.png', '/logos/Logo_169787817072.png', '4.701 KB', 'width=\"202\" height=\"144\"', 'image/png', 1, '2023-10-21 08:49:30', '2023-10-21 08:49:30'),
(23, 'Logo_169787821261.png', '/logos/Logo_169787821261.png', '6.105 KB', 'width=\"202\" height=\"144\"', 'image/png', 1, '2023-10-21 08:50:12', '2023-10-21 08:50:12'),
(24, 'Logo_169787823834.png', '/logos/Logo_169787823834.png', '12.283 KB', 'width=\"202\" height=\"144\"', 'image/png', 1, '2023-10-21 08:50:38', '2023-10-21 08:50:38'),
(25, 'Logo_169807903117.png', '/logos/Logo_169807903117.png', '20.124 KB', 'width=\"450\" height=\"300\"', 'image/png', 1, '2023-10-23 16:37:11', '2023-10-23 16:37:11'),
(26, 'Logo_169815570090.png', '/logos/Logo_169815570090.png', '21.618 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-24 13:55:00', '2023-10-24 13:55:00'),
(27, 'Logo_169815573459.png', '/logos/Logo_169815573459.png', '41.51 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-24 13:55:34', '2023-10-24 13:55:34'),
(28, 'Logo_169815588729.png', '/logos/Logo_169815588729.png', '28.899 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-24 13:58:07', '2023-10-24 13:58:07'),
(29, 'Logo_169815605063.png', '/logos/Logo_169815605063.png', '18.65 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-24 14:00:50', '2023-10-24 14:00:50'),
(30, 'Logo_169815608922.png', '/logos/Logo_169815608922.png', '21.618 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-24 14:01:29', '2023-10-24 14:01:29'),
(31, 'Logo_169875565432.png', '/logos/Logo_169875565432.png', '13.519 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 12:34:14', '2023-10-31 12:34:14'),
(32, 'Logo_169875594171.png', '/logos/Logo_169875594171.png', '13.519 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 12:39:01', '2023-10-31 12:39:01'),
(33, 'Logo_169875645245.png', '/logos/Logo_169875645245.png', '13.519 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 12:47:32', '2023-10-31 12:47:32'),
(34, 'Logo_169875675685.png', '/logos/Logo_169875675685.png', '41.51 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 12:52:36', '2023-10-31 12:52:36'),
(35, 'Logo_169875688586.png', '/logos/Logo_169875688586.png', '35.677 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 12:54:45', '2023-10-31 12:54:45'),
(36, 'Logo_169875706080.png', '/logos/Logo_169875706080.png', '21.618 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 12:57:40', '2023-10-31 12:57:40'),
(37, 'Logo_169875713653.png', '/logos/Logo_169875713653.png', '17.511 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 12:58:56', '2023-10-31 12:58:56'),
(38, 'Logo_169875726818.png', '/logos/Logo_169875726818.png', '18.65 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 13:01:08', '2023-10-31 13:01:08'),
(39, 'Logo_169875731775.png', '/logos/Logo_169875731775.png', '21.131 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 13:01:57', '2023-10-31 13:01:57'),
(40, 'Logo_169875745829.png', '/logos/Logo_169875745829.png', '30.872 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 13:04:18', '2023-10-31 13:04:18'),
(41, 'Logo_169875753053.png', '/logos/Logo_169875753053.png', '17.402 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 13:05:30', '2023-10-31 13:05:30'),
(42, 'Logo_169875757381.png', '/logos/Logo_169875757381.png', '16.418 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 13:06:13', '2023-10-31 13:06:13'),
(43, 'Logo_169875764459.png', '/logos/Logo_169875764459.png', '28.899 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 13:07:24', '2023-10-31 13:07:24'),
(44, 'Logo_169875775611.png', '/logos/Logo_169875775611.png', '19.489 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 13:09:16', '2023-10-31 13:09:16'),
(45, 'Logo_169875779131.png', '/logos/Logo_169875779131.png', '22.518 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 13:09:51', '2023-10-31 13:09:51'),
(46, 'Logo_169875786435.png', '/logos/Logo_169875786435.png', '17.995 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 13:11:04', '2023-10-31 13:11:04'),
(47, 'Logo_169875797711.png', '/logos/Logo_169875797711.png', '43.648 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 13:12:57', '2023-10-31 13:12:57'),
(48, 'Logo_169875805911.png', '/logos/Logo_169875805911.png', '25.201 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 13:14:19', '2023-10-31 13:14:19'),
(49, 'Logo_169875818142.png', '/logos/Logo_169875818142.png', '16.385 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 13:16:21', '2023-10-31 13:16:21'),
(50, 'Logo_169875827022.png', '/logos/Logo_169875827022.png', '14.612 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 13:17:50', '2023-10-31 13:17:50'),
(51, 'Logo_169875830091.png', '/logos/Logo_169875830091.png', '17.963 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 13:18:20', '2023-10-31 13:18:20'),
(52, 'Logo_169875839924.png', '/logos/Logo_169875839924.png', '36.242 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 13:19:59', '2023-10-31 13:19:59'),
(53, 'Logo_169875967173.ai', '/logos/Logo_169875967173.ai', '3.036 KB', '', '', 1, '2023-10-31 13:41:11', '2023-10-31 13:41:11'),
(54, 'Logo_169875967186.jpg', '/logos/Logo_169875967186.jpg', '3.86 KB', 'width=\"359\" height=\"359\"', 'image/jpeg', 1, '2023-10-31 13:41:11', '2023-10-31 13:41:11'),
(55, 'Logo_169875967129.png', '/logos/Logo_169875967129.png', '13.519 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-10-31 13:41:11', '2023-10-31 13:41:11'),
(58, 'Logo_170065855871.png', '/logos/Logo_170065855871.png', '17.402 KB', 'width=\"359\" height=\"359\"', 'image/png', 1, '2023-11-22 13:09:18', '2023-11-22 13:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` int(11) NOT NULL,
  `reciever_id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `seen_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `reciever_id`, `message`, `seen_status`, `created_at`, `updated_at`) VALUES
(11, 4, 6, 'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2023-11-21 06:13:08', '2023-11-24 05:38:52'),
(12, 4, 6, 'hello', 1, '2023-11-21 06:13:42', '2023-11-24 05:38:52'),
(13, 4, 6, 'It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2023-11-21 06:13:51', '2023-11-24 05:38:52'),
(14, 4, 6, 'hello', 1, '2023-11-21 06:28:20', '2023-11-24 05:38:52'),
(15, 6, 4, 'hello', 1, '2023-11-21 08:12:07', '2023-11-24 05:37:21'),
(16, 6, 4, 'how are you', 1, '2023-11-21 08:15:48', '2023-11-24 05:37:21'),
(17, 6, 4, 'hello', 1, '2023-11-21 08:17:32', '2023-11-24 05:37:21'),
(18, 4, 6, 'hello', 1, '2023-11-21 08:27:51', '2023-11-24 05:38:52'),
(19, 4, 6, 'hello', 1, '2023-11-21 08:29:33', '2023-11-24 05:38:52'),
(20, 4, 6, 'hello', 1, '2023-11-21 08:30:31', '2023-11-24 05:38:52'),
(21, 4, 6, 'hello', 1, '2023-11-21 08:31:21', '2023-11-24 05:38:52'),
(22, 4, 6, 'hello', 1, '2023-11-21 08:32:08', '2023-11-24 05:38:52'),
(23, 4, 6, 'hello', 1, '2023-11-21 08:33:08', '2023-11-24 05:38:52'),
(24, 4, 6, 'done', 1, '2023-11-21 08:36:01', '2023-11-24 05:38:52'),
(25, 6, 4, 'hello', 1, '2023-11-21 23:42:21', '2023-11-24 05:37:21'),
(26, 4, 6, 'hello', 1, '2023-11-21 23:45:55', '2023-11-24 05:38:52'),
(27, 4, 6, 'hello', 1, '2023-11-21 23:47:05', '2023-11-24 05:38:52'),
(28, 4, 6, 'done', 1, '2023-11-21 23:47:25', '2023-11-24 05:38:52'),
(29, 6, 4, 'testing', 1, '2023-11-22 00:02:21', '2023-11-24 05:37:21'),
(30, 6, 4, 'testing', 1, '2023-11-22 00:04:31', '2023-11-24 05:37:21'),
(31, 4, 6, 'hello', 1, '2023-11-22 00:05:03', '2023-11-24 05:38:52'),
(32, 6, 4, 'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 1, '2023-11-22 00:08:13', '2023-11-24 05:37:21'),
(33, 4, 6, 'when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged', 1, '2023-11-22 00:08:29', '2023-11-24 05:38:52'),
(34, 4, 6, ':)', 1, '2023-11-22 00:08:45', '2023-11-24 05:38:52'),
(35, 4, 6, ':)', 1, '2023-11-22 00:08:46', '2023-11-24 05:38:52'),
(78, 6, 4, 'hello', 1, '2023-11-22 05:39:11', '2023-11-24 05:37:21'),
(79, 4, 6, 'hello', 1, '2023-11-22 05:39:35', '2023-11-24 05:38:52'),
(80, 4, 6, 'hkjhjk', 1, '2023-11-22 05:40:04', '2023-11-24 05:38:52'),
(81, 4, 6, 'bnbvj', 1, '2023-11-22 05:40:14', '2023-11-24 05:38:52'),
(82, 6, 4, 'gdfgdfgdfg', 1, '2023-11-22 05:51:39', '2023-11-24 05:37:21'),
(83, 6, 4, 'gfdgdfg', 1, '2023-11-22 05:53:39', '2023-11-24 05:37:21'),
(84, 6, 4, 'teadfasdf', 1, '2023-11-22 05:56:24', '2023-11-24 05:37:21'),
(85, 6, 4, 'adfasdfads', 1, '2023-11-22 06:00:36', '2023-11-24 05:37:21'),
(86, 6, 4, 'adfads', 1, '2023-11-22 06:00:46', '2023-11-24 05:37:21'),
(87, 6, 4, 'adfasdfasdfasf', 1, '2023-11-22 06:00:53', '2023-11-24 05:37:21'),
(88, 6, 4, 'hellloooo', 1, '2023-11-22 06:02:40', '2023-11-24 05:37:21'),
(89, 4, 6, 'doneeee', 1, '2023-11-22 06:02:52', '2023-11-24 05:38:52'),
(90, 4, 6, 'sfasdfasd', 1, '2023-11-22 06:02:58', '2023-11-24 05:38:52'),
(91, 4, 6, 'asdfasdf', 1, '2023-11-22 06:03:05', '2023-11-24 05:38:52'),
(92, 4, 6, 'done', 1, '2023-11-22 06:04:49', '2023-11-24 05:38:52'),
(93, 4, 6, 'dsfs', 1, '2023-11-22 06:05:17', '2023-11-24 05:38:52'),
(94, 4, 6, 'hello', 1, '2023-11-23 08:02:11', '2023-11-24 05:38:52'),
(95, 4, 6, 'hlo', 1, '2023-11-23 08:02:23', '2023-11-24 05:38:52'),
(96, 4, 6, 'done', 1, '2023-11-23 08:03:41', '2023-11-24 05:38:52'),
(97, 6, 4, 'hello', 1, '2023-11-23 10:17:10', '2023-11-24 05:37:21'),
(98, 4, 6, 'done', 1, '2023-11-24 05:37:33', '2023-11-24 05:38:52'),
(99, 4, 6, 'done', 0, '2023-11-24 05:39:02', '2023-11-24 05:39:02'),
(100, 4, 3, 'hello Designer', 0, '2023-11-24 08:56:26', '2023-11-24 08:56:26'),
(101, 4, 3, 'dad', 0, '2023-11-24 09:51:59', '2023-11-24 09:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(8, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(9, '2019_08_19_000000_create_failed_jobs_table', 1),
(10, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(14, '2023_09_29_062945_create_tags_table', 3),
(16, '2023_09_29_080738_create_media_table', 3),
(17, '2023_10_03_133859_create_blogs_table', 4),
(18, '2023_10_04_063401_create_blog_categories_table', 4),
(19, '2023_05_09_065149_create_categories_table', 5),
(21, '2023_10_06_101115_create_styles_table', 7),
(24, '2023_09_27_082808_notifications', 9),
(26, '2023_10_11_085533_create_checkout_table', 11),
(28, '2023_10_11_113428_create_logo_facilities_table', 11),
(29, '2023_10_11_131136_create_additional_options_table', 11),
(30, '2023_10_12_125110_create_user_billing_address_table', 11),
(31, '2014_10_12_000000_create_users_table', 12),
(32, '2023_10_16_104632_create_logo_status_table', 13),
(37, '2023_10_24_054401_create_payments_table', 13),
(39, '2023_10_27_113938_create_wishlists_table', 14),
(40, '2023_09_29_080709_create_logos_table', 15),
(41, '2023_10_11_085837_create_order_table', 16),
(42, '2023_10_23_115225_create_order_meta_table', 17),
(43, '2023_10_16_110540_create_logo_revision_table', 18),
(44, '2023_10_18_074341_create_special_designer_tasks_table', 19),
(45, '2023_10_20_125208_create_completed_task_table', 20),
(46, '2023_11_07_055543_create_site_metas_table', 21),
(48, '2023_11_07_125302_create_about_us_content_table', 22),
(50, '2023_11_07_125343_create_blog_content_table', 22),
(51, '2023_11_07_125353_create_support_content_table', 22),
(52, '2023_05_02_105938_create_user_roles_table', 23),
(54, '2023_11_09_105503_create_support_contents_table', 25),
(55, '2023_11_07_125302_create_about_us_contents_table', 26),
(56, '2023_11_07_125326_create_reviews_content_table', 27),
(57, '2023_10_24_071955_create_logo_review_table', 28),
(59, '2023_11_15_110721_create_review_contents_table', 30),
(60, '2023_11_15_110737_create_blog_contents_table', 30),
(61, '2023_11_15_110838_create_register_contents_table', 30),
(62, '2023_11_15_110848_create_login_contents_table', 30),
(63, '2023_11_16_070219_create_shop_contents_table', 30),
(64, '2023_11_16_092800_create_branches_table', 30),
(65, '2023_11_07_125238_create_home_content_table', 31),
(66, '2023_11_21_052514_create_messages_table', 32);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `is_read` int(11) NOT NULL DEFAULT 0,
  `type` varchar(255) NOT NULL,
  `sender_id` varchar(255) NOT NULL DEFAULT '0',
  `reciever_id` varchar(255) NOT NULL DEFAULT '0',
  `designer_id` varchar(255) NOT NULL,
  `logo_id` int(11) DEFAULT NULL,
  `message` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `is_read`, `type`, `sender_id`, `reciever_id`, `designer_id`, `logo_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 1, 'logo-added', '0', '0', '5', 1, 'New logo is <span>Added !</span>', '2023-10-09 06:09:46', '2023-10-09 06:09:53'),
(2, 1, 'logo-disapproved', '0', '5', '5', 1, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-09 06:10:33', '2023-10-09 06:10:51'),
(3, 1, 'logo-added', '0', '0', '5', 2, 'New logo is <span>Added !</span>', '2023-10-09 06:12:32', '2023-10-09 06:12:53'),
(4, 1, 'logo-approved', '0', '5', '5', 2, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-09 06:13:03', '2023-10-09 06:13:24'),
(5, 1, 'designer-disapprove', '0', '5', '5', NULL, 'OOPS ! Your account has been <span>Disapproved !</span>', '2023-10-09 06:13:48', '2023-10-09 06:33:24'),
(6, 1, 'designer-approve', '0', '5', '5', NULL, 'Congratulations ! Your account has been <span>Approved !</span>', '2023-10-09 06:14:07', '2023-10-09 06:14:10'),
(7, 1, 'logo-added', '0', '0', '4', 1, 'New logo is <span>Added !</span>', '2023-10-09 14:00:44', '2023-10-09 14:00:52'),
(8, 1, 'logo-approved', '0', '4', '4', 1, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-09 14:01:50', '2023-10-09 14:02:06'),
(9, 1, 'logo-approved', '0', '4', '4', 1, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-09 14:01:50', '2023-10-09 14:02:24'),
(10, 1, 'logo-added', '0', '0', '3', 2, 'New logo is <span>Added !</span>', '2023-10-10 06:18:29', '2023-10-10 07:15:58'),
(11, 0, 'logo-approved', '0', '3', '3', 2, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-10 06:19:27', '2023-10-10 06:19:27'),
(12, 1, 'logo-added', '0', '0', '5', 3, 'New logo is <span>Added !</span>', '2023-10-10 10:10:39', '2023-10-10 10:11:43'),
(13, 1, 'logo-approved', '0', '5', '5', 3, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-10 10:13:53', '2023-10-10 10:30:54'),
(14, 1, 'logo-approved', '0', '5', '5', 3, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-10 10:13:53', '2023-10-10 10:30:54'),
(15, 1, 'logo-approved', '0', '5', '5', 3, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-10 10:13:53', '2023-10-10 10:30:54'),
(16, 1, 'logo-approved', '0', '5', '5', 3, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-10 10:13:54', '2023-10-10 10:30:54'),
(17, 1, 'logo-approved', '0', '5', '5', 3, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-10 10:13:54', '2023-10-10 10:30:54'),
(18, 1, 'logo-approved', '0', '5', '5', 3, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-10 10:13:54', '2023-10-10 10:30:54'),
(19, 0, 'logo-approved', '0', '3', '3', 2, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-14 10:27:30', '2023-10-14 10:27:30'),
(20, 1, 'logo-added', '0', '0', '4', 4, 'New logo is <span>Added !</span>', '2023-10-14 10:29:39', '2023-10-16 06:47:59'),
(21, 0, 'logo-disapproved', '0', '5', '5', 3, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-14 10:50:25', '2023-10-14 10:50:25'),
(22, 0, 'logo-approved', '0', '5', '5', 3, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-14 10:50:38', '2023-10-14 10:50:38'),
(23, 0, 'logo-approved', '0', '4', '4', 4, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-14 10:55:59', '2023-10-14 10:55:59'),
(24, 0, 'logo-disapproved', '0', '4', '4', 4, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-14 10:56:21', '2023-10-14 10:56:21'),
(25, 0, 'designer-disapprove', '0', '3', '3', NULL, 'OOPS ! Your account has been <span>Disapproved !</span>', '2023-10-14 10:56:45', '2023-10-14 10:56:45'),
(26, 0, 'designer-approve', '0', '3', '3', NULL, 'Congratulations ! Your account has been <span>Approved !</span>', '2023-10-14 10:56:52', '2023-10-14 10:56:52'),
(27, 1, 'logo-added', '0', '0', '4', 5, 'New logo is <span>Added !</span>', '2023-10-14 11:03:19', '2023-10-16 06:48:02'),
(28, 0, 'logo-approved', '0', '4', '4', 5, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-14 11:05:18', '2023-10-14 11:05:18'),
(29, 1, 'logo-added', '0', '0', '2', 6, 'New logo is <span>Added !</span>', '2023-10-21 08:39:20', '2023-10-21 08:42:40'),
(30, 1, 'logo-approved', '0', '2', '2', 6, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-21 08:42:51', '2023-10-26 15:46:13'),
(31, 1, 'logo-added', '0', '0', '2', 7, 'New logo is <span>Added !</span>', '2023-10-21 08:49:32', '2023-10-26 15:48:25'),
(32, 1, 'logo-added', '0', '0', '2', 8, 'New logo is <span>Added !</span>', '2023-10-21 08:50:15', '2023-10-26 15:48:25'),
(33, 1, 'logo-added', '0', '0', '2', 9, 'New logo is <span>Added !</span>', '2023-10-21 08:51:05', '2023-10-26 15:48:25'),
(34, 1, 'logo-approved', '0', '2', '2', 7, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-21 08:51:46', '2023-10-26 15:46:13'),
(35, 1, 'logo-approved', '0', '2', '2', 8, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-21 08:51:54', '2023-10-26 15:46:13'),
(36, 1, 'logo-approved', '0', '2', '2', 9, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-21 08:52:01', '2023-10-26 15:46:13'),
(37, 1, 'logo-added', '0', '0', '2', 10, 'New logo is <span>Added !</span>', '2023-10-23 16:37:32', '2023-10-26 15:48:25'),
(38, 1, 'logo-approved', '0', '2', '2', 10, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-23 16:52:08', '2023-10-26 15:46:13'),
(39, 1, 'logo-added', '0', '0', '2', 11, 'New logo is <span>Added !</span>', '2023-10-24 13:55:35', '2023-10-26 15:48:25'),
(40, 1, 'logo-approved', '0', '2', '2', 11, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-24 13:56:20', '2023-10-26 15:46:13'),
(41, 1, 'logo-added', '0', '0', '2', 12, 'New logo is <span>Added !</span>', '2023-10-24 13:58:08', '2023-10-26 15:48:25'),
(42, 1, 'logo-approved', '0', '2', '2', 12, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-24 13:58:25', '2023-10-26 15:46:13'),
(43, 1, 'logo-disapproved', '0', '2', '2', 6, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-24 13:58:47', '2023-10-26 15:46:13'),
(44, 1, 'logo-disapproved', '0', '2', '2', 7, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-24 13:59:06', '2023-10-26 15:46:13'),
(45, 1, 'logo-disapproved', '0', '2', '2', 8, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-24 13:59:26', '2023-10-26 15:46:13'),
(46, 1, 'logo-disapproved', '0', '2', '2', 9, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-24 13:59:43', '2023-10-26 15:46:13'),
(47, 1, 'logo-disapproved', '0', '2', '2', 10, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-24 14:00:01', '2023-10-26 15:46:13'),
(48, 1, 'logo-added', '0', '0', '2', 13, 'New logo is <span>Added !</span>', '2023-10-24 14:00:51', '2023-10-26 15:48:25'),
(49, 1, 'logo-added', '0', '0', '2', 14, 'New logo is <span>Added !</span>', '2023-10-24 14:01:30', '2023-10-26 15:48:25'),
(50, 1, 'logo-approved', '0', '2', '2', 13, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-24 14:01:48', '2023-10-26 15:46:13'),
(51, 1, 'logo-approved', '0', '2', '2', 14, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-24 14:01:58', '2023-10-26 15:46:13'),
(52, 1, 'logo-disapproved', '0', '2', '2', 13, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-26 15:44:48', '2023-10-26 15:46:13'),
(53, 1, 'logo-added', '0', '0', '2', 1, 'New logo is <span>Added !</span>', '2023-10-31 12:50:11', '2023-10-31 12:57:38'),
(54, 1, 'logo-added', '0', '0', '2', 2, 'New logo is <span>Added !</span>', '2023-10-31 12:53:36', '2023-10-31 12:57:41'),
(55, 1, 'logo-added', '0', '0', '2', 3, 'New logo is <span>Added !</span>', '2023-10-31 12:56:04', '2023-10-31 12:57:44'),
(56, 0, 'logo-approved', '0', '2', '2', 1, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-31 12:56:40', '2023-10-31 12:56:40'),
(57, 0, 'logo-approved', '0', '2', '2', 2, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-31 12:57:16', '2023-10-31 12:57:16'),
(58, 0, 'logo-approved', '0', '2', '2', 3, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-31 12:57:33', '2023-10-31 12:57:33'),
(59, 1, 'logo-added', '0', '0', '2', 4, 'New logo is <span>Added !</span>', '2023-10-31 12:58:17', '2023-10-31 13:37:35'),
(60, 1, 'logo-added', '0', '0', '2', 5, 'New logo is <span>Added !</span>', '2023-10-31 12:59:33', '2023-10-31 13:37:35'),
(61, 1, 'logo-added', '0', '0', '2', 6, 'New logo is <span>Added !</span>', '2023-10-31 13:01:09', '2023-10-31 13:37:35'),
(62, 1, 'logo-added', '0', '0', '2', 7, 'New logo is <span>Added !</span>', '2023-10-31 13:02:37', '2023-10-31 13:37:35'),
(63, 1, 'logo-added', '0', '0', '2', 8, 'New logo is <span>Added !</span>', '2023-10-31 13:04:20', '2023-10-31 13:37:35'),
(64, 1, 'logo-added', '0', '0', '2', 9, 'New logo is <span>Added !</span>', '2023-10-31 13:05:36', '2023-10-31 13:37:35'),
(65, 1, 'logo-added', '0', '0', '2', 10, 'New logo is <span>Added !</span>', '2023-10-31 13:06:57', '2023-10-31 13:37:35'),
(66, 1, 'logo-added', '0', '0', '2', 11, 'New logo is <span>Added !</span>', '2023-10-31 13:08:11', '2023-10-31 13:37:35'),
(67, 1, 'logo-added', '0', '0', '2', 12, 'New logo is <span>Added !</span>', '2023-10-31 13:09:21', '2023-10-31 13:37:35'),
(68, 1, 'logo-added', '0', '0', '2', 13, 'New logo is <span>Added !</span>', '2023-10-31 13:10:37', '2023-10-31 13:37:35'),
(69, 1, 'logo-added', '0', '0', '2', 14, 'New logo is <span>Added !</span>', '2023-10-31 13:11:39', '2023-10-31 13:37:35'),
(70, 1, 'logo-added', '0', '0', '2', 15, 'New logo is <span>Added !</span>', '2023-10-31 13:13:41', '2023-10-31 13:37:35'),
(71, 1, 'logo-added', '0', '0', '2', 16, 'New logo is <span>Added !</span>', '2023-10-31 13:14:54', '2023-10-31 13:37:35'),
(72, 1, 'logo-added', '0', '0', '2', 17, 'New logo is <span>Added !</span>', '2023-10-31 13:16:26', '2023-10-31 13:37:35'),
(73, 1, 'logo-added', '0', '0', '2', 18, 'New logo is <span>Added !</span>', '2023-10-31 13:17:54', '2023-10-31 13:37:35'),
(74, 1, 'logo-added', '0', '0', '2', 19, 'New logo is <span>Added !</span>', '2023-10-31 13:18:55', '2023-10-31 13:37:35'),
(75, 1, 'logo-added', '0', '0', '2', 20, 'New logo is <span>Added !</span>', '2023-10-31 13:20:01', '2023-10-31 13:37:35'),
(76, 0, 'logo-approved', '0', '2', '2', 4, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-31 13:21:58', '2023-10-31 13:21:58'),
(77, 0, 'logo-approved', '0', '2', '2', 5, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-31 13:25:15', '2023-10-31 13:25:15'),
(78, 0, 'logo-approved', '0', '2', '2', 6, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-31 13:25:29', '2023-10-31 13:25:29'),
(79, 0, 'logo-approved', '0', '2', '2', 7, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-31 13:25:43', '2023-10-31 13:25:43'),
(80, 0, 'logo-approved', '0', '2', '2', 8, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-31 13:25:56', '2023-10-31 13:25:56'),
(81, 0, 'logo-approved', '0', '2', '2', 9, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-31 13:26:08', '2023-10-31 13:26:08'),
(82, 0, 'logo-approved', '0', '2', '2', 10, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-31 13:26:20', '2023-10-31 13:26:20'),
(83, 0, 'designer-aproved-for-logo', '0', '3', '3', 1, 'Congratulations ! Your assigne for a <span>Logo Revision </span> task.', '2023-10-31 13:26:26', '2023-10-31 13:26:26'),
(84, 0, 'logo-approved', '0', '2', '2', 12, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-31 13:26:31', '2023-10-31 13:26:31'),
(85, 0, 'logo-approved', '0', '2', '2', 15, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-31 13:26:42', '2023-10-31 13:26:42'),
(86, 0, 'logo-approved', '0', '2', '2', 14, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-31 13:26:53', '2023-10-31 13:26:53'),
(87, 0, 'logo-approved', '0', '2', '2', 17, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-31 13:27:03', '2023-10-31 13:27:03'),
(88, 0, 'logo-approved', '0', '2', '2', 18, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-31 13:27:14', '2023-10-31 13:27:14'),
(89, 0, 'logo-approved', '0', '2', '2', 16, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-31 13:27:25', '2023-10-31 13:27:25'),
(90, 0, 'logo-approved', '0', '2', '2', 20, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-31 13:27:36', '2023-10-31 13:27:36'),
(91, 0, 'logo-approved', '0', '2', '2', 19, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-31 13:27:48', '2023-10-31 13:27:48'),
(92, 0, 'logo-approved', '0', '2', '2', 13, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-31 13:28:01', '2023-10-31 13:28:01'),
(93, 0, 'logo-approved', '0', '2', '2', 11, 'Congratulations ! Your logo is <span>Approved !</span>', '2023-10-31 13:28:15', '2023-10-31 13:28:15'),
(94, 0, 'designer-aproved-for-logo', '0', '5', '5', 1, 'Congratulations ! Your assigne for a <span>Logo Revision </span> task.', '2023-10-31 13:29:54', '2023-10-31 13:29:54'),
(95, 0, 'designer-aproved-for-logo', '0', '5', '5', 1, 'Congratulations ! Your assigne for a <span>Logo Revision </span> task.', '2023-11-01 07:41:36', '2023-11-01 07:41:36'),
(96, 0, 'designer-aproved-for-logo', '0', '3', '3', 1, 'You have new task for <span>logo revision </span>.', '2023-11-01 08:58:54', '2023-11-01 08:58:54'),
(97, 0, 'designer-aproved-for-logo', '0', '6', '6', 1, 'You have new task for <span>logo revision </span>.', '2023-11-01 10:05:04', '2023-11-01 10:05:04'),
(98, 1, 'designer-registered', '0', '0', '12', NULL, 'New host is <span>Registered</span>', '2023-11-08 05:41:09', '2023-11-20 11:17:32'),
(99, 0, 'designer-registered', '0', '0', '19', NULL, 'New host is <span>Registered</span>', '2023-11-21 12:36:40', '2023-11-21 12:36:40'),
(100, 0, 'designer-registered', '0', '0', '20', NULL, 'New host is <span>Registered</span>', '2023-11-21 12:47:57', '2023-11-21 12:47:57'),
(101, 1, 'designer-approve', '0', '20', '20', NULL, 'Congratulations ! Your account has been <span>Approved !</span>', '2023-11-21 12:48:51', '2023-11-21 12:49:02'),
(102, 0, 'logo-added', '0', '0', '20', 21, 'New logo is <span>Added !</span>', '2023-11-22 13:09:21', '2023-11-22 13:09:21'),
(103, 0, 'designer-aproved-for-logo', '0', '3', '3', 8, 'Congratulations ! Your assigne for a <span>Logo Revision </span> task.', '2023-11-24 08:55:41', '2023-11-24 08:55:41'),
(104, 0, 'designer-aproved-for-logo', '0', '3', '3', 8, 'You have new task for <span>logo revision </span>.', '2023-11-24 09:56:04', '2023-11-24 09:56:04'),
(105, 0, 'designer-aproved-for-logo', '0', '5', '5', 8, 'You have new task for <span>logo revision </span>.', '2023-11-24 10:57:04', '2023-11-24 10:57:04'),
(106, 0, 'designer-aproved-for-logo', '0', '6', '6', 8, 'You have new task for <span>logo revision </span>.', '2023-11-24 11:58:04', '2023-11-24 11:58:04');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_num` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `logo_id` varchar(255) NOT NULL,
  `price` double(8,2) NOT NULL,
  `taxes` varchar(255) DEFAULT NULL,
  `tax_percent` double(8,2) DEFAULT NULL,
  `discount_coupon_code` varchar(255) DEFAULT NULL,
  `discount_amount` varchar(255) DEFAULT NULL,
  `logo_for_future_status` int(11) NOT NULL DEFAULT 0,
  `logo_for_future_price` varchar(255) DEFAULT NULL,
  `get_favicon_status` int(11) NOT NULL DEFAULT 0,
  `get_favicon_price` varchar(255) DEFAULT NULL,
  `total_payment_amount` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `on_revision` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `order_num`, `user_id`, `logo_id`, `price`, `taxes`, `tax_percent`, `discount_coupon_code`, `discount_amount`, `logo_for_future_status`, `logo_for_future_price`, `get_favicon_status`, `get_favicon_price`, `total_payment_amount`, `status`, `on_revision`, `created_at`, `updated_at`) VALUES
(1, 'iGgkJMo', '4', '1', 199.00, '41.94', 18.00, NULL, NULL, 1, '5', 1, '29', '274.94', 1, 1, '2023-10-31 13:04:33', '2023-10-31 13:28:09'),
(2, 'FqwY0Rz', '8', '2', 199.00, '41.94', 18.00, NULL, NULL, 1, '5', 1, '29', '274.94', 1, 0, '2023-11-03 14:12:34', '2023-11-03 14:12:34'),
(3, 'vDgCYxT', '13', '3', 199.00, '41.94', 18.00, NULL, NULL, 1, '5', 1, '29', '274.94', 1, 0, '2023-11-10 07:02:41', '2023-11-10 07:02:41'),
(4, '3Xt8JIW', '21', '5', 199.00, '35.82', 18.00, NULL, NULL, 0, NULL, 0, NULL, '234.82', 1, 0, '2023-11-22 13:06:28', '2023-11-22 13:06:28'),
(5, 'Ke6U7rd', '4', '4', 199.00, '35.82', 18.00, NULL, NULL, 0, NULL, 0, NULL, '234.82', 1, 0, '2023-11-24 08:13:19', '2023-11-24 08:13:19'),
(6, 'mnYqJZs', '4', '8', 199.00, '35.82', 18.00, NULL, NULL, 0, NULL, 0, NULL, '234.82', 1, 1, '2023-11-24 08:38:46', '2023-11-24 08:45:06'),
(7, 'EXoCrD0', '4', '6', 199.00, '35.82', 18.00, NULL, NULL, 0, NULL, 0, NULL, '234.82', 1, 0, '2023-11-24 10:11:09', '2023-11-24 10:11:09');

-- --------------------------------------------------------

--
-- Table structure for table `order_meta`
--

CREATE TABLE `order_meta` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `user_first_name` varchar(255) NOT NULL,
  `user_last_name` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `name_on_card` varchar(255) NOT NULL,
  `street_num` varchar(255) NOT NULL,
  `additional_address` varchar(255) NOT NULL,
  `organization` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `taxid` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_meta`
--

INSERT INTO `order_meta` (`id`, `order_id`, `user_first_name`, `user_last_name`, `user_email`, `name_on_card`, `street_num`, `additional_address`, `organization`, `city`, `state`, `zip`, `country`, `taxid`, `created_at`, `updated_at`) VALUES
(1, 1, 'Client', '1', 'client1@gmail.com', 'Client 1', '#123 street', '', '', 'New York', 'New York', '12345', 'US', NULL, '2023-10-31 13:04:33', '2023-10-31 13:04:33'),
(2, 2, 'Test', 'test', 'test@123.com', 'Test', '#123 Street', '', '', 'washington', 'New York', '35211', 'US', NULL, '2023-11-03 14:12:34', '2023-11-03 14:12:34'),
(3, 3, 'Agam', 'Tanwar', 'agam@gmail.com', 'Agam Tanwar', '#123 Street', '', '', 'washington', 'New York', '35211', 'US', NULL, '2023-11-10 07:02:41', '2023-11-10 07:02:41'),
(4, 4, 'Agam', 'Tanwar', 'agam@karma.com', 'Agam', '#343 Sector 55D', '', '', 'Mohali', 'Chandigarh', '135616', 'US', NULL, '2023-11-22 13:06:28', '2023-11-22 13:06:28'),
(5, 5, 'user', 'Host', 'client1@gmail.com', 'test', '#123 street', '#123 street1223', 'testing', 'washington', 'New York', '35211', 'US', NULL, '2023-11-24 08:13:19', '2023-11-24 08:13:19'),
(6, 6, 'test', 'test', 'client1@gmail.com', 'test', '#123 street1223', '#123 street1223', 'testing', 'barmingim', 'Florida', '35211', 'US', '143242342342342', '2023-11-24 08:38:46', '2023-11-24 08:38:46'),
(7, 7, 'user', 'test', 'client1@gmail.com', 'test', 'mohali,india', '#123 street1223', 'test', 'Naples', 'Florida', '35211', 'US', '143242342342342', '2023-11-24 10:11:09', '2023-11-24 10:11:09');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `payment_type` varchar(255) DEFAULT NULL,
  `payment_gateway` varchar(255) NOT NULL,
  `stripe_payment_intent` varchar(255) DEFAULT NULL,
  `stripe_payment_method` varchar(255) DEFAULT NULL,
  `currency` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `payment_type`, `payment_gateway`, `stripe_payment_intent`, `stripe_payment_method`, `currency`, `total_amount`, `status`, `created_at`, `updated_at`) VALUES
(1, '1', 'logo_purchase', 'stripe', 'pi_3O7HcSSDpE15tSXh1vtkP6Np', 'pm_1O7HcPSDpE15tSXh5QYdBZWP', 'usd', '274.94', 'succeeded', '2023-10-31 13:04:33', '2023-10-31 13:04:33'),
(2, '2', 'logo_purchase', 'stripe', 'pi_3O8O6vSDpE15tSXh12MdKbSv', 'pm_1O8O6sSDpE15tSXhUdR4bcL7', 'usd', '274.94', 'succeeded', '2023-11-03 14:12:34', '2023-11-03 14:12:34'),
(3, '3', 'logo_purchase', 'stripe', 'pi_3OAojjSDpE15tSXh1ktkUnMh', 'pm_1OAojhSDpE15tSXhIEnsbZLz', 'usd', '274.94', 'succeeded', '2023-11-10 07:02:41', '2023-11-10 07:02:41'),
(4, '4', 'logo_purchase', 'stripe', 'pi_3OFG8NSDpE15tSXh1W0AcMrY', 'pm_1OFG8KSDpE15tSXhCzFMYkTD', 'usd', '234.82', 'succeeded', '2023-11-22 13:06:28', '2023-11-22 13:06:28'),
(5, '5', 'logo_purchase', 'stripe', 'pi_3OFuVmSDpE15tSXh1hkq7gEH', 'pm_1OFuViSDpE15tSXh2mOBsKIu', 'usd', '234.82', 'succeeded', '2023-11-24 08:13:19', '2023-11-24 08:13:19'),
(6, '6', 'logo_purchase', 'stripe', 'pi_3OFuuOSDpE15tSXh0tKSlYPo', 'pm_1OFuuLSDpE15tSXhGyw6Xten', 'usd', '234.82', 'succeeded', '2023-11-24 08:38:46', '2023-11-24 08:38:46'),
(7, '7', 'logo_purchase', 'stripe', 'pi_3OFwLoSDpE15tSXh1BL6Yvfh', 'pm_1OFwLlSDpE15tSXhM2OGfOwv', 'usd', '234.82', 'succeeded', '2023-11-24 10:11:09', '2023-11-24 10:11:09');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register_contents`
--

CREATE TABLE `register_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `register_contents`
--

INSERT INTO `register_contents` (`id`, `name`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES
(1, 'meta title', 'meta-title', 'test', 'textarea', NULL, NULL),
(2, 'meta description', 'meta-description', '', 'textarea', NULL, NULL),
(3, 'meta language', 'meta-language', 'test', 'textarea', NULL, NULL),
(4, 'meta country', 'meta-country', '', 'textarea', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews_content`
--

CREATE TABLE `reviews_content` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review_contents`
--

CREATE TABLE `review_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `review_contents`
--

INSERT INTO `review_contents` (`id`, `name`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES
(1, 'meta title', 'meta-title', 'test', 'textarea', NULL, NULL),
(2, 'meta description', 'meta-description', '', 'textarea', NULL, NULL),
(3, 'meta language', 'meta-language', 'test', 'textarea', NULL, NULL),
(4, 'meta country', 'meta-country', '', 'textarea', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `shop_contents`
--

CREATE TABLE `shop_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` longtext NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shop_contents`
--

INSERT INTO `shop_contents` (`id`, `name`, `key`, `value`, `type`, `created_at`, `updated_at`) VALUES
(1, 'meta title', 'meta-title', 'test', 'textarea', NULL, NULL),
(2, 'meta description', 'meta-description', '', 'textarea', NULL, NULL),
(3, 'meta language', 'meta-language', 'test', 'textarea', NULL, NULL),
(4, 'meta country', 'meta-country', '', 'textarea', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `site_metas`
--

CREATE TABLE `site_metas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meta_name` varchar(255) NOT NULL,
  `meta_key` varchar(255) NOT NULL,
  `meta_value` varchar(255) NOT NULL,
  `meta_type` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `site_metas`
--

INSERT INTO `site_metas` (`id`, `meta_name`, `meta_key`, `meta_value`, `meta_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Home Banner', 'home-banner', 'Home_Banner_1700760317.png', 'image', 1, NULL, '2023-11-23 17:25:17'),
(2, 'Home Page Site Logo', 'home-page-site-logo', 'Home_Page_Site_Logo_1700723995.svg', 'image', 1, NULL, '2023-11-23 07:19:55'),
(3, 'Other pages Site Logo', 'other-pages-site-logo', 'Other_pages_Site_Logo_1700724005.svg', 'image', 1, NULL, '2023-11-23 07:20:05'),
(4, 'Footer Logo', 'footer-logo', 'Footer_Logo_1700721727.svg', 'image', 1, NULL, '2023-11-23 06:42:07'),
(5, 'Thousands of Unique, Exclusive Logo Designs from Diverse Talents', 'thousands-of-unique,-exclusive-logo-designs-from-diverse-talents', 'Thousands of Unique, Exclusive Logo Designs from Diverse Talents', 'textarea', 1, '2023-11-17 13:57:10', '2023-11-17 13:57:10');

-- --------------------------------------------------------

--
-- Table structure for table `special_designer_tasks`
--

CREATE TABLE `special_designer_tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `logo_revision_id` varchar(255) NOT NULL,
  `logo_id` varchar(255) NOT NULL,
  `client_id` varchar(255) NOT NULL,
  `assigned_designer_id` varchar(255) NOT NULL,
  `backup_designer_id` varchar(255) DEFAULT NULL,
  `task_duration` int(11) NOT NULL DEFAULT 60 COMMENT 'duration in minutes',
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `special_designer_tasks`
--

INSERT INTO `special_designer_tasks` (`id`, `logo_revision_id`, `logo_id`, `client_id`, `assigned_designer_id`, `backup_designer_id`, `task_duration`, `status`, `created_at`, `updated_at`) VALUES
(3, '2', '1', '4', '5', 'a:2:{i:0;s:1:\"3\";i:1;s:1:\"6\";}', 60, 4, '2023-11-01 07:41:33', '2023-11-01 08:58:52'),
(4, '2', '1', '4', '3', 'a:1:{i:0;s:1:\"6\";}', 60, 4, '2023-11-01 08:58:52', '2023-11-01 10:05:02'),
(5, '2', '1', '4', '6', 'a:0:{}', 60, 5, '2023-11-01 10:05:02', '2023-11-01 11:05:03'),
(6, '3', '8', '4', '3', 'a:3:{i:0;s:1:\"3\";i:1;s:1:\"5\";i:2;s:1:\"6\";}', 60, 4, '2023-11-24 08:55:37', '2023-11-24 09:56:02'),
(7, '3', '8', '4', '3', 'a:2:{i:0;s:1:\"5\";i:1;s:1:\"6\";}', 60, 4, '2023-11-24 09:56:02', '2023-11-24 10:57:02'),
(8, '3', '8', '4', '5', 'a:1:{i:0;s:1:\"6\";}', 60, 4, '2023-11-24 10:57:02', '2023-11-24 11:58:02'),
(9, '3', '8', '4', '6', 'a:0:{}', 60, 0, '2023-11-24 11:58:02', '2023-11-24 11:58:02');

-- --------------------------------------------------------

--
-- Table structure for table `styles`
--

CREATE TABLE `styles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `styles`
--

INSERT INTO `styles` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Houses & Buildings', 'houses-buildings', 1, '2023-10-09 06:08:43', '2023-11-17 11:36:53'),
(2, 'Cars & Vehicles', 'cars-vehicles', 1, '2023-10-09 06:08:49', '2023-11-17 11:37:05'),
(3, 'Animals', 'animals', 1, '2023-10-09 06:08:56', '2023-11-17 11:37:17'),
(4, 'Nature Elements', 'nature-elements', 1, '2023-10-09 06:09:03', '2023-11-17 11:37:30'),
(5, 'Technological Gadgets', 'technological-gadgets', 1, '2023-10-14 10:59:03', '2023-11-17 11:37:40'),
(6, 'Food & Drink', 'food-drink', 1, '2023-11-17 11:37:56', '2023-11-17 11:37:56'),
(7, 'Musical Instruments', 'musical-instruments', 1, '2023-11-17 11:38:06', '2023-11-17 11:38:06'),
(8, 'Sports Equipment', 'sports-equipment', 1, '2023-11-17 11:38:15', '2023-11-17 11:38:15'),
(9, 'Nautical & Marine', 'nautical-marine', 1, '2023-11-17 11:38:29', '2023-11-17 11:38:29'),
(10, 'Astronomical Objects', 'astronomical-objects', 1, '2023-11-17 11:38:42', '2023-11-17 11:38:42'),
(11, 'Cultural Symbols', 'cultural-symbols', 1, '2023-11-17 11:38:59', '2023-11-17 11:38:59'),
(12, 'Abstract Shapes', 'abstract-shapes', 1, '2023-11-17 11:39:12', '2023-11-17 11:39:12'),
(13, 'Human Figures & Silhouetes', 'human-figures-silhouetes', 1, '2023-11-17 11:39:24', '2023-11-17 11:39:24'),
(14, 'Oﬃce & Business', 'oﬃce-business', 1, '2023-11-17 11:39:32', '2023-11-17 11:39:32'),
(15, 'Travel & Landmarks', 'travel-landmarks', 1, '2023-11-17 11:39:43', '2023-11-17 11:39:43'),
(16, 'Health & Wellness', 'health-wellness', 1, '2023-11-17 11:39:51', '2023-11-17 11:39:51'),
(17, 'Fashion & Beauty', 'fashion-beauty', 1, '2023-11-17 11:40:00', '2023-11-17 11:40:00'),
(18, 'Art & Design', 'art-design', 1, '2023-11-17 11:40:08', '2023-11-17 11:40:08'),
(19, 'Education & Academia', 'education-academia', 1, '2023-11-17 11:40:20', '2023-11-17 11:40:20'),
(20, 'Legal & Law Enforcement', 'legal-law-enforcement', 1, '2023-11-17 11:40:29', '2023-11-17 11:40:29'),
(21, 'Construction & Tools', 'construction-tools', 1, '2023-11-17 11:40:42', '2023-11-17 11:40:42'),
(22, 'Environment & Sustainability', 'environment-sustainability', 1, '2023-11-17 11:40:51', '2023-11-17 11:40:51'),
(23, 'Media & Entertainment', 'media-entertainment', 1, '2023-11-17 11:41:03', '2023-11-17 11:41:03'),
(24, 'Financial & Economic', 'financial-economic', 1, '2023-11-17 11:41:12', '2023-11-17 11:41:12'),
(25, 'Communication & Social Media', 'communication-social-media', 1, '2023-11-17 11:41:25', '2023-11-17 11:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `support_content`
--

CREATE TABLE `support_content` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `support_contents`
--

CREATE TABLE `support_contents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `meta_name` varchar(255) NOT NULL,
  `meta_key` varchar(255) NOT NULL,
  `meta_value` text DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `support_contents`
--

INSERT INTO `support_contents` (`id`, `meta_name`, `meta_key`, `meta_value`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Support Text', 'support_text', '<p>Welcome to Logomax, where exclusivity meets design. In a digital world brimming with repetive and overused logos, we stand out by offering a unique proposition - exclusive, once-in-a-lifetime logos. Established 2012, Logomax has been dedicated to creating and curating a diverse range of logo designs, each sold only once. At Logomax, we understand that a logo is more than just a graphic; it\'s the face of your brand, a visual story waiting to be told. Our platform brings together skilled designers from across the globe, each contributing to our eclectic mix of styles. Whether you\'re a budding startup or a seasoned enterprise, our collection has something for every brand personality.</p>', 'textarea', NULL, '2023-11-20 13:32:45'),
(2, 'meta title', 'meta-title', 'test', 'textarea', NULL, NULL),
(3, 'meta description', 'meta-description', NULL, 'textarea', NULL, '2023-11-20 13:29:47'),
(4, 'meta language', 'meta-language', 'test', 'textarea', NULL, NULL),
(5, 'meta country', 'meta-country', NULL, 'textarea', NULL, '2023-11-20 13:29:47');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`, `slug`, `status`, `created_at`, `updated_at`) VALUES
(12, 'Agriculture', 'agriculture', 1, '2023-10-21 06:06:44', '2023-10-21 06:06:44'),
(13, 'Airline', 'airline', 1, '2023-10-21 06:07:04', '2023-10-21 06:07:04'),
(14, 'Animals', 'animals', 1, '2023-10-21 06:09:42', '2023-10-21 06:09:42'),
(15, 'App', 'app', 1, '2023-10-21 06:10:04', '2023-10-21 06:10:04'),
(16, 'Bakery', 'bakery', 1, '2023-10-21 06:11:07', '2023-10-21 06:11:07'),
(17, 'Barber shop', 'barber-shop', 1, '2023-10-21 06:11:32', '2023-10-21 06:11:32'),
(18, 'Beauty', 'beauty', 1, '2023-10-21 06:11:47', '2023-10-21 06:11:47'),
(19, 'Solar Energy', 'solar-energy', 1, '2023-10-21 06:11:56', '2023-10-21 06:11:56'),
(20, 'Interior design', 'interior-design', 1, '2023-10-21 06:12:10', '2023-10-21 06:12:10'),
(21, 'Logistics', 'logistics', 1, '2023-10-21 06:12:24', '2023-10-21 06:12:24'),
(22, 'Makeup', 'makeup', 1, '2023-10-21 06:12:51', '2023-10-21 06:12:51'),
(23, 'Marketing', 'marketing', 1, '2023-10-21 06:13:20', '2023-10-21 06:13:20'),
(24, 'Travel', 'travel', 1, '2023-10-21 06:13:32', '2023-10-21 06:13:32'),
(25, 'Dental', 'dental', 1, '2023-10-21 06:13:47', '2023-10-21 06:13:47'),
(26, 'Education', 'education', 1, '2023-10-21 06:13:59', '2023-10-21 06:13:59'),
(27, 'Lawn care', 'lawn-care', 1, '2023-10-21 06:14:26', '2023-10-21 06:14:26'),
(28, 'Trendy logo', 'trendy-logo', 1, '2023-10-21 06:14:45', '2023-10-21 06:14:45'),
(29, 'Wedding', 'wedding', 1, '2023-10-21 06:15:01', '2023-10-21 06:15:01'),
(30, 'Insurance', 'insurance', 1, '2023-10-21 06:15:13', '2023-10-21 06:15:13'),
(31, 'Digital', 'digital', 1, '2023-10-21 06:15:24', '2023-10-21 06:15:24'),
(32, 'app solution', 'app-solution', 1, '2023-10-31 12:33:55', '2023-10-31 12:33:55'),
(33, 'hotel', 'hotel', 1, '2023-10-31 12:52:49', '2023-10-31 12:52:49'),
(34, 'food', 'food', 1, '2023-10-31 12:55:07', '2023-10-31 12:55:07'),
(35, 'tech', 'tech', 1, '2023-10-31 12:59:03', '2023-10-31 12:59:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified` int(11) NOT NULL DEFAULT 0,
  `is_approved` int(11) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `experience` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `organization` varchar(255) DEFAULT NULL,
  `additional_address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `zip_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) DEFAULT NULL,
  `google_id` varchar(255) DEFAULT NULL,
  `facebook_id` varchar(255) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `first_name`, `last_name`, `email`, `email_verified`, `is_approved`, `password`, `experience`, `address`, `organization`, `additional_address`, `city`, `state`, `zip_code`, `country`, `google_id`, `facebook_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 3, 'admin', NULL, 'developeritexpert9@gmail.com', 0, 0, '$2y$10$pRpw9xtewCmjQzkRQmL7wuKHdV41KMjWAY6oJQA5ek4cN6nr5zJny', '2', '#123 Street', NULL, NULL, NULL, NULL, NULL, 'United States', NULL, NULL, 1, 'K797rRchRZZGDB2hFksHqt0IXzCb6HSoOC363zDU9jNKyLbdKGozKXUOtQTJ', '2023-10-16 09:00:08', '2023-10-16 09:00:08'),
(2, 2, 'Designer', NULL, 'abhishek1@sagmetic.com', 0, 1, '$2y$10$1UQQnzfiwz4LIRvPR/lf3.T134bEvBEucnGeinoY2tVoX1Jp5cH7a', '2', '#123 Street', NULL, NULL, NULL, NULL, NULL, 'United States', NULL, NULL, 1, 'm5rL4ujEZ5A2A8PNLdQZHPDfIXQSda7NnaibjXJnFpZVVBkGspUMA9ZihaTq', '2023-10-16 09:01:56', '2023-10-16 09:01:56'),
(3, 4, 'XAVIER', NULL, 'jx.tenoriog@gmail.com', 1, 1, '$2y$10$w3ZLX1zu0LVCRLn/C.q7cuDec/q/sJKbLwwttSWLl7nZ5urkcLAwm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-10-23 17:17:39', '2023-10-23 17:17:39'),
(4, 1, 'client 1', NULL, 'client1@gmail.com', 0, 0, '$2y$10$xKy/Sf.mU/VUzf22imKtdOAMj5vIITIGqkzwXnDaaD2YvF3WUqbLS', NULL, 'mohali,india', 'test', NULL, 'Naples', 'Florida', '35211', 'US', NULL, NULL, 0, NULL, '2023-10-31 13:00:03', '2023-11-24 10:11:09'),
(5, 4, 'Johnson', NULL, 'johnson@gmail.com', 1, 1, '$2y$10$w3ZLX1zu0LVCRLn/C.q7cuDec/q/sJKbLwwttSWLl7nZ5urkcLAwm', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-10-31 13:26:57', '2023-10-31 13:26:57'),
(6, 4, 'Johny Wick', NULL, 'johny@gmail.com', 1, 1, '$2y$10$pRpw9xtewCmjQzkRQmL7wuKHdV41KMjWAY6oJQA5ek4cN6nr5zJny', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1, NULL, '2023-10-31 13:27:18', '2023-10-31 13:27:18'),
(7, 1, 'd as', NULL, 'agamthakur991@gmail.com', 0, 0, '$2y$10$hqTFNwwkZG87rAKpcMQH6u18g7OGp7AXChykr0xohOOuUXCr15LBy', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2023-11-03 06:56:49', '2023-11-03 06:56:49'),
(8, 1, 'Test test', NULL, 'test@123.com', 0, 0, '$2y$10$lQpBtxP1RNx6.NJ1Nvrz5.TeQvs4lLJU1V.PI1fnMSR.qw5ghdyEK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2023-11-03 14:12:32', '2023-11-03 14:12:32'),
(9, 2, 'Agam', NULL, 'agamthakur96@gmail.com', 0, 0, '$2y$10$QBAbzSlXFpaZp9e8M5BUDOqSnKG3H1JfdJOjDZBhIPjETZ.Laj1HS', 'oP', '#343 Sector 55D', NULL, NULL, NULL, NULL, NULL, 'India', NULL, NULL, 1, 'WU0nupav8b37ZpMAGAXmp1n5p8nihJohmJpqwVPKbHA2YpfRMTuSKpi8zboW', '2023-11-06 07:25:40', '2023-11-06 07:25:40'),
(10, 2, 'Test', NULL, 'developer.ashar1@gmail.com', 0, 0, '$2y$10$rGMYXxCApXi9QurYXtKPru.MrkUQUjvDjxObOWCPhI4Do2IIkHW2q', '2', '#123 Street', NULL, NULL, NULL, NULL, NULL, 'United States', NULL, NULL, 1, 'MlAi6suMvi35oEw68fjvcV6dvoO7Do9vlO7GRUe6paTft7cAeAuwOq04jt3hwYG7', '2023-11-06 07:40:07', '2023-11-06 07:40:07'),
(11, 2, 'agam-223', NULL, 'shiivvii991@gmail.com', 0, 0, '$2y$10$On7uS1VoU8nXVGSlyGapou2/6ULH/imBp7C5fBHhVXBv9dQ4Fdrh6', '2', '#123 Street', NULL, NULL, NULL, NULL, NULL, 'United States', NULL, NULL, 1, 'lf1bEyCAxl0nHY3JVbQEDo61WjC5Ovq0ulKmA6dmtz9RQKoJg4FFZfYCZyt1nrf2', '2023-11-06 07:49:18', '2023-11-06 07:49:18'),
(12, 2, 'Yashwant Chandel', NULL, 'pdeveloper261@gmail.com', 1, 1, '$2y$10$pRpw9xtewCmjQzkRQmL7wuKHdV41KMjWAY6oJQA5ek4cN6nr5zJny', '20', 'mohali,india', NULL, NULL, NULL, NULL, NULL, 'US', NULL, '122096379692066769', 1, 'DMLsSHldureepdTPTkG89wFDsAU32eToEJs7lokmwKCuDCsWi8CJEum8skAW', '2023-11-08 05:29:38', '2023-11-08 05:41:09'),
(13, 1, 'Agam Tanwar', NULL, 'agam@gmail.com', 0, 0, '$2y$10$UXCQ8k3FS7CxBzSgAjORNOLFxlADuDWxZqHX7XYNlUZZe2ipXTQIS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2023-11-10 07:02:39', '2023-11-10 07:02:39'),
(14, 2, 'test', 'test', 'pdeveloper2611@gmail.com', 0, 0, '$2y$10$/xPBoFyhb2Lre2f3oU5.iuEaaQcrZ/skjR5YspS4utIfi58/7iUn2', '12', 'test', NULL, NULL, 'teset', NULL, NULL, 'AF', NULL, NULL, 1, 'hqOcg1PAXQ4dS42yAkNtmQlOi0wPsHGFDD7kGAPZwdLVY85BXiJuB15q0LAp', '2023-11-17 12:04:50', '2023-11-17 12:04:50'),
(15, 1, 'Agam', 'Tanwar', 'vivek@karma.com', 0, 0, '$2y$10$S6x00EgwGKZ9BLEDozTGIOBAUWSfN/AOhW5Lp4QZo4MmQx0jHbfAK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'IN', NULL, NULL, 1, 'JdnO0SKtcYVla01uOon1Z0xYXGrbONarZLd35hUBfE8qCgNJVgMc4qu2TIj4s4bD', '2023-11-20 12:10:51', '2023-11-20 12:10:51'),
(17, 2, 'agam', 'dev', 'agamthakur99@gmail.com', 0, 0, '$2y$10$o0M.J067ijVT.KW6qCusz.Dd.Ghi9w26GSmD4.eqlCubWmCbIFXjW', '2', '#123 Street', NULL, NULL, 'washington', NULL, NULL, 'IN', NULL, NULL, 1, 'WHQpzM6HwcVvI5Nt5wGnsrdfJJ5wurl6SJgVhqowLnLKkK9vFxBO6kzMvViQilcy', '2023-11-21 12:22:06', '2023-11-21 12:22:06'),
(18, 2, 'developer', 'design', 'developer.ashar@gmail.com', 0, 0, '$2y$10$k9Lcxhk3YGsbF76BlZpsqusfkEpHF7V6eO8MLpoMSExno5yjffwYe', '2', '#123 Street', NULL, NULL, 'washington', NULL, NULL, 'IN', NULL, NULL, 1, 'eS3LbXjsT1F2A8UQEfnTfjUyLixIKAXHloys1CAsLr6AS8eT78Ny8vlqevt1C7my', '2023-11-21 12:31:32', '2023-11-21 12:31:32'),
(20, 2, 'dev', 'designer', 'abhishek@sagmetic.com', 1, 1, '$2y$10$63poeKblkUJXSrVDr4DAsuZJA/PGVu.BzCBmwS97IFCLIpF5iLN4S', '2', '#123 Street', NULL, NULL, 'washington', NULL, NULL, 'IN', NULL, NULL, 1, 'dSCydDDDZUSDlxPd8qRFic31RSMoLTbyddKuJOAx9B4RJEesaRluhAkSwDOR', '2023-11-21 12:46:53', '2023-11-21 12:48:48'),
(21, 1, 'Agam', 'Tanwar', 'agam@karma.com', 0, 0, '$2y$10$sQtIxxmcJW/u/Rg.b2R.VuQHjzAvdgyzXCtyr0JRu32LAB4EyMlfa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, '2023-11-22 13:02:21', '2023-11-22 13:02:21');

-- --------------------------------------------------------

--
-- Table structure for table `user_billing_address`
--

CREATE TABLE `user_billing_address` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `address_1` varchar(255) NOT NULL,
  `address_2` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip_code` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role_id`, `role`, `created_at`, `updated_at`) VALUES
(1, 1, 'Simple user', NULL, NULL),
(2, 2, 'Designer', NULL, NULL),
(3, 3, 'Admin', NULL, NULL),
(4, 4, 'Special Designer', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `logo_id` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `logo_id`, `created_at`, `updated_at`) VALUES
(2, '4', '6', '2023-11-16 13:41:41', '2023-11-16 13:41:41'),
(3, '4', '4', '2023-11-21 13:44:15', '2023-11-21 13:44:15'),
(4, '4', '5', '2023-11-21 13:44:18', '2023-11-21 13:44:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us_contents`
--
ALTER TABLE `about_us_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `additional_options`
--
ALTER TABLE `additional_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_content`
--
ALTER TABLE `blog_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_contents`
--
ALTER TABLE `blog_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indexes for table `checkout`
--
ALTER TABLE `checkout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `completed_task`
--
ALTER TABLE `completed_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `home_content`
--
ALTER TABLE `home_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_contents`
--
ALTER TABLE `login_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logos`
--
ALTER TABLE `logos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `logos_logo_unique_id_unique` (`logo_unique_id`);

--
-- Indexes for table `logo_facilities`
--
ALTER TABLE `logo_facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo_reviews`
--
ALTER TABLE `logo_reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo_revisions`
--
ALTER TABLE `logo_revisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logo_status`
--
ALTER TABLE `logo_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_meta`
--
ALTER TABLE `order_meta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_meta_order_id_foreign` (`order_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `register_contents`
--
ALTER TABLE `register_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews_content`
--
ALTER TABLE `reviews_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `review_contents`
--
ALTER TABLE `review_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_contents`
--
ALTER TABLE `shop_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `site_metas`
--
ALTER TABLE `site_metas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `special_designer_tasks`
--
ALTER TABLE `special_designer_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `styles`
--
ALTER TABLE `styles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_content`
--
ALTER TABLE `support_content`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `support_contents`
--
ALTER TABLE `support_contents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_billing_address`
--
ALTER TABLE `user_billing_address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about_us_contents`
--
ALTER TABLE `about_us_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `additional_options`
--
ALTER TABLE `additional_options`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `blog_content`
--
ALTER TABLE `blog_content`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `blog_contents`
--
ALTER TABLE `blog_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `checkout`
--
ALTER TABLE `checkout`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `completed_task`
--
ALTER TABLE `completed_task`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `home_content`
--
ALTER TABLE `home_content`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `login_contents`
--
ALTER TABLE `login_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `logos`
--
ALTER TABLE `logos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `logo_facilities`
--
ALTER TABLE `logo_facilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `logo_reviews`
--
ALTER TABLE `logo_reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `logo_revisions`
--
ALTER TABLE `logo_revisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `logo_status`
--
ALTER TABLE `logo_status`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `order_meta`
--
ALTER TABLE `order_meta`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `register_contents`
--
ALTER TABLE `register_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reviews_content`
--
ALTER TABLE `reviews_content`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review_contents`
--
ALTER TABLE `review_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shop_contents`
--
ALTER TABLE `shop_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `site_metas`
--
ALTER TABLE `site_metas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `special_designer_tasks`
--
ALTER TABLE `special_designer_tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `styles`
--
ALTER TABLE `styles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `support_content`
--
ALTER TABLE `support_content`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_contents`
--
ALTER TABLE `support_contents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user_billing_address`
--
ALTER TABLE `user_billing_address`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_meta`
--
ALTER TABLE `order_meta`
  ADD CONSTRAINT `order_meta_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
