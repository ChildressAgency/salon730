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
