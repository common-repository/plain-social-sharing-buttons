<?php

/**
 * 
 * Plugin Name: Plain Social Sharing Buttons
 * Plugin URI: https://cleancode.systems
 * Description: Social media sharing buttons in a floating sidebar
 * Version: 0.6.0
 * Author: cleanCode
 * Author URI: https://en.cleancode.systems
 * License: GPL2
 * Plugin URI: https://en.cleancode.systems/plain-social
 * 
 */

/**
 * max wordpress: 2.8.0
 * plugin_dir_path > wp > 2.8.0
 * 
 * max php: 5.0.0
 */




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
 * Include the file containing the global array with the settings for the admin
 * panel
 * 
 * plugin_dir_path > wp > 2.8.0
 * 
 */
include_once plugin_dir_path( __FILE__ ) . 'settings.php';




global $cc_plain_social_options;

$cc_plain_social_options = get_option( $cc_plain_social_settings['optionsPrefix'] );




/**
 * wp_query > wp > 1.5.0
 */
function cc_plain_social_view_type() {
    
    global $wp_query;
    
    $type = 'unknown';
    
    if ( $wp_query->is_home ) {
        
        $type = 'home';
        
    } elseif( $wp_query->is_page ) {
        
        if ( is_front_page() === false ) {
            
            $type = 'page';
            
        }
        
    } elseif ( $wp_query->is_single ) {
        
        if ( $wp_query->is_attachment ) {
            
            $type = 'attachment';
            
        } else {
            
            $type = 'post';
            
        }
        
    } elseif( $wp_query->is_category ) {
        
        $type = 'category';
        
    } elseif( $wp_query->is_tag ) {
        
        $type = 'tag';
        
    } elseif( $wp_query->is_archive ) {
        
        $type = 'archive';
        
    }
    
    return $type;
    
}




/**
 * plugin_dir_path > wp > 2.8.0
 */
function cc_plain_social_load_floating() {
    
    global $cc_plain_social_options;
    
    if ( $cc_plain_social_options[ 'floating-show-' . cc_plain_social_view_type() ] === '1' ) {
        
        include_once plugin_dir_path( __FILE__ ) . 'floating.php';
        
    }
    
}




/**
 * 
 * This function enqueues the .css and the .js file for the end-user.
 * The .js file is enqueued in the footer.
 * The files are enqueued in posts, attachments, pages and custom post types
 * 
 * wp_enqueue_style > wp > 2.6.0
 * plugins_url > wp > 2.6.0
 * wp_enqueue_script > wp > 2.1.0
 * 
 */
function cc_plain_social_enqueue_public_files() {
    
    global $cc_plain_social_options;

    wp_enqueue_style(
        'cc-plain-social-main-css',
        plugins_url( '/css/main.css', __FILE__ )
    );

    wp_enqueue_script(
        'cc-plain-social-main-js',
        plugins_url( '/js/main.js', __FILE__ ),
        array (),
        0.1,
        true
    );
    
    wp_localize_script(
        'cc-plain-social-main-js',
        'CcPlainOptions',
        array(
            'ajaxurl'                                   => admin_url( 'admin-ajax.php' ),
            'security'                                  => wp_create_nonce( 'cc-plain-social-string' ),
            'postId'                                    => get_the_ID(),
            'counter-minimum-show'                      => $cc_plain_social_options['counter-minimum-show'],
            'counter-cache-bypass-desktop'              => $cc_plain_social_options['counter-cache-bypass-desktop'],
            'counter-cache-bypass-tablet'               => $cc_plain_social_options['counter-cache-bypass-tablet'],
            'counter-cache-bypass-mobile'               => $cc_plain_social_options['counter-cache-bypass-mobile'],
            'counter-cache-bypass-localcache'           => $cc_plain_social_options['counter-cache-bypass-localcache'],
            'counter-time-interval'                     => $cc_plain_social_options['counter-time-interval'],
        )
    );

}




/**
 * Create the admin panel. Add a submenu page under the General Options Wordpress Menu,
 * with settings contained in the global settings variable in the settings.php file.
 * Include the admin menu file which contains the functions that register the sections
 * and the fields for the admin panel
 * 
 * is_admin > wp > 1.5.1
 * plugin_dir_path > wp > 2.8.0
 * add_action > wp > 1.2.0
 * 
 * @global array $cc_plain_social_settings
 */
function cc_plain_social_create_admin_menu() {
    
    global $cc_plain_social_settings;
    
    if ( is_admin() === false ) {
        
        return;
        
    }
    
    include_once plugin_dir_path( __FILE__ ) . 'admin.php';
    
    add_submenu_page(
        $cc_plain_social_settings[ 'parent-slug' ],
        $cc_plain_social_settings[ 'page-title' ],
        $cc_plain_social_settings[ 'menu-title' ],
        $cc_plain_social_settings[ 'capability' ],
        $cc_plain_social_settings[ 'plugin-uid' ],
        $cc_plain_social_settings[ 'admin-callback' ]
    );
    
    add_action( 'admin_init', $cc_plain_social_settings['register-settings-function'] );
    
}




/**
 * When the plugin is activated, add to the database the initial options for
 * the plugin to run. The initial options are in the global array in the
 * settings.php file, in the 'fields' sub-array. No need to evaluate the
 * add_option function. If the user reactivates after a temporary deactivation,
 * his settings are maintained
 * 
 * add_option > wp > 1.0.0
 * 
 * @global array $cc_plain_social_settings
 */
function cc_plain_social_activation_hook() {
    
    global $cc_plain_social_settings;

    add_option( $cc_plain_social_settings[ 'optionsPrefix' ], $cc_plain_social_settings[ 'options' ] );
    
}




/**
 * Add an action link in the plugins page on the admin panel, linking to the
 * admin settings page. The menu slug comes from the global admin settings array.
 * Use unshift to make the settings link, come before the deavtivation link.
 * 
 * admin_url > wp > 2.6.0
 * 
 * @global array $cc_plain_social_settings
 * @param array $links
 * @return array
 */
function cc_plain_social_action_links( $links ) {
    
    global $cc_plain_social_settings;
    
    $newLink = sprintf(
        '<a href="%s">%s</a>',
        admin_url( 'options-general.php?page=' . $cc_plain_social_settings[ 'plugin-uid' ] ),
        __('Settings')
    );
    
    array_unshift( $links, $newLink );
    
    return $links;
    
}




/**
 * wp_enqueue_style > wp > 2.6.0
 * wp_enqueue_script > wp > 2.1.0
 */
function cc_plain_social_enqueue_admin_files( $hook ) {
    
    global $cc_plain_social_settings;
    
    if( $hook != $cc_plain_social_settings['toplevel-page'] . '_page_' . $cc_plain_social_settings['plugin-uid'] ) {
        
        return;
        
    }
    
    wp_enqueue_style(
        'cc-plain-social-admin-css',
        plugins_url( '/css/admin.css', __FILE__ )
    );

    wp_enqueue_script( 'cc-plain-social-admin-js', plugins_url( '/js/admin.js', __FILE__ ), array (), 1.1, true);

}








/**
 * 
 * Register a function named 'cc_plain_social_activation_hook' to be run when
 * the plugin is activated
 * 
 * register_activation_hook > wp > 2.0.0
 * 
 */
register_activation_hook( __FILE__, 'cc_plain_social_activation_hook');




/**
 * 
 * Register a function to alter the action links for the plugin, in the plugins
 * page on the admin panel
 * 
 * add_filter > wp > 0.71
 * plugin_basename > wp > 1.5.0
 * 
 */
add_filter('plugin_action_links_'.plugin_basename(__FILE__), 'cc_plain_social_action_links');




/**
 * 
 * Register a function to add menu options to the admin panel's menu structure
 * 
 * add_action > wp > 1.2.0
 * 
 */
add_action( 'admin_menu', 'cc_plain_social_create_admin_menu' );




/**
 * add_action > wp > 1.2.0
 */
add_action( 'admin_enqueue_scripts', 'cc_plain_social_enqueue_admin_files' );




/**
 * 
 * Register a function to inject html near the </body> tag of a page or a post
 * 
 * add_action > wp > 1.2.0
 * 
 */
add_action( 'wp_footer', 'cc_plain_social_load_floating' );




/**
 * 
 * Register a function to enqueue the necessary .js and .css public files
 * 
 * add_action > wp > 1.2.0
 * 
 */
add_action( 'wp_enqueue_scripts', 'cc_plain_social_enqueue_public_files' );




function counterData_callback() {
    
    check_ajax_referer( 'cc-plain-social-string', 'security' );
    
    include_once plugin_dir_path( __FILE__ ) . 'ajaxCounter.php';
    
}




add_action( 'wp_ajax_nopriv_counterData', 'counterData_callback' );