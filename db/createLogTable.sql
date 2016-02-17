CREATE TABLE IF NOT EXISTS bot_log (
	wiki		VARCHAR(30) DEFAULT NULL,
	page_id		INT(11) DEFAULT NULL,
	rev_id		INT(11) DEFAULT NULL,
	num_links	INT(11) DEFAULT NULL,
	bot_id		INT(11) NOT NULL,
	service		VARCHAR(30) DEFAULT NULL,
	status		ENUM('fixed', 'posted') DEFAULT NULL
);
