CREATE TABLE `photogallary` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `imageurl` varchar(255) NOT NULL,
  `thumburl` varchar(255) NOT NULL,
  `width` smallint NOT NULL,
  `height` smallint NOT NULL,
  PRIMARY KEY (`id`)
);