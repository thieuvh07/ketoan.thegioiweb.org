

CREATE TABLE `color_catalogue` (
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


INSERT INTO color_catalogue VALUES
("1","Module khách hàng","module-khach-hang","0","1","4","5","0","0","2019-08-23 23:54:05","2019-08-24 01:01:35","3","3","1"),
("2","adsf","adsf","1","2","5","6","0","1","2019-08-23 23:55:28","2019-08-23 23:59:10","3","3","1"),
("3","adsfads","adsfads","1","2","3","4","0","1","2019-08-24 00:01:28","2019-08-24 01:01:21","3","3","1"),
("4","nhóm màu thời gian","nhom-mau-thoi-gian","0","1","2","3","0","0","2019-08-24 01:02:06","0000-00-00 00:00:00","3","0","1");


