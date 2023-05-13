<?php

// Connect to the SQLite database
$db = new PDO('mysql:dbname=clouds;host=db;port=3306;charset=utf8mb4', 'root', 'password', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$db->exec("
CREATE TABLE clouds.gods (
	id BIGINT UNSIGNED auto_increment NOT NULL,
	name varchar(100) NOT NULL,
	created_at DATETIME DEFAULT NOW() NULL,
	CONSTRAINT gods_PK PRIMARY KEY (id)
);
");


$db->exec("
CREATE TABLE clouds.mythologies (
	id BIGINT UNSIGNED auto_increment NOT NULL,
	name varchar(100) NOT NULL,
	created_at DATETIME DEFAULT NOW() NULL,
	CONSTRAINT mythologies_PK PRIMARY KEY (id)
);
");

$db->exec("
ALTER TABLE clouds.gods ADD mythology_id BIGINT UNSIGNED NULL;
ALTER TABLE clouds.gods ADD CONSTRAINT fk_mythology FOREIGN KEY (mythology_id) REFERENCES clouds.mythologies (id);
");


$db->exec("
CREATE TABLE clouds.followers (
	id BIGINT UNSIGNED auto_increment NOT NULL,
	name varchar(100) NOT NULL,
	god_id BIGINT UNSIGNED NULL,
	followed_at DATETIME DEFAULT NOW() NULL,
	unfollowed_at DATETIME NULL,
	CONSTRAINT followers_pk PRIMARY KEY (id),
	CONSTRAINT fk_god FOREIGN KEY (god_id) REFERENCES clouds.gods (id)
);
");

$db->exec("
CREATE TABLE clouds.followers_metrics (
	id BIGINT UNSIGNED auto_increment NOT NULL,
	new_followers BIGINT UNSIGNED DEFAULT 0,
	leaving_followers BIGINT UNSIGNED DEFAULT 0,
	god_id BIGINT UNSIGNED NULL,
	date DATE,
	updated_at DATETIME NULL,
	CONSTRAINT followers_metrics_pk PRIMARY KEY (id),
	CONSTRAINT fk_god2 FOREIGN KEY (god_id) REFERENCES clouds.gods (id),
	CONSTRAINT unique_god_date UNIQUE (god_id, date)
);
");
