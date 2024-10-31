<?php




/**
 * 
 * exit if accessed directly
 * 
 */
if( ! defined( 'ABSPATH' ) ) {
    
    exit;
    
}




if ( isset( $_POST['postId'] ) === false || empty( $_POST['postId'] ) === true ) {
    
    echo 'fail';
    die();
    
}

if ( isset( $_POST['timeInterval'] ) === false || empty( $_POST['timeInterval'] ) === true ) {
    
    echo 'fail';
    die();
    
}




$postId         = absint( $_POST['postId'] );
$timeInterval 	= absint( $_POST['timeInterval'] );
$metaData 	= get_post_meta( $postId );

$latest 	= (int) $metaData[ '_cc-plain-social-fb-shares-latest' ];
$current 	= floor( date( 'U' ) );

if ( $current - $latest <= $timeInterval ) {
	
    echo $metaData[ '_cc-plain-social-fb-shares' ];

    die();
	
}

$link = sprintf(
        'https://graph.facebook.com/?id=%s&fields=share',
        get_permalink( $postId )
    );

$content = file_get_contents( $link );

if ( $content === false ) {

    echo $metaData[ '_cc-plain-social-fb-shares' ];

    die();

}

$data = json_decode( $content, true );

if ( $data === null ) {

    echo $metaData[ '_cc-plain-social-fb-shares' ];

    die();

}

$count = $data[ 'share' ][ 'share_count' ];

if ( is_int( $count ) === false || $count < 0 ) {

    echo $metaData[ '_cc-plain-social-fb-shares' ];

    die();

}

update_post_meta(
        $postId,
        '_cc-plain-social-fb-shares',
        $count
    );

update_post_meta(
        $postId,
        '_cc-plain-social-fb-shares-latest',
        $current
    );

echo $count;
	
die();