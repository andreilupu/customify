<?php defined( 'ABSPATH' ) or die;

$basepath = dirname( __FILE__ ) . DIRECTORY_SEPARATOR;

$debug = false;
if ( isset( $_GET['debug'] ) && $_GET['debug'] == 'true' ) {
	$debug = true;
}

$debug = true;

$config = require $basepath . 'config.php';

return array(
	'plugin-name'           => 'pixcustomify',
	'settings-key'          => 'pixcustomify_settings',
	'textdomain'            => 'pixcustomify_txtd',
	'template-paths'        => array(
		$basepath . 'core/views/form-partials/',
		$basepath . 'views/form-partials/',
	),
	'fields'                => array(
		'hiddens' => include 'settings/hiddens' . EXT,
		'general' => include 'settings/general' . EXT,
		'typography' => include 'settings/typography' . EXT,
		'css_editor' => include 'settings/css_editor' . EXT,
	),
	'processor'             => array(
		// callback signature: (array $input, PixtypesProcessor $processor)
		'preupdate'  => array(
			// callbacks to run before update process
			// cleanup and validation has been performed on data
		),
		'postupdate' => array(
			'save_settings'
		),
	),
	'cleanup'               => array(
		'switch' => array( 'switch_not_available' ),
	),
	'checks'                => array(
		'counter' => array( 'is_numeric', 'not_empty' ),
	),
	'errors'                => array(
		'not_empty' => __( 'Invalid Value.', pixcustomify::textdomain() ),
	),
	'callbacks'             => array(
		'save_settings' => 'save_customizer_plugin_settings'
	),
	// shows exception traces on error
	'debug'                 => $debug,

	/**
	 * DEFAULTS - The default plugin options
	 */
	'default_options' => $config

); # config
