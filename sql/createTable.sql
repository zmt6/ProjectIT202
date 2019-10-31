create table if not exists `ProjectAccounts`(
		`id` int auto_increment not null,
		`username` varchar(30) not null unique,
		`pin` int default 0,
		PRIMARY KEY (`id2`)
		) CHARACTER SET utf8 COLLATE utf8_general_ci;
