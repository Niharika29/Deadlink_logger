CREATE TABLE IF NOT EXISTS bot_log (
	wiki				VARCHAR(30) DEFAULT NULL, /* URL of the wiki */
	page_id				INT(11) UNSIGNED DEFAULT NULL,
	rev_id				INT(11) UNSIGNED DEFAULT NULL,
	links_fixed			INT(11) UNSIGNED DEFAULT NULL,
	links_not_fixed		INT(11) UNSIGNED DEFAULT NULL,
	bot					VARCHAR(30) NOT NULL,
	service				VARCHAR(30) DEFAULT NULL,
	status				ENUM('fixed', 'posted') DEFAULT NULL,
	page_title			VARCHAR(255) DEFAULT NULL,
	datetime			TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 2, 5, 'Alpha', 'IA', 'fixed', 'Apple', '2016-03-02 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 4, 4, 'Beta', 'IA', 'fixed', 'Orange', '2016-03-01 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 1, 4, 'Gamma', 'IA', 'fixed', 'Mango', '2016-02-29 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 0, 4, 'Beta', 'IA', 'fixed', 'Pear', '2016-02-02 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 5, 4, 'Alpha', 'IA', 'fixed', 'India', '2016-01-20 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 0, 4, 'Alpha', 'IA', 'fixed', 'America', '2016-03-02 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 1, 4, 'Alpha', 'IA', 'fixed', 'Russia', '2016-02-18 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 2, 4, 'Alpha', 'IA', 'fixed', 'Japan', '2016-02-22 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 3, 4, 'Alpha', 'IA', 'fixed', 'China', '2016-02-26 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 4, 4, 'Alpha', 'IA', 'fixed', 'Canada', '2016-01-30 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 5, 4, 'Alpha', 'IA', 'fixed', 'UK', '2016-01-29 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 6, 4, 'Alpha', 'IA', 'fixed', 'Mexico', '2016-01-24 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 0, 4, 'Alpha', 'IA', 'fixed', 'Deer', '2016-01-22 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 1, 4, 'Alpha', 'IA', 'fixed', 'Apple', '2015-12-11 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 2, 4, 'Beta', 'IA', 'fixed', 'Apple', '2015-12-10 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 3, 4, 'Beta', 'IA', 'fixed', 'Apple', '2016-02-11 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 4, 4, 'Alpha', 'IA', 'fixed', 'Apple', '2016-02-30 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 5, 4, 'Alpha', 'IA', 'fixed', 'Apple', '2015-12-11 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 6, 4, 'Gamma', 'IA', 'fixed', 'Apple', '2016-02-01 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 7, 4, 'Alpha', 'IA', 'fixed', 'Apple', '2015-10-02 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 0, 4, 'Alpha', 'IA', 'fixed', 'Cheese', '2015-09-02 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 1, 4, 'Alpha', 'IA', 'fixed', 'Apple', '2015-03-02 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 2, 4, 'Alpha', 'IA', 'fixed', 'Apple', '2016-01-01 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 3, 4, 'Gamma', 'IA', 'fixed', 'Fish', '2016-01-01 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 4, 4, 'Alpha', 'IA', 'fixed', 'Apple', '2016-02-01 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 5, 4, 'Beta', 'IA', 'fixed', 'Apple', '2016-03-01 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 6, 4, 'Alpha', 'IA', 'fixed', 'Apple', '2016-02-12 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'en.wikipedia.org', 203, 1035523, 7, 4, 'Alpha', 'IA', 'fixed', 'Horse', '2016-01-14 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'de.wikipedia.org', 203, 1035523, 0, 4, 'Alpha', 'IA', 'fixed', 'Whale', '2016-01-15 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'fr.wikipedia.org', 203, 1035523, 1, 4, 'Beta', 'IA', 'fixed', 'Apple', '2016-03-01 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'fr.wikipedia.org', 203, 1035523, 2, 4, 'Gamma', 'IA', 'fixed', 'Apple', '2016-03-02 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'de.wikipedia.org', 203, 1035523, 3, 4, 'Alpha', 'IA', 'fixed', 'Sushi', '2016-03-02 08:50:39' );

INSERT INTO bot_log(wiki, page_id, rev_id, links_fixed, links_not_fixed, bot, service, status, page_title, datetime)
VALUES( 'es.wikipedia.org', 203, 1035523, 4, 4, 'Alpha', 'IA', 'fixed', 'Apple', '2016-03-02 08:50:39' );
