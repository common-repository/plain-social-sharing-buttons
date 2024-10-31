<?php

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




function cc_plain_social_floating_facebook( $options, $title, $permalink ) {
    
    if ( $options[ 'facebook-enable' ] === '1' ) {

        printf(
            '<a rel="nofollow noreferrer noopener" class="ccPlainSocialButton ccPlainFacebook" title="%s" href="%s" target="_blank"></a>',
            $options[ 'facebook-title' ],
            esc_url( 'https://www.facebook.com/sharer.php?u=' . $permalink )
        );

    }
    
    wp_localize_script(
        'cc-plain-social-main-js',
        'FacebookData',
        array(
            'title'   => $options[ 'facebook-title' ]
        )
    );
    
}




function cc_plain_social_floating_reddit( $options, $title, $permalink ) {
    
    if ( $options[ 'reddit-enable' ] === '1' ) {

        printf(
            '<a rel="nofollow noreferrer noopener" class="ccPlainSocialButton ccPlainReddit" title="%s" href="%s" target="_blank"></a>',
            $options[ 'reddit-title' ],
            esc_url( 'https://www.reddit.com/submit?url=' . $permalink . '&title=' . $title )
        );

    }
    
}




function cc_plain_social_floating_twitter( $options, $title, $permalink ) {
    
    if ( $options[ 'twitter-enable' ] === '1' ) {

        $mention = '';

        if ( $options[ 'twitter-mention' ] !== '' ) {

            $mention = '&via=' . $options[ 'twitter-mention' ];

        }

        printf(
            '<a rel="nofollow noreferrer noopener" class="ccPlainSocialButton ccPlainTwitter" title="%s" href="%s" target="_blank"></a>',
            $options[ 'twitter-title' ],
            esc_url( 'https://twitter.com/intent/tweet?text=' . $title . '&url=' . $permalink . $mention )
        );

    }
    
}




function cc_plain_social_floating_tumblr( $options, $title, $permalink ) {
    
    if ( $options[ 'tumblr-enable' ] === '1' ) {

        printf(
            '<a rel="nofollow noreferrer noopener" class="ccPlainSocialButton ccPlainTumblr" title="%s" href="%s" target="_blank"></a>',
            $options[ 'tumblr-title' ],
            esc_url( 'https://www.tumblr.com/widgets/share/tool?posttype=link&canonicalUrl=' . $permalink . '&title=' . $title )
        );

    }
    
}




function cc_plain_social_floating_linkedin( $options, $title, $permalink ) {
    
    if ( $options[ 'linkedin-enable' ] === '1' ) {

        printf(
            '<a rel="nofollow noreferrer noopener" class="ccPlainSocialButton ccPlainLinkedin" title="%s" href="%s" target="_blank"></a>',
            $options[ 'linkedin-title' ],
            esc_url( 'https://www.linkedin.com/cws/share?url=' . $permalink )
        );

    }
    
}




function cc_plain_social_floating_mastodon( $options, $title, $permalink ) {
    
    if ( $options[ 'mastodon-enable' ] === '1' ) {
        
        $defaultServer = rtrim( $options[ 'mastodon-defaultserver' ], '/' );

        printf(
            '<a rel="nofollow noreferrer noopener" class="ccPlainSocialButton ccPlainMastodon" title="%1$s" data-text="%2$s" data-link="%3$s" href="%6$s" target="_blank" data-popuptitle="%5$s" data-popupexplanation="%6$s" data-popupinputplaceholder="%7$s" data-popuperror="%8$s" data-popupmemorize="%9$s" data-popupmemorizetitle="%10$s" data-popupclose="%11$s" data-popupconfirm="%12$s" data-popupmemorizeenable="%13$s"></a>',
            $options[ 'mastodon-title' ],
            $title,
            $permalink,
            esc_url( $defaultServer . '/share?text=' . $title . ' ' . $permalink ),
            $options[ 'mastodon-popuptitle' ],
            $options[ 'mastodon-popupexplanation' ],
            $options[ 'mastodon-popupinputplaceholder' ],
            $options[ 'mastodon-popuperror' ],
            $options[ 'mastodon-popupmemorize' ],
            $options[ 'mastodon-popupmemorizetitle' ],
            $options[ 'mastodon-popupclose' ],
            $options[ 'mastodon-popupconfirm' ],
            $options[ 'mastodon-popupmemorizeenable' ]
        );

    }
    
}




function cc_plain_social_floating_diaspora( $options, $title, $permalink ) {
    
    if ( $options[ 'diaspora-enable' ] === '1' ) {

        printf(
            '<a rel="nofollow noreferrer noopener" class="ccPlainSocialButton ccPlainDiaspora" title="%s" href="%s" target="_blank"></a>',
            $options[ 'diaspora-title' ],
            esc_url( 'https://share.diasporafoundation.org/?title=' . $title . '&url=' . $permalink )
        );

    }
    
}




function cc_plain_social_floating_whatsapp( $options, $title, $permalink ) {
    
    if ( $options[ 'whatsapp-enable' ] === '1' ) {

        printf(
            '<a rel="nofollow noreferrer noopener" class="ccPlainSocialButton ccPlainWhatsapp" title="%s" href="%s" target="_blank"></a>',
            $options[ 'whatsapp-title' ],
            esc_url( 'https://api.whatsapp.com/send?text=' . $permalink )
        );

    }
    
}




function cc_plain_social_floating_mail( $options, $title, $permalink ) {
    
    if ( $options[ 'mail-enable' ] === '1' ) {

        printf(
            '<a rel="nofollow noreferrer noopener" class="ccPlainSocialButton ccPlainEmail" title="%s" href="%s" target="_blank"></a>',
            $options[ 'mail-title' ],
            esc_url( 'mailto:?subject=' . $options[ 'mail-subject' ] . '&body=' . $permalink )
        );

    }
    
}




function cc_plain_social_floating_resizer( $options, $title, $permalink ) {
    
    if ( $options[ 'text-resizer-enable' ] === '1' ) {

        printf(
            '<div class="ccPlainSocialButton ccPlainTextInc" title="%s" data-textselector="%s"></div>',
            $options[ 'text-resizer-increase-hover' ],
            $options[ 'text-resizer-selector' ]
        );
        
        printf(
            '<div class="ccPlainSocialButton ccPlainTextDec" title="%s" data-textselector="%s"></div>',
            $options[ 'text-resizer-decrease-hover' ],
            $options[ 'text-resizer-selector' ]
        );

    }
    
}




function cc_plain_social_floating_counter( $options, $title, $permalink ) {
    
    if ( $options['floating-counter-enable'] === '1' ) {
        
        include_once plugin_dir_path( __FILE__ ) . 'counter.php';
        
        $postId = cc_plain_social_counter_load();
        
        $hidden = '';
        
        if ( cc_plain_social_counter_valid_to_show( $postId ) === false ) {
            
            $hidden = ' hidden';
            
        }
        
        printf(
            '<div class="ccPlainSocialFloatingCounter%3$s" title="%1$s">%2$s</div><div class="ccPlainSocialFloatingCounterIcon%3$s" title="%1$s"></div>',
            cc_plain_social_counter_data( $postId ) . ' Shares',
            cc_plain_social_counter_format_data( $postId ),
            $hidden
        );
        
    }
    
}




/**
 * 
 * Injects the html for the end-user. All options are called from the database
 * 
 * plugin_dir_path > wp > 2.8.0
 * get_permalink > wp > 1.0.0
 * get_the_title > wp > 0.71
 * 
 */
function cc_plain_social_add_footer_html() {
    
    global $cc_plain_social_options, $cc_plain_social_settings;
    
    $permalink  = get_permalink();
    $title      = get_the_title();
    
    echo '<!-- Plain Social Sharing Buttons - https://en.cleancode.systems/ -->';
    
    printf(
        '<div class="%s">',
        'ccPlainSocialFloating'
            . $cc_plain_social_options[ 'floating-right-alignment' ]
            . $cc_plain_social_options[ 'floating-showdesktop' ]
            . $cc_plain_social_options[ 'floating-showtablet' ]
            . $cc_plain_social_options[ 'floating-showmobile' ]
            . $cc_plain_social_options[ 'floating-fade-in' ]
    );
    
    foreach ( explode( ',', $cc_plain_social_options[ 'floating-sort' ] ) as $element ) {
        
        call_user_func( $cc_plain_social_settings[ 'floatingIdentifiers' ][ $element ], $cc_plain_social_options, $title, $permalink );
        
    }
    

    echo '</div>';
    
    echo "\n\n<!-- Plain Social Sharing Buttons - https://en.cleancode.systems/ -->\n\n";
    
}




cc_plain_social_add_footer_html();