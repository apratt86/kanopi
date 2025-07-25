<?php
/**
 * Defines the Authentication Class to Capture the Salesforce Access Token
 *
 * @since  1.0.0
 * @author Aaron Pratt
 *
 * @package    Adp_Salesforce_Auth_Sdk
 * @subpackage Adp_Salesforce_Auth_Sdk/inc
 */

namespace ADP\CORE;

/**
 * Class to get the Salesforce Authentication Access Token and store it in site transient.
 *
 * @since      1.0.0
 * @package    Adp_Salesforce_Auth_Sdk
 * @subpackage Adp_Salesforce_Auth_Sdk/inc
 * @author     Aaron Pratt
 */
class SF_SDK extends Plugin {

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
	 * The Salesforce Client ID credential string.
	 * - Defined in main plugin file, from the env vars.
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @var     string $client_id
	 */
	protected $client_id = ADP_SF_AUTH_CLIENT_ID_CONST;

	/**
	 * The Salesforce Client Secret credential string.
	 * - Defined in main plugin file, from the env vars.
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @var     string $client_secret
	 */
	protected $client_secret = ADP_SF_AUTH_CLIENT_SECRET_CONST;

	/**
	 * The Salesforce Bearer Token Authentication User Name string.
	 * - Defined in main plugin file, from the env vars.
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @var     string $client_secret
	 */
	protected $auth_user = ADP_SF_AUTH_USER_NAME_CONST;

	/**
	 * The Salesforce Bearer Token Authentication User Password string.
	 * - Defined in main plugin file, from the env vars.
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @var     string $client_secret
	 */
	protected $auth_password = ADP_SF_AUTH_USER_PASSWORD_CONST;

	/**
	 * The oAuth token transient key.
	 * - Updated in database every 12 hours.
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @var     string $transient_name
	 */
	protected $transient_name = 'salesforce_auth_token';

	/**
	 * The returned authentication token.
	 *
	 * @since   1.0.0
	 * @access  protected
	 * @var     string $bearer_token
	 */
	protected $bearer_token;

	/**
	 * Instantiate the class object.
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function load() {
		$this->bearer_token = get_site_transient( $this->transient_name );
	}

	/**
	 * Is Bearer Token Transient Set
	 *
	 * @since   1.0.0
	 * @access  private
	 */
	private function is_transient_set() {
		if ( false === $this->bearer_token || empty( $this->bearer_token ) ) {
			return false;
		}
		return true;
	}

	/**
	 * Update Bearer Token Transient
	 *
	 * @since   1.0.0
	 * @access  private
	 */
	private function update_transient() {
		// Delete the existing bearer token transient.
		delete_site_transient( $this->transient_name );

		// Refresh the Bearer Token.
		$new_token = $this->get_bearer_token();

		if ( $new_token ) :
			// Set the new Bearer Token to the Transient value and set expiry to 12 hours.
			set_site_transient( $this->transient_name, $this->bearer_token, ( 12 * HOUR_IN_SECONDS ) );
			trigger_error( 'Updated bearer token transient.', E_USER_NOTICE ); // phpcs:ignore
		endif;
	}

	/**
	 * Get new Bearer Token
	 *
	 * @since   1.0.0
	 * @access  private
	 */
	private function get_bearer_token() {

		// Define the Salesforce oAuth Endpoint.
		$endpoint = 'https://login.salesforce.com/services/oauth2/token';

		// Get New Token.
		$args = array(
			'method'    => 'POST',
			'sslverify' => apply_filters( 'https_local_ssl_verify', true, $endpoint ), // Check is secure endpoint.
			'body'      => array(
				'grant_type'    => 'password',
				'username'      => $this->auth_user,
				'password'      => $this->auth_password,
				'client_id'     => $this->client_id,
				'client_secret' => $this->client_secret,
			),
		);

		$request  = wp_remote_request( $endpoint, $args );
		$response = json_decode( wp_remote_retrieve_body( $request ) );
		$code     = wp_remote_retrieve_response_code( $request );

		if ( 200 !== $code ) :
			trigger_error( json_encode( $response ), E_USER_NOTICE ); // phpcs:ignore
			return false;
		else :
			trigger_error( 'Received new bearer token.', E_USER_NOTICE ); // phpcs:ignore
			$this->bearer_token = $response->access_token;
		endif;

		return true;
	}

	/**
	 * Returns valid Bearer Token
	 *
	 * @param   bool $error Whether or not an error has occurred.
	 * @since   1.0.0
	 * @access  public
	 */
	public function get_token( bool $error = false ) {

		// Check if Bearer Token Transient is Set $this->is_transient_set() .
		if ( ! $this->is_transient_set() || $error ) :
			trigger_error( 'Error or bearer token not set, attempting to update bearer token.', E_USER_NOTICE ); // phpcs:ignore
			$this->update_transient(); // Refreshes the Bearer Token & Updates Transient Value.
		endif;

		// Return the Bearer Token.
		return $this->bearer_token;
	}

	/**
	 * Delete the transient
	 *
	 * @since   1.0.0
	 * @access  public
	 */
	public function delete_bearer_transient() {
		delete_site_transient( $this->transient_name );
	}
}

SF_SDK::instance();
