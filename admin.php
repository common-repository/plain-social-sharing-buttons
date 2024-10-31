<?php

/**
 * max wordpress: 3.1.0
 * submit_button > wp > 3.1.0
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
 * Create the admin panel container the typical way. The settings are contained
 * in the global settings variable in the settings.php file
 * 
 * settings_fields > wp > 2.7.0
 * do_settings_sections > wp > 2.7.0
 * submit_button > wp > 3.1.0
 * 
 * @global array $cc_plain_social_settings
 */
function cc_plain_social_admin_initial_setup() {
    
    global $cc_plain_social_settings;
    
    printf(
        '<div class="wrap"><h1 class="cc-plain-social-header">%s</h1><form method="post" action="options.php">',
        esc_html( $cc_plain_social_settings['menu-title'] )
    );
    
    settings_fields( $cc_plain_social_settings['plugin-uid'] );
    do_settings_sections( $cc_plain_social_settings['plugin-uid'] );

    echo "<div class='cc-plain-social-tab'>";

    foreach ( $cc_plain_social_settings[ 'sections' ] as $section ) {

        echo "<span class='cc-plain-social-tablinks' data-for='{$section['uid']}'>{$section['sidebar']}</span>";

    }

    submit_button();

    echo "</div>";
    echo "<div class='cc-plain-social-container'>";
    
    cc_plain_social_sections_callback();
    
    cc_plain_social_options_callback();

    echo "</div></form></div>";
    
}




/**
 * register_setting > wp > 2.7.0
 */
function cc_plain_social_admin_register_settings() {
    
    global $cc_plain_social_settings;
    
    register_setting(
            $cc_plain_social_settings['plugin-uid'],
            $cc_plain_social_settings['optionsPrefix']
        );
    
}




function cc_plain_social_create_field( $field ) {
    
    $draggable = '';
    
    if( isset( $field[ 'draggable' ] ) === true && $field[ 'draggable' ] === true ){
        
        $draggable = 'draggable="true"';
        
    }
    
    $dataset = array();
    
    if ( isset( $field[ 'data' ] ) === true ) {
        
        foreach ( $field[ 'data' ] as $key => $value ) {
        
            $dataset[] = sprintf('data-%s="%s"',
                $key,
                $value
            );
            
        }
        
    }
    
    printf(
        '<div class="field" %1$s %2$s id="%3$s">',
        $draggable,
        implode( ' ', $dataset ),
        $field[ 'for' ] . '_field'
    );
    
}




function cc_plain_social_create_fieldLabel( $field ) {
    
    printf(
        '<div class="fieldLabel %s">%s</div>',
        $field[ 'for' ] . '_fieldLabel',
        $field[ 'label' ]
    );
    
}




function cc_plain_social_create_description( $field ) {
    
    if( isset( $field[ 'description' ] ) === true ){
        
        printf(
            '<p class="description %1$s">%2$s</p>',
            $field[ 'description' ] . '_description',
            $field[ 'description' ]
        );
        
    }
    
}




/**
 * Creates the text inputs in the admin panel for any option that requires one.
 * The array that passes to the function comes from the 'cc_plain_social_admin_fields'
 * and it also contains data from the global settings variable. The description comes
 * from the global settings variable and is passed through the 'cc_plain_social_admin_fields' function
 * 
 * @param array $arguments
 */
function cc_plain_social_text_callback( $field ) {
    
    cc_plain_social_create_field( $field );
    
    cc_plain_social_create_fieldLabel( $field );
    
    echo '<div class="fieldContent">';
    
    $placeholder = '';
    
    if( isset( $field[ 'placeholder' ] ) === true ){
        
        $placeholder = sprintf(
            'placeholder="%s"',
            $field[ 'placeholder' ]
        );
        
    }
    
    printf(
        '<input id="%1$s" type="text" %2$s data-for="%3$s" class="inputFront inputTextFront"/>',
        $field[ 'for' ] . '_inputFront',
        $placeholder,
        $field[ 'for' ]
    );
    
    cc_plain_social_create_description( $field );
    
    echo "</div></div>";
    
}




function cc_plain_social_number_callback( $field ) {
    
    cc_plain_social_create_field( $field );
    
    cc_plain_social_create_fieldLabel( $field );
    
    echo '<div class="fieldContent">';
    
    printf(
        '<input id="%1$s" type="number" data-for="%2$s" min="%3$s" max="%4$s"  class="inputFront inputNumberFront"/>',
        $field[ 'for' ] . '_inputFront',
        $field[ 'for' ],
        $field[ 'minValue' ],
        $field[ 'maxValue' ]
    );
    
    cc_plain_social_create_description( $field );
    
    echo "</div></div>";
    
}




function cc_plain_social_checkbox_callback( $field ) {
    
    cc_plain_social_create_field( $field );
    
    cc_plain_social_create_fieldLabel( $field );
    
    echo '<div class="fieldContent">';
    
    $dataset = array();
    
    if ( isset( $field[ 'data' ] ) === true ) {
        
        foreach ( $field[ 'data' ] as $key => $value ) {
        
            $dataset[] = sprintf('data-%s="%s"',
                $key,
                $value
            );
            
        }
        
    }
    
    printf(
        '<label class="switch"><input id="%1$s" type="checkbox" data-for="%2$s" class="inputFront inputCheckboxFront" %3$s/><span class="slider round"></span></label>',
        $field[ 'for' ] . '_inputFront',
        $field[ 'for' ],
        implode( ' ', $dataset )
    );
    
    cc_plain_social_create_description( $field );
    
    echo "</div></div>";
    
}




function cc_plain_social_custom_callback_supportReview() {
    
    echo '<div class="supportReview">';
    echo '<h3>If you have found this plugin useful, please spare a few seconds to leave a positive review.</h3>';
    echo '<a href="https://wordpress.org/support/plugin/plain-social-sharing-buttons/reviews/?rate=5#new-post" target="_blank">Click to review</a>';
    echo '</div>';
    
}




function cc_plain_social_custom_callback_supportShare() {
    
    global $cc_plain_social_options;
        
    $permalink      = 'https://wordpress.org/plugins/plain-social-sharing-buttons/';
    $mention        = '&via=cleanCodeWeb';
    $titleBig       = 'We have started using Plain Social Sharing Buttons for Wordpress. Check it out:';
    $titleSmall     = 'Plain Social Sharing Buttons for Wordpress';
    $defaultServer  = 'https://mastodon.social';

    echo '<div class="supportShare">';
    echo '<h3>You can also support us by spreading word for this plugin. You can use the buttons below:</h3>';
    echo '<div class="ccPlainSocialFloating">';
        
    printf(
        '<a rel="%1$s" class="%2$s" title="%3$s" href="%4$s" target="%5$s"></a>',
        esc_attr( 'nofollow noreferrer noopener' ),
        esc_attr( 'ccPlainSocialButton ccPlainFacebook' ),
        esc_attr( $cc_plain_social_options[ 'facebook-title' ] ),
        esc_url( 'https://www.facebook.com/sharer.php?u=' . $permalink ),
        esc_attr( '_blank' )
    );

    printf(
        '<a rel="%1$s" class="%2$s" title="%3$s" href="%4$s" target="%5$s"></a>',
        esc_attr( 'nofollow noreferrer noopener' ),
        esc_attr( 'ccPlainSocialButton ccPlainTwitter' ),
        esc_attr( $cc_plain_social_options[ 'twitter-title' ] ),
        esc_url( 'https://twitter.com/intent/tweet?text=' . $titleBig . '&url=' . $permalink . $mention ),
        esc_attr( '_blank' )
    );

    printf(
        '<a rel="%1$s" class="%2$s" title="%3$s" href="%4$s" target="%5$s"></a>',
        esc_attr( 'nofollow noreferrer noopener' ),
        esc_attr( 'ccPlainSocialButton ccPlainReddit' ),
        esc_attr( $cc_plain_social_options[ 'reddit-title' ] ),
        esc_url( 'https://www.reddit.com/submit?url=' . $permalink . '&title=' . $titleSmall ),
        esc_attr( '_blank' )
    );

    printf(
        '<a rel="%1$s" class="%2$s" title="%3$s" href="%4$s" target="%5$s"></a>',
        esc_attr( 'nofollow noreferrer noopener' ),
        esc_attr( 'ccPlainSocialButton ccPlainLinkedin' ),
        esc_attr( $cc_plain_social_options[ 'linkedin-title' ] ),
        esc_url( 'https://www.linkedin.com/cws/share?url=' . $permalink ),
        esc_attr( '_blank' )
    );

    printf(
        '<a rel="%1$s" class="%2$s" title="%3$s" href="%4$s" target="%5$s"></a>',
        esc_attr( 'nofollow noreferrer noopener' ),
        esc_attr( 'ccPlainSocialButton ccPlainTumblr' ),
        esc_attr( $cc_plain_social_options[ 'tumblr-title' ] ),
        esc_url( 'https://www.tumblr.com/widgets/share/tool?posttype=link&canonicalUrl=' . $permalink . '&title=' . $titleBig ),
        esc_attr( '_blank' )
    );

    printf(
        '<a rel="%1$s" class="%2$s" title="%3$s" data-text="%4$s" data-link="%5$s" href="%6$s" target="%7$s" data-popuptitle="%8$s" data-popupexplanation="%9$s" data-popupinputplaceholder="%10$s" data-popuperror="%11$s" data-popupmemorize="%12$s" data-popupmemorizetitle="%13$s" data-popupclose="%14$s" data-popupconfirm="%15$s"></a>',
        esc_attr( 'nofollow noreferrer noopener' ),
        esc_attr( 'ccPlainSocialButton ccPlainMastodon' ),
        esc_attr( $cc_plain_social_options[ 'mastodon-title' ] ),
        $titleBig,
        $permalink,
        esc_url( $defaultServer . '/share?text=' . $titleBig . ' ' . $permalink ),
        esc_attr( '_blank' ),
        esc_attr( $cc_plain_social_options[ 'mastodon-popuptitle' ] ),
        esc_attr( $cc_plain_social_options[ 'mastodon-popupexplanation' ] ),
        esc_attr( $cc_plain_social_options[ 'mastodon-popupinputplaceholder' ] ),
        esc_attr( $cc_plain_social_options[ 'mastodon-popuperror' ] ),
        esc_attr( $cc_plain_social_options[ 'mastodon-popupmemorize' ] ),
        esc_attr( $cc_plain_social_options[ 'mastodon-popupmemorizetitle' ] ),
        esc_attr( $cc_plain_social_options[ 'mastodon-popupclose' ] ),
        esc_attr( $cc_plain_social_options[ 'mastodon-popupconfirm' ] )
    );

    printf(
        '<a rel="%1$s" class="%2$s" title="%3$s" href="%4$s" target="%5$s"></a>',
        esc_attr( 'nofollow noreferrer noopener' ),
        esc_attr( 'ccPlainSocialButton ccPlainDiaspora' ),
        esc_attr( $cc_plain_social_options[ 'diaspora-title' ] ),
        esc_url( 'https://share.diasporafoundation.org/?title=' . $titleBig . '&url=' . $permalink ),
        esc_attr( '_blank' )
    );

    printf(
        '<a rel="%1$s" class="%2$s" title="%3$s" href="%4$s" target="%5$s"></a>',
        esc_attr( 'nofollow noreferrer noopener' ),
        esc_attr( 'ccPlainSocialButton ccPlainEmail' ),
        esc_attr( $cc_plain_social_options[ 'mail-title' ] ),
        esc_url( 'mailto:?subject=' . $cc_plain_social_options[ 'mail-subject' ] . '&body=' . $permalink ),
        esc_attr( '_blank' )
    );
        
    echo '</div></div>';
    
}




function cc_plain_social_options_callback() {
    
    global $cc_plain_social_settings, $cc_plain_social_options;
    
    echo '<div class="optionsContainer">';
    
    foreach ( $cc_plain_social_settings[ 'options' ] as $option => $initial ) {
        
        printf(
                '<input name="%3$s" id="%1$s" type="hidden" value="%2$s"/>',
                'hidden_' . $option,
                $cc_plain_social_options[ $option ],
                $cc_plain_social_settings['optionsPrefix'] . '[' . $option . ']'
            );
        
    }
    
    echo '</div>';
    
}




function cc_plain_social_sections_callback() {
    
    global $cc_plain_social_settings;
    
    foreach ( $cc_plain_social_settings[ 'sections' ] as $section ) {
        
        printf(
            '<div id="%s" class="cc-plain-social-tabcontent">',
            $section[ 'uid' ]
        );
        
        foreach ( $section[ 'subsections' ] as $subsection ) {
            
            if ( $subsection[ 'label' ] === 'cc-plain-social-support-review' ) {
                
                cc_plain_social_custom_callback_supportReview();
                
            } elseif ( $subsection[ 'label' ] === 'cc-plain-social-support-share' ) {
                
                cc_plain_social_custom_callback_supportShare();
                
            } elseif ( $subsection[ 'label' ] === 'Floating buttons selection' ) {
                
                cc_plain_social_custom_callback_floatingButtons( $subsection );
                
            } else {
            
                cc_plain_social_subsections_callback( $subsection );
                
            }
            
        }

        echo "</div>";

    }
    
}




function cc_plain_social_subsections_callback( $subsection ) {
    
    $additionalClass = '';
    
    if( isset( $subsection[ 'class' ] ) === true ){
        
        $additionalClass = ' ' . $subsection[ 'class' ];
        
    }
    
    printf(
        '<div class="subsection%s">',
        $additionalClass
    );
    
    printf(
        '<h2>%s</h2>',
        $subsection[ 'label' ]
    );
    
    printf(
        '<p class="description">%s</p>',
        $subsection[ 'description' ]
    );
    
    foreach ( $subsection[ 'fields' ] as $field ) {
        
        cc_plain_social_field_callback( $field );
        
    }
    
    echo '</div>';
    
}




function cc_plain_social_field_callback( $field ) {

    if ( $field['type'] === 'text' ) {

        cc_plain_social_text_callback( $field );

    } elseif ( $field['type'] === 'checkbox' ) {

        cc_plain_social_checkbox_callback( $field );

    } elseif ( $field['type'] === 'number' ) {

        cc_plain_social_number_callback( $field );

    }
    
}




function cc_plain_social_custom_callback_floatingButtons( $subsection ) {
    
    global $cc_plain_social_options;
    
    $additionalClass = '';
    
    if( isset( $subsection[ 'class' ] ) === true ){
        
        $additionalClass = ' ' . $subsection[ 'class' ];
        
    }
    
    printf(
        '<div class="subsection%s">',
        $additionalClass
    );
    
    printf(
        '<h2>%s</h2>',
        $subsection[ 'label' ]
    );
    
    printf(
        '<p class="description">%s</p>',
        $subsection[ 'description' ]
    );
    
    $sortNice = explode( ',', $cc_plain_social_options[ 'floating-sort' ] );
    
    foreach ( $sortNice as $element ) {
        
        foreach ( $subsection[ 'fields' ] as $field ) {
            
            if ( strpos( $field[ 'for' ], $element ) !== false ) {
                
                cc_plain_social_checkbox_callback( $field );
                
                continue;
                
            }
            
        }
        
    }
    
    echo '</div>';
    
}