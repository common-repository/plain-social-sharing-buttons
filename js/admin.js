window.addEventListener('load', arranger, false);
window.addEventListener('load', ccPlainSocialInitiator, false);

let _ccPlainSocialEl;

document.querySelectorAll('.cc-plain-social-tablinks')[0].className += " active";

document.querySelectorAll('.cc-plain-social-tabcontent')[0].style.display = "block";

document.querySelectorAll('.cc-plain-social-tablinks').forEach(function( elem ){
    
    elem.addEventListener('click', clickSection);
    
});

document.querySelectorAll('.floatingButtons [draggable=true]').forEach(function( elem ){
    
    elem.addEventListener('dragstart', dragStart);
    elem.addEventListener('dragover', dragOver);
    elem.addEventListener('dragend', dragEnd);
    
});

function checkBoxChange( event ) {
    
    var wantedId =  event.target.dataset.for;
    
    if ( event.target.checked === true ) {
        
        document.getElementById( wantedId ).value = '1';
        
    } else {
        
        document.getElementById( wantedId ).value = '0';
        
    }
    
}

function arranger() {
    
    var contWidth, optionsWidth;
    
    contWidth = document.querySelector('.wrap').offsetWidth;
    optionsWidth = document.querySelector('.cc-plain-social-container').offsetWidth;

    document.querySelector('.cc-plain-social-tab').style.width = ( contWidth - optionsWidth ) + 'px';
    
}

function clickSection( event ) {
    
    event.preventDefault();
    
    var i, contentElems, contentElemsNum, linkElems, linkElemsNum;
    
    contentElems        = document.querySelectorAll('.cc-plain-social-tabcontent');
    contentElemsNum     = contentElems.length;
    
    for ( i=0 ; i<contentElemsNum ; i++ ) {
        
        contentElems[i].style.display = 'none';
        
    }
    
    linkElems   = document.querySelectorAll('.cc-plain-social-tablinks');
    linkElemsNum    = linkElems.length;
    
    for ( i=0 ; i<linkElemsNum ; i++ ) {
        
        linkElems[i].className = linkElems[i].className.replace(" active", "");
        
    }
    
    event.target.className += " active";
    
    document.getElementById( event.target.dataset.for ).style.display = "block";
    
}

function isBefore( el1, el2 ) {
    
    var cur;
    
    if ( el2.parentNode === el1.parentNode ) {
        
        for ( cur = el1.previousSibling; cur; cur = cur.previousSibling) {
            
            if ( cur === el2 ) {
                
                return true;
                
            }
            
        }
        
    }
    
    return false;
    
}

function dragOver( event ) {
    
    if ( isBefore( _ccPlainSocialEl, event.target ) === true ) {
    
        event.target.parentNode.insertBefore( _ccPlainSocialEl, event.target );
        
    } else {
        
        if ( event.target.parentNode !== _ccPlainSocialEl ) {

            event.target.parentNode.insertBefore( _ccPlainSocialEl, event.target.nextSibling);
            
        }
        
    }

}

function dragEnd() {
    
    var floatingButtons, floatingButtonsNum;
    
    var sorted = new Array();
    
    _ccPlainSocialEl = null;
    
    floatingButtons = document.querySelectorAll('.floatingButtons [draggable=true]');
    floatingButtonsNum = floatingButtons.length;
    
    for ( var i=0 ; i<floatingButtonsNum ; i++ ) {
        
        sorted.push( floatingButtons[ i ].dataset.drag );
        
    }
    
    document.getElementById('hidden_floating-sort').value = sorted.join( ',' );
  
}

function dragStart( event ) {
    
  event.dataTransfer.effectAllowed = "move";
  
  event.dataTransfer.setData( "text/plain", null );
  
  _ccPlainSocialEl = event.target;
  
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
    
    if ( ccPlainSocialIsLocalStorageAvailable() === true ) {

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
                
                if ( document.getElementById('ccPlainSocialMastodonMemorize').checked === true ) {
    
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




function mastodonGdpr( event ) {
    
    if ( event.target.checked === false ) {

        document.getElementById('mastodon-popupmemorize_field').style.display = 'none';

        document.getElementById('mastodon-popupmemorizetitle_field').style.display = 'none';

    } else {

        document.getElementById('mastodon-popupmemorize_field').style.display = 'flex';

        document.getElementById('mastodon-popupmemorizetitle_field').style.display = 'flex';
        
    }
    
}

function inputOptionTextbox( event ) {
    
    document.getElementById( 'hidden_' + event.target.dataset.for ).value = event.target.value;
    
}

function inputOptionCheckbox( event ) {
    
    var elem;
    
    elem = document.getElementById( 'hidden_' + event.target.dataset.for );
    
    if ( event.target.checked === true ) {
        
        elem.value = event.target.dataset.checked;
        
    } else {
        
        elem.value = event.target.dataset.unchecked;
        
    }
    
    if ( event.target.dataset.for === 'mastodon-popupmemorizeenable' ) {
        
        mastodonGdpr( event );
        
    }
    
}

function ccPlainSocialInitiator() {
    
    var buttonsNum;
    var buttons = new Array();
    
    document.querySelectorAll('.inputTextFront').forEach( function( elem ){
    
        elem.value = document.getElementById( 'hidden_' + elem.dataset.for ).value;
        
        elem.addEventListener( 'input', inputOptionTextbox );

    });
    
    document.querySelectorAll('.inputNumberFront').forEach( function( elem ){
    
        elem.value = document.getElementById( 'hidden_' + elem.dataset.for ).value;
        
        elem.addEventListener( 'input', inputOptionTextbox );

    });
    
    document.querySelectorAll('.inputCheckboxFront').forEach( function( elem ){
        
        if ( document.getElementById( 'hidden_' + elem.dataset.for ).value === elem.dataset.checked ) {
            
            elem.checked = true;
            
        }
        
        elem.addEventListener( 'change', inputOptionCheckbox );

    });
    
    buttons.push( document.querySelector(".ccPlainFacebook") );
    buttons.push( document.querySelector(".ccPlainTwitter") );
    buttons.push( document.querySelector(".ccPlainReddit") );
    buttons.push( document.querySelector(".ccPlainLinkedin") );
    buttons.push( document.querySelector(".ccPlainTumblr") );
    buttons.push( document.querySelector(".ccPlainDiaspora") );
    
    buttonsNum = buttons.length;
    
    for ( var i=0 ; i<buttonsNum ; i++ ) {
        
        if ( buttons[ i ] !== null ) {
            
            buttons[ i ].addEventListener("click", function( event ) {

                event.preventDefault();

                socialWindow( event.target.href );

            });
            
        }
        
    }

    if ( document.querySelector(".ccPlainTextInc") !== null ) {

        document.querySelector(".ccPlainTextInc").addEventListener("click", function() {

            if ( ccPlainSocialFontSizeDef < 150 ) {
                ccPlainSocialFontSizeDef = ccPlainSocialFontSizeDef + 10;
            }

            document.querySelector(".entry-content").style.fontSize = ccPlainSocialFontSizeDef + "%";

        });

    }

    if ( document.querySelector(".ccPlainTextDec") !== null ) {

        document.querySelector(".ccPlainTextDec").addEventListener("click", function() {

            if ( ccPlainSocialFontSizeDef > 50 ) {
                ccPlainSocialFontSizeDef = ccPlainSocialFontSizeDef - 10;
            }

            document.querySelector(".entry-content").style.fontSize = ccPlainSocialFontSizeDef + "%";

        });

    }
    
    if ( document.querySelector(".ccPlainMastodon") !== null ) {

        document.querySelector(".ccPlainMastodon").addEventListener("click", function() {

            event.preventDefault();

            if ( ccPlainSocialIsLocalStorageAvailable() === true ) {

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