<?php
/**
 * @author Maxim Doronin <maxim.doronin@itcode.pro>
 * @link itcode.pro
 */

/**
 * Get all list tables
 *
 * @return array
 */
function sr_tables() {
	return [
		'events' => "
			`id` BIGINT(20) NOT NULL AUTO_INCREMENT,
			`time` INT(10) DEFAULT 0,
			`post_id` BIGINT(20) DEFAULT NULL,
			`page_id` VARCHAR(50) DEFAULT NULL,
			`object_id` VARCHAR(50) DEFAULT NULL,
			`status_id` TINYINT(1) DEFAULT 0,
			`is_force` TINYINT(1) DEFAULT 0,
			`social_id` TINYINT(1) NOT NULL,
			`action_id` TINYINT(1) NOT NULL,
			`message` TEXT DEFAULT NULL,
			PRIMARY KEY (`id`),
			KEY(`post_id`),
			KEY(`page_id`),
			KEY(`object_id`)
		",

		'objects' => "
			`id` BIGINT(20) NOT NULL AUTO_INCREMENT,
			`object_id` BIGINT(20) NOT NULL,
			`name` VARCHAR(255) DEFAULT '',
			`likes` BIGINT(20) DEFAULT '0',
			`talkings` BIGINT(20) DEFAULT NULL,
			`status_id` TINYINT(1) NOT NULL DEFAULT '0',
			`social_id` TINYINT(1) NOT NULL,
			`action_id` TINYINT(1) NOT NULL,
			PRIMARY KEY (`id`),
			KEY(`object_id`),
			KEY(`name`),
			KEY(`talkings`),
			KEY(`social_id`)
		",

		'media' => "
			`id` BIGINT(20) NOT NULL AUTO_INCREMENT,
			`album_id` INT(10) DEFAULT NULL,
			`attachment_id` BIGINT(20) NOT NULL,
			`thumbnail` VARCHAR(255) NOT NULL,
			`title` VARCHAR(255) DEFAULT NULL,
			`template` TEXT DEFAULT NULL,
			PRIMARY KEY (`id`),
			KEY(`album_id`),
			KEY(`attachment_id`)
		",

		'media_albums' => "
			`id` BIGINT(20) NOT NULL AUTO_INCREMENT,
			`social_id` TINYINT(1) DEFAULT NULL,
			`action_id` TINYINT(1) DEFAULT NULL,
			`is_fixed` TINYINT(1) DEFAULT '0',
			`is_subscription` TINYINT(1) DEFAULT '0',
			`title` VARCHAR(255) DEFAULT NULL,
			`keywords` VARCHAR(255) DEFAULT NULL,
			`category` VARCHAR(50) DEFAULT NULL,
			`service` VARCHAR(50) DEFAULT NULL,
			`template` TEXT DEFAULT NULL,
			PRIMARY KEY (`id`)
		",

		'spinners' => "
			`id` BIGINT(20) NOT NULL AUTO_INCREMENT,
			`type_id` TINYINT(1) NOT NULL,
			`template` TEXT NOT NULL,
			PRIMARY KEY (`id`),
			KEY(`type_id`)
		",

		'statistics' => "
			`id` BIGINT(20) NOT NULL AUTO_INCREMENT,
			`time` INT(10) NOT NULL,
			`social_id` TINYINT(1) NOT NULL,
			`likes` BIGINT(20) DEFAULT '0',
			`talkings` BIGINT(20) DEFAULT NULL,
			PRIMARY KEY (`id`),
			KEY(`social_id`),
			KEY(`talkings`)
		",

		'stat_profile' => "
			`id` BIGINT(20) NOT NULL AUTO_INCREMENT,
			`time` INT(10) NOT NULL,
			`social_id` TINYINT(1) NOT NULL,
			`page_id` BIGINT(20) NOT NULL,
			`followers` INT DEFAULT '0',
			`posts` INT DEFAULT NULL,
			`clicks` INT DEFAULT NULL,
			`impressions` INT DEFAULT NULL,
			`reach` INT DEFAULT NULL,
			`views` INT DEFAULT NULL,
			PRIMARY KEY (`id`),
			KEY(`page_id`),
			KEY(`social_id`)
		",

		'stat_posts' => "
			`id` BIGINT(20) NOT NULL AUTO_INCREMENT,
			`time` INT(10) NOT NULL,
			`social_id` TINYINT(1) NOT NULL,
			`post_id` BIGINT(20) DEFAULT NULL,
			`page_id` BIGINT(20) NOT NULL,
			`media_id` BIGINT(20) NOT NULL,
			`likes` INT DEFAULT '0',
			`comments` INT DEFAULT '0',
			`saved` INT DEFAULT '0',
			`clicks` INT DEFAULT NULL,
			`impressions` INT DEFAULT NULL,
			`reach` INT DEFAULT NULL,
			`views` INT DEFAULT NULL,
			PRIMARY KEY (`id`),
			KEY(`social_id`),
			KEY(`post_id`),
			KEY(`page_id`),
			KEY(`media_id`)
		"
	];
}

function sr_activation() {

	if (!current_user_can('install_plugins')) {
		return;
	}

	delete_site_option('sr-errors');

	global $wpdb;

	require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

	$tables = sr_tables();
	$charset = $wpdb->get_charset_collate();

	maybe_convert_table_to_utf8mb4("{$wpdb->prefix}options");

	foreach ($tables as $table => $sql) {

		$tb = "{$wpdb->prefix}sr_{$table}";

		dbDelta("CREATE TABLE IF NOT EXISTS $tb ($sql) $charset");
	}
}
