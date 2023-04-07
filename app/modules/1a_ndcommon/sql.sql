-- data từ điển Họ tên VN: https://github.com/duyetdev/vietnamese-namedb?fbclid=IwAR1_f2m8HfzUScqm_S3t2tK4ABXhnmIvdubzPDTheIadtd2vzv_yCimK27Q

-- Dùng MyISAM với những thằng có tần suất đọc cao như 24h, vnexpress, blog, ...
-- Dùng InnoDB với những thằng hay động vào DB như Diễn đàn, Mạng xã hội, ...
-- Dùng MEMORY cho các table chứa dữ liệu tạm và thông tin phiên làm việc của người dùng (Session
CREATE TABLE `module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `catalogueid` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `trash` tinyint(4) NOT NULL,
  `userid_created` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `userid_updated` int(11) NOT NULL,
  `updated` datetime NOT NULL,
  `companyid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `module_catalogue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keyword` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parentid` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `trash` tinyint(1) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `userid_created` int(11) NOT NULL,
  `userid_updated` int(11) NOT NULL,
  `companyid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

