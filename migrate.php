<?php

// Connect to the SQLite database
$db = new PDO('mysql:dbname=clouds;host=db;port=3306;charset=utf8mb4', 'root', 'password', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

if (in_array('--fresh', $argv)) {
    $db->exec("
    SET FOREIGN_KEY_CHECKS = 0;
    DROP TABLE IF EXISTS clouds.realms,
        clouds.gods,
        clouds.abilities,
        clouds.god_ability,
        clouds.mythologies,
        clouds.god_mythology,
        clouds.followers,
        clouds.followers_metrics;
    SET FOREIGN_KEY_CHECKS = 1;
    ");
}

$db->exec("
CREATE TABLE clouds.realms (
	id BIGINT UNSIGNED PRIMARY KEY auto_increment NOT NULL,
	name VARCHAR(100) NOT NULL
);
");

$db->exec("
INSERT INTO clouds.realms(id, name)
VALUES
    (1, 'Asgard'),
    (2, 'Olympus'),
    (3, 'Jotunhein'),
    (4, 'Hel'),
    (5, 'Duat'),
    (6, 'Mount Tlaloc');
");

$db->exec("
CREATE TABLE clouds.gods (
	id BIGINT UNSIGNED PRIMARY KEY auto_increment NOT NULL,
	name VARCHAR(100) NOT NULL,
    realm_id BIGINT UNSIGNED,
    alignment ENUM('good', 'neutral', 'evil', 'unknown'),
	created_at DATETIME DEFAULT NOW() NULL,
	FOREIGN KEY (realm_id) REFERENCES clouds.realms (id)
);
");

$db->exec("
INSERT INTO clouds.gods(id, name, realm_id, alignment)
VALUES
    (1, 'Thor', 1, 'neutral'),
    (2, 'Loki', 1, 'evil'),
    (3, 'Zeus', 2, 'neutral'),
    (4, 'Osiris', 5, 'neutral'),
    (5, 'Tlaloc', 6, 'neutral');
");

$db->exec("
CREATE TABLE clouds.abilities (
    id BIGINT UNSIGNED PRIMARY KEY auto_increment NOT NULL,
    name VARCHAR(100) NOT NULL,
    type ENUM('skill', 'curse', 'attribute'),
    description TEXT(500) NULL
);
");

$db->exec("
CREATE TABLE clouds.god_ability (
    id BIGINT UNSIGNED PRIMARY KEY auto_increment NOT NULL,
    god_id BIGINT UNSIGNED NOT NULL,
    ability_id BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (god_id) REFERENCES clouds.gods (id),
    FOREIGN KEY (ability_id) REFERENCES clouds.abilities (id)
);
");

$db->exec("
CREATE TABLE clouds.mythologies (
	id BIGINT UNSIGNED PRIMARY KEY auto_increment NOT NULL,
	name VARCHAR(100) NOT NULL,
	created_at DATETIME DEFAULT NOW() NULL
);
");

$db->exec("
INSERT INTO clouds.mythologies(id, name)
VALUES
    (1, 'Norse'),
    (2, 'Greek'),
    (3, 'Roman'),
    (4, 'Egyptian');
");

$db->exec("
CREATE TABLE clouds.god_mythology (
	id BIGINT UNSIGNED PRIMARY KEY auto_increment NOT NULL,
	role ENUM('leader', 'common', 'prophet', 'hero', 'creature', 'none') DEFAULT 'common',
    god_id BIGINT UNSIGNED NOT NULL,
    mythology_id BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (god_id) REFERENCES clouds.gods (id),
    FOREIGN KEY (mythology_id) REFERENCES clouds.mythologies (id)
);
");

$db->exec("
CREATE TABLE clouds.followers (
	id BIGINT UNSIGNED PRIMARY KEY auto_increment NOT NULL,
	name varchar(100) NOT NULL,
	god_id BIGINT UNSIGNED NULL,
	followed_at DATETIME DEFAULT NOW() NULL,
	unfollowed_at DATETIME NULL,
	FOREIGN KEY (god_id) REFERENCES clouds.gods (id)
);
");

$db->exec("
CREATE TABLE clouds.followers_metrics (
	id BIGINT UNSIGNED PRIMARY KEY auto_increment NOT NULL,
	new_followers BIGINT UNSIGNED DEFAULT 0,
	leaving_followers BIGINT UNSIGNED DEFAULT 0,
	god_id BIGINT UNSIGNED NULL,
	date DATE,
	updated_at DATETIME NULL,
	FOREIGN KEY (god_id) REFERENCES clouds.gods (id),
	UNIQUE (god_id, date)
);
");

$db->exec("
CREATE TABLE clouds.users (
	id BIGINT UNSIGNED PRIMARY KEY auto_increment NOT NULL,
	username VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
	created_at DATETIME DEFAULT NOW() NULL
);
");
