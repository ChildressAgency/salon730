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
