<?php 

// Custom Nav Walker
class Custom_Nav_Walker extends Walker_Nav_Menu {

    function start_el(&$output, $item, $depth = 0, $args = array(), $current_object_id = 0) {
        global $post;
        if( $post )
            $pageID = $post->ID; // id of current page
        else
            $pageID = '';
        $title = $item->title; // title of menu item
        $objectID = $item->object_id; // page id of menu item
        $permalink = $item->url; // link of menu item
        $hasChildren = in_array( 'has-children', $item->classes ); // whether the menu item has children
        $parent = $item->menu_item_parent; // the parent of the current menu item

        // if the current menu item has a parent, then it is a dropdown item
        if( $parent ){
            $output .= "<li><a class=\"navbar__drop-item";

            // if this item goes to this page, then highlight it
            if( $objectID == $pageID )
                $output .= " active";

            $output .= "\" href=\"" . $permalink . "\">";
            $output .= $title;
            $output .= "</a>";
        } else {
            $output .= "<li class=\"navbar__item";

            // if this item has children, then it is a dropdown menu
            if( $hasChildren )
                $output .= " navbar__drop";

            // close the tag
            $output .= "\">";


            // if this item is a dropdown menu, it needs some extra info
            if( $hasChildren ){
                $output .= "<a href=\"" . $permalink . "\" class=\"navbar__link navbar__drop-toggle\">";
            }
            else{
                $output .= "<a href=\"" . $permalink . "\" class=\"navbar__link\">";
            }

            // item title and close the tag
            $output .= $title;
            $output .= "</a>";
        }
    }

    // same as the default function, except the class is 'dropdown-menu' instead of 'sub-menu'
    function start_lvl( &$output, $depth = 0, $args = array() ){
        if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
                $t = '';
                $n = '';
            } else {
                $t = "\t";
                $n = "\n";
            }
            $indent = str_repeat( $t, $depth );
         
            // Default class.
            $classes = array( 'navbar__drop-menu');
         
            /**
             * Filters the CSS class(es) applied to a menu list element.
             *
             * @since 4.8.0
             *
             * @param array    $classes The CSS classes that are applied to the menu `<ul>` element.
             * @param stdClass $args    An object of `wp_nav_menu()` arguments.
             * @param int      $depth   Depth of menu item. Used for padding.
             */
            $class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
            $class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';
         
            $output .= "{$n}{$indent}<ul$class_names>{$n}";
    }
}

// if a nav item has children, add the 'has-children' class to it
function add_has_children_to_nav_items( $items )
{
    $parents = wp_list_pluck( $items, 'menu_item_parent');

    foreach ( $items as $item )
        in_array( $item->ID, $parents ) && $item->classes[] = 'has-children';

    return $items;
}
add_filter( 'wp_nav_menu_objects', 'add_has_children_to_nav_items' );