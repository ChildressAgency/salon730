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
        autoplaySpeed:      4000
    });

    $( '.stylist__insta-feed' ).slick({
        slidesToShow:       4,
        slidesToScroll:     1,
        infinite:           true,
        variableWidth:      true,
        dots:               false,
        arrows:             true,
        nextArrow:          $( '.stylist__insta-next' ),
        prevArrow:          $( '.stylist__insta-prev' ),
        autoplay:           true,
        autoplaySpeed:      4000
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


    /*
     * COLLAPSIBLE BLOCK
     */
    $( '.collapsible__title' ).click(function(){
        $content = $( this ).next();
        $height = 0;
        $content.children().each(function(){
            $height += $( this ).outerHeight() + parseInt( $( this ).css('marginTop') ) + parseInt( $( this ).css('marginBottom') );
        });

        if( $content.hasClass( 'collapsible--open' ) ){
            $content.css( 'max-height', '0' );
            $content.removeClass( 'collapsible--open' );
            $( this ).find( '.collapsible__arrow' ).css( 'transform', 'rotate(0deg)' );
        } else {
            $content.addClass( 'collapsible--open' );
            $content.css( 'max-height', $height + 'px' );
            $( this ).find( '.collapsible__arrow' ).css( 'transform', 'rotate(90deg)' );
        }
    });

    /*
     * TABS
     */
    $( '.tabs__title' ).click( function(){
        if( $( this ).hasClass( 'tabs__title--a' ) ){
            $thisTab = $( this ).parent().next().children().eq(0);
            $thatTab = $( this ).parent().next().children().eq(1);

            $thisTab.css( 'display', 'block' );
            // $( this ).css( 'background-color', '#8bc53f' );
            // $( this ).css( 'color', '#fff' );
            $( this ).addClass( 'tabs__title--active' );

            $thatTab.css( 'display', 'none' );
            $( this ).next().removeClass( 'tabs__title--active' );
            // $( this ).next().css( 'background-color', '#fff' );
            // $( this ).next().css( 'color', '#000' );
        } else {
            $thisTab = $( this ).parent().next().children().eq(1);
            $thatTab = $( this ).parent().next().children().eq(0);

            $thisTab.css( 'display', 'block' );
            $( this ).addClass( 'tabs__title--active' );
            // $( this ).css( 'background-color', '#8bc53f' );
            // $( this ).css( 'color', '#fff' );

            $thatTab.css( 'display', 'none' );
            $( this ).prev().removeClass( 'tabs__title--active' );
            // $( this ).prev().css( 'background-color', '#fff' );
            // $( this ).prev().css( 'color', '#000' );
        }
    } );


    /*
     * STYLIST MODAL
     * 
     * Show more info about a stylist when they are clicked on
     */
    $isModalOpen = false;
    $( '.stylist__image' ).click( function(){
        openModal( $( this ) );
    } );
    $( '.stylist__name' ).click( function(){
        openModal( $( this ) );
    } );

    function openModal( stylist ){
        $modal = stylist.parent().find( '.stylist__modal' );

        if( !$isModalOpen ){
            $modal.css( 'display', 'block' );
            $isModalOpen = true;
        } else {
            $( '.stylist__modal' ).css( 'display', 'none' );
            $modal.css( 'display', 'block' );
        }
    }

    $( '.stylist__close-modal' ).click( function(){
        $( this ).parent().css( 'display', 'none' );
        $isModalOpen = false;
    } );
});
