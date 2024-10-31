/*! Plain Social Shares - v0.1 */

window.addEventListener('load', ccPlainSocialInitiator, false);
window.addEventListener('load', bypassCache, false);
window.addEventListener('scroll', ccPlainSocialFadeIn, false );

function socialWindow(url) {
    
    var width, height, left, params,
        half = 0;
    
    width = window.innerWidth
        || document.documentElement.clientWidth
        || document.body.clientWidth;

    height = window.innerHeight
        || document.documentElement.clientHeight
        || document.body.clientHeight;
        
    if ( width <= 1025 ) {
        
        half = Math.floor( width * 0.75 );
        
    } else {
        
        half = Math.floor( width / 2 );
        
    }
    
    left = Math.floor( (width - half) / 2 );
    
    params = "menubar=no,toolbar=no,status=no,width=" + half + ",height=" + height + ",top=0,left=" + left;
    
    window.open(url,"NewWindow",params);
    
}




function ccPlainSocialIsLocalStorageAvailable () {
    
    var test = 'test';
    
    try {
        
        localStorage.setItem( test, test );
        localStorage.removeItem( test );
        return true;
        
    } catch(e) {
        
        return false;
        
    }
    
}




let ccPlainSocialFontSizeDef = 100;




function ccPlainSocialInitiator() {
    
    var buttonsNum, textUp, textDown;
    var buttons = new Array();
    
    buttons.push( document.querySelector(".ccPlainFacebook") );
    buttons.push( document.querySelector(".ccPlainTwitter") );
    buttons.push( document.querySelector(".ccPlainReddit") );
    buttons.push( document.querySelector(".ccPlainLinkedin") );
    buttons.push( document.querySelector(".ccPlainTumblr") );
    buttons.push( document.querySelector(".ccPlainDiaspora") );
    buttons.push( document.querySelector(".ccPlainWhatsapp") );
    
    buttonsNum = buttons.length;
    
    for ( var i=0 ; i<buttonsNum ; i++ ) {
        
        if ( buttons[ i ] !== null ) {
            
            buttons[ i ].addEventListener("click", function( event ) {

                event.preventDefault();

                socialWindow( event.target.href );

            });
            
        }
        
    }
    
    textUp      = document.querySelector(".ccPlainTextInc");
    textDown    = document.querySelector(".ccPlainTextDec");

    if ( textUp !== null ) {

        textUp.addEventListener("click", function( event ) {
            
            ccPlainSocialTextResizer( event.target, 1 );

        });

    }

    if ( textDown !== null ) {

        textDown.addEventListener("click", function( event ) {

            ccPlainSocialTextResizer( event.target, -1 );

        });

    }
    
    if ( document.querySelector(".ccPlainMastodon") !== null ) {

        document.querySelector(".ccPlainMastodon").addEventListener("click", function() {

            event.preventDefault();

            if ( ccPlainSocialIsLocalStorageAvailable() === true && document.querySelector(".ccPlainMastodon").dataset.popupmemorizeenable === '1' ) {

                if ( ccPlainSocialMastodonGetLocalstorage() === false ) {

                    ccPlainSocialMastodonWidow();

                } else {

                    ccPlainSocialMastodonShare();

                }

            } else {

                ccPlainSocialMastodonWidow();

            }

        });

    }
    
}




function ccPlainSocialFadeIn() {
    
    if ( document.querySelector(".ccPlainSocialFadeIn") !== null ) {
        
        document.querySelector(".ccPlainSocialFadeIn").style.opacity = 1;
        
    }
    
}

function ccPlainSocialMastodonWidow() {
    
    var button;
    
    button = document.querySelector(".ccPlainMastodon");
    
    console.log( button );
    
    var wrapper = document.createElement("DIV");
    wrapper.classList.add("ccPlainSocialMastodonWrapper");

    document.body.appendChild( wrapper );

    var widow = document.createElement("DIV");
    widow.setAttribute("class", "ccPlainSocialMastodonWidow");

    wrapper.appendChild( widow );

    var title = document.createElement("DIV");
    title.setAttribute("class", "ccPlainSocialMastodonTitle");

    widow.appendChild( title );

    var titleText = document.createTextNode( button.dataset.popuptitle );

    title.appendChild( titleText );

    var data = document.createElement("DIV");
    data.setAttribute("class", "ccPlainSocialMastodonData");

    widow.appendChild( data );

    var paragraph = document.createElement("P");

    data.appendChild( paragraph );

    var paragraphText = document.createTextNode( button.dataset.popupexplanation );

    paragraph.appendChild( paragraphText );

    var server = document.createElement("INPUT");
    server.setAttribute( "type", "url" );
    server.setAttribute( "class", "ccPlainSocialMastodonServer" );
    server.setAttribute( "placeholder", button.dataset.popupinputplaceholder );

    data.appendChild( server );
    
    var errorInput = document.createElement("SPAN");
    errorInput.setAttribute("class", "ccPlainSocialMastodonErrorInput");
    
    data.appendChild( errorInput );

    var errorInputText = document.createTextNode( button.dataset.popuperror );

    errorInput.appendChild( errorInputText );
    
    if ( ccPlainSocialIsLocalStorageAvailable() === true && document.querySelector(".ccPlainMastodon").dataset.popupmemorizeenable === '1' ) {

        var label = document.createElement("LABEL");
        label.setAttribute( "title", button.dataset.popupmemorizetitle );

        data.appendChild( label );

        var labelText = document.createTextNode( button.dataset.popupmemorize );

        label.appendChild( labelText );

        var checkbox = document.createElement("INPUT");
        checkbox.setAttribute("type", "checkbox");
        checkbox.setAttribute("id", "ccPlainSocialMastodonMemorize");

        label.appendChild( checkbox );
        
    }

    var footer = document.createElement("DIV");
    footer.setAttribute("class", "ccPlainSocialMastodonFooter");

    widow.appendChild( footer );

    var close = document.createElement("BUTTON");
    close.setAttribute("class", "ccPlainSocialMastodonClose");

    footer.appendChild( close );

    var closeText = document.createTextNode( button.dataset.popupclose );

    close.appendChild( closeText );

    var confirm = document.createElement("BUTTON");
    confirm.setAttribute("class", "ccPlainSocialMastodonConfirm");

    footer.appendChild( confirm );

    var confirmText = document.createTextNode( button.dataset.popupconfirm );

    confirm.appendChild( confirmText );

    setTimeout(function(){

        document.querySelector('.ccPlainSocialMastodonWidow').style.top = '0';

    }, 100);

    document.querySelector('.ccPlainSocialMastodonClose').addEventListener( 'click', ccPlainSocialCloseMastodonHandler );

    document.querySelector('.ccPlainSocialMastodonWrapper').addEventListener( 'click', ccPlainSocialCloseMastodonHandler );

    window.addEventListener( 'keydown', ccPlainSocialCloseMastodonHandler );
    
    document.querySelector('.ccPlainSocialMastodonConfirm').addEventListener( 'click', ccPlainSocialCloseMastodonHandler );
    
    document.querySelector('.ccPlainSocialMastodonServer').addEventListener( 'input', ccPlainSocialCloseMastodonHandler );
    
}

function ccPlainSocialCloseMastodonHandler( event ) {
    
    if ( event.type === 'click' ) {
        
        if (
                event.target === document.querySelector('.ccPlainSocialMastodonClose') ||
                event.target === document.querySelector('.ccPlainSocialMastodonWrapper') 
            ) {

            ccPlainSocialCloseMastodon();
            
        } else if ( event.target === document.querySelector('.ccPlainSocialMastodonConfirm') ) {
            
            if (    
                    document.querySelector('.ccPlainSocialMastodonServer').checkValidity() === false ||
                    document.querySelector('.ccPlainSocialMastodonServer').value === ''
                ) {
                
                document.querySelector('.ccPlainSocialMastodonErrorInput').style.opacity = 1;
                
            } else {
                
                document.querySelector('.ccPlainSocialMastodonServer').value;
                
                if ( document.getElementById('ccPlainSocialMastodonMemorize') !== null && document.getElementById('ccPlainSocialMastodonMemorize').checked === true ) {
    
                    ccPlainSocialMastodonSetLocalstorage ( document.querySelector('.ccPlainSocialMastodonServer').value );
                    
                }
                
                ccPlainSocialMastodonShare();
                
            }
            
        }
        
    } else if ( event.type === 'keydown' && event.key === 'Escape' ) {
        
        ccPlainSocialCloseMastodon();
        
    } else if ( event.type === 'input' && event.target === document.querySelector('.ccPlainSocialMastodonServer') ) {
        
        document.querySelector('.ccPlainSocialMastodonErrorInput').style.opacity = 0;
        
    }
    
}

function ccPlainSocialCloseMastodon() {
    
    var mastodonServer, mastodonConfirm, mastodonClose, mastodonWrapper;
    
    mastodonServer      = document.querySelector('.ccPlainSocialMastodonServer');
    mastodonConfirm     = document.querySelector('.ccPlainSocialMastodonConfirm');
    mastodonClose       = document.querySelector('.ccPlainSocialMastodonClose');
    mastodonWrapper     = document.querySelector('.ccPlainSocialMastodonWrapper');
    
    if ( mastodonServer !== null ) {
    
        mastodonServer.removeEventListener( 'input', ccPlainSocialCloseMastodonHandler );
        
    }
    
    if ( mastodonConfirm !== null ) {
    
        mastodonConfirm.removeEventListener( 'click', ccPlainSocialCloseMastodonHandler );
        
    }
    
    if ( mastodonClose !== null ) {
    
        mastodonClose.removeEventListener( 'click', ccPlainSocialCloseMastodonHandler );
        
    }
    
    if ( mastodonWrapper !== null ) {
        
        mastodonWrapper.removeEventListener( 'click', ccPlainSocialCloseMastodonHandler );
            
        while (mastodonWrapper.firstChild) {

            mastodonWrapper.removeChild( mastodonWrapper.firstChild );

        }

        mastodonWrapper.parentNode.removeChild( mastodonWrapper );
        
    }

    window.removeEventListener( 'keydown', ccPlainSocialCloseMastodonHandler );
    
}

function ccPlainSocialMastodonGetLocalstorage () {
    
    var server;
    
    try {
        
        server = localStorage.getItem( 'ccPlainSocialMastodonServer' );
        
        if ( server === null || server === '' ) {
            
            return false;
            
        }
        
        return server;
        
    } catch(e) {
        
        return false;
        
    }
    
}

function ccPlainSocialMastodonSetLocalstorage ( serverUrl ) {
    
    try {
        
        localStorage.setItem( 'ccPlainSocialMastodonServer', serverUrl );
        
        return true;
        
    } catch(e) {
        
        return false;
        
    }
    
}

function ccPlainSocialMastodonShare() {
    
    var server, text, link, mastodonButton;
    
    server = ccPlainSocialMastodonGetLocalstorage();
    
    mastodonButton = document.querySelector(".ccPlainMastodon");
    
    if ( server === false ) {
        
        server = document.querySelector('.ccPlainSocialMastodonServer').value;
        
    }
    
    ccPlainSocialCloseMastodon();
    
    text = mastodonButton.dataset.text;
    link = mastodonButton.dataset.link;
    
    server = server.replace(/\/$/, "");

    var url = server + '/share?text=' + text + ' ' + link;

    socialWindow( url );
    
}




function ccPlainSocialTextResizer( button, action ) {
    
    if ( ( action > 0 && ccPlainSocialFontSizeDef < 150 ) || ( action < 0 && ccPlainSocialFontSizeDef > 50 ) ) {
        
        ccPlainSocialFontSizeDef = ccPlainSocialFontSizeDef + ( 10 * action);
        
        document.querySelector( button.dataset.textselector ).style.fontSize = ccPlainSocialFontSizeDef + "%";
        
    }
    
}




function bypassCache() {
    
    this.isLocalStorageAvailable = function() {

        try {

            localStorage.setItem( 'test', 'test' );
            localStorage.removeItem( 'test' );
            return true;

        } catch(e) {

            return false;

        }

    };
    
    this.makeQuery = function() {
        
        var fd, xhr;
        
        fd = new FormData();    
        fd.append( 'action',        this.action );
        fd.append( 'security',      this.security );
        fd.append( 'postId',        this.postId );
        fd.append( 'timeInterval',  this.timeInterval );
        
        xhr = new XMLHttpRequest();
        xhr.open( 'POST', this.ajaxurl, true );
        xhr.setRequestHeader( 'X-Requested-With', 'XMLHttpRequest' );
        xhr.send( fd );
        
        xhr.onreadystatechange = function() {

            if ( this.readyState === 4 && this.status === 200 && this.responseText !== 'fail' ) {

                self.shares = this.responseText;
                self.applyHtml();
                self.updateLocalCache();

            }

        };
        
    };
    
    this.updateLocalCache = function() {
        
        if ( this.localCacheEnable !== '1' ) { return false; }
		
        this.localData[ this.postId ] = {
            
            shares:         this.shares,
            lastUpdated:    Date.now()
        };
        
        localStorage.setItem( 'ccPlainSocialCounter', JSON.stringify( this.localData ) );
        
    };
    
    this.loadLocalCache = function() {
        
        if ( this.localCacheEnable !== '1' ) { return false; }
		
        var data = JSON.parse( localStorage.getItem( 'ccPlainSocialCounter' ) );

        if ( data === null ) {

                this.localData = {};

        } else {

                this.localData = data;

        }
        
    };
    
    this.applyHtml = function() {
        
        var formattedData;
        
        if ( parseInt( this.shares ) < parseInt( this.minimum ) ) { return false; }
        
        if ( this.shares > 999 ) {
            
            formattedData = ( Math.round( ( this.shares / 1000 ) * 10 ) / 10 ) + 'K';
            
        } else {
            
            formattedData = this.shares;
            
        }
        
        this.floatingBarCounter.innerHTML = formattedData;
        this.floatingBarCounter.style.transition = 'opacity 0.3s ease 0s';
        this.floatingBarCounterIcon.style.transition = 'opacity 0.3s ease 0s';
        this.floatingBarCounter.style.opacity = 1;
        this.floatingBarCounterIcon.style.opacity = 1;
        
    };
    
    var self = this;
    
    this.postId                 = CcPlainOptions.postId;    
    this.action                 = 'counterData';
    this.minimum                = CcPlainOptions['counter-minimum-show'];
    this.security               = CcPlainOptions.security;
    this.ajaxurl                = CcPlainOptions.ajaxurl;
    this.timeInterval           = CcPlainOptions['counter-time-interval'] * 60 * 60;
    this.localCacheEnable       = CcPlainOptions['counter-cache-bypass-localcache'];
    this.localExpire 		= parseInt( CcPlainOptions['counter-cache-bypass-localcache-expire'] ) * 60 * 60 * 1000;
    this.shares                 = 0;
    this.localData		= {};
    this.currentTimestamp 	= Date.now();
    this.floatingBar            = document.querySelector('.ccPlainSocialFloating');
    this.floatingBarCounter     = document.querySelector('.ccPlainSocialFloatingCounter');
    this.floatingBarCounterIcon = document.querySelector('.ccPlainSocialFloatingCounterIcon');
    this.deviceWidth            = window.innerWidth
                                || document.documentElement.clientWidth
                                || document.body.clientWidth;
    
    if ( this.floatingBar === null ) { return false; }
    
    if ( this.deviceWidth > 1025 && CcPlainOptions['counter-cache-bypass-desktop'] === '0' ) { return false; }
    
    if ( this.deviceWidth > 768 && this.deviceWidth <= 1025 && CcPlainOptions['counter-cache-bypass-tablet'] === '0' ) { return false; }
    
    if ( this.deviceWidth <= 768 && CcPlainOptions['counter-cache-bypass-mobile'] === '0' ) { return false; }

    this.loadLocalCache();
    
    if ( this.localData.hasOwnProperty( this.postId ) === false ) {
		
        this.makeQuery();
        
    } else {
		
        if ( ( this.currentTimestamp - this.localData[ this.postId ][ 'lastUpdated' ] ) > this.localExpire ) {

            this.makeQuery();

        } else {

            this.shares = this.localData[ this.postId ][ 'shares' ];
            this.applyHtml();

        }

    }
    
}