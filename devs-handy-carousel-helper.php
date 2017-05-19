<?php
/*
 * Plugin Name: Dev's Handy Little Carousel Helper
 * Version: 1.0
 * Plugin URI: https://github.com/thebeard/devs-handy-carousel-helper
 * Description: Provides a class with which a developer can rapidly pass an array of slides and the template file location to render the carousel. This is particularly useful if multiple carousel styles/layouts are being used on a website.
 * Author: Theunis Cilliers
 * Author URI: https://github.com/thebeard
 * Requires at least: 4.0
 * Tested up to: 4.0
 *
 * Text Domain: devs-handy-carousel-helper
 *
 * @package WordPress
 * @author Theunis Cilliers
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Include the class used to render carousels in the wordpress custom theme
 */
if ( !class_exists( 'CK_Carousel' ) )
	require_once( 'includes/class.ck.carousel.php' );