TABLES:

CREATE TABLE IF NOT EXISTS system (
	systemid TINYINT(3) UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
	system VARCHAR(50) NOT NULL UNIQUE KEY, 					 	 
	active TINYINT(1) UNSIGNED DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS game (
	gameid INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,	
	game VARCHAR(12) NOT NULL UNIQUE KEY,
	systemid TINYINT(3) UNSIGNED DEFAULT NULL,
	FOREIGN KEY (systemid) REFERENCES system(systemid),	
	logged DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',	 
	lastupdated DATETIME NOT NULL DEFAULT '0000-00-00 00:00:00',
	active tinyint(1) UNSIGNED NOT NULL DEFAULT '1'
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `signup` (
  `id` int(11) NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '1'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSTRUCTIONS:

Start from any file between game-delete.php and system-update.php