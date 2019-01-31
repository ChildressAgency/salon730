<?php

///////////////////////////////////////////////////////////////////////////////
// DEPENDENCIES                                                              //
///////////////////////////////////////////////////////////////////////////////
function load_dependencies(){
    wp_register_script(
        'dependencies-script',
        get_template_directory_uri() . '/js/block-dependencies.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components' )
    );

    wp_enqueue_script( 'dependencies-script' );
}
add_action( 'init', 'load_dependencies', 10, 0 );

///////////////////////////////////////////////////////////////////////////////
// CONTAINER                                                                 //
///////////////////////////////////////////////////////////////////////////////
function container_block(){
    wp_register_script(
        'container-script',
        get_template_directory_uri() . '/js/block-container.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components' )
    );

    register_block_type('childress/container', array(
        'editor_script' => 'container-script',
    ) );
}
add_action( 'init', 'container_block', 10, 0 );

///////////////////////////////////////////////////////////////////////////////
// HERO BOX                                                                  //
///////////////////////////////////////////////////////////////////////////////
function hero_box_block(){
    wp_register_script(
        'hero-box-script',
        get_template_directory_uri() . '/js/block-hero-box.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components' )
    );

    wp_register_style(
        'hero-box-editor-style',
        get_template_directory_uri() . '/css/block-hero-box-editor-style.css',
        array( 'wp-edit-blocks' )
    );

    wp_register_style(
        'hero-box-style',
        get_template_directory_uri() . '/css/block-hero-box-style.css',
        array( 'wp-edit-blocks' )
    );

    register_block_type('childress/hero-box', array(
        'editor_script' => 'hero-box-script',
        'editor_style'  => 'hero-box-editor-style',
        'style'  => 'hero-box-style',
    ) );
}
add_action( 'init', 'hero_box_block', 10, 0 );

///////////////////////////////////////////////////////////////////////////////
// VALUE BOXES                                                               //
///////////////////////////////////////////////////////////////////////////////
function value_boxes_block(){
    wp_register_script(
        'value-boxes-script',
        get_template_directory_uri() . '/js/block-value-boxes.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components' )
    );

    wp_register_style(
        'value-boxes-editor-style',
        get_template_directory_uri() . '/css/block-value-boxes-editor-style.css',
        array( 'wp-edit-blocks' )
    );

    wp_register_style(
        'value-boxes-style',
        get_template_directory_uri() . '/css/block-value-boxes-style.css',
        array( 'wp-edit-blocks' )
    );

    register_block_type('childress/value-boxes', array(
        'editor_script' => 'value-boxes-script',
        'editor_style'  => 'value-boxes-editor-style',
        'style'  => 'value-boxes-style',
    ) );
}
add_action( 'init', 'value_boxes_block', 10, 0 );

///////////////////////////////////////////////////////////////////////////////
// IMAGE LINKS                                                               //
///////////////////////////////////////////////////////////////////////////////
function image_links_block(){
    wp_register_script(
        'image-links-script',
        get_template_directory_uri() . '/js/block-image-links.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components' )
    );

    wp_register_style(
        'image-links-editor-style',
        get_template_directory_uri() . '/css/block-image-links-editor-style.css',
        array( 'wp-edit-blocks' )
    );

    wp_register_style(
        'image-links-style',
        get_template_directory_uri() . '/css/block-image-links-style.css',
        array( 'wp-edit-blocks' )
    );

    register_block_type('childress/image-links', array(
        'editor_script' => 'image-links-script',
        'editor_style'  => 'image-links-editor-style',
        'style'  => 'image-links-style',
    ) );
}
add_action( 'init', 'image_links_block', 10, 0 );

///////////////////////////////////////////////////////////////////////////////
// INSTAGRAM FEED                                                            //
///////////////////////////////////////////////////////////////////////////////
function insta_feed_block(){
    wp_register_script(
        'insta-feed-script',
        get_template_directory_uri() . '/js/block-insta-feed.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components' )
    );

    wp_register_style(
        'insta-feed-editor-style',
        get_template_directory_uri() . '/css/block-insta-feed-editor-style.css',
        array( 'wp-edit-blocks' )
    );

    wp_register_style(
        'insta-feed-style',
        get_template_directory_uri() . '/css/block-insta-feed-style.css',
        array( 'wp-edit-blocks' )
    );

    register_block_type('childress/insta-feed', array(
        'editor_script' => 'insta-feed-script',
        'editor_style'  => 'insta-feed-editor-style',
        'style'  => 'insta-feed-style',
        'render_callback' => 'insta_feed_callback'
    ) );
}
add_action( 'init', 'insta_feed_block', 10, 0 );

function insta_feed_callback(){
    $result = '';

    $result .= '<div class="instagram">
        <div class="instagram__controls">
            <a class="instagram__link" target="blank" href="' . get_option( 'instagram' ) . '"><i class="fab fa-instagram"></i></a>
            <div class="instagram__next"><div class="instagram__triangle"></div></div>
            <div class="instagram__prev"><div class="instagram__triangle"></div></div>
        </div>

        <div class="instagram__feed">';

    function fetchData($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
            
    $url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token=' . get_option( 'insta_access_token' );
    $data = fetchData( $url );
    
    $data = json_decode($data);
    foreach($data->data as $post) {
        $result .= '<a target="blank" href="' . $post->link . '"><img src="' . $post->images->low_resolution->url . '" /></a>';
    }
    $result .= '</div>

    </div>';

    return $result;
}


///////////////////////////////////////////////////////////////////////////////
// ACTION BOXES                                                              //
///////////////////////////////////////////////////////////////////////////////
function action_boxes_block(){
    wp_register_script(
        'action-boxes-script',
        get_template_directory_uri() . '/js/block-action-boxes.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components' )
    );

    wp_register_style(
        'action-boxes-editor-style',
        get_template_directory_uri() . '/css/block-action-boxes-editor-style.css',
        array( 'wp-edit-blocks' )
    );

    wp_register_style(
        'action-boxes-style',
        get_template_directory_uri() . '/css/block-action-boxes-style.css',
        array( 'wp-edit-blocks' )
    );

    register_block_type('childress/action-boxes', array(
        'editor_script' => 'action-boxes-script',
        'editor_style'  => 'action-boxes-editor-style',
        'style'  => 'action-boxes-style',
    ) );
}
add_action( 'init', 'action_boxes_block', 10, 0 );

///////////////////////////////////////////////////////////////////////////////
// PRICE LIST                                                                //
///////////////////////////////////////////////////////////////////////////////
function price_list_block(){
    wp_register_script(
        'price-list-script',
        get_template_directory_uri() . '/js/block-price-list.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components' )
    );

    wp_register_style(
        'price-list-editor-style',
        get_template_directory_uri() . '/css/block-price-list-editor-style.css',
        array( 'wp-edit-blocks' )
    );

    wp_register_style(
        'price-list-style',
        get_template_directory_uri() . '/css/block-price-list-style.css',
        array( 'wp-edit-blocks' )
    );

    register_block_type('childress/price-list', array(
        'editor_script' => 'price-list-script',
        'editor_style'  => 'price-list-editor-style',
        'style'  => 'price-list-style',
    ) );
}
add_action( 'init', 'price_list_block', 10, 0 );

///////////////////////////////////////////////////////////////////////////////
// COLLAPSIBLE                                                               //
///////////////////////////////////////////////////////////////////////////////
function collapsible_block(){
    wp_register_script(
        'collapsible-script',
        get_template_directory_uri() . '/js/block-collapsible.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components' )
    );

    wp_register_style(
        'collapsible-editor-style',
        get_template_directory_uri() . '/css/block-collapsible-editor-style.css',
        array( 'wp-edit-blocks' )
    );

    wp_register_style(
        'collapsible-style',
        get_template_directory_uri() . '/css/block-collapsible-style.css',
        array( 'wp-edit-blocks' )
    );

    register_block_type('childress/collapsible', array(
        'editor_script' => 'collapsible-script',
        'editor_style'  => 'collapsible-editor-style',
        'style'  => 'collapsible-style',
    ) );
}
add_action( 'init', 'collapsible_block', 10, 0 );

///////////////////////////////////////////////////////////////////////////////
// TABS                                                                      //
///////////////////////////////////////////////////////////////////////////////
function tabs_block(){
    wp_register_script(
        'tabs-script',
        get_template_directory_uri() . '/js/block-tabs.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components' )
    );

    wp_register_style(
        'tabs-editor-style',
        get_template_directory_uri() . '/css/block-tabs-editor-style.css',
        array( 'wp-edit-blocks' )
    );

    wp_register_style(
        'tabs-style',
        get_template_directory_uri() . '/css/block-tabs-style.css',
        array( 'wp-edit-blocks' )
    );

    register_block_type('childress/tabs', array(
        'editor_script' => 'tabs-script',
        'editor_style'  => 'tabs-editor-style',
        'style'  => 'tabs-style',
    ) );
}
add_action( 'init', 'tabs_block', 10, 0 );

///////////////////////////////////////////////////////////////////////////////
// STYLISTS                                                                  //
///////////////////////////////////////////////////////////////////////////////
function stylists_block(){
    wp_register_script(
        'stylists-script',
        get_template_directory_uri() . '/js/block-stylists.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components' )
    );

    wp_register_style(
        'stylists-editor-style',
        get_template_directory_uri() . '/css/block-stylists-editor-style.css',
        array( 'wp-edit-blocks' )
    );

    wp_register_style(
        'stylists-style',
        get_template_directory_uri() . '/css/block-stylists-style.css',
        array( 'wp-edit-blocks' )
    );

    register_block_type('childress/stylists', array(
        'editor_script' => 'stylists-script',
        'editor_style'  => 'stylists-editor-style',
        'style'  => 'stylists-style',
        'render_callback' => 'stylists_callback'
    ) );
}
add_action( 'init', 'stylists_block', 10, 0 );

function stylists_callback( $attributes, $content ){
    $result = '<div class="wp-block-childress-stylists stylists">
                <div class="container">
                    <div class="stylists__grid">';

    if( isset( $attributes['category'] ) )
        $terms = explode( ',', $attributes['category'] );
    else
        $terms = array( 'elite-1' );

    function fetchData($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    $args = array(
        'posts_per_page'    => -1,
        'post_type'         => 'stylists',
        'orderby'           => 'date',
        'order'             => 'ASC',
        'tax_query'         => array(
            array(
                'taxonomy'  => 'stylist-category',
                'field'     => 'slug',
                'terms'     => $terms
            )
        )
    );

    $query = new WP_Query( $args );

    if( $query->have_posts() ){
        while( $query->have_posts() ){
            $query->the_post();
            global $post;
            $blocks = '';
            $stylistTemplate = '';
            $attr = '';

            if( has_blocks( $post->post_content ) ){
                $blocks = parse_blocks( $post->post_content );
            }

            if( $blocks ){
                foreach( $blocks as $block ){
                    if( 'childress/stylist-template' == $block['blockName'] ){
                        $stylistTemplate = $block;
                    }
                }
            }

            if( $stylistTemplate ){
                $attr = $stylistTemplate['attrs'];
            }

            
            $result .= '<div id="stylist-' . strtolower( get_the_title() ) . '" class="stylist">
                    <img class="stylist__image" src="' . $attr['imageUrl'] . '" alt="' . $attr['imageAlt'] . '" />
                    <p class="stylist__name">' . strtoupper( get_the_title() ) . '</p>
                    <div class="stylist__modal">
                        <div class="stylist__close-modal"></div>
                        <div class="container">
                            <div class="stylist__info">
                                <img class="stylist__image" src="' . $attr['imageUrl'] . '" alt="' . $attr['imageAlt'] . '" />
                                <div class="stylist__bio">
                                    <h3 class="stylist__name">' . strtoupper( $attr['fullName'] ) . '</h3>
                                    <p class="stylist__title">' . $attr['title'] . '</p>
                                    <p class="stylist__desc">' . $attr['desc'] . '</p>';

            if( $attr['appointmentUrl'] ){
                $result .= '<div class="wp-block-button is-style-outline"><a class="wp-block-button__link" href="' . $attr['appointmentUrl'] . '" target="blank">SET AN APPOINTMENT</a></div>';
            }

            $result .= '</div>
                    </div>';

            if( $attr['instaToken'] && $attr['instaUrl'] ){
                $result .= '<div class="stylist__insta">
                            <p>A SNIP OF MY INSTAGRAM <a href="' . $attr['instaUrl'] . '" target="blank"><i class="fab fa-instagram"></i></a></p>
                            <div class="stylist__insta-feed">';
                        
                $url = 'https://api.instagram.com/v1/users/self/media/recent/?access_token=' . $attr['instaToken'];
                $data = fetchData( $url );
                
                $data = json_decode($data);
                foreach($data->data as $post) {
                    $result .= '<a target="blank" href="' . $post->link . '"><img src="' . $post->images->low_resolution->url . '" /></a>';
                }
                                
                $result .= '</div>
                            <div class="stylist__insta-arrows">
                                <div class="stylist__insta-prev"><</div>
                                <div class="stylist__insta-next">></div>
                            </div>
                        </div>';
            }
            $result .= '</div>
                    </div>
                </div>';
        }
    }

    $result .= '</div>
            </div>
        </div>';

    return $result;
}

///////////////////////////////////////////////////////////////////////////////
// STYLIST TEMPLATE                                                          //
///////////////////////////////////////////////////////////////////////////////
function stylist_template_block(){
    wp_register_script(
        'stylist-template-script',
        get_template_directory_uri() . '/js/block-stylist-template.js',
        array( 'wp-blocks', 'wp-element', 'wp-editor', 'wp-components' )
    );

    wp_register_style(
        'stylist-template-editor-style',
        get_template_directory_uri() . '/css/block-stylist-template-editor-style.css',
        array( 'wp-edit-blocks' )
    );

    wp_register_style(
        'stylist-template-style',
        get_template_directory_uri() . '/css/block-stylist-template-style.css',
        array( 'wp-edit-blocks' )
    );

    register_block_type('childress/stylist-template', array(
        'editor_script' => 'stylist-template-script',
        'editor_style'  => 'stylist-template-editor-style',
        'style'  => 'stylist-template-style'
    ) );
}
add_action( 'init', 'stylist_template_block', 10, 0 );
