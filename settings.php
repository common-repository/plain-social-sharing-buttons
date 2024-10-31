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
 * declare a global variable
 */
global $cc_plain_social_settings;




/**
 * Initialize an array as global variable, containing the settings mainly for
 * administrative usage
 */
$cc_plain_social_settings = array(
    
    'toplevel-page'                 => 'settings',
    
    'parent-slug'                   => 'options-general.php',
    
    'page-title'                    => 'Plain social sharing buttons',
    
    'menu-title'                    => 'Plain Social Sharing Buttons',
    
    'capability'                    => 'manage_options',
    
    'plugin-uid'                    => 'plain_social_sharing',
    
    'admin-callback'                => 'cc_plain_social_admin_initial_setup',
    
    'register-settings-function'    => 'cc_plain_social_admin_register_settings',
    
    'optionsPrefix'                 => '_ccPlainSocial',
    
    'floatingIdentifiers'           => array(
        
        'counter'   => 'cc_plain_social_floating_counter',
        'facebook'  => 'cc_plain_social_floating_facebook',
        'twitter'   => 'cc_plain_social_floating_twitter',
        'reddit'    => 'cc_plain_social_floating_reddit',
        'linkedin'  => 'cc_plain_social_floating_linkedin',
        'tumblr'    => 'cc_plain_social_floating_tumblr',
        'mastodon'  => 'cc_plain_social_floating_mastodon',
        'diaspora'  => 'cc_plain_social_floating_diaspora',
        'whatsapp'  => 'cc_plain_social_floating_whatsapp',
        'mail'      => 'cc_plain_social_floating_mail',
        'resizer'   => 'cc_plain_social_floating_resizer',
        
        
    ),
    
    'options'                       => array(
        
        'floating-counter-enable'       => '1',
        'facebook-enable'               => '1',
        'twitter-enable'                => '1',
        'reddit-enable'                 => '1',
        'linkedin-enable'               => '0',
        'tumblr-enable'                 => '0',
        'mastodon-enable'               => '0',
        'diaspora-enable'               => '1',
        'whatsapp-enable'               => '0',
        'mail-enable'                   => '1',
        'text-resizer-enable'           => '1',
        'floating-sort'                 => 'counter,facebook,twitter,reddit,linkedin,tumblr,mastodon,diaspora,whatsapp,mail,resizer',
        'floating-showdesktop'          => ' ccPlainSocialShowDesktop',
        'floating-showtablet'           => ' ccPlainSocialShowTablet',
        'floating-showmobile'           => ' ccPlainSocialHideMobile',
        'floating-show-home'            => '0',
        'floating-show-post'            => '1',
        'floating-show-page'            => '1',
        'floating-show-attachment'      => '1',
        'floating-show-category'        => '0',
        'floating-show-tag'             => '0',
        'floating-show-archive'         => '0',
        'floating-right-alignment'      => ' ccPlainSocialLeft',
        'floating-fade-in'              => '',
        'facebook-title'                => 'Share on Facebook',
        'twitter-title'                 => 'Share on Twitter',
        'twitter-mention'               => '',
        'reddit-title'                  => 'Share on Reddit',
        'linkedin-title'                => 'Share on LinkedIn',
        'tumblr-title'                  => 'Share on Tumblr',
        'mastodon-title'                => 'Toot on Mastodon',
        'mastodon-popuptitle'           => 'Server Address',
        'mastodon-popupexplanation'     => 'Enter the mastodon server url you are registered, eg:',
        'mastodon-popupinputplaceholder'=> 'https://mastodon.social',
        'mastodon-popuperror'           => 'Please, provide a valid url',
        'mastodon-popupmemorizeenable'  => '1',
        'mastodon-popupmemorize'        => 'Memorize my server',
        'mastodon-popupmemorizetitle'   => 'This will only work for your current browser. No data will be sent to any server.',
        'mastodon-popupclose'           => 'Close',
        'mastodon-popupconfirm'         => 'Confirm',
        'mastodon-defaultserver'        => 'https://mastodon.social',
        'diaspora-title'                => 'Share on Diaspora',
        'whatsapp-title'                => 'Send on WhatsApp',
        'mail-title'                    => 'E-mail this',
        'mail-subject'                  => 'Check this out',
        'text-resizer-increase-hover'   => 'Increase text size',
        'text-resizer-decrease-hover'   => 'Decrease text size',
        'text-resizer-selector'         => '.entry-content',
        'counter-time-interval'                     => '1',
        'counter-minimum-show'                      => '0',
        'counter-cache-bypass-desktop'              => '1',        
        'counter-cache-bypass-tablet'               => '0',
        'counter-cache-bypass-mobile'               => '0',
        'counter-cache-bypass-localcache'           => '1',
        'counter-cache-bypass-localcache-expire'    => '1',
        'uninstall-keep-options'                    => '0',
        'uninstall-keep-counterdata'                => '0'
    ),
    
    'sections'                      => array(
        
        array(
            
            'uid'           => 'ccPlainSocialButtonsSetup',
            
            'sidebar'       => 'Floating Sidebar',
            
            'subsections'   => array(
                
                array(
                    
                    'label'         => 'Floating buttons selection',
                    
                    'class'         => 'floatingButtons',
                
                    'description'   => 'Here you can choose which buttons and info you want to appear on your floating sidebar',

                    'fields'        => array(

                        array(
                            'for'           => 'floating-counter-enable',
                            'label'         => 'Counter:',
                            'type'          => 'checkbox',
                            'draggable'     => true,
                            'data'          => array(
                                    'drag'      => 'counter',
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),

                        array(
                            'for'           => 'facebook-enable',
                            'label'         => 'Facebook:',
                            'type'          => 'checkbox',
                            'draggable'     => true,
                            'data'          => array(
                                    'drag'      => 'facebook',
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),
                        
                        array(
                            'for'           => 'twitter-enable',
                            'label'         => 'Twitter:',
                            'type'          => 'checkbox',
                            'draggable'     => true,
                            'data'          => array(
                                    'drag'      => 'twitter',
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),
                        
                        array(
                            'for'           => 'reddit-enable',
                            'label'         => 'Reddit:',
                            'type'          => 'checkbox',
                            'draggable'     => true,
                            'data'          => array(
                                    'drag'      => 'reddit',
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),
                
                        array(
                            'for'           => 'linkedin-enable',
                            'label'         => 'LinkedIn:',
                            'type'          => 'checkbox',
                            'draggable'     => true,
                            'data'          => array(
                                    'drag'      => 'linkedin',
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),
                
                        array(
                            'for'           => 'tumblr-enable',
                            'label'         => 'Tumblr:',
                            'type'          => 'checkbox',
                            'draggable'     => true,
                            'data'          => array(
                                    'drag'      => 'tumblr',
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),
                
                        array(
                            'for'           => 'mastodon-enable',
                            'label'         => 'Mastodon:',
                            'type'          => 'checkbox',
                            'draggable'     => true,
                            'data'          => array(
                                    'drag'      => 'mastodon',
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),
                
                        array(
                            'for'           => 'diaspora-enable',
                            'label'         => 'Diaspora:',
                            'type'          => 'checkbox',
                            'draggable'     => true,
                            'data'          => array(
                                    'drag'      => 'diaspora',
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),
                
                        array(
                            'for'           => 'whatsapp-enable',
                            'label'         => 'WhatsApp:',
                            'type'          => 'checkbox',
                            'draggable'     => true,
                            'data'          => array(
                                    'drag'      => 'whatsapp',
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),

                        array(
                            'for'           => 'mail-enable',
                            'label'         => 'E-mail:',
                            'type'          => 'checkbox',
                            'draggable'     => true,
                            'data'          => array(
                                    'drag'      => 'mail',
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),

                        array(
                            'for'           => 'text-resizer-enable',
                            'label'         => 'Text resizer:',
                            'type'          => 'checkbox',
                            'draggable'     => true,
                            'data'          => array(
                                    'drag'      => 'resizer',
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),

                    )
                    
                ),
                
                array(
                    
                    'label'         => 'Devices',
                    
                    'description'   => 'Choose to which devices the floating sidebar will appear',
                    
                    'fields'        => array(
                
                        array(
                            'for'           => 'floating-showdesktop',
                            'label'         => 'Desktop:',
                            'type'          => 'checkbox',
                            'description'   => 'By default, the floating sidebar appears on desktop browsers. The detection is based solely on the screen width, so if this option is enabled, it means that the floating sidebar will appear to any browser with a width larger than <strong>1025px</strong>',
                            'data'          => array(
                                    'checked'   => ' ccPlainSocialShowDesktop',
                                    'unchecked' => ' ccPlainSocialHideDesktop'
                                )
                        ),
                
                        array(
                            'for'           => 'floating-showtablet',
                            'label'         => 'Tablet:',
                            'type'          => 'checkbox',
                            'description'   => 'By default, the floating sidebar appears on tablet browsers. If this option is enabled, the floating sidebar will appear on browsers with width between <strong>769px</strong> and <strong>1025px</strong>',
                            'data'          => array(
                                    'checked'   => ' ccPlainSocialShowTablet',
                                    'unchecked' => ' ccPlainSocialHideTablet'
                                )
                        ),
                
                        array(
                            'for'           => 'floating-showmobile',
                            'label'         => 'Mobile:',
                            'type'          => 'checkbox',
                            'description'   => 'By default, the floating sidebar does not appear on mobile browsers. If this option is enabled, the floating sidebar will appear on browsers with width below <strong>769px</strong>',
                            'data'          => array(
                                    'checked'   => ' ccPlainSocialShowMobile',
                                    'unchecked' => ' ccPlainSocialHideMobile'
                                )
                        )
                        
                    )
                    
                ),
                
                array(
                    
                    'label'         => 'Display',
                    
                    'description'   => 'Choose on which parts of your site the floating sidebar will appear',
                    
                    'fields'        => array(
                
                        array(
                            'for'           => 'floating-show-home',
                            'label'         => 'Home:',
                            'type'          => 'checkbox',
                            'description'   => 'By default, the floating sidebar does not appear on the homepage. Click above to override this option',
                            'data'          => array(
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),
                
                        array(
                            'for'           => 'floating-show-post',
                            'label'         => 'Posts:',
                            'type'          => 'checkbox',
                            'description'   => 'By default, the floating sidebar appears on your posts. Click above to hide the floating sidebar for all your posts',
                            'data'          => array(
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),
                
                        array(
                            'for'           => 'floating-show-page',
                            'label'         => 'Pages:',
                            'type'          => 'checkbox',
                            'description'   => 'By default, the floating sidebar appears on your pages. Click above to hide the floating sidebar for all your pages',
                            'data'          => array(
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),
                
                        array(
                            'for'           => 'floating-show-attachment',
                            'label'         => 'Attachments:',
                            'type'          => 'checkbox',
                            'description'   => 'By default, the floating sidebar appears on your attachments. Click above to hide the floating sidebar for all your pages',
                            'data'          => array(
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),
                
                        array(
                            'for'           => 'floating-show-category',
                            'label'         => 'Categories:',
                            'type'          => 'checkbox',
                            'description'   => 'By default, the floating sidebar does not appear on your category pages. Toggle this switch to override the default behavior',
                            'data'          => array(
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),
                
                        array(
                            'for'           => 'floating-show-tag',
                            'label'         => 'Tags:',
                            'type'          => 'checkbox',
                            'description'   => 'By default, the floating sidebar does not appear on your tag pages. Toggle this switch to override the default behavior',
                            'data'          => array(
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),
                
                        array(
                            'for'           => 'floating-show-archive',
                            'label'         => 'Archives:',
                            'type'          => 'checkbox',
                            'description'   => 'By default, the floating sidebar does not appear on your archives pages. Toggle this switch to override the default behavior',
                            'data'          => array(
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),
                        
                    )
                    
                ),
                
                array(
                    
                    'label'         => 'Appearance',
                    
                    'description'   => 'Various options about the appearance of the floating sidebar',
                    
                    'fields'        => array(
                
                        array(
                            'for'           => 'floating-right-alignment',
                            'label'         => 'Align right:',
                            'type'          => 'checkbox',
                            'description'   => 'By default, the floating sidebar floats on the left side of the screen. Enabling this option, the sidebar will float on the right side.',
                            'data'          => array(
                                    'checked'   => ' ccPlainSocialRight',
                                    'unchecked' => ' ccPlainSocialLeft'
                                )
                        ),
                
                        array(
                            'for'           => 'floating-fade-in',
                            'label'         => 'Fade-in:',
                            'type'          => 'checkbox',
                            'description'   => 'By default, the floating sidebar appears immediately upon page load. Enable this option to make the floating sidebar to appear after the user has scrolled down the page.',
                            'data'          => array(
                                    'checked'   => ' ccPlainSocialFadeIn',
                                    'unchecked' => ''
                                )
                        )
                        
                    )
                    
                )
                
            )
            
        ),
        
        array(
            
            'uid'           => 'cc-plain-social-general-setup',
            
            'sidebar'       => 'General',
            
            'subsections'   => array(
                
                array(
                    
                    'label'         => 'Facebook Options',
                    
                    'description'   => 'General options for the facebook sharing buttons',
                    
                    'fields'        => array(
                
                        array(
                            'for'           => 'facebook-title',
                            'label'         => 'Facebook Title',
                            'description'   => 'The text people see when they hover the facebook sharing button',
                            'type'          => 'text'
                        ),
                        
                    )
                    
                ),
                
                array(
                    
                    'label'         => 'Twitter Options',
                    
                    'description'   => 'General options for the twitter sharing buttons',
                    
                    'fields'        => array(

                        array(
                            'for'           => 'twitter-title',
                            'label'         => 'Twitter Title',
                            'description'   => 'The text people see when they hover the twitter sharing button',
                            'type'          => 'text'
                        ),

                        array(
                            'for'           => 'twitter-mention',
                            'label'         => 'Twitter Mention',
                            'description'   => 'Add your twitter username so that your twitter account is mentioned in twitter shares',
                            'type'          => 'text',
                            'placeholder'   => 'yourTwitterHandle WITHOUT the @'
                        )
                        
                    )
                    
                ),
                
                array(
                    
                    'label'         => 'Reddit Options',
                    
                    'description'   => 'General options for the reddit sharing buttons',
                    
                    'fields'        => array(

                        array(
                            'for'           => 'reddit-title',
                            'label'         => 'Reddit Title',
                            'description'   => 'The text people see when they hover the reddit sharing button',
                            'type'          => 'text'
                        ),
                        
                    )
                    
                ),
                
                array(
                    
                    'label'         => 'LinkedIn Options',
                    
                    'description'   => 'General options for the LinkedIn sharing buttons',
                    
                    'fields'        => array(

                        array(
                            'for'           => 'linkedin-title',
                            'label'         => 'LinkedIn Title',
                            'description'   => 'The text people see when they hover the linkedin sharing button',
                            'type'          => 'text'
                        ),
                        
                    )
                    
                ),
                
                array(
                    
                    'label'         => 'Tumblr Options',
                    
                    'description'   => 'General options for the Tumblr sharing buttons',
                    
                    'fields'        => array(

                        array(
                            'for'           => 'tumblr-title',
                            'label'         => 'Tumblr Title',
                            'description'   => 'The text people see when they hover the tumblr sharing button',
                            'type'          => 'text'
                        ),
                        
                    )
                    
                ),
                
                array(
                    
                    'label'         => 'Mastodon Options',
                    
                    'description'   => 'General options for the Mastodon sharing buttons. Mastodon works a bit different from the other social media. Due to its decentralized nature, visitors on your site must make known the mastodon pod they want to share your link. For this reason, a little pop-up appears when they click the share button, so as to enter their pod server url. Once they enter it, then the actual share window appears. Below, among other things, you can change the text that appears on the helper pop up.',
                    
                    'fields'        => array(

                        array(
                            'for'           => 'mastodon-title',
                            'label'         => 'Mastodon Title',
                            'description'   => 'The text people see when they hover the mastodon sharing button',
                            'type'          => 'text'
                        ),

                        array(
                            'for'           => 'mastodon-popuptitle',
                            'label'         => 'Mastodon Helper Title',
                            'description'   => 'The helper pop up title',
                            'type'          => 'text'
                        ),

                        array(
                            'for'           => 'mastodon-popupexplanation',
                            'label'         => 'Mastodon Helper Text',
                            'description'   => 'The helper pop up text that inform visitors what should they enter in the input field',
                            'type'          => 'text'
                        ),

                        array(
                            'for'           => 'mastodon-popupinputplaceholder',
                            'label'         => 'Mastodon Helper Placeholder',
                            'description'   => 'This text appears as a placeholder in the input field, so a visitor can get an idea of what kind of input is expected',
                            'type'          => 'text'
                        ),

                        array(
                            'for'           => 'mastodon-popuperror',
                            'label'         => 'Mastodon Helper Error Text',
                            'description'   => 'When visitors enter a mastodon pod url, a check runs on whether what they wrote is an actual url. This is the text that visitors will see, when they enter an invalid url. Note that the validation checks only whether what was provided is an actual url and not if it is indeed a mastodon pod url',
                            'type'          => 'text'
                        ),
                
                        array(
                            'for'           => 'mastodon-popupmemorizeenable',
                            'label'         => 'Mastodon Helper GDPR',
                            'description'   => 'When visitors enter a mastodon pod url, they can choose to store its address on their browser for future use. This way the next time they try to share their posts on Mastodon, they will not have to enter their mastodon pod url, which makes your site more user friendly. However for countries in EU, this may create a problem, because of the GDPR directive. Although the server address they enter will never leave their browser, at least without someone modifying this plugin\'s source code, you still have to let them know that your site stores a cookie on their machines\' localstorage, with the identifier "ccPlainSocialMastodonServer". If you comply with the GDPR, or if you know what you are doing, keep this option enabled. If you are worried, or if you have second thoughts on this, disable it just to be on the safe side.',
                            'type'          => 'checkbox',
                            'data'          => array(
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),

                        array(
                            'for'           => 'mastodon-popupmemorize',
                            'label'         => 'Mastodon Helper Memorize',
                            'description'   => 'When visitors enter a mastodon pod url, they can choose to memorize the mastodon pod url. The url is then stored as a cookie, and from there on they can share your posts on mastodon and the helper pop up will not appear again until the cookies are deleted. This is the text that visitors see next to the checkbox providing this ability.',
                            'type'          => 'text'
                        ),

                        array(
                            'for'           => 'mastodon-popupmemorizetitle',
                            'label'         => 'Mastodon Helper Memorize Hover',
                            'description'   => 'When visitors hover over the checkbox to enable storing the pod url, they will see a message reassuring them that the data they enter will not leave their browser and they will not be shared with any third parties. This is the message that will appear.',
                            'type'          => 'text'
                        ),

                        array(
                            'for'           => 'mastodon-popupclose',
                            'label'         => 'Mastodon Helper Close',
                            'description'   => 'The text on the helper pop up close button',
                            'type'          => 'text'
                        ),

                        array(
                            'for'           => 'mastodon-popupconfirm',
                            'label'         => 'Mastodon Helper Confirm',
                            'description'   => 'The text on the helper pop up confirm button',
                            'type'          => 'text'
                        ),

                        array(
                            'for'           => 'mastodon-defaultserver',
                            'label'         => 'Mastodon Default Server',
                            'description'   => 'If javascript is disabled on a visitor browser, there is a fallback allowing users to share your posts to a preselected mastodon pod. Here you can change which is the preselected mastodon server.',
                            'type'          => 'text'
                        ),
                        
                    )
                    
                ),
                
                array(
                    
                    'label'         => 'Diaspora Options',
                    
                    'description'   => 'General options for the Diaspora sharing buttons',
                    
                    'fields'        => array(

                        array(
                            'for'           => 'diaspora-title',
                            'label'         => 'Diaspora Title',
                            'description'   => 'The text people see when they hover the diaspora sharing button',
                            'type'          => 'text'
                        ),
                        
                    )
                    
                ),
                
                array(
                    
                    'label'         => 'WhatsApp Options',
                    
                    'description'   => 'General options for the WhatsApp sharing buttons',
                    
                    'fields'        => array(

                        array(
                            'for'           => 'whatsapp-title',
                            'label'         => 'WhatsApp Title',
                            'description'   => 'The text people see when they hover the whatsapp sharing button',
                            'type'          => 'text'
                        ),
                        
                    )
                    
                ),
                
                array(
                    
                    'label'         => 'E-mail Options',
                    
                    'description'   => 'General options for the e-mail sharing buttons',
                    
                    'fields'        => array(

                        array(
                            'for'           => 'mail-title',
                            'label'         => 'Mail Title',
                            'description'   => 'The text people see when they hover the e-mail sharing button',
                            'type'          => 'text'
                        ),

                        array(
                            'for'           => 'mail-subject',
                            'label'         => 'Mail Subject',
                            'description'   => 'The text that will be used as a subject for the e-mail',
                            'type'          => 'text'
                        ),
                        
                    )
                    
                ),
                
                array(
                    
                    'label'         => 'Text-resizer Options',
                    
                    'description'   => 'General options for the text-resizer buttons',
                    
                    'fields'        => array(

                        array(
                            'for'           => 'text-resizer-increase-hover',
                            'label'         => 'Magnify Text Title',
                            'description'   => 'The text people see when they hover the text magnifying button',
                            'type'          => 'text'
                        ),

                        array(
                            'for'           => 'text-resizer-decrease-hover',
                            'label'         => 'Minify Text Title',
                            'description'   => 'The text people see when they hover the text minifying button',
                            'type'          => 'text'
                        ),
                
                        array(
                            'for'           => 'text-resizer-selector',
                            'label'         => 'Text selector',
                            'description'   => 'By default these buttons will resize the text that is contained in an element with a class of .entry-content. If you want to change the target element, you can change this value to a selector of your choice. This field accepts a css selector value.',
                            'type'          => 'text'
                        )
                        
                    )
                    
                )
                
            )
            
        ),
        
        array(
            
            'uid'           => 'cc-plain-social-counter-setup',
            
            'sidebar'       => 'Social Counter',
            
            'subsections'   => array(
                
                array(
                    
                    'label'         => 'General Options',
                    
                    'description'   => 'The social counter gathers and shows how many times a post of yours was shared on Facebook. Currently facebook shares are shown only for posts and pages. NOT attachments, categories, tags, etc... The shares count for every post will be estimated when someone views your post. They will not populate automatically for all of your posts upon installation.',
                    
                    'fields'        => array(
                
                        array(
                            'for'           => 'counter-time-interval',
                            'label'         => 'Cache Time (hours):',
                            'description'   => 'Your Facebook shares are not queried on every post reload. They are queried when a post loads for the first time and are stored for a specific amount of time so as to minimize the response time of your site. The default waiting period before asking facebook for new stats is one hour, but you can change this value here, according to your needs. Take note that this option will be overriden if you use a caching plugin or technology. We strongly suggest to not set this value to 0.',
                            'type'          => 'number',
                            'minValue'      => '0',
                            'maxValue'      => '1440'
                        ),
                
                        array(
                            'for'           => 'counter-minimum-show',
                            'label'         => 'Minimum Share Count:',
                            'description'   => 'Whereas showing that a post of yours has a lot of shares on social media, can be extremely helpful, showing that a post of yours has no or very few shares, can be damaging for your site. Here you can set a minimum share count, below which the social share count will not appear to your visitors. Use 0 to disable this feature.',
                            'type'          => 'number',
                            'minValue'      => '0',
                            'maxValue'      => '999999'
                        )
                        
                    )
                    
                ),
                
                array(
                    
                    'label'         => 'Cache Bypass',
                    
                    'description'   => 'If you are using a caching technology or plugin for your site, the social share counter will be updated for your visitors, only when cache is refreshed. However you can bypass the cache, enabling a combination of the features below. In general, every time a user loads one of your posts or pages, an additional request will be made to the server, getting the current social shares. Beware though, this feature may or may not increase your server payload and this is something you will have to figure out yourself with trial and error. This plugin offers an additional caching system for your visitors to minimize even more the impact to your server. There are also options that allow you to follow different strategies for different devices used to browse your site. Keep in mind that the cache bypass feature, will respect and will not override the server side caching time you have on the option above.',
                    
                    'fields'        => array(
                
                        array(
                            'for'           => 'counter-cache-bypass-desktop',
                            'label'         => 'Desktop:',
                            'type'          => 'checkbox',
                            'description'   => 'If you enable this option, then users visiting your site using a desktop computer, will see a fresh sum of the social shares for your posts and pages. This is probably the most lightweight and safe cache bypass option to enable, since desktop computers are powerful enough to make additional requests without impeding a user\'s experience.',
                            'data'          => array(
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),
                        
                        array(
                            'for'           => 'counter-cache-bypass-tablet',
                            'label'         => 'Tablet:',
                            'type'          => 'checkbox',
                            'description'   => 'If you enable this option, then users visiting your site using a tablet, will see a fresh sum of the social shares for your posts and pages. This is also considered safe to enable.',
                            'data'          => array(
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),
                        
                        array(
                            'for'           => 'counter-cache-bypass-mobile',
                            'label'         => 'Mobile:',
                            'type'          => 'checkbox',
                            'description'   => 'If you enable this option, then users visiting your site using a mobile, will see a fresh sum of the social shares for your posts and pages. Enable this after thoroughly examining your server\'s capabilities and available resources. Additional requests to your server can drive audience away, if they make your page slow to load on mobiles, especially on low-end devices.',
                            'data'          => array(
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),
                        
                        array(
                            'for'           => 'counter-cache-bypass-localcache',
                            'label'         => 'Local Cache:',
                            'type'          => 'checkbox',
                            'description'   => 'This plugin offers an additional caching system, to minimize the impact of the cache bypassing. If you enable this, when a user visits a post or a page will make the additional request to your server, but the results will be stored to their browser for a specific amount of time. During that time, if they visit again the same post or page, there will be no additional server requests and they will only see the data that are stored on their browser. It is strongly recommended to enable this feature if you are set to enable cache bypassing. However, this will add an additional cookie to your visitors\' browsers and if you have to comply with GDPR, you will have to let them know the reason you are setting this cookie, although their data will never leave their browser or will be shared with third parties.',
                            'data'          => array(
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),
                        
                        array(
                            'for'           => 'counter-cache-bypass-localcache-expire',
                            'label'         => 'Cache Time (hours):',
                            'description'   => 'This is the amount of time for the local cache system you have enabled above',
                            'type'          => 'number',
                            'minValue'      => '0',
                            'maxValue'      => '1440'
                        ),
                        
                    )
                    
                )
                
            ),
            
        ),
        
        array(
            
            'uid'           => 'cc-plain-uninstallation-setup',
            
            'sidebar'       => 'Uninstallation',
            
            'subsections'   => array(
                
                array(
                    
                    'label'         => 'Uninstallation Options',
                    
                    'description'   => 'In case you want to remove this plugin, all the options will be removed from your database. Below however you can choose to maintain some or all of the data and options you have set.',
                    
                    'fields'        => array(
                        
                        array(
                            'for'           => 'uninstall-keep-options',
                            'label'         => 'Settings:',
                            'type'          => 'checkbox',
                            'description'   => 'Enable this, in case you want to keep in your database the current settings for the plugin. This is useful in case you test something and you want to uniinstall and reinstall the plugin. Keep this disabled at all other times, so that plugin updates will be installed correctly',
                            'data'          => array(
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        ),
                        
                        array(
                            'for'           => 'uninstall-keep-counterdata',
                            'label'         => 'Share Counts:',
                            'type'          => 'checkbox',
                            'description'   => 'Enable this, in case you want to keep in your database the share counts for your posts and pages',
                            'data'          => array(
                                    'checked'   => '1',
                                    'unchecked' => '0'
                                )
                        )
                        
                    )
                    
                )
                
            )
            
        ),
        
        array(
            
            'uid'           => 'cc-plain-social-support',
            
            'sidebar'       => 'Contribute',
            
            'subsections'   => array(
                
                array(
                    
                    'label'     => 'cc-plain-social-support-review',
                    
                ),
                
                array(
                    
                    'label'     => 'cc-plain-social-support-share',
                    
                )
                
            )
            
        )
    )
);