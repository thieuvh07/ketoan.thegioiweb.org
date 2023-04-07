

CREATE TABLE `color` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `keyword` varchar(255) NOT NULL,
  `color` varchar(11) NOT NULL,
  `catalogueid` int(11) NOT NULL,
  `order` int(11) NOT NULL,
  `trash` tinyint(4) NOT NULL,
  `userid_created` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `userid_updated` int(11) NOT NULL,
  `updated` datetime NOT NULL,
  `companyid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;


INSERT INTO color VALUES
("1","Màu đen","mau-den","#8d5e5e","1","0","0","3","2019-08-24 00:30:03","0","0000-00-00 00:00:00","1"),
("2","Màu đỏ","mau-do","#a40000","1","0","0","3","2019-08-24 00:30:58","3","2019-08-26 22:04:53","1"),
("3","Màu vàng","mau-vang","#f3f428","1","0","0","3","2019-08-24 00:31:23","3","2019-08-26 21:31:57","1"),
("4","màu đen1","mau-den1","#000000","1","0","1","3","2019-08-26 21:17:52","3","2019-08-26 21:28:02","1"),
("5","màu đen11","mau-den11","#6e0000","1","0","1","3","2019-08-26 21:19:24","3","2019-08-26 21:27:59","1"),
("6","màu đen11à","mau-den11a","","1","0","1","3","2019-08-26 21:21:00","3","2019-08-26 21:27:55","1"),
("7","màu đen11à1","mau-den11a1","","1","0","1","3","2019-08-26 21:24:14","3","2019-08-26 21:27:52","1");


