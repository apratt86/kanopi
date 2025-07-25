<?php
/**
 * Registers the Main Plugin Configuration settings page in the ADP Admin must-use plugin menu.
 *
 * @link       https://github.com/apratt86
 * @since      1.0.0
 *
 * @package    Adp_Salesforce_Auth_Sdk
 * @subpackage Adp_Salesforce_Auth_Sdk/inc
 */

namespace ADP\CORE;

/**
 * Class to display the admin status page for the Salesforce Authentication connection details.
 *
 * @since      1.0.0
 * @package    Adp_Salesforce_Auth_Sdk
 * @subpackage Adp_Salesforce_Auth_Sdk/inc
 * @author     Aaron Pratt
 */
class Auth_Status extends Plugin {

	/**
	 * Needed for parent singleton class, plugin version number.
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @var     string $version
	 */
	protected static $version = Adp_Salesforce_Auth_Sdk_VERSION;

	/**
	 * Needed for parent singleton class, plugin identifier slug.
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @var     string $slug
	 */
	protected static $slug = 'Adp_Salesforce_Auth_Sdk';

	/**
	 * Instantiate the class object.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function load() {
		add_action( 'admin_menu', array( $this, 'add_menu_page' ), 20 );
	}

	/**
	 * Instantiate the class object.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function add_menu_page() {
		add_submenu_page(
			'adp_admin',
			'Salesforce Authentication Status',
			'Salesforce Auth',
			'manage_options',
			'adp_admin_sf-auth',
			array( $this, 'display_callback' )
		);
	}

	/**
	 * Method callback to display the status information in the admin page.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function display_callback() {
		// Get the Salesforce SDK Instance.
		$sf_auth_instance = SF_SDK::instance();
		?>
		<div class="wrap">
			<h1><?php echo esc_html( __( 'Salesforce Authentication Status', 'salesforce-auth-sdk' ) ); ?></h1>
			<ul>
			<?php
			// The Bearer Token.
			if ( false === $sf_auth_instance->get_token() ) :
				?>
				<li class="notice notice-error"><h4>Bearer Token: Not Set</h4></li>
			<?php else : ?>
				<li class="notice notice-success"><h4>Bearer Token: Bearer Token is Set</h4></li>
			<?php endif; ?>

			<?php
			// The Client ID.
			if ( false === ADP_SF_AUTH_CLIENT_ID_CONST || empty( ADP_SF_AUTH_CLIENT_ID_CONST ) ) :
				?>
				<li class="notice notice-error"><h4>[ADP_SF_AUTH_CLIENT_ID]</h4><p>Salesforce Authentication Environment Variable Not Set, Please Contact System Administrator.</p></li>
			<?php else : ?>
				<li class="notice notice-success"><h4>[ADP_SF_AUTH_CLIENT_ID]: Credential Value Set.</h4></li>
			<?php endif; ?>

			<?php
			// The Client Secret.
			if ( false === ADP_SF_AUTH_CLIENT_SECRET_CONST || empty( ADP_SF_AUTH_CLIENT_SECRET_CONST ) ) :
				?>
				<li class="notice notice-error"><h4>[ADP_SF_AUTH_CLIENT_SECRET]</h4><p>Salesforce Authentication Environment Variable Not Set, Please Contact System Administrator.</p></li>
			<?php else : ?>
				<li class="notice notice-success"><h4>[ADP_SF_AUTH_CLIENT_SECRET]: Credential Value Set.</h4></li>
			<?php endif; ?>

			<?php
			// The Auth Token Username.
			if ( false === ADP_SF_AUTH_USER_NAME_CONST || empty( ADP_SF_AUTH_USER_NAME_CONST ) ) :
				?>
				<li class="notice notice-error"><h4>[ADP_SF_AUTH_USER_NAME]</h4><p>Salesforce Authentication Environment Variable Not Set, Please Contact System Administrator.</p></li>
			<?php else : ?>
				<li class="notice notice-success"><h4>[ADP_SF_AUTH_USER_NAME]: Credential Value Set.</h4></li>
			<?php endif; ?>

			<?php
			// The Auth Token User Password.
			if ( false === ADP_SF_AUTH_USER_PASSWORD_CONST || empty( ADP_SF_AUTH_USER_PASSWORD_CONST ) ) :
				?>
				<li class="notice notice-error"><h4>[ADP_SF_AUTH_USER_PASSWORD]</h4><p>Salesforce Authentication Environment Variable Not Set, Please Contact System Administrator.</p></li>
			<?php else : ?>
				<li class="notice notice-success"><h4>[ADP_SF_AUTH_USER_PASSWORD]: Credential Value Set.</h4></li>
			<?php endif; ?>

			</ul>
		</div>
		<?php
	}
}

Auth_Status::instance();
