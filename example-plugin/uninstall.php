<?php

defined('WP_UNINSTALL_PLUGIN') or die('get lost :D');

global $table_prefix;
global $wpdb;

$cptBook = 'book';
$posts = $table_prefix . 'posts';
$postMeta = $table_prefix . 'postmeta';
$termRelationships = $table_prefix . 'term_relationships';

$cptBooksIds = "SELECT id FROM $posts WHERE post_type = $cptBook";

$wpdb->query("DELETE FROM $posts WHERE post_type = $cptBook");
$wpdb->query("DELETE FROM $postMeta WHERE post_id NOT IN ($cptBooksIds)");
$wpdb->query("DELETE FROM $termRelationships WHERE object_id NOT IN ($cptBooksIds)");