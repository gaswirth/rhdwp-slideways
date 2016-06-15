<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage rhd
 */

get_header();

wp_safe_redirect( home_url(), '301' );
