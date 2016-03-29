CREATE TABLE IF NOT EXISTS bot_log (
	wiki				VARCHAR(30) DEFAULT NULL, /* URL of the wiki */
	page_id				INT(11) UNSIGNED DEFAULT NULL,
	rev_id				INT(11) UNSIGNED DEFAULT NULL,
	links_fixed			INT(11) UNSIGNED DEFAULT NULL,
	links_not_fixed		INT(11) UNSIGNED DEFAULT NULL,
	bot					VARCHAR(30) NOT NULL,
	service				VARCHAR(30) DEFAULT NULL,
	status				ENUM('fixed', 'posted', 'failed') DEFAULT NULL,
	page_title			VARCHAR(255) DEFAULT NULL,
	datetime			TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

