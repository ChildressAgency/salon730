$(document).ready(function(){

    /**
     * HEADER NAVIGATION
     */
    $header_nav = $( '.header__nav' ).find( '.navbar__nav' );
    $header_nav_height = 0;

    $( '.navbar__toggler' ).click(function(){
            $header_nav_height = 0;
            $header_nav.children().each(function(){
                $header_nav_height += $( this ).outerHeight() + parseInt( $( this ).css('marginTop') ) + parseInt( $( this ).css('marginBottom') );
            });

        if( $header_nav.hasClass( 'navbar__open' ) ){
            $header_nav.removeClass( 'navbar__open' );
            $header_nav.css( 'max-height', '0' );
        } else {
            $header_nav.addClass( 'navbar__open' );
            $header_nav.css( 'max-height', $header_nav_height + 'px' );
        }
    });

    /*
     * SLIDERS
     */
    $('.featured-slider').slick({
        dots: false,
        infinite: true,
        autoplay: true,
        slidesToShow: 1,
        arrows: false,
        autoplaySpeed: 5000
    });

    $( '.instagram__feed' ).slick({
        slidesToShow:       5,
        slidesToScroll:     1,
        infinite:           true,
        variableWidth:      true,
        dots:               false,
        arrows:             true,
        nextArrow:          $( '.instagram__next' ),
        prevArrow:          $( '.instagram__prev' ),
        autoplay:           true,
        autoplaySpeed:      3000
    });

    /*
     * ACTION BOXES HEADINGS
     *
     * Ensure the headings of adjacent action boxes are the same height
     */
    function adjustActionBoxTitleHeight(){
        $actionbox_title_height = 0;
        $( '.action-boxes' ).children().each( function(){
            $( this ).find( '.action-box__title' ).height( 'auto' );
            $height = $( this ).find( '.action-box__title' ).height();

            if( $height > $actionbox_title_height ){
                $actionbox_title_height = $height;
            }
        } );

        $( '.action-boxes' ).children().each( function(){
            $( this ).find( '.action-box__title' ).height( $actionbox_title_height );
        } );
    }
    adjustActionBoxTitleHeight();
    $( window ).resize( function(){
        adjustActionBoxTitleHeight();
    } );

});
