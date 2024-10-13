-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 24, 2024 lúc 10:29 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `football`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', '2024-07-10 02:57:33');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblbanners`
--

CREATE TABLE `tblbanners` (
  `id` int(11) NOT NULL,
  `BannerTitle` varchar(150) DEFAULT NULL,
  `Vimage1` varchar(120) DEFAULT NULL,
  `Vimage2` varchar(120) DEFAULT NULL,
  `Vimage3` varchar(120) DEFAULT NULL,
  `Vimage4` varchar(120) DEFAULT NULL,
  `Vimage5` varchar(120) DEFAULT NULL,
  `CreateDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tblbanners`
--

INSERT INTO `tblbanners` (`id`, `BannerTitle`, `Vimage1`, `Vimage2`, `Vimage3`, `Vimage4`, `Vimage5`, `CreateDate`, `UpdationDate`, `Status`) VALUES
(1, 'Banner image website', 'banner1_930x620.jpg', 'banner2_930x620.jpg', 'banner3_930x620.jpg', 'banner4_930x620.jpg', 'banner5_930x620.jpg', '2024-06-22 14:04:35', '2024-06-22 14:06:53', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblbookings`
--

CREATE TABLE `tblbookings` (
  `BookingID` int(11) NOT NULL,
  `CustomerID` int(11) DEFAULT NULL,
  `AwayTeam` int(11) DEFAULT NULL,
  `idfm` int(11) NOT NULL,
  `BookingDate` date DEFAULT NULL,
  `Notes` text DEFAULT NULL,
  `Status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblbookings`
--

INSERT INTO `tblbookings` (`BookingID`, `CustomerID`, `AwayTeam`, `idfm`, `BookingDate`, `Notes`, `Status`) VALUES
(1, 1, NULL, 12, '2024-06-24', 'Kiếm kèo mạnh!', 2),
(2, 1, NULL, 19, '2024-07-02', '', 1),
(3, 1, 2, 17, '2024-07-02', '', 2),
(4, 1, NULL, 32, '2024-07-02', '', 1),
(5, 1, 2, 32, '2024-07-03', '', 4),
(14, 1, NULL, 2, '2024-07-04', '', 1),
(15, 1, 2, 17, '2024-07-04', '', 2),
(16, 1, NULL, 32, '2024-07-04', '', 1),
(17, 2, 1, 18, '2024-07-04', '', 4),
(18, 1, NULL, 33, '2024-07-04', '', 1),
(19, 2, 3, 4, '2024-07-04', '', 4),
(20, 3, 1, 3, '2024-07-04', '', 4),
(21, 3, 2, 19, '2024-07-04', '', 4),
(22, 3, 2, 2, '2024-07-05', '', 2),
(23, 2, 1, 17, '2024-07-05', '', 3),
(24, 1, 2, 2, '2024-07-07', '', 4),
(25, 1, 2, 13, '2024-07-07', '', 3),
(26, 1, 2, 2, '2024-07-11', '', 4),
(27, 1, 2, 17, '2024-07-11', '', 4),
(28, 1, NULL, 2, '2024-08-02', '', 1),
(29, 1, 2, 2, '2024-08-21', '', 3),
(30, 1, 2, 17, '2024-08-21', '', 3),
(32, 1, NULL, 2, '2024-08-22', '', 1),
(42, 1, 2, 62, '2024-08-24', '', 4);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Description` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Description`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(3, 'Thể Thao', 'Liên quan đến tin tức thể thao', '2024-01-11 18:30:00', '2024-06-23 05:43:16', 1),
(5, 'Giải trí', 'Tin tức liên quan đến giải trí', '2024-01-11 18:30:00', '2024-06-23 05:43:25', 1),
(6, 'Chính trị', 'Tin tức liên quan đến chính trị', '2024-01-11 18:30:00', '2024-06-23 13:30:05', 1),
(7, 'Kinh doanh', 'Tin tức liên quan đến Kinh doanh', '2024-01-11 18:30:00', '2024-06-23 05:43:25', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcontactusinfo`
--

CREATE TABLE `tblcontactusinfo` (
  `id` int(11) NOT NULL,
  `Address` tinytext DEFAULT NULL,
  `EmailId` varchar(255) DEFAULT NULL,
  `ContactNo` char(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tblcontactusinfo`
--

INSERT INTO `tblcontactusinfo` (`id`, `Address`, `EmailId`, `ContactNo`) VALUES
(1, 'Châu Thành - Trà Vinh', 'thanhhien.thach@gmail.com', '0975448616');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcontactusquery`
--

CREATE TABLE `tblcontactusquery` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `ContactNumber` char(11) DEFAULT NULL,
  `Message` longtext DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tblcontactusquery`
--

INSERT INTO `tblcontactusquery` (`id`, `name`, `EmailId`, `ContactNumber`, `Message`, `PostingDate`, `status`) VALUES
(1, 'Kunal ', 'kunal@gmail.com', '7977779798', 'I want to know you brach in Chandigarh?', '2024-06-04 09:34:51', 1),
(2, 'Test', 'mailtest@gmail.com', '0123456789', 'asdasdasdasdasdasd', '2024-07-08 08:38:00', 1),
(3, 'Test', 'mailtest@gmail.com', '0123456789', 'asdasdasdasdasdasd', '2024-07-08 08:38:52', NULL),
(4, 'Test', 'mailtest@gmail.com', '0123456789', 'asdasdasdasdasdasd', '2024-07-08 08:39:24', NULL),
(5, 'Test', 'mailtest@gmail.com', '0123456789', 'asdasdasdasdasdasd', '2024-07-08 08:39:51', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcountryalpha`
--

CREATE TABLE `tblcountryalpha` (
  `ID` int(11) NOT NULL,
  `Country` varchar(150) NOT NULL,
  `Alpha2` varchar(10) NOT NULL,
  `Alpha3` varchar(10) NOT NULL,
  `NumericAlpha` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblcountryalpha`
--

INSERT INTO `tblcountryalpha` (`ID`, `Country`, `Alpha2`, `Alpha3`, `NumericAlpha`) VALUES
(369, 'Afghanistan', 'FG', 'AFG', ''),
(370, 'Albania', 'LB', 'ALB', ''),
(371, 'Algeria', 'LG', 'ALG', ''),
(372, 'American Samoa', 'SA', 'ASA', ''),
(373, 'Andorra', 'ND', 'AND', ''),
(374, 'Angola', 'NG', 'ANG', ''),
(375, 'Anguilla', 'IA', 'AIA', ''),
(376, 'Antigua and Barbuda', 'TG', 'ATG', ''),
(377, 'Argentina', 'RG', 'ARG', ''),
(378, 'Armenia', 'RM', 'ARM', ''),
(379, 'Aruba', 'RU', 'ARU', ''),
(380, 'Australia', 'US', 'AUS', ''),
(381, 'Austria', 'UT', 'AUT', ''),
(382, 'Azerbaijan', 'ZE', 'AZE', ''),
(383, 'Bahamas', 'AH', 'BAH', ''),
(384, 'Bahrain', 'HR', 'BHR', ''),
(385, 'Bangladesh', 'AN', 'BAN', ''),
(386, 'Barbados', 'RB', 'BRB', ''),
(387, 'Belarus', 'LR', 'BLR', ''),
(388, 'Belgium', 'EL', 'BEL', ''),
(389, 'Belize', 'LZ', 'BLZ', ''),
(390, 'Benin', 'EN', 'BEN', ''),
(391, 'Bermuda', 'ER', 'BER', ''),
(392, 'Bhutan', 'HU', 'BHU', ''),
(393, 'Bolivia', 'OL', 'BOL', ''),
(394, 'Bosnia and Herzegovina', 'IH', 'BIH', ''),
(395, 'Botswana', 'OT', 'BOT', ''),
(396, 'Brazil', 'RA', 'BRA', ''),
(397, 'British Virgin Islands', 'GB', 'VGB', ''),
(398, 'Brunei', 'RU', 'BRU', ''),
(399, 'Bulgaria', 'UL', 'BUL', ''),
(400, 'Burkina Faso', 'FA', 'BFA', ''),
(401, 'Burundi', 'DI', 'BDI', ''),
(402, 'Cambodia', 'AM', 'CAM', ''),
(403, 'Cameroon', 'MR', 'CMR', ''),
(404, 'Canada', 'AN', 'CAN', ''),
(405, 'Cape Verde', 'PV', 'CPV', ''),
(406, 'Cayman Islands', 'AY', 'CAY', ''),
(407, 'Central African Republic', 'TA', 'CTA', ''),
(408, 'Chad', 'HA', 'CHA', ''),
(409, 'Chile', 'HI', 'CHI', ''),
(410, 'China', 'HN', 'CHN', ''),
(411, 'Chinese Taipei', 'PE', 'TPE', ''),
(412, 'Colombia', 'OL', 'COL', ''),
(413, 'Comoros', 'OM', 'COM', ''),
(414, 'Congo', 'GO', 'CGO', ''),
(415, 'Cook Islands', 'OK', 'COK', ''),
(416, 'Costa Rica', 'RC', 'CRC', ''),
(417, 'Croatia', 'RO', 'CRO', ''),
(418, 'Cuba', 'UB', 'CUB', ''),
(419, 'Curaçao', 'UW', 'CUW', ''),
(420, 'Cyprus', 'YP', 'CYP', ''),
(421, 'Czech Republic', 'ZE', 'CZE', ''),
(422, 'Country', 'de', 'ode', ''),
(423, 'Denmark', 'EN', 'DEN', ''),
(424, 'Djibouti', 'JI', 'DJI', ''),
(425, 'Dominica', 'MA', 'DMA', ''),
(426, 'Dominican Republic', 'OM', 'DOM', ''),
(427, 'DR Congo', 'OD', 'COD', ''),
(428, 'Ecuador', 'CU', 'ECU', ''),
(429, 'Egypt', 'GY', 'EGY', ''),
(430, 'El Salvador', 'LV', 'SLV', ''),
(431, 'England', 'NG', 'ENG', ''),
(432, 'Equatorial Guinea', 'QG', 'EQG', ''),
(433, 'Eritrea', 'RI', 'ERI', ''),
(434, 'Estonia', 'ST', 'EST', ''),
(435, 'Eswatini', 'WZ', 'SWZ', ''),
(436, 'Ethiopia', 'TH', 'ETH', ''),
(437, 'Faroe Islands', 'RO', 'FRO', ''),
(438, 'Fiji', 'IJ', 'FIJ', ''),
(439, 'Finland', 'IN', 'FIN', ''),
(440, 'France', 'RA', 'FRA', ''),
(441, 'Gabon', 'AB', 'GAB', ''),
(442, 'Gambia', 'AM', 'GAM', ''),
(443, 'Georgia', 'EO', 'GEO', ''),
(444, 'Germany', 'ER', 'GER', ''),
(445, 'Ghana', 'HA', 'GHA', ''),
(446, 'Gibraltar', 'IB', 'GIB', ''),
(447, 'Greece', 'RE', 'GRE', ''),
(448, 'Grenada', 'RN', 'GRN', ''),
(449, 'Guam', 'UM', 'GUM', ''),
(450, 'Guatemala', 'UA', 'GUA', ''),
(451, 'Guinea', 'UI', 'GUI', ''),
(452, 'Guinea', 'NB', 'GNB', ''),
(453, 'Guyana', 'UY', 'GUY', ''),
(454, 'Haiti', 'AI', 'HAI', ''),
(455, 'Honduras', 'ON', 'HON', ''),
(456, 'Hong Kong', 'KG', 'HKG', ''),
(457, 'Hungary', 'UN', 'HUN', ''),
(458, 'Iceland', 'SL', 'ISL', ''),
(459, 'India', 'ND', 'IND', ''),
(460, 'Indonesia', 'DN', 'IDN', ''),
(461, 'Iran', 'RN', 'IRN', ''),
(462, 'Iraq', 'RQ', 'IRQ', ''),
(463, 'Israel', 'SR', 'ISR', ''),
(464, 'Italy', 'TA', 'ITA', ''),
(465, 'Ivory Coast', 'IV', 'CIV', ''),
(466, 'Jamaica', 'AM', 'JAM', ''),
(467, 'Japan', 'PN', 'JPN', ''),
(468, 'Jordan', 'OR', 'JOR', ''),
(469, 'Kazakhstan', 'AZ', 'KAZ', ''),
(470, 'Kenya', 'EN', 'KEN', ''),
(471, 'Kosovo', 'OS', 'KOS', ''),
(472, 'Kuwait', 'UW', 'KUW', ''),
(473, 'Kyrgyzstan', 'GZ', 'KGZ', ''),
(474, 'Laos', 'AO', 'LAO', ''),
(475, 'Latvia', 'VA', 'LVA', ''),
(476, 'Lebanon', 'BN', 'LBN', ''),
(477, 'Lesotho', 'ES', 'LES', ''),
(478, 'Liberia', 'BR', 'LBR', ''),
(479, 'Libya', 'BY', 'LBY', ''),
(480, 'Liechtenstein', 'IE', 'LIE', ''),
(481, 'Lithuania', 'TU', 'LTU', ''),
(482, 'Luxembourg', 'UX', 'LUX', ''),
(483, 'Macau', 'AC', 'MAC', ''),
(484, 'Madagascar', 'AD', 'MAD', ''),
(485, 'Malawi', 'WI', 'MWI', ''),
(486, 'Malaysia', 'AS', 'MAS', ''),
(487, 'Maldives', 'DV', 'MDV', ''),
(488, 'Mali', 'LI', 'MLI', ''),
(489, 'Malta', 'LT', 'MLT', ''),
(490, 'Mauritania', 'TN', 'MTN', ''),
(491, 'Mauritius', 'RI', 'MRI', ''),
(492, 'Mexico', 'EX', 'MEX', ''),
(493, 'Moldova', 'DA', 'MDA', ''),
(494, 'Mongolia', 'NG', 'MNG', ''),
(495, 'Montenegro', 'NE', 'MNE', ''),
(496, 'Montserrat', 'SR', 'MSR', ''),
(497, 'Morocco', 'AR', 'MAR', ''),
(498, 'Mozambique', 'OZ', 'MOZ', ''),
(499, 'Myanmar', 'YA', 'MYA', ''),
(500, 'Namibia', 'AM', 'NAM', ''),
(501, 'Nepal', 'EP', 'NEP', ''),
(502, 'Netherlands', 'ED', 'NED', ''),
(503, 'New Caledonia', 'CL', 'NCL', ''),
(504, 'New Zealand', 'ZL', 'NZL', ''),
(505, 'Nicaragua', 'CA', 'NCA', ''),
(506, 'Niger', 'IG', 'NIG', ''),
(507, 'Nigeria', 'GA', 'NGA', ''),
(508, 'North Korea', 'RK', 'PRK', ''),
(509, 'North Macedonia', 'KD', 'MKD', ''),
(510, 'Northern Ireland', 'IR', 'NIR', ''),
(511, 'Norway', 'OR', 'NOR', ''),
(512, 'Oman', 'MA', 'OMA', ''),
(513, 'Pakistan', 'AK', 'PAK', ''),
(514, 'Palestine', 'LE', 'PLE', ''),
(515, 'Panama', 'AN', 'PAN', ''),
(516, 'Papua New Guinea', 'NG', 'PNG', ''),
(517, 'Paraguay', 'AR', 'PAR', ''),
(518, 'Peru', 'ER', 'PER', ''),
(519, 'Philippines', 'HI', 'PHI', ''),
(520, 'Poland', 'OL', 'POL', ''),
(521, 'Portugal', 'OR', 'POR', ''),
(522, 'Puerto Rico', 'UR', 'PUR', ''),
(523, 'Qatar', 'AT', 'QAT', ''),
(524, 'Republic of Ireland', 'RL', 'IRL', ''),
(525, 'Romania', 'OU', 'ROU', ''),
(526, 'Russia', 'US', 'RUS', ''),
(527, 'Rwanda', 'WA', 'RWA', ''),
(528, 'Saint Kitts and Nevis', 'KN', 'SKN', ''),
(529, 'Saint Lucia', 'CA', 'LCA', ''),
(530, 'Saint Vincent and the Grenadines', 'IN', 'VIN', ''),
(531, 'Samoa', 'AM', 'SAM', ''),
(532, 'San Marino', 'MR', 'SMR', ''),
(533, 'São Tomé and Príncipe', 'TP', 'STP', ''),
(534, 'Saudi Arabia', 'SA', 'KSA', ''),
(535, 'Scotland', 'CO', 'SCO', ''),
(536, 'Senegal', 'EN', 'SEN', ''),
(537, 'Serbia', 'RB', 'SRB', ''),
(538, 'Seychelles', 'EY', 'SEY', ''),
(539, 'Sierra Leone', 'LE', 'SLE', ''),
(540, 'Singapore', 'GP', 'SGP', ''),
(541, 'Slovakia', 'VK', 'SVK', ''),
(542, 'Slovenia', 'VN', 'SVN', ''),
(543, 'Solomon Islands', 'OL', 'SOL', ''),
(544, 'Somalia', 'OM', 'SOM', ''),
(545, 'South Africa', 'SA', 'RSA', ''),
(546, 'South Korea', 'OR', 'KOR', ''),
(547, 'South Sudan', 'SD', 'SSD', ''),
(548, 'Spain', 'SP', 'ESP', ''),
(549, 'Sri Lanka', 'RI', 'SRI', ''),
(550, 'Sudan', 'DN', 'SDN', ''),
(551, 'Suriname', 'UR', 'SUR', ''),
(552, 'Sweden', 'WE', 'SWE', ''),
(553, 'Switzerland', 'UI', 'SUI', ''),
(554, 'Syria', 'YR', 'SYR', ''),
(555, 'Tahiti', 'AH', 'TAH', ''),
(556, 'Tajikistan', 'JK', 'TJK', ''),
(557, 'Tanzania', 'AN', 'TAN', ''),
(558, 'Thailand', 'HA', 'THA', ''),
(559, 'East Timor', 'LS', 'TLS', ''),
(560, 'Togo', 'OG', 'TOG', ''),
(561, 'Tonga', 'GA', 'TGA', ''),
(562, 'Trinidad and Tobago', 'RI', 'TRI', ''),
(563, 'Tunisia', 'UN', 'TUN', ''),
(564, 'Turkey', 'UR', 'TUR', ''),
(565, 'Turkmenistan', 'KM', 'TKM', ''),
(566, 'Turks and Caicos Islands', 'CA', 'TCA', ''),
(567, 'Uganda', 'GA', 'UGA', ''),
(568, 'Ukraine', 'KR', 'UKR', ''),
(569, 'United Arab Emirates', 'AE', 'UAE', ''),
(570, 'United States', 'SA', 'USA', ''),
(571, 'Uruguay', 'RU', 'URU', ''),
(572, 'U.S. Virgin Islands', 'IR', 'VIR', ''),
(573, 'Uzbekistan', 'ZB', 'UZB', ''),
(574, 'Vanuatu', 'AN', 'VAN', ''),
(575, 'Venezuela', 'EN', 'VEN', ''),
(576, 'Vietnam', 'IE', 'VIE', ''),
(577, 'Wales', 'AL', 'WAL', ''),
(578, 'Yemen', 'EM', 'YEM', ''),
(579, 'Zambia', 'AM', 'ZAM', ''),
(580, 'Zimbabwe', 'IM', 'ZIM', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcustomers`
--

CREATE TABLE `tblcustomers` (
  `CustomerID` int(11) NOT NULL,
  `CustomerName` varchar(100) NOT NULL,
  `CustomerTypeID` int(50) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblcustomers`
--

INSERT INTO `tblcustomers` (`CustomerID`, `CustomerName`, `CustomerTypeID`, `Address`, `Phone`, `Email`) VALUES
(1, 'Hien', 1, 'Châu Thành - Trà Vinh', '0123456789', 'mailtest@gmail.com'),
(2, 'Oanh Đi', 1, 'Chau Thanh - Tra Vinh', NULL, 'OanhDi@gmail.com'),
(3, 'Cristiano Ronaldo', 1, 'Bồ Đào Nha', '0123456789', 'ronaldo@gmail.com'),
(10, 'Ngọc Ly', 1, 'Trà On', '0123456789', 'ngocly@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblcustomertype`
--

CREATE TABLE `tblcustomertype` (
  `CustomerTypeID` int(11) NOT NULL,
  `CustomerTypeName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblcustomertype`
--

INSERT INTO `tblcustomertype` (`CustomerTypeID`, `CustomerTypeName`) VALUES
(1, 'Bình Thường'),
(2, 'VIP');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbldiscount`
--

CREATE TABLE `tbldiscount` (
  `id` int(11) NOT NULL,
  `value` decimal(10,2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `create_by` varchar(50) DEFAULT NULL,
  `create_date` datetime DEFAULT current_timestamp(),
  `update_last` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbldiscount`
--

INSERT INTO `tbldiscount` (`id`, `value`, `description`, `create_by`, `create_date`, `update_last`) VALUES
(1, 5.00, '5%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(2, 10.00, '10%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(3, 15.00, '15%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(4, 20.00, '20%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(5, 25.00, '25%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(6, 30.00, '30%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(7, 35.00, '35%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(8, 40.00, '40%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(9, 45.00, '45%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(10, 50.00, '50%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(11, 55.00, '55%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(12, 60.00, '60%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(13, 65.00, '65%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(14, 70.00, '70%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(15, 75.00, '75%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(16, 80.00, '80%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(17, 85.00, '85%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(18, 90.00, '90%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(19, 95.00, '95%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38'),
(20, 100.00, '100%', NULL, '2024-07-26 16:07:38', '2024-07-26 16:07:38');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbldrink`
--

CREATE TABLE `tbldrink` (
  `DrinkID` int(11) NOT NULL,
  `DrinkName` varchar(150) NOT NULL,
  `PricePerUnit` decimal(10,0) NOT NULL,
  `CreateDate` datetime NOT NULL DEFAULT current_timestamp(),
  `UpdateDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbldrink`
--

INSERT INTO `tbldrink` (`DrinkID`, `DrinkName`, `PricePerUnit`, `CreateDate`, `UpdateDate`) VALUES
(1, 'Sting', 15000, '2024-07-19 09:55:34', NULL),
(2, 'Chanh Muối', 15000, '2024-07-19 09:55:34', NULL),
(3, 'Trà Đường', 10000, '2024-07-19 09:55:34', NULL),
(4, 'Number 1', 10000, '2024-07-19 09:55:34', NULL),
(5, 'Cafe đá', 10000, '2024-07-19 09:55:34', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbldrinkorder`
--

CREATE TABLE `tbldrinkorder` (
  `DrinkOrderID` int(11) NOT NULL,
  `TotalPrice` decimal(10,2) DEFAULT NULL,
  `PaymentID` int(11) DEFAULT NULL,
  `CreateDate` datetime NOT NULL DEFAULT current_timestamp(),
  `UpdateDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbldrinkorder`
--

INSERT INTO `tbldrinkorder` (`DrinkOrderID`, `TotalPrice`, `PaymentID`, `CreateDate`, `UpdateDate`) VALUES
(76, 120000.00, 75, '2024-07-20 16:34:58', '2024-07-20 21:30:07'),
(87, 150000.00, 90, '2024-07-23 14:24:39', '2024-07-23 14:24:39'),
(88, 75000.00, 91, '2024-08-24 14:12:48', '2024-08-24 14:12:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbldrinkorderline`
--

CREATE TABLE `tbldrinkorderline` (
  `DrinkOrderLineID` int(11) NOT NULL,
  `DrinkOrderID` int(11) NOT NULL,
  `DrinkID` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `TotalPrice` decimal(10,0) NOT NULL,
  `CreateDate` datetime NOT NULL DEFAULT current_timestamp(),
  `UpdateDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbldrinkorderline`
--

INSERT INTO `tbldrinkorderline` (`DrinkOrderLineID`, `DrinkOrderID`, `DrinkID`, `Quantity`, `TotalPrice`, `CreateDate`, `UpdateDate`) VALUES
(83, 76, 1, 3, 45000, '2024-07-20 16:34:58', NULL),
(84, 76, 3, 2, 20000, '2024-07-20 16:34:58', NULL),
(108, 87, 1, 2, 30000, '2024-07-23 14:24:39', NULL),
(109, 87, 2, 8, 120000, '2024-07-23 14:24:39', NULL),
(110, 88, 1, 5, 75000, '2024-08-24 14:12:48', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblemployees`
--

CREATE TABLE `tblemployees` (
  `EmployeeID` int(11) NOT NULL,
  `EmployeeName` varchar(100) NOT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `PositionTypeID` int(11) DEFAULT NULL,
  `Salary` decimal(10,2) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblemployees`
--

INSERT INTO `tblemployees` (`EmployeeID`, `EmployeeName`, `DateOfBirth`, `Gender`, `PositionTypeID`, `Salary`, `Address`, `Phone`, `Email`) VALUES
(1, 'Nguyễn Quang Vinh', NULL, NULL, 3, NULL, 'Châu Thành - Trà Vinh', '0123456789', ''),
(2, 'Trương Quốc Dũng', NULL, NULL, 3, NULL, 'TP. Trà Vinh', '0123456789', NULL),
(3, 'Võ Minh Trí', NULL, NULL, 3, NULL, 'TP. Trà Vinh', '0123456789', NULL),
(4, 'Hoàng Anh Tuấn', NULL, NULL, NULL, NULL, 'TP. Trà Vinh', '0123456789', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblfacility_inventory`
--

CREATE TABLE `tblfacility_inventory` (
  `id` int(11) NOT NULL,
  `facility_type_id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `good_quantity` int(11) NOT NULL,
  `normal_quantity` int(11) NOT NULL,
  `deteriorated_quantity` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `last_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblfacility_inventory`
--

INSERT INTO `tblfacility_inventory` (`id`, `facility_type_id`, `warehouse_id`, `quantity`, `good_quantity`, `normal_quantity`, `deteriorated_quantity`, `status_id`, `last_updated`) VALUES
(2, 2, 1, 10, 2, 2, 6, 2, '2024-07-23 14:04:23'),
(3, 1, 1, 50, 40, 5, 5, 1, '2024-07-23 14:03:12'),
(4, 3, 1, 8, 5, 2, 1, 1, '2024-07-23 14:27:30');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblfacility_status`
--

CREATE TABLE `tblfacility_status` (
  `id` int(11) NOT NULL,
  `status_fac` varchar(150) NOT NULL,
  `Create_By` varchar(50) DEFAULT NULL,
  `Create_Date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblfacility_status`
--

INSERT INTO `tblfacility_status` (`id`, `status_fac`, `Create_By`, `Create_Date`) VALUES
(1, 'Bình thường', NULL, '2024-07-22 11:48:48'),
(2, 'Cần Nâng Cấp', NULL, '2024-07-22 11:48:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblfacility_types`
--

CREATE TABLE `tblfacility_types` (
  `id` int(11) NOT NULL,
  `type_name` varchar(150) NOT NULL,
  `Create_By` varchar(50) DEFAULT NULL,
  `Create_Date` datetime NOT NULL DEFAULT current_timestamp(),
  `Last_Update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblfacility_types`
--

INSERT INTO `tblfacility_types` (`id`, `type_name`, `Create_By`, `Create_Date`, `Last_Update`) VALUES
(1, 'Trái bóng', NULL, '2024-07-22 11:48:25', '2024-07-22 14:16:42'),
(2, 'Đồng phục', NULL, '2024-07-22 11:48:25', NULL),
(3, 'Khung thành', NULL, '2024-07-22 11:48:25', NULL),
(4, 'Lưới bóng', NULL, '2024-07-22 11:48:25', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblfieldmatch`
--

CREATE TABLE `tblfieldmatch` (
  `idfm` int(11) NOT NULL,
  `FieldID` int(11) NOT NULL,
  `idtm` int(11) NOT NULL,
  `Price` decimal(10,0) NOT NULL,
  `Status` int(11) NOT NULL,
  `CreateBy` varchar(50) NOT NULL,
  `CreateDate` date NOT NULL,
  `UpdateDate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblfieldmatch`
--

INSERT INTO `tblfieldmatch` (`idfm`, `FieldID`, `idtm`, `Price`, `Status`, `CreateBy`, `CreateDate`, `UpdateDate`) VALUES
(2, 1, 1, 150000, 1, '', '2024-06-24', 0),
(3, 1, 2, 150000, 1, '', '2024-06-24', 0),
(4, 1, 3, 150000, 1, '', '2024-06-24', 0),
(5, 1, 4, 150000, 1, '', '2024-06-24', 0),
(6, 1, 5, 150000, 1, '', '2024-06-24', 0),
(7, 1, 6, 150000, 1, '', '2024-06-24', 0),
(8, 1, 7, 170000, 1, '', '2024-06-24', 0),
(9, 1, 8, 170000, 1, '', '2024-06-24', 0),
(10, 1, 9, 170000, 1, '', '2024-06-24', 0),
(11, 1, 10, 200000, 1, '', '2024-06-24', 0),
(12, 1, 11, 200000, 1, '', '2024-06-24', 0),
(13, 1, 12, 200000, 1, '', '2024-06-24', 0),
(14, 1, 13, 200000, 1, '', '2024-06-24', 0),
(15, 1, 14, 200000, 1, '', '2024-06-24', 0),
(16, 1, 15, 200000, 1, '', '2024-06-24', 0),
(17, 2, 1, 150000, 1, '', '2024-06-24', 0),
(18, 2, 2, 150000, 1, '', '2024-06-24', 0),
(19, 2, 3, 150000, 1, '', '2024-06-24', 0),
(20, 2, 4, 150000, 1, '', '2024-06-24', 0),
(21, 2, 5, 150000, 1, '', '2024-06-24', 0),
(22, 2, 6, 150000, 1, '', '2024-06-24', 0),
(23, 2, 7, 170000, 1, '', '2024-06-24', 0),
(24, 2, 8, 170000, 1, '', '2024-06-24', 0),
(25, 2, 9, 170000, 1, '', '2024-06-24', 0),
(26, 2, 10, 200000, 1, '', '2024-06-24', 0),
(27, 2, 11, 200000, 1, '', '2024-06-24', 0),
(28, 2, 12, 200000, 1, '', '2024-06-24', 0),
(29, 2, 13, 200000, 1, '', '2024-06-24', 0),
(30, 2, 14, 200000, 1, '', '2024-06-24', 0),
(31, 2, 15, 200000, 1, '', '2024-06-24', 0),
(32, 3, 1, 150000, 1, '', '2024-06-24', 0),
(33, 3, 2, 150000, 1, '', '2024-06-24', 0),
(34, 3, 3, 150000, 1, '', '2024-06-24', 0),
(35, 3, 4, 150000, 1, '', '2024-06-24', 0),
(36, 3, 5, 150000, 1, '', '2024-06-24', 0),
(37, 3, 6, 150000, 1, '', '2024-06-24', 0),
(38, 3, 7, 170000, 1, '', '2024-06-24', 0),
(39, 3, 8, 170000, 1, '', '2024-06-24', 0),
(40, 3, 9, 170000, 0, '', '2024-06-24', 0),
(41, 3, 10, 200000, 1, '', '2024-06-24', 0),
(42, 3, 11, 200000, 1, '', '2024-06-24', 0),
(43, 3, 12, 200000, 1, '', '2024-06-24', 0),
(44, 3, 13, 200000, 1, '', '2024-06-24', 0),
(45, 3, 14, 200000, 1, '', '2024-06-24', 0),
(46, 3, 15, 200000, 1, '', '2024-06-24', 0),
(47, 4, 1, 150000, 1, '', '2024-06-24', 0),
(48, 4, 2, 150000, 1, '', '2024-06-24', 0),
(49, 4, 3, 150000, 1, '', '2024-06-24', 0),
(50, 4, 4, 150000, 1, '', '2024-06-24', 0),
(51, 4, 5, 150000, 1, '', '2024-06-24', 0),
(52, 4, 6, 150000, 1, '', '2024-06-24', 0),
(53, 4, 7, 170000, 1, '', '2024-06-24', 0),
(54, 4, 8, 170000, 1, '', '2024-06-24', 0),
(55, 4, 9, 170000, 0, '', '2024-06-24', 0),
(56, 4, 10, 200000, 1, '', '2024-06-24', 0),
(57, 4, 11, 200000, 1, '', '2024-06-24', 0),
(58, 4, 12, 200000, 1, '', '2024-06-24', 0),
(59, 4, 13, 200000, 1, '', '2024-06-24', 0),
(60, 4, 14, 200000, 1, '', '2024-06-24', 0),
(61, 4, 15, 200000, 1, '', '2024-06-24', 0),
(62, 5, 1, 200000, 1, '', '0000-00-00', 0),
(63, 5, 2, 200000, 1, '', '0000-00-00', 0),
(64, 5, 3, 200000, 1, '', '0000-00-00', 0),
(65, 5, 4, 200000, 1, '', '0000-00-00', 0),
(66, 5, 5, 200000, 1, '', '0000-00-00', 0),
(67, 5, 6, 200000, 1, '', '0000-00-00', 0),
(68, 5, 7, 200000, 1, '', '0000-00-00', 0),
(69, 5, 8, 200000, 1, '', '0000-00-00', 0),
(70, 5, 9, 200000, 1, '', '0000-00-00', 0),
(71, 5, 10, 200000, 1, '', '0000-00-00', 0),
(72, 5, 11, 250000, 1, '', '0000-00-00', 0),
(73, 5, 12, 250000, 1, '', '0000-00-00', 0),
(74, 5, 13, 250000, 1, '', '0000-00-00', 0),
(75, 5, 14, 300000, 1, '', '0000-00-00', 0),
(76, 5, 15, 300000, 1, '', '0000-00-00', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblfields`
--

CREATE TABLE `tblfields` (
  `FieldID` int(11) NOT NULL,
  `FieldName` varchar(100) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `FieldTypeID` int(11) DEFAULT NULL,
  `Size` varchar(50) DEFAULT NULL,
  `MaxPlayers` int(11) DEFAULT NULL,
  `Notes` text DEFAULT NULL,
  `FieldGroup` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblfields`
--

INSERT INTO `tblfields` (`FieldID`, `FieldName`, `Address`, `FieldTypeID`, `Size`, `MaxPlayers`, `Notes`, `FieldGroup`) VALUES
(1, 'Sân 1', '', 1, '40M*20M', 10, 'Sân 1', 5),
(2, 'Sân 2', NULL, 1, '40M*20M', 10, 'Sân 2', 5),
(3, 'Sân 3', NULL, 1, '40M*20M', 10, 'Sân 3', 5),
(5, 'Sân 7(Sân Lớn)', NULL, 1, '25M*45M', 14, 'Sân 7', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblfieldtypes`
--

CREATE TABLE `tblfieldtypes` (
  `FieldTypeID` int(11) NOT NULL,
  `TypeName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblfieldtypes`
--

INSERT INTO `tblfieldtypes` (`FieldTypeID`, `TypeName`) VALUES
(1, 'Bóng Đá'),
(2, 'Cầu Lông');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblmatches`
--

CREATE TABLE `tblmatches` (
  `MatchID` int(11) NOT NULL,
  `BookingID` int(11) NOT NULL,
  `Status` int(11) NOT NULL,
  `Result` varchar(50) DEFAULT NULL,
  `Referee` varchar(50) DEFAULT NULL,
  `EmployeeID` int(11) NOT NULL,
  `HomeTeamID` int(11) NOT NULL,
  `AwayTeamID` int(11) DEFAULT NULL,
  `ScoreTeamHome` int(11) DEFAULT NULL,
  `ScoreTeamAway` int(11) DEFAULT NULL,
  `CreateBy` int(11) DEFAULT NULL,
  `CreateDate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblmatches`
--

INSERT INTO `tblmatches` (`MatchID`, `BookingID`, `Status`, `Result`, `Referee`, `EmployeeID`, `HomeTeamID`, `AwayTeamID`, `ScoreTeamHome`, `ScoreTeamAway`, `CreateBy`, `CreateDate`) VALUES
(1, 1, 4, '1', '', 1, 1, 2, 5, 2, 1, '2024-06-29 17:00:00'),
(3, 5, 4, '1', '', 1, 1, 2, 3, 0, NULL, '2024-07-04 04:35:40'),
(4, 17, 4, '2', '', 1, 2, 1, 6, 2, 1, '2024-07-04 07:10:38'),
(5, 20, 4, '3', '', 1, 3, 1, 10, 2, 1, '2024-07-04 13:44:50'),
(6, 19, 4, '3', '', 1, 2, 3, 4, 5, 1, '2024-07-04 14:23:44'),
(7, 21, 4, '3', '', 1, 3, 2, 6, 3, 1, '2024-07-04 14:35:09'),
(8, 23, 3, NULL, NULL, 1, 2, 1, NULL, NULL, 0, '2024-07-05 15:25:56'),
(9, 24, 4, '2', 'Kim Lâm Khôi', 1, 1, 2, 2, 7, 1, '2024-07-07 08:41:46'),
(10, 25, 3, NULL, NULL, 1, 1, 2, NULL, NULL, 0, '2024-07-07 13:44:32'),
(11, 26, 4, '1', '', 1, 1, 2, 10, 2, 0, '2024-07-11 04:09:50'),
(12, 27, 4, '1', NULL, 3, 1, 2, 7, 2, 0, '2024-07-11 04:10:03'),
(13, 29, 3, NULL, NULL, 0, 1, 2, NULL, NULL, NULL, '2024-08-21 09:40:31'),
(14, 30, 3, NULL, NULL, 0, 1, 2, NULL, NULL, NULL, '2024-08-22 03:44:51'),
(15, 42, 4, '2', NULL, 1, 1, 2, 5, 7, 0, '2024-08-24 04:57:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblmatchpayments`
--

CREATE TABLE `tblmatchpayments` (
  `PaymentID` int(11) NOT NULL,
  `MatchID` int(11) DEFAULT NULL,
  `FieldRent` decimal(10,0) NOT NULL,
  `ServiceCharges` decimal(10,0) NOT NULL,
  `Amount` decimal(10,0) NOT NULL,
  `ExtraCharge` decimal(10,2) DEFAULT NULL,
  `TotalAmount` decimal(10,2) DEFAULT NULL,
  `Status` int(11) DEFAULT NULL,
  `CreateDate` datetime NOT NULL DEFAULT current_timestamp(),
  `UpdateDate` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblmatchpayments`
--

INSERT INTO `tblmatchpayments` (`PaymentID`, `MatchID`, `FieldRent`, `ServiceCharges`, `Amount`, `ExtraCharge`, `TotalAmount`, `Status`, `CreateDate`, `UpdateDate`) VALUES
(75, 12, 150000, 120000, 270000, 10000.00, 280000.00, 1, '2024-07-20 16:34:58', '2024-07-20 21:30:07'),
(90, 11, 150000, 150000, 300000, 2000.00, 302000.00, 1, '2024-07-23 14:24:39', '2024-07-23 14:24:39'),
(91, 15, 200000, 75000, 275000, 0.00, 275000.00, 1, '2024-08-24 14:12:48', '2024-08-24 14:12:48');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblorder`
--

CREATE TABLE `tblorder` (
  `id` int(11) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `address` text DEFAULT NULL,
  `phone` varchar(12) DEFAULT NULL,
  `order_date` date DEFAULT NULL,
  `total_price_product` decimal(10,0) DEFAULT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `promotion` decimal(10,2) DEFAULT NULL,
  `extra_charge` decimal(10,2) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_last_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblorder`
--

INSERT INTO `tblorder` (`id`, `customer_name`, `address`, `phone`, `order_date`, `total_price_product`, `total_amount`, `status`, `discount`, `promotion`, `extra_charge`, `created_by`, `created_date`, `updated_by`, `updated_last_date`) VALUES
(3, 'Oanh Đi', 'Châu Thành - Trà Vinh', '0123456789', '2024-08-02', 7900000, 5526500.00, '1', 2368500.00, 15000.00, 10000.00, NULL, '2024-08-02 14:13:29', NULL, '2024-08-02 14:13:29'),
(4, 'Hiền', 'Trà Vinh', '0123456789', '2024-08-06', 3100000, 3100000.00, '1', 0.00, 0.00, 0.00, NULL, '2024-08-06 10:53:01', NULL, '2024-08-06 10:53:01'),
(5, 'Na', 'Trà Vinh', '0123456789', '2024-08-06', 6200000, 5566500.00, '1', 618500.00, 15000.00, 0.00, NULL, '2024-08-16 10:53:34', NULL, '2024-08-06 10:55:32'),
(6, 'Oanh', 'Trà Vinh', '0123456789', '2024-08-23', 8000000, 6384000.00, '1', 1596000.00, 20000.00, 0.00, NULL, '2024-08-23 10:54:17', NULL, '2024-08-06 10:56:27'),
(7, 'Hạnh', 'Trà Vinh', '0123456789', '2024-08-09', 1600000, 1600000.00, '1', 0.00, 0.00, 0.00, NULL, '2024-08-09 11:03:39', NULL, '2024-08-06 11:04:04');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblorderdetails`
--

CREATE TABLE `tblorderdetails` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `size` varchar(10) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `total_price` decimal(10,0) NOT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_last_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblorderdetails`
--

INSERT INTO `tblorderdetails` (`id`, `order_id`, `product_id`, `size`, `quantity`, `price`, `total_price`, `created_by`, `created_date`, `updated_by`, `updated_last_date`) VALUES
(3, 3, 1, '43', 3, 1600000.00, 4800000, NULL, '2024-08-02 14:13:29', NULL, NULL),
(4, 3, 3, '43', 2, 1550000.00, 3100000, NULL, '2024-08-02 14:13:29', NULL, NULL),
(5, 4, 1, '41', 1, 1600000.00, 1600000, NULL, '2024-08-06 10:53:01', NULL, '2024-08-06 10:57:01'),
(6, 4, 2, '41', 1, 1500000.00, 1500000, NULL, '2024-08-06 10:53:01', NULL, '2024-08-06 10:57:01'),
(7, 5, 3, '42', 4, 1550000.00, 6200000, NULL, '2024-08-16 10:53:34', NULL, '2024-08-06 10:55:51'),
(8, 6, 1, '42', 5, 1600000.00, 8000000, NULL, '2024-08-23 10:54:17', NULL, '2024-08-06 10:56:40'),
(9, 7, 1, '41', 1, 1600000.00, 1600000, NULL, '2024-08-09 11:03:39', NULL, '2024-08-06 11:04:14');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblpages`
--

CREATE TABLE `tblpages` (
  `id` int(11) NOT NULL,
  `PageName` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` varchar(255) NOT NULL DEFAULT '',
  `detail` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tblpages`
--

INSERT INTO `tblpages` (`id`, `PageName`, `type`, `detail`) VALUES
(1, 'Điều Khoản Sử Dụng', 'terms', '																<div class=\"container\">\r\n        <p>Xin chào và cảm ơn bạn đã sử dụng dịch vụ của chúng tôi! Điều Khoản Sử Dụng này quy định các điều kiện và điều khoản mà bạn phải tuân thủ&nbsp;</p><p>khi truy cập và sử dụng trang web FootballTVU.com và các dịch vụ liên quan.</p>\r\n\r\n        <h4>Điều khoản chung</h4>\r\n        <p>Bằng cách truy cập hoặc sử dụng trang web của chúng tôi, bạn đồng ý tuân thủ các điều khoản và điều kiện sau đây. Nếu bạn không đồng ý với&nbsp;</p><p>bất kỳ phần nào trong các điều khoản này, xin vui lòng ngừng sử dụng trang web và các dịch vụ liên quan.</p>\r\n\r\n        <h4>Quyền sở hữu trí tuệ</h4>\r\n        <p>Các nội dung trên trang web bao gồm nhưng không giới hạn đến văn bản, đồ họa, biểu tượng, hình ảnh, video, mã nguồn và phần mềm đều thuộc quyền sở hữu trí tuệ của chúng tôi hoặc các bên sở hữu. Bạn không được sao chép, sửa đổi, phân phối hoặc tái sử dụng bất kỳ phần nào của trang web mà không có sự cho phép&nbsp;</p><p>bằng văn bản từ chúng tôi.</p>\r\n\r\n        <h4>Thay đổi dịch vụ</h4>\r\n        <p>Chúng tôi có quyền thay đổi hoặc ngừng cung cấp bất kỳ dịch vụ nào mà không cần thông báo trước. Chúng tôi không chịu trách nhiệm đối với&nbsp;</p><p>bất kỳ ai hoặc bất kỳ thực thể nào đối với bất kỳ sự thay đổi, tạm ngừng hoặc ngừng cung cấp dịch vụ nào.</p>\r\n\r\n        <h4>Bảo mật thông tin</h4>\r\n        <p>Chúng tôi cam kết bảo vệ thông tin cá nhân của bạn theo Chính sách bảo mật của chúng tôi. Bằng cách sử dụng dịch vụ của chúng tôi, bạn đồng ý rằng thông tin cá nhân của bạn có thể được thu thập và sử dụng theo Chính sách bảo mật của chúng tôi.</p>\r\n\r\n        <h4>Liên hệ chúng tôi</h4>\r\n        <p>Nếu bạn có bất kỳ câu hỏi hoặc yêu cầu nào liên quan đến Điều Khoản Sử Dụng này, vui lòng liên hệ với chúng tôi qua email support@FootballTVU.com hoặc hotline 123-456-789.</p>\r\n\r\n        <p>Chúng tôi có thể cập nhật Điều Khoản Sử Dụng này từ thời gian này sang thời gian khác để phản ánh các thay đổi trong các hoạt động của chúng tôi.</p><p>&nbsp;Mọi thay đổi sẽ được đăng tải trên trang web này.</p>\r\n    </div>\r\n														'),
(2, 'Chính Sách Bảo Mật', 'privacy', '																<div class=\"container\">\r\n        <p>Bảo vệ thông tin cá nhân của người dùng là một trong những ưu tiên hàng đầu của chúng tôi tại FootballTVU.com.&nbsp;</p><p>Chính sách bảo mật này giải thích cách chúng tôi thu thập, sử dụng, bảo vệ và tiết lộ thông tin cá nhân của bạn khi bạn sử dụng dịch vụ của chúng tôi.</p>\r\n\r\n        <h4>Thông tin chúng tôi thu thập</h4>\r\n        <p>Chúng tôi có thể thu thập các thông tin cá nhân từ bạn khi bạn đăng ký tài khoản, đặt sân bóng, hoặc liên lạc với chúng tôi qua email.&nbsp;</p><p>Các thông tin này có thể bao gồm tên, địa chỉ email, số điện thoại.</p>\r\n\r\n        <h4>Việc sử dụng thông tin</h4>\r\n        <p>Chúng tôi sử dụng thông tin cá nhân của bạn để cung cấp dịch vụ đặt sân bóng, quản lý tài khoản của bạn, xử lý thanh toán, và liên lạc với bạn về các thông tin quan trọng liên quan đến đặt sân.</p>\r\n\r\n        <h4>Bảo vệ thông tin cá nhân</h4>\r\n        <p>Chúng tôi cam kết bảo vệ thông tin cá nhân của bạn bằng cách sử dụng các biện pháp bảo mật vật lý và điện tử phù hợp.&nbsp;</p><p>Chúng tôi không bán, cho thuê hoặc chia sẻ thông tin cá nhân của bạn với bên thứ ba ngoài trừ trường hợp có yêu cầu pháp lý hoặc khi bạn đã đồng ý.</p>\r\n\r\n        <h4>Quyền lợi của bạn</h4>\r\n        <p>Bạn có quyền truy cập, sửa đổi và cập nhật thông tin cá nhân của mình bất kỳ lúc nào bằng cách đăng nhập vào tài khoản của bạn&nbsp;</p><p>trên FootballTVU.com. Bạn cũng có quyền yêu cầu xóa thông tin cá nhân của mình khỏi hệ thống của chúng tôi.</p>\r\n\r\n        <h4>Liên hệ chúng tôi</h4>\r\n        <p>Nếu bạn có bất kỳ câu hỏi nào về Chính sách bảo mật của chúng tôi, vui lòng liên hệ với chúng tôi qua email support@FootballTVU.com&nbsp;</p><p>hoặc hotline 123-456-789.</p>\r\n\r\n        <p>Chính sách bảo mật này có thể được cập nhật từ thời gian này sang thời gian khác. Mọi thay đổi sẽ được cập nhật trên trang web này.</p>\r\n    </div>\r\n														'),
(3, 'Về Với Chúng Tôi', 'aboutus', '																 <div class=\"container\">\r\n        <h4>Chào mừng bạn đến với FootballTVU.com</h4>\r\n        <p>Bạn yêu thích bóng đá và đang tìm kiếm một địa điểm lý tưởng để cùng bạn bè thỏa mãn niềm đam mê? <strong>FootballTVU.com</strong> chính là sự lựa chọn&nbsp;</p><p>hoàn hảo dành cho bạn! Chúng tôi cung cấp dịch vụ đặt sân bóng đá 5 người với hệ thống sân bãi hiện đại, trang thiết bị đầy đủ, và dịch vụ hỗ trợ tận</p><p>&nbsp;tâm.</p>\r\n        \r\n        <h4>Tại sao chọn chúng tôi?</h4>\r\n        <ul class=\"list-group list-group-flush\">\r\n            <li class=\"list-group-item\"><strong>Sân bãi chất lượng cao:</strong> Các sân bóng của chúng tôi đều đạt chuẩn, được bảo dưỡng thường xuyên để mang lại trải nghiệm chơi bóng tốt nhất&nbsp;</li><li class=\"list-group-item\">cho bạn và đội của mình.</li>\r\n            <li class=\"list-group-item\"><strong>Dễ dàng đặt sân:</strong> Hệ thống đặt sân trực tuyến tiện lợi, cho phép bạn đặt sân nhanh chóng và dễ dàng chỉ với vài cú nhấp chuột.</li>\r\n            <li class=\"list-group-item\"><strong>Dịch vụ khách hàng:</strong> Đội ngũ hỗ trợ nhiệt tình, sẵn sàng giải đáp mọi thắc mắc và giúp bạn giải quyết mọi vấn đề liên quan đến việc đặt sân.</li>\r\n            <li class=\"list-group-item\"><strong>Giá cả hợp lý:</strong> Chúng tôi cam kết mang đến cho bạn mức giá cạnh tranh nhất, phù hợp với mọi đối tượng khách hàng.</li>\r\n            <li class=\"list-group-item\"><strong>Sự kiện và giải đấu:</strong> Thường xuyên tổ chức các sự kiện, giải đấu bóng đá hấp dẫn, giúp bạn có cơ hội giao lưu, học hỏi và thể hiện tài năng.</li>\r\n        </ul>\r\n\r\n        <h4>Cách thức đặt sân</h4>\r\n        <ol class=\"list-group list-group-flush\">\r\n            <li class=\"list-group-item\"><strong>Đăng ký tài khoản:</strong> Tạo tài khoản trên <strong>FootballTVU.com</strong> để dễ dàng quản lý các lần đặt sân của bạn.</li>\r\n            <li class=\"list-group-item\"><strong>Chọn sân và thời gian:</strong> Truy cập vào mục \"Đặt sân\", chọn sân bóng và thời gian phù hợp với lịch trình của bạn.</li>\r\n            <li class=\"list-group-item\"><strong>Xác nhận và thanh toán:</strong> Kiểm tra lại thông tin đặt sân và tiến hành thanh toán qua các phương thức hỗ trợ.</li>\r\n            <li class=\"list-group-item\"><strong>Nhận xác nhận:</strong> Sau khi hoàn tất thanh toán, bạn sẽ nhận được email xác nhận đặt sân.</li>\r\n        </ol>\r\n\r\n        <h4>Liên hệ với chúng tôi</h4>\r\n        <p>Nếu bạn có bất kỳ câu hỏi hay cần hỗ trợ, đừng ngần ngại liên hệ với chúng tôi qua các kênh sau:</p>\r\n        <ul class=\"list-group list-group-flush\">\r\n            <li class=\"list-group-item\"><strong>Hotline:</strong> 123-456-789</li>\r\n            <li class=\"list-group-item\"><strong>Email:</strong> support@FootballTVU.com</li>\r\n            <li class=\"list-group-item\"><strong>Địa chỉ:</strong> Trà Vinh</li>\r\n        </ul>\r\n\r\n        <p>Hãy đến với <strong>FootballTVU.com</strong> để trải nghiệm dịch vụ đặt sân bóng đá tốt nhất và cùng chúng tôi tận hưởng những trận cầu sôi động và đầy kịch tính!</p>\r\n    </div>\r\n														'),
(11, 'Câu Hỏi Thường Gặp', 'faqs', '																																														<div class=\"container\">\r\n        <div class=\"accordion\" id=\"faqAccordion\">\r\n            <div class=\"accordion-item\">\r\n                <h3 class=\"accordion-header\" id=\"faqHeadingOne\">\r\n                    <button class=\"accordion-button collapsed\" type=\"button\" data-toggle=\"collapse\" data-target=\"#faqCollapseOne\" aria-expanded=\"false\" aria-controls=\"faqCollapseOne\">\r\n                        Câu hỏi 1: Làm thế nào để đặt sân bóng đá trên trang web của bạn?\r\n                    </button>\r\n                </h3>\r\n                <div id=\"faqCollapseOne\" class=\"collapse\" aria-labelledby=\"faqHeadingOne\" data-parent=\"#faqAccordion\" aria-expanded=\"false\" style=\"height: 0px;\">\r\n                    <div class=\"accordion-body\">\r\n                        Để đặt sân bóng đá, bạn cần đăng nhập vào tài khoản của mình, chọn sân bóng và thời gian phù hợp, sau đó tiến hành thanh toán để hoàn tất quy</div><div class=\"accordion-body\">&nbsp;trình đặt sân.\r\n                    </div>\r\n                </div>\r\n            </div>\r\n\r\n            <div class=\"accordion-item\">\r\n                <h3 class=\"accordion-header\" id=\"faqHeadingTwo\">\r\n                    <button class=\"accordion-button collapsed\" type=\"button\" data-toggle=\"collapse\" data-target=\"#faqCollapseTwo\" aria-expanded=\"false\" aria-controls=\"faqCollapseTwo\">\r\n                        Câu hỏi 2: Tôi có thể hủy đặt sân như thế nào?\r\n                    </button>\r\n                </h3>\r\n                <div id=\"faqCollapseTwo\" class=\"collapse\" aria-labelledby=\"faqHeadingTwo\" data-parent=\"#faqAccordion\" aria-expanded=\"false\" style=\"height: 0px;\">\r\n                    <div class=\"accordion-body\">\r\n                        Để hủy đặt sân, bạn cần đăng nhập vào tài khoản của mình, truy cập vào lịch sử đặt sân và chọn tùy chọn hủy bỏ. Vui lòng lưu ý thực hiện hủy đặt&nbsp;</div><div class=\"accordion-body\">sân trước thời gian quy định để nhận được hoàn trả phí một cách hợp lý.\r\n                    </div>\r\n                </div>\r\n            </div>\r\n\r\n            <div class=\"accordion-item\">\r\n                <h3 class=\"accordion-header\" id=\"faqHeadingThree\">\r\n                    <button class=\"accordion-button collapsed\" type=\"button\" data-toggle=\"collapse\" data-target=\"#faqCollapseThree\" aria-expanded=\"false\" aria-controls=\"faqCollapseThree\">\r\n                        Câu hỏi 3: Tôi có thể liên hệ với đội ngũ hỗ trợ của bạn như thế nào?\r\n                    </button>\r\n                </h3>\r\n                <div id=\"faqCollapseThree\" class=\"collapse\" aria-labelledby=\"faqHeadingThree\" data-parent=\"#faqAccordion\" aria-expanded=\"false\" style=\"height: 0px;\">\r\n                    <div class=\"accordion-body\">\r\n                        Bạn có thể liên hệ với đội ngũ hỗ trợ của chúng tôi qua hotline 123-456-789 hoặc gửi email đến địa chỉ support@FootballTVU.com.&nbsp;</div><div class=\"accordion-body\">Chúng tôi luôn sẵn sàng hỗ trợ bạn trong quá trình đặt sân và giải đáp mọi thắc mắc của bạn.\r\n                    </div>\r\n                </div>\r\n            </div>\r\n        </div>\r\n    </div>\r\n\r\n														');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblplayers`
--

CREATE TABLE `tblplayers` (
  `PlayerID` int(11) NOT NULL,
  `PlayerName` varchar(100) NOT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Position` varchar(50) DEFAULT NULL,
  `TeamID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblpositiontypes`
--

CREATE TABLE `tblpositiontypes` (
  `PositionTypeID` int(11) NOT NULL,
  `PositionName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblpositiontypes`
--

INSERT INTO `tblpositiontypes` (`PositionTypeID`, `PositionName`) VALUES
(1, 'Nhân Viên Phục Vụ'),
(2, 'Nhân Viên Thu Ngân'),
(3, 'Trọng Tài');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblposts`
--

CREATE TABLE `tblposts` (
  `id` int(11) NOT NULL,
  `PostTitle` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `SubCategoryId` int(11) DEFAULT NULL,
  `PostDetails` longtext CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL,
  `PostUrl` mediumtext DEFAULT NULL,
  `PostImage` varchar(255) DEFAULT NULL,
  `viewCounter` int(11) DEFAULT NULL,
  `postedBy` varchar(255) DEFAULT NULL,
  `lastUpdatedBy` varchar(255) DEFAULT NULL,
  `Content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Likes` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tblposts`
--

INSERT INTO `tblposts` (`id`, `PostTitle`, `CategoryId`, `SubCategoryId`, `PostDetails`, `PostingDate`, `UpdationDate`, `Is_Active`, `PostUrl`, `PostImage`, `viewCounter`, `postedBy`, `lastUpdatedBy`, `Content`, `Likes`) VALUES
(7, 'Khánh thành sân bóng đá cỏ nhân tạo và giao lưu bóng đá tại Trường Đại học Trà Vinh', 3, 4, '<p><strong>Ng&agrave;y 28/4/2023, Ban Gi&aacute;m hiệu Trường Đại học Tr&agrave; Vinh tổ chức&nbsp;</strong><strong>Lễ&nbsp;</strong><strong>kh&aacute;nh th&agrave;nh v&agrave; đưa v&agrave;o sử dụng s&acirc;n b&oacute;ng đ&aacute; cỏ nh&acirc;n tạo tại khu I, T</strong><strong>rường</strong><strong>&nbsp;Đại học Tr&agrave; Vinh. Đồng thời, diễn ra giải b&oacute;ng đ&aacute; nam ch&agrave;o mừng Kỷ niệm 48 năm ng&agrave;y Giải ph&oacute;ng miền Nam thống nhất đất nước (30/4/1975 &ndash; 30/4/2023), kỷ niệm 137 năm Ng&agrave;y Quốc tế Lao động 01/5 (01/5/1886 &ndash; 01/5/2023) v&agrave; kỷ niệm 133 năm Ng&agrave;y sinh Chủ tịch Hồ Ch&iacute; Minh (19/5/1890 &ndash; 19/5/2023) kết hợp tư vấn tuyển sinh tại trường.</strong></p>\r\n<p>Đến dự c&oacute;, &Ocirc;ng Trần Văn &Uacute;t T&aacute;m, Ph&oacute; Gi&aacute;m đốc Sở Khoa học &amp; C&ocirc;ng nghệ; &Ocirc;ng Nguyễn Văn Đ&ocirc;, Chủ tịch C&ocirc;ng đo&agrave;n Cty Nhiệt điện Duy&ecirc;n Hải v&agrave; l&atilde;nh đạo, c&aacute;n bộ vi&ecirc;n chức của hai đơn vị Sở Khoa học &amp; C&ocirc;ng nghệ v&agrave; Nh&agrave; m&aacute;y Nhiệt điện Duy&ecirc;n Hải.</p>\r\n<p>Về ph&iacute;a Trường Đại học Tr&agrave; Vinh c&oacute;, TS. Thạch Thị D&acirc;n, Ph&oacute; Hiệu trưởng Nh&agrave; trường; &Ocirc;ng Phan Mai Bạch, Ph&oacute; Gi&aacute;m đốc Trung t&acirc;m Ngoại ngữ Tin học Victory, Cố vấn học tập lớp Bồi dưỡng tiếng Khmer c&ugrave;ng với l&atilde;nh đạo c&aacute;c đơn vị, đại diện c&aacute;n bộ vi&ecirc;n chức Nh&agrave; trường v&agrave; hơn 80 vận động vi&ecirc;n tranh t&agrave;i tại giải b&oacute;ng đ&aacute; tham dự.</p>\r\n<p>Dịp n&agrave;y, tại s&acirc;n b&oacute;ng đ&aacute; cỏ nh&acirc;n tạo Trường Đại học Tr&agrave; Vinh diễn ra giải b&oacute;ng đ&aacute; nam tranh c&uacute;p TVU ch&agrave;o mừng Kỷ niệm 48 năm ng&agrave;y Giải ph&oacute;ng miền Nam thống nhất đất nước (30/4/1975 &ndash; 30/4/2023), kỷ niệm 137 năm Ng&agrave;y Quốc tế Lao động 01/5 (01/5/1886 &ndash; 01/5/2023) v&agrave; kỷ niệm 133 năm Ng&agrave;y sinh Chủ tịch Hồ Ch&iacute; Minh (19/5/1890 &ndash; 19/5/2023) với sự tham gia thi đấu của bốn đội đến từ c&aacute;c đơn vị: Trường Đại học Tr&agrave; Vinh; Sở Khoa học v&agrave; C&ocirc;ng nghệ tỉnh Tr&agrave; Vinh; C&ocirc;ng ty Nhiệt điện Thị x&atilde; Duy&ecirc;n Hải, Học vi&ecirc;n l&agrave; c&aacute;n bộ lớp bồi dưỡng tiếng Khmer.</p>\r\n<p>Kết th&uacute;c giải đấu, tại trận chung kết đội trường Đại học Tr&agrave; Vinh chiến thắng với tỷ số 1-0 đến từ pha ghi b&agrave;n của ch&acirc;n s&uacute;t Trần Nam v&agrave; gi&agrave;nh ng&ocirc;i v&ocirc; địch tại giải đấu. Về Nh&igrave; l&agrave; đội đến từ đơn vị Sở Khoa học v&agrave; C&ocirc;ng nghệ tỉnh Tr&agrave; Vinh. Đội từ hai đơn vị C&ocirc;ng ty Nhiệt điện Thị x&atilde; Duy&ecirc;n Hải, Học vi&ecirc;n l&agrave; c&aacute;n bộ lớp bồi dưỡng tiếng Khmer lần lượt gi&agrave;nh giải ba v&agrave; v&agrave; giải khuyến kh&iacute;ch của giải đấu.</p>', '2024-01-15 18:30:00', '2024-08-15 08:51:49', 1, 'Jasprit-Bumrah-ruled-out-of-England-T20I-series-due-to-injury', 'khanhthanh.jpg', 24, 'admin', NULL, '<p>Ng&agrave;y 28/4/2023, Ban Gi&aacute;m hiệu Trường Đại học Tr&agrave; Vinh tổ chức&nbsp;Lễ&nbsp;kh&aacute;nh th&agrave;nh v&agrave; đưa v&agrave;o sử dụng s&acirc;n b&oacute;ng đ&aacute; cỏ nh&acirc;n tạo tại khu I, Trường&nbsp;Đại học Tr&agrave; Vinh. Đồng thời, diễn ra giải b&oacute;ng đ&aacute; nam ch&agrave;o mừng Kỷ niệm 48 năm ng&agrave;y Giải ph&oacute;ng miền Nam thống nhất đất nước (30/4/1975 &ndash; 30/4/2023), kỷ niệm 137 năm Ng&agrave;y Quốc tế Lao động 01/5 (01/5/1886 &ndash; 01/5/2023) v&agrave; kỷ niệm 133 năm Ng&agrave;y sinh Chủ tịch Hồ Ch&iacute; Minh (19/5/1890 &ndash; 19/5/2023) kết hợp tư vấn tuyển sinh tại trường.</p>', 150),
(14, 'Tiêu đề của bài viết 1', 3, 5, '<p>Trong khi đ&oacute;, trang&nbsp;Cadena SER cho biết&nbsp;Mounir Nasraoui d&iacute;nh nhiều vết đ&acirc;m. Điều đ&oacute; khiến &ocirc;ng bị mất m&aacute;u đ&aacute;ng kể.&nbsp;</p>\r\n<p>Sự việc nghi&ecirc;m trọng n&agrave;y diễn ra khi bố&nbsp;của Yamal dắt ch&oacute; đi dạo tr&ecirc;n khu phố Rocafonda v&agrave; bị n&eacute;m chai nước v&agrave;o người.&nbsp;Mounir Nasraoui sau đấy&nbsp;c&oacute; cuộc tranh c&atilde;i gay gắt với những kẻ l&agrave;m việc đ&oacute;. Tưởng chừng mọi thứ chỉ dừng ở mức c&atilde;i nhau th&ocirc;ng thường, nhưng v&agrave;i tiếng sau đấy,&nbsp;Mounir Nasraoui bị h&agrave;nh hung bất ngờ.&nbsp;</p>\r\n<p>Cảnh s&aacute;t khu vực cũng đ&atilde; tiến h&agrave;nh bắt giữ 3 nghi phạm. Hiện họ đối mặt với tội danh cố &yacute; giết người. Cảnh s&aacute;t vẫn đang truy t&igrave;m những người kh&aacute;c c&oacute; li&ecirc;n quan tới vụ việc n&agrave;y để điều tra th&ecirc;m.&nbsp;</p>\r\n<p>Mounir Nasraoui từng g&acirc;y sốt ở EURO 2024 khi &ocirc;ng theo ch&acirc;n Yamal trong mọi trận đấu. Hiện chưa r&otilde; tuổi thực sự của&nbsp;Mounir Nasraoui, nhưng theo nhiều nguồn tin, người đ&agrave;n &ocirc;ng n&agrave;y mới chỉ 35 tuổi. Điều đ&oacute; đồng nghĩa bố&nbsp;của Yamal c&ograve;n k&eacute;m tuổi kh&ocirc;ng &iacute;t ng&ocirc;i sao của&nbsp;<a class=\"TextlinkBaiviet\" title=\"b&oacute;ng đ&aacute;\" href=\"https://www.24h.com.vn/bong-da-c48.html\">b&oacute;ng đ&aacute;</a>&nbsp;đương đại như Messi, Modric hay Ronaldo.</p>\r\n<p>Mounir Nasraoui ly h&ocirc;n vợ từ sớm. Tuy nhi&ecirc;n &ocirc;ng vẫn c&ugrave;ng vợ hỗ trợ nu&ocirc;i nấng Yamal n&ecirc;n người. Do vậy, Yamal c&oacute; mối quan hệ tốt với Mounir Nasraoui. Thậm ch&iacute; Yamal c&ograve;n mua nh&agrave; tặng cho Mounir Nasraoui khi sự nghiệp l&ecirc;n như \"diều gặp gi&oacute;\".</p>', '2024-01-15 18:30:00', '2024-08-15 07:22:46', 1, 'Jasprit-Bumrah-ruled-out-of-England-T20I-series-due-to-injury', 'sonn.jpg', 24, 'admin', NULL, 'Ngày 28/4/2023, Ban Giám hiệu Trường Đại học Trà Vinh tổ chức Lễ khánh thành và đưa vào sử dụng sân bóng đá cỏ nhân tạo tại khu I, Trường Đại học Trà Vinh', 150);
INSERT INTO `tblposts` (`id`, `PostTitle`, `CategoryId`, `SubCategoryId`, `PostDetails`, `PostingDate`, `UpdationDate`, `Is_Active`, `PostUrl`, `PostImage`, `viewCounter`, `postedBy`, `lastUpdatedBy`, `Content`, `Likes`) VALUES
(389, 'Hamas không dự vòng đàm phán then chốt về ngừng bắn ở Gaza', 6, 8, '<p class=\"description\">Hamas sẽ kh&ocirc;ng tham dự v&ograve;ng đ&aacute;m ph&aacute;n quan trọng tại Qatar về lệnh ngừng bắn ở Gaza, song c&oacute; thể sẽ gặp c&aacute;c b&ecirc;n trung gian sau đ&oacute;.</p>\r\n<article class=\"fck_detail \">\r\n<p class=\"Normal\">\"Tham gia cuộc đ&agrave;m ph&aacute;n sẽ chỉ cho ph&eacute;p lực lượng chiếm đ&oacute;ng &aacute;p đặt c&aacute;c điều kiện mới v&agrave; tiến h&agrave;nh th&ecirc;m c&aacute;c cuộc thảm s&aacute;t\", Sami Abu Zuhri, quan chức cấp cao của Hamas, n&oacute;i ng&agrave;y 14/8 khi n&ecirc;u l&yacute; do từ chối tham gia v&ograve;ng h&ograve;a đ&agrave;m mới về Gaza sẽ diễn ra ở Doha, Qatar h&ocirc;m nay.</p>\r\n<p class=\"Normal\">Mỹ v&agrave; Israel đ&atilde; x&aacute;c nhận sẽ cử đại diện tham dự cuộc đối thoại. Đ&acirc;y được coi l&agrave; \"cơ hội cuối c&ugrave;ng\" để c&aacute;c b&ecirc;n đạt được lệnh ngừng bắn, trước khi t&igrave;nh h&igrave;nh diễn biến phức tạp hơn nếu Iran tung đ&ograve;n tấn c&ocirc;ng Israel để đ&aacute;p trả vụ &aacute;m s&aacute;t thủ lĩnh Hamas tại Tehran.</p>\r\n<p class=\"Normal\">Lực lượng Hamas trước đ&oacute; b&agrave;y tỏ ho&agrave;i nghi về v&ograve;ng đ&agrave;m ph&aacute;n lần n&agrave;y, c&aacute;o buộc Israel đang t&igrave;m c&aacute;ch tr&igrave; ho&atilde;n việc thiết lập lệnh ngừng bắn. Trong khi đ&oacute;, Thủ tướng Israel Benjamin Netanyahu nhấn mạnh thủ lĩnh Hamas Yahya Sinwar l&agrave; trở ngại ch&iacute;nh khiến c&aacute;c b&ecirc;n chưa đạt được thỏa thuận.</p>\r\n<p class=\"Normal\">\"Hamas cam kết thực hiện đề xuất được đưa ra v&agrave;o ng&agrave;y 2/7, vốn dựa tr&ecirc;n nghị quyết của Hội đồng Bảo an Li&ecirc;n Hợp Quốc v&agrave; b&agrave;i ph&aacute;t biểu của &ocirc;ng Biden. Ch&uacute;ng t&ocirc;i sẵn s&agrave;ng bắt đầu thảo luận ngay lập tức về cơ chế thực hiện điều đ&oacute;\", &ocirc;ng Zuhri n&oacute;i th&ecirc;m.</p>\r\n<p class=\"Normal\">Tổng thống Mỹ Joe Biden cuối th&aacute;ng 5 c&ocirc;ng bố đề xuất gồm ba giai đoạn về ngừng giao tranh tại Gaza v&agrave; đ&atilde; được Hội đồng Bảo an Li&ecirc;n Hợp Quốc ủng hộ. Lực lượng Hamas ng&agrave;y 2/7 đưa ra phản hồi về đề xuất của &ocirc;ng Biden, song nội dung chi tiết kh&ocirc;ng được tiết lộ.</p>\r\n<p class=\"Normal\">D&ugrave; vậy, nh&oacute;m vũ trang được cho l&agrave; đ&atilde; từ bỏ y&ecirc;u cầu phải thiết lập lệnh ngừng bắn ho&agrave;n to&agrave;n ngay từ đầu, thay v&agrave;o đ&oacute; chấp nhận điều khoản tạm dừng giao tranh trong 6 tuần đầu ti&ecirc;n như thỏa thuận &ocirc;ng Biden đưa ra. Đ&agrave;m ph&aacute;n giữa c&aacute;c b&ecirc;n tiếp tục sau đ&oacute; một tuần, trong đ&oacute; Hamas c&aacute;o buộc Israel đ&atilde; đưa ra c&aacute;c điều kiện mới, theo&nbsp;<em>BBC</em>.</p>\r\n<p class=\"Normal\">Sự vắng mặt của đại diện Hamas kh&ocirc;ng đồng nghĩa cuộc đối thoại lần n&agrave;y kh&ocirc;ng c&oacute; cơ hội đạt tiến triển, do Khalil al-Hayya, trưởng nh&oacute;m đ&agrave;m ph&aacute;n của Hamas, đang cư tr&uacute; ở Doha v&agrave; vẫn duy tr&igrave; c&aacute;c k&ecirc;nh li&ecirc;n lạc với hai nước trung gian l&agrave; Ai Cập v&agrave; Qatar, theo&nbsp;<em>Reuters</em>.</p>\r\n<p class=\"Normal\">Một nguồn thạo tin cho biết nh&oacute;m vũ trang muốn c&aacute;c b&ecirc;n trung gian mang đến \"phản hồi nghi&ecirc;m t&uacute;c\" từ ph&iacute;a Israel. Nếu điều n&agrave;y xảy ra, Hamas sẽ gặp c&aacute;c b&ecirc;n trung gian sau khi cuộc đ&agrave;m ph&aacute;n ng&agrave;y 15/8 kết th&uacute;c. Một quan chức được cập nhật về qu&aacute; tr&igrave;nh đ&agrave;m ph&aacute;n cũng cho biết c&aacute;c b&ecirc;n trung gian dự kiến tham vấn với Hamas.</p>\r\n<p class=\"Normal\">Mỹ nhận định c&aacute;c cuộc đối thoại gi&aacute;n tiếp vẫn sẽ diễn ra như kế hoạch tại Doha v&agrave; c&aacute;c b&ecirc;n vẫn c&oacute; khả năng đạt được thỏa thuận. Washington cảnh b&aacute;o cần phải đạt tiến triển gấp tr&ecirc;n b&agrave;n đ&agrave;m ph&aacute;n để c&oacute; thể ngăn nguy cơ xảy ra một cuộc xung đột lớn hơn trong khu vực.</p>\r\n<p class=\"Normal\">Ba quan chức cấp cao Iran cho biết chỉ c&oacute; thỏa thuận ngừng bắn tại Gaza mới khiến nước n&agrave;y kh&ocirc;ng trả đũa trực tiếp Israel sau vụ thủ lĩnh Hamas Ismail Haniyeh bị &aacute;m s&aacute;t ngay tại thủ đ&ocirc; Tehran cuối th&aacute;ng trước. Iran c&aacute;o buộc Israel l&agrave; thủ phạm, song Tel Aviv chưa x&aacute;c nhận hay phủ nhận.</p>\r\n<p class=\"Normal\">Thỏa thuận ngừng bắn tại Gaza cũng sẽ gi&uacute;p c&aacute;c con tin Israel đang bị giam ở dải dất được trả tự do, để đổi lấy c&aacute;c t&ugrave; nh&acirc;n Palestine hiện bị Tel Aviv giữ. D&ugrave; vậy, Israel v&agrave; Hamas đang bất đồng về tr&igrave;nh tự thực hiện thỏa thuận v&agrave; c&aacute;c vấn đề kh&aacute;c.</p>\r\n<p class=\"Normal\">Thủ tướng Netanyahu nhấn mạnh Israel cần phải tiếp tục kiểm so&aacute;t khu vực bi&ecirc;n giới giữa Gaza v&agrave; Ai Cập để ngăn chặn hoạt động bu&ocirc;n lậu vũ kh&iacute; v&agrave;o v&ugrave;ng l&atilde;nh thổ, d&ugrave; tham mưu trưởng qu&acirc;n đội Israel Herzi Halevi cho rằng Tel Aviv c&oacute; thể gi&aacute;m s&aacute;t khu vực n&agrave;y từ xa nếu cần thiết.</p>\r\n<p class=\"Normal\">Ngo&agrave;i ra, c&aacute;c b&ecirc;n cũng bất đồng về vấn đề cho ph&eacute;p người d&acirc;n b&ecirc;n trong Gaza di chuyển tự do giữa c&aacute;c khu vực ở dải đất sau khi đạt được thỏa thuận ngừng bắn.</p>\r\n<p class=\"Normal\"><img src=\"data:image/jpeg;base64,/9j/4AAQSkZJRgABAQEASABIAAD/7R+sUGhvdG9zaG9wIDMuMAA4QklNBCUAAAAAABAAAAAAAAAAAAAAAAAAAAAAOEJJTQQ6AAAAAADlAAAAEAAAAAEAAAAAAAtwcmludE91dHB1dAAAAAUAAAAAUHN0U2Jvb2wBAAAAAEludGVlbnVtAAAAAEludGUAAAAAQ2xybQAAAA9wcmludFNpeHRlZW5CaXRib29sAAAAAAtwcmludGVyTmFtZVRFWFQAAAABAAAAAAAPcHJpbnRQcm9vZlNldHVwT2JqYwAAAAwAUAByAG8AbwBmACAAUwBlAHQAdQBwAAAAAAAKcHJvb2ZTZXR1cAAAAAEAAAAAQmx0bmVudW0AAAAMYnVpbHRpblByb29mAAAACXByb29mQ01ZSwA4QklNBDsAAAAAAi0AAAAQAAAAAQAAAAAAEnByaW50T3V0cHV0T3B0aW9ucwAAABcAAAAAQ3B0bmJvb2wAAAAAAENsYnJib29sAAAAAABSZ3NNYm9vbAAAAAAAQ3JuQ2Jvb2wAAAAAAENudENib29sAAAAAABMYmxzYm9vbAAAAAAATmd0dmJvb2wAAAAAAEVtbERib29sAAAAAABJbnRyYm9vbAAAAAAAQmNrZ09iamMAAAABAAAAAAAAUkdCQwAAAAMAAAAAUmQgIGRvdWJAb+AAAAAAAAAAAABHcm4gZG91YkBv4AAAAAAAAAAAAEJsICBkb3ViQG/gAAAAAAAAAAAAQnJkVFVudEYjUmx0AAAAAAAAAAAAAAAAQmxkIFVudEYjUmx0AAAAAAAAAAAAAAAAUnNsdFVudEYjUHhsQFIAAAAAAAAAAAAKdmVjdG9yRGF0YWJvb2wBAAAAAFBnUHNlbnVtAAAAAFBnUHMAAAAAUGdQQwAAAABMZWZ0VW50RiNSbHQAAAAAAAAAAAAAAABUb3AgVW50RiNSbHQAAAAAAAAAAAAAAABTY2wgVW50RiNQcmNAWQAAAAAAAAAAABBjcm9wV2hlblByaW50aW5nYm9vbAAAAAAOY3JvcFJlY3RCb3R0b21sb25nAAAAAAAAAAxjcm9wUmVjdExlZnRsb25nAAAAAAAAAA1jcm9wUmVjdFJpZ2h0bG9uZwAAAAAAAAALY3JvcFJlY3RUb3Bsb25nAAAAAAA4QklNA+0AAAAAABAASAAAAAEAAQBIAAAAAQABOEJJTQQmAAAAAAAOAAAAAAAAAAAAAD+AAAA4QklNBA0AAAAAAAQAAABaOEJJTQQZAAAAAAAEAAAAHjhCSU0D8wAAAAAACQAAAAAAAAAAAQA4QklNJxAAAAAAAAoAAQAAAAAAAAABOEJJTQP1AAAAAABIAC9mZgABAGxmZgAGAAAAAAABAC9mZgABAKGZmgAGAAAAAAABADIAAAABAFoAAAAGAAAAAAABADUAAAABAC0AAAAGAAAAAAABOEJJTQP4AAAAAABwAAD/////////////////////////////A+gAAAAA/////////////////////////////wPoAAAAAP////////////////////////////8D6AAAAAD/////////////////////////////A+gAADhCSU0EAAAAAAAAAgACOEJJTQQCAAAAAAAGAAAAAAAAOEJJTQQwAAAAAAADAQEBADhCSU0ELQAAAAAABgABAAAAAzhCSU0ECAAAAAAAEAAAAAEAAAJAAAACQAAAAAA4QklNBEQAAAAAABAAAAACAAACQAAAAkAAAAAAOEJJTQQeAAAAAAAEAAAAADhCSU0EGgAAAAADSQAAAAYAAAAAAAAAAAAABGAAAASwAAAACgBVAG4AdABpAHQAbABlAGQALQA1AAAAAQAAAAAAAAAAAAAAAAAAAAAAAAABAAAAAAAAAAAAAASwAAAEYAAAAAAAAAAAAAAAAAAAAAABAAAAAAAAAAAAAAAAAAAAAAAAABAAAAABAAAAAAAAbnVsbAAAAAIAAAAGYm91bmRzT2JqYwAAAAEAAAAAAABSY3QxAAAABAAAAABUb3AgbG9uZwAAAAAAAAAATGVmdGxvbmcAAAAAAAAAAEJ0b21sb25nAAAEYAAAAABSZ2h0bG9uZwAABLAAAAAGc2xpY2VzVmxMcwAAAAFPYmpjAAAAAQAAAAAABXNsaWNlAAAAEgAAAAdzbGljZUlEbG9uZwAAAAAAAAAHZ3JvdXBJRGxvbmcAAAAAAAAABm9yaWdpbmVudW0AAAAMRVNsaWNlT3JpZ2luAAAADWF1dG9HZW5lcmF0ZWQAAAAAVHlwZWVudW0AAAAKRVNsaWNlVHlwZQAAAABJbWcgAAAABmJvdW5kc09iamMAAAABAAAAAAAAUmN0MQAAAAQAAAAAVG9w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cmRmLXN5bnRheC1ucyMiPiA8cmRmOkRlc2NyaXB0aW9uIHJkZjphYm91dD0iIiB4bWxuczp4bXA9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdEV2dD0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlRXZlbnQjIiB4bWxuczpwaG90b3Nob3A9Imh0dHA6Ly9ucy5hZG9iZS5jb20vcGhvdG9zaG9wLzEuMC8iIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgeG1wOkNyZWF0b3JUb29sPSJBZG9iZSBQaG90b3Nob3AgMjQuMCAoV2luZG93cykiIHhtcDpDcmVhdGVEYXRlPSIyMDI0LTA1LTA3VDE0OjI4OjUwKzA3OjAwIiB4bXA6TWV0YWRhdGFEYXRlPSIyMDI0LTA1LTA3VDE0OjI4OjUwKzA3OjAwIiB4bXA6TW9kaWZ5RGF0ZT0iMjAyNC0wNS0wN1QxNDoyODo1MCswNzowMCIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo0NGU4YjhiOS0zNmFlLWMxNDktYTNlNy1jNmRlYWQwNTM3ZWMiIHhtcE1NOkRvY3VtZW50SUQ9ImFkb2JlOmRvY2lkOnBob3Rvc2hvcDpiYzcyZGIzZC0wMTI5LWMyNGItOGM5NC1kMzVmMzk4NGE0ZTUiIHhtcE1NOk9yaWdpbmFsRG9jdW1lbnRJRD0ieG1wLmRpZDplMDhkY2Y0OC03MGJmLTg2NGUtYjkxMS01OTZjNWQ0ODU2NDMiIHBob3Rvc2hvcDpDb2xvck1vZGU9IjMiIGRjOmZvcm1hdD0iaW1hZ2UvanBlZyI+IDx4bXBNTTpIaXN0b3J5PiA8cmRmOlNlcT4gPHJkZjpsaSBzdEV2dDphY3Rpb249ImNyZWF0ZWQiIHN0RXZ0Omluc3RhbmNlSUQ9InhtcC5paWQ6ZTA4ZGNmNDgtNzBiZi04NjRlLWI5MTEtNTk2YzVkNDg1NjQzIiBzdEV2dDp3aGVuPSIyMDI0LTA1LTA3VDE0OjI4OjUwKzA3OjAwIiBzdEV2dDpzb2Z0d2FyZUFnZW50PSJBZG9iZSBQaG90b3Nob3AgMjQuMCAoV2luZG93cykiLz4gPHJkZjpsaSBzdEV2dDphY3Rpb249InNhdmVkIiBzdEV2dDppbnN0YW5jZUlEPSJ4bXAuaWlkOjQ0ZThiOGI5LTM2YWUtYzE0OS1hM2U3LWM2ZGVhZDA1MzdlYyIgc3RFdnQ6d2hlbj0iMjAyNC0wNS0wN1QxNDoyODo1MCswNzowMCIgc3RFdnQ6c29mdHdhcmVBZ2VudD0iQWRvYmUgUGhvdG9zaG9wIDI0LjAgKFdpbmRvd3MpIiBzdEV2dDpjaGFuZ2VkPSIvIi8+IDwvcmRmOlNlcT4gPC94bXBNTTpIaXN0b3J5PiA8cGhvdG9zaG9wOlRleHRMYXllcnM+IDxyZGY6QmFnPiA8cmRmOmxpIHBob3Rvc2hvcDpMYXllck5hbWU9IkPhu61hIGto4bqpdSBSYWZhaCIgcGhvdG9zaG9wOkxheWVyVGV4dD0iQ+G7rWEga2jhuql1IFJhZmFoIi8+IDwvcmRmOkJhZz4gPC9waG90b3Nob3A6VGV4dExheWVycz4gPC9yZGY6RGVzY3JpcHRpb24+IDwvcmRmOlJERj4gPC94OnhtcG1ldGE+ICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgPD94cGFja2V0IGVuZD0idyI/Pv/bAEMAAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAQEBAgIBAQIBAQECAgICAgICAgIBAgICAgICAgICAv/bAEMBAQEBAQEBAQEBAQIBAQECAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAv/CABEIAnoC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\"></p>\r\n</article>', '2024-08-14 17:00:00', NULL, 1, NULL, 'Gaza-9018-1723697634.png', NULL, NULL, NULL, '', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblproductcategory`
--

CREATE TABLE `tblproductcategory` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_last_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblproductcategory`
--

INSERT INTO `tblproductcategory` (`id`, `name`, `description`, `created_by`, `created_date`, `updated_by`, `updated_last_date`) VALUES
(1, 'Phụ kiện Bóng Đá', '', NULL, '2024-07-23 16:07:35', NULL, '2024-07-24 15:31:58'),
(2, 'Phụ kiện Cầu Lông', '', NULL, '2024-07-24 13:25:36', NULL, '2024-07-24 15:31:48'),
(3, 'Phụ Kiện Bóng Rổ', '', NULL, '2024-07-24 15:31:31', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblproducts`
--

CREATE TABLE `tblproducts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `quantity` blob DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `image_url` varchar(255) DEFAULT NULL,
  `created_by` varchar(100) DEFAULT NULL,
  `created_date` datetime DEFAULT current_timestamp(),
  `updated_by` varchar(100) DEFAULT NULL,
  `updated_last_date` datetime DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblproducts`
--

INSERT INTO `tblproducts` (`id`, `name`, `description`, `price`, `quantity`, `category_id`, `image_url`, `created_by`, `created_date`, `updated_by`, `updated_last_date`) VALUES
(1, 'Giày đá banh Nike M2', 'Size 39, 40, 41, 42, 43, 44', 1600000.00, NULL, 1, 'giaynk1.png', NULL, '2024-07-23 16:08:33', NULL, '2024-07-24 14:51:06'),
(2, 'Giày đá banh Nike ', 'Size 39, 40, 41, 42, 43, 44', 1500000.00, NULL, 1, 'giaynk2.png', NULL, '2024-07-24 13:54:41', NULL, '2024-07-24 14:50:29'),
(3, 'Giày đá banh Nike Sport N1', 'Size 39, 40, 41, 42, 43, 44', 1550000.00, NULL, 1, 'giaynk3.png', NULL, '2024-07-24 13:59:30', NULL, '2024-07-24 14:51:37');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblrejectmatch`
--

CREATE TABLE `tblrejectmatch` (
  `rejectid` int(11) NOT NULL,
  `BookingID` int(11) NOT NULL,
  `HomeTeam` int(11) NOT NULL,
  `AwayTeam` int(11) NOT NULL,
  `idfm` int(11) NOT NULL,
  `BookingDate` date NOT NULL,
  `Status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblrejectmatch`
--

INSERT INTO `tblrejectmatch` (`rejectid`, `BookingID`, `HomeTeam`, `AwayTeam`, `idfm`, `BookingDate`, `Status`) VALUES
(1, 23, 2, 1, 17, '2024-07-05', 0),
(2, 29, 1, 2, 2, '2024-08-21', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblsubcategory`
--

CREATE TABLE `tblsubcategory` (
  `SubCategoryId` int(11) NOT NULL,
  `CategoryId` int(11) DEFAULT NULL,
  `Subcategory` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `SubCatDescription` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `Is_Active` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tblsubcategory`
--

INSERT INTO `tblsubcategory` (`SubCategoryId`, `CategoryId`, `Subcategory`, `SubCatDescription`, `PostingDate`, `UpdationDate`, `Is_Active`) VALUES
(3, 5, 'Bollywood ', 'Bollywood masala', '2024-01-14 18:30:00', '2024-01-31 05:48:30', 1),
(4, 3, 'Bóng gậy', 'Bóng gậy\r\n', '2024-01-14 18:30:00', '2024-06-23 13:42:10', 1),
(5, 3, 'Bóng đá', 'Bóng đá', '2024-01-14 18:30:00', '2024-06-23 13:42:10', 1),
(6, 5, 'Truyền hình', 'Truyền hình', '2024-01-14 18:30:00', '2024-06-23 13:42:10', 1),
(7, 6, 'Trong nước', 'Trong nước', '2024-01-14 18:30:00', '2024-06-23 13:42:10', 1),
(8, 6, 'Quốc tế', 'Quốc tế', '2024-01-14 18:30:00', '2024-06-23 13:42:10', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblsubscribers`
--

CREATE TABLE `tblsubscribers` (
  `id` int(11) NOT NULL,
  `SubscriberEmail` varchar(120) DEFAULT NULL,
  `PostingDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tblsubscribers`
--

INSERT INTO `tblsubscribers` (`id`, `SubscriberEmail`, `PostingDate`) VALUES
(4, 'harish@gmail.com', '2024-06-01 09:26:21'),
(5, 'kunal@gmail.com', '2024-05-31 09:35:07'),
(6, 'sdfsdf@gmail.com', '2024-06-22 15:04:17');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblteams`
--

CREATE TABLE `tblteams` (
  `TeamID` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `TeamName` varchar(100) NOT NULL,
  `Country` varchar(50) DEFAULT NULL,
  `Rank` int(11) DEFAULT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `Phone` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `MemberCount` int(11) DEFAULT NULL,
  `FlagImage` varchar(100) DEFAULT NULL,
  `FlagName` varchar(100) DEFAULT NULL,
  `GroupTeam` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblteams`
--

INSERT INTO `tblteams` (`TeamID`, `CustomerID`, `TeamName`, `Country`, `Rank`, `Address`, `Phone`, `Email`, `MemberCount`, `FlagImage`, `FlagName`, `GroupTeam`) VALUES
(1, 1, 'Hiền Michael', NULL, 3, '', NULL, NULL, NULL, 'https://world-cup.codsfli.com/flag/ENG.png', 'England', NULL),
(2, 2, 'Ngọc Ly Trà On', 'VN', 2, 'Càng Long - Trà Vinh', '0123456789', NULL, 10, 'https://world-cup.codsfli.com/flag/QAT.png', 'Qatar', NULL),
(3, 3, 'Real Madrid', 'Real', 5, 'Real ', '0123456789', 'thanhhien.thach2019@gmail.com', 10, 'https://world-cup.codsfli.com/flag/SEN.png', 'Senegal', NULL),
(5, 10, 'Ngọc Ly', NULL, NULL, 'Trà On', '0123456789', 'ngocly@gmail.com', 10, 'https://world-cup.codsfli.com/flag/POR.png', 'Portugal', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltestimonial`
--

CREATE TABLE `tbltestimonial` (
  `id` int(11) NOT NULL,
  `UserEmail` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Testimonial` mediumtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `PostingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tbltestimonial`
--

INSERT INTO `tbltestimonial` (`id`, `UserEmail`, `Testimonial`, `PostingDate`, `status`) VALUES
(1, 'thanhhien.thach2019@gmail.com', 'Thạch Thanh Hiền - Cựu Sinh Viên', '2024-06-22 15:16:22', 1),
(2, 'OanhDi@gmail.com', 'Oanh Đi - Sinh Viên Khoa KTCN', '2024-06-22 15:16:22', 1),
(3, 'haduykien@gmail.com', 'Hà Duy Kiên - Cựu Sinh Viên', '2024-06-22 15:17:38', 1),
(4, 'thanhhien.thach2019@gmail.com', 'Test ', '2024-06-23 07:50:06', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbltimematch`
--

CREATE TABLE `tbltimematch` (
  `idtm` int(11) NOT NULL,
  `NameMatch` varchar(50) NOT NULL,
  `StartTime` time NOT NULL,
  `EndTime` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tbltimematch`
--

INSERT INTO `tbltimematch` (`idtm`, `NameMatch`, `StartTime`, `EndTime`) VALUES
(1, '7 Giờ', '07:00:00', '07:59:59'),
(2, '8 Giờ', '08:00:00', '08:59:59'),
(3, '9 Giờ', '09:00:00', '09:59:59'),
(4, '10 Giờ', '10:00:00', '10:59:59'),
(5, '11 Giờ ', '11:00:00', '11:59:59'),
(6, '12 Giờ ', '12:00:00', '12:59:59'),
(7, '13 Giờ', '13:00:00', '13:59:59'),
(8, '14 Giờ', '14:00:00', '14:59:59'),
(9, '15 Giờ', '15:00:00', '15:59:59'),
(10, '16 Giờ', '16:00:00', '16:59:00'),
(11, '17 Giờ', '17:00:00', '17:59:59'),
(12, '18 Giờ', '18:00:00', '18:59:59'),
(13, '19 Giờ', '19:00:00', '19:59:59'),
(14, '20 Giờ', '20:00:00', '20:59:59'),
(15, '21 Giờ', '21:00:00', '21:59:59');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblusers`
--

CREATE TABLE `tblusers` (
  `id` int(11) NOT NULL,
  `CustomerID` int(11) NOT NULL,
  `FullName` varchar(120) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `EmailId` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Password` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `ContactNo` char(11) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` varchar(100) CHARACTER SET utf16 COLLATE utf16_unicode_ci DEFAULT NULL,
  `Address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `City` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `Country` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp(),
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Đang đổ dữ liệu cho bảng `tblusers`
--

INSERT INTO `tblusers` (`id`, `CustomerID`, `FullName`, `EmailId`, `Password`, `ContactNo`, `dob`, `Address`, `City`, `Country`, `RegDate`, `UpdationDate`) VALUES
(1, 0, 'Test', 'test@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '6465465465', '', 'L-890, Gaur City Ghaziabad', 'Ghaziabad', 'India', '2024-05-01 14:00:49', '2024-06-05 05:27:37'),
(2, 1, 'MrHien', 'thanhhien.thach2019@gmail.com', '202cb962ac59075b964b07152d234b70', '1425365214', NULL, 'Chau Thanh - Tra Vinh', NULL, 'VN', '2024-06-05 05:31:05', '2024-07-09 05:39:36'),
(3, 2, 'Oanh Đi', 'OanhDi@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456789', '01/01/2002', 'Chau Thanh - Tra Vinh', NULL, 'VN', '2024-06-22 15:19:39', NULL),
(4, 3, 'Cristiano Ronaldo', 'ronaldo@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '123456789', '01/01/1985', '', NULL, 'Bồ Đào Nha', '2024-06-22 15:19:39', NULL),
(7, 10, 'Ngọc Ly', 'ngocly@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0123456789', NULL, NULL, NULL, NULL, '2024-07-08 15:23:08', NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tblwarehouses`
--

CREATE TABLE `tblwarehouses` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `location` varchar(255) NOT NULL,
  `create_by` varchar(50) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT current_timestamp(),
  `last_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `tblwarehouses`
--

INSERT INTO `tblwarehouses` (`id`, `name`, `location`, `create_by`, `create_date`, `last_update`) VALUES
(1, 'Kho Cơ Sở Vật Chất Khu I', 'Trường ĐHTV Khu 1', '', '2024-07-22 14:20:04', NULL);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblbanners`
--
ALTER TABLE `tblbanners`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblbookings`
--
ALTER TABLE `tblbookings`
  ADD PRIMARY KEY (`BookingID`),
  ADD KEY `CustomerID` (`CustomerID`);

--
-- Chỉ mục cho bảng `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblcontactusinfo`
--
ALTER TABLE `tblcontactusinfo`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblcountryalpha`
--
ALTER TABLE `tblcountryalpha`
  ADD PRIMARY KEY (`ID`);

--
-- Chỉ mục cho bảng `tblcustomers`
--
ALTER TABLE `tblcustomers`
  ADD PRIMARY KEY (`CustomerID`);

--
-- Chỉ mục cho bảng `tblcustomertype`
--
ALTER TABLE `tblcustomertype`
  ADD PRIMARY KEY (`CustomerTypeID`);

--
-- Chỉ mục cho bảng `tbldiscount`
--
ALTER TABLE `tbldiscount`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbldrink`
--
ALTER TABLE `tbldrink`
  ADD PRIMARY KEY (`DrinkID`);

--
-- Chỉ mục cho bảng `tbldrinkorder`
--
ALTER TABLE `tbldrinkorder`
  ADD PRIMARY KEY (`DrinkOrderID`);

--
-- Chỉ mục cho bảng `tbldrinkorderline`
--
ALTER TABLE `tbldrinkorderline`
  ADD PRIMARY KEY (`DrinkOrderLineID`);

--
-- Chỉ mục cho bảng `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD KEY `PositionTypeID` (`PositionTypeID`);

--
-- Chỉ mục cho bảng `tblfacility_inventory`
--
ALTER TABLE `tblfacility_inventory`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblfacility_status`
--
ALTER TABLE `tblfacility_status`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblfacility_types`
--
ALTER TABLE `tblfacility_types`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblfieldmatch`
--
ALTER TABLE `tblfieldmatch`
  ADD PRIMARY KEY (`idfm`);

--
-- Chỉ mục cho bảng `tblfields`
--
ALTER TABLE `tblfields`
  ADD PRIMARY KEY (`FieldID`),
  ADD KEY `FieldTypeID` (`FieldTypeID`);

--
-- Chỉ mục cho bảng `tblfieldtypes`
--
ALTER TABLE `tblfieldtypes`
  ADD PRIMARY KEY (`FieldTypeID`);

--
-- Chỉ mục cho bảng `tblmatches`
--
ALTER TABLE `tblmatches`
  ADD PRIMARY KEY (`MatchID`);

--
-- Chỉ mục cho bảng `tblmatchpayments`
--
ALTER TABLE `tblmatchpayments`
  ADD PRIMARY KEY (`PaymentID`),
  ADD KEY `MatchID` (`MatchID`);

--
-- Chỉ mục cho bảng `tblorder`
--
ALTER TABLE `tblorder`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblorderdetails`
--
ALTER TABLE `tblorderdetails`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblpages`
--
ALTER TABLE `tblpages`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblplayers`
--
ALTER TABLE `tblplayers`
  ADD PRIMARY KEY (`PlayerID`),
  ADD KEY `TeamID` (`TeamID`);

--
-- Chỉ mục cho bảng `tblpositiontypes`
--
ALTER TABLE `tblpositiontypes`
  ADD PRIMARY KEY (`PositionTypeID`);

--
-- Chỉ mục cho bảng `tblposts`
--
ALTER TABLE `tblposts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `postcatid` (`CategoryId`),
  ADD KEY `postsucatid` (`SubCategoryId`),
  ADD KEY `subadmin` (`postedBy`);

--
-- Chỉ mục cho bảng `tblproductcategory`
--
ALTER TABLE `tblproductcategory`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Chỉ mục cho bảng `tblproducts`
--
ALTER TABLE `tblproducts`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblrejectmatch`
--
ALTER TABLE `tblrejectmatch`
  ADD PRIMARY KEY (`rejectid`);

--
-- Chỉ mục cho bảng `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  ADD PRIMARY KEY (`SubCategoryId`),
  ADD KEY `catid` (`CategoryId`);

--
-- Chỉ mục cho bảng `tblsubscribers`
--
ALTER TABLE `tblsubscribers`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tblteams`
--
ALTER TABLE `tblteams`
  ADD PRIMARY KEY (`TeamID`);

--
-- Chỉ mục cho bảng `tbltestimonial`
--
ALTER TABLE `tbltestimonial`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `tbltimematch`
--
ALTER TABLE `tbltimematch`
  ADD PRIMARY KEY (`idtm`);

--
-- Chỉ mục cho bảng `tblusers`
--
ALTER TABLE `tblusers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `EmailId` (`EmailId`);

--
-- Chỉ mục cho bảng `tblwarehouses`
--
ALTER TABLE `tblwarehouses`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tblbanners`
--
ALTER TABLE `tblbanners`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `tblbookings`
--
ALTER TABLE `tblbookings`
  MODIFY `BookingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT cho bảng `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `tblcontactusinfo`
--
ALTER TABLE `tblcontactusinfo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tblcontactusquery`
--
ALTER TABLE `tblcontactusquery`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tblcountryalpha`
--
ALTER TABLE `tblcountryalpha`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=581;

--
-- AUTO_INCREMENT cho bảng `tblcustomers`
--
ALTER TABLE `tblcustomers`
  MODIFY `CustomerID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tblcustomertype`
--
ALTER TABLE `tblcustomertype`
  MODIFY `CustomerTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tbldiscount`
--
ALTER TABLE `tbldiscount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT cho bảng `tbldrink`
--
ALTER TABLE `tbldrink`
  MODIFY `DrinkID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbldrinkorder`
--
ALTER TABLE `tbldrinkorder`
  MODIFY `DrinkOrderID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT cho bảng `tbldrinkorderline`
--
ALTER TABLE `tbldrinkorderline`
  MODIFY `DrinkOrderLineID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT cho bảng `tblemployees`
--
ALTER TABLE `tblemployees`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tblfacility_inventory`
--
ALTER TABLE `tblfacility_inventory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tblfacility_status`
--
ALTER TABLE `tblfacility_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tblfacility_types`
--
ALTER TABLE `tblfacility_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tblfieldmatch`
--
ALTER TABLE `tblfieldmatch`
  MODIFY `idfm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT cho bảng `tblfields`
--
ALTER TABLE `tblfields`
  MODIFY `FieldID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tblfieldtypes`
--
ALTER TABLE `tblfieldtypes`
  MODIFY `FieldTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tblmatches`
--
ALTER TABLE `tblmatches`
  MODIFY `MatchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `tblmatchpayments`
--
ALTER TABLE `tblmatchpayments`
  MODIFY `PaymentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT cho bảng `tblorder`
--
ALTER TABLE `tblorder`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tblorderdetails`
--
ALTER TABLE `tblorderdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `tblpages`
--
ALTER TABLE `tblpages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `tblpositiontypes`
--
ALTER TABLE `tblpositiontypes`
  MODIFY `PositionTypeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `tblposts`
--
ALTER TABLE `tblposts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=392;

--
-- AUTO_INCREMENT cho bảng `tblproductcategory`
--
ALTER TABLE `tblproductcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tblproducts`
--
ALTER TABLE `tblproducts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tblrejectmatch`
--
ALTER TABLE `tblrejectmatch`
  MODIFY `rejectid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `tblsubcategory`
--
ALTER TABLE `tblsubcategory`
  MODIFY `SubCategoryId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `tblsubscribers`
--
ALTER TABLE `tblsubscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT cho bảng `tblteams`
--
ALTER TABLE `tblteams`
  MODIFY `TeamID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `tbltestimonial`
--
ALTER TABLE `tbltestimonial`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbltimematch`
--
ALTER TABLE `tbltimematch`
  MODIFY `idtm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT cho bảng `tblusers`
--
ALTER TABLE `tblusers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `tblwarehouses`
--
ALTER TABLE `tblwarehouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tblbookings`
--
ALTER TABLE `tblbookings`
  ADD CONSTRAINT `tblbookings_ibfk_1` FOREIGN KEY (`CustomerID`) REFERENCES `tblcustomers` (`CustomerID`);

--
-- Các ràng buộc cho bảng `tblemployees`
--
ALTER TABLE `tblemployees`
  ADD CONSTRAINT `tblemployees_ibfk_1` FOREIGN KEY (`PositionTypeID`) REFERENCES `tblpositiontypes` (`PositionTypeID`);

--
-- Các ràng buộc cho bảng `tblfields`
--
ALTER TABLE `tblfields`
  ADD CONSTRAINT `tblfields_ibfk_1` FOREIGN KEY (`FieldTypeID`) REFERENCES `tblfieldtypes` (`FieldTypeID`);

--
-- Các ràng buộc cho bảng `tblmatchpayments`
--
ALTER TABLE `tblmatchpayments`
  ADD CONSTRAINT `tblmatchpayments_ibfk_1` FOREIGN KEY (`MatchID`) REFERENCES `tblmatches` (`MatchID`);

--
-- Các ràng buộc cho bảng `tblplayers`
--
ALTER TABLE `tblplayers`
  ADD CONSTRAINT `tblplayers_ibfk_1` FOREIGN KEY (`TeamID`) REFERENCES `tblteams` (`TeamID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
