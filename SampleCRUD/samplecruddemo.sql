SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

DROP TABLE IF EXISTS `samplecruddemo`;
CREATE TABLE `User` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `gender` varchar(100) NOT NULL,
  `emailaddress` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

BEGIN;
INSERT INTO `User` VALUES 
	('1', 'Jason', 'Lam', 'Male', 'jasonlam13513@gmail.com'), 
	('2', 'Reese', 'Dela Cruz', 'Male', 'reesedlacruz@gmail.com');
COMMIT;