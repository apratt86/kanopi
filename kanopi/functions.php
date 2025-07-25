<?php
require_once get_template_directory() . '/blocks/fancy-date/fancy-date.php';

/**
 * General Theme Settings.
 *
 * @since v1.0.0
 *
 * @return void
 */
function kanopi_theme_support() {
	// Add support for Post thumbnails.
	add_theme_support( 'post-thumbnails' );
	// Add support for responsive embedded content.
	add_theme_support( 'responsive-embeds' );
	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	// Add support for Editor Styles.
	add_theme_support( 'editor-styles' );
	// Enqueue Editor Styles.
	add_editor_style(
		'style-editor.css'
	);
}
add_action( 'after_setup_theme', 'kanopi_theme_support' );

/**
 * Enqueue CSS Stylesheets and Javascript files.
 *
 * @return void
 */
function kanopi_load_scripts() {
	$theme_version = wp_get_theme()->get( 'Version' );

	// 1. Styles.
	wp_enqueue_style( 'style', get_stylesheet_uri(), array(), $theme_version );
	wp_enqueue_style( 'main', get_theme_file_uri( 'build/main.css' ), array(), $theme_version, 'all' ); // main.scss: Compiled custom styles.

	// 2. Scripts.
	wp_enqueue_script( 'mainjs', get_theme_file_uri( 'build/main.js' ), array(), $theme_version, true );
}
add_action( 'wp_enqueue_scripts', 'kanopi_load_scripts' );

/**
 * Adds the Google Font Library in the <head> tag.
 *
 * @return void;
 */
function kanopi_load_fonts() {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
	echo '<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">';
}
add_action( 'wp_head', 'kanopi_load_fonts' );
