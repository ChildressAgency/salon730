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

        if( $header_nav.hasClass( 'is-open' ) ){
            $header_nav.removeClass( 'is-open' );
            $header_nav.css( 'max-height', '0' );

            $drop_menu = $header_nav.find( '.navbar__drop-menu' );
            $drop_menu.css( 'max-height', '0' );
            $drop_menu.removeClass( 'is-open' );
        } else {
            $header_nav.addClass( 'is-open' );
            $header_nav.css( 'max-height', $header_nav_height + 'px' );
        }
    });

    $( '.navbar__item.navbar__drop' ).click(function(){
        $drop_height = 0;
        $drop_menu = $( this ).find( '.navbar__drop-menu' );
        $drop_menu.children().each(function(){
            $drop_height += $( this ).outerHeight() + parseInt( $( this ).css('marginTop') ) + parseInt( $( this ).css('marginBottom') );
        });

        if( $( window ).width() < 768 ){

            if( $drop_menu.hasClass( 'is-open' ) ){
                $drop_menu.css( 'max-height', '0' );
                $drop_menu.removeClass( 'is-open' );
            } else {
                $drop_menu.css( 'max-height', $drop_height + 'px' );
                $drop_menu.addClass( 'is-open' );

                $parent_nav = $drop_menu.parents( '.navbar__nav' );

                $parent_height = parseInt( $parent_nav.css( 'max-height' ) );
                $new_height = $parent_height + $drop_height;
                $parent_nav.css( 'max-height', $new_height + 'px' );
            }

        }
    });

    /*
     * SLIDERS
     */
    $('.announcement-slider').slick({
        dots: false,
        infinite: true,
        autoplay: true,
        slidesToShow: 1,
        arrows: true,
        nextArrow: '.slick-arrow--next',
        prevArrow: '.slick-arrow--prev',
        autoplaySpeed: 5000,
        adaptiveHeight: true
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
            $( this ).addClass( 'tabs__title--active' );

            $thatTab.css( 'display', 'none' );
            $( this ).next().removeClass( 'tabs__title--active' );
        } else {
            $thisTab = $( this ).parent().next().children().eq(1);
            $thatTab = $( this ).parent().next().children().eq(0);

            $thisTab.css( 'display', 'block' );
            $( this ).addClass( 'tabs__title--active' );

            $thatTab.css( 'display', 'none' );
            $( this ).prev().removeClass( 'tabs__title--active' );
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
