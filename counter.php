<?php

/**
 * max wordpress: 2.1.0
 * get_the_ID > wp > 2.1.0
 * 
 * max php: 5.3.0
 * round > php > 5.3.0
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
 * get_the_ID > wp > 2.1.0
 * get_permalink > wp > 1.0.0
 * get_post_meta > wp > 1.5.0
 * update_post_meta > wp > 1.5.0
 * date > php > 5.1.0 * 
 * is_page > wp > 1.5.0
 * is_single > wp > 1.5.0
 * 
 * intval > php > 5.1.0
 * file_get_contents > php > 5.1.0
 * json_decode > php 5.2.1
 * round > php > 5.3.0
 */




global $cc_plain_social_counter_data;
global $cc_plain_social_counter_current;
global $cc_plain_social_counter_minimum;




function cc_plain_social_counter_load() {
    
    global $cc_plain_social_counter_data, $cc_plain_social_counter_current, $cc_plain_social_counter_minimum, $cc_plain_social_options;
    
    $postId = get_the_ID();
    
    if ( $cc_plain_social_counter_current === null ) {
        
        $cc_plain_social_counter_current = floor( date( 'U' ) );
        
    }
    
    if ( $cc_plain_social_counter_minimum === null ) {
        
        $cc_plain_social_counter_minimum = intval( $cc_plain_social_options[ 'counter-minimum-show' ] );
        
    }
    
    if ( isset( $cc_plain_social_counter_data[ $postId ] ) !== true ) {
        
        cc_plain_social_counter_get_dbase_data( $postId );
        
    }
    
    return $postId;
    
}




function cc_plain_social_counter_valid_to_show( $postId ) {
    
    global $cc_plain_social_counter_data, $cc_plain_social_counter_minimum;
    
    if ( $cc_plain_social_counter_data[ $postId ]['fbShares'] >= $cc_plain_social_counter_minimum ) {
            
        return true;

    } else {

        return false;

    }
    
}




function cc_plain_social_counter_get_dbase_data( $postId ) {
    
    global $cc_plain_social_counter_data, $cc_plain_social_counter_current, $cc_plain_social_counter_minimum;
    
    $latest = get_post_meta(
            $postId,
            '_cc-plain-social-fb-shares-latest',
            true
        );
    
    if ( $latest === '' ) {
        
        cc_plain_social_counter_query_data( $postId );
        
        return;
        
    }

    $diff = ( ( $cc_plain_social_counter_current - $latest ) / 60 ) / 60;

    if ( $diff > $cc_plain_social_counter_minimum ) {
        
        cc_plain_social_counter_query_data( $postId );
        
        return;
        
    }
    
    $fbShares = get_post_meta(
            $postId,
            '_cc-plain-social-fb-shares',
            true
        );
    
    $cc_plain_social_counter_data[ $postId ] = array(
            'latest'    => $latest,
            'fbShares'  => $fbShares
        );
    
}




function cc_plain_social_counter_query_data( $postId ) {
    
    global $cc_plain_social_counter_data, $cc_plain_social_counter_current;
    
    $link = sprintf(
        'https://graph.facebook.com/?id=%s&fields=share',
        get_permalink()
    );

    $content = file_get_contents( $link );

    if ( $content === false ) {

        return;

    }

    $data = json_decode( $content, true );

    if ( $data === null ) {

        return;

    }

    $count = $data[ 'share' ][ 'share_count' ];

    if ( is_int( $count ) === false || $count < 0 ) {

        return false;

    }
    
    update_post_meta(
            $postId,
            '_cc-plain-social-fb-shares',
            $count
        );

    update_post_meta(
            $postId,
            '_cc-plain-social-fb-shares-latest',
            $cc_plain_social_counter_current
        );

    $cc_plain_social_counter_data[ $postId ] = array(
            'latest'    => $cc_plain_social_counter_current,
            'fbShares'  => $count
        );

}




function cc_plain_social_counter_format_data( $postId ) {
    
    global $cc_plain_social_counter_data;
        
    if ( $cc_plain_social_counter_data[ $postId ]['fbShares'] > 999 ) {

        return round( ( $cc_plain_social_counter_data[ $postId ]['fbShares'] / 1000 ), 1 ) . 'K';

    } else {

        return $cc_plain_social_counter_data[ $postId ]['fbShares'];

    }

}




function cc_plain_social_counter_data( $postId ) {
    
    global $cc_plain_social_counter_data;
    
    return $cc_plain_social_counter_data[ $postId ]['fbShares'];

}