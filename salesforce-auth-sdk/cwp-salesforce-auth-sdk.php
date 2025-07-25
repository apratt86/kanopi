<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/apratt86
 * @since             1.0.0
 * @package           Adp_Salesforce_Auth_Sdk
 *
 * @wordpress-plugin
 * Plugin Name:       Salesforce Authentication SDK
 * Plugin URI:        https://https://github.com/apratt86/kanopi/salesforce-auth-sdk
 * Description:       Central Salesforce Authentication Connection. Defines the Salesforce Authentication Credentials and maintains the bearer token as a universal transient that may be used in connected plugins.
 * Version:           1.0.0
 * Author:            Aaron Pratt
 * Author URI:        https://github.com/apratt86
 * Text Domain:       salesforce-auth-sdk
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'Adp_Salesforce_Auth_Sdk_VERSION', '1.0.0' );

/**
 * Defines Salesforce Client ID from Environment Variable
 *
 * [ADP_SF_AUTH_CLIENT_ID_CONST] defines the constant alias used by the plugin.
 *
 * If base constant [ADP_SF_AUTH_CLIENT_ID] is not defined attempt to use VIP Env Var,
 * Else use the defined base constant.
 */
if ( ! defined( 'ADP_SF_AUTH_CLIENT_ID' ) ) :
	if ( ! function_exists( 'vip_get_env_var' ) ) :
		define( 'ADP_SF_AUTH_CLIENT_ID_CONST', false );
	else :
		define( 'ADP_SF_AUTH_CLIENT_ID_CONST', vip_get_env_var( 'ADP_SF_AUTH_CLIENT_ID', false ) );
	endif;
else :
	define( 'ADP_SF_AUTH_CLIENT_ID_CONST', ADP_SF_AUTH_CLIENT_ID );
endif;

/**
 * Defines Salesforce Client Secret from Environment Variable
 *
 * [ADP_SF_AUTH_CLIENT_SECRET_CONST] defines the constant alias used by the plugin.
 *
 * If base constant [ADP_SF_AUTH_CLIENT_SECRET] is not defined attempt to use VIP Env Var,
 * Else use the defined base constant.
 */
if ( ! defined( 'ADP_SF_AUTH_CLIENT_SECRET' ) ) :
	if ( ! function_exists( 'vip_get_env_var' ) ) :
		define( 'ADP_SF_AUTH_CLIENT_SECRET_CONST', false );
	else :
		define( 'ADP_SF_AUTH_CLIENT_SECRET_CONST', vip_get_env_var( 'ADP_SF_AUTH_CLIENT_SECRET', false ) );
	endif;
else :
	define( 'ADP_SF_AUTH_CLIENT_SECRET_CONST', ADP_SF_AUTH_CLIENT_SECRET );
endif;

/**
 * Defines Salesforce Username from Environment Variable
 *
 * [ADP_SF_AUTH_USER_NAME_CONST] defines the constant alias used by the plugin.
 *
 * If base constant [ADP_SF_AUTH_USER_NAME] is not defined attempt to use VIP Env Var,
 * Else use the defined base constant.
 */
if ( ! defined( 'ADP_SF_AUTH_USER_NAME' ) ) :
	if ( ! function_exists( 'vip_get_env_var' ) ) :
		define( 'ADP_SF_AUTH_USER_NAME_CONST', false );
	else :
		define( 'ADP_SF_AUTH_USER_NAME_CONST', vip_get_env_var( 'ADP_SF_AUTH_USER_NAME', false ) );
	endif;
else :
	define( 'ADP_SF_AUTH_USER_NAME_CONST', ADP_SF_AUTH_USER_NAME );
endif;

/**
 * Defines Salesforce User Password from Environment Variable
 *
 * [ADP_SF_AUTH_USER_PASSWORD_CONST] defines the constant alias used by the plugin.
 *
 * If base constant [ADP_SF_AUTH_USER_PASSWORD] is not defined attempt to use VIP Env Var,
 * Else use the defined base constant.
 */
if ( ! defined( 'ADP_SF_AUTH_USER_PASSWORD' ) ) :
	if ( ! function_exists( 'vip_get_env_var' ) ) :
		define( 'ADP_SF_AUTH_USER_PASSWORD_CONST', false );
	else :
		define( 'ADP_SF_AUTH_USER_PASSWORD_CONST', vip_get_env_var( 'ADP_SF_AUTH_USER_PASSWORD', false ) );
	endif;
else :
	define( 'ADP_SF_AUTH_USER_PASSWORD_CONST', ADP_SF_AUTH_USER_PASSWORD );
endif;


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require_once plugin_dir_path( __FILE__ ) . 'inc/class-sf-sdk.php';
require_once plugin_dir_path( __FILE__ ) . 'inc/class-auth-status.php';
