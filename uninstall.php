<?php




/**
 * 
 * exit if accessed directly
 * 
 */
if( ! defined( 'ABSPATH' ) ) {
    
    exit;
    
}




/**
 * 
 * if uninstall.php is not called by WordPress, die
 * 
 */
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
    
    exit;
	
}




/**
 * 
 * Include the file containing the global array with the settings for the admin
 * panel
 * 
 */
include_once plugin_dir_path( __FILE__ ) . 'settings.php';

global $cc_plain_social_options;

$cc_plain_social_options = get_option( $cc_plain_social_settings['optionsPrefix'] );





if ( $cc_plain_social_options[ 'uninstall-keep-options' ] !== '1' ) {
    
    delete_option( $cc_plain_social_settings['optionsPrefix'] );
    
}




if ( $cc_plain_social_options[ 'uninstall-keep-counterdata' ] !== '1' ) {
    
    delete_post_meta_by_key( '_cc-plain-social-fb-shares' );
    delete_post_meta_by_key( '_cc-plain-social-fb-shares-latest' );
    
}